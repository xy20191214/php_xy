<?php

namespace App\Library\Base;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Library\Constant\Dispatch;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 返回结果
     * @param int $code json状态码
     * @param array $data 返回的数据
     * @param int $status 请求状态码
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @author cy
     */
    public function result(int $code = 200, $data = [], int $status = 200, $file = 'common')
    {
        $result = '';
        if ($status === 200)
        {
            if (is_string($status)) $file = $status;
            $result = [
                'code' => $code,
                'message' => Dispatch::message($file, $code),
            ];

            $data && $result['data'] = $data;
        }

        return response($result, $status);
    }
}
