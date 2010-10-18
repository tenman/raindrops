<?php
echo '<?xml version="1.0" encoding="utf-8"?>';
// Tell the browser that this is CSS instead of HTML
header("Content-type: text/html");



?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html lang="ja" xml:lang="ja" xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="content-script-type" content="text/javascript" />
	<meta http-equiv="content-style-type" content="text/css" />
	<meta name="author" content="" />
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rev="made" href="mailto:" />
	<link rel="stylesheet" href="" media="" />
	<link rel="start" href="" />
	<link rel="prev" href="" />
	<link rel="next" href="" />
	<link rel="help" href="" />
	<title></title>
<style>
body{text-align:center;}
div.sq div{
width:40px;
margin:auto;
height:40px;
padding-top:10px;
float:left;
}
p{
margin:0;
padding:10px;


}

<?php echo color_base('ff6666');?>
</style>
</head>

<body>
<div class="sq">
<div class="color1">
hello
</div>
<div class="color2">
hello
</div>
<div class="color3">
hello
</div>
<div class="color4">
hello
</div>
<div class="color5">
hello
</div>
<div class="color-1">
hello
</div>
<div class="color-2">
hello
</div>
<div class="color-3">
hello
</div>
<div class="color-4">
hello
</div>
<div class="color-5">
hello
</div>
</div>

<div style="border:1px solid #ccc;clear:both;width:200px;">
<p class="color1">color1</p>
<p class="color2">color2</p>
<p class="color3">color3</p>
<p class="color4">color4</p>
<p class="color5">color5</p>
<p class="color-1">color-1</p>
<p class="color-2">color-2</p>
<p class="color-3">color-3</p>
<p class="color-4">color-4</p>
<p class="color-5">color-5</p>
<br style="clear:both;" />
</div>
</body>

</html>



<?php


function color_base($color1="#777777",$color2="#777777"){

	$color1 = str_replace('#',"",$color1);
	$color2 = str_replace('#',"",$color2);
	
	// Get the color generating code
	include_once("csscolor.php");

	// Set the error handing for csscolor.
	// If an error occurs, print the error
	// within a CSS comment so we can see
	// it in the CSS file.
	
	PEAR::setErrorHandling(PEAR_ERROR_CALLBACK, 'errorHandler');
	function errorHandler($err) {
		echo("/* ERROR " . $err->getMessage() . " */");
	}

	// Define a couple color palettes
	
	$base = new CSS_Color($color1);
	$highlight = new CSS_Color($color2);
	
	// Trigger an error just to see what happens
	// $trigger <?php new CSS_Color('');

	$bg_1 = $base->bg['-1'];
	$fg_1 = $base->fg['-1'];
	$hgt0 = $highlight->bg['0'];
	$bg_2 = $base->bg['-2'];
	$fg_2 = $base->fg['-2'];
	$bg_3 = $base->bg['-3'];
	$fg_3 = $base->fg['-3'];
	$bg_4 = $base->bg['-4'];
	$fg_4 = $base->fg['-4'];
	$bg_5 = $base->bg['-5'];
	$fg_5 = $base->fg['-5'];
	$bg1 = $base->bg['+1'];
	$fg1 = $base->fg['+1'];
	$hgt0 = $highlight->bg['0'];
	$bg2 = $base->bg['+2'];
	$fg2 = $base->fg['+2'];
	$bg3 = $base->bg['+3'];
	$fg3 = $base->fg['+3'];
	$bg4 = $base->bg['+4'];
	$fg4 = $base->fg['+4'];
	$bg5 = $base->bg['+5'];
	$fg5 = $base->fg['+5'];

	$result=<<<CSS

.color-1{
  background:#{$bg_1};
  color:#{$fg_1};
  border-color: #{$hgt0};
}
.color-2 {
  background:#{$bg_2};
  color:#{$fg_2};
  border-color: #{$hgt0};
}
.color-3 {
  background:#{$bg_3};
  color:#{$fg_3};
  border-color: #{$hgt0};
}
.color-4 {
  /** Use the base color, two shades darker */
  background:#{$bg_4};
  /** Use the corresponding foreground color */
  color:#{$fg_4};
  /** Use the highlight color as a border */
  border-color: #{$hgt0};
}
.color-5 {
  background:#{$bg_5};
  color:#{$fg_5};
  border-color: #{$hgt0};
}
.color1{
  background:#{$bg1};
  color:#{$fg1};
  border-color: #{$hgt0};;
}
.color2 {
  background:#{$bg2};
  color:#{$fg2};
  border-color: #{$hgt0};
}
.color3 {
  background:#{$bg3};
  color:#{$fg3};
  border-color: #{$hgt0};
}
.color4 {
  /** Use the base color, two shades darker */
  background:#{$bg4};
  /** Use the corresponding foreground color */
  color:#{$fg4};
  /** Use the highlight color as a border */
  border-color: #{$hgt0};
}
.color5 {
  background:#{$bg5};
  color:#{$fg5};
  border-color: #{$hgt0};
}

CSS;

return $result;
}
?>