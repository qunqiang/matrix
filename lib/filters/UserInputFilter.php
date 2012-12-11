<?php
class UserInputFilter extends Filter
{

	public function doFilter()
	{
		//TODO: 实现用户数据过滤
		$this->setAfterFilteredData($this->getBeforeFilterData());
		return $this->getAfterFilteredData();
	}

}