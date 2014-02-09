<?php

include_once "../../model/customer.php";

function getCustomerPage($role){
	if($role == 1)
		return 6;
	elseif ($role == 2)
		return 4;
	
}


function getCustomers($id = 'none'){
	if($id == 'none')
	$result = getAllCustomers();
	else $result = getAllCustomers($id);
	$i=0;
	while($ds=mysql_fetch_array($result)){
		$customers[$i]=array(
					"id"=>$ds["id"],
					"name"=>$ds["name"],
					"producerId"=>$ds["producer_id"],
					"surname"=>$ds["surname"],
					"dni"=>$ds["dni"],
					"birthday"=>$ds["birth_date"],
					"address"=>$ds["address"],
					"email" =>$ds["email"],
					"phone" =>$ds["phone"],
					"cuit" =>$ds["cuit"],
					"taxCondition" =>$ds["tax_condition"],
		);
		$i = $i +1;
	}
	if(!$i){
		return 0;
	}else	
	return $customers;
	
	return $customers;
}

function getCustomersBySeach($search){
	$result = selectCustomerBySearch($search);
		$i=0;
	while($ds=mysql_fetch_array($result)){
		$customers[$i]=array(
					"id"=>$ds["id"],
					"name"=>$ds["name"],
					"producerId"=>$ds["producer_id"],
					"surname"=>$ds["surname"],
					"dni"=>$ds["dni"],
					"birthday"=>$ds["birth_date"],
					"address"=>$ds["address"],
					"email" =>$ds["email"],
					"phone" =>$ds["phone"],
					"cuit" =>$ds["cuit"],
					"taxCondition" =>$ds["tax_condition"],
		);
		$i = $i +1;
	}
	if(!$i){
		return 0;
	}else	
	return $customers;
	
	return $customers;
}

function addCustomer(){
	$customer = array(
		"name" => $_POST['name'],
		"producerId" => $_POST['producerId'],
		"surname" => $_POST['surname'],
		"dni" => $_POST['dni'],
		"birthday" => $_POST['birthday'],
		"address" => $_POST['address'],
		"email" => $_POST['email'],
		"phone" => $_POST['phone'],
		"cuit" => $_POST['cuit'],
		"taxCondition" => $_POST['taxCondition'],
		);
		
	insertCustomer($customer);
	return 1;
}

function getCustomer($id){
	$result = selectCustomer($id);
	while($ds=mysql_fetch_array($result))
		$customer=array(
					"id"=>$ds["id"],
					"name"=>$ds["name"],
					"producerId"=>$ds["producer_id"],
					"surname"=>$ds["surname"],
					"dni"=>$ds["dni"],
					"birthday"=>$ds["birth_date"],
					"address"=>$ds["address"],
					"email" =>$ds["email"],
					"phone" =>$ds["phone"],
					"cuit" =>$ds["cuit"],
					"taxCondition" =>$ds["tax_condition"],
		);
	return $customer;
}

function deleteCustomer($id){
	return dropCustomer($id);
}

function updateCustomer(){
			$customer = array(
					"id" => $_POST['id'],
					"name" => $_POST['name'],
					"producerId" => $_POST['producerId'],
					"surname" => $_POST['surname'],
					"dni" => $_POST['dni'],
					"birthday" => $_POST['birthday'],
					"address" => $_POST['address'],
					"email" => $_POST['email'],
					"phone" => $_POST['phone'],
					"cuit" => $_POST['cuit'],
					"taxCondition" => $_POST['taxCondition'],
				);
	
		alterCustomer($customer);
		return 1;
		
}

function getImpositiveCode($code){
	if($code == 1)
		return "Consumidor Final";
	elseif ($code == 2)
		return "Monotributo";
	elseif ($code == 3)
		return "Responsable Inscripto"; 
}

function getCustomerProducer($id){
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

function myCustomer($customer){
	if($customer['producerId'] == $_SESSION['userData']['id'])
		return 1;
else return 0;
}
?>
