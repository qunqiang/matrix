<?php
class Database
{
	static $db;
	static $connection;
	static $queries = array();
	
	private $_uniqId;	
	private $_driver = 'PDO_MySQL';
	private $_statement;
	private $_recordSet;
	private $_prefix;
	
	
	public static function getInstance()
	{
		if (!self::$db)
		{
			self::$db = new Database;
		}
		return self::$db;
	}
	
	private function Database()
	{
		if (!self::$connection)
		{
			$this->_connectDb();
		}
	}
	
	/////////////
	/// setters & getters
	/////////////
	public function setPrefix($prefix)
	{
		$this->_prefix = $prefix ? $prefix : 'mt_';
	}
	public function getPrefix()
	{
		return $this->_prefix;
	}
	
	public function setRecordSet($executeResult)
	{
		$this->_recordSet = $executeResult;
	}
	public function getRecordSet()
	{
		return $this->_recordSet;
	}
	
	
	private function _connectDb()
	{
		$this->_uniqId = uniqid();
		$os = BIOS::activeOS();
		$environment = $os->getConf('base.runtime.environment');
		$driver = $os->getConf('database.'.$environment.'.driver');
		switch($driver)
		{
			case 'PDO_MySQL':
				if (!self::$connection)
				{
					if (!class_exists('PDO'))
					{
						BIOS::raise('ClassNotFound');
					}
				
					self::$connection = new PDO(
						$os->getConf('database.'.$environment.'.dsn'),
						$os->getConf('database.'.$environment.'.user'),
						$os->getConf('database.'.$environment.'.password')
					);
					$this->setPrefix($os->getConf('database.'.$environment.'.prefix'));
					if (empty(self::$connection))
					{
						BIOS::raise('DbCreateConnectFailed');
					}
				}
				
				break;
			default:
				var_dump($driver);
				break;
		}
	}
	
	public function getResultAsArray($arrayType = DB_ARRAY_ASSOC)
	{
		
		return array();
	}
	
	public function find($tableIndentify, $conditions =array())
	{
		$tableClass = $tableIndentify .'Table';
		$table = new $tableClass;
		$this->setRecordSet($table->execute($conditions));
		return $this;
	}
}