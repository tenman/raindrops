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
    global $current_blog,$tmn_show_header_image;
    if(isset($current_blog)){
        $this_blog = array("b". $current_blog->blog_id);
    }else{
        $this_blog = array();
    }
?><?php echo '<'.'?'.'xml version="1.0" encoding="'.get_bloginfo( 'charset' ).'"'.'?'.'>'."\n";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes('xhtml'); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="content-type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="content-script-type" content="text/javascript" />
<meta http-equiv="content-style-type" content="text/css" />
<title><?php
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
<?php
    if ( is_singular() && get_option( 'thread_comments' )){
        wp_enqueue_script( 'comment-reply' );
    }

    wp_head();
?>
</head>
<body <?php body_class($this_blog); ?>>
<div id="<?php echo warehouse('raindrops_page_width'); ?>" class="<?php echo 'yui-'.warehouse('raindrops_col_width'); ?> hfeed">
<div id="top">
  <div id="hd">
<?php
    if ( 'blank' == get_theme_mod('header_textcolor', HEADER_TEXTCOLOR) || '' == get_theme_mod('header_textcolor', HEADER_TEXTCOLOR)  ){
        $style = ' style="display:none;"';
    }elseif(preg_match("|[0-9a-f]{6}|si",get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ))){
        $style = ' style="color:#' . get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) . ';"';
    }else{
        $style = '';
    }
?>
<?php
    if( is_home() or is_front_page() ){
        $heading_elememt = 'h1';
    }else{
        $heading_elememt = 'div';
    }
    $title_format = '<%s class="h1" id="site-title"><span><a href="%s" title="%s" rel="%s">%s</a></span></%s>';

    printf(
        $title_format,
        $heading_elememt,
        home_url(),
        esc_attr(get_bloginfo( 'name', 'display' )),
        "home",
        get_bloginfo( 'name', 'display' ),
        $heading_elememt
        );
?>
<div id="site-description" <?php echo $style; ?>>
<?php bloginfo( 'description' ); ?>
</div>
</div>
<?php if($tmn_show_header_image == 'yes'){?>
<div id="header-image" class="color3" style="clear:both;background:url(<?php header_image(); ?>);width:100%;height:<?php echo HEADER_IMAGE_HEIGHT;?>px;color:<?php echo HEADER_TEXTCOLOR;?>;background-repeat:no-repeat;background-position:top center;"><span class="hide">headerimage</span></div>
<?php }?>
<div id="access">
<div class="skip-link screen-reader-text"><a href="#container" title="<?php esc_attr_e( 'Skip to content', 'raindrops' ); ?>"><?php _e( 'Skip to content', 'raindrops' ); ?></a></div>
<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
</div>
<br class="clear" />
</div>
<div id="bd" class="clearfix">
