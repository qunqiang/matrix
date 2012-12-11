<?php 
class ActionNotFoundException extends Signal
{
	public $message = "无法找到请求的动作";
	public $code 	= 404;
	
	public function __construct()
	{
		$this->message .= HttpEvent::getRequest()->getAction()  . '在类' . HttpEvent::getRequest()->getController() . '中';
	}
}
