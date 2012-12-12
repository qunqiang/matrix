<!--Template news-->
<?php echo $test?>

<ol>
<?php if (is_array($test)) foreach ($test as $key):?>
<li><?php echo $key['title']?></li>
<?php  endforeach;?>
</ol>