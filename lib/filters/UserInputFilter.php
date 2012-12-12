<?php
class UserInputFilter extends Filter
{

	public function doFilter($request)
	{
		//TODO: 实现用户数据过滤
         // var_dump($this->getBeforeFilterData());
		$this->setAfterFilteredData(str_replace(array('`', '\'', '\"'), array('', '', ''), $this->getBeforeFilterData()));
		return $this->getAfterFilteredData();
	}

}