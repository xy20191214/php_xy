<?php

namespace App\Models\Repository;

class BaseRepository
{
    public $db = 'Mysql'; // 存储媒介种类
    public $model; // 实例
    public $where; // 条件
    public $params; // 参数

    /**
     * 实例模型
     */
    public function __construct()
    {
        $class = get_class($this);

        $namespace = "\\App\\Models\\" . $this->db . "\\" . substr($class, strrpos($class, "\\") + 1);
        $this->model = new $namespace;
    }

    /**
     * 获取指定key值
     * @param $key
     * @return mixed
     */
    public function getParam($key)
    {
        return [
            'id' => $this->params->isId(),
            'uid' => $this->params->isUid(),
        ][$key];
    }

    /**
     * 设置where
     * @param $key
     * @return $this
     */
    public function where($key)
    {
        $this->where[] =[$key, $this->getParam($key)];

        return $this;
    }

    /**
     * 设置状态码
     * @param $int [状态码]
     * @param string $ch [逻辑判断]
     * @return $this
     */
    public function status($int, $ch = '')
    {
        $arr[] = 'status';
        $ch && $arr[] = $ch;
        $arr[] = $int;

        $this->where[] = $arr;

        return $this;
    }

    /**
     * 获取一条数据
     * @return mixed
     */
    public function first()
    {
        if ($this->where)
            foreach ($this->where as $v)
            {
                $this->model = $this->model->where(...$v);
            }

        return $this->model->first();
    }

    /**
     * 设置处理数组
     * @param $params
     * @return mixed
     */
    public function cmn($params)
    {
        $this->params = $params;

        return $this;
    }

    public function get()
    {
        return $this->model->get();
    }

    /**
     * 执行添加或修改
     * @return bool
     */
    public function save()
    {
        $id = $this->getParam('id');

        if ($id)
        {
            $this->model = $this->first();

            if (! $this->model) return false;
        }

        foreach ($this->params->need as $k => $v)
            $this->model->$k = $v;

        return $this->model->save();
    }

    public function __call($method, $params)
    {
        return $this->where($method);
    }
}
