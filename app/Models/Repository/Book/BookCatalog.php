<?php

namespace App\Models\Repository\Book;

use App\Models\Repository\BaseRepository;

class BookCatalog extends BaseRepository
{
    public $db = 'Mysql';

    /**
     *
     */
    public function write($params)
    {
        return $this->save($params);
    }
}
