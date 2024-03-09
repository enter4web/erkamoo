<?php
defined('BASE_URL') or exit('No direct script access allowed');

class Home extends Controller
{
	
	function __construct()
    {
        parent::__construct();
        $this->hasConfig();
        Auth::handleLogin();
	}
	
    public function index()
	{
		global $config, $db;
		
		$data = [];

		# MODEL
		$setting = $this->loadModel('Setting_model');
		
		$breadcrumb = $this->loadHelper('breadcrumb_helper');
		
		$views = $this->loadView('home/index');
				
		$views->set('title', 'Home');			
		$views->set('param', $setting->getParameter_id());
		$views->set('getUsr', $setting->getAllUser($_SESSION['SESS_ID']));
		$views->set('homeMenu', $setting->getMenu_home('0', ' AND m.status = 1'));	
		
		## Bread crumb
		$breadcrumb->add('Home', BASE_URL);
		
		$data = [
			'kotak'			=> 'Dashboard',
			'breadcrumb'	=> $breadcrumb->output(),
			'js' 			=> $this->loadJS(['apps/views/login/js/load.js'])
		];

		$views->set('data', $data);
		$views->render();
    }

}