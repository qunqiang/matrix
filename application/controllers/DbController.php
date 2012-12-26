<?php
class DbController extends WebAction
{
	public function actionIndex($id, $args)
	{
		echo '<pre>';
		$db = BIOS::activeOS()->initDb();
		$result = $db->find('News', array('id' => $id));
		var_dump($result);
	}
	
	public function actionTestTableName()
	{
		$conditions = array('id > 1');
		$newsMod = NewsTable::model();
		$newsMod->getPage(1,$conditions);
		// var_dump($tbl->getTableName());
	}
}