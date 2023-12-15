<?php
namespace Templater\Controllers;

use Templater\System\Engine\Application;
use Templater\System\Engine\Controller;

class Menu extends Controller{
	public function topmenu(){
        $this->data['usermenu'] = $this->load_controller('menu', 'usermenu', $this->data);
        $this->data['mainmenu'] = $this->load_controller('menu', 'mainmenu', $this->data);

        $content = file_exists(PATH_VIEWS . "topmenu.php") ? $this->render($this->data, 'topmenu') : "";
        return $content;
	}

    public function errormenu(){
        $content = file_exists(PATH_VIEWS . "errormenu.php") ? $this->render($this->data, 'errormenu') : "";
        return $content;
    }

    public function toplogin(){
        $content = file_exists(PATH_VIEWS . "toplogin.php") ? $this->render($this->data, 'toplogin') : "";
        return $content;
    }

	public function usermenu(){
        $content = file_exists(PATH_VIEWS . "usermenu.php") ? $this->render($this->data, 'usermenu') : "";
        return $content;
	}

	public function mainmenu(){
        $content = file_exists(PATH_VIEWS . "mainmenu.php") ? $this->render($this->data, 'mainmenu') : "";
        return $content;
	}

    public function mainlogin(){
        $content = file_exists(PATH_VIEWS . "mainlogin.php") ? $this->render($this->data, 'mainlogin') : "";
        return $content;
    }

    public function bottom(){
        $this->data['add_js'] = Application::$app->doc->getScript();
        
        $content = file_exists(PATH_VIEWS . "bottom.php") ? $this->render($this->data, 'bottom') : "";
        return $content;
    }
}
