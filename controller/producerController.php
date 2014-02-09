<?php

include_once "../../model/producer.php";



function getProducers(){
	$result = getAllProducers();
	$i=0;
	while($ds=mysql_fetch_array($result)){
		$producers[$i]=array(
					"id"=>$ds["id"],
					"name"=>$ds["name"],
					"surname"=>$ds["surname"],
					"dni"=>$ds["dni"],
					"email"=>$ds["email"],
					"phone"=>$ds["phone"],
					"password"=>$ds["password"],
					"address" =>$ds["address"],
		);
		$i = $i +1;
	}
	if(!$i){
		return 0;
	}else	
	return $producers;
	
	return $producers;
}

function getProducer($id){
	$result = selectProducer($id);
	while($ds=mysql_fetch_array($result))
			$producer=array(
					"id"=>$ds["id"],
					"name"=>$ds["name"],
					"surname"=>$ds["surname"],
					"dni"=>$ds["dni"],
					"email"=>$ds["email"],
					"phone"=>$ds["phone"],
					"password"=>$ds["password"],
					"address" =>$ds["address"],
		);
	return $producer;
}

function getProducersBySeach($search){
	$result = selectProducerBySearch($search);
		$i=0;
	while($ds=mysql_fetch_array($result)){
		$producers[$i]=array(
					"id"=>$ds["id"],
					"name"=>$ds["name"],
					"surname"=>$ds["surname"],
					"dni"=>$ds["dni"],
					"email"=>$ds["email"],
					"phone"=>$ds["phone"],
					"password"=>$ds["password"],
					"address" =>$ds["address"],
		);
		$i = $i +1;
	}
	if(!$i){
		return 0;
	}else	
	return $producers;
	
}

function registeredMail($email){
	return searchMailExists($email);
	
}

function verifyData($producer){
	if(!registeredMail($producer["email"]) && ($producer["password"] == $producer["confirmedPassword"]))
		return 1;
	else return 0;
}

function addProducer(){
	$producer = array(
		"userName" => $_POST['userName'],
		"lastName" => $_POST['userLastName'],
		"dni" => $_POST['userDni'],
		"phone" => $_POST['userPhone'],
		"address" => $_POST['userAdress'],
		"email" => $_POST['userEmail'],
		"password" => md5($_POST['userPassword']),
		"confirmedPassword" => md5($_POST['userRetypedPassword']),
		);
	if(verifyData($producer))
		insertProducer($producer);
	else return 0;
	return 1;
}

function deleteProducer($id){
	return dropProducer($id);
}

function updateProducer(){
		if(isset($_POST['userPassword'])){
		$producer = array(
		"id" => $_POST['id'],
		"userName" => $_POST['userName'],
		"lastName" => $_POST['userLastName'],
		"dni" => $_POST['userDni'],
		"phone" => $_POST['userPhone'],
		"address" => $_POST['userAdress'],
		"password" => md5($_POST['userPassword']),
		"confirmedPassword" => md5($_POST['userRetypedPassword']),
		);
		}else{
			$producer = array(
			"id" => $_POST['id'],		
			"userName" => $_POST['userName'],
			"lastName" => $_POST['userLastName'],
			"dni" => $_POST['userDni'],
			"phone" => $_POST['userPhone'],
			"address" => $_POST['userAdress'],
			"password" => "nochange",
			"confirmedPassword" => "nochange",
			);		
		}
		if($producer["password"] == $producer["confirmedPassword"])
			alterProducer($producer);
		else return 0;
		return 1;
}

function getProducerPage($role){
	if($role == 1)
		return 2;
	if($role == 2)
		return 19;
	
}

function verifyLogin(){
	if($_SESSION['userData']['role'] != 'producer'){
		header("location:../login.php?redirect=1");
	}
}
?>