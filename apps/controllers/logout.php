<?php
defined('BASE_URL') or exit('No direct script access allowed');

class Logout extends Controller
{
	
	function __construct()
    {
        parent::__construct();
        $this->hasConfig();
        Auth::handleLogin();
	}
	
    function index()
	{
        Session::destroy();
        header('location: ' . BASE_URL .  'login');
		
		$data = $this->loadModel('Setting_model');
        $data->logActivity("LOGOUT", "Logout");
        exit;
    }

}