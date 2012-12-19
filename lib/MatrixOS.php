<?php
define('APP', ROOT . 'application' .DS );
spl_autoload_register(array('MatrixOS', 'appAutoLoad'));
class MatrixOS
{
	
	public function powerOn()
	{
		date_default_timezone_set($this->getConf('base.locale.dateTimeZone'));
		$this->beforeEvent(new InlineEvent('PageAccess', 'log', Event::ACCESSED));
		$this->executeEvent(new HttpEvent('a', 'b', 1), $this);
		$this->afterEvent(new InlineEvent('PageLeave', 'log', Event::EXITED));
	}
	
	public function powerOff()
	{
		BIOS::println('starting garbage collecting operation');
		exit;
	}
	
	public function beforeEvent($event)
	{
		// BIOS::println('beforeEvent hook');
		$event->trigger();
	}
	
	public function afterEvent($event)
	{
		// BIOS::println('afterEvent hook');
		$event->trigger();
	}
	
	public function executeEvent($event, $os)
	{
		$event->trigger();
	}
	
	public function getRequest()
	{
		return HttpEvent::getRequest();
	}
	
	public function getConf($key)
	{
		return Conf::getInstance()->find($key);
	}
	
	public function initDb()
	{
		BIOS::importClass(LIB. 'database' . DS);
		return Database::getInstance();
	}
	
	
	public function getRuntimePath()
	{
		return APP;
	}
	
	public static function appAutoLoad($fileNeedToLoad)
	{
		// BIOS::println($fileNeedToLoad);
		$flagToPath = array(
			'Controller' 	=> 'controllers',
			'Model'			=> 'models',
			'Module'		=> 'modules',
			'Table'			=> 'tables',
			'View'			=> 'views',
			'Ext'			=> 'extentions',
			'Component'		=> 'components',
			'Exception'		=> 'exceptions',
		);
		
		$runtimePath = BIOS::activeOS()->getRuntimePath();
		$searchPath = '';
		foreach($flagToPath as $pattern => $path)
		{
			if (strpos($fileNeedToLoad, $pattern) !== false)
			{
				$searchPath = $path;
				
				// 加载基础异常库
				if ($searchPath == 'exceptions')
				{
					BIOS::importClass(SYS_SIGNALS);
				}
				$fileLoadPath = $runtimePath . $path . DS .$fileNeedToLoad . '.php';
				// BIOS::println($fileLoadPath);
				if (class_exists($fileNeedToLoad))
				{
					return;
				}
				else if (file_exists($fileLoadPath))
				{
					require_once ($fileLoadPath);
					return;
				}
			}
			else
			{
				if (class_exists($fileNeedToLoad))
				{
					return ;
				}
			}
		}
	}
}