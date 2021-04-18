<?php

	// Remove code when released!!

$date = date_create();

$release_date = "593043200";

	if(date_timestamp_get($date) < $release_date){
          if($_GET["iamdev"] != "true"){
		echo "
<!DOCTYPE HTML>
<html>
<head>
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
<style>
@font-face {
  font-family: 'Minecraftia';
  src: url(\"/assets/fonts/Minecraftia-Regular.ttf\") format(\"truetype\");
  font-weight: normal;
  font-style: normal;
}
body{
  font-family: \"Minecraftia\" !important;
  color: #e2af05;
  background: #1f1f1f;
}


#release {
  text-align: center;
  font-size: 22px;
  margin-top: 0px;
}

#demo {
  text-align: center;
  font-size: 60px;
  margin-top: 0px;
}
</style>
</head>
<body>
<p id=\"release\">iLoot.it re-opening date:</p>
<p id=\"demo\">Loading...</p>

<script>
// Set the date we're counting down to
var countDownDate = new Date('" . $release_date . "'*1000);

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id=\"demo\"
  document.getElementById(\"demo\").innerHTML = days + \"d \" + hours + \"h \"
  + minutes + \"m \" + seconds + \"s \";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById(\"demo\").innerHTML = \"Refresh to start earning!\";
  }
}, 1000);
</script>

</body>
</html>
";
		exit;
}
	}

	include("assets/php/menu.php");

	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}

	if(isset($_GET['m'])){
		$_SESSION["m"] = $_GET["m"];
		
		echo "<meta http-equiv=\"Refresh\" content=\"0; url=/minilinks\">";
	}

	if(isset($_GET['sponsor'])){
		$_SESSION["sponsor"] = $_GET["sponsor"];
		
		echo  "<meta http-equiv=\"Refresh\" content=\"0; url=/register\">";
	}


	if(!empty($_SESSION['error'])) {
		$color = "red";
	} else if(!empty($_SESSION['message'])) {
		$color = "green";
	} else if($maintenance_announcement != "") {
		$color = $maintenance_color;
	} else {
		$color = "red";
	}
?>

<!DOCTYPE HTML>
<html lang="en">
	<head>
		<?php echo $tags; ?>
		
		<title><?php echo $name; ?> | How to get started with <?php echo $name; ?></title>

		<?php echo $imports; ?>
