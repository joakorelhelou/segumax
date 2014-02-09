<?php

function sanitize($data)
{
// remove whitespaces (not a must though)
$data = trim($data); 

// apply stripslashes if magic_quotes_gpc is enabled
if(get_magic_quotes_gpc()) 
{
$data = stripslashes($data); 
}

// a mySQL connection is required before using this function
$data = mysql_real_escape_string($data);

return $data;
}

function isAdmin(){
	if ($_SESSION['userData']['role'] == 'admin')
		return 1;
	else return 0;
}

if(isset($routeLevel)){
	if($routeLevel == 1)
		include_once "../../model/user.php";
}else include_once "../model/user.php";


function logUser($userName,$userPassword){
	$userPassword = md5($userPassword);
	if(searchLog("admin",$userName,$userPassword)){
		$message = "El usuario ".$_SESSION['userData']['surname']." ".$_SESSION['userData']['name']." ha iniciado sesion";
		recordActivity($_SESSION['userData']['id'],"admin",$message);
		
		header("location:admin/main.php");
	}elseif(searchLog("company",$userName,$userPassword)){
			$message = "El usuario ".$_SESSION['userData']['surname']." ".$_SESSION['userData']['name']." ha iniciado sesión";
			recordActivity($_SESSION['userData']['id'],"company",$message);	
			header("location:company/main.php");
		}elseif(searchLog("producer",$userName,$userPassword)){
					$message = "El usuario ".$_SESSION['userData']['surname']." ".$_SESSION['userData']['name']." ha iniciado sesión";
					recordActivity($_SESSION['userData']['id'],"producer",$message);	
					header("location:producer/main.php");
			}else return 0;
}

function getError(){
	if(isset($_GET['logout'])){
		return 1;
	}elseif(isset($_GET['redirect'])){
		return 2;
	}
}

function getRoleCode(){
	if($_SESSION['userData']['role'] == "admin")
		return 1;
	elseif($_SESSION['userData']['role'] == "producer")
		return 2;
	elseif($_SESSION['userData']['role'] == "company")
		return 3;
}

function recordMessage($message){
	$ruta=realpath("../../logs").'/'.date("y-m").".txt";
	$id= fopen($ruta,"a+");
	$mensaje=date("y-m-d H:i:s")." ".$message."\n \n";	
	fputs($id,$mensaje);
	fclose($id);
}

function recordActivity($id,$role,$message){
	$connection=dbaConnect();
	$date=date("y/m/d H:i:s");
	$result=mysql_query("INSERT INTO activity (user_id,description,role,date) VALUES ('$id','$message','$role','$date')");
	recordMessage($message);
}

function getActivities($id,$role){
		$connection=dbaConnect();
		$result=  mysql_query("SELECT * FROM activity WHERE role = '$role' AND user_id = '$id' ORDER BY id DESC");
		$i = 0;
			while($ds=mysql_fetch_array($result)){
		$customers[$i]=array(
					"description"=>$ds["description"],
					"date"=>$ds["date"],
		);
		$i = $i +1;
	}
	if(!$i){
		return 0;
	}else	
	return $customers;
	
	return $customers;
		
}

?>