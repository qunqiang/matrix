<?php
class InvalidParameterException extends Signal
{
	public $message = '无效的参数';
	public $code 	= 500;
	
	public function __toString()
	{
		return $this->getCode() . ' ' . $this->getMessage() . '<pre>' .$this->getTraceAsString();
	}
}