<?php

include_once "../../model/database.php";

function getAllCustomers($id = 'none'){
	$con = dbaConnect();
	if($id == 'none')	
	return mysql_query("SELECT * FROM customer");
	else return mysql_query("SELECT * FROM customer WHERE producer_id = '$id'");
	dbaClose($con);
}

function selectCustomerBySearch($key){
	$con = dbaConnect();
	return mysql_query("SELECT * FROM customer WHERE (name LIKE '%$key%') OR (surname LIKE '%$key%') OR (dni LIKE '%$key%') OR (email LIKE '%$key%') OR (cuit LIKE '%$key%')");
	dbaClose($con);
}

function insertCustomer($customer){
	$con = dbaConnect();
	$name = $customer['name'];
	$surname = $customer['surname'];
	$dni = $customer['dni'];
	$birthday = $customer['birthday'];
	$phone = $customer['phone'];
	$cuit = $customer['cuit'];
	$taxCondition = $customer['taxCondition'];
	$email = $customer['email'];
	$address = $customer['address'];
	$producerId = $customer['producerId'];

	$message = "El usuario ".$_SESSION['userData']['surname']." ".$_SESSION['userData']['name']." ha registrado el cliente ".$surname." ".$name;
	recordActivity($_SESSION['userData']['id'],$_SESSION['userData']['role'],$message);		

		
	$result =  mysql_query("INSERT INTO customer (producer_id, name, surname, dni, birth_date, address, email, phone, cuit, tax_condition) VALUES ('$producerId', '$name', '$surname', '$dni',
	 '$birthday', '$address', '$email', '$phone', '$cuit', '$taxCondition')") or die(mysql_error());
	dbaClose($con);
	
}

function selectCustomer($id){
	$con = dbaConnect();
	$result =  mysql_query("SELECT * FROM customer WHERE id = '$id'") or die(mysql_error());
	return $result;
	dbaClose($con);
}

function dropCustomer($id){
	$con = dbaConnect();	

	$message = "El usuario ".$_SESSION['userData']['surname']." ".$_SESSION['userData']['name']." ha elimiando el cliente ".$id;
	recordActivity($_SESSION['userData']['id'],$_SESSION['userData']['role'],$message);		


	return mysql_query("DELETE FROM customer where id = '$id'");
	dbaClose($con);
	
}

function alterCustomer($customer){	
	$con = dbaConnect();
	$id = $customer['id'];
	$name = $customer['name'];
	$surname = $customer['surname'];
	$dni = $customer['dni'];
	$birthday = $customer['birthday'];
	$phone = $customer['phone'];
	$cuit = $customer['cuit'];
	$taxCondition = $customer['taxCondition'];
	$email = $customer['email'];
	$address = $customer['address'];
	$producerId = $customer['producerId'];

	$message = "El usuario ".$_SESSION['userData']['surname']." ".$_SESSION['userData']['name']." ha modificado el cliente ".$surname." ".$name;
	recordActivity($_SESSION['userData']['id'],$_SESSION['userData']['role'],$message);		

	
	return mysql_query("UPDATE customer SET name = '$name', surname = '$surname', dni = '$dni', birth_date = '$birthday', address = '$address', phone = '$phone', cuit = '$cuit', 
	tax_condition = '$taxCondition', email = '$email' WHERE id = '$id'") or die(mysql_error()); ;
	dbaClose($con);
	
}

?>
