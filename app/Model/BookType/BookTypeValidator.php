<?php
namespace App\Model\BookType;

use App\Library\Base\ValidatorBase;

class BookTypeValidator extends ValidatorBase
{
    public function iGet($re)
    {
        return $this->params($re->all())
            ->default('pch', 0)
            ->default('limit', 10)
            ->result();
    }
}
