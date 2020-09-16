<?php

namespace App\Models\Repository;

class BaseRepositoryBuild
{
    /**
     * 设置存储媒介种类
     */
    public function db($db)
    {
        $this->db = $db;

        return $this;
    }

    public function a()
    {
        return 1;
    }
}
