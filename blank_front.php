<?php
/**
 * Template Name: brank front
 *
 *
 *
 * @package Raindrops
 * @since Raindrops 0.959
 *
 *
 */
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
 * @uses preg_match("|[0-9a-f]{6}|si",get_header_textcolor())
 * @uses home_url()
 * @uses esc_attr()
 * @uses get_bloginfo( 'name', 'display' )
 * @uses raindrops_header_image($args = array())
 *
 * @uses raindrops_show_one_column()
 * @uses add_filter()
 * @uses get_header()
 * @uses raindrops_yui_class_modify()
 * @uses have_posts()
 * @uses the_post()
 * @uses the_ID()
 * @uses post_class()
 * @uses the_title_attribute()
 * @uses the_title()
 * @uses the_content()
 * @uses wp_link_pages()
 * @uses the_category(', ')
 * @uses edit_post_link()
 * @uses raindrops_delete_post_link()
 * @uses comments_template( '', true )
 * @uses next_posts_link()
 * @uses previous_posts_link()
 * @uses get_sidebar('extra')
 * @uses get_sidebar('default')
 * @uses get_footer( $raindrops_document_type )
 *
 * @uses wp_upload_dir()
 * @uses raindrops_upload_image_parser($footer_image_uri,'inline','#ft')
 * @uses is_active_sidebar( 'sidebar-4' )
 * @uses get_bloginfo('name')
 * @uses get_bloginfo('rss2_url')
 * @uses ucwords()
 * @uses get_current_theme()
 * @uses wp_footer()
 *
 */
/*
You can add widget
    the_widget($widget, $instance, $args);
    see http://codex.wordpress.org/Function_Reference/the_widget
    widget name below
        (string) the widget's PHP class name.
        WP_Widget_Archives -- Archives
        WP_Widget_Calendar -- Calendar
        WP_Widget_Categories -- Categories
        WP_Widget_Links -- Links
        WP_Widget_Meta -- Meta
        WP_Widget_Pages -- Pages
        WP_Widget_Recent_Comments -- Recent Comments
        WP_Widget_Recent_Posts -- Recent Posts
        WP_Widget_RSS -- RSS
        WP_Widget_Search -- Search (a search from)
        WP_Widget_Tag_Cloud -- Tag Cloud
        WP_Widget_Text -- Text
        WP_Nav_Menu_Widget

    for example
        line:319 , 343

        //the_widget here start

            the_widget("WP_Widget_Calendar");//add widget
        //the_widget here end
*/
/**
 * Settings
 *  need display value 'y'
 *  no need display value ''
 *
 *
 */

/**
 * Display or not Site title
 *
 *
 *
 *
 */
$raindrops_display_title                    = 'y';
/**
 * Display or not Site description
 *
 *
 *
 *
 */
$raindrops_display_description              = 'y';

/**
 * Display or not Site header image
 *
 *
 *
 *
 */
$raindrops_display_header_image             = 'y';
/**
 * Display or not horizontal navigation
 *
 *
 *
 *
 */
$raindrops_display_horizontal_navigation    = 'y';
/**
 * Keep the space extra sidebar
 *
 * when ''  sidebar contents displayed after page content
 *
 *
 */
$raindrops_display_extra_sidebar_column     = 'y';
/**
 * Display or not extrasidebar contents
 *
 * when ''  $substitution_extra_sidebar value show
 * need $raindrops_display_extra_sidebar_column = 'y'
 * when $raindrops_display_extra_sidebar_column = ''
 *  display extra sidebar contents shows page content after
 */
$raindrops_display_extra_sidebar            = 'y';
/**
 * Keep the space default sidebar
 *
 * when ''  sidebar contents displayed after page content
 *
 *
 */
$raindrops_display_default_sidebar_column   = 'y';
/**
 * Display or not defaultsidebar contents
 *
 * when ''  $substitution_default_sidebar value show
 * need $raindrops_display_default_sidebar_column = 'y'
 * when $raindrops_display_default_sidebar_column = ''
 *  display default sidebar contents shows page content after
 */
$raindrops_display_default_sidebar          = 'y';
/**
 * Display or not page title
 *
 */
$raindrops_display_page_title               = 'y';
/**
 * Display or not page content
 *
 * when ''  $substitution_content value show
 *
 */
$raindrops_display_page_content             = 'y';
/**
 * Display or not wp_link_pages
 *
 *
 */
$raindrops_display_wp_link_pages            = 'y';
/**
 * Display or not comment form
 *
 *
 */

$raindrops_display_comments_template        = 'y';
/**
 * Display or not next previus link
 *
 *
 */
