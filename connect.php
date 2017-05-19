<?php

$dbPassword = "";
$dbUserName = "root";
$dbServer = "127.0.0.1";
$dbName = "CIS_435_P3";

// $connection = new mysqli($dbServer, $dbUserName, $dbPassword, $dbName);

try{
	$db = new PDO("mysql:host=127.0.0.1;dbname=CIS_435_P3", "root", "");	
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e){
	echo "PDO could not connect to the database.";
	exit;
}
?>