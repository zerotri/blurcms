<?php
/**
 * Code modified by Wynter Woods for Windowpane.
 * Uses a LessPHP rather than the original Ruby LESS.
 * This allows less files to be compiled on the fly by
 * any server supporting PHP, and removes the Ruby
 * requirement.
 *
 * There is a caveat to this, which is documented at
 * the LessPHP site: http://leafo.net/lessphp/docs/
 **/

/**
 * LESS PHP cacher [http://github.com/aaronrussell/less_php_cacher]
 * Extension to LESS for creating cached stylesheets your PHP projects can use
 * Copyright (c) 2009 Aaron Russell [http://www.aaronrussell.co.uk]
 * Licensed under the MIT license [http://www.opensource.org/licenses/mit-license.php]
 * Less is maintained by Alexis Sellier [http://github.com/cloudhead/less]
 *
 * Preparation: lessphpc [command]
 *  Commands:
 *    prepare   Installs the PHP wrapper for LESS and creates a cache folder in your web root
 *    remove    Removes the PHP wrapper from your web project
 *    update    Updates the PHP wrapper to the latest version
 *    help      Displays this help dialogue
 *
 * Integration:
 *  <link rel="stylesheet" href="less.php?stylesheet.less" type="text/css">
 *  ..or..
 *  <?php include 'less.php'; ?>
 *  <style type="text/css">
 *    <?php less_php('stylesheet.less'); ?>
 *  </style>
 **/
require_once ('globals.php');
require_once ( ROOT . '/library/lessc.inc.php' );
define ('NL', "\n");


function less_php($less){
	$source = preg_replace('/(\.less|_less)\Z/i', '', $less);
	$cache = ROOT.'/tmp/cache/'.$source.'.css';
	$sourcefile = ROOT."/".$source . ".less";
	if(file_exists($cache) && filemtime($cache) >= filemtime($sourcefile))
	{
		$f = fopen($cache, 'r');
		echo fread($f, filesize($cache));
		fclose($f);
	}
	else
	{
		$less = new lessc($sourcefile);
		$data = $less->parse();
		$f = fopen($cache, 'w');
		fputs($f, $data);
		fclose($f);
		echo $data;
	}
}

if ($_GET):
  $args = array();
  foreach ($_GET as $key => $value):
    array_push($args, $key);
  endforeach;
  Header("Content-type: text/css");
  less_php($args[0]);
endif;
?>