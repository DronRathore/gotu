<?php
	define('DB_HOST', 'localhost');
    define('DB_USER', 'geekve5_geekved');
    define('DB_PASSWORD', '123_nishant');
    define('DB_DATABASE', 'geekve5_geekved');


$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
	
	
$lat =  isset($_POST['latitude']) ? $_POST['latitude'] : null;
$lon = isset($_POST['longitude']) ? $_POST['longitude'] : null;


mysql_query ("INSERT INTO location(latitude, longitude) VALUES('$lat', '$lon')");
	?>