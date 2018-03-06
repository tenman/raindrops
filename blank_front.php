<?php
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

global $rsidebar_show, $raindrops_document_type,$content_width;
$raindrops_current_column = raindrops_column_controller();
get_header( $raindrops_document_type );
do_action( 'raindrops_pre_' . basename( __FILE__ ) );
$raindrops_current_column = raindrops_column_controller();
raindrops_debug_navitation( __FILE__ );
/**
 * Template Name: brank front
 *
 * Show or Hide Controller Template
 *
 * $raindrops_bf_show_sticky_post
 * $raindrops_bf_recent_posts
 * $raindrops_bf_category_posts
 * $raindrops_bf_tag_posts
 *
 * $raindrops_bf_sticky_post_args	//WP_Query
 * $raindrops_bf_recent_posts_setting	//wp_get_recent_posts
 * $raindrops_bf_category_posts_setting  //get_posts
 * $raindrops_bf_tag_posts_setting	//get_posts
 * 
 * $raindrops_bf_display_title // Site Title
 * $raindrops_bf_display_description // Site description + Need customizer site title and tagline display header text checkbox off
 * $raindrops_bf_display_header_image // header image
 * $raindrops_bf_display_nav_menus // wp_nav_menu
 * $raindrops_bf_display_widget // widget
 * $raindrops_bf_add_custom_text_extra_sidebar // Extra Sidebar show original menu
 * $raindrops_bf_custom_text_extra_sidebar // Extra Sidebar show original menu text
 * $raindrops_bf_add_custom_text_default_sidebar // Default Sidebar show original menu
 * $raindrops_bf_custom_text_default_sidebar // Extra Sidebar show original menu text
 * $raindrops_bf_remove_left_margin // Remove Default Sidebar blank space
 * $raindrops_bf_remove_right_margin // Remove Extra Sidebar blank space
 * $raindrops_bf_display_page_title // Static Page Title
 * $raindrops_bf_display_page_content //Static Page Content
 *
 * usage:
 * $raindrops_bf_display_title = ''; //hide Site Title
 * $raindrops_bf_display_title = 'y'; //Show Site Title
 * variables can write functions.php or this template.
 *
 * @package Raindrops
 * @since Raindrops 0.959
 */


/**
 * @1.456 removed display the Sticky post settings
 */

/**
 * When you display links list of the Recent Posts , please delete comment out of add_action( ).
 *
 *
 *
 */
if ( !isset( $raindrops_bf_recent_posts ) ) {

    $raindrops_bf_recent_posts = 'y';
}
if ( !isset( $raindrops_bf_recent_posts_setting ) ) {

    $raindrops_bf_recent_posts_setting = array(
        'title'                                       => esc_html__( 'Recent Posts', 'raindrops' ),
        'numberposts'                                 => 4, //show count
        'raindrops_excerpt_length'                    => 50, // excerpt length
        'raindrops_excerpt_more'                      => '...', // excerpt more marker
        'raindrops_post_thumbnail'                    => true,
        'raindrops_recent_post_thumbnail_default_uri' => raindrops_warehouse_clone( 'raindrops_show_related_posts_thumbnail_fallback' ),
    );
}

/**
 * When you display the category contain post list , please delete comment out of add_action( ).
 *
 *
 *
 *
 */
if ( !isset( $raindrops_bf_category_posts ) ) {

    $raindrops_bf_category_posts = 'y';
}
if ( !isset( $raindrops_bf_category_posts_setting ) ) {

    $raindrops_bf_category_posts_setting = array(
        'title'                                         => esc_html__( 'Categories', 'raindrops' ),
        'numberposts'                                   => 4, //show count
		'raindrops_excerpt_length'                      => 50, // excerpt length
        'category'                                      => 0, //category id
        'orderby'                                       => 'post_date',
        'order'                                         => 'DESC',
        'raindrops_post_thumbnail'                      => true,
        'raindrops_category_post_thumbnail_default_uri' => raindrops_warehouse_clone( 'raindrops_show_related_posts_thumbnail_fallback' ),
    );
}
/**
 * 　When you display the tagged entry list , please delete comment out of add_action( ).
 *
 *
 *
 *
 */
