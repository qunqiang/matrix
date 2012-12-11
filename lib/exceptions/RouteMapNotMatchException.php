<?php
class RouteMapNotMatchException extends Signal
{
	public $message = '无效的路由映射';
	public $code 	= 500;
	
	public function __toString()
	{
		return $this->getCode() . ' '. $this->getMessage();
	}
}