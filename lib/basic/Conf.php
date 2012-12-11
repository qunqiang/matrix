<?php
class Conf
{
 	static $instance;
	
	static $confCache;
	
	private $_keyFile;
	private $_branchName;
	private $_keyName;
	private $_conf;

	private function Conf()
	{
		
	}
	
	public function getKeyFile()
	{
		return $this->_keyFile;
	}
	public function setKeyFile($keyFile)
	{
		$this->_keyFile = $keyFile;
	}
	
	public function getBranchName()
	{
		return $this->_branchName;
	}
	public function setBranchName($branchName)
	{
		$this->_branchName = $branchName;
	}
	
	public function getKeyName()
	{
		return $this->_keyName;
	}
	public function setKeyName($keyName)
	{
		$this->_keyName = $keyName;
	}
	
	public function getConf()
	{
		return $this->_conf;
	}
	public function setConf($conf)
	{
		$this->_conf = $conf;
	}
	
	public function getInstance()
	{
		if(!self::$instance)
		{
			self::$instance = new Conf;
		}
		return self::$instance;
	}
	
	public function find($key)
	{
		$this->_parseConfigureFile($key);
		if($this->getBranchName() && $this->getConf())
		{
			$config = $this->getConf();
			if (isset($config[$this->getBranchName()]))
			{
				$config =$config[$this->getBranchName()];
				if ($this->getKeyName())
				{
					if (isset($config[$this->getKeyName()]))
					{
						return $config[$this->getKeyName()];
					}
					else
					{
						BIOS::raise('ParametersLost');
					}
					
				}
				return $config;
			}
			else
			{
				BIOS::raise('ParametersLost');
			}
		}
		else
		{
			BIOS::raise('ParametersLost');
		}
		
	}
	
	private function _parseConfigureFile($key)
	{
		if (strpos($key, '.') === false)
		{
			BIOS::raise('ResourceNotFound');
		}
		$fileinfo = explode('.', trim($key, '.'));
		if (count($fileinfo) > 1)
		{
			if (isset($fileinfo[0]))
			{
				$this->setKeyFile($fileinfo[0]);
			}
			else
			{
				$this->setKeyFile('');
			}
			if (isset($fileinfo[1]))
			{
				$this->setBranchName($fileinfo[1]);
			}
			else 
			{
				$this->setBranchName('');
			}
			if (isset($fileinfo[2]))
			{
				$this->setKeyName($fileinfo[2]);
			}
			else
			{
				$this->setKeyName('');
			}
			if (!isset(self::$confCache[$fileinfo[0]]))
			{
				$configPath = BIOS::activeOS()->getRuntimePath() . 'config' . DS;
				$configFile = $configPath . $fileinfo[0] . '.php';
				if (file_exists($configFile))
				{
					$conf = require($configFile);
					$this->setConf($conf);
					self::$confCache[$fileinfo[0]] = $this->getConf();
				}
			}
			else
			{
				$this->setConf(self::$confCache[$fileinfo[0]]);
			}
		}
		else
		{
			$this->setConf(NULL);
			BIOS::raise('ResourceNotFound');
		}
	}


}