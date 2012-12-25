<?php


/**
 * Filter and actions for Raindrops theme
 *
 *
 * @package Raindrops
 * @since Raindrops 0.948
 */
add_action( 'after_setup_theme', 'raindrops_theme_setup' );

function raindrops_theme_setup(){
    global $raindrops_wp_version;
    add_filter( 'use_default_gallery_style', '__return_false' );
    //add ver0.991
    add_theme_support( 'post-formats', array( 'status', 'gallery' ) );
/**
 * Custom image header
 *
 *
 *
 *
 *
 */
    if(file_exists(get_stylesheet_directory().'/images/headers/wp3.jpg')){
        $raindrops_site_image = get_stylesheet_directory_uri().'/images/headers/wp3.jpg';
        $raindrops_site_thumbnail_image = get_stylesheet_directory_uri().'/images/headers/wp3-thumbnail.jpg';
    }else{
        $raindrops_site_image = get_template_directory_uri().'/images/headers/wp3.jpg';
        $raindrops_site_thumbnail_image = get_template_directory_uri().'/images/headers/wp3-thumbnail.jpg';
    }

    if( $raindrops_wp_version >= '3.4' ){
        $args = array( 'default-text-color' => 'bbb'
                    , 'width' => apply_filters( 'raindrops_header_image_width', '950' )
                    , 'flex-width' => true
                    , 'height' => apply_filters( 'raindrops_header_image_height', '198' )
                    , 'flex-height' => true
                    , 'header-text' => true
                    , 'default-image' => $raindrops_site_image
                    , 'wp-head-callback' => 'raindrops_embed_meta'
                );
						
        //they are "suggested" when flex-width and flex-height are set
        add_theme_support( 'custom-header', $args );

    }else{
        add_custom_image_header(
            'raindrops_header_style',
            'raindrops_admin_header_style',
            'raindrops_admin_header_image'
        );
        register_default_headers( array(
            'default' => array(
                'url' => $raindrops_site_image,
                'thumbnail_url' => $raindrops_site_thumbnail_image,
                /* translators: header image description */
                'description' => __( 'Raindrops', 'Raindrops')
            )
        ) );
    }
/**
 *
 *
 *
 *
 *
 */
    add_action('load-themes.php', 'raindrops_install_navigation');
/**
 *
 *
 *
 *
 *
 */
    add_editor_style();
/**
 *
 *
 *
 *
 *
 */
    register_nav_menus( array(
        'primary' => __( 'Primary Navigation', 'Raindrops' ),
    ) );
/**
 *
 *
 *
 *
 * thanks ison
 */
    add_filter( 'wp_page_menu_args', 'raindrops_page_menu_args' );
/**
 *
 *
 *
 *
 *
 */
if( $raindrops_wp_version >= '3.4' ){
    $args = array('default-color' => ''
                , 'default-image' => ''
                , 'wp-head-callback' => 'raindrops_embed_meta'
            );
    add_theme_support( 'custom-background', $args );
}elseif( ! function_exists( 'get_custom_header' ) ){
    add_custom_background();
}
/**
 *
 *
 *
 *
 *
 */
 $args = array( 'width' => apply_filters( 'raindrops_post_thumbnails_width', 'flex-width' ), 'height' => apply_filters( 'raindrops_post_thumbnails_height', 'flex-height' )

                );
    add_theme_support( 'post-thumbnails');
   /* set_post_thumbnail_size( 48, 48, true );*/
/**
 *
 *
 *
 *
 *
 */
    add_theme_support( 'automatic-feed-links' );

/**
 *
 *
 *
 *
 *
 */
if( $raindrops_wp_version < '3.4' ){

    add_filter("wp_head","raindrops_embed_meta",'90');
    }
/**
 *
 *
 *
 *
 *
 */
    add_filter( 'comment_form_default_fields','raindrops_comment_form');
/**
 *
 *
 *
 *
 *
 */
    add_filter( 'the_meta_key', 'raindrops_filter_explode_meta_keys', 10, 2 );
/**
 *
 *
 *
 *
 *
 */
    add_filter('body_class','raindrops_add_body_class');
/**
 *
 *
 *
 *
 *
 */
    add_filter('comment_form_field_comment','custom_remove_aria_required1');
/**
 *
 *
 *
 *
 *
 */
    add_filter('comment_form_default_fields', 'custom_remove_aria_required2');
/**
 *
 *
 *
 *
 *
 */
    add_filter( 'the_meta_key', 'raindrops_filter_explode_meta_keys', 10, 2 );
/**
 *
 *
 *
 *
 *
 */
    add_filter('the_title','raindrops_fallback_title');
/**
 *
 *
 *
 *
 *
 */
    add_filter('the_content','raindrops_ie_height_expand_issue');
/**
 *
 *
 *
 *
 *
 */
//    if ( !is_admin() ) {
    add_action('wp_print_styles', 'add_raindrops_stylesheet');
//    }
/**
 *
 *
 *
 *
 *
 */
    add_action( 'admin_init', 'raindrops_options_init' );
/**
 *
 *
 *
 *
 *
 */
    add_filter('wp_title','raindrops_filter_title',10,3);
/**
 *
 *
 *
 *
 * @since 0.956
 */
    add_action( 'wp_enqueue_scripts', 'raindrops_enqueue_comment_reply' );
/**
 *
 *
 *
 *
 * @since 0.956
 */

add_action('customize_controls_print_styles','raindrops_customize_controls_print_styles');

/**
 *
 *
 *
 *
 * @since 0.964 ?
 */
    add_filter('widget_text', 'do_shortcode');
/**
 *
 *
 *
 * @since 0.992
 */
    if( $raindrops_wp_version >= '3.4'){
        add_action( 'wp_head', 'raindrops_mobile_meta');
    }
}
?>