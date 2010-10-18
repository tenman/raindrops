<?php
header('Content-type: image/png');
//http://example.com/wordpress/blogname/wp-content/themes/blogname/page/banner.php

//ページ固有のpngファイルは、接頭辞page_をつけてください。

$filename = "../page/page_".htmlspecialchars($_GET['f']).'.png';

if (file_exists($filename) ) {

	@readfile($filename);
	
exit;
	
} else {

foreach(glob("../page/*{.png}",GLOB_BRACE) as $key=>$val){
if(!preg_match("|page_|",$val)){
 $result[] = $val;
 $count = $key;
 }
 
}


$num = rand(0,$count);

if(!readfile($result[$num])){

@readfile("default.png");
}
exit;
}