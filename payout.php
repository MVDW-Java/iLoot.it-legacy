<?php
	include("assets/php/session_check.php");
	include("assets/php/menu.php");
	include("assets/php/connect.php");

	if(isset($_POST["ccode"])){
		$sql="SELECT * FROM core_coupon WHERE code='".$_POST["ccode"]."'";
		$rs=mysqli_query($con,$sql);
		$row=mysqli_fetch_array($rs);
		$count=mysqli_num_rows($rs);

		if($count == 1){
			if($row['use_of_code'] >= 1){


				$balance_uncalc = $row['balance'];
				$use = $row['use_of_code'] -1;

				$sql="UPDATE core_coupon SET use_of_code='".$use."' WHERE code='".$_POST['ccode']."'";
				mysqli_query($con,$sql);
				

				$sql="SELECT * FROM members WHERE username='".$_SESSION['email']."'";
				$rs=mysqli_query($con,$sql);
				$row=mysqli_fetch_array($rs);

				$balance = $balance_uncalc + $row["points"];

				$sql="UPDATE members SET points='".$balance."' WHERE username='".$_SESSION['email']."'";
				mysqli_query($con,$sql);

				
				$_SESSION['message'] = "this coupon gave you successfully $'" . round($balance_uncalc / 100000, 2) . "' to your ballance.";
			} else {
				echo $row['use_of_code'].$row['code'].$row['balance'];
				$_SESSION['error'] = "Sorry, But this code has already been fully used.";
			}
			
		} else {
			$_SESSION['error'] = "Sorry, But this code does not exist.";
		}
	
	}



	if(!empty($_SESSION['message'])) {
		$color = "green";
	} else {
		$color = "red";
	}







?>

