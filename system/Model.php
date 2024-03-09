<?php
class Model {

	protected static $db;
	protected static $db2;
	
	function __construct()
	{
		global $config, $db, $db2;
		
		$dbConfig = array(
			"host"		=> $config['db_host'], 
			"dbname"	=> $config['db_name'], 
			"username"	=> $config['db_username'], 
			"password"	=> $config['db_password']
		);
		
		// get instance of PDO Wrapper object
		$db = new PdoWrapper($dbConfig);

		// get instance of PDO Helper object
		$helper = new PDOHelper();

		// set error log mode true to show error on screen or false to log in log file
		$db->setErrorLog(true);
	}
}
?>
