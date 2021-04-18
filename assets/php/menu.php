<?php 
	if($_SERVER['HTTP_X_FORWARDED_FOR'] == "ILOOTTEMP"){
		echo "<center><h1>Oh no, it looks like you have been banned from our services</h1></center><br><br><center><h2>Reason: 'NULL'</h2></center>";
		exit;
	}

	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}


	include("connect.php");

	if(isset($_COOKIE["email"]) && isset($_COOKIE["password"]) && !isset($_SESSION["email"])){
		$username = htmlentities(urldecode($_COOKIE["email"]), ENT_QUOTES); 
		$password = hash('sha256', 'abcdefghijklmnopqrstuvwxyz1234567890'.$_COOKIE["password"]);

		$username = stripslashes($username);
		$password = stripslashes($password);

		$username = mysqli_real_escape_string($con,$username);
		$password = mysqli_real_escape_string($con,$password);

		$sql="SELECT * FROM members WHERE username='$username' AND password='$password'";
		$result=mysqli_query($con,$sql);
		$count = mysqli_num_rows($result);

		if($count == 1){
			$_SESSION['email'] = $_COOKIE["email"];
			
		} else {
			echo $_COOKIE["email"] . urldecode($_COOKIE["email"]);
		}
	}
	



		include("translate.php");
		include("permissions.php");




	$tags = "
		<meta charset=\"UTF-8\">
		<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
		<meta name=\"description\" content=\"iLoot.it is an earnings platform desinged for gamers by gamers.\n get money by doing tasks to buy yourself a new game.\">
		<meta name=\"keywords\" content=\"Loot, Money, Earn, Euro, PayPal, Enthix, Dollar, Account\">
		<meta name=\"author\" content=\"\">
		<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">

		<meta property=\"og:title\" content=\"iLoot.it\" />
		<meta property=\"og:type\" content=\"Reward farming\" />
		<meta property=\"og:image\" content=\"https://iloot.it/assets/images/banner.png\" />
		<meta property=\"og:description\" content=\"iLoot.it is an earnings platform desinged for gamers by gamers.\n get money by doing tasks to buy yourself a new game.\" />
		<meta property=\"og:site_name\" content=\"iLoot.it\" />
		<meta property=\"og:url\" content=\"https://www.iLoot.it\" />
		<meta name=\"twitter:image\" content=\"https://iloot.it/assets/images/banner.png\" />
		<meta name=\"twitter:title\" content=\"iLoot.it\" />
		<meta name=\"twitter:description\" content=\"iLoot.it is an earnings platform desinged for gamers, get money by doing tasks to buy yourself a new game.\" />
		<meta name=\"twitter:card\" content=\"summary_large_image\" />
		<meta name=\"twitter:site\" content=\"@maxw20001\" />
		<meta name=\"PreMiD_Presence\" content=\"Iloot.it\">
	";


	$imports = "

		<link rel=\"icon\" href=\"https://iloot.it/favicon.ico\" type=\"image/x-icon\" />

		<link rel=\"stylesheet\" href=\"/assets/css/animate.css\" />
		<link rel=\"stylesheet\" href=\"/assets/css/icomoon.css\" />
		<link rel=\"stylesheet\" href=\"/assets/css/bootstrap.css\" />
		<link rel=\"stylesheet\" href=\"/assets/css/magnific-popup.css\" />
		<link rel=\"stylesheet\" href=\"/assets/css/style.css\" />
		<link rel=\"stylesheet\" href=\"/assets/css/fonts.css\" />

		<script src=\"https://www.googletagmanager.com/gtag/js?id=UA-36777972-2\" async></script>
		<script src=\"/assets/js/modernizr-2.6.2.min.js\"></script>
		<script src=\"/assets/js/respond.min.js\"></script>
		<script src=\"https://hcaptcha.com/1/api.js\" async defer></script>
		<script src=\"//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5d9030afce5d2776\"></script>


		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'UA-36777972-2');
		</script>

	";




	$menu = "

	<li><a href=\"/\" title=\"How to get started\">Home</a></li>

	<li><a href=\"/partners\" title=\"Partners\">Partners</a></li>


	<!--
	<li class=\"has-dropdown\">
	<a style=\"cursor: pointer;\" title=\"Information\">Publishers</a>

	<ul class=\"dropdown\">
		<li><a href=\"/publishers/\" title=\"Information\">Information</a></li>
		<li><a href=\"/publishers/manage_advertising\" title=\"Manage advertising\">Manage advertising</a></li>
		<li><a href=\"/publishers/pricing\" title=\"Pricing\">Pricing</a></li>
		<li><a href=\"/helpcenter\" title=\"Help center\">Help center</a></li>
	</ul>
	</li> -->

	<li class=\"has-dropdown\">
		<a style=\"cursor: pointer;\" title=\"Account\">Account</a>
		<ul class=\"dropdown\">
			<li><a href=\"/login\" title=\"Login\">Login</a></li>
			<li><a href=\"/register\" title=\"Register\">Register</a></li>
		</ul>
	</li>
	";



	if(isset($_SESSION["email"])){

		$sql="SELECT * FROM members WHERE username='".$_SESSION["email"]."'";  // this line
		$rs=mysqli_query($con,$sql);
		$row=mysqli_fetch_array($rs);
		$count = mysqli_num_rows($rs);


		$points = $row["points"];
		$calc = $points/100000;
		$calc = round($calc, 4);

		if($count == 1){


			$menu = "

			<li><a href=\"/\" title=\"How to get started\">".$menu_home."</a></li>
			<li><a href=\"/partners\" title=\"Partners\">".$menu_partners."</a></li>


			<li class=\"has-dropdown\">
				<a style=\"cursor: pointer;\" title=\"Money\">Money</a>
				<ul class=\"dropdown\">

					<li style=\"color: white;\">".str_replace('[1]', $calc, $display_gems)."</li>

					<li><a href=\"/payout\" title=\"Payout\">".$menu_get_reward."</a></li>

					<li><a href=\"/watch_advertisements\" title=\"Watch advertisements\">Watch advertisements [⭐⭐⭐★★]</a></li>
					<li><a href=\"/minilinks\" title=\"minilinks\">MiniLinks [⭐⭐★★★]</a></li>
					<li><a href=\"/overlay\" title=\"OverLay\">OverLay [⭐⭐⭐★★]</a></li>
					<li><a href=\"/miner\" title=\"Miner\">Miner [⭐⭐⭐⭐★]</a></li>
					<li><a href=\"/pay/send\" title=\"Send a payment\">Send a payment</a></li>
					<li><a href=\"/tokens/\" title=\"Earn Tokens\">Earn Tokens</a></li>
				</ul>
			</li>



			<li class=\"has-dropdown\">
				<a style=\"cursor: pointer;\" title=\"Profile\">Account</a>
				<ul class=\"dropdown\">
					<li><a href=\"/profile\" title=\"Profile\">".$menu_profile."</a></li>
					<li><a href=\"/logout\" title=\"Logout\">".$menu_logout."</a></li>
				</ul>
			</li>


			";



			$menu = "

			<li><a href=\"/\" title=\"How to get started\">".$menu_home."</a></li>

			<li><a href=\"/partners\" title=\"Partners\">".$menu_partners."</a></li>

			<li class=\"has-dropdown\">
				<a style=\"cursor: pointer;\" title=\"Community\">Community</a>
				<ul class=\"dropdown\">
					<li><a href=\"/leaderboard\" title=\"leaderboard\">Leaderboard</a></li>
				</ul>
			</li>


			";

			if($permissions_see_tasks || $permissions_give_support || $permissions_translate || $permissions_manage_users) {

				$menu = $menu . "
				<li class=\"has-dropdown\">
					<a style=\"cursor: pointer;\" title=\"Staff\">staff</a>
					<ul class=\"dropdown\">
				";

				if($permissions_see_tasks) $menu = $menu . "<li><a href=\"/staff_tasks\" title=\"Tasks\">Tasks</a></li>";
				if($permissions_give_support) $menu = $menu . "<li><a href=\"/staff_support\" title=\"Support\">Support</a></li>";
				if($permissions_translate) $menu = $menu . "<li><a href=\"/staff_translate\" title=\"Translate\">Translate</a></li>";
				if($permissions_manage_users) $menu = $menu . "<li><a href=\"/staff_user_administration\" title=\"User administration\">User administration</a></li>";

				$menu = $menu . "

					</ul>
				</li>
				";
				

			}

			$menu = $menu . "
			<li class=\"has-dropdown\">
				<a style=\"cursor: pointer;\" title=\"Earnings\">" . $menu_make_gems . "</a>
				<ul class=\"dropdown\">
					<li><a title=\"balance\" style=\"cursor: default; color: #ffffff;\">" . $display_gems . ": $<b>" . $calc . "</b></a></li>
					<li><a href=\"/payout\" title=\"Payout\">".$menu_get_reward."</a></li>
					<li><a href=\"/captcha\" title=\"Fill Captcha\">".$menu_fill."</a></li>
					<li><a href=\"/watch_advertisements\" title=\"Watch advertisements\">" . $make_gems_watch_ads . "</a></li>
					<li><a href=\"/minilinks\" title=\"Minilinks\">" . $make_gems_minilinks . "</a></li>
                                        
				</ul>
			</li>



			<li class=\"has-dropdown\">
				<a style=\"cursor: pointer;\" title=\"Account\">".$profile_account."</a>
				<ul class=\"dropdown\">
					<li><a href=\"/profile\" title=\"Profile\">".$menu_profile."</a></li>
					<li><a href=\"/logout\" title=\"Logout\">".$menu_logout."</a></li>
				</ul>
			</li>


			";




		}
	}



