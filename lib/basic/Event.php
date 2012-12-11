<?php
class Event
{
	
	/* Access Event Enum List */
	
	const ACCESSED 		= 1;
	const EXECUTED	 	= 2;
	const EXITED		= 3;
	
	private $_class;
	private $_method;
	private $_respondTo;
	
	public function Event($class, $method, $respondTo)
	{
		$this->setClass($class);
		$this->setMethod($method);
		$this->setRespondTo($respondTo);
	}
	
	public function trigger()
	{
		// call_user_func(array($event->getClass(), $event->getMethod()));
		print_r(get_object_vars($this));
		BIOS::println();
		print_r($_GET);
		BIOS::println();
	}
	
	
	public function getClass()
	{
		return $this->_class;
	}
	
	public function getMethod()
	{
		return $this->_method;
	}
	
	public function getRespondTo()
	{
		return $this->_respondTo;
	}
	
	public function setClass($classname)
	{
		$this->_class = $classname;
	}
	
	public function setMethod($methodname)
	{
		$this->_method = $methodname;
	}
	
	public function setRespondTo($respondTo)
	{
		$this->_respondTo = $respondTo;
	}
	
	public function __toString()
	{
		$info  = '<br/><pre>';
		$info .= 'Class		:' . $this->getClass() . '<br/>';
		$info .= 'Method		:' . $this->getMethod() . '<br/>';
		$info .= 'RespondTo	:' . $this->getRespondTo() . '<br/>';
		
		return $info;
		
	}
}