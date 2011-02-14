<?php
header("Content-type: text/css");
    $raindrops_dir      = dirname(dirname(dirname(__FILE__)));
    $raindrops_config_dir = dirname(dirname(dirname(dirname(dirname(__FILE__)))));
    require_once($raindrops_config_dir."/wp-load.php");
    $lang       = get_bloginfo("language");
echo $raindrops_dirs;
//ob_start ("ob_gzhandler");
    echo '@charset "utf-8";';
    echo whitespace_del($raindrops_dir.'/raindrops/reset-fonts-grids.css');
    echo whitespace_del($raindrops_dir.'/raindrops/grids.css');
    echo whitespace_del($raindrops_dir.'/raindrops/fonts.css');
    echo whitespace_del($raindrops_dir.'/raindrops/style.css');
/*languages*/
    if(file_exists($raindrops_dir.'/raindrops/languages/css/'.$lang.'.css')){
        echo whitespace_del($raindrops_dir.'/raindrops/languages/css/'.$lang.'.css');
    }
/* child theme style*/
    if(basename(dirname(dirname(__FILE__))) !== "raindrops"){
        $current_style = preg_replace("|@import[^;]+;|","",whitespace_del('../style.css'));

    echo $current_style;
    }
//ob_end_flush();

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