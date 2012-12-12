<!--Template-->
<?php echo $test?>
<?php call_user_func(array('InlineEvent', 'extenalApi'), array('datetime', 'datetime="13910212032" format="Ymd" '));?>
<?php call_user_func(array('InlineEvent', 'extenalApi'), array('hello', 'message="hello world" who="my name" '));?>
<div style="width:400px; height:300px; border:1px solid;">
<ol>
<?php if (is_array($test)) foreach ($test as $key):?>
<li><?php echo $key['title']?></li>
<?php  endforeach;?>
</ol>
</div>