if ( !isset( $raindrops_bf_tag_posts ) ) {

    $raindrops_bf_tag_posts = 'y';
}
if ( !isset( $raindrops_bf_tag_posts_setting ) ) {

    $raindrops_bf_tag_posts_setting = array(
        'title'                                         => esc_html__( 'Tags', 'raindrops' ),
        'numberposts'                                   => 4, //show count
        'raindrops_excerpt_length'						=> 50, // excerpt length
        'raindrops_post_thumbnail'                      => true,
        'raindrops_category_post_thumbnail_default_uri' => raindrops_warehouse_clone( 'raindrops_show_related_posts_thumbnail_fallback' ),
        'tax_query'                                     => array(
            array(
                'taxonomy' => 'post_tag',
                'terms'    => array( 'post-formats' ), //tag slug
                'field'    => 'slug',
                'operator' => 'IN'
            ),
            'relation' => 'AND'
        )
    );
}
if ( !isset( $raindrops_bf_display_widget ) ) {

    /**
     * Display or not widget
     *
     * value y then show other hide.
     */
    $raindrops_bf_display_widget = 'y';
}
if ( !isset( $raindrops_bf_add_custom_text_extra_sidebar ) ) {

    /**
     * Add your html , line:211 $raindrops_bf_custom_text_extra_sidebar
     *
     * value y then show other hide.
     *
     */
    $raindrops_bf_add_custom_text_extra_sidebar = '';
}
if ( !isset( $raindrops_bf_add_custom_text_default_sidebar ) ) {

    /**
     * Add your html , line:194 $raindrops_bf_custom_text_default_sidebar
     *
     * value y then show other hide.
     *
     */
    $raindrops_bf_add_custom_text_default_sidebar = '';
}
if ( !isset( $raindrops_bf_remove_left_margin ) ) {

    /**
     * When you not need left margin ( blank default sidebar width ).
     *
     * value y then show other hide.
     *
     */
    $raindrops_bf_remove_left_margin = '';
}
if ( !isset( $raindrops_bf_remove_right_margin ) ) {

    /**
     * When you not need right margin ( blank extra sidebar width ).
     *
     * value y then show other hide.
     *
     */
    $raindrops_bf_remove_right_margin = '';
}
if ( !isset( $raindrops_bf_display_page_title ) ) {
    /**
     * Display or not page title
     * value y then show other hide.
     *
     */
    $raindrops_bf_display_page_title = 'y';
}
if ( !isset( $raindrops_bf_display_page_content ) ) {
    /**
     * Display or not page content
     * value y then show other hide.
     *
     */
    $raindrops_bf_display_page_content = 'y';
}
if ( !isset( $raindrops_bf_custom_text_default_sidebar ) ) {
    /**
     * custom_text_default_sidebar
     *
     *
     *
     */
    $raindrops_bf_custom_text_default_sidebar = <<<SUBSTITUTION_CONTENT

<h2>hello world</h2>



SUBSTITUTION_CONTENT;
}
if ( !isset( $raindrops_bf_custom_text_extra_sidebar ) ) {

    /**
     * substitution extra sidebar content
     *
     */
    $raindrops_bf_custom_text_extra_sidebar = <<<SUBSTITUTION_EXTRA_SIDEBAR

<h2>hello world</h2>



SUBSTITUTION_EXTRA_SIDEBAR;
}

/** Do not Edit
 * Functions and filters
 *
 *
 *
 */

if ( isset( $raindrops_bf_recent_posts ) && 'y' == $raindrops_bf_recent_posts ) {

    add_action( 'raindrops_append_entry_content', 'raindrops_recent_posts' );
    $raindrops_bf_recent_posts_setting = apply_filters( 'raindrops_bf_recent_posts_setting', $raindrops_bf_recent_posts_setting );
}
if ( isset( $raindrops_bf_category_posts ) && 'y' == $raindrops_bf_category_posts ) {

    add_action( 'raindrops_append_entry_content', 'raindrops_category_posts' );
    $raindrops_bf_category_posts_setting = apply_filters( 'raindrops_bf_category_posts_setting', $raindrops_bf_category_posts_setting );
}
if ( isset( $raindrops_bf_tag_posts ) && 'y' == $raindrops_bf_tag_posts ) {

    add_action( 'raindrops_append_entry_content', 'raindrops_tag_posts' );
    $raindrops_bf_tag_posts_setting = apply_filters( 'raindrops_bf_tag_posts_setting', $raindrops_bf_tag_posts_setting );
}
if ( 'y' !== $raindrops_bf_display_page_content ) {

    add_filter( 'raindrops_entry_content', '__return_null' );
}

