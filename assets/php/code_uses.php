<?php

include("connect.php");
include("check_owner.php");
if($isowner == 1){
			  $sql = "SELECT * FROM user_sponsor WHERE sponsor_name='" . $code . "'";
			  $result = mysqli_query($con, $sql);
			  $row = mysqli_fetch_assoc($result);
			  $rowcount = mysqli_num_rows($result);

			  echo "Code Uses".$rowcount."";
};

?>