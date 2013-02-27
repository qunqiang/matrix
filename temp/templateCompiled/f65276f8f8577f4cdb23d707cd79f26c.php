<h3> <?php echo $news['title']?> </h3>
<?php if ($news):?>
<?php echo $news['content']?>
<?php else:?>
暂无内容
<?php endif;?>
<a href="http://www.baidu.com">百度垃圾站</a>|<a href="<?php echo $listurl?>">返回列表</a>|<a href="###" id="clickme">弹个框吧</a>
<?php call_user_func(array("Template", "script"),"test.js");?>