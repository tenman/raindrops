<?php
/**
 * The xhtml1.0 transitional header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="bd">
 *
 * @package Raindrops
 * @since Raindrops 0.1
 *
 * @uses get_bloginfo( 'charset' )
 * @uses language_attributes('xhtml')
 * @uses bloginfo('html_type')
 * @uses bloginfo( 'charset' )
 * @uses wp_title( '|', true, 'right' )
 * @uses bloginfo( 'name' ) 
 * @uses get_bloginfo( 'description', 'display' ) 
 * @uses bloginfo( 'pingback_url' )
 * @uses is_singular()
 * @uses get_option( 'thread_comments' )
 * @uses wp_enqueue_script( 'comment-reply' )
 * @uses wp_head()
 * @uses body_class($this_blog)
 * @uses raindrops_warehouse('raindrops_page_width')
 * @uses raindrops_warehouse('raindrops_col_width')
 * @uses wp_upload_dir()
 * @uses raindrops_upload_image_parser($header_image_uri,'inline','#hd')
 * @uses get_theme_mod('header_textcolor', HEADER_TEXTCOLOR)
 * @uses get_header_textcolor()
 * @uses preg_match("!([0-9a-f]{6}|[0-9a-f]{3})!si",get_header_textcolor())
 * @uses home_url()
 * @uses esc_attr()
 * @uses get_bloginfo( 'name', 'display' )
 * @uses raindrops_header_image($args = array()) 
 * 
 * 
 */
echo '<'.'?'.'xml version="1.0" encoding="'.get_bloginfo( 'charset' ).'"'.'?'.'>'."\n";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes('xhtml'); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="content-type" content="<?php bloginfo('html_type');?>; charset=<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="content-script-type" content="text/javascript" />
<meta http-equiv="content-style-type" content="text/css" />
<title><?php wp_title('|', true, 'right')?></title>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head();?>
</head>
<body <?php body_class(); ?>>
<div id="<?php echo raindrops_warehouse('raindrops_page_width'); ?>" class="<?php echo 'yui-'.raindrops_warehouse('raindrops_col_width'); ?> hfeed">
<div id="top">
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
<div id="access">
<div class="skip-link screen-reader-text"><a href="#container" title="<?php esc_attr_e( 'Skip to content', 'raindrops' ); ?>"><?php _e( 'Skip to content', 'raindrops' ); ?></a></div>
<?php 
wp_nav_menu( array('container_class' => 'menu-header', 'theme_location' => 'primary') ); ?>
</div>
<br class="clear" />
</div>
<?php  }//raindrops_warehouse( 'raindrops_show_menu_primary' ) ?>
<div id="bd" class="clearfix">
