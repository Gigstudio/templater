<?php
namespace Templater\System\Engine;
defined('_RUNKEY') or die;

class Controller{
    public string $layout = 'main';
    public array $models = [];
    public array $views = [];
    public array $data = [];

    public function __construct($extra = []){
        $this->data = $extra;
    }

    public function setLayout(string $layout){
        $this->layout = $layout;
    }

    public function load_model($model){
        $model = ucfirst(strtolower($model));
        if(file_exists(PATH_MODELS . $model . ".php")){
            $class = 'Cmgift\Models\\'.$model;
            include_once PATH_MODELS . $model . ".php";
            if(class_exists($class)){
                $this->models[$model] = new $class;
                return $this->models[$model];
            }
        }
        return false;
    }

    public function composeHeader(){
        // get params from Doc
        $this->data['page_title'] = Application::$app->doc->getTitle();
		$this->data['lang'] = Application::$app->doc->getLanguage();
		$this->data['charset'] = Application::$app->config->get_cs($this->data['lang']);
        $this->data['description'] = Application::$app->doc->getDescription();
        $this->data['add_css'] = Application::$app->doc->getStyle();
        $this->data['add_js'] = Application::$app->doc->getScript();
        $this->data['add_style'] = Application::$app->doc->getInlineStyles();
        $this->data['site_icon']  = HOME_URL . 'assets/images/' . SITE_ICON_FILE;

        // get layout
        return $this->getLayout('header');
        // return $this->composeView($layout);
        // show($layout);
    }

    public function getLayout($name){
        $file = PATH_LAYOUTS . $name . '.php';
        if(!file_exists($file)){
			$t=time();
			trigger_error(date("H:i:s",$t).": Схема $name не найдена.", Errorhandler::EL_INFO);
            return '';
        }
        ob_start();
        include_once $file;
        $content = ob_get_clean();
        return $content;
    }

    public function composeView($layout){
        while($startpos = strpos($layout, '{{')){
            $endpos = strpos($layout, '}}');
            if($endpos){
                $length = $endpos - $startpos;
                $key = substr($layout, $startpos+2, $length-2);
                $ins = array_key_exists($key, $this->data) ? $this->data[$key] : '';
                $layout = substr_replace($layout, $ins, $startpos, $length+2);
            }
        }
        // show($layout);
        return $layout;
        // return $content;
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
        // show((bool)is_callable([$block, $method]));
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
                // show($key);
                // show($ins);
                $layout = substr_replace($layout, ltrim($ins), $startpos, $length+2);
            }
        }
        // show($layout);
        return $layout;
    }
}