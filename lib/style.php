<?php
header("Content-type: text/css");
$dir = dirname(dirname(dirname(__FILE__)));

$config_dir = dirname(dirname(dirname(dirname(dirname(__FILE__)))));
require_once($config_dir."/wp-load.php");


ob_start ("ob_gzhandler");
echo '@charset "utf-8";';
echo whitespace_del($dir.'/raindrops/reset-fonts-grids.css');
echo whitespace_del($dir.'/raindrops/grids.css');
echo whitespace_del($dir.'/raindrops/fonts.css');
echo whitespace_del($dir.'/raindrops/style.css');

/*languages*/
if(file_exists($dir.'/raindrops/languages/css/'.WPLANG.'.css')){
    echo whitespace_del($dir.'/raindrops/languages/css/'.WPLANG.'.css');
}

/* child theme style*/
if(basename(dirname(dirname(__FILE__))) !== "raindrops"){
    $current_style = preg_replace("|@import[^;]+;|","",whitespace_del('../style.css'));

echo $current_style;
}
ob_end_flush();

function whitespace_del($path){

    $handle = fopen($path, "r") or die ("error not open");
    $buffer = "";
    $buffers = "";
    while (!feof($handle)) {
        $buffer = fgetss($handle);

        $buffers .= $buffer;
    }
    fclose($handle);
    $buffers = str_replace(array("\r","\n","\t",""),"",$buffers);
    return $buffers;

}
?>