$footer = "
<footer id=\"colorlib-footer\">
<div class=\"container\">
<div class=\"row row-pb-md\">
<div class=\"col-md-3 colorlib-widget\">
<h4>About ".$name."</h4>
<p>We want to help people who need or want some quick change. So we came up with the idea to let people watch advertisements for money. iLoot.it was created to earn money faster then other sites, without any of the hassle.</p>
</div>
<div class=\"col-md-3 colorlib-widget\">
<h4>Important links</h4>

<ul class=\"colorlib-footer-links\">
<li><a href=\"https://iloot.it/terms\" title=\"Twitter\">&bull; Terms of Service</a></li>
<li><a href=\"https://iloot.it/privacy\" title=\"Discord\">&bull; Privacy Policy</a></li>
<li><a href=\"https://discordapp.com/invite/XYRWhw\" title=\"Discord\">&bull; Support Discord</a></li>
</ul>
</div>
<div class=\"col-md-3 colorlib-widget\">
<h4>Recent updates</h4>

<div class=\"desc\">
<p class=\"admin\"><span>In the section below this we will let you know all the latest updates and when it updated(DD/MM/YYYY)</span></p>
</div>








<div class=\"desc\">
<p class=\"admin\"><span>10/01/2021: Fixed issues with certificates.</span></p>
<p class=\"admin\"><span>01/12/2019: Updated the text on the home page.</span></p>
<p class=\"admin\"><span>30/11/2019: Changed menu layout</span></p>
<p class=\"admin\"><span>29/11/2019: Fixed the remember me button/payout screen + changed register and login.</span></p>
</div>








</div>
<div class=\"col-md-3 colorlib-widget\">
<h4>Contact Info</h4>
<ul class=\"colorlib-footer-links\">
<li>If you need contact with us you can always join our discord.</li>
<li>Click <a href=\"https://discordapp.com/invite/XYRWhw\" title=\"Discord\">here</a> to go to our Discord server.</li>
</ul>
</div>
<br>
<div class=\"col-md-3 colorlib-widget\">
<ul class=\"colorlib-footer-links\">
<h4>Theme [BETA]</h4>
<label class=\"switch\">
  <input type=\"checkbox\">
  <span id=\"theme-button\" class=\"slider round\"></span>
</label>
</ul>
</div>
</div>
</div>
<div class=\"copy\">
<div class=\"container\">
<div class=\"row\">
<div class=\"col-md-12 text-center\">
<p>Copyright &copy;".date("Y")." MVDW All rights reserved.</p>
</div>
</div>
</div>
</div>
</footer>




";



?>
