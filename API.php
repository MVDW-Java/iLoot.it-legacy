<?php
	include("assets/php/connect.php");

	if(isset($_GET['Authorization'])){
		
		if(isset($_POST['link'])) {

			$sql = "SELECT * FROM api WHERE token='" . $_GET['Authorization'] . "'";
			$rs = mysqli_query($con,$sql);
			$row = mysqli_fetch_array($rs);
			$count = mysqli_num_rows($rs);
			

			if($count == 1){
				
				$sql2 = "SELECT * FROM skinnylinks WHERE url='" . $_POST['link'] . "' AND username='" . $row['user'] . "'";
				$rs2 = mysqli_query($con, $sql2);
				$row2 = mysqli_fetch_array($rs2);
				$count2 = mysqli_num_rows($rs2);
				
				if($count2 == 1){
					echo "{\"short\": \"" . $row2["shorter"] . "\"}";
				} else {
					$found = 0;
					$shorter = "TEST";

					while($found == 0){
						$shorter = bin2hex(openssl_random_pseudo_bytes(4));
						$sql = "SELECT * FROM skinnylinks WHERE shorter='" . $shorter . "'";
						$rs = mysqli_query($con,$sql);
						$count = mysqli_num_rows($rs);

						if($count == 0){
							$found = 1;
							mysqli_query($con, "INSERT INTO `skinnylinks` (username, url, shorter, clicks) VALUES ('" . $row['user'] . "', '" . $_POST['link'] . "', '$shorter', '0')");
							$_SESSION["message"] = "https://iloot.it/minilinks?m=$shorter";

						}

					}

					echo "{\"short\": \"" . $shorter . "\"}";

				}


			} else {
				echo "{\"error\": \"Authorization header not vailid(".$headers['Authorization'].")\"}";
			}

		} else {
		
			echo "{\"error\": \"Post link not set\"}";

		}



	} else {
		echo "{\"error\": \"no Authorization header\"}";
	}

	header('Content-Type: application/json');
?>