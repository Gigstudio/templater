<?php
namespace Templater\Controllers;
defined('_RUNKEY') or die;

use Templater\System\Engine\Controller;

class Home extends Controller{
    public function index(){
        show('index method in Templater controller');
    }
}