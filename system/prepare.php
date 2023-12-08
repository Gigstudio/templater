<?php

defined('_RUNKEY') or die;

define('DS',DIRECTORY_SEPARATOR);

if (!defined('ABSPATH')){
	define('ABSPATH',dirname( __DIR__) . DS );
}

if (!ini_get('date.timezone')) {
	date_default_timezone_set('UTC');
}

// Windows IIS Compatibility
if (!isset($_SERVER['DOCUMENT_ROOT'])) {
	if (isset($_SERVER['SCRIPT_FILENAME'])) {
		$_SERVER['DOCUMENT_ROOT'] = str_replace('\\', '/', substr($_SERVER['SCRIPT_FILENAME'], 0, 0 - strlen($_SERVER['PHP_SELF'])));
	}
}

if (!isset($_SERVER['DOCUMENT_ROOT'])) {
	if (isset($_SERVER['PATH_TRANSLATED'])) {
		$_SERVER['DOCUMENT_ROOT'] = str_replace('\\', '/', substr(str_replace('\\\\', '\\', $_SERVER['PATH_TRANSLATED']), 0, 0 - strlen($_SERVER['PHP_SELF'])));
	}
}

if (!isset($_SERVER['REQUEST_URI'])) {
	$_SERVER['REQUEST_URI'] = $_SERVER['PHP_SELF'];

	if (isset($_SERVER['QUERY_STRING'])) {
		$_SERVER['REQUEST_URI'] .= '?' . $_SERVER['QUERY_STRING'];
	}
}

if (!isset($_SERVER['HTTP_HOST'])) {
	$_SERVER['HTTP_HOST'] = getenv('HTTP_HOST');
}

// Check if SSL
if ((isset($_SERVER['HTTPS']) && (($_SERVER['HTTPS'] == 'on') || ($_SERVER['HTTPS'] == '1'))) || (isset($_SERVER['HTTPS']) && (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443))) {
	$_SERVER['HTTPS'] = true;
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
	$_SERVER['HTTPS'] = true;
} else {
	$_SERVER['HTTPS'] = false;
}

// Check IP if forwarded IP
if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	$_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_X_FORWARDED_FOR'];
} elseif (!empty($_SERVER['HTTP_CLIENT_IP'])) {
	$_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_CLIENT_IP'];
}

if (file_exists(ABSPATH.'system'.DS.'defines.php')) {
    require_once ABSPATH.'system'.DS.'defines.php';
}
else{
	die('No required file (defines.php) found. Stopped.');
}

if (file_exists(ABSPATH.'system'.DS.'functions.php')) {
    require_once ABSPATH.'system'.DS.'functions.php';
}
else{
	die('No required file (functions.php) found. Stopped.');
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

$app->run();
