<?php
class DataTime
{
	
	static function stampToLocale($timeStamp)
	{
		return $timeStamp == 0 ? "nerver" : date(BIOS::activeOS()->getConf('base.locale.dateTimeFormatString'), $timeStamp);
	}

    static function stampToLocaleShort($timeStamp)
    {
        return $timeStamp == 0 ? 'never' : date(BIOS::activeOS()->getConf('base.locale.dateTimeShortFormatString'), $timeStamp);
    }
}