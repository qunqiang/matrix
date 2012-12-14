<?php
class WebAction
{
	
	private $_request;
	private $_view;
	public $layout;
	
	public function WebAction()
	{
		$this->setRequest(HttpEvent::getRequest());
		$this->setView(Template::initView());
	}
	
	public function get($key = '', $default = '')
	{
		return $this->getRequest()->get($key) ? $this->getRequest()->get($key) : $default;
	}
	
	public function post($key = '')
	{
		return $this->getRequest()->post($key);
	}

	/**
	 *{{{
	 * Template APIs Start
	 *
	 *
	 */
	public function assign($keys, $values)
	{
		// $vars = $this->getView()->getAssignment();
		if (gettype($keys) == 'array')
		{
			foreach($keys as $k => $key)
			{
				$this->assign($key, $values[$k]);
			}
		}
		else
		{
			if ($this->getView()->isAlreadyAssigned($keys))
			{
				BIOS::notice('assignment : key is already assigned to the key : ' . $keys);
			}
			$this->getView()->assign($keys, $values);
		}
	}

	public function display($tpl = '')
	{
		$this->getView()->display($tpl);
	}
	
	public function getLayout()
	{
		return $this->getView()->getLayout();
	}
	public function setLayout($layout)
	{
		$this->getView()->setLayout($layout);
	}
	
	public function setView($view)
	{
		$this->_view = $view;
		$this->_view->setLayout($this->layout);
	}
	
	public function getView()
	{
		return $this->_view;
	}

	/**
	 * Template APIs End	
	 *}}}*/
	
	public function getConf($key)
	{
		return Conf::getInstance()->find($key);
	}

	public function getRoute()
	{
		return $this->getRequest()->getRoute();
	}
	
	public function setRequest($request)
	{
		$this->_request = $request;
	}
	public function getRequest()
	{
		return $this->_request;
	}

	public function redirect($url = '/')
	{
		$this->_request->redirect($url);
	}

}