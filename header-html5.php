<!DOCTYPE html>
<html <?php language_attributes( ); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]--> 
<?php
		wp_head( );
?>
	</head>
<body <?php body_class( ); ?>>
	<div id="<?php echo esc_attr( raindrops_warehouse( 'raindrops_page_width' ) ); ?>" class="<?php echo esc_attr( 'yui-'.raindrops_warehouse( 'raindrops_col_width' ) ); ?> hfeed">
<?php
		raindrops_prepend_doc( );
?>
		<header id="top">
			<div id="hd">
<?php
/**
 * Conditional Switch html headding element
 *
 * example
 *  raindrops_site_title( " add some text" );
 *
 */
		echo raindrops_site_title( );
/**
 * Site description diaplay at header bar when if header text Display Text value is no.
 *
 * example
 *  raindrops_site_description( array("text"=>"replace text","switch" => 'style="display:none;"' );
 *
 *
 */
		echo raindrops_site_description( );
?>
			</div>
<?php
/**
 * header image
 *
 * if no link home_url( ) then use 'elements'
 *
 */
		echo raindrops_header_image( 'home_url' );
?>
<?php
/**
 * horizontal menubar
 *
 *
 *
 *
 */
 
		raindrops_nav_menu_primary( );
		

		raindrops_after_nav_menu( );
?>
		</header>
		<div id="bd" class="clearfix">