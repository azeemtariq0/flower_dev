<?php include __DIR__ .'/Crypto.php'; ?>
<?php 

	error_reporting(0);
	
	$merchant_data='';
	$working_key='292B51275D03A265221D93B952E2B48B';//Shared by CCAVENUES
	$access_code='AVPE04KF66BD84EPDB';//Shared by CCAVENUES
	
	foreach ($shipping as $key => $value){
		$merchant_data.=$key.'='.$value.'&';
	}

	$encrypted_data=encrypt1($merchant_data,$working_key); // Method for encrypting the data.

?>
<form method="post" name="redirect" action="https://secure.ccavenue.ae/transaction/transaction.do?command=initiateTransaction"> 
<?php
echo "<input type=hidden name=encRequest value=$encrypted_data>";
echo "<input type=hidden name=access_code value=$access_code>";
?>
</form>
</center>
<script language='javascript'>document.redirect.submit();</script>