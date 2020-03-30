<?php
namespace App\Library\Error;

class ValidatorError
{
    public $errorCode;

    public function __construct($code)
    {
        $this->errorCode = $code;
    }
}