$raindrops_display_next_previus_link        = 'y';

/**
 * substitution_content
 *
 * This showes when $raindrops_display_page_content = ''
 *
 *
 */

$substitution_content = <<<SUBSTITUTION_CONTENT

<h1>hello world</h1>




SUBSTITUTION_CONTENT;

/**
 * substitution extra sidebar content
 *
 * This showes when
 *      $raindrops_display_extra_sidebar_column     = 'y';
 *      and
 *      $raindrops_display_extra_sidebar            = '';
 */

$substitution_extra_sidebar = <<<SUBSTITUTION_EXTRA_SIDEBAR

<h2>hello world</h2>




SUBSTITUTION_EXTRA_SIDEBAR;

/**
 * substitution default sidebar content
 *
 * This showes when
 *      $raindrops_display_default_sidebar_column   = 'y';
 *      and
 *      $raindrops_display_default_sidebar          = '';
 */

$substitution_default_sidebar = <<<SUBSTITUTION_DEFAULT_SIDEBAR

<h2>hello world</h2>




SUBSTITUTION_DEFAULT_SIDEBAR;


////////////////////////////////End Settings ////////////////////////////////

/**
 * Template area
 *
 *
 *
 *
 */
    $raindrops_current_column = raindrops_show_one_column();
    if($raindrops_current_column !== false){
        add_filter("raindrops_theme_settings__raindrops_indv_css","raindrops_color_type_custom");
    }
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
<title>
<?php wp_title('|', true, 'right')?>
</title>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head();?>
</head>
<body <?php body_class($this_blog); ?>>
<div id="<?php echo raindrops_warehouse('raindrops_page_width'); ?>" class="<?php if($raindrops_display_default_sidebar_column == 'y'){echo 'yui-'.raindrops_warehouse('raindrops_col_width');} ?> hfeed">
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
if($raindrops_display_title == 'y'){
    echo raindrops_site_title();
}
/**
 * Site description diaplay at header bar when if header text Display Text value is no.
 *
 * example
 *  raindrops_site_description(array("text"=>"replace text","switch" => 'style="display:none;"');
 *
 *
 */
if($raindrops_display_description == 'y'){
    echo raindrops_site_description();
}
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
if($raindrops_display_header_image == 'y'){
    echo raindrops_header_image();
}
?>
<?php
/**
 * horizontal menubar
 *
 *
 *
 *
 */
if($raindrops_display_horizontal_navigation == 'y'){
?>
    <div id="access">
      <div class="skip-link screen-reader-text"><a href="#container" title="<?php esc_attr_e( 'Skip to content', 'raindrops' ); ?>">
        <?php _e( 'Skip to content', 'raindrops' ); ?>
        </a></div>
      <?php
wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary'));
?>
    </div>
    <?php }?>
    <br class="clear" />
  </div>
  <div id="bd" class="clearfix">
    <?php if(WP_DEBUG == true){echo '<!--'.basename(__FILE__,'.php').'['.basename(dirname(__FILE__)).']-->';}?>
    <div id="yui-main">
      <div <?php if($raindrops_display_extra_sidebar_column == 'y' or $raindrops_display_default_sidebar_column == 'y'){ echo 'class="yui-b"';}?>
   <?php if($raindrops_current_column == '1'){
    echo "style=\"width:100%;margin-left:0;\"";}?>>
        <div class="<?php echo raindrops_yui_class_modify();?>" id="container">
          <div class="yui-u first"
