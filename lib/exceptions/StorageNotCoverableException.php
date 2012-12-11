<?php
class StorageNotCoverableException extends Signal
{
	public $message = '无法覆盖已经存在的Key, 如果需要强制刷新已经存在的Key, 请参考手册';
	public $code 	= 501;
}