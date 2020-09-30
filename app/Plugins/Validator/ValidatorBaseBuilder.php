<?php


namespace App\Plugins\Validator;


class ValidatorBaseBuilder
{
    public $code; // 状态码
    public $pass = false; // 错误 false没错，true有错

    public function __construct()
    {
        // 获取request参数
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
     * @param array $param
     * @return ValidatorBaseBuilder
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
     * @param $code [错误码]
     * @return ValidatorBaseBuilder
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
