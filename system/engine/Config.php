<?php
namespace Templater\System\Engine;
defined('_RUNKEY') or die;

class Config{
    private string $path = PATH_CONFIG;
    private array $data = [];

    public function __construct(){
        
    }

	public function get(string $key) {
		return isset($this->data[$key]) ? $this->data[$key] : '';
	}

	public function set(string $key, $value) {
		$this->data[$key] = $value;
	}

	public function get_cs($lang){
		return 'UTF-8';
	}

	public function init($configs){
		if(is_array($configs)){
			foreach($configs as $config){
				$file = PATH_CONFIG . $config .'.php';
				require_once($file);
				if(is_array($settings)){
					foreach($settings as $key=>$value){
						$this->set($key, $value);
					}
				}
			}
		}
	}
}
