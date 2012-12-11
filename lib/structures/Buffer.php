<?php
abstract class Buffer
{
	private $_data;
	private $_dataLength;
	private $_maxDataLength;
	
	abstract public function addLine($text);
	
	public function getData()
	{
		return $this->_data;
	}
	
	public function setData($data)
	{
		$this->_data .= $data;
		$this->setDataLength(strlen($this->getData()));
	}
	
	public function getDataLength()
	{
		return $this->_dataLength;
	}
	public function setDataLength($dataLength)
	{
		$this->_dataLength = $dataLength;
	}
	
	public function setMaxBufferSize($maxDataLength)
	{
		$this->_maxDataLength = $maxDataLength;
	}
	public function getMaxBufferSize()
	{
		return $this->_maxDataLength;
	}
}