<?php
/**
 * 返回路由
 */
namespace App\Library\Tool;

trait Crypt
{
    public $en = ['c', 'd', 'z', 'y', 'a', 'o', 'm', 'e', 'l', 't', 'c', 'd', 'z', 'y', 'a', 'o']; // 英文码
    public $int = ['c' => 0, 'd' => 1, 'z' => 2, 'y' => 3, 'a' => 4, 'o' => 5, 'm' => 6, 'e' => 7, 'l' => 8, 't' => 9]; // 数字码
    public $rand = ['b', 'f', 'g', 'h', 'i', 'j', 'k', 'n', 'p', 'q', 'r', 's', 'u', 'v', 'w', 'x']; // 逗号上述没出现
    public $ch = 'xingyun'; // 秘钥

    /**
     * 加密字段
     * @param $str
     * @return string
     * @author cy
     * 1 time + id + ch 9 (32-time(9)-id(?)-ch(7))
     */
    public function encrypField($str)
    {
        $randnum = 32 - strlen($str) - 16 - 2;

        $str = str_replace($this->rand, $this->en, substr(md5(rand(100, 999)), 5, 16) . ',' . $str . ',' . substr(md5($this->ch . rand(100, 999)), 0, $randnum));

        $result = '';
        for ($i = 0; $i < strlen($str); $i++)
        {
            $result .= is_numeric($str[$i]) ? $this->en[$str[$i]] : (isset($this->int[$str[$i]]) ? $this->int[$str[$i]] : $this->rand[rand(0, 15)]);
        }

        return $result;
    }

    /**
     * 解密字段
     * @param $str
     * @return string
     * @author cy
     */
    public function decryptField($str)
    {
        $result = '';
        for ($i = 0; $i < strlen($str); $i++)
        {
            $result .= is_numeric($str[$i]) ? $this->en[$str[$i]] : (isset($this->int[$str[$i]]) ? $this->int[$str[$i]] : ',');
        }

        return $result;
    }
}
