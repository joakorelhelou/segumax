<?php

include_once "../../model/rfc.php";

function getRfcPage($role){
	if($role == 1)
		return 4;
	elseif ($role == 2)
		return 3;
	elseif($role == 3)
		return 3;
	
}


function getRfcs($id = 'none'){
	if($id == 'none')
	$result = getAllRfcs();
	else $result = getAllRfcs($id);
	$i=0;
	while($ds=mysql_fetch_array($result)){
		$rfcs[$i]=array(
					"id"=>$ds["id"],
					"customerId"=>$ds["customer_id"],
					"producerId"=>$ds["producer_id"],
					"companyId"=>$ds["company_id"],
					"coverageId"=>$ds["coverage_id"],
					"carData"=>$ds["car_data"],
					"modelAge"=>$ds["model_age"],
					"insuredAmount" =>$ds["insured_amount"],
					"commissionDisc" =>$ds["commission_dis"],
					"coverageAmount" =>$ds["coverage_amount"],
					"state" =>$ds["state"],
					"comment" =>$ds["comment"],
					"date" =>$ds["date"],
					
		);
		$i = $i +1;
	}
	if(!$i){
		return 0;
	}else	
	return $rfcs;
	
	return $rfcs;
}

function getCustomerRfcs($id = 'none'){
	if($id == 'none')
	$result = getAllRfcs();
	else $result = selectCustomerRfcs($id);
	$i=0;
	while($ds=mysql_fetch_array($result)){
		$rfcs[$i]=array(
					"id"=>$ds["id"],
					"customerId"=>$ds["customer_id"],
					"producerId"=>$ds["producer_id"],
					"companyId"=>$ds["company_id"],
					"coverageId"=>$ds["coverage_id"],
					"carData"=>$ds["car_data"],
					"modelAge"=>$ds["model_age"],
					"insuredAmount" =>$ds["insured_amount"],
					"commissionDisc" =>$ds["commission_dis"],
					"coverageAmount" =>$ds["coverage_amount"],
					"state" =>$ds["state"],
					"comment" =>$ds["comment"],
					"date" =>$ds["date"],
					
		);
		$i = $i +1;
	}
	if(!$i){
		return 0;
	}else	
	return $rfcs;
	
	return $rfcs;
}


function getRfcsBySeach(){
		
	
	
	$result = selectRfcBySearch();
		$i=0;
	while($ds=mysql_fetch_array($result)){
		$rfcs[$i]=array(
					"id"=>$ds["id"],
					"customerId"=>$ds["customer_id"],
					"producerId"=>$ds["producer_id"],
					"companyId"=>$ds["company_id"],
					"coverageId"=>$ds["coverage_id"],
					"carData"=>$ds["car_data"],
					"modelAge"=>$ds["model_age"],
					"insuredAmount" =>$ds["insured_amount"],
					"commissionDisc" =>$ds["commission_dis"],
					"coverageAmount" =>$ds["coverage_amount"],
					"state" =>$ds["state"],
					"comment" =>$ds["comment"],
					"date" =>$ds["date"],
		);
		$i = $i +1;
	}
	if(!$i){
		return 0;
	}else	
	return $rfcs;
	
	return $rfcs;
}

function addRfc(){
	$rfc = array(
					"customerId"=>$_POST["customerId"],
					"producerId"=>$_SESSION["userData"]["id"],
					"companyId"=>$_POST["companyId"],
					"coverageId"=>$_POST["coverageId"],
					"carData"=>$_POST["carData"],
					"modelAge"=>$_POST["modelAge"],
					"insuredAmount" =>$_POST["insuredAmount"],
					"commissionDisc" =>$_POST["commissionDis"],
					"coverageAmount" =>$_POST["coverageAmount"],
					"state" =>1,
					"comment" => " ",
					"date" =>date("d/m/y"),
		);
		
	insertRfc($rfc);
	return 1;
}

function getRfc($id){
	$result = selectRfc($id);
	while($ds=mysql_fetch_array($result))
		$rfc=array(
					"id"=>$ds["id"],
					"customerId"=>$ds["customer_id"],
					"producerId"=>$ds["producer_id"],
					"companyId"=>$ds["company_id"],
					"coverageId"=>$ds["coverage_id"],
					"carData"=>$ds["car_data"],
					"modelAge"=>$ds["model_age"],
					"insuredAmount" =>$ds["insured_amount"],
					"commissionDisc" =>$ds["commission_dis"],
					"coverageAmount" =>$ds["coverage_amount"],
					"state" =>$ds["state"],
					"comment" =>$ds["comment"],
					"date" =>$ds["date"],
		);
	return $rfc;
}

