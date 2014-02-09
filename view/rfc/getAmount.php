<?php 

include_once "../../controller/coverageController.php";
include_once "../../controller/customerController.php";
include_once "../../controller/companyController.php";

define('TAX1', '27.2');
define('TAX2', '27.2');
define('TAX3', '27.2');


if($_GET){
	$companyId = $_GET['companyId'];
	$coverageId = $_GET['coverageId'];
	$customerId = $_GET['customerId'];
	$coverage = getCoverage($coverageId);
	$customer = getCustomer($customerId);
	$company = getCompany($companyId);
	$insuredAmount = $_GET['amount'];
	$discount = $_GET['commissionDisc'];
	
	if($customer['taxCondition'] == 1){
		$tax = TAX1;
	}elseif ($customer['taxCondition'] == 2){
		$tax = TAX2;
	}else $tax = TAX3;
	
	$ammount = ($insuredAmount * $coverage['rate']/100+$company['rc']) * ((100-$discount)/100) * ((100+$tax)/100);
	echo $ammount;
	
	

}



?>
 