<?php
// Database Connection
class DBConnection {
    private $_dbHostname = "zmysql:3306";
    private $_dbName = "FI_ITIS_MEUCCI";
    private $_dbUsername = "root";
    private $_dbPassword = "password";
    private $_con;

    public function __construct() {
    	try {
        	$this->_con = new PDO("mysql:host=$this->_dbHostname;dbname=$this->_dbName", $this->_dbUsername, $this->_dbPassword);
          $this->_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $this->_con->exec('SET NAMES utf8');
	    } catch(PDOException $e) {
			echo "Connection failed: " . $e->getMessage();
		}

    }
    // return Connection
    public function returnConnection() {
        return $this->_con;
    }
}
?>
