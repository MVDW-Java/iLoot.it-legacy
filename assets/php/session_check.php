<?php

	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}

	if(!isset($_SESSION["email"]) ){

		$_SESSION["error"] = "Sorry, but you need to login to visit this page or use this function.";
		header("location:/login?".$_SESSION["m"]);
		exit;

	} else {

		include("connect.php");

		$sql = "SELECT * FROM members WHERE username='" . $_SESSION["email"] . "'";
		$rs = mysqli_query($con,$sql);
		$count = mysqli_num_rows($rs);

		if($count != 1) {

			$_SESSION["error"] = "Sorry, but you need to login to visit this page or use this function.";
			header("location:/login");
			exit;


		}

	}

?>