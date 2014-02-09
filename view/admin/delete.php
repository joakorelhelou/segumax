<?php
session_start();

$routeLevel = 1;

include_once "../../controller/adminController.php";
include_once "../../model/admin.php";
include_once "../../controller/frontController.php";
$title = "Administradores - SeguMax";

if($_SESSION['userData']['role'] != 'admin'){
	header("location:../login.php?redirect=1");
}

$role = getRoleCode();
$page = getPage($role);

if($_GET){
	if(isset($_GET['id'])){
		if(deleteAdmin($_GET['id']))
			header("location:list.php?message=2");
		else header("location:../login.php?redirect=1");
	}
		
}

include_once "../header.php";


?>