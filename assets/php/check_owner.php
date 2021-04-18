<?php

include("connect.php");
			  $sql = "SELECT * FROM user_sponsor WHERE sponsor_name='".$_SESSION["email"]."'";
			  $result = mysqli_query($con, $sql);
			  $row = mysqli_fetch_assoc($result);
			  $rowcount = mysqli_num_rows($result);

if($rowcount == 1){
			  $code = row['sponsor_name'];
			  $isowner = 1;
};
?>