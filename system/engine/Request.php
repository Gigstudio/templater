<?php
namespace Templater\System\Engine;
defined('_RUNKEY') or die;

class Request{
    protected $controller = 'site';
    protected $method = 'index';
    protected $params = [];

    public function __construct(){
        show($_SERVER['REQUEST_URI']);
    }

    private function parseUrl(){

    }
}
