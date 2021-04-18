<?php

	include("./session_check.php");

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	ini_set('max_execution_time', 300); //300 seconds = 5 minutes. In case if your CURL is slow and is loading too much (Can be IPv6 problem)

	error_reporting(E_ALL);

	define('OAUTH2_CLIENT_ID', '');
	define('OAUTH2_CLIENT_SECRET', '');

	$authorizeURL = 'https://discordapp.com/api/oauth2/authorize';
	$tokenURL = 'https://discordapp.com/api/oauth2/token';
	$apiURLBase = 'https://discordapp.com/api/users/@me';

	session_start();



	if(get('action') == 'login') {
		$params = array(
			'client_id' => OAUTH2_CLIENT_ID,
			'redirect_uri' => 'https://iloot.it/assets/php/discord.php',
			'response_type' => 'code',
			'scope' => 'identify guilds guilds.join email'
		);

		header('Location: https://discordapp.com/api/oauth2/authorize' . '?' . http_build_query($params));
		die();
	}

	if(get('code')) {

		$token = apiRequest($tokenURL, array(
			"grant_type" => "authorization_code",
			'client_id' => OAUTH2_CLIENT_ID,
			'client_secret' => OAUTH2_CLIENT_SECRET,
			'redirect_uri' => 'https://iloot.it/assets/php/discord.php',
			'code' => get('code')
		));



		$logout_token = $token->access_token;
		$_SESSION['access_token'] = $token->access_token;
	
		$user = apiRequest($apiURLBase);
	
		$_SESSION['username'] = $user->username;
		$_SESSION['id'] = $user->id;
                $_SESSION['avatar'] = $user->avatar;
	include("./connect.php");
	$sql1 = "UPDATE members SET discordID='" . $_SESSION['id'] . "' WHERE username='" . $_SESSION['email'] . "'";
	mysqli_query($con, $sql1);
	header('Location: /');

}

if(!session('access_token')) {
	header('Location: /');
} else {
	header('Location: /');
}

if(get('action') == 'logout') {
	session_destroy();
}

function apiRequest($url, $post=FALSE, $headers=array()) {
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  $response = curl_exec($ch);
  if($post)
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
  $headers[] = 'Accept: application/json';
  if(session('access_token'))
    $headers[] = 'Authorization: Bearer ' . session('access_token');
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $response = curl_exec($ch);
  return json_decode($response);
}
function get($key, $default=NULL) {
  return array_key_exists($key, $_GET) ? $_GET[$key] : $default;
}
function session($key, $default=NULL) {
  return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : $default;
}
?>