<?php

class Lib {
	
	private $userdata;
	private $settings;
	private $language;
	
	private $loggedIn;
	
	private $database;
	
	public function __construct($authentication) {		
		# Start the session.
		session_start();
	
		# Require database.
		require(__DIR__ . "/database.php");
		
		# Initialize database.
		$this->database = new Database();
		
		# Check authentication.
		if ($authentication) {
			
			# Check user login.
			if(!isset($_SESSION["myusername"])) {
				$requestUrl = substr($_SERVER['REQUEST_URI'], 1);
				
				header("Location: https://iloot.it/login?message=You need to login to access this page.&page=$requestUrl");
				exit();
			}
			
			# Create user profile.
			$username = $_SESSION["myusername"];
			
			# Select user by username.
			$data = $this->getDatabase()->query("SELECT * FROM members WHERE username='$username'");
			
			while($row = $data->fetch_assoc()) {
				
				$this->userdata = $row;
				
				break;
			}
			
		} else {
			if(isset($_SESSION["myusername"])) {
				# Create user profile.
				$username = $_SESSION["myusername"];
				
				# Select user by username.
				$data = $this->getDatabase()->query("SELECT * FROM members WHERE username='$username'");
				
				while($row = $data->fetch_assoc()) {
					
					$this->userdata = $row;
					
					break;
				}
			}
		}
		
		# Set is logged in.
		if(isset($_SESSION["myusername"])) {
			$this->loggedIn = true;
		} else {
			$this->loggedIn = false;
		}
		
		# Require other libraries
		require(__DIR__ . "/placeholder.php");
		require(__DIR__ . "/menu.php");
		
		# Get settings.
		$this->settings = json_decode(file_get_contents(__DIR__ . "/settings.json"));
		
		# Check if maintenance is enabled.
		if ($this->settings->maintenance->enabled) {
			$requestUrl = substr($_SERVER['REQUEST_URI'], 1);
				
			header("Location: ./maintenance?page=$requestUrl");
			exit();
		}
		
		# Get language file.
		$this->language = json_decode(file_get_contents(__DIR__ . "/language.json"));
		
		# Apply menu
		$this->menu = new Menu($this);
		
		# Store user page visit statistic.
		$requestUrl = substr($_SERVER['REQUEST_URI'], 1);
		$oauth = $this->getUserdata()["oauth"];
			
		$this->saveStatistic($oauth, "text", "visit", "$requestUrl");
		
	}
	
	public function isLoggedIn() {
		return $this->loggedIn;
	}
	
	public function getDatabase() {
		return $this->database;
	}
	
	public function getUserdata() {
		return $this->userdata;
	}
	
	public function getMenu() {
		return $this->menu;
	}
	
	public function getLanguage() {
		return $this->language;
	}
	
	public static function saveStatistic($oauth, $type, $action, $data) {
		if (empty($oauth)) {
			return;
		}
		
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		
		$ms = round(microtime(true) * 1000);
		
		# Require database.
		require_once(__DIR__ . "/database.php");
		
		# Initialize database.
		$database = new Database();
			
		$database->query("INSERT INTO statistics VALUES ('$oauth', '$ip', '$ms', '$type', '$action', '$data')");
	}
	
	public function getCurrency($currency) {
		switch ($currency) {
			case "dollar": 
				# TODO change database.
				return (int)$this->getUserdata()["points"] / 100000;
			case "token":
				
				# TODO
				return 0;
		}
	}
	
	public function getSettings() {
		return $this->settings;
	}
	
}

?>