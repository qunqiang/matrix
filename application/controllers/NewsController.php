<?php
class NewsController extends WebAction
{

	public function actionIndex($id, $params)
	{
		// BIOS::println("业务主键是" . $id);
		// BIOS::println('业务参数是:');
		// print_r($params);
		// BIOS::println($this->getRequest()->getAction());
		// BIOS::println($this->buildUrl($this, $id, $params));
		// $this->redirect('/');
		
		// print_r($this->getConf('database.development'));
		
		// BIOS::initStorage()->setForce('test', 'this is only a test key', time() + 7200);	
		// 		BIOS::initStorage()->describe('test');
		// 		$val = BIOS::initStorage()->get('test');
		// 		BIOS::println($val);
		// 		BIOS::initStorage()->del('test');
		// 		BIOS::initStorage()->describe('test');
		// 		
		// BIOS::initComponent('Rewrite')->toUrl($this->request->getController(), $this->request->getAction(), $this->request->getId(), $this->request->getParamList());
		
		
		$this->getRequest()->redirect($this->getRequest()->getRoute()->toUrl('news','view',1099));
	}
	
	
	public function actionView($id, $params)
	{
		
		print_r(func_get_args());
		echo '文章id' . $id;
	}

}