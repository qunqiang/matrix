<?php
class NewsTable extends DbQueryBuilder
{
	private $_tableName = 'news';
	
	public function NewsTable()
	{
		
	}
	
	public function test()
	{
		var_dump($this->getTableName());
	}
	
	
	
}