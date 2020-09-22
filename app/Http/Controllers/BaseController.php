<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Plugins\Error\CustomError;

class BaseController extends Controller
{
    /**
     * 返回结果
     * @param $code [状态码:int=不拼接字符，array=拼接字符]
     * @param array $data [返回的数据]
     * @param int $status [请求状态码]
     * @param string $file [选择文件]
     * @return string
     */
    public function result($code = 200, $data = [], int $status = 200, $file = 'common')
    {
        // 使用的http状态码，如果是int并且是201或204，直接返回。
        if (is_numeric($code) && in_array($code, [201, 204])) return response('', $code);

        // 选择文件，如果参数3是字符串则等于file
        if (is_string($status)) $file = $status;

        // 结果
        $result = [
            'code' => is_numeric($code) ? $code : $code[0],
            'message' => (new CustomError)->message($file, $code),
        ];

        $data && $result['data'] = $data;

        return response($result, $status);
    }
}
