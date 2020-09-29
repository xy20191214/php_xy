<?php
namespace App\Plugins\Error;

class ErrorMessages
{
    // 基本错误
    const C_SUCCESS = 200;
    const C_NO_DATA = 404;
    const C_SET_FAIL = 501;

    // 基本业务错误
    const C_PARAMS_ERROR = 1000;

    // 业务验证错误
    const C_SUB_IS_EMPTY = 10000;
    const C_SUB_STR_MIN = 10001;
    const C_SUB_STR_MAX = 10002;

    // 自定义错误
    const C_RE_TITLE = 'title';
    const C_RE_TYPE = 'type';

    // 错误信息
    const C_MESSAGE = [
        self::C_SET_FAIL => '操作失败',
        self::C_SUCCESS => '操作成功',
        self::C_NO_DATA => '请求失败',
        self::C_PARAMS_ERROR => '参数错误'
    ];

    // 自定义错误信息
    const C_MESSAGE_SUBJECT = [
        self::C_SUB_IS_EMPTY => '%s不能为空',
        self::C_SUB_STR_MIN => '%s不能少于%d',
        self::C_SUB_STR_MAX => '%s不能超过%d',
    ];

    // 自定义类型
    const C_MESSAGE_REPLACE = [
        self::C_RE_TITLE => '标题',
        self::C_RE_TYPE => '类型'
    ];
}
