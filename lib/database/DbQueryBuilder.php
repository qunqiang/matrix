<?php
class DbQueryBuilder
{
	private $_tablePrefix;
	private $_tableMainName;
	
	public function DbQueryBuilder($tblName)
	{
		$this->setTableMainName($tblName);
	}
	
	public function setTableMainName($tblName)
	{
		$this->_tableMainName = $tblName;
	}
	public function getTableMainName()
	{
		return $this->_tableMainName;
	}
	
	protected function getTableName()
	{
		return Database::getInstance()->getPrefix() . $this->getTableMainName();
	}

}