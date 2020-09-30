<?php

namespace App\Models\Repository;

class BaseRepository
{
    public $db; // 存储媒介种类
    public $where; // 条件
    public $params; // 参数
    /**
     * @var BaseRepositoryEasyMode 简易模式
     */
    public $mode; // 模式

    /**
     * 简易模式
     * @param $validator
     * @return mixed
     */
    public function cmn($validator)
    {
        $easyMode = new BaseRepositoryEasyMode($validator);
        $this->mode = $easyMode;

        return $this;
    }

    /**
     * @remark mode属性为选择模式
     * @param $method
     * @param $params
     * @return BaseRepositoryEasyMode|bool
     */
    public function __call($method, $params)
    {
        if ($this->mode) return $this->mode;

        return false;
    }
}
