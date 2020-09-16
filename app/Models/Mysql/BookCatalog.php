<?php

namespace App\Models\Mysql;

use Illuminate\Database\Eloquent\Model;

class BookCatalog extends Model
{
    protected $table = 'xy_book_catalog';

    public function write()
    {
        return $this->get();
    }
}
