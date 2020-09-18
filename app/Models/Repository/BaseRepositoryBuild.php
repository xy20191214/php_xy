<?php

namespace App\Models\Repository;

class BaseRepositoryBuild
{
    public $model;

    public function __construct($db, $class)
    {
        $namespace = "\\App\\Models\\" . $db . "\\" . substr($class, strrpos($class, "\\") + 1);
        $this->model = new $namespace;
    }

    public function save($params)
    {
        ($id = $params->isId()) && $this->model = $this->model->find($id);
        dd($params->isId(),$this->model->where([]));
    }
}
