<?php
defined('BASE_URL') or exit('No direct script access allowed');

class Login extends Controller
{

	function __construct()
    {
        parent::__construct();
		
        $this->hasConfig();
	}
	
    public function index()
	{
		global $config, $db;

		# MODEL
		$setting = $this->loadModel('Setting_model');
		
		$views = $this->loadView('login/index');
				
		$views->set('title', 'Login');			
		$views->set('param', $setting->getParameter_id());
		
		$data = [
			'js' => $this->loadJS(['apps/views/login/js/load.js'])
		];

		$views->set('data', $data);
		$views->render();
    }

    public function runLogin()
	{
		global $config, $db;

		# MODEL
		$setting = $this->loadModel('Setting_model');
		
		$post = ($_POST) ? $_POST : json_decode(file_get_contents('php://input'), true);
		
		$response = [];
		$response["success"] = false;
		
		try
		{
			if($post['username'] == "" || $post['password'] == "")
			{
				$response["message"] = "You must fill all the fields!";
			}
			else{
				$db->start();
					
				$row = $db->select("tbl_users", "*", array(
					'username' => $post['username'],
					'password' => md5($post['password'])
				))->results();
				
				if(count($row) > 0)
				{
					$response["success"]	= true;
					$response["timestamp"]	= time();
					$response["message"]	= "Login success.";
										
					Session::init();
					Session::set('loggedIn',		true);
					Session::set('SESS_ID',			$row[0]->userId);
					Session::set('SESS_LOGIN_ID',	$row[0]->userName);
					Session::set('SESS_F_NAME',		$row[0]->fullName);
					Session::set('SESS_EMAIL',		$row[0]->email);
					Session::set('SESS_IS_ACTIVE',	$row[0]->active);
					Session::set('SESS_GROUP',		$row[0]->groupId);
					Session::set('SESS_GROUP_NAME',	$setting->getGroup_id($row[0]->groupId)[0]->groupName);
					Session::set('SESS_USR_IMG',	$row[0]->usrImg);
					
					## LOG ACTIVITY
					$setting->logActivity("LOGIN", "Login");
				}
				else{
					$response["timestamp"]	= time();
					$response["message"]	= "Login failled.";
				}
				
				$db->end();
			}
		
		}
		catch(Exception $e)
		{
			http_response_code(401);
			$response["message"] = $e->getmessage();
			$response["success"] = false;
			$db->back();
		}
		echo json_encode($response);
		exit;
    }

}
?>