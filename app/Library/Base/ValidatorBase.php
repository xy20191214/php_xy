<?php
namespace App\Library\Base;

class ValidatorBase
{
    protected $params; // 请求参数

    /**
     * 设置数据
     * @param $params 数据
     * @return $this
     */
    public function params($params)
    {
        is_array($params) && $this->params = (object)$params;

        return $this;
    }

    /**
     * 设置默认值
     * @param $key
     * @param $val
     * @return $this
     */
    public function default($key, $val)
    {
        if (! $this->notFlase($key))
        {
            $this->params->$key = $val;
        }

        return $this;
    }

    /**
     * 不是假切被设置
     * @param $key 键名
     * @return bool
     */
    public function notFlase($key)
    {
        return isset($this->params->$key) && $this->params->$key ? true : false;
    }

    /**
     * 获取结果
     */
    public function result()
    {
        return $this->params;
    }
}
