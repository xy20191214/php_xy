<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\BaseController,
    App\Models\Repository\Book\BookCatalog,
    App\Plugins\Validator\BookValidator;

use Illuminate\Http\Request;

class BookCatalogController extends BaseController
{
    public $bc; // mysql数据模型
    public $bv; // 验证

    public function __construct(BookCatalog $bc, BookValidator $bv)
    {
        $this->bc = $bc;
        $this->bv = $bv;
    }

    public function read()
    {
        $params = $this->ver->iGet();
        $params->uid = 10000;

        return $this->result(200, $this->booktype->lists($params));
    }

    public function remove()
    {
        $param = $this->bv->write();
        if ($param->pass) return $this->result($param->code);
    }

    public function write()
    {
        $param = $this->bv->write();
        if ($param->pass) return $this->result($param->code);

        return $this->bc->write($param) ? $this->result(201) : $this->result(10000);
    }
}
