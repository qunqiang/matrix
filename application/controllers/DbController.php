<?php
class DbController extends WebAction
{
	public function actionIndex($id, $args)
	{
		echo '<pre>';
		$db = BIOS::activeOS()->initDb();
		
		$result = $db->find('News', array('id' => 1))->getResultAsArray(DB_TYPE_ASSOC);
				
		var_dump($result);
	}
}