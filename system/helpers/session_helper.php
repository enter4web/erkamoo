<?php
defined('BASE_URL') or exit('No direct script access allowed');

class Session_helper
{
	public function __construct()
    {
        // Nothing here
    }
    
    public static function init()
    {
        @session_start();
    }
	
	public static function exists($key)
	{
		if (isset($_SESSION[$key]))
		{
			return true;
		}
		else{
			return false;
		}
	}
    
    public static function set($key, $value = null)
    {
		if(is_array($key))
		{
			foreach($key as $keys => $val)
			{
				$_SESSION[$keys]	= $val;
			}
			// var_dump($_SESSION);
		}
		else{
			$_SESSION[$key] = $value;
		}
		return true;
    }
    
    public static function get($key)
    {
        if (self::exists($key))
        return $_SESSION[$key];
    }
    
    public static function destroy()
    {
        session_destroy();
    }
	
	public static function delete($key)
	{
		if (self::exists($key))
		unset($_SESSION[$key]);
		session_destroy();
	}
	
	public static function flash($key, $string = '')
	{
		if (self::exists($key))
		{
			$session = self::get($key);
			self::delete($key);
			return $session; 
		}
		else {
			self::set($key, $string); 
		}
	}
    
}