<?php
namespace Templater\System\Engine;
defined('_RUNKEY') or die;

interface Databroker{
    public function create($data);
    public function read($fields = null, $condition);
    public function update($data, $condition);
    public function delete($conditions);
}