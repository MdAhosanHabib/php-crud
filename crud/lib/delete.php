<?php
include "connection.php";

if(isset($_GET['id'])){
	// echo $_GET['id'];
	$delete_id = $_GET['id'];

	$deletesql = "delete from student_info where id = $delete_id";

	if($conn -> query($deletesql)){
			header("location:../index.php");
	}else{
		die($conn -> error);
	}
}else{
	header("location:../index.php");
}
?>