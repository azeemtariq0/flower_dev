DROP TABLE IF EXISTS `as_receipts`;
CREATE TABLE `as_receipts` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `receipt_code` CHAR(40) DEFAULT NULL,
  `project_id` INT DEFAULT NULL,
  `block_id` INT DEFAULT NULL,
  `unit_id` INT DEFAULT NULL,
  `receipt_date` VARCHAR(255)  DEFAULT NULL,
  `description` VARCHAR(255)  DEFAULT NULL,
  `amount` VARCHAR(255)  DEFAULT NULL,
  `status` INT DEFAULT '0',
  `created_by` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` VARCHAR(255) DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  KEY `id` (`id`)
);

ALTER TABLE `as_receipts`   
  ADD COLUMN `unit_category_id` INT NULL AFTER `block_id`;

ALTER TABLE `as_receipts`   
  ADD COLUMN `year` CHAR(40) NULL AFTER `description`;

ALTER TABLE `as_receipts`   
  ADD COLUMN `receipt_type_id` INT(11) NULL AFTER `receipt_code`;


DELIMITER $$
DROP TRIGGER /*!50032 IF EXISTS */ `as_receipts`$$
CREATE
    /*!50017 DEFINER = 'root'@'localhost' */
    TRIGGER `as_receipts` BEFORE INSERT ON `as_receipts` 
    FOR EACH ROW BEGIN
    UPDATE 
     `sequence` 
    SET
     `executed_record` = @tempVariable := executed_record + 1 
    WHERE TABLE_NAME = 'as_receipts'
          AND tbl_year = NEW.year ;
        IF (ROW_COUNT() < 1) THEN 
         INSERT INTO sequence SET TABLE_NAME = 'as_receipts',tbl_year = NEW.year,executed_record = 1;
         SET @tempVariable = 1;
    END IF;
     SET NEW.receipt_code = CONCAT(NEW.year ,'/RV-',LPAD((@tempVariable),4, '0'));
END;
$$
DELIMITER ;




CREATE TABLE `as_expenses` (  
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `exp_code` CHAR(40),
  `project_id` INT(11),
  `block_id` INT(11),
  `exp_category_id` INT(11),
  `exp_date` VARCHAR(255),
  `year` VARCHAR(255),
  `payee` VARCHAR(255),
  `remarks` TEXT,
  `created_at` DATETIME,
  `created_by` INT(11),
  `updated_at` VARCHAR(255),
  `updated_by` INT(11),
  PRIMARY KEY (`id`)
);


CREATE TABLE `as_expense_detail` (  
  `id` INT NOT NULL AUTO_INCREMENT,
  `expense_id` INT,
  `description` TEXT,
  `amount` VARCHAR(255),
  `created_at` DATETIME,
  `created_by` INT,
  `updated_at` VARCHAR(255),
  `updated_by` INT,
  PRIMARY KEY (`id`)
);


DELIMITER $$
DROP TRIGGER /*!50032 IF EXISTS */ `as_expenses`$$
CREATE
    /*!50017 DEFINER = 'root'@'localhost' */
    TRIGGER `as_expenses` BEFORE INSERT ON `as_expenses` 
    FOR EACH ROW BEGIN
    UPDATE 
     `sequence` 
    SET
     `executed_record` = @tempVariable := executed_record + 1 
    WHERE TABLE_NAME = 'as_expenses'
          AND tbl_year = NEW.year ;
        IF (ROW_COUNT() < 1) THEN 
         INSERT INTO sequence SET TABLE_NAME = 'as_expenses',tbl_year = NEW.year,executed_record = 1;
         SET @tempVariable = 1;
    END IF;
     SET NEW.exp_code = CONCAT(NEW.year ,'/EX-',LPAD((@tempVariable),4, '0'));
END;
$$
DELIMITER ;


ALTER TABLE as_unit_owners  
  ADD COLUMN `is_tenant` TINYINT(2) DEFAULT 0 NULL AFTER `owner_since`;\

ALTER TABLE as_expense_detail
  ADD COLUMN `reference_no` VARCHAR(255) NULL AFTER `description`,
  ADD COLUMN `reference_date` VARCHAR(255) NULL AFTER `reference_no`;

ALTER TABLE as_expenses
  ADD COLUMN STATUS TINYINT(2) DEFAULT 0 NULL AFTER remarks;

CREATE TABLE `as_unit_resident` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `unit_id` INT(11) NOT NULL,
  `resident_code` CHAR(40),
  `resident_name` VARCHAR(255),
  `resident_cnic` VARCHAR(255),
  `resident_mobile` VARCHAR(255),
  `resident_email` VARCHAR(255),
  `residing_since` VARCHAR(255),
  `idenetity_type` VARCHAR(255),
  `created_at` TIMESTAMP,
  `created_by` VARCHAR(255),
  `updated_at` DATETIME ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` VARCHAR(255),
  PRIMARY KEY (`id`)
);




