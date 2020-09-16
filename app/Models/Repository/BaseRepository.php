<?php

namespace App\Models\Repository;

use ReflectionClass;
use App\Models\Repository\BaseRepositoryBuild;

class BaseRepository
{
    public $db = 'Mysql'; // 存储媒介种类

    public function __construct()
    {
        echo 1;die;
    }

    /**
     * 设置存储媒介种类
     */
    private function query($method)
    {
        $class = new BaseRepositoryBuild;dd($method,$class->a());
        return new BaseRepositoryBuild;
    }

    public static function __callStatic($method, $params)
    {
        return (new static)->query($method, ...$params);
    }
}
