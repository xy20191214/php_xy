<?php
/**
 * 常用错误类
 */
namespace App\Library\Constant;

class Common
{
	const C_SUCCESS = 200;
	const C_NO_DATA = 500;

	const C_TITLE_NULL = 10000;

	const C_MESSAGE = [
		self::C_SUCCESS => '请求成功',
		self::C_NO_DATA => '请求失败',
        self::C_TITLE_NULL => '标题不能为空'
	];
}
