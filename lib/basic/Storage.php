<?php
abstract class Storage
{
	private $_storageEngine;
	protected $_expireFlag;

	public function Storage($engineType)
	{
		$this->setStorageEngine($engineType);
	}
	
	public function describe($key)
	{
		if ($this->get($key))
		{
			$buff = BIOS::createStringBuffer(20148);
			$buff->addLine('key		:' . $key . '<br/>');
			$buff->addLine('value		:' . $this->get($key) . '<br/>');
			$buff->addLine('expired_on	:' . DataTime::stampToLocale($this->get($this->getExpireFlag() . $key)) . '<br/>');
			BIOS::println($buff->getData());
		}
		else
		{
			BIOS::println($key . '不存在于' . $this->getStorageEngine() . '中');
		}
	}
	
	protected function getExpireFlag()
	{
		return $this->_expireFlag;
	}
	
	public function getStorageEngine()
	{
		return $this->_storageEngine;
	}
	
	public function setStorageEngine($engineType)
	{
		if (in_array($engineType, BIOS::activeOS()->getConf('base.runtime.storageEnginesSupport')))
		{
			$this->_storageEngine = $engineType . 'Storage';
		}
		else
		{
			BIOS::raise('UnkonwStorageEngine');
		}
		
	}
	
	abstract public function set($key, $value, $expireOn = '');
	abstract public function setEx($key, $value, $expireOn);
	abstract public function get($key);
	abstract public function del($key);
	

}