add_filter( 'raindrops_posted_in', '__return_null' );

add_filter( 'raindrops_posted_on', '__return_null' );

/*
  if ( $raindrops_display_wp_link_pages !== 'y' ) {
  add_filter( 'wp_link_pages_args', 'raindrops_wp_link_pages_filter' );
  }
 */

function raindrops_wp_link_pages_filter( $args ) {

    $args['echo'] = false;

    return $args;
}

if ( 'y' !== $raindrops_bf_display_widget ) {

    add_filter( 'dynamic_sidebar', '__return_empty_array' );

    add_filter( 'raindrops_sidebar_menus', '__return_null' );
}

if ( 'y' == $raindrops_bf_add_custom_text_default_sidebar ) {

    add_action( 'raindrops_prepend_default_sidebar', 'raindrops_prepend_default_sidebar_filter' );
}

if ( 'y' == $raindrops_bf_add_custom_text_extra_sidebar ) {

    add_action( 'raindrops_prepend_extra_sidebar', 'raindrops_prepend_default_sidebar_filter' );
}

function raindrops_prepend_default_sidebar_filter() {

    global $raindrops_bf_custom_text_default_sidebar;

    echo $raindrops_bf_custom_text_default_sidebar;
}

function raindrops_prepend_extra_sidebar_filter() {

    global $raindrops_bf_custom_text_extra_sidebar;

    echo $raindrops_bf_custom_text_extra_sidebar;
}

if ( 'y' !== $raindrops_bf_display_page_title ) {

    add_filter( 'raindrops_entry_title', '__return_null' );
}

if ( ( 'y' !== $raindrops_bf_remove_left_margin || 'y' == $raindrops_bf_add_custom_text_default_sidebar ) && 1 !== $raindrops_current_column ) {

    $raindrops_devide_column_class = 'yui-b';
} else {

    $raindrops_devide_column_class = '';
}

if ( ( 'y' !== $raindrops_bf_remove_left_margin || 'y' == $raindrops_bf_add_custom_text_extra_sidebar )  && 1 !== $raindrops_current_column ) {

		$raindrops_devide_column_extra_class = 'yui-u';

} else {

    $raindrops_devide_column_extra_class = '';
}
?>

<div id="yui-main" class="<?php raindrops_dinamic_class( 'yui-main',true ); ?>">
    <div class="<?php echo $raindrops_devide_column_class; ?>">

        <div class="<?php echo raindrops_yui_class_modify(); ?>" id="container">
            <div class="<?php echo $raindrops_devide_column_extra_class; ?> first" <?php /*
            raindrops_is_2col( 'style="width:99%;"' );

            if ( $raindrops_devide_column_extra_class !== 'yui-u' ) {
                echo 'style="width:99%;"';
            }
            */?>>
			<?php get_template_part( 'widget', 'sticky' ); ?>			
 

                <?php get_template_part( 'loop', 'default' ); ?>
                <br style="clear:both" />
            </div>
            <?php if ( $raindrops_devide_column_extra_class == 'yui-u' ) { ?>
                <?php 
                    if ( $rsidebar_show && $raindrops_bf_display_widget == 'y' ) {
						?><div class="yui-u"><?php
						raindrops_prepend_extra_sidebar();
                        get_sidebar( 'extra' );
						raindrops_append_extra_sidebar();
						?></div><?php
                    }
                ?>
            <?php }//if ( $raindrops_devide_column_class == 'yui-u' )  ?>
        </div>
    </div>
</div>
<?php  
if ( 'yui-b' == $raindrops_devide_column_class ) { 
	if ( $raindrops_bf_display_widget == 'y' ) {
		get_sidebar( 'default' );
	}
}//if ( $raindrops_devide_column_class == 'yui-b' )   
get_footer( $raindrops_document_type ); 
?>