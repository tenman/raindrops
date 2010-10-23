<?php
/**
 * create individual stylesheet
 *
 *
 * @package WordPress
 * @subpackage Raindrops
 * @since Raindrops 0.1
 */
 
if(!defined('ABSPATH')){exit;}

include(ABSPATH."/wp-load.php"); 
	
	include_once(STYLESHEETPATH."/lib/csscolor/csscolor.php");

$images_path			= get_bloginfo('stylesheet_directory').'/images/';

$count 					= warehouse('raindrops_base_color');
$style_type 			= warehouse('raindrops_style_type');
$navigation_title_img 	= warehouse('raindrops_heading_image');
$position_y 			= warehouse('raindrops_heading_image_position');
$tmn_header_image 		= warehouse('raindrops_header_image');
$tmn_header_color 		= warehouse('raindrops_default_fonts_color');
$tmn_footer_image 		= warehouse('raindrops_footer_image');
$tmn_footer_color 		= warehouse('raindrops_footer_color');

define("BASE_COLOR1",$count);

//define("BASE_COLOR2","#ff0000");

/**
 * save stylesheet
 *
 */

$raindrops_indv_css = design_output($style_type,$position_y).color_base();

if(get_option("_raindrops_indv_css","none") == "none"){
	add_option("_raindrops_indv_css",$raindrops_indv_css);
}else{
	update_option("_raindrops_indv_css",$raindrops_indv_css);
}

  $parm = fileperms(STYLESHEETPATH.'/lib/');
  $parm = decoct($parm);
  

/*
if(!is_writable(STYLESHEETPATH.'/lib/')){ 

echo '<div style="padding:2em;color:red">'.STYLESHEETPATH.'/lib/' .__(' Permission denied change writable').'</div>';
}

*/

function colors($num = 0, $select = 'set',$color1 = null){
	global $images_path;	
	
	if($color == null){
		$color1 = str_replace('#',"",BASE_COLOR1);
	}else{
		$color1 = str_replace('#',"",$color1);
	
	}
		$base = new CSS_Color( $color1 );
		
	switch($num){
	
	case(0):
		$bg 		= $base->bg['0'];
		$fg 		= $base->fg['0'];
		$color 	= "color:#$fg;background-color:#$bg;";
		break;
		case(-1):
		$bg 		= $base->bg['-1'];
		$fg 		= $base->fg['-1'];
		$color 	= "color:#$fg;background-color:#$bg;";
		break;
		case(-2):
		$bg 		= $base->bg['-2'];
		$fg 		= $base->fg['-2'];
		$color 	= "color:#$fg;background-color:#$bg;";
		break;
		case(-3):
		$bg 		= $base->bg['-3'];
		$fg 		= $base->fg['-3'];
		$color 	= "color:#$fg;background-color:#$bg;";
		break;
		case(-4):
		$bg 		= $base->bg['-4'];
		$fg 		= $base->fg['-4'];
		$color 	= "color:#$fg;background-color:#$bg;";
		break;
		case(-5):
		$bg 		= $base->bg['-5'];
		$fg 		= $base->fg['-5'];
		$color 	= "color:#$fg;\n\tbackground-color:#$bg;";
		break;
		case(1):
		$bg 		= $base->bg['+1'];
		$fg 		= $base->fg['+1'];
		$color 	= "color:#$fg;\n\tbackground-color:#$bg;";
		break;
		case(2):
		$bg 		= $base->bg['+2'];
		$fg 		= $base->fg['+2'];
		$color 	= "color:#$fg;\n\tbackground-color:#$bg;";
		break;
		case(3):
		$bg 		= $base->bg['+3'];
		$fg 		= $base->fg['+3'];
		$color 	= "color:#$fg;\n\tbackground-color:#$bg;";
		break;
		case(4):
		$bg 		= $base->bg['+4'];
		$fg 		= $base->fg['+4'];
		$color 	= "color:#$fg;\n\tbackground-color:#$bg;";
		break;
		case(5):
		$bg 		= $base->bg['+5'];
		$fg 		= $base->fg['+5'];
		$color 	= "color:#$fg;\n\tbackground-color:#$bg;";
		break;
		default:
		$bg 		= $base->bg['0'];
		$fg 		= $base->fg['0'];
		$color 	= "color:#$fg;\n\tbackground-color:#$bg;";
		break;
		
	}	
	switch($select){
	
		case('set'):
		
		return $color;
		break;
		case('background'):
		
		return '#'.$bg;
		break;
		case('color'):
		
		return '#'.$fg;
		break;
	
	}
	
}

function color_base($color1=null,$colo2=null){
global $images_path;
if($color == null){
	$color1 = str_replace('#',"",BASE_COLOR1);
}else{
	$color1 = str_replace('#',"",$color1);

}
if($color == null){
	$color2 = str_replace('#',"",BASE_COLOR2);
}else{

	$color2 = str_replace('#',"",$color2);
}
	

	
	$base = new CSS_Color($color1);
	$highlight = new CSS_Color($color2);
	
	$bg_1 = $base->bg['-1'];
	$fg_1 = $base->fg['-1'];
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
}
.color-2 {
  background:#{$bg_2};
  color:#{$fg_2};
}
.color-3 {
  background:#{$bg_3};
  color:#{$fg_3};
}
.color-4 {
  /** Use the base color, two shades darker */
  background:#{$bg_4};
  /** Use the corresponding foreground color */
  color:#{$fg_4};
}
.color-5 {
  background:#{$bg_5};
  color:#{$fg_5};
}
.color0{
  background:#{$bg0};
  color:#{$fg0};
}
.color1{
  background:#{$bg1};
  color:#{$fg1};
}
.color2 {
  background:#{$bg2};
  color:#{$fg2};
}
.color3 {
  background:#{$bg3};
  color:#{$fg3};
}
.color4 {
  /** Use the base color, two shades darker */
  background:#{$bg4};
  /** Use the corresponding foreground color */
  color:#{$fg4};
}
.color5 {
  background:#{$bg5};
  color:#{$fg5};
}
.face-1{
  color:#{$fg_1};
}
.face-2 {
  color:#{$fg_2};
}
.face-3 {
  color:#{$fg_3};
}
.face-4 {
  color:#{$fg_4};
}
.face-5 {
  color:#{$fg_5};
}
.face1{
  color:#{$fg1};
}
.face2 {
  color:#{$fg2};
}
.face3 {
  color:#{$fg3};
}
.face4 {
  color:#{$fg4};
}
.face5 {
  color:#{$fg5};
}

CSS;

return $result;
}

function hex2rgba($color,$opecity){

    if ($color[0] == '#')
        $color = substr($color, 1);

    if (strlen($color) == 6)
        list($r, $g, $b) = array($color[0].$color[1],
                                 $color[2].$color[3],
                                 $color[4].$color[5]);
    elseif (strlen($color) == 3)
        list($r, $g, $b) = array($color[0].$color[0], $color[1].$color[1], $color[2].$color[2]);
    else
        return false;

    $r = hexdec($r); $g = hexdec($g); $b = hexdec($b);

    return "rgba({$r}, {$g}, {$b},{$opecity})";
}
?>