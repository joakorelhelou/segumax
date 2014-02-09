<?php

include_once "../../model/coverage.php";

function getPage($role){
	if($role == 1)
		return 5;
	elseif ($role == 2)
		return 5;
	elseif ($role == 3)
		return 2;
	
}


function getCoverages($id = 'none'){
	if($id == 'none')
	$result = getAllCoverages();
	else $result = getAllCoverages($id);
	$i=0;
	while($ds=mysql_fetch_array($result)){
		$coverages[$i]=array(
					"id"=>$ds["id"],
					"companyId"=>$ds["company_id"],
					"description"=>$ds["description"],
					"rate"=>$ds["rate"],
		);
		$i = $i +1;
	}
	if(!$i){
		return 0;
	}else	
	return $coverages;
	
	return $coverages;
}

function getCoveragesBySeach($search){
	if($_SESSION['userData']['role'] == "company"){
		$result = selectCoverageBySearch($search,$_SESSION['userData']['id']);
	}else $result = selectCoverageBySearch($search);
		$i=0;
	while($ds=mysql_fetch_array($result)){
		$coverages[$i]=array(
					"id"=>$ds["id"],
					"companyId"=>$ds["company_id"],
					"description"=>$ds["description"],
					"rate"=>$ds["rate"],
		);
		$i = $i +1;
	}
	if(!$i){
		return 0;
	}else	
	return $coverages;
	
	return $coverages;
}

function addCoverage(){
	$coverage = array(
		"companyId" => $_POST['companyId'],
		"description" => $_POST['description'],
		"rate" => $_POST['rate'],
		);
		
	insertCoverage($coverage);
	return 1;
}

function getCoverage($id){
	$result = selectCoverage($id);
	while($ds=mysql_fetch_array($result))
		$coverage=array(
					"id"=>$ds["id"],
					"companyId"=>$ds["company_id"],
					"description"=>$ds["description"],
					"rate"=>$ds["rate"],
		);
	return $coverage;
}

function deleteCoverage($id){
	return dropCoverage($id);
}

function updateCoverage(){
			$coverage = array(
					"id" => $_POST['id'],
					"description" => $_POST['description'],
					"rate" => $_POST['rate'],
				);
	
		alterCoverage($coverage);
		return 1;
		
}


function getCoverageCompany($id){
	include_once "../../model/company.php";
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
	if(isset($company['businessName']))
	return $company['businessName'];	
else return "";
	
}

function myCoverage($coverage){
	if($coverage['companyId'] == $_SESSION['userData']['id'])
		return 1;
else return 0;
}

?>
