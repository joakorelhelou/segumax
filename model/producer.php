<?php

include_once "../../model/database.php";
include_once "../../controller/frontController.php";


function getAllProducers(){
	$con = dbaConnect();	
	return mysql_query("SELECT * FROM producer ORDER BY id DESC");
	dbaClose($con);
}

function selectProducer($id){
	$con = dbaConnect();
	$result =  mysql_query("SELECT * FROM producer WHERE id = '$id'") or die(mysql_error());
	return $result;
	dbaClose($con);
}

function selectProducerBySearch($key){
	$con = dbaConnect();
	return mysql_query("SELECT * FROM producer WHERE (name LIKE '%$key%') OR (surname LIKE '%$key%') OR (dni LIKE '%$key%') OR (email LIKE '%$key%') OR (phone LIKE '%$key%')");
	dbaClose($con);
}

function searchMailExists($email){
	$con = dbaConnect();
	$result =  mysql_query("SELECT * FROM producer WHERE email = '$email'") or die(mysql_error());
	return mysql_num_rows($result);
	
}

function insertProducer($producer){
	$con = dbaConnect();
	$userName = $producer['userName'];
	$userLastName = $producer['lastName'];
	$userDni = $producer['dni'];
	$userPhone = $producer['phone'];
	$userEmail = $producer['email'];
	$userPassword = $producer['password'];
	$message = "El usuario ".$_SESSION['userData']['surname']." ".$_SESSION['userData']['name']." ha registrado al productor ".$producer['lastName']." ".$producer['userName'];
	recordActivity($_SESSION['userData']['id'],$_SESSION['userData']['role'],$message);		
	
	$result =  mysql_query("INSERT INTO producer (name, surname, dni, email, phone, password) VALUES ('$userName', '$userLastName', '$userDni', '$userEmail',
	 '$userPhone', '$userPassword')") or die(mysql_error());
	dbaClose($con);
	
}

function dropProducer($id){
	$con = dbaConnect();	
		 $message = "El usuario ".$_SESSION['userData']['surname']." ".$_SESSION['userData']['name']." ha eliminado al productor ".$id;
	recordActivity($_SESSION['userData']['id'],$_SESSION['userData']['role'],$message);		
	
	return mysql_query("DELETE FROM producer where id = '$id'");
	dbaClose($con);
	
}

function alterProducer($producer){	
	$con = dbaConnect();
	$id = $producer['id'];
	$userName = $producer['userName'];
	$userLastName = $producer['lastName'];
	$userDni = $producer['dni'];
	$userPhone = $producer['phone'];
	$userPassword = $producer['password'];
	$userAddress = $producer['address'];
	
	$con = dbaConnect();	
		 $message = "El usuario ".$_SESSION['userData']['surname']." ".$_SESSION['userData']['name']." ha modificado los datos del productor ".$producer['lastName']." ".$producer['userName'];
	recordActivity($_SESSION['userData']['id'],$_SESSION['userData']['role'],$message);		
	
	if($userPassword == "nochange")
	return mysql_query("UPDATE producer SET name = '$userName', surname = '$userLastName', dni = '$userDni', phone = '$userPhone', address = '$userAddress' WHERE id = '$id'");
	else return mysql_query("UPDATE producer SET name = '$userName', surname = '$userLastName', dni = '$userDni', phone = '$userPhone', address = '$userAddress', password = '$userPassword' WHERE id = '$id'");
	dbaClose($con);
	
}

?>