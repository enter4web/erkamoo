<?php
defined('BASE_URL') or exit('No direct script access allowed');

class Url_helper {

	function base_url()
	{
		global $config;
		return $config['base_url'];
	}
	
	function segment($seg)
	{
		if(is_int($seg)) return false;
		return isset($_REQUEST[$seg]) ? $_REQUEST[$seg] : false;
	}
	
}

?>