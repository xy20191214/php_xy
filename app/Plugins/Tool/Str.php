<?php


namespace App\Plugins\Tool;


trait Str
{
    public function mysqlNamespace($str)
    {
        return "\\App\\Models\\Mysql\\" . $str;
    }

    public function repositoryNamespace($str)
    {
        return "\\App\\Models\\Repository\\" . $str;
    }
}
