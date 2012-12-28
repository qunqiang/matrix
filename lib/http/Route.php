<?php
class Route
{
	private $_routineMapPath;
	private $_route;
	private $_routeConfig;
	private $_lastRouteMap;
	private $_routeGlue = '/';
	public static $_routeFormats = array(
		'controller' 	=> '(\w+)',
		'action'		=> '(\w+)',
		'id'			=> '(\d+)',
		'param_list'	=> '([\D].+)',
		'param_name'	=> '(\w+)',
		'param_value'	=> '(\w+|\d+)',
		'format'		=> '(html|json|xml)'
	);
	
	public function Route()
	{
		
	}
	
	public function setRoutineMapPath($mapPath)
	{
		if (file_exists($mapPath))
		{
			$this->_routineMapPath = $mapPath;
			$this->setMaps($mapPath);
		}
		else
		{
			BIOS::raise('HTTP_RESOUCE_NOT_FOUND');
		}
	}
	
	public function toUrl($controller = '', $action = '', $id = null, $param_list = array(), $format = '')
	{
		$keyMap = array('controller', 'action', 'id', 'param_list', '.format');
		$generateFormat = '';
		$urlParts = array();
		$args = func_get_args();
		if (is_array($args))
		{
			foreach($args as $k => $arg)
			{
				if (!empty($arg))
				{
					$urlParts[$keyMap[$k]] = $arg;
				}
			}
		}
		if (!isset($urlParts['controller']) )
		{
			$controller = BIOS::activeOS()->getConf('base.runtime.defaultController');
		}
		$maps = array_reverse($this->getMaps());
		if (is_array($maps))
		{
			foreach($maps as $map)
			{
				// BIOS::println($map);
				$mapTest = $map;
				foreach($urlParts as $k => $v)
				{
					$mapTest = str_replace($k, '', $mapTest);
				}
				$res = array();
				preg_match('/[\.]?\w+/', $mapTest, $res);
				if (count($res) == 1)
				{
					$res = $res[0];
				}			
				
				if (in_array($res, $keyMap))
				{
					continue;
				}
				else
				{
					// BIOS::println($map);
					$this->_scanRouteGlue($map);
					// 生成url
					$tmpParam = '';
					if (is_array($param_list))
					{
						$tmp = '';
						foreach ($param_list as $kp => $vp)
						{
							$tmp = $kp . $this->getRouteGlue() . $vp . $this->getRouteGlue();
							$tmpParam .= $tmp;
						}
						$args[3] = trim($tmpParam, $this->getRouteGlue());
					}
					
					if($format)
					{
						$args[4] = '.' . $format;
					}
					// print_r($args);
					$url = $map;
					foreach($args as $ka => $arg)
					{
						$url = str_replace($keyMap[$ka], $arg, $url);
					}
					return '/' . $url;
					break;
				}
				
			}
		}
		return '/';
	}
	
	private function _scanRouteGlue($map)
	{
		$tmp = array();
		$regexp = "/controller(.)action.+/";
		$ret = preg_match($regexp, $map, $result);
		if ($ret > 0)
		{
			$this->setRouteGlue($result[1]);
		}
	}
	
	public function setRouteGlue($routeGlue)
	{
		$this->_routeGlue = $routeGlue;
	}
	public function getRouteGlue()
	{
		return $this->_routeGlue;
	}
		
	public function parseRoute($q)
	{
		$q = trim($q , '/');
		$routineMap = $this->getMaps();
		$result = array();
		if (!empty($routineMap))
		{
			// 根据路由表解析规则
			foreach ($routineMap as $map)
			{
				//保存map变量
				$regx = str_replace(array('.', '/'), array('\.', '\/'), $map);
				$routeRule = str_replace(array_keys(self::$_routeFormats), array_values(self::$_routeFormats), '/^' . $regx . '$/');
				// BIOS::println($routeRule);
				if (preg_match($routeRule, $q, $result) > 0)
				{
					unset($result[0]);
					// 上一次解析路径
					$this->_lastRouteMap = $map;
					$this->_scanRouteGlue($map);
					// 解析map 填充参数
					$map = trim($regx, '/');
					$map = str_replace(array('\/', '\.', '-'), array('/','/','/'), $map);
					$parts = explode('/', $map);
					$result = array_values($result);
					$tmp = array();
					foreach ($parts as $k => $partname)
					{
						BIOS::println($k . ' ' .$partname);
						if ($partname === 'param_list')
						{
							$tmpList = $result[$k];
							$tmpList = explode($this->getRouteGlue(), $tmpList);
							$listLength = count($tmpList);
							$tmpParams = array();
							if ($listLength <= 1)
							{
								$result = array('c' => BIOS::activeOS()->getConf('base.runtime.defaultController'), 'a' =>BIOS::activeOS()->getConf('base.runtime.defaultAction') );
							}
							for($i = 0; $i < $listLength; $i += 2)
							{
								$tmpParams[$tmpList[$i]] = $tmpList[$i + 1];
							}
							$tmp[$partname] = $tmpParams;
						}
						else if ($partname === 'id')
						{
							if (preg_match('/^\d+$/', $result[$k]))
							{
								$tmp[$partname] = $result[$k];
							}
							else
							{

								$tmp[$partname] = null;
							}
						}
						else
						{
							if (isset($result[$k]))
							{
								$tmp[$partname] = $result[$k];
							}
						}	
					}
					return $tmp;
				}
			}
			$result = array('c' => BIOS::activeOS()->getConf('runtime.defaultController'), 'a' =>BIOS::activeOS()->getConf('runtime.defaultAction') );
		}
		else
		{
			$result = array('c' => BIOS::activeOS()->getConf('runtime.defaultController'), 'a' =>BIOS::activeOS()->getConf('runtime.defaultAction') );
		}
		return $result;
	}
	
	public function getLastRouteMap()
	{
		return $this->_lastRouteMap;
	}
	
	
	public function getRoutineMapPath()
	{
		return $this->_routineMapPath;
	}
	
	public function getMaps()
	{
		return $this->_route;
	}

	public function setMaps($mapPath)
	{
		$this->_route = require($mapPath);
	}
}