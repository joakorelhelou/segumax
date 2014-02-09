<?php
if(isset($routeLevel)){
	if($routeLevel == 1)
		include_once "../../model/database.php";
}else include_once "../model/database.php";

function searchLog($table, $user, $password){
	$con = dbaConnect();
	$result = mysql_query("SELECT * FROM ".$table." WHERE email='".$user."' AND password='".$password."'") or die(mysql_error());
	if(mysql_num_rows($result)){
		session_start();
		while($ds=mysql_fetch_array($result)){
		$userData=array(
					"id"=>$ds["id"],
					"name"=>$ds["name"],
					"surname"=>$ds["surname"],
					"dni"=>$ds["dni"],
					"id"=>$ds["id"],
					"phone"=>$ds["phone"],
					"email"=>$ds["email"],
					"address"=>$ds["address"],
					"role"=>$table,
					"password"=>$ds["password"],
		);
	}
		$_SESSION["userData"] = $userData;
		return 1;
	}
	else return 0;
	dbaClose($con);
}

?>