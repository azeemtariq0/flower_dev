CREATE TABLE `as_society` (
  `id` INT(11) NOT NULL,
  `Society_code` VARCHAR(240) DEFAULT NULL,
  `society_title` VARCHAR(240) DEFAULT NULL,
  `society_image` VARCHAR(240) DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL
) ;

--
-- Dumping data for table `as_society`
--

INSERT INTO `as_society` (`id`, `Society_code`, `society_title`, `society_image`, `created_at`, `updated_at`) VALUES
(1, '0001', 'Soceity 1', NULL, '2024-01-18 04:37:49', NULL),
(2, '0002', 'Soceity 2', NULL, '2024-01-18 04:38:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` INT(10) UNSIGNED NOT NULL,
  `title` VARCHAR(255)  DEFAULT NULL,
  `slug` VARCHAR(255)  DEFAULT NULL,
  `status` INT(11) DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL
) ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `title`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(5, 'United Arab Emirates', 'united-arab-emirates', 1, '2023-03-29 16:21:49', '2023-06-24 22:11:52'),
(6, 'United States', 'united-states', 1, '2023-03-31 15:08:53', '2023-03-31 15:08:53'),
(7, 'Canada', 'canada', 1, '2023-03-31 15:14:05', '2023-03-31 15:14:05'),
(8, 'Sri Lanka', 'sri-lanka', 1, '2023-03-31 15:24:37', '2023-03-31 15:24:37'),
(9, 'Pakistan', 'karachi', 1, '2023-04-07 19:12:27', '2023-04-07 19:12:56'),
(10, 'Russia', 'russia', 1, '2023-05-15 23:47:53', '2023-05-15 23:47:53'),
(11, 'Saudi Arabia', 'saudi-arabia', 1, '2023-05-15 23:48:28', '2023-05-15 23:48:28'),
(12, 'Kenya', 'kenya', 1, '2023-06-13 18:22:24', '2023-06-13 18:22:24'),
(13, 'Turkey', 'turkey', 1, '2023-06-13 20:15:20', '2023-06-13 20:15:20'),
(14, 'Italy', 'italy', 1, '2023-06-13 21:31:31', '2023-06-13 21:31:31'),
(16, 'Thailand', 'thailand', 1, '2023-06-23 07:05:52', '2023-06-23 07:05:52');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` INT(10) UNSIGNED NOT NULL,
  `status` VARCHAR(255)  DEFAULT NULL,
  `bydefault` INT(11) DEFAULT '0',
  `currency_name` VARCHAR(255)  DEFAULT NULL,
  `currency_symbol` VARCHAR(255)  DEFAULT NULL,
  `currency_code` VARCHAR(255)  DEFAULT NULL,
  `currency_rate` DOUBLE DEFAULT NULL,
  `language_code` VARCHAR(255)  NOT NULL,
  `country_id` VARCHAR(255)  DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL
);

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `status`, `bydefault`, `currency_name`, `currency_symbol`, `currency_code`, `currency_rate`, `language_code`, `country_id`, `created_at`, `updated_at`) VALUES
(7, '0', 0, 'Rupee', '₨', 'PKR', 77.59, 'ur', '9', '2022-08-31 23:21:16', '2023-06-17 13:48:52'),
(18, '1', 1, 'Dirham', 'AED', 'AED', 1, 'ar', '5', '2023-05-15 23:43:56', '2023-06-17 13:47:58'),
(20, '1', 0, 'United States dollar', '$', 'USD', 0.27, 'en', '6', '2023-05-16 18:25:26', '2023-05-16 18:25:26');

-- --------------------------------------------------------

--
-- Table structure for table `destination_themes`
--

CREATE TABLE `destination_themes` (
  `id` INT(10) UNSIGNED NOT NULL,
  `title` VARCHAR(255)  DEFAULT NULL,
  `slug` VARCHAR(255)  DEFAULT NULL,
  `status` VARCHAR(255)  NOT NULL,
  `faqs` VARCHAR(255)  DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL
);

--
-- Dumping data for table `destination_themes`
--

INSERT INTO `destination_themes` (`id`, `title`, `slug`, `status`, `faqs`, `created_at`, `updated_at`) VALUES
(7, 'Honeymoon Packages', 'honeymoon-packages', '1', '[\"26\"]', '2023-03-17 11:55:19', '2023-03-17 13:36:53'),
(9, 'Family Packages', 'family-packages', '1', '[\"27\"]', '2023-03-17 13:17:51', '2023-03-17 13:17:51'),
(10, 'Friends / Group', 'friends-group', '1', NULL, '2023-03-17 13:27:31', '2023-03-17 13:38:01'),
(11, 'Luxury Holidays', 'luxury-holidays', '1', '[\"28\"]', '2023-03-17 13:28:52', '2023-03-17 13:40:30'),
(12, 'Holiday Packages', 'holiday-packages', '1', '[\"29\"]', '2023-03-17 13:30:04', '2023-03-17 13:36:41'),
(13, 'Holiday Deals', 'holiday-deals', '1', '[\"30\"]', '2023-03-17 13:31:07', '2023-03-17 13:32:58'),
(14, 'Religious places', 'religious-places', '1', '[\"31\"]', '2023-03-17 13:34:27', '2023-03-17 13:34:27'),
(15, 'Wildlife places', 'wildlife-places', '1', '[\"32\"]', '2023-03-17 13:35:38', '2023-03-17 13:35:38'),
(16, 'Water Activities', 'water-activities', '1', '[\"33\"]', '2023-03-17 13:36:17', '2023-03-17 13:37:22');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` BIGINT(20) UNSIGNED NOT NULL,
  `uuid` VARCHAR(191)  NOT NULL,
  `connection` TEXT  NOT NULL,
  `queue` TEXT  NOT NULL,
  `payload` LONGTEXT  NOT NULL,
  `exception` LONGTEXT  NOT NULL,
  `failed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` INT(10) UNSIGNED NOT NULL,
  `language_name` VARCHAR(255)  DEFAULT NULL,
  `language_code` VARCHAR(255)  DEFAULT NULL,
  `status` VARCHAR(255)  DEFAULT NULL,
  `bydefault` VARCHAR(255)  DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL
);

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `language_name`, `language_code`, `status`, `bydefault`, `created_at`, `updated_at`) VALUES
(4, 'english', 'en', '1', '1', '2023-02-09 12:23:34', '2023-02-09 12:23:34'),
(5, 'arabic', 'ar', '1', NULL, '2023-02-09 12:23:43', '2023-02-09 12:23:43'),
(6, 'russian', 'ru', '0', NULL, '2023-02-09 15:28:47', '2023-06-14 02:00:41');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` INT(10) UNSIGNED NOT NULL,
  `migration` VARCHAR(191)  NOT NULL,
  `batch` INT(11) NOT NULL
);

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(10, '2022_06_27_073125_create_permission_tables', 1),
(11, '2022_06_27_073153_create_products_table', 1),
(12, '2022_07_04_044044_create_stock_companies_table', 1),
(13, '2022_07_04_045006_add_soft_delete_columns_to_users', 1),
(14, '2022_07_04_093115_create_sectors_table', 1),
(15, '2022_07_04_104729_research_report_category', 1),
(16, '2022_07_04_104751_research_analyst', 1),
(17, '2022_07_04_105002_research_report_type', 1),
(18, '2022_07_05_055114_create_research_uploads_table', 1),
(19, '2022_07_22_073427_create_projects_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` BIGINT(20) UNSIGNED NOT NULL,
  `model_type` VARCHAR(191) NOT NULL,
  `model_id` BIGINT(20) UNSIGNED NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` BIGINT(20) UNSIGNED NOT NULL,
  `model_type` VARCHAR(191) NOT NULL,
  `model_id` BIGINT(20) UNSIGNED NOT NULL
) ;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 2),
(1, 'App\\Models\\User', 3),
(1, 'App\\Models\\User', 4),
(1, 'App\\Models\\User', 5),
(1, 'App\\Models\\User', 6),
(1, 'App\\Models\\User', 7),
(1, 'App\\Models\\User', 8),
(1, 'App\\Models\\User', 38),
(1, 'App\\Models\\User', 39),
(16, 'App\\Models\\User', 1),
(16, 'App\\Models\\User', 33);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` VARCHAR(100)  NOT NULL,
  `user_id` BIGINT(20) UNSIGNED DEFAULT NULL,
  `client_id` BIGINT(20) UNSIGNED NOT NULL,
  `name` VARCHAR(191)  DEFAULT NULL,
  `scopes` TEXT ,
  `revoked` TINYINT(1) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `expires_at` DATETIME DEFAULT NULL
) ;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('d8382b5d0eca40fe3a59bcf7dcd6923b2577c6bf0ffdbfa943ee52676ce644640881921fce7d5b8d', 6, 3, 'authToken', '[]', 0, '2022-08-11 20:24:42', '2022-08-11 20:24:42', '2023-08-11 11:24:42'),
('de6707aa0f556099fe1d5206fd49fda6febcdbf8ad62cc3e620e36d90e9f19e1d2480d57baf5d472', 1, 3, 'authToken', '[]', 0, '2022-08-11 20:23:00', '2022-08-11 20:23:00', '2023-08-11 11:23:00'),
('ed04e46f25354c67691f44287f6cbd5739dee9c150bac5d06da345cc729794fa4e8831d893a2ed1f', 4, 3, 'authToken', '[]', 0, '2022-07-23 01:43:06', '2022-07-23 01:43:06', '2023-07-22 16:43:06');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` VARCHAR(100)  NOT NULL,
  `user_id` BIGINT(20) UNSIGNED NOT NULL,
  `client_id` BIGINT(20) UNSIGNED NOT NULL,
  `scopes` TEXT ,
  `revoked` TINYINT(1) NOT NULL,
  `expires_at` DATETIME DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` BIGINT(20) UNSIGNED NOT NULL,
  `user_id` BIGINT(20) UNSIGNED DEFAULT NULL,
  `name` VARCHAR(191)  NOT NULL,
  `secret` VARCHAR(100)  DEFAULT NULL,
  `provider` VARCHAR(191)  DEFAULT NULL,
  `redirect` TEXT  NOT NULL,
  `personal_access_client` TINYINT(1) NOT NULL,
  `password_client` TINYINT(1) NOT NULL,
  `revoked` TINYINT(1) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL
);

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'BMA-Portal Personal Access Client', 'NUM002BUfgZfUdyyUknOsMck1FmcjrnzorxFwUmY', NULL, 'http://localhost', 1, 0, 0, '2022-07-23 01:42:39', '2022-07-23 01:42:39'),
(2, NULL, 'BMA-Portal Password Grant Client', 'vXH5PJxXTJjF0OF1tiAHHY9M45OoodJHdhPibhaC', 'users', 'http://localhost', 0, 1, 0, '2022-07-23 01:42:39', '2022-07-23 01:42:39'),
(3, NULL, 'BMA-Portal Personal Access Client', 'uUez2GiX7yxFQVrKPJpepRQTzuE1UwQ1EhOn0s1v', NULL, 'http://localhost', 1, 0, 0, '2022-07-23 01:42:52', '2022-07-23 01:42:52'),
(4, NULL, 'BMA-Portal Password Grant Client', 'XU5pPR5qKzsG03Qd0SeEB1lgrAx7O6QekSr08fr8', 'users', 'http://localhost', 0, 1, 0, '2022-07-23 01:42:52', '2022-07-23 01:42:52');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` BIGINT(20) UNSIGNED NOT NULL,
  `client_id` BIGINT(20) UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL
) ;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-07-23 01:42:39', '2022-07-23 01:42:39'),
(2, 3, '2022-07-23 01:42:52', '2022-07-23 01:42:52');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` VARCHAR(100)  NOT NULL,
  `access_token_id` VARCHAR(100)  NOT NULL,
  `revoked` TINYINT(1) NOT NULL,
  `expires_at` DATETIME DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` INT(11) NOT NULL,
  `code` VARCHAR(255) DEFAULT NULL,
  `year` VARCHAR(255) DEFAULT NULL,
  `date` DATE NOT NULL,
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
  `status` INT(1) NOT NULL DEFAULT '1',
  `created_by` INT(11) DEFAULT NULL,
  `created_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` INT(11) DEFAULT NULL,
  `modified_date` DATETIME DEFAULT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

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
  `Status` INT(11) NOT NULL DEFAULT '1',
  `is_done` TINYINT(1) NOT NULL DEFAULT '0'
) ;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` BIGINT(20) UNSIGNED NOT NULL,
  `name` VARCHAR(191) NOT NULL,
  `guard_name` VARCHAR(191) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL
) ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'role-list', 'web', '2022-07-22 16:55:25', '2022-07-22 16:55:25'),
(2, 'role-create', 'web', '2022-07-22 16:55:25', '2022-07-22 16:55:25'),
(3, 'role-edit', 'web', '2022-07-22 16:55:25', '2022-07-22 16:55:25'),
(4, 'role-delete', 'web', '2022-07-22 16:55:25', '2022-07-22 16:55:25'),
(5, 'permission-list', 'web', '2022-06-30 14:23:56', '2022-06-30 14:23:56'),
(6, 'permission-create', 'web', '2022-06-30 14:32:56', '2022-06-30 14:32:56'),
(7, 'permission-edit', 'web', '2022-06-30 14:33:07', '2022-06-30 14:33:07'),
(8, 'permission-delete', 'web', '2022-06-30 14:35:47', '2022-07-05 18:49:12'),
(68, 'user-list', 'web', '2023-12-17 02:35:44', '2023-12-17 02:35:44'),
(69, 'user-view', 'web', '2023-12-17 02:36:00', '2023-12-17 02:36:00'),
(70, 'user-create', 'web', '2023-12-17 02:36:10', '2023-12-17 02:36:10'),
(71, 'user-edit', 'web', '2023-12-17 02:36:21', '2023-12-17 02:36:21'),
(72, 'user-delete', 'web', '2023-12-17 02:36:31', '2023-12-17 02:36:31'),
(113, 'permission-view', 'web', '2023-12-17 13:39:22', '2023-12-17 13:39:22'),
(114, 'role-view', 'web', '2023-12-17 13:39:43', '2023-12-17 13:39:43'),
(120, 'product-category-list', 'web', '2024-06-05 21:58:39', '2024-06-05 21:58:39'),
(121, 'product-list', 'web', '2024-06-06 19:39:14', '2024-06-06 19:39:14'),
(122, 'product-create', 'web', '2024-06-06 20:19:22', '2024-06-06 20:19:22'),
(123, 'product-category-create', 'web', '2024-06-06 20:19:37', '2024-06-06 20:19:37'),
(124, 'product-category-edit', 'web', '2024-06-08 13:50:04', '2024-06-08 13:50:04'),
(125, 'product-category-delete', 'web', '2024-06-08 13:50:14', '2024-06-08 13:50:14'),
(126, 'product-edit', 'web', '2024-06-08 14:50:08', '2024-06-08 14:50:08'),
(127, 'product-delete', 'web', '2024-06-08 14:50:17', '2024-06-08 14:50:17'),
(128, 'product-sub-category-list', 'web', '2024-07-06 11:47:21', '2024-07-06 11:47:21'),
(129, 'product-sub-category-create', 'web', '2024-07-06 11:47:26', '2024-07-06 11:47:26'),
(130, 'product-sub-category-edit', 'web', '2024-07-06 11:47:34', '2024-07-06 11:47:34'),
(131, 'product-sub-category-delete', 'web', '2024-07-06 11:47:39', '2024-07-06 11:47:39');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` INT(11) NOT NULL,
  `product_sub_category_id` INT(11) DEFAULT NULL,
  `product_category_id` INT(11) DEFAULT NULL,
  `product_code` CHAR(40) DEFAULT NULL,
  `product_name` VARCHAR(255) DEFAULT NULL,
  `sell_price` VARCHAR(255) DEFAULT NULL,
  `description` TEXT,
  `product_image` VARCHAR(255) DEFAULT NULL,
  `created_at` DATETIME DEFAULT NULL,
  `created_by` VARCHAR(255) DEFAULT NULL,
  `updated_at` DATETIME DEFAULT NULL,
  `updated_by` VARCHAR(255) DEFAULT NULL
) ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_sub_category_id`, `product_category_id`, `product_code`, `product_name`, `sell_price`, `description`, `product_image`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(11, NULL, 10, '0001', 'Jasmin', NULL, 'Jasmin', NULL, NULL, NULL, NULL, NULL),
(12, NULL, 10, '0001', 'Jasmin 2', NULL, 'Test', NULL, NULL, NULL, NULL, NULL),
(13, NULL, 10, '0001', 'Jasmin 3', NULL, 'test', NULL, NULL, NULL, NULL, NULL),
(14, NULL, 10, '0001', 'Jasmin 4', NULL, 'test', NULL, NULL, NULL, NULL, NULL),
(15, NULL, 10, '0001', 'Jasmin 5', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, NULL, 10, '0001', 'Jasmin 6', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, NULL, 10, '0001', 'Jasmin 7', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, NULL, 10, '0001', 'Jasmin 8', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, NULL, 10, '0001', 'Jasmin 8', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, NULL, 10, '0001', 'Jasmin', NULL, 'Jasmin', NULL, NULL, NULL, NULL, NULL),
(21, 1, 10, '0001', 'Jasmin', '4000', 'Jasmin', NULL, NULL, NULL, '2024-07-06 07:50:16', '2'),
(22, NULL, 10, '0001', 'Jasmin', NULL, 'Jasmin', NULL, NULL, NULL, NULL, NULL),
(23, NULL, 10, '0001', 'Jasmin', NULL, 'Jasmin', NULL, NULL, NULL, NULL, NULL),
(24, NULL, 10, '0001', 'Jasmin', NULL, 'Jasmin', NULL, NULL, NULL, NULL, NULL),
(25, NULL, 10, '0001', 'Jasmin', NULL, 'Jasmin', NULL, NULL, NULL, NULL, NULL),
(26, NULL, 10, '0001', 'Jasmin', NULL, 'Jasmin', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` INT(11) NOT NULL,
  `name` VARCHAR(255) DEFAULT NULL,
  `description` TEXT,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `created_by` VARCHAR(255) DEFAULT NULL,
  `updated_at` DATETIME DEFAULT NULL,
  `updated_by` VARCHAR(255) DEFAULT NULL
) ;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `description`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(10, 'Flower Category 1', NULL, '2024-06-12 02:18:32', NULL, '2024-06-12 02:18:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `id` INT(11) NOT NULL,
  `product_id` INT(11) DEFAULT NULL,
  `image` VARCHAR(255) DEFAULT NULL,
  `url` VARCHAR(255) DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `created_by` VARCHAR(255) DEFAULT NULL,
  `updated_at` DATETIME DEFAULT NULL
) ;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`id`, `product_id`, `image`, `url`, `created_at`, `created_by`, `updated_at`) VALUES
(1, 7, 'screencapture-flower2-test-admin-permissions-2024-06-04-00_54_12.pdf', 'products/', '2024-06-08 11:53:30', NULL, '2024-06-08 11:53:30'),
(4, 2, 'screencapture-flower2-test-admin-permissions-2024-06-04-00_54_12.pdf', 'products/', '2024-06-08 12:15:15', NULL, '2024-06-08 12:15:15'),
(5, 2, 'screencapture-flower2-test-admin-permissions-2024-06-04-00_54_12.pdf', 'products/', '2024-06-08 12:15:35', NULL, '2024-06-08 12:15:35'),
(6, 2, 'screencapture-flower2-test-admin-roles-1-edit-2024-06-04-00_55_28.png', 'products/', '2024-06-08 12:18:42', NULL, '2024-06-08 12:18:42'),
(7, 8, 'screencapture-flower2-test-2024-06-05-01_22_12.pdf', 'products/', '2024-06-11 16:35:55', NULL, '2024-06-11 16:35:55'),
(8, 8, 'screencapture-flower2-test-2024-06-05-01_22_12.pdf', 'products/', '2024-06-11 16:35:55', NULL, '2024-06-11 16:35:55'),
(9, 9, 'screencapture-flower2-test-2024-06-05-01_22_12.pdf', 'products/', '2024-06-12 02:05:46', NULL, '2024-06-12 02:05:46'),
(10, 10, 'screencapture-flower2-test-admin-roles-1-edit-2024-06-04-00_55_28.png', 'products/', '2024-06-12 02:13:44', NULL, '2024-06-12 02:13:44'),
(11, 11, 'screencapture-flower2-test-admin-roles-1-edit-2024-06-04-00_55_28.png', 'products/', '2024-06-12 02:19:41', NULL, '2024-06-12 02:19:41'),
(12, 11, 'screencapture-flower2-test-admin-roles-1-edit-2024-06-04-00_55_28.png', 'products/', '2024-06-12 02:19:41', NULL, '2024-06-12 02:19:41'),
(13, 11, 'screencapture-flower2-test-admin-roles-1-edit-2024-06-04-00_55_28.png', 'products/', '2024-06-12 02:19:41', NULL, '2024-06-12 02:19:41'),
(14, 21, '', 'products/', '2024-07-06 07:50:16', NULL, '2024-07-06 07:50:16'),
(15, 21, '', 'products/', '2024-07-06 07:50:16', NULL, '2024-07-06 07:50:16'),
(16, 21, '', 'products/', '2024-07-06 07:50:16', NULL, '2024-07-06 07:50:16'),
(17, 21, '', 'products/', '2024-07-06 07:50:16', NULL, '2024-07-06 07:50:16'),
(18, 21, '', 'products/', '2024-07-06 07:50:16', NULL, '2024-07-06 07:50:16'),
(19, 21, '', 'products/', '2024-07-06 07:50:16', NULL, '2024-07-06 07:50:16'),
(20, 21, '', 'products/', '2024-07-06 07:50:16', NULL, '2024-07-06 07:50:16');

-- --------------------------------------------------------

--
-- Table structure for table `product_sub_categories`
--

CREATE TABLE `product_sub_categories` (
  `id` INT(11) NOT NULL,
  `category_id` INT(11) DEFAULT NULL,
  `name` VARCHAR(255) DEFAULT NULL,
  `description` VARCHAR(255) DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `created_by` VARCHAR(255) DEFAULT NULL,
  `updated_at` DATETIME DEFAULT NULL,
  `updated_by` VARCHAR(255) DEFAULT NULL
) ;

--
-- Dumping data for table `product_sub_categories`
--

INSERT INTO `product_sub_categories` (`id`, `category_id`, `name`, `description`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 10, 'Rose', NULL, '2024-06-27 23:02:17', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` BIGINT(20) UNSIGNED NOT NULL,
  `name` VARCHAR(191) NOT NULL,
  `guard_name` VARCHAR(191) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL
) ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', '2022-07-22 16:55:22', '2024-06-03 21:35:36'),
(16, 'General User', 'web', '2024-01-09 20:16:10', '2024-01-09 20:16:10');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` BIGINT(20) UNSIGNED NOT NULL,
  `role_id` BIGINT(20) UNSIGNED NOT NULL
) ;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(113, 1),
(113, 16),
(114, 1),
(114, 16),
(120, 1),
(121, 1),
(122, 1),
(123, 1),
(124, 1),
(125, 1),
(126, 1),
(127, 1),
(128, 1),
(129, 1),
(130, 1),
(131, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` VARCHAR(191)  NOT NULL,
  `user_id` BIGINT(20) UNSIGNED DEFAULT NULL,
  `ip_address` VARCHAR(45)  DEFAULT NULL,
  `user_agent` TEXT ,
  `payload` TEXT  NOT NULL,
  `last_activity` INT(11) NOT NULL
) ;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('ds3VuobLmBZxMyRIX3bTffns3iMOPiOHRO36f7Sm', NULL, '185.196.0.26', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/88.0.4240.193 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS1JMT1JOSFRJb0wxbEZ6Qkd4eTFOYnRQT0VKdVFjb1FIYkxkOGZaZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly9hbHlhc21pbmZsb3dlcnMuY29tIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1720277900),
('FNzipV05bUj8eAEZjFVOEbfELyFS4K4rVzfmGOAi', NULL, '43.135.149.154', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU2hzaDNCbmdaY0N1cWN5SVJwZWVBRE5QOGVjd09YQWpFNlNqdjdGNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly93d3cuYWx5YXNtaW5mbG93ZXJzLmNvbSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1720279746),
('eAOiefNG5qAKVcqXQBsyaDXR10pew5usmABKpgeZ', NULL, '103.70.86.110', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibDFDOEUwOE55clFhSkJuOGVlMDgwY1hJR0lMODhFNlp5b1ExRnVPVCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHBzOi8vYWx5YXNtaW5mbG93ZXJzLmNvbS9mbG93ZXIiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjQ6ImNhcnQiO2E6Mjp7aToxNzthOjU6e3M6MjoiaWQiO2k6MTc7czo0OiJuYW1lIjtzOjg6Ikphc21pbiA3IjtzOjg6InF1YW50aXR5IjtpOjE7czo1OiJwcmljZSI7aTozMDA7czo1OiJpbWFnZSI7Tjt9aToxODthOjU6e3M6MjoiaWQiO2k6MTg7czo0OiJuYW1lIjtzOjg6Ikphc21pbiA4IjtzOjg6InF1YW50aXR5IjtpOjE7czo1OiJwcmljZSI7aTozMDA7czo1OiJpbWFnZSI7Tjt9fX0=', 1720282590);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` BIGINT(20) UNSIGNED NOT NULL,
  `soceity_id` INT(11) DEFAULT NULL,
  `project_id` INT(11) DEFAULT NULL,
  `block_id` INT(11) DEFAULT NULL,
  `name` VARCHAR(191)  NOT NULL,
  `email` VARCHAR(191)  DEFAULT NULL,
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
  `mobile_number` VARCHAR(45)  DEFAULT NULL,
  `mobile_verified_at` TIMESTAMP NULL DEFAULT NULL,
  `password` VARCHAR(191)  DEFAULT NULL,
  `remember_token` VARCHAR(100)  DEFAULT NULL,
  `last_login` DATETIME DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  `is_terminal_user` TINYINT(4) DEFAULT NULL
);

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `soceity_id`, `project_id`, `block_id`, `name`, `email`, `email_verified_at`, `mobile_number`, `mobile_verified_at`, `password`, `remember_token`, `last_login`, `created_at`, `updated_at`, `deleted_at`, `is_terminal_user`) VALUES
(2, 1, NULL, NULL, 'Muhammad Azeem', 'admin@gmail.com', NULL, NULL, NULL, '$2y$10$DHUTWiidEW.zN.0LzCOWU.iOBr./hzwGaVxk1P5cPZlSpxrW19vVm', 'ZqXPGXSRANG9hoTXQpLW3Gyhpzi0Bmclwxs2XHZv4bTgBz9McYn3GyIGddoW', NULL, NULL, NULL, NULL, NULL),
(38, 2, NULL, NULL, 'Society Admin 2', 'admin2@gmail.com', NULL, NULL, NULL, '$2y$10$/fNzNMl7AJhZBeuxsOjnjOLP.7k5.Jb6iUMuAVGhRCkXvmIHo7Wr2', NULL, NULL, '2024-01-18 15:55:11', '2024-01-18 15:55:11', NULL, NULL),
(39, 1, 3, NULL, 'Muhammad Azeem', 'azeem@gmail.com', NULL, NULL, NULL, '$2y$10$KokDyf6rLWMWGv1t3FEvGuTGjxOvQ0DNk6ZwqU26hfhe0VpUPms9q', NULL, NULL, '2024-01-18 15:59:57', '2024-01-18 15:59:57', NULL, NULL),
(40, 1, 3, 7, '2serty', 'admin4454@gmail.com', NULL, NULL, NULL, '$2y$10$0GqgW5ORbVrIFbV5bFfUy./yaPeBLvOVir3lPADrtMXG5LpqywDLq', NULL, NULL, '2024-02-06 19:07:52', '2024-02-06 19:08:02', '2024-02-06 19:08:02', NULL);





CREATE TABLE `colors` (  
  `id` INT NOT NULL,
  `color_name` VARCHAR(255),
  `color_code` VARCHAR(255),
  `description` VARCHAR(255),
  `created_at` DATETIME NOT NULL,
  `created_by` VARCHAR(255),
  `updated_at` DATETIME,
  `updated_by` VARCHAR(255),
  PRIMARY KEY (`id`)
);


--
-- Indexes for dumped tables
--

--
-- Indexes for table `as_society`
--
ALTER TABLE `as_society`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `destination_themes`
--
ALTER TABLE `destination_themes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`OrderDetailId`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sub_categories`
--
ALTER TABLE `product_sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `as_society`
--
ALTER TABLE `as_society`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `destination_themes`
--
ALTER TABLE `destination_themes`
  MODIFY `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `OrderDetailId` INT(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `product_sub_categories`
--
ALTER TABLE `product_sub_categories`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

ALTER TABLE `products`   
  ADD COLUMN `color_id` VARCHAR(255) NULL AFTER `sell_price`;
