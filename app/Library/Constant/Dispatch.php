<?php
/**
 * 返回路由
 */
namespace App\Library\Constant;

class Dispatch
{
	public $className; // 类名

	private function file($file)
	{
		$this->className = "\\App\\Library\\Constant\\" . ucfirst($file);
	}

	private function message($file, $code)
	{
		$this->file($file);
		$messages = $this->className::C_MESSAGE;

		return isset($messages[$code]) ? $messages[$code] : $messages[404];
	}

	public static function __callStatic($method, $params)
	{
		$dispatch = new Dispatch;

		if (method_exists($dispatch, $method))
		{
			return $dispatch->$method(...$params);
		}
	}
}
