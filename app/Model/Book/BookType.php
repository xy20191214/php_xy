<?php

namespace App\Model\Book;

use App\Library\Base\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookType extends BaseModel
{
    use SoftDeletes;

    public $table = "book_type";
    protected $appends = ['ch'];

    /**
     * 获取全部数据
     * @param $a
     * @author cy
     */
    public function lists($uid, $pid)
    {
        return self::where('uid', $uid)
            ->where('pid', $pid)
            ->orderBy('sort', 'desc')
            ->orderBy('create_time', 'desc')
            ->get(['id', 'title', 'remark', 'create_time'])
            ->makeHidden('id');
    }

    public function getChAttribute()
    {
        return $this->encrypField($this->attributes['id']);
    }
}
