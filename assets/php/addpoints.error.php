<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}

if (!isset($_SESSION["myusername"])) {
    header("location:login?error=Sorry, but you need to login to open this page or run this function.");
}

include("connect.php");

$myusername = $_POST['email'];
$mypassword = $_POST['password'];
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysqli_real_escape_string($con, $myusername);
$mypassword = mysqli_real_escape_string($con, $mypassword);
$username = $_SESSION['myusername'];

$time = time();

$sql   = "SELECT * FROM members WHERE username='" . $_SESSION['myusername'] . "'";
$rs    = mysqli_query($con, $sql);
$row   = mysqli_fetch_array($rs);
$count = mysqli_num_rows($rs);

if ($count == 1) {
	
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
    
	$pointsAdd = rand(5, 14);
    $points    = $row['points'] + $pointsAdd;
    $calc_time = time() - $row['time'];
    
   if ($calc_time < 5) {
		header("location:window.php?window=2&message=Remember to use only 1 device. points will not get added.");
		die;
   }
    
    $sql1 = "UPDATE members SET points='" . $points . "', time='" . time() . "' WHERE username='" . $_SESSION['myusername'] . "'";
	// $sql1 = "INSERT INTO core_fast_save (product_id, email, time, data_1) VALUES ('1', '$username', '".$time."', '$pointsAdd');";
    mysqli_query($con, $sql1);
	
	
	$update = "WATCH ADVERTISEMENTS > ADD VALUE";
	
	$sql = "INSERT INTO users_history (email, date, log, value) VALUES ('$username', '".$time."', '$update', '$pointsAdd');";
	mysqli_query($con, $sql);
    
    header("location:window.php?window=2");
} else {
    header("location:logout.php?message=We loged you out because of a fatal error.");
}

?>