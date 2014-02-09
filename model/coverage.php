<?php

include_once "../../model/database.php";

function getAllCoverages($id = 'none'){
	$con = dbaConnect();
	if($id == 'none')	
	return mysql_query("SELECT * FROM coverage ORDER BY id DESC");
	else return mysql_query("SELECT * FROM coverage WHERE company_id = '$id' ORDER BY id DESC");
	dbaClose($con);
}

function selectCoverageBySearch($key, $id = 'none'){
	$con = dbaConnect();
	if($id == 'none')
	return mysql_query("SELECT * FROM coverage WHERE (description LIKE '%$key%') OR (rate LIKE '%$key%') ORDER BY id DESC");
	else return mysql_query("SELECT * FROM coverage WHERE ((description LIKE '%$key%') OR (rate LIKE '%$key%')) AND company_id = '$id' ORDER BY id DESC");
	dbaClose($con);
}

function insertCoverage($coverage){
	$con = dbaConnect();
	$companyId = $coverage['companyId'];
	$description = $coverage['description'];
	$rate = $coverage['rate'];
	
	$message = "El usuario ".$_SESSION['userData']['surname']." ".$_SESSION['userData']['name']." ha registrado la cobertura ".$description;
	recordActivity($_SESSION['userData']['id'],$_SESSION['userData']['role'],$message);		
	
	
	$result =  mysql_query("INSERT INTO coverage (company_id, description, rate) VALUES ('$companyId', '$description', '$rate')") or die(mysql_error());
	dbaClose($con);
	
}

function selectCoverage($id){
	$con = dbaConnect();
	$result =  mysql_query("SELECT * FROM coverage WHERE id = '$id'") or die(mysql_error());
	return $result;
	dbaClose($con);
}

function dropCoverage($id){
	$con = dbaConnect();	
	$message = "El usuario ".$_SESSION['userData']['surname']." ".$_SESSION['userData']['name']." ha eliminado la cobertura ".$id;
	recordActivity($_SESSION['userData']['id'],$_SESSION['userData']['role'],$message);		
	
	return mysql_query("DELETE FROM coverage where id = '$id'");
	dbaClose($con);
	
}

function alterCoverage($coverage){	
	$con = dbaConnect();
	$id = $coverage['id'];
	$description = $coverage['description'];
	$rate = $coverage['rate'];
	
	$message = "El usuario ".$_SESSION['userData']['surname']." ".$_SESSION['userData']['name']." ha modificado la cobertura ".$description;
	recordActivity($_SESSION['userData']['id'],$_SESSION['userData']['role'],$message);		
	
	return mysql_query("UPDATE coverage SET description = '$description', rate = '$rate' WHERE id = '$id'") or die(mysql_error()); ;
	dbaClose($con);
	
}

?>