DELIMITER $$
DROP TRIGGER /*!50032 IF EXISTS */ `as_unit_resident`$$
CREATE
    /*!50017 DEFINER = 'root'@'localhost' */
    TRIGGER `as_unit_resident` BEFORE INSERT ON `as_unit_resident` 
    FOR EACH ROW BEGIN
    UPDATE 
     `sequence` 
    SET
     `executed_record` = @tempVariable := executed_record + 1 
    WHERE TABLE_NAME = 'as_unit_resident';
        IF (ROW_COUNT() < 1) THEN 
         INSERT INTO sequence SET TABLE_NAME = 'as_unit_resident',executed_record = 1;
         SET @tempVariable = 1;
    END IF;
     SET NEW.resident_code = CONCAT('/RS-',LPAD((@tempVariable),4, '0'));
END;
$$
DELIMITER ;


ALTER TABLE `as_units`   
  ADD COLUMN `last_update` DATE NULL AFTER `ob_date`;


CREATE TABLE `as_generate_receivables` (  
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `unit_id` INT(11),
  `last_amount` VARCHAR(255),
  `actual_amount` VARCHAR(255),
  `date` VARCHAR(255),
  `created_at` DATETIME,
  `updated_at` DATETIME ON UPDATE CURRENT_TIMESTAMP NULL ,
  PRIMARY KEY (`id`)
);


ALTER TABLE `users`   
  ADD COLUMN `project_id` INT(11) NULL AFTER `id`;


ALTER TABLE `as_projects`   
  ADD COLUMN `created_by` INT(11) NULL AFTER `union_other_4`,
  ADD COLUMN `updated_by` INT(11) NULL AFTER `created_at`;

ALTER TABLE `as_receipt_types`   
  ADD COLUMN `created_by` INT(11) NULL AFTER `description`,
  ADD COLUMN `updated_by` INT(11) NULL AFTER `created_at`;


ALTER TABLE `as_unit_owners`   
  ADD COLUMN `created_by` INT(11) NULL AFTER `is_tenant`,
  ADD COLUMN `updated_by` INT(11) NULL AFTER `created_at`;

ALTER TABLE `as_units`   
  ADD COLUMN `created_by` INT(11) NULL AFTER `ob_date`,
  ADD COLUMN `updated_by` INT(11) NULL AFTER `created_at`;

ALTER TABLE `as_blocks`   
  ADD COLUMN `created_by` INT(11) NULL AFTER `description`,
  ADD COLUMN `updated_by` INT(11) NULL AFTER `created_at`,
  CHANGE `updated_at` `updated_at` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NULL;


ALTER TABLE `as_expense_categories`   
  ADD COLUMN `created_by` INT(11) NULL AFTER `description`,
  CHANGE `created_at` `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  ADD COLUMN `update_by` INT(11) NULL AFTER `created_at`,
  CHANGE `updated_at` `updated_at` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NULL;


ALTER TABLE `as_expenses`   
  CHANGE `created_at` `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NULL,
  CHANGE `updated_at` `updated_at` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NULL;



ALTER TABLE `as_projects`   
  CHANGE `created_by` `created_by` INT(11) NULL,
  CHANGE `created_at` `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NULL,
  CHANGE `updated_by` `updated_by` INT(11) NULL,
  CHANGE `updated_at` `updated_at` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NULL;


ALTER TABLE `as_unit_owners`   
  CHANGE `created_by` `created_by` INT(11) NULL,
  CHANGE `created_at` `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP NULL,
  CHANGE `updated_by` `updated_by` INT(11) NULL,
  CHANGE `updated_at` `updated_at` DATETIME ON UPDATE CURRENT_TIMESTAMP NULL;



