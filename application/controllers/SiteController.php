<?php
class SiteController extends WebAction
{
    public $layout = 'main';

	public function actionIndex()
	{
		print_r($this->get());
        $this->assign('hello', 'world');
        $this->display();
	}
}