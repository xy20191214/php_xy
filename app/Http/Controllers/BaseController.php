<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Plugins\Error\CustomError;

class BaseController extends Controller
{
    /**
     * 返回结果
     * @param int $code [状态码:int=不拼接字符，array=拼接字符]
     * @param array $data [返回的数据]
     * @param string $file [选择文件]
     * @return string
     */
    public function result($code = 200, $data = [], $file = 'common')
    {
        // 结果
        $result = [
            'code' => is_numeric($code) ? $code : $code[0],
            'message' => (new CustomError)->message($file, $code),
        ];

        $data && $result['data'] = $data;

        return response($result);
    }

    /**
     * 返回成功
     * @param array $data [成功数据]
     * @return string
     */
    public function success($data = [])
    {
        return $this->result(200, $data);
    }

    /**
     * 返回失败
     * @param int $code [错误码]
     * @return string
     */
    public function fail($code = 404)
    {
        return $this->result($code);
    }

    /**
     * http状态码方式
     * @remark http码不存在直接调用错误
     * @param int $code [201 204 404 500]
     * @return string
     */
    public function httpsuccess(int $code = 201)
    {
        if (! in_array($code, config('base.http.code'))) return $this->fail($code);

        return response('', $code);
    }

    /**
     * 自行判断成功与否用于操作数据
     * @param $code [状态码或对象]
     * @return string
     */
    public function judge($code)
    {
        return is_numeric($code) ? $this->fail($code) : $this->success($code);
    }
}
