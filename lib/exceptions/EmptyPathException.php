<?php
class EmptyPathException extends Signal
{
	public $message = "无效的路径";
	public $code 	= 500;
	
	public function __toString()
	{
		return $this->getTraceAsString();
	}
}