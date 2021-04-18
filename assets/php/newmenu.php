<?php
include("connect.php");
include("translate.php");

$sql="SELECT * FROM members WHERE username='".$_SESSION["myusername"]."'";
$rs=mysqli_query($con,$sql);
$row=mysqli_fetch_array($rs);

$points = $row["points"];
$calc = $points/100000;
$calc = round($calc, 4);


if(!isset($_SESSION["myusername"]) ){
$menu = "<li class=\"nav-item\"><a href=\"/new\" title=\"How to get started\" class=\"nav-link\" role=\"button\"><span class=\"nav-link-inner--text\">Home</span></a></li>

<li class=\"nav-item\"><a href=\"/new/partners\" title=\"Partners\" class=\"nav-link\" role=\"button\"><span class=\"nav-link-inner--text\">Partners</span></a></li>

<li class=\"nav-item dropdown\">
<a class=\"nav-link\" data-toggle=\"dropdown\" role=\"button\">
<i class=\"ni ni-collection d-lg-none\"></i>
<span class=\"nav-link-inner--text\">Developers</span>
</a>
<div class=\"dropdown-menu\">
<a href=\"/new/developers\" title=\"Information\" class=\"dropdown-item\">Information</a>
<a href=\"/new/developers/verification\" title=\"Verification\" class=\"dropdown-item\">Verification</a>
<a href=\"/new/developers/docs\" title=\"Documentation\" class=\"dropdown-item\">Documentation</a>
<a href=\"/new/developers/projects\" title=\"Manage Projects\" class=\"dropdown-item\">Manage Projects</a>
</div>
</li>

<li class=\"nav-item dropdown\">
<a class=\"nav-link\" data-toggle=\"dropdown\" role=\"button\">
<i class=\"ni ni-collection d-lg-none\"></i>
<span class=\"nav-link-inner--text\">Account</span>
</a>
<div class=\"dropdown-menu\">
<a href=\"/login\" title=\"Login\" class=\"dropdown-item\">Login</a>
<a href=\"/register\" title=\"Register\" class=\"dropdown-item\">Register</a>
<a href=\"/faq\" title=\"Help Center\" class=\"dropdown-item\">Help Center</a>
</div>
</li>";
} else {
$menu = "<li class=\"nav-item\"><a href=\"/new\" title=\"How to get started\" class=\"nav-link\" role=\"button\"><span class=\"nav-link-inner--text\">".$menu_home."</span></a></li>

<li class=\"nav-item\"><a href=\"/new/partners\" title=\"Partners\" class=\"nav-link\" role=\"button\"><span class=\"nav-link-inner--text\">Partners</span></a></li>

<li class=\"nav-item dropdown\">
<a class=\"nav-link\" data-toggle=\"dropdown\" role=\"button\">
<i class=\"ni ni-collection d-lg-none\"></i>
<span class=\"nav-link-inner--text\">Money</span>
</a>
<div class=\"dropdown-menu\">
<li style=\"color: white;\">".str_replace('[1]', $calc, $display_gems)."</li>

<a href=\"/payout\" title=\"Payout\" class=\"dropdown-item\">".$menu_get_reward."</a>

<a href=\"/watch_advertisements\" title=\"Advertisements\" class=\"dropdown-item\">Watch Advertisements [⭐⭐⭐★★]</a>
<a href=\"/minilinks\" title=\"Minilinks\" class=\"dropdown-item\">MiniLinks [⭐⭐★★★]</a>
<a href=\"/overlay\" title=\"OverLay\" class=\"dropdown-item\">OverLay [⭐⭐⭐★★]</a>
<a href=\"/miner\" title=\"Miner\" class=\"dropdown-item\">Miner [⭐⭐⭐⭐★]</a>
<a href=\"/pay/send\" title=\"Send a payment\" class=\"dropdown-item\">Send a payment</a>
<a href=\"/tokens\" title=\"Earn Tokens\" class=\"dropdown-item\">Earn Tokens</a>
</div>
</li>

<li class=\"nav-item dropdown\">
<a class=\"nav-link\" data-toggle=\"dropdown\" role=\"button\">
<i class=\"ni ni-collection d-lg-none\"></i>
<span class=\"nav-link-inner--text\">Account</span>
</a>
<div class=\"dropdown-menu\">
<a href=\"/profile\" title=\"Profile\" class=\"dropdown-item\">".$menu_profile."</a>
<a href=\"/logout\" title=\"Log Out\" class=\"dropdown-item\">".$menu_logout."</a>
</div>
</li>";
}

$footer = "
";
?>