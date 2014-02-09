<?php

include_once "../../model/database.php";

function getAllRfcs($id = 'none'){
	$con = dbaConnect();
	if($id == 'none')	
	return mysql_query("SELECT * FROM rfc ORDER BY id DESC");
	else return mysql_query("SELECT * FROM rfc WHERE producer_id = '$id' ORDER BY id DESC");
	dbaClose($con);
}

function selectCustomerRfcs($id = 'none'){
	$con = dbaConnect();
	if($id == 'none')	
	return mysql_query("SELECT * FROM rfc ORDER BY id DESC");
	else return mysql_query("SELECT * FROM rfc WHERE customer_id = '$id' ORDER BY id DESC");
	dbaClose($con);
}

function selectRfcBySearch(){
	$con = dbaConnect();
	
	$query = "SELECT * FROM rfc ";
	
	
	if((isset($_POST['customerId'])) && $_POST['customerId']){
		$customerId = $_POST['customerId'];
		$condition1 = "customer_id = '$customerId'";
	}
	if((isset($_POST['companyId'])) && $_POST['companyId']){
		$companyId = $_POST['companyId'];
		$condition2 = "company_id = '$companyId'";

	}
	if($_POST['dateFrom'] != ''){
		$dateFrom = $_POST['dateFrom'];
		$condition3 = "date >= '$dateFrom'";

	}
	if($_POST['dateTo'] != ''){
		$dateTo = $_POST['dateTo'];
		$condition4 = "date <= '$dateTo'";

	}
	if($_POST['state']){
		$state = $_POST['state'];
		$condition5 = "state = '$state'";
	}
	if((isset($_POST['producerId'])) && $_POST['producerId']){
		$producerId = $_POST['producerId'];
		$condition6 = "producer_id = '$producerId'";
	}	
	$query = $query." WHERE ";
	
	if(isset($condition1)) $query = $query.$condition1." AND ";
	if(isset($condition2)) $query = $query.$condition2." AND ";
	if(isset($condition3)) $query = $query.$condition3." AND ";
	if(isset($condition4)) $query = $query.$condition4." AND ";
	if(isset($condition5)) $query = $query.$condition5." AND ";
	if(isset($condition6)) $query = $query.$condition6." AND ";

	$id = $_SESSION['userData']['id'];
	if($_SESSION['userData']['role'] == 'producer')
	$query = $query." producer_id = '$id' ORDER BY id DESC";
	elseif($_SESSION['userData']['role'] == 'company')
			$query = $query." company_id = '$id' ORDER BY id DESC";
	else $query = $query." 1 = 1 ORDER BY id DESC";
		
		
	return mysql_query($query);
	dbaClose($con);
}

function insertRfc($rfc){
	$con = dbaConnect();
	$companyId = $rfc['companyId'];
	$coverageId = $rfc['coverageId'];
	$customerId = $rfc['customerId'];
	$carData= $rfc['carData'];
	$modelAge = $rfc['modelAge'];
	$insuredAmount = $rfc['insuredAmount'];
	$commissionDisc = $rfc['commissionDisc'];
	$coverageAmount = $rfc['coverageAmount'];
	$state = $rfc['state'];
	$producerId = $rfc['producerId'];
	$comment = $rfc['comment'];
	$date = $rfc['date'];
	
	$message = "El usuario ".$_SESSION['userData']['surname']." ".$_SESSION['userData']['name']." ha enviado una solicitud para el cliente  ".$customerId;
	recordActivity($_SESSION['userData']['id'],$_SESSION['userData']['role'],$message);		
		
	
	$result =  mysql_query("INSERT INTO rfc (customer_id, producer_id, company_id, coverage_id, car_data, model_age, insured_amount, commission_dis, coverage_amount, state, comment, date)
	 VALUES ('$customerId', '$producerId', '$companyId', '$coverageId','$carData', '$modelAge', '$insuredAmount', '$commissionDisc', '$coverageAmount', '$state', '$comment', '$date')") or die(mysql_error());
	dbaClose($con);
	
}

function selectRfc($id){
	$con = dbaConnect();
	$result =  mysql_query("SELECT * FROM rfc WHERE id = '$id'") or die(mysql_error());
	return $result;
	dbaClose($con);
}

function dropRfc($id){
	$con = dbaConnect();	
	
	$comment = $_POST['comment'];
	
		$message = "El usuario ".$_SESSION['userData']['surname']." ".$_SESSION['userData']['name']." ha cancelado la solicitud ".$id;
	recordActivity($_SESSION['userData']['id'],$_SESSION['userData']['role'],$message);		
	
	return mysql_query("UPDATE rfc SET state=3, comment = '$comment' WHERE id = '$id'");
	dbaClose($con);
	
}

function selectCompanyRfcs($id){
	$con = dbaConnect();
	$result =  mysql_query("SELECT * FROM rfc WHERE company_id = '$id' ORDER BY id DESC") or die(mysql_error());
	return $result;
	dbaClose($con);
}

function updateConfirmedRFC($id,$comment){
	$con = dbaConnect();
	
	$message = "El usuario ".$_SESSION['userData']['surname']." ".$_SESSION['userData']['name']." ha confirmado la solicitud ".$id;
	recordActivity($_SESSION['userData']['id'],$_SESSION['userData']['role'],$message);		
	
	$result =  mysql_query("UPDATE rfc SET comment = '$comment', state = 2 WHERE id = '$id'") or die(mysql_error());
	dbaClose($con);
	
}

function getRequestQ($id){
	$con = dbaConnect();
	$result =  mysql_query("SELECT * FROM rfc WHERE company_id = '$id' AND state = 1") or die(mysql_error());
	return mysql_num_rows($result);
	dbaClose($con);
	
}

function selectSentRfcs(){
	$con = dbaConnect();
	$id = $_SESSION['userData']['id'];
	return mysql_query("SELECT * FROM rfc WHERE company_id = '$id' AND state = 1 ORDER BY id DESC") or die(mysql_error());
	dbaClose($con);
	
}

?>
