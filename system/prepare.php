<?php

defined('_RUNKEY') or die;

define('DS',DIRECTORY_SEPARATOR);

if (!defined('ABSPATH')){
	define('ABSPATH',dirname( __DIR__) . DS );
}

if (file_exists(ABSPATH.'system'.DS.'defines.php')) {
    require_once ABSPATH.'system'.DS.'defines.php';
}

if (file_exists(ABSPATH.'system'.DS.'functions.php')) {
    require_once ABSPATH.'system'.DS.'functions.php';
}

if(ENVIRONMENT == 'development'){
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
}
else{
	ini_set('display_errors', 0);
	ini_set('display_startup_errors', 0);
	error_reporting(0);
}

require_once(PATH_SYSTEM . 'Autoloader.php');

$autoloader = new \Templater\Autoloader();

// $autoloader->register(APPLICATION, PATH_ROOT);
$autoloader->register(APPLICATION . '\System', 			PATH_SYSTEM);
$autoloader->register(APPLICATION . '\System\Engine', 	PATH_ENGINE);
$autoloader->register(APPLICATION . '\Controllers', 	PATH_CONTROLLERS);
$autoloader->register(APPLICATION . '\Views', 			PATH_VIEWS);
$autoloader->register(APPLICATION . '\Models', 			PATH_MODELS);
// $autoloader->register('GIG\Exception', 					PATH_SYSTEM . 'exceptions' . DS);
// $autoloader->register('GIG\Mware', 						PATH_SYSTEM . 'mwares' . DS);

$app = new Templater\System\Engine\Application();

// $app->run();
