<?php 	
include("connect.php");

	$sql = "SELECT * FROM core_sponsor_names WHERE email='" . $_SESSION['email'] . "'";
	$rs = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($rs);
	$count = mysqli_num_rows($rs);
	$time = time();
       $_SESSION['sponsorcode'] = $row['sponsor_name'];
 ?>
