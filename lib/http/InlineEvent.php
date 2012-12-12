<?php
class InlineEvent extends Event
{
	
	public function InlineEvent($class, $method, $type, $args = array())
	{
		
	}
	
	public function extenalApi($args)
	{
		$method = '';
		$arg = '';
		if (!isset($args[0]) || !isset($args[1]))
		{
			BIOS::raise('InvalidParameter');
		}
		
		$method = $args[0];
		$argument = trim($args[1]);
		
		$args = array();
		preg_match_all('/(\w+)=[\'"](.+?)[\'"]/', $argument, $args);		
		$params = array();
		if (!empty($args))
		{
			unset($args[0]);
			foreach ($args[1] as $k => $v)
			{
				$params[$v] = $args[2][$k];
			}
		}
		$class = BIOS::activeOS()->getConf('base.runtime.userDefinedTemplateTags');
		$content = call_user_func(array($class, $method), $params);
		echo $content;
	}
	
	public function trigger()
	{
		// BIOS::println("--Inline Event---");
		// BIOS::println($this);
		// BIOS::println(date('Y-m-d H:i:s'));
	}

}