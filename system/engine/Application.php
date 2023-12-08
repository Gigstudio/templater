<?php
namespace Templater\System\Engine;
defined('_RUNKEY') or die;

class Application{
    public static Application $app;
    public Config $config;
    public Errorhandler $error;
	public Request $request;
	public Response $response;
	public Router $router;

    public function __construct(){
        self::$app = $this;
        // $this->config = new Config();
        // $this->error = new Errorhandler();
		$this->request = new Request();
		$this->response = new Response();
        $this->router = new Router($this->request, $this->response);
    }

    public function run(){
        // show($this);
        $this->router->resolve();
    }
}