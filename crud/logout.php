<?php
session_start();
if(isset($_SESSION['auth']) || isset($_COOKIE['author']) ){
	session_destroy();
	if(isset($_COOKIE['author'])){
		setcookie('author','',time()-3600,'/');
	}
	header("location:login.php");
}else{
	header("location:login.php");
}
?>