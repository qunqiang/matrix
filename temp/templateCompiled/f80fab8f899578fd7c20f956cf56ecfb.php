<html>
	<head>
		<title><?php call_user_func(array("Template", "text"),"siteName");?></title>
		<?php call_user_func(array("Template", "css"),"1140.css,ie.css");?>
     <?php call_user_func(array("Template", "script"),"jquery.min.js,css3-mediaqueries.js");?>
	</head>
	<body>
        <div class="container">
            <div class="row">
                <div class="twelvecol last">
                    <h1><?php call_user_func(array("Template", "text"),"siteName");?></h1>
                </div>
            </div>
		</div>
		<?php echo $content;?>
		<div class="container">
		    <div class="row">
		        <div class="twelvecol last" style="color:gray;">
		            <span style="float:right;">powered by ln[wangqunqiang@gmail.com]</span>
		            <div style="clear:both;"></div>
		        </div>
		    </div>
		</div>
	</body>
</html>