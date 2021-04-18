<?php 
	include("connect.php");

	$sql = "SELECT perms FROM members WHERE username='" . $_SESSION['email'] . "'";
	$rs = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($rs);
	$count = mysqli_num_rows($rs);

if($row['usertoken'] == 0){
        echo "(<a href=\"/assets/php/token_generator.php\">Generate token</a>)";
        } else {
echo "(<a href=\"#\">Iloot.it Token</a>)";
}

?>