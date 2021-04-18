<?php

class Database {
	
	// Database credentials
    private $host = "";
    private $db_name = "";
    private $username = "";
    private $password = "!";
	
    public $conn;
 
	public function __construct() {
		$this->conn = null;
		
		$this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
		
		if ($this->conn->connect_error) {
			die("Connection failed: " . $this->conn->connect_error);
		}
	}
 
    // get the database connection
    public function getConnection() {
		return $this->conn;
    }
	
	// run a query
	public function query($sql) {
		return $this->conn->query($sql);
	}
}

?>