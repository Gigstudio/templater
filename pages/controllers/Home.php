<?php
namespace Templater\Controllers;
defined('_RUNKEY') or die;

use Templater\System\Engine\Controller;
use Templater\System\Engine\Application;

class Home extends Controller{
    public function __construct(){
        // $pars = Application::$app->request->getQueryParams();
        $this->pagesetup();
    }

    public function index($request){
        $this->data['page'] = '';
        $abspath = PATH_ASSETS.'images/miniatures/';
        $relpath = 'assets/images/miniatures/';
        $this->data['slides'] = $this->get_files($abspath, $relpath, ['jpg', 'jpeg']);
        
        $this->views['topmenu'] = $this->load_controller('menu', 'topmenu', $this->data);
        $this->views['search'] = $this->load_controller('menu', 'search', $this->data);
        // $this->views['usermenu'] = $this->load_controller('menu', 'usermenu', $this->data);
        $this->views['content'] = $this->load_view('home');
        $this->views['bottom'] = $this->load_controller('menu', 'bottom', $this->data);

        return $this->render($this->views);
    }

    public function plans($request){
        $this->data['page'] = 'plans';
        $this->data['sidemenuitems'] = [
            ['name'=>'plans', 'title'=>'Тарифы'], 
            ['name'=>'payments', 'title'=>'Способы оплаты'], 
            ['name'=>'terms', 'title'=>'Пользовательское соглашение'], 
            ['name'=>'policy', 'title'=>'Политика конфиденциальности']
        ];
        
        $this->views['topmenu'] = $this->load_controller('menu', 'topmenu', $this->data);
        $this->views['sidemenu'] = $this->load_controller('menu', 'sidemenu', $this->data);
        // $this->views['usermenu'] = $this->load_controller('menu', 'usermenu', $this->data);
        $this->views['content'] = $this->load_view('plans');
        $this->views['bottom'] = $this->load_controller('menu', 'bottom', $this->data);

        return $this->render($this->views);
    }

    private function pagesetup(){
        $add_js = ['main.js'];
        $add_css = [
            'fonts/fontawesome/css/fontawesome.css',
            'fonts/fontawesome/css/brands.css',
            'fonts/fontawesome/css/solid.css',
            'css/flag-icons.css',
            'css/colors.css',
            'css/fonts.css',
            'css/default.css',
            'css/media.css'
        ];

        // if($User->isLogged()){
            // $this->data['user'] = $User->getCurrent()[0];
        // }

        Application::$app->doc->setTitle(Application::$app->config->get('sitetitle'));
        Application::$app->doc->setLanguage(Application::$app->config->get('default_language'));
        Application::$app->doc->setDescription(Application::$app->config->get('sitedescription'));
        Application::$app->doc->addStyle($add_css);
        Application::$app->doc->addScript($add_js);

        $this->views['header'] = $this->load_controller('header', 'common', $this->data);
        // $this->views['topmenu'] = $this->load_controller('menu', 'topmenu', $this->data);
        // $this->views['mainmenu'] = $this->load_controller('menu', 'mainmenu', $this->data);
        // $this->views['bottom'] = $this->load_controller('menu', 'bottom', $this->data);

        // $flashes = Application::$app->session->getFlashes();
        // if($flashes){
        //     $this->data['flash_messages'] = $flashes;
        // }
    }
}