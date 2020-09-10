<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

use App\Plugins\Error\CustomError;

class BaseController extends Controller
{
    /**
     * 返回结果
     * @param $code json状态码 int 不拼接字符 array拼接字符
     * @param array $data 返回的数据
     * @param int $status 请求状态码
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @author cy
     */
    public function result($code = 200, $data = [], int $status = 200, $file = 'common')
    {
        // 使用的http状态码
        if (is_numeric($code) && in_array($code, [201, 204])) return response('', $status);

        // 设置文件
        if (is_string($status)) $file = $status;

        // 结果
        $result = [
            'code' => is_numeric($code) ? $code : $code[0],
            'message' => CustomError::message($file, $code),
        ];

        $data && $result['data'] = $data;

        return response($result, $status);
    }
}
