<?php
class DbQueryBuilder
{
	static $model;	
	private $_tablePrefix;
	protected $_tableMainName;
	
	public function DbQueryBuilder()
	{

	}

	public static function model()
	{
		if (function_exists('get_called_class'))
		{
			$class = get_called_class();
		}
		else
		{
			$bt = debug_backtrace();
			$bt = $bt[0];
			$lines = file($bt['file']);
			$line = $lines[$bt['line'] - 1];
			$calledClass = preg_match('/\s(\w+)::/', $line, $class);
			if($calledClass >= 2)
			{
				$class = $class[1];
			}
		}
		if (!self::$model)
		{
			self::$model = new $class;
		}
		return self::$model;
	}
	
	protected function setTableMainName($tblName)
	{
		$this->_tableMainName = $tblName;
	}
	protected function getTableMainName()
	{
		return $this->_tableMainName;
	}
	
	
	public function getTableName()
	{
		return Database::getInstance()->getPrefix() . $this->getTableMainName();
	}
	
	public function execute($conditions = array())
	{
		$db = Database::getInstance()->getConnection();
		$sql = "SELECT * FROM " . $this->getTableName() . " WHERE 1 " . $this->buildConditions($conditions);
		// echo $sql;
		$stmt = $db->prepare($sql);
		var_dump($stmt);
		$stmt->execute(array_values($conditions));
		$data = $stmt->fetchAll();
		return $data;
	}
	
	public function bindAllValues(&$stmt, &$conditions)
	{
			
	}
	
	public function buildConditions($conditions)
	{
		$conditionSql = '';
		$conditionSqlParts = array();
		if (empty($conditions))
		{
			return $conditionSql;
		}
		
		if (is_array($conditions))
		{
			foreach ($conditions as $k => $v)
			{
				$conditionSqlParts[] = $k . ' = ?';
			}
		}
		$conditionSql = implode(' AND ', $conditionSqlParts);
		$conditionSql = ' AND ' . $conditionSql;
		return $conditionSql;
	}

}