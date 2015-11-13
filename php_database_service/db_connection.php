<?php
class DB_CONNECTION {

	//constructor
	function __construct() {
		//connect to the database
		$this->connect();
	}

	//destructor 
	function __destruct() {
		//close connection
		$this->close();
	}

	/*
	* connect - connects to the database using the variables defined in db_config.php
	*/
	function connect() {
		//require the configuration file
		require_once __DIR__ . '/db_config.php';

		//connect to the database
		$con = mysql_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysql_error());

		//Select the database 
		$db = mysql_select_db(DB_DATABASE) or die(mysql_error());

		//returning connection cursor
		return $con;
	}

	/*
	* close - closes the connection to the database
	*/
	function close() {
		mysql_close();
	}

}
?>