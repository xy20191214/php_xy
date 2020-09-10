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
     * 是否为空
     * @param $key 键名
     * @return $this
     */
    public function not($key)
    {
        ! $this->notFlase($key) && $this->error([10000, $key]);
        die;
        return $this;
    }

    /**
     * 长度
     * @param $key 键名
     * @param $max 最大长度
     * @param $min 最小长度
     * @return $this
     */
    public function length($key, $max, $min)
    {
        $this->not($key);
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
}
