<?php 
class FilterManager
{
	public static function getFilter($filtername)
	{
		BIOS::importClass(LIB . DS . 'filters');
		if (class_exists($filtername))
		{
			return new $filtername;
		}
	}

}