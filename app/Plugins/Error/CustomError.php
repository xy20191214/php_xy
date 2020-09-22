<?php
namespace App\Plugins\Error;

class CustomError
{
    public $className; // 类名

    /**
     * 根据文件名获取文件
     * @param $file [文件名]
     */
    private function file($file)
    {
        $arr = ['common' => 'ErrorMessages'];
        $this->className = "\\App\\Plugins\\Error\\" . ucfirst($arr[$file] ?? $arr['common']);
    }

    /**
     * 获取信息返回
     * @param $file [文件名]
     * @param $code [错误码:1=int执行返回，2=array拼接字符串后返回]
     * @return string
     */
    public function message($file, $code)
    {
        $this->file($file);
        $messages = $this->className::C_MESSAGE;
        if (! is_array($code)) return $messages[$code] ?? $messages[404];

        // 拼接
        $messages = $this->className::C_MESSAGE_SUBJECT;
        $temp = $messages[$code[0]];
        $tempArr = [];
        $count = count($code);
        for ($i = 1; $i < $count; $i++)
        {
            $tempArr[] = $this->className::C_MESSAGE_REPLACE[$code[$i]] ?? "";
        }

        return sprintf($temp, ...$tempArr);
    }
}
