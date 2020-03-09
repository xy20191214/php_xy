<?php

namespace App\Model\Book;

use App\Library\Base\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookType extends BaseModel
{
    use SoftDeletes; // 软删除
    public $timestamps = true;

    public $table = "book_type";
    protected $appends = ['children'];

    /**
     * 添加修改数据
     * @return mixed
     */
    public function adds($request)
    {
        // 判断id，有修改，无添加
        $save = $this->where('id', $request->id)->first() ?? $this;

        $save->title = $request->title;
        $request->pid !== '' && $save->pid = $request->pid; // 判断添加子集

        return $save->save();
    }

    /**
     * 获取type列表
     * @param $request 参数
     * @param $uid uid
     * @return mixed
     */
    public function lists($request)
    {
        $pid = $this->decryptField($request->id)->toValue();
        if ($pid === false) return [];

        return self::where('uid', $request->uid)
            ->where('pid', $pid)
            ->orderBy('sort', 'desc')
            ->orderBy('create_time', 'desc')
            ->get(['id', 'title', 'remark', 'create_time']);
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
