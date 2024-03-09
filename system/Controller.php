<?php
defined('BASE_URL') or exit('No direct script access allowed');

class Controller
{

	function __construct(){}
	
	public function loadModel($name)
	{
		require(APP_DIR .'models/'. strtolower($name) .'.php');

		$model = new $name;
		return $model;
	}
	
	public function loadView($name)
	{
		$view = new View($name);
		return $view;
	}
	
	public function loadPlugin($name)
	{
		require('plugins/'. $name .'.php');
	}
	
	public function loadHelper($name)
	{
		require('helpers/'. strtolower($name) .'.php');
		$helper = new $name;
		return $helper;
	}

    public function hasConfig() 
	{
        global $config;
        if (BASE_URL == '' || $config['db_host'] == '' || $config['db_name'] == '' || $config['db_username'] == '') {
            echo '<h1>Configuration Error!</h1>';
            echo '<p>Looks like configuration page didn\'t set properly. Please go to <a href="readme.txt">readme</a></p>';
            exit;
        }
    }
		
	public function redirect($url, $time = "")
	{
		global $config;
		
		if (!headers_sent())
		{ 
			header('Location: '. BASE_URL . $url); exit;
		}
		else{ 
			echo '<script type="text/javascript">';
			echo 'window.location.href="'. BASE_URL . $url.'";';
			echo '</script>';
			echo '<noscript>';
			echo '<meta http-equiv="refresh" content="'.(($time) ? $time : 0).';url='.$url.'" />';
			echo '</noscript>'; 
			return;
			exit;
		}
	}
	
	public function handleLogin()
    {
		$session = $this->loadHelper('session');
		
		@session_start();
		if ($session->get('loggedIn') == false || $session->get('loggedIn') == null) {
			$session->delete('loggedIn');
			$this->redirect('auth/login');
			exit;
		}
    }
	
	// LOAD JS
	public function loadJS($data)
	{
		global $config;
		
		if(!empty($data))
		{
			foreach($data as $value)
			{
				$scripts .= '<script src="'.BASE_URL . $value.'" type="text/javascript"></script>';
				$scripts .= "\r\n";
			}
			return $scripts;
		}
		else{
			throw new Exception("Missing js file '$data'.");
		}
	}
    
}