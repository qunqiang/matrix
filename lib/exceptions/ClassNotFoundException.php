<?php 
class ClassNotFoundException extends Signal
{
	public $message = "无法找类项目";
	public $code 	= 404;
	
	public function __toString()
	{
		return $this->getCode() . ' ' .$this->getMessage();
	}
}