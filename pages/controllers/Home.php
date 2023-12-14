<?php
namespace Templater\Controllers;
defined('_RUNKEY') or die;

use Templater\System\Engine\Controller;
use Templater\System\Engine\Application;

class Home extends Controller{
    public function __construct(){
        // $pars = Application::$app->request->getQueryParams();
        $this->pagesetup();
        // dump($this->views);
    }

    public function construction(){
        $this->setLayout('error');
        $this->data['errimage'] = '';
        $this->data['errcode'] = '403';
        // Use language here! Dont hardcode!
        $this->data['errmessage'] = 'Извините, страница находится на стадии разработки. Работа сервиса будет восстановлена в ближайшее время!';
        $this->views['errormenu'] = $this->load_controller('menu', 'errormenu', $this->data);
        return $this->render($this->views);
        // exit;
    }

    public function index($request){
        $pars = $request->getQueryParams();
        if(!array_key_exists('check',$pars)){
            header("Location: construction");
            // $this->construction();
            // exit;
        }
        // echo $this->views['header'];
        // 1. compose header
        // 2. create top menu
        // 3. create user menu
        // 4. create main menu
        // 5. create ribbon content
        // 6. create side menu
        // 7. create carousel content
        // 8. create MAIN content
        // 9. create bottom menu
        // 10. get layout
        // 11. replace all {{vars}} with code if exist

        $this->views['topmenu'] = $this->load_controller('menu', 'topmenu', $this->data);
        // $this->views['usermenu'] = $this->load_controller('menu', 'usermenu', $this->data);
        // $this->views['mainmenu'] = $this->load_controller('menu', 'mainmenu', $this->data);
        // $this->views['bottom'] = $this->load_controller('menu', 'bottom', $this->data);

        return $this->render($this->views);
        // dump($this->views);
    }

    private function pagesetup(){
        $add_js = ['main.js'];
        $add_css = [
            'fonts/fontawesome/css/fontawesome.css',
            'fonts/fontawesome/css/brands.css',
            'fonts/fontawesome/css/solid.css',
            'css/flag-icons.css',
            'css/colors.css',
            'css/default.css',
            'css/fonts.css'
        ];
        $add_style = [
            // 'body' => [
            //     'background-image' => 'linear-gradient(0deg, var(--t02), var(--t02)), url("' . HOME_URL . 'assets/images/cleanbg03.jpg")'
            // ]
        ];

        // if($User->isLogged()){
            // $this->data['user'] = $User->getCurrent()[0];
        // }


        // echo 'Home controller<br>';
        Application::$app->doc->setTitle(Application::$app->config->get('sitetitle'));
        Application::$app->doc->setLanguage(Application::$app->config->get('default_language'));
        Application::$app->doc->setDescription(Application::$app->config->get('sitedescription'));
        Application::$app->doc->addInlineStyle($add_style);
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