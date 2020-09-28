<?php


namespace App\Plugins\Tool;


trait Str
{
    public function mysqlNamespace($str)
    {
        return "\\App\\Models\\Mysql\\" . $str;
    }
}
