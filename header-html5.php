<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title>
<?php wp_title('|', true, 'right')?>
</title>
	<!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]--> 
<?php wp_head();?>
</head>
<body <?php body_class(); ?>>
<div id="<?php echo raindrops_warehouse('raindrops_page_width'); ?>" class="<?php echo 'yui-'.raindrops_warehouse('raindrops_col_width'); ?> hfeed">
<?php raindrops_prepend_doc();?>
<header id="top">
<div id="hd">
<?php
/**
 * Conditional Switch html headding element
 *
 * example
 *  raindrops_site_title(" add some text");
 *
 */
echo raindrops_site_title();
/**
 * Site description diaplay at header bar when if header text Display Text value is no.
 *
 * example
 *  raindrops_site_description(array("text"=>"replace text","switch" => 'style="display:none;"');
 *
 *
 */
echo raindrops_site_description();
?>
</div>
<?php
/**
 * header image
 * array("style"=>"border:3px solid red;",'img' => 'replace your image uri','color' => 'hexcolor not need #','description' => 'replace your text','description_style' => 'desctiption style rule')
 *
 *
 *
 */
echo raindrops_header_image( 'elements' );
?>
<?php
/**
 * horizontal menubar
 *
 *
 *
 *
 */
?>
<?php
if( raindrops_warehouse( 'raindrops_show_menu_primary' ) == "show" ){ ?>
<p class="raindrops-mobile-menu"><a href="#access" class="open">+</a><span class="menu-text">menu</span><a href="#<?php echo raindrops_warehouse('raindrops_page_width'); ?>" class="close">-</a></p>
<nav id="access">
<div class="skip-link screen-reader-text"><a href="#container" title="<?php esc_attr_e( 'Skip to content', 'Raindrops' ); ?>"><?php _e( 'Skip to content', 'Raindrops' ); ?></a></div>
<?php 
wp_nav_menu( array('container_class' => 'menu-header', 'theme_location' => 'primary') ); ?>
</nav>
<br class="clear" />
<?php raindrops_after_nav_menu();?>
<?php  }//raindrops_warehouse( 'raindrops_show_menu_primary' ) ?>
</header>
<div id="bd" class="clearfix">