<?php
namespace Templater\System\Engine;
defined('_RUNKEY') or die;

class Application{
    protected $controller = 'site';
    protected $method = 'index';

	public Request $request;
	public Response $response;
	public Router $router;

    public function __construct(){
		$this->request = new Request();
		$this->response = new Response();
        $this->router = new Router($this->request, $this->response);
    }
}