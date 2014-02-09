<?php 

include_once "../../controller/companyController.php";


if($_GET){
	$id = $_GET['id'];
	$company = getCompany($id);
	echo $company['producerCommission'];
}
?>