<script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
	</head>
	<body style="display: none; ">

		<div class="colorlib-loader"></div>


		<div id="page">
			<nav class="colorlib-nav">
				<div class="top-menu">
					<div class="container">
						<div class="row">

							<div id="colorlib-logo"><a href="https://www.iloot.it"><img src="https://iloot.it/assets/images/logo.png" width="128" alt="<?php echo $name; ?>"></a></div>
							
							<div class="col-md-10 text-right menu-1">
								<ul>
									<?php
										echo $menu;
									?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</nav>

			<section id="home" class="video-hero" style="height: 700px; background-image: url(assets/images/cover_img_1.jpg); background-repeat:space;" data-section="home">
				<div class="overlay"></div>


				<!-- <a class="player" data-property="{videoURL:'https://www.youtube.com/watch?v=hIoP5YMhfKk',containment:'#home', showControls:false, autoPlay:true, loop:true, mute:true, startAt:0, opacity:1, quality:'default'}"></a> -->


				<div class="display-t text-center">
					<div class="display-tc">
						<div class="container">
							<div class="col-md-12 col-md-offset-0">
								<div class="animate-box">
									<img style="width: 75%; max-width: 512px;" src="https://iloot.it/assets/images/logo.png" alt="iLoot.it">
									<h2 style="font-size: 32px;"><?php echo $slogan; ?></h2>

									<!-- <div class="16bit_button" style="width:128px;"><p><a href="register" title="Register">Register today!</a></p></div> -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

			<div class="colorlib-intro">
				<div class="container">
					<div class="row">
						<div class="col-md-12 col-md-offset-0 text-left colorlib-heading animate-box">

							<div class="row form-group">
								<div class="col-md-8">


							<?php
								if($maintenance_announcement != "" || !empty($_SESSION['error']) || !empty($_SESSION['message'])) {
									echo "<div class=\"alert " . $color . "\" id=\"alert-text\">";
									echo "<span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>";

									if(!empty($_SESSION['error'])) {
				  						echo $_SESSION["error"];
									} else if(!empty($_SESSION['message'])) {
				  						echo $_SESSION["message"];
									} else if($maintenance_announcement != "") {
										echo $maintenance_announcement;
									} else {
										echo "Something went wrong, please let the admins know! errorcode: 481641";
									}

									echo "</div>";
								}
							?>






									<h1>How to get started with iLoot.it</h1>
									<p>Welcome to iLoot.it! We&rsquo;re happy to have you here.<br /> On this website you can make free money by watching ads, completing surveys, solving captchas and shortening URLs.<br /> Your money will be stored in your online wallet.<br /> Once you earn 10 dollars you can withdraw via PayPal.<br /> The money will be deposited on your account on the first of every month, due to Google AdSense paying us like that.<br /> You can also use your iloot.it balance to buy subscriptions on our other projects such as Enthix, Globan and High-Class Advertisements.</p>
									<br/>

									<!--<h2>Official app</h2>
									<p>We are working on a official iLoot.it app for on the Play store&trade; and for Microsoft Store&trade;, its still in development and will be released next year! for more updates join our Discord so stay tuned.<br />
									<a href='#'><img width="254" src="https://iloot.it/assets/images/google-play-badge.png" alt="Get it on Google Play"></a>

									<a href='#'><img src='https://assets.windowsphone.com/85864462-9c82-451e-9355-a3d5f874397a/English_get-it-from-MS_InvariantCulture_Default.png' alt='English badge' style='width: 192px;'/></a>

									<a href='/overlay'><img width="254" src="https://iloot.it/assets/images/ChromeWebStore_BadgeWBorder_v2_496x150.png" alt="Available in the Chrome Web Store"></a> -->
								</div>
								<div class="col-md-4">
									<iframe src="https://discordapp.com/widget?id=355981469744889856&theme=dark" width="350" height="500" allowtransparency="true" frameborder="0"></iframe>
								</div>
							</div>
<?php
include("assets/php/adssettings.php");
if($index == "true"){ 
include("ads.php");
} else {

}
?>						</div>
					</div>
				</div>

			<?php 
				echo $footer;
			?>
		</div>

		<div class="gototop js-top">
			<a title="goto top" class="js-gotop"></a>
		</div>



<script>
	var blocked = false;

	$(document).ready(function(){
		$("body").show();

		$.get( "https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js", function( data ) {
			console.log(data.length);
			if(data.length === 0){
				blocked = true;
			}
		});


		check()
	});


	function check() {
    		setTimeout(function () {

			if(blocked) {
				$( "body" ).empty();
				$('body').append('<?PHP include("assets/php/adblockscreen.php"); ?>');   
			}
    		}, 2000);
	}

</script>




	<!-- jQuery -->
	<script src="https://iloot.it/assets/js/jquery.min.js"></script>

	<!-- jQuery Easing -->
	<script src="https://iloot.it/assets/js/jquery.easing.1.3.js"></script>

	<!-- Bootstrap -->
	<script src="https://iloot.it/assets/js/bootstrap.min.js"></script>

	<!-- Waypoints -->
	<script src="https://iloot.it/assets/js/jquery.waypoints.min.js"></script>

	<!-- Stellar Parallax -->
	<script src="https://iloot.it/assets/js/jquery.stellar.min.js"></script>

	<!-- YTPlayer -->
	<script src="https://iloot.it/assets/js/jquery.mb.YTPlayer.min.js"></script>

	<!-- Magnific Popup -->
	<script src="https://iloot.it/assets/js/jquery.magnific-popup.min.js"></script>
	<script src="https://iloot.it/assets/js/magnific-popup-options.js"></script>

	<!-- Counters -->
	<script src="https://iloot.it/assets/js/jquery.countTo.js"></script>

	<!-- Main -->
	<script src="/assets/js/main.js" async></script>

	</body>
</html>


<?php
	$_SESSION['message'] = "";
	$_SESSION['error'] = "";
?>


