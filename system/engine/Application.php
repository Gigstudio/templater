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
    public Document $doc;
    private array $configs = [
        'appconfig',
        'dbconfig'
    ];

    public function __construct(){
        self::$app = $this;
        $this->config = new Config();
        $this->config->init();
        $this->error = new Errorhandler();
		$this->request = new Request();
		$this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->doc = new Document();
    }

    public function run(){
        $content = $this->router->resolve();
        $this->show($content ?? '');

    }

	public function show(string $content){
        $this->response->setOutput($content);
        $this->response->show();
	}
}