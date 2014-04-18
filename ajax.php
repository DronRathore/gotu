<?php
	define("DB_USER_NAME", "root");
	define("DB_PASSWORD", "");
	define("DB_HOST", "localhost");
	require_once("./Database.php");
	$database = new Database("work");
	$result = $database->query("SELECT longitude,latitude from gpsdata order by id desc", true);
	
	while($re = mysql_fetch_array($result)){
		echo $re[0]." ".$re[1]." ";
		
	}
?>