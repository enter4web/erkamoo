<?php
global $config, $db;

error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('date.timezone', 'Asia/Jakarta');
ini_set('max_execution_time', 300);
ini_set('memory_limit', '-1');
// ini_set('session.save_path', './tmp');
// ini_set('session.save_path', '/tmp');
ob_start("ob_gzhandler");

session_start(); 

// Defines
define('ROOT_DIR', str_replace('\\', '/', realpath(dirname(__FILE__))) .'/');
define('APP_DIR', ROOT_DIR .'apps/');

// Includes
require(ROOT_DIR .'system/Handle.php');
require(ROOT_DIR .'system/Functions.php');
require(ROOT_DIR .'system/style.php');
require(ROOT_DIR .'system/config.php');
require(ROOT_DIR .'system/startup.php');

# Define global configurations
define('BASE_URL', $config['base_url']);

require(ROOT_DIR .'system/db/class.pdohelper.php');
require(ROOT_DIR .'system/db/class.pdowrapper.php');

# AUTOLOAD
function autoload_classes($class_name)
{
    $filename = ROOT_DIR . '/system/' . str_replace('\\', '/', $class_name) .'.php';
    if(is_file($filename))
    {
        include_once $filename;
    }
}

spl_autoload_register('autoload_classes');

new startup();