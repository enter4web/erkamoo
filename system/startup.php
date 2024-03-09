<?php
class startup
{
	protected $controller	= 'home';
    protected $action		= 'index';
    protected $errors		= 'errors';
    protected $params		= [];

    public function __construct()
	{
		global $config;
        
        $url = $this->parseUrl();
		
		if(is_dir(APP_DIR.'controllers/' . $url[0]) and isset($url[0]))
		{
			if(file_exists(APP_DIR.'controllers/' . $url[0].'/' . $url[1] . '.php')){
				$this->controller = $url[1];
				unset($url[1]);
			}
			else{
				if($url[1] == null){
					$this->controller = $this->controller;
				}
				else{
					$this->controller = $this->errors;
				}
			}
			
			if($this->controller == "errors"){
				require_once APP_DIR.'controllers/' . $this->controller . '.php';
			}
			else{
				require_once APP_DIR.'controllers/' . $url[0].'/' . $this->controller . '.php';
			}
			
			$this->controller = new $this->controller;
			
			$arrUrl = array_diff($url, array($url[0]));
			if(isset($arrUrl[2]))
			{
				if(method_exists($this->controller, $arrUrl[2]))
				{
					$this->action = $arrUrl[2];
					unset($arrUrl[2]);
				}
				else{
					Controller::redirect('./');
				}
			}
			
			$this->params = $arrUrl ? array_values($arrUrl): [];
			
			call_user_func_array([$this->controller, $this->action], $this->params);
		}
		else{
			if(file_exists(APP_DIR.'controllers/' . $url[0] . '.php')){
				$this->controller = $url[0];
				unset($url[0]);
			}
			else{
				if($url[0] == null){
					$this->controller = $this->controller;
				}
				else{
					$this->controller = $this->errors;
				}
			}
			require_once APP_DIR.'controllers/' . $this->controller . '.php';
			
			$this->controller = new $this->controller;
			
			if(isset($url[1]))
			{
				if(method_exists($this->controller, $url[1]))
				{
					$this->action = $url[1];
					unset($url[1]);
				}
				else{
					Controller::redirect('./');
				}
			}
			
			$this->params = $url ? array_values($url): [];
			
			call_user_func_array([$this->controller,$this->action], $this->params);
		}
    }

    public function parseUrl()
	{
        if(isset($_GET['pages']))
		{
            return $pages = explode('/',filter_var(rtrim($_GET['pages'],'/'),FILTER_SANITIZE_URL));
        }
    }
}
?>
