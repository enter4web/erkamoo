<?php
defined('BASE_URL') or exit('No direct script access allowed');

class View {

	private $pageVars = array();
	private $template;

	public function __construct($template)
	{
		$this->template = APP_DIR .'views/'. $template .'.php';
	}

	public function set($var, $val)
	{
		$this->pageVars[$var] = $val;
	}

	public function render()
	{
		extract($this->pageVars);

		ob_start();
		require($this->template);
		echo ob_get_clean();
	}
		
	function log_db($pola, $query)
	{
		$str = "#".$pola."#".$query . "  [". date("H:i:s") ."]" . PHP_EOL;
		file_put_contents(__DIR__."/log_".date("Y-m-d").".txt", $str,FILE_APPEND);
	}
    
}