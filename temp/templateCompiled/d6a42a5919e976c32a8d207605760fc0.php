<!--Template news-->
<?php echo $test?>
<?php echo $test['name']?>
<ul>
<?php if ($test['id'] != '1'):?>
    <li><?php echo $test['title']?></li>
<?php endif;?>

<?php if (($test['id']['name'] != '1') and ($list['id'] == 1)):?>
<a href="<?php echo $url?>">ClickHereToGo</a>
<?php endif;?>
</ul>


<?php if (is_array($test)) foreach ($test as $key):?>
<?php echo $key['title']?>
<?php  endforeach;?>