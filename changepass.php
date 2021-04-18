<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
if(!session_is_registered(email)){
header("location:login.php");
}

include("connect.php");

$password1=hash('sha256', 'hash'.$_POST['password1']);
$password2=hash('sha256', 'hash'.$_POST['password2']);
$password3=hash('sha256', 'hash'.$_POST['password3']);

$password1=stripslashes($password1);
$password2=stripslashes($password2);
$password3=stripslashes($password3);

$password1=mysql_real_escape_string($password1);
$password2=mysql_real_escape_string($password2);
$password3=mysql_real_escape_string($password3);


if($password2 == $password3){
$sql="SELECT * FROM members WHERE username='".$_SESSION['email']."' AND password='".$password1."'";
$rs=mysql_query($sql);
$row=mysql_fetch_array($rs);
$count=mysql_num_rows($rs);

if($count==1){

$changepwddate = date('d.m.Y G:i');

$sql1="UPDATE members SET password='".$password2."', changepwddate='".$changepwddate."' WHERE username='".$_SESSION['email']."'";
mysql_query($sql1);


header("location:profile.php?message=Password changed.");
} else {
header("location:change.php?type=pass&message=Wrong Password, try again.");
}
} else {
header("location:change.php?type=pass&message=Passwords don't match.");
}
?>