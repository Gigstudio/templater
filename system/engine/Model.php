<?php
namespace Templater\System\Engine;
defined('_RUNKEY') or die;

class Model{
    // protected Session $session;
    public string $driver;
    private string $filename;

    public function __construct($driver){
        $this->driver = $driver;
        $class = 'Templater\System\Engine\Driver\\'.ucfirst($this->driver);
        if(class_exists($class)){
            echo $class;
        }
		// $this->conn = Application::$app->db->getInstance();
		// $this->session = Application::$app->session;
    }

    public function setFileName($name){
    	$this->filename = $name;
    }
}
