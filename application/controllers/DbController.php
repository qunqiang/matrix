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
	
	public function actionTest($id)
	{
		echo '<pre>';
		$news = News::init()->find_by_id(array(1,2));
		$newsCls = NewsClass::init()->find_by_id(1);

		echo '<br/>';
		print_r($news);	
		print_r($newsCls);
	}
}