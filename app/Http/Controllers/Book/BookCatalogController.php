<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\BaseController,
    App\Models\Repository\Book\BookCatalog,
    App\Plugins\Validator\BookValidator;

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

    }

    public function remove()
    {
        $param = $this->bv->verId();
        if ($param->pass) return $this->result($param->code);dd($param);

        return 1;
    }

    public function write()
    {
        $param = $this->bv->write();dd($param);
        if ($param->pass) return $this->result($param->code);

        return $this->bc->write($param) ? $this->result(201) : $this->result(10000);
    }
}
