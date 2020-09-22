<?php
namespace App\Plugins\Validator;

class BookValidator extends ValidatorBase
{
    /**
     * 验证
     * @return mixed
     */
    public function write()
    {
        return $this->must(['type', 'title'])->length('title', 100, 1)->end(['type', 'title', 'pid']);
    }

    /**
     * 验证id
     */
    public function verId()
    {
        return $this->must(['id'])->end(['id']);
    }
}
