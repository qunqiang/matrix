<?php
class UserInputFilter extends Filter
{

	public function doFilter(&$request)
	{
		$dirtyData = $this->getDirtyData();
		if (isset($dirtyData['q']))
		{
			$data = ($request->getRoute()->parseRoute($dirtyData['q']));
			$request->initRequest($data);
			$data = $request->getParamList();
			if (!empty($data))
			{
				$this->_cleanData($data);
			}
			$request->setData($data);
		}
		else
		{
			BIOS::raise('InvalidParameter');
		}
	}
	
	private function _cleanData(&$data)
	{
		array_walk_recursive($data, array($this, '_filter'));
	}
	
	private function _filter(&$item, $key)
	{
		if ($key == 'test')
		{
			$item = '231234';
		}
	}
}