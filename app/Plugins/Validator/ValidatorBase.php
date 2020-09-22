<?php
namespace App\Plugins\Validator;

abstract class ValidatorBase
{
    public $pass = false; // 错误
    public $need; // 需要的数组
    public $code; // 状态码

    private $uid; // 用户id

    /**
     * 设置接收参数
     */
    public function __construct()
    {
        $this->uid = 10000;
        $this->params(request()->all());
    }

    /**
     * 前置方法
     * @return bool|ValidatorBase
     */
    public function before()
    {
         // 如果有报错直接返回this
        if ($this->pass) return $this;

        return false;
    }

    /**
     * 必填项
     * @param array $keys
     * @return $this
     */
    public function isMust(array $keys)
    {
        foreach ($keys as $v)
        {
            if (! $this->notFlase($v)) return $this->error(1000);
        }

        return $this;
    }

    /**
     * 设置数据
     * @param array $params [数据]
     * @return void
     */
    public function params(array $params)
    {
        foreach ($params as $k => $v)
        {
            $this->$k = $v;
        }
    }

    /**
     * 不是假，且被设置
     * @param $key [键名]
     * @return bool
     */
    public function notFlase($key)
    {
        return isset($this->$key) && $this->$key ? true : false;
    }

    /**
     * 长度
     * @param $key [键名]
     * @param $max [最大长度]
     * @param $min [最小长度]
     * @return $this
     */
    public function isLength($key, $max, $min)
    {
        $len = strlen($this->$key);

        $len < $min && $this->error([10001, $key, $max]);
        $len > $max && $this->error([10002, $key, $min]);

        return $this;
    }

    /**
     * 结束闭环增加工具方法
     * @param $keys [keys需要的参数]
     * @return ValidatorBase
     */
    public function end($keys)
    {
        foreach ($this as $k => $v)
        {
            if (in_array($k, $keys)) $this->need[$k] = $v;
        }

        return $this;
    }

    /**
     * 值是否存在
     * @param string $key
     * @return int
     */
    public function isId($key = 'id')
    {
        return isset($this->$key) ? $this->$key : 0;
    }

    /**
     * 获取uid
     */
    public function isUid()
    {
        return $this->uid;
    }

    /**
     * 设置错误
     * @param int $code 错误码
     * @return ValidatorBase
     */
    public function error($code = 404)
    {
        $this->pass = true;
        $this->code = $code;

        return $this;
    }

    public function __call($method, $params)
    {
        $temp = $this->before();
        if ($temp) return $temp;
        $method = 'is' . ucfirst($method);
        return $this->$method(...$params);
    }
}
