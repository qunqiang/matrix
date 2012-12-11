<?php
/**
	controller_default 默认控制器Default
	action_default 默认控制器动作index(对应控制器的actionIndex方法)
	controller 	控制器
	action		控制器动作
	id			业务对象
	param_list	参数列表(多个param_name/param_value键值对)
	param_name	参数名称
	param_value	参数值
	format		代加:文件格式(html|xml|json)
	
	可以这样编写支持的路由规则
	'controller-action-id.format'
	'controller/action/id/param_name/param_value',
	'controller/action/id/,
	'controller/action/',
	'controller/',
	'/',
	也可以自由定义
	'id/controller/action',
	'id/action/controller',
*/
return array(
	'controller-action.format',
	'controller',
	'controller/action',
	'controller/action/id',
	'controller/action/param_list',
	'controller/action/id/param_list.format',
);