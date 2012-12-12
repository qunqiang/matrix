<?php
class Request
{
	private $_requestGetData = array();
	private $_requestPostData = array();

	private $_route;
	
	private $_controller;
	private $_action;
	private $_id;
	private $_param_list;
	private $_format;
	
	public function Request($dirtyGetData, $dirtyPostData)
	{
		$this->setRequestGetData(FilterManager::getFilter('UserInputFilter')->initWithDirtyData($dirtyGetData)->doFilter($this));
		$this->setRequestPostData(FilterManager::getFilter('UserInputFilter')->initWithDirtyData($dirtyPostData)->doFilter($this));
		$this->_route = new Route;
		$this->_route->setRoutineMapPath(APP.'config/route.php');
		$this->initRequest($this->_route->parseRoute($this->get('q')));
	}
	
	public function getRoute()
	{
		return $this->_route;
	}
	
	public function initRequest($iniData)
	{
		if (isset($iniData['controller']))
		{
			$this->setController($iniData['controller']);
		}
		if (isset($iniData['action']))
		{
			$this->setAction($iniData['action']);
		}
		if (isset($iniData['id']))
		{
			$this->setId($iniData['id']);
		}
		if (isset($iniData['param_list']))
		{
			$this->setParamList($iniData['param_list']);
		}
		if (isset($iniData['format']))
		{
			$this->setFormat($iniData['format']);
		}
	}
	
	
	public function setController($controllerName)
	{
		if (strpos($controllerName,'Controller') === false)
		{
			$this->_controller = ucfirst($controllerName) . 'Controller';
		}
		else
		{
			$this->_controller = ucfirst($controllerName);
		}
		
	}
	
	public function getController()
	{	
		return $this->_controller == NULL ? $this->getDefaultController() : $this->_controller;
	}
	
	public function setAction($actionName)
	{
		if (strpos($actionName,'action') === false)
		{
			$this->_action = 'action'. ucfirst($actionName);
		}
		else
		{
			$this->_action = $actionName;
		}
		
	}
	
	public function getAction()
	{
		return $this->_action == NULL ? $this->getDefaultAction() : $this->_action;
	}
	
	public function setId($id)
	{
		$this->_id = intval(trim($id));
	}
	
	public function getId()
	{
		return $this->_id;
	}
	
	public function setParamList($paramList)
	{
		$this->_param_list = $paramList;
	}
	
	public function getParamList()
	{
		return $this->_param_list;
	}
	
	public function setFormat($format)
	{
		$this->_format = $format;
	}
	
	public function getFormat()
	{
		return $this->_format;
	}
	
	public function getUrl($url)
	{
		return $url;
	}
	
	public function getRequestGetData($key = '')
	{
		if (empty($key))
		{
			return $this->_requestGetData;
		}
		if (isset($this->_requestGetData[$key]))
		{
			return $this->_requestGetData[$key];
		}
		else
		{
			return null;
		}
	}

	public function get($key = '')
	{
		return $this->getRequestGetData($key);
	}
	public function post($key = '')
	{
		return $this->getRequestPostData($key);
	}

	public function getRequestPostData($key = '')
	{
		if (empty($key))
		{
			return $this->_requestPostData;
		}
		if (isset($this->_requestPostData[$key]))
		{
			return $this->_requestPostData[$key];
		}
		else
		{
			return null;
		}
	}

	public function setRequestGetData($cleanGetData)
	{
		$this->_requestGetData = $cleanGetData;
	}
	public function setRequestPostData($cleanPostData)
	{
		$this->_requestPostData = $cleanPostData;
	}
	
	public function getDefaultController()
	{
		$defaultController = 'SiteController';
		$this->setController($defaultController);
		// BIOS::activeOS()->get('base.default.controller');
		return $defaultController;
	}
	
	public function getDefaultAction()
	{
		$defaultAction = 'actionIndex';
		// BIOS::activeOS()->get('base.default.action');
		$this->setAction($defaultAction);
		return $defaultAction;
	}
	
	public function sendHeader()
	{
		$contentType = 'Content-Type:';
		$ctype = '';
		switch($this->getFormat())
		{
			case "html": $ctype="text/html"; break;
			case "json": $ctype="text/plain"; break;
			case "xml": $ctype="text/xml"; break;
			case "pdf": $ctype="application/pdf"; break;
			case "exe": $ctype="application/octet-stream"; break;
			case "zip": $ctype="application/zip"; break;
			case "doc": $ctype="application/msword"; break;
			case "xls": $ctype="application/vnd.ms-excel"; break;
			case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
			case "gif": $ctype="image/gif"; break;
			case "png": $ctype="image/png"; break;
			case "jpeg":
			case "jpg": $ctype="image/jpg"; break;
			default: $ctype = "text/html"; break;
			// default: $ctype="application/force-download"; 
		}
		$charset = BIOS::activeOS()->getConf('base.locale.encoding');
		header("Content-type: {$ctype}; charset={$charset}");
	}
	
	public function __toString()
	{
		$info = "<br/><pre>";
		$info .= 'controller 	:' . $this->getController() . '<br/>';
		$info .= 'action		:' . $this->getAction() . '<br/>';
		$info .= 'id		:' . 	 $this->getId()	 . '<br/>';
		$info .= 'param_list	:' . var_export($this->getParamList(), true) . '<br/>';
		$info .= 'format		:' . $this->getFormat() . '<br/>';
		$info .= '</pre><br/>';
		return $info;
	}
	
	public function redirect($url = '/')
	{
		echo '<script> window.location.href="' . $url . '";</script>';
	}
	
	
	public function respond()
	{
		$this->sendHeader();
		new Executor($this);
	}

}