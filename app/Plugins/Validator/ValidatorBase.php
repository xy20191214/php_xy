<?php
namespace App\Plugins\Validator;

class ValidatorBase
{
    public $params = []; // 请求参数
    public $pass = false; // 错误

    /**
     * 设置接收参数
     */
    public function __construct()
    {
        $this->params(request()->all());
    }

    /**
     * 前置方法
     * @return $this
     */
    public function before()
    {
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
            if (! $this->notFlase($v)) return $this->error([10000, $v]);
        }

        return $this;
    }

    /**
     * 设置数据
     * @param $params 数据
     * @return $this
     */
    public function params($params)
    {
        is_array($params) && $this->params = (object)$params;
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
     * 长度
     * @param $key 键名
     * @param $max 最大长度
     * @param $min 最小长度
     * @return $this
     */
    public function isLength($key, $max, $min)
    {
        $len = strlen($this->params->$key);

        $len < $min && $this->error([10001, $key, $max]);
        $len > $max && $this->error([10002, $key, $min]);

        return $this;
    }


    /**
     * 设置错误
     * @param int $code 错误码
     */
    public function error($code = 404)
    {
        $this->pass = true;
        $this->code = $code;

        return $this;
    }

    public function __call($method, $params)
    {
        if (! method_exists($this, $method))
        {
            $temp = $this->before();
            if ($temp) return $temp;
            $method = 'is' . ucfirst($method);
            return $this->$method(...$params);
        }
    }
}
