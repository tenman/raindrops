<?php
/**
 * The template for The xhtml1.0 transitional header.
 *
 * Displays all of the <head> section and everything up till <div id="bd">
 *
 * @package WordPress
 * @subpackage Raindrops
 * @since Raindrops 0.1
 */
    global $current_blog;
    if(isset($current_blog)){
        $this_blog = array("b". $current_blog->blog_id);
    }else{
        $this_blog = array();
    }
 echo '<'.'?'.'xml version="1.0" encoding="'.get_bloginfo( 'charset' ).'"'.'?'.'>'."\n";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes('xhtml'); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="content-type" content="<?php bloginfo('html_type');?>; charset=<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="content-script-type" content="text/javascript" />
<meta http-equiv="content-style-type" content="text/css" />
<title><?php echo raindrops_wp_title();?></title>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
    if ( is_singular() && get_option( 'thread_comments' )){
        wp_enqueue_script( 'comment-reply' );
    }
    wp_head();
?>
</head>
<body <?php body_class($this_blog); ?>>
<div id="<?php echo raindrops_warehouse('raindrops_page_width'); ?>" class="<?php echo 'yui-'.raindrops_warehouse('raindrops_col_width'); ?> hfeed">
<div id="top">
<?php
$uploads = wp_upload_dir();
$header_image_uri = $uploads['url'].'/'.raindrops_warehouse('raindrops_header_image');
?>
<div id="hd" style="<?php echo raindrops_upload_image_parser($header_image_uri,'inline','#hd'); ?>">
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
echo raindrops_header_image();
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
<div id="access">
<div class="skip-link screen-reader-text"><a href="#container" title="<?php esc_attr_e( 'Skip to content', 'raindrops' ); ?>"><?php _e( 'Skip to content', 'raindrops' ); ?></a></div>
<?php
wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary'));
?>
</div>
<br class="clear" />
</div>
<div id="bd" class="clearfix">
