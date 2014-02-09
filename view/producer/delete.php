<?php
session_start();

$routeLevel = 1;

include_once "../../controller/producerController.php";
include_once "../../controller/frontController.php";
$title = "Productores - SeguMax";

if($_SESSION['userData']['role'] != 'admin'){
	header("location:../login.php?redirect=1");
}

$role = getRoleCode();

if($_GET){
	if(isset($_GET['id'])){
		if(deleteProducer($_GET['id']))
			header("location:list.php?message=2");
	}
}

include_once "../header.php";


?>