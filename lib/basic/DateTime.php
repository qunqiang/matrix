<?php
class DataTime
{
	
	static function stampToLocale($timeStamp)
	{
		return $timeStamp == 0 ? "nerver" : date(BIOS::activeOS()->getConf('base.locale.dateTimeFormatString'), $timeStamp);
	}

}