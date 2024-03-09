<?php 
$ssl = isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] && $_SERVER["HTTPS"] != "off" 
     ? true 
     : false;
define("SSL_ENABLED", $ssl);

if (!in_array($_SERVER['SERVER_PORT'], [443, 8443])) {
	$port = ":$_SERVER[SERVER_PORT]";
}
else {
	$port = '';
}
	
$app_url = (SSL_ENABLED ? "https" : "http")
         . "://"
         . $_SERVER["SERVER_NAME"]
		 . $port
         . (dirname($_SERVER["SCRIPT_NAME"]) == DIRECTORY_SEPARATOR ? "" : "/")
         . trim(str_replace("\\", "/", dirname($_SERVER["SCRIPT_NAME"])), "/");
		 
$config['default_controller']	= 'home'; 	// Default controller to load
$config['error_controller']		= 'errors'; // Controller used for errors (e.g. 404, 500 etc)
$config['base_url'] 			= $app_url.'/'; 

# EMAIL
$config['ehost'] = 'localhost'; 
$config['eport'] = 25; 
$config['euser'] = ''; 
$config['epass'] = ''; 

# DATABASE
$config['db_host'] = 'localhost'; 
$config['db_name'] = 'latihan'; 
$config['db_username'] = 'root'; 
$config['db_password'] = '';