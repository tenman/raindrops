<?php
/**
 * functions and constants for Raindrops theme
 *
 *
 * @package Raindrops
 * @since Raindrops 0.1
 */
if ( !defined( 'ABSPATH' ) ) {
	exit;
}
do_action( 'raindrops_before' );

/**
 * move from hooks.php
 * and change from load_textdomain(   ) to load_theme_text_domain(   )
 *
 *
 * @since 0.988
 *
 * When child theme has languages/raindrops_[lang].mo
 * Raindrops Theme read this language file.
 * You can override parent themes language file from child theme.
 */
load_theme_textdomain( 'Raindrops', apply_filters( 'raindrops_load_text_domain', get_template_directory() . '/languages' ) );
/**
 * include raindrops custom settings
 *
 *
 *
 */
if ( file_exists( get_template_directory() . '/raindrops-config.php' ) ) {

	require_once( get_template_directory() . '/raindrops-config.php' );
}

if ( file_exists( get_stylesheet_directory() . '/lib/alias_functions.php' ) ) {
	
	require_once ( get_stylesheet_directory() . '/lib/alias_functions.php' );
} else {
	
	require_once ( get_template_directory() . '/lib/alias_functions.php' );
}
if ( false !== ( $path = raindrops_locate_url( 'lib/csscolor/csscolor.php', 'path' ) ) ) {
			require_once ( $path );
}

if ( false !== ( $path = raindrops_locate_url( 'lib/csscolor.css.php', 'path' ) ) ) {
			require_once ( $path );
}
if ( false !== ( $path = raindrops_locate_url( 'lib/vars.php', 'path' ) ) ) {
	
	require_once ( $path );
}
if ( false !== ( $path = raindrops_locate_url( 'lib/validate.php', 'path' ) ) ) {
	
	require_once ( $path );
}
if ( false !== ( $path = raindrops_locate_url( 'plugins/plugins-presentation.php', 'path' ) ) ) {

		require_once ( $path );	
}
if ( !class_exists( 'raindrops_menu_create' ) ) {

	if ( false !== ( $path = raindrops_locate_url( 'lib/option-panel.php', 'path' ) ) ) {
		require_once ( $path );
	}
}
if ( $raindrops_show_theme_option == true ) {

	$is_submenu = new raindrops_menu_create;
	add_action( 'admin_menu', array( $is_submenu, 'raindrops_add_menus' ) );
}

if ( false !== ( $path = raindrops_locate_url( 'lib/widgets.php', 'path' ) ) ) {
			require_once ( $path );
}
if ( get_locale() == 'ja' ) {
	
	if ( false !== ( $path = raindrops_locate_url( 'languages/scripts/ja.php', 'path' ) ) ) {
		
		require_once ( $path );
	}
}

$jetpack_active_modules = get_option( 'jetpack_active_modules' );

if ( class_exists( 'Jetpack', false ) && $jetpack_active_modules ) {
	
	if ( false !== ( $path = raindrops_locate_url( 'lib/jetpack.php', 'path' ) ) ) {
		
		require_once ( $path );
	}
}

/**
 * Featured Image Prezentation
 * @since 1.274
 */
if ( false !== ( $path = raindrops_locate_url( 'lib/featured-image.php', 'path' ) ) ) {
		
	require_once ( $path );
}


if ( is_admin() && $raindrops_recommend_plugins !== false ) {

	$raindrops_is_include_tgm_config = false;
	
	if ( false !== ( $path = raindrops_locate_url( 'plugins/tgm-config.php', 'path' ) ) ) {

		require_once ( $path );
		$raindrops_is_include_tgm_config = true;	
	}

	if ( true == $raindrops_is_include_tgm_config && file_exists( get_template_directory() . '/plugins/class-tgm-plugin-activation.php' ) ) {

		if ( !class_exists( 'WP_List_Table' ) ) {

			require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
		}
		require_once ( get_template_directory() . '/plugins/class-tgm-plugin-activation.php' );
	}
	add_action( 'tgmpa_register', 'raindrops_theme_register_required_plugins' );
}
		
if( true == $raindrops_new_customizer &&  isset( $wp_customize ) ) {

	if ( false !== ( $path = raindrops_locate_url( 'lib/customize.php', 'path' ) ) ) {

		require_once ( $path );
	}	
}
/**
 * Style sheet setting html head embed inline-style or external link
 * value external ( default ) or embed
 * 1.297 #doc5 external style suport.
 * @since 1.277
 */
if ( ! isset( $raindrops_stylesheet_type ) ) {

	$raindrops_stylesheet_type = raindrops_warehouse_clone( 'raindrops_stylesheet_in_html' );
}
/**
 *
 *
 *
 * @since 1.138
 */
do_action( 'raindrops_include_after' );
/**
 *
 * Add enable keyboard focus
 *
 * uses true no use false
 * @since 1.229
 */
if( raindrops_warehouse_clone( 'raindrops_disable_keyboard_focus' ) !== 'disable' && !isset( $raindrops_enable_keyboard )) {

	$raindrops_enable_keyboard = true;

} elseif ( ! isset( $raindrops_enable_keyboard ) ) {

	$raindrops_enable_keyboard = false;
}

/* when wp_nav_menu using fallback_cb keyboard accessibility desable why menu structure issue */
$raindrops_nav_menu_nothing_check = wp_get_nav_menus();

if( empty( $raindrops_nav_menu_nothing_check ) ) {

	$raindrops_enable_keyboard = false;
}
/**
 *
 */
add_action( 'wp_enqueue_scripts', 'raindrops_add_stylesheet' );
/**
 *
 */
register_nav_menus( array( 'primary' => esc_html__( 'Primary Navigation', 'Raindrops' ), ) );
/**
 * Custom image header
 * $raindrops_custom_header_args
 */
add_filter('raindrops_header_image_width','raindrops_responsive_width_ajust');

if ( ! function_exists( 'raindrops_responsive_width_ajust') ) {

	function raindrops_responsive_width_ajust( $width ) {
		$page_type_check = raindrops_warehouse_clone( 'raindrops_page_width' );

		if( $page_type_check == 'doc3' ) {

			$width = absint( raindrops_detect_header_image_size_clone(  'width' ) );
			$max_width = raindrops_warehouse_clone( 'raindrops_fluid_max_width' );

			if ( $width <  $max_width  ) {

				return $width;
			}

			return raindrops_warehouse_clone( 'raindrops_fluid_max_width' );
		}
		return $width;
	}
}

add_filter('raindrops_header_image_height', 'raindrops_responsive_height_ajust');

if ( ! function_exists( 'raindrops_responsive_height_ajust') ) {

	function raindrops_responsive_height_ajust( $height ) {

		$page_type_check = raindrops_warehouse_clone( 'raindrops_page_width' );

		if( $page_type_check == 'doc3' ) {
			$max_width = raindrops_warehouse_clone( 'raindrops_fluid_max_width' );
			$width = absint( raindrops_detect_header_image_size_clone(  'width' ) );

			if( $width < $max_width ) {
				$orrection_amount = $width / $max_width;

				return round( $height * $orrection_amount );
			}
			if( $width > $max_width ) {
				$orrection_amount = $max_width / $width;

				return round( $height * $orrection_amount );
			}
			return $height;

		}
		return $height;
	}
}


if ( !isset( $raindrops_custom_header_args ) ) {

	$raindrops_custom_header_width  = apply_filters( 'raindrops_header_image_width', absint( raindrops_detect_header_image_size_clone(  'width' ) )	);
	$raindrops_custom_header_height = apply_filters( 'raindrops_header_image_height', absint( raindrops_detect_header_image_size_clone( 'height' ) ) );
	
	$raindrops_current_style_type   = raindrops_warehouse_clone( 'raindrops_style_type' );
	
	$raindrops_custom_header_args = array( 'default-text-color'	 => raindrops_default_colors_clone( $raindrops_current_style_type,  "default-text-color", true ) ,
		'width'					 => $raindrops_custom_header_width,
		'flex-width'			 => true,
		'height'				 => $raindrops_custom_header_height ,
		'flex-height'			 => true,
		'header-text'			 => true,
		'default-image'			 => '%1$s/images/headers/wp3.jpg',
		'wp-head-callback'		 => apply_filters( 'raindrops_wp-head-callback', 'raindrops_embed_meta' ),
		);

	if ( version_compare( $wp_version, '4.1', '<' ) ) {

		$raindrops_custom_header_args['admin-preview-callback'] = 'raindrops_admin_header_image';
		$raindrops_custom_header_args['admin-head-callback'] = 'raindrops_admin_header_style';
	}

	add_theme_support( 'custom-header', apply_filters( 'raindrops_custom_header_args', $raindrops_custom_header_args ) );

	/**
	 * Add for WordPress 4.1
	 * @since 1.260
	 */
	register_default_headers( array(
		'raindrops' => array(
			'url' => '%s/images/headers/wp3.jpg',
			'thumbnail_url' => '%s/images/headers/wp3-thumbnail.jpg',
		),
	) );
}

/**
 * It has hooks.
 *
 *
 *
 *
 */
if ( false !== ( $path = raindrops_locate_url( 'lib/hooks.php', 'path' ) ) ) {
	require_once ( $path );
}
/**
 * Accessibility Settings
 *
 *  When true
 *  Add to hidden text for identify  entry-title link text, comment link text, more link
 *
 * @since 1.116
 */
function raindrops_extend_query( $vars ) {

	$vars[] = 'raindrops_color_type';
	$vars[] = 'raindrops_pid';
	return $vars;
}

if ( !isset( $raindrops_link_unique_text ) ) {

	if ( 'yes' == raindrops_warehouse_clone( 'raindrops_accessibility_settings' ) ) {

		$raindrops_link_unique_text = true;
	} else {

		$raindrops_link_unique_text = false;
	}
}



if ( 'yes' == raindrops_warehouse_clone( 'raindrops_accessibility_settings' ) ) {

	$raindrops_accessibility_link = false;
}
if ( ! function_exists( 'raindrops_current_url' ) ) {
	function raindrops_current_url() {

		$url = 'http';
		if ( isset( $_SERVER[ "HTTPS" ] ) && $_SERVER[ "HTTPS" ] == "on" ) {
			$url .= "s";
		}
		$url .= "://";
		if ( isset( $_SERVER[ "SERVER_PORT" ] ) && $_SERVER[ "SERVER_PORT" ] != "80" ) {
			$url .= $_SERVER[ "SERVER_NAME" ] . ":" . $_SERVER[ "SERVER_PORT" ] . $_SERVER[ "REQUEST_URI" ];
		} else {
			$url .= $_SERVER[ "SERVER_NAME" ] . $_SERVER[ "REQUEST_URI" ];
		}
		$url = esc_url( $url );

		return apply_filters( 'raindrops_current_url', $url );
	}
}
/**
 * home link
 *
 * ver 1.116 default value change
 * if you need home link then $raindrops_nav_menu_home_link set true.
 */
if ( !isset( $raindrops_nav_menu_home_link ) ) {

	if ( true == $raindrops_link_unique_text ) {

		$raindrops_nav_menu_home_link = false;
	} else {

		$raindrops_nav_menu_home_link = true;
	}
}

/**
 * HTML document type
 *
 *
 *
 * Now only 'xhtml'
 * ver 0.999 add type 'html5'
 */
if ( !isset( $raindrops_document_type ) ) {

	if ( 'xhtml' == raindrops_warehouse_clone( 'raindrops_doc_type_settings' ) ) {

		$raindrops_document_type = 'xhtml';

	} else {

		$raindrops_document_type = 'html5';
		// html5
		add_theme_support( 'html5', array( 'gallery', 'caption' ) );

	}
}
if( ! function_exists( 'raindrops_gallery_atts' ) ) {
/**
 *
 * @global type $raindrops_extend_galleries
 * @param type $out
 * @param type $pairs
 * @param type $atts
 * @return gallery default attribute value
 * @since 1.269
 */
	function raindrops_gallery_atts( $out, $pairs, $atts ) {
		global $raindrops_extend_galleries;

		if ( $raindrops_extend_galleries !== true ){
			return  $out;
		}

		if (  empty( $atts["columns"] ) || $atts["columns"] < 4 ) {

			$atts = shortcode_atts( array(
			'size' => 'medium',
			), $atts );

			$out['size'] = $atts['size'];
		}
		return $out;
	}
}
add_filter( 'shortcode_atts_gallery', 'raindrops_gallery_atts', 10, 3 );
/**
 * Force Document type for lt IE9 Old Browser
 * Note: This setting is SERVER_SIDE Setting, I recommend that the browser is set when the cache of less than IE9 as not performed
 *
 * Raindrops 1.204 remove from header.php
 * 		<!--[if IE]>
 * 		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
 * 		<![endif]-->
 *
 *
 * ver 1.204
 */
if ( $is_IE ) {

	preg_match( "|(MSIE )([0-9]{1,2})(\.)|si", $_SERVER[ 'HTTP_USER_AGENT' ], $raindrops_regs );

	if ( isset( $raindrops_regs[ 2 ] ) && $raindrops_regs[ 2 ] < 9 ) {

		$raindrops_document_type = 'xhtml';
		remove_theme_support( 'html5' );
	}
}

/**
 *
 *
 * $raindrops_post_formats_args
 * add ver0.991 gallery,status
 */
if ( !isset( $raindrops_post_formats_args ) ) {

	$raindrops_post_formats_args = apply_filters( 'raindrops_post_formats_args', array( 'aside', 'gallery', 'chat', 'link', 'image', 'status', 'quote', 'video' ) );
	add_theme_support( 'post-formats', $raindrops_post_formats_args );
}
/**
 *
 *
 *
 * $raindrops_custom_background_args
 *
 */
if ( !isset( $raindrops_custom_background_args ) ) {

	$raindrops_custom_background_args = apply_filters( 'raindrops_custom_background_args', array(
		'default-color'		 => '',
		'default-image'		 => '',
		 ) );
	add_theme_support( 'custom-background',  $raindrops_custom_background_args );
}
/**
 *
 *
 *
 * $raindrops_post_thumbnails_args
 *
 */
if ( !isset( $raindrops_post_thumbnails_args ) ) {

	$raindrops_post_thumbnails_args = array( 'post', 'page' );
	add_theme_support( 'post-thumbnails', apply_filters( 'raindrops_post_thumbnails_args', $raindrops_post_thumbnails_args ) );
}
/**
 *
 *
 *
 *
 *
 */
add_theme_support( 'automatic-feed-links' );
/**
 * Your extend function , settings write below.
 *
 *
 *
 *
 */

/**
 * Content width implementation by manual labor
 *
 * If you need specific $content_width.
 * value set 400 When not setting or empty.
 *
 */
//$content_width = '';



/**
 * $raindrops_fluid_minimum_width for IE
 *
 * IE browser not support responsive
 *
 * $raindrops_fluid_minimum_width
 *
 */
if ( $is_IE ) {

	preg_match( "|(MSIE )([0-9]{1,2})(\.)|si", $_SERVER[ 'HTTP_USER_AGENT' ], $regs );

	if ( isset( $regs[ 2 ] ) && $regs[ 2 ] < 9 ) {

		$raindrops_fluid_minimum_width = apply_filters( 'raindrops_fluid_minimum_width_lt_ie9', '640');
	}
}
/**
 * fluid page  main column maximum width px
 *
 *
 *
 * $raindrops_fluid_maximum_width
 *
 */

if ( !isset( $raindrops_fluid_maximum_width ) ) {

	$raindrops_fluid_maximum_width = raindrops_warehouse_clone( 'raindrops_fluid_max_width' );
}

/**
 *
 *
 *
 * @since 1.127
 */
if ( !function_exists( 'raindrops_detect_display_none_condition' ) ) {

	function raindrops_detect_display_none_condition() {

		global $raindrops_where_display_none;

		if ( !isset( $raindrops_where_display_none ) ) {

			$raindrops_display_none_pages = array();

			if ( raindrops_warehouse_clone( 'raindrops_entry_content_is_home' ) == 'none' ) {

				$raindrops_display_none_pages[] = 'is_home';
			}
			if ( raindrops_warehouse_clone( 'raindrops_entry_content_is_category' ) == 'none' ) {

				$raindrops_display_none_pages[] = 'is_category';
			}

			if ( raindrops_warehouse_clone( 'raindrops_entry_content_is_search' ) == 'none' ) {

				$raindrops_display_none_pages[] = 'is_search';
			}

			$raindrops_where_display_none = $raindrops_display_none_pages;
		}


		if ( !empty( $raindrops_where_display_none ) && is_array( $raindrops_where_display_none ) ) {

			foreach ( $raindrops_where_display_none as $excerpt ) {

				if ( true == $excerpt() ) {

					return true;
				}
			}
		}
		return false;
	}
}


if ( !function_exists( 'raindrops_detect_excerpt_condition' ) ) {

	function raindrops_detect_excerpt_condition() {

		global $raindrops_where_excerpts, $post;

		if ( !isset( $raindrops_where_excerpts ) ) {

			$raindrops_excerpt_pages = array();

			if ( raindrops_warehouse_clone( 'raindrops_entry_content_is_home' ) == 'excerpt' ) {

				$raindrops_excerpt_pages[] = 'is_home';
			}
			if ( raindrops_warehouse_clone( 'raindrops_entry_content_is_category' ) == 'excerpt' ) {

				$raindrops_excerpt_pages[] = 'is_category';
			}

			if ( raindrops_warehouse_clone( 'raindrops_entry_content_is_search' ) == 'excerpt' ) {

				$raindrops_excerpt_pages[] = 'is_search';
			}

			$raindrops_where_excerpts = $raindrops_excerpt_pages;
		}

		if ( RAINDROPS_USE_LIST_EXCERPT !== true ) {

			return false;
		}

		if ( !empty( $raindrops_where_excerpts ) ) {

			foreach ( $raindrops_where_excerpts as $excerpt ) {

				if ( true == $excerpt() ) {

					return true;
				}
			}
		}
		return false;
	}
}


if ( !defined( 'RAINDROPS_TABLE_TITLE' ) ) {

	define( "RAINDROPS_TABLE_TITLE", 'options' );
}

if ( !defined( 'RAINDROPS_PLUGIN_TABLE' ) ) {

	define( 'RAINDROPS_PLUGIN_TABLE', $wpdb->prefix . RAINDROPS_TABLE_TITLE );
}

if ( !isset( $raindrops_theme_settings ) ) {

	$raindrops_theme_settings = get_option( 'raindrops_theme_settings', 'no' );
}

/**
 * widget settings
 *
 * Registered Default Sidebar, Extra Sidebar, Sticky Widget, Footer Widget, Category Blog Widget
 *
 * @since 1.119 Widget label change from Category Blog Widget to Status Sidebar
 *
 */
if ( !function_exists( 'raindrops_widgets_init' ) ) {

	function raindrops_widgets_init() {

		register_sidebar( array(
			'name'			 => esc_html__( 'Default Sidebar', 'Raindrops' ),
			'id'			 => 'sidebar-1',
			'before_widget'	 => '<li id="%1$s" class="%2$s widget default" '. raindrops_doctype_elements( '', 'tabindex="-1"', false ) . '>',
			'after_widget'	 => '</li>',
			'before_title'	 => '<h2 class="widgettitle default h2"><span>',
			'after_title'	 => '</span></h2>',
			'widget_id'		 => 'default',
			'widget_name'	 => 'default',
			'text'			 => "1" ) );

		register_sidebar( array(
			'name'			 => esc_html__( 'Extra Sidebar', 'Raindrops' ),
			'id'			 => 'sidebar-2',
			'before_widget'	 => '<li id="%1$s" class="%2$s widget extra" '. raindrops_doctype_elements( '', 'tabindex="-1"', false ) . '>',
			'after_widget'	 => '</li>',
			'before_title'	 => '<h2 class="widgettitle extra h2"><span>',
			'after_title'	 => '</span></h2>',
			'widget_id'		 => 'extra',
			'widget_name'	 => 'extra',
			'text'			 => "2" ) );
		register_sidebar( array(
			'name'			 => esc_html__( 'Sticky Widget', 'Raindrops' ),
			'id'			 => 'sidebar-3',
			'before_widget'	 => '<li id="%1$s" class="%2$s widget sticky-widget" '. raindrops_doctype_elements( '', 'tabindex="-1"', false ) . '>',
			'after_widget'	 => '</li>',
			'before_title'	 => '<h2 class="widgettitle home-top-content h2"><span>',
			'after_title'	 => '</span></h2>',
			'widget_id'		 => 'toppage2',
			'widget_name'	 => 'toppage2',
			'text'			 => "3" ) );
		register_sidebar( array(
			'name'			 => esc_html__( 'Footer Widget', 'Raindrops' ),
			'id'			 => 'sidebar-4',
			'before_widget'	 => '<li id="%1$s" class="%2$s widget footer-widget" '. raindrops_doctype_elements( '', 'tabindex="-1"', false ) . '>',
			'after_widget'	 => '</li>',
			'before_title'	 => '<h2 class="widgettitle footer-widget h2"><span>',
			'after_title'	 => '</span></h2>',
			'widget_id'		 => 'footer',
			'widget_name'	 => 'footer',
			'text'			 => "4" ) );
		register_sidebar( array(
			'name'			 => esc_html__( 'Post Format Status Sidebar', 'Raindrops' ),
			'id'			 => 'sidebar-5',
			'before_widget'	 => '<li  id="%1$s" class="%2$s widget category-blog-widget status-side-bar" '. raindrops_doctype_elements( '', 'tabindex="-1"', false ) . '>',
			'after_widget'	 => '</li>',
			'before_title'	 => '<h2 class="widgettitle category-blog-widget h2 status-side-bar">',
			'after_title'	 => '</h2>',
			'widget_id'		 => 'categoryblog',
			'widget_name'	 => 'categoryblog',
			'text'			 => "5" ) );
	}
}
/**
 *
 *
 *
 *
 *
 */
/**
 * 1.297 remove

if ( !isset( $raindrops_base_setting ) ) {

	$raindrops_base_setting = $raindrops_base_setting_args;
}
 **/
/**
 *
 *
 *
 *
 * @since 1.238
 */
if ( isset( $raindrops_base_font_size ) ) {

	raindrops_update_theme_option( 'raindrops_basefont_settings', $raindrops_base_font_size );
}
/**
 * @since 1.278
 */


if ( raindrops_warehouse_clone( 'raindrops_show_right_sidebar' ) == 'hide' ) {

	$rsidebar_show = false;
} else {

	$rsidebar_show = true;
}

if ( !isset( $raindrops_current_style_type ) ) {

	$raindrops_current_style_type = raindrops_warehouse_clone( "raindrops_style_type" );
}
/**
 * Content width setup
 *
 *
 *
 *
 *
 */
if ( !isset( $content_width ) || empty( $content_width ) ) {

	$content_width = raindrops_content_width_clone();
}

add_action( 'widgets_init', 'raindrops_widgets_init' );
/**
 * Add option helper
 *
 *
 *
 *
 *
 */
foreach ( $raindrops_base_setting as $setting ) {

	$function_name = $setting[ 'option_name' ] . '_validate';

	if ( !function_exists( $function_name ) ) {

		$message = sprintf( esc_html__( 'If you add  %s when you must create function %s for data validation', 'Raindrops' ), $setting[ 'option_name' ], $function_name );
		printf( '<script type="text/javascript">alert( \'%s\'  );</script>', $message );
		return;
	}
}
/**
 * Extend body_class(   )
 *
 *
 * add browser class, languages class,
 *
 *
 */

if ( !function_exists( 'raindrops_add_body_class' ) ) {

	function raindrops_add_body_class( $classes ) {

		global $post, $current_blog, $raindrops_link_unique_text, $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone, $raindrops_browser_detection, $raindrops_status_bar, $raindrops_enable_keyboard, $raindrops_current_column;
		$classes[] = get_locale();
		
		if ( isset( $raindrops_status_bar ) || empty( $raindrops_status_bar ) ) {
			$raindrops_status_bar = raindrops_warehouse_clone( 'raindrops_status_bar' );
		}

		if ( $raindrops_enable_keyboard == true && true !== $raindrops_link_unique_text ) {

			$classes[] = 'enable-keyboard';
		}
		/**
		 * @since 1.289
		 */
		$classes[] = esc_attr( "rd-pw-" . raindrops_warehouse( 'raindrops_page_width' ) );
		
		if( isset( $raindrops_current_column ) && !empty( $raindrops_current_column ) ) {
			$classes[] = 'rd-col-'. $raindrops_current_column;
		}

		if ( is_single() || is_page() ) {

			$raindrops_options = get_option( "raindrops_theme_settings" );

			if ( isset( $raindrops_options[ "raindrops_style_type" ] ) && !empty( $raindrops_options[ "raindrops_style_type" ] ) ) {

				$color_type = "rd-type-" . $raindrops_options[ "raindrops_style_type" ];

			}

			$raindrops_content_check = get_post( $post->ID );
			$raindrops_content_check = $raindrops_content_check->post_content;

			if ( preg_match( "!\[raindrops[^\]]+(color_type)=(\"|')*?([^\"' ]+)(\"|' )*?[^\]]*\]!si", $raindrops_content_check, $regs ) ) {

				$color_type = "rd-type-" . trim( $regs[ 3 ] );

			}
			if ( preg_match( "!\[raindrops[^\]]+(col)=(\"|')*?([^\"' ]+)(\"|')*?[^\]]*\]!si", $raindrops_content_check, $regs ) ) {

				$color_type .= ' ';
				/** escaped 1.290 see line:794
				 * $color_type .= "rd-col-" . $regs[ 3 ];
				 */
			}
			if ( !isset( $color_type ) ) { // When not using database
				$color_type = "rd-type-" . raindrops_warehouse( 'raindrops_style_type' );
			}
			$classes[] = $color_type;
		} else {

			$raindrops_options = get_option( "raindrops_theme_settings" );

			if ( isset( $raindrops_options[ "raindrops_style_type" ] ) && !empty( $raindrops_options[ "raindrops_style_type" ] ) ) {

				$classes[] = "rd-type-" . $raindrops_options[ "raindrops_style_type" ];
			} else {

				$classes[] = "rd-type-" . raindrops_warehouse( 'raindrops_style_type' );
			}
		}

		if ( true == $raindrops_browser_detection ) {

			if ( isset( $_SERVER[ "HTTP_ACCEPT_LANGUAGE" ] ) ) {

				$browser_lang	 = $_SERVER[ "HTTP_ACCEPT_LANGUAGE" ];
				$browser_lang	 = explode( ",", $browser_lang );
				$browser_lang	 = esc_html( $browser_lang[ 0 ] );
				$browser_lang	 = 'accept-lang-' . $browser_lang;
				$classes[]		 = $browser_lang;
			}
			switch ( true ) {
				case ( $is_lynx ):
					$classes[] = 'lynx';
					break;

				case ( $is_gecko ):

					if ( preg_match( '!Trident/.*rv:([0-9]{1,}\.[\.0-9]{0,})!', $_SERVER[ 'HTTP_USER_AGENT' ], $regs ) ) {

						$classes[] = 'ie' . (int) $regs[ 1 ];
					} else {

						$classes[] = 'gecko';
					}
					break;

				case ( $is_IE ):
					preg_match( "|(MSIE )([0-9]{1,2})(\.)|si", $_SERVER[ 'HTTP_USER_AGENT' ], $regs );
					if ( isset( $regs[ 2 ] ) ) {
						$classes[] = 'ie' . $regs[ 2 ];
					}
					break;

				case ( $is_opera ):
					$classes[] = 'opera';
					break;

				case ( $is_NS4 ):
					$classes[] = 'ns4';
					break;

				case ( $is_safari ):
					$classes[] = 'safari';
					break;

				case ( $is_chrome ):
					$classes[] = 'chrome';
					break;

				case ( $is_iphone ):
					$classes[] = 'iphone';
					break;

				default:

					$classes[] = 'unknown2';
					break;
			}
		}


		if ( isset( $current_blog ) ) {

			$classes[] = "b" . absint( $current_blog->blog_id );
		}

		if ( true == $raindrops_link_unique_text ) {

			$classes[] = 'raindrops-accessible-mode';
		}

		if ( $raindrops_status_bar == true ) {

			$classes[] = 'raindrops-status-bar-active';
		}
		return apply_filters( "raindrops_add_body_class", $classes );
	}
}
/**
 * wp_list_comments callback function
 *
 *
 *
 * comments.php
 *
 */
if ( !function_exists( 'raindrops_comment' ) ) {

	function raindrops_comment( $comment, $args, $depth ) {

		$GLOBALS[ 'comment' ] = $comment;

		if ( '' == $comment->comment_type ) {
			?>
			<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
				<div id="comment-<?php comment_ID(); ?>">
					<div class="comment-author vcard">
						<div class="raindrops-comment-avatar">
							<?php echo get_avatar( $comment, 32, '', esc_attr__( 'Avatar', 'Raindrops' ) . ' ' . esc_attr( strip_tags( get_comment_author_link() ) ) ); ?> </div>
						<div class="raindrops-comment-author-meta">
							<?php
							printf( '%1$s <span class="says">%2$s</span>', sprintf( '<cite class="fn">%s</cite> ', get_comment_author_link() ), esc_html__( 'says:', 'Raindrops' ) );
							?>
						</div>
						<div class="comment-meta commentmetadata clearfix">
							<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf( esc_html__( '%1$s at %2$s', 'Raindrops' ), get_comment_date(), get_comment_time() ); ?></a>
							<?php
							edit_comment_link( esc_html__( ' Edit ', 'Raindrops' ) . raindrops_link_unique( 'Comment', $comment->comment_ID ), ' ' );
							?>
						</div>
					</div>
					<!-- .comment-author .vcard -->
					<?php
					if ( '0' == $comment->comment_approved ) {
						?>
						<div class="clearfix awaiting"> <em><?php esc_html_e( 'Your comment is awaiting moderation.', 'Raindrops' ); ?></em>
							<br />
						</div>
						<?php
					} //endif
					?>
					<!-- .comment-meta .commentmetadata -->
					<div class="comment-body">
						<?php
						comment_text();
						?>
					</div>
					<div class="reply">
						<?php
						$raindrops_comment_reply_text = esc_html__( 'Reply', 'Raindrops' ) . raindrops_link_unique( 'Comment', $comment->comment_ID );
						comment_reply_link( array_merge( $args, array( 'reply_text' => $raindrops_comment_reply_text, 'depth' => $depth, 'max_depth' => $args[ 'max_depth' ] ) ) );
						?>
					</div>
					<!-- .reply -->
				</div>
				<!-- #comment-##  -->
		<?php
		} else {
		?>
			<li class="post pingback">
				<p>
					<?php
					esc_html_e( 'Pingback:', 'Raindrops' );
					comment_author_link();
					echo ' ';
					edit_comment_link( esc_html__( ' Edit ', 'Raindrops' ) . raindrops_link_unique( 'Comment', $comment->comment_ID ), ' ' );
					?>
				</p>
				<?php
		} //endif
	}
}
/**
 * Template function posted in
 *
 *
 *
 * loop.php
 *
 */

if ( !function_exists( 'raindrops_posted_in' ) ) {

	function raindrops_posted_in( ) {

		$exclude_category_conditionals = apply_filters( 'raindrops_posted_in_category',array( 'is_category'=> 'raindrops_post_category_relation' ) );
		$exclude_tag_conditional       = apply_filters( 'raindrops_posted_in_tag',array( 'is_tag' => '' ) );

		global $post;

		if ( is_sticky() ) {

			return;
		}
		$format		     = get_post_format( $post->ID );
		$tag_list		 = get_the_tag_list( '', ' ' );
		$categories_list = get_the_category_list( ' ' );

		if ( ! empty($exclude_category_conditionals) && is_array( $exclude_category_conditionals ) ) {

			foreach( $exclude_category_conditionals as  $key => $conditional ) {

				if( function_exists( $key ) && true == $key() ) {

					if ( empty( $conditional ) ) {

						$categories_list = '';
					} elseif ( function_exists( $conditional ) ) {

						$categories_list = $conditional();
					}
				}
			}
		}

		if ( ! empty($exclude_tag_conditionals) && is_array( $exclude_tag_conditionals ) ) {

			foreach( $exclude_tag_conditionals as  $key => $conditional ) {

				if( function_exists( $key ) && true == $key() ) {

					if ( empty( $conditional ) ) {

						$tag_list = '';
					} elseif ( function_exists( $conditional ) ) {

						$tag_list = $conditional();
					}
				}
			}
		}

		if ( false === $format ) {

			if ( $tag_list ) {

				$posted_in = '<span class="this-posted-in">' .
								esc_html__( 'This entry was posted in', 'Raindrops' ) .
							'</span> %1$s <span class="tagged">' .
								esc_html__( 'and tagged', 'Raindrops' ) .
							'</span> %2$s';
			} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {

				$posted_in = '<span class="this-posted-in">' . esc_html__( 'This entry was posted in', 'Raindrops' ) . '</span> %1$s ';
			} else {

				$posted_in = '';
			}
			$result = $format . sprintf( $posted_in, $categories_list, $tag_list );
			echo apply_filters( "raindrops_posted_in", $result );
		} else {

			if ( $tag_list ) {

				$posted_in = '<span class="this-posted-in">' . esc_html__( 'This entry was posted in', 'Raindrops' ) . '</span> %1$s <span class="tagged">' . esc_html__( 'and tagged', 'Raindrops' ) . '</span> %2$s ' . '  <span class="post-format-text">%4$s</span> <a href="%3$s"> <span class="post-format">%5$s</span></a>';
			} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {

				$posted_in = '<span class="this-posted-in">' . esc_html__( 'This entry was posted in', 'Raindrops' ) . '</span> %1$s %2$s' . '  <span class="post-format-text">%4$s</span><a href="%3$s"> <span class="post-format">%5$s</span></a>';
			} else {

				$posted_in = '<a href="%3$s">   <span class="post-format-text">%4$s</span> <span class="post-format">%5$s</span></a>';
			}
			$result = sprintf( $posted_in, get_the_category_list( ' ' ), $tag_list, esc_url( get_post_format_link( $format ) ), esc_html( 'Format', 'Raindrops' ), get_post_format_string( $format ) );
			echo apply_filters( "raindrops_posted_in", $result );
		}

	}
}
/**
 * Template function raindrops_comments_link
 *
 *
 *
 * loop.php
 * @since 1.163
 */
if ( !function_exists( 'raindrops_comments_link' ) ) {

	function raindrops_comments_link() {

		if ( comments_open() ) {

			$raindrops_comment_html = '<a href="%1$s" class="raindrops-comment-link"><span class="raindrops-comment-string point"></span><em>%2$s %3$s</em></a>';

			if ( get_comments_number() > 0 ) {

				$raindrops_comment_string	 = _n( 'Comment', 'Comments', get_comments_number(), 'Raindrops' ) . raindrops_link_unique( 'Post', get_the_ID() );
				$raindrops_comment_number	 = get_comments_number();
			} else {

				$raindrops_comment_string	 = __( 'Comment ', 'Raindrops' ) . raindrops_link_unique( 'Post', get_the_ID() );
				$raindrops_comment_number	 = '';
			}
		} else {

			$raindrops_comment_html		 = '';
			$raindrops_comment_string	 = '';
			$raindrops_comment_number	 = '';
		}

		$result = sprintf( $raindrops_comment_html, get_comments_link(), $raindrops_comment_number, $raindrops_comment_string );

		return apply_filters( 'raindrops_comments_link', $result, get_comments_link(), $raindrops_comment_number, $raindrops_comment_string );
	}
}

if ( !function_exists( 'raindrops_post_author' ) ) {
/**
 * loop
 * @global type $post
 * @return type
 * @since 1.272
 */

	function raindrops_post_author( ) {
		global $post;

		$author						= raindrops_blank_fallback( get_the_author(), 'Somebody' );
		$author_attr_title_string	 = sprintf( esc_attr__( 'View all posts by %s', 'Raindrops' ), wp_kses( $author, array() ) );
		$author_html				 = '<span class="author vcard"><a class="url fn nickname" href="%1$s" title="%2$s" rel="vcard:url">%3$s</a></span> ';
		$author_html				 = sprintf(	$author_html, get_author_posts_url( get_the_author_meta( 'ID' ) ), $author_attr_title_string, $author );
		$author_html				 = apply_filters( 'raindrops_post_author', $author_html );

		return $author_html;
	}
}
if ( !function_exists( 'raindrops_post_date' ) ) {
/**
 * loop
 * @global type $post
 * @return type
 * @since1.272
 */
	function raindrops_post_date(){

		global $post;

		$entry_date_html = '<a href="%1$s" title="%2$s"><%4$s class="entry-date updated" %5$s>%3$s</%4$s></a>';

		$archive_year			 = get_the_time( 'Y' );
		$archive_month			 = get_the_time( 'm' );
		$archive_day			 = get_the_time( 'd' );
		$day_link				 = esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) . '#post-' . $post->ID );
		$raindrops_date_format	 = get_option( 'date_format' ) . ' ' . get_option( 'time_format' );

		$entry_date_html = sprintf(	$entry_date_html,
									$day_link,
									esc_attr( 'archives daily ' . get_the_date( $raindrops_date_format ) ),
									get_the_date( $raindrops_date_format ),
									raindrops_doctype_elements( 'span', 'time', false ),
									raindrops_doctype_elements( '', 'datetime="' . esc_attr( get_the_date( 'c' ) ) . '"', false )
		);
		$entry_date_html = apply_filters( 'raindrops_post_date', $entry_date_html );

		return $entry_date_html;

	}
}
/**
 * Template function posted_on
 *
 *
 *
 * loop.php
 *
 */
if ( !function_exists( 'raindrops_posted_on' ) ) {

	function raindrops_posted_on() {

		global $post;
		$called_function		 = __FUNCTION__;

		$author_html			 = apply_filters( 'raindrops_post_author', raindrops_post_author( ), $called_function );
		$entry_date_html		 = apply_filters( 'raindrops_post_date', raindrops_post_date( ), $called_function );
		$posted_on_comment_link  = apply_filters( 'raindrops_comments_link', raindrops_comments_link(), $called_function );

		$result = '<span class="meta-prep meta-prep-author">
					<span class="posted-on-string">%1$s</span></span> %2$s
					<span class="meta-sep"><span class="posted-by-string">%3$s</span></span> %4$s %5$s';
		$result = apply_filters('raindrops_posted_on_result', $result );
		$posted_on_string = '';
		if( !empty( $entry_date_html ) ) {
			$posted_on_string = __( 'Posted on', 'Raindrops' );
		}
		$posted_by_string = '';
		if( !empty( $entry_date_html ) ) {
			$posted_by_string =  __( 'by', 'Raindrops' );
		}
		$result = sprintf( $result, $posted_on_string , $entry_date_html, $posted_by_string, $author_html, $posted_on_comment_link );

		$format				 = get_post_format();
		$content_empty_check = '';

		if ( isset( $post ) ) {
			$content_empty_check = trim( get_the_content() );
		}

		if ( false === $format ) {

			echo apply_filters( "raindrops_posted_on", $result );
		} elseif ( empty( $content_empty_check ) ) {

			echo $posted_on_comment_link;
		} else {

			echo apply_filters( "raindrops_posted_on", $result );
		}
	}
}
/**
* Special custom fields key css, javascript, metatags
*
*
* css,javascrip,meta is separated anothor Custom Field.
*
*
*/
if ( !function_exists( 'raindrops_filter_explode_meta_keys' ) ) {

	function raindrops_filter_explode_meta_keys( $content, $key ) {

		$explode_keys = array( 'css', 'javascript', 'meta' );

		if ( in_array( $key, $explode_keys ) ) {

			return;
		} else {

			return $content;
		}
	}
}
/**
 * Like a get_option(   )
 *
 *
 * Raindrops conditional response.
 *
 * for templates
 */
if ( !function_exists( 'raindrops_warehouse' ) ) {

	function raindrops_warehouse( $name , $fallback = false) {

		return apply_filters( "raindrops_warehouse", raindrops_warehouse_clone( $name, $fallback ) );
	}
}
/**
 * Return $raindrops_base_setting value.
 *
 *
 *
 *
 *
 */
if ( !function_exists( 'raindrops_admin_meta' ) ) {

	function raindrops_admin_meta( $name, $meta_name ) {

		global $raindrops_base_setting;
		global $raindrops_page_width;
		$vertical = array();

		foreach ( $raindrops_base_setting as $key => $val ) {

			if ( !is_null( $raindrops_base_setting ) ) {

				$vertical[] = $val[ 'option_name' ];
			}
		}

		$row = array_search( $name, $vertical );
		return $raindrops_base_setting[ $row ][ $meta_name ];
	}

}
/**
 * Admin Panel help
 *
 *
 *
 *
 *
 */
if ( !function_exists( 'raindrops_settings_page_contextual_help' ) ) {

	function raindrops_settings_page_contextual_help() {

		global $raindrops_current_data;
		$html	 = '<dt>%1$s</dt><dd>%2$s</dd>';
		$link	 = '<a href="%1$s" %3$s>%2$s</a>';
		$content = '';
		/* theme URI */
		$content .= sprintf( $html, esc_html__( 'Theme URI', 'Raindrops' ), sprintf( $link, $raindrops_current_data->get( 'ThemeURI' ), $raindrops_current_data->get( 'ThemeURI' ), 'target="_self"' ) );
		/* AuthorURI */
		$content .= sprintf( $html, esc_html__( 'Author', 'Raindrops' ), sprintf( $link, $raindrops_current_data->get( 'AuthorURI' ), $raindrops_current_data->get( 'Author' ), 'target="_self"' ) );
		/* Support */
		$content .= sprintf( $html, esc_html__( 'Support', 'Raindrops' ), sprintf( $link, 'http://wordpress.org/support/theme/raindrops', esc_html__( 'http://wordpress.org/support/theme/raindrops', 'Raindrops' ), 'target="_blank"' ) . '<br />' . sprintf( $link, 'http://ja.forums.wordpress.org/', esc_html__( 'http://ja.forums.wordpress.org/ lang:Japanese', 'Raindrops' ), 'target="_blank"' ) );
		/* Version */
		$content .= sprintf( $html, esc_html__( 'Version', 'Raindrops' ), $raindrops_current_data->get( 'Version' ) );
		/* Changelog.txt */
		$content .= sprintf( $html, esc_html__( 'Change log text', 'Raindrops' ), sprintf( $link, get_template_directory_uri() . '/changelog.txt', esc_html__( 'Changelog , display new window', 'Raindrops' ), 'target="_blank"' ), 'target = "_blank"' );
		/* readme.txt */
		$content .= sprintf( $html, esc_html__( 'Readme text', 'Raindrops' ), sprintf( $link, get_template_directory_uri() . '/README.txt', esc_html__( 'Readme , display new window', 'Raindrops' ), 'target="_blank"' ) );
		$content = '<dl id="raindrops-help">' . $content . '</dl>';

		return $content;
	}

}

if ( !function_exists( 'raindrops_editor_page_contextual_help' ) ) {

	function raindrops_editor_page_contextual_help() {

		global $raindrops_current_data;
		$html	 = '<dt>%1$s</dt><dd>%2$s</dd>';
		$link	 = '<a href="%1$s" %3$s>%2$s</a>';
		$content = '';
		$content .= sprintf( $html, esc_html__( 'Support', 'Raindrops' ), sprintf( $link, 'http://wordpress.org/support/theme/raindrops', esc_html__( 'English', 'Raindrops' ), 'target="_blank"' ) . '<br />' . sprintf( $link, 'http://ja.forums.wordpress.org/', esc_html__( 'Japanese', 'Raindrops' ), 'target="_blank"' ) );

		$help = '<h2>' . esc_html__( 'How to remove Site Title Block', 'Raindrops' ) . '</h2><pre><code>#hd{display:none;}</code></pre>';
		$help .= '<h2>' . esc_html__( 'How to remove Post Author Name', 'Raindrops' ) . '</h2><pre><code>.posted-by-string,.author{display:none;}</code></pre>';
		$help .= '<h2>' . esc_html__( 'How to remove Entry Date', 'Raindrops' ) . '</h2><pre><code>.posted-on-string,.entry-date{display:none;}</code></pre>';
		$help .= '<h2>' . esc_html__( 'How to remove Entry Meta', 'Raindrops' ) . '</h2><pre><code>.entry-meta{display:none;}</code></pre>';
		$help .= '<h2>' . esc_html__( 'How to remove Archive Title Label[ like Category Archives ]', 'Raindrops' ) . '</h2><pre><code>#archives-title .label{display:none;}</code></pre>';
		$help .= '<h2>' . esc_html__( 'How to remove Home list above next prev navigation link', 'Raindrops' ) . '</h2><pre><code> #nav-above{ display:none;}</code></pre>';
		$help .= '<p>' . esc_html__( 'above codes paste style.css last. If not change when  Version value change ( line:9 )', 'Raindrops' ) . '</p>';

		$help = wpautop( $help );

		$content = '<dl id="raindrops-help">' . $content . $help . '</dl>';
		return $content;
	}
}
/**
 * Raindrops edit help
 *
 *
 * Check the real color of the Cradation Class and the Color Class.
 *
 *
 */
if ( !function_exists( 'raindrops_edit_help' ) ) {

	function raindrops_edit_help( $text, $force = false ) {

		global $post_type_object;
		global $title;

		if ( RAINDROPS_USE_AUTO_COLOR !== true && $force !== true ) {

			return $text;
		}

		if ( ( isset( $post_type_object ) && ( $title == $post_type_object->labels->add_new_item || $title == $post_type_object->labels->edit_item ) || true == $force ) ) {

			$result = "<h2 class=\"h2\">" . esc_html__( 'Tips', "Raindrops" ) . '</h2>';
			$result .= '<p>' . esc_html__( 'If Raindrops Options panel is opened, and the reference color is set, this arrangement of color is changed at once.', "Raindrops" ) . "</p>";
			$result .= "<dl><dt><h3>" . esc_html__( 'Dinamic Color Class', 'Raindrops' ) . '</strong></h3>';
			$result .= '<dd><table><tr>
							<td style="' .raindrops_colors_clone( 5, 'set' ) . ';padding:0.5em;">class color5</td>
							<td style="' . raindrops_colors_clone( 4, 'set' ) . ';padding:0.5em;">class color4</td>
							<td style="' . raindrops_colors_clone( 3, 'set' ) . ';padding:0.5em;">class color3</td>
							<td style="' . raindrops_colors_clone( 2, 'set' ) . ';padding:0.5em;">class color2</td>
							<td style="' . raindrops_colors_clone( 1, 'set' ) . ';padding:0.5em;">class color1</td></tr><tr>
							<td style="' . raindrops_colors_clone( '-1', 'set' ) . ';padding:0.5em;">class color-1</td>
							<td style="' . raindrops_colors_clone( '-2', 'set' ) . ';padding:0.5em;">class color-2</td>
							<td style="' . raindrops_colors_clone( '-3', 'set' ) . ';padding:0.5em;">class color-3</td>
							<td style="' . raindrops_colors_clone( '-4', 'set' ) . ';padding:0.5em;">class color-4</td>
							<td style="' . raindrops_colors_clone( '-5', 'set' ) . ';padding:0.5em;">class color-5</td></tr>
							<tr><td colspan="5">
							' . esc_html__( 'code example:please HTML editor mode', 'Raindrops' ) . '
							<div  style="' . raindrops_colors_clone( -1, 'set' ) . ';padding:1em;">&lt;div class="color-1"&gt;
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum&lt;/div&gt;
							</div></td>
							</tr></table>
							</dd>';
			$result .= "<dt><h3>" . esc_html__( 'Dinamic Gradient Class', 'Raindrops' ) . '</h3></dt>';
			$result .= '<dd><table><tr>
						<td style="' . raindrops_gradient_single( 1, "asc" ) . 'padding:0.5em;">class gradient1</td>
						<td style="' . raindrops_gradient_single( 2, "asc" ) . 'padding:0.5em;">class gradient2</td>
						<td style="' . raindrops_gradient_single( 3, "asc" ) . 'padding:0.5em;">class gradient3</td>
						<td style="' . raindrops_gradient_single( 4, "asc" ) . 'padding:0.5em;">class gradient4</td>
						</tr><tr>
						<td style="' . raindrops_gradient_single( -1, "asc" ) . 'padding:0.5em;">class gradient-1</td>
						<td style="' . raindrops_gradient_single( -2, "asc" ) . 'padding:0.5em;">class gradient-2</td>
						<td style="' . raindrops_gradient_single( -3, "asc" ) . 'padding:0.5em;">class gradient-3</td>
						<td style="' . raindrops_gradient_single( -4, "asc" ) . 'padding:0.5em;">class gradient-4</td>
						</tr>
						<tr><td colspan="5">
						' . esc_html__( 'code example:please HTML editor mode', 'Raindrops' ) . '
						<div  style="' . raindrops_gradient_single( -1, "asc" ) . 'padding:1em;">&lt;div class="gradient-1"&gt;<p>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>&lt;/div&gt;</div></td></tr></table></dd>';
			$result .= "<dl><dt><h3>" . esc_html__( 'Font Size CSS Class', 'Raindrops' ) . '</strong></h3>';
			$result .= "<dt><p>" . esc_html__( 'Classes', 'Raindrops' ) . '</p></dt>';
			$result .= "<dd><p>" . esc_html__( 'f10 , f11 , f12 , f13 , f14 , f15 , f16 , f17 , f18 , f19 , f20 , f21 , f22 , f23 , f24 , f25 , f26', 'Raindrops' ) . "</p><pre><code>&lt;p class=\"f16\"&gt;Font Size 16px&lt;/p&gt;</code></pre>";
			$result .= "</dl>";
			$result .= "<dl><dt><h3>" . esc_html__( 'Google Fonts Family CSS Class', 'Raindrops' ) . '</strong></h3>';
			$result .= "<dt><p>" . esc_html__( 'Classes', 'Raindrops' ) . '</p></dt>';
			$result .= "<dd><p>" . esc_html__( 'Note, More than 90 percent of the Google font can be used, but there are some limitations.', 'Raindrops' ) . "</p></dd>";
			$result .= "<dd><p>" . esc_html__( 'Examples of the no corresponding font', 'Raindrops' ) . "</p><pre><code>Fredericka the Great ( The first character is lowercase word ) </code></pre></dd>";
			$result .= "<dd><p>" . esc_html__( 'Examples of the corresponding font', 'Raindrops' ) . "</p><pre><code>Open Sans Condensed ( font name has 0 - 2 spaces ) </code></pre></dd>";
			$result .= "<dd><p>" . esc_html__( 'How to specify the font', 'Raindrops' ) . "</p><pre><code>Open Sans: &lt;p class=\"google-font-open-sans\"&gt;Open Sans&lt;/p&gt;</code></pre></dd>";
			$result .= "<dd><p>" . esc_html__( 'Add prefix google-font- + Font name lowercase and change to - the space', 'Raindrops' ) . "</p></dd>";
			$result .= "<dd><p>" . esc_html__( 'How to specify the font weight', 'Raindrops' ) . "</p><pre><code>Open Sans EXTRA-BOLD800: &lt;p class=\"google-font-open-sans800\"&gt;Open Sans&lt;/p&gt;</code></pre></dd>";
			$result .= "<dd><p>" . esc_html__( 'How to specify the font style', 'Raindrops' ) . "</p><pre><code>Open Sans EXTRA-BOLD800 Italic: &lt;p class=\"google-font-open-sans800i\"&gt;Open Sans&lt;/p&gt;</code></pre></dd>";
			$result .= "</dl>";

			$result .= "<dl><dt><h3>" . esc_html__( 'Example of Custom CSS Meta Box Style Rules', 'Raindrops' ) . '</strong></h3>';
			$result .= "<dt><p>" . esc_html__( 'Styling Entry Title', 'Raindrops' ) . '</p></dt>';
			$result .= "<dd><p>" . esc_html__( 'Change entry title color', 'Raindrops' ) . "</p><pre><code>.entry-title span{ color:red; }</code></pre>";
			$result .= "<dt><p>" . esc_html__( 'Styling Posted on', 'Raindrops' ) . '</p></dt>';
			$result .= "<dd><p>" . esc_html__( 'hide posted on from all post', 'Raindrops' ) . "</p><pre><code> .posted-on, .entry-meta-default{ display:none;}</code></pre></dd>";
			$result .= "<dt><p>" . esc_html__( 'Styling Posted in', 'Raindrops' ) . '</p></dt>';
			$result .= "<dd><p>" . esc_html__( 'hide posted in', 'Raindrops' ) . "</p><pre><code> .entry-meta{ display:none;}</code></pre></dd>";
			$result .= "<dt><p>" . esc_html__( 'Styling Article', 'Raindrops' ) . '</p></dt>';
			$result .= "<dd><p>" . esc_html__( 'add border and padding', 'Raindrops' ) . "</p><pre><code>article {border:1px solid red;padding:1em;}</code></pre>"
			. "<p>" . esc_html__( 'note:article elements and post_class () You can use all of the elements to be output.', 'Raindrops' ) . "</p></dd>";
			$result .= "</dl>";

			$result .= $text;
			return $result;
		} else {

			return $text;
		}
	}

}
/**
 * Create admin panel form and define input value.
 *
 *
 *
 *
 */
if ( !function_exists( 'raindrops_options_init' ) ) {

	function raindrops_options_init() {

		global $raindrops_base_setting;

		if ( isset( $raindrops_base_setting ) ) {

			foreach ( $raindrops_base_setting as $setting ) {

				register_setting( 'raindrop_options', $setting[ 'option_name' ], $setting[ 'validate' ] );
			}
		}
	}

}
/**
 * internal function File upload
 *
 *
 * @param $embed string inline or external or embed
 * @param $id #hd or #ft
 */
if ( !function_exists( 'raindrops_upload_image_parser' ) ) {

	function raindrops_upload_image_parser( $uri, $embed = "inline", $id = "#hd" ) {

		/* upload image from raindrops admin panel saved filename
		 * e.g. raindrops-item-header-style-no-repeat-top-0-left-0-aomoriken.jpg
		 * filename parse and create style
		 */
		$upload_info = wp_upload_dir();
		$filename	 = basename( $uri );

		if ( file_exists( get_stylesheet_directory() . '/images/' . $filename ) ) {

			if ( '#hd' == $id ) {

				if ( !file_exists( $upload_info[ 'path' ] . '/' . $filename ) ) {

					return apply_filters( 'raindrops_upload_image_parser_hd', 'background:url(  ' . get_stylesheet_directory_uri() . '/images/' . $filename . '  );background-repeat:repeat-x;' );
				}
			} elseif ( '#ft' == $id ) {

				if ( !file_exists( $upload_info[ 'path' ] . '/' . $filename ) ) {

					return apply_filters( 'raindrops_upload_image_parser_ft', 'background:url(  ' . get_stylesheet_directory_uri() . '/images/' . $filename . '  );background-repeat:repeat-x;' );
				}
			}
		} elseif ( file_exists( get_template_directory() . '/images/' . $filename ) ) {

			if ( '#hd' == $id ) {

				if ( !file_exists( $upload_info[ 'path' ] . '/' . $filename ) ) {

					return apply_filters( 'raindrops_upload_image_parser_hd', 'background:url(  ' . get_template_directory_uri() . '/images/' . $filename . '  );background-repeat:repeat-x;' );
				}
			} elseif ( '#ft' == $id ) {

				if ( !file_exists( $upload_info[ 'path' ] . '/' . $filename ) ) {

					return apply_filters( 'raindrops_upload_image_parser_ft', 'background:url(  ' . get_template_directory_uri() . '/images/' . $filename . '  );background-repeat:repeat-x;' );
				}
			}
		}

		if ( file_exists( $upload_info[ 'path' ] . '/' . $filename ) ) {
			$top	 = '';
			$left	 = '';
			$height	 = '';
			$style	 = '';
			preg_match( "|raindrops-item-([^-]+)|", $filename, $regs );

			if ( isset( $regs[ 1 ] ) ) {

				$purpose = $regs[ 1 ];

				$purpose = str_replace( array( "header", "footer" ), array( "#hd", "#ft" ), $purpose );
			}
			preg_match( "|-style-([^-]+)|", $filename, $regs );

			if ( isset( $regs[ 1 ] ) ) {

				$style = $regs[ 1 ];

				$style = str_replace( array( 'no', 'x' ), array( 'no-', '-x' ), $style );
			}
			preg_match( "|-top-(-?[^-]+)|", $filename, $regs );

			if ( isset( $regs[ 1 ] ) ) {

				$top = $regs[ 1 ];
			}
			preg_match( "|-left-(-?[^-]+)|", $filename, $regs );

			if ( isset( $regs[ 1 ] ) ) {

				$left = $regs[ 1 ];
			}
			preg_match( "|-height-([^-]+)|", $filename, $regs );

			if ( isset( $regs[ 1 ] ) ) {

				$height = $regs[ 1 ];
			}
			if ( 'inline' == $embed ) {

				return apply_filters( 'raindrops_upload_image_parser_prop', 'background:url(  ' . $uri . '  );background-repeat:' . $style . ';background-position:' . $left . 'px ' . $top . 'px;min-height:' . $height . 'px;' );
			} elseif ( 'external' == $embed || 'embed' == $embed ) {

				return apply_filters( 'raindrops_upload_image_parser_prop', $purpose . '{background:url(  ' . $uri . '  );background-repeat:' . $style . ';background-position:' . $left . 'px ' . $top . 'px;min-height:' . $height . 'px;}' );
			} else {

				return;
			}
		}
		return false;
	}
}
/**
 * Alias function Show real gradient where admin panel help
 *
 *
 *
 *
 * return string inline style rule what gradient
 */
if ( !function_exists( 'raindrops_gradient_single' ) ) {

	function raindrops_gradient_single( $i, $order = "asc" ) {

		return apply_filters( "raindrops_gradient_single", raindrops_gradient_single_clone( $i, $order ) );
	}

}
/**
 * Alias function Create gradient style rule
 *
 *
 *
 * return string embed header current style rule set what gradient
 */
if ( !function_exists( 'raindrops_gradient' ) ) {

	function raindrops_gradient( $selector ) {

		return apply_filters( "raindrops_gradient", raindrops_gradient_clone( $selector ) );
	}

}

if ( !function_exists( "raindrops_add_stylesheet" ) ) {

	function raindrops_add_stylesheet() {

		global $raindrops_current_theme_name, $raindrops_current_data_version, $raindrops_css_auto_include;
		//$themes			 = wp_get_themes();
		//$current_theme	 = $raindrops_current_theme_name;
		if ( false !== ( $url = raindrops_locate_url( 'reset-fonts-grids.css' ) ) ){

			wp_register_style( 'raindrops_reset_fonts_grids', $url, array(), $raindrops_current_data_version, 'all' );
			wp_enqueue_style( 'raindrops_reset_fonts_grids' );
		}

		if ( false !== ( $url = raindrops_locate_url( 'grids.css' ) ) ) {

			wp_register_style( 'raindrops_grids', $url, array( 'raindrops_reset_fonts_grids' ), $raindrops_current_data_version, 'all' );
			wp_enqueue_style( 'raindrops_grids' );
		}

		if ( false !== ( $url = raindrops_locate_url( 'fonts.css' ) ) ) {

			wp_register_style( 'raindrops_fonts', $url, array( 'raindrops_grids' ), $raindrops_current_data_version, 'all' );
			wp_enqueue_style( 'raindrops_fonts' );
		}

		$style_filename =  'languages/css/' . get_locale() . '.css';

		if ( false !== ( $url = raindrops_locate_url( $style_filename ) ) ) {

			wp_register_style( 'lang_style', $url, array( 'raindrops_fonts' ), $raindrops_current_data_version, 'all' );
			wp_enqueue_style( 'lang_style' );
		}

		if ( raindrops_warehouse_clone( "raindrops_style_type" ) !== 'w3standard' ) {

			if ( false !== ( $url = raindrops_locate_url( 'css3.css' ) ) ) {

				wp_register_style( 'raindrops_css3', $url, array( 'raindrops_fonts' ), $raindrops_current_data_version, 'all' );
				wp_enqueue_style( 'raindrops_css3' );
			}
		}
		if ( $raindrops_css_auto_include == true ) {

			$style_filename = get_template_directory_uri() . '/style.css';

			wp_register_style( 'style', $style_filename, array( 'raindrops_fonts' ), $raindrops_current_data_version, 'all' );
			wp_enqueue_style( 'style' );
		}

		if ( is_child_theme() ) {

			$style_filename =  get_stylesheet_directory_uri() . '/style.css';

			wp_register_style( 'child', $style_filename, array( 'style' ), $raindrops_current_data_version, 'all' );
			wp_enqueue_style( 'child' );

			/**
			 * When Using Child Theme, Parent rtl.css is not load, only load child themes load rtl.css
			 * When not exists rtl.css at Child Theme, It should be automate include parent rtl.css
			 *
			 */

			if( is_rtl() ) {

				$rtl_css = raindrops_locate_url('rtl.css');

				wp_register_style( 'child-rtl', $rtl_css, array( 'style' ), $raindrops_current_data_version, 'all' );
				wp_enqueue_style( 'child-rtl' );
			}

			$depending_on_style = 'child';

		} else {
			$depending_on_style = 'style';
		}

		if ( raindrops_warehouse_clone( "raindrops_page_width" ) == 'doc3' || raindrops_warehouse_clone( "raindrops_page_width" ) == 'doc5' ) {

			if ( false !== ( $url = raindrops_locate_url( 'responsiveness.css' ) ) ) {

				wp_register_style( 'raindrops_responsiveness', $url, array( $depending_on_style ), $raindrops_current_data_version, 'all' );
				wp_enqueue_style( 'raindrops_responsiveness' );
			}
		}

		if ( false !== ( $url = raindrops_locate_url( 'raindrops.js' ) ) ) {

			wp_register_script( 'raindrops', $url, array( 'jquery', 'jquery-migrate' ), $raindrops_current_data_version, false );
			wp_enqueue_script( 'raindrops' );
		}
	}

}
/**
 * filter function comment form
 *
 *
 *
 *
 */
if ( !function_exists( "raindrops_comment_form" ) ) {

	function raindrops_comment_form( $form ) {

		global $commenter;
		$form[ 'url' ] = '<p class="comment-form-url"><label for="url">' . esc_html__( 'Website', 'Raindrops' ) . '</label><span class="option">' . esc_html__( '(&nbsp;optional&nbsp;)', 'Raindrops' ) . '</span><input id="url" name="url" type="text" value="' . esc_attr( $commenter[ 'comment_author_url' ] ) . '" size="30" /></p>';
		return apply_filters( "raindrops_comment_form", $form );
	}

}
/**
 * filter function remove area required
 *
 *
 *
 *
 */
if ( !function_exists( "raindrops_custom_remove_aria_required" ) ) {

	function raindrops_custom_remove_aria_required( $arg ) {

		global $raindrops_document_type;

		if ( $raindrops_document_type == 'xhtml' ) {
			$change	 = array( "aria-required=\"true\"", "aria-required='true'" );
			$arg	 = str_replace( $change, '', $arg );
			return $arg;
		} else {
			return $arg;
		}
	}

}
/**
 * Option value set when install.
 *
 *
 *
 *
 */
if ( !function_exists( "setup_raindrops" ) ) {

	function setup_raindrops() {

		global $wpdb, $raindrops_base_setting;

		if ( false == RAINDROPS_USE_AUTO_COLOR ) {

			return;
		}
		$raindrops_theme_settings = get_option( 'raindrops_theme_settings' );

		foreach ( $raindrops_base_setting as $add ) {

			$option_name = $add[ 'option_name' ];

			if ( !isset( $raindrops_theme_settings[ $option_name ] ) ) {

				$raindrops_theme_settings[ $option_name ] = $add[ 'option_value' ];
			}
		}
		$style_type											 = raindrops_warehouse_clone( "raindrops_style_type" );
		$raindrops_indv_css									 = raindrops_design_output_clone( $style_type ) . raindrops_color_base_clone();
		$raindrops_theme_settings[ '_raindrops_indv_css' ]	 = $raindrops_indv_css;
		update_option( 'raindrops_theme_settings', $raindrops_theme_settings, "", $add[ 'autoload' ] );

		if ( file_exists( get_stylesheet_directory() . '/images/headers/wp3.jpg' ) ) {

			$raindrops_site_image			 = get_stylesheet_directory_uri() . '/images/headers/wp3.jpg';
			$raindrops_site_thumbnail_image	 = get_stylesheet_directory_uri() . '/images/headers/wp3-thumbnail.jpg';
		} else {

			$raindrops_site_image			 = get_template_directory_uri() . '/images/headers/wp3.jpg';
			$raindrops_site_thumbnail_image	 = get_template_directory_uri() . '/images/headers/wp3-thumbnail.jpg';
		}
		set_theme_mod( 'default-image', $raindrops_site_image );
	}

}
/**
 * image element has attribute 'width','height' and image size > column width
 * style max-width value 100% set when expand height height attribute value.
 *
 * IE filter
 *
 */
if ( !function_exists( "raindrops_ie_height_expand_issue" ) ) {

	function raindrops_ie_height_expand_issue( $content ) {

		global $is_IE, $content_width;

		if ( $is_IE ) {

			preg_match_all( '#(<img)([^>]+)(height|width)(=")([0-9]+)"([^>]+)(height|width)(=")([0-9]+)"([^>]*)>#', $content, $images, PREG_SET_ORDER );

			foreach ( $images as $image ) {

				if ( ( "width" == $image[ 3 ] && $image[ 5 ] > $content_width ) || ( "width" == $image[ 7 ] && $image[ 9 ] > $content_width ) ) {

					$content = str_replace( $image[ 0 ], $image[ 1 ] . $image[ 2 ] . $image[ 6 ] . $image[ 10 ] . '>', $content );
				}
			}
			return $content;
		} else {

			return $content;
		}
	}

}
/**
 * Raindrops once message when install.
 *
 *
 *
 *
 *
 */
if ( !function_exists( "raindrops_first_only_msg" ) ) {

	function raindrops_first_only_msg( $type = 0 ) {

		global $raindrops_current_theme_name;

		if ( 1 == $type ) {

			$query	 = 'raindrops_settings';
			$link	 = get_site_url( '', 'wp-admin/themes.php', 'admin' ) . '?page=' . $query;

			if ( version_compare( PHP_VERSION, '5.0.0', '<' ) ) {

				$msg = sprintf( esc_html__( 'Sorry Your PHP version is %s Please use PHP version 5 || later.', 'Raindrops' ), PHP_VERSION );
			} else {

				$msg = sprintf( esc_html__( 'Thank you for adopting the %1$s theme. It is necessary to set it to this theme. Please move to a set screen clicking this ', 'Raindrops' ) . '<a href="%2$s">' . esc_html__( 'Raindrops settings view', 'Raindrops' ) . '</a>.', $raindrops_current_theme_name, $link );
			}
		}
		return '<div id="testmsg" class="error"><p>' . $msg . '</p></div>' . "\n";
	}

}
/**
 * Management of uninstall and install.
 *
 *
 *
 * ver 1.114 Theme data automatic change is supported at the time of site change.
 */
if ( !function_exists( "raindrops_install_navigation" ) ) {

	function raindrops_install_navigation() {


		$install	 = get_option( 'raindrops_theme_settings' );
		$upload_dir	 = wp_upload_dir();
		if ( false == $install ) {

		} else {

			if ( isset( $install[ 'current_stylesheet_dir_url' ] ) && get_stylesheet_directory_uri() !== $install[ 'current_stylesheet_dir_url' ] ) {

				$install[ '_raindrops_indv_css' ]		 = str_replace( $install[ 'current_stylesheet_dir_url' ], get_stylesheet_directory_uri(), $install[ '_raindrops_indv_css' ] );
				$install[ 'old_stylesheet_dir_url' ]	 = $install[ 'current_stylesheet_dir_url' ];
				$install[ 'current_stylesheet_dir_url' ] = get_stylesheet_directory_uri();
				update_option( 'raindrops_theme_settings', $install );
			} elseif ( !isset( $install[ 'current_stylesheet_dir_url' ] ) ) {

				$install[ 'current_stylesheet_dir_url' ] = get_stylesheet_directory_uri();
				update_option( 'raindrops_theme_settings', $install );
			}

			if ( isset( $install[ 'current_upload_base_url' ] ) && $upload_dir !== $install[ 'current_upload_base_url' ] ) {

				$install[ '_raindrops_indv_css' ]		 = str_replace( $install[ 'current_upload_base_url' ], $upload_dir[ 'baseurl' ], $install[ '_raindrops_indv_css' ] );
				$install[ 'old_upload_base_url' ]		 = $install[ 'current_upload_base_url' ];
				$install[ 'current_upload_base_url' ]	 = $upload_dir[ 'baseurl' ];
				update_option( 'raindrops_theme_settings', $install );
			} elseif ( !isset( $install[ 'current_upload_base_url' ] ) ) {

				$install[ 'current_upload_base_url' ] = $upload_dir[ 'baseurl' ];
				update_option( 'raindrops_theme_settings', $install );
			}
			if( 'delete' == raindrops_warehouse_clone( "raindrops_uninstall_option" ) ) {

				//add_action( 'switch_theme', 'raindrops_delete_all_options' );
			}
		}
	}

}
if ( !function_exists( "raindrops_delete_all_options" ) ) {

	function raindrops_delete_all_options(){

		if( current_user_can( 'delete_themes' ) ) {

			delete_option( 'raindrops_theme_settings' );

			remove_theme_mods();

			delete_option( 'widget_raindrops_pinup_entry_widget' );
			delete_option( 'widget_raindrops_entrywidget' );

			$allposts = get_posts( 'numberposts=0&post_type=post&post_status=') ;

			foreach( $allposts as $postinfo ) {

				delete_post_meta($postinfo->ID, '_web_fonts_styles');
				delete_post_meta($postinfo->ID, '_web_fonts_link_element');
				delete_post_meta($postinfo->ID, '_css');
				delete_post_meta($postinfo->ID, 'css');
				delete_post_meta($postinfo->ID, '_add-to-front');
				delete_post_meta($postinfo->ID, '_raindrops_this_header_image');
				delete_post_meta($postinfo->ID, 'meta');
				if ( RAINDROPS_CUSTOM_FIELD_SCRIPT == true ) {
					delete_post_meta($postinfo->ID, 'javascript');
				}

			}

			$allposts = get_posts( 'numberposts=0&post_type=page&post_status=') ;

			foreach( $allposts as $postinfo ) {

				delete_post_meta($postinfo->ID, '_web_fonts_styles');
				delete_post_meta($postinfo->ID, '_web_fonts_link_element');
				delete_post_meta($postinfo->ID, '_css');
				delete_post_meta($postinfo->ID, 'css');
				delete_post_meta($postinfo->ID, '_add-to-front');
				delete_post_meta($postinfo->ID, '_raindrops_this_header_image');
				delete_post_meta($postinfo->ID, 'meta');
				if ( RAINDROPS_CUSTOM_FIELD_SCRIPT == true ) {
					delete_post_meta($postinfo->ID, 'javascript');
				}

			}
		}
	}
}

/**
 * insert into embed style ,javascript script and embed tags from custom field
 *
 *
 *
 *
 */
if ( !function_exists( "raindrops_embed_css" ) ) {

	function raindrops_embed_css() {

		global $post, $raindrops_fluid_or_fixed, $raindrops_fluid_minimum_width, $raindrops_wp_version, $raindrops_current_theme_name, $raindrops_page_width, $raindrops_base_font_size, $raindrops_custom_header_width, $raindrops_custom_header_height,$raindrops_current_column;
		$css = apply_filters('raindrops_embed_css_pre', '' );

		//preload
		$css_rule_set = 'body:after{display:none; content: url(%1$s);}';
		$css .= "\n". sprintf( $css_rule_set, get_header_image() );
		//#header-image
		$css .= "\n" . raindrops_header_image( 'css' ) . "\n";
	
		//#header-image bounse issue fixed
		$css_rule_set =	'#header-imge{ width:%1$spx;height:%2$spx;}';
		$css .= "\n". sprintf( $css_rule_set, $raindrops_custom_header_width, apply_filters( 'raindrops_header_image_height', $raindrops_custom_header_height ) );

		//site-title
		$raindrops_text_color = get_theme_mod( 'header_textcolor', 'dddddd' );

		if ( $raindrops_text_color !== 'blank' && display_header_text() == true ) {

			$css .= "\n#site-title a{color:#" . $raindrops_text_color . ';}';
		}

		//page type

		if ( isset( $raindrops_fluid_or_fixed ) && !empty( $raindrops_fluid_or_fixed ) && ( 'doc' == raindrops_warehouse_clone( "raindrops_page_width" ) || 'doc2' == raindrops_warehouse_clone( "raindrops_page_width" ) || 'custom-doc' == raindrops_warehouse_clone( "raindrops_page_width" ) || 'doc4' == raindrops_warehouse_clone( "raindrops_page_width" ) ) ) {

			$css .= raindrops_is_fixed();
		} elseif ( isset( $raindrops_fluid_minimum_width ) && !empty( $raindrops_fluid_minimum_width ) || 'doc5' == raindrops_warehouse_clone( "raindrops_page_width" )) {

			$css .= raindrops_is_fluid();
		}

		//#hd
		$uploads			 = wp_upload_dir();
		$header_image_uri	 = $uploads[ 'url' ] . '/' . raindrops_warehouse( 'raindrops_header_image' );

		if ( 'raindrops' !== $raindrops_current_theme_name && 'header.png' == raindrops_warehouse( 'raindrops_header_image' ) ) {

			$header_image_uri = str_replace( $raindrops_current_theme_name, 'raindrops', $header_image_uri );
		}
		$css .= "\n#hd{" . raindrops_upload_image_parser( $header_image_uri, 'inline', '#hd' ) . '}';
		//#ft
		$footer_image_uri = $uploads[ 'url' ] . '/' . raindrops_warehouse( 'raindrops_footer_image' );

		if ( 'raindrops' !== $raindrops_current_theme_name && 'footer.png' == raindrops_warehouse( 'raindrops_footer_image' ) ) {

			$footer_image_uri = str_replace( $raindrops_current_theme_name, 'raindrops', $footer_image_uri );
		}
		$css .= "\n#ft{" . raindrops_upload_image_parser( $footer_image_uri, 'inline', '#ft' ) . '}';

		$css .= "\n#ft{color:". raindrops_warehouse( 'raindrops_footer_color' ). ';}';
		// 2col 3col change style helper
		$css .= '/*' . raindrops_warehouse_clone( 'raindrops_show_right_sidebar' ) . '*/';

		if ( "show" == raindrops_warehouse_clone( 'raindrops_show_right_sidebar' ) ) {

			$css .= ' .rsidebar{display:block;} ';
		} else {

			$css .= ' .rsidebar{display:none;} ';
			$css .= '.yui-t6 .index.archives,.yui-t5 .index.archives,.yui-t4 .index.archives{
					 margin-right:1em;	}';
		}

		//when manual style rule mode

		if ( raindrops_warehouse_clone( "raindrops_style_type" ) == $raindrops_current_theme_name ) {

			return $css . raindrops_warehouse_clone( '_raindrops_indv_css' );
		}
		$raindrops_options = get_option( "raindrops_theme_settings" );

		if ( isset( $raindrops_options[ 'raindrops_style_type' ] ) && !empty( $raindrops_options[ 'raindrops_style_type' ] ) ) {

			$raindrops_style_type = $raindrops_options[ 'raindrops_style_type' ];
		} else {

			$raindrops_style_type = '';
		}
		$raindrops_options			 = get_option( 'raindrops_theme_settings' );
		$raindrops_base_color		 = raindrops_warehouse_clone( 'raindrops_base_color' );
		$raindrops_hyperlink_color	 = raindrops_warehouse_clone( 'raindrops_hyperlink_color' );
		$raindrops_indv_css			 = raindrops_design_output( $raindrops_style_type ) . raindrops_color_base( $raindrops_base_color );

		//when this code exists [raindrops color_type="minimal" col="1"] in the post
		$raindrops_indv_css = raindrops_color_type_custom( $raindrops_indv_css );
		$css .= apply_filters( "raindrops_indv_css", $raindrops_indv_css );

		if ( $raindrops_hyperlink_color !== '' ) {

			$css .= raindrops_custom_link_color( $raindrops_hyperlink_color );
		}
		$background	 = get_background_image();
		$color		 = get_background_color();

		if ( !empty( $background ) || !empty( $color ) ) {

			$css = preg_replace( "|body[^{]*{[^}]+}|", "", $css );
		}
		if ( raindrops_warehouse_clone( 'raindrops_basefont_settings' ) > 13 ) {
			$css .= 'body{font-size:' . raindrops_warehouse_clone( 'raindrops_basefont_settings' ) . 'px;}';
		} elseif ( isset( $raindrops_base_font_size ) ) {
			$css .= 'body{font-size:' . $raindrops_base_font_size . 'px;}';
		}

		//body background
		$body_background			 = get_theme_mod( "background_color" );
		$body_background_image		 = get_theme_mod( "background_image" );
		$body_background_repeat		 = get_theme_mod( "background_repeat" );
		$body_background_position_x	 = get_theme_mod( "background_position_x" );
		$body_background_attachment	 = get_theme_mod( "background_attachment" );

		if ( $body_background !== false && !empty( $body_background ) && !empty( $body_background_image ) ) {

			$css .= "\nbody{background:#" . $body_background . ' url(  ' . $body_background_image . '  );}';
		} elseif ( $body_background !== false && !empty( $body_background ) ) {

			$css .= "\nbody{background-color:#" . $body_background . ';}';
		} elseif ( !empty( $body_background_image ) ) {

			$css .= "\nbody{background-image: url(  " . $body_background_image . '  );}';
		}

		if ( isset( $body_background_repeat ) && !empty( $body_background_repeat ) ) {

			$css .= "\nbody{background-repeat: " . $body_background_repeat . ';}';
		}

		if ( isset( $body_background_position_x ) && !empty( $body_background_position_x ) ) {

			$css .= "\nbody{background-position:top " . $body_background_position_x . ';}';
		}

		if ( isset( $body_background_attachment ) && !empty( $body_background_attachment ) ) {

			$css .= "\nbody{background-attachment: " . $body_background_attachment . ';}';
		}

		/* Primary Menu Font Size */
		$primary_menu_font_size = raindrops_warehouse_clone( 'raindrops_menu_primary_font_size' );

		if ( isset( $primary_menu_font_size ) && !empty( $primary_menu_font_size ) ) {
			/* Add check value why some web site font-size:0% using child theme */
			if ( $primary_menu_font_size > 76 && $primary_menu_font_size < 183 ) {
				$css .= '#access .children li{width:100%;}';
				$css .= '#access .sub-menu li{width:100%;}';
				$css .= '#access a{font-size:' . floatval( $primary_menu_font_size ) . '%;}';
			} else {

				$css .= '#access a{font-size:100%;}';
			}
		} else {
			$css .= '#access a{font-size:100%;}';
		}

		$primary_menu_min_width = raindrops_warehouse_clone( 'raindrops_menu_primary_min_width' );

		if ( isset( $primary_menu_min_width ) && !empty( $primary_menu_min_width ) ) {

			if ( $primary_menu_min_width < 10 ) { $child_width = 10; }else{ $child_width = floatval( $primary_menu_min_width );}

			$adding_style = "\n".'#access ul ul li,#access ul ul,#access a{ min-width:%1$dem;}
							.ie8 #access .page_item_has_children > a:after,
							.ie8 #access .menu-item-has-children > a:after{ content :"";}
							#access .children li,#access .sub-menu li,#access .children ul,#access .sub-menu ul,#access .children a,#access .sub-menu a{
							 min-width:%2$dem;
							}';

			$css .= sprintf( $adding_style , $primary_menu_min_width, $child_width);
		}

		if ( empty( $css ) ) {

			$css = "cannot get style value check me";
		}

		if ( WP_DEBUG !== true ) {

			$css = str_replace( array( "\n", "\r", "\t", '&quot;', '--', '\"' ), array( "", "", "", '"', '', '"' ), $css );
		} else {

			$css = str_replace( array( '&quot;', '--', '\"' ), array( '"', '', '"' ), $css );
		}

		return apply_filters( "raindrops_embed_meta_css", $css );
	}
}
/**
 *
 *
 *
 *
 *
 */
if ( !function_exists( "raindrops_custom_link_color" ) ) {

	function raindrops_custom_link_color( $color ) {

		$css = <<< LINK_COLOR_CSS
.entry-content a:link,
.entry-content a:active,
.entry-content a:visited,
.entry-content a:hover{
	color:{$color};
}

.entry-title a:link,
.entry-title a:active,
.entry-title a:visited,
.entry-title a:hover{
	color:{$color};
}

.posted-on a:link,
.posted-on a:active,
.posted-on a:visited,
.posted-on a:hover{
	color:{$color};
}
.entry-meta-default .entry-date{
color:{$color};
}/*single.php*/
.entry-meta-default .author a{
	color:{$color};
}/*single.php*/

.post .entry-meta,
.entry-meta a:link,
.entry-meta a:active,
.entry-meta a:visited,
.entry-meta a:hover{
	color:{$color};
}

.rsidebar a:link,
.rsidebar a:active,
.rsidebar a:visited,
.rsidebar a:hover{
	color:{$color};
}
.lsidebar a:link,
.lsidebar a:active,
.lsidebar a:visited,
.lsidebar a:hover{
	color:{$color};
}

#wp-calendar{
color:{$color};
}
.raindrops-comment-link em,
.raindrops-comment-link a:link em,
.raindrops-comment-link a:active em,
.raindrops-comment-link a:visited em,
.raindrops-comment-link a:hover em{
	color:{$color}! important;
}

#nav-above .nav-previous a,
#nav-above .nav-next a,
#nav-below .nav-previous a,
#nav-below .nav-next a{
	color:{$color};

}
.logged-in-as a:link,
.logged-in-as a:active,
.logged-in-as a:visited,
.logged-in-as a:hover{
	color:{$color};
}
LINK_COLOR_CSS;
		if ( preg_match( "!#([0-9a-f]{6}|[0-9a-f]{3})!si", $color ) ) {

			return apply_filters( "raindrops_custom_link_color", $css );
		}
	}

}
/**
 *
 *
 *
 *
 *
 */
if ( !function_exists( "raindrops_embed_meta" ) ) {

	function raindrops_embed_meta( $content ) {

		global $post, $wp_customize, $content_width, $raindrops_stylesheet_type;

		$raindrops_use_featured_image_emphasis = raindrops_warehouse_clone( 'raindrops_use_featured_image_emphasis' );

		if ( $raindrops_use_featured_image_emphasis == 'yes' ) {
			$raindrops_post_image_position	 = raindrops_warehouse_clone( 'raindrops_featured_image_position' );

			add_filter( 'raindrops_post_thumbnail_size_main_query', 'raindrops_post_thumbnail_size_in_the_loop', 10, 3 );

			switch ( $raindrops_post_image_position ) {

				case( 'front' ):
					add_filter( 'raindrops_embed_meta_css', 'raindrops_post_thumbnail_size_block_style' );
					break;
				case( 'left' ):
					add_filter( 'raindrops_embed_meta_css', 'raindrops_post_thumbnail_size_lefty_style' );
					break;

				default:
					remove_filter( 'raindrops_embed_meta_css', 'raindrops_post_thumbnail_size_block_style' );
					remove_filter( 'raindrops_embed_meta_css', 'raindrops_post_thumbnail_size_lefty_style' );
			}
		}

		$result	 = "";

		$css = apply_filters( 'raindrops_embed_meta_pre','');
		$css .='#doc5 .raindrops-keep-content-width{width:'. $content_width. 'px;max-width:100%;margin:auto;float:none;}'. "\n";
		$css .='#doc5 .raindrops-keep-content-width .raindrops-expand-width{margin:0;}'. "\n";
		$css .='#doc3 .raindrops-keep-content-width{width:'. $content_width. 'px;max-width:100%;margin:auto;float:none;}'. "\n";
		$css .='#doc3 .raindrops-keep-content-width .raindrops-expand-width{margin:0;}'. "\n";

		if ( isset( $wp_customize ) || $raindrops_stylesheet_type !== 'external' ) {
			$css .= raindrops_embed_css();
		}

		$result_indv = '';
		$pinup_style = '';
		if ( RAINDROPS_USE_AUTO_COLOR !== true ) {

			//  $css = '';
		}

		if ( is_single() || is_page() ) {

				$pinup_widget_ids		= raindrops_get_pinup_widget_ids();
				$pinup_widget_post_ids	= raindrops_pinup_widget_ids_to_post_ids( $pinup_widget_ids );

				foreach( $pinup_widget_post_ids as $pinup_id ){

					$web_fonts = get_post_meta( $pinup_id, '_web_fonts_link_element', true );

					if ( isset( $web_fonts ) && !empty( $web_fonts ) ) {

						$web_fonts_each_array = explode("\n", $web_fonts);

						foreach( $web_fonts_each_array as $web_fonts_each ) {
							$result = str_replace( array( $web_fonts_each,"\n\n"), array('',"\n"), $result );
							$result .= $web_fonts_each ."\n";
						}
					}

					$web_fonts_style = get_post_meta( $pinup_id, '_web_fonts_styles', true );

						if ( isset( $web_fonts_style ) && !empty( $web_fonts_style ) ) {

							$web_fonts_style_each_array = explode("\n", $web_fonts_style );

							foreach( $web_fonts_style_each_array as $web_fonts_style_each ) {
								$pinup_style = str_replace( array( $web_fonts_style_each,"\n\n"), array('',"\n"), $pinup_style );
								$pinup_style .= $web_fonts_style_each ."\n";
							}
						}
				}

				$web_fonts = get_post_meta( get_the_ID(), '_web_fonts_link_element', true );

				if ( isset( $web_fonts ) && !empty( $web_fonts ) ) {

					$result .= $web_fonts ;
				}

				$web_fonts_styles = get_post_meta( $post->ID, '_web_fonts_styles', true );

				if ( ( isset( $web_fonts_styles ) && !empty( $web_fonts_styles ) ) || !empty( $pinup_style )) {

					$web_fonts_styles_wrapper = "<style type=\"text/css\" media=\"screen\">\n". '%1$s</style>'. "\n";

					$result .= sprintf( $web_fonts_styles_wrapper,  $web_fonts_styles. $pinup_style );

				}

			$css_single = get_post_meta( $post->ID, 'css', true );
			/* 1.234 metabox support */

			$css_single .= get_post_meta( $post->ID, '_css', true );


			if ( true == RAINDROPS_OVERRIDE_POST_STYLE_ALL_CONTENTS ) {

				$css .= preg_replace_callback( '![^}]+{[^}]+}!siu', 'raindrops_css_add_id', $css_single );

			} else {

				$css_single = $css_single;

			}

			if ( !empty( $css ) && RAINDROPS_CUSTOM_FIELD_CSS == true ) {

				$result .= '<style type="text/css" id="raindrops-embed-css">';
				$result .= "\n<!--/*<! [CDATA[*/\n";
				$result .= strip_tags( $css );
				$result .= "\n/*]]>*/-->\n";
				$result .= "</style>";
			}

			$meta = get_post_meta( $post->ID, 'meta', true );

			if ( !empty( $meta ) && RAINDROPS_CUSTOM_FIELD_META == true ) {

				$result .= raindrops_esc_custom_field_meta( $meta );
			}

			$javascript = get_post_meta( $post->ID, 'javascript', true );

			if ( !empty( $javascript ) && RAINDROPS_CUSTOM_FIELD_SCRIPT == true ) {

				$result .= '<script type="text/javascript">';
				$result .= "\n<!--/*<! [CDATA[*/\n";
				$result .= raindrops_esc_custom_field_javascript( $javascript );
				$result .= "\n/*]]>*/-->\n";
				$result .= "</script>";
			}
		} else {

			$pinup_widget_ids		= raindrops_get_pinup_widget_ids();
			$pinup_widget_post_ids	= raindrops_pinup_widget_ids_to_post_ids( $pinup_widget_ids );

			if( isset($pinup_widget_post_ids) && is_array( $pinup_widget_post_ids ) ) {

				foreach( $pinup_widget_post_ids as $pinup_id ){

					$web_fonts = get_post_meta( $pinup_id, '_web_fonts_link_element', true );

					if ( isset( $web_fonts ) && !empty( $web_fonts ) ) {

						$web_fonts_each_array = explode("\n", $web_fonts);

						foreach( $web_fonts_each_array as $web_fonts_each ) {
							$result = str_replace( array( $web_fonts_each,"\n\n"), array('',"\n"), $result );
							$result .= $web_fonts_each ."\n";
						}
					}

					$web_fonts_style = get_post_meta( $pinup_id, '_web_fonts_styles', true );

					if ( isset( $web_fonts_style ) && !empty( $web_fonts_style ) ) {

						$web_fonts_style_each_array = explode("\n", $web_fonts_style );

						foreach( $web_fonts_style_each_array as $web_fonts_style_each ) {
							$result_indv = str_replace( array( $web_fonts_style_each,"\n\n"), array('',"\n"), $result_indv );
							$result_indv .= $web_fonts_style_each ."\n";
						}
					}
				}
			}
			if ( true == RAINDROPS_OVERRIDE_POST_STYLE_ALL_CONTENTS ) {

				if ( have_posts() && !is_date() ) {

					if ( false == RAINDROPS_USE_AUTO_COLOR ) {

					}


					while ( have_posts() ) {
						the_post();
						$web_fonts = get_post_meta( $post->ID, '_web_fonts_link_element', true );

						if ( isset( $web_fonts ) && !empty( $web_fonts ) ) {

							$web_fonts_each_array = explode("\n", $web_fonts);

							foreach( $web_fonts_each_array as $web_fonts_each ) {
								$result = str_replace( array( $web_fonts_each,"\n\n"), array('',"\n"), $result );
								$result .= $web_fonts_each ."\n";
							}
						}

						$web_fonts_style = get_post_meta( $post->ID, '_web_fonts_styles', true );


						if ( isset( $web_fonts_style ) && !empty( $web_fonts_style ) ) {

							$web_fonts_style_each_array = explode("\n", $web_fonts_style );

							foreach( $web_fonts_style_each_array as $web_fonts_style_each ) {
								$result_indv = str_replace( array( $web_fonts_style_each,"\n\n"), array('',"\n"), $result_indv );
								$result_indv .= $web_fonts_style_each ."\n";
							}
						}

						$collections = get_post_meta( $post->ID, 'css', true );
						$collections .= get_post_meta( $post->ID, '_css', true );
						if ( !empty( $collections ) ) {
							$result_indv .= preg_replace_callback( '![^}]+{[^}]+}!siu', 'raindrops_css_add_id', $collections );
						}
					}
					rewind_posts();


				}
			}

			$result .= '<style type="text/css">';
			$result .= "\n<!--/*<! [CDATA[*/\n";
			$result .= $css;
			$result .= "/*start custom fields style for loop pages*/\n";

			if ( WP_DEBUG !== true ) {

				$result_indv = str_replace( array( "\n", "\r", "\t", '&quot;', '--', '\"' ), array( "", "", "", '"', '', '"' ), $result_indv );
			}
			$result .= $result_indv;
			$result .= "\n/*end custom fields style for loop pages*/";
			$result .= "\n/*]]>*/-->\n";
			$result .= "</style>\n";
		}
		echo apply_filters( 'raindrops_embed_meta_echo', $result );

		return $content;
	}
}

if ( !function_exists( 'raindrops_esc_custom_field_meta' ) ) {

	function raindrops_esc_custom_field_meta( $meta_input ) {

		if ( RAINDROPS_CUSTOM_FIELD_META !== true ) {
			return;
		}
		$meta	 = preg_replace( '!>[^<]+<!', ">\n<", $meta_input );
		$meta	 = "\n{$meta}\n";
		$meta	 = preg_replace( '!style\s*=\s*("|\')[^"\']+("|\')!', '', $meta );
		$meta	 = preg_replace( '!onmouseover\s*=\s*("|\')[^"\']+("|\')!', '', $meta );
		$meta	 = strip_tags( $meta, '<base><link><meta>' );

		if ( is_singular() && !empty( $meta_input ) ) {

			return apply_filters( 'raindrops_esc_custom_field_meta', $meta, $meta_input );
		}

		return;
	}

}

/**
 * When custom field <base>element add single post display properly.
 * But loop page not adding <base>element,result display improperly.
 * this filter detect custom field <base> and add base URL to relative links and image source.
 */
add_filter( 'the_content', 'raindrops_custom_field_meta_helper' );

if ( !function_exists( 'raindrops_custom_field_meta_helper' ) ) {

	function raindrops_custom_field_meta_helper( $content ) {

		global $post;
		$meta_values = '';

		if ( isset( $post ) ) {
			$meta_values = get_post_meta( $post->ID, 'meta', true );
		}

		if ( !empty( $meta_values ) && strstr( $meta_values, '<base' ) !== false && !is_singular() ) {

			preg_match( '!<base.+href\s*=\s*("|\')([^"\']+)("|\')!', $meta_values, $regs );

			/* NOTE: This preg_replace has Notice:Undefined offset: 2,  add patturn exists check */

			if ( preg_match( '!(href\s*=\s*|src\s*=\s*)("|\')([^//]*)?("|\')!', $content ) ) {

				$content = preg_replace( '!(href\s*=\s*|src\s*=\s*)("|\')([^//]*)?("|\')!', '$1"' . esc_url( $regs[ 2 ] ) . '$3"', $content );

				return apply_filters( 'raindrops_esc_custom_field_meta_helper', $content );
			}
		}

		return $content;
	}

}

if ( !function_exists( 'raindrops_esc_custom_field_javascript' ) ) {

	function raindrops_esc_custom_field_javascript( $script ) {

		if ( RAINDROPS_CUSTOM_FIELD_SCRIPT !== true ) {
			return;
		}
		if ( is_singular() && !empty( $script ) ) {

			$javascript = str_replace( array( "\n", "\t", "\r", ), ' ', $script );

			return apply_filters( 'raindrops_esc_custom_field_javascript', $javascript, $script );
		}
		return;
	}

}

/**
 *
 *
 *
 * @since 0.992
 */
if ( !function_exists( "raindrops_css_add_id" ) ) {

	function raindrops_css_add_id( $matches ) {

		global $post;
		$result = '';
		$exclude_lists = '@keyframes|transform|from\s*{|to\s*{|@raindrops'; // separate |
		foreach ( $matches as $k => $match ) {

			if(preg_match('!([^{]+){([^{]+{)(.+)!',$match, $regs) ) {
				$result .= $regs[1]. '{'. "\n";
				$match = $regs[2]. $regs[3];
			}

			if(  preg_match('!('. $exclude_lists .')!', $result. $match ) || preg_match( '!^[0-9]{1,3}%!', trim( $match ) ) ) {

				if( preg_match( '!@raindrops!', $match) ) {

					// @raindrops is force keyword, Not adding ID
					// Although not recommended, please use only if absolutely necessary
					// Please include the CSS body class that specifies a particular page(.postid-xxxx). This is not the case when the layout is likely to collapse.
					$match = str_replace( '@raindrops', '', $match );
				}

				$result .= ' ' . trim( $match ) . "\n";

				return $result;
			}
			if ( preg_match( '|^([^@]+){(.+)|siu', $match, $regs ) ) {

				$match_1 = str_replace( ',', ', #post-' . $post->ID . ' ', $regs[ 1 ] );
				$match	 = $match_1 . '{' . $regs[ 2 ];

				$result .= '#post-' . $post->ID . ' ' . trim( $match ) . "\n";
			} else {

				$result .= ' ' . trim( $match ) . "\n";
			}


		}
		return $result;
	}

}
/**
 * Alternative character when value is blank
 *
 *
 *
 *
 */
if ( !function_exists( "raindrops_blank_fallback" ) ) {

	function raindrops_blank_fallback( $string, $fallback ) {

		if ( !empty( $string ) ) {

			return $string;
		} else {

			return $fallback;
		}
	}

}
/**
 * Article navigation
 *
 *
 *
 *
 */
if ( !function_exists( "raindrops_prev_next_post" ) ) {

	function raindrops_prev_next_post( $position = "nav-above" ) {

		if ( is_category() ) {

			$filter = true; //display same category.
		} else {

			$filter = false;
		}
		//exclude separate 'and'
		$exclude_category	 = apply_filters( 'raindrops_next_prev_excluded_categories', '' );
		$html				 = '<div id="%1$s" class="%2$s"><span class="%3$s">';
		printf( $html, $position, "clearfix", "nav-previous" );
		previous_post_link( '%link', '<span class="button"><span class="meta-nav">&laquo;</span> %title</span>', $filter, $exclude_category );
		$html				 = '</span><div class="%1$s">';
		printf( $html, "nav-next" );
		next_post_link( '%link', '<span class="button"> %title <span class="meta-nav">&raquo;</span></span>', $filter, $exclude_category );
		$html				 = '</div></div>';
		echo apply_filters( "raindrops_prev_next_post", $html );
	}

}
/**
 * date.php
 *
 *
 *
 *
 */
if ( !function_exists( "raindrops_days_in_month" ) ) {

	function raindrops_days_in_month( $month, $year ) {

		$daysInMonth = array( 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 );

		if ( $month != 2 ) {

			return $daysInMonth[ $month - 1 ];
		}
		return ( checkdate( $month, 29, $year ) ) ? 29 : 28;
	}

}

/**
 * for date.php
 *
 *
 *
 *
 */
if ( !function_exists( "raindrops_get_year" ) ) {

	function raindrops_get_year( $posts = '', $year = '', $pad = 0 ) {

		global $calendar_page_number, $post_per_page, $calendar_page_last, $calendar_page_start;

		$months	 = array();
		$y		 = "";
		$m		 = "";
		$d		 = "";
		// first let's parse through our posts, organizing them by month

		foreach ( $posts as $post ) {

			$y				 = substr( $post->post_date, 0, 4 );
			$m				 = substr( $post->post_date, 5, 2 );
			$d				 = substr( $post->post_date, 8, 2 );
			$months[ $m ][]	 = $post;
		}
		$year_label  = apply_filters( 'raindrops_archive_year_label', $year );
		$output		 = "<h2 class=\"h2 year\"><span class=\"year-name\">$year_label</span></h2>";
		$table_year	 = array( '<table id="raindrops_year_list"' . raindrops_doctype_elements( 'summary ="Archives in ' . $year . '"', '', false ) . '><tbody>', '<tr><td class="month-name">1</td><td></td></tr>', '<tr><td class="month-name">2</td><td></td></tr>', '<tr><td class="month-name">3</td><td></td></tr>', '<tr><td class="month-name">4</td><td></td></tr>', '<tr><td class="month-name">5</td><td></td></tr>', '<tr><td class="month-name">6</td><td></td></tr>', '<tr><td class="month-name">7</td><td></td></tr>', '<tr><td class="month-name">8</td><td></td></tr>', '<tr><td class="month-name">9</td><td></td></tr>', '<tr><td class="month-name">10</td><td></td></tr>', '<tr><td class="month-name">11</td><td></td></tr>', '<tr><td class="month-name">12</td><td></td></tr>', '</tbody></table>' );

		foreach ( $months as $num => $val ) {

			$num				 = (int) $num;
			$table_year[ $num ]	 = '<tr><td class="month-name"><a href="' . get_month_link( $year, $num ) . "\" title=\"$year/$num\">" . $num . '</a></td><td class="month-excerpt"><a href="' . get_month_link( $year, $num ) . "\" title=\"$year/$num\">" . sprintf( esc_html__( "%s Articles archived", "Raindrops" ), count( $val ) ) . '</a></td></tr>';
		}
		return $output . implode( "\n", $table_year );
	}

}
/* end raindrops_get_year(   ) */
/**
 * for date.php
 *
 *
 *
 *
 */
if ( !function_exists( "raindrops_get_day" ) ) {

	function raindrops_get_day( $posts = '', $year = '', $mon = '', $day = '', $pad = 1 ) {

		global $month;
		$here	 = home_url();
		$year_label = apply_filters( 'raindrops_archive_year_label', $year );
		$month_label = apply_filters( 'raindrops_archive_month_label', $mon );
		$day_label = apply_filters( 'raindrops_archive_day_label', $day );
		$output	 = "<h2 class=\"h2 year-month-date\"><a href=\"" . get_year_link( $year ) . "\" title=\"$year\"><span class=\"year-name\">$year_label</span></a> <a href=\"" . get_month_link( $year, $mon ) . "\" title=\"$year/$mon\"><span class=\"month-name\">" . $month_label . "</span></a>&nbsp;<span class=\"day-name\">" . $day_label . "</span></h2>";
		$output .= '<table id="date_list" ' . raindrops_doctype_elements( 'summary="Archive in ' . $day . ', ' . $mon . ', ' . $year . '"', '', false ) . '>';

		foreach ( $posts as $mytime ) {

			$h = substr( $mytime->post_date, 11, 2 );

			if ( 10 > $h ) {

				$h = substr( $h, 1, 1 );
			}
			$today[ $h ][] = $mytime;
		}

		for ( $i = 0; $i <= 24; $i++ ) {
			$output .= '<tr><td class="time">';

			if ( 10 > $i ) {

				$output .= "0$i:00";
			} else {

				$output .= "$i:00";
			}
			$output .= '</td><td class="entry-title">';

			if ( isset( $today[ $i ] ) ) {

				foreach ( $today[ $i ] as $mytime ) {

					$mytime->post_title	 = raindrops_fallback_title( $mytime->post_title );
					$mytime->post_title	 = preg_replace( '|>.+</|', '>[Article ' . $mytime->ID . ']</', $mytime->post_title );


					$output .= "<a href=\"" . get_permalink( $mytime->ID ) . "\"
id=\"post-" . $mytime->ID . "\"><span>$mytime->post_title</span></a><br />";
				}
			} else {

				$output .= '<span style="visibility:hidden;">.</span>';
			}
			$output .= '</td></tr>';
		}
		$output .= '</table>';
		return $output;
	}

}
/* end raindrops_get_day(   ) */
/**
 * for date.php
 *
 *
 *
 *
 */
if ( !function_exists( "raindrops_year_list" ) ) {

	function raindrops_year_list( $one_month, $ye, $mo ) {

		global $calendar_page_number, $post_per_page, $calendar_page_last, $calendar_page_start;
		$d		 = "";
		$links	 = "";
		$result	 = "";

		foreach ( $one_month as $key => $month ) {

			list( $y, $m, $d ) = sscanf( $month->post_date, "%d-%d-%d $d:$d:$d" );
			$month->post_title	 = raindrops_fallback_title( $month->post_title );
			$month->post_title	 = preg_replace( '|>.+</|', '>[link to ' . $month->ID . ']</', $month->post_title );

			if ( $m == $mo && $ye == $y ) {

				$links .= "<li class=\"$mo\"><a href=\"" . get_permalink( $month->ID ) . "\" title=\"" . esc_attr( strip_tags( $month->post_title ) ) . "\">" . $month->post_title . "</a></li>";
			}
		}

		if ( !empty( $links ) ) {

			$result .= " <td><ul>";
			$result .= $links;
			$result .= "</ul></td>";
		}
		return $result;
	}

}
/**
 * sort month_list
 *
 *
 *
 *
 */
if ( !function_exists( "raindrops_cmp_ids" ) ) {

	function raindrops_cmp_ids( $a, $b ) {

		$cmp = strcmp( $a->post_date, $b->post_date );
		return $cmp;
	}

}
/**
 * for date.php
 *
 *
 *
 *
 *
 */
if ( !function_exists( "raindrops_month_list" ) ) {

	function raindrops_month_list( $one_month, $ye, $mo ) {

		global $calendar_page_number, $post_per_page, $calendar_page_last, $calendar_page_start, $wp_locale;
		$result	 = "";
		$here	 = home_url();
		$z		 = - 1;
		$c		 = 0;

		for ( $i = 1; $i <= raindrops_days_in_month( $mo, $ye ); $i++ ) {
			$links		 = "";
			usort( $one_month, "raindrops_cmp_ids" );
			$page_break	 = false;
			$first_data	 = false;

			foreach ( $one_month as $key => $month ) {

				list( $y, $m, $d, $h, $m, $s ) = sscanf( $month->post_date, "%d-%d-%d %d:%d:%d" );

				if ( $key < $calendar_page_last && $key >= $calendar_page_start ) {

					if ( $d == $i && $m == $mo && $y == $ye ) {

						$first_data			 = true;
						$month->post_title	 = raindrops_fallback_title( $month->post_title );
						$month->post_title	 = preg_replace( '|>.+</|', '>[link to ' . $month->ID . ']</', $month->post_title );

						$html = '<li id="post-%5$s" %6$s>
					<span class="%1$s"><a href="%2$s" rel="bookmark" title="%3$s"><span>%4$s</span></a></span>
					<%7$s class="entry-date updated" %8$s>%9$s</%7$s>
					<span class="author vcard"><a class="url fn nickname" href="%10$s" title="%11$s" rel="vcard:url">%12$s</a></span> 					</li>';

						$display_name = get_the_author_meta( 'display_name', $month->post_author );
						$links .= sprintf( $html, 'h2 entry-title', esc_url( get_permalink( $month->ID ) ), 'link to content: ' . esc_attr( strip_tags( $month->post_title ) ), $month->post_title, $month->ID, ' ' . raindrops_post_class( array( 'clearfix' ), $month->ID, false ), raindrops_doctype_elements( 'span', 'time', false ), raindrops_doctype_elements( '', 'datetime="' . esc_attr( get_the_date( 'c' ) ) . '"', false ), $month->post_date, get_author_posts_url( get_the_author_meta( 'ID' ) ), sprintf( esc_attr__( 'View all posts by %s', 'Raindrops' ), $display_name ), $display_name
						);
						$c++;
					}
				}
			}
			$post_per_page	 = get_option( 'posts_per_page' );
			$post_per_page	 = apply_filters( 'raindrops_month_list_post_count', $post_per_page );

			if ( $z == $c && $c == $post_per_page ) {

				break;
			}

			if ( !empty( $links ) ) {

				$result .= "<tr><td class=\"month-date\"><span class=\"day-name\">";
				$result .= "<a href=\"" . get_day_link( $y, $mo, $i ) . "\">";
				$result .= $i;
				$result .= " </a></span></td><td><ul>";
				$result .= $links;
				$result .= "</ul></td></tr>";
			} else {

				$result .= "<tr class=\"no-archive\"><td class=\"month-date\"><span class=\"day-name\">";
				$result .= $i;
				$result .= " </span></td><td>&nbsp;</td></tr>";
			}
			$z = $c;
		}
		$month_name = $wp_locale->get_month( $m );
		$year_name = apply_filters( 'raindrops_month_list_year_name', $y );
		if( get_locale() == 'ja') {
			$output = "<h2 id=\"date_title\" class=\"h2 year-month\"><a href=\"" . esc_url( get_year_link( $y ) ) . "\" title=\"" . esc_attr( $y ) . "\"><span class=\"year-name\">" . esc_html( $year_name ) . "</span></a> <span class=\"month-name\">" . esc_html( $month_name ) . " </span></h2>";
		} else {
			$output = "<h2 id=\"date_title\" class=\"h2 year-month\"><span class=\"month-name\">" . esc_html( $month_name ) . " </span> <a href=\"" . esc_url( get_year_link( $y ) ) . "\" title=\"" . esc_attr( $y ) . "\"><span class=\"year-name\">" . esc_html( $year_name ) . "</span></a></h2>";
		}
		return $output . '<table id="month_list" ' . raindrops_doctype_elements( 'summary="Archive in ' . esc_attr( $m ) . ', ' . esc_attr( $y ) . '"', '', false ) . '>' . $result . "</table>";
	}

}
/**
 * index ,archive,loops page title
 *
 * echo Archives title
 *
 *
 */
if ( !function_exists( "raindrops_loop_title" ) ) {

	function raindrops_loop_title() {

		global $template;

		$Raindrops_class_name	 = "";
		$page_title				 = "";
		$page_title_c			 = "";

		if ( is_search() ) {

			$Raindrops_class_name	 = 'serch-result';
			$page_title				 = esc_html__( "Search Results", 'Raindrops' );
			$page_title_c			 = get_search_query();
		} elseif ( is_tag() ) {

			$Raindrops_class_name	 = 'tag-archives';
			$page_title				 = esc_html__( "Tag Archives", 'Raindrops' );
			$page_title_c			 = single_term_title( "", false );
		} elseif ( is_category() ) {

			$Raindrops_class_name	 = 'category-archives';
			$page_title				 = esc_html__( "Category Archives", 'Raindrops' );
			$page_title_c			 = single_cat_title( '', false );
		} elseif ( is_archive() ) {

			$raindrops_date_format = get_option( 'date_format' );

			if ( is_day() ) {

				$Raindrops_class_name	 = 'dayly-archives';
				$page_title				 = esc_html__( 'Daily Archives', 'Raindrops' );
				$page_title_c			 = get_the_date( $raindrops_date_format );
			} elseif ( is_month() ) {

				$Raindrops_class_name	 = 'monthly-archives';
				$page_title				 = esc_html__( 'Monthly Archives', 'Raindrops' );

				if ( 'ja' == get_locale() ) {

					$page_title_c = get_the_date( 'Y / F' );
				} else {

					$page_title_c = get_the_date( 'F Y' );
				}
			} elseif ( is_year() ) {

				$Raindrops_class_name	 = 'yearly-archives';
				$page_title				 = esc_html__( 'Yearly Archives', 'Raindrops' );
				$page_title_c			 = get_the_date( 'Y' );
			} elseif ( is_author() ) {

				$Raindrops_class_name	 = 'author-archives';
				$page_title				 = esc_html__( "Author Archives", 'Raindrops' );
				while ( have_posts() ) {
					the_post();
					$page_title_c = get_avatar( get_the_author_meta( 'user_email' ), 32 ) . ' ' . get_the_author();
					break;
				}
				rewind_posts();
			} elseif ( has_post_format( 'aside' ) ) {

				$slug					 = 'aside';
				$Raindrops_class_name	 = 'post-format-' . $slug;
				$page_title				 = esc_html__( 'Post Format', 'Raindrops' );
				$page_title_c			 = get_post_format_string( $slug );
			} elseif ( has_post_format( 'chat' ) ) {

				$slug					 = 'chat';
				$Raindrops_class_name	 = 'post-format-' . $slug;
				$page_title				 = esc_html__( 'Post Format', 'Raindrops' );
				$page_title_c			 = get_post_format_string( $slug );
			} elseif ( has_post_format( 'gallery' ) ) {

				$slug					 = 'gallery';
				$Raindrops_class_name	 = 'post-format-' . $slug;
				$page_title				 = esc_html__( 'Post Format', 'Raindrops' );
				$page_title_c			 = get_post_format_string( $slug );
			} elseif ( has_post_format( 'link' ) ) {

				$slug					 = 'link';
				$Raindrops_class_name	 = 'post-format-' . $slug;
				$page_title				 = esc_html__( 'Post Format', 'Raindrops' );
				$page_title_c			 = get_post_format_string( $slug );
			} elseif ( has_post_format( 'image' ) ) {

				$slug					 = 'image';
				$Raindrops_class_name	 = 'post-format-' . $slug;
				$page_title				 = esc_html__( 'Post Format', 'Raindrops' );
				$page_title_c			 = get_post_format_string( $slug );
			} elseif ( has_post_format( 'quote' ) ) {

				$slug					 = 'quote';
				$Raindrops_class_name	 = 'post-format-' . $slug;
				$page_title				 = esc_html__( 'Post Format', 'Raindrops' );
				$page_title_c			 = get_post_format_string( $slug );
			} elseif ( has_post_format( 'status' ) ) {

				$slug					 = 'status';
				$Raindrops_class_name	 = 'post-format-' . $slug;
				$page_title				 = esc_html__( 'Post Format', 'Raindrops' );
				$page_title_c			 = get_post_format_string( $slug );
			} elseif ( has_post_format( 'video' ) ) {

				$slug					 = 'video';
				$Raindrops_class_name	 = 'post-format-' . $slug;
				$page_title				 = esc_html__( 'Post Format', 'Raindrops' );
				$page_title_c			 = get_post_format_string( $slug );
			} elseif ( has_post_format( 'audio' ) ) {

				$slug					 = 'audio';
				$Raindrops_class_name	 = 'post-format-' . $slug;
				$page_title				 = esc_html__( 'Post Format', 'Raindrops' );
				$page_title_c			 = get_post_format_string( $slug );
			} else {

				$Raindrops_class_name	 = 'blog-archives';
				$page_title				 = esc_html__( "Blog Archives", 'Raindrops' );
			}
		}

		$page_title = apply_filters( 'raindrops_loop_title_page_title', $page_title );

		if ( empty( $Raindrops_class_name ) ) {

			if ( is_front_page() ) {
				$Raindrops_class_name = 'front-page ';
			}

			$Raindrops_class_name .= basename( $template, '.php' );
			$Raindrops_class_name = str_replace( array( '_', ), array( '-', ), $Raindrops_class_name );
		}

		if ( !empty( $Raindrops_class_name ) ) {

			echo "\n". str_repeat("\t", 7 ). '<ul class="index archives ' . esc_attr( $Raindrops_class_name ) . '">';
		} else {

			echo "\n". str_repeat("\t", 7 ). '<ul class="index archives">';
		}

		if ( !empty( $page_title ) ) {

			printf( '<li class="title-wrapper %3$s-wrapper"><strong class="f16" id="archives-title"><span class="label">%1$s</span> <span class="title">%2$s</span></strong></li>', apply_filters( 'raindrops_archive_name', $page_title ), apply_filters( 'raindrops_archive_value', $page_title_c ), $Raindrops_class_name );

			if ( is_category() ) {
				printf('<li class="list-category-navigation">%1$s</li>', raindrops_category_navigation() );

			}
		}
	}

}
/**
 * yui helper function
 *
 *
 *
 *
 *
 */
if ( !function_exists( "raindrops_yui_class_modify" ) ) {

	function raindrops_yui_class_modify( $raindrops_inner_class = 'yui-ge' ) {

		//   global $yui_inner_layout;
		$value = raindrops_warehouse_clone( 'raindrops_right_sidebar_width_percent' );
		if ( '25' == $value ) {

			$yui_inner_layout = 'yui-ge';
		} elseif ( '75' == $value ) {

			$yui_inner_layout = 'yui-gf';
		} elseif ( '33' == $value ) {

			$yui_inner_layout = 'yui-gc';
		} elseif ( '66' == $value ) {

			$yui_inner_layout = 'yui-gd';
		} elseif ( '50' == $value ) {

			$yui_inner_layout = 'yui-g';
		} else {

			$yui_inner_layout = 'yui-ge';
		}

		return apply_filters( 'raindrops_yui_class_modify', $yui_inner_layout );
	}

}
/**
 * Template conditional function Raindrops display 2column or not
 *
 *
 * @param string   css rule or text
 * @param bool      if value is true echo or false return
 * @return string  input strings text
 */
if ( !function_exists( "is_2col_raindrops" ) ) {

	function is_2col_raindrops( $action = true, $echo = true ) {

		if ( 'hide' == Raindrops_warehouse_clone( 'raindrops_show_right_sidebar' ) ) {

			if ( true == $echo ) {

				echo $action;
			} else {

				return $action;
			}
		} else {

			return false;
		}
	}

}
/**
 * yui layout curc
 *
 *
 *
 * @return content width
 */
if ( !function_exists( "raindrops_main_width" ) ) {

	function raindrops_main_width() {

		return raindrops_content_width_clone();
	}

}
/**
 * content width curc
 *
 *
 *
 *
 * @return main column width
 */
if ( !function_exists( "raindrops_content_width" ) ) {

	function raindrops_content_width() {

		return raindrops_content_width_clone();
	}

}
/**
 * fallback stylesheet
 *
 *
 *
 *
 */
if ( !function_exists( "raindrops_w3standard" ) ) {

	function raindrops_w3standard() {

		$font_color	 = raindrops_colors( $num		 = 5, $select		 = 'color', $color1		 = null );
		$style		 = <<<DOC
legend,
a:link,a:active,a:visited,a:hover,
.lsidebar,
#sidebar,
.rsidebar,
#doc,#doc2,#doc3,#doc4,
#hd,
h1,
#yui-main,
.entry ol ol ,.entry ul,
.entry ul * {
%c5%
}
.footer-widget h2,.rsidebar h2,.lsidebar h2 {
%c5%
%h2_w3standard_background%
%h_position_rsidebar_h2%
}
body {
margin:0! important;padding:0;
background-repeat:repeat-x;
}
#yui-main{
color:%raindrops_header_color%;
}
#hd{
background-image:url( %raindrops_hd_images_path%%raindrops_header_image% );
}
.hfeed{
background:#fff;
}
#ft {
background:url( %raindrops_images_path%%raindrops_footer_image% ) repeat-x;
color:%raindrops_footer_color%;
}
.footer-widget h2,
.rsidebar h2,
.lsidebar h2 {
/*%h2_w3standard_background%*/
%h_position_rsidebar_h2%
}
.rsidebar ul li ul li,
.lsidebar ul li ul li{
list-style-type:square;
list-style-position:inside;
}
.ie8 .lsidebar .widget ul li a {
list-style:none;
}
.home .sticky {
%c5%
border-top:solid 6px %c_border%;
border-bottom:solid 2px %c_border%;
}
.entry-meta{
%c4%
border-top:solid 1px %c_border%;
border-bottom:solid 1px %c_border%;
}
textarea,
input[type="password"],
input[type="text"],
input[type="submit"],
input[type="reset"],
input[type="file"]{
%c4%
}
input[type="checkbox"],
input[type="radio"],
select{
%c4%
}
.social textarea#comment,
.social input[type="text"] {
outline:none;
%c3%
}
.social textarea#comment:focus,
.social input:focus{
%c4%
}
.entry-content ul li{
list-style-type:square;
}
.entry-content input[type="submit"],
.entry-content input[type="reset"],
.entry-content input[type="file"]{
%c4%
}
.entry-content input[type="submit"],
.entry-content input[type="radio"]{
%c3%
}
.entry-content select{
%c4%
}
.entry-content blockquote{
%c4%
border-left:solid 6px %c_border%;
}
cite{
%c4%
}
cite a:link,
cite a:active,
cite a:visited,
cite a:hover{
$font_color
}
.entry-content fieldset {
border:solid 1px %c_border%;
}
.entry-content legend{
%c5%
}
.entry-content td{
%c4%
border:solid 1px %c_border%;
}
.entry-content th{
%c3%
border:solid 1px %c_border%;
}
hr{
border-top:1px dashed %c_border%;
}
/*--------------------------------*/
#access{
/*%c3%*/
}
#access a {
}
#access ul ul a {
%c3%
}
#access li:active > a,
#access ul ul :active > a {
top:0;
%c2%
color:%custom_color%
}
#access ul li.current_page_item > a,
#access ul li.current-menu-ancestor > a,
#access ul li.current-menu-item > a,
#access ul li.current-menu-parent > a {
%c3%
}
.ie6 #access ul li.current_page_item a,
.ie6 #access ul li.current-menu-ancestor a,
.ie6 #access ul li.current-menu-item a,
.ie6 #access ul li.current-menu-parent a,
.ie6 #access ul li a:hover {
%c2%
}
table,
table td,
#access > li{
border:1px solid #ccc;
}
tfoot td{
border:none;
}
.lsidebar  li,
.rsidebar li{
border:none! important;
}
td.month-date,td.month-name,td.time{
%c4%
}
.datetable td li{
}
address{margin:10px auto;}
.wp-caption {
}
li.byuser,
li.bypostauthor {
%c5%
}
.comment-meta a,
cite.fn{
}
.datetable td li{
}
.fail-search,
#not-found {
%c3%
border:3px double;
}
.rd-page-navigation li{
border-left:solid 1px %c_border%;
%c5%
}
.rd-page-navigation a{
%c5%
}
.rd-page-navigation .current_page_item{
%c4%
}
.raindrops-tab-content,
.raindrops-tab-list li{
border:1px solid %c_border%;
}
/*comment bubble*/
a.raindrops-comment-link {
}
.raindrops-comment-link em {
%c4%
position: relative;
}
.raindrops-comment-link .point {
border-left: 0.45em solid %c_border%;
border-bottom: 0.45em solid #FFF; /* IE fix */
border-bottom: 0.45em solid %c_border%;
overflow: hidden; /* IE fix */
}
a.raindrops-comment-link:hover {
}
a.raindrops-comment-link:hover em {
%c5%
}
a.raindrops-comment-link:hover .point {
border-left:1px solid %c_border%;
}
DOC;
		return $style;
	}

}
/**
 * plugin API
 *
 *
 *
 *
 *
 */
if ( !function_exists( "plugin_is_active" ) ) {

	function plugin_is_active( $plugin_path ) {

		$return_var = in_array( $plugin_path, get_option( 'active_plugins' ) );
		return $return_var;
	}

	if ( plugin_is_active( 'tmn-quickpost/tmn-quickpost.php' ) ) {

		global $base_info;

		foreach ( $base_info[ 'root' ] as $key => $val ) {

			$wp_cockneyreplace[ '%' . $key . '%' ] = $val;
		}

		function raindrops_import_post_meta() {

			global $post, $base_info;
			$r = get_post_meta( $post->ID, 'template', true );

			foreach ( $base_info[ 'root' ] as $key => $val ) {

				$r = str_replace( '%' . $key . '%', $val, $r );
			}

			if ( class_exists( 'trans' ) ) {

				$n = new trans( $r );
				return $n->text2html();
			} else {

				return $r;
			}
		}

	}
}
/** Custom Image Header for Raindrops theme
 *
 *
 *
 *
 *
 */
if ( !function_exists( 'raindrops_header_style' ) ) {

	function raindrops_header_style() {
		?><?php
	}

}
/** Custom Image Header for Raindrops theme
 *
 *
 *
 *
 *
 */
if ( !function_exists( 'raindrops_admin_header_style' )  && version_compare( $wp_version, '4.1', '<' ) ) {

	function raindrops_admin_header_style() {

		global $raindrops_page_width;
		$raindrops_options	 = get_option( "raindrops_theme_settings" );
		$css				 = $raindrops_options[ '_raindrops_indv_css' ];
		$css				 = raindrops_color_type_custom( $css );
		$background			 = get_background_image();
		$color				 = get_background_color();
		$text_color			 = get_header_textcolor();
		$page_width			 = raindrops_warehouse_clone( 'raindrops_page_width' );
		$custom_header_width = $raindrops_page_width;

		switch ( $page_width ) {
			case ( "doc" ):
				$custom_header_width = '750px';
				break;

			case ( "doc2" ):
				$custom_header_width = '950px';
				break;

			case ( "doc3" ):
				//$custom_header_width = '974px';
				$custom_header_width = '100%';
				break;

			case ( "doc4" ):
				//$custom_header_width = '100%';
				$custom_header_width = '974px';
				break;
		}

		if ( !empty( $background ) || !empty( $color ) ) {

			$css = preg_replace( "|body[^{]*{[^}]+}|", "", $css );
		}
		$css_result	 = "";
		$csses		 = explode( "\n", $css );

		foreach ( $csses as $k => $v ) {

			if ( preg_match( '!^.+(,|{)!si', $v, $regs ) ) {

				$css_result .= '#headimg ' . $regs[ 0 ] . "\n";
			} else {

				$css_result .= $v . "\n";
			}
		}
		$css_result = str_replace( array( '#headimg body', 'a:hover' ), array( '#headimg', 'a' ), $css_result );
		?>
		<style type="text/css">
			<!--
			a:hover{color:none;}
			#headimg{
				width:<?php echo $custom_header_width; ?>! important;
				position:relative;
				min-height:278px;
				background-position:0 80px;
			}
			#headimg #hd {
				overflow:hidden;
				padding:.5em 1em;
				min-height:5em;
			}
			#headimg #hd h1,
			#headimg #hd h1 a,
			#headimg #hd .h1 a,
			#headimg #hd #site-title{
				font-size:159%;
				letter-spacing: 0.05em;
				background:none;
				text-decoration:none;
			}
			#headimg #hd #site-title{
				display:inline-block! important;
				max-width:74%;
			}
			#headimg #hd #site-title a{
				color:#<?php echo $text_color; ?>! important;
			}
			#headimg #top{
				padding-bottom:5px;
				position:relative;
			}
			#headimg #site-title{
				display:inline-block! important;
				max-width:74%;
				clear:both;
				font-weight:bold;
				overflow:hidden;
				margin:.5em 0;
				font-family:"Times New Roman", Times, serif;
			}
			#headimg #site-description {
				position:absolute;
				top:10px;
				right:10px;
			}
			#headimg #access {
				display: block;
				float: left;
				margin: 0 auto;
				width:99%;
				margin-left:0.5%;
				margin-top:5px;
			}
			#headimg #access .menu,
			#headimg #access div.menu ul{
				font-family: "Helvetica Neue", Arial, Helvetica, "Nimbus Sans L", sans-serif;
			}
			#headimg #headimg .ie8 #access {
				margin-left:0;
				width:100%;
				margin-top:0;
			}
			#headimg #header-image{
				position:relative;
				min-height:198px;
			}
			#headimg #header-image p{
				position:relative;
				top:35%;
				text-align:center;
				font-size:200%;
				position:relative;
				top:35%;
				text-align:center;
				font-size:200%;
				text-shadow: 0 0 2px #fff, 0 0 2px #fff, 0 0 2px #fff, 0 0 2px #fff;
				/*filter:progid:DXImageTransform.Microsoft.Glow(  color=white,Strength=2 );*/
			}
			#headimg #site-description {
				text-align:right;
			}
			#headimg #site-description {
				max-width:24%;
			}
			#headimg #access ul ul {
				box-shadow: 0px 3px 3px rgba( 0,0,0,0.2 );
				-moz-box-shadow: 0px 3px 3px rgba( 0,0,0,0.2 );
				-webkit-box-shadow: 0px 3px 3px rgba( 0,0,0,0.2 );
			}
			#headimg .wp-caption {
				/* optional rounded corners for browsers that support it */
				-moz-border-radius: 3px;
				-khtml-border-radius: 3px;
				-webkit-border-radius: 3px;
				border-radius: 3px;
			}
			#headimg .wp-caption {
				/* optional rounded corners for browsers that support it */
				-moz-border-radius: 3px;
				-khtml-border-radius: 3px;
				-webkit-border-radius: 3px;
				border-radius: 3px;
			}
			#headimg .shadow{
				box-shadow: 7px 7px 8px #cccccc;
				-webkit-box-shadow: 7px 7px 8px #cccccc;
				-moz-box-shadow: 7px 7px 8px #cccccc;
				/*filter: progid:DXImageTransform.Microsoft.dropShadow(  color=#cccccc, offX=7, offY=7, positive=true  );zoom:1;*/
			}
			#headimg #access{
				-webkit-text-size-adjust: 120%;
			}
			<?php echo $css_result; ?>
			a, a:hover{
				background:none;
			}
			#wp-admin-bar-comments a,
			#wp-admin-bar-view-site a{
				color:#ddd! important;
			}
			span#site-title,
			#message a{
				color: #21759B! important;
			}-->
		</style>
		<?php
	}

}
/**
 *
 *
 *
 *
 */
if ( !function_exists( 'raindrops_admin_header_image' ) && version_compare( $wp_version, '4.1', '<' ) ) {

	function raindrops_admin_header_image() {

		global $raindrops_current_theme_name;
		$raindrops_header_image	 = get_header_image();
		$raindrops_header_style	 = 'style="color:#' . get_theme_mod( 'header_textcolor' ) . '"';
		$html					 = '<div id="%1$s"><div id="%2$s">';
		printf( $html, 'headimg', 'top' );
		$uploads				 = wp_upload_dir();
		$header_image_uri		 = $uploads[ 'url' ] . '/' . raindrops_warehouse_clone( 'raindrops_header_image' );
		$html					 = '<div id="%1$s" style="%2$s">';
		$exception_page_width	 = raindrops_warehouse_clone( 'raindrops_page_width' );

		if ( 'doc3' == $exception_page_width ) {

			/* doc3 fluid layout , image displayed shrink , expand */
			$add_fluid_style					 = "";
			$add_fluid_style_description_html	 = '<div style="padding:1em;position:absolute;left:520px;top:20px;background:#000;color:#fff;border:2px dashed #777"><p>' . esc_html__( 'Current theme is fluid settings', 'Raindrops' ) . '</p><p>' . esc_html__( 'image size will be shrink to fit page', 'Raindrops' ) . '</p>';
			$add_fluid_style_description_html .= '<li><a href="' . admin_url() . 'themes.php?page=raindrops_settings#raindrops-page-width" style="color:#00CCCC;">' . esc_html__( 'Theme Settings', 'Raindrops' ) . '</a></li>';
			$add_fluid_style_description_html .= '</div>';
		} else {

			$add_fluid_style					 = "";
			$add_fluid_style_description_html	 = '';
		}
		printf( $html, 'hd', raindrops_upload_image_parser( $header_image_uri, 'inline', '#hd' ) . $add_fluid_style );
		/** Site description display position
		 *
		 *
		 * Site description diaplay at image when if header text Display Text value is yes.
		 * Site description diaplay at header bar when if header text Display Text value is no.
		 *
		 *
		 */
		if ( 'blank' == get_theme_mod( 'header_textcolor' ) || '' == get_theme_mod( 'header_textcolor' ) ) {

			$raindrops_show_hide = '';
			$style				 = ' style="display:none;"';
		} elseif ( preg_match( "!([0-9a-f]{6}|[0-9a-f]{3})!si", get_header_textcolor() ) ) {

			$style				 = ' style="color:#' . get_header_textcolor() . ';"';
			$raindrops_show_hide = ' style="display:none;"';
		} else {

			$style				 = '';
			$raindrops_show_hide = ' style="display:none;"';
		}
		/**
		 * Conditional Switch html headding element
		 *
		 *
		 *
		 *
		 *
		 */
		if ( is_home() || is_front_page() ) {

			$heading_elememt = 'h1';
		} else {

			$heading_elememt = 'div';
		}
		$title_format					 = '<%s class="h1" id="site-title"><span><a href="%s" title="%s" rel="%s">%s</a></span></%s>';
		printf( $title_format, $heading_elememt, home_url(), esc_attr( get_bloginfo( 'name', 'display' ) ), "home", get_bloginfo( 'name', 'display' ), $heading_elememt );
		/**
		 * Site description diaplay at header bar when if header text Display Text value is no.
		 *
		 *
		 *
		 *
		 */
		$raindrops_site_desctiption_html = '<div id="site-description" %s>%s</div></div>';
		printf( $raindrops_site_desctiption_html, $raindrops_show_hide, get_bloginfo( 'description' ) );
		/**
		 * header image
		 *
		 *
		 *
		 *
		 *
		 */
		echo raindrops_header_image();
		echo $add_fluid_style_description_html;
	}

}
/**
 * Empty title fallback
 *
 *
 */
if ( !function_exists( 'raindrops_fallback_title' ) ) {

	function raindrops_fallback_title( $title, $id = 0 ) {

		global $post, $raindrops_link_unique_text;
		$format_label = '';

		if ( 0 == $id && is_object( $post ) ) {

			$id = $post->ID;
		}

		if ( !is_admin() ) {

			$format = get_post_format( $id );
			
			if ( false === $format ) {

				$image_uri		 = get_template_directory_uri() . '/images/link.png';
				$class			 = 'icon-link-no-title';
				$format_label	 = 'Article';
			} else {

				$image_uri	 = get_template_directory_uri() . '/images/post-format-' . $format . '.png';
				$class		 = 'icon-post-format-notitle icon-post-format-' . $format;

				if ( 'link' == $format ) {

					$add_label = ' to entry';
				} else {

					$add_label = '';
				}
				$format_label = 'Post Format ' . esc_attr( $format ) . $add_label;
			}

			$raindrops_post_thumbnail_size =  array( 48, 48 );

			if ( in_the_loop() ) {

				$raindrops_post_thumbnail_size =  apply_filters( 'raindrops_post_thumbnail_size_main_query', array( 48, 48 ), $post->ID, get_post_class( '', $post->ID ) );
			}

			$thumbnail = '';
			if (  in_the_loop()  && has_post_thumbnail( $post->ID ) && !post_password_required()  && !is_singular() ) {

				$thumbnail .= '<span class="h2-thumb">';
				$thumbnail .= get_the_post_thumbnail( $post->ID, $raindrops_post_thumbnail_size, array( "style" => "vertical-align:middle;", "alt" => null ) );
				$thumbnail .= '</span>';
			}
			if (isset( $post->ID ) && ! is_404() && !has_post_thumbnail( $post->ID ) && !is_singular() && !post_password_required() ) {

				$thumbnail =  apply_filters('raindrops_title_thumbnail', $thumbnail ,'<span class="h2-thumb">', '</span>');
			}
			if ( ! is_singular() && in_the_loop() ) {

				$raindrops_entry_title_text_allow = apply_filters( 'raindrops_entry_title_text_elements_allow', true );

				if ( true == $raindrops_entry_title_text_allow ) {

					$title =  $thumbnail. '<span class="entry-title-text">'.$title.'</span>';
				} else {

					$title =  $thumbnail. $title ;
				}
			} else {

				$title =  $thumbnail. $title;
			}

			$striped_title = wp_kses( $title,array());
			
			if ( empty( $title )  || empty( $striped_title ) ) {

				$html = $thumbnail. '<span class="' . esc_attr( $class ) . '" title="' . $format_label . '" ></span>';
				return $html;
			}
		}

		if ( isset( $post->ID ) && $raindrops_link_unique_text == true ) {
			 $title = $title. raindrops_unique_entry_title(  $post->ID );
		}

		return apply_filters( 'raindrops_fallback_title', $title );
	}

}

/**
 * for remove title html escaped from plug-ins
 * @param type $title
 * @return type
 * @since 1.276
 */
function raindrops_strip_escaped_title( $title ) {

	return preg_replace('!&lt;.*?&gt;!', '', $title );
}
/**
 *
 *
 *
 * @since 1.139
 */
///////////////////////////////////test

if ( !function_exists( 'raindrops_detect_header_image_size' ) ) {

	function raindrops_detect_header_image_size( $xy = 'width' ) {

		global $raindrops_custom_header_args;

		return  raindrops_detect_header_image_size_clone( $xy );
	}

}
/**
 * Template function print header image
 *
 * This function has filter hook name raindrops_header_image
 * @param array(  'img'=> 'image uri' , 'height' => 'image height' , 'color' => 'text color', 'style' => '( default  ) background-size:cover;' , 'description' => 'replace text from bloginfo(  description  ) to your text','description_style' => 'Your description style rule'  )
 * @return string htmlblock <div id="['header-image']" style="background-image:url( [img] );height:[height];color:#[color]][style]"><p [description_style]>[WordPress site description]</p></div>
 */
if ( !function_exists( 'raindrops_header_image' ) ) {

	function raindrops_header_image( $type = 'default', $args = array() ) {

		global $raindrops_page_width, $post, $raindrops_custom_header_height;


		$raindrops_document_width		 = $raindrops_page_width;
		$raindrops_header_image			 = get_custom_header();
		$raindrops_header_image_uri		 = $raindrops_header_image->url;
		$raindrops_header_image_width	 = apply_filters( 'raindrops_header_image_width', raindrops_detect_header_image_size( 'width' ) );
		$raindrops_header_image_height	 = apply_filters( 'raindrops_header_image_height',raindrops_detect_header_image_size( 'height' ) );
		$raindrops_restore_check		 = get_theme_mod( 'header_image', get_theme_support( 'custom-header', 'default-image' ) );
		$raindrops_field_exists_check	 = get_post_custom_values( '_raindrops_this_header_image' );

		if ( $raindrops_field_exists_check !== null ) {
			$display_header_image_file = get_post_meta( $post->ID, '_raindrops_this_header_image', true );

			if ( $display_header_image_file == 'hide' && is_singular() ) {

				return;
			}

			if ( !empty( $display_header_image_file ) && $display_header_image_file !== 'default' && is_singular() ) {

				$display_header_image_attr = wp_get_attachment_image_src( $display_header_image_file, 'full' );
				if ( ! empty( $display_header_image_attr ) ) {
					$raindrops_header_image_uri		 = $display_header_image_attr[ 0 ];
					$raindrops_header_image_width	 = $display_header_image_attr[ 1 ];
					$raindrops_header_image_height	 = $display_header_image_attr[ 2 ];
				}
			}
		}
		if ( 'remove-header' == $raindrops_restore_check ) {

			return;
		}

		if ( empty( $raindrops_header_image_uri ) ) {

			$raindrops_header_image_uri = $raindrops_restore_check;
		}

		if ( $raindrops_header_image_width > 0 && $raindrops_header_image_height > 0 ) {

			$ratio = $raindrops_header_image_height / $raindrops_header_image_width;
		} else {

			$ratio = 0;
		}
		$raindrops_width = raindrops_warehouse_clone( 'raindrops_page_width' );
		switch ( true ) {
			case 'doc' == $raindrops_width:
				$raindrops_document_width = 750;
				break;

			case 'doc2' == $raindrops_width:
				$raindrops_document_width = 950;
				break;

			case 'doc4' == $raindrops_width:
				$raindrops_document_width = 974;
				break;

			case is_numeric( $raindrops_width ):
				$raindrops_document_width = $raindrops_page_width;
				break;

			case 'doc3' == $raindrops_width:
				$raindrops_document_width = 950; //this value is fake following javascript
				break;
		}

		if ( $raindrops_header_image_width >= $raindrops_document_width ) {

			$height_current	 = round( $raindrops_document_width * $ratio ) . 'px';
			$block_style	 = 'background-size:cover;';
		} else {

			$height_current	 = round( $raindrops_header_image_height ) . 'px';
			$block_style	 = 'background-repeat:no-repeat;background-position:center;background-color:#000;background-size:auto;  background-origin:content-box;';
		}

		if ( 'doc3' == $raindrops_width ) {

			$block_style = str_replace( 'background-size:auto', 'background-size:cover', $block_style );
		}
		//w3standard can not use CSS3

		if ( 'w3standard' == raindrops_warehouse( 'raindrops_style_type' ) ) {

			$block_style = 'background-repeat:no-repeat;background-position:center;background-color:#000;';
		}

		if ( '' == get_header_image() ) {

			$height				 = 0;
			$description_style	 = ' style="display:none;"';
		}
		$defaults	 = array( 'img' => $raindrops_header_image_uri, 'height' => $height_current, 'color' => get_theme_mod( 'header_textcolor' ), 'style' => $block_style, 'text' => get_bloginfo( 'description' ), 'text_attr' => '' );
		$args		 = wp_parse_args( $args, $defaults );
		extract( $args, EXTR_SKIP );

		if ( 'blank' == get_theme_mod( 'header_textcolor' ) ) {

			$text_attr = ' style="display:none;"';
		} elseif ( preg_match( "!([0-9a-f]{6}|[0-9a-f]{3})!si", get_theme_mod( 'header_textcolor' ) ) ) {

			$add_class	 = '';
			$add_style	 = '';

			if ( preg_match( '!style!', $text_attr ) ) {

				$add_style = str_replace( array( 'style', "'", '"', '=' ), '', $text_attr );
			} else {

				$add_class = $text_attr;
			}
			$text_attr	 = ' style="color:#' . esc_attr( get_theme_mod( 'header_textcolor' ) ) . ';' . esc_attr( $add_style ) . '" ' . esc_html( $add_class );
			$text_attr	 = apply_filters( 'raindrops_header_image_description_attr', $text_attr );
		}

		if ( 'doc3' == Raindrops_warehouse_clone( "raindrops_page_width" ) ) {

			$width = 'width:100%';
			$height = apply_filters( 'raindrops_header_image_height', $raindrops_custom_header_height ). 'px';

		} else {

			$width = 'width:' . $raindrops_document_width . 'px';
		}

		if ( $type == 'default' || !isset( $type ) ) {

			$html	 = '<div id="%1$s" style="background-image:url( %2$s );%8$s;height:%3$s;color:#%4$s;%5$s"><p class="tagline" %6$s>%7$s</p></div>';
			$html	 = sprintf( $html,
								'header-image',
								esc_url( $img ),
								esc_html( $height ),
								esc_html( $color ),
								esc_html( $style ),
								htmlspecialchars( $text_attr, ENT_NOQUOTES ), esc_html( $text ), $width );

			if ( $color == 'blank' ) {

				$html = str_replace( 'color:#blank;', '', $html );
			}
			return apply_filters( "raindrops_header_image", $html );
		} elseif ( 'css' == $type ) {
			
			$old_ie = '';
			preg_match( "|(MSIE )([0-9]{1,2})(\.)|si", $_SERVER[ 'HTTP_USER_AGENT' ], $regs );
			if ( isset( $regs[ 2 ] ) ) {
				$old_ie = 'ie' . $regs[ 2 ];
			}

			$raindrops_header_imge_filter_color			 = raindrops_warehouse_clone( 'raindrops_header_image_filter_color' );
			$raindrops_header_image_color_rgb_array		 = raindrops_hex2rgb_array_clone( $raindrops_header_imge_filter_color );
			$raindrops_header_image_filter_apply_top	 = raindrops_warehouse_clone( 'raindrops_header_image_filter_apply_top' );
			$raindrops_header_image_filter_apply_bottom	 = raindrops_warehouse_clone( 'raindrops_header_image_filter_apply_bottom' );
			$raindrops_enable_header_image_filter	 = raindrops_warehouse_clone( 'raindrops_enable_header_image_filter' );
			
			
			if ( false !== $raindrops_header_image_color_rgb_array &&
				'enable' == $raindrops_enable_header_image_filter &&
				$old_ie !== 'ie8' &&
				$old_ie !== 'ie9' ) { // client side yet 1.298
				
				$style_rule_template = ' background:  
					linear-gradient(
						rgba(%1$s, %2$s, %3$s, %4$s),rgba(%1$s, %2$s, %3$s, %5$s)
					),
					url(%6$s);
					 background:  
					-moz-linear-gradient(
						rgba(%1$s, %2$s, %3$s, %4$s),rgba(%1$s, %2$s, %3$s, %5$s)
					),
					url(%6$s);
					 background-size:cover;';

				$background_property = sprintf(
				$style_rule_template, $raindrops_header_image_color_rgb_array[ 0 ], $raindrops_header_image_color_rgb_array[ 1 ], $raindrops_header_image_color_rgb_array[ 2 ], $raindrops_header_image_filter_apply_top, $raindrops_header_image_filter_apply_bottom, esc_url( $img )
				);
			} else {
				$background_property = 'background-image:url( ' . esc_url( $img ) . ' );';
			}

			$css		 = '#%1$s{%2$s%8$s;height:%3$s;color:#%4$s;%5$s}' . "\n" . '#%1$s p {%6$s}';
			$text_attr	 = str_replace( array( 'style', '=', '"', "'" ), '', $text_attr );
			$css		 = sprintf( $css, 'header-image',
							apply_filters( 'raindrops_header_image_background_image', $background_property ),
							esc_html( $height ),
							esc_html( $color ),
							apply_filters( 'raindrops_header_image_background_style', esc_html( $style ) ),
							// css needs > but this style is inline
																																																																	 htmlspecialchars( $text_attr, ENT_NOQUOTES ), // css needs > but this style is inline
																				 esc_html( $text ), $width );
			if ( $color == 'blank' ) {

				$css = str_replace( 'color:#blank;', '', $css );
			}
			return apply_filters( "raindrops_header_image_css", $css );
		} elseif ( 'elements' == $type ) {

			$elements	 = '<div id="%1$s">' . apply_filters( 'raindrops_header_image_contents', '' ) . '<p class="tagline" %3$s>%2$s</p></div>';
			$elements	 = sprintf( $elements, 'header-image', esc_html( $text ), $text_attr );
			return apply_filters( "raindrops_header_image_elements", $elements );
		} elseif ( 'home_url' == $type ) {

			$elements	 = '<a href="%3$s"><div id="%1$s">' . apply_filters( 'raindrops_header_image_contents', '' ) . '<p class="tagline"  %4$s>%2$s</p></div></a>';
			$elements	 = sprintf( $elements, 'header-image', esc_html( $text ), esc_url( home_url() ), $text_attr );
			return apply_filters( "raindrops_header_image_home_url", $elements );
		}
	}

}


/**
 * Print site description html
 *
 * This function has filter hook name raindrops_site_description
 *
 * @param array(  "text" => 'Some text' , "switch" => ' style="display:none;"'  )
 * @return string htmlblock  <div id="site-description" [input switch]>[input text]</div>
 *
 */
if ( !function_exists( 'raindrops_site_description' ) ) {

	function raindrops_site_description( $args = array() ) {

		if ( 'blank' == get_theme_mod( 'header_textcolor' ) ) {

			$raindrops_show_hide = '';
		} elseif ( preg_match( "!([0-9a-f]{6}|[0-9a-f]{3})!si", get_header_textcolor() ) ) {

			$raindrops_show_hide = ' style="display:none;"';
		} else {

			$raindrops_show_hide = ' style="display:none;"';
		}
		$defaults	 = array( 'text' => get_bloginfo( 'description' ), 'switch' => $raindrops_show_hide );
		$args		 = wp_parse_args( $args, $defaults );
		extract( $args, EXTR_SKIP );
		$html		 = '<div id="site-description" %1$s>%2$s</div>';
		$html		 = sprintf( $html, $switch, $text );
		return apply_filters( "raindrops_site_description", $html );
	}

}
/**
 * Print the site title
 *
 * This function has filter hook name raindrops_site_title(  #site-title  )
 *
 *
 * @param $text string  append to title strings
 * @return htmlblock <[h1|div] class="h1" id="site-title"><span><a href="[home url(   )]" title="[blog_info( name )]" rel="['home']" [style get_header_textcolor(   )]>[bloginfo( name )]</a></span></[h1|div]>
 */
if ( !function_exists( 'raindrops_site_title' ) ) {

	function raindrops_site_title( $text = "" ) {

		global $raindrops_document_type;

		if ( 'xhtml' == $raindrops_document_type ) {

			if ( is_home() || is_front_page() ) {

				$heading_elememt = 'h1';
			} else {

				$heading_elememt = 'div';
			}
		} else {

			$heading_elememt = 'h1';
		}
		$header_text_color = get_theme_mod( 'header_textcolor' );


		// check hex value if ( 'blank' == $header_text_color || '' == $header_text_color )

			if ( preg_match('|^([A-Fa-f0-9]{3}){1,2}$|', $header_text_color ) ) {

				$hd_style = ' style="color:#' . $header_text_color . ';"';
			} else {

				$hd_style = '';
			}

		$title_format	 = '<%1$s class="%6$s" id="site-title"><a href="%2$s" title="%3$s" rel="%4$s"><span>%5$s</span></a></%1$s>';
		$html			 = sprintf( $title_format,
									$heading_elememt,
									home_url(),
									esc_attr( 'site title ' . get_bloginfo( 'name', 'display' ) ),
									"home",
									get_bloginfo( 'name', 'display' ) . esc_html( $text ),
									apply_filters( 'raindrops_site_title_class', 'h1' )
								);
		return apply_filters( "raindrops_site_title", $html );
	}

}
/**
 * filter function for wp_title hook
 * element title
 */
if ( !function_exists( 'raindrops_filter_title' ) ) {

	function raindrops_filter_title( $title, $sep = true, $seplocation = 'right' ) {

		global $page, $paged;
		$page_info			 = '';
		$add_title			 = array();
		$site_description	 = get_bloginfo( 'description', 'display' );

		if ( !empty( $title ) ) {

			$add_title[] = str_replace( $sep, '', $title );
		}
		$add_title[] = get_bloginfo( 'name' );

		if ( !empty( $site_description ) && ( is_home() || is_front_page() ) ) {

			$add_title[] = $site_description;
		}
		// Add a page number

		if ( $paged > 1 || $page > 1 ) {

			$page_info = sprintf( esc_html__( ' Page %s', 'Raindrops' ), max( $paged, $page ) );
		}

		if ( 'right' == $seplocation ) {

			$add_title	 = array_reverse( $add_title );
			$title		 = implode( " $sep ", $add_title ) . $page_info;
		} else {

			$title = implode( " $sep ", $add_title ) . $page_info;
		}
		return $title;
	}
}
/**
 *
 *
 *
 *
 *
 */
if ( !function_exists( "raindrops_column_controller" ) ) {

	function raindrops_column_controller( $col = false ) {

		global $post;

		if( $col !== false && !is_singular() ) {
			return absint( $col );
		}

		if ( isset( $post ) ) {

			$filter_column = apply_filters( 'raindrops_column_controller', '', $post->ID );
		} else {

			$filter_column = apply_filters( 'raindrops_column_controller', '', 0 );
		}

		if( !empty( $filter_column ) && !is_int( $filter_column ) ) {
			$filter_column = false;
		}



		if ( isset( $post ) ) {

			$raindrops_content_check = get_post( $post->ID );
			$raindrops_content_check = $raindrops_content_check->post_content;
			


			if ( is_singular() && preg_match( "!\[raindrops[^\]]+(col)=(\"|')*?([^\"' ]+)(\"|')*?[^\]]*\]!si", $raindrops_content_check, $regs ) ) {

				return absint( $regs[ 3 ] );
			}


				if( ! empty( $filter_column ) ) {

					return absint( $filter_column );
				}



			if ( 'hide' == Raindrops_warehouse_clone( 'raindrops_show_right_sidebar' ) ) {

				return  2;

			} elseif ( 'show' == Raindrops_warehouse_clone( 'raindrops_show_right_sidebar' ) ) {

			return  3 ;
			}
		}

					return false;

	}

}
/**
 *
 *
 *
 *
 *
 */

if ( !function_exists( "raindrops_color_type_custom" ) ) {
	function raindrops_color_type_custom( $css ) {

		global $post;
		if ( isset( $post ) ) {

			$filter_custom_color = apply_filters( 'raindrops_color_type_custom', '', $post->ID );
		} else {

			$filter_custom_color = apply_filters( 'raindrops_color_type_custom', '', 0 );
		}

		if( !empty( $filter_custom_color )){
			/* validate value */

			$raindrops_style_type_choices	 = raindrops_register_styles( "w3standard" );

			if ( ! array_key_exists( $filter_custom_color, $raindrops_style_type_choices ) ) {

				$filter_custom_color = '';
			}

		}

		if ( isset( $post ) && is_singular()  ) {

			$raindrops_content_check = get_post( $post->ID );
			$raindrops_content_check = $raindrops_content_check->post_content;

			if ( preg_match( "!\[raindrops[^\]]+(color_type)=(\"|')*?([^\"' ]+)(\"|')*?[^\]]*\]!si", $raindrops_content_check, $regs ) ) {

				$color_type = trim( $regs[ 3 ] );

				return raindrops_design_output( $color_type ) . raindrops_color_base();
			} else {

				if ( ! empty( $filter_custom_color ) ) {

					$color_type = $filter_custom_color;

					return raindrops_design_output( $color_type ) . raindrops_color_base();
				} else {

					return $css;
				}
			}
		}elseif( intval( get_query_var( 'raindrops_color_type' ) ) == 1 && $post_id = get_query_var( 'raindrops_pid' )  )  {
//&& $raindrops_new_style_load == true
			$raindrops_content_check = get_post( $post_id );
			$raindrops_content_check = $raindrops_content_check->post_content;

			if ( preg_match( "!\[raindrops[^\]]+(color_type)=(\"|')*?([^\"' ]+)(\"|')*?[^\]]*\]!si", $raindrops_content_check, $regs ) ) {

				$color_type = trim( $regs[ 3 ] );

				return raindrops_design_output( $color_type ) . raindrops_color_base();
			} else {

				if ( ! empty( $filter_custom_color ) ) {

					$color_type = $filter_custom_color;

					return raindrops_design_output( $color_type ) . raindrops_color_base();
				} else {

					return $css;
				}
			}

		}else{
			return $css;
		}
	}
}

/**
 *
 *
 *
 *
 *
 */
if ( !function_exists( "raindrops_delete_post_link" ) ) {

	function raindrops_delete_post_link( $link_text = null, $before = '', $after = '', $id = 0, $echo = true ) {

		global $post;

		if ( RAINDROPS_SHOW_DELETE_POST_LINK !== true ) {

			return;
		}

		if ( empty( $link_text ) ) {

			$link_text = esc_html__( 'Trash', 'Raindrops' );
		}

		if ( current_user_can( 'edit_post', $post->ID ) && $url = get_delete_post_link() ) {

			$html	 = $before . '<a href="%1$s">%2$s</a>' . $after;
			$html	 = sprintf( $html, $url, $link_text );

			if ( $echo !== true ) {

				return $html;
			} else {

				echo $html;
			}
		}
	}

}
/**
 * comment reply
 *
 *
 *
 * @since 0.956
 */
if ( !function_exists( "raindrops_enqueue_comment_reply" ) ) {

	function raindrops_enqueue_comment_reply() {

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {

			wp_enqueue_script( 'comment-reply' );
		}
	}

}
//add_filter( 'the_content', 'raindrops_fallback_human_interface' );
//add_filter( 'raindrops_posted_in', 'raindrops_fallback_human_interface' );
/**
 *
 *
 *
 *
 * @since 0.958
 */
if ( !function_exists( "raindrops_fallback_human_interface" ) ) {

	function raindrops_fallback_human_interface( $content ) {

		if ( ( is_home() || is_front_page() ) && true == small_screen_check() ) {

			return;
		} else {

			return $content;
		}
	}
}
/**
 *
 *
 *
 *
 * @since 0.958
 */
if ( !function_exists( "small_screen_check" ) ) {

	function small_screen_check() {

		global $raindrops_fluid_minimum_width, $raindrops_fallback_human_interface_show;
		$size = '';

		if ( isset( $_SERVER[ 'HTTP_UA_PIXELS' ] ) && !empty( $_SERVER[ 'HTTP_UA_PIXELS' ] ) ) {

			$size = $_SERVER[ 'HTTP_UA_PIXELS' ];
		}

		if ( isset( $_SERVER[ 'HTTP_X_UP_DEVCAP_SCREENPIXELS' ] ) && !empty( $_SERVER[ 'HTTP_X_UP_DEVCAP_SCREENPIXELS' ] ) ) {

			$size = $_SERVER[ 'HTTP_X_UP_DEVCAP_SCREENPIXELS' ];
		}

		if ( isset( $_SERVER[ 'HTTP_X_JPHONE_DISPLAY' ] ) && !empty( $_SERVER[ 'HTTP_X_JPHONE_DISPLAY' ] ) ) {

			$size = $_SERVER[ 'HTTP_X_JPHONE_DISPLAY' ];
		}
		$size = preg_split( '[x,*]', $size );

		if ( true == $raindrops_fallback_human_interface_show ) {

			return true;
		}

		if ( isset( $size[ 0 ] ) && is_numeric( $size[ 0 ] ) ) {

			if ( $size[ 0 ] < $raindrops_fluid_minimum_width ) {

				return true;
			} else {

				return false;
			}
		}
		return false;
	}
}
/**
 *
 *
 *
 *
 * @since 0.958
 */

if ( !function_exists( "raindrops_fallback_user_interface_view" ) ) {

	function raindrops_fallback_user_interface_view() {

		global $raindrops_current_theme_name, $raindrops_current_data_version;

		wp_deregister_style( 'style' );

		wp_deregister_style( 'raindrops_reset_fonts_grids' );

		wp_deregister_style( 'raindrops_grids' );

		wp_deregister_style( 'raindrops_fonts' );

		wp_deregister_style( 'raindrops_css3' );

		wp_deregister_style( 'child' );

		$current_theme = $raindrops_current_theme_name;

		$fallback_style = get_template_directory_uri() . '/fallback.css';

		wp_register_style( 'fallback_style', $fallback_style, array(), $raindrops_current_data_version, 'all' );

		wp_enqueue_style( 'fallback_style' );

		add_filter( 'raindrops_indv_css', '__return_false' );

		add_filter( 'raindrops_is_fluid', '__return_false' );

		add_filter( 'raindrops_is_fixed', '__return_false' );

		add_filter( 'raindrops_embed_meta_css', '__return_false' );
	}

	if ( small_screen_check() == true ) {

		add_action( 'wp_print_styles', 'raindrops_fallback_user_interface_view', 99 );

		add_action( 'wp_head', 'raindrops_mobile_meta' );
	}
}

if ( !function_exists( 'raindrops_load_small_device_helper' ) ) {
	/**
	 *
	 * @global type $raindrops_current_data_version
	 * @global type $is_IE
	 * @global type $raindrops_fluid_maximum_width
	 * @global type $raindrops_browser_detection
	 * @global type $post
	 * @global type $template
	 * @global type $raindrops_link_unique_text
	 * @since 1.254
	 */
	function raindrops_load_small_device_helper() {

		global $raindrops_current_data_version, $is_IE, $raindrops_fluid_maximum_width, $raindrops_browser_detection, $post, $template, $raindrops_link_unique_text;
		$raindrops_header_image		 = get_custom_header();
		$raindrops_header_image_uri	 = $raindrops_header_image->url;
		$ratio						 = 0;
		if ( empty( $raindrops_header_image_uri ) ) {

			$raindrops_header_image_uri = get_header_image();
		}

		$raindrops_header_image_width	 = apply_filters( 'raindrops_header_image_width', raindrops_detect_header_image_size( 'width' ) );
		$raindrops_header_image_height	 = apply_filters( 'raindrops_header_image_height', raindrops_detect_header_image_size( 'height' ) );
		$raindrops_field_exists_check	 = get_post_custom_values( '_raindrops_this_header_image' );

		if ( $raindrops_field_exists_check !== null ) {
			$display_header_image_file = get_post_meta( $post->ID, '_raindrops_this_header_image', true );

			if ( !empty( $display_header_image_file ) && $display_header_image_file !== 'default' && is_singular() ) {

				$display_header_image_attr = wp_get_attachment_image_src( $display_header_image_file, 'full' );
				if ( ! empty( $display_header_image_attr ) ) {
					$raindrops_header_image_uri		 = $display_header_image_attr[ 0 ];
					$raindrops_header_image_width	 = $display_header_image_attr[ 1 ];
					$raindrops_header_image_height	 = $display_header_image_attr[ 2 ];
				}
			}
		}
		$raindrops_restore_check = get_theme_mod( 'header_image', get_theme_support( 'custom-header', 'default-image' ) );
		if ( $raindrops_restore_check !== 'remove-header' ) {

			if ( $raindrops_header_image_width > 0 && $raindrops_header_image_height > 0 ) {

				$ratio = $raindrops_header_image_height / $raindrops_header_image_width;
			} else {

				$ratio = 0;
			}
		}

		$raindrops_current_template = basename( $template, '.php' );


		if ( $raindrops_current_template == 'list_of_post' ) {

			$raindrops_ignore_template = true;
		} else {

			$raindrops_ignore_template = false;
		}


		if ( is_single() || is_page() ) {

			$color_type				 = '';
			$raindrops_content_check = get_post( $post->ID );
			$raindrops_content_check = $raindrops_content_check->post_content;

			if ( preg_match( "!\[raindrops[^\]]+(color_type)=(\"|')*?([^\"' ]+)(\"|' )*?[^\]]*\]!si", $raindrops_content_check, $regs ) ) {

				$color_type = "rd-type-" . trim( $regs[ 3 ] );
			}

			if ( preg_match( "!\[raindrops[^\]]+(col)=(\"|')*?([^\"' ]+)(\"|')*?[^\]]*\]!si", $raindrops_content_check, $regs ) ) {

				$color_type .= ' ';
				$color_type .= "rd-col-" . $regs[ 3 ];
			}
		}/*del1.289 else {

			$raindrops_options = get_option( "raindrops_theme_settings" );

			if ( isset( $raindrops_options[ "raindrops_style_type" ] ) && !empty( $raindrops_options[ "raindrops_style_type" ] ) ) {

			}
		}*/
		$color_type				 = '';

		if ( isset( $post->ID ) ) {

			$raindrops_content_check = get_post( $post->ID );
		}

		if ( isset( $raindrops_content_check ) ) {

			$raindrops_content_check = $raindrops_content_check->post_content;

			if ( preg_match( "!\[raindrops[^\]]+(color_type)=(\"|')*?([^\"' ]+)(\"|' )*?[^\]]*\]!si", $raindrops_content_check, $regs ) && is_singular() ) {

				$color_type = "rd-type-" . trim( $regs[ 3 ] );
			}

			if ( preg_match( "!\[raindrops[^\]]+(col)=(\"|')*?([^\"' ]+)(\"|')*?[^\]]*\]!si", $raindrops_content_check, $regs ) && is_singular() ) {

				$color_type .= ' ';
				$color_type .= "rd-col-" . $regs[ 3 ];
			}
		} else {
			/*del1.289
			$raindrops_options = get_option( "raindrops_theme_settings" );

			if ( isset( $raindrops_options[ "raindrops_style_type" ] ) && !empty( $raindrops_options[ "raindrops_style_type" ] ) ) {

				$color_type = "rd-type-" . $raindrops_options[ "raindrops_style_type" ];
			}*/
			$raindrops_style_type = raindrops_warehouse_clone( 'raindrops_style_type' );
			
			if( ! empty( $raindrops_style_type ) ) {
				
				$color_type = esc_attr( "rd-type-" . $raindrops_style_type );
			}
			
		}
		$raindrops_page_width = raindrops_warehouse_clone( 'raindrops_page_width' );

		wp_enqueue_script( 'raindrops_helper_script', get_template_directory_uri() . '/raindrops-helper.js', array( 'jquery' ),$raindrops_current_data_version, true );

		if( $raindrops_browser_detection == true ){
			$raindrops_browser_detection = 1;
		}else{
			$raindrops_browser_detection = 0;
		}
		if( is_singular() == true ) {
			$raindrops_is_singular = 1;
		}else{
			$raindrops_is_singular = 0;
		}
		if( is_single() == true ) {
			$raindrops_is_single = 1;
		}else{
			$raindrops_is_single = 0;
		}
		if( is_page() == true ) {
			$raindrops_is_page = 1;
		}else{
			$raindrops_is_page = 0;
		}




		wp_localize_script( 'raindrops_helper_script', 'raindrops_script_vars', array(
			'is_ie'					 => $is_IE,
			'fluid_maximum_width'	 => $raindrops_fluid_maximum_width,
			'browser_detection'		 => $raindrops_browser_detection ,
			'post'					 => $post,
			'template'				 => $template,
			'link_unique_text'		 => $raindrops_link_unique_text,
			'header_image_uri'		 => $raindrops_header_image_uri,
			'header_image_width'	 => $raindrops_header_image_width,
			'header_image_height'	 => $raindrops_header_image_height,
			'field_exists_check'	 => $raindrops_field_exists_check,
			'restore_check'			 => $raindrops_restore_check,
			'ratio'					 => apply_filters( 'raindrops_header_image_ratio', $ratio ),
			'current_template'		 => $raindrops_current_template,
			'ignore_template'		 => $raindrops_ignore_template,
			'is_single'				 => $raindrops_is_single,
			'is_page'				 => $raindrops_is_page,
			'is_singular'			 => $raindrops_is_singular,
			'browser_detection'		 => $raindrops_browser_detection,
			'color_type'			 => $color_type,
			'page_width'			 => $raindrops_page_width,
			'accessibility_settings' => raindrops_warehouse_clone( 'raindrops_accessibility_settings' ),
		)
		);
	}
}

/**
 *
 *
 *
 *
 *
 */
if ( !function_exists( 'raindrops_custom_width' ) ) {

	function raindrops_custom_width() {

		global $raindrops_page_width;
		$c_width				 = (int) $raindrops_page_width;
		$width					 = $c_width / 13;
		$ie_width				 = $width * 0.9759;
		return "/* test: $c_width */";
		$custom_content_width	 = '/* set custom content width start */' . '#custom-doc {margin:auto;text-align:left;' . "\n" . 'width:' . round( $width, 0 ) . 'em;' . "\n" . '*width:' . round( $ie_width, 0 ) . 'em;' . "\n" . 'min-width:' . round( $width * 0.7, 0 ) . 'em;}/* set custom content width end */';
		return apply_filters( "raindrops_custom_width", $custom_content_width );
	}

}
/**
 *
 *
 *
 *
 *
 */
if ( !function_exists( 'raindrops_is_fluid' ) ) {

	function raindrops_is_fluid() {

		global $is_IE, $raindrops_fluid_minimum_width, $raindrops_fluid_maximum_width, $raindrops_current_column, $raindrops_stylesheet_type;
		$content_width       = raindrops_content_width_clone();
		$width				 = intval( $raindrops_fluid_minimum_width );	
		$extra_sidebar_width = raindrops_warehouse_clone( 'raindrops_right_sidebar_width_percent' );
		$fluid_width		 = '';
		$page_width = raindrops_warehouse_clone( 'raindrops_page_width' );

		if ( '25' == $extra_sidebar_width ) {

			$main_column_width_fluid = 74.2;
		} elseif ( '75' == $extra_sidebar_width ) {

			$main_column_width_fluid = 24;
		} elseif ( '33' == $extra_sidebar_width ) {

			$main_column_width_fluid = 64;
		} elseif ( '66' == $extra_sidebar_width ) {

			$main_column_width_fluid = 32;
		} elseif ( '50' == $extra_sidebar_width ) {

			$main_column_width_fluid = 49;
		} else {

			$main_column_width_fluid = 100;
		}

		if ( 'show' !== raindrops_warehouse_clone( 'raindrops_show_right_sidebar' ) ) {

			$main_column_width_fluid = 100;
		}
		
		if( 'doc3' ==  $page_width ) {
		
			$fluid_width = '/* raindrops is fluid start  */' .
			"\n#doc3{min-width:" . $raindrops_fluid_minimum_width . 
			'px;max-width:' . $raindrops_fluid_maximum_width . 'px;}' . 
			"\n#container > .first{width:" . $main_column_width_fluid . "%;}" . 
			"\n#access{min-width:" . $raindrops_fluid_minimum_width . 'px;}'.
			"\n".
			".rd-pw-doc3.rd-col-1 .breadcrumbs{width:".$content_width .'px;margin:auto;}'.
			'/* raindrops is fluid end */';
		
		} elseif ( 'doc5' ==  $page_width  ) {
			
			$padding_height = 20.859375;
			$width = absint( raindrops_detect_header_image_size_clone(  'width' ) );
			$height = absint( raindrops_detect_header_image_size_clone(  'height' ) );
			
			$raindrops_full_width_limit_window_width	= raindrops_warehouse_clone( 'raindrops_full_width_limit_window_width' );
			$raindrops_full_width_max_width				= raindrops_warehouse_clone( 'raindrops_full_width_max_width' );
			
			if( $width !== 0 || $height !== 0  ) {
				$padding_height = $height / $width * 100;
			}

			if( isset( $raindrops_current_column) && 1 !== $raindrops_current_column ) {
				
			$fluid_width = '/* raindrops is fluid start  */' .
			"\n#doc5{min-width:" . $raindrops_fluid_minimum_width . 
			'px;max-width:' . $raindrops_full_width_limit_window_width . 'px;}' . 
			"\n#container > .first{width:" . $main_column_width_fluid . "%;}" . 
			"\n#access{min-width:" . $raindrops_fluid_minimum_width . 'px;}'.
			"#doc5 .front-page-top-container,
			#header-image,
			#hd,
			#access .menu-header,
			#access > .menu,
			#top ol.breadcrumbs,
			#bd,
			#ft .widget-wrapper,
			#ft address{
				max-width:{$raindrops_full_width_max_width}px;
				margin:auto;
			}

			#top > a{
				display:block;
				
			}
			#doc5 #header-image{
				display:block;
				position: relative;
				padding-bottom: {$padding_height}%;
				height: 0!important;
				max-width:100%;
			}".			
			"\n".'/* raindrops is fluid end */';
				
			} else {
				
				$fluid_width = '/* raindrops is fluid 1 column start  */'.
				"\n#doc5{
					min-width:{$raindrops_fluid_minimum_width}px;
					max-width: {$raindrops_full_width_limit_window_width}px;
					}
				#doc5 #header-image{
					display:block;
					position: relative;
					padding-bottom: {$padding_height}%;
					height: 0!important;
					max-width:100%;
				}
				.rd-pw-doc5.rd-col-1 .raindrops-expand-width{
					padding-right:0;
				}
				.rd-pw-doc5.rd-col-1 .topsidebar,
				.rd-pw-doc5.rd-col-1 .rd-tpl-image,
				.rd-pw-doc5.rd-col-1 .breadcrumbs,
				.rd-pw-doc5.rd-col-1 .wp-pagenavi,
					.rd-pw-doc5.rd-col-1 #home-tab,
					.rd-pw-doc5.rd-col-1 .bottom-sidebar-1 li,
					.rd-pw-doc5.rd-col-1 .page-template-list_of_post-php #container,
					.rd-pw-doc5.rd-col-1 .error404 .entry-content,
					.rd-pw-doc5.rd-col-1 .error404 .entry-title,
					.rd-pw-doc5.rd-col-1 .bottom-sidebar-3 ul,
					.rd-pw-doc5.rd-col-1 .bottom-sidebar-2 ul,
					.rd-pw-doc5.rd-col-1 .raindrops-toc-front,
					.rd-pw-doc5.rd-col-1 .nav-links,
					.rd-pw-doc5.rd-col-1 #access .menu,
					.rd-pw-doc5.rd-col-1 #doc3 .front-page-top-container,
					.rd-pw-doc5.rd-col-1 #hd,
					.rd-pw-doc5.rd-col-1 #access .menu-header,
					.rd-pw-doc5.rd-col-1 .page-title,
					.rd-pw-doc5.rd-col-1.page-template-date-php #doc3 .raindrops-monthly-archive-prev-next-avigation,
					.rd-pw-doc5.rd-col-1 #nav-above,
					.rd-pw-doc5.rd-col-1 #ft .widget-wrapper,
					.rd-pw-doc5.rd-col-1 #ft address{
											max-width:{$raindrops_full_width_max_width}px;
											margin:auto;
					}
					.rd-pw-doc5.rd-col-1 #ft address{
						margin:1em auto;
					}
					
				.rd-pw-doc5.rd-col-1.error404 .entry-title,
					.rd-pw-doc5.rd-col-1.archive.author main,
					.rd-pw-doc5.rd-col-1.archive .raindrops-monthly-archive-prev-next-avigation,
					.rd-pw-doc5.rd-col-1.archive .datetable,
					.rd-pw-doc5.rd-col-1 #list-of-post,
					.rd-pw-doc5.rd-col-1 .raindrops-tile-wrapper .portfolio,
					.rd-pw-doc5.rd-col-1.search .pagetitle,
					.rd-pw-doc5.rd-col-1.search .search-results article,
					.rd-pw-doc5.rd-col-1 .fail-search,
					.rd-pw-doc5.rd-col-1.tag article,
					.rd-pw-doc5.rd-col-1.page-template-date-php #doc3 .datetable,
					.rd-pw-doc5.rd-col-1.single article,
					.rd-pw-doc5.rd-col-1.page article,
					.rd-pw-doc5.rd-col-1 .loop-1  article,
					.rd-pw-doc5.rd-col-1 .loop-2  article,
					.rd-pw-doc5.rd-col-1 .loop-3  article,
					.rd-pw-doc5.rd-col-1 .loop-4  article,
					.rd-pw-doc5.rd-col-1 .loop-5  article,
					.rd-pw-doc5.rd-col-1 .loop-6  article,
					.rd-pw-doc5.rd-col-1 .loop-7  article,
					.rd-pw-doc5.rd-col-1 .loop-8  article,
					.rd-pw-doc5.rd-col-1 .loop-9  article,
					.rd-pw-doc5.rd-col-1 .loop-10 article,
					.rd-pw-doc5.rd-col-1 .loop-item-show-allways article{
										  max-width:{$raindrops_full_width_max_width}px!important;
										  margin:0 auto!important;
										  padding:2em;
					}". '/* raindrops is fluid 1 column end  */';
				
			}	
		}		
		return apply_filters( "raindrops_is_fluid", $fluid_width );
	}

}

if ( !function_exists( 'raindrops_is_fixed' ) ) {

	function raindrops_is_fixed() {

		global $is_IE, $raindrops_page_width, $raindrops_base_font_size;
		$add_ie	 = '';
		$pw		 = raindrops_warehouse_clone( "raindrops_page_width" );


		$raindrops_base_font_size = apply_filters( 'raindrops_base_font_size', $raindrops_base_font_size ); //px size

		if ( 'doc' == $pw ) {

			$width	 = 750;
			$px		 = 'max-width:' . $width . 'px;';
			$width	 = $width / $raindrops_base_font_size;
		}

		if ( 'doc2' == $pw ) {

			$width	 = 950;
			$px		 = 'max-width:' . $width . 'px;';
			$width	 = $width / $raindrops_base_font_size;
		}
		if ( 'doc4' == $pw ) {

			$width	 = 974;
			$px		 = 'max-width:' . $width . 'px;';
			$width	 = $width / $raindrops_base_font_size;
		}
		if ( 'custom-doc' == $pw ) {

			$width	 = $raindrops_page_width;
			$px		 = 'width:' . $width . 'px;';
			$width	 = $width / $raindrops_base_font_size;
		}

		$raindrops_main_width	 = raindrops_main_width();
		$raindrops_main_width	 = $raindrops_main_width / $raindrops_base_font_size;

		if ( $is_IE ) {

			$width					 = round( $width * 0.9759, 1 );
			$add_ie					 = '';
			$raindrops_main_width	 = round( $raindrops_main_width * 0.9759, 1 );
		} else {

			$width					 = round( $width, 1 );
			$raindrops_main_width	 = round( $raindrops_main_width, 1 );
		}
		$custom_fixed_width = '/* raindrops is fixed start*/' . "
			\n#" . $pw . '{margin:auto;text-align:left;' . "\n" . 'width:' . $width . 'em;' . $add_ie . $px . '}' . "\n#container{width:" . $raindrops_main_width . 'em;}/* raindrops is fixed end */';
		return apply_filters( "raindrops_is_fixed", $custom_fixed_width );
	}

}
/**
 *
 *
 *
 *
 *
 */

add_filter( 'raindrops_embed_meta_css', 'raindrops_add_gallery_css');

if ( !function_exists( 'raindrops_add_gallery_css' ) ) {

	function raindrops_add_gallery_css( $css ) {

		return $css. raindrops_gallerys();
	}

}

if ( !function_exists( 'raindrops_gallerys' ) ) {

	function raindrops_gallerys() {

		global $raindrops_document_type;

		$raindrops_gallerys = raindrops_gallerys_clone();

		if ( WP_DEBUG !== true ) {

			$raindrops_gallerys = str_replace( array( "\n", "\r", "\t", '&quot;', '--', '\"' ),
												  array( "", "", "", '"', '', '"' ),
												  $raindrops_gallerys );
		}

		return apply_filters( "raindrops_gallerys_css", $raindrops_gallerys );
	}

}
/**
 *
 *
 *
 *
 * @since 0.965
 */
if( false == $raindrops_new_customizer ) {
add_action( 'customize_register', 'raindrops_customize_register' );
}

/**
 *
 *
 *
 *
 */

if ( !function_exists( 'raindrops_customize_register' ) ) {

	function raindrops_customize_register( $wp_customize ) {

		global $raindrops_current_theme_name, $raindrops_base_setting_args, $raindrops_base_font_size, $raindrops_enable_cutomizer;

		if( true !== $raindrops_enable_cutomizer ) {
			return;
		}

		$raindrops_theme_name = wp_get_theme();

		$wp_customize->add_section( 'raindrops_theme_settings', array( 'title' => esc_html__( 'Color Scheme', 'Raindrops' ), 'priority' => 26, ) );
//////////////////////////////////
		$wp_customize->add_section( 'raindrops_theme_settings_featured',
									array( 'title' => esc_html__( 'Featured Image', 'Raindrops' ),
											'priority' => 40,
											'panel'  => 'raindrops_theme_settings_featured_panel',
											'theme_supports' => '',
											'title'          =>  esc_html__( 'Featured Image Settings', 'Raindrops' ),
											'description'    => __( 'Emphasis of new content using the Featured Image', 'Raindrops' ),
										)
								);

		$wp_customize->add_panel( 'raindrops_theme_settings_featured_panel',
									array('priority' => 40,
											'capability' => 'edit_theme_options',
											'theme_supports' => '',
											'title' => __( 'Featured Image', 'Raindrops' ),
											'description' => __( 'Emphasis of new content using the Featured Image', 'Raindrops' ),
										)
								);
		///////////////////////////
		$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_use_featured_image_emphasis]',
									array( 'default' => raindrops_warehouse_clone( 'raindrops_use_featured_image_emphasis' ),
											'type' => 'option',
											'capability' => 'edit_theme_options',
											'sanitize_callback' => 'raindrops_use_featured_image_emphasis_validate',
										)
								);
		$raindrops_featured_image_position_choices = array(  "yes" => esc_html__( "Yes", 'Raindrops' ),
															 "no" => esc_html__( "No", 'Raindrops' ),
														);
		$wp_customize->add_control( 'raindrops_use_featured_image_emphasis',
									array( 'label' => esc_html__( 'USE or Not Emphasis of new content using the Featured Image', 'Raindrops' ),
											'description' => esc_html__( 'values yes or no default No', 'Raindrops' ),
											'section' => 'raindrops_theme_settings_featured',
											'settings' => 'raindrops_theme_settings[raindrops_use_featured_image_emphasis]',
											'type' => 'radio',
											'choices' => $raindrops_featured_image_position_choices,
										) );

		///////////////////////////
		$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_featured_image_position]',
									array( 'default' => raindrops_warehouse_clone( 'raindrops_featured_image_position' ),
											'type' => 'option',
											'capability' => 'edit_theme_options',
											'sanitize_callback' => 'raindrops_featured_image_position_validate',
										)
								);
		$raindrops_featured_image_position_choices = array(  "front" => esc_html__( "In front of Title", 'Raindrops' ),
															 "left" => esc_html__( "Left of Article", 'Raindrops' ),
														);
		$wp_customize->add_control( 'raindrops_featured_image_position',
									array( 'label' => esc_html__( 'Featured Image Position', 'Raindrops' ),
											'description' => esc_html__( 'Loop Pages Layout of Featured Image', 'Raindrops' ),
											'section' => 'raindrops_theme_settings_featured',
											'settings' => 'raindrops_theme_settings[raindrops_featured_image_position]',
											'type' => 'radio',
											'choices' => $raindrops_featured_image_position_choices,
										) );

		////////////////////////////////
		$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_featured_image_size]',
									array( 'default' => raindrops_warehouse_clone( 'raindrops_featured_image_size' ),
											'type' => 'option',
											'capability' => 'edit_theme_options',
											'sanitize_callback' => 'raindrops_featured_image_size_validate'
										)
								);

		$raindrops_featured_image_size_array   = get_intermediate_image_sizes();
		$raindrops_featured_image_size_choices = array();

		foreach( $raindrops_featured_image_size_array as $key=>$val) {

			$raindrops_featured_image_size_choices[ $val ] = ucfirst( $val );
		}

		$wp_customize->add_control( 'raindrops_featured_image_size',
									array( 'label' => esc_html__( 'Featured Image Size', 'Raindrops' ),
										'description' => esc_html__( 'values thumbnail, medium, large etc', 'Raindrops' ),
											'section' => 'raindrops_theme_settings_featured',
											'settings' => 'raindrops_theme_settings[raindrops_featured_image_size]',
											'type' => 'radio',
											'choices' => $raindrops_featured_image_size_choices,
										) );
		///////////////////////////////////////
		$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_featured_image_recent_post_count]',
									array( 'default' => raindrops_warehouse_clone( 'raindrops_featured_image_recent_post_count' ),
											'type' => 'option',
											'capability' => 'edit_theme_options',
											'sanitize_callback' => 'raindrops_featured_image_recent_post_count_validate'
										)
								);
		$raindrops_featured_image_post_max = get_option('posts_per_page');
		$wp_customize->add_control( 'raindrops_featured_image_recent_post_count',
									array( 'label' => esc_html__( 'Featured Image Special Layout Apply Post Count', 'Raindrops' ),
										'description' => esc_html__( 'Input Possible values are 1 - ', 'Raindrops' ).
														$raindrops_featured_image_post_max.
														esc_html__(' default value 3', 'Raindrops' ),
											'section' => 'raindrops_theme_settings_featured',
											'settings' => 'raindrops_theme_settings[raindrops_featured_image_recent_post_count]',
											'type' => 'text',

										) );
		////////////////////////////////////////
		$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_featured_image_singular]',
									array( 'default' => raindrops_warehouse_clone( 'raindrops_featured_image_singular' ),
											'type' => 'option',
											'capability' => 'edit_theme_options',
											'sanitize_callback' => 'raindrops_featured_image_singular_validate'
										)
								);
		$raindrops_featured_image_singular_choices = array(  "show" => esc_html__( "Show", 'Raindrops' ),
														 "hide" => esc_html__( "Hide", 'Raindrops' ),
														 "lightbox" => esc_html__( "Light Box", 'Raindrops' ),
														);
		$wp_customize->add_control( 'raindrops_featured_image_singular',
									array( 'label' =>  esc_html__( 'Singular ( post, page )', 'Raindrops' ),
										'description' => esc_html__( 'Featured Image Show, Hide or Lightbox on Singular Post,Page. default Show', 'Raindrops' ),
											'section' => 'raindrops_theme_settings_featured',
											'settings' => 'raindrops_theme_settings[raindrops_featured_image_singular]',
											'type' => 'radio',
											'choices' => $raindrops_featured_image_singular_choices,
										) );

		$wp_customize->add_section( 'raindrops_theme_settings_sidebar', array( 'title' => esc_html__( 'Sidebars', 'Raindrops' ), 'priority' => 27, ) );
		$wp_customize->add_section( 'raindrops_theme_settings_fonts', array( 'title' => esc_html__( 'Fonts', 'Raindrops' ), 'priority' => 28, ) );
		$wp_customize->add_section( 'raindrops_theme_settings_document', array( 'title' => esc_html__( 'Document', 'Raindrops' ), 'priority' => 25, ) );
		$wp_customize->add_section( 'raindrops_theme_settings_content', array( 'title' => esc_html__( 'Post Content Types', 'Raindrops' ), 'priority' => 29, ) );
		$wp_customize->add_section( 'raindrops_theme_settings_plugins', array( 'title' => esc_html__( 'Recommend Plugins Presentation', 'Raindrops' ), 'priority' => 30, ) );
		$wp_customize->add_section( 'raindrops_theme_settings_uninstall', array( 'title' => esc_html__( 'Uninstall Option', 'Raindrops' ), 'priority' => 99, ) );
		$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_style_type]', array( 'default' => raindrops_warehouse_clone( 'raindrops_style_type' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'raindrops_style_type_validate' ) );

		$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_japanese_date]',
									array( 'default' => raindrops_warehouse_clone( 'raindrops_japanese_date' ),
											'type' => 'option', 'capability' => 'edit_theme_options',
											'sanitize_callback' => 'raindrops_japanese_date_validate' ) );

		$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_page_width]', array( 'default' => raindrops_warehouse_clone( 'raindrops_page_width' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'raindrops_page_width_validate' ) );

		$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_base_color]', array( 'default' => raindrops_warehouse_clone( 'raindrops_base_color' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'raindrops_base_color_validate' ) );

		$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_show_right_sidebar]', array( 'default' => raindrops_warehouse_clone( 'raindrops_show_right_sidebar' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'raindrops_show_right_sidebar_validate' ) );

		$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_col_width]', array( 'default' => raindrops_warehouse_clone( 'raindrops_col_width' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'raindrops_col_width_validate' ) );

		$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_show_menu_primary]', array( 'default' => raindrops_warehouse_clone( 'raindrops_show_menu_primary' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'raindrops_show_menu_primary_validate' ) );

		$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_default_fonts_color]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'raindrops_default_fonts_color_validate' ) );

		$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_hyperlink_color]', array( 'default' => '', 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'raindrops_hyperlink_color_validate' ) );

		$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_complementary_color_for_title_link]', array( 'default'			 => raindrops_warehouse_clone( 'raindrops_complementary_color_for_title_link' ),
			'type'				 => 'option', 'capability'		 => 'edit_theme_options', 'sanitize_callback'	 => 'raindrops_complementary_color_for_title_link_validate' ) );

		$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_doc_type_settings]', array( 'default' => raindrops_warehouse_clone( 'raindrops_doc_type_settings' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'raindrops_doc_type_settings_validate' ) );

		$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_footer_color]', array( 'default' => raindrops_warehouse_clone( 'raindrops_footer_color' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'raindrops_footer_color_validate' ) );

		$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_accessibility_settings]', array( 'default' => raindrops_warehouse_clone( 'raindrops_accessibility_settings' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'raindrops_accessibility_settings_validate' ) );

		$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_plugin_presentation_bcn_nav_menu]',
				array( 'default' => raindrops_warehouse_clone( 'raindrops_plugin_presentation_bcn_nav_menu' ),
					'type' => 'option', 'capability' => 'edit_theme_options',
					'sanitize_callback' => 'raindrops_plugin_presentation_bcn_nav_menu_validate'
					) );
		$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_plugin_presentation_wp_pagenav]',
				array( 'default' => raindrops_warehouse_clone( 'raindrops_plugin_presentation_wp_pagenav' ),
					'type' => 'option', 'capability' => 'edit_theme_options',
					'sanitize_callback' => 'raindrops_plugin_presentation_wp_pagenav_validate'
					) );
		$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_plugin_presentation_meta_slider]',
				array( 'default' => raindrops_warehouse_clone( 'raindrops_plugin_presentation_meta_slider' ),
					'type' => 'option', 'capability' => 'edit_theme_options',
					'sanitize_callback' => 'raindrops_plugin_presentation_meta_slider_validate'
					) );
		$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_plugin_presentation_the_events_calendar]',
				array( 'default' => raindrops_warehouse_clone( 'raindrops_plugin_presentation_the_events_calendar' ),
					'type' => 'option', 'capability' => 'edit_theme_options',
					'sanitize_callback' => 'raindrops_plugin_presentation_the_events_calendar_validate'
					) );

		if ( RAINDROPS_USE_LIST_EXCERPT !== false ) {

			$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_entry_content_is_home]', array( 'default' => raindrops_warehouse_clone( 'raindrops_entry_content_is_home' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'raindrops_entry_content_is_home_validate' ) );
			//$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_entry_content_is_category]', array( 'default' => raindrops_warehouse_clone( 'raindrops_entry_content_is_category' ), 'type' => 'option', 'capability' => 'edit_theme_options',  ) );
			$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_entry_content_is_category]', array( 'default' => raindrops_warehouse_clone( 'raindrops_entry_content_is_category' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'raindrops_entry_content_is_category_validate' ) );
			//$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_entry_content_is_search]', array( 'default' => raindrops_warehouse_clone( 'raindrops_entry_content_is_search' ), 'type' => 'option', 'capability' => 'edit_theme_options', ) );
			$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_entry_content_is_search]', array( 'default' => raindrops_warehouse_clone( 'raindrops_entry_content_is_search' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'raindrops_entry_content_is_search_validate' ) );
		}
		//$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_footer_link_color]', array( 'default' => raindrops_warehouse_clone( 'raindrops_footer_link_color' ), 'type' => 'option', 'capability' => 'edit_theme_options', ) );
		$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_footer_link_color]', array( 'default' => raindrops_warehouse_clone( 'raindrops_footer_link_color' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'raindrops_footer_link_color_validate' ) );

		$raindrops_font_max_size = 20;

		if ( isset( $raindrops_base_font_size ) ) {

			$raindrops_basefont_default_val = absint( $raindrops_base_font_size );

			$raindrops_basefont_size = array();

			for ( $i = $raindrops_basefont_default_val; $i < $raindrops_font_max_size + 1; $i++ ) {

				$font_size_key								 = "{$i}px";
				$raindrops_basefont_size[ $font_size_key ]	 = $i;
			}
		} else {

			$raindrops_basefont_default_val = raindrops_warehouse_clone( 'raindrops_basefont_settings' );

			$raindrops_basefont_size = array();

			for ( $i = 13; $i < $raindrops_font_max_size + 1; $i++ ) {

				$font_size_key								 = "{$i}px";
				$raindrops_basefont_size[ $font_size_key ]	 = $i;
			}
		}

		$raindrops_style_type_choices	 = raindrops_register_styles( "w3standard" );
		$raindrops_col_width			 = array( esc_html__( "left 160px", 'Raindrops' ) => "t1", esc_html__( "left 180px", 'Raindrops' ) => "t2", esc_html__( "left 300px", 'Raindrops' ) => "t3", esc_html__( "right 180px", 'Raindrops' ) => "t4", esc_html__( "right 240px", 'Raindrops' ) => "t5", esc_html__( "right 300px", 'Raindrops' ) => "t6" );
		$raindrops_extra_col_width		 = array( esc_html__( "25%", 'Raindrops' ) => "25", esc_html__( "33%", 'Raindrops' ) => "33", esc_html__( "50%", 'Raindrops' ) => "50", esc_html__( "66%", 'Raindrops' ) => "66", esc_html__( "75%", 'Raindrops' ) => "75" );


		$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_basefont_settings]', array( 'default' => $raindrops_basefont_default_val, 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'raindrops_basefont_settings_validate' ) );
		$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_right_sidebar_width_percent]', array( 'default' => raindrops_warehouse_clone( 'raindrops_right_sidebar_width_percent' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'raindrops_right_sidebar_width_percent_validate' ) );
		$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_fluid_max_width]', array( 'default' => raindrops_warehouse_clone( 'raindrops_fluid_max_width' ), 'type' => 'option', 'capability' => 'edit_theme_options', 'sanitize_callback' => 'raindrops_fluid_max_width_validate' ) );
		$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_disable_keyboard_focus]',
			array( 'default' => raindrops_warehouse_clone( 'raindrops_disable_keyboard_focus' ),
					'type' => 'option',
					'capability' => 'edit_theme_options',
					'sanitize_callback' => 'raindrops_disable_keyboard_focus_validate' ) );

		$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_sync_style_for_tinymce]',
						array( 'default' => raindrops_warehouse_clone( 'raindrops_sync_style_for_tinymce' ),
								'type' => 'option',
								'capability' => 'edit_theme_options', 'sanitize_callback' => 'raindrops_sync_style_for_tinymce_validate'
							)
					);
		$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_uninstall_option]',
						array( 'default' => raindrops_warehouse_clone( 'raindrops_uninstall_option' ),
								'type' => 'option',
								'capability' => 'edit_theme_options', 'sanitize_callback' => 'raindrops_uninstall_option_validate'
							)
					);
		$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_menu_primary_font_size]',
						array( 'default' => raindrops_warehouse_clone( 'raindrops_menu_primary_font_size' ),
								'type' => 'option',
								'capability' => 'edit_theme_options', 'sanitize_callback' => 'raindrops_menu_primary_font_size_validate'
							)
					);
		$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_menu_primary_min_width]',
						array( 'default' => raindrops_warehouse_clone( 'raindrops_menu_primary_min_width' ),
								'type' => 'option',
								'capability' => 'edit_theme_options', 'sanitize_callback' => 'raindrops_menu_primary_min_width_validate'
							)
					);
//////////////////////////
				$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_excerpt_enable]',
						array( 'default' => raindrops_warehouse_clone( 'raindrops_excerpt_enable' ),
								'type' => 'option',
								'capability' => 'edit_theme_options', 'sanitize_callback' => 'raindrops_excerpt_enable_validate'
							)
					);

				/////////////////////
				$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_allow_oembed_excerpt_view]',
						array( 'default' => raindrops_warehouse_clone( 'raindrops_allow_oembed_excerpt_view' ),
								'type' => 'option',
								'capability' => 'edit_theme_options', 'sanitize_callback' => 'raindrops_allow_oembed_excerpt_view_validate'
							)
					);

				////////////////
				$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_read_more_after_excerpt]',
						array( 'default' => raindrops_warehouse_clone( 'raindrops_read_more_after_excerpt' ),
								'type' => 'option',
								'capability' => 'edit_theme_options', 'sanitize_callback' => 'raindrops_read_more_after_excerpt_validate'
							)
					);

////////////////////////////


		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'raindrops_base_color', array( 'label' => esc_html__( 'Base color', 'Raindrops' ), 'section' => 'raindrops_theme_settings', 'settings' => 'raindrops_theme_settings[raindrops_base_color]' ) ) );
		$wp_customize->add_control( 'raindrops_style_type', array( 'label' => esc_html__( 'Color Type', 'Raindrops' ), 'section' => 'raindrops_theme_settings', 'settings' => 'raindrops_theme_settings[raindrops_style_type]', 'type' => 'radio', 'choices' => $raindrops_style_type_choices, ) );

		$wp_customize->add_control( 'raindrops_doc_type_settings', array( 'label' => esc_html__( 'Document Type Definition', 'Raindrops' ), 'section' => 'raindrops_theme_settings_document', 'settings' => 'raindrops_theme_settings[raindrops_doc_type_settings]', 'type' => 'radio', 'choices' => array( 'html5' => 'HTML5', 'xhtml' => 'XHTML1.0', ), ) );
		$wp_customize->add_control( 'raindrops_accessibility_settings', array( 'label' => esc_html__( 'Force Unique Link Text', 'Raindrops' ), 'section' => 'raindrops_theme_settings_document', 'settings' => 'raindrops_theme_settings[raindrops_accessibility_settings]', 'type' => 'radio', 'choices' => array( 'no' => 'No', 'yes' => 'Yes', ), ) );
		$wp_customize->add_control( 'raindrops_page_width', array( 'label' => esc_html__( 'Document Width', 'Raindrops' ), 'section' => 'raindrops_theme_settings_document', 'settings' => 'raindrops_theme_settings[raindrops_page_width]', 'type' => 'radio', 'choices' => array( 'doc' => esc_html__( '750px Fixed Layout', 'Raindrops' ), 'doc2' => esc_html__( '950px Fixed Layout', 'Raindrops' ), 'doc3' => esc_html__( 'Fluid Responsive Layout', 'Raindrops' ), 'doc4' => esc_html( '974px Fixed Layout', 'Raindrops' ), ), ) );



		$wp_customize->add_control( 'raindrops_col_width',
			array( 'label'		 => esc_html__( 'Default Sidebar', 'Raindrops' ),
					'section'	 => 'raindrops_theme_settings_sidebar',
					'settings'	 => 'raindrops_theme_settings[raindrops_col_width]',
					'type'		 => 'radio',
					'choices'	 => array_flip( $raindrops_col_width
					),
				) );

		$wp_customize->add_control( 'raindrops_disable_keyboard_focus',
			array( 'label' => esc_html__( 'Disable Keyboad Focus', 'Raindrops' ),
					'section' => 'raindrops_theme_settings_document',
					'settings' => 'raindrops_theme_settings[raindrops_disable_keyboard_focus]',
					'type' => 'radio',
					'choices' => array(
									'disable' => esc_html__( 'Disable', 'Raindrops' ),
									'enable' => esc_html__( 'Enable', 'Raindrops' ),
									 ),
				) );
		$wp_customize->add_control( 'raindrops_show_right_sidebar',
						array( 'label'		 => esc_html__( 'Display Extra Sidebar', 'Raindrops' ),
							'section'	 => 'raindrops_theme_settings_sidebar',
							'settings'	 => 'raindrops_theme_settings[raindrops_show_right_sidebar]',
							'type'		 => 'radio', 'choices'	 => array( 'show' => esc_html__( 'Show', 'Raindrops' ), 'hide' => esc_html__( 'Hide', 'Raindrops' ), ), ) );
		$wp_customize->add_control( 'raindrops_right_sidebar_width_percent',
						array( 'label'		 => esc_html__( 'Extra Sidebar Width', 'Raindrops' ),
							'section'	 => 'raindrops_theme_settings_sidebar',
							'settings'	 => 'raindrops_theme_settings[raindrops_right_sidebar_width_percent]',
							'type'		 => 'radio',
							'choices'	 => array_flip( $raindrops_extra_col_width ), ) );
		$wp_customize->add_control( 'raindrops_show_menu_primary', array( 'label' => esc_html__( 'Display hide', 'Raindrops' ), 'section' => 'nav', 'settings' => 'raindrops_theme_settings[raindrops_show_menu_primary]', 'type' => 'radio', 'choices' => array( 'show' => 'Show', 'hide' => 'Hide', ), ) );
		$wp_customize->add_control( 'raindrops_fluid_max_width', array( 'label' => esc_html__( 'Fluid  Max Width (px)', 'Raindrops' ), 'section' => 'raindrops_theme_settings_document', 'settings' => 'raindrops_theme_settings[raindrops_fluid_max_width]', 'type' => 'text', ) );

		if ( RAINDROPS_USE_LIST_EXCERPT !== false ) {
			$wp_customize->add_control( 'raindrops_entry_content_is_home', array( 'label' => esc_html__( 'Home Listed Entry Contents', 'Raindrops' ), 'section' => 'raindrops_theme_settings_content', 'settings' => 'raindrops_theme_settings[raindrops_entry_content_is_home]', 'type' => 'radio', 'choices' => array( 'content' => esc_html__( 'Show Content', 'Raindrops' ), 'excerpt' => esc_html__( 'Show Excerpt', 'Raindrops' ), 'none' => esc_html__( 'Hide', 'Raindrops' ), ) ) );
			$wp_customize->add_control( 'raindrops_entry_content_is_category', array( 'label' => esc_html__( 'Category Archives Entry Contents', 'Raindrops' ), 'section' => 'raindrops_theme_settings_content', 'settings' => 'raindrops_theme_settings[raindrops_entry_content_is_category]', 'type' => 'radio', 'choices' => array( 'content' => esc_html__( 'Show Content', 'Raindrops' ), 'excerpt' => esc_html__( 'Show Excerpt', 'Raindrops' ), 'none' => esc_html__( 'Hide', 'Raindrops' ), ) ) );
			$wp_customize->add_control( 'raindrops_entry_content_is_search', array( 'label' => esc_html__( 'Search Result Entry Contents', 'Raindrops' ), 'section' => 'raindrops_theme_settings_content', 'settings' => 'raindrops_theme_settings[raindrops_entry_content_is_search]', 'type' => 'radio', 'choices' => array( 'content' => esc_html__( 'Show Content', 'Raindrops' ), 'excerpt' => esc_html__( 'Show Excerpt', 'Raindrops' ), 'none' => esc_html__( 'Hide', 'Raindrops' ), ) ) );
			$wp_customize->add_control( 'raindrops_allow_oembed_excerpt_view',
						array( 'label' => esc_html__( 'Allow Oembed in Excerpt', 'Raindrops' ),
							'section' => 'raindrops_theme_settings_content',
							'settings' => 'raindrops_theme_settings[raindrops_allow_oembed_excerpt_view]',
							'type' => 'radio',
							'choices' => array( 'no' => esc_html__( 'No', 'Raindrops' ),
												'yes' => esc_html__( 'Yes', 'Raindrops' ), ), ) );
			$wp_customize->add_control( 'raindrops_excerpt_enable',
						array( 'label' => esc_html__( 'Excerpt Type', 'Raindrops' ),
							'section' => 'raindrops_theme_settings_content',
							'settings' => 'raindrops_theme_settings[raindrops_excerpt_enable]',
							'type' => 'radio',
							'choices' => array( 'no' => esc_html__( 'WordPress Excerpt', 'Raindrops' ),
												'yes' => esc_html__( 'HTML in Excerpt', 'Raindrops' ), ), ) );
			$wp_customize->add_control( 'raindrops_read_more_after_excerpt',
						array( 'label' => esc_html__( 'Add More Link After Excerpt', 'Raindrops' ),
							'section' => 'raindrops_theme_settings_content',
							'settings' => 'raindrops_theme_settings[raindrops_read_more_after_excerpt]',
							'type' => 'radio',
							'choices' => array( 'no' => esc_html__( 'No', 'Raindrops' ),
												'yes' => esc_html__( 'Yes', 'Raindrops' ), ), ) );
		}
		/*
		 * font color
		 */
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'raindrops_default_fonts_color2', array( 'label' => esc_html__( 'Font Color', 'Raindrops' ), 'section' => 'colors', 'settings' => 'raindrops_theme_settings[raindrops_default_fonts_color]' ) ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'raindrops_footer_color2', array( 'label' => esc_html__( 'Footer Font Color', 'Raindrops' ), 'section' => 'colors', 'settings' => 'raindrops_theme_settings[raindrops_footer_color]' ) ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'raindrops_footer_link_color2', array( 'label' => esc_html__( 'Footer Link Color', 'Raindrops' ), 'section' => 'colors', 'settings' => 'raindrops_theme_settings[raindrops_footer_link_color]' ) ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'raindrops_hyperlink_color2', array( 'label' => esc_html__( 'Link Color', 'Raindrops' ), 'section' => 'colors', 'settings' => 'raindrops_theme_settings[raindrops_hyperlink_color]' ) ) );

		$wp_customize->add_control( 'raindrops_complementary_color_for_title_link2', array( 'label'		 => esc_html__( 'Complementary Link Color For Entry Title', 'Raindrops' ),
			'section'	 => 'colors',
			'settings'	 => 'raindrops_theme_settings[raindrops_complementary_color_for_title_link]',
			'type'		 => 'radio',
			'choices'	 => array( 'yes' => 'Yes', 'no' => 'no' ), ) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'raindrops_default_fonts_color', array( 'label' => esc_html__( 'Font Color', 'Raindrops' ), 'section' => 'raindrops_theme_settings_fonts', 'settings' => 'raindrops_theme_settings[raindrops_default_fonts_color]' ) ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'raindrops_hyperlink_color', array( 'label' => esc_html__( 'Link Color', 'Raindrops' ), 'section' => 'raindrops_theme_settings_fonts', 'settings' => 'raindrops_theme_settings[raindrops_hyperlink_color]' ) ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'raindrops_footer_color', array( 'label' => esc_html__( 'Footer Font Color', 'Raindrops' ), 'section' => 'raindrops_theme_settings_fonts', 'settings' => 'raindrops_theme_settings[raindrops_footer_color]' ) ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'raindrops_footer_link_color', array( 'label' => esc_html__( 'Footer Link Color', 'Raindrops' ), 'section' => 'raindrops_theme_settings_fonts', 'settings' => 'raindrops_theme_settings[raindrops_footer_link_color]' ) ) );

		$wp_customize->add_control( 'raindrops_complementary_linkcolor_for_title_link', array( 'label'		 => esc_html__( 'Complementary Link Color For Entry Title', 'Raindrops' ),
			'section'	 => 'raindrops_theme_settings_fonts',
			'settings'	 => 'raindrops_theme_settings[raindrops_complementary_color_for_title_link]',
			'type'		 => 'radio',
			'choices'	 => array( 'yes' => 'Yes', 'no' => 'no' ), ) );

		$wp_customize->add_control( 'raindrops_basefont_settings', array( 'label'		 => esc_html__( 'Base Font Size', 'Raindrops' ),
			'section'	 => 'raindrops_theme_settings_fonts',
			'settings'	 => 'raindrops_theme_settings[raindrops_basefont_settings]',
			'type'		 => 'radio',
			'choices'	 => array_flip( $raindrops_basefont_size ), ) );


		if ( 'yes' == get_theme_mod( 'raindrops_breadcrumb_navxt_status' ) ) {

			$wp_customize->add_control( 'raindrops_plugin_presentation_bcn_nav_menu', array(
				'label'		 => esc_html__( 'Breadcrumb NavXT Automatic Presentation', 'Raindrops' ),
				'section'	 => 'raindrops_theme_settings_plugins',
				'settings'	 => 'raindrops_theme_settings[raindrops_plugin_presentation_bcn_nav_menu]',
				'type'		 => 'radio',
				'choices'	 => array( 'yes' => 'Yes', 'none' => 'no' ), ) );
		}

		if ( 'yes' == get_theme_mod( 'raindrops_wp_pagenavi_status'  ) ) {

			$wp_customize->add_control( 'raindrops_plugin_presentation_wp_pagenav', array(
				'label'		 => esc_html__( 'WP PageNavi Automatic Presentation', 'Raindrops' ),
				'section'	 => 'raindrops_theme_settings_plugins',
				'settings'	 => 'raindrops_theme_settings[raindrops_plugin_presentation_wp_pagenav]',
				'type'		 => 'radio',
				'choices'	 => array( 'yes' => 'Yes', 'none' => 'no' ), ) );
		}
		if ( 'yes' == get_theme_mod( 'raindrops_ml_slider_status'  ) ) {

			$wp_customize->add_control( 'raindrops_plugin_presentation_meta_slider', array(
				'label'		 => esc_html__( 'Meta Slider ID for HomePage', 'Raindrops' ),
				'section'	 => 'raindrops_theme_settings_plugins',
				'settings'	 => 'raindrops_theme_settings[raindrops_plugin_presentation_meta_slider]',
				'type'		 => 'text', ) );
		}
		if ( 'yes' == get_theme_mod( 'raindrops_the_events_calendar_status'  ) ) {

			$wp_customize->add_control( 'raindrops_plugin_presentation_the_events_calendar', array(
				'label'		 => esc_html__( 'The Events Calendar Automatic Presentation', 'Raindrops' ),
				'section'	 => 'raindrops_theme_settings_plugins',
				'settings'	 => 'raindrops_theme_settings[raindrops_plugin_presentation_the_events_calendar]',
				'type'		 => 'radio',
				'choices'	 => array( 'yes' => 'Yes', 'none' => 'no' ), ) );
		}
		$wp_customize->add_control( 'raindrops_sync_style_for_tinymce',
						array(
							'label'		 => esc_html__( 'Synchronize Style for Visual Editor', 'Raindrops' ),
							'section'	 => 'raindrops_theme_settings',
							'settings'	 => 'raindrops_theme_settings[raindrops_sync_style_for_tinymce]',
							'type'		 => 'radio',
							'choices'	 => array( 'yes' => 'Yes', 'none' => 'No' ),
							)
					);
		$wp_customize->add_control( 'raindrops_uninstall_option',
						array(
							'label'		 => esc_html__( 'Delete all Theme Settings when Switch Theme', 'Raindrops' ),
							'section'	 => 'raindrops_theme_settings_uninstall',
							'settings'	 => 'raindrops_theme_settings[raindrops_uninstall_option]',
							'type'		 => 'radio',
							'choices'	 => array( 'keep' => 'Keep', 'delete' => 'Delete All' ),
							'description' => '<strong style="color:red">'. esc_html__( 'The deleted data can not be restored', 'Raindrops' ). '</strong>',
							)
					);
		$wp_customize->add_control( 'raindrops_menu_primary_font_size',
						array(
							'label'		 => esc_html__( 'Menu Primary Font Size', 'Raindrops' ),
							'section'	 => 'nav',
							'settings'	 => 'raindrops_theme_settings[raindrops_menu_primary_font_size]',
							'type'		 => 'text',
							'description' => '<p>'. esc_html__( 'Menu Primary Font Size. default value is 100( % ). set font size between 77 and 182', 'Raindrops' ). '</p>',
							)
					);
////////////////////////////////////
		$wp_customize->add_control( 'raindrops_menu_primary_min_width',
						array(
							'label'		 => esc_html__( 'Menu Primary Min Width', 'Raindrops' ),
							'section'	 => 'nav',
							'settings'	 => 'raindrops_theme_settings[raindrops_menu_primary_min_width]',
							'type'		 => 'text',
							'description' => '<p>'. esc_html__( 'Menu Primary Width. default value is 10 ( em ). set 1 between 95.999', 'Raindrops' ). '</p>',
							)
					);
		if ( get_locale() == 'ja' ) {
			$wp_customize->add_control( 'raindrops_japanese_date',
									array( 'label' => esc_html__( 'USE or Not Japanese Date', 'Raindrops' ),
											'section' => 'raindrops_theme_settings_document',
											'settings' => 'raindrops_theme_settings[raindrops_japanese_date]',
											'type' => 'radio',
											'choices' => array(
															'yes' => esc_html__( 'Yes', 'Raindrops' ),
															'no' => esc_html__( 'No', 'Raindrops' ),
											),
										) );
		}
/////////////////////////////////////
		//raindrops_plugin_presentation_the_events_calendar
		/* Label change 'Display Header Text' */
		$wp_customize->add_control( 'display_header_text', array(
			'settings'	 => 'header_textcolor',
			'label'		 => __( 'Move Tagline Position from top right to header image', 'Raindrops' ),
			'section'	 => 'title_tagline',
			'type'		 => 'checkbox',
		) );

	/////////////////////////////

		$place_of_site_title_setting = raindrops_warehouse_clone( 'raindrops_place_of_site_title' );
		if( get_header_image() !== false ||  $place_of_site_title_setting == 'header_image' ) {
			$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_place_of_site_title]',
							array( 'default' => raindrops_warehouse_clone( 'raindrops_place_of_site_title' ),
									'type' => 'option',
									'capability' => 'edit_theme_options', 'sanitize_callback' => 'raindrops_place_of_site_title_validate'
								)
					);

			$wp_customize->add_control( 'raindrops_place_of_site_title',
							array( 'label' => esc_html__( 'Place of the Title', 'Raindrops' ),
									'section' => 'title_tagline',
									'settings' => 'raindrops_theme_settings[raindrops_place_of_site_title]',
									'type' => 'radio',
									'choices' => array(
													'above' => esc_html__( 'Above the header image', 'Raindrops' ),
													'header_image' => esc_html__( 'In the header image', 'Raindrops' ),
									),
								) );
			$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_site_title_left_margin]',
							array( 'default' => raindrops_warehouse_clone( 'raindrops_site_title_left_margin' ),
									'type' => 'option',
									'capability' => 'edit_theme_options', 'sanitize_callback' => 'raindrops_site_title_left_margin_validate'
								)
					);
			$wp_customize->add_control( 'raindrops_site_title_left_margin',
							array(
								'label'		 => esc_html__( 'Left Margin in the header image', 'Raindrops' ),
								'section'	 => 'title_tagline',
								'settings'	 => 'raindrops_theme_settings[raindrops_site_title_left_margin]',
								'type'		 => 'text',
								'description' => '<p>'. esc_html__( ' default value is 1. set 0 between 100 ( percent )', 'Raindrops' ). '</p>',
								)
					);
			$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_site_title_top_margin]',
							array( 'default' => raindrops_warehouse_clone( 'raindrops_site_title_top_margin' ),
									'type' => 'option',
									'capability' => 'edit_theme_options', 'sanitize_callback' => 'raindrops_site_title_top_margin_validate'
								)
					);
			$wp_customize->add_control( 'raindrops_site_title_top_margin',
							array(
								'label'		 => esc_html__( 'Top Margin in the header image', 'Raindrops' ),
								'section'	 => 'title_tagline',
								'settings'	 => 'raindrops_theme_settings[raindrops_site_title_top_margin]',
								'type'		 => 'text',
								'description' => '<p>'. esc_html__( ' default value is 1 . set 0 between 100 ( percent )', 'Raindrops' ). '</p>',
								)
					);
			$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_site_title_font_size]',
							array( 'default' => raindrops_warehouse_clone( 'raindrops_site_title_font_size' ),
									'type' => 'option',
									'capability' => 'edit_theme_options', 'sanitize_callback' => 'raindrops_site_title_font_size_validate'
								)
					);
			$wp_customize->add_control( 'raindrops_site_title_font_size',
							array(
								'label'		 => esc_html__( 'Font Size of Site Title', 'Raindrops' ),
								'section'	 => 'title_tagline',
								'settings'	 => 'raindrops_theme_settings[raindrops_site_title_font_size]',
								'type'		 => 'text',
								'description' => '<p>'. esc_html__( 'default value none, or 1-10( percent of viewport width )' , 'Raindrops' ). '</p>',
								)
					);

			$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_site_title_font_size]',
							array( 'default' => raindrops_warehouse_clone( 'raindrops_site_title_font_size' ),
									'type' => 'option',
									'capability' => 'edit_theme_options', 'sanitize_callback' => 'raindrops_site_title_font_size_validate'
								)
					);
			$wp_customize->add_control( 'raindrops_site_title_font_size',
							array(
								'label'		 => esc_html__( 'Font Size of Site Title', 'Raindrops' ),
								'section'	 => 'title_tagline',
								'settings'	 => 'raindrops_theme_settings[raindrops_site_title_font_size]',
								'type'		 => 'text',
								'description' => '<p>'. esc_html__( 'default value none, or 1-10( percent of viewport width )' , 'Raindrops' ). '</p>',
								)
					);
			$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_site_title_css_class]',
							array( 'default' => raindrops_warehouse_clone( 'raindrops_site_title_css_class' ),
									'type' => 'option',
									'capability' => 'edit_theme_options', 'sanitize_callback' => 'raindrops_site_title_css_class_validate'
								)
					);
			$wp_customize->add_control( 'raindrops_site_title_css_class',
							array(
								'label'		 => esc_html__( 'CSS Class of Site Title', 'Raindrops' ),
								'section'	 => 'title_tagline',
								'settings'	 => 'raindrops_theme_settings[raindrops_site_title_css_class]',
								'type'		 => 'text',
								'description' => '<p>'. esc_html__( 'add your own CSS class' , 'Raindrops' ). '</p>',
								)
					);
			$wp_customize->add_setting( 'raindrops_theme_settings[raindrops_tagline_in_the_header_image]',
							array( 'default' => raindrops_warehouse_clone( 'raindrops_tagline_in_the_header_image' ),
									'type' => 'option',
									'capability' => 'edit_theme_options', 'sanitize_callback' => 'raindrops_tagline_in_the_header_image_validate'
								)
					);
			$wp_customize->add_control( 'raindrops_tagline_in_the_header_image',
							array( 'label' => esc_html__( 'Tagline in the header image', 'Raindrops' ),
									'section' => 'title_tagline',
									'settings' => 'raindrops_theme_settings[raindrops_tagline_in_the_header_image]',
									'type' => 'radio',
									'choices' => array(
													'show' => esc_html__( 'Show', 'Raindrops' ),
													'hide' => esc_html__( 'Hide', 'Raindrops' ),
									),
								)
					);
		}

		do_action( 'raindrops_customize_register' );
	}

}

add_filter( 'raindrops_prev_next_post', 'raindrops_remove_element' );
add_filter( 'raindrops_posted_on', 'raindrops_remove_element' );
add_filter( 'raindrops_posted_in', 'raindrops_remove_element' );
/**
 *
 *
 *
 *
 */
if ( !function_exists( 'raindrops_remove_element' ) ) {

	function raindrops_remove_element( $content ) {

		return preg_replace( '!<span[^>]+><\/span>!', '', $content );
	}

}
/**
 *
 *
 *
 *
 * thanks  aison
 */
if ( !function_exists( 'raindrops_page_menu_args' ) ) {

	function raindrops_page_menu_args( $args ) {

		global $raindrops_nav_menu_home_link;
		$args[ 'show_home' ] = $raindrops_nav_menu_home_link;
		return $args;
	}

}
/**
 *
 *
 *
 *
 * @since 0.980
 */

if ( !function_exists( 'insert_message_action_hook_position' ) ) {

	function insert_message_action_hook_position( $hook_name = '' ) {
		global  $wp_customize;

		if ( ( true == WP_DEBUG || $wp_customize) && is_user_logged_in() && current_user_can( 'edit_theme_options' ) ) {

				add_action( 'raindrops_after_nav_menu', 'raindrops_action_hook_messages' );
				add_action( 'raindrops_append_entry_content', 'raindrops_action_hook_messages' );
				add_action( 'raindrops_prepend_extra_sidebar', 'raindrops_action_hook_messages' );
				add_action( 'raindrops_append_extra_sidebar', 'raindrops_action_hook_messages' );
				add_action( 'raindrops_prepend_doc', 'raindrops_action_hook_messages' );
				add_action( 'raindrops_append_doc', 'raindrops_action_hook_messages' );
				add_action( 'raindrops_prepend_default_sidebar', 'raindrops_action_hook_messages' );
				add_action( 'raindrops_append_default_sidebar', 'raindrops_action_hook_messages' );
				add_action( 'raindrops_prepend_footer', 'raindrops_action_hook_messages' );
				add_action( 'raindrops_append_footer', 'raindrops_action_hook_messages' );
				add_action( 'raindrops_prepend_entry_content', 'raindrops_action_hook_messages' );
				add_action( 'raindrops_prepend_loop', 'raindrops_action_hook_messages' );
				add_action( 'raindrops_append_loop', 'raindrops_action_hook_messages' );
		}
	}

}

		insert_message_action_hook_position();
/**
 *
 *
 *
 *
 * @since 1.204
 */
if ( !function_exists( 'raindrops_prepend_loop' ) ) {

	function raindrops_prepend_loop() {
		$args = array( 'hook_name' => 'raindrops_prepend_loop', 'template_part_name' => 'hook-prepend-loop.php' );

		get_template_part( 'hook', 'prepend-loop' );
		do_action( 'raindrops_prepend_loop', $args );
	}

}
/**
 *
 *
 *
 *
 * @since 1.204
 */
if ( !function_exists( 'raindrops_append_loop' ) ) {

	function raindrops_append_loop() {
		$args = array( 'hook_name' => 'raindrops_append_loop', 'template_part_name' => 'hook-append-loop.php' );

		get_template_part( 'hook', 'append-loop' );
		do_action( 'raindrops_append_loop', $args );
	}

}
/**
 *
 *
 *
 *
 * @since 0.980
 */
if ( !function_exists( 'raindrops_action_hook_messages' ) ) {

	function raindrops_action_hook_messages( $args ) {
		global $raindrops_actions_hook_message;
	/**
		 * When WP_DEBUG value true and $raindrops_actions_hook_message value true
		 * Show Raindrops action filter position and examples
		 *
		 * $raindrops_actions_hook_message
		 * @since 0.980
		 */
		if ( ! isset( $raindrops_actions_hook_message ) ) {

			$customizer_modify_value = raindrops_warehouse_clone( 'raindrops_actions_hook_message' );
			
			if ( 'show' !== $customizer_modify_value ) {

				$raindrops_actions_hook_message = false;
			} else {
				$raindrops_actions_hook_message = true;	
			}		

		}
	
		if( true == $raindrops_actions_hook_message ) {
			
			if ( isset( $args ) && array_key_exists( 'hook_name', $args ) && array_key_exists( 'template_part_name', $args ) ) {

				$message = esc_html__( 'add_action(  \'%1$s\', \'your_function\'  ) or add template part file the name \'%2$s\'.', 'Raindrops' );
				$message = sprintf( $message, $args[ 'hook_name' ], $args[ 'template_part_name' ] );
				printf( '<div style="%2$s" class="color3 pad-m corner">%1$s</div>', $message, 'word-break:break-all;word-wrap:break-word;' );
			}
		}
	}

}
/**
 *
 *
 *
 *
 * @since 0.980
 */
if ( !function_exists( 'raindrops_after_nav_menu' ) ) {

	function raindrops_after_nav_menu() {

		get_template_part( 'hook', 'after-nav-menu' );
		$args = array( 'hook_name' => 'raindrops_after_nav_menu', 'template_part_name' => 'hook-after-nav-menu.php' );
		do_action( 'raindrops_after_nav_menu', $args );
	}

}
/**
 *
 *
 *
 *
 * @since 0.980
 */
if ( !function_exists( 'raindrops_prepend_doc' ) ) {

	function raindrops_prepend_doc() {

		$args = array( 'hook_name' => 'raindrops_prepend_doc', 'template_part_name' => 'hook-prepend-doc.php' );
		get_template_part( 'hook', 'prepend-doc' );
		do_action( 'raindrops_prepend_doc', $args );
	}

}
/**
 *
 *
 *
 *
 * @since 0.980
 */
if ( !function_exists( 'raindrops_append_doc' ) ) {

	function raindrops_append_doc() {

		$args = array( 'hook_name' => 'raindrops_append_doc', 'template_part_name' => 'hook-append-doc.php' );
		get_template_part( 'hook', 'append-doc' );
		do_action( 'raindrops_append_doc', $args );
	}

}
/**
 *
 *
 *
 *
 * @since 0.980
 */
if ( !function_exists( 'raindrops_prepend_entry_content' ) ) {

	function raindrops_prepend_entry_content() {

		$args = array( 'hook_name' => 'raindrops_prepend_entry_content', 'template_part_name' => 'hook-prepend-entry-content.php' );
		get_template_part( 'hook', 'prepend-entry-content' );
		do_action( 'raindrops_prepend_entry_content', $args );
	}

}
/**
 *
 *
 *
 *
 * @since 0.980
 */
if ( !function_exists( 'raindrops_prepend_extra_sidebar' ) ) {

	function raindrops_prepend_extra_sidebar() {

		$args = array( 'hook_name' => 'raindrops_prepend_extra_sidebar', 'template_part_name' => 'hook-prepend-extra-sidebar.php' );
		get_template_part( 'hook', 'prepend-extra-sidebar' );
		do_action( 'raindrops_prepend_extra_sidebar', $args );
	}

}
/**
 *
 *
 *
 *
 * @since 0.980
 */
if ( !function_exists( 'raindrops_prepend_default_sidebar' ) ) {

	function raindrops_prepend_default_sidebar() {

		$args = array( 'hook_name' => 'raindrops_prepend_default_sidebar', 'template_part_name' => 'hook-prepend-default-sidebar.php' );
		get_template_part( 'hook', 'prepend-default-sidebar' );
		do_action( 'raindrops_prepend_default_sidebar', $args );
	}

}
/**
 *
 *
 *
 *
 * @since 0.980
 */
if ( !function_exists( 'raindrops_prepend_footer' ) ) {

	function raindrops_prepend_footer() {

		$args = array( 'hook_name' => 'raindrops_prepend_footer', 'template_part_name' => 'hook-prepend-footer.php' );
		get_template_part( 'hook', 'prepend-footer' );
		do_action( 'raindrops_prepend_footer', $args );
	}

}
/**
 *
 *
 *
 *
 * @since 0.980
 */
if ( !function_exists( 'raindrops_append_entry_content' ) ) {

	function raindrops_append_entry_content() {

		$args = array( 'hook_name' => 'raindrops_append_entry_content', 'template_part_name' => 'hook-append-entry-content.php' );
		get_template_part( 'hook', 'append-entry-content' );
		do_action( 'raindrops_append_entry_content', $args );
	}

}
/**
 *
 *
 *
 *
 * @since 0.980
 */
if ( !function_exists( 'raindrops_append_extra_sidebar' ) ) {

	function raindrops_append_extra_sidebar() {

		$args = array( 'hook_name' => 'raindrops_append_extra_sidebar', 'template_part_name' => 'hook-append-extra-sidebar.php' );
		get_template_part( 'hook', 'append-extra-sidebar' );
		do_action( 'raindrops_append_extra_sidebar', $args );
	}

}
/**
 *
 *
 *
 *
 * @since 0.980
 */
if ( !function_exists( 'raindrops_append_default_sidebar' ) ) {

	function raindrops_append_default_sidebar() {

		$args = array( 'hook_name' => 'raindrops_append_default_sidebar', 'template_part_name' => 'hook-append-default-sidebar.php' );
		get_template_part( 'hook', 'append-default-sidebar' );
		do_action( 'raindrops_append_default_sidebar', $args );
	}

}
/**
 *
 *
 *
 *
 * @since 0.980
 */
if ( !function_exists( 'raindrops_append_footer' ) ) {

	function raindrops_append_footer() {

		$args = array( 'hook_name' => 'raindrops_append_footer', 'template_part_name' => 'hook-append-footer.php' );
		get_template_part( 'hook', 'append-footer' );
		do_action( 'raindrops_append_footer', $args );
	}

}
/**
 *
 *
 *
 *
 * @since 0.980
 */
if ( !function_exists( 'raindrops_entry_title' ) ) {

	function raindrops_entry_title( $args = array() ) {

		global $post, $templates, $raindrops_link_unique_text;
		$default				 = array( 'raindrops_title_element' => 'h2', 'echo' => true );
		$args					 = wp_parse_args( $args, $default );
		$thumbnail				 = '';
		$raindrops_unique_label	 = '';
		extract( $args, EXTR_SKIP );


		if ( !is_singular() || is_page_template( 'page-templates/list-of-post.php' ) || ( is_page_template( 'page-templates/full-width.php' ) && is_front_page()  ) || ( is_page_template( 'page-templates/front-page.php' ) && is_front_page()  ) ) {

			$html = '<' . $raindrops_title_element . ' class="%1$s">%2$s'.
					"\n". str_repeat("\t", 11 ).'<a href="%3$s" rel="bookmark" title="%4$s"><span>%5$s %6$s</span></a>'.
					"\n". str_repeat("\t", 10 ). '</' . $raindrops_title_element . '>';

			$html = sprintf( $html,
							apply_filters('raindrops_entry_title_class', 'h2 entry-title'),
							$thumbnail,
							get_permalink(),
							the_title_attribute( array( 'before' => '', 'after' => '', 'echo' => false ) ),
							the_title( '', '', false ),
							$raindrops_unique_label );


			if ( true == $echo ) {
				echo apply_filters( 'raindrops_entry_title', $html );
			} else {
				return apply_filters( 'raindrops_entry_title', $html );
			}
		} else {

			$html = '<' . $raindrops_title_element . ' class="%1$s">%4$s<span>%3$s %2$s</span></' . $raindrops_title_element . '>';

			$html = sprintf( $html,  apply_filters('raindrops_entry_title_class', 'h2 entry-title'), the_title( '', '', false ), $raindrops_unique_label, $thumbnail );
			if ( true == $echo ) {
				echo apply_filters( 'raindrops_entry_title', $html );
			} else {
				return apply_filters( 'raindrops_entry_title', $html );
			}
		}
	}

}

if( ! function_exists( 'raindrops_excerpt_with_html') ) {
	/**
	 *
	 * @param type $content
	 * @return type
	 * @since 1.278
	 */
	function raindrops_excerpt_with_html( $content ) {

		$raindrops_excerpt_condition = raindrops_detect_excerpt_condition();
		$raindrops_excerpt_enable	 = raindrops_warehouse_clone( 'raindrops_excerpt_enable' );
		$raindrops_allow_oembed_excerpt_view = raindrops_warehouse_clone( 'raindrops_allow_oembed_excerpt_view' );

		if ( true == $raindrops_excerpt_condition && 'yes' == $raindrops_excerpt_enable ) {

			return raindrops_html_excerpt_with_elements( $content, 200, ' ...', true, true );
		}
		return $content;
	}
}

if( ! function_exists( 'raindrops_maybe_multibyte') ) {
	/**
	 *
	 * @param type $text
	 * @return boolean
	 * @since 1.278
	 */
	function raindrops_maybe_multibyte( $text ) {

		$filter_value = apply_filters( 'raindrops_maybe_multibyte', 0 , $text );

		if( is_bool ( $filter_value ) ) {

			return $filter_value;
		}

		if ( !is_string( $text ) ) {

			return false;
		}
		if ( strlen($text) !== mb_strlen( $text, "UTF-8" ) ) {

			return true;
		}

			return false;
	}
}
if( ! function_exists( 'raindrops_html_excerpt_with_elements') ) {
	/**
	 *
	 * @param type $content
	 * @param type $length
	 * @param type $more
	 * @param type $exact
	 * @param type $allow_html
	 * @return type
	 * @since 1.278
	 */
	function raindrops_html_excerpt_with_elements( $content, $length = 200, $more = '...', $exact = true, $allow_html = false ) {
		global $post;
		$no_closed_elements	 = '(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param|embed)';
		$length				 = apply_filters( 'excerpt_length', $length );
		$length				 = apply_filters( 'raindrops_html_excerpt_with_elements_length', $length );
		$allow_html			 = apply_filters( 'raindrops_html_excerpt_with_elements_allow_html', $allow_html );

		if( isset( $post ) && has_excerpt() ) {

			return apply_filters('the_excerpt', get_the_excerpt() );
		}

		if ( $allow_html ) {

			if( preg_match( '!\[raindrops skip-excerpt\]!', $content ) ) {
				return $content;
			}

			$striped_shortcode_content = strip_shortcodes( $content );
			$striped_content = wp_kses( $striped_shortcode_content, array() );

			if ( mb_strlen( $striped_content, "UTF-8" ) <= $length ) {
				return $content;
			}

			preg_match_all( '/(<.+?>|\[.+\])?([^<>]*)/s', $content, $lines, PREG_SET_ORDER );

			$total_length = mb_strlen( $more, "UTF-8" );
			$open_tags    = array();
			$truncate     = '';

			foreach ( $lines as $line_matchings ) {

				if ( isset( $line_matchings[1] ) and ! empty( $line_matchings[1] ) ) {

					if ( preg_match( '/^<(\s*.+?\/\s*|\s*'. $no_closed_elements.'(\s.+?)?)>$/is', $line_matchings[1] ) ) {

					} elseif ( preg_match( '!\[\/([^\]]+)\]!', $line_matchings[1], $tag_matchings ) ) {

						$pos = array_search( $tag_matchings[1], $open_tags );

						if ( $pos !== false ) {

							unset( $open_tags[$pos] );
						}
					} elseif ( preg_match( '/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings ) ) {

						$pos = array_search( $tag_matchings[1], $open_tags );

						if ( $pos !== false ) {

							unset( $open_tags[$pos] );
						}
					} elseif ( preg_match( '/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings ) ) {

						array_unshift( $open_tags, strtolower( $tag_matchings[1] ) );
					} elseif ( preg_match( '/^\[\s*([^\s\]!]+).*?\]$/s', $line_matchings[1], $tag_matchings ) ) {

						array_unshift( $open_tags, strtolower( $tag_matchings[1] ) );
					}
					$truncate .= $line_matchings[1];
				}

				$content_length = mb_strlen( preg_replace( '/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', ' ', $line_matchings[2] ), "UTF-8" );

				if ( $total_length + $content_length > $length ) {

					$left            = $length - $total_length;
					$entities_length = 0;

					if ( preg_match_all( '/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE ) ) {

						foreach ( $entities[0] as $entity ) {
							if ( $entity[1] + 1 - $entities_length <= $left ) {
								$left--;
								$entities_length += mb_strlen( $entity[0], "UTF-8" );
							} else {
								break;
							}
						}
					}

					$truncate .= wp_html_excerpt( $line_matchings[2], $left + $entities_length, '' );
					break;

				} else {

					$truncate .= $line_matchings[2];
					$total_length += $content_length;
				}
				if ( $total_length >= $length ) {

					break;
				}
			}
		} else {

			if ( mb_strlen( $content, "UTF-8" ) <= $length ) {

				return $content;
			} else {

				$truncate = wp_html_excerpt( $striped_shortcode_content, $length - mb_strlen( $more, "UTF-8" ), $more );
			}
		}

		if ( ! $exact ) {

			$spacepos = mb_strrpos( $truncate, ' ' );

			if ( isset( $spacepos ) ) {

				$truncate = mb_substr( $truncate, 0, $spacepos, "UTF-8" );
			}
		}

		$truncate .= $more;

		if ( $allow_html ) {

			foreach ( $open_tags as $tag ) {
				$truncate .= '</' . $tag . '>';
			}
		}
		return apply_filters( 'raindrops_html_excerpt_with_elements', $truncate, __FUNCTION__ );
	}
}


if ( !function_exists( 'raindrops_entry_content' ) ) {
   /**
	*
	*
	*
	*
	* @since 0.980
	*/
	function raindrops_entry_content( $more_link_text = null, $stripteaser = false ) {

		global $post;

		if ( raindrops_detect_display_none_condition() && !is_sticky() ) {

			return;
		}
		$raindrops_excerpt_condition = raindrops_detect_excerpt_condition();
		$raindrops_excerpt_enable	 = raindrops_warehouse_clone( 'raindrops_excerpt_enable' );
		$raindrops_allow_oembed_excerpt_view = raindrops_warehouse_clone( 'raindrops_allow_oembed_excerpt_view' );

		if ( true == $raindrops_excerpt_condition && !is_sticky() && 'no' == $raindrops_excerpt_enable ) {

			/* remove shortcodes */
			$excerpt = preg_replace( '!\[[^\]]+\]!', '', get_the_excerpt() );
			$excerpt = apply_filters( 'the_excerpt', $excerpt );
			$excerpt = apply_filters( 'raindrops_the_excerpt', $excerpt, __FUNCTION__ );

			echo apply_filters( 'raindrops_entry_content', $excerpt );
		} else {

			if ( empty( $more_link_text ) ) {

				$more_link_text = esc_html__( 'Continue&nbsp;reading ', 'Raindrops' ) . '<span class="meta-nav">&rarr;</span><span class="more-link-post-unique">' . esc_html__( '&nbsp;Post ID&nbsp;', 'Raindrops' ) . get_the_ID() . '</span>';
			}

			$content = ''; // wp-includes/post-template.php:265 - Trying to get property of non-object
			if ( isset( $post ) ) {
				$content = get_the_content( $more_link_text, $stripteaser );
			}
			$content = apply_filters( 'the_content', $content );
			$content = apply_filters( 'raindrops_entry_content', $content );
			$content = str_replace( ']]>', ']]&gt;', $content );
			echo $content;


		}
	}

}
/**
 *
 *
 *
 *
 * @since 0.980
 */
if ( !function_exists( 'raindrops_next_prev_links' ) ) {

	function raindrops_next_prev_links( $position = 'nav-above' ) {

		global $wp_query, $paged;

		$raindrops_old	 = $paged + 1;
		$raindrops_new	 = $paged - 1;
		$raindrops_old	 = raindrops_link_unique( $text			 = 'Next Page', $raindrops_old );
		$raindrops_new	 = raindrops_link_unique( $text			 = 'Next Page', $raindrops_new );

		if ( $wp_query->max_num_pages > 1 ) {

			$html	 = '<div id="%3$s" class="clearfix">'."\n". str_repeat("\t", 8). '<span class="nav-previous">%1$s</span><span class="nav-next">%2$s</span>'."\n". str_repeat("\t", 7).'</div>'. "\n";
			$html	 = sprintf( $html, get_next_posts_link( '<span class="meta-nav">&larr;</span>' . $raindrops_old . esc_html__( ' Older posts', 'Raindrops' ) ), get_previous_posts_link( '<span>' . $raindrops_new . esc_html__( 'Newer posts', 'Raindrops' ) . '<span class="meta-nav">&rarr;</span></span>' ), $position );
			echo apply_filters( 'raindrops_next_prev_links', $html, $position );
		}
	}

}

if ( version_compare( $wp_version, '4.0.1', '>' ) ) {

	add_filter( 'raindrops_next_prev_links', 'raindrops_the_pagenation', 10, 2);
}
function raindrops_the_pagenation( $html , $position){
	global $raindrops_document_type;
	if ( function_exists( 'get_the_posts_pagination' ) && $position == 'nav-below' ) {

		if ( $raindrops_document_type == 'html5' ) {

			return get_the_posts_pagination();
		} elseif( $raindrops_document_type == 'xhtml' ) {

			$result = str_replace( array('<nav ','</nav>'),array('<div ', '</div>'), get_the_posts_pagination() );
			return $result;
		} else {
			return $html;
		}
	}
	return $html;
}

/**
 *
 *
 *
 *
 * @since 0.980
 */
if ( !function_exists( 'raindrops_sidebar_menus' ) ) {

	function raindrops_sidebar_menus( $position = 'default' ) {

		global $post, $raindrops_wp_version;
		$attr = '';

		if ( 'default' == $position ) {

			$html = '<li id="search-default" class="widget-container widget_search">' . get_search_form( false ) . '</li>';
			$html .= '<li><h2 class="h2 widget-title">' . esc_html__( 'Archives', 'Raindrops' ) . '</h2>';
			$html .= '<ul>' . wp_get_archives( 'type=monthly&echo=0' ) . '</ul>';
			$html .= '</li>';
		} else {

			$html = wp_list_categories( 'show_count=1&title_li=<h2 class="h2 widget-title">' . esc_html__( 'Categories', 'Raindrops' ) . '</h2>&echo=0' );
		}
		echo apply_filters( 'raindrops_sidebar_menus', $html );
		wp_reset_postdata();
	}

}

if ( !function_exists( 'raindrops_link_get' ) ) {
/**
*
* @param type $text
* @return boolean
* @since 1.246
*/
	function raindrops_link_get( $text = '' ) {

		if ( preg_match_all( "/(https?:\/\/)([-_.!˜*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/iu", $text, $matches, PREG_SET_ORDER ) ) {

			return $matches;
		}
		return false;
	}

}
if ( !function_exists( 'raindrops_replace_oembed_link_to_icon' ) ) {
/**
*
* @param type $post_content
* @return type
* @since 1.246
*/
	function raindrops_replace_oembed_link_to_icon( $post_content = '' ) {
			$replaced_content		 = $post_content;
			$link_removed_content	 = $post_content;
			$icon_html				 = '';
		$raindrops_post_content_links = raindrops_link_get( $post_content );

		if ( isset( $raindrops_post_content_links ) && !empty( $raindrops_post_content_links ) ) {

			foreach ( $raindrops_post_content_links[ 0 ] as $key => $uri ) {

				if ( wp_oembed_get( $uri ) ) {

					$css_class	 = parse_url( $uri );
					$css_class	 = str_replace( '.', '-', $css_class );

					$icon_html_1  = '<span class="oembed-content-icon ' . esc_attr( $css_class['host'] ) . '">Cloud</span>';
					$icon_html	 .= apply_filters( 'raindrops_replace_oembed_link_to_icon_icon', $icon_html_1 );

					$replaced_content	 = str_replace( $uri, $icon_html, $post_content );
					$replaced_content	 = apply_filters( 'raindrops_replace_oembed_link_to_icon_replace', $replaced_content, $icon_html );

					$link_removed_content	 = str_replace( $uri, '', $post_content );
					$link_removed_content	 = apply_filters( 'raindrops_replace_oembed_link_to_icon_removed', $link_removed_content, $icon_html );
				}
			}
		} else {
			$replaced_content		 = $post_content;
			$link_removed_content	 = $post_content;
			$icon_html				 = '';
		}
		return array( 'replaced_content' => $replaced_content, 'link_removed_content' => $link_removed_content, 'icon_html' => $icon_html );
	}

}

if ( !function_exists( 'raindrops_transient_update' ) ) {
/**
*
* @param type $post_id
* @since 1.246
*/
	function raindrops_transient_update( $post_id ) {

		delete_transient( 'raindrops_recent_posts' );
		delete_transient( 'raindrops_category_posts' );
		delete_transient( 'raindrops_get_tag_posts' );
	}
}

if ( !function_exists( 'raindrops_recent_posts' ) ) {
/**
*
* @param array $args
* @return html
* @since 1.246
*/
	function raindrops_recent_posts( $args = array() ) {
		global $raindrops_bf_recent_posts_setting, $raindrops_use_transient;

		if ( false === ( $val = get_transient( __FUNCTION__ ) ) || get_transient( 'raindrops_bf_recent_posts_setting')  !==  md5(serialize( $raindrops_bf_recent_posts_setting ) ) ) {

			$result = raindrops_get_recent_posts( $args = array() );

			if( $raindrops_use_transient == true ) {

				set_transient( 'raindrops_bf_recent_posts_setting', md5(serialize( $raindrops_bf_recent_posts_setting )));
				set_transient( __FUNCTION__, $result);
			}
			echo $result;
			return;
		}

		echo $val;
		if( $raindrops_use_transient == false ) {
			delete_transient( 'raindrops_bf_recent_posts_setting');
			delete_transient( __FUNCTION__);
		}
	}
}
if ( !function_exists( 'raindrops_category_posts' ) ) {
/**
*
* @param array $args
* @return html
* @since 1.246
*/
	function raindrops_category_posts( $args = array() ) {
		global $raindrops_bf_category_posts_setting, $raindrops_use_transient;

		if ( false === ( $val = get_transient( __FUNCTION__ ) ) || get_transient( 'raindrops_bf_category_posts_setting')  !==  md5(serialize( $raindrops_bf_category_posts_setting ) )) {

			$result = raindrops_get_category_posts( $args = array() );

			if( $raindrops_use_transient == true ) {
				set_transient( 'raindrops_bf_category_posts_setting', md5(serialize( $raindrops_bf_category_posts_setting )));
				set_transient( __FUNCTION__, $result);
			}

			echo $result;
			return;
		}

		echo $val;
		if( $raindrops_use_transient == false ) {

			delete_transient( 'raindrops_bf_category_posts_setting');
			delete_transient( __FUNCTION__);
		}
	}
}

if ( !function_exists( 'raindrops_tag_posts' ) ) {
/**
*
* @param array $args
* @return html
* @since 1.246
*/
	function raindrops_tag_posts( $args = array() ) {
		global $raindrops_bf_tag_posts_setting, $raindrops_use_transient;
		if ( false === ( $val = get_transient( __FUNCTION__ ) ) || get_transient( 'raindrops_bf_tag_posts_setting' )  !==  md5( serialize( $raindrops_bf_tag_posts_setting ) ) ) {

			$result = raindrops_get_tag_posts( $args = array() );
			if( $raindrops_use_transient == true ) {
				set_transient( 'raindrops_bf_tag_posts_setting', md5(serialize( $raindrops_bf_tag_posts_setting )));
				set_transient( __FUNCTION__, $result);
			}
			echo $result;
			return;
		}

		echo $val;
		if( $raindrops_use_transient == false) {

				delete_transient( 'raindrops_bf_tag_posts_setting');
				delete_transient( __FUNCTION__);
		}
	}
}
/**
 * recent post
 *
 *
 *
 *
 */

if ( !function_exists( 'raindrops_get_recent_posts' ) ) {

	function raindrops_get_recent_posts( $args = array() ) {

		global $raindrops_bf_recent_posts_setting, $post, $raindrops_base_font_size, $raindrops_link_unique_text, $template;

		$thumbnail_size	 = apply_filters( 'raindrops_recent_posts_thumb_size', array( 125, 125 ) );
		$article_margin	 = 0;

		$thumbnail_width	 = (int) $thumbnail_size[ 0 ];
		$thumbnail_height	 = (int) $thumbnail_size[ 0 ];

		if ( empty( $args ) ) {

			if ( !isset( $raindrops_bf_recent_posts_setting ) && basename( $template ) == 'blank-front.php' ) {

				return;
			}
		} else {

			$raindrops_bf_recent_posts_setting = wp_parse_args( $args, $raindrops_bf_recent_posts_setting );
		}

		$default = array(
			'title'											 => esc_html__( 'Recent Post', 'Raindrops' ),
			'numberposts'									 => 10,
			'offset'										 => 0,
			'category'										 => 0,
			'orderby'										 => 'post_date',
			'order'											 => 'DESC',
			'include'										 => '',
			'exclude'										 => '',
			'meta_key'										 => '',
			'meta_value'									 => '',
			'post_type'										 => 'post',
			'post_status'									 => 'publish',
			'suppress_filters'								 => true,
			'raindrops_excerpt_length'						 => 100,
			'raindrops_excerpt_more'						 => '...',
			'raindrops_post_thumbnail'						 => true, 'raindrops_recent_post_thumbnail_default_uri'	 => '' );
		$args	 = wp_parse_args( $raindrops_bf_recent_posts_setting, $default );
		$title	 = $args[ 'title' ];
		unset( $args[ 'title' ] );

		$article_margin = '';

		if ( array_key_exists( 'raindrops_excerpt_length', $args ) ) {

			$raindrops_excerpt_length = $args[ "raindrops_excerpt_length" ];
		}

		if ( array_key_exists( 'raindrops_excerpt_more', $args ) && $args[ "raindrops_excerpt_length" ] > 0 ) {

			$raindrops_excerpt_more = $args[ "raindrops_excerpt_more" ];
		} else {

			$raindrops_excerpt_more = '';
		}

		if ( array_key_exists( 'raindrops_recent_post_thumbnail_default_uri', $args ) && !empty( $args[ "raindrops_recent_post_thumbnail_default_uri" ] ) ) {

			$raindrops_recent_post_thumbnail_default_uri = $args[ "raindrops_recent_post_thumbnail_default_uri" ];
		} elseif ( empty( $args[ "raindrops_recent_post_thumbnail_default_uri" ] ) ) {

			$raindrops_recent_post_thumbnail_default_uri = '';
		}


		$archive_year	 = get_the_time( 'Y' );
		$archive_month	 = get_the_time( 'm' );
		$archive_day	 = get_the_time( 'd' );

		$raindrops_date_format	 = get_option( 'date_format' ) . ' ' . get_option( 'time_format' );
		$day_link				 = esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) . '#post-' . $post->ID );

		$html	 = '<li class="%3$s">%10$s<%4$s id="post-%5$s-recentpost" %6$s style="%11$s"><div class="posted-on">
%7$s%8$s</div><h3 class="h4 entry-title"><a href="%1$s"><span>%2$s</span></a></h3><div class="entry-content clearfix">%9$s</div></%4$s></li>';
		$html	 = apply_filters( 'raindrops_recent_posts_li', $html );
		$results = wp_get_recent_posts( $args );

		$result	 = sprintf( '<h2 class="%2$s">%1$s</h2>', $title, 'title h2' );
		$result	 = apply_filters( 'raindrops_recent_posts_title', $result );

		$result .= sprintf( '<ul class="%1$s">', 'raindrops-recent-posts' );

		foreach ( $results as $key => $val ) {

			$classes = '';

			if ( empty( $raindrops_recent_post_thumbnail_default_uri ) && !has_post_thumbnail( $val[ "ID" ] ) ) {

				$article_margin = '';
			} elseif ( true == $args[ "raindrops_post_thumbnail" ] ) {

				$article_margin = (int) $thumbnail_size[ 0 ] + 10;

				/* if ( !isset( $raindrops_base_font_size ) || empty( $raindrops_base_font_size ) ) {
				  $raindrops_base_font_size = 13;
				  }

				  $article_margin = $article_margin / $raindrops_base_font_size; */

				$article_margin = 'margin-left:' . $article_margin . 'px';
			}


			if ( array_key_exists( 'raindrops_post_thumbnail', $args ) &&
			true == $args[ "raindrops_post_thumbnail" ] &&	!post_password_required() ) {

				$thumbnail = '<span class="raindrops_recent_posts thumb">';

				if ( has_post_thumbnail( $val[ "ID" ] ) ) {
					if( $raindrops_link_unique_text == false ) {
						$thumbnail .= '<a href="'.get_permalink( $val[ "ID" ] ).'">';
					}
					$thumbnail .= get_the_post_thumbnail( $val[ "ID" ], $thumbnail_size, array( "style" => "vertical-align:text-bottom;float:left;", "alt" => null ) );
					if( $raindrops_link_unique_text == false ) {
						$thumbnail .= '</a>';
					}

				} elseif ( !empty( $raindrops_recent_post_thumbnail_default_uri ) ) {
					if( $raindrops_link_unique_text == false ) {
						$thumbnail .= '<a href="'.get_permalink( $val[ "ID" ] ).'">';
					}
					$thumbnail .= '<img src="' . apply_filters( 'raindrops_recent_post_thumbnail_default_uri', $raindrops_recent_post_thumbnail_default_uri ) . '" style="vertical-align:text-bottom;float:left;" width="' . $thumbnail_width . '" height="' . $thumbnail_height . '" alt="" />';
					if( $raindrops_link_unique_text == false ) {
						$thumbnail .= '</a>';
					}
				}


				$thumbnail .= '</span>';
			} else {
				$thumbnail = '';
			}
			$post_content = strip_shortcodes( $val["post_content"] );

			$oembed_replace_array	 = raindrops_replace_oembed_link_to_icon( $post_content );
			$oembed_flag			 = $oembed_replace_array['icon_html'];
			$post_content			 = $oembed_replace_array['link_removed_content'];

			$author			 = get_the_author_meta( 'display_name', $val[ "post_author" ] );

			$list_num_class	 = 'recent-' . $val['ID'];

			$raindrops_now			 = (int) current_time( 'timestamp' );
			$raindrops_publish_time	 = (int) strtotime( $val[ "post_date" ] );
			$raindrops_period		 = apply_filters( 'raindrops_new_period', 3 );
			$raindrops_Period		 = (int) 60 * 60 * 24 * $raindrops_period;


			if ( $raindrops_now < $raindrops_Period + $raindrops_publish_time ) {

				$classes = array( 'raindrops-pub-new ' );
				$classes = get_post_class( $classes );
			} else {

				$classes = get_post_class();
			}

			$classes = 'class="' . join( ' ', $classes ) . '"';

			$result .= sprintf( $html, get_permalink( $val[ 'ID' ] ), $val[ 'post_title' ], $list_num_class, raindrops_doctype_elements( 'div', 'article', false ), $val[ 'ID' ], $classes, sprintf( '<a href="%1$s" title="%2$s"><%4$s class="entry-date updated" %5$s>%3$s</%4$s></a>&nbsp;', $day_link, esc_attr( 'archives daily ' . mysql2date( $val[ "post_date" ], $raindrops_date_format ) ), esc_html( mysql2date( $raindrops_date_format, $val[ "post_date" ] ) ), raindrops_doctype_elements( 'span', 'time', false ), raindrops_doctype_elements( '', 'datetime="' . esc_attr( get_the_date( 'c' ) ) . '"', false )
			), sprintf( '<span class="author vcard"><a class="url fn nickname" href="%1$s" title="%2$s" rel="vcard:url">%3$s</a></span> ', get_author_posts_url( $val[ "post_author" ] ), sprintf( esc_attr__( 'View all posts by %s', 'Raindrops' ), $author ), $author
			), wp_html_excerpt( $post_content, $raindrops_excerpt_length, $raindrops_excerpt_more ). $oembed_flag, $thumbnail, $article_margin
			);
		}

		$result .= sprintf( '</ul>' );
		$result = sprintf( '<div id="%3$s" class="%1$s">%2$s</div>', 'clearfix', $result, 'raindrops-recent-posts' );
		return apply_filters( 'raindrops_recent_posts', $result );
	}

}
/**
 * category posts
 *
 *
 *
 *
 */
if ( !function_exists( 'raindrops_get_category_posts' ) ) {

	function raindrops_get_category_posts( $args = '' ) {

		global $post, $raindrops_bf_category_posts_setting, $template, $raindrops_link_unique_text;

		if ( empty( $args ) ) {

			if ( !isset( $raindrops_bf_category_posts_setting ) && basename( $template ) == 'blank-front.php' ) {

				return;
			}
		} else {

			$raindrops_bf_category_posts_setting = wp_parse_args( $args, $raindrops_bf_category_posts_setting );
		}

		$thumbnail_size	 = apply_filters( 'raindrops_category_posts_thumb_size', array( 125, 125 ) );
		$article_margin	 = 0;

		$thumbnail_width	 = (int) $thumbnail_size[ 0 ];
		$thumbnail_height	 = (int) $thumbnail_size[ 0 ];

		$html			 = '<li class="%3$s">%10$s<%4$s id="post-%5$s-catpost" %6$s style="%11$s"><div class="posted-on">
%7$s%8$s</div><h3 class="h4 entry-title"><a href="%1$s"><span>%2$s</span></a></h3><div class="entry-content clearfix">%9$s</div></%4$s></li>';
		$archive_year	 = get_the_time( 'Y' );
		$archive_month	 = get_the_time( 'm' );
		$archive_day	 = get_the_time( 'd' );

		$raindrops_date_format	 = get_option( 'date_format' ) . ' ' . get_option( 'time_format' );
		$day_link				 = esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) . '#post-' . $post->ID );
		$settings				 = array( 'title'											 => esc_html__( 'Categories', 'Raindrops' ),
			'numberposts'									 => 0,
			'offset'										 => 0,
			'category'										 => 0,
			'orderby'										 => 'post_date',
			'order'											 => 'DESC',
			'include'										 => '',
			'exclude'										 => '',
			'meta_key'										 => '',
			'meta_value'									 => '',
			'post_type'										 => 'post',
			'post_mime_type'								 => '',
			'post_parent'									 => '',
			'post_status'									 => 'publish',
			'raindrops_excerpt_length'						 => 100,
			'raindrops_excerpt_more'						 => '...',
			'raindrops_post_thumbnail'						 => true,
			'raindrops_category_post_thumbnail_default_uri'	 => '' );
		$settings				 = wp_parse_args( $raindrops_bf_category_posts_setting, $settings );



		$title = $settings[ 'title' ];
		unset( $settings[ 'title' ] );


		$article_margin = '';

		if ( array_key_exists( 'raindrops_excerpt_length', $settings ) ) {

			$raindrops_excerpt_length = $settings[ "raindrops_excerpt_length" ];
		}

		if ( array_key_exists( 'raindrops_excerpt_more', $settings ) && $settings[ "raindrops_excerpt_length" ] > 0 ) {

			$raindrops_excerpt_more = $settings[ "raindrops_excerpt_more" ];
		} else {

			$raindrops_excerpt_more = '';
		}

		if ( array_key_exists( 'raindrops_category_post_thumbnail_default_uri', $settings ) && !empty( $settings[ "raindrops_category_post_thumbnail_default_uri" ] ) ) {

			$raindrops_category_post_thumbnail_default_uri = $settings[ "raindrops_category_post_thumbnail_default_uri" ];
		} elseif ( empty( $settings[ "raindrops_category_post_thumbnail_default_uri" ] ) ) {

			$raindrops_category_post_thumbnail_default_uri = '';
		}

		//echo 'test'. $raindrops_category_post_thumbnail_default_uri.'test';

		$posts = get_posts( $settings );

		if ( $posts ) {

			$result = sprintf( '<h2 class="%2$s">%1$s</h2>', $title, 'title h2' );
			$result .= sprintf( '<ul class="list">' );

			foreach ( $posts as $post ) {
				setup_postdata( $post );
				$classes = '';

				if ( empty( $raindrops_category_post_thumbnail_default_uri ) && !has_post_thumbnail( $post->ID ) ) {

					$article_margin = '';
				} elseif ( true == $settings[ "raindrops_post_thumbnail" ] ) {

					$article_margin = (int) $thumbnail_size[ 0 ] + 10;

					$article_margin = 'margin-left:' . $article_margin . 'px';
				}

				if ( array_key_exists( 'raindrops_post_thumbnail', $settings ) &&
				true == $settings[ "raindrops_post_thumbnail" ] &&
				!post_password_required() ) {

					$thumbnail = '<span class="raindrops_recent_posts thumb">';

					if ( has_post_thumbnail( $post->ID ) ) {

						if( $raindrops_link_unique_text == false ) {

							$thumbnail .= '<a href="'.get_permalink( $post->ID ).'">';
						}

						$thumbnail .= get_the_post_thumbnail( $post->ID, $thumbnail_size, array( "style" => "vertical-align:text-bottom;float:left;", "alt" => null ) );
						if( $raindrops_link_unique_text == false ) {

							$thumbnail .= '</a>';
						}

					} elseif ( !empty( $raindrops_category_post_thumbnail_default_uri ) ) {

						if( $raindrops_link_unique_text == false ) {

							$thumbnail .= '<a href="'.get_permalink( $post->ID ).'">';
						}
						$thumbnail .= '<img src="' . apply_filters( 'raindrops_category_post_thumbnail_default_uri', $raindrops_category_post_thumbnail_default_uri ) . '" style="vertical-align:text-bottom;float:left;" width="' . $thumbnail_width . '" height="' . $thumbnail_height . '" alt="" />';

						if( $raindrops_link_unique_text == false ) {

							$thumbnail .= '</a>';
						}

					}
					$thumbnail .= '</span>';
				} else {
					$thumbnail = '';
				}
				$post_content = ''; // wp-includes/post-template.php:265 - Trying to get property of non-object
				if ( isset( $post ) ) {
					$post_content = strip_shortcodes( get_the_content() );
				}
				$oembed_replace_array	 = raindrops_replace_oembed_link_to_icon( $post_content );
				$oembed_flag			 = $oembed_replace_array['icon_html'];
				$post_content			 = $oembed_replace_array['link_removed_content'];
				$author					 = get_the_author_meta( 'display_name', get_the_author() );
				$list_num_class			 = 'recent-' . $post->ID;
				$raindrops_now			 = (int) current_time( 'timestamp' );
				$raindrops_publish_time	 = (int) strtotime( get_the_date() );
				$raindrops_period		 = apply_filters( 'raindrops_new_period', 3 );
				$raindrops_Period		 = (int) 60 * 60 * 24 * $raindrops_period;

				if ( $raindrops_now < $raindrops_Period + $raindrops_publish_time ) {

					$classes = array( 'raindrops-pub-new ' );
					$classes = get_post_class( $classes );
				} else {

					$classes = get_post_class();
				}

				$classes = 'class="' . join( ' ', $classes ) . '"';
				$result .= sprintf( $html, get_permalink( $post->ID ), get_the_title(), $list_num_class, raindrops_doctype_elements( 'div', 'article', false ), $post->ID, $classes, sprintf( '<a href="%1$s" title="%2$s"><%4$s class="entry-date updated" %5$s>%3$s</%4$s></a>&nbsp;', $day_link, esc_attr( 'archives daily ' . mysql2date( get_the_date(), $raindrops_date_format ) ), esc_html( mysql2date( $raindrops_date_format, get_the_date() ) ), raindrops_doctype_elements( 'span', 'time', false ), raindrops_doctype_elements( '', 'datetime="' . esc_attr( get_the_date( 'c' ) ) . '"', false )
				), sprintf( '<span class="author vcard"><a class="url fn nickname" href="%1$s" title="%2$s" rel="vcard:url">%3$s</a></span> ', get_author_posts_url( get_the_author() ), sprintf( esc_attr__( 'View all posts by %s', 'Raindrops' ), get_the_author() ), get_the_author()
				), wp_html_excerpt( $post_content, $raindrops_excerpt_length, $raindrops_excerpt_more ). $oembed_flag, $thumbnail, $article_margin
				);

			}
			$result .= sprintf( '</ul>' );
		}

		$result = sprintf( '<div class="%1$s">%2$s</div>', 'raindrops-category-posts clearfix', $result );
		wp_reset_postdata();
		return apply_filters( 'raindrops_category_posts', $result );
	}

}
/**
 * tag posts
 *
 *
 *
 *
 */
if ( !function_exists( 'raindrops_get_tag_posts' ) ) {

function raindrops_get_tag_posts( $args = '' ) {

	global $post, $raindrops_bf_tag_posts_setting, $raindrops_link_unique_text, $template;

	if ( empty( $args ) ) {

		if ( !isset( $raindrops_bf_tag_posts_setting ) && basename( $template ) == 'blank-front.php' ) {

			return;
		}
	} else {

		$raindrops_bf_tag_posts_setting = wp_parse_args( $args, $raindrops_bf_tag_posts_setting );
	}

	$thumbnail_size			 = apply_filters( 'raindrops_tag_posts_thumb_size', array( 125, 125 ) );
	$article_margin			 = 0;
	$thumbnail_width		 = (int) $thumbnail_size[ 0 ];
	$thumbnail_height		 = (int) $thumbnail_size[ 0 ];
	$html					 = '<li class="%3$s">%10$s<%4$s id="post-%5$s-tagpost" %6$s style="%11$s"><div class="posted-on">
%7$s%8$s</div><h3 class="h4 entry-title"><a href="%1$s"><span>%2$s</span></a></h3><div class="entry-content clearfix">%9$s</div></%4$s></li>';
	$archive_year			 = get_the_time( 'Y' );
	$archive_month			 = get_the_time( 'm' );
	$archive_day			 = get_the_time( 'd' );
	$raindrops_date_format	 = get_option( 'date_format' ) . ' ' . get_option( 'time_format' );
	$day_link				 = esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) . '#post-' . $post->ID );
	$settings				 = array(
		'title'										 => esc_html__( 'Tags', 'Raindrops' ),
		'numberposts'								 => 0,
		'offset'									 => 0,
		'category'									 => 0,
		'orderby'									 => 'post_date',
		'order'										 => 'DESC',
		'include'									 => '',
		'exclude'									 => '',
		'meta_key'									 => '',
		'meta_value'								 => '',
		'post_type'									 => 'post',
		'post_mime_type'							 => '',
		'post_parent'								 => '',
		'post_status'								 => 'publish',
		'raindrops_excerpt_length'					 => 100,
		'raindrops_excerpt_more'					 => '...',
		'raindrops_post_thumbnail'					 => true,
		'raindrops_tag_post_thumbnail_default_uri'	 => ''
	);
	$settings				 = wp_parse_args( $raindrops_bf_tag_posts_setting, $settings );
	$title					 = $settings[ 'title' ];
	unset( $settings[ 'title' ] );
	$article_margin			 = 'margin-left:' . $article_margin . 'px!important';

	if ( array_key_exists( 'raindrops_excerpt_length', $settings ) ) {

		$raindrops_excerpt_length = $settings[ "raindrops_excerpt_length" ];
	}

	if ( array_key_exists( 'raindrops_excerpt_more', $settings ) && $settings[ "raindrops_excerpt_length" ] > 0 ) {

		$raindrops_excerpt_more = $settings[ "raindrops_excerpt_more" ];
	} else {

		$raindrops_excerpt_more = '';
	}

	if ( array_key_exists( 'raindrops_tag_post_thumbnail_default_uri', $settings ) && !empty( $settings[ "raindrops_tag_post_thumbnail_default_uri" ] ) ) {

		$raindrops_tag_post_thumbnail_default_uri = $settings[ "raindrops_tag_post_thumbnail_default_uri" ];
	} elseif ( empty( $settings[ "raindrops_tag_post_thumbnail_default_uri" ] ) ) {

		$raindrops_tag_post_thumbnail_default_uri = '';
	}

	$posts = get_posts( $settings );

	if ( $posts ) {

		$result = sprintf( '<h2 class="%2$s">%1$s</h2>', $title, 'title h2' );
		$result .= sprintf( '<ul class="%1$s">', 'list' );

		foreach ( $posts as $post ) {
			setup_postdata( $post );
			$classes = '';


			if ( empty( $raindrops_tag_post_thumbnail_default_uri ) && !has_post_thumbnail( $post->ID ) ) {

				$article_margin = '';
			} elseif ( true == $settings[ "raindrops_post_thumbnail" ] ) {

				$article_margin = (int) $thumbnail_size[ 0 ] + 10;

				$article_margin = 'margin-left:' . $article_margin . 'px';
			}



			if ( array_key_exists( 'raindrops_post_thumbnail', $settings ) &&
			true == $settings[ "raindrops_post_thumbnail" ] &&
			!post_password_required() ) {

				$thumbnail = '<span class="raindrops_recent_posts thumb">';

				if ( has_post_thumbnail( $post->ID ) ) {

					if ( $raindrops_link_unique_text == false ) {

						$thumbnail .= '<a href="' . get_permalink( $post->ID ) . '">';
					}

					$thumbnail .= get_the_post_thumbnail( $post->ID, $thumbnail_size, array( "style" => "vertical-align:text-bottom;float:left;", "alt" => null ) );

					if ( $raindrops_link_unique_text == false ) {

						$thumbnail .= '</a>';
					}
				} elseif ( !empty( $raindrops_tag_post_thumbnail_default_uri ) ) {
					if ( $raindrops_link_unique_text == false ) {

						$thumbnail .= '<a href="' . get_permalink( $post->ID ) . '">';
					}

					$thumbnail .= '<img src="' . apply_filters( 'raindrops_tag_post_thumbnail_default_uri', $raindrops_tag_post_thumbnail_default_uri ) . '" style="vertical-align:text-bottom;float:left;" width="' . $thumbnail_width . '" height="' . $thumbnail_height . '" alt="" />';

					if ( $raindrops_link_unique_text == false ) {

						$thumbnail .= '</a>';
					}
				}


				$thumbnail .= '</span>';
			} else {
				$thumbnail = '';
			}
			$post_content = ''; // wp-includes/post-template.php:265 - Trying to get property of non-object
			if ( isset( $post ) ) {
				$post_content = strip_shortcodes( get_the_content() );
			}

			$oembed_replace_array	 = raindrops_replace_oembed_link_to_icon( $post_content );
			$oembed_flag			 = $oembed_replace_array[ 'icon_html' ];
			$post_content			 = $oembed_replace_array[ 'link_removed_content' ];
			$author					 = get_the_author_meta( 'display_name', get_the_author() );
			$list_num_class			 = 'recent-' . $post->ID;
			$raindrops_now			 = (int) current_time( 'timestamp' );
			$raindrops_publish_time	 = (int) strtotime( get_the_date() );
			$raindrops_period		 = apply_filters( 'raindrops_new_period', 3 );
			$raindrops_Period		 = (int) 60 * 60 * 24 * $raindrops_period;

			if ( $raindrops_now < $raindrops_Period + $raindrops_publish_time ) {

				$classes = array( 'raindrops-pub-new ' );
				$classes = get_post_class( $classes );
			} else {

				$classes = get_post_class();
			}

			$classes = 'class="' . join( ' ', $classes ) . '"';
			$result .= sprintf( $html, get_permalink( $post->ID ), get_the_title(), $list_num_class, raindrops_doctype_elements( 'div', 'article', false ), $post->ID, $classes, sprintf( '<a href="%1$s" title="%2$s"><%4$s class="entry-date updated" %5$s>%3$s</%4$s></a>&nbsp;', $day_link, esc_attr( 'archives daily ' . mysql2date( get_the_date(), $raindrops_date_format ) ), esc_html( mysql2date( $raindrops_date_format, get_the_date() ) ), raindrops_doctype_elements( 'span', 'time', false ), raindrops_doctype_elements( '', 'datetime="' . esc_attr( get_the_date( 'c' ) ) . '"', false )
			), sprintf( '<span class="author vcard"><a class="url fn nickname" href="%1$s" title="%2$s" rel="vcard:url">%3$s</a></span> ', get_author_posts_url( get_the_author() ), sprintf( esc_attr__( 'View all posts by %s', 'Raindrops' ), get_the_author() ), get_the_author()
			), wp_html_excerpt( $post_content, $raindrops_excerpt_length, $raindrops_excerpt_more ) . $oembed_flag, $thumbnail, $article_margin
			);
		}
		$result .= sprintf( '</ul>' );
	}
	$result = sprintf( '<div class="%1$s">%2$s</div>', 'raindrops-tag-posts clearfix', $result );
	wp_reset_postdata();
	return apply_filters( 'raindrops_tag_posts', $result );
}

}
/**
 *
 *
 *
 *
 */
if ( !function_exists( 'raindrops_monthly_archive_prev_next_navigation' ) ) {

	function raindrops_monthly_archive_prev_next_navigation( $echo = true, $show_year = false ) {

		global $wpdb, $wp_query, $wp_locale;

		if ( ! is_singular() && !is_404() ) {

			$thisyear		 = mysql2date( 'Y', $wp_query->posts[ 0 ]->post_date );
			$thismonth		 = mysql2date( 'm', $wp_query->posts[ 0 ]->post_date );
			$unixmonth		 = mktime( 0, 0, 0, $thismonth, 1, $thisyear );
			$last_day		 = date( 't', $unixmonth );
			$calendar_output = '';

			$previous	 = $wpdb->get_row( "SELECT MONTH(post_date) AS month, YEAR(post_date) AS year
	FROM $wpdb->posts
	WHERE post_date < '$thisyear-$thismonth-01'
	AND post_type = 'post' AND post_status = 'publish'
		ORDER BY post_date DESC
		LIMIT 1" );
			$next		 = $wpdb->get_row( "SELECT MONTH(post_date) AS month, YEAR(post_date) AS year
	FROM $wpdb->posts
	WHERE post_date > '$thisyear-$thismonth-{$last_day} 23:59:59'
	AND post_type = 'post' AND post_status = 'publish'
		ORDER BY post_date ASC
		LIMIT 1" );

			$html = '<a href="%1$s" class="%3$s">%2$s</a>';

			if ( $previous ) {

				$previous_label = $wp_locale->get_month( $previous->month );

				$calendar_output = sprintf( $html, get_month_link( $previous->year, $previous->month ), sprintf( esc_html__( '&laquo; %s ', 'Raindrops' ), $previous_label ), 'alignleft' );
			}
			$calendar_output .= "\t";

			if ( true == $show_year ) {
				$year_label  = apply_filters( 'raindrops_archive_year_label', esc_html( $thisyear ) );
				$calendar_output .= '<span class="year">'. $year_label. '</span>';
			}

			if ( $next ) {
				$next_label = $wp_locale->get_month( $next->month );

				$calendar_output .= sprintf( $html, get_month_link( $next->year, $next->month ), sprintf( esc_html__( ' %s &raquo;', 'Raindrops' ), $next_label ), 'alignright' );
			}
			$html			 = '<div class="%1$s">%2$s<br class="clear" /></div>';
			$calendar_output = sprintf( $html, 'raindrops-monthly-archive-prev-next-avigation', $calendar_output );

			if ( true == $echo ) {
				echo apply_filters( 'raindrops_monthly_archive_prev_next_navigation', $calendar_output );
			}
			if ( false == $echo ) {
				return apply_filters( 'raindrops_monthly_archive_prev_next_navigation', $calendar_output );
			}


		}
	}

}
/**
 *
 *
 *
 *
 *
 */
if ( !function_exists( 'raindrops_customize_controls_print_styles' ) ) {

	function raindrops_customize_controls_print_styles() {

		global $raindrops_current_data_version;
		?>
		<style type="text/css">
			.accordion-section label{
				display:inline-block!important;
				margin-right:1em;
			}
			#customize-control-raindrops_theme_settings-raindrops_style_type label,/* new */
			#customize-control-raindrops_style_type label{
				width:250px;
				display:inline-block!important;
				margin-right:1em;
			}

			#customize-control-raindrops_theme_settings-raindrops_style_type .customize-control-title +label ,/* new */
			#customize-control-raindrops_style_type .customize-control-title + label{

				background:url( <?php echo get_template_directory_uri() . '/images/screen-shot-dark.png'; ?> );
				height:200px;
				display:block;
				background-position:0px 40px;
				background-repeat:no-repeat;
				background-size:contain;
			}
			#customize-control-raindrops_theme_settings-raindrops_style_type .customize-control-title +label + label,/*new*/
			#customize-control-raindrops_style_type .customize-control-title  + label + label{

				background:url( <?php echo get_template_directory_uri() . '/images/screen-shot-w3standard.png'; ?> );
				height:200px;
				display:block;
				background-position:0px 40px;
				background-repeat:no-repeat;
				background-size:contain;
			}
			#customize-control-raindrops_theme_settings-raindrops_style_type .customize-control-title +label + label + label,/*new*/
			#customize-control-raindrops_style_type .customize-control-title  + label +label + label{

				background:url( <?php echo get_template_directory_uri() . '/images/screen-shot-light.png'; ?> );
				height:200px;
				display:block;
				background-position:0px 40px;
				background-repeat:no-repeat;
				background-size:contain;
			}
			#customize-control-raindrops_theme_settings-raindrops_style_type .customize-control-title +label + label + label + label,/*new*/
			#customize-control-raindrops_style_type .customize-control-title  + label +label + label + label{

				background:url( <?php echo get_template_directory_uri() . '/images/screen-shot-minimal.png'; ?> );
				height:200px;
				display:block;
				background-position:0px 40px;
				background-repeat:no-repeat;
				background-size:contain;
			}
			<?php
			if ( is_child_theme() ) {
				?>
			#customize-control-raindrops_theme_settings-raindrops_style_type .customize-control-title +label + label + label + label + label,/*new*/
			#customize-control-raindrops_style_type .customize-control-title  + label +label + label + label + label{
				/**
				* Conditional fallback screenshot using multiple background
				* This works only child theme has original color scheme
				*/
				background:url( <?php echo get_stylesheet_directory_uri() . '/screenshot.png'; ?> ),
							url( <?php echo get_template_directory_uri() . '/images/screen-shot-child-fallback.png'; ?> );
				height:200px;
				display:block;
				background-position:0px 40px;
				background-repeat:no-repeat;
				background-size:contain;
			}		
			
			
				
			<?php }?>
			#customize-control-raindrops_theme_settings-raindrops_use_featured_image_emphasis,
			#customize-control-raindrops_use_featured_image_emphasis{
				background:rgba(0,128,128,.3);
				padding:1em;
				box-sizing:border-box;
			}
			<?php
			if ( version_compare( $raindrops_current_data_version, '1.280') < 0 ) {
			?>
			#accordion-panel-raindrops_theme_settings_featured_panel > .accordion-section-title:before{
				content: 'New';
				display:inline-block;
				color:white;
				background:red;
				padding:2px 4px;
			}
			<?php
			}
			?>
			<?php
			if ( version_compare( $raindrops_current_data_version, '1.282') < 0 ) {
			?>
			#customize-control-raindrops_japanese_date > .customize-control-title:before{
				content: 'New';
				display:inline-block;
				color:white;
				background:red;
				padding:2px 4px;
			}
			<?php
			}
			?>
		</style>
		<?php
	}

}
/**
 *
 *
 *
 * @since: 0.992
 */
if ( !function_exists( 'raindrops_mobile_meta' ) ) {

	function raindrops_mobile_meta() {
		/* 1.213 remove wp_is_mobile() && works improperly ? */
		if ( 'doc3' == raindrops_warehouse( 'raindrops_page_width' ) || 'doc5' == raindrops_warehouse( 'raindrops_page_width') ) {
			?><meta name="viewport" content="width=device-width, initial-scale=1" id="raindrops-viewport" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="default" />
<?php
		}
	}

}
/**
 *
 *
 *
 * @since 0.999
 */

if ( !function_exists( 'raindrops_dinamic_class' ) ) {

	function raindrops_dinamic_class( $id = 'yui-u first', $echo = false ) {

		global $rsidebar_show,$raindrops_current_column, $raindrops_keep_content_width;
		$class = '';

		if ( 'yui-u first' == $id ) {

			if ( 3 == $raindrops_current_column ) {

				$class = $id;
			} elseif ( 1 == $raindrops_current_column ) {

					$class = $id. ' raindrops-expand-width';

			} elseif ( $raindrops_current_column == 2 ) {

					$class = $id. ' raindrops-expand-width';

			} elseif ( false == $raindrops_current_column ) {

				$check = is_2col_raindrops( 'not-add-class', false );

				if ( false == $check ) {

					$class = $id;
				} elseif ( 'not-add-class' == $check ) {

					$class = $id. ' raindrops-expand-width';
				} else {

					$class = $id;
				}
			}
		}

		if ( 'yui-b' == $id ) {

			if ( 1 == $raindrops_current_column ) {

				$class = $id. " raindrops-expand-width raindrops-margin-left-none";

			} else {

				$class = $id;
			}
		}
		if ( 'yui-main' == $id ) {

			if ( 1 == $raindrops_current_column && true == $raindrops_keep_content_width ) {

				$class = $id.  " raindrops-keep-content-width";

			} else {

				$class = $id;
			}
		}

		if ( false !== $echo ) {

			if ( !empty( $class ) ) {

				echo  $class;
			}
		} else {

			if ( !empty( $class ) ) {

				return  $class;
			} else {

				return;
			}
		}
	}

}
/**
 *
 *
 *
 *
 */
if ( !function_exists( 'raindrops_debug_navitation' ) ) {

	function raindrops_debug_navitation( $template ) {

		if ( true == WP_DEBUG ) {

			echo '<!--' . basename( $template, '.php' ) . '[' . basename( dirname( __FILE__ ) ) . ']-->';
		}
	}

}
/**
 *
 *
 *
 *
 */
if ( !function_exists( 'raindrops_doctype_elements' ) ) {

	function raindrops_doctype_elements( $xhtml, $html5, $echo = true ) {

		global $raindrops_document_type;

		if ( true == $echo ) {

			echo $$raindrops_document_type;
		} else {

			return $$raindrops_document_type;
		}
	}
}
/**
 * Switch elements from div to figure when doctype html5
 *
 *
 * @since 1.003
 */
if ( !function_exists( 'raindrops_img_caption_shortcode_filter' ) ) {

	function raindrops_img_caption_shortcode_filter( $val, $attr, $content = null ) {

		global $raindrops_document_type;
		extract( shortcode_atts( array( 'id' => '', 'align' => '', 'width' => '', 'caption' => '' ), $attr ) );

		if ( 'html5' == $raindrops_document_type ) {

			if ( 1 > (int) $width && empty( $caption ) )
				return $val;
			$capid = '';

			if ( $id ) {

				$id		 = esc_attr( $id );
				$capid	 = 'id="figcaption_' . $id . '" ';
				$id		 = 'id="' . $id . '" aria-labelledby="figcaption_' . $id . '" ';
			}
			$html = '<figure %1$s class="wp-caption %2$s" style="width:%3$spx">%4$s<figcaption %5$s class="wp-caption-text">%6$s</figcaption></figure>';
			return sprintf( $html, $id, esc_attr( $align ), ( 10 + (int) $width ), do_shortcode( $content ), $capid, $caption );
		}
		return $val;
	}

}
/**
 *
 *
 *
 * @since 1.002
 */
if ( !function_exists( 'raindrops_featured_image' ) ) {

	function raindrops_featured_image() {

		global $post, $is_IE, $raindrops_featured_image_full_size, $raindrops_use_featured_image_light_box;

		$raindrops_featured_image_enable = apply_filters( 'raindrops_featured_image_enable', true );
		
		if( is_single() && "hide" == raindrops_warehouse_clone( 'raindrops_featured_image_singular' ) ) {
			$raindrops_featured_image_enable = false;
		}

		if ( post_password_required() || !has_post_thumbnail() || false == $raindrops_featured_image_enable ) {

			return;
		}
		/**
		 * Show featured image
		 *
		 *
		 *
		 *
		 */
		if ( true == $raindrops_featured_image_full_size ) {
			$thumb = get_the_post_thumbnail( $post->ID, 'full' );
		} else {
			$thumb = get_the_post_thumbnail( $post->ID, 'single-post-thumbnail' );
		}

		if ( has_post_thumbnail() && isset( $thumb ) && $is_IE && $raindrops_use_featured_image_light_box == false ) {

			/* IE8 img element has width height attribute. and style max-width and height auto makes conflict expand height */
			$thumbnailsrc	 = wp_get_attachment_image_src( get_post_thumbnail_id(), 'single-post-thumbnail' );
			$thumbnailuri	 = esc_url( $thumbnailsrc[ 0 ] );
			$thumbnailwidth	 = $thumbnailsrc[ 1 ];

			if ( $thumbnailwidth > $content_width ) {

				$thumbnailheight = $thumbnailsrc[ 2 ];
				$ratio			 = round( RAINDROPS_SINGLE_POST_THUMBNAIL_HEIGHT / RAINDROPS_SINGLE_POST_THUMBNAIL_WIDTH, 2 );
				$ie_height		 = round( $content_width * $ratio );
				$thumbnail_title = basename( $thumbnailsrc[ 0 ] );
				$thumbnail_title = esc_attr( $thumbnail_title );
				$size_attribute	 = image_hwstring( $content_width, $ie_height );
				echo '<div class="single-post-thumbnail">';
				echo '<img src="' . $thumbnailuri . '" ' . $size_attribute . '" alt="' . $thumbnail_title . '" />';
				echo '</div>';
			} else {

				echo '<div class="single-post-thumbnail">';
				echo $thumb;
				echo '</div>';
			}
		} else {

			$raindrops_post_thumbnail_src	 = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full', false, '' );
			$flag							 = true;

			if ( 'w3standard' == raindrops_warehouse( 'raindrops_style_type' ) || false == $raindrops_use_featured_image_light_box ) {

				//Sorry w3standard css can not use CSS3 then remove light box
				$flag = false;
			}

			if ( !empty( $thumb ) ) {

				echo '<div class="single-post-thumbnail">';

				if ( $flag ) {

					echo '<a href="#raindrops-light-box" class="raindrops-light-box">';
				} else {

					printf( '<a href="%1$s">', get_attachment_link( get_post_thumbnail_id() ) );
				}
				echo $thumb;

				if ( $flag ) {

					echo '</a>';
				}
				echo '</div>';
				/* for light box */
				if ( $flag ) {

					echo '<div class="raindrops-lightbox-overlay" id="raindrops-light-box">';
					echo '<a href="#page" class="lb-close">Close</a>';
					echo '<img src="' . $raindrops_post_thumbnail_src[ 0 ] . '" alt="single post thumbnail" />';
					echo '</div>';
				}
			}
		}
		/**
		 * Add navigation link for post thumbnail
		 *
		 *
		 *
		 *
		 */
		if ( has_post_thumbnail() && true == $raindrops_use_featured_image_light_box ) {

			$raindrops_html_piece = '<p style="text-align:center;font-size:small;"><a href="%1$s">%2$s</a></p>';
			printf( $raindrops_html_piece, get_attachment_link( get_post_thumbnail_id() ), esc_html__( 'Go to Attachment page', 'Raindrops' ) );
		}
	}

}
/**
 * raindrops loop class
 *
 *
 *
 *
 * ver 1.001
 */
if ( !function_exists( 'raindrops_loop_class' ) ) {

	function raindrops_loop_class( $raindrops_loop_number, $raindrops_tile_post_id = '', $add_class = '' ) {

		if ( is_front_page() || is_home() ) {

			$id				 = get_option( 'page_on_front' );
			$template_name	 = basename( get_page_template_slug( $id ), '.php' );
		} elseif ( is_page() ) {

			global $template;
			$template_name = basename( $template, '.php' );
		} else {

			$template_name = '';
		}
		$str_class				 = '';
		$raindrops_background	 = '';

		if ( is_array( $add_class ) ) {

			foreach ( $add_class as $class ) {

				$str_class = ' ' . $class;
			}
		} else {

			$str_class = ' ' . $add_class;
		}
		$post_formats = get_post_format_slugs();

		foreach ( $post_formats as $key => $val ) {

			if ( has_post_format( $val ) ) {

				$str_class .= ' loop-post-format-' . $val;
			}
		}
		$raindrops_loop_five = $str_class;

		//	if ( 'front-portfolio' == $template_name ) {

		if ( 12 == $raindrops_loop_number ) {

			$raindrops_loop_number = 0;
		} elseif ( 0 == $raindrops_loop_number % 5 ) {

			$raindrops_loop_five .= ' loop-five';
		}

		if ( !empty( $raindrops_tile_post_id ) ) {

			$post_thumbnail_id		 = get_post_thumbnail_id( $raindrops_tile_post_id );
			$raindrops_background	 = wp_get_attachment_image_src( $post_thumbnail_id, 'medium' );

			list( $raindrops_background, $width, $height ) = $raindrops_background;
		} else {
			$raindrops_background = false;
		}

		if ( !$raindrops_background ) {

			$raindrops_loop_five .= ' loop-item-show-allways';
		} else {

			$raindrops_background = 'style="background:url(  ' . $raindrops_background . '  );background-size:cover;"';
		}
		//	}
		return array( $raindrops_loop_number, $raindrops_loop_five, $raindrops_background );
	}

}
/**
 *
 *
 *
 * @since 1.103
 */
add_action( 'set_current_user', 'raindrops_postmeta_cap' );

if ( !function_exists( 'raindrops_postmeta_cap' ) ) {

	function raindrops_postmeta_cap() {

		if ( current_user_can( 'edit_pages' ) && RAINDROPS_CUSTOM_FIELD_CSS == true ) {

			add_filter( 'auth_post_meta_css', '__return_true', 5 );
		} else {

			add_filter( 'auth_post_meta_css', '__return_false', 5 );
		}

		if ( current_user_can( 'edit_pages' ) && RAINDROPS_CUSTOM_FIELD_SCRIPT == true ) {

			add_filter( 'auth_post_meta_javascript', '__return_true', 5 );
		} else {

			add_filter( 'auth_post_meta_javascript', '__return_false', 5 );
		}
		if ( current_user_can( 'edit_pages' ) && RAINDROPS_CUSTOM_FIELD_META == true ) {

			add_filter( 'auth_post_meta_meta', '__return_true', 5 );
		} else {

			add_filter( 'auth_post_meta_meta', '__return_false', 5 );
		}
	}

}
/**
 *
 *
 *
 *
 * @since 1.111
 */
if ( !class_exists( 'raindrops_unique_identifier_walker_nav_menu' ) ) {

	class raindrops_unique_identifier_walker_nav_menu extends Walker_Nav_Menu {

		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			global $wp_query;

			$classes	 = empty( $item->classes ) ? array() : (array) $item->classes;
			$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

			// build html
			$output .= '<li id="nav-menu-item-' . $item->ID . '" class="' . $class_names . '">';

			// link attributes
			$attributes = !empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
			$attributes .=!empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
			$attributes .=!empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
			$attributes .=!empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';

			$item_id = url_to_postid( $item->url );

			if ( $item_id == 0 ) {

			} else {

				$item->title			 = $item->title;
				$raindrops_aria_hidden	 = raindrops_doctype_elements( '', 'aria-hidden="true"', false );
				$item->title			 = sprintf( '<span class="raindrops_unique_identifier" %3$s>[Link to %1$s]</span>%2$s', $item_id, $item->title, $raindrops_aria_hidden );
			}

			$item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s', !empty( $args->before ) ? $args->before : '', $attributes, !empty( $args->link_before ) ? $args->link_before : '', apply_filters( 'raindrops_nav_menu_title', $item->title, $item->ID ), !empty( $args->link_after ) ? $args->link_after : '', !empty( $args->after ) ? $args->after : ''
			);

			// build html
			$output .= apply_filters( 'raindrops_unique_identifier_walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}

	}

}
/**
 *
 *
 *
 *
 *
 */
if ( !function_exists( 'raindrops_nav_menu_primary' ) ) {

	function raindrops_nav_menu_primary( $args = array() ) {
		global $raindrops_link_unique_text;

		$defaults = array(
			'theme_location'	 => 'primary',
			'menu'				 => '',
			'container'			 => 'div',
			'container_class'	 => 'menu-header',
			'container_id'		 => '',
			'menu_class'		 => 'menu',
			'menu_id'			 => '',
			'echo'				 => false,
			'fallback_cb'		 => 'wp_page_menu',
			'before'			 => '',
			'after'				 => '',
			'link_before'		 => '',
			'link_after'		 => '',
			'items_wrap'		 => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'depth'				 => 0,
			'walker'			 => '',
			'wrap_element_id'	 => 'access',
			'wrap_mobile_class'	 => 'raindrops-mobile-menu',
		);

		$args	 = wp_parse_args( $args, $defaults );
		$args	 = apply_filters( 'wp_nav_menu_args', $args );

		if ( "show" == raindrops_warehouse( 'raindrops_show_menu_primary' ) ) {

			if ( $raindrops_link_unique_text == true ) {

				$args[ 'walker' ]			 = new raindrops_unique_identifier_walker_nav_menu();
				$raindrops_nav_menu_primary	 = wp_nav_menu( $args );
			} else {

				$raindrops_nav_menu_primary = wp_nav_menu( $args );
			}

			$template = '<p class="' . $args[ 'wrap_mobile_class' ] . '">
						<a href="#access" class="open"><span class="raindrops-nav-menu-expand" title="nav menu expand">Expand</span></a><span class="menu-text">menu</span>
						<a href="#%1$s" class="close"><span class="raindrops-nav-menu-shrunk" title="nav menu shrunk">Shrunk</span></a>
						 </p>
						<%3$s id="' . esc_attr( $args[ 'wrap_element_id' ] ) . '">
						%2$s
						</%3$s>
						<br class="clear" />';

			do_action( 'raindrops_nav_menu_primary' );
			$html = sprintf( $template, esc_attr( raindrops_warehouse( 'raindrops_page_width' ) ), $raindrops_nav_menu_primary, raindrops_doctype_elements( 'div', 'nav', false ) );
			echo apply_filters( 'raindrops_nav_menu_primary_html', $html );
		} //raindrops_warehouse(  'raindrops_show_menu_primary'  )
	}

}

/**
 *
 *
 *
 *
 * @since 0.48
 */
if ( !function_exists( 'raindrops_post_class' ) ) {

	function raindrops_post_class( $class = '', $post_id = null, $echo = true ) {

		global $post, $template;
		$classes = get_post_class( $class, $post_id );


		if ( is_sticky() ) {

			$classes[] = 'raindrops-sticky';
		}
		$raindrops_content_empty_class = ''; // wp-includes/post-template.php:265 - Trying to get property of non-object
		if ( isset( $post ) ) {
			$raindrops_content_empty_class = trim( get_the_content() );
		}
		if ( isset( $template ) ) {

			$template_class = basename( $template, '.php' );
			$classes[] = 'rd-tpl-'. esc_attr( $template_class );
		}

		if ( empty( $raindrops_content_empty_class ) ) {

			$classes[] = 'raindrops-empty-content';
		}
		$raindrops_title_empty_class = trim( the_title( '', '', false ) );

		if ( empty( $raindrops_title_empty_class ) ) {

			$classes[] = 'raindrops-empty-title';
		}
		$raindrops_now			 = current_time( 'timestamp' );
		$raindrops_publish_time	 = get_the_time( 'U' );
		$raindrops_modified_time = get_the_modified_time( 'U' );
		$raindrops_period		 = apply_filters( 'raindrops_new_period', 3 );
		$raindrops_Period		 = 60 * 60 * 24 * $raindrops_period;

		if ( $raindrops_now < $raindrops_Period + $raindrops_publish_time ) {

			$classes[] = 'raindrops-pub-new ';
		}

		if ( $raindrops_now < $raindrops_Period + $raindrops_modified_time ) {

			$classes[] = 'raindrops-mod-new';
		}
		$classes = array_map( 'esc_attr', $classes );

		if ( true == $echo ) {

			echo 'class="' . join( ' ', $classes ) . '"';
		} else {

			return 'class="' . join( ' ', $classes ) . '"';
		}
	}

}
/**
 *
 *
 *
 *
 * @since 1.111
 */
add_filter( 'the_content', 'raindrops_chat_filter' );

if ( !function_exists( 'raindrops_chat_filter' ) ) {

	function raindrops_chat_filter( $contents ) {

		if ( !has_post_format( 'chat' ) ) {

			return $contents;
		} else {

			/* chat notation use : remove protocol from url */
			$contents = str_replace( array( 'http:', 'https:' ), '', $contents );
		}
		$new_contents = explode( '<p>', $contents );

		if ( 2 == count( $new_contents ) ) {

			return $contents;
		}
		$result			 = '';
		$prev_author_id	 = '';
		$html			 = '<dt class="raindrops-chat raindrops-chat-author-%1$s">%2$s</dt><dd class="raindrops-chat-text raindrops-chat-author-text-%1$s">%3$s</dd>';

		foreach ( $new_contents as $key => $new ) {

			preg_match( '|([^\:]+)(\:)(.+)|si', $new, $regs );

			if ( isset( $regs[ 1 ] ) && !empty( $regs[ 1 ] ) ) {

				$regs[ 1 ] = strip_tags( $regs[ 1 ] );
			}

			if ( isset( $regs[ 1 ] ) && !preg_match( '!(http|https|ftp)!', $regs[ 1 ] ) && !empty( $regs[ 1 ] ) ) {

				$result .= sprintf( $html, esc_attr( raindrops_chat_author_id( $regs[ 1 ] ) ), esc_html( $regs[ 1 ] ), $regs[ 3 ] );
			} else {

				if ( !empty( $new ) ) {
					$result .= '<dd>' . $new . '</dd>';
				}
			}
		}
		return apply_filters( 'raindrops_chat_filter', sprintf( '<dl class="raindrops-post-format-chat">%1$s</dl>', $result ) );
	}

}
/**
 *
 *
 *
 *
 * @since 1.111
 */
if ( !function_exists( 'raindrops_chat_author_id' ) ) {

	function raindrops_chat_author_id( $author ) {

		static $raindrops_chat_author_id = array();
		$raindrops_chat_author_id[]		 = $author;
		$raindrops_chat_author_id		 = array_unique( $raindrops_chat_author_id );
		return array_search( $author, $raindrops_chat_author_id );
	}

}

/**
 *
 *
 *
 *
 * @since 1.116
 */
function do_not_cache_feeds( $feed ) {
	$feed->enable_cache( false );
}

add_action( 'wp_feed_options', 'do_not_cache_feeds' );


if ( !function_exists( 'raindrops_link_unique' ) ) {

	function raindrops_link_unique( $text = '', $id = 0, $class = 'raindrops_unique_identifier' ) {

		global $raindrops_link_unique_text;

		if ( true == $raindrops_link_unique_text && !is_admin() ) {
			$raindrops_aria_hidden = raindrops_doctype_elements( '', 'aria-hidden="true"', false );
			$html	 = '<span class="%1$s" %4$s>[%2$s %3$s]</span>';
			$html	 = sprintf( $html, esc_attr( $class ), esc_attr( $text ), (int) $id , $raindrops_aria_hidden );
			return apply_filters( 'raindrops_link_unique', $html, $text, $id, $class );
		}
		return;
	}

}
/**
 *
 *
 *
 *
 * @since 1.118
 */
if ( !function_exists( 'raindrops_counter' ) ) {

	function raindrops_counter() {

		static $count = 1;
		return $count++;
	}

}
/**
 *
 *
 *
 *
 * @since 1.118
 */
if ( !function_exists( 'raindrops_accessible_titled' ) ) {

	function raindrops_accessible_titled( $link ) {

		/* care for screen reader */
		$link = str_replace( array( "title='", 'title="' ), array( "title='Archives ", 'title="Archives ' ), $link );
		return $link;
	}

}
/**
 *
 *
 *
 *
 * @since 1.118
 */
add_filter( 'image_send_to_editor', 'raindrops_remove_category_rel' );

if ( !function_exists( 'raindrops_remove_category_rel' ) ) {

	function raindrops_remove_category_rel( $output ) {

		$output = preg_replace( '!( rel="[^"]+")!', '', $output );
		return $output;
	}

}
add_filter( 'widget_posts_args', 'raindrops_remove_sticky_link_from_recent_post_widget' );

if ( !function_exists( 'raindrops_remove_sticky_link_from_recent_post_widget' ) ) {

	function raindrops_remove_sticky_link_from_recent_post_widget( $args ) {

		$args[ 'post__not_in' ] = get_option( 'sticky_posts' );
		return $args;
	}

}
/**
 * Entry title none breaking text breakable
 *
 *
 * test filter.
 * @since 1.119
 */
if ( isset( $raindrops_use_wbr_for_title ) && true == $raindrops_use_wbr_for_title ) {

	add_filter( 'the_title', 'raindrops_non_breaking_title' );
}

if ( !function_exists( 'raindrops_non_breaking_title' ) ) {

	function raindrops_non_breaking_title( $title ) {

		global $raindrops_document_type;
		//Floccinaucinihilipilification

		if ( !is_admin() && 'html5' == $raindrops_document_type ) {

			if ( preg_match( "/[\x20-\x7E]{30,}/", strip_tags( $title ) ) && preg_match( '!([A-Z])!', $title ) ) {

				return preg_replace( '!([A-Z])!', '<wbr>$1', $title );
			} elseif ( preg_match( "/[\x20-\x7E]{30,}/", strip_tags( $title ) ) ) {

				return preg_replace( '!([A-Z])!', '$1<wbr>', $title );
			}
		}
		return $title;
	}

}
/** raindrops_non_breaking_title() assist function
 * remove wbr escaped elements when another plugin escape title
 *
 *
 */
add_filter( 'esc_html', 'remove_wbr', 999 );

function remove_wbr( $content ) {

	return str_replace( array( '&lt;wbr&gt;', '&lt;/wbr&gt;' ), '', $content );
}

/**
 * Entry content none breaking text (  url  ) breakable
 *
 *
 * test filter.
 * @since 1.119
 */
add_filter( 'the_content', 'raindrops_non_breaking_content', 11 );

if ( !function_exists( 'raindrops_non_breaking_content' ) ) {

	function raindrops_non_breaking_content( $content ) {

		global $raindrops_document_type;
		//long url link text breakable

		if ( !is_admin() && 'html5' == $raindrops_document_type ) {

			return preg_replace_callback( "|>([-_.!˜*\'()a-zA-Z0-9;\/?:@&=+$,%#]{30,})<|", 'raindrops_add_wbr_content_long_text', $content );
		}
		return $content;
	}

}

if ( !function_exists( 'raindrops_add_wbr_content_long_text' ) ) {

	function raindrops_add_wbr_content_long_text( $matches ) {

		foreach ( $matches as $match ) {

			return preg_replace( '!([/])!', '$1<wbr>', $match );
		}
	}

}

if ( !function_exists( 'raindrops_poster' ) ) {

	function raindrops_poster( $args ) {

		$args_count	 = count( $args );
		$html		 = '<a href="%1$s" title="link to %2$s" class="page-featured-template">%3$s</a>';
		for ( $i = 0; $i < $args_count; $i++ ) {
			echo '<div class="line poster-row-' . ($i + 1) . '">';

			foreach ( $args[ $i ] as $key => $page_item ) {

				echo '<div class="' . $page_item[ 'class' ] . ' poster-col-' . ( $key + 1 ) . ' ' . esc_attr( $page_item[ 'type' ][ 0 ] ) . ' ">';

				do_action( 'raindrops_poster_before_' . ($i + 1) . '_' . ( $key + 1 ) );

				if ( 'include' == $page_item[ 'type' ][ 0 ] ) {

					if ( is_string( $page_item[ 'type' ][ 1 ] ) ) {

						locate_template( array( $page_item[ 'type' ][ 1 ] ), true, true );
					} elseif ( is_array( $page_item[ 'type' ][ 1 ] ) ) {

						locate_template( $page_item[ 'type' ][ 1 ], true, true );
					}
				}

				if ( 'widget' == $page_item[ 'type' ][ 0 ] ) {

					the_widget( $page_item[ 'type' ][ 1 ], $page_item[ 'type' ][ 2 ], $page_item[ 'type' ][ 3 ] );
				}

				if ( 'page' == $page_item[ 'type' ][ 0 ] || 'post' == $page_item[ 'type' ][ 0 ] ) {

					if ( is_numeric( $page_item[ 'type' ][ 1 ] ) ) {
						$raindrops_article_id = $page_item[ 'type' ][ 1 ];
					} elseif ( is_numeric( $page_item[ 'type' ][ 1 ][ 0 ] ) ) {
						$raindrops_article_id = $page_item[ 'type' ][ 1 ][ 0 ];
					} else {
						$raindrops_article_id = '';
					}
					?><div <?php
					if ( !empty( $raindrops_article_id ) ) {
						echo 'id="post-' . esc_attr( $raindrops_article_id );
					}
					?>"><<?php raindrops_doctype_elements( 'div', 'article' ); ?>
					 <?php raindrops_post_class( array( 'clearfix' ) ); ?>>
					<?php
					if ( is_numeric( $page_item[ 'type' ][ 1 ] ) ) {

						$content = get_post( $page_item[ 'type' ][ 1 ] );

						if ( !is_null( $content ) ) {

							$thumnail_exists = $content->__get( '_thumbnail_id' );
							$title			 = $content->post_title;
							$link			 = get_permalink( $page_item[ 'type' ][ 1 ] );
							$image			 = get_the_post_thumbnail( $page_item[ 'type' ][ 1 ] );

							if ( empty( $thumnail_exists ) ) {

								printf( '<h2 class="entry-title page-featured-template">' . $html . '</h2>', $link, esc_attr( strip_tags( $title ) ), $title );

								echo apply_filters( 'the_content', raindrops_add_more( $page_item[ 'type' ][ 1 ], $content->post_content ) );
							} else {

								$image = get_the_post_thumbnail( $page_item[ 'type' ][ 1 ] );
								printf( $html, $link, esc_attr( $title ), $image );
							}
						}
					} elseif ( is_array( $page_item[ 'type' ][ 1 ] ) ) {

						foreach ( $page_item[ 'type' ][ 1 ] as $id ) {

							$content = get_post( $id );

							if ( !is_null( $content ) ) {

								$title			 = get_the_title( $id );
								$link			 = get_permalink( $id );
								$thumnail_exists = $content->__get( '_thumbnail_id' );

								if ( empty( $thumnail_exists ) ) {

									printf( '<h2 class="entry-title page-featured-template">' . $html . '</h2>', $link, esc_attr( strip_tags( $title ) ), $title );


									echo apply_filters( 'the_content', raindrops_add_more( $id, $content->post_content ) );
								} else {

									$image = get_the_post_thumbnail( $id );
									printf( $html, $link, esc_attr( $title ), $image );
								}
							}
						}
					}
					?>
					 </<?php raindrops_doctype_elements( 'div', 'article' ); ?>></div>
					<?php
				}
				do_action( 'raindrops_poster_after_' . ($i + 1) . '_' . ( $key + 1 ) );
				echo '</div>';
			}
			echo '</div>';
		}
	}

}
/**
 * comment list class
 *
 *
 * since 1.136
 */
if ( !function_exists( 'raindrops_comment_class' ) ) {

	function raindrops_comment_class( $comment_class = array(), $add_start_attribute = true ) {

		$comment_class[] = 'commentlist';
		$comment_page	 = get_query_var( 'cpage' );

		if ( is_numeric( $comment_page ) ) {

			$comment_class[] = esc_attr( sprintf( 'comments-p%1$d', $comment_page ) );
		} else {

			$comment_page = '';
		}
		printf( 'class="%1$s"', join( ' ', $comment_class ) );

		if ( $add_start_attribute && !empty( $comment_page ) ) {

			$comment_per_page	 = get_option( 'comments_per_page' );
			$comment_page		 = $comment_page - 1;
			$start				 = ( $comment_page * $comment_per_page ) + 1;
			printf( ' start="%1$d"', $start );
		}
	}

}
/**
 *
 *
 *
 * since 1.136
 */
if ( !function_exists( 'raindrops_filter_header_text_color' ) ) {

	function raindrops_filter_header_text_color( $color ) {

		global $raindrops_fallback_human_interface_show;

		if ( true == $raindrops_fallback_human_interface_show ) {

			return 'blank';
		}
		return $color;
	}

}
	/**
	 *
	 *
	 *
	 * @since 1.148
	 */
if ( !function_exists( 'raindrops_list_of_posts' ) ) {

	function raindrops_list_of_posts() {

		global $raindrops_list_of_posts_per_page;
		global $raindrops_list_of_posts_length;
		global $raindrops_list_of_posts_more;
		global $raindrops_list_of_posts_use_toggle;

		$query = get_query_var( 'paged' );


		if ( !isset( $raindrops_list_of_posts_per_page ) ) {

			$raindrops_list_of_posts_per_page = get_option( 'posts_per_page' );
		}
		if ( !isset( $raindrops_list_of_posts_excerpt_length ) ) {

			$raindrops_list_of_posts_length = 200;
		}

		if ( !isset( $raindrops_list_of_posts_excerpt_more ) ) {

			$raindrops_list_of_posts_more = '[...]';
		}
		if ( !isset( $raindrops_list_of_posts_use_toggle ) ) {

			$raindrops_list_of_posts_use_toggle = true;
		}


		if ( !isset( $raindrops_list_of_posts_per_page ) ) {

			$raindrops_list_of_posts_per_page = get_option( 'posts_per_page' );
		}

		if ( $query == 0 ) {

			$start = 1;
		} else {

			$start = ($query - 1) * $raindrops_list_of_posts_per_page + 1;
		}

		$raindrops_args					 = array( 'post_status'	 => 'publish',
			'post_per_page'	 => $raindrops_list_of_posts_per_page,
			'paged'			 => $query,
		);
		$raindrops_list_of_post_query	 = new WP_Query( $raindrops_args );

			if ( $raindrops_list_of_post_query->have_posts() ) {
				?>
				<ol start="<?php echo $start; ?>" class="list-of-post-list">
				<?php
				while ( $raindrops_list_of_post_query->have_posts() ) {

					$raindrops_list_of_post_query->the_post();
					$raindrops_list_of_posts_empty_flag	 = false;
					?>
					<li id="post-<?php the_ID(); ?>" <?php raindrops_post_class( 'list-of-post-items' ); ?>>
						<?php
						raindrops_entry_title();
						?>
						<ul class="list-of-post-toggle">
							<?php
							$raindrops_list_of_posts_excerpt	 = apply_filters( 'the_content', get_the_content() );
							$raindrops_list_of_posts_excerpt	 = preg_replace( '!\[[^\]]*\]!', '', $raindrops_list_of_posts_excerpt );

							if ( empty( $raindrops_list_of_posts_excerpt ) ) {
								$raindrops_list_of_posts_excerpt	 = esc_html__( 'Empty content', 'Raindrops' );
								$raindrops_list_of_posts_empty_flag	 = true;
							}
							$raindrops_list_of_posts_contents	 = $raindrops_list_of_posts_excerpt;
							$raindrops_list_of_posts_excerpt	 = wp_html_excerpt( $raindrops_list_of_posts_excerpt, $raindrops_list_of_posts_length, $raindrops_list_of_posts_more );

							if ( $raindrops_list_of_posts_use_toggle == true ) {

								$raindrops_toggle_title_class	 = 'raindrops-toggle raindrops-toggle-title';
								$raindrops_toggle_content_class	 = 'raindrops-toggle';
							} else {

								$raindrops_toggle_title_class	 = 'no-toggle-title';
								$raindrops_toggle_content_class	 = 'no-toggle-content';
							}

							if ( $raindrops_list_of_posts_empty_flag == true ) {

								$raindrops_toggle_title_class	 = 'no-toggle-title';
								$raindrops_toggle_content_class	 = 'no-toggle-content';
							}

							printf( '<li class="%1$s">', $raindrops_toggle_title_class );

							echo $raindrops_list_of_posts_excerpt;

							if ( $raindrops_list_of_posts_use_toggle == true and $raindrops_list_of_posts_empty_flag == false ) {

								printf( '</li><li class="%1$s">', $raindrops_toggle_content_class );
								echo $raindrops_list_of_posts_contents;
							}
							?>
					</li>
				</ul>
				<div class="list-of-post-edit-link">
					<?php
					raindrops_delete_post_link( __( 'Trash', 'Raindrops' ), '<span class="delete-link">', '</span>' );

					edit_post_link( __( 'Edit', 'Raindrops' ), '<span class="edit-link">', '</span>' );
					?>
				</div>
			</li>
		<?php
			} //end while

			wp_reset_postdata();
		?>
		</ol>
		<?php
		} //end have_posts
		?>
		<div class="list-of-post-next-prev">
			<div class="left">
				<?php
				next_posts_link( __( '&laquo; Older Entries', 'Raindrops' ), $raindrops_list_of_post_query->max_num_pages )
				?>
			</div>
			<div class="right">
				<?php
				previous_posts_link( __( 'Newer Entries &raquo;', 'Raindrops' ), $raindrops_list_of_post_query->max_num_pages )
				?>
			</div>
		</div>
		<?php
	}
}

if ( !function_exists( 'raindrops_tile' ) ) {

	function raindrops_tile( $args = array() ) {

		global $query_string;

		$defaults		 = array(
			'posts_per_page'	 => 3,
			'numberposts'		 => -1,
			'orderby'			 => 'post_date',
			'order'				 => 'DESC',
			'post_type'			 => 'post',
			/* 'meta_key'        => '_thumbnail_id', */
			'post_status'		 => 'publish',
			'post__not_in'		 => get_option( 'sticky_posts' ),
			'raindrops_tile_col' => 3,
		);
		$args			 = wp_parse_args( $args, $defaults );
		$args[ 'paged' ] = get_query_var( 'page' );

		if ( !isset( $args[ 'paged' ] ) ) {

			$args[ 'paged' ] = 1;
		}
		if ( $args[ 'paged' ] > 0 ) {

			$args[ 'offset' ] = ( $args[ 'paged' ] - 1 ) * $args[ 'posts_per_page' ];
		} else {

			$args[ 'offset' ] = 0;
		}

		$raindrops_posts	 = get_posts( $args );
		$raindrops_html_page = '<li><a href="%1$s" class="%2$s"><span class="%3$st">%4$s</span></a></li>';

		if ( !empty( $raindrops_posts ) ) {
			?><div id="portfolio" class="portfolio column-<?php echo $args[ 'raindrops_tile_col' ]; ?>"><?php
			do_action( 'raindrops_tile_pre' );

			raindrops_loop_title();
			$raindrops_loop_number = 1;

			foreach ( $raindrops_posts as $post ) {

				setup_postdata( $post );
				$raindrops_loop_class = raindrops_loop_class( $raindrops_loop_number, $post->ID );

				printf( '<li class="loop-%1$s%2$s" %3$s>', trim( $raindrops_loop_class[ 0 ] ), apply_filters( 'raindrops_tile_class', ' ' . trim( $raindrops_loop_class[ 1 ] ), $post->ID ), apply_filters( 'raindrops_tile_style', $raindrops_loop_class[ 2 ], $post->ID )
				);

				$raindrops_loop_number++;
				?><div id="post-<?php echo $post->ID; ?>"><<?php raindrops_doctype_elements( 'div', 'article' ); ?> id="post-tile-<?php echo $post->ID; ?>" <?php raindrops_post_class( '', $post->ID ); ?> >
					<h2 class="entry-title"><a href="<?php echo get_permalink( $post->ID ); ?>">
							<?php
							$title	 = get_the_title( $post->ID );
							$title	 = wp_html_excerpt( $title, apply_filters( 'raindrops_tile_title_length', 40 ), apply_filters( 'raindrops_tile_title_more', '...' ) );

							echo raindrops_fallback_title( $title, $post->ID );
							?></a></h2>
					<div class="posted-on">
						<?php raindrops_posted_on(); ?>
					</div>
					<div class="entry-content clearfix">
						<a href="<?php echo get_comments_link( $post->ID ); ?>" class="raindrops-comment-link"><span class="raindrops-comment-string point"></span><em><?php esc_html_e( 'Comment', 'Raindrops' ); ?></em></a>
					</div>
					<div class="entry-meta">
						<?php edit_post_link( esc_html__( 'Edit', 'Raindrops' ) . raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>', $post->ID ); ?>
					</div>
					<br class="clear" />
					</<?php raindrops_doctype_elements( 'div', 'article' ); ?>></div>
				</li>
			<?php }//foreach( $raindrops_posts as $post )                                   ?>
			</ul>
			<br class="clear" />
			<?php
			$html = '';

			if ( 0 == $args[ 'paged' ] ) {

				if ( is_front_page() ) {

					$url	 = esc_url( add_query_arg( 'page', 2 ) ) . '#portfolio';
					$html	 = '<li><a href="' . esc_url( $url ) . '" title="page 2" class="portfolio-page2">' . esc_html__( 'Page', 'Raindrops' ) . '2</a></li>';
				} else {

					$url	 = esc_url( add_query_arg( 'page', 2 ) ) . '#portfolio';
					$html	 = '<li><a href="' . esc_url( $url ) . '" title="page 2" class="portfolio-page2">' . esc_html__( 'Page', 'Raindrops' ) . '2</a></li>';
				}
			} elseif ( $args[ 'paged' ] > 0 ) {

				$page	 = $args[ 'paged' ] + 1;
				$url	 = esc_url( add_query_arg( 'page', $page ) ). '#portfolio';
				$html	 = sprintf( $raindrops_html_page, esc_url( $url ), 'portfolio-next portfolio-' . $page, 'portfolio-nav-next', esc_html__( 'Page', 'Raindrops' ) . ' ' . $page
				);
			}

			$url = esc_url( add_query_arg( 'page', $args[ 'paged' ] ) ). '#portfolio';
			$raindrops_page_for_posts		 = get_option( 'page_for_posts' );
			$raindrops_html_page = '<li><a href="%1$s" class="%2$s"><span class="%3$st">%4$s</span></a></li>';

			if ( $args['post_type'] == 'post' && $raindrops_page_for_posts ){

				$html .= sprintf(
							$raindrops_html_page,
							esc_url( get_permalink( $raindrops_page_for_posts ) ),
							'portfolio-link-to-page-for-posts',
							'link-to-page-title',
							get_the_title( $raindrops_page_for_posts )
							);
			}

			if ( 2 == $args[ 'paged' ] ) {

				$page	 = $args[ 'paged' ] - 1;
				$url	 = esc_url( add_query_arg( 'page', $page ) ) . '#portfolio';
				$html .= sprintf( $raindrops_html_page, esc_url( $url ), 'portfolio-prev portfolio-home', 'portfolio-nav-prev', __( 'Portfolio Home', 'Raindrops' )
				);
			} elseif ( $args[ 'paged' ] > 2 ) {

				$page	 = $args[ 'paged' ];
				$page	 = $page - 1;
				$url	 = esc_url( add_query_arg( 'page', $page ) ). '#portfolio';
				$html .= sprintf( $raindrops_html_page, esc_url( $url ), 'portfolio-prev portfolio-' . $page, 'portfolio-nav-prev', esc_html__( 'Page', 'Raindrops' ) . ' ' . $page
				);
			}

			echo apply_filters( 'raindrops_portfolio_nav', sprintf( '<div class="portfolio-nav"><ul>%1$s</ul></div>', $html ) );
		} else { //! empty( $raindrops_posts )
			?><div  id="post-<?php the_ID(); ?>"><<?php raindrops_doctype_elements( 'div', 'article' ); ?> <?php raindrops_post_class( 'no-portfolio' ); ?> ><?php

				$url = remove_query_arg( 'page' , get_permalink() );

				$raindrops_html_page = '<p style="text-align:center;"><a href="%1$s" class="%2$s" ><span class="%3$st">%4$s</span></a></p>';
				if ( preg_match( '!page=!', $query_string ) ) {
					?><h3 style="text-align:center" class="h1 portfolio-navigation-last">End</h3><?php
					echo apply_filters( 'raindrops_portfolio_nav', sprintf( $raindrops_html_page, esc_url( $url ), 'portfolio-home', 'portfolio-home-text', esc_html__( 'Portfolio Home', 'Raindrops' )
					) );
				}
				echo apply_filters( 'raindrops_portfolio_nav', sprintf( $raindrops_html_page, home_url(), 'portfolio blog-home-link', 'portfolio-nav', esc_html__( 'Home', 'Raindrops' )
				) );
				?></<?php raindrops_doctype_elements( 'div', 'article' ); ?>></div><?php
			}
			wp_reset_postdata();
			do_action( 'raindrops_tile_after' );
			?>
		</div>
		<?php
	}
}
/**
 *
 *
 *
 * @since 1.150
 */
if ( !function_exists( 'raindrops_add_more' ) ) {

	function raindrops_add_more( $id, $content, $more_link_text = null ) {

		global $multipage, $page;

		$pre	 = apply_filters( 'raindrops_add_more_before', '' );
		$after	 = apply_filters( 'raindrops_add_more_after', '' );
		$html	 = ' <div class="raindrops-more-wrapper">' . $pre . '<a href="%1$s%2$s" class="poster-more-link">%3$s</a>' . $after . '</div>';
		if ( empty( $more_link_text ) ) {

			$raindrops_aria_hidden = raindrops_doctype_elements( '', 'aria-hidden="true"', false );
			$more_link_text = esc_html__( 'Continue&nbsp;reading ', 'Raindrops' ) . '<span class="meta-nav" '. $raindrops_aria_hidden. '>&rarr;</span><span class="more-link-post-unique">' . esc_html__( '&nbsp;Post ID&nbsp;', 'Raindrops' ) . $id . '</span>';
		}
		$output			 = '';
		$strip_teaser	 = false;
		$more			 = false;

		if ( preg_match( '/<!--noteaser-->/', $content, $matches ) ) {

			$fragment_identifier = '';
		} else {

			$fragment_identifier = '#more-' . $id;
		}

		if ( preg_match( '/<!--more(.*?)?-->/', $content, $matches ) ) {

			$content = explode( $matches[ 0 ], $content, 2 );

			if ( !empty( $matches[ 1 ] ) ) {

				$more_link_text = esc_html( $matches[ 1 ] );
			}

			if ( !empty( $matches[ 1 ] ) && !empty( $more_link_text ) ) {
				$more_link_text = strip_tags( wp_kses_no_null( trim( $matches[ 1 ] ) ) );
			}
			$more = true;
		}

		if ( is_array( $content ) ) {

			$content = $content[ 0 ];
			$content .= apply_filters( 'the_content_more_link', sprintf( $html, get_permalink( $id ), $fragment_identifier, $more_link_text
			), $more_link_text
			);

			$content = force_balance_tags( $content );

			return apply_filters( 'raindrops_add_more', $content, $more );
		} else {

			return apply_filters( 'raindrops_add_more', $content, $more );
		}
	}
}
/**
 *
 *
 *
 * @since 1.211
 */

if ( !function_exists( 'raindrops_status_bar' ) ) {

	function raindrops_status_bar() {
		global $raindrops_status_bar, $post;

		/**
		*
		* Show Raindrops status bar at browser bottom
		*
		* shows true hide false
		* @since 1.211
		*/

		$customizer_modify_value = raindrops_warehouse_clone( 'raindrops_status_bar' );

		if ( 'show' !== $customizer_modify_value ) {

			$raindrops_status_bar = false;
		} else {
			$raindrops_status_bar = true;	
		}		
		
		if ( $raindrops_status_bar !== true ) {

			return;
		}
		?>
		<div id="raindrops_status_bar">
			<?php
			do_action( 'raindrops_status_bar_before' );

			$link_to_top = '<p class="move-to-top"><a href="#top">top</a></p>';
			echo apply_filters( 'raindrops_status_bar_top', $link_to_top );

			if ( 'posts' == get_option( 'show_on_front' ) ) {
				if ( is_month() ) {
					raindrops_monthly_archive_prev_next_navigation();
				}
			}

			?>
			<div class="raindrops-next-prev-links">
				<?php raindrops_next_prev_links( 'nav-status-bar' ); ?>
			</div>
			<div class="raindrops_prev_next_post">
				<?php
				if ( is_single() ) {
					raindrops_prev_next_post( 'nav-status-bar' );
				}
				?>
			</div>
			<?php

			if ( is_page() ) {
				?>
				<div class="child-pages">

					<?php
					$args = array(
						'post_type'		 => 'page',
						'post_status'	 => 'publish',
						'numberposts'	 => -1,
						'order'			 => 'ASC',
						'orderby'		 => 'post_title',
						'post_parent'	 => $post->ID, );

					$html = '<a href="%1$s">%2$s</a>';

					$child_pages = query_posts( $args );

					if ( !empty( $child_pages ) && is_array( $child_pages ) ) {

						$number = count( $child_pages );
						?>
						<span class="status-bar-page-title"><?php echo _nx( 'Child Page : ', 'Child Pages : ', $number, '', 'Raindrops' ); ?></span>
						<?php
						foreach ( $child_pages as $child ) {
							$permalink	 = apply_filters( 'the_permalink', get_permalink( $child->ID ) );
							$title		 = apply_filters( 'the_title', $child->post_title );

							printf( $html, $permalink, $title );

							if ( end( $child_pages ) !== $child ) {

								echo ' , ';
							}
						}
					}
					wp_reset_query();
					?>
				</div>
			</div>
			<?php } //is_page()            ?>
			<?php do_action( 'raindrops_status_bar_after' ); ?>
		</div>
		<?php
	}
}
if ( !function_exists( 'raindrops_base_font_size' ) ) {
/**
 *
 * @global type $raindrops_base_font_size
 * @param type $content
 * @return int
 */
	function raindrops_base_font_size( $content ) {

		global $raindrops_base_font_size;
		if ( isset( $raindrops_base_font_size ) && is_numeric( $raindrops_base_font_size ) ) {
			return $raindrops_base_font_size;
		} else {
			return 13;
				// YUI2 base font size
		}
	}
}
/**
 *
 *
 *
 * @since 1.229
 */
if ( !function_exists( 'raindrops_widget_tag_cloud_args' ) ) {

	function raindrops_widget_tag_cloud_args( $args ) {

		$args[ 'smallest' ]	 = '100';
		$args[ 'largest' ]	 = '300';
		$args[ 'unit' ]		 = '%';

		return $args;
	}
}
if ( ! function_exists('raindrops_widget_ids') ) {

	function raindrops_widget_ids( $sidebars_widgets ) {

		global $raindrops_theme_settings;

		if ( $raindrops_theme_settings !== 'no' ) {
			$copy										 = $sidebars_widgets;
			unset( $copy[ "wp_inactive_widgets" ] );
			$raindrops_theme_settings[ 'widget_ids' ]	 = $copy;
			update_option( 'raindrops_theme_settings', $raindrops_theme_settings );
		}
		return $sidebars_widgets;
	}
}
/**
 *
 *
 * @since 1.231
 */
if ( !function_exists( 'raindrops_skip_links' ) ) {

	function raindrops_skip_links() {

		global $raindrops_theme_settings, $wp_widget_factory, $rsidebar_show,$wp_customize;
		
		if( isset( $wp_customize ) ) {
			return;
		}
		
		$result	 = '';
		$html	 = "\n". str_repeat("\t", 1 ). '<div class="skip-link"><a href="#%1$s" class="screen-reader-text" title="Skip to %2$s">Skip to %3$s</a></div>';
		if ( $raindrops_theme_settings !== 'no' ) {

			if ( isset( $raindrops_theme_settings[ 'widget_ids' ] ) ) {

				$copy = $raindrops_theme_settings[ 'widget_ids' ];

				if ( $rsidebar_show == false ) {

					unset( $copy[ 'sidebar-2' ] );
				}

				if ( is_singular() ) {

					return;
				}
				foreach ( $copy as $key => $array_val ) {
					if (isset( $array_val ) && is_array( $array_val ) ) {
						foreach ( $array_val as $val ) {

							$result .= sprintf( $html, wp_kses( $val, array() ), esc_attr( $val ), esc_html( strtoupper( $val ) ) );
						}
					}
				}
				return $result;
			}
		} else {

			$raindrops_id_bases = array(
				'WP_Widget_Categories'		 => 'categories',
				'WP_Widget_Archives'		 => 'archives',
				'WP_Widget_Calendar'		 => 'calendar',
				'WP_Widget_Pages'			 => 'pages',
				'WP_Widget_Recent_Comments'	 => 'recent-comments',
				'WP_Widget_RSS'				 => 'rss',
				'WP_Widget_Text'			 => 'text',
				'WP_Widget_Tag_Cloud'		 => 'tag_cloud',
				'WP_Nav_Menu_Widget'		 => 'nav_menu',
				'WP_Widget_Search'			 => 'search'
			);
			foreach ( $raindrops_id_bases as $key => $val ) {

				if ( is_active_widget( '', '', $val ) ) {

					$result .= sprintf( $html, wp_kses( $wp_widget_factory->widgets[ $key ]->id, array() ), esc_attr( $wp_widget_factory->widgets[ $key ]->name ), esc_html( $wp_widget_factory->widgets[ $key ]->name ) );
				}
			}
			return $result;
		}
	}

}
/**
 * Filter of paragraph correction
 *
 *
 * @param type $content
 * @return type
 * @sincd 1.231
 */
if ( !function_exists( 'raindrops_remove_wrong_p_before' ) ) {

	function raindrops_remove_wrong_p_before( $content ) {
		return str_replace( array( '<div>', '</div>' ), array( "<div>\n\n", "\n</div>" ), $content );
	}

}
if ( !function_exists( 'raindrops_remove_wrong_p' ) ) {

	function raindrops_remove_wrong_p( $content ) {

		$allblocks = '(?:table|thead|tfoot|caption|col|colgroup|tbody|tr|td|th|div|dl|dd|dt|ul|ol|li|pre|form|map|area|blockquote|address|math|style|h[1-6]|hr|fieldset|noscript|legend|section|article|aside|hgroup|header|footer|nav|figure|details|menu|summary)';
		/* 1.261 remove p at allblocks */
		$content = preg_replace( '!([^(<p>)]*)</p>(</' . $allblocks . '>)!', "$1$2", $content );
		$content = preg_replace( '!(<(select|del|option|canvas|mrow|svg|rect|optgroup) [^>]*>)(<br />|</p>)!', "$1", $content );
		$content = preg_replace( '!(</option>|</svg>|</figcaption>|<mrow>|<msup>|</msup>|</mi>|</mn>|</mrow>|</mo>|</rect>|</button>|</optgroup>|</select>)<br />!', "$1", $content );
		$content = preg_replace( '!<p>\s*(</?(ins|del|msup)[^>]*>)\s*</p>!', "$1", $content );
		$content = preg_replace( '!(</?(svg|msup|keygen|command|canvas|datalist|script)[^>]*>)\s*</p>!', "$1", $content );
		$content = preg_replace( '!(<p>)(</?(svg|msup|keygen|command|canvas|datalist)[^>]*>)!', "$2", $content );
		$content = preg_replace( '!(<p>[^<]*)(</' . $allblocks . '>)!', "$1</p>$2", $content );
		$content = preg_replace( '!(<' . $allblocks . '[^>]*>[^<]*)</p>!', "$1", $content );
		$content = preg_replace( '!(<' . $allblocks . '[^>]*>)([^(<|\s)]+)<p>!', "$1<p>$2</p>", $content );
		$content = str_replace( 'class="wp-caption-text"></p>', 'class="wp-caption-text">', $content );
		return $content;
	}
}

/**
 *
 *
 * @since 1.234
 */
if ( !function_exists( 'raindrops_call_custom_css' ) ) {

	function raindrops_call_custom_css() {

		new raindrops_custom_css();
	}

}

/**
 *
 * post metabox
 * Raindrops indivisual CSS
 */

if ( !class_exists( 'raindrops_custom_css' ) ) {

	class raindrops_custom_css {

		public function __construct() {
			add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
			add_action( 'save_post', array( $this, 'save' ) );
		}

		public function add_meta_box( $post_type ) {

			$post_types = array( 'post', 'page' );

			if ( in_array( $post_type, $post_types ) ) {

				add_meta_box(
				'raindrops_custom_css'
				, esc_html__( 'Custom CSS For This Entry', 'Raindrops' )
				, array( $this, 'render_meta_box_content' )
				, $post_type
				, 'advanced'
				, 'high'
				);
			}
		}

		public function save( $post_id ) {

			if ( !isset( $_POST[ 'raindrops_inner_custom_box_nonce' ] ) ) {
				return $post_id;
			}

			$nonce = $_POST[ 'raindrops_inner_custom_box_nonce' ];

			if ( !wp_verify_nonce( $nonce, 'raindrops_inner_custom_box' ) ) {

				return $post_id;
			}
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {

				return $post_id;
			}
			if ( 'page' == $_POST[ 'post_type' ] ) {

				if ( !current_user_can( 'edit_page', $post_id ) )
					return $post_id;
			} else {

				if ( !current_user_can( 'edit_post', $post_id ) )
					return $post_id;
			}

			$data	 = sanitize_text_field( $_POST[ 'raindrops_custom_css_field' ] );
			$data	 = str_replace( array( "\n", "\r" ), '', $data );
			update_post_meta( $post_id, '_css', $data );

			if ( isset( $_POST[ 'add-to-front' ] ) && !empty( $_POST[ 'add-to-front' ] ) ) {

				$data = sanitize_text_field( $_POST[ 'add-to-front' ] );

					update_post_meta( $post_id, '_add-to-front', $data );

			}

			if ( isset( $_POST[ 'header-image-show' ] ) && !empty( $_POST[ 'header-image-show' ] ) ) {

				$data = sanitize_text_field( $_POST[ 'header-image-show' ] );

				update_post_meta( $post_id, '_raindrops_header_image_show', $data );
			}

			if ( isset( $_POST[ 'header-image-file' ] ) && !empty( $_POST[ 'header-image-file' ] ) ) {

				$data = sanitize_text_field( $_POST[ 'header-image-file' ] );

				update_post_meta( $post_id, '_raindrops_this_header_image', $data );
			}
		}

		public function render_meta_box_content( $post ) {

			do_action( ' raindrops_custom_css_pre' );
			$form					 = '';
			wp_nonce_field( 'raindrops_inner_custom_box', 'raindrops_inner_custom_box_nonce' );
			$value					 = get_post_meta( $post->ID, '_css', true );
			$value					 = str_replace( array( '{', '}', ), array( "{\n", "\n}\n", ), $value );
			$value					 = str_replace( '![^(\"|\')];!', ";\n", $value );
			$raindrops_restore_check = get_theme_mod( 'header_image', get_theme_support( 'custom-header', 'default-image' ) );
			$current_value_header	 = get_post_meta( $post->ID, '_raindrops_this_header_image', true );


			$form .= '<label for="%1$s">%2$s</label>'
			. '<textarea id="%1$s" name="%1$s" %4$s>%3$s</textarea>';

	/*
	 * 1.295 commentout Unnatural behavior
	 * 		$form .= '<div id="contextual-help-link-wrap-2" class="hide-if-no-js screen-meta-toggle button button-large">
			<a href="#contextual-help-wrap" id="contextual-help-link-2" class="show-settings" aria-controls="contextual-help-wrap" aria-expanded="false" style="text-decoration:none;">Help</a>
			</div>';*/
			 

			$raindrops_show_on_front					 = get_option( 'show_on_front' );// val posts or page
			$raindrops_static_front_page_id				 = get_option( 'page_on_front' );
			$raindrops_static_front_page_template_slug	 = basename( get_page_template_slug( $raindrops_static_front_page_id ) );
			$raindrops_current_screen					 = get_current_screen();
			$current_value								 = get_post_meta( $post->ID, '_add-to-front', true );
			$page_page_auto_include_template             = apply_filters( 'raindrops_page_auto_include_template', 'front-page.php' );
			
			if ( $raindrops_static_front_page_template_slug == $page_page_auto_include_template && $raindrops_current_screen->post_type == 'page' ) {

				$form .= '<h4>' . esc_html__( 'Add Front Page', 'Raindrops' ) . '</h4>';
				$form .= '<p><input type="radio" name="add-to-front" id="add-to-front" value="add" ' . checked( 'add', $current_value, false ) . ' />' . __( 'Add Front Page This Content', 'Raindrops' ) . '</p>';
				$form .= '<p><input type="radio" name="add-to-front" id="add-to-front" value="default" ' . checked( '', $current_value, false ) . checked( 'default', $current_value, false ) . '  />' . __( 'No Need', 'Raindrops' ) . '</p>';
			}

			/**
			 * 1.295 change conditional test
			 * if ( 'remove-header' !== $raindrops_restore_check && $raindrops_static_front_page_template_slug !== 'front-page.php' ) {
			 */
			if ( 'remove-header' !== $raindrops_restore_check && $raindrops_show_on_front !== 'page' ) {

				$form .= '<h4>' . esc_html__( 'Override header Image', 'Raindrops' ) . '</h4>';

				$images = get_uploaded_header_images();

				$form .= '<p><input type="radio" name="header-image-file" id="header-image-file" value="hide" ' . checked( 'hide', $current_value_header, false ) . ' />' . __( 'Hide Header Image', 'Raindrops' ) . '</p>';
				$form .= '<p><input type="radio" name="header-image-file" id="header-image-file" value="default" ' . checked( '', $current_value_header, false ) . checked( 'default', $current_value_header, false ) . '  />' . __( 'Default Image', 'Raindrops' ) . '</p>';
				$form .= '<div class="header-image-wrapper" style="max-height:320px;overflow-y:scroll;overflow-x:hidden;">';

				$header_image_html = '<p %1$s>'
				. '<input %2$s type="radio" name="header-image-file" id="header-image-file-%3$s" value="%3$s"  %4$s />'
				. '<label for="header-image-file-%3$s"><img src="%5$s" width="160" alt="header image %3$s"  /></label>'
				. '</p>';

				foreach ( $images as $image ) {
					$form .= sprintf(
					$header_image_html, 'style="display:inline-block;"', 'style="position:relative;top:-1em;"', $image[ 'attachment_id' ], checked( $image[ 'attachment_id' ], $current_value_header, false ), $image[ 'url' ]
					);
				}
				$form .= '</div>';

				$form .= '<p><a class="button button-large" href="' . admin_url( 'themes.php?page=custom-header' ) . '">' . esc_html__( 'Add Custom Header', 'Raindrops' ) . '</a></p>';
			}
			if ( $raindrops_static_front_page_template_slug == 'front-page.php' && 'page' == get_option('show_on_front') ) {

				$form .= '<h4>' . esc_html__( 'Override header Image', 'Raindrops' ) . '</h4>';
				$form .= '<p>'. esc_html__( 'Now Selected Front Page template,You can use Featured Image for override header image', 'Raindrops' ). '</p>';

			}

			printf( $form, 'raindrops_custom_css_field', __( 'The Custom CSS Field only for the current post', 'Raindrops' ), esc_textarea( $value ), 'style="width:100%;height:13em;font-size:1.3em;"'
			);

			do_action( ' raindrops_custom_css_after' );
		}
	}
}


/**
 *
 * @param type $out
 * @param type $pairs
 * @param type $atts
 * @return string
 */


if ( !function_exists( 'raindrops_play_list_add_atts' ) ) {

	function raindrops_play_list_add_atts( $out, $pairs, $atts ) {
		global $post;
		if ( !is_singular() ) {

			$color_type = raindrops_warehouse_clone( 'raindrops_style_type' );

			if ( 'dark' == $color_type ) {

				$out[ 'style' ] = 'dark';
			}
		} else {

			$raindrops_content_check = get_post( $post->ID );
			$raindrops_content_check = $raindrops_content_check->post_content;

			if ( preg_match( "!\[raindrops[^\]]+(color_type)=(\"|')*?([^\"' ]+)(\"|' )*?[^\]]*\]!si", $raindrops_content_check, $regs ) ) {

				if ( 'dark' == trim( $regs[ 2 ] ) ) {

					$out[ 'style' ] = 'dark';
				}
			} else {

				$color_type = raindrops_warehouse_clone( 'raindrops_style_type' );

				if ( 'dark' == $color_type ) {

					$out[ 'style' ] = 'dark';
				}
			}
		}
		return $out;
	}
}
if ( !function_exists( 'raindrops_complementary_color' ) ) {

	function raindrops_complementary_color( $hex_color = '#444' ) {
	
		return raindrops_complementary_color_clone( $hex_color );
	}

}

if ( !function_exists( 'raindrops_add_complementary_color' ) ) {

	function raindrops_add_complementary_color() {

		if ( 'yes' == raindrops_warehouse_clone( 'raindrops_complementary_color_for_title_link' ) ) {

			$raindrops_link_color			 = raindrops_warehouse_clone( 'raindrops_hyperlink_color' );
			$raindrops_complementary_color	 = raindrops_complementary_color( $raindrops_link_color );
			$raindrops_css					 = sprintf( '.entry-title span{color:%1$s;}', $raindrops_complementary_color );
			$raindrops_css					 = apply_filters( 'raindrops_add_complementary_color', $raindrops_css, $raindrops_link_color, $raindrops_complementary_color );
			wp_add_inline_style( 'style', $raindrops_css );
		}
	}

}
if ( !function_exists( 'raindrops_oembed_filter' ) ) {

	/**
	 *
	 * @param type $html
	 * @param type $url
	 * @param type $attr
	 * @param type $post_ID
	 * @return type string html
	 * @since 1.246
	 */
	function raindrops_oembed_filter( $html, $url, $attr, $post_ID ) {
		global $is_IE;
		if ( ! $is_IE ) {

			$html = str_replace( 'frameborder="0"', '', $html );
		}

		$element = raindrops_doctype_elements( 'div', 'figure', false );
		if ( !preg_match( '!(twitter.com|tumblr.com)!', $url ) ) {
			return sprintf( '<%2$s class="oembed-container clearfix">%1$s</%2$s>', $html, $element );
		}
		return $html;
	}

}

/**
 * Change color type styles from embed head element to external link
 *
 * @since 1.254
 */
global $wp_customize;

if ( ! isset( $wp_customize )  ) {
	/**
	 * @1.254
	 */
	 add_action( 'after_setup_theme', 'raindrops_setup_style_loader' );
}

if ( !function_exists( 'raindrops_setup_style_loader' ) ) {
	/**
	 *
	 * @1.254
	 */
    function raindrops_setup_style_loader(){
		global $raindrops_stylesheet_type;
		if( $raindrops_stylesheet_type == 'external' ) {
			//@ see line:501 query var
			add_action( 'wp_enqueue_scripts', 'raindrops_register_color_type_style' ,99 );
			add_action( 'template_redirect', 'raindrops_color_type_style_buffer');
		}
    }
}
add_action( 'send_headers','raindrops_dinamic_css_header' );

add_action( 'save_post', 'raindrops_blog_last_modified_date',10, 2 );

if ( !function_exists( 'raindrops_blog_last_modified_date' ) ) {

	function raindrops_blog_last_modified_date( $post_id, $post ){

		set_theme_mod( 'raindrops_blog_last_modified_date', gmdate( 'D, d M Y H:i:s \G\M\T', time() ) );
	}
}
if ( !function_exists( 'raindrops_dinamic_css_header' ) ) {

	function raindrops_dinamic_css_header( $headers ){

		if ( preg_match( '!raindrops_color_type=1!', $_SERVER['QUERY_STRING'] ) ) {

			header( 'Content-type: text/css' );
			header("Cache-Control: public, maxage=3600");
			header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() + 3600));
			header("Pragma: cache");
			$last_modified = get_theme_mod('raindrops_blog_last_modified_date');
			if( ! empty( $last_modified ) ) {
				header('Last-Modified:'. $last_modified );
			}
		}
	}
}

if ( !function_exists( 'raindrops_register_color_type_style' ) ) {
	/**
	 *
	 * @global type $raindrops_current_data_version
	 * @1.254
	 */
    function raindrops_register_color_type_style() {

		global $raindrops_current_data_version,$post,$posts,$raindrops_current_column;
		$query = '';
		$count = count( $posts );
		if( isset($post) && $count == 1 ) {

			$query = sprintf( '&amp;raindrops_pid=%1$s', $post->ID);
		}
			$version     = md5( raindrops_embed_css() );

            wp_register_style( 'raindrops_color_type', sprintf('/?%1$s=1%2$s&amp;qcAC=1', 'raindrops_color_type', $query ),array(), $version );
            wp_enqueue_style( 'raindrops_color_type' );

    }
}
if ( !function_exists( 'raindrops_color_type_style_buffer' ) ) {
	/**
	 *
	 * @1.254
	 */
    function raindrops_color_type_style_buffer( ) {
		global $raindrops_fallback_human_interface_show,$post,$raindrops_current_column;

        if( intval( get_query_var( 'raindrops_color_type' ) ) == 1 ) {
			if( $raindrops_fallback_human_interface_show == true ) { exit;}
			
			do_action( 'raindrops_external_css_pre');

			$style = apply_filters('raindrops_color_type_style_buffer',raindrops_embed_css());


			if( ! defined( 'WP_DEBUG') || WP_DEBUG == false ) {

				//$style = preg_replace('!('. wp_spaces_regexp() .'){2,}!', ' ', $style );
			}
			ob_start();
			$css     = $style;
			$css     = wp_kses( $css, array() );
			$css = str_replace( array("&gt;",'raindrops_color_ja'),array('>',''),$css);
			echo $css;
			exit;
			ob_clean();
        }
    }
}
if ( !function_exists( 'raindrops_unique_entry_title' ) ) {

	function raindrops_unique_entry_title( $postid = '', $echo = false ) {

		global $post;

		if ( isset( $post ) && empty( $postid ) ) {
			$postid = $post->ID;
		} elseif ( empty( $post ) ) {
			return;
		}

		$post_object	 = get_post( $postid );
		$post_name		 = $post_object->post_name;
		$unique_title	 = urldecode( wp_unique_post_slug( $post_name, $post->ID, 'publish', 'post', 0 ) );

		preg_match( '!(.+)(-[0-9]+)$!', $unique_title, $regs );

		if ( isset( $regs[ 2 ] ) ) {

			if ( true == $echo ) {

				echo esc_html( $regs[ 2 ] );
			} else {

				return esc_html( $regs[ 2 ] );
			}
		}
	}
}
if ( ! function_exists( 'raindrops_footer_text' ) ) {

	function raindrops_footer_text() {

		global $raindrops_current_theme_name, $raindrops_current_data_theme_uri, $template, $raindrops_accessibility_link;

		$raindrops_copyright_text = sprintf( apply_filters( 'raindrops_copyright_text' , '&copy;%1$s '. $raindrops_current_theme_name. ' ') ,  date( "Y" ) );

		$raindrops_address_html = '<address>';

		$raindrops_address_html .= apply_filters( 'raindrops_prepend_footer_address', '' );

		$raindrops_address_rss =  "\n". str_repeat("\t", 2 ). '<small>%1$s<a href="%2$s" class="entry-rss">%3$s</a>' .
								  "\n". str_repeat("\t", 3 ). '<span>'. esc_html__( 'and', 'Raindrops' ) . '</span>' .
								  "\n". str_repeat("\t", 2 ). '<a href="%4$s" class="comments-rss">%5$s</a>';

		$raindrops_address_html .= sprintf( $raindrops_address_rss, $raindrops_copyright_text, get_bloginfo( 'rss2_url' ), esc_html__( "Entries RSS", "Raindrops" ), get_bloginfo( 'comments_rss2_url' ), esc_html__( 'Comments RSS', "Raindrops" )
		);

		$raindrops_address_html .= '</small> ';

		if ( is_child_theme() ) {

			$raindrops_theme_name = 'Child theme ' . esc_html( ucwords( $raindrops_current_theme_name ) ) . ' of ' . esc_html__( "Raindrops Theme", "Raindrops" );
		} else {

			$raindrops_theme_name = esc_html__( "Raindrops Theme", "Raindrops" );
		}

		$raindrops_address_html .= sprintf(  "\n". str_repeat("\t", 2 ). '<small><a href="%s">%s</a></small> ', $raindrops_current_data_theme_uri, $raindrops_theme_name
		);

		$raindrops_address_html .= apply_filters( 'raindrops_append_footer_address', '' );

		$raindrops_address_html .= "\n". str_repeat("\t", 1 ). '</address>';

		echo apply_filters( 'raindrops_footer_text', $raindrops_address_html );
	}

}

if ( ! function_exists( 'raindrops_wp_headers' ) ) {

	function raindrops_wp_headers($headers, $this ) {

		global $raindrops_xhtml_media_type;
		
		/**
		* xhtml media type
		* value 'application/xhtml+xml' or 'text/html'
		*/
	   if ( ! isset( $raindrops_xhtml_media_type ) ) {

		   $raindrops_xhtml_media_type = raindrops_warehouse_clone( 'raindrops_xhtml_media_type' );
	   }
		if( !is_admin()
			&& !is_user_logged_in()
			&& 'xhtml' == raindrops_warehouse_clone( 'raindrops_doc_type_settings' )
			&& $raindrops_xhtml_media_type == 'application/xhtml+xml' ) {

			$headers["Content-Type"] = $raindrops_xhtml_media_type. '; charset='. get_bloginfo( 'charset' );
			add_filter( 'option_html_type', 'raindrops_xhtml_media_type', 10 );

		}

		return $headers;
	}
}
if ( ! function_exists( 'raindrops_xhtml_media_type' ) ) {

	function raindrops_xhtml_media_type( $type ) {
		global $raindrops_xhtml_media_type;

		if( !is_admin()
			&& !is_user_logged_in()
			&& 'xhtml' == raindrops_warehouse_clone( 'raindrops_doc_type_settings' )
			&& $raindrops_xhtml_media_type == 'application/xhtml+xml' ) {

			return $raindrops_xhtml_media_type;
		}
		return $type;
	}
}
if ( ! function_exists( 'raindrops_xhtml_http_equiv' ) ) {

	function raindrops_xhtml_http_equiv( $output = true ) {
		global $raindrops_xhtml_media_type;
			if( $raindrops_xhtml_media_type == 'text/html'  && 'xhtml' == raindrops_warehouse_clone( 'raindrops_doc_type_settings' ) ) {
/**
 * By already header (), htmltype and charset has been sent
 */
			//	printf( '<meta http-equiv="content-type" content="'. get_bloginfo( 'html_type' ).'" charset="'. strtolower ( get_bloginfo( 'charset' ) ) .'" />'. "\n" );
				printf( '<meta http-equiv="content-script-type" content="text/javascript" />'. "\n" );
				printf( '<meta http-equiv="content-style-type" content="text/css" />'. "\n" );
			}
	}
}

add_action( 'save_post', 'raindrops_register_webfonts', 10, 3 );

if ( !function_exists( 'raindrops_register_webfonts' ) ) {
/**
 *
 * @param type $post_ID
 * @param type $post
 * @param type $update
 * @return boolean
 * @1.264
 */
	function raindrops_register_webfonts( $post_ID, $post, $update ) {

		if ( !current_user_can('edit_posts') ) { return false; }

		$early_access	 = array('alefhebrew' , 'amiri' , 'dhurjati' , 'dhyana' , 'droidarabickufi' , 'droidarabicnaskh' , 'droidsansethiopic' , 'droidsanstamil' , 'droidsansthai' , 'droidserifthai' , 'gidugu' , 'gurajada' , 'hanna' , 'jejugothic' , 'jejuhallasan' , 'jejumyeongjo' , 'karlatamilinclined' , 'karlatamilupright' , 'kopubbatang' , 'lakkireddy' , 'laomuangdon' , 'laomuangkhong' , 'laosanspro' , 'lateef' , 'lohitbengali' , 'lohitdevanagari' , 'lohittamil' , 'mallanna' , 'mandali' , 'myanmarsanspro' , 'nats' , 'ntr' , 'nanumbrushscript' , 'nanumgothic' , 'nanumgothiccoding' , 'nanummyeongjo' , 'nanumpenscript' , 'notokufiarabic' , 'notonaskharabic' , 'notonastaliqurdudraft' , 'notosansarmenian' , 'notosansbengali' , 'notosanscherokee' , 'notosansdevanagari' , 'notosansdevanagariui' , 'notosansethiopic' , 'notosansgeorgian' , 'notosansgujarati' , 'notosansgurmukhi' , 'notosanshebrew' , 'notosansjapanese' , 'notosanskannada' , 'notosanskhmer' , 'notosanskufiarabic' , 'notosanslao' , 'notosanslaoui' , 'notosansmalayalam' , 'notosansmyanmar' , 'notosansosmanya' , 'notosanssinhala' , 'notosanstamil' , 'notosanstamilui' , 'notosanstelugu' , 'notosansthai' , 'notosansthaiui' , 'notoserifarmenian' , 'notoserifgeorgian' , 'notoserifkhmer' , 'notoseriflao' , 'notoserifthai' , 'opensanshebrew' , 'opensanshebrewcondensed' , 'padauk' , 'peddana' , 'phetsarath' , 'ponnala' , 'ramabhadra' , 'raviprakash' , 'scheherazade' , 'souliyo' , 'sreekrushnadevaraya' , 'suranna' , 'suravaram' , 'tenaliramakrishna' , 'thabit' , 'tharlon' , 'cwtexfangsong' , 'cwtexhei' , 'cwtexkai' , 'cwtexming' );
		$flag_early_access = false;
		$include_fonts	 = '';
		$link_html		 = '<link rel="stylesheet" id="%2$s" href="%1$s" type="text/css" media="all" />' . "\n";
		$url			 = apply_filters( 'google_fonts_endpoint_url', '//fonts.googleapis.com/css' );
		$secondary		 = '';
		$separator		 = '';
		$mid_name		 = '';
		$has_mid_name    = array();
		$web_font_styles = '';
		$font_for_style_italic = '';
		$font_for_style_weight = '';

		if ( preg_match_all( '!class="([^\"]*)(google-font-)([a-z0-9-]+)([^\"]*)"!', $post->post_title . $post->post_content, $regs, PREG_SET_ORDER ) ) {

			if ( isset( $regs) && !empty( $regs ) ) {
				foreach ( $regs as $reg ) {

					if ( strstr( $reg[ 3 ], '-' ) ) {
						if(  count( $has_mid_name = explode( '-', $reg[ 3 ] ) ) == 3 ) {

							list( $primary, $mid_name, $secondary ) = $has_mid_name;

						} else {
							list( $primary, $secondary) = explode( '-', $reg[ 3 ] );
						}
					} else {
						$primary = $reg[ 3 ];
					}

					preg_match_all( '!([0-9]00)(i)?!', $reg[ 3 ], $weight_and_italic );

					if ( is_array( $weight_and_italic ) ) {

						$weight_and_italic_values	 = implode( ',', $weight_and_italic[ 0 ] );
						$weight_and_italic_values	 = str_replace( 'i', 'italic', $weight_and_italic_values );
						if ( !empty( $weight_and_italic_values ) ) {
							$separator = ':';
						}
					}
					$primary	 = preg_replace( '![0-9]00(i)?!', '', $primary );
					$secondary	 = preg_replace( '![0-9]00(i)?!', '', $secondary );
					$mid_name    = preg_replace( '![0-9]00(i)?!', '', $mid_name );

					if( true == array_search( $primary. $mid_name. $secondary ,  $early_access ) ) {

						$flag_early_access = true;
					}

					if( ! empty($has_mid_name) ) {
						$font_name		 = ucfirst( $primary ) . ' ' . ucfirst( $mid_name ) . ' ' . ucfirst( $secondary ) . $separator . $weight_and_italic_values;
						$font_for_style	 = ucfirst( $primary ) . ' ' . ucfirst( $mid_name ). ' ' . ucfirst( $secondary );;
					} elseif ( !empty( $secondary ) && empty( $has_mid_name ) ) {
						$font_name		 = ucfirst( $primary ) . ' ' . ucfirst( $secondary ) . $separator . $weight_and_italic_values;
						$font_for_style	 = ucfirst( $primary ) . ' ' . ucfirst( $secondary );
					} else {
						$font_name		 = ucfirst( $primary );
						$font_for_style	 = ucfirst( $primary );
					}


					if ( isset( $reg[ 3 ] ) ) {
						if ( strstr( $weight_and_italic_values, ',' ) ) {

						} else {
							if( ! empty(  $weight_and_italic_values ) ) {

								if ( strstr( $weight_and_italic_values, 'italic' ) ) {
									$font_for_style_italic = 'font-style: italic;';
								}
								if ( preg_match('!([0-9]00)(i)?!', $weight_and_italic_values, $font_weight_value ) ) {
									$font_for_style_weight = 'font-weight: '. absint( $font_weight_value[1] ).';';
								}
							}
						}
						$web_font_styles = str_replace('.mce-content-body .google-font-' . sanitize_html_class( $reg[ 3 ] ) . ', .hfeed .google-font-' . sanitize_html_class( $reg[ 3 ] ) . '{ font-family:"' . $font_for_style . '", sans-serif;'.
																			 $font_for_style_italic.
																			 $font_for_style_weight.
																			'}' . "\n",'',$web_font_styles );
						$web_font_styles .= '.mce-content-body .google-font-' . sanitize_html_class( $reg[ 3 ] ) . ', .hfeed .google-font-' . sanitize_html_class( $reg[ 3 ] ) . '{ font-family:"' . $font_for_style . '", sans-serif;'.
																			 $font_for_style_italic.
																			 $font_for_style_weight.
																			'}' . "\n";
					}

					$query_val = str_replace( '%2B', '+', urlencode( $font_name ) );

					if ( preg_match( '!(font-effect-)([a-z-)]+)!', $reg[ 0 ], $effect ) ) {

						$font_url = esc_url( add_query_arg( array( 'family' => $query_val, 'effect' => urlencode( $effect[ 2 ] ) ) , $url ) );
					} else {

						$font_url = esc_url( add_query_arg( 'family', $query_val, $url ) );
					}
					$font_url = str_replace( '&', '&amp;', $font_url );

					$id = $reg[ 3 ];


					if( ! empty( $effect[ 2 ] )) {
						$id = $id. '-'. $effect[ 2 ];
					}
					if( true == $flag_early_access  ) {

						$font_url		= 'http://fonts.googleapis.com/earlyaccess/';
						$font_url		.= str_replace( ' ','', strtolower( $font_name.'.css' ) );

						$font_url		= str_replace( $separator . $weight_and_italic_values, '', $font_url );
						$id             = str_replace( $weight_and_italic_values, '', $id );

						$include_fonts = str_replace( sprintf( $link_html, $font_url ,'google-font-early-'. sanitize_html_class( $id ). '-css'  ),'',  $include_fonts );
						$include_fonts .= sprintf( $link_html, $font_url ,'google-font-early-'. sanitize_html_class( $id ). '-css'  );
					} else {
						$include_fonts = str_replace( sprintf( $link_html, $font_url ,'google-font-'. sanitize_html_class( $id ). '-css'  ) ,'',  $include_fonts );
						$include_fonts .= sprintf( $link_html, $font_url ,'google-font-'. sanitize_html_class( $id ). '-css'  );
					}

					unset( $regs );
					$primary					 = '';
					$secondary					 = '';
					$separator					 = '';
					$weight_and_italic_values	 = '';
					$font_name					 = '';
					$font_url					 = '';
					$font_for_style_italic       = '';
					$font_for_style_weight       = '';
					$mid_name					= '';
					$has_mid_name				= array();
					$flag_early_access			= false;
				}

				/*patch 1.272*/
				$include_fonts = str_replace( '++','+', $include_fonts );

				update_post_meta( $post_ID, '_web_fonts_link_element', $include_fonts );
				update_post_meta( $post_ID, '_web_fonts_styles', $web_font_styles );

				$already_included = get_post_meta( $post_ID );

				if ( empty( $already_included ) ) {
					delete_post_meta( $post_ID, '_web_fonts_link_element' );
				}
			}
		}
	}
}

if ( !function_exists( 'raindrops_tiny_mce_before_init' ) ) {
/**
 *
 * @param array $init_array
 * @return string
 * @since 1.264
 */
	function raindrops_tiny_mce_before_init( $init_array ) {

		$separator = '';
		if ( !empty( $init_array ) ) {
			$separator = ',';
		}
		$init_array[ 'content_css' ] = trim( $init_array[ 'content_css' ], ',' ) . $separator . raindrops_google_fonts_for_tinymce();

		return $init_array;
	}
}

if ( !function_exists( 'raindrops_google_fonts_for_tinymce' ) ) {
	/**
	 *
	 * @global type $post
	 * @return type
	 * @since 1.264
	 */
	function raindrops_google_fonts_for_tinymce() {

		if ( raindrops_warehouse_clone( 'raindrops_sync_style_for_tinymce' ) !== 'yes' ) {
			return;
		}
		global $post;
		$google_font_link_elements	 = get_post_meta( $post->ID, '_web_fonts_link_element', true );
		$comma_separated_urls		 = '';
		if ( preg_match_all( '!href="([^"]+)"!', $google_font_link_elements, $regs, PREG_SET_ORDER ) ) {
			foreach ( $regs as $reg ) {

				$comma_separated_urls .= ', ' . $reg[ 1 ];
			}
		}
		return trim( $comma_separated_urls, ',' );
	}

}

if ( !function_exists( 'raindrops_editor_styles_callback' ) ) {
/**
 *
 * @global type $content_width
 * @return type
 * @since 1.264
 */
	function raindrops_editor_styles_callback() {
		global $content_width;
		if ( raindrops_warehouse_clone( 'raindrops_sync_style_for_tinymce' ) !== 'yes' ) {
			return;
		}

		$metabox_style	 = '';
		$result			 = '';
		if ( isset( $_REQUEST[ 'id' ] ) && !empty( $_REQUEST[ 'id' ] ) ) {
			$post_id = absint( $_REQUEST[ 'id' ] );

			$metabox_style	 = get_post_meta( $post_id, '_css', true );
			//$metabox_style	 = preg_replace_callback( '![^}]+{[^}]+}!siu', 'raindrops_css_add_id', $metabox_style );
			//$metabox_style	 = str_replace( '#post-','#post-'. $post_id, $metabox_style );
			$style			 = get_post_meta( $post_id, '_web_fonts_styles', true );
			$result			 = str_replace( $style, '', $result );
			$result .= $result . $style;
		}

		$defined_colors			 = raindrops_embed_css();
		$defined_colors			 = str_replace( array( 'body', '.entry-content' ), array( 'no-body', 'html .mceContentBody' ), $defined_colors );
		$font_size				 = raindrops_warehouse_clone( 'raindrops_basefont_settings' );
		$font_color				 = raindrops_warehouse_clone( 'raindrops_default_fonts_color' );
		$link_color				 = raindrops_warehouse_clone( 'raindrops_hyperlink_color' );

		$editor_custom_styles	 = 'html .mceContentBody{max-width:' . $content_width . 'px;}' . "\n";
		$editor_custom_styles	 .= 'html .mceContentBody{font-size:' . $font_size . 'px;}' . "\n";
		if( isset( $font_color ) && !empty( $font_color )) {
			$editor_custom_styles	 .= 'html .mceContentBody.mce-content-body{color:' . $font_color . ';}' . "\n";
		}
		if( isset( $link_color ) && !empty( $link_color )) {
			$editor_custom_styles	 .= 'html .mceContentBody a{color:' . $link_color . ';}' . "\n";
		}

		header( 'Content-type: text/css' );
		echo $editor_custom_styles;
		echo apply_filters( 'raindrops_editor_styles_callback', $result );
		echo $defined_colors;
		echo $metabox_style;
		die();
	}

}
if ( !function_exists( 'raindrops_get_pinup_widget_ids' ) ) {
/**
 *
 * @return type array
 * @since 1.265
 */
	function raindrops_get_pinup_widget_ids() {

		$widgets = wp_get_sidebars_widgets();
		$ids	 = array();

		if ( isset( $widgets ) && is_array( $widgets ) ) {

			foreach ( $widgets as $key => $val_array ) {

				if ( preg_match( '$sidebar$', $key ) ) {

					if ( is_array($val_array) ) {
						foreach ( $val_array as $widget ) {

							if ( preg_match( '$raindrops_pinup_entry_widget-([0-9]+)$', $widget, $regs ) ) {

								$ids[] = absint( $regs[ 1 ] );
							}
						}
					}
				}
			}
		}
		return $ids;
	}
}


if ( !function_exists( 'raindrops_apply_pinup_styles' ) ) {

	/**
	 *
	 * @return type string styles
	 * @since 1.265
	 */
	function raindrops_apply_pinup_styles() {

		$widget_ids	 = raindrops_get_pinup_widget_ids();
		$style		 = '';

		foreach ( $widget_ids as $id ) {

			$style .= raindrops_pinup_parse_styles( $id );

		}
		return $style;
	}
}
if ( !function_exists( 'raindrops_pinup_widget_ids_to_post_ids' ) ) {
/**
 *
 * @param type $ids
 * @return boolean
 * @since 1.265
 */
	function raindrops_pinup_widget_ids_to_post_ids( $ids ){

		$widget_array				= get_option( 'widget_raindrops_pinup_entry_widget' );
		$raindrops_pinup_post_id	= array();
		
		if( is_array( $ids ) ) {
			foreach( $ids as $id ) {
				if( isset( $widget_array[ $id ][ "id" ] ) ) {
					$raindrops_pinup_post_id[]		 = $widget_array[ $id ][ "id" ];
				}
			}
			return $raindrops_pinup_post_id;
		}
		return false;
	}
}

if ( !function_exists( 'raindrops_pinup_parse_styles' ) ) {
/**
 *
 * @param type $id
 * @return string
 * @since 1.265
 */
	function raindrops_pinup_parse_styles( $id ) {

		$id_prefix		 = 'pinup-';
		$widget_array	 = get_option( 'widget_raindrops_pinup_entry_widget' );
		$styles			 = $widget_array[ $id ][ "inline_style" ];
		$raindrops_pinup_post_id		 = $widget_array[ $id ][ "id" ];
		if ( empty( $styles ) ) {

			return '';
		}
		if ( preg_match( '${$', $styles ) ) {

			preg_match_all( '$[^}]*{([^}]*)}$', $styles, $regs, PREG_SET_ORDER );
			$result = '';

			foreach ( $regs as $each_style ) {

				$result .= '#' . $id_prefix . $raindrops_pinup_post_id . ' ' . $each_style[ 0 ];
			}
		} else {

			$result = '#' . $id_prefix . $raindrops_pinup_post_id . '{ ' . $styles . ' }';
		}

		return $result;
	}

}

/**
 *
 * @since 1.265
 */

global $wp_customize;

if( isset( $wp_customize ) ) {

	add_filter( 'raindrops_embed_meta_css', 'raindrops_pinup_entry_style' );
}

if ( !function_exists( 'raindrops_pinup_entry_style' ) ) {
/**
 *
 * @param type $css
 * @return type string styel filterd value
 * @since 1.265
 */
	function raindrops_pinup_entry_style( $css ) {

		return $css . raindrops_apply_pinup_styles();
	}

}

if ( ! function_exists( '_wp_render_title_tag' ) ) {
/**
 * WordPress4.1 Backwards compatibility
 * @since 1.265
 */
    function raindrops_render_title() {
?><title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
    }
    add_action( 'wp_head', 'raindrops_render_title' );
}

if ( ! function_exists( 'raindrops_month_list_count' ) ) {
	/**
	 *
	 * @param type $count
	 * @return int
	 * @since 1.271
	 */
	function raindrops_month_list_count( $count ) {
		
		return 50;
	}
}

if ( ! function_exists( 'raindrops_add_header_archive_description' ) && function_exists( 'get_the_archive_description') ) {
	/**
	 *
	 * @since1.272
	 */
	function raindrops_add_header_archive_description(){

		if ( is_archive( ) ) {

			$html = '<meta name="%1$s" content="%2$s" />'. "\n";

			$raindrops_archive_description_length = apply_filters( 'raindrops_archive_description_length', 115 );

			$description = wp_kses( get_the_archive_description(), array() );
			$description = wp_html_excerpt( $description, $raindrops_archive_description_length , '' );

			if ( ! empty( $description ) ) {
				$result = sprintf( $html, 'description', $description );
				echo apply_filters( 'raindrops_add_header_archive_description', $result );
			}
		}
	}
}
/**
 * fallback function renema but child theme or custom user
 *
 * @return type
 */
if ( ! function_exists( 'raindrops_show_one_column' ) ) {

	function raindrops_show_one_column(){

		_deprecated_function( __FUNCTION__, '1.272', 'raindrops_column_controller()' );

		return raindrops_column_controller();
	}
}

if ( ! function_exists( 'raindrops_add_class' ) ) {

	function raindrops_add_class($id = 'yui-u first', $echo = false) {

		_deprecated_function( __FUNCTION__, '1.272', 'raindrops_dinamic_class()' );

		if( false == $echo){
			return raindrops_dinamic_class($id = 'yui-u first', $echo = false);
		}else{
			echo raindrops_dinamic_class($id = 'yui-u first', $echo = false);
		}
	}
}

if ( ! function_exists( 'raindrops_category_navigation' ) ) {

	function raindrops_category_navigation(){
		$result = '';
		$tmp_id = get_query_var( 'cat');
		$tmp_parent =  get_category_parents( $tmp_id, true, ' &raquo; ' );

		if( strip_tags( $tmp_parent ) !== get_the_category_by_ID( $tmp_id ). ' &raquo; ' ) {
		$tmp_parent = trim( $tmp_parent ,' &raquo; ');
		$result  = str_replace(get_the_category_by_ID( $tmp_id ),'', $tmp_parent );

			$result .= sprintf( '<span class="current">%1$s</span> &raquo; ',  get_the_category_by_ID( $tmp_id ) );
		}
			$tmp_child_ids = get_term_children( $tmp_id, 'category' );
		foreach( $tmp_child_ids as $tmp_id ) {
			$term = get_term_by( 'id', $tmp_id, 'category' );
			$result .= '<a href="' . get_term_link( $tmp_id, 'category' ) . '">' . $term->name . "</a> &raquo; ";
		}

		return apply_filters( 'raindrops_category_navigation', '<div class="raindrops-category-navigation">'. rtrim( $result,' &raquo; '). '</div>' );
	}
}

if ( ! function_exists( 'raindrops_post_category_relation' ) ) {

	function raindrops_post_category_relation() {
		global $post;

		$result			 = array();
		$tmp_id			 = get_query_var( 'cat' );
		$categories	     = get_the_category( $post->ID );

		foreach ( $categories as $category ) {

			$parents = get_category_parents( $category->term_id, true, '&raquo;' );
			$parents_item = str_replace( '<a href="' . get_category_link( $category->term_id ) . '">' . $category->name . "</a>&raquo;", '', $parents );
			$parents = explode( '&raquo;', $parents_item );
			if ( ! empty( $parents_item ) ) {
				$result[] = '<span class="label title parent">'.esc_html__('Parent Category:','Raindrops' ).'</span>';
			}
			foreach ( $parents as $links ) {

				$result[] = $links;
			}

			$replace_check	 = get_the_category_by_ID( $category->term_id );
			$replace_check	 = get_category_link( $category->term_id );
			$tmp_child_ids	 = get_term_children( $category->term_id, 'category' );
			$child_result	 = '';
			$child_ready	 = array();
			if ( ! empty( $tmp_child_ids ) ) {
				$result[] = '<span class="label title child">'.esc_html__('Child Category:','Raindrops' ).'</span>';
			}
			foreach ( $tmp_child_ids as $tmp_id ) {

				$term		 = get_term_by( 'id', $tmp_id, 'category' );
				$result[]	 = '<a href="' . get_term_link( $tmp_id, 'category' ) . '">' . $term->name . "</a>";
			}
		}

		$result	 = array_unique( $result );
		$result	 = implode( ' ', $result );

		return apply_filters( 'raindrops_post_category_relation', rtrim( $result, ' &raquo; ' ) );
	}
}
if ( ! function_exists( 'raindrops_article_wrapper_class' ) ) {
/**
 *
 * @return string
 * @since1.277
 */
	function raindrops_article_wrapper_class( ) {
		global $post;

			if (isset( $post ) && preg_match( '!<[^>]*?(lang-ja|lang-not-ja)[^>]*?>!', $post->post_content ) ) {
				$lang = 'rd-l-'. raindrops_get_accept_language( );
				return apply_filters( 'raindrops_article_wrapper_class', $lang );

			}
	}
}
if ( ! function_exists( 'raindrops_get_accept_language' ) ) {
	/**
	 *
	 * @return boolean
	 * @since 1.278
	 */

	function raindrops_get_accept_language( ) {

		if ( isset( $_SERVER[ "HTTP_ACCEPT_LANGUAGE" ] ) ) {

					$browser_lang	 = $_SERVER[ "HTTP_ACCEPT_LANGUAGE" ];
					$browser_lang	 = explode( ",", $browser_lang );
					$browser_lang	 = wp_strip_all_tags( $browser_lang[ 0 ] );
					if( isset( $browser_lang ) ) {
						return $browser_lang;
					}
					return false;
		}
	}
}


if ( ! function_exists( 'raindrops_excerpt_id' ) ) {
	/**
	 * @since 1.278
	 */
	function raindrops_excerpt_id(  ) {
		if( is_singular() ) {
			echo '<span id="read"></span>';
		}
	}
}
if ( ! function_exists( 'raindrops_excerpt_after_link' ) ) {
	/**
	 *
	 * @global type $post
	 * @param type $content
	 * @param type $function
	 * @return type
	 * @since 1.278
	 */
	function raindrops_excerpt_after_link( $content , $function ) {
		global $post;
		$raindrops_excerpt_more = raindrops_warehouse_clone( 'raindrops_read_more_after_excerpt' );

		$more_link_text = esc_html__( 'Continue&nbsp;reading ', 'Raindrops' ) .
						'<span class="meta-nav">&rarr;</span><span class="more-link-post-unique">' .
						esc_html__( '&nbsp;Post ID&nbsp;', 'Raindrops' ) . get_the_ID() . '</span>';

		$html = '<div class="raindrops-excerpt-more pad-s corner"><a href="%1$s" rel="bookmark">%2$s</a></div>';
		$link = sprintf( $html , get_permalink( $post->ID ) . '#read', $more_link_text );

		if( $raindrops_excerpt_more == 'yes' && isset( $post ) && ( $function == 'raindrops_entry_content' || $function == 'raindrops_html_excerpt_with_elements' ) && !is_singular() ) {

			return $content . $link;
		}
		return $content;
	}
}

if ( ! function_exists( 'raindrops_oembed_result' ) ) {
	/**
	 *
	 * @param type $html
	 * @param type $url
	 * @param type $args
	 * @return type
	 * @since 1.278
	 */
	function raindrops_oembed_result( $html, $url, $args ) {

		$raindrops_excerpt_condition         = raindrops_detect_excerpt_condition();
		$raindrops_excerpt_enable            = raindrops_warehouse_clone( 'raindrops_excerpt_enable' );
		$raindrops_allow_oembed_excerpt_view = raindrops_warehouse_clone( 'raindrops_allow_oembed_excerpt_view' );

		if ( true == $raindrops_excerpt_condition && 'yes' == $raindrops_excerpt_enable ) {

			if ( 'yes' == $raindrops_allow_oembed_excerpt_view ) {
				return $html;
			} else {
				return;
			/*	$more_link_text = esc_html__( 'MEDIA&nbsp;', 'Raindrops' ) .'<span class="url">'. esc_url( $url ) . '</span>';

				$html = '<div class="raindrops-excerpt-more pad-s corner"><a href="%1$s" rel="bookmark">%2$s</a></div>';

				return sprintf( $html ,esc_url( $url ), $more_link_text );*/
			}
		}

		return $html;
	}
}


if ( !function_exists( 'raindrops_parse_webfonts' ) ) {
/**
 *
 * @param type $post_ID
 * @param type $post
 * @param type $update
 * @return boolean
 * @1.264
 */
	function raindrops_parse_webfonts( $data ) {

		if ( is_admin() && !current_user_can('edit_posts') ) { return false; }

		$early_access	 = array('alefhebrew' , 'amiri' , 'dhurjati' , 'dhyana' , 'droidarabickufi' , 'droidarabicnaskh' , 'droidsansethiopic' , 'droidsanstamil' , 'droidsansthai' , 'droidserifthai' , 'gidugu' , 'gurajada' , 'hanna' , 'jejugothic' , 'jejuhallasan' , 'jejumyeongjo' , 'karlatamilinclined' , 'karlatamilupright' , 'kopubbatang' , 'lakkireddy' , 'laomuangdon' , 'laomuangkhong' , 'laosanspro' , 'lateef' , 'lohitbengali' , 'lohitdevanagari' , 'lohittamil' , 'mallanna' , 'mandali' , 'myanmarsanspro' , 'nats' , 'ntr' , 'nanumbrushscript' , 'nanumgothic' , 'nanumgothiccoding' , 'nanummyeongjo' , 'nanumpenscript' , 'notokufiarabic' , 'notonaskharabic' , 'notonastaliqurdudraft' , 'notosansarmenian' , 'notosansbengali' , 'notosanscherokee' , 'notosansdevanagari' , 'notosansdevanagariui' , 'notosansethiopic' , 'notosansgeorgian' , 'notosansgujarati' , 'notosansgurmukhi' , 'notosanshebrew' , 'notosansjapanese' , 'notosanskannada' , 'notosanskhmer' , 'notosanskufiarabic' , 'notosanslao' , 'notosanslaoui' , 'notosansmalayalam' , 'notosansmyanmar' , 'notosansosmanya' , 'notosanssinhala' , 'notosanstamil' , 'notosanstamilui' , 'notosanstelugu' , 'notosansthai' , 'notosansthaiui' , 'notoserifarmenian' , 'notoserifgeorgian' , 'notoserifkhmer' , 'notoseriflao' , 'notoserifthai' , 'opensanshebrew' , 'opensanshebrewcondensed' , 'padauk' , 'peddana' , 'phetsarath' , 'ponnala' , 'ramabhadra' , 'raviprakash' , 'scheherazade' , 'souliyo' , 'sreekrushnadevaraya' , 'suranna' , 'suravaram' , 'tenaliramakrishna' , 'thabit' , 'tharlon' , 'cwtexfangsong' , 'cwtexhei' , 'cwtexkai' , 'cwtexming' );
		$flag_early_access = false;
		$include_fonts	 = '';
		$link_html		 = '@import url(%1$s);' . "\n";
		$url			 = apply_filters( 'google_fonts_endpoint_url', '//fonts.googleapis.com/css' );
		$secondary		 = '';
		$separator		 = '';
		$mid_name		 = '';
		$has_mid_name    = array();
		$web_font_styles = '';
		$font_for_style_italic = '';
		$font_for_style_weight = '';

		if ( preg_match_all( '!([^\s]*)(google-font-)([a-z0-9-]+)([^\s]*)!', $data, $regs, PREG_SET_ORDER ) ) {

			if ( isset( $regs) && !empty( $regs ) ) {
				foreach ( $regs as $reg ) {

					if ( strstr( $reg[ 3 ], '-' ) ) {
						if(  count( $has_mid_name = explode( '-', $reg[ 3 ] ) ) == 3 ) {

							list( $primary, $mid_name, $secondary ) = $has_mid_name;

						} else {
							list( $primary, $secondary) = explode( '-', $reg[ 3 ] );
						}
					} else {
						$primary = $reg[ 3 ];
					}

					preg_match_all( '!([0-9]00)(i)?!', $reg[ 3 ], $weight_and_italic );

					if ( is_array( $weight_and_italic ) ) {

						$weight_and_italic_values	 = implode( ',', $weight_and_italic[ 0 ] );
						$weight_and_italic_values	 = str_replace( 'i', 'italic', $weight_and_italic_values );
						if ( !empty( $weight_and_italic_values ) ) {
							$separator = ':';
						}
					}
					$primary	 = preg_replace( '![0-9]00(i)?!', '', $primary );
					$secondary	 = preg_replace( '![0-9]00(i)?!', '', $secondary );
					$mid_name    = preg_replace( '![0-9]00(i)?!', '', $mid_name );

					if( true == array_search( $primary. $mid_name. $secondary ,  $early_access ) ) {

						$flag_early_access = true;
					}

					if( ! empty($has_mid_name) ) {
						$font_name		 = ucfirst( $primary ) . ' ' . ucfirst( $mid_name ) . ' ' . ucfirst( $secondary ) . $separator . $weight_and_italic_values;
						$font_for_style	 = ucfirst( $primary ) . ' ' . ucfirst( $mid_name ). ' ' . ucfirst( $secondary );;
					} elseif ( !empty( $secondary ) && empty( $has_mid_name ) ) {
						$font_name		 = ucfirst( $primary ) . ' ' . ucfirst( $secondary ) . $separator . $weight_and_italic_values;
						$font_for_style	 = ucfirst( $primary ) . ' ' . ucfirst( $secondary );
					} else {
						$font_name		 = ucfirst( $primary );
						$font_for_style	 = ucfirst( $primary );
					}


					if ( isset( $reg[ 3 ] ) ) {
						if ( strstr( $weight_and_italic_values, ',' ) ) {

						} else {
							if( ! empty(  $weight_and_italic_values ) ) {

								if ( strstr( $weight_and_italic_values, 'italic' ) ) {
									$font_for_style_italic = 'font-style: italic;';
								}
								if ( preg_match('!([0-9]00)(i)?!', $weight_and_italic_values, $font_weight_value ) ) {
									$font_for_style_weight = 'font-weight: '. absint( $font_weight_value[1] ).';';
								}
							}
						}
						$web_font_styles = str_replace('.mce-content-body .google-font-' . sanitize_html_class( $reg[ 3 ] ) . ', .hfeed .google-font-' . sanitize_html_class( $reg[ 3 ] ) . ', h1.google-font-' . sanitize_html_class( $reg[ 3 ] ) . ' span{ font-family:"' . $font_for_style . '", sans-serif;'.
																			 $font_for_style_italic.
																			 $font_for_style_weight.
																			'}' . "\n",'',$web_font_styles );
						$web_font_styles .= '.mce-content-body .google-font-' . sanitize_html_class( $reg[ 3 ] ) . ', .hfeed .google-font-' . sanitize_html_class( $reg[ 3 ] ) . ', h1.google-font-' . sanitize_html_class( $reg[ 3 ] ) .' span{ font-family:"' . $font_for_style . '", sans-serif;'.
																			 $font_for_style_italic.
																			 $font_for_style_weight.
																			'}' . "\n";
					}

					$query_val = str_replace( '%2B', '+', urlencode( $font_name ) );

					if ( preg_match( '!(font-effect-)([a-z-)]+)!', $reg[ 0 ], $effect ) ) {

						$font_url = esc_url( add_query_arg( array( 'family' => $query_val, 'effect' => urlencode( $effect[ 2 ] ) ), $url ) );
					} else {

						$font_url = esc_url( add_query_arg( 'family', $query_val, $url ) );
					}
					$font_url = str_replace( '&', '&amp;', $font_url );

					$id = $reg[ 3 ];


					if( ! empty( $effect[ 2 ] )) {
						$id = $id. '-'. $effect[ 2 ];
					}
					if( true == $flag_early_access  ) {

						$font_url		= 'http://fonts.googleapis.com/earlyaccess/';
						$font_url		.= str_replace( ' ','', strtolower( $font_name.'.css' ) );

						$font_url		= str_replace( $separator . $weight_and_italic_values, '', $font_url );
						$id             = str_replace( $weight_and_italic_values, '', $id );

						$include_fonts = str_replace( sprintf( $link_html, $font_url ,'google-font-early-'. sanitize_html_class( $id ). '-css'  ),'',  $include_fonts );
						$include_fonts .= sprintf( $link_html, $font_url  );
					} else {
						$include_fonts = str_replace( sprintf( $link_html, $font_url ,'google-font-'. sanitize_html_class( $id ). '-css'  ) ,'',  $include_fonts );
						$include_fonts .= sprintf( $link_html, $font_url  );
					}

					unset( $regs );
					$primary					 = '';
					$secondary					 = '';
					$separator					 = '';
					$weight_and_italic_values	 = '';
					$font_name					 = '';
					$font_url					 = '';
					$font_for_style_italic       = '';
					$font_for_style_weight       = '';
					$mid_name					= '';
					$has_mid_name				= array();
					$flag_early_access			= false;
				}

				/*patch 1.272*/
				$include_fonts = str_replace( '++','+', $include_fonts );

				return array('import_rule' => $include_fonts, 'apply_style' => $web_font_styles );

			}
		}
	}
}
if ( ! function_exists('raindrops_get_classes_from_primary_menu') ) {
	/**
	 *
	 * @return boolean
	 * @since1.278
	 */
	function raindrops_get_classes_from_primary_menu(){

		$menu_slug = 'primary';
		$locations = get_nav_menu_locations();

		if (isset($locations[$menu_slug])) {
			$menu_id = $locations[$menu_slug];
			$items = wp_get_nav_menu_items( $menu_id ) ;
			$class_strings = '';
			if( isset( $items ) && ! empty( $items ) ) {

				foreach( $items as $val){
						$class_strings .= ' '. implode( ',', $val->classes ).' ';
				}

				return esc_attr( $class_strings );
			} else {
				return false;
			}
		}
		return false;
	}
}
if ( ! function_exists( 'raindrops_apply_google_font_import_rule_for_site_title' ) ) {
	/**
	 *
	 * @param type $css
	 * @return type
	 * @since 1.278
	 */
	function raindrops_apply_google_font_import_rule_for_site_title( $css ) {

		$setting_value	= raindrops_warehouse_clone( 'raindrops_site_title_css_class' );
		$fonts_get		= raindrops_parse_webfonts( $setting_value ) ;
		$import_rule    = $fonts_get['import_rule'];

		if ( ! empty( $import_rule ) ) {

			return  wp_strip_all_tags( $import_rule. $css );
		}
		return $css;
	}
}
if ( ! function_exists( 'raindrops_apply_google_font_import_rule_for_primary_menu' ) ) {
	/**
	 *
	 * @param type $css
	 * @return type
	 * @since 1.278
	 */
	function raindrops_apply_google_font_import_rule_for_primary_menu( $css ) {
		$setting_value = raindrops_get_classes_from_primary_menu();

		$fonts_get = raindrops_parse_webfonts( $setting_value ) ;
		$import_rule    = $fonts_get['import_rule'];

		if ( ! empty( $import_rule ) ) {

					return  wp_strip_all_tags( $import_rule. $css );
		}
		return $css;

	}
}
if ( ! function_exists( 'raindrops_apply_google_font_styles_for_site_title' ) ) {
	/**
	 *
	 * @param type $css
	 * @return type
	 * @since 1.278
	 */
	function raindrops_apply_google_font_styles_for_site_title( $css ) {

		$setting_value	= raindrops_warehouse_clone( 'raindrops_site_title_css_class' );
		$fonts_get		= raindrops_parse_webfonts( $setting_value ) ;
		$style			= $fonts_get['apply_style'];

		if ( ! empty( $style ) ) {

			return  wp_strip_all_tags( $style. $css );
		}
		return $css;
	}
}
if ( ! function_exists( 'raindrops_apply_google_font_styles_for_primary_menu' ) ) {
	/**
	 *
	 * @param type $css
	 * @return type
	 * @since 1.278
	 */
	function raindrops_apply_google_font_styles_for_primary_menu( $css ) {

		$setting_value = raindrops_get_classes_from_primary_menu();
		$fonts_get     = raindrops_parse_webfonts( $setting_value ) ;
		$style         = $fonts_get['apply_style'];

		if ( ! empty( $style ) ) {

					return wp_strip_all_tags( $style. $css );
		}
		return $css;
	}
}
if ( ! function_exists( 'raindrops_is_place_of_site_title' ) ) {
	/**
	 *
	 * @return boolean
	 * @since 1.278
	 */
	function raindrops_is_place_of_site_title(){

		$raindrops_type_site_title = raindrops_warehouse_clone( 'raindrops_place_of_site_title' );

		if ( get_header_image( ) == false ) {

			raindrops_update_theme_option( 'raindrops_place_of_site_title', 'above' );
			$raindrops_type_site_title = 'above';
		}

		If( $raindrops_type_site_title == 'header_image' ) {
			return false;
		}
		return true;
	}
}

if ( ! function_exists( 'raindrops_custom_header_image_contents' ) ) {
	/**
	 *
	 * @param type $content
	 * @return type
	 * @since 1.278
	 */
	function raindrops_custom_header_image_contents( $content ) {

		$setting_value = raindrops_warehouse_clone( 'raindrops_place_of_site_title' );

		If( $setting_value == 'header_image' ) {
			return $content. raindrops_site_title();
		}
		return $content;
	}
}

if ( ! function_exists( 'raindrops_custom_site_title_class' ) ) {
	/**
	 *
	 * @param type $return_value
	 * @return type
	 * @since 1.278
	 */
	function raindrops_custom_site_title_class( $return_value ) {

		$setting_value = raindrops_warehouse_clone( 'raindrops_site_title_css_class' );

		if ( $setting_value !== 'none' && !empty( $setting_value ) ) {
			return $return_value .' '. wp_kses( $setting_value , array() );
		}
	}
}
if ( ! function_exists( 'raindrops_custom_site_title_style' ) ) {
	/**
	 *
	 * @param type $return_value
	 * @return type
	 * @since 1.278
	 */
	function raindrops_custom_site_title_style( $return_value ) {

		$style = apply_filters( 'raindrops_site_title_in_header_image_css','', '#header-image #site-title, #raindrops_metaslider #site-title' );

		$setting_value = raindrops_warehouse_clone( 'raindrops_place_of_site_title' );




		If( $setting_value == 'header_image' && get_header_image( ) !== false ) {

			$style .= '#hd {display:none;}';
		}

		$setting_value = raindrops_warehouse_clone( 'raindrops_tagline_in_the_header_image' );

		If( $setting_value !== 'show' ) {

			$style .= '#header-image .tagline{display:none;}';
		}

		$setting_value = raindrops_warehouse_clone( 'raindrops_site_title_font_size' );

		If( is_numeric( $setting_value ) && $setting_value < 11 ) {

			$style .= '#header-image #site-title{font-size:'. $setting_value. 'vw;}';
		}
		
		$setting_value_left_type = raindrops_warehouse_clone( 'raindrops_site_title_left_margin_type' );

		if( 'centered' == $setting_value_left_type ) {
			$setting_value_top = (float) raindrops_warehouse_clone( 'raindrops_site_title_top_margin' );			
			$style .='#header-image #site-title, #raindrops_metaslider #site-title{position:absolute;left:0; right:0; margin-left: auto; margin-right: auto; text-align: center; top:'. $setting_value_top.'%; }';
		
		} elseif( 'default' == $setting_value_left_type ) {
			
			$setting_value_top = (float) raindrops_warehouse_clone( 'raindrops_site_title_top_margin' );
			$setting_value_left = 1;

			if ( is_numeric( $setting_value_top ) && is_numeric( $setting_value_top )  ) {

				$style .='#header-image #site-title, #raindrops_metaslider #site-title{position:absolute;left:'. $setting_value_left.'%; top:'. $setting_value_top.'%; }';
			}			
			
		} else {
		
			$setting_value_top = (float) raindrops_warehouse_clone( 'raindrops_site_title_top_margin' );
			$setting_value_left = (float) raindrops_warehouse_clone( 'raindrops_site_title_left_margin' );

			if ( is_numeric( $setting_value_top ) && is_numeric( $setting_value_top )  ) {

				$style .='#header-image #site-title, #raindrops_metaslider #site-title{position:absolute;left:'. $setting_value_left.'%; top:'. $setting_value_top.'%;}';
			}
		}

		return wp_strip_all_tags( $return_value.$style );
	}
}
if ( !function_exists( 'raindrops_customizer_add_article_title_css_class' ) ) {
/**
 * 
 * @param type $class
 * @return type
 * @since 1.295
 */
	function raindrops_customizer_add_article_title_css_class( $class ) {
		$customizer_config = raindrops_warehouse_clone( 'raindrops_article_title_css_class' );
		if ( !empty( $customizer_config ) ) {
			return $class . ' ' . trim( $customizer_config );
		} else {
			return $class;
		}
	}

}
if ( !function_exists( 'raindrops_customizer_hide_default_category' ) ) {
/**
 * 
 * @param type $css
 * @return type
 * @since 1.295
 */
	function raindrops_customizer_hide_default_category( $css ) {

		$permalink_structure = get_option( 'permalink_structure' );
		$customizer_config	 = raindrops_warehouse_clone( 'raindrops_display_default_category' );
		$css_rule_set		 = '.entry-meta a[href$="%1$s/"],.entry-meta a[href$="%1$s"]{display:none;}';
		$css_rule_set		 .= '.author dd a[href$="%1$s/"],.author dd a[href$="%1$s"]{display:none;}';
		
		if ( !empty( $permalink_structure ) && 'show' !== $customizer_config ) {
			$default_category_id	 = get_option( 'default_category' );
			$default_category_info	 = get_category( $default_category_id );
			$default_category_slug	 = $default_category_info->slug;

			$css_add = sprintf( $css_rule_set, $default_category_slug );

			return $css . $css_add;
		}
		return $css;
	}

}
if ( !function_exists( 'raindrops_customizer_hide_post_author' ) ) {
/**
 * 
 * @param type $css
 * @return type
 * @since 1.295
 */
	function raindrops_customizer_hide_post_author( $css ) {
		$customizer_config = raindrops_warehouse_clone( 'raindrops_display_article_author' );
		if ( 'show' !== $customizer_config ) {
			$css_add = '.posted-on .author a,.ported-on .posted-by-string,.entry-meta-default .author a,.entry-meta-default .posted-by-string{display:none;}';
			return $css . $css_add;
		}
		return $css;
	}

}
if ( !function_exists( 'raindrops_customizer_hide_post_date' ) ) {
/**
 * 
 * @param type $css
 * @return type
 * @since 1.295
 */
	function raindrops_customizer_hide_post_date( $css ) {
		$customizer_config = raindrops_warehouse_clone( 'raindrops_display_article_publish_date' );
		if ( 'show' !== $customizer_config ) {
			$css_add = '.posted-on .posted-on-string,.posted-on .entry-date,.entry-meta-default  .posted-on-string,.entry-meta-default .entry-date{display:none;}';
			$css_add .= '.author time.entry-date{display:none;}';
			return $css . $css_add;
		}
		return $css;
	}

}
if ( !function_exists( 'raindrops_excerpt_length' ) ) {
/**
 * 
 * @param type $length
 * @return type
 * @since 1.296
 */
	function raindrops_excerpt_length( $length ) {
		return raindrops_warehouse_clone( 'raindrops_excerpt_length' );
	}

}
if ( !function_exists( 'raindrops_import_parent_theme_mods' ) ) {
/**
 * 
 * @global type $raindrops_setting_type
 * @global type $wp_customize
 * @return boolean
 * @since 1.297
 */
	function raindrops_import_parent_theme_mods() {
		global $raindrops_setting_type, $wp_customize;
		

	




		$oarent_slug = get_option( 'template' );
		$child_slug	 = get_option( 'stylesheet' );
		$mods		 = get_option( "theme_mods_$oarent_slug" );

		if ( isset( $wp_customize ) && false !== $mods && false !== $child_slug && false !== $oarent_slug && is_child_theme() ) {
			if ( get_option( "mods_$child_slug" ) ) {
				delete_option( "mods_$child_slug" );
			}
			if ( 'import' == get_theme_mod( "raindrops_parent_theme_mods" ) ) {
				set_theme_mod( "raindrops_parent_theme_mods", 'no' );
			}
			if ( 'import' == raindrops_warehouse_clone( 'raindrops_parent_theme_mods' ) ) {
				raindrops_update_theme_option( 'raindrops_parent_theme_mods', 'no' );
			}

			return update_option( "theme_mods_$child_slug", $mods );
		}
		return false;
	}

}
/*
if ( is_child_theme() ) {
			raindrops_import_parent_theme_mods();
}*/
/**
 *
 *
 *
 * @since 1.138
 */
do_action( 'raindrops_last' );
?>