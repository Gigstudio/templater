<?php
defined('_RUNKEY') or die;

function dump($var){
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

function str_contains($haystack, $needle){
	return $needle !== '' && mb_strpos($haystack, $needle) !== false;
}

function trimSpaces($str, $separator = ',',  $key = 'string'){
	$str = str_replace(';',',',$str);
	$arr = explode(',',$str);
	$trimedarray=array_map("trim",$arr);
	$modifiedarray=array_values(array_filter($trimedarray)); 
	$separated_str = implode($separator." ", $modifiedarray);
	return $key == 'array' ? $modifiedarray : $separated_str;
}

function combine_arr($a, $b){
	$acount = count($a);
	$bcount = count($b);
	$size = ($acount > $bcount) ? $bcount : $acount;
	$a = array_slice($a, 0, $size);
	$b = array_slice($b, 0, $size);
	return array_combine($a, $b);
}	
function check_db(){
    
}