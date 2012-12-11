<?php
return array(
	'app'		=> array(
		'siteName' 			=> '测试站点',
		'siteAuthor'		=> 'ln<wangqunqiang@gmail.com>',
		'siteContact'		=> 'Tencent QQ:1039383',
		'environment'		=> 'development',
	),
	
	'locale'	=> array(
		'dateTimeZone'		=> 'Asia/Chongqing',
		'usingLang'			=> 'zh_cn',
		'encoding'			=> 'UTF-8',
		'dateTimeFormatString' => 'Y-m-d H:i:s',
	),
	'runtime'	=> array(
		'storageEnginesSupport' => array('Session', 'Cookie', 'Database', 'MemCached', 'Redis'),
	)

);