<?php

include_once "../../model/database.php";

function getAllCompanies(){
	$con = dbaConnect();	
	return mysql_query("SELECT * FROM company ORDER BY id DESC");
	dbaClose($con);
}

function selectCompanyBySearch($key){
	$con = dbaConnect();
	return mysql_query("SELECT * FROM company WHERE (name LIKE '%$key%') OR (surname LIKE '%$key%') OR (business_name LIKE '%$key%') OR (email LIKE '%$key%') ORDER BY id DESC");
	dbaClose($con);
}

function searchCompanyMailExists($email){
	$con = dbaConnect();
	$result =  mysql_query("SELECT * FROM company WHERE email = '$email'") or die(mysql_error());
	return mysql_num_rows($result);
	
}

function insertCompany($company){
	$con = dbaConnect();
	$propName = $company['propName'];
	$propSurname = $company['propSurname'];
	$businessName = $company['businessName'];
	$rc = $company['rc'];
	$coverageTax = $company['coverageTax'];
	$discount = $company['discount'];
	$producerCommission = $company['producerCommission'];
	$email = $company['email'];
	$password = $company['password'];
	$address = $company['address'];
		
	$result =  mysql_query("INSERT INTO company (business_name, address, rc, coverage_tax, producer_commission, discount, email, name, surname, password) VALUES ('$businessName', '$address', '$rc', '$coverageTax',
	 '$producerCommission', '$discount', '$email', '$propName', '$propSurname', '$password')") or die(mysql_error());
	$message = "El usuario ".$_SESSION['userData']['surname']." ".$_SESSION['userData']['name']." ha registrado la compañía ".$businessName;
	recordActivity($_SESSION['userData']['id'],$_SESSION['userData']['role'],$message);		
	
	
	dbaClose($con);
	
}

function selectCompany($id){
	$con = dbaConnect();
	$result =  mysql_query("SELECT * FROM company WHERE id = '$id'") or die(mysql_error());
	return $result;
	dbaClose($con);
}

function dropCompany($id){
	$con = dbaConnect();	
	$message = "El usuario ".$_SESSION['userData']['surname']." ".$_SESSION['userData']['name']." ha eliminado la compañía ".$id;
	recordActivity($_SESSION['userData']['id'],$_SESSION['userData']['role'],$message);		
	
	return mysql_query("DELETE FROM company where id = '$id'");
	dbaClose($con);
	
}

function alterCompany($company){	
	$con = dbaConnect();
	$id = $company['id'];
	$propName = $company['propName'];
	$propSurname = $company['propSurname'];
	$businessName = $company['businessName'];
	$rc = $company['rc'];
	$coverageTax = $company['coverageTax'];
	$discount = $company['discount'];
	$producerCommission = $company['producerCommission'];
	$password = $company['password'];
	$address = $company['address'];
	
	$message = "El usuario ".$_SESSION['userData']['surname']." ".$_SESSION['userData']['name']." ha modificado la compañía ".$businessName;
	recordActivity($_SESSION['userData']['id'],$_SESSION['userData']['role'],$message);		
	
	
	if($password == "nochange")
	return mysql_query("UPDATE company SET name = '$propName', surname = '$propSurname', business_name = '$businessName', rc = '$rc', address = '$address', coverage_tax = '$coverageTax', discount = '$discount', 
	producer_commission = '$producerCommission' WHERE id = '$id'");
	else return mysql_query("UPDATE company SET name = '$propName', surname = '$propSurname', business_name = '$businessName', rc = '$rc', address = '$address', coverage_tax = '$coverageTax', discount = '$discount', 
	producer_commission = '$producerCommission', password = '$password' WHERE id = '$id'");
	dbaClose($con);
	
}

?>