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
		
		
		$this->redirect($this->getRoute()->toUrl('site','index',null, array('test' => 1)));
	}
	
	
	public function actionView($id, $params)
	{
		if ($id >1000)
		{
			$this->redirect($this->getRoute()->toUrl());
		}
		// var_dump($this->getView()->getLayout());
		$this->assign('news', array('title' => 'A test page title', 'content'=>'8月10日，百度站长社区迎来第一期站长门诊开放日，百度搜索专家Lee对于部分问题的回答整理如下：
Lee：首先，公布数字是不可能的，任何一个搜索引擎都不会这么干，我们需要保证判断算法的寿命。
问题2：一个网站内有部分页面的title等设置一样，那么会不会影响到这些页面的相关关键词排名，还是从中选择一个权重高的合适的页面出来参与排名竞争？
Lee：这种问题请参考《百度搜索引擎优化指南》，其中已经有非常明确的说明，多个网页title一样，意味着这部分网页搜索引擎判断其中心内容非常困难，也就不容易准确的给其一个合理的权值。
问题3：请问：百度对于网站分隔符、网站结构是否有自己的标准？目前医疗网站内容同质化严重，请问百度是如何来判定网站权重和自然排名的？
Lee：网站的结构在保证用户体验的前提下，适当的做一些对spider的优化会有助于收录，我们推荐扁平的树型结构。
《百度搜索引擎优化指南》中有详细的说明。'));
		$this->assign('listurl', $this->getRoute()->toUrl('news', 'list', null, array('page'=>$this->get('page', 1)), 'html'));
		// print_r($this->getView()->getAssignments());
		$this->display();
	}
	
	
	public function actionList($id, $params)
	{
		
		var_dump($this->get('test'));
		
		$this->assign('test', array(
			array('title' => 'A test page title', 'url' =>$this->getRoute()->toUrl('news','view',1, null ,'html')),
			array('title' => 'An other test page title', 'url' => $this->getRoute()->toUrl('news','view',2,null, 'html'))
				)
		 );

		// print_r($this->getView()->getAssignments());
		$this->display();
		
	}

}