ALTER TABLE `as_unit_resident`   
  CHANGE `created_at` `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP NULL,
  CHANGE `created_by` `created_by` INT(11) NULL,
  CHANGE `updated_by` `updated_by` INT(11) NULL;


--  Add Soceity Code

ALTER TABLE `users`   
  ADD COLUMN `soceity_id` INT(11) NULL AFTER `id`,
  ADD COLUMN `block_id` INT(11) NULL AFTER `project_id`;

ALTER TABLE `as_projects`   
  ADD COLUMN `soceity_id` INT(11) NULL AFTER `id`;

ALTER TABLE `as_blocks`   
  ADD COLUMN `soceity_id` INT(11) NULL AFTER `id`;

ALTER TABLE `as_units`   
  ADD COLUMN `soceity_id` INT(11) NULL AFTER `id`;

ALTER TABLE `as_unit_owners`   
  ADD COLUMN `soceity_id` INT(11) NULL AFTER `id`;

ALTER TABLE `as_unit_resident`   
  ADD COLUMN `soceity_id` INT(11) NULL AFTER `id`;

ALTER TABLE `as_expenses`   
  ADD COLUMN `soceity_id` INT(11) NULL AFTER `id`;

ALTER TABLE `as_receipts`   
  ADD COLUMN `soceity_id` INT(11) NULL AFTER `id`;

ALTER TABLE `as_generate_receivables`   
  ADD COLUMN `soceity_id` INT(11) NULL AFTER `id`;


CREATE TABLE society(  
  id INT NOT NULL AUTO_INCREMENT,
  Society_code VARCHAR(240),
  society_title VARCHAR(240),
  society_image VARCHAR(240),
  created_at TIMESTAMP,
  updated_at TIMESTAMP,
  PRIMARY KEY (id)
);

ALTER TABLE `users`   
  ADD COLUMN `block_id` INT NULL AFTER `project_id`;

ALTER TABLE `as_expenses`   
  ADD COLUMN `total_amount` VARCHAR(255) NULL AFTER `year`;






CREATE TABLE `orders` (
  `id` INT(11) NOT NULL,
  `code` VARCHAR(255) DEFAULT NULL,
  `year` VARCHAR(255) DEFAULT NULL,
  `date` DATE NOT NULL ,
  `time` VARCHAR(255) DEFAULT NULL,
  `first_name` VARCHAR(255) DEFAULT NULL,
  `last_name` VARCHAR(255) DEFAULT NULL,
  `name` VARCHAR(255) DEFAULT NULL,
  `email` VARCHAR(255) DEFAULT NULL,
  `phone_no` VARCHAR(255) DEFAULT NULL,
  `city_name` VARCHAR(255) DEFAULT NULL,
  `address` VARCHAR(255) DEFAULT NULL,
  `massage` VARCHAR(255) DEFAULT NULL,
  `items` VARCHAR(255) NOT NULL DEFAULT '0',
  `totalAmount` VARCHAR(255) NOT NULL DEFAULT '0',
  `status` INT(1) NOT NULL DEFAULT 1,
  `created_by` INT(11) DEFAULT NULL,
  `created_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `modified_by` INT(11) DEFAULT NULL,
  `modified_date` DATETIME DEFAULT NULL
);



CREATE TABLE `order_detail` (
  `OrderDetailId` INT(11) NOT NULL,
  `OrderId` INT(11) NOT NULL,
  `year` VARCHAR(255) DEFAULT NULL,
  `ItemId` INT(11) NOT NULL,
  `ItemQty` INT(11) NOT NULL,
  `suggestion` VARCHAR(300) DEFAULT NULL,
  `AddedOn` INT(11) NOT NULL,
  `AddedBy` INT(11) NOT NULL,
  `modified_by` VARCHAR(11) NOT NULL,
  `modified_date` DATETIME DEFAULT NULL,
  `Status` INT(11) NOT NULL DEFAULT 1,
  `is_done` TINYINT(1) NOT NULL DEFAULT 0
);


ALTER TABLE `order_detail` ADD COLUMN `price` VARCHAR(255) NULL AFTER `ItemQty`;