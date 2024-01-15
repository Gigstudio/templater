<?php
namespace Templater\Controllers;
defined('_RUNKEY') or die;

use Templater\System\Engine\Controller;
use Templater\System\Engine\Application;
use Templater\System\Engine\Request;
use Templater\System\Engine\Response;

class Auth extends Controller{
    public function __construct(){
        // $pars = Application::$app->request->getQueryParams();
        $this->setLayout('auth');
        $this->pagesetup();
    }

    public function login(Request $request, Response $response){
        $this->data['page'] = 'login';
        $this->data['activeform'] = 'login';
        $this->common($request, $response);

        return $this->render($this->views);
    }

    public function register(Request $request, Response $response){
        $this->data['page'] = 'login';
        $this->data['activeform'] = 'register';
        $this->common($request, $response);
        return $this->render($this->views);
    }

    private function common(Request $request, Response $response){
        $this->data['error'] = [];
        $this->data['user_input'] = [];
        if ($request->isPost()){
            $data = $request->getBody();
            $this->data['user_input'] = $data;
            dump($data);
        }
        $this->views['topmenu'] = $this->load_controller('menu', 'toplogin', $this->data);
        $this->views['content'] = $this->load_view('auth-login');
        $this->views['bottom'] = $this->load_controller('menu', 'bottom', $this->data);

    }

    public function authenticate(){

    }

    private function pagesetup(){
        $this->data['error'] = [];
        $this->data['user_input'] = [];
        $add_js = ['main.js', 'auth.js'];
        $add_css = [
            'fonts/fontawesome/css/fontawesome.css',
            'fonts/fontawesome/css/brands.css',
            'fonts/fontawesome/css/solid.css',
            'css/flag-icons.css',
            'css/colors.css',
            'css/fonts.css',
            'css/default.css',
            'css/auth.css',
            'css/media.css'
        ];
        $ins_css = [
            'body' => [
                'background-color' => 'var(--t06)'
            ]
        ];

        // if($User->isLogged()){
            // $this->data['user'] = $User->getCurrent()[0];
        // }

        Application::$app->doc->setTitle(Application::$app->config->get('sitetitle'));
        Application::$app->doc->setLanguage(Application::$app->config->get('default_language'));
        Application::$app->doc->setDescription(Application::$app->config->get('sitedescription'));
        Application::$app->doc->addStyle($add_css);
        Application::$app->doc->addInlineStyle($ins_css);
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