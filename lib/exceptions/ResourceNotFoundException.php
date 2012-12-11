<?php
class ResourceNotFoundException extends Signal
{
	public $message = '无法找到请求的资源';
	public $code 	= '404';

}