<?php
namespace Templater\Controllers;
defined('_RUNKEY') or die;

use Templater\System\Engine\Controller;
use Templater\System\Engine\Application;
use Templater\System\Engine\Request;
use Templater\System\Engine\Response;

class Admin extends Controller{
    public function __construct(){
        $this->setLayout('admin');
        $this->pagesetup();
    }

    public function migration(Request $request, Response $response){
        $this->data['page'] = 'migration';
        
        $this->views['topmenu'] = $this->load_controller('menu', 'topadmin', $this->data);
        // $this->views['search'] = $this->load_controller('menu', 'search', $this->data);
        $this->views['content'] = $this->load_view('admin-migrate');
        $this->views['bottom'] = $this->load_controller('menu', 'bottomadmin', $this->data);

        return $this->render($this->views);
    }

    private function pagesetup(){
        // if($User->isLogged()){
            // $this->data['user'] = $User->getCurrent()[0];
            // check if user have admin perrmission, if no - redirect to index or ...
        // }

        $this->data['error'] = [];
        $this->data['user_input'] = [];
        $add_js = ['main.js', 'admin.js'];
        $add_css = [
            'fonts/fontawesome/css/fontawesome.css',
            'fonts/fontawesome/css/brands.css',
            'fonts/fontawesome/css/solid.css',
            'css/flag-icons.css',
            'css/colors.css',
            'css/fonts.css',
            'css/default.css',
            'css/admin.css',
            'css/media.css'
        ];
        $ins_css = [
            'body' => [
                'background-color' => 'var(--t06)'
            ]
        ];

        Application::$app->doc->setTitle(Application::$app->config->get('sitetitle'));
        Application::$app->doc->setLanguage(Application::$app->config->get('default_language'));
        Application::$app->doc->setDescription(Application::$app->config->get('sitedescription'));
        Application::$app->doc->addStyle($add_css);
        Application::$app->doc->addInlineStyle($ins_css);
        Application::$app->doc->addScript($add_js);

        $this->views['header'] = $this->load_controller('header', 'common', $this->data);

        // $flashes = Application::$app->session->getFlashes();
        // if($flashes){
        //     $this->data['flash_messages'] = $flashes;
        // }
    }
}