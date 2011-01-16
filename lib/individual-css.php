<?php
$config_dir = dirname(dirname(dirname(dirname(dirname(__FILE__)))));
include_once($config_dir."/wp-load.php");

header('Content-type: text/css');

echo get_option("_raindrops_indv_css","cannot get style value check me");

?>