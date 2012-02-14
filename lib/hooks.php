<?php
/**
 * Filter and actions for Raindrops theme
 *
 *
 * @package Raindrops
 * @since Raindrops 0.948
 */
    add_filter( 'use_default_gallery_style', '__return_false' );
/**
 * Custom image header
 *
 *
 *
 *
 *
 */
    add_custom_image_header(
        'raindrops_header_style',
        'raindrops_admin_header_style',
        'raindrops_admin_header_image'
    );
    register_default_headers( array(
        'default' => array(
            'url' => get_stylesheet_directory_uri().'/images/headers/wp3.jpg',
            'thumbnail_url' => get_stylesheet_directory_uri().'/images/headers/wp3-thumbnail.jpg',
            /* translators: header image description */
            'description' => __( 'Raindrops', 'Raindrops')
        )
    ) );
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
 *
 */
    add_custom_background();
/**
 *
 *
 *
 *
 *
 */
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 48, 48, true );
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
    load_textdomain( 'Raindrops', get_template_directory().'/languages/'.get_locale().'.mo' );
/**
 *
 *
 *
 *
 *
 */
    add_filter("wp_head","raindrops_embed_meta",'99');
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
    add_filter('contextual_help','raindrops_help');
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
    if ( !is_admin()) {
       add_action('wp_print_styles', 'add_raindrops_stylesheet');
    }
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
     add_action('admin_menu', array($is_submenu, 'add_menus'));

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

?>