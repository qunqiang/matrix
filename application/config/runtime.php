<?php
return array(
		'environment'			=> 'development',
		'defaultController'		=> 'site',
		'defaultAction'			=> 'index',
		'routeMapPath'			=> APP.'config/route.php',
		'staticFilesAP'			=> 'http://static.leadphp.com/',
		'storageEnginesSupport' => array('Session', 'Cookie', 'Database', 'MemCached', 'Redis'),
		'userDefinedTemplateTags' => 'TemplateTagsComponent',
		'template'	=> array(
			'compileDir' 	=> '/temp/templateCompiled',
			'cacheDir'		=> '/temp/templateCached',
		),
		'modules-available'	=> array(
			'interfaces',
			'database',
		),
		'modules-enabled'	=> array(
			'ido',
			'http',
			'execeptions',
			'filters',
			'storages',
			'structures',
		)

);