<?php
if($raindrops_current_column == 3){

}elseif($raindrops_current_column == 1){
    echo 'style="width:99%;"';
}elseif($raindrops_current_column == 2){

    echo 'style="width:99%;"';
}elseif($raindrops_current_column == false){
    is_2col_raindrops('style="width:99%;"');
}
if($raindrops_display_extra_sidebar_column !== 'y'){
     echo 'style="width:99%;"';
}
?>>
            <?php if (have_posts()){ ?>
            <?php       while (have_posts()){ the_post(); ?>
            <div class="entry page">
              <div id="post-<?php the_ID(); ?>" <?php post_class();?>>
                <?php if($raindrops_display_page_title == 'y'){?>
                <h2 class="h2 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
                  <?php the_title(); ?>
                  </a></h2>
                <?php }//raindrops_display_page_title?>
                <div style="entry-content">
                  <?php if($raindrops_display_page_content == 'y'){?>
                  <?php the_content(__('Read the rest of this entry &raquo;','Raindrops')); ?>
                  <?php
              }else{
              echo $substitution_content;
              }   ?>
                  <br class="clear" />
                </div>
                <?php if($raindrops_display_wp_link_pages == 'y'){?>
                <div class="linkpage clearfix">
                  <?php wp_link_pages('before=<p class="pagenate">&after=</p>&next_or_number=number&pagelink=<span>%</span>'); ?>
                </div>
                <?php }//raindrops_display_wp_link_pages ?>
                <br class="clear" />
                <div class="postmetadata">
                  <?php if($raindrops_display_page_content == 'y'){?>
                  <?php the_category(', ') ?>
                  &nbsp;
                  <?php }//raindrops_display_postmetada  use $raindrops_display_page_content ?>
                  <?php edit_post_link( __( 'Edit', 'Raindrops' ), '<span class="edit-link">', '</span>' ); ?>
                  <?php     raindrops_delete_post_link( __( 'Trash', 'Raindrops' ), '<span class="edit-link">', '</span>' ); ?>
                </div>
                <?php
            if($raindrops_display_comments_template == 'y'){
                comments_template( '', true );
            }
            ?>
              </div>
            </div>
            <?php       } //endwhile ?>
            <?php       if ( $wp_query->max_num_pages > 1  and $raindrops_display_next_previus_link == 'y'){ ?>
            <div id="nav-below" class="clearfix"> <span class="nav-previous">
              <?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'Raindrops' ) ); ?>
              </span> <span class="nav-next">
              <?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'Raindrops' ) ); ?>
              </span> </div>
            <?php       } //end max_num_pages > 1 ?>
            <?php } //end have post?>
          </div>
          <?php if(raindrops_show_one_column() == 3){?>
          <div class="yui-u">
            <?php get_sidebar('extra');?>
          </div>
          <?php
}elseif($rsidebar_show and $raindrops_current_column == false){?>
         <div class="yui-u">
            <?php
if($raindrops_display_extra_sidebar == 'y'){
    get_sidebar('extra');
}elseif($raindrops_display_extra_sidebar_column == 'y'){
    echo $substitution_extra_sidebar;
//the_widget here start


//the_widget here end
}
?>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <?php if($raindrops_current_column == 3 or $raindrops_current_column == 2){?>
    <div <?php if($raindrops_display_extra_sidebar_column == 'y'){ echo 'class="yui-b"';}?>>
      <?php get_sidebar('default'); ?>
    </div>
    <?php
}elseif(raindrops_show_one_column() !== '1' or $raindrops_current_column == false){?>
    <div <?php if($raindrops_display_default_sidebar_column == 'y'){echo 'class="yui-b"';}?>>
      <?php //lsidebar start ?>
      <?php
if($raindrops_display_default_sidebar == 'y'){
    get_sidebar('default');
}elseif($raindrops_display_default_sidebar_column == 'y'){
    echo $substitution_default_sidebar;
//the_widget here start


//the_widget here end
}?>
    </div>
    <?php }?>
  </div>
  <?php
$uploads = wp_upload_dir();
$footer_image_uri = $uploads['url'].'/'.raindrops_warehouse('raindrops_footer_image');
?>
  <div id="ft" class="clear" style="<?php echo raindrops_upload_image_parser($footer_image_uri,'inline','#ft'); ?>">
    <!--footer-widget start-->
    <div class="widget-wrapper clearfix">
      <?php if ( is_active_sidebar( 'sidebar-4' ) ) {?>
      <ul>
        <?php dynamic_sidebar('sidebar-4');?>
      </ul>
      <?php } ?>
      <br class="clear" />
    </div>
    <!--footer-widget end-->
    <address>
    <?php
printf(
'<small>&copy;%s %s <a href="%s" class="entry-rss">%s</a> and <a href="%s" class="comments-rss">%s</a></small>&nbsp;',
date("Y"),
get_bloginfo('name'),
get_bloginfo('rss2_url') ,
__("Entries <span>(RSS)</span>","Raindrops"),
get_bloginfo('comments_rss2_url'),
__('Comments <span>(RSS)</span>',"Raindrops")
);
if( is_child_theme() ){
    $raindrops_theme_name = 'Child theme '.ucwords(get_current_theme()).' of '.__("Raindrops Theme","Raindrops");
}else{
    $raindrops_theme_name = __("Raindrops Theme","Raindrops");
}
printf(
'&nbsp;<small><a href="%s">%s</a></small>&nbsp;&nbsp;',
'http://www.tenman.info/wp3/raindrops',
$raindrops_theme_name
);
?>
    </address>
  </div>
</div>
<?php wp_footer(); ?>
</body>
</html>