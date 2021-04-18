<?php 
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	$_SESSION["email"] = "";
	setcookie("email", "", time() - 3600); 
	setcookie("password", "", time() - 3600); 
	$_SESSION["message"] = "You have been logged out.";
	header("location:login");
?>
