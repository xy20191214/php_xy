<?php
return [
    // http相关
    'http' => [
        'code' => [
            201, // 请求已经被实现，而且有一个新的资源已经依据请求的需要而建立。
            204, // 服务器成功处理了请求，但不需要返回任何实体内容，并且希望返回更新了的元信息。
            400 // 语义有误或请求参数有误，当前请求无法被服务器理解。除非进行修改，否则客户端不应该重复提交这个请求。
        ]
    ],
    // 状态码
    'status' => [
        'soft_delete' => -3, // 软删除
    ],
    // 方法
    'function' => [
        'remove',  // 软删除
        'alter', // 添加or修改
    ],
];
