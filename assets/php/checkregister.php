<?php
	include("connect.php");

	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}

	if(isset($_POST['email'])){
		$_SESSION['register_email'] = $_POST['email'];
	}

	if(isset($_POST['name'])){
		$_SESSION['register_name'] = $_POST['name'];
	}

	if(isset($_POST['password1'])){
		$_SESSION['register_password1'] = $_POST['password1'];
	}

	if(isset($_POST['password2'])){
		$_SESSION['register_password2'] = $_POST['password2'];
	}



	if(isset($_POST['h-captcha-response']) && !empty($_POST['h-captcha-response'])){

		$secret = '0x6D2dA6bFCC74606638600F9805f5328f721b03be';
		$verifyResponse = file_get_contents('https://hcaptcha.com/siteverify?secret='.$secret.'&response='.$_POST['h-captcha-response'].'&remoteip='.$_SERVER['REMOTE_ADDR']);
		$responseData = json_decode($verifyResponse);

		if($responseData->success){



			if(empty($_POST['email'])){
				$_SESSION['error'] = "Please fill in your email";
				header("location:/register");
				die;
			}

			if(empty($_POST['password1'])){
				$_SESSION['error'] = "Please fill in your password";
				header("location:/register");
				die;
			}

			if(empty($_POST['password2'])){
				$_SESSION['error'] = "Please fill in your password";
				header("location:/register");
				die;
			}

			if(empty($_POST['name'])){
				$_SESSION['error'] = "You need to fill in your full name";
				header("location:/register");
				die;
			}

			if(empty($_POST['terms'])){
				$_SESSION['error'] = "Sorry, but you need to accpet our term of service";
				header("location:/register");
				die;
			}

			if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
				$_SESSION['error'] = "Sorry, but you need to enter a valid email address";
				header("location:/register");
				die;
			}


			$myusername = htmlentities($_POST['email'], ENT_QUOTES); 
			$myfullname = htmlentities($_POST['name'], ENT_QUOTES);
			$mypassword1 = hash('sha256', 'abcdefghijklmnopqrstuvwxyz1234567890'.$_POST['password1']);
			$mypassword2 = hash('sha256', 'abcdefghijklmnopqrstuvwxyz1234567890'.$_POST['password2']);

			$myusername = stripslashes($myusername);
			$myfullname = stripslashes($myfullname);
			$mypassword1 = stripslashes($mypassword1);
			$mypassword2 = stripslashes($mypassword2);
			$myusername = mysqli_real_escape_string($con,$myusername);
			$myfullname = mysqli_real_escape_string($con,$myfullname);
			$mypassword1 = mysqli_real_escape_string($con,$mypassword1);
			$mypassword2 = mysqli_real_escape_string($con,$mypassword2);

			$sql="SELECT * FROM members WHERE username='$myusername'";
			$result=mysqli_query($con,$sql);



			if($mypassword1 == $mypassword2){

				$count = mysqli_num_rows($result);

				if($count==1){
					$_SESSION['error'] = "Email already exist.";
					header("location:/register");
				} else {


					if(isset($_SESSION["sponsor"])){

						$sql="SELECT * FROM core_sponsor_names WHERE sponsor_name='" . $_SESSION['sponsor'] . "'";
						$result=mysqli_query($con,$sql);
						$count = mysqli_num_rows($result);
						
						if($count == 1) {
							mysqli_query($con,"INSERT INTO user_sponsor (email, sponsor_name) VALUES ('$myusername', '" . $_SESSION['sponsor'] . "')");
						} else {

							$_SESSION["error"] = "SPONSOR NOT FOUND, PLEASE REPORT THIS!";
							unset($_SESSION["sponsor"]);
							header("location:/register");
							exit;
						}

					}

					mysqli_query($con,"INSERT INTO members (username, fullname, password, changepwddate, tos_ver, avatar, nickname) VALUES ('$myusername', '$myfullname', '$mypassword1', '".date('d.m.Y G:i')."', '2', 'https://iloot.it/assets/images/defult.png', 'Anonymous')");

					$_SESSION["message"] = "You have been successfully registered, please login.";
					header("location:/login");
				}

			} else {
				$_SESSION['error'] = "The password does not match";
				header("location:/register");
			}
		} else {
		$_SESSION['error'] = "Wrong captcha awnser, please try again!";
		header("location:/register");
		die;

		}
	} else {
		$_SESSION['error'] = "Please fill in the captcha!";
		header("location:/register");
		die;

		
	}


?>