<?php
//it is for live server
$host="localhost";
$user="ahosande_portfolio121";
$pass="ahosande_portfolio121";
$db="ahosande_portfolio121";

$conn= new mysqli($host,$user,$pass,$db);

if($conn -> connect_error){
	die($conn -> error);
}else{
	// echo "Database Connected";
}

?>