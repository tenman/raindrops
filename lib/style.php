<?php
/**
 *style central
 *
 *
 *
 */
header("Content-type: text/css");
$dir = dirname(dirname(dirname(__FILE__)));
$config_dir = dirname(dirname(dirname(dirname(dirname(__FILE__)))));
require_once($config_dir.'/wp-config.php');
ob_start ("ob_gzhandler");
echo '@charset "utf-8";';
whitespace_del(file_get_contents($dir.'/raindrops/reset-fonts-grids.css'));
whitespace_del(file_get_contents($dir.'/raindrops/grids.css'));
whitespace_del(file_get_contents($dir.'/raindrops/fonts.css'));
whitespace_del(file_get_contents($dir.'/raindrops/style.css'));

if(file_exists($dir.'/raindrops/languages/css/'.WPLANG.'.css')){
whitespace_del(file_get_contents($dir.'/raindrops/languages/css/'.WPLANG.'.css'));
}

if(basename(dirname(dirname(__FILE__))) !== "raindrops"){
$current_style = preg_replace("|@import[^;]+;|","",file_get_contents('../style.css'));
whitespace_del($current_style);
}
ob_end_flush();

function whitespace_del($text){
$result = str_replace(array("\r","\n","\t",""),"",$text);
echo $result;

}
?>