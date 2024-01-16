<?php
namespace Templater\Controllers;

use Templater\System\Engine\Application;
use Templater\System\Engine\Controller;

class Menu extends Controller{
	public function topmain(){
        // $this->data['usermenu'] = $this->load_controller('menu', 'menu.usermenu', $this->data);
        $this->data['mainmenu'] = $this->load_controller('menu', 'main', $this->data);

        $content = file_exists(PATH_VIEWS . "menu.topmain.php") ? $this->render($this->data, 'menu.topmain') : "";
        return $content;
	}

    public function toplogin(){
        $this->data['mainmenu'] = $this->load_controller('menu', 'mainlogin', $this->data);
        
        $content = file_exists(PATH_VIEWS . "menu.toplogin.php") ? $this->render($this->data, 'menu.toplogin') : "";
        return $content;
    }

    public function topadmin(){
        $this->data['searchfield'] = $this->load_view('searchfield');
        
        $content = file_exists(PATH_VIEWS . "menu.topadmin.php") ? $this->render($this->data, 'menu.topadmin') : "";
        return $content;
    }

	public function usermenu(){
        $content = file_exists(PATH_VIEWS . "menu.usermenu.php") ? $this->render($this->data, 'menu.usermenu') : "";
        return $content;
	}

	public function main(){
        $content = file_exists(PATH_VIEWS . "menu.main.php") ? $this->render($this->data, 'menu.main') : "";
        return $content;
	}

    public function mainlogin(){
        $content = file_exists(PATH_VIEWS . "menu.mainlogin.php") ? $this->render($this->data, 'menu.mainlogin') : "";
        return $content;
    }

    public function mainadmin(){
        $content = file_exists(PATH_VIEWS . "menu.mainadmin.php") ? $this->render($this->data, 'menu.mainadmin') : "";
        return $content;
    }

	public function side(){
        $content = file_exists(PATH_VIEWS . "menu.side.php") ? $this->render($this->data, 'menu.side') : "";
        return $content;
	}

	public function sideadmin(){
        $content = file_exists(PATH_VIEWS . "menu.sideadmin.php") ? $this->render($this->data, 'menu.sideadmin') : "";
        return $content;
	}

    public function bottom(){
        $this->data['add_js'] = Application::$app->doc->getScript();
        
        $content = file_exists(PATH_VIEWS . "menu.bottom.php") ? $this->render($this->data, 'menu.bottom') : "";
        return $content;
    }

    public function bottomadmin(){
        $this->data['add_js'] = Application::$app->doc->getScript();
        
        $content = file_exists(PATH_VIEWS . "menu.bottomadmin.php") ? $this->render($this->data, 'menu.bottomadmin') : "";
        return $content;
    }

	public function search(){
        $content = file_exists(PATH_VIEWS . "menu.search.php") ? $this->render($this->data, 'menu.search') : "";
        return $content;
    }
}
