<?php

define("SERVER","localhost");
define("USERDB", "root");
define("PASSDB", "");
define("DATABASE", "segumax");


//-----------CONECTA A LA DB-----------------
    function dbaConnect(){
	$con=mysql_connect(SERVER,USERDB,PASSDB);
	mysql_select_db(DATABASE);
	return $con;
	}
	
//-----------DESCONECTA DE LA DB--------------
function dbaClose($con){
	mysql_close($con);
	}


?>