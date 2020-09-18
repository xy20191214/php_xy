<?php

namespace App\Models\Repository;

use App\Models\Repository\BaseRepositoryBuild;

class BaseRepository
{
    public $db = 'Mysql'; // 存储媒介种类

    /**
     * 设置存储媒介种类
     */
    private function query($method, $params)
    {
        $build = new BaseRepositoryBuild($this->db, get_class($this));
        return $build->$method($params);
    }

    public function __call($method, $params)
    {
        return $this->query($method, ...$params);
    }

    public static function __callStatic($method, $params)
    {
        return (new static)->query($method, ...$params);
    }
}
