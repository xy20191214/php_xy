<?php
namespace App\Library\Base;

use App\Library\Error\ValidatorError;

class ValidatorBase
{
    public $params; // 请求参数
    public $error; // 错误类
    public $pass = false; // 错误
    public $code; // 错误码

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
     * @param $key 默认值键名
     * @param $val 默认值
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
     * 不是假，且被设置
     * @param $key 键名
     * @return bool
     */
    public function notFlase($key)
    {
        return isset($this->params->$key) && $this->params->$key ? true : false;
    }

    /**
     * 直接返回结果
     */
    public function result()
    {
        return $this;
    }

    /**
     * 是否为空
     * @param $key 键名
     * @return $this
     */
    public function isempty($key)
    {
        ! $this->notFlase($key) && $this->error(10000);

        return  $this;
    }

    /**
     * 设置错误
     * @param int $code 错误码
     */
    public function error($code = 404)
    {
        $this->pass = true;
        $this->error = new ValidatorError($code); // 错误类

        $func = function ()
        {
            return $this->error->errorCode;
        };

        $this->code = $func();

        return $this;
    }
}
