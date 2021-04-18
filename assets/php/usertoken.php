<?php

include("connect.php");
			  $sql="SELECT * FROM members WHERE username='".$_SESSION["email"]."'";
			  $result = mysqli_query($con, $sql);
			  $row = mysqli_fetch_assoc($result);
			  $rowcount = mysqli_num_rows($result);
 
                                  echo "" . $row['usertoken'] . "";

?>