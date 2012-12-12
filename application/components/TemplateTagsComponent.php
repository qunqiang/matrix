<?php
class TemplateTagsComponent 
{

	public static function datetime($args)
	{
		return date($args['format'], $args['datetime']);
	}
	
	public static function hello($args)
	{
		return $args['message'] . ',' . $args['who'];
	}

}