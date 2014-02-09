<?php

include_once "../../model/database.php";
include_once "../../controller/frontController.php";


function getAllAdmins(){
	$con = dbaConnect();	
	return mysql_query("SELECT * FROM admin ORDER BY id DESC");
	dbaClose($con);
}

function selectAdminsBySearch($key){
	$con = dbaConnect();
	return mysql_query("SELECT * FROM admin WHERE (name LIKE '%$key%') OR (surname LIKE '%$key%') OR (dni LIKE '%$key%') OR (email LIKE '%$key%') ORDER BY id DESC");
	dbaClose($con);
}

function searchMailExists($email){
	$con = dbaConnect();
	$result =  mysql_query("SELECT * FROM admin WHERE email = '$email'") or die(mysql_error());
	return mysql_num_rows($result);
	
}

function insertAdmin($admin){
	$con = dbaConnect();
	$name = $admin['name'];
	$surname = $admin['surname'];
	$dni = $admin['dni'];
	$address = $admin['address'];
	$phone = $admin['phone'];
	$email = $admin['email'];
	$password = $admin['password'];
		
	$result =  mysql_query("INSERT INTO admin (name, surname, dni, address, email, phone, password) VALUES ('$name', '$surname', '$dni', '$address',
	 '$email', '$phone', '$password')") or die(mysql_error());
	 $message = "El usuario ".$_SESSION['userData']['surname']." ".$_SESSION['userData']['name']." ha registrado al administrador ".$admin['surname']." ".$admin['name'];
	recordActivity($_SESSION['userData']['id'],$_SESSION['userData']['role'],$message);		
	 
	dbaClose($con);
	
}

function selectAdmin($id){
	$con = dbaConnect();
	$result =  mysql_query("SELECT * FROM admin WHERE id = '$id'") or die(mysql_error());
	return $result;
	dbaClose($con);
}

function dropAdmin($id){
	$con = dbaConnect();
	 $message = "El usuario ".$_SESSION['userData']['surname']." ".$_SESSION['userData']['name']." ha eliminado al administrador ".$id;
	recordActivity($_SESSION['userData']['id'],$_SESSION['userData']['role'],$message);		
	
	return mysql_query("DELETE FROM admin where id = '$id'") or die(mysql_error());
	dbaClose($con);
	
}

function alterAdmin($admin){	
	$id = $admin['id'];
	$name = $admin['name'];
	$surname = $admin['surname'];
	$dni = $admin['dni'];
	$address = $admin['address'];
	$password = $admin['password'];
	
	$message = "El usuario ".$_SESSION['userData']['surname']." ".$_SESSION['userData']['name']." ha modificado los datos del administrador ".$admin['surname']." ".$admin['name'];
	recordActivity($_SESSION['userData']['id'],$_SESSION['userData']['role'],$message);		
	$con = dbaConnect();
		
	if($password == "nochange")
	return mysql_query("UPDATE admin SET name = '$name', surname = '$surname', dni = '$dni', address = '$address' WHERE id = '$id'") or die(mysql_error());
	else return mysql_query("UPDATE admin SET name = '$name', surname = '$surname', dni = '$dni', address = '$address', password = '$password' WHERE id = '$id'") or die(mysql_error());
	dbaClose($con);
	
}
?>