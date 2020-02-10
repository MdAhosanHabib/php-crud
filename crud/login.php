<?php

session_start();

if(isset($_SESSION['auth'])){
	if($_SESSION['auth']==1){
		header("location:index.php");
	}
}else{
	if(isset($_COOKIE['author'])){
		if($_COOKIE['author']==true){
			header("location:index.php");
		}
	}
}

$notify = "";
if(isset($_POST['login_btn'])){
	$email = $_POST['student_email'];
	$pass  = $_POST['student_pass'];
	$loggedin = isset($_POST['keep_login'])?1:0;

	if($email=="ahosan@gmail.com" && $pass=="1234"){
		$_SESSION['auth']=1;
		if($loggedin==1){
			setcookie('author',true,time()+(60*60*24*10),'/');
		}

		header("location:index.php");
	}else{
		$notify = "invalid email or password";
	}
}


?>
<!DOCTYPE html>
<html lang="en">
<html>
<head>
	<meta charset="utf-8">
	<title>Log in</title>
</head>
<body>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<label for="">Email</label><br>
		<input type="email" name="student_email" placeholder="Email"><br>
		<label for="">Password</label><br>
		<input type="password" name="student_pass" placeholder="Password"><br>
		<label for="">
			<input type="checkbox" name="keep_login">keep me loggedin.
		</label><br><br>
		<input type="submit" name="login_btn" value="login">
	</form>
	<div>
		<?php echo $notify;?>
	</div>
</body>
</html>