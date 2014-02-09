<?php

include_once "../../model/company.php";


function getCompanyPage($role){
	if($role == 1)
		return 3;
	elseif ($role == 2)
		return 2;
	else return 10;
	
}

function getCompanies(){
	$result = getAllCompanies();
	$i=0;
	while($ds=mysql_fetch_array($result)){
		$companies[$i]=array(
					"id"=>$ds["id"],
					"businessName"=>$ds["business_name"],
					"address"=>$ds["address"],
					"rc"=>$ds["rc"],
					"coverageTax"=>$ds["coverage_tax"],
					"producerCommission"=>$ds["producer_commission"],
					"discount"=>$ds["discount"],
					"email" =>$ds["email"],
					"propName" =>$ds["name"],
					"propSurname" =>$ds["surname"],
					"password" =>$ds["password"],
		);
		$i = $i +1;
	}
	if(!$i){
		return 0;
	}else	
	return $companies;
	
	return $companies;
}

function getCompaniesBySeach($search){
	$result = selectCompanyBySearch($search);
		$i=0;
	while($ds=mysql_fetch_array($result)){
		$companies[$i]=array(
					"id"=>$ds["id"],
					"businessName"=>$ds["business_name"],
					"address"=>$ds["address"],
					"rc"=>$ds["rc"],
					"coverageTax"=>$ds["coverage_tax"],
					"producerCommission"=>$ds["producer_commission"],
					"discount"=>$ds["discount"],
					"email" =>$ds["email"],
					"propName" =>$ds["name"],
					"propSurname" =>$ds["surname"],
					"password" =>$ds["password"],
		);
		$i = $i +1;
	}
	if(!$i){
		return 0;
	}else	
	return $companies;
	
	return $companies;	
}

function registeredCompanyMail($email){
	return searchCompanyMailExists($email);
	
}

function verifyCompanyData($company){
	if(!registeredCompanyMail($company["email"]) && ($company["password"] == $company["confirmedPassword"]))
		return 1;
	else return 0;
}

function addCompany(){
	$company = array(
		"businessName" => $_POST['businessName'],
		"address" => $_POST['address'],
		"rc" => $_POST['rc'],
		"coverageTax" => $_POST['coverageTax'],
		"producerCommission" => $_POST['producerCommission'],
		"discount" => $_POST['discount'],
		"propName" => $_POST['propName'],
		"propSurname" => $_POST['propSurname'],
		"email" => $_POST['email'],
		"password" => md5($_POST['userPassword']),
		"confirmedPassword" => md5($_POST['userRetypedPassword']),
		);
	if(verifyCompanyData($company))
		insertCompany($company);
	else return 0;
	return 1;
}

function getCompany($id){
	$result = selectCompany($id);
	while($ds=mysql_fetch_array($result))
		$company=array(
					"id"=>$ds["id"],
					"businessName"=>$ds["business_name"],
					"address"=>$ds["address"],
					"rc"=>$ds["rc"],
					"coverageTax"=>$ds["coverage_tax"],
					"producerCommission"=>$ds["producer_commission"],
					"discount"=>$ds["discount"],
					"email" =>$ds["email"],
					"propName" =>$ds["name"],
					"propSurname" =>$ds["surname"],
					"password" =>$ds["password"],
		);
	return $company;
}

function deleteCompany($id){
	return dropCompany($id);
}

function updateCompany(){
		if(isset($_POST['password'])){
			$company = array(
				"id" => $_POST['id'],
				"businessName" => $_POST['businessName'],
				"address" => $_POST['address'],
				"rc" => $_POST['rc'],
				"coverageTax" => $_POST['coverageTax'],
				"producerCommission" => $_POST['producerCommission'],
				"discount" => $_POST['discount'],
				"propName" => $_POST['propName'],
				"propSurname" => $_POST['propSurname'],
				"password" => md5($_POST['userPassword']),
				"confirmedPassword" => md5($_POST['userRetypedPassword']),
				);
		}else{
			$company = array(
				"id" => $_POST['id'],
				"businessName" => $_POST['businessName'],
				"address" => $_POST['address'],
				"rc" => $_POST['rc'],
				"coverageTax" => $_POST['coverageTax'],
				"producerCommission" => $_POST['producerCommission'],
				"discount" => $_POST['discount'],
				"propName" => $_POST['propName'],
				"propSurname" => $_POST['propSurname'],
				"password" => "nochange",
				"confirmedPassword" => "nochange",	
				);
		}
				
		if($company["password"] == $company["confirmedPassword"])
			alterCompany($company);
		else return 0;
		return 1;
		
}

?>