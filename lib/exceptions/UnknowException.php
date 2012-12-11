<?php
class UnknowException extends Signal
{
	public $message = '未知错误';
	public $code 	= '500';
}