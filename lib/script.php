<?php
/**
 * jsファイルの集約と、圧縮処理
 *　
 *
 *
 */

header('Content-type: text/javascript');
ob_start ("ob_gzhandler");

whitespace_del(file_get_contents('jquery.js'));
whitespace_del(file_get_contents('my.js'));

ob_end_flush();

function whitespace_del($text){

$text = str_replace(array("\t"),"",$text);
echo $text;

}
?>