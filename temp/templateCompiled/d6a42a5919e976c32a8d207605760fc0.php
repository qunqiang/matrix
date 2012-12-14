<!--LastCompiled At:[<?php call_user_func(array("Template", "getInfo"), "lastModifyTime");?>]-->
<a href="<?php echo $listurl?>">返回列表</a>
<div style="width:400px; height:300px; border:1px solid;">
	<p> <?php echo $news['title']?> </p>
	<?php if ($news):?>
	<?php echo $news['content']?>
	<?php else:?>
	暂无内容
	<?php endif;?>
</div>