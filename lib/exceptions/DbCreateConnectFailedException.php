<?php
class DbCreateConnectFailedException extends Signal
{
	public $message = '无法打开数据库连接';
	public $code 	= 500;
}