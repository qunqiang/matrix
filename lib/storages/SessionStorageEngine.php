<?php
class SessionStorageEngine extends Storage
{
	
	protected $_expireFlag = 'SYS_EXPIRE_';

	public function get($key)
	{
		if (isset($_SESSION[$key]))
		{
			if (isset($_SESSION[$this->getExpireFlag() . $key]))
			{
				if (time() >= $_SESSION[$this->getExpireFlag() . $key])
				{
					return null;
				}
			}
			return $_SESSION[$key];
		}
		return null;
	}
	
	protected function getExpireFlag()
	{
		return $this->_expireFlag;
	}
	
	public function setForce($key, $value, $expireOn = '')
	{
		$this->set($key, $value, $expireOn, true);
	}
	
	public function set($key, $value, $expireOn = '', $forceSet = false)
	{
		if (isset($_SESSION[$key]))
		{
			if ($forceSet)
			{
				$_SESSION[$key] = $value;
				if ($expireOn)
				{
					$_SESSION[$this->getExpireFlag() . $key] = $expireOn;
				}
				return true;
			}
			BIOS::raise('StorageNotCoverable');
		}
		
		$_SESSION[$key] = $value;
		if ($expireOn)
		{
			$_SESSION['SYS_EXPIRE_' . $key] = $expireOn;
		}
		return true;
	}
	
	public function setEx($key, $value, $expireOn)
	{
		$this->set($key, $value, $expireOn);
	}

	
	public function del($key)
	{
		if($this->get($key))
		{
			unset($_SESSION[$key]);
			if($this->get($this->getExpireFlag() . $key))
			{
				unset($_SESSION[$this->getExpireFlag() . $key]);
			}
		}
	}
	
	

}