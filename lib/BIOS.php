<?php
if(defined('DEBUG_MODE') === true)
{
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
}
else
{
	error_reporting(E_ALL^~ E_NOTICE);
	ini_set('display_errors', 0);
}

if (defined("BIOS_VERSION"))
{
	// return true;
}
// 设置默认启动的基类
define('BASICOS', 'MatrixOS');
// 设置系统版本
define('BIOS_VERSION', 'BIOS 0.1 alpha-2012-12-05 113402r');
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', str_replace('\\','/', dirname(dirname(__FILE__))) . DS);
define('TIMESTAMP', time());
define('LIB', ROOT . 'lib' .DS);
// 注册基础异常处理器
set_exception_handler(array('BIOS', 'basicExceptionHandler'));
// 系统基础的异常类库
define('SYS_SIGNALS', str_replace('\\', '/', ROOT . 'lib' . DS.  'exceptions'));
// 加载boot Menu
BIOS::installOS(BASICOS);
// 启动Session
session_start();

/**
* BIOS , load basic configuration 
*/
class BIOS
{
	static $_basicModules = array(
		'CSignal' => 'basic/Signal.php',
		
	);
	
	static $storageEngine 	= array();
	static $components 		= array();
	
	static function load($configures = array())
	{
		BIOS::importClass(LIB . 'basic');
		BIOS::importClass(LIB . 'interfaces');
		// 做一些类库的加载功能, 根据配置文件载入http 或者 console
		BIOS::importClass(LIB . $configures['AppType']);

		return new BIOS;
	}
	
	public function startOS($os)
	{
		if ($os instanceof MatrixOS)
		{
			$os->powerOn();
		}
	}
	
	static function raise($signal)
	{
		$exception = "{$signal}Exception";
		// 加载基础异常类库
		BIOS::importClass(LIB.self::$_basicModules['CSignal']);
		// BIOS::importClass(SYS_SIGNALS);
		throw new $exception;
	}
	
	static function importClass($source)
	{
		if (!is_file($source))
		{
			if (is_dir($source))
			{
				$handle = opendir($source);
				while ($item = readdir($handle))
				{
					if ($item == '.' || $item == '..' || $item == '.svn')
					{
						continue;
					}
					if (is_dir($item))
					{
						self::importClass($source . DS . $item);
					}
					else
					{
						if (strpos($item, '.php') !== false)
						{
							// BIOS::println($source . DS . $item);
							require_once $source . DS . $item;
						}
					}
				}
			}
		}
		else
		{
			require_once $source;
		}
	}
	
	public static function activeOS()
	{
		if(OSINSTALLED)
		{
			$basicos = BASICOS;
			return new $basicos;
		}
		else
		{
			BIOS::raise('Unknow');
		}
	}
	
	static function installOS($osname)
	{
		$os_kernal_files_path = LIB;
		$os_kernal_image = $os_kernal_files_path . $osname . '.php';
		if (file_exists($os_kernal_image))
		{
			require_once ($os_kernal_image);
			if (!defined('OSINSTALLED'))
			{
				define('OSINSTALLED', true);
			}
		}
		else
		{
			BIOS::raise('NullOSPointer');
		}
	}
	
	public static function initStorage($storageEngine = 'Session')
	{
		// $storageEnable = self::activeOS()->getConf('base.runtime.storageEngineSupport');
		$storageEngineClass = $storageEngine . 'StorageEngine';
		self::importClass(LIB. 'storages' . DS . $storageEngineClass . '.php');
		if (!isset(self::$storageEngine[$storageEngine]))
		{
			self::$storageEngine[$storageEngine] = new $storageEngineClass($storageEngine);
		}
		return self::$storageEngine[$storageEngine];
	}
	
	public static function initComponent($componentName)
	{
		$componentClass = $componentName . 'Component';
		$componentClassFile = $componentClass. '.php';
		if (!isset(self::$components[$componentClass]))
		{
			self::$components[$componentClass] = new $componentClass;
		}
		return self::$components[$componentClass];
	}
	
	public static function createStringBuffer($maxDataLength)
	{
		self::importClass(LIB. 'structures' );
		return new StringBuffer($maxDataLength);
	}
	
	public static function flushBuffer($buff)
	{
		echo $buff->getData();
	}
	
	public static function basicExceptionHandler($exception)
	{
		echo $exception;
		echo '<pre>';
		echo $exception->getTraceAsString();
		self::activeOS()->powerOff();
	}
	
	public static function println($message = '')
	{
		echo $message  , '<br/>';
	}
	
}


