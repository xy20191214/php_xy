<?php

namespace App\Models\Repository\Book;

use App\Models\Repository\BaseRepository;

class BookCatalog extends BaseRepository
{
    /**
     *
     */
    public function write()
    {
        return $this->a('Mysql');
    }
}
