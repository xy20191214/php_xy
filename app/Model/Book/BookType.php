<?php

namespace App\Model\Book;

use App\Library\Base\BaseModel;

class BookType extends BaseModel
{
    public $table = "book_type";

    /**
     * 获取全部数据
     * @param $a
     * @author cy
     */
    public static function lists()
    {
        return self::where()->where()->get();
    }
}
