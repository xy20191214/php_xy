<?php

namespace App\Models\Mysql\Book;

use App\Models\Mysql\BaseModel;

class BookCatalog extends BaseModel
{
    protected $table = 'xy_book_catalog';

    public $fields = [
        'remove' => 'id',
        'alter' => 'id',
        'get' => '',
    ];
}
