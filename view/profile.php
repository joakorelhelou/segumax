<?php
session_start();

$routeLevel = 1;

include_once "../controller/adminController.php";
include_once "../model/admin.php";
include_once "../controller/frontController.php";
$title = "Perfil - SeguMax";

verifyLogin();

$role = getRoleCode();
$page = 1;


include_once "../header.php";


?>