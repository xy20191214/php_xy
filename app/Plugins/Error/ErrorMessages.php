<?php
/**
 * 常用错误类
 */
namespace App\Plugins\Error;

class ErrorMessages
{
    const C_SUCCESS = 200;
    const C_NO_DATA = 404;

    const C_SUB_IS_EMPTY = 10000;
    const C_SUB_STR_MIN = 10001;
    const C_SUB_STR_MAX = 10002;

    const C_RE_TITLE = 'title';
    const C_RE_TYPE = 'type';

    const C_MESSAGE = [
        self::C_SUCCESS => '请求成功',
        self::C_NO_DATA => '请求失败',
    ];

    const C_MESSAGE_SUBJECT = [
        self::C_SUB_IS_EMPTY => '%s不能为空',
        self::C_SUB_STR_MIN => '%s不能少于%d',
        self::C_SUB_STR_MAX => '%s不能超过%d',
    ];

    const C_MESSAGE_REPLACE = [
        self::C_RE_TITLE => '标题',
        self::C_RE_TYPE => '类型'
    ];
}
