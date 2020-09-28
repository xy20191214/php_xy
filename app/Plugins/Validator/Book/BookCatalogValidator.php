<?php


namespace App\Plugins\Validator\Book;

use App\Plugins\Validator\ValidatorBase;

class BookCatalogValidator extends ValidatorBase
{
    public $name = "BookCatalog";

    /**
     * 验证
     * @return mixed
     */
    public function write()
    {
        return $this->must('type', 'title')->length('title', 100, 1)->over('type', 'title', 'pid');
    }

    /**
     * 验证id
     */
    public function verId()
    {
        return $this->must('id')->end('id')->remove();
    }
}
