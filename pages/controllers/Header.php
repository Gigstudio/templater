<?php
namespace Templater\Controllers;

use Templater\System\Engine\Application;
use Templater\System\Engine\Controller;

class Header extends Controller{
	public function Common(){
        // show($this->data);
        $this->data['page_title'] = Application::$app->doc->getTitle();
		$this->data['lang'] = Application::$app->doc->getLanguage();
		$this->data['charset'] = Application::$app->config->get_cs($this->data['lang']);
        $this->data['description'] = Application::$app->doc->getDescription();
        $this->data['add_css'] = Application::$app->doc->getStyle();
        $this->data['add_js'] = Application::$app->doc->getScript();
        $this->data['add_style'] = Application::$app->doc->getInlineStyles();
        $this->data['site_icon']  = HOME_URL . 'assets/images/' . SITE_ICON_FILE;

        // show(Application::$app->doc);
        // show($this->data);
        // show('Header render in Header controller');
        $content = file_exists(PATH_VIEWS . "header.php") ? $this->render($this->data, 'header') : "";
        return $content;
	}
}
