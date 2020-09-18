<?php

namespace App\Models\Repository\Book;

use App\Models\Repository\BaseRepository;

class Book extends BaseRepository
{
    /**
     *
     */
    public function writes()
    {
        return $this->db('Mysql');
    }
}
