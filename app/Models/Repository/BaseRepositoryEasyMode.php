<?php


namespace App\Models\Repository;

use App\Plugins\Tool\Str;


class BaseRepositoryEasyMode
{
    use str;

    public $where;
    public $object;

    public $model; // 数据模型实例

    public function __construct($object)
    {
        $this->object = $object;
        $namespace = $this->mysqlNamespace($object->name);
        $this->model = new $namespace;
    }

    /**
     * 设置where
     * @param array $param
     * @return $this
     */
    public function where(...$param)
    {
        $this->where[] = $param;

        return $this;
    }

    public function uid()
    {
        $this->where('uid', $this->object->isUid());

        return $this;
    }

    public function id()
    {
        $this->where('id', $this->object->isId());

        return $this;
    }

    public function status($num, $ch = '')
    {
        $this->where('status', $ch, $num);

        return $this;
    }

    /**
     * 执行添加或修改
     * @return bool
     */
    public function save()
    {
        $id = $this->object->isId();

        if ($id)
        {
            $this->model = $this->first();
            if (! $this->model) return false;
        }

        foreach ($this->object->need as $k => $v)
            $this->model->$k = $v;

        return $this->model->save();
    }

    /**
     * 获取一条数据
     * @return mixed
     */
    public function first()
    {
        if ($this->where)
            $this->model = $this->model->where($this->where);

        return $this->model->first();
    }
}
