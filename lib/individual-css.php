<?php
include_once("../../../../wp-load.php"); 

header('Content-type: text/css');

echo get_option("_raindrops_indv_css","cannot get style value check me");

?>