<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller,
    App\Models\Mysql\Book;

use Illuminate\Http\Request;

class BookCatalogController extends Controller
{
    public $book; // mysql数据模型
    public $ver; // 验证

    public function __construct(Book $book, BookTypeValidator $validator)
    {
        $this->Book = $book;
        $this->ver = $validator;
    }

    public function read()
    {
        $params = $this->ver->iGet();
        $params->uid = 10000;

        return $this->result(200, $this->booktype->lists($params));
    }

    public function remove()
    {

    }

    public function write()
    {
        $param = $this->ver->iSave();
        if ($param->pass) return $this->result($param->code);

        return $this->booktype->adds($param->params) ? $this->result(201) : $this->result(10000);
    }
}
