<?php
	include("connect.php");

	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}



	if(empty($_POST['email'])){
		$_SESSION['error'] = "Please fill in your email";
		header("location:/login");
		die;
	}

	if(empty($_POST['password'])){
		$_SESSION['error'] = "Please fill in your password";
		header("location:/login");
		die;
	}



	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
		$_SESSION['error'] = "Sorry, but you need to enter a valid email address";
		header("location:/login");
		die;
	}


	$username = htmlentities($_POST['email'], ENT_QUOTES); 
	$password = hash('sha256', 'abcdefghijklmnopqrstuvwxyz1234567890'.$_POST['password']);

	$username = stripslashes($username);
	$password = stripslashes($password);

	$username = mysqli_real_escape_string($con,$username);
	$password = mysqli_real_escape_string($con,$password);

	$sql="SELECT * FROM members WHERE username='$username' AND password='$password'";
	$result=mysqli_query($con,$sql);
	$count = mysqli_num_rows($result);

	if($count == 1){
		$_SESSION['email'] = $_POST['email'];
		
		if($_POST["rememberme"] == "yes") {
			setcookie("email", $_POST['email'], time() + (86400 * 30), "/");
			setcookie("password", $_POST['password'], time() + (86400 * 30), "/");
		}



		header("location:/profile");
	} else {
		$_SESSION['error'] = "Invailid username or password, please try again.";
	}


?>