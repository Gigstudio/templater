<?php
defined('_RUNKEY') or die;

function show($var){
	echo '<pre>';
	var_dump($var);
	echo '</pre>';
}

function load_plugins(){
	$files = glob(PATH_PLUGINS.'*.php');

	if(is_array($files)){
		foreach ($files as $file){
			if(file_exists($file)){
				require_once $file;
			}
		}
	}
}

function check_db(){
    
}