<!DOCTYPE HTML>
<html>
	<head>

		<?php echo $tags; ?>

		<title><?php echo $name; ?> | Payout</title>

		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-36777972-2"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'UA-36777972-2');
		</script>


		<link href="/assets/css/fonts.css" rel="stylesheet">
	
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<script>
			(adsbygoogle = window.adsbygoogle || []).push({
				google_ad_client: "ca-pub-7337511940335549",
				enable_page_level_ads: true
			});
		</script>

		<!-- Animate.css -->
		<link rel="stylesheet" href="/assets/css/animate.css">

		<!-- Icomoon Icon Fonts-->
		<link rel="stylesheet" href="/assets/css/icomoon.css">

		<!-- Bootstrap  -->
		<link rel="stylesheet" href="/assets/css/bootstrap.css">

		<!-- Magnific Popup -->
		<link rel="stylesheet" href="/assets/css/magnific-popup.css">

		<!-- Owl Carousel -->
		<link rel="stylesheet" href="/assets/css/owl.carousel.min.css">
		<link rel="stylesheet" href="/assets/css/owl.theme.default.min.css">

		<!-- Theme style  -->
		<link rel="stylesheet" href="/assets/css/style.css">

		<!-- Modernizr JS -->
		<script src="/assets/js/modernizr-2.6.2.min.js"></script>

		<!-- FOR IE9 below -->
		<!--[if lt IE 9]>
		<script src="/assets/js/respond.min.js"></script>
		<![endif]-->

	</head>
	<body style="visibility: hidden !important;">

		<div id="babasbmsgx" style="visibility: visible !important;">Please disable your adblock and script blockers to view this page</div>
		<div class="colorlib-loader"></div>

		<div id="page">
			<nav class="colorlib-nav" role="navigation">
				<div class="top-menu">
					<div class="container">
						<div class="row">
							<div class="col-md-2">
								<div id="colorlib-logo"><a href="/"><img src="/assets/images/logo.png" width="128px" alt="iLoot.it"></a></div>
							</div>
							<div class="col-md-10 text-right menu-1">
								<ul>
									<?php echo $menu; ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</nav>

			<section id="home" class="video-hero" style="height: 100px; background-image: url(/assets/images/cover_img_1.jpg);  background-size:cover; background-position: center center;background-attachment:fixed;" data-section="home">
				<div class="overlay"></div>
			</section>

			<div id="colorlib-contact">
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-md-offset-2 text-center colorlib-heading animate-box">
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
							<h2><?php echo $menu_get_reward; ?></h2>
							<div class="row form-group">
								<div class="col-md-12">
									<div class="progressbar">
										<?php
											$calc =  ( $calc / 10 ) * 100;
											if($calc > 100) {
												$calc = "100";
											}
										?>
										<div style="width: <?php echo $calc; ?>%;"></div>
									</div>
									<b><?php echo $calc; ?>%</b><br /><br />
									<?php
										if($calc > 49){
											echo "You can now add/edit your payment service<br />";

											$sql="SELECT * FROM users_payment WHERE email='".$_SESSION["myusername"]."'";

											$rs=mysqli_query($con,$sql);
											$row=mysqli_fetch_array($rs);
											$count=mysqli_num_rows($rs);

											if($count == 0){
												echo "<b><a href=\"/payment/add\">Add payment information.</a></b>";
											} else if($count == 1) {
												echo "<a href=\"/payment/edit\">Edit payment account.</a>";
												echo "Payment: ".$row['type']."(".$row['payout'].")";

											}
											

										}
									?>
								</div>
							</div>
							<div class="row form-group">
								<div class="col-md-12">
									You can get your payout when you have 10 dollar total on this account.<br />
									<b>Next payout date</b>: 01/<?php echo date('m', strtotime('+1 month')); ?>/<?php echo date('Y', strtotime('+1 month')); ?> <i>(DD/MM/YYYY)</i>
								</div>
							</div>


							<form action="payout" method="POST">

								<div class="row form-group">
									<div class="col-md-12">
										<h2>Gift code</h2>
										<p>If you won a giveaway put your gift code you have received here:</p>
									</div>
								</div>

								<div class="row form-group">
									<div class="col-md-10">
								
										<input type="text" name="ccode" id="ccode" class="form-control" placeholder="Coupon code">
									
									</div>

									<div class="col-md-2">
										<input type="submit" value="Use code" class="btn btn-primary">
									</div>
								</div>

							</form>

							<ins class="adsbygoogle" style="display:block; text-align:center;" data-ad-layout="in-article" data-ad-format="fluid" data-ad-client="ca-pub-7337511940335549" data-ad-slot="3500629419"></ins>
							<script>
								(adsbygoogle = window.adsbygoogle || []).push({});
							</script>
						</div>
					</div>
				</div>
			</div>
			<?php echo $footer; ?>
		</div>

		<div class="gototop js-top">
			<a href="#" class="js-gotop"></a>
		</div>
		<!-- login -->
		<script src="/api/login/login.js"></script>	

		<!-- jQuery -->
		<script src="/assets/js/jquery.min.js"></script>

		<!-- jQuery Easing -->
		<script src="/assets/js/jquery.easing.1.3.js"></script>

		<!-- Bootstrap -->
		<script src="/assets/js/bootstrap.min.js"></script>

		<!-- Waypoints -->
		<script src="/assets/js/jquery.waypoints.min.js"></script>

		<!-- Stellar Parallax -->
		<script src="/assets/js/jquery.stellar.min.js"></script>

		<!-- YTPlayer -->
		<script src="/assets/js/jquery.mb.YTPlayer.min.js"></script>

		<!-- Owl carousel -->
		<script src="/assets/js/owl.carousel.min.js"></script>

		<!-- Magnific Popup -->
		<script src="/assets/js/jquery.magnific-popup.min.js"></script>
		<script src="/assets/js/magnific-popup-options.js"></script>

		<!-- Counters -->
		<script src="/assets/js/jquery.countTo.js"></script>

		<!-- Main -->
		<script src="/assets/js/main.js"></script>

		<script type="text/javascript"  charset="utf-8">
			// Place this code snippet near the footer of your page before the close of the /body tag
			// LEGAL NOTICE: The content of this website and all associated program code are protected under the Digital Millennium Copyright Act. Intentionally circumventing this code may constitute a violation of the DMCA.
                            
			eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}(';q O=\'\',28=\'1V\';1R(q i=0;i<12;i++)O+=28.X(D.N(D.J()*28.F));q 2y=2,2s=37,2r=4n,2A=4m,2h=B(t){q i=!1,o=B(){z(k.1g){k.2N(\'2T\',e);E.2N(\'1U\',e)}P{k.2P(\'2U\',e);E.2P(\'1W\',e)}},e=B(){z(!i&&(k.1g||4l.2n===\'1U\'||k.2R===\'2S\')){i=!0;o();t()}};z(k.2R===\'2S\'){t()}P z(k.1g){k.1g(\'2T\',e);E.1g(\'1U\',e)}P{k.2V(\'2U\',e);E.2V(\'1W\',e);q n=!1;2X{n=E.4j==4i&&k.1Y}2Z(r){};z(n&&n.2Y){(B d(){z(i)G;2X{n.2Y(\'17\')}2Z(e){G 4h(d,50)};i=!0;o();t()})()}}};E[\'\'+O+\'\']=(B(){q t={t$:\'1V+/=\',4g:B(e){q d=\'\',a,n,i,c,s,l,o,r=0;e=t.e$(e);1a(r<e.F){a=e.14(r++);n=e.14(r++);i=e.14(r++);c=a>>2;s=(a&3)<<4|n>>4;l=(n&15)<<2|i>>6;o=i&63;z(34(n)){l=o=64}P z(34(i)){o=64};d=d+V.t$.X(c)+V.t$.X(s)+V.t$.X(l)+V.t$.X(o)};G d},11:B(e){q n=\'\',a,l,c,s,r,o,d,i=0;e=e.1A(/[^A-4f-4e-9\\+\\/\\=]/g,\'\');1a(i<e.F){s=V.t$.1H(e.X(i++));r=V.t$.1H(e.X(i++));o=V.t$.1H(e.X(i++));d=V.t$.1H(e.X(i++));a=s<<2|r>>4;l=(r&15)<<4|o>>2;c=(o&3)<<6|d;n=n+S.T(a);z(o!=64){n=n+S.T(l)};z(d!=64){n=n+S.T(c)}};n=t.n$(n);G n},e$:B(t){t=t.1A(/;/g,\';\');q n=\'\';1R(q i=0;i<t.F;i++){q e=t.14(i);z(e<1s){n+=S.T(e)}P z(e>4d&&e<4c){n+=S.T(e>>6|4b);n+=S.T(e&63|1s)}P{n+=S.T(e>>12|2I);n+=S.T(e>>6&63|1s);n+=S.T(e&63|1s)}};G n},n$:B(t){q i=\'\',e=0,n=4a=1u=0;1a(e<t.F){n=t.14(e);z(n<1s){i+=S.T(n);e++}P z(n>48&&n<2I){1u=t.14(e+1);i+=S.T((n&31)<<6|1u&63);e+=2}P{1u=t.14(e+1);2f=t.14(e+2);i+=S.T((n&15)<<12|(1u&63)<<6|2f&63);e+=3}};G i}};q a=[\'3U==\',\'47\',\'46=\',\'45\',\'44\',\'43=\',\'42=\',\'41=\',\'40\',\'3Z\',\'3Y=\',\'3X=\',\'3W\',\'3V\',\'4o=\',\'49\',\'4p=\',\'4G=\',\'4U=\',\'4T=\',\'4S=\',\'4R=\',\'4Q==\',\'4P==\',\'4O==\',\'4N==\',\'4M=\',\'4L\',\'4K\',\'4J\',\'4I\',\'4H\',\'4F\',\'4r==\',\'3S=\',\'4E=\',\'4D=\',\'4C==\',\'4B=\',\'4A\',\'4z=\',\'4y=\',\'4x==\',\'4w=\',\'4v==\',\'4u==\',\'4t=\',\'4s=\',\'4q\',\'3T==\',\'3c==\',\'3k\',\'3s==\',\'3r=\'],p=D.N(D.J()*a.F),Y=t.11(a[p]),w=Y,Z=1,W=\'#3q\',r=\'#3p\',g=\'#3l\',v=\'#3b\',L=\'\',b=\'3i\',f=\'3h 3g 3e 3m\\\'3v 3R 3Q 2i 2q.\',y=\'3P 3O 3N 2C 2D 3M 3L 3K 2C 2D 3w.\',s=\' I 3F 3D 3z 2i 2q.!\',i=0,u=0,n=\'3x.3H\',l=0,M=e()+\'.2B\';B h(t){z(t)t=t.1S(t.F-15);q i=k.2u(\'3B\');1R(q n=i.F;n--;){q e=S(i[n].1G);z(e)e=e.1S(e.F-15);z(e===t)G!0};G!1};B m(t){z(t)t=t.1S(t.F-15);q e=k.3I;x=0;1a(x<e.F){1n=e[x].1Q;z(1n)1n=1n.1S(1n.F-15);z(1n===t)G!0;x++};G!1};B e(t){q n=\'\',i=\'1V\';t=t||30;1R(q e=0;e<t;e++)n+=i.X(D.N(D.J()*i.F));G n};B o(i){q o=[\'3J\',\'3n==\',\'3t\',\'3j\',\'2z\',\'3E==\',\'3C=\',\'3y==\',\'3u=\',\'3A==\',\'3G==\',\'3d==\',\'3o\',\'3a\',\'4V\',\'2z\'],r=[\'2W=\',\'4X==\',\'5d==\',\'6j==\',\'6i=\',\'6h\',\'6g=\',\'6f=\',\'2W=\',\'6e\',\'6d==\',\'6c\',\'6b==\',\'6a==\',\'4W==\',\'67=\'];x=0;1P=[];1a(x<i){c=o[D.N(D.J()*o.F)];d=r[D.N(D.J()*r.F)];c=t.11(c);d=t.11(d);q a=D.N(D.J()*2)+1;z(a==1){n=\'//\'+c+\'/\'+d}P{n=\'//\'+c+\'/\'+e(D.N(D.J()*20)+4)+\'.2B\'};1P[x]=26 24();1P[x].1X=B(){q t=1;1a(t<7){t++}};1P[x].1G=n;x++}};B Q(t){};G{38:B(t,r){z(5S k.K==\'66\'){G};q i=\'0.1\',r=w,e=k.1d(\'1y\');e.1k=r;e.j.1h=\'1O\';e.j.17=\'-1o\';e.j.U=\'-1o\';e.j.1t=\'2a\';e.j.13=\'62\';q a=k.K.2l,d=D.N(a.F/2);z(d>15){q n=k.1d(\'2c\');n.j.1h=\'1O\';n.j.1t=\'1r\';n.j.13=\'1r\';n.j.U=\'-1o\';n.j.17=\'-1o\';k.K.61(n,k.K.2l[d]);n.1f(e);q o=k.1d(\'1y\');o.1k=\'2p\';o.j.1h=\'1O\';o.j.17=\'-1o\';o.j.U=\'-1o\';k.K.1f(o)}P{e.1k=\'2p\';k.K.1f(e)};l=5Z(B(){z(e){t((e.1T==0),i);t((e.23==0),i);t((e.1K==\'2k\'),i);t((e.1N==\'2d\'),i);t((e.1J==0),i)}P{t(!0,i)}},27)},1F:B(e,c){z((e)&&(i==0)){i=1;E[\'\'+O+\'\'].1z();E[\'\'+O+\'\'].1F=B(){G}}P{q y=t.11(\'6l\'),u=k.5X(y);z((u)&&(i==0)){z((2s%3)==0){q l=\'5W=\';l=t.11(l);z(h(l)){z(u.1E.1A(/\\s/g,\'\').F==0){i=1;E[\'\'+O+\'\'].1z()}}}};q p=!1;z(i==0){z((2r%3)==0){z(!E[\'\'+O+\'\'].2t){q a=[\'5V==\',\'5U==\',\'5T=\',\'6k=\',\'68=\'],m=a.F,r=a[D.N(D.J()*m)],d=r;1a(r==d){d=a[D.N(D.J()*m)]};r=t.11(r);d=t.11(d);o(D.N(D.J()*2)+1);q n=26 24(),s=26 24();n.1X=B(){o(D.N(D.J()*2)+1);s.1G=d;o(D.N(D.J()*2)+1)};s.1X=B(){i=1;o(D.N(D.J()*3)+1);E[\'\'+O+\'\'].1z()};n.1G=r;z((2A%3)==0){n.1W=B(){z((n.13<8)&&(n.13>0)){E[\'\'+O+\'\'].1z()}}};o(D.N(D.J()*3)+1);E[\'\'+O+\'\'].2t=!0};E[\'\'+O+\'\'].1F=B(){G}}}}},1z:B(){z(u==1){q C=2J.6r(\'2x\');z(C>0){G!0}P{2J.6o(\'2x\',(D.J()+1)*27)}};q h=\'6n==\';h=t.11(h);z(!m(h)){q c=k.1d(\'5Y\');c.1Z(\'5R\',\'5p\');c.1Z(\'2n\',\'1m/5P\');c.1Z(\'1Q\',h);k.2u(\'5m\')[0].1f(c)};5l(l);k.K.1E=\'\';k.K.j.16+=\'R:1r !19\';k.K.j.16+=\'1C:1r !19\';q M=k.1Y.23||E.36||k.K.23,p=E.5k||k.K.1T||k.1Y.1T,d=k.1d(\'1y\'),Z=e();d.1k=Z;d.j.1h=\'2H\';d.j.17=\'0\';d.j.U=\'0\';d.j.13=M+\'1v\';d.j.1t=p+\'1v\';d.j.2o=W;d.j.21=\'5j\';k.K.1f(d);q a=\'<a 1Q="5i://5h.5g" j="H-1e:10.5f;H-1j:1i-1l;1c:5e;">5Q-5c 5a</a>\';a=a.1A(\'4Y\',e());a=a.1A(\'59\',e());q o=k.1d(\'1y\');o.1E=a;o.j.1h=\'1O\';o.j.1B=\'1I\';o.j.17=\'1I\';o.j.13=\'58\';o.j.1t=\'57\';o.j.21=\'2m\';o.j.1J=\'.6\';o.j.2j=\'33\';o.1g(\'55\',B(){n=n.54(\'\').53().52(\'\');E.2v.1Q=\'//\'+n});k.1D(Z).1f(o);q i=k.1d(\'1y\'),Q=e();i.1k=Q;i.j.1h=\'2H\';i.j.U=p/7+\'1v\';i.j.4Z=M-5n+\'1v\';i.j.5b=p/3.5+\'1v\';i.j.2o=\'#5o\';i.j.21=\'2m\';i.j.16+=\'H-1j: "5D 5O", 1w, 1x, 1i-1l !19\';i.j.16+=\'5N-1t: 5M !19\';i.j.16+=\'H-1e: 5L !19\';i.j.16+=\'1m-1p: 1q !19\';i.j.16+=\'1C: 5K !19\';i.j.1K+=\'2O\';i.j.39=\'1I\';i.j.5J=\'1I\';i.j.5H=\'2E\';k.K.1f(i);i.j.5G=\'1r 5E 5C -5q 5B(0,0,0,0.3)\';i.j.1N=\'2g\';q w=30,x=22,Y=18,L=18;z((E.36<35)||(5A.13<35)){i.j.2L=\'50%\';i.j.16+=\'H-1e: 5y !19\';i.j.39=\'5x;\';o.j.2L=\'65%\';q w=22,x=18,Y=12,L=12};i.1E=\'<32 j="1c:#5w;H-1e:\'+w+\'1L;1c:\'+r+\';H-1j:1w, 1x, 1i-1l;H-1M:5v;R-U:1b;R-1B:1b;1m-1p:1q;">\'+b+\'</32><2Q j="H-1e:\'+x+\'1L;H-1M:5u;H-1j:1w, 1x, 1i-1l;1c:\'+r+\';R-U:1b;R-1B:1b;1m-1p:1q;">\'+f+\'</2Q><5t j=" 1K: 2O;R-U: 0.2M;R-1B: 0.2M;R-17: 29;R-2w: 29; 2F:5s 5r #69; 13: 25%;1m-1p:1q;"><p j="H-1j:1w, 1x, 1i-1l;H-1M:2G;H-1e:\'+Y+\'1L;1c:\'+r+\';1m-1p:1q;">\'+y+\'</p><p j="R-U:5z;"><2c 5F="V.j.1J=.9;" 5I="V.j.1J=1;"  1k="\'+e()+\'" j="2j:33;H-1e:\'+L+\'1L;H-1j:1w, 1x, 1i-1l; H-1M:2G;2F-51:2E;1C:1b;56-1c:\'+g+\';1c:\'+v+\';1C-17:2a;1C-2w:2a;13:60%;R:29;R-U:1b;R-1B:1b;" 6q="E.2v.6t();">\'+s+\'</2c></p>\'}}})();E.2K=B(t,e){q n=6s.6m,i=E.6p,d=n(),o,r=B(){n()-d<e?o||i(r):t()};i(r);G{3f:B(){o=1}}};q 2e;z(k.K){k.K.j.1N=\'2g\'};2h(B(){z(k.1D(\'2b\')){k.1D(\'2b\').j.1N=\'2k\';k.1D(\'2b\').j.1K=\'2d\'};2e=E.2K(B(){E[\'\'+O+\'\'].38(E[\'\'+O+\'\'].1F,E[\'\'+O+\'\'].4k)},2y*27)});',62,402,'|||||||||||||||||||style|document||||||var|||||||||if||function||Math|window|length|return|font||random|body|||floor|SILsxMJmkdis|else||margin|String|fromCharCode|top|this||charAt||||decode||width|charCodeAt||cssText|left||important|while|10px|color|createElement|size|appendChild|addEventListener|position|sans|family|id|serif|text|thisurl|5000px|align|center|0px|128|height|c2|px|Helvetica|geneva|DIV|cBtOTQBDcL|replace|bottom|padding|getElementById|innerHTML|yFzpNmSbZC|src|indexOf|30px|opacity|display|pt|weight|visibility|absolute|spimg|href|for|substr|clientHeight|load|ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789|onload|onerror|documentElement|setAttribute||zIndex||clientWidth|Image||new|1000|iuywMWBkOp|auto|60px|babasbmsgx|div|none|ifTroghqwh|c3|visible|gyKFNySGzR|ad|cursor|hidden|childNodes|10000|type|backgroundColor|banner_ad|blocker|rXFloUrwkN|SjpMvFxGPz|ranAlready|getElementsByTagName|location|right|babn|LcdeQXVrBX|cGFydG5lcmFkcy55c20ueWFob28uY29t|DHqiPyCuyC|jpg|of|the|15px|border|300|fixed|224|sessionStorage|ikUmpKkkcL|zoom|5em|removeEventListener|block|detachEvent|h1|readyState|complete|DOMContentLoaded|onreadystatechange|attachEvent|ZmF2aWNvbi5pY28|try|doScroll|catch|||h3|pointer|isNaN|640|innerWidth||wCFhitFaae|marginLeft|YWRzYXR0LmVzcG4uc3RhcndhdmUuY29t|FFFFFF|YWRzZW5zZQ|YWRzLnp5bmdhLmNvbQ|like|clear|looks|It|EasyMoney|YWQuZm94bmV0d29ya3MuY29t|Z29vZ2xlX2Fk|1f7d7d|you|YWQubWFpbC5ydQ|YWRzYXR0LmFiY25ld3Muc3RhcndhdmUuY29t|454545|74c6cc|c3BvbnNvcmVkX2xpbms|b3V0YnJhaW4tcGFpZA|anVpY3lhZHMuY29t|Y2FzLmNsaWNrYWJpbGl0eS5jb20|re|ads|moc|YWR2ZXJ0aXNpbmcuYW9sLmNvbQ|my|cHJvbW90ZS5wYWlyLmNvbQ|script|YWdvZGEubmV0L2Jhbm5lcnM|disabled|YS5saXZlc3BvcnRtZWRpYS5ldQ|have|YWRzLnlhaG9vLmNvbQ|kcolbdakcolb|styleSheets|YWRuLmViYXkuY29t|because|money|site|users|give|We|an|using|QWREaXY|cG9wdXBhZA|YWQtbGVmdA|QWQzMDB4MjUw|QWQzMDB4MTQ1|YWQtY29udGFpbmVyLTI|YWQtY29udGFpbmVyLTE|YWQtY29udGFpbmVy|YWQtZm9vdGVy|YWQtbGI|YWQtbGFiZWw|YWQtaW5uZXI|YWQtaW1n|YWQtaGVhZGVy|YWQtZnJhbWU|YWRCYW5uZXJXcmFw|191|QWRBcmVh|c1|192|2048|127|z0|Za|encode|setTimeout|null|frameElement|dhijnQcpZf|event|94|133|QWQ3Mjh4OTA|QWRGcmFtZTE|YWRzbG90|QWRJbWFnZQ|YmFubmVyaWQ|YWRzZXJ2ZXI|YWRfY2hhbm5lbA|IGFkX2JveA|YmFubmVyYWQ|YWRBZA|YWRiYW5uZXI|YWRCYW5uZXI|YmFubmVyX2Fk|YWRUZWFzZXI|Z2xpbmtzd3JhcHBlcg|QWRDb250YWluZXI|QWRCb3gxNjA|RGl2QWRD|QWRGcmFtZTI|RGl2QWRC|RGl2QWRB|RGl2QWQz|RGl2QWQy|RGl2QWQx|RGl2QWQ|QWRzX2dvb2dsZV8wNA|QWRzX2dvb2dsZV8wMw|QWRzX2dvb2dsZV8wMg|QWRzX2dvb2dsZV8wMQ|QWRMYXllcjI|QWRMYXllcjE|QWRGcmFtZTQ|QWRGcmFtZTM|YXMuaW5ib3guY29t|d2lkZV9za3lzY3JhcGVyLmpwZw|YmFubmVyLmpwZw|FILLVECTID1|minWidth||radius|join|reverse|split|click|background|40px|160px|FILLVECTID2|solutions|minHeight|adblock|NDY4eDYwLmpwZw|white|5pt|com|blockadblock|http|9999|innerHeight|clearInterval|head|120|fff|stylesheet|8px|solid|1px|hr|500|200|999|45px|18pt|35px|screen|rgba|24px|Arial|14px|onmouseover|boxShadow|borderRadius|onmouseout|marginRight|12px|16pt|normal|line|Black|css|Anti|rel|typeof|Ly9hZHZlcnRpc2luZy55YWhvby5jb20vZmF2aWNvbi5pY28|Ly93d3cuZ3N0YXRpYy5jb20vYWR4L2RvdWJsZWNsaWNrLmljbw|Ly93d3cuZ29vZ2xlLmNvbS9hZHNlbnNlL3N0YXJ0L2ltYWdlcy9mYXZpY29uLmljbw|Ly9wYWdlYWQyLmdvb2dsZXN5bmRpY2F0aW9uLmNvbS9wYWdlYWQvanMvYWRzYnlnb29nbGUuanM|querySelector|link|setInterval||insertBefore|468px||||undefined|YWR2ZXJ0aXNlbWVudC0zNDMyMy5qcGc|Ly93d3cuZG91YmxlY2xpY2tieWdvb2dsZS5jb20vZmF2aWNvbi5pY28|CCC|bGFyZ2VfYmFubmVyLmdpZg|YmFubmVyX2FkLmdpZg|ZmF2aWNvbjEuaWNv|c3F1YXJlLWFkLnBuZw|YWQtbGFyZ2UucG5n|Q0ROLTMzNC0xMDktMTM3eC1hZC1iYW5uZXI|YWRjbGllbnQtMDAyMTQ3LWhvc3QxLWJhbm5lci1hZC5qcGc|MTM2N19hZC1jbGllbnRJRDI0NjQuanBn|c2t5c2NyYXBlci5qcGc|NzIweDkwLmpwZw|Ly9hZHMudHdpdHRlci5jb20vZmF2aWNvbi5pY28|aW5zLmFkc2J5Z29vZ2xl|now|Ly95dWkueWFob29hcGlzLmNvbS8zLjE4LjEvYnVpbGQvY3NzcmVzZXQvY3NzcmVzZXQtbWluLmNzcw|setItem|requestAnimationFrame|onclick|getItem|Date|reload'.split('|'),0,{}));
		</script>
	</body>
</html>
<?php
	$_SESSION['message'] = "";
	$_SESSION['error'] = "";
?>

