<?php
class ParametersLostException extends Signal
{
	public $message = 'HTTP错误 请求的资源无效';
	public $code = '404';
	
	public function __toString()
	{
		$buff = BIOS::createStringBuffer(2048);
		$buff->addLine($this->getCode() . ' ' . $this->getMessage());
		return $buff->getData();
	}

}