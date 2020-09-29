<?php


namespace App\Plugins\Validator;


class ValidatorBaseBuilder
{
    public $code; // 状态码
    public $pass = false; // 错误 false没错，true有错
    private $name;

    public function __construct()
    {
        $this->params(request()->all());
    }

    /**
     * 设置数据
     * @param array $params [数据]
     * @return void
     */
    public function params(array $params)
    {
        foreach ($params as $k => $v) {
            $this->$k = $v;
        }
    }

    /**
     * 长度
     * @param $key [键名]
     * @param $max [最大长度]
     * @param $min [最小长度]
     * @return $this
     */
    public function length(array $param)
    {
        $len = strlen($param[0]);

        if ($len < $param[2]) return $this->end([10001, $param[0], $param[2]]);
        if ($len > $param[1]) return $this->end([10002, $param[0], $param[1]]);

        return $this;
    }

    /**
     * 结束闭环增加工具方法
     * @param $keys [keys需要的参数]
     * @return ValidatorBase
     */
    public function end($code)
    {
        $this->pass = true;
        $this->code = $code;

        return $this;
    }

    /**
     * 必填项
     * @param array $keys
     * @return $this
     */
    public function must(array $keys)
    {
        foreach ($keys as $v) {
            if (! $this->notFlase($v)) return $this->end(1000);
        }

        return $this;
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
}
