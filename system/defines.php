<?php
defined('_RUNKEY') or die;

$parts = explode(DS, ABSPATH);

// !!! Change to 1 when ported to host !!!
$base_url_level = 2;

// Defines.
defined('APPLICATION') or 		define('APPLICATION', 'Templater');

defined('PATH_ROOT') or 		define('PATH_ROOT', implode(DS, $parts));
defined('PATH_CONFIG') or 		define('PATH_CONFIG', PATH_ROOT.'config'.DS);
defined('PATH_PLUGINS') or 		define('PATH_PLUGINS', PATH_ROOT.'plugins'.DS);
defined('PATH_SYSTEM') or 		define('PATH_SYSTEM', PATH_ROOT.'system'.DS);
defined('PATH_ENGINE') or 		define('PATH_ENGINE', PATH_SYSTEM.'engine'.DS);
defined('PATH_PAGES') or 		define('PATH_PAGES', PATH_ROOT.'pages'.DS);
defined('PATH_LAYOUTS') or 		define('PATH_LAYOUTS', PATH_PAGES.'layouts'.DS);
defined('PATH_MODELS') or 		define('PATH_MODELS', PATH_PAGES.'models'.DS);
defined('PATH_VIEWS') or 		define('PATH_VIEWS', PATH_PAGES.'views'.DS);
defined('PATH_VIEWMODELS') or 	define('PATH_VIEWMODELS', PATH_PAGES.'viewmodels'.DS);
defined('PATH_CONTROLLERS') or 	define('PATH_CONTROLLERS', PATH_PAGES.'controllers'.DS);
defined('PATH_BLOCKS') or 		define('PATH_BLOCKS', PATH_PAGES.'blocks'.DS);
defined('PATH_STORAGE') or 		define('PATH_STORAGE', PATH_ROOT.'storage'.DS);
defined('PATH_LOGS') or 		define('PATH_LOGS', PATH_STORAGE.'logs'.DS);
defined('PATH_SESSION') or 		define('PATH_SESSION', PATH_STORAGE.'sessions'.DS);
defined('PATH_CACHE') or 		define('PATH_CACHE', PATH_STORAGE.'cache'.DS);
defined('PATH_UPLOAD') or 		define('PATH_UPLOAD', PATH_STORAGE.'upload'.DS);
defined('PATH_DOWNLOAD') or 	define('PATH_DOWNLOAD', PATH_STORAGE.'download'.DS);
// defined('PATH_TEMPLATE') or 	define('PATH_TEMPLATE', PATH_ROOT.APPLICATION.'view'.DS.'template'.DS);
// defined('PATH_LANGUAGE') or 	define('PATH_LANGUAGE', PATH_ROOT.APPLICATION.'language'.DS);
// defined('PATH_SOURCE') or 		define('PATH_SOURCE', PATH_ROOT.'source'.DS);
// defined('PATH_API') or 			define('PATH_API', PATH_ROOT.'api'.DS);
// defined('PATH_DATA') or 		define('PATH_DATA', PATH_ROOT.'data'.DS);
defined('PATH_ASSETS') or 		define('PATH_ASSETS', PATH_ROOT.'siteroot/assets'.DS);
// defined('PATH_FONTS') or 		define('PATH_FONTS', PATH_ASSETS.'fonts'.DS);
// defined('PATH_IMAGES') or 		define('PATH_IMAGES', PATH_ASSETS.'images'.DS);

defined('PROTOCOL') or 			define('PROTOCOL', isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https://' : 'http://');

$home = PROTOCOL.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
defined('HOME_URL') or 			define('HOME_URL', implode('/', array_slice(explode('/',$home), 0, $base_url_level+2)).'/');

$sname = explode('/', rtrim(HOME_URL, '/'));

defined('SITE_SHORT_NAME') or 	define('SITE_SHORT_NAME', end($sname));
defined('SITE_DISPLAY_NAME') or define('SITE_DISPLAY_NAME', 'Templater');
defined('MAIN_LOGO_FILE') or 	define('MAIN_LOGO_FILE', 'ttype.png');
defined('SITE_ICON_FILE') or 	define('SITE_ICON_FILE', 'ticon.svg');

defined('ENVIRONMENT') or 		define('ENVIRONMENT', 'development');
