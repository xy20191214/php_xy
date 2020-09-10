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
        $params = $this->not('title')->length('title', 100, 1);

        return $params;
    }
}
