<?php 

	if(isset($_SESSION["email"])){


	include("connect.php");

	$permissions_is_banned = false;
	$permissions_see_tasks = false;
	$permissions_give_support = false;
	$permissions_translate = false;
	$permissions_manage_users = false;

	$sql = "SELECT perms FROM members WHERE username='" . $_SESSION['email'] . "'";
	$rs = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($rs);
	$count = mysqli_num_rows($rs);

	if($count == 1){
			
		if(substr($row["perms"], -0, 1)){
			$_SESSION["email"] = "";
			$_SESSION['error'] = "This account has been disabled.";
			header("location:/login");
		}

		if(substr($row["perms"], -4, 1)){
			$permissions_see_tasks = true;
		}

		if(substr($row["perms"], -3, 1)){
			$permissions_give_support = true;
		}

		if(substr($row["perms"], -2, 1)){
			$permissions_translate = true;
		}

		if(substr($row["perms"], -1, 1)){
			$permissions_manage_users = true;
		}



	} else {
		unset($_SESSION["email"]);
		$_SESSION["error"] = "Permission problems, please tell us!";
		header("location:/login");
	}
}
?>