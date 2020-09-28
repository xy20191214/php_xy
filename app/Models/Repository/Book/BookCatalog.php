<?php


namespace App\Models\Repository\Book;

use App\Models\Repository\BaseRepository;

class BookCatalog extends BaseRepository
{
    public $db = 'Mysql';

    /**
     * 写入数据
     * @param $params
     * @return $this
     */
    public function write($validator)
    {
        return $this->cmn($validator) // 简易模式
            ->uid()
            ->id()
            ->status(-3, '!=')
            ->save();
    }
}
