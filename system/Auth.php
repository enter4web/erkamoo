<?php

class Auth
{
    public static function handleLogin()
    {
		@session_start();
        if (!isset($_SESSION['loggedIn']))
		{			
            session_destroy();
            header('location: '.BASE_URL.'login');
            exit;
        }
		else{
			return '1';
		}
    }
}