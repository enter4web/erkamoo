<?php
defined('BASE_URL') or exit('No direct script access allowed');
 
class Breadcrumb_helper
{
    private $breadcrumbs = array();
    private $separator = '';
    private $start = '<ol class="breadcrumb">';
    private $end = '</ol>';
    
    public function __construct($params = array())
    {
        if (count($params) > 0) {
            $this->initialize($params);
        }
    }
    
    private function initialize($params = array())
    {
        if (count($params) > 0) {
            foreach ($params as $key => $val) {
                if (isset($this->{'_' . $key})) {
                    $this->{'_' . $key} = $val;
                }
            }
        }
    }
    
    function add($title, $href)
    {
        if (!$title OR !$href)
            return;
        
        $this->breadcrumbs[] = array(
            'title' => $title,
            'href' => $href
        );
    }
    
    function output()
    {
        if ($this->breadcrumbs) {
            $output = $this->start;
			$i = 0;
            foreach ($this->breadcrumbs as $key => $crumb) {
                if ($key) {
                    $output .= $this->separator;
                }
                if (end(array_keys($this->breadcrumbs)) == $key) {
					if($i == 0){
						$output .= '<li class="active"><i class="fa fa-home"></i> ' . $crumb['title'] . '</li>';
					}
					else{
						$output .= '<li class="active">' . $crumb['title'] . '</li>';
					}
                } else {
					if($i == 0){
						$output .= '<li><a href="' . $crumb['href'] . '"><i class="fa fa-home"></i> ' . $crumb['title'] . '</a></li>';
					}
					else{
						$output .= '<li><a href="' . $crumb['href'] . '">' . $crumb['title'] . '</a></li>';
					}
                }
				$i++;
            }
            return $output . $this->end . PHP_EOL;
        }
        return '';
    }
}