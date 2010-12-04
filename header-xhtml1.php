<?php
/**
 * The xhtml1.0 transitional header for our theme.
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

?><?php echo '<'.'?'.'xml version="1.0" encoding="'.get_bloginfo( 'charset' ).'"'.'?'.'>'."\n";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="ja" xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="content-type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="content-script-type" content="text/javascript" />
<meta http-equiv="content-style-type" content="text/css" />
<title>
<?php
    /*
     * Print the <title> tag based on what is being viewed.
     */
    global $page, $paged;

    wp_title( '|', true, 'right' );

    // Add the blog name.
    bloginfo( 'name' );

    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        echo " | $site_description";

    // Add a page number if necessary:
    if ( $paged >= 2 || $page >= 2 )
        echo ' | ' . sprintf( __( 'Page %s', 'raindrops' ), max( $paged, $page ) );

    ?>
</title>

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rev="made" href="mailto:<?php echo str_replace("@","&#64;",get_bloginfo( 'admin_email' )); ?>" />
<?php
    /* We add some JavaScript to pages with the comment form
     * to support sites with threaded comments (when in use).
     */
    if ( is_singular() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );

    /* Always have wp_head() just before the closing </head>
     * tag of your theme, or you will break many plugins, which
     * generally use this hook to add elements to <head> such
     * as styles, scripts, and meta tags.
     */
    wp_head();
?>
<?php
/**
 * insert into embed style ,javascript script and embed tags from custom field
 *
 *
 */
if (is_single() || is_page()) {

 while (have_posts()) : the_post();

    $css = get_post_meta($post->ID, 'css', true);
    if (!empty($css)) { ?>
<style type="text/css">
    /*<![CDATA[*/
    <?php echo $css; ?>
    /*]]>*/
        </style>
<?php }
    $javascript = get_post_meta($post->ID, 'javascript', true);
    if (!empty($javascript)) { ?>
<script type="text/javascript">
        /*<![CDATA[*/
        <?php echo $javascript; ?>
        /*]]>*/
        </script>
<?php }
    $meta = get_post_meta($post->ID, 'meta', true);
    if (!empty($meta)) { ?>
<?php echo $meta; ?>
<?php }
endwhile;
}
?>
</head>
<body <?php body_class($this_blog); ?>>
<div id="<?php echo warehouse('raindrops_page_width'); ?>" class="<?php echo 'yui-'.warehouse('raindrops_col_width'); ?> hfeed">
<!--header-->
<div id="top">
  <div id="hd">
    <?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
    <<?php echo $heading_tag; ?> id="site-title" class="h1"> <span> <a href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
    <?php bloginfo( 'name' ); ?>
    </a> </span> </<?php echo $heading_tag; ?>>
    <div id="site-description">
      <?php bloginfo( 'description' ); ?>
    </div>
  </div>

<?php if(SHOW_HEADER_IMAGE == true){?>

    <div id="header-image" class="color3" style="clear:both;background:#000 url(<?php header_image(); ?>);width:100%;height:<?php echo HEADER_IMAGE_HEIGHT;?>px;color:<?php echo HEADER_TEXTCOLOR;?>;background-repeat:no-repeat;background-position:top center;margin:0;"><span style="display:none">headerimage</span></div>
<?php }?>
 <!-- role="navigation" -->
  <div id="access">

    <div class="skip-link screen-reader-text" id="content"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'raindrops' ); ?>"><?php _e( 'Skip to content', 'raindrops' ); ?></a></div>
    <?php

    wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>

    </div>
  <br class="clearfix" />
</div>
<!--header-->
<div id="bd" style="clear:both;">
