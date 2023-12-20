<?php
namespace Templater\System\Engine\Driver;

use Templater\System\Engine\Databroker;

defined('_RUNKEY') or die;

class Json implements Databroker{
    private $conn;
    private string $filename;

    public function __construct(){
		// $this->conn = Application::$app->db->getInstance();
		// $this->session = Application::$app->session;
    }

    public function setFileName($name){
    	$this->filename = $name;
    }

    public function create($data){
        
    }

    public function read($fields = null, $condition){

    }

    public function update($data, $condition){

    }

    public function delete($conditions){

    }
}
