<?php
namespace Templater\System\Engine;
defined('_RUNKEY') or die;

class Request{
    public function __construct(){
        // $this->params = $this->getQueryParams();
    }

    private function prepareRequest(){
        $_SERVER['REQUEST_URI'] = strpos($_SERVER['REQUEST_URI'], strtolower(APPLICATION)) === false ? '/' . strtolower(APPLICATION) . $_SERVER['REQUEST_URI'] : $_SERVER['REQUEST_URI'];
        $_SERVER['REQUEST_URI'] = strstr($_SERVER['REQUEST_URI'], strtolower(APPLICATION));
    }

    public function getUrl(){
        $this->prepareRequest();
        $uriString = filter_var(rtrim($_SERVER['REQUEST_URI'], '/'), FILTER_SANITIZE_URL);
        $position = strpos($uriString, '?');
        $path = $position !== false ? substr($uriString, 0, $position) : $uriString;
        return rtrim(preg_replace('/(.php|.html|)/i', '', $path),'/');
    }

    public function getQueryParams(){
        $this->prepareRequest();
        $query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
        parse_str($query, $query_params);
        return $query_params;
    }

	public function getMethod(){
		return strtolower($_SERVER['REQUEST_METHOD']);
	}

	public function isGet(){
		return $this->getMethod() === 'get';
	}

	public function isPost(){
		return $this->getMethod() === 'post';
	}

	public function getBody(){
		$data = [];
		if ($this->isGet()){
			foreach ($_GET as $key => $value){
				$data[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
			}
		}
		if ($this->isPost()){
			foreach ($_POST as $key => $value){
				$data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
			}
		}
		return $data;
	}
}
