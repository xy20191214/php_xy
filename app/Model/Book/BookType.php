<?php

namespace App\Model\Book;

use App\Library\Base\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookType extends BaseModel
{
    use SoftDeletes; // 软删除

    public $table = "book_type";
    protected $appends = ['children'];

    /**
     * 获取type列表
     * @param $uid
     * @param $pid
     * @return mixed
     */
    public function lists($uid, $pid)
    {
        $pid = $this->decryptField($pid)->toValue();

        return self::where('uid', $uid)
            ->where('pid', $pid)
            ->orderBy('sort', 'desc')
            ->orderBy('create_time', 'desc')
            ->get(['id', 'title as label', 'remark', 'create_time']);
            //->makeHidden('id'); // 隐藏字段
    }

    /**
     * 设置id的值
     * @return string
     */
    public function getIdAttribute()
    {
        return $this->encrypField($this->attributes['id']);
    }

    /**
     * 设置id的值
     * @return string
     */
    public function getChildrenAttribute()
    {
        return [];
    }
}
