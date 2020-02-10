<?php

$host="localhost";
$user="root";
$pass="";
$db="ssb_126";

$conn= new mysqli($host,$user,$pass,$db);

if($conn -> connect_error){
	die($conn -> error);
}else{
	// echo "Database Connected";
}

?>