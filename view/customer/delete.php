<?php
session_start();

$routeLevel = 1;

include_once "../../controller/customerController.php";
include_once "../../controller/frontController.php";
$title = "Clientes - SeguMax";

if($_SESSION['userData']['role'] != 'producer'){
	header("location:../login.php?redirect=1");
}

$role = getRoleCode();

if($_GET){
	if(isset($_GET['id'])){
		if(deleteCustomer($_GET['id']))
			header("location:list.php?message=2");
	}
}

include_once "../header.php";


?>