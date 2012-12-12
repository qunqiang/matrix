<?php
abstract class Filter
{
	protected $_beforeFilterData;
	protected $_afterFilteredData;
	
	abstract function doFilter($request);
	
	public function initWithDirtyData($dirtyData)
	{
		$this->setBeforeFilterData($dirtyData);
		return $this;
	}
	
	public function getBeforeFilterData()
	{
		return $this->_beforeFilterData;
	}
	
	public function setBeforeFilterData($dirtyData)
	{
		return $this->_beforeFilterData = $dirtyData;
	}

	public function setAfterFilteredData($cleanData)
	{
		$this->_afterFilteredData = $cleanData;
	}
	
	public function getAfterFilteredData()
	{
		return $this->_afterFilteredData;
	}
}