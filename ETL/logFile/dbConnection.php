<?php
class dbConnection{
	public $serverName = "localhost";
	public $userName = "root";
	public $passWord = "root";
	public $dbName = "ciscoaudit";
	public $connection;
	public function __construct(){
		$this->mysqlConnection();
	}
	public function mysqlConnection(){
		$this->connection = mysqli_connect($this->serverName,$this->userName,$this->passWord,$this->dbName); //or die("hi"); 
		// if(!$connection){
		// 	echo "database connection failed";
		// }
		// else
		// {
		// 	echo "database successfully connected";
		// }
	}
}
$object = new dbConnection;
?>