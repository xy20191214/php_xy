<?php

namespace App\Http\Controllers\Book;

use Illuminate\Http\Request;

use App\Library\Base\Controller,
    App\Model\BookType\BookType,
    App\Model\BookType\BookTypeValidator;

class BookTypeController extends Controller
{
    public $booktype;

    public function __construct(BookType $booktype)
    {
        $this->booktype = $booktype;
    }

    public function iGet(Request $re, BookTypeValidator $validator)
    {
        // 操作指针
        $params = $validator->iGet($re);
        $params->uid = 10000;

        return $this->result(200, $this->booktype->lists($params));
    }

    public function iSave()
    {
        $request->pid = $request->pid ?? '';
        if (! $request->title) return $this->result(10000);
    }
}
