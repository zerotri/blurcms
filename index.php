<?php
ob_start();
require_once ('globals.php');
require_once (ROOT . DS . 'library' .DS .'blurcms.php');
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<link rel="stylesheet" type="text/css" href="less.php?default.less">
	</head>
	<body>
		<div class="header">
			<?php blur_content('header'); ?>
		</div>
		<div class="nav">
			<?php blur_content('navbar'); ?>
		</div>
		<div class="content">
			<?php
			$arg = blur_get_argument();
			if($arg == "")
			{
				$arg = "main";
			}
			blur_content($arg); ?>
		</div>
	</body>
</html>	
<?php ob_end_flush();?>