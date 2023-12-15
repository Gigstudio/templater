<?php
namespace Templater\System\Engine;
defined('_RUNKEY') or die;

use Templater\System\Engine\Application;

class Controller{
    public string $layout = 'main';
    public array $models = [];
    public array $views = [];
    public array $data = [];

    public function __construct($extra = []){
        $this->data = $extra;
        // check for user logged in and user is owner
        $pars = Application::$app->request->getQueryParams();
        if(!array_key_exists('check',$pars)){
            $t=time();
            $msg = 'Извините, страница находится на стадии разработки. Работа сервиса будет восстановлена в ближайшее время!';
            throw new \Exception($msg, 410);
        }
        
    }

    public function setLayout(string $layout){
        $this->layout = $layout;
    }

    public function load_model($model){
        $model = ucfirst(strtolower($model));
        if(file_exists(PATH_MODELS . $model . ".php")){
            $class = 'Templater\Models\\'.$model;
            include_once PATH_MODELS . $model . ".php";
            if(class_exists($class)){
                $this->models[$model] = new $class;
                return $this->models[$model];
            }
        }
        return false;
    }

    public function load_controller($file, $method, $data = []){
        $path = PATH_CONTROLLERS . ucfirst($file) . '.php';
        $class = 'Templater\Controllers\\' . ucfirst($file);
        if(!file_exists($path)){
            throw new \Exception("Контроллер $file не найден", 404);
            exit;
        }
        $block = new $class($data);
        $content = is_callable([$block, $method]) ? call_user_func([$block, $method]) : '';
        return $content; 
    }

    public function load_HTML($file): string{
        if(!file_exists($file)){
            $parts = explode('/', $file);
            $page = end($parts);
            $name = explode('.',$page);
            throw new \Exception("Страница $name[0] не найдена", 404);
            return '';
        }
        ob_start();
        include_once $file;
        $content = ob_get_clean();
        return $content;
    }

    public function render($data = [], $view = ''){
        $file = !$view || $view === $this->layout ? PATH_LAYOUTS . "$this->layout.php" : PATH_VIEWS . "$view.php";
        $layout = $this->load_HTML($file);
        while($startpos = strpos($layout, '{{')){
            $endpos = strpos($layout, '}}');
            if($endpos){
                $length = $endpos - $startpos;
                $key = substr($layout, $startpos+2, $length-2);
                $ins = array_key_exists($key, $data) ? $data[$key] : '';
                $layout = substr_replace($layout, $ins, $startpos, $length+2);
            }
        }
        return $layout;
    }
}