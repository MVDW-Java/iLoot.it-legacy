<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}

if(!isset($_SESSION["myusername"]) ){
header("location:login.php?message=Oops... something whent wrong...");
}

include("connect.php");

$found = 0;

while($found == 0) {
$token = bin2hex(openssl_random_pseudo_bytes(8));

$sql="SELECT * FROM members WHERE usertoken='".$token."'";
$rs=mysqli_query($con,$sql);
$count=mysqli_num_rows($rs);
if($count == 0){

$sql = "UPDATE members SET usertoken='".$token."' WHERE username='".$_SESSION["email"]."'";
if (mysqli_query($con, $sql)) {
$found = 1;
header("location:/profile.php");
} else {
header("location:/profile.php");
}
} else {
header("location:/profile.php");
}
}

?>