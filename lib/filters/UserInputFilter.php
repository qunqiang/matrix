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
			$request->setData($request->getParamList());
		}
		else
		{
			BIOS::raise('InvalidParameter');
		}
	}

}