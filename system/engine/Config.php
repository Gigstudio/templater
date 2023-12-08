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
}
