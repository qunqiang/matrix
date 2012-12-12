<?php
class NewsController extends WebAction
{
	public $layout = 'main';

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
		
		
		$this->redirect($this->getRoute()->toUrl('news','view',1099));
	}
	
	
	public function actionView($id, $params)
	{
		// var_dump($this->getView()->getLayout());
		$this->assign('test', array(array('title' => 'A test page title'), array('title' => 'An other test page title')));

		// print_r($this->getView()->getAssignments());
		$this->display();
	}

}