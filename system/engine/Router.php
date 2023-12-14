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
            require $file;
            $routes['get'] = $get;
            $routes['post'] = $post;
            return $routes;
        }
    }

    public function getController($url){
        $url = str_replace(SITE_SHORT_NAME, 'Home', $url);
        return $url[0] ?? 'Home';
    }

    public function getAction($url){
        return $url[1] ?? 'index';
    }

    public function resolve(){
        $method = $this->request->getMethod();
        $url = $this->request->getUrl();
        $callback = $this->routeMap[$method][$url] ?? false;

        if(!$callback){
            throw new \Exception('Page not found', 404);
        }
        
        if(is_array($callback)){
			if(!class_exists($callback[0])){
				throw new \Exception('Контроллер '.$callback[0].' не найден', 404);
			}
			$controller = new $callback[0]();
			$controller->action = $callback[1];
			$callback[0] = $controller;
		}

		if(is_callable($callback)){
			return call_user_func($callback, $this->request, $this->response);
		}
		else{
			throw new \Exception("Страница $callback[1] не найдена", 404);
		}
       // $this->controller = $callback[0];
        // $this->action = $callback[1];

        dump($url);
        dump($callback);

    }
}