<?php

namespace App\Http\Controllers\Book;

use Illuminate\Http\Request;

use App\Library\Base\Controller,
    App\Model\Book\BookType;

class BookTypeController extends Controller
{
    public $data;

    public function __construct(BookType $data)
    {
        $this->data = $data;
    }

    public function handles(Request $request)
    {
        // 操作指针
        $func = $this->outs($request->server('REQUEST_METHOD'));

        return $this->result(200, $this->data->$func(10000, 0));
    }
}
