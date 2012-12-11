<?php
class StringBuffer extends Buffer
{
	public function addLine($text)
	{
		$this->setData($text);
	}

}