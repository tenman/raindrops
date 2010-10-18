<?php
/**
 *　cssファイルの集約と圧縮
 *
 *
 *
 */

header("Content-type: text/css");


ob_start ("ob_gzhandler");
echo '@charset "utf-8";';
whitespace_del(file_get_contents('../reset-fonts-grids.css'));
whitespace_del(file_get_contents('../grids.css'));
whitespace_del(file_get_contents('../fonts.css'));
whitespace_del(file_get_contents('../style.css'));

/*whitespace_del(file_get_contents('my.css'));*/

ob_end_flush();

function whitespace_del($text){

$result = str_replace(array("\r","\n","\t","　"),"",$text);
echo $result;

}

//<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ? >" type="text/css" media="all" />
?>