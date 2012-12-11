<?php
class WebAction
{
	
	public $request;
	
	public function WebAction()
	{
		$this->request = new Request($_GET);
	}
	
	public function get($key)
	{
		
	}
	
	public function getConf($key)
	{
		return Conf::getInstance()->find($key);
	}
	
	public function getRequest()
	{
		return HttpEvent::getRequest();
	}

	public function redirect($url = '/')
	{
		$this->request->redirect($url);
	}

}