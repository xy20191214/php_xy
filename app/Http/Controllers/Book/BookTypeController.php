<?php

namespace App\Http\Controllers\Book;

use Illuminate\Http\Request;

use App\Library\Base\Controller,
    App\Model\BookType\BookType,
    App\Model\BookType\BookTypeValidator;

class BookTypeController extends Controller
{
    public $booktype; // mysql数据模型
    public $ver; // 验证

    public function __construct(BookType $booktype, BookTypeValidator $validator)
    {
        $this->booktype = $booktype;
        $this->ver = $validator;
    }

    public function iGet()
    {
        $params = $this->ver->iGet();
        $params->uid = 10000;

        return $this->result(200, $this->booktype->lists($params));
    }

    public function iSave()
    {
        $param = $this->ver->iSave();
        if ($param->pass) return $this->result($param->code);

        return $this->booktype->adds($param->params) ? $this->result(201) : $this->result(10000);
    }
}
