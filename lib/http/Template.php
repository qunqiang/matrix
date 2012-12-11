<?php
class Template
{
	static $template;
	private $_vars;
	
	private function Template()
	{

	}
	
	public function initView()
	{
		if (!self::$template)
		{
			self::$template = new Template;
		}
		return self::$template;
	}
	
	
	public function render($tpl = '')
	{
		$tkey = '';
		if ($this->_checkTemplate($tpl))
		{
			$tkey = $this->_compile($tpl, $this->getAssignments());
		}
		
		echo $tpl;
		
	}
	
	private function getAssignments()
	{
		return $this->_vars;
	}
	
	private function _checkTemplate($tpl)
	{
		// check template file for exsiting
		
		return true;
	}
	
	private function _compile($tpl, $data)
	{
		
		return md5($tpl);
	}


	

}