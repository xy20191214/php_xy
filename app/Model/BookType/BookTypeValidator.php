<?php
namespace App\Model\BookType;

use App\Library\Base\ValidatorBase;

class BookTypeValidator extends ValidatorBase
{
    /**
     * 设置接收参数
     */
    public function __construct()
    {
        $this->params(request()->all());
    }

    /**
     * 验证
     * @return mixed
     */
    public function iGet()
    {
        return $this->default('pch', 0)
            ->default('limit', 10)
            ->result()->params;
    }


    /**
     * 验证
     * @return mixed
     */
    public function iSave()
    {
        $params = $this->default('ch', 0)
            ->default('pch', 0)
            ->isempty('title')
            ->result();

        return $params;
    }
}
