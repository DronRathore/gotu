<?php
	session_start();
	define("DB_USER_NAME", "root");
	define("DB_PASSWORD", "");
	define("DB_HOST", "localhost");
	require_once("./Database.php");
	$database = new Database("work");
	$result = $database->query("SELECT longitude,latitude from gpsdata", true);
	$ar = array();
		$i=0;
	while($re = mysql_fetch_array($result)){
		$_SESSION["longitude"][$i]=$re[0];
		$_SESSION["latitude"][$i]=$re[1];
		
		//echo "[".$_SESSION["longitude"][$i].",".$_SESSION["latitude"][$i]."],"; 
		$i=$i+1;
	}

	if(isset($_SESSION["latitude"]))
				for($i=0;$i<sizeof($_SESSION["latitude"]);$i=$i+1)
				{

echo "[".$_SESSION["longitude"][$i].",".$_SESSION["latitude"][$i]."],";
}
?>