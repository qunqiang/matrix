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
                    <h1>测试站点css样式</h1>
                </div>
            </div>
      <div class="row">
        <div class="threecol" style="height:400px; backgroud-color:#efe;">
          <div style="height:198px; border:1px solid;">
            box 1
          </div>
          <div style="height:198px; border:1px solid;">
            box 2
          </div>
        </div>
        <div class="ninecol last" style="height:400px; backgroud-color:#efe;">
            <div style="height:198px; border:1px solid;">
                <?php echo $content;?>
            </div>
            
        </div>
      </div>
    <div class="row">
        <div class="twelvecol last" style="color:gray;">
            <span style="float:right;">powered by ln[wangqunqiang@gmail.com]</span>
            <div style="clear:both;"></div>
        </div>
    </div>
</div>
	</body>
</html>