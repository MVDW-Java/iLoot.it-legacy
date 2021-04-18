<?php 
include("connect.php");
		$sql="SELECT * FROM members WHERE username='".$_SESSION["email"]."'";
		$result=mysqli_query($con,$sql);
		$count = mysqli_num_rows($result);

$date = strtotime("May 31");
$remaining = $date - time();
echo $date;
$days_remaining = floor($remaining / 86400);
$hours_remaining = floor(($remaining % 86400) / 3600);
echo "There are $days_remaining days and $hours_remaining hours left";
?>