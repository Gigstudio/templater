<?php
namespace Templater\System\Engine;
defined('_RUNKEY') or die;

class Router{
    private Request $request;
    private Response $response;

    public function __construct(Request $request, Response $response){
        $this->request = $request;
        $this->response = $response;
    }
}