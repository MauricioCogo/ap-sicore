<?php

	$host = "127.0.0.1";
	$name = "root";
	$pass = "";
	$database = "SICORE";

	try{
		$cone = new mysqli($host,$name,$pass,$database);
	}
	catch(Exception $e){
		echo("Error: ".$e);
	}
	?>
