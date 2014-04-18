<?php
	define("DB_USER_NAME", "root");
	define("DB_PASSWORD", "");
	define("DB_HOST", "localhost");
	require_once("./Database.php");
	$database = new Database("work");
	//$result = $database->query("SELECT longitude,latitude from gpsdata", true);
	$longitude=$_POST["long"];
	$latitude=$_POST["lat"];
	echo $longitude;
	echo $latitude;
	echo "I am up to here..";
	mysql_query("UPDATE gpsdata SET longitude='$longitude' WHERE id=1 AND latitude='$latitude'")

	
?>