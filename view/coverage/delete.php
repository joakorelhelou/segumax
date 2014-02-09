<?php
session_start();

$routeLevel = 1;


include_once "../../controller/coverageController.php";
include_once "../../controller/frontController.php";
$title = "Clientes - SeguMax";

if($_SESSION['userData']['role'] != 'company' && $_SESSION['userData']['role'] != 'admin'){
	header("location:../login.php?redirect=1");
}

$role = getRoleCode();
$page = getPage($role);

if($_GET){
	if(isset($_GET['id'])){
		if(deleteCoverage($_GET['id']))
			header("location:list.php?message=2");
	}
}

include_once "../header.php";


?>