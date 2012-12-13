<?php
abstract class Filter
{
	protected $_dirtyData;
	protected $_cleanData;
	
	abstract function doFilter(&$request);
	
	public function initWithDirtyData($dirtyData)
	{
		$this->setDirtyData($dirtyData);
		return $this;
	}
	
	public function setDirtyData($dirtyData)
	{
		$this->_dirtyData = $dirtyData;
	}
	public function getDirtyData()
	{
		return $this->_dirtyData;
	}
	
	public function getCleanData()
	{
		return $this->_cleanData = $cleanData;
	}

	public function setCleanData($cleanData)
	{
		$this->_cleanData = $cleanData;
	}

}