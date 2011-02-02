<?php
//	Copyright (C) 2010 by Wynter Woods <zerotri@gmail.com>
//	This software is distributed under the MIT license. The one thing I ask is
//	that if you use this software for anything, let me know. It's always good
//	to hear that someone else is making use of something you created.
//
//	Permission is hereby granted, free of charge, to any person obtaining a copy
//	of this software and associated documentation files (the "Software"), to deal
//	in the Software without restriction, including without limitation the rights
//	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
//	copies of the Software, and to permit persons to whom the Software is
//	furnished to do so, subject to the following conditions:
//
//	The above copyright notice and this permission notice shall be included in
//	all copies or substantial portions of the Software.
//
//	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
//	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
//	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
//	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
//	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
//	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
//	THE SOFTWARE.
	
require_once (ROOT . DS . 'library' . DS .'markdown.php');

// Not yet implemented
function blur_get_cached_region($region)
{
	
}
// Not yet implemented
function blur_get_region_is_cached($region)
{
	
}
function blur_get_argument()
{
	if ($_GET)
	{
		$args = array();
		foreach ($_GET as $key => $value)
		{
			array_push($args, $key);
		}
		return $args[0];
	}
	else return "";
}
function blur_content($region)
{
	$regionfile = ROOT."/content/".$region . BLURCMS_CONTENT_EXTENSION;
	if(!file_exists($regionfile))
	{
		echo "<p>Content unavailable: $region</p>";
		return;
	}
	$f = fopen($regionfile, 'r');
	if($f != null)
	{
		$filesize = filesize($regionfile);
		if($filesize != 0)
		{
			$text = fread($f, $filesize);
		}
		else $text = "Content region empty: $region";
		echo Markdown($text);
	}	
	fclose($f);
}
?>