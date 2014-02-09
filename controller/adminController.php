<?php

include_once "../../model/admin.php";





function getPage($role){
	if($role == 1)
		return 7;
	
}

function getAdmins(){
	$result = getAllAdmins();
	$i=0;
	while($ds=mysql_fetch_array($result)){
		$companies[$i]=array(
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
	return $companies;
	
	return $companies;
}

function getAdminsBySeach($search){
	$result = selectAdminsBySearch($search);
		$i=0;
	while($ds=mysql_fetch_array($result)){
		$companies[$i]=array(
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
	return $companies;
	
	return $companies;	
}

function registeredMail($email){
	return searchMailExists($email);
	
}

function verifyData($company){
	if(!registeredMail($company["email"]) && ($company["password"] == $company["confirmedPassword"]))
		return 1;
	else return 0;
}

function addAdmin(){
	$company = array(
		"name" => $_POST['name'],
		"surname" => $_POST['surname'],
		"dni" => $_POST['dni'],
		"email" => $_POST['email'],
		"phone" => $_POST['phone'],
		"address" => $_POST['adress'],
		"password" => md5($_POST['userPassword']),
		"confirmedPassword" => md5($_POST['userRetypedPassword']),
		);
	if(verifyData($company))
		insertAdmin($company);
	else return 0;
	return 1;
}

function getAdmin($id){
	$result = selectAdmin($id);
	while($ds=mysql_fetch_array($result))
		$company=array(
					"id"=>$ds["id"],
					"name"=>$ds["name"],
					"surname"=>$ds["surname"],
					"dni"=>$ds["dni"],
					"email"=>$ds["email"],
					"phone"=>$ds["phone"],
					"password"=>$ds["password"],
					"address" =>$ds["address"],
		);
	return $company;
}

function deleteAdmin($id){
		return dropAdmin($id);
}

function updateAdmin(){
		if($_POST['userPassword']!=""){
			$company = array(
				"id" => $_POST['id'],
				"name" => $_POST['name'],
				"surname" => $_POST['surname'],
				"dni" => $_POST['dni'],
				"phone" => $_POST['phone'],
				"address" => $_POST['address'],
				"password" => md5($_POST['userPassword']),
				"confirmedPassword" => md5($_POST['userRetypedPassword']),
				);
		}else{
			$company = array(
				"id" => $_POST['id'],
				"name" => $_POST['name'],
				"surname" => $_POST['surname'],
				"dni" => $_POST['dni'],
				"phone" => $_POST['phone'],
				"address" => $_POST['address'],
				"password" => "nochange",
				"confirmedPassword" => "nochange",	
				);
		}
		if($company["password"] == $company["confirmedPassword"]){
			return alterAdmin($company);

		}
		else return 0;
		
}

?>