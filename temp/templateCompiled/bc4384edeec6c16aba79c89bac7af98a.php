<div style="width:400px; height:300px; border:1px solid;">
<ol>
<?php if (is_array($test)) foreach ($test as $key):?>
<li><a href="<?php echo $key['url']?>"><?php echo $key['title']?></a></li>
<?php  endforeach;?>
</ol>
</div>