function deleteRfc($id){
	return dropRfc($id);
}

function getRfcProducer($id){
	include_once "../../model/producer.php";
	$result = selectProducer($id);
		while($ds=mysql_fetch_array($result))
		$customer=array(
				"id"=>$ds["id"],
					"name"=>$ds["name"],
					"surname"=>$ds["surname"],
					"dni"=>$ds["dni"],
					"email"=>$ds["email"],
					"phone"=>$ds["phone"],
					"password"=>$ds["password"],
					"address" =>$ds["address"],
		);
	if(isset($customer['name']) && isset($customer['surname']))
	return $customer['name'].' '.$customer['surname'];	
else return "";
	
}

function getRfcCompany($id){
	include_once "../../model/company.php";
	$result = selectCompany($id);
		while($ds=mysql_fetch_array($result))
		$customer=array(
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
	if(isset($customer['businessName']))
	return $customer['businessName'];	
else return "";
	
}

function getRfcCustomer($id){
	include_once "../../model/customer.php";
	$result = selectCustomer($id);
		while($ds=mysql_fetch_array($result))
		$customer=array(
				"id"=>$ds["id"],
						"name"=>$ds["name"],
					"surname"=>$ds["surname"],
		);
	if(isset($customer['name']))
	return $customer['name'].' '.$customer['surname'];
else return "";
	
}

function getRfcCoverage($id){
	include_once "../../model/coverage.php";
	$result = selectCoverage($id);
		while($ds=mysql_fetch_array($result))
		$customer=array(
				"id"=>$ds["id"],
						"description"=>$ds["description"],
		);
	if(isset($customer['description']))
	return $customer['description'];
else return "";
	
}

function getCompanyRfcs($id){
	$result = selectCompanyRfcs($id);
		$i=0;
	while($ds=mysql_fetch_array($result)){
		$rfcs[$i]=array(
					"id"=>$ds["id"],
					"customerId"=>$ds["customer_id"],
					"producerId"=>$ds["producer_id"],
					"companyId"=>$ds["company_id"],
					"coverageId"=>$ds["coverage_id"],
					"carData"=>$ds["car_data"],
					"modelAge"=>$ds["model_age"],
					"insuredAmount" =>$ds["insured_amount"],
					"commissionDisc" =>$ds["commission_dis"],
					"coverageAmount" =>$ds["coverage_amount"],
					"state" =>$ds["state"],
					"comment" =>$ds["comment"],
					"date" =>$ds["date"],
		);
		$i = $i +1;
	}
	if(!$i){
		return 0;
	}else	
	return $rfcs;
	
	return $rfcs;

}

function myRfc($customer){
	if($_SESSION['userData']['role'] == 'producer'){
		if($customer['producerId'] == $_SESSION['userData']['id'])
			return 1;
		else return 0;
	}elseif($_SESSION['userData']['role'] == 'company'){
		if($customer['companyId'] == $_SESSION['userData']['id'])
			return 1;
		else return 0;
	}
}

function confirmRfc(){
	$id = $_POST["id"];
	$comment = $_POST["comment"];
	updateConfirmedRFC($id,$comment);
	return 1;
}

function getRequestNumber($id){
	return getRequestQ($id);
}

function getSentRfcs(){
	$result = selectSentRfcs();
		$i=0;
	while($ds=mysql_fetch_array($result)){
		$rfcs[$i]=array(
					"id"=>$ds["id"],
					"customerId"=>$ds["customer_id"],
					"producerId"=>$ds["producer_id"],
					"companyId"=>$ds["company_id"],
					"coverageId"=>$ds["coverage_id"],
					"carData"=>$ds["car_data"],
					"modelAge"=>$ds["model_age"],
					"insuredAmount" =>$ds["insured_amount"],
					"commissionDisc" =>$ds["commission_dis"],
					"coverageAmount" =>$ds["coverage_amount"],
					"state" =>$ds["state"],
					"comment" =>$ds["comment"],
					"date" =>$ds["date"],
		);
		$i = $i +1;
	}
	if(!$i){
		return 0;
	}else	
	return $rfcs;
	
	return $rfcs;
	
}
?>