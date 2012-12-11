<?php
class Signal extends Exception
{

	public function __toString()
	{
		$buff = BIOS::createStringBuffer(2048);
		$buff->addLine($this->getCode() . ' ' . $this->getMessage() . '<br/>');
		$buff->addLine(HttpEvent::getRequest());
		return $buff->getData();
	}
}