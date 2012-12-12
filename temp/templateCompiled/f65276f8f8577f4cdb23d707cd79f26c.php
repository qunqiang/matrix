<!--LastCompiled At:[<?php call_user_func(array("Template", "getInfo"), "lastModifyTime");?>]-->
<?php call_user_func(array('InlineEvent', 'extenalApi'), array('hello', 'message="hello world" who="my name" '));?>
<?php call_user_func(array('InlineEvent', 'extenalApi'), array('datetime', 'datetime="13015111153" format="m/d/Y H:i:s"'));?>
<div style="width:400px; height:300px; border:1px solid;">
<ol>
<?php if (is_array($test)) foreach ($test as $key):?>
<li><?php echo $key['title']?></li>
<?php  endforeach;?>
</ol>
</div>