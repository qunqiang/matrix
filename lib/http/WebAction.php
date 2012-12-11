<?php
class WebAction
{
	
	private $_request;
	private $_view;
	public $layout;
	
	public function WebAction()
	{
		$this->request = HttpEvent::getRequest();
		if ($this->getLayout())
		{
			$this->setView(Template::initView());
		}
	}
	
	public function get($key)
	{
		
	}
	
	public function post($key)
	{
		
	}
	
	public function getLayout()
	{
		return $this->layout;
	}
	public function setLayout($layout)
	{
		$this->layout = $layout;
	}
	
	public function setView($view)
	{
		$this->_view = $view;
	}
	
	public function getView()
	{
		return $this->_view;
	}
	
	public function getConf($key)
	{
		return Conf::getInstance()->find($key);
	}
	
	public function getRequest()
	{
		return $this->_request;
	}

	public function redirect($url = '/')
	{
		$this->request->redirect($url);
	}

}