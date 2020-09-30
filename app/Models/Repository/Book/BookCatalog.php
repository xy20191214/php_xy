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
    public function alter($validator)
    {
        // 状态:3-审核通过/2-审核中/1-待审核/0/-1-审核不通过/-2-封禁/-3-软删除
        return $this->cmn($validator) // 简易模式
            ->uid()
            ->id()
            ->soltDelete()
            ->alter();
    }

    /**
     * 软删除
     * @param $validator
     * @return mixed
     */
    public function remove($validator)
    {
        return $this->cmn($validator) // 简易模式
            ->uid()
            ->id()
            ->remove();
    }
}
