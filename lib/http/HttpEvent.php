<?php
class HttpEvent extends Event
{
	
	static $request;
	
	
	public static function getRequest()
	{
		if(!self::$request)
		{
			self::$request = new Request($_REQUEST);
		}
		return self::$request;
	}
	
	
	public function trigger()
	{
		$request = self::getRequest();
		if ($request)
		{
			$request->respond();
		}
		else
		{
			BIOS::raise('ParametersLost');
		}
	}

}