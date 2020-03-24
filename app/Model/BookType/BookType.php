<?php

namespace App\Model\BookType;

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
    public function lists($params)
    {
        $pch = $this->decryptField($params->pch)->toValue();
        if ($pch === false) return [];

        $row = $this->where('uid', $params->uid)
            ->where('pid', $pch)
            ->orderBy('sort', 'desc')
            ->orderBy('create_time', 'desc')
            ->paginate($params->limit, ['id', 'title', 'remark', 'create_time']);

        return $row;
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
