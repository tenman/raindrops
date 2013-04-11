<?php
/**
 * The xhtml1.0 transitional header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="bd">
 *
 * @package Raindrops
 * @since Raindrops 0.997
 *
 */
		global $raindrops_document_type;
		
		switch( $raindrops_document_type ){
/**
 *
 *
 *
 *
 */
			case( 'html5' ):
			
?>
<!DOCTYPE html>
<html <?php language_attributes( ); ?>>
	<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]--> 
<?php wp_head( );?>
	</head>
<?php

			break;
/**
 *
 *
 *
 *
 */
			default:
			
echo '<'.'?'.'xml version="1.0" encoding="'.get_bloginfo( 'charset' ).'"'.'?'.'>'."\n";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>>
	<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="content-type" content="<?php bloginfo( 'html_type' );?>; charset=<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="content-script-type" content="text/javascript" />
	<meta http-equiv="content-style-type" content="text/css" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php 
		wp_head( );
?>
	</head>
<?php
			break;
		}
?>
	<body <?php body_class( ); ?>>
		<div id="<?php echo esc_attr( raindrops_warehouse( 'raindrops_page_width' ) ); ?>" class="<?php echo esc_attr( 'yui-'.raindrops_warehouse( 'raindrops_col_width' ) ); ?> hfeed">
<?php
		raindrops_prepend_doc( );
?>
			<<?php raindrops_doctype_elements( 'div', 'header' );?> id="top">
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
 *  raindrops_site_description( array("text"=>"replace text","switch" => 'style="display:none;"' ) );
 *
 *
 */
		echo raindrops_site_description( );
?>
				</div>
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
			</<?php raindrops_doctype_elements( 'div', 'header' );?>>

<?php
		$raindrops_header_image = raindrops_header_image( 'elements' );
		
		if( ! empty( $raindrops_header_image ) or has_post_thumbnail( ) ){
?>
			<span id="container"></span>
			<div class="yui-g">
				<div class="yui-u first">
					<div class="static-front-content">
<?php	
			if ( have_posts( ) ) {
                while (have_posts( ) ) {
                        the_post( );
                        the_content( );
                }
            }
?>
            			<br style="clear:both" />
        			</div>
    			</div>
			<div class="yui-u">
				<div class="static-front-media">
<?php
			if ( has_post_thumbnail( ) ){
				the_post_thumbnail( 'large', 'style=max-width:100%;height:auto;' );
			} else {
				echo $raindrops_header_image;
			}
		} else {
?>  
					<div class="static-front-content">
<?php
			if ( have_posts( ) ) {
				while (have_posts( ) ) {
						the_post( );
						the_content( );
				}
        	}
?>
        				<br style="clear:both" />
    				</div>
<?php
		}
?>
				</div>
			</div>
		</div>
	<div id="bd" class="clearfix">