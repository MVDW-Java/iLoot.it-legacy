<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}


include("connect.php");

$sql="SELECT * FROM members WHERE username='".$_SESSION["myusername"]."'";
$rs=mysqli_query($con,$sql);
$row=mysqli_fetch_array($rs);


$type = $_GET['window'];
if($type == 1){

echo "<center><h1>You have ".$row['points']." points</h1></center>";
} else if($type == 2){
header('Refresh: 10;url=addpoints.php');


if(!empty($_GET['message'])){
echo "<p style=\"color: red\">" . $_GET['message'] . "</p>";
}



echo "
<script async src=\"//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({
          google_ad_client: \"ca-pub-7337511940335549\",
          enable_page_level_ads: true
     });
</script>
";
echo "
<ins class=\"adsbygoogle\"
     style=\"display:block; text-align:center;\"
     data-ad-layout=\"in-article\"
     data-ad-format=\"fluid\"
     data-ad-client=\"ca-pub-7337511940335549\"
     data-ad-slot=\"3500629419\"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
";
echo "
<ins class=\"adsbygoogle\"
     style=\"display:block; text-align:center;\"
     data-ad-layout=\"in-article\"
     data-ad-format=\"fluid\"
     data-ad-client=\"ca-pub-7337511940335549\"
     data-ad-slot=\"3500629419\"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
";

echo "
<ins class=\"adsbygoogle\"
     style=\"display:block; text-align:center;\"
     data-ad-layout=\"in-article\"
     data-ad-format=\"fluid\"
     data-ad-client=\"ca-pub-7337511940335549\"
     data-ad-slot=\"3500629419\"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
";

echo "
<ins class=\"adsbygoogle\"
     style=\"display:block; text-align:center;\"
     data-ad-layout=\"in-article\"
     data-ad-format=\"fluid\"
     data-ad-client=\"ca-pub-7337511940335549\"
     data-ad-slot=\"3500629419\"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
";

echo "
<ins class=\"adsbygoogle\"
     style=\"display:block; text-align:center;\"
     data-ad-layout=\"in-article\"
     data-ad-format=\"fluid\"
     data-ad-client=\"ca-pub-7337511940335549\"
     data-ad-slot=\"3500629419\"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
";

} else if($type == 3){


echo "
<html>
<body>
<br />
<script async src=\"//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>
<ins class=\"adsbygoogle\"
     style=\"display:block; text-align:center;\"
     data-ad-layout=\"in-article\"
     data-ad-format=\"fluid\"
     data-ad-client=\"ca-pub-7337511940335549\"
     data-ad-slot=\"3500629419\"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
<ins class=\"adsbygoogle\"
     style=\"display:block; text-align:center;\"
     data-ad-layout=\"in-article\"
     data-ad-format=\"fluid\"
     data-ad-client=\"ca-pub-7337511940335549\"
     data-ad-slot=\"3500629419\"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>

</body>
</html>
";

} else {
echo "ERROR: NO WINDOW FOUNDED!!!<br />Please report if this is a bug under normal use!";
}

?>