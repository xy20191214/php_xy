<?php
namespace App\Plugins\Error;

class CustomError
{
    public $className; // 类名

    private function file($file)
    {
        $arr = ['common' => 'ErrorMessages'];
        $this->className = "\\App\\Plugins\\Error\\" . ucfirst($arr[$file] ?? $arr['common']);
    }

    private function message($file, $code)
    {
        $this->file($file);
        $messages = $this->className::C_MESSAGE;
        if (! is_array($code) || ($count = count($code)) < 2) return $messages[$code] ?? $messages[404];

        // 拼接
        $messages = $this->className::C_MESSAGE_SUBJECT;
        $temp = $messages[$code[0]];
        $tempArr = [];
        for ($i = 1; $i < $count; $i++)
        {
            $tempArr[] = $this->className::C_MESSAGE_REPLACE[$code[$i]] ?? "";
        }

        return sprintf($temp, ...$tempArr);
    }

    public static function __callStatic($method, $params)
    {
        $dispatch = new CustomError;

        if (method_exists($dispatch, $method))
        {
            return $dispatch->$method(...$params);
        }
    }
}
