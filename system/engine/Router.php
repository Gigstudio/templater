<?php
namespace Templater\System\Engine;
defined('_RUNKEY') or die;

class Router{
    protected string $controller = 'Home';
    protected string $action = 'index';
    protected array $params = [];

    private Request $request;
    private Response $response;
    private $routeMap = [];

    public function __construct(Request $request, Response $response){
        $this->request = $request;
        $this->response = $response;
        $this->routeMap = $this->getRoutes('routesmap.php');
        $this->params = $this->request->getQueryParams();
    }

    private function getRoutes($source){
        $file = PATH_CONFIG . $source;
        if(file_exists($file)){
            require_once $file;
            $routes['get'] = $get;
            $routes['post'] = $post;
            return $routes;
        }
    }

    public function getController($url){
        return $url[0] ?? 'Home';
    }

    public function resolve(){
        $url = $this->request->getUrl();
        $this->controller = $this->getController($url);
        show($this);
        die;

    }
}