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
        $namespace = $object->fullnameMysql();
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

    /**
     * 简易uid条件
     * @return $this
     */
    public function uid()
    {
        $this->where('uid', $this->object->isUid());

        return $this;
    }

    /**
     * 简易id条件
     * @return $this
     */
    public function id()
    {
        $this->where('id', $this->object->isId());

        return $this;
    }

    /**
     * 简易状态条件
     * @param $num [状态码]
     * @param string $ch [逻辑操作符]
     * @return $this
     */
    public function status($num, $ch = '')
    {
        $this->where('status', $ch, $num);

        return $this;
    }

    /**
     * 软删除
     * @return $this
     */
    public function soltDelete()
    {
        return $this->status(config('base.status.soft_delete'), '!=');
    }

    /**
     * 执行添加或修改
     * @return int
     */
    public function alter()
    {
        // 检查id是否存在
        $id = $this->object->isId();

        // 有则查询
        if ($id)
        {
            $this->model = $this->first(__FUNCTION__);
            if (! $this->model) return 501;

        }else
            $this->model->created_at = time();
        $this->model->updated_at = time();

        // 否则利用构造方法实例化model模型
        foreach ($this->object->need as $k => $v)
            $this->model->$k = $v;

        return $this->model->save() ? ($id ? 204 : 201) : 501;
    }

    /**
     * 软删除 修改状态-3
     * @return int|null
     */
    public function remove()
    {
        $id = $this->object->isId();

        if ($id)
        {
            $this->model = $this->soltDelete()->first(__FUNCTION__);
            if (! $this->model) return 501;
            $this->model->status = -3;

            return $this->model->save() ? 204 : 501;
        }

        return 501;
    }

    /**
     * 获取一条数据
     * @param string $field
     * @return mixed
     */
    public function first($field = 'get')
    {
        if ($this->where)
            return $this->model->where($this->where)->first($this->model->fields[$field]);

        return 501;
    }
}
