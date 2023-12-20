<?php
namespace Templater\System\Engine\Driver;

use Templater\System\Engine\Databroker;

defined('_RUNKEY') or die;

class Db implements Databroker{
    private $conn;
    private string $tablename;

    public function __construct(){
		// $this->conn = Application::$app->db->getInstance();
		// $this->session = Application::$app->session;
    }

    public function setTableName($name){
    	$this->tablename = $name;
    }

    public function create($data){
		$cols = $vals = '';
		$sql = 'INSERT INTO '.$this->tablename.' (';
		foreach($data as $key => $value){
			$quot = is_string($value) ? "'" : "";
			$cols .= $key.' , ';
			$vals .= $quot.$value.$quot.' , ';
		}
		$cols = substr($cols, 0, -3);
		$vals = substr($vals, 0, -3);
		$sql .= $cols.') VALUES ('.$vals.')';
		$statement = $this->conn->prepare($sql);
		try {
			$statement->execute();
			return $this->conn->lastInsertId();
		} catch(\PDOException $exc) {
			throw new \Exception("Ошибка ".$exc->getCode()." при попытке добавления записи в таблицу  $this->tablename: ".$exc->getMessage());
			return false;
        }
    }

    public function read($fields = null, $condition){

    }

    public function update($data, $condition){

    }

    public function delete($conditions){

    }
}
