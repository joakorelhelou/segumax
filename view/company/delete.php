<?php
session_start();

$routeLevel = 1;


include_once "../../controller/companyController.php";
include_once "../../controller/frontController.php";
$title = "Companías - SeguMax";

	if($_SESSION['userData']['role'] != 'admin'){
		header("location:../login.php?redirect=1");
	} 
$role = getRoleCode();
$page = getCompanyPage($role);

if($_GET){
	if(isset($_GET['id'])){
		if(deleteCompany($_GET['id']))
			header("location:list.php?message=2");
	}
}

include_once "../header.php";


?>