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
		'dateTimeShortFormatString'	=> 'YmdHi',
	),
	'runtime'	=> array(
		'defaultController'		=> 'site',
		'defaultAction'			=> 'index',
		'routeMapPath'			=> APP.'config/route.php',
		'staticFilesAP'			=> 'http://static.leadphp.com/',
		'storageEnginesSupport' => array('Session', 'Cookie', 'Database', 'MemCached', 'Redis'),
		'userDefinedTemplateTags' => 'TemplateTagsComponent',
		'template'	=> array(
			'compileDir' 	=> '/temp/templateCompiled',
			'cacheDir'		=> '/temp/templateCached',
		)
	)

);