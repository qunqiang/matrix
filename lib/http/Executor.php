<?php
class Executor
{
	private $_request;
	
	public function Executor($request)
	{
		$this->_request = $request;
		$this->_run();
	}
	
	private function _run()
	{		
		$target = $this->_request->getController();
		$action = $this->_request->getAction();
		$id		= $this->_request->getId();
		$params = $this->_request->getParamList();
		
		// BIOS::println($this->_request->getRoute()->getLastRouteMap());
		if (class_exists($target))
		{
			$aim = new $target;
			if (method_exists($target, $action))
			{
				$aim->{$action}($id, $params);
			}
			else
			{
				BIOS::raise('ActionNotFound');
			}
		}
		else
		{
			BIOS::raise('ClassNotFound');
		}
		
	}
}