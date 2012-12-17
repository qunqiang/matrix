<?php
class SiteController extends WebAction
{
    public $layout = 'main';

	public function actionIndex()
	{
        $this->assign('hello', 'world');
        $this->display();
	}
}