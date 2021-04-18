<?php

include("/connect.php");

			  $sql = "SELECT * FROM captcha_history WHERE email='" . $_SESSION["email"] . "'";
			  $result = mysqli_query($con, $sql);
			  $row = mysqli_fetch_assoc($result);
			  $rowcount = mysqli_num_rows($result);

			  echo "".$rowcount.""
?>