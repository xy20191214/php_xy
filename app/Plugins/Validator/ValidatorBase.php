<?php


namespace App\Plugins\Validator;

use App\Plugins\Tool\Str,
    App\Plugins\Error\Error;

abstract class ValidatorBase
{
    use Str;

    public $need; // 需要的数组
    public $name; // 统一类名
    public $dir; // 统一类名目录
    public $suffix = 'Validator'; // 后缀

    private $uid; // 用户id
    private $ver; // 验证类
    public $pass; // 正确与否开关

    /**
     * 设置接收参数
     */
    public function __construct()
    {
        $this->uid = 10000;
    }


    public function remove()
    {
        $namespce = $this->fullname();

        return (new $namespce)->remove($this);
    }

    public function fullname()
    {
        return $this->repositoryNamespace($this->dir . '\\' . $this->name);
    }

    public function fullnameMysql()
    {
        return $this->mysqlNamespace($this->dir . '\\' . $this->name);
    }

    /**
     * 值是否存在
     * @param string $key
     * @return int
     */
    public function isId($key = 'id')
    {
        return isset($this->ver->$key) ? $this->ver->$key : 0;
    }

    /**
     * 获取uid
     */
    public function isUid()
    {
        return $this->uid;
    }

    public function pass()
    {
        return $this->ver->pass ?? false;
    }

    public function over(...$need)
    {
        if ($this->pass())
        {
            $error = new Error;
            $error->pass = true;
            $error->code = $this->ver->code;

            return $error;
        }

        $this->pass = false;
        foreach ($need as $k => $v)
            isset($this->ver->$v) and $this->need[$v] = $this->ver->$v;

        return $this;
    }

    /**
     * 调整跳转方法
     *
     * @param ValidatorBaseBuilder
     * @param $method [方法名]
     * @param $params [参数]
     * @return $this
     */
    public function __call($method, $params)
    {
        // pass参数为真，也就是有错直接返回本类
        if ($this->pass()) return $this;

        // 跳转验证工具类，为假new，为真直接调用
        ! $this->ver and $this->ver = new ValidatorBaseBuilder;
        $this->ver->$method($params);

        return $this;
    }
}
