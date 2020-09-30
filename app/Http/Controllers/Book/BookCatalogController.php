<?php


namespace App\Http\Controllers\Book;

use App\Http\Controllers\BaseController,
    App\Models\Repository\Book\BookCatalog,
    App\Plugins\Validator\Book\BookCatalogValidator;

class BookCatalogController extends BaseController
{
    public $bc; // mysql数据模型
    public $bv; // 验证

    public function __construct(BookCatalog $bc, BookCatalogValidator $bv)
    {
        $this->bc = $bc;
        $this->bv = $bv;
    }

    public function read()
    {

    }

    public function remove()
    {
        // 验证
        $validator = $this->bv->verId();
        if ($validator->pass) return $this->result($validator->code);

        // 执行与返回
        return $this->httpsuccess($validator->remove());
    }

    public function write()
    {
        $validator = $this->bv->write();
        if ($validator->pass) return $this->result($validator->code);

        return $this->httpsuccess($validator->alter());
    }
}
