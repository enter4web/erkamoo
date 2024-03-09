<?php
defined('BASE_URL') or exit('No direct script access allowed');

class Errors extends Controller
{
	
	function __construct()
    {
        parent::__construct();
        $this->hasConfig();
	}
	
	function index()
	{
		$this->error404();
	}
	
	function error404()
	{
		$this->loadView('errors/404')->render();
		// echo '<h1>404 Error</h1>';
		// echo '<p>Looks like this page doesn\'t exist</p>';
	}
    
}

?>
