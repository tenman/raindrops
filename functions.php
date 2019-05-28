<?php
/**
 *
 *
 * @package Raindrops
 * @since Raindrops 0.1
 */
if ( ! defined( 'ABSPATH' ) ) {
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
 * You can override parent themes language file from child theme.
 */ 
load_theme_textdomain( 'raindrops', apply_filters( 'raindrops_load_text_domain', get_template_directory() . '/languages' ) );
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
 * Featured Image Presentation
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

if ( true == $raindrops_extend_customizer && isset( $wp_customize ) ) {

	if ( false !== ( $path = raindrops_locate_url( 'lib/customize.php', 'path' ) ) ) {

		require_once ( $path );
	}
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
 *
 *
 *
 * @since 1.138
 */
$raindrops_options_owner = raindrops_warehouse_clone( 'raindrops_options_owner' );

if ( isset( $raindrops_options_owner ) && $raindrops_current_theme_name !== $raindrops_options_owner ) {

	raindrops_update_theme_option( 'raindrops_options_owner', $raindrops_current_theme_name );
}
/**
 *
 */
add_action( 'wp_enqueue_scripts', 'raindrops_add_stylesheet' );
/**
 *
 */
register_nav_menus( array( 'primary' => esc_html__( 'Primary Navigation', 'raindrops' ), ) );

if ( ! function_exists( 'raindrops_extend_query' ) ) {

	/**
	 * Accessibility Settings
	 *
	 *  When true
	 *  Add to hidden text for identify  entry-title link text, comment link text, more link
	 *
	 * @since 1.116
	 */
	function raindrops_extend_query( $vars ) {

		$vars[]	 = 'raindrops_color_type';
		$vars[]	 = 'raindrops_pid';
		return $vars;
	}

}
if ( 'yes' == raindrops_warehouse_clone( 'raindrops_accessibility_settings' ) ) {

	$raindrops_accessibility_link = false;
}

if ( ! function_exists( 'raindrops_current_url' ) ) {
	/**
	 * old function
	 * new raindrops_request_url()
	 * @return type
	 */
	function raindrops_current_url() {

		$url = 'http';

		$server_https = filter_input( INPUT_SERVER, 'HTTPS' );

		if ( !is_null( $server_https ) && "on" == $server_https ) {

			$url = "https";
		}
		$url .= "://";
		$server_port = filter_input( INPUT_ENV, "SERVER_PORT", FILTER_VALIDATE_INT );
		$server_name = filter_input( INPUT_ENV, "SERVER_NAME" );
		$request_uri = filter_input( INPUT_ENV, "REQUEST_URI" );

		if ( !is_null( $server_port ) && 80 !== $server_port ) {

			$url .= $server_name . ":" . $server_port . $request_uri;
		} else {
			$url .= $server_name . $request_uri;
		}

		$url = esc_url( $url );

		return apply_filters( 'raindrops_current_url', $url );
	}

}
if ( ! function_exists( 'raindrops_request_url' ) ) {
	/**
	 * @since 1.525
	 * @global type $wp
	 * @return type
	 */
	function raindrops_request_url() {
		global $wp;
		return home_url( $wp->request );
	}
}
/**
 * home link
 *
 * ver 1.116 default value change
 * if you need home link then $raindrops_nav_menu_home_link set true.
 */
if ( !isset( $raindrops_nav_menu_home_link ) ) {

	$raindrops_link_unique_text = raindrops_link_unique_text();

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

		add_theme_support( 'html5', array( 'gallery', 'caption' ) );
	}
}
if ( ! function_exists( 'raindrops_gallery_atts' ) ) {

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

		if ( $raindrops_extend_galleries !== true ) {
			return $out;
		}

		if ( empty( $atts[ "columns" ] ) || $atts[ "columns" ] < 4 ) {

			if ( isset( $atts[ "columns" ] ) && 1 == $atts[ "columns" ] ) {
				$gallary_img_size = 'large';
			} else {
				$gallary_img_size = 'medium';
			}

			$atts = shortcode_atts( array( 'size' => $gallary_img_size, ), $atts );

			$out[ 'size' ] = $atts[ 'size' ];
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
 * 		<script src="http : // html5shiv.googlecode.com / svn / trunk / html5.js"></script>
 * 		<![endif]-->
 *
 *
 * ver 1.204
 */
if ( $is_IE ) {

	$http_user_agent = filter_input( INPUT_ENV, 'HTTP_USER_AGENT' );

	preg_match( "|(MSIE )([0-9]{1,2})(\.)|si", $http_user_agent, $raindrops_regs );

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
		'default-color'	 => '',
		'default-image'	 => '',
	) );
	add_theme_support( 'custom-background', $raindrops_custom_background_args );
}
/**
 *
 *
 *
 *
 *
 */
add_theme_support( 'post-thumbnails' );

/**
 *
 *
 *
 *
 *
 */
add_theme_support( 'automatic-feed-links' );

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

	$http_user_agent = filter_input( INPUT_ENV, 'HTTP_USER_AGENT' );

	preg_match( "|(MSIE )([0-9]{1,2})(\.)|si", $http_user_agent, $regs );

	if ( isset( $regs[ 2 ] ) && $regs[ 2 ] < 9 ) {

		$raindrops_fluid_minimum_width = apply_filters( 'raindrops_fluid_minimum_width_lt_ie9', '640' );
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


if ( ! function_exists( 'raindrops_reset_theme_options' ) ) {

	/**
	 * @since 1.401
	 */
	function raindrops_reset_theme_options() {
		global $raindrops_setting_type, $raindrops_base_setting_args;

		if ( 'yes' == raindrops_warehouse_clone( 'raindrops_reset_options' ) ) {
			if ( 'option' == $raindrops_setting_type ) {
				delete_option( 'raindrops_theme_settings' );
				raindrops_update_theme_option( 'raindrops_reset_options', 'no' );
			}
		}

		if ( 'theme_mod' == $raindrops_setting_type && 'yes' == get_theme_mod( 'raindrops_reset_options' ) ) {

			foreach ( $raindrops_base_setting_args as $key => $name ) {

				if ( $key == 'raindrops_footer_link_color' ||
				$key == 'raindrops_footer_color' ||
				$key == 'raindrops_hyperlink_color' ||
				$key == 'raindrops_default_fonts_color' ) {

					set_theme_mod( $key, raindrops_default_colors_clone( 'dark', $key ) );
				} else {

					set_theme_mod( $key, raindrops_warehouse_clone( $key, 'option_value' ) );
				}
			}
			set_theme_mod( 'raindrops_reset_options', 'no' );
		}
	}

}

add_action( 'customize_save_after', 'raindrops_reset_theme_options' );

if ( ! function_exists( 'raindrops_reset_custom_color' ) ) {

	/**
	 *
	 * @global type $raindrops_base_setting_args
	 * @since 1.401
	 */
	function raindrops_reset_custom_color() {
		global $raindrops_base_setting_args;

		if ( 'automatic' == raindrops_warehouse_clone( 'raindrops_color_select' ) ) {

			$change_settings = array( 'raindrops_default_fonts_color', 'raindrops_complementary_color_for_title_link',
				'raindrops_footer_color', 'raindrops_hyperlink_color', 'raindrops_footer_link_color' );

			foreach ( $raindrops_base_setting_args as $key => $val ) {

				if ( in_array( $key, $change_settings ) ) {

					$validate_function = $key . '_validate';

					if ( isset( $val[ 'option_value' ] ) ) {

						$raindrops_color_default_val = $validate_function( $val[ 'option_value' ] );

						raindrops_update_theme_option( $key, $raindrops_color_default_val );
					}
				}
			}
		}
	}

}
add_action( 'customize_save_after', 'raindrops_reset_custom_color' );

/**
 *
 *
 *
 * @since 1.127
 */
if ( ! function_exists( 'raindrops_detect_display_none_condition' ) ) {

	function raindrops_detect_display_none_condition() {

		global $raindrops_where_display_none;

		if ( !isset( $raindrops_where_display_none ) || empty( $raindrops_where_display_none ) ) {

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
/**
 * Custom image header
 * $raindrops_custom_header_args
 */
add_filter( 'raindrops_header_image_width', 'raindrops_responsive_width_ajust' );

add_filter( 'raindrops_header_image_height', 'raindrops_responsive_height_ajust' );

if ( !isset( $raindrops_custom_header_args ) ) {

	$raindrops_custom_header_width	 = apply_filters( 'raindrops_header_image_width', absint( raindrops_detect_header_image_size_clone( 'width' ) ) );
	$raindrops_custom_header_height	 = apply_filters( 'raindrops_header_image_height', absint( raindrops_detect_header_image_size_clone( 'height' ) ) );
	$raindrops_current_style_type	 = raindrops_warehouse_clone( 'raindrops_style_type' );

	$raindrops_custom_header_args = array(
		'default-text-color' => raindrops_default_colors_clone( $raindrops_current_style_type, "header_textcolor", true ),
		'width'				 => $raindrops_custom_header_width,
		'flex-width'		 => true,
		'height'			 => $raindrops_custom_header_height,
		'flex-height'		 => true,
		'header-text'		 => true,
		'default-image'		 => '%1$s/images/headers/wp3.jpg',
		'wp-head-callback'	 => apply_filters( 'raindrops_wp-head-callback', 'raindrops_embed_meta' ),
	);

	if ( function_exists( 'has_header_video' ) ) {
		/**
		 * WordPress 4.7 check
		 */
		$raindrops_custom_header_args[ 'video' ] = true;
	}

	add_theme_support( 'custom-header', apply_filters( 'raindrops_custom_header_args', $raindrops_custom_header_args ) );

	/**
	 * Add for WordPress 4.1
	 * @since 1.260
	 */
	register_default_headers( array(
		'raindrops' => array(
			'url'			 => '%s/images/headers/wp3.jpg',
			'thumbnail_url'	 => '%s/images/headers/wp3-thumbnail.jpg',
		),
	) );
}

if ( ! function_exists( 'raindrops_detect_excerpt_condition' ) ) {

	function raindrops_detect_excerpt_condition() {

		global $raindrops_where_excerpts, $post;

		if ( !isset( $raindrops_where_excerpts ) || empty( $raindrops_where_excerpts ) ) {
			$raindrops_where_excerpts = array();
		}

		if ( raindrops_warehouse_clone( 'raindrops_entry_content_is_home' ) == 'excerpt' ||
		raindrops_warehouse_clone( 'raindrops_entry_content_is_home' ) == 'excerpt_grid' ) {

			$raindrops_where_excerpts[] = 'is_home';
		}
		if ( raindrops_warehouse_clone( 'raindrops_entry_content_is_category' ) == 'excerpt' ||
		raindrops_warehouse_clone( 'raindrops_entry_content_is_category' ) == 'excerpt_grid' ) {

			$raindrops_where_excerpts[] = 'is_category';
		}

		if ( raindrops_warehouse_clone( 'raindrops_entry_content_is_search' ) == 'excerpt' ||
		raindrops_warehouse_clone( 'raindrops_entry_content_is_search' ) == 'excerpt_grid' ) {

			$raindrops_where_excerpts[] = 'is_search';
		}

		if ( RAINDROPS_USE_LIST_EXCERPT !== true ) {

			return false;
		}

		if ( !empty( $raindrops_where_excerpts ) ) {

			$raindrops_where_excerpts = array_unique( $raindrops_where_excerpts );

			foreach ( $raindrops_where_excerpts as $excerpt ) {

				if ( true == $excerpt() ) {

					return true;
				}
			}
		}
		return false;
	}
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
if ( ! function_exists( 'raindrops_widgets_init' ) ) {

	function raindrops_widgets_init() {

		register_sidebar( array(
			'name'			 => esc_html__( 'Default Sidebar', 'raindrops' ),
			'id'			 => 'sidebar-1',
			'description'	 => '',
			'before_widget'	 => '<li id="%1$s" class="%2$s widget default" ' . raindrops_doctype_elements( '', 'tabindex="-1"', false ) . '>',
			'after_widget'	 => "</li>\n",
			'before_title'	 => "\n\t<h2 class=\"widgettitle default h2\"><span>",
			'after_title'	 => "</span></h2>\n",
			'widget_id'		 => 'default',
			'widget_name'	 => 'default',
			'text'			 => "1" ) );

		register_sidebar( array(
			'name'			 => esc_html__( 'Extra Sidebar', 'raindrops' ),
			'id'			 => 'sidebar-2',
			'description'	 => '',
			'before_widget'	 => '<li id="%1$s" class="%2$s widget extra" ' . raindrops_doctype_elements( '', 'tabindex="-1"', false ) . '>',
			'after_widget'	 => "</li>\n",
			'before_title'	 => "\n\t<h2 class=\"widgettitle extra h2\"><span>",
			'after_title'	 => "</span></h2>\n",
			'widget_id'		 => 'extra',
			'widget_name'	 => 'extra',
			'text'			 => "2" ) );
		register_sidebar( array(
			'name'			 => esc_html__( 'Sticky Widget', 'raindrops' ),
			'id'			 => 'sidebar-3',
			'description'	 => '',
			'before_widget'	 => '<li id="%1$s" class="%2$s widget sticky-widget" ' . raindrops_doctype_elements( '', 'tabindex="-1"', false ) . '>',
			'after_widget'	 => '</li>',
			'before_title'	 => "\n\t<h2 class=\"widgettitle home-top-content h2\"><span>",
			'after_title'	 => "</span></h2>\n",
			'widget_id'		 => 'toppage2',
			'widget_name'	 => 'toppage2',
			'text'			 => "3" ) );
		register_sidebar( array(
			'name'			 => esc_html__( 'Footer Widget', 'raindrops' ),
			'id'			 => 'sidebar-4',
			'description'	 => '',
			'before_widget'	 => '<li id="%1$s" class="%2$s widget footer-widget" ' . raindrops_doctype_elements( '', 'tabindex="-1"', false ) . '>',
			'after_widget'	 => "</li>\n",
			'before_title'	 => "\n\t<h2 class=\"widgettitle footer-widget h2\"><span>",
			'after_title'	 => "</span></h2>\n",
			'widget_id'		 => 'footer',
			'widget_name'	 => 'footer',
			'text'			 => "4" ) );
		register_sidebar( array(
			'name'			 => esc_html__( 'Post Format Status Sidebar', 'raindrops' ),
			'id'			 => 'sidebar-5',
			'description'	 => '',
			'before_widget'	 => '<li  id="%1$s" class="%2$s widget category-blog-widget status-side-bar" ' . raindrops_doctype_elements( '', 'tabindex="-1"', false ) . '>',
			'after_widget'	 => "</li>\n",
			'before_title'	 => "\n\t<h2 class=\"widgettitle category-blog-widget h2 status-side-bar\">",
			'after_title'	 => "</h2>\n",
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

	$content_width = apply_filters( 'raindrops_content_width', raindrops_content_width_clone() );
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

	if ( ! function_exists( $function_name ) ) {
		/* translators: 1: theme option name 2: theme validate function name */
		$message = sprintf( esc_html__( 'If you add  %1$s when you must create function %2$s for data validation', 'raindrops' ), $setting[ 'option_name' ], $function_name );
		printf( '<script type="text/javascript">alert( \'%1$s\' );</script>', $message );
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
if ( ! function_exists( 'raindrops_add_body_class' ) ) {

	function raindrops_add_body_class( $classes ) {

		global $post, $current_blog, $raindrops_link_unique_text, $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone, $raindrops_browser_detection, $raindrops_status_bar, $raindrops_current_column, $raindrops_setting_type, $raindrops_change_all_excerpt_archives_to_grid_layout, $raindrops_where_excerpts;

		$raindrops_link_unique_text	 = raindrops_link_unique_text();
		$classes[]					 = get_locale();
		$keyboard_support			 = raindrops_enable_keyboard();



		if ( 'enable' == $keyboard_support && true !== $raindrops_link_unique_text ) {

			$classes[] = 'enable-keyboard';
		}
		if( true == raindrops_is_grid_archives() ) {
			/**
			 * @1.464
			 */
			$classes[] = 'rd-grid';
		}
		if ( 'yes' == get_theme_mod( 'raindrops_year_2017_base_settings' ) ) {
			/**
			 * @since 1.457
			 */
			$classes[] = 'rd-2017-base-setting';
		}
		/**
		 * @since 1.447
		 * this class will removed jQuery removeClass
		 */
		$classes[]		 = 'noscript';
		/**
		 * @since 1.415
		 * add $builtin_type @1.440
		 */
		$builtin_type	 = false;

		if ( isset( $post->post_type ) && ( "post" == $post->post_type || "page" == $post->post_type || "attachment" == $post->post_type || "revision" == $post->post_type || "nav_menu_item" == $post->post_type ) ) {
			$builtin_type = true;
		}
		if ( 'yes' == raindrops_warehouse_clone( 'raindrops_color_coded_category' ) && true == $builtin_type ) {
			$classes[] = 'rd-cat-em';
		}
		if ( 'yes' == raindrops_warehouse_clone( 'raindrops_color_coded_post_tag' ) && true == $builtin_type ) {
			$classes[] = 'rd-tag-em';
		}
		/**
		 * @since 1.307
		 */
		if ( is_home() ) {
			$raindrops_use_featured_image_emphasis	 = raindrops_warehouse_clone( 'raindrops_use_featured_image_emphasis' );
			// yes no
			$raindrops_featured_image_position		 = raindrops_warehouse_clone( 'raindrops_featured_image_position' );
			//left front
			$classes[]								 = 'rd-featured-' . $raindrops_use_featured_image_emphasis . '-' . $raindrops_featured_image_position;
		}
		/**
		 * @since 1.497
		 */
		$classes[] = sanitize_html_class( "rd-basefont-" . raindrops_warehouse_clone( 'raindrops_basefont_settings' ) );
		/**
		 * @since 1.289
		 */
		$classes[] = sanitize_html_class( "rd-pw-" . raindrops_warehouse( 'raindrops_page_width' ) );

		if ( is_child_theme() ) {

			raindrops_filter_page_column_control();
		}
		if ( isset( $raindrops_current_column ) && !empty( $raindrops_current_column ) ) {
			$classes[] = sanitize_html_class( 'rd-col-' . $raindrops_current_column );
		}
		/**
		 * @since 1.447
		 */
		$raindrops_content_width_setting = raindrops_warehouse_clone( 'raindrops_content_width_setting' );

		if ( isset( $raindrops_current_column ) && 1 == $raindrops_current_column ) {

			$classes[]						 = sanitize_html_class( 'rd-content-width-' . $raindrops_content_width_setting );
		}

		if ( current_theme_supports( 'align-wide' ) && 'keep' !== $raindrops_content_width_setting ) {
			/**
			 * @1.515
			 */
			$classes[] = 'enable-align-wide';
		}
		/**
		 *
		 */
		$paragraph_wrap_enable = raindrops_warehouse_clone( 'raindrops_paragraph_line_wrapping' );

		if( 'enable' == $paragraph_wrap_enable ) {

			$classes[] = 'paragraph_wrap_enable';
		}
		/**
		 * @1.401
		 */
		if ( 'option' == $raindrops_setting_type ) {

			$customized = get_option( 'raindrops_theme_settings' );

			if ( false == $customized ) {
				$raindrops_is_customized = 'default';
				$classes[]				 = sanitize_html_class( 'rd-option-' . $raindrops_is_customized );
			}
			/**
			 * @1.434
			 */
			$classes[] = 'rd-setting-option';
		} else {
			$classes[] = 'rd-setting-mod';
		}

		$doc_type = raindrops_warehouse_clone( 'raindrops_doc_type_settings' );

		if ( function_exists( 'has_header_video' ) && is_header_video_active() && has_header_video() && 'html5' == $doc_type ) {
			/**
			 * @since 1.445
			 */
			$classes[] = 'rd-video-header';
		}

		if ( is_single() || is_page() ) {

			$raindrops_style_type = raindrops_warehouse_clone( "raindrops_style_type" );

			if ( isset( $raindrops_style_type ) && !empty( $raindrops_style_type ) ) {

				$color_type = sanitize_html_class( "rd-type-" . $raindrops_style_type );
			}

			if ( false !== ($type = raindrops_has_indivisual_notation() ) ) {

				if ( isset( $type[ 'color_type' ] ) ) {

					$color_type = sanitize_html_class( "rd-type-" . $type[ 'color_type' ] );
				}
			}

			if ( !isset( $color_type ) ) { // When not using database
				$color_type = sanitize_html_class( "rd-type-" . raindrops_warehouse( 'raindrops_style_type', 'option_value' ) );
			}
			$classes[] = $color_type;
		} else {

			$raindrops_style_type = raindrops_warehouse_clone( "raindrops_style_type" );
			if ( isset( $raindrops_style_type ) && !empty( $raindrops_style_type ) ) {

				$classes[] = sanitize_html_class( "rd-type-" . $raindrops_style_type );
			}
		}

		if ( true == $raindrops_browser_detection ) {

			$blowser_lang = raindrops_get_accept_language();

			if ( !empty( $blowser_lang ) ) {
				$browser_lang	 = 'accept-lang-' . $blowser_lang;
				$classes[]		 = sanitize_html_class( $browser_lang );
			}

			switch ( true ) {
				case ( $is_lynx ):
					$classes[] = 'lynx';
					break;

				case ( $is_gecko ):

					$classes[] = 'gecko';

					break;

				case ( $is_IE ):

					$http_user_agent = filter_input( INPUT_ENV, 'HTTP_USER_AGENT' );

					if ( preg_match( '!Trident/.*rv:([0-9]{1,}\.[\.0-9]{0,})!', $http_user_agent, $regs ) ) {
						$classes[] = sanitize_html_class( 'ie' . (int) $regs[ 1 ] );
					}

					preg_match( "|(MSIE )([0-9]{1,2})(\.)|si", $http_user_agent, $regs );
					if ( isset( $regs[ 2 ] ) ) {
						$classes[] = sanitize_html_class( 'ie' . $regs[ 2 ] );
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

		if ( !isset( $raindrops_status_bar ) ) {

			$raindrops_status_bar = raindrops_warehouse_clone( 'raindrops_status_bar' );

			if ( 'show' == $raindrops_status_bar ) {

				$raindrops_status_bar = true;
			} else {

				$raindrops_status_bar = false;
			}
		}

		if ( isset( $raindrops_status_bar ) && $raindrops_status_bar == true ) {

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
if ( ! function_exists( 'raindrops_comment' ) ) {

	function raindrops_comment( $comment, $args, $depth ) {

		if ( '' == $comment->comment_type ) {
			?>
			<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
				<div id="comment-<?php comment_ID(); ?>">
					<div class="comment-author vcard">
			<?php
			$core_avatar_setting = get_option( 'show_avatars' );
			if ( !empty( $core_avatar_setting ) ) {
				printf( '<div class="raindrops-comment-avatar">%1$s</div>', get_avatar( $comment, 160, '', esc_attr__( 'Avatar', 'raindrops' ) . ' ' . esc_attr( strip_tags( get_comment_author_link() ) ) ) );
			}
			?>
						<div class="raindrops-comment-author-meta">
						<?php
						printf( '%1$s <span class="says">%2$s</span>', sprintf( '<cite class="fn">%s</cite> ', get_comment_author_link() ), esc_html__( 'says:', 'raindrops' ) );
						?>
						</div>
						<div class="comment-meta commentmetadata clearfix">
							<a href="<?php
							/* translators: 1: comment date 2: comment time */
							echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf( esc_html__( '%1$s at %2$s', 'raindrops' ), get_comment_date(), get_comment_time() ); ?></a>
						<?php
						edit_comment_link( esc_html__( ' Edit ', 'raindrops' ) . raindrops_link_unique( 'Comment', $comment->comment_ID ), ' ' );
						?>
						</div>
					</div>
					<!-- .comment-author .vcard -->
			<?php
			if ( '0' == $comment->comment_approved ) {
				?>
						<div class="clearfix awaiting"> <em><?php esc_html_e( 'Your comment is awaiting moderation.', 'raindrops' ); ?></em>
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
					$raindrops_comment_reply_text = esc_html__( 'Reply', 'raindrops' ) . raindrops_link_unique( 'Comment', $comment->comment_ID );
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
			esc_html_e( 'Pingback:', 'raindrops' );
			comment_author_link();
			echo ' ';
			edit_comment_link( esc_html__( ' Edit ', 'raindrops' ) . raindrops_link_unique( 'Comment', $comment->comment_ID ), ' ' );
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
if ( ! function_exists( 'raindrops_posted_in' ) ) {

	function raindrops_posted_in() {

		$exclude_category_conditionals	 = apply_filters( 'raindrops_posted_in_category', array( 'is_category' => 'raindrops_post_category_relation' ) );
		$exclude_tag_conditional		 = apply_filters( 'raindrops_posted_in_tag', array( 'is_tag' => '' ) );

		global $post, $raindrops_tag_emoji, $raindrops_category_emoji;

		if ( is_sticky() ) {

			return;
		}

		$format			 = get_post_format( $post->ID );
		$tag_list		 = raindrops_get_the_posted_in_tag( '', ' ' );
		$categories_list = raindrops_get_the_posted_in_category( ' ' );


		if ( !empty( $exclude_category_conditionals ) && is_array( $exclude_category_conditionals ) ) {

			foreach ( $exclude_category_conditionals as $key => $conditional ) {

				if ( function_exists( $key ) && true == $key() ) {

					if ( empty( $conditional ) ) {

						$categories_list = '';
					} elseif ( function_exists( $conditional ) ) {

						$categories_list = $conditional();
					}
				}
			}
		}

		if ( !empty( $exclude_tag_conditionals ) && is_array( $exclude_tag_conditionals ) ) {

			foreach ( $exclude_tag_conditionals as $key => $conditional ) {

				if ( function_exists( $key ) && true == $key() ) {

					if ( empty( $conditional ) ) {

						$tag_list = '';
					} elseif ( function_exists( $conditional ) ) {

						$tag_list = $conditional();
					}
				}
			}
		}

		if ( 'emoji' == raindrops_warehouse_clone( 'raindrops_posted_in_label' ) ) {

			$category_label	 = $raindrops_category_emoji . '<span class="screen-reader-text">' . esc_html__( 'This entry was posted in', 'raindrops' ) . '</span>';
			$tag_label		 = $raindrops_tag_emoji . '<span class="screen-reader-text">' . esc_html__( 'and tagged', 'raindrops' ) . '</span>';

			$categories							 = wp_get_post_categories( $post->ID );
			$categories_count					 = count( $categories );
			$default_category_id				 = absint( get_option( 'default_category' ) );
			$raindrops_display_default_category	 = raindrops_warehouse_clone( 'raindrops_display_default_category' );

			if ( $categories_count == 1 && absint( $categories[ 0 ] ) == absint( $default_category_id ) && 'show' !== $raindrops_display_default_category ) {
				$category_label = '';
			}
			if ( is_category() ) {
				$category_label = '';
			}
		} else {
			$category_label	 = esc_html__( 'This entry was posted in', 'raindrops' );
			$tag_label		 = esc_html__( 'and tagged', 'raindrops' );
		}
		if ( false === $format ) {

			if ( $tag_list ) {

				$posted_in = '<span class="this-posted-in">' .
				$category_label .
				'</span><span class="post-category"> %1$s </span><span class="tagged">' .
				$tag_label .
				'</span><span class="post-tag"> %2$s </span>';
			} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {

				$posted_in = '<span class="this-posted-in">' . $category_label . '</span><span class="post-category">  %1$s </span>';
			} else {

				$posted_in = '';
			}

			$result = $format . sprintf( $posted_in, $categories_list, $tag_list );
			$result = apply_filters( "raindrops_posted_in", $result );

			echo $result;

		} else {

			if ( $tag_list ) {

				$posted_in = '<span class="this-posted-in">' . $category_label . '</span><span class="post-category"> %1$s </span><span class="tagged">' . $tag_label . '</span> <span class="post-tag"> %2$s </span>' . '  <span class="post-format-wrap"><span class="post-format-text">%4$s</span> <a href="%3$s"> <span class="post-format">%5$s</span></a></span>';
			} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {

				$posted_in = '<span class="this-posted-in">' . $category_label . '</span> <span class="post-category">%1$s %2$s</span>' . '  <span class="post-format-wrap"><span class="post-format-text">%4$s</span><a href="%3$s"> <span class="post-format">%5$s</span></a></span>';
			} else {

				$posted_in = '<a href="%3$s">   <span class="post-format-wrap"><span class="post-format-text">%4$s</span> <span class="post-format">%5$s</span></span></a>';
			}
			$result = sprintf( $posted_in, $categories_list, $tag_list, esc_url( get_post_format_link( $format ) ), esc_html( 'Format', 'raindrops' ), get_post_format_string( $format ) );
			$result = apply_filters( "raindrops_posted_in", $result );

			echo $result;
		}

		edit_post_link( esc_html__( 'Edit', 'raindrops' ) . raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );

		raindrops_delete_post_link( esc_html__( 'Trash', 'raindrops' ) . raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );
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
if ( ! function_exists( 'raindrops_comments_link' ) ) {

	function raindrops_comments_link() {

		if ( comments_open() ) {

			$raindrops_comment_html = '<a href="%1$s" class="raindrops-comment-link"><span class="raindrops-comment-string point"></span><em>%2$s %3$s</em></a>';

			if ( get_comments_number() > 0 ) {

				$raindrops_comment_string	 = _n( 'Comment', 'Comments', get_comments_number(), 'raindrops' ) . raindrops_link_unique( 'Post', get_the_ID() );
				$raindrops_comment_number	 = get_comments_number();
			} else {

				$raindrops_comment_string	 = __( 'Comment ', 'raindrops' ) . raindrops_link_unique( 'Post', get_the_ID() );
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

if ( ! function_exists( 'raindrops_post_author' ) ) {

	/**
	 * loop
	 * @global type $post
	 * @return type
	 * @since 1.272
	 */
	function raindrops_post_author() {
		global $post;

		$author						 = raindrops_blank_fallback( get_the_author(), 'Somebody' );
		/* translators: 1: post author */
		$author_attr_title_string	 = sprintf( esc_attr__( 'View all posts by %s', 'raindrops' ), wp_kses( $author, array() ) );
		$author_html				 = '<span class="author vcard"><a class="url fn nickname" href="%1$s" title="%2$s">%3$s</a></span> ';

		if ( "avatar" == raindrops_warehouse_clone( 'raindrops_display_article_author' ) ) {

			$author = get_avatar( get_the_author_meta( 'ID' ), 24 ) . '<span class="screen-reader-text">' . $author . '</span>';
		}

		$author_html = sprintf( $author_html, get_author_posts_url( get_the_author_meta( 'ID' ) ), $author_attr_title_string, $author );
		$author_html = apply_filters( 'raindrops_post_author', $author_html );

		return $author_html;
	}

}
if ( ! function_exists( 'raindrops_post_date' ) ) {

	/**
	 * loop
	 * @global type $post
	 * @return type
	 * @since1.272
	 */

	function raindrops_post_date() {
		global $post, $raindrops_posted_on_date_emoji;

		$published_class = 'updated';

		if( isset( $post ) && $post->post_date == $post->post_modified ) {
			/* @since 1.480 */
			$published_class = 'published';
		}
		$entry_date_html = '<a href="%1$s" title="%2$s"><%4$s class="entry-date %6$s" %5$s>%3$s</%4$s></a>';

		$archive_year			 = get_the_time( 'Y' );
		$archive_month			 = get_the_time( 'm' );
		$archive_day			 = get_the_time( 'd' );
		$day_link				 = esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) . '#post-' . $post->ID );
		$raindrops_date_format	 = get_option( 'date_format' ) . ' ' . get_option( 'time_format' );

		$date_text = get_the_date( $raindrops_date_format );

		if ( 'emoji' == raindrops_warehouse_clone( 'raindrops_display_article_publish_date' ) ) {
			$date_text = '<span class="emoji-date">' . $raindrops_posted_on_date_emoji . '</span><span class="screen-reader-text">' . $date_text . '</span>';
		}

		$entry_date_html = sprintf( $entry_date_html, $day_link, esc_attr( 'archives daily ' . get_the_date( $raindrops_date_format ) ), $date_text, raindrops_doctype_elements( 'span', 'time', false ), raindrops_doctype_elements( '', 'datetime="' . esc_attr( get_the_date( 'c' ) ) . '"', false ), $published_class
		);
		/**
		 * Custom Post Type Dairy Archives link not yet
		 * @since 1.443
		 */
		$post_type		 = get_post_type( get_the_ID() );

		if ( 'post' !== $post_type && 'page' !== $post_type ) {

			$entry_date_html = '<%2$s class="entry-date %4$s" %3$s>%1$s</%2$s>';

			$entry_date_html = sprintf( $entry_date_html, $date_text, raindrops_doctype_elements( 'span', 'time', false ), raindrops_doctype_elements( '', 'datetime="' . esc_attr( get_the_date( 'c' ) ) . '"', false )
			, $published_class );
		}

		$entry_date_html = apply_filters( 'raindrops_post_date', $entry_date_html, $date_text, absint( $post->ID ) );

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
if ( ! function_exists( 'raindrops_posted_on' ) ) {

	function raindrops_posted_on() {

		global $post;
		$called_function = __FUNCTION__;

		$author_html			 = apply_filters( 'raindrops_post_author', raindrops_post_author(), $called_function );
		$entry_date_html		 = apply_filters( 'raindrops_post_date', raindrops_post_date(), $called_function );
		$posted_on_comment_link	 = '';

		if ( !is_attachment() ) {
			/**
			 * @1.404
			 * Customize / Advanced / Show Attach to Post Date and Author in Attachment
			 * No needs comments link when attachment page
			 */
			$posted_on_comment_link = apply_filters( 'raindrops_comments_link', raindrops_comments_link(), $called_function );
		}

		$result				 = '<span class="meta-prep meta-prep-author">
			<span class="posted-on-string">%1$s</span></span> %2$s
			<span class="meta-sep"><span class="posted-by-string">%3$s</span></span> %4$s %5$s';
		$result				 = apply_filters( 'raindrops_posted_on_result', $result );
		$posted_on_string	 = '';
		if ( !empty( $entry_date_html ) ) {
			/**
			 * @1.404
			 */
			if ( is_attachment() ) {

				$posted_on_string = esc_html__( 'Attached to Post on', 'raindrops' );
			} elseif ( is_page() ) {

				$posted_on_string = esc_html__( 'Created on', 'raindrops' );
			} else {

				$posted_on_string = esc_html__( 'Posted on', 'raindrops' );
			}
		}
		$posted_by_string = '';
		if ( !empty( $entry_date_html ) ) {

			$posted_by_string = esc_html__( 'by', 'raindrops' );
		}
		$result	 = sprintf( $result, $posted_on_string, $entry_date_html, $posted_by_string, $author_html, $posted_on_comment_link );
		$result	 = raindrops_remove_empty_span( $result );

		$format				 = get_post_format();
		$content_empty_check = '';

		if ( isset( $post ) ) {
			$content_empty_check = trim( get_the_content() );
		}

		if ( false === $format ) {

			$result = apply_filters( "raindrops_posted_on", $result );
			echo $result;
		} elseif ( empty( $content_empty_check ) ) {

			echo $posted_on_comment_link;
		} else {

			$result = apply_filters( "raindrops_posted_on", $result );
			echo $result;
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
if ( ! function_exists( 'raindrops_filter_explode_meta_keys' ) ) {

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
if ( ! function_exists( 'raindrops_warehouse' ) ) {

	function raindrops_warehouse( $name, $property = false, $fallback = false ) {

		return apply_filters( "raindrops_warehouse", raindrops_warehouse_clone( $name, $property, $fallback ) );
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
if ( ! function_exists( 'raindrops_admin_meta' ) ) {

	function raindrops_admin_meta( $name, $meta_name ) {

		global $raindrops_base_setting, $raindrops_page_width;

		$raindrops_current_data			 = wp_get_theme();
		$raindrops_current_data_version	 = $raindrops_current_data->get( 'Version' );
		$raindrops_current_theme_name	 = $raindrops_current_data->get( 'Name' );
		/**
		 * Theme version trainsitional setting
		 * Note: Maybe remove new version live
		 */
		if ( version_compare( $raindrops_current_data_version, '1.356.1', '<=' ) && 'boots' == $raindrops_current_theme_name ) {

			return apply_filters( 'raindrops_admin_meta', raindrops_admin_meta_transitional( $name, $meta_name ) );
		}

		if ( version_compare( $raindrops_current_data_version, '1.216', '<=' ) && 'puddle' == $raindrops_current_theme_name ) {

			return apply_filters( 'raindrops_admin_meta', raindrops_admin_meta_transitional( $name, $meta_name ) );
		}


		return apply_filters( 'raindrops_admin_meta', $raindrops_base_setting[ $name ][ $meta_name ] );
	}

}
if ( ! function_exists( 'raindrops_admin_meta_transitional' ) ) {

	function raindrops_admin_meta_transitional( $name, $meta_name ) {

		global $raindrops_base_setting, $raindrops_page_width;

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
if ( ! function_exists( 'raindrops_settings_page_contextual_help' ) ) {

	function raindrops_settings_page_contextual_help() {

		global $raindrops_current_data;
		$html	 = '<dt>%1$s</dt><dd>%2$s</dd>';
		$link	 = '<a href="%1$s" %3$s>%2$s</a>';
		$content = '';
		/* theme URI */
		$content .= sprintf( $html, esc_html__( 'Theme URI', 'raindrops' ), sprintf( $link, $raindrops_current_data->get( 'ThemeURI' ), $raindrops_current_data->get( 'ThemeURI' ), 'target="_self"' ) );
		/* AuthorURI */
		$content .= sprintf( $html, esc_html__( 'Author', 'raindrops' ), sprintf( $link, $raindrops_current_data->get( 'AuthorURI' ), $raindrops_current_data->get( 'Author' ), 'target="_self"' ) );
		/* Support */
		$content .= sprintf( $html, esc_html__( 'Support', 'raindrops' ), sprintf( $link, 'https://wordpress.org/support/theme/raindrops', esc_html__( 'https://wordpress.org/support/theme/raindrops', 'raindrops' ), 'target="_blank"' ) . '<br />' . sprintf( $link, 'https://ja.wordpress.org/', esc_html__( 'https://ja.wordpress.org/ lang:Japanese', 'raindrops' ), 'target="_blank"' ) );
		/* Version */
		$content .= sprintf( $html, esc_html__( 'Version', 'raindrops' ), $raindrops_current_data->get( 'Version' ) );
		/* Changelog.txt */
		$content .= sprintf( $html, esc_html__( 'Change log text', 'raindrops' ), sprintf( $link, get_template_directory_uri() . '/changelog.txt', esc_html__( 'Changelog , display new window', 'raindrops' ), 'target="_blank"' ), 'target = "_blank"' );
		/* readme.txt */
		$content .= sprintf( $html, esc_html__( 'Readme text', 'raindrops' ), sprintf( $link, get_template_directory_uri() . '/README.txt', esc_html__( 'Readme , display new window', 'raindrops' ), 'target="_blank"' ) );
		$content = '<dl id="raindrops-help">' . $content . '</dl>';

		return $content;
	}

}

if ( ! function_exists( 'raindrops_editor_page_contextual_help' ) ) {

	function raindrops_editor_page_contextual_help() {

		global $raindrops_current_data;
		$html	 = '<dt>%1$s</dt><dd>%2$s</dd>';
		$link	 = '<a href="%1$s" %3$s>%2$s</a>';
		$content = '';
		$content .= sprintf( $html, esc_html__( 'Support', 'raindrops' ), sprintf( $link, 'https://wordpress.org/support/theme/raindrops', esc_html__( 'English', 'raindrops' ), 'target="_blank"' ) . '<br />' . sprintf( $link, 'https://ja.forums.wordpress.org/', esc_html__( 'Japanese', 'raindrops' ), 'target="_blank"' ) );

		$help = '<h2>' . esc_html__( 'How to remove Site Title Block', 'raindrops' ) . '</h2><pre><code>#hd{display:none;}</code></pre>';
		$help .= '<h2>' . esc_html__( 'How to remove Post Author Name', 'raindrops' ) . '</h2><pre><code>.posted-by-string,.author{display:none;}</code></pre>';
		$help .= '<h2>' . esc_html__( 'How to remove Entry Date', 'raindrops' ) . '</h2><pre><code>.posted-on-string,.entry-date{display:none;}</code></pre>';
		$help .= '<h2>' . esc_html__( 'How to remove Entry Meta', 'raindrops' ) . '</h2><pre><code>.entry-meta{display:none;}</code></pre>';
		$help .= '<h2>' . esc_html__( 'How to remove Archive Title Label[ like Category Archives ]', 'raindrops' ) . '</h2><pre><code>#archives-title .label{display:none;}</code></pre>';
		$help .= '<h2>' . esc_html__( 'How to remove Home list above next prev navigation link', 'raindrops' ) . '</h2><pre><code> #nav-above{ display:none;}</code></pre>';
		$help .= '<p>' . esc_html__( 'above codes paste style.css last. If not change when  Version value change ( line:9 )', 'raindrops' ) . '</p>';

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
if ( ! function_exists( 'raindrops_edit_help' ) ) {

	function raindrops_edit_help( $text, $force = false ) {

		global $post_type_object;
		global $title;

		if ( RAINDROPS_USE_AUTO_COLOR !== true && $force !== true ) {

			return $text;
		}

		if ( ( isset( $post_type_object ) && ( $title == $post_type_object->labels->add_new_item || $title == $post_type_object->labels->edit_item ) || true == $force ) ) {

			$result = "<h2 class=\"h2\">" . esc_html__( 'Tips', 'raindrops' ) . '</h2>';
			$result .= '<p>' . esc_html__( 'If Raindrops Options panel is opened, and the reference color is set, this arrangement of color is changed at once.', 'raindrops' ) . "</p>";
			$result .= "<dl><dt><h3 class=\"dm-color\">" . esc_html__( 'Dinamic Color Class', 'raindrops' ) . '</strong></h3>';
			$result .= "<dd><a href=\"customize.php?autofocus[section]=raindrops_theme_settings_presentation\">" . esc_html__( 'Link to Customize Base Color Settings', 'raindrops' ) . '</a></dd>';
			$result .= '<dd><table><tr>
					<td style="' . raindrops_colors_clone( 5, 'set' ) . ';padding:0.5em;">class color5</td>
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
					' . esc_html__( 'code example:please HTML editor mode', 'raindrops' ) . '
					<div  style="' . raindrops_colors_clone( -1, 'set' ) . ';padding:1em;">&lt;div class="color-1"&gt;
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum&lt;/div&gt;
					</div></td>
					</tr></table>
					</dd>';

			$style_type = raindrops_warehouse_clone( 'raindrops_style_type' );

			if( 'dark' == $style_type || 'light' == $style_type ) {

			$result .= "<dt><h3>" . esc_html__( 'Dinamic Gradient Class', 'raindrops' ) . '</h3></dt>';
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
				' . esc_html__( 'code example:please HTML editor mode', 'raindrops' ) . '
				<div  style="' . raindrops_gradient_single( -1, "asc" ) . 'padding:1em;">&lt;div class="gradient-1"&gt;<p>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>&lt;/div&gt;</div></td></tr></table></dd>';
			}

			$result .= "<dl><dt><h3>" . esc_html__( 'Font Size CSS Class', 'raindrops' ) . '</strong></h3>';
			$result .= "<dt><p>" . esc_html__( 'Classes', 'raindrops' ) . '</p></dt>';
			$result .= "<dd><p>" . esc_html__( 'f10 , f11 , f12 , f13 , f14 , f15 , f16 , f17 , f18 , f19 , f20 , f21 , f22 , f23 , f24 , f25 , f26...f40', 'raindrops' ) . "</p><pre><code>&lt;p class=\"f16\"&gt;Font Size 16px&lt;/p&gt;</code></pre>";
			$result .= "</dl>";
			$result .= "<dl><dt><h3>" . esc_html__( 'Google Fonts Family CSS Class', 'raindrops' ) . '</strong></h3>';
			$result .= "<dt><p>" . esc_html__( 'Classes', 'raindrops' ) . '</p></dt>';
			$result .= "<dd><p>" . esc_html__( 'Note, More than 90 percent of the Google font can be used, but there are some limitations.', 'raindrops' ) . "</p></dd>";
			$result .= "<dd><p>" . esc_html__( 'Examples of the no corresponding font', 'raindrops' ) . "</p><pre><code>Fredericka the Great ( The first character is lowercase word ) </code></pre></dd>";
			$result .= "<dd><p>" . esc_html__( 'Examples of the corresponding font', 'raindrops' ) . "</p><pre><code>Open Sans Condensed ( font name has 0 - 2 spaces ) </code></pre></dd>";
			$result .= "<dd><p>" . esc_html__( 'How to specify the font', 'raindrops' ) . "</p><pre><code>Open Sans: &lt;p class=\"google-font-open-sans\"&gt;Open Sans&lt;/p&gt;</code></pre></dd>";
			$result .= "<dd><p>" . esc_html__( 'Add prefix google-font- + Font name lowercase and change to - the space', 'raindrops' ) . "</p></dd>";
			$result .= "<dd><p>" . esc_html__( 'How to specify the font weight', 'raindrops' ) . "</p><pre><code>Open Sans EXTRA-BOLD800: &lt;p class=\"google-font-open-sans800\"&gt;Open Sans&lt;/p&gt;</code></pre></dd>";
			$result .= "<dd><p>" . esc_html__( 'How to specify the font style', 'raindrops' ) . "</p><pre><code>Open Sans EXTRA-BOLD800 Italic: &lt;p class=\"google-font-open-sans800i\"&gt;Open Sans&lt;/p&gt;</code></pre></dd>";
			$result .= "</dl>";

			$result .= "<dl><dt><h3>" . esc_html__( 'Example of Custom CSS Meta Box Style Rules', 'raindrops' ) . '</strong></h3>';
			$result .= "<dt><p>" . esc_html__( 'Styling Entry Title', 'raindrops' ) . '</p></dt>';
			$result .= "<dd><p>" . esc_html__( 'Change entry title color', 'raindrops' ) . "</p><pre><code>.entry-title span{ color:red; }</code></pre>";
			$result .= "<dt><p>" . esc_html__( 'Styling Posted on', 'raindrops' ) . '</p></dt>';
			$result .= "<dd><p>" . esc_html__( 'hide posted on from all post', 'raindrops' ) . "</p><pre><code> .posted-on, .entry-meta-default{ display:none;}</code></pre></dd>";
			$result .= "<dt><p>" . esc_html__( 'Styling Posted in', 'raindrops' ) . '</p></dt>';
			$result .= "<dd><p>" . esc_html__( 'hide posted in', 'raindrops' ) . "</p><pre><code> .entry-meta{ display:none;}</code></pre></dd>";
			$result .= "<dt><p>" . esc_html__( 'Styling Article', 'raindrops' ) . '</p></dt>';
			$result .= "<dd><p>" . esc_html__( 'add border and padding', 'raindrops' ) . "</p><pre><code>article {border:1px solid red;padding:1em;}</code></pre>"
			. "<p>" . esc_html__( 'note:article elements and post_class () You can use all of the elements to be output.', 'raindrops' ) . "</p></dd>";
			$result .= "</dl>";

			$result .= "<dl><dt><h3>" . esc_html__( 'Example of Raindrops Notation Tags', 'raindrops' ) . '</strong></h3>';
			$result .= '<dt><p>&lt;!--[raindrops color_type="dark" col="1"]--&gt;</p></dt>';
			$result .= "<dd><p>" . esc_html__( 'When pasting this tag in the entry content, it displays in color type dark 1 column layout', 'raindrops' ) ."</p></dd>";
			$result .= "<dd><p>" . esc_html__( 'color_type values [dark|light|w3standard|minimal] col values [1|2|3]', 'raindrops' ) ."</p></dd>";
			$result .= '<dt><p>&lt;!--[raindrops skip-excerpt]--&gt;</p></dt>';
			$result .= "<dd><p>" . esc_html__( 'Even if it is set to display excerpt sentences in the archive, this post will be displayed in full text.', 'raindrops' ) ."</p></dd>";
			$result .= "</dl>";

			$result .= $text;
			return $result;
		} else {

			return $text;
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
if ( ! function_exists( 'raindrops_upload_image_parser' ) ) {

	function raindrops_upload_image_parser( $uri, $embed = "inline", $id = "#hd" ) {

		//upload image from raindrops admin panel saved filename
		// e.g. raindrops-item-header-style-no-repeat-top-0-left-0-aomoriken.jpg
		// filename parse and create style

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
if ( ! function_exists( 'raindrops_gradient_single' ) ) {

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
if ( ! function_exists( 'raindrops_gradient' ) ) {

	function raindrops_gradient( $selector ) {

		return apply_filters( "raindrops_gradient", raindrops_gradient_clone( $selector ) );
	}

}

if ( ! function_exists( "raindrops_add_stylesheet" ) ) {

	function raindrops_add_stylesheet() {

		global $raindrops_current_theme_name, $raindrops_current_data_version, $raindrops_css_auto_include, $raindrops_fallback_human_interface_show, $raindrops_tooltip, $wp_scripts, $raindrops_minified_suffix, $raindrops_load_minified_css_js;
		/* 1.498 jquery in footer */
		wp_scripts()->add_data( 'jquery', 'group', 1 );
		wp_scripts()->add_data( 'jquery-core', 'group', 1 );
		wp_scripts()->add_data( 'jquery-migrate', 'group', 1 );

		if( ! is_user_logged_in() ) {
			/* @since 1.490 */
			$raindrops_current_data_version = null;
		}
		/* @1.333 */
		if ( true == $raindrops_fallback_human_interface_show ) {

			$fallback_style = get_template_directory_uri() . '/fallback.css';
			wp_register_style( 'fallback_style', $fallback_style, array(), $raindrops_current_data_version, 'all' );
			wp_enqueue_style( 'fallback_style' );

			return;
		}

		if ( false !== ( $url = raindrops_locate_url( 'reset-fonts-grids.css' ) ) ) {

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

		$style_filename = 'languages/css/' . get_locale() . '.css';

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

			if ( file_exists( get_template_directory() . '/style' . $raindrops_minified_suffix . '.css' ) && true == $raindrops_load_minified_css_js ) {
				$style_filename = get_template_directory_uri() . '/style' . $raindrops_minified_suffix . '.css';
			}

			wp_register_style( 'style', $style_filename, array( 'raindrops_fonts' ), $raindrops_current_data_version, 'all' );
			wp_enqueue_style( 'style' );
		}

		if ( is_child_theme() ) {

			$style_filename = get_stylesheet_directory_uri() . '/style.css';

			if ( file_exists( get_stylesheet_directory() . '/style' . $raindrops_minified_suffix . '.css' ) && true == $raindrops_load_minified_css_js ) {
				$style_filename = get_stylesheet_directory_uri() . '/style' . $raindrops_minified_suffix . '.css';
			}

			if ( $raindrops_css_auto_include == true ) {

				wp_register_style( 'child', $style_filename, array( 'style' ), $raindrops_current_data_version, 'all' );
				wp_enqueue_style( 'child' );

					$inline_style	 = apply_filters( 'raindrops_inline_style', "" );
					$inline_style	 = raindrops_remove_spaces_from_css( $inline_style );
					wp_add_inline_style( 'child', $inline_style );

			} else {

				if ( raindrops_warehouse_clone( "raindrops_style_type" ) !== 'w3standard' ) {

					wp_register_style( 'child', $style_filename, array( 'raindrops_css3' ), $raindrops_current_data_version, 'all' );
					wp_enqueue_style( 'child' );
				} else {

					wp_register_style( 'child', $style_filename, array( 'lang_style' ), $raindrops_current_data_version, 'all' );
					wp_enqueue_style( 'child' );
				}
			}

			/**
			 * When Using Child Theme, Parent rtl.css is not load, only load child themes load rtl.css
			 * When not exists rtl.css at Child Theme, It should be automate include parent rtl.css
			 *
			 */
			if ( is_rtl() ) {

				$rtl_css = raindrops_locate_url( 'rtl.css' );

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

			wp_register_script( 'raindrops', $url, array( 'jquery', 'jquery-migrate', 'raindrops_helper_script' ), $raindrops_current_data_version, true );
			wp_enqueue_script( 'raindrops' );
		}
		$raindrops_lazyload_image_enable		= raindrops_warehouse_clone( 'raindrops_lazyload_image' );
		$raindrops_performance_helper_enable	= raindrops_warehouse_clone( 'raindrops_performance_helper' );
		$only_front_end							= raindrops_scripts_operate_only_front_end();
		if( true == WP_DEBUG ) {
			if('enable' == $raindrops_performance_helper_enable && $only_front_end ) {

				if ( false !== ( $url = raindrops_locate_url( 'lazyload.js' ) )  ) {
					wp_register_script( 'raindrops-lazyload', $url, array( 'raindrops' ), $raindrops_current_data_version, true );

				}
			}

			if( 'enable' == $raindrops_lazyload_image_enable && $only_front_end ){

				if ( false !== ( $url = raindrops_locate_url( 'instantclick.js' ) ) ) {
					wp_register_script( 'raindrops-instantclick', $url, array( 'raindrops-lazyload' ), $raindrops_current_data_version, true );

				}
			}
		} else {
			
			if('enable' == $raindrops_performance_helper_enable && $only_front_end ) {

				if ( false !== ( $url = raindrops_locate_url( 'lazyload.min.js' ) )  ) {
					wp_register_script( 'raindrops-lazyload', $url, array( 'raindrops' ), $raindrops_current_data_version, true );

				}
			}

			if( 'enable' == $raindrops_lazyload_image_enable && $only_front_end ){

				if ( false !== ( $url = raindrops_locate_url( 'instantclick.min.js' ) ) ) {
					wp_register_script( 'raindrops-instantclick', $url, array( 'raindrops-lazyload' ), $raindrops_current_data_version, true );

				}
			}
			
			
		}


		
		
		//raindrops_add_tooltip_script();
		
		//	raindrops_add_lazyload_script();
		//	raindrops_add_instantclick_script();


	}

}
add_action( 'wp_enqueue_scripts', 'raindrops_add_tooltip_script' );

if ( ! function_exists( "raindrops_add_tooltip_script" ) ) {

	/**
	 *
	 * @global type $raindrops_tooltip
	 * @global type $wp_scripts
	 * @since 1.417
	 */
	function raindrops_add_tooltip_script() {

		global $raindrops_tooltip, $wp_scripts;

		if ( $raindrops_tooltip == true && 'yes' == raindrops_warehouse_clone( 'raindrops_tooltip' ) ) {

			wp_enqueue_script( 'jquery-ui-tooltip' );
			$js = "jQuery(function() {
						jQuery( document ).tooltip({position: {
							my: 'center', at: 'top-30', collision: 'none'
						}});
						jQuery('.widget_media_video, .wp-video').tooltip({position:{
							my: 'center', at: 'bottom+30', collision: 'none'
						}});
						jQuery('.widget_media_video, .wp-video').tooltip('option', 'tooltipClass','bottom-tooltip' );

					});";

			wp_add_inline_script( 'jquery-ui-tooltip', $js );
		}
	}

}

if ( ! function_exists( "raindrops_comment_form" ) ) {

	/**
	 * filter function comment form
	 * @global type $commenter
	 * @param array $form
	 * @return type
	 */
	function raindrops_comment_form( $form ) {

		global $commenter;
		$form[ 'url' ] = '<p class="comment-form-url"><label for="url">' . esc_html__( 'Website', 'raindrops' ) . '</label><span class="option">' . esc_html__( '(&nbsp;optional&nbsp;)', 'raindrops' ) . '</span><input id="url" name="url" type="text" value="' . esc_attr( $commenter[ 'comment_author_url' ] ) . '" size="30" /></p>';
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
if ( ! function_exists( "raindrops_custom_remove_aria_required" ) ) {

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
 * image element has attribute 'width','height' and image size > column width
 * style max-width value 100% set when expand height height attribute value.
 *
 * IE filter
 *
 */
if ( ! function_exists( "raindrops_ie_height_expand_issue" ) ) {

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

if ( ! function_exists( "raindrops_delete_all_options" ) ) {

	function raindrops_delete_all_options() {

		if ( current_user_can( 'delete_themes' ) ) {

			delete_option( 'raindrops_theme_settings' );

			remove_theme_mods();

			delete_option( 'widget_raindrops_pinup_entry_widget' );
			delete_option( 'widget_raindrops_entrywidget' );

			$allposts = get_posts( 'numberposts=0&post_type=post&post_status=' );

			foreach ( $allposts as $postinfo ) {

				delete_post_meta( $postinfo->ID, '_web_fonts_styles' );
				delete_post_meta( $postinfo->ID, '_web_fonts_link_element' );
				delete_post_meta( $postinfo->ID, '_css' );
				delete_post_meta( $postinfo->ID, 'css' );
				delete_post_meta( $postinfo->ID, '_add-to-front' );
				delete_post_meta( $postinfo->ID, '_raindrops_this_header_image' );
				delete_post_meta( $postinfo->ID, 'meta' );
				if ( RAINDROPS_CUSTOM_FIELD_SCRIPT == true ) {
					delete_post_meta( $postinfo->ID, 'javascript' );
				}
			}

			$allposts = get_posts( 'numberposts=0&post_type=page&post_status=' );

			foreach ( $allposts as $postinfo ) {

				delete_post_meta( $postinfo->ID, '_web_fonts_styles' );
				delete_post_meta( $postinfo->ID, '_web_fonts_link_element' );
				delete_post_meta( $postinfo->ID, '_css' );
				delete_post_meta( $postinfo->ID, 'css' );
				delete_post_meta( $postinfo->ID, '_add-to-front' );
				delete_post_meta( $postinfo->ID, '_raindrops_this_header_image' );
				delete_post_meta( $postinfo->ID, 'meta' );
				if ( RAINDROPS_CUSTOM_FIELD_SCRIPT == true ) {
					delete_post_meta( $postinfo->ID, 'javascript' );
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
 * @1.312
 */
if ( ! function_exists( "raindrops_emoji_collection" ) ) {

	function raindrops_emoji_collection( $condition = '' ) {
		global $raindrops_tag_emoji, $raindrops_category_emoji;

		$raindrops_tag_emoji_for_archive		 = '\\' . str_replace( array( '&#x', ';' ), '', $raindrops_tag_emoji );
		$raindrops_category_emoji_for_archive	 = '\\' . str_replace( array( '&#x', ';' ), '', $raindrops_category_emoji );

		$emoji_code	 = '';
		$condition	 = get_the_archive_title();


		if ( is_tag() ) {
			$condition	 = 'tag';
			$emoji_code	 = $raindrops_tag_emoji_for_archive;
		}
		if ( is_category() ) {
			$condition	 = 'category';
			$emoji_code	 = $raindrops_category_emoji_for_archive;
		}
		return apply_filters( 'raindrops_emoji_collection', $emoji_code, $condition );
	}

}


if ( ! function_exists( "raindrops_embed_css" ) ) {

	function raindrops_embed_css() {

		global $post, $raindrops_fluid_or_fixed, $raindrops_fluid_minimum_width, $raindrops_wp_version, $raindrops_current_theme_name, $raindrops_page_width, $raindrops_base_font_size, $raindrops_custom_header_width, $raindrops_custom_header_height, $raindrops_current_column, $raindrops_setting_type, $raindrops_use_transient, $raindrops_automatic_color;

		if ( empty( $raindrops_automatic_color ) ) {

			if ( 'automatic' == raindrops_warehouse_clone( 'raindrops_color_select' ) ) {

				$raindrops_automatic_color = true;
			} else {
				$raindrops_automatic_color = false;
			}
			if ( false !== raindrops_has_indivisual_notation() ) {

				$raindrops_automatic_color = true;
			}
		}

		$css = apply_filters( 'raindrops_embed_css_pre', '' );

		$css .= '/* raindrops_embed_css */';

		$raindrops_content_elements_margin	 = raindrops_warehouse_clone( 'raindrops_content_elements_margin' );
		$raindrops_content_elements_margin	 = floatval( $raindrops_content_elements_margin );

		if ( 1 < $raindrops_content_elements_margin ) {
			$raindrops_content_elements_margin_x2		 = $raindrops_content_elements_margin * 2;
			$raindrops_content_elements_top_margin		 = $raindrops_content_elements_margin * 1.5;
			$raindrops_content_elements_bottom_margin	 = $raindrops_content_elements_margin * 0.75;
			/* @since 1.511 */
			if( 1.65 > $raindrops_content_elements_bottom_margin  ) {
				$raindrops_content_elements_line_height = 1.65;
			} else {
				$raindrops_content_elements_line_height = $raindrops_content_elements_bottom_margin;
			}
			/* Vertical Rhythm */
			$css .= "\n article .entry-content > p{margin-bottom:" . $raindrops_content_elements_margin . 'em;line-height:'.$raindrops_content_elements_line_height.';}';
			$css .= "\n article .entry-content h1, .entry-content h2, .entry-content h3, .entry-content h4,.entry-content h5, .entry-content h6{margin-top:" . $raindrops_content_elements_top_margin . "em; margin-bottom:" . $raindrops_content_elements_bottom_margin . 'em;}';
			$css .= "\n article .entry-content > blockquote{margin-top:" . $raindrops_content_elements_margin . "em; margin-bottom:" . $raindrops_content_elements_margin . 'em;}';
			$css .= "\n article .entry-content > div{margin-bottom:" . $raindrops_content_elements_margin_x2 . 'em;}';
			$css .= "\n article .entry-content > ul,.entry-content > ol{margin-top:" . $raindrops_content_elements_margin . "em; margin-bottom:" . $raindrops_content_elements_margin . 'em;}';
		}
		$raindrops_text_transform_of_title = raindrops_warehouse_clone( 'raindrops_text_transform_of_title' );

		if ( 'yes' == $raindrops_text_transform_of_title ) {
			$css .= "\n#site-title{text-transform: uppercase;}";
			$css .= "\n.entry-title{text-transform: uppercase;}";
			$css .= "\n.widgettitle,.archive .title-wrapper,.date .page-title{text-transform: uppercase;}";
			$css .= "\n h1,.h1,h2,.h2,h3,.h3,h4,.h4,h5,.h5,h6,.h6{text-transform: uppercase;}";
		}
		/* @sice 1.458 fallback menu background color */
		$raindrops_base_color = raindrops_warehouse_clone( 'raindrops_base_color' );

		// @since 1.492
		$default_basefont_val	= (int) raindrops_warehouse_clone( 'raindrops_basefont_settings', 'option_value' );
		$sidebar_h2_margin		= ceil( $default_basefont_val * 1.539 );

		$css .= '.lsidebar, div[role="main"]{ padding-top:'. $sidebar_h2_margin. 'px;}';
		$css .= '.rsidebar{ padding-bottom:'. $sidebar_h2_margin. 'px;}';
		$css .= '#doc5 .raindrops-no-keep-content-width .raindrops-expand-width{margin-top:0}';
		$css .= '#doc3 .raindrops-no-keep-content-width .raindrops-expand-width{margin-top:0}';
		// @1.497 $css .= '#searchform{margin: '. $sidebar_h2_margin. 'px 0 1em 0.38461538461em;}';
		$css .= '.rd-col-1 .loop-before-toolbar{ margin-top:'. $sidebar_h2_margin. 'px;}';
		$css .= '.rd-col-1 .single-post-thumbnail{ margin-top:'. $sidebar_h2_margin. 'px;}';
		$css .= '.page ul.blank-front{ margin-top:'. $sidebar_h2_margin. 'px;}';
		/**
		 * when not set widget in default sidebar,
		 * Add padding to the width section where the left margin of the page is insufficient
		 * relate .home #doc3 #bd:not(.rd-expand-sidebar-default) > .yui-main > .yui-b . below 237line
		 *
		 *  @since 1.492
		 */
		$is_active_sidebar_1			= is_active_sidebar( 'sidebar-1' );
		$default_sidebar_break_point	= raindrops_warehouse_clone( 'raindrops_default_sidebar_responsive_breakpoint' );
		$extra_sidebar_break_point		= raindrops_warehouse_clone( 'raindrops_extra_sidebar_responsive_breakpoint' );
		$min_break_point				= min( $default_sidebar_break_point, $extra_sidebar_break_point );

		$is_responsive_seting			= raindrops_warehouse_clone( 'raindrops_extra_sidebar_responsive' );

		if( ! $is_active_sidebar_1 && 'yes' == $is_responsive_seting ) {

			$css .= "\n".'@media screen and (min-width : '. $min_break_point.'px){ div[role="main"]{padding-left:1em;box-sizing:border-box;} }';
			
			//@1.526
			
			$css .= "\n".'@media screen and (max-width : '. $min_break_point.'px){ '
					. '.enable-align-wide #bd figure.alignfull{
							margin-left: -2em;
							margin-right: 0;
							position: static;
							display: block;
							float: none;
							clear: both;
						}'
					. ' }';
			
			
			$css .= "\n".'#yui-main .rsidebar,#bd .lsidebar{min-height:0!important; }';
		}

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			/**
			 * @since 1.514
			 */
			$thread_comments_depth = absint( get_option( 'thread_comments_depth' ) );

			if ( isset( $thread_comments_depth ) && !empty( $thread_comments_depth ) ) {

				for ($i = 2; $i <= $thread_comments_depth; $i++) {

					$padding_count = ( $i - 1 ) * 13;
					$css .= '.commentlist .depth-'. $i. '{ padding-left:2.4em; }';
				}
			}

		}
		/**
		 * Paragraph line wrapping
		 * @since 1.511
		 */
		$paragraph_wrap_enable = raindrops_warehouse_clone( 'raindrops_paragraph_line_wrapping' );

		if ( 'enable' == $paragraph_wrap_enable ) {

			$basefont_size			 = raindrops_warehouse_clone( 'raindrops_basefont_settings' );
			$paragraph_wrap_width	 = raindrops_warehouse_clone( 'raindrops_paragraph_line_wrapping_value' );
			$max_width_px			 = $basefont_size * $paragraph_wrap_width;
			$paragraph_wrap_width_en = round( $paragraph_wrap_width / 2 );
			$max_width_en_px		 = round( ( $basefont_size * $paragraph_wrap_width ) / 2 );

			if ( 'ja' == get_locale() ) {
				$css .= '.entry-content > .wp-block-search{ max-width:' . $max_width_px . 'px;}';
				$css .= '.entry-content > .is-small-text{ max-width:' . $max_width_px . 'px;}';
				$css .= '.entry-content > .is-regular-text{ max-width:' . $max_width_px . 'px;}';
				$css .= '.post .entry-content > p:not(.d-tate):not(.trancate){ width:' . $paragraph_wrap_width . 'em;}';
				$css .= '.entry-content > p.aligncenter{ width:' . $paragraph_wrap_width . 'em;}';
				$css .= '.entry-content .aligncenter:not(.wp-block-cover){ max-width:' . $max_width_px . 'px;}';
				$css .= '.entry-content figure.aligncenter{ max-width:' . $max_width_px . 'px;}';
				$css .= '.entry-content .fit-p{ max-width:' . $max_width_px . 'px;}';
				$css .= '.entry-content ul,ol{ max-width:' . $max_width_px . 'px;}';
				$css .= '.rd-grid .entry-content > p:not([class]){ max-width:100%;}';
				$css .= '.rd-grid .entry-content .aligncenter{ max-width:100%;}';
				$css .= '.rd-grid .entry-content > p.aligncenter{ width:100%;}';
				$css .= '.rd-grid .entry-content > p.alignleft{ max-width:100%;margin-right:0;}';
				$css .= '.rd-grid .entry-content > p.alignright{ max-width:100%;margin-left:0;}';
				$css .= '.rd-grid .entry-content .fit-p{ max-width:100%;}';
				$css .= '@media screen and (max-width : ' . $paragraph_wrap_width . 'em){';
				$css .= '.entry-content > .wp-block-search{ max-width:100%;}';
					$css .= '.entry-content > .is-small-text{ max-width:100%;}';
					$css .= '.entry-content > .is-regular-text{ max-width:100%;}';
					$css .= '.entry-content >  p:not(.d-tate):not(.trancate){ max-width:100%;}';
					$css .= '.entry-content > p.aligncenter{ max-width:100%;}';
					$css .= '.entry-content .aligncenter{ max-width:100%;}';
					$css .= '.entry-content .fit-p{ max-width:100%;}';
					$css .= '.entry-content ul,ol{ max-width:100%;}';
				$css .= '}';
			} else {
				$css .= '.entry-content > .wp-block-search{ max-width:' . $max_width_en_px . 'px;}';
				$css .= '.entry-content > .is-small-text{ max-width:' . $max_width_en_px . 'px;}';
				$css .= '.entry-content > .is-regular-text{ max-width:' . $max_width_en_px . 'px;}';
				$css .= '.entry-content > p:not(.d-tate):not(.trancate){ width:' . $paragraph_wrap_width_en . 'em;}';
				$css .= '.entry-content > p.aligncenter{ width:' . $paragraph_wrap_width_en . 'em;}';
				$css .= '.entry-content .aligncenter{ max-width:' . $max_width_en_px . 'px;}';
				$css .= '.entry-content figure.aligncenter{ max-width:' . $max_width_en_px . 'px;}';
				$css .= '.entry-content .fit-p{ max-width:' . $max_width_en_px . 'px;}';
				$css .= '.entry-content ul,ol{ max-width:' . $max_width_en_px . 'px;}';
				$css .= '.rd-grid .entry-content > p:not([class]){ max-width:100%;}';
				$css .= '.rd-grid .entry-content .aligncenter{ max-width:100%;}';
				$css .= '.rd-grid .entry-content > p.aligncenter{ width:100%;}';
				$css .= '.rd-grid .entry-content > p.alignleft{ max-width:100%;margin-right:0;}';
				$css .= '.rd-grid .entry-content > p.alignright{ max-width:100%;margin-left:0;}';
				$css .= '.rd-grid .entry-content .fit-p{ max-width:100%;}';
				$css .= '@media screen and (max-width : ' . $paragraph_wrap_width_en . 'em){';
				$css .= '.entry-content > .wp-block-search{ max-width:100%;}';
					$css .= '.entry-content > .is-small-text{ max-width:100%;}';
					$css .= '.entry-content > .is-regular-text{ max-width:100%;}';
					$css .= '.entry-content >  p:not(.d-tate):not(.trancate){ max-width:100%;}';
					$css .= '.entry-content > p.aligncenter{ max-width:100%;}';
					$css .= '.entry-content .aligncenter{ max-width:100%;}';
					$css .= '.entry-content .fit-p{ max-width:100%;}';
					$css .= '.entry-content ul,ol{ max-width:100%;}';
				$css .= '}';
			}
		}
		/**
		 * if featured image in singular and show then add margin
		 *
		 * @1.492
		 */
		$is_featured_image_singlar_hide = raindrops_warehouse_clone( 'raindrops_featured_image_singular' );

		if( 'hide' !== $is_featured_image_singlar_hide ) {
			$css .= "\n". '.page .has-post-thumbnail .entry-title,.single .has-post-thumbnail .entry-title{ margin-top:.75em;}';
		}
		/**
		 * Customizer partial shortcut Position
		 * @1.494
		 */
		if( is_customize_preview() ) {
			$css .= ' .widget .customize-partial-edit-shortcut, .customize-partial-edit-shortcut{margin: -15px 0 0 20px;}';
		}
		//#header-image
		$css .= "\n" . raindrops_header_image( 'css' ) . "\n";

		//#header-image bounse issue fixed
		$css_rule_set			 = '#header-imge{ width:%1$spx;height:%2$spx;}';
		$css .= "\n" . sprintf( $css_rule_set, $raindrops_custom_header_width, apply_filters( 'raindrops_header_image_height', $raindrops_custom_header_height ) );
		/* @since 1.445 */
		$css .= '.rd-video-header .static-front-media ' . raindrops_header_image( 'css' ) . "\n";
		$css .= '.rd-video-header .static-front-media #header-image #site-title,.rd-video-header .static-front-media #header-image .tagline{display:none!important;}' . "\n";
		//site-title
		$raindrops_text_color	 = get_theme_mod( 'header_textcolor' );

		if ( $raindrops_text_color !== 'blank' &&
		display_header_text() == true &&
		false == raindrops_has_indivisual_notation() ) {

			$css .= "\n h1 a.site-title-link{color:#" . $raindrops_text_color . ';}';
		}
		// @1.519
		if( isset($post) && ! empty( $post ) ) {
			if( metadata_exists( 'post',  $post->ID, '_raindrops_this_header_image' ) ) {

				$singular_header_image = get_post_meta( $post->ID , '_raindrops_this_header_image', true );

				if( 'hide' == $singular_header_image ) {
					$header_text_fallback_color = raindrops_fallback_header_text_color();
					$css .= "\n h1 a.site-title-link,.tagline{color:" .$header_text_fallback_color . ';}';
				}
			}
		}
		// @1.353
		if ( 'hide' == raindrops_warehouse_clone( "raindrops_display_site_title" ) ) {
			$css .= "\n#site-title a:not(.custom-logo-link){display:none;}";
		}
		//page type

		if ( isset( $raindrops_fluid_or_fixed ) && !empty( $raindrops_fluid_or_fixed ) && ( 'doc' == raindrops_warehouse_clone( "raindrops_page_width" ) || 'doc2' == raindrops_warehouse_clone( "raindrops_page_width" ) || 'custom-doc' == raindrops_warehouse_clone( "raindrops_page_width" ) || 'doc4' == raindrops_warehouse_clone( "raindrops_page_width" ) ) ) {

			$css .= raindrops_is_fixed();
		} elseif ( isset( $raindrops_fluid_minimum_width ) && !empty( $raindrops_fluid_minimum_width ) || 'doc5' == raindrops_warehouse_clone( "raindrops_page_width" ) ) {

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

		$footer_image_uri = $uploads[ 'url' ] . '/' . sanitize_file_name( raindrops_warehouse( 'raindrops_footer_image' ) );

		if ( 'raindrops' !== $raindrops_current_theme_name && 'footer.png' == raindrops_warehouse( 'raindrops_footer_image' ) ) {

			$footer_image_uri = str_replace( $raindrops_current_theme_name, 'raindrops', $footer_image_uri );
		}
		if ( 'none' !== raindrops_warehouse( 'raindrops_footer_image' ) ) {

			$css .= "\n#ft{" . raindrops_upload_image_parser( $footer_image_uri, 'inline', '#ft' ) . '}';
		}
		/* @1.492 add */

			$css .= "\n/*font-size-class*/\n". raindrops_font_size_class()."\n";

		/* 1.306 add conditional */
		if ( false == raindrops_has_indivisual_notation() ) {
			if ( false == $raindrops_automatic_color ) {

				$css .= "\n#ft{color:" . raindrops_warehouse_clone( 'raindrops_footer_color' ) . ';}';

			}
		}

		// 2col 3col change style helper
		$css .= '/*' . raindrops_warehouse_clone( 'raindrops_show_right_sidebar' ) . '*/';

		if ( "show" == raindrops_warehouse_clone( 'raindrops_show_right_sidebar' ) ) {

			$css .= ' .rsidebar{display:block;} ';
		} else {

			if( 3 !== ( int ) $raindrops_current_column ){
				/**
				 * @since 1.471
				 */
				$css .= ' .rsidebar{display:none;} ';
			}
			$css .= '.yui-t6 .index.archives,.yui-t5 .index.archives,.yui-t4 .index.archives{
			 margin-right:1em;	}';
		}

		if ( "hide" == raindrops_warehouse_clone( 'raindrops_display_article_author' ) ) {
			$css .= ' .posted-by-string{display:none;} .raindrops-comment-link{margin:0;} ';
			$css .= ' .posted-on-after .author{display:none;} ';
		}

		if ( "avatar" == raindrops_warehouse_clone( 'raindrops_display_article_author' ) ) {
			$css .= 'body:not(.ja) .posted-by-string{visibility:hidden;margin:-.5em;} ';
		}

		if ( "hide" == raindrops_warehouse_clone( 'raindrops_posted_in_label' ) ) {
			$css .= ' .tagged, .entry-meta .tagged, .this-posted-in{display:none;} ';
			$css .= ' .posted-on + .this-posted-in{display:none;} ';
			$css .= ' .entry-title + .this-posted-in{display:none;} ';
		}
		if ( "emoji" == raindrops_warehouse_clone( 'raindrops_posted_in_label' ) ) {
			$css .= ' .tagged,.this-posted-in{font-size:1.6em;} ';
		}
		if ( "show" !== raindrops_warehouse_clone( 'raindrops_comments_are_closed' ) ) {
			$css .= ' .nocomments{display:none;} ';
		}
		$raindrops_archive_title_label = raindrops_warehouse_clone( 'raindrops_archive_title_label' );
		if ( "hide" == $raindrops_archive_title_label && !is_post_type_archive() && !is_tax() ) {
			$css .= ' #archives-title .label{display:none;} ';
		} elseif ( "emoji" == $raindrops_archive_title_label && !is_post_type_archive() && !is_tax() ) {
			$css .= ' #archives-title .label{display:none;} ';
			$css .= ' #archives-title .title:before{ content: \'' . raindrops_emoji_collection() . '\';display:inline-block;margin-right:13px; }';
		}
		if ( "show" !== raindrops_warehouse_clone( 'raindrops_archive_nav_above' ) ) {
			$css .= ' #nav-above{display:none;} ';
		}
		/* ver 1.304 add */
		$raindrops_fonts_color = raindrops_warehouse_clone( 'raindrops_default_fonts_color' );

		if ( !empty( $raindrops_fonts_color ) && false == raindrops_has_indivisual_notation() ) {
			/* 1.306 add false == raindrops_has_indivisual_notation() */
			if ( false == $raindrops_automatic_color ) {

				$css .= ' article {color:' . $raindrops_fonts_color . ';}';
			}
		}
		/**
		 * ver 1.410 add
		 */
		$use_settings = raindrops_warehouse_clone( 'raindrops_extra_sidebar_responsive' );

		if ( 1 < raindrops_get_column_count() && 'yes' == $use_settings ) {

			$sidebar_breakpoint = absint( raindrops_warehouse_clone( 'raindrops_extra_sidebar_responsive_breakpoint' ) );



			$css .= '@media screen and  ( min-width: 641px) and (max-width: ' . $sidebar_breakpoint . 'px) {
#doc5 .rsidebar-shrink,
#doc3 .rsidebar-shrink{
	display:inline-block;
}
#doc5 .rsidebar-shrink button,
#doc3 .rsidebar-shrink button{
	display:block;
	width:1.4em;
	height:1.4em;
	padding:0;
	margin:0;
}
#doc5 .rsidebar-shrink button:focus,
#doc3 .rsidebar-shrink button:focus{
	outline:none;
}
.rd-primary-menu-responsive-active #doc5 .rsidebar-shrink button,
.rd-primary-menu-responsive-active #doc3 .rsidebar-shrink button{
	margin:2em 0 0 2em;
}
#doc5 #container:not(.rd-expand-sidebar) > div.first,
#doc3 #container:not(.rd-expand-sidebar) > div.first{
	width:100%;
	padding-right:1em;
	box-sizing:border-box;
}
.rd-col-3 #doc5 #container:not(.rd-expand-sidebar) > div.first,
.rd-col-3 #doc3 #container:not(.rd-expand-sidebar) > div.first,
.rd-col-2 #doc5 #container:not(.rd-expand-sidebar) > div.first,
.rd-col-2 #doc3 #container:not(.rd-expand-sidebar) > div.first{
	/* @1.505 */
	padding-left:1em;
	box-sizing:border-box;
}
#doc5 #container:not(.rd-expand-sidebar) .first+.yui-u,
#doc3 #container:not(.rd-expand-sidebar) .first+.yui-u{
	display:none;
}
/* @1.498 */
#doc5 #container:not(.rd-expand-sidebar) .entry-content .first+.yui-u,
#doc3 #container:not(.rd-expand-sidebar) .entry-content .first+.yui-u{
	display:block;
}
#doc5 .button-wrapper,
#doc3 .button-wrapper{
	position:relative;
	display:inline-block;
}
}';
		}

		$use_settings = raindrops_warehouse_clone( 'raindrops_default_sidebar_responsive' );
		/* @1.150 2 to 1 */
		if ( 1 < raindrops_get_column_count() && 'yes' == $use_settings ) {

			$sidebar_breakpoint = absint( raindrops_warehouse_clone( 'raindrops_default_sidebar_responsive_breakpoint' ) );

			$css .= '@media screen and  ( min-width: 641px) and ( max-width: ' . $sidebar_breakpoint . 'px ) {

#doc5 .lsidebar-shrink,
#doc3 .lsidebar-shrink{
	display:inline-block;
}

#doc5 .lsidebar-shrink button,
#doc3 .lsidebar-shrink button{
	display:block;
	width:1.4em;
	height:1.4em;
	z-index:1;
	padding:0;
	margin:0;
}

#doc5 .lsidebar-shrink button:focus,
#doc3 .lsidebar-shrink button:focus{
	outline:none;
}
.rd-primary-menu-responsive-active #doc5 .lsidebar-shrink button,
.rd-primary-menu-responsive-active #doc3 .rsidebar-shrink button{
	margin:2em 0 0 2em;
}
#doc5 #bd:not(.rd-expand-sidebar-default) > .yui-b,
#doc3 #bd:not(.rd-expand-sidebar-default) > .yui-b{
	display:none;
}
#doc5 #bd:not(.rd-expand-sidebar-default) > .yui-main > .yui-b,
#doc3 #bd:not(.rd-expand-sidebar-default) > .yui-main > .yui-b{
	width:100%;
	box-sizing:border-box;
	margin-left:0;
}
#doc5.yui-t6 #bd:not(.rd-expand-sidebar-default) > .yui-main > .yui-b,
#doc5.yui-t5 #bd:not(.rd-expand-sidebar-default) > .yui-main > .yui-b,
#doc5.yui-t4 #bd:not(.rd-expand-sidebar-default) > .yui-main > .yui-b,
#doc3.yui-t6 #bd:not(.rd-expand-sidebar-default) > .yui-main > .yui-b,
#doc3.yui-t5 #bd:not(.rd-expand-sidebar-default) > .yui-main > .yui-b,
#doc3.yui-t4 #bd:not(.rd-expand-sidebar-default) > .yui-main > .yui-b{
	padding-right:1em;
}
.page #doc5 #bd:not(.rd-expand-sidebar-default) > .yui-main > .yui-b,
.page #doc3 #bd:not(.rd-expand-sidebar-default) > .yui-main > .yui-b,
.search #doc5 #bd:not(.rd-expand-sidebar-default) > .yui-main > .yui-b,
.search #doc3 #bd:not(.rd-expand-sidebar-default) > .yui-main > .yui-b,
.home #doc5 #bd:not(.rd-expand-sidebar-default) > .yui-main > .yui-b,
.home #doc3 #bd:not(.rd-expand-sidebar-default) > .yui-main > .yui-b{
	padding-left:1em;
}

.single #doc5 #bd:not(.rd-expand-sidebar-default) > .yui-main > .yui-b,
.single #doc3 #bd:not(.rd-expand-sidebar-default) > .yui-main > .yui-b{
	margin-left:0;
	padding-left:1em;
}
.single.rd-primary-menu-responsive-active  #doc5 #bd.rd-expand-sidebar .yui-main > .yui-b,
.single.rd-primary-menu-responsive-active  #doc3 #bd.rd-expand-sidebar .yui-main > .yui-b{
	margin-right:1em;
	background:red!important;
}
#doc5 .button-wrapper-default,
#doc3 .button-wrapper-default{
	position:relative;
	display:inline-block;
}

#doc5 #bd:not(.rd-expand-sidebar) > div.first,
#doc3 #bd:not(.rd-expand-sidebar) > div.first{
	padding-right:0;
}
}';
		}


		/**
		 * Add @version 1.304
		 */
		$raindrops_sticky_conditional = raindrops_warehouse_clone( 'raindrops_display_sticky_post' );

		if ( 'only_home' == $raindrops_sticky_conditional ) {

			$css .= ' .single .raindrops-sticky .entry-title, .single .raindrops-sticky .entry-content{ display:none; }';
		}

		/**
		 * Add @since 1.309
		 *
		 */
		//
		$raindrops_display_default_category = raindrops_warehouse_clone( 'raindrops_display_default_category' );

		if ( 'show' !== $raindrops_display_default_category ) {
			/* @1.516*/
			$default_category_id = absint( get_option('default_category') );

			$css .= ' .post-category cat-item-'.$default_category_id.'{display:none;}';
		}

		/* 0611 1.301
		 * $raindrops_options			 = get_option( 'raindrops_theme_settings' );
		 */
		$raindrops_base_color		 = raindrops_warehouse_clone( 'raindrops_base_color' );
		$raindrops_hyperlink_color	 = raindrops_warehouse_clone( 'raindrops_hyperlink_color' );
		$raindrops_style_type		 = raindrops_warehouse_clone( 'raindrops_style_type' );

		$color_check = raindrops_has_indivisual_notation();


		if ( false == $color_check ) {
			$raindrops_style_type = raindrops_warehouse_clone( 'raindrops_style_type' );
		} else {

			if ( isset( $color_check[ 'color_type' ] ) ) {
				$raindrops_style_type = $color_check[ 'color_type' ];
			}
			//$columns = $color_check['col'];
		}

		$raindrops_indv_css = raindrops_design_output( $raindrops_style_type ) . raindrops_color_base( $raindrops_base_color );

		//when this code exists [raindrops color_type="minimal" col="1"] in the post
		$raindrops_indv_css = raindrops_color_type_custom( $raindrops_indv_css );

		$css .= apply_filters( "raindrops_indv_css", $raindrops_indv_css );

		if ( $raindrops_hyperlink_color !== '' ) {

			if ( false !== ($type = raindrops_has_indivisual_notation() ) ) {

				if ( isset( $type[ 'color_type' ] ) ) {

					$default_color = raindrops_default_color_clone( 'raindrops_hyperlink_color', $type[ 'color_type' ] );

					$css .= raindrops_custom_link_color( $default_color );
				}
			} else {

				/* 1.306 add conditional */
				if ( false == raindrops_has_indivisual_notation() ) {
					if ( false == $raindrops_automatic_color ) {
						$css .= raindrops_custom_link_color( $raindrops_hyperlink_color );
					}
				}
			}
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

			if ( $primary_menu_min_width < 10 ) {
				$child_width = 10;
			} else {
				$child_width = floatval( $primary_menu_min_width );
			}

			$adding_style = "\n" . '#access ul ul li,#access ul ul,#access a{ min-width:%1$dem;}
					.ie8 #access .page_item_has_children > a:after,
					.ie8 #access .menu-item-has-children > a:after{ content :"";}
					#access .children li,#access .sub-menu li,#access .children ul,#access .sub-menu ul,#access .children a,#access .sub-menu a{
					 min-width:%2$dem;
					}';

			$css .= sprintf( $adding_style, $primary_menu_min_width, $child_width );
		}
		/**
		 * @since 1.505
		 */
			$css .= raindrops_width_class_and_relate_settings();
		/**
		 * @since 1.443
		 */
		$primary_menu_color = raindrops_warehouse_clone( 'raindrops_primary_menu_color' );

		if ( '' !== raindrops_primary_menu_color_validate( $primary_menu_color ) ) {

			$css .= '.raindrops-mobile-menu, #top #access .children, #top #access .sub-menu, #top #access a{ color:' . $primary_menu_color . ';}';
		}

		$primary_menu_background = raindrops_warehouse_clone( 'raindrops_primary_menu_background' );
		if ( '' !== raindrops_primary_menu_color_validate( $primary_menu_background ) ) {

			$css .= '.raindrops-mobile-menu, #top #access .children, #top #access .sub-menu, #top #access, #top #access a{ background:' . $primary_menu_background . ';}';
		}

		$raindrops_sitewide_css = raindrops_warehouse_clone( 'raindrops_sitewide_css' );

		if ( isset( $raindrops_sitewide_css ) && !empty( $raindrops_sitewide_css ) ) {

			$css .= ' ' . wp_strip_all_tags( $raindrops_sitewide_css );
		}



		if ( empty( $css ) ) {

			$css = "cannot get style value check me";
		}


		$css = raindrops_remove_spaces_from_css( $css );

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
if ( ! function_exists( "raindrops_custom_link_color" ) ) {

	function raindrops_custom_link_color( $color ) {

		$color = apply_filters( 'raindrops_custom_link_color_val', $color );

		$css = <<< LINK_COLOR_CSS
.entry-content a:link,
.entry-content a:active,
.entry-content a:visited,
.entry-content a:hover{
color:{$color};
}
.raindrops-toc-front a,
.page-template-front-page a,
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
.entry-meta-default a{
color:{$color};
}/*single.php*/
.entry-meta-default a{
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
.nav-previous a,
.nav-next a,
.nav-previous a,
.nav-next a{
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
if ( ! function_exists( "raindrops_embed_meta" ) ) {

	function raindrops_embed_meta( $content ) {

		global $post, $wp_customize, $content_width, $raindrops_use_transient, $raindrops_stylesheet_type, $raindrops_fallback_human_interface_show;
		/* @1.333 */
		if ( true == $raindrops_fallback_human_interface_show ) {
			return;
		}

		if ( !isset( $raindrops_stylesheet_type ) ) {

			$raindrops_stylesheet_type = raindrops_warehouse_clone( 'raindrops_stylesheet_in_html' );
		}

		$zen = get_option( 'comet_cache_options' );

		do_action( 'raindrops_embed_meta_transient_before' );

		if ( true == $raindrops_use_transient && !is_user_logged_in() &&
		false !== ( $raindrops_embed_meta_transient = get_transient( 'raindrops_embed_meta_transient' ) ) &&
		( isset( $zen ) && false == $zen[ 'enable' ] || !class_exists( 'WebSharks\\CometCache\\Classes\\Plugin' ) ) && false == is_random_header_image()
		) {
			/* @1.516 added wp_strip_all_tags */
			echo wp_strip_all_tags( $raindrops_embed_meta_transient );
			return $content;
		}


		$raindrops_use_featured_image_emphasis = raindrops_warehouse_clone( 'raindrops_use_featured_image_emphasis' );

		if ( $raindrops_use_featured_image_emphasis == 'yes' ) {
			$raindrops_post_image_position = raindrops_warehouse_clone( 'raindrops_featured_image_position' );

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

		$result = "";

		$css = apply_filters( 'raindrops_embed_meta_pre', '' );
		$css .='#doc5 .raindrops-keep-content-width{width:' . $content_width . 'px;max-width:100%;margin:auto;float:none;}' . "\n";
		$css .='#doc5 .raindrops-keep-content-width .raindrops-expand-width{margin-left:0;margin-right:0;}' . "\n";
		$css .='#doc3 .raindrops-keep-content-width{width:' . $content_width . 'px;max-width:100%;margin:auto;float:none;}' . "\n";
		$css .='#doc3 .raindrops-keep-content-width .raindrops-expand-width{margin-left:0;margin-right:0;}' . "\n";

		$css .='#doc5 .raindrops-no-keep-content-width{max-width:100%;margin-left:auto;margin-right:auto;float:none;}' . "\n";
		$css .='#doc5 .raindrops-no-keep-content-width .raindrops-expand-width{margin-left:0;margin-right:0;}' . "\n";
		$css .='#doc3 .raindrops-no-keep-content-width{max-width:100%;margin:auto;float:none;}' . "\n";
		$css .='#doc3 .raindrops-no-keep-content-width .raindrops-expand-width{margin-left:0;margin-right:0;}' . "\n";
		if ( isset( $wp_customize ) || $raindrops_stylesheet_type !== 'external' ) {
			$css .= raindrops_embed_css();
		}

		$result_indv = '';
		$pinup_style = '';
		if ( RAINDROPS_USE_AUTO_COLOR !== true ) {

			//  $css = '';
		}

		if ( is_single() || is_page() ) {

			$pinup_widget_ids		 = raindrops_get_pinup_widget_ids();
			$pinup_widget_post_ids	 = raindrops_pinup_widget_ids_to_post_ids( $pinup_widget_ids );

			foreach ( $pinup_widget_post_ids as $pinup_id ) {

				$web_fonts = get_post_meta( $pinup_id, '_web_fonts_link_element', true );

				if ( isset( $web_fonts ) && !empty( $web_fonts ) ) {

					$web_fonts_each_array = explode( "\n", $web_fonts );

					foreach ( $web_fonts_each_array as $web_fonts_each ) {
						$result = str_replace( array( $web_fonts_each, "\n\n" ), array( '', "\n" ), $result );
						$result .= $web_fonts_each . "\n";
					}
				}

				$web_fonts_style = get_post_meta( $pinup_id, '_web_fonts_styles', true );

				if ( isset( $web_fonts_style ) && !empty( $web_fonts_style ) ) {

					$web_fonts_style_each_array = explode( "\n", $web_fonts_style );

					foreach ( $web_fonts_style_each_array as $web_fonts_style_each ) {
						$pinup_style = str_replace( array( $web_fonts_style_each, "\n\n" ), array( '', "\n" ), $pinup_style );
						$pinup_style .= $web_fonts_style_each . "\n";
					}
				}
			}

			$web_fonts = get_post_meta( get_the_ID(), '_web_fonts_link_element', true );

			if ( isset( $web_fonts ) && !empty( $web_fonts ) ) {

				$result .= $web_fonts;
			}

			$web_fonts_styles = get_post_meta( $post->ID, '_web_fonts_styles', true );

			if ( ( isset( $web_fonts_styles ) && !empty( $web_fonts_styles ) ) || !empty( $pinup_style ) ) {

				$web_fonts_styles_wrapper = "<style". raindrops_doctype_elements( ' type="text/css" ', ' ', false ). "media=\"screen\" id=\"raindrops-web-font-style\">\n" . '%1$s</style>' . "\n";

				$result .= sprintf( $web_fonts_styles_wrapper, $web_fonts_styles . $pinup_style );
			}

			$css_single = get_post_meta( $post->ID, 'css', true );
			/* 1.234 metabox support */

			$css_single .= get_post_meta( $post->ID, '_css', true );


			if ( true == RAINDROPS_OVERRIDE_POST_STYLE_ALL_CONTENTS ) {

				$css .= preg_replace_callback( '![^}]+{[^}]+}!siu', 'raindrops_css_add_id', $css_single );
				/**
			* front-page.php template sub query CSS
			* @since 1.484
			*/
		   $css .= raindrops_add_front_page_template_css();
			} else {

				$css_single = $css_single;
			}

			if ( !empty( $css ) && RAINDROPS_CUSTOM_FIELD_CSS == true ) {

				$result .= '<style'. raindrops_doctype_elements( ' type="text/css" ', ' ', false ).'id="raindrops-embed-css" data-instant-track>';
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

				$result .= '<script'. raindrops_doctype_elements( ' type="text/javascript"', '', false ).'>';
				$result .= "\n<!--/*<! [CDATA[*/\n";
				$result .= raindrops_esc_custom_field_javascript( $javascript );
				$result .= "\n/*]]>*/-->\n";
				$result .= "</script>";
			}
		} else {

			$pinup_widget_ids		 = raindrops_get_pinup_widget_ids();
			$pinup_widget_post_ids	 = raindrops_pinup_widget_ids_to_post_ids( $pinup_widget_ids );

			if ( isset( $pinup_widget_post_ids ) && is_array( $pinup_widget_post_ids ) ) {

				foreach ( $pinup_widget_post_ids as $pinup_id ) {

					$web_fonts = get_post_meta( $pinup_id, '_web_fonts_link_element', true );

					if ( isset( $web_fonts ) && !empty( $web_fonts ) ) {

						$web_fonts_each_array = explode( "\n", $web_fonts );

						foreach ( $web_fonts_each_array as $web_fonts_each ) {
							$result = str_replace( array( $web_fonts_each, "\n\n" ), array( '', "\n" ), $result );
							$result .= $web_fonts_each . "\n";
						}
					}

					$web_fonts_style = get_post_meta( $pinup_id, '_web_fonts_styles', true );

					if ( isset( $web_fonts_style ) && !empty( $web_fonts_style ) ) {

						$web_fonts_style_each_array = explode( "\n", $web_fonts_style );

						foreach ( $web_fonts_style_each_array as $web_fonts_style_each ) {
							$result_indv = str_replace( array( $web_fonts_style_each, "\n\n" ), array( '', "\n" ), $result_indv );
							$result_indv .= $web_fonts_style_each . "\n";
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

							$web_fonts_each_array = explode( "\n", $web_fonts );

							foreach ( $web_fonts_each_array as $web_fonts_each ) {
								$result = str_replace( array( $web_fonts_each, "\n\n" ), array( '', "\n" ), $result );
								$result .= $web_fonts_each . "\n";
							}
						}

						$web_fonts_style = get_post_meta( $post->ID, '_web_fonts_styles', true );


						if ( isset( $web_fonts_style ) && !empty( $web_fonts_style ) ) {

							$web_fonts_style_each_array = explode( "\n", $web_fonts_style );

							foreach ( $web_fonts_style_each_array as $web_fonts_style_each ) {
								$result_indv = str_replace( array( $web_fonts_style_each, "\n\n" ), array( '', "\n" ), $result_indv );
								$result_indv .= $web_fonts_style_each . "\n";
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

			$result .= '<style'. raindrops_doctype_elements( ' type="text/css" ', ' ', false ). 'id="raindrops-loop-style" data-instant-track>';
			$result .= "\n<!--/*<! [CDATA[*/\n";
			$result .= $css;
			$result .= "/*start custom fields style for loop pages*/\n";

			$result_indv = raindrops_remove_spaces_from_css( $result_indv );

			$result .= $result_indv;
			$result .= "\n/*end custom fields style for loop pages*/";
			$result .= "\n/*]]>*/-->\n";
			$result .= "</style>\n";
		}
		if ( true == $raindrops_use_transient ) {

			set_transient( 'raindrops_embed_css_transient', $css );
		}
		if ( false == $raindrops_use_transient || is_user_logged_in() ) {

			set_transient( 'raindrops_embed_meta_transient', $result );
		}
		echo apply_filters( 'raindrops_embed_meta_echo', $result );

		return $content;
	}

}

if ( ! function_exists( 'raindrops_esc_custom_field_meta' ) ) {

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

if ( ! function_exists( 'raindrops_custom_field_meta_helper' ) ) {

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

if ( ! function_exists( 'raindrops_esc_custom_field_javascript' ) ) {

	function raindrops_esc_custom_field_javascript( $script ) {

		if ( RAINDROPS_CUSTOM_FIELD_SCRIPT !== true ) {
			return;
		}
		if ( is_singular() && !empty( $script ) ) {

			$pattern = '/(?:(?:\/\*(?:[^*]|(?:\*+[^*\/]))*\*+\/)|(?:(?<!\:|\\\|\')\/\/.*))/';
			$script	 = preg_replace( $pattern, '', $script );

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
if ( ! function_exists( "raindrops_css_add_id" ) ) {

	function raindrops_css_add_id( $matches ) {

		global $post;

		$result			 = '';
		/* @since 1.447 remove transform from $exclude_lists */
		$exclude_lists	 = '@keyframes|from\s*{|to\s*{|@raindrops'; // separate |
		foreach ( $matches as $k => $match ) {

			if ( preg_match( '!([^{]+){([^{]+{)(.+)!', $match, $regs ) ) {
				$result .= $regs[ 1 ] . '{' . "\n";
				$match = $regs[ 2 ] . $regs[ 3 ];
			}

			if ( preg_match( '!(' . $exclude_lists . ')!', $result . $match ) || preg_match( '!^[0-9]{1,3}%!', trim( $match ) ) ) {

				if ( preg_match( '!@raindrops!', $match ) ) {

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
				
				/**
				 * Improve page and post so that style can be specified for entire page
				 * @since 1.532
				 */
 
				if( is_page()){
					$result .= 'body.page-id-' . $post->ID . ' ' . trim( $match ) . "\n";
				} else {
					$result .= 'body.postid-' . $post->ID . ' ' . trim( $match ) . "\n";
				}
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
if ( ! function_exists( "raindrops_blank_fallback" ) ) {

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
if ( ! function_exists( "raindrops_prev_next_post" ) ) {

	function raindrops_prev_next_post( $position = "nav-above" ) {

		if ( is_category() ) {

			$filter = true; //display same category.
		} else {

			$filter = false;
		}
		//exclude separate 'and'
		$exclude_category = apply_filters( 'raindrops_next_prev_excluded_categories', '' );
		/* @1.516 add sanitize_html_class */
		printf( '<div id="%1$s" class="%2$s">', sanitize_html_class( $position ), "clearfix" );

		$prev_post = get_previous_post( $filter, $exclude_category );
		if ( !empty( $prev_post ) ) {
			printf( '<span class="%1$s">', "nav-previous" );
			previous_post_link( '%link', '<span class="button"><span class="meta-nav">&#171;</span> %title</span>', $filter, $exclude_category );
			printf( '</span>' );
		}

		$next_post = get_next_post( $filter, $exclude_category );
		if ( !empty( $next_post ) ) {
			printf( '<span class="%1$s">', "nav-next" );
			next_post_link( '%link', '<span class="button"> %title <span class="meta-nav">&#187;</span></span>', $filter, $exclude_category );
			printf( '</span>' );
		}
		printf( '</div>' );

		echo apply_filters( "raindrops_prev_next_post", '' );
	}

}
/**
 * date.php
 *
 *
 *
 *
 */
if ( ! function_exists( "raindrops_days_in_month" ) ) {

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
if ( ! function_exists( "raindrops_get_year" ) ) {

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
		// @since1.491 add mktime()
		$year_label	 = apply_filters( 'raindrops_archive_year_label', $year, mktime( 0, 0, 0, 1, 1, $year ) );
		$output		 = raindrops_archive_year_navigation( false );
		$table_year	 = array( '<table id="raindrops_year_list"' . raindrops_doctype_elements( 'summary ="Archives in ' . esc_attr( $year ) . '"', '', false ) . '><tbody>', '<tr><td class="month-name">1</td><td></td></tr>', '<tr><td class="month-name">2</td><td></td></tr>', '<tr><td class="month-name">3</td><td></td></tr>', '<tr><td class="month-name">4</td><td></td></tr>', '<tr><td class="month-name">5</td><td></td></tr>', '<tr><td class="month-name">6</td><td></td></tr>', '<tr><td class="month-name">7</td><td></td></tr>', '<tr><td class="month-name">8</td><td></td></tr>', '<tr><td class="month-name">9</td><td></td></tr>', '<tr><td class="month-name">10</td><td></td></tr>', '<tr><td class="month-name">11</td><td></td></tr>', '<tr><td class="month-name">12</td><td></td></tr>', '</tbody></table>' );

		foreach ( $months as $num => $val ) {

			$num				 = (int) $num;
			/* translators: 1: post count */
			$table_year[ $num ]	 = '<tr><td class="month-name"><a href="' . get_month_link( $year, $num ) . "\" title=\"" . esc_attr( $year . '/' . $num ) . "\">" . $num . '</a></td><td class="month-excerpt"><a href="' . get_month_link( $year, $num ) . "\" title=\"$year/$num\">" . sprintf( esc_html__( "%s Articles archived", 'raindrops' ), count( $val ) ) . '</a></td></tr>';
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
if ( ! function_exists( "raindrops_get_day" ) ) {

	function raindrops_get_day( $posts = '', $year = '', $mon = '', $day = '', $pad = 1 ) {
		global $month;

		$here		 = home_url();
		// @since 1.491 add mkttime()
		$year_label	 = apply_filters( 'raindrops_archive_year_label', $year, mktime( 0, 0, 0, $mon, $day, $year ) );
		$month_label = apply_filters( 'raindrops_archive_month_label', $mon, mktime( 0, 0, 0, $mon, $day, $year ) );
		$day_label	 = apply_filters( 'raindrops_archive_day_label', $day, mktime( 0, 0, 0, $mon, $day, $year ) );

		if ( 'ja' == get_locale() ) {
			$output = "<h2 class=\"h2 year-month-date\"><a href=\"" . esc_url( get_year_link( $year ) ) . "\" title=\"$year\"><span class=\"year-name\">$year_label</span></a> <a href=\"" . get_month_link( $year, $mon ) . "\" title=\"$year/$mon\"><span class=\"month-name\">" . $month_label . "</span></a>&nbsp;<span class=\"day-name\">" . $day_label . "</span></h2>";
		} else {
			$output = "<h2 class=\"h2 year-month-date\"><span class=\"day-name\">" . $day_label . "</span> <a href=\"" . get_month_link( $year, $mon ) . "\" title=\"$year/$mon\"><span class=\"month-name\">" . $month_label . "</span></a>&nbsp<a href=\"" . esc_url( get_year_link( $year ) ) . "\" title=\"$year\"><span class=\"year-name\">$year_label</span></a></h2>";
		}



		$output .= '<table id="date_list" ' . raindrops_doctype_elements( 'summary="Archive in ' . esc_attr( $day ) . ', ' . esc_attr( $mon ) . ', ' . esc_attr( $year ) . '"', '', false ) . '>';

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

					if( empty( $mytime->post_title )){

							$mytime->post_title = '<span class="icon-link-no-title entry-title-text">no title</span>';
					}

					$post_title	 = preg_replace( '|>.+</|', '>[link to ' . $mytime->ID . ']</', $mytime->post_title );

					$title_html = '<a href="%1$s" id="post-%2$s"><span>%3$s</span></a>';

					$output .= sprintf( $title_html,
									esc_url( get_permalink( $mytime->ID ) ),
									absint( $mytime->ID ),
									$post_title
								);
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
 * sort month_list
 *
 *
 *
 *
 */
if ( ! function_exists( "raindrops_cmp_ids" ) ) {

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
if ( ! function_exists( "raindrops_month_list" ) ) {

	function raindrops_month_list( $one_month, $ye, $mo, $post_type = 'post' ) {

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

				$m = 0;
				list( $y, $m, $d, $h, $min, $s ) = sscanf( $month->post_date, "%d-%d-%d %d:%d:%d" );

				if ( $key < $calendar_page_last && $key >= $calendar_page_start ) {

					if ( $d == $i && $m == $mo && $y == $ye ) {

						$first_data			 = true;

						if( empty( $month->post_title )){

							$month->post_title = '<span class="icon-link-no-title entry-title-text">no title</span>';
						}
						$month->post_title	 = preg_replace( '|>.+</|', '>[link to ' . $month->ID . ']</', $month->post_title );



						$html = '<li id="post-%5$s" %6$s>
			<span class="%1$s"><a href="%2$s" rel="bookmark" title="%3$s"><span>%4$s</span></a></span>
			<%7$s class="entry-date updated" %8$s>%9$s</%7$s>
			<span class="author vcard"><a class="url fn nickname" href="%10$s" title="%11$s">%12$s</a></span> 					</li>';

						$display_name = get_the_author_meta( 'display_name', $month->post_author );
						$links .= sprintf( $html,
									'h2 entry-title',
									esc_url( get_permalink( $month->ID ) ),
									'link to content: ' . esc_attr( strip_tags( $month->post_title ) ),
									$month->post_title,
									$month->ID,
									' ' . raindrops_post_class( array( 'clearfix' ),
									$month->ID, false ),
									raindrops_doctype_elements( 'span', 'time', false ),
									raindrops_doctype_elements( '', 'datetime="' . esc_attr( get_the_date( 'c' ) ) . '"', false ),
									$month->post_date, get_author_posts_url( get_the_author_meta( 'ID' ) ),
									/* translators: 1: post author display name */
									sprintf( esc_attr__( 'View all posts by %s', 'raindrops' ), $display_name ),
									$display_name
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

				if ( 'post' !== $post_type ) {
					$day_permalink = add_query_arg( 'post_type', $post_type, get_day_link( $y, $mo, $i ) );
				} else {
					$day_permalink = get_day_link( $y, $mo, $i );
				}

				$result .= "<tr><td class=\"month-date\"><span class=\"day-name\">";
				$result .= "<a href=\"" . esc_url( $day_permalink ) . "\">";
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

		$month_name	 = $wp_locale->get_month( $m );

		$year_name	 = apply_filters( 'raindrops_month_list_year_name', $y , mktime( 0, 0, 0, intval($month_name), 1, $y ) );
		// @since 1.491 add mktime()
		if ( 'post' !== $post_type ) {
			$year_permalink = add_query_arg( 'post_type', $post_type, get_year_link( $y ) );
		} else {
			$year_permalink = get_year_link( $y );
		}

		if ( get_locale() == 'ja' ) {
			$output = "<h2 id=\"date_title\" class=\"h2 year-month\"><a href=\"" . esc_url( $year_permalink ) . "\" title=\"" . esc_attr( $y ) . "\"><span class=\"year-name\">" . esc_html( $year_name ) . "</span></a> <span class=\"month-name\">" . esc_html( $month_name ) . " </span></h2>";
		} else {
			$output = "<h2 id=\"date_title\" class=\"h2 year-month\"><span class=\"month-name\">" . esc_html( $month_name ) . " </span> <a href=\"" . esc_url( $year_permalink ) . "\" title=\"" . esc_attr( $y ) . "\"><span class=\"year-name\">" . esc_html( $year_name ) . "</span></a></h2>";
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
if ( ! function_exists( "raindrops_loop_title" ) ) {

	function raindrops_loop_title() {

		global $template;

		$Raindrops_class_name	 = "";
		$page_title				 = "";
		$page_title_c			 = "";

		if ( is_search() ) {

			$Raindrops_class_name	 = 'serch-result';
			$page_title				 = esc_html__( "Search Results", 'raindrops' );
			$page_title_c			 = get_search_query();
		} elseif ( is_tag() ) {

			$tag_id					 = absint( get_queried_object_id() );
			$Raindrops_class_name	 = 'tag-archives list-tag-' . $tag_id;
			$page_title				 = esc_html__( "Tag Archives", 'raindrops' );
			$page_title_c			 = single_term_title( "", false );
		} elseif ( is_category() ) {
			$page_title_c			 = single_cat_title( '', false );
			$category_id			 = get_cat_ID( $page_title_c );
			$Raindrops_class_name	 = 'category-archives list-cat-item-' . $category_id;
			$page_title				 = esc_html__( "Category Archives", 'raindrops' );
		} elseif ( is_archive() ) {

			$raindrops_date_format = get_option( 'date_format' );

			if ( is_day() ) {

				$Raindrops_class_name	 = 'dayly-archives';
				$page_title				 = esc_html__( 'Daily Archives', 'raindrops' );
				$page_title_c			 = get_the_date( $raindrops_date_format );
			} elseif ( is_month() ) {

				$Raindrops_class_name	 = 'monthly-archives';
				$page_title				 = esc_html__( 'Monthly Archives', 'raindrops' );

				if ( 'ja' == get_locale() ) {

					$page_title_c = get_the_date( 'Y / F' );
				} else {

					$page_title_c = get_the_date( 'F Y' );
				}
			} elseif ( is_year() ) {

				$Raindrops_class_name	 = 'yearly-archives';
				$page_title				 = esc_html__( 'Yearly Archives', 'raindrops' );
				$page_title_c			 = get_the_date( 'Y' );
			} elseif ( is_author() ) {

				$Raindrops_class_name	 = 'author-archives';
				$page_title				 = esc_html__( "Author Archives", 'raindrops' );
				while ( have_posts() ) {
					the_post();
					$page_title_c = get_avatar( get_the_author_meta( 'user_email' ), 32 ) . ' ' . get_the_author();
					break;
				}
				rewind_posts();
			} elseif ( has_post_format( 'aside' ) ) {

				$slug					 = 'aside';
				$Raindrops_class_name	 = 'post-format-' . $slug;
				$page_title				 = esc_html__( 'Post Format', 'raindrops' );
				$page_title_c			 = get_post_format_string( $slug );
			} elseif ( has_post_format( 'chat' ) ) {

				$slug					 = 'chat';
				$Raindrops_class_name	 = 'post-format-' . $slug;
				$page_title				 = esc_html__( 'Post Format', 'raindrops' );
				$page_title_c			 = get_post_format_string( $slug );
			} elseif ( has_post_format( 'gallery' ) ) {

				$slug					 = 'gallery';
				$Raindrops_class_name	 = 'post-format-' . $slug;
				$page_title				 = esc_html__( 'Post Format', 'raindrops' );
				$page_title_c			 = get_post_format_string( $slug );
			} elseif ( has_post_format( 'link' ) ) {

				$slug					 = 'link';
				$Raindrops_class_name	 = 'post-format-' . $slug;
				$page_title				 = esc_html__( 'Post Format', 'raindrops' );
				$page_title_c			 = get_post_format_string( $slug );
			} elseif ( has_post_format( 'image' ) ) {

				$slug					 = 'image';
				$Raindrops_class_name	 = 'post-format-' . $slug;
				$page_title				 = esc_html__( 'Post Format', 'raindrops' );
				$page_title_c			 = get_post_format_string( $slug );
			} elseif ( has_post_format( 'quote' ) ) {

				$slug					 = 'quote';
				$Raindrops_class_name	 = 'post-format-' . $slug;
				$page_title				 = esc_html__( 'Post Format', 'raindrops' );
				$page_title_c			 = get_post_format_string( $slug );
			} elseif ( has_post_format( 'status' ) ) {

				$slug					 = 'status';
				$Raindrops_class_name	 = 'post-format-' . $slug;
				$page_title				 = esc_html__( 'Post Format', 'raindrops' );
				$page_title_c			 = get_post_format_string( $slug );
			} elseif ( has_post_format( 'video' ) ) {

				$slug					 = 'video';
				$Raindrops_class_name	 = 'post-format-' . $slug;
				$page_title				 = esc_html__( 'Post Format', 'raindrops' );
				$page_title_c			 = get_post_format_string( $slug );
			} elseif ( has_post_format( 'audio' ) ) {

				$slug					 = 'audio';
				$Raindrops_class_name	 = 'post-format-' . $slug;
				$page_title				 = esc_html__( 'Post Format', 'raindrops' );
				$page_title_c			 = get_post_format_string( $slug );
			} else {

				$Raindrops_class_name	 = 'blog-archives';
				$page_title				 = esc_html__( "Blog Archives", 'raindrops' );
				$page_title_c			 = 'blog';
			}

			/**
			 * Custom Post Type Archives Title
			 * @1.438
			 */
			$post_type = get_post_type( get_the_ID() );

			if ( "post" !== $post_type || "page" !== $post_type || "attachment" !== $post_type || "revision" !== $post_type || "nav_menu_item" !== $post_type ) {

				$obj = get_post_type_object( $post_type );

				if ( !empty( $obj ) && is_post_type_archive( $obj->name ) && true == $obj->has_archive ) {

					$Raindrops_class_name	 = sanitize_html_class( $obj->name . '-archives' ) . ' custom-post-archives';
					$page_title				 = post_type_archive_title( '', false );
					$page_title_c			 = '';
				}
			}
			/**
			 * Custom Taxonomy Archives Title
			 * @1.438
			 */
			if ( is_tax() && !isset( $page_title ) ) {

				$obj					 = get_post_type_object( $post_type );
				$taxes					 = get_object_taxonomies( $obj->name );
				$current_taxsonomy		 = apply_filters( 'raindrops_custom_post_tax', $taxes[ 0 ] );
				$Raindrops_class_name	 = sanitize_html_class( 'custom-taxsonomy-archives-' . $current_taxsonomy ) . ' custom-taxsonomy-archives';
				$taxonomy_meta_data		 = get_taxonomy( $current_taxsonomy );
				$page_title				 = esc_html( $taxonomy_meta_data->labels->name );
				$page_title_c			 = '';

				$current_tax = get_queried_object();

				if ( !empty( $current_tax->name ) ) {

					$separator = apply_filters( 'raindrops_custom_post_tax_separator', ' : ' );
					$page_title .= $separator . esc_html( $current_tax->name );
				}
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

			echo "\n" . str_repeat( "\t", 7 ) . '<ul class="index archives ' . esc_attr( $Raindrops_class_name ) . '">';
		} else {

			echo "\n" . str_repeat( "\t", 7 ) . '<ul class="index archives">';
		}

		if ( !empty( $page_title ) ) {

			do_action( 'raindrops_loop_title_before' );

			printf( '<li class="title-wrapper %3$s-wrapper"><strong id="archives-title" class="page-title"><span class="label">%1$s</span> <span class="title ">%2$s</span></strong></li>', apply_filters( 'raindrops_archive_name', $page_title ), apply_filters( 'raindrops_archive_value', $page_title_c ), $Raindrops_class_name );

			do_action( 'raindrops_loop_title_after' );

			$category_navigation_empty_check = strip_tags( raindrops_category_navigation() );

			if ( is_category() && !empty( $category_navigation_empty_check ) ) {

				printf( '<li class="list-category-navigation">%1$s</li>', raindrops_category_navigation() );
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
if ( ! function_exists( "raindrops_yui_class_modify" ) ) {

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

		return $yui_inner_layout;


	}
}

function raindrops_extra_sidebar_classes() {

	$yui_inner_layout = raindrops_yui_class_modify( );

	$yui_inner_layout = apply_filters( 'raindrops_yui_class_modify', $yui_inner_layout );

	echo sanitize_html_class( $yui_inner_layout );
}
/**
 * Template conditional function Raindrops display 2column or not
 *
 *
 * @param string   css rule or text
 * @param bool      if value is true echo or false return
 * @return string  input strings text
 */
if ( ! function_exists( "raindrops_is_2col" ) ) {


	function raindrops_is_2col( $action = true, $echo = true ) {
		global $template;

		$template_name = basename( $template, '.php' );

		$raindrops_col_setting_type = raindrops_warehouse_clone( 'raindrops_col_setting_type' );

		if ( 'simple' == $raindrops_col_setting_type ) {

			if ( 'hide' == raindrops_warehouse_clone( 'raindrops_show_right_sidebar' ) ) {

				if ( true == $echo ) {

					echo $action;
				} else {

					return $action;
				}
			} else {

				return false;
			}
		}
		if ( 'details' == $raindrops_col_setting_type ) {

			if ( is_home() && 2 == raindrops_warehouse_clone( 'raindrops_sidebar_index' ) ) {
				if ( true == $echo ) {
					echo $action;
				} else {
					return $action;
				}
			}
			if ( is_date() && 2 == raindrops_warehouse_clone( 'raindrops_sidebar_date' ) ) {
				if ( true == $echo ) {
					echo $action;
				} else {
					return $action;
				}
			}
			if ( is_page() && 2 == raindrops_warehouse_clone( 'raindrops_sidebar_page' ) ) {
				if ( true == $echo ) {
					echo $action;
				} else {
					return $action;
				}
			}
			if ( is_search() && 2 == raindrops_warehouse_clone( 'raindrops_sidebar_search' ) ) {
				if ( true == $echo ) {
					echo $action;
				} else {
					return $action;
				}
			}
			if ( is_single() && 2 == raindrops_warehouse_clone( 'raindrops_sidebar_single' ) ) {
				if ( true == $echo ) {
					echo $action;
				} else {
					return $action;
				}
			}
			if ( is_archive() && 'image' == $template_name && 2 == raindrops_warehouse_clone( 'raindrops_sidebar_image_archive' ) ) {
				if ( true == $echo ) {
					echo $action;
				} else {
					return $action;
				}
			}
			if ( is_404() && 2 == raindrops_warehouse_clone( 'raindrops_sidebar_404' ) ) {
				if ( true == $echo ) {
					echo $action;
				} else {
					return $action;
				}
			}
			if ( is_page() && 'list-of-post' == $template_name && 2 == raindrops_warehouse_clone( 'raindrops_sidebar_list_of_post' ) ) {
				if ( true == $echo ) {
					echo $action;
				} else {
					return $action;
				}
			}

			if ( is_category() && 2 == raindrops_warehouse_clone( 'raindrops_sidebar_category' ) ) {
				if ( true == $echo ) {
					echo $action;
				} else {
					return $action;
				}
			}
			if ( is_tag() && 2 == raindrops_warehouse_clone( 'raindrops_sidebar_tag' ) ) {
				if ( true == $echo ) {
					echo $action;
				} else {
					return $action;
				}
			}
			if ( is_author() && 2 == raindrops_warehouse_clone( 'raindrops_sidebar_author' ) ) {
				if ( true == $echo ) {
					echo $action;
				} else {
					return $action;
				}
			}

			return false;
		}
	}

}
/**
 * yui layout calc
 *
 *
 *
 * @return content width
 */
if ( ! function_exists( "raindrops_main_width" ) ) {

	function raindrops_main_width() {

		return absint( raindrops_content_width_clone() );
	}

}
/**
 * content width calc
 *
 *
 *
 *
 * @return main column width
 */
if ( ! function_exists( "raindrops_content_width" ) ) {

	function raindrops_content_width() {

		return absint( apply_filters( 'raindrops_content_width', raindrops_content_width_clone() ) );
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
if ( ! function_exists( "raindrops_plugin_is_active" ) ) {

	function raindrops_plugin_is_active( $plugin_path ) {

		$return_var = in_array( $plugin_path, get_option( 'active_plugins' ) );
		return $return_var;
	}

	if ( raindrops_plugin_is_active( 'tmn-quickpost/tmn-quickpost.php' ) ) {

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
/**
 * for remove title html escaped from plug-ins
 * @param type $title
 * @return type
 * @since 1.276
 */
if ( ! function_exists( 'raindrops_strip_escaped_title' ) ) {

	function raindrops_strip_escaped_title( $title ) {
		/**
		 * @1.423 add filter
		 */
		$title = apply_filters( 'raindrops_strip_escaped_title', $title );

		return preg_replace( '!&lt;.*?&gt;!', '', $title );
	}

}
/**
 *
 *
 *
 * @since 1.139
 */
if ( ! function_exists( 'raindrops_detect_header_image_size' ) ) {

	function raindrops_detect_header_image_size( $xy = 'width' ) {
		global $raindrops_custom_header_args;

		return raindrops_detect_header_image_size_clone( $xy );
	}

}
if ( ! function_exists( 'raindrops_the_header_image' ) ) {

	function raindrops_the_header_image( $type = 'default', $args = array() ) {
		global $raindrops_link_unique_text;
		/**
		 * Custom Header
		 */
		$raindrops_title_in_the_header_check = raindrops_warehouse_clone( 'raindrops_place_of_site_title' );

		if ( true == $raindrops_link_unique_text || $raindrops_title_in_the_header_check == 'header_image' ) {

			$type = 'elements';
		} else {

			$type = 'home_url';
		}
		if ( function_exists( 'has_header_video' ) && has_header_video() && is_header_video_active() ) {
			/**
			 * @since 1.445
			 */
			$type = 'elements';
		}

		echo raindrops_header_image( $type, $args );
	}

}

/**
 * Template function print header image
 *
 * This function has filter hook name raindrops_header_image
 * @param array(  'img'=> 'image uri' , 'height' => 'image height' , 'color' => 'text color', 'style' => '( default  ) background-size:cover;' , 'description' => 'replace text from bloginfo(  description  ) to your text','description_style' => 'Your description style rule'  )
 * @return string htmlblock <div id="['header-image']" style="background-image:url( [img] );height:[height];color:#[color]][style]"><p [description_style]>[WordPress site description]</p></div>
 */
if ( ! function_exists( 'raindrops_header_image' ) ) {

	function raindrops_header_image( $type = 'default', $args = array() ) {

		global $raindrops_page_width, $post, $raindrops_custom_header_height, $is_IE, $is_edge;


		$raindrops_document_width		 = $raindrops_page_width;
		$raindrops_header_image			 = get_custom_header();
		$raindrops_header_image_uri		 = $raindrops_header_image->url;
		$raindrops_header_image_width	 = apply_filters( 'raindrops_header_image_width', raindrops_detect_header_image_size( 'width' ) );
		$raindrops_header_image_height	 = apply_filters( 'raindrops_header_image_height', raindrops_detect_header_image_size( 'height' ) );
		$raindrops_restore_check		 = get_theme_mod( 'header_image', get_theme_support( 'custom-header', 'default-image' ) );
		$raindrops_field_exists_check	 = get_post_custom_values( '_raindrops_this_header_image' );

		if ( $raindrops_field_exists_check !== null ) {
			$display_header_image_file = get_post_meta( $post->ID, '_raindrops_this_header_image', true );

			if ( $display_header_image_file == 'hide' && is_singular() ) {

				return;
			}

			if ( !empty( $display_header_image_file ) && $display_header_image_file !== 'default' && is_singular() ) {

				$display_header_image_attr = wp_get_attachment_image_src( $display_header_image_file, 'full' );
				if ( !empty( $display_header_image_attr ) ) {
					$raindrops_header_image_uri		 = $display_header_image_attr[ 0 ];
					$raindrops_header_image_width	 = $display_header_image_attr[ 1 ];
					$raindrops_header_image_height	 = $display_header_image_attr[ 2 ];
				}
			}
		}


		if ( 'remove-header' == $raindrops_restore_check ) {

			return;
		}

		if ( empty( $raindrops_header_image_uri ) || has_filter( 'theme_mod_header_image' ) ) {

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
				$raindrops_document_width	 = 950; //this value is fake following javascript
				break;
			case 'doc5' == $raindrops_width:
				$raindrops_document_width	 = 950; //this value is fake following javascript
				break;
		}

		if ( $raindrops_header_image_width >= $raindrops_document_width ) {

			$ratio			 = floatval( $ratio );
			$height_current	 = round( $raindrops_document_width * $ratio ) . 'px';
			$block_style	 = 'background-size:cover;';
		} else {

			$height_current			 = round( $raindrops_header_image_height ) . 'px';
			$raindrops_style_type	 = raindrops_warehouse_clone( 'raindrops_style_type' );
			/**
			 * @1.434 conditional
			 */
			if ( "w3standard" == $raindrops_style_type ) {
				$block_style = 'background-repeat:no-repeat;background-position:center;background-color:#000;background-size:auto;';
				if ( !$is_IE && !$is_edge ) {
					$block_style .= ' background-origin:content-box;';
				}
			} else {
				$block_style = 'background-repeat:no-repeat;background-position:top center;background-color:#000;background-size:auto;';
				if ( !$is_IE && !$is_edge ) {
					$block_style .= ' background-origin:content-box;';
				}
			}
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

			$text_attr	 = esc_attr( $add_style ) . ' ' . esc_html( $add_class );
			$text_attr	 = apply_filters( 'raindrops_header_image_description_attr', $text_attr );
		}

		$responsive_page_width_check = Raindrops_warehouse_clone( "raindrops_page_width" );

		if ( 'doc3' == $responsive_page_width_check || 'doc5' == $responsive_page_width_check ) {

			$width	 = 'width:100%';
			$height	 = apply_filters( 'raindrops_header_image_height', $raindrops_custom_header_height ) . 'px';
		} else {

			$width = 'width:' . $raindrops_document_width . 'px';
		}

		if ( $type == 'default' || !isset( $type ) ) {

			$html	 = '<div id="%1$s" style="background-image:url( %2$s );%8$s;height:%3$s;color:#%4$s;%5$s"><p class="tagline" %6$s>%7$s</p></div>';
			$html	 = sprintf( $html, 'header-image', esc_url( $img ), esc_html( $height ), esc_html( $color ), esc_html( $style ), htmlspecialchars( $text_attr, ENT_NOQUOTES ), esc_html( $text ), $width );

			if ( $color == 'blank' ) {

				$html = str_replace( 'color:#blank;', '', $html );
			}
			return apply_filters( "raindrops_header_image", $html );
		} elseif ( 'css' == $type ) {

			$old_ie			 = '';
			$http_user_agent = filter_input( INPUT_ENV, 'HTTP_USER_AGENT' );
			preg_match( "|(MSIE )([0-9]{1,2})(\.)|si", $http_user_agent, $regs );
			if ( isset( $regs[ 2 ] ) ) {
				$old_ie = 'ie' . $regs[ 2 ];
			}

			$raindrops_header_imge_filter_color			 = raindrops_warehouse_clone( 'raindrops_header_image_filter_color' );
			$raindrops_header_image_color_rgb_array		 = raindrops_hex2rgb_array_clone( $raindrops_header_imge_filter_color );
			$raindrops_header_image_filter_apply_top	 = raindrops_warehouse_clone( 'raindrops_header_image_filter_apply_top' );
			$raindrops_header_image_filter_apply_bottom	 = raindrops_warehouse_clone( 'raindrops_header_image_filter_apply_bottom' );
			$raindrops_enable_header_image_filter		 = raindrops_warehouse_clone( 'raindrops_enable_header_image_filter' );


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
			 background:
			-webkit-linear-gradient(
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

			$css		 = '#%1$s{%2$s%8$s;height:%3$s;color:#%4$s;%5$s}' . "\n" . '#%1$s p {color:#%4$s;}' . "\n" . '.site-title-link{color:#%4$s;}';
			$text_attr	 = str_replace( array( 'style', '=', '"', "'" ), '', $text_attr );

			$css = sprintf( $css, 'header-image', apply_filters( 'raindrops_header_image_background_image', $background_property ), esc_html( $height ), esc_html( $color ), apply_filters( 'raindrops_header_image_background_style', esc_html( $style ) ), htmlspecialchars( $text_attr, ENT_NOQUOTES ), esc_html( $text ), $width );

			if ( $color == 'blank' ) {

				$css = str_replace( 'color:#blank;', '', $css );
			}
			return apply_filters( "raindrops_header_image_css", $css );
		} elseif ( 'elements' == $type ) {

			$raindrops_tagline	 = apply_filters( 'raindrops_tagline_elements', '<p class="tagline" %3$s>%2$s</p>' );
			$elements			 = '<div id="%1$s">' . apply_filters( 'raindrops_header_image_contents', '' ) . $raindrops_tagline . '</div>';
			$elements			 = sprintf( $elements, 'header-image', esc_html( $text ), $text_attr );
			return apply_filters( "raindrops_header_image_elements", $elements );
		} elseif ( 'home_url' == $type ) {

			$raindrops_tagline	 = apply_filters( 'raindrops_tagline_home_url', '<p class="tagline"  %4$s>%2$s</p>' );
			$elements			 = '<a href="%3$s" rel="home"><div id="%1$s">' . apply_filters( 'raindrops_header_image_contents', '' ) . $raindrops_tagline . '</div></a>';
			$elements			 = sprintf( $elements, 'header-image', esc_html( $text ), esc_url( home_url() ), $text_attr );
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
if ( ! function_exists( 'raindrops_site_description' ) ) {

	function raindrops_site_description( $args = array() ) {

		//	if ( 'blank' == get_theme_mod( 'header_textcolor' ) ) {
		if ( 'above' == raindrops_warehouse_clone( 'raindrops_tagline_in_the_header_image' ) ) {

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
if ( function_exists( 'the_custom_logo' ) ) {
	/* for WordPress 4.5 */
	/**
	 *
	 * @see https://developers.google.com/search/docs/data-types/articles#amp-logo-guidelines
	 */
	add_image_size( 'raindrops-logo', 1200, 120 );
	add_theme_support( 'custom-logo', array( 'size' => 'raindrops-logo' ) );
}

if ( ! function_exists( 'raindrops_site_title' ) ) {

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

		if ( function_exists( 'the_custom_logo' ) ) {

			if ( 'hide' == raindrops_warehouse_clone( "raindrops_display_site_title" ) ) {

				$logo = get_custom_logo();
			} else {

				$logo = '<span class="custom-logo-wrap">' . strip_tags( get_custom_logo(), '<img>' ) . '</span>';
			}
		} else {
			$logo = '';
		}
		$title_format	 = '<%1$s class="%6$s" id="site-title">%7$s<a href="%2$s" title="%3$s" rel="%4$s" class="site-title-link"><span>%5$s</span></a></%1$s>';
		$html			 = sprintf( $title_format, $heading_elememt, esc_url( home_url('/') ), esc_attr( 'site title ' . get_bloginfo( 'name', 'display' ) ), "home", get_bloginfo( 'name', 'display' ) . esc_html( $text ), apply_filters( 'raindrops_site_title_class', 'h1' ), $logo
		);
		return apply_filters( "raindrops_site_title", $html );
	}

}

if ( ! function_exists( "raindrops_column_controller" ) ) {
	/**
	 *
	 * @global type $post
	 * @param type $col
	 * @return boolean|int
	 */
	function raindrops_column_controller( $col = false ) {

		global $post;

		if ( $col !== false && !is_singular() ) {

			return absint( $col );
		}

		if ( isset( $post ) ) {

			$filter_column = apply_filters( 'raindrops_column_controller', '', $post->ID );
		} else {

			$filter_column = apply_filters( 'raindrops_column_controller', '', 0 );
		}

		if ( !empty( $filter_column ) && !is_int( $filter_column ) ) {
			$filter_column = false;
		}

		if ( isset( $post ) ) {

			if ( false !== ($type = raindrops_has_indivisual_notation() ) ) {

				if ( isset( $type[ 'col' ] ) ) {
					return absint( $type[ 'col' ] );
				}
			}

			if ( !empty( $filter_column ) ) {

				return absint( $filter_column );
			}

			/**
			 * @since 1.447
			 */
			if ( !is_active_sidebar( 1 ) && !is_active_sidebar( 2 ) ) {

				return 1;
			}
			if ( is_active_sidebar( 1 ) && !is_active_sidebar( 2 ) ) {

				return 2;
			}

			if ( 'hide' == Raindrops_warehouse_clone( 'raindrops_show_right_sidebar' ) ) {

				return 2;
			} elseif ( 'show' == Raindrops_warehouse_clone( 'raindrops_show_right_sidebar' ) ) {

				return 3;
			}
		}

		return false;
	}

}

if ( ! function_exists( "raindrops_color_type_custom" ) ) {
	/**
	 *
	 * @global type $post
	 * @param type $css
	 * @return type
	 */
	function raindrops_color_type_custom( $css ) {

		global $post;
		if ( isset( $post ) ) {

			$filter_custom_color = apply_filters( 'raindrops_color_type_custom', '', $post->ID );
		} else {

			$filter_custom_color = apply_filters( 'raindrops_color_type_custom', '', 0 );
		}

		if ( !empty( $filter_custom_color ) ) {
			/* validate value */

			$raindrops_style_type_choices = raindrops_register_styles( "w3standard" );

			if ( !array_key_exists( $filter_custom_color, $raindrops_style_type_choices ) ) {

				$filter_custom_color = '';
			}
		}

		if ( false !== ($type = raindrops_has_indivisual_notation() ) ) {

			if ( isset( $type[ 'color_type' ] ) ) {

				return raindrops_design_output( $type[ 'color_type' ] ) . raindrops_color_base();
			}

			if ( !empty( $filter_custom_color ) ) {

				return raindrops_design_output( $filter_custom_color ) . raindrops_color_base( $filter_custom_color );
			} else {

				return $css;
			}
		} elseif ( intval( get_query_var( 'raindrops_color_type' ) ) == 1 && $post_id = get_query_var( 'raindrops_pid' ) ) {

			$post_id = absint( $post_id );

			$type = raindrops_has_indivisual_notation( $post_id );

			if ( isset( $type[ 'color_type' ] ) ) {

				return raindrops_design_output( $type[ 'color_type' ] ) . raindrops_color_base();
			} else {

				if ( !empty( $filter_custom_color ) ) {

					$color_type = $filter_custom_color;

					return raindrops_design_output( $color_type ) . raindrops_color_base();
				} else {

					return $css;
				}
			}
		} else {

			return $css;
		}
	}

}

if ( ! function_exists( "raindrops_delete_post_link" ) ) {
	/**
	 *
	 * @global type $post
	 * @param type $link_text
	 * @param type $before
	 * @param type $after
	 * @param type $id
	 * @param type $echo
	 * @return type
	 */
	function raindrops_delete_post_link( $link_text = null, $before = '', $after = '', $id = 0, $echo = true ) {

		global $post;

		if ( RAINDROPS_SHOW_DELETE_POST_LINK !== true ) {

			return;
		}

		if ( empty( $link_text ) ) {

			$link_text = esc_html__( 'Trash', 'raindrops' );
		}

		if ( current_user_can( 'edit_post', $post->ID ) && $url = get_delete_post_link() ) {

			$html	 = $before . '<a href="%1$s">%2$s</a>' . $after;
			$html	 = sprintf( $html, esc_url( $url ), $link_text );

			if ( $echo !== true ) {

				return $html;
			} else {

				echo $html;
			}
		}
	}

}

if ( ! function_exists( "raindrops_enqueue_comment_reply" ) ) {
	/**
	 * @since 0.956
	 */
	function raindrops_enqueue_comment_reply() {

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {

			wp_enqueue_script( 'comment-reply' );
		}
	}

}

if ( ! function_exists( 'raindrops_load_small_device_helper' ) ) {
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

		global $raindrops_current_data_version, $is_IE, $raindrops_fluid_maximum_width, $raindrops_browser_detection, $post, $template, $raindrops_link_unique_text, $raindrops_fallback_image_for_entry_content_enable, $raindrops_fallback_human_interface_show, $raindrops_add_inline_style_for_sidebars, $raindrops_class_rd_justify_enable;

		if ( true == $raindrops_fallback_human_interface_show ) {
			return;
		}
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
				if ( !empty( $display_header_image_attr ) ) {
					$raindrops_header_image_uri		 = esc_url( $display_header_image_attr[ 0 ] );
					$raindrops_header_image_width	 = absint( $display_header_image_attr[ 1 ] );
					$function						 = absint( $display_header_image_attr[ 2 ] );
				}
			}
		}
		/* @since 1.488 */
		$raindrops_header_image_uri	= raindrops_ssl_link_helper( $raindrops_header_image_uri );

		$raindrops_restore_check = get_theme_mod( 'header_image', get_theme_support( 'custom-header', 'default-image' ) );
		/* @since 1.488 */
		$raindrops_restore_check = raindrops_ssl_link_helper( $raindrops_restore_check );

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

		$color_type = '';
		$column_type = '';
		if ( false !== ($type = raindrops_has_indivisual_notation() ) ) {

			if ( isset( $type[ 'color_type' ] ) ) {

				$color_type .= sanitize_html_class( "rd-type-" . $type[ 'color_type' ] );
			}
			if ( isset( $type[ 'col' ] ) ) {
				/** @1.482
				$color_type .= ' ';
				$color_type .= sanitize_html_class( "rd-col-" . $type[ 'col' ] );*/
				$column_type = sanitize_html_class( "rd-col-" . $type[ 'col' ] );
			}
		} else {

			$raindrops_style_type = raindrops_warehouse_clone( 'raindrops_style_type' );

			if ( !empty( $raindrops_style_type ) ) {

				$color_type = esc_attr( "rd-type-" . $raindrops_style_type );
			}
		}
		$raindrops_page_width = raindrops_warehouse_clone( 'raindrops_page_width' );

		if ( false !== ( $url = raindrops_locate_url( 'raindrops-helper.js' ) ) ) {

			wp_enqueue_script( 'raindrops_helper_script', $url, array( 'jquery' ), $raindrops_current_data_version, true );
		}

		if ( $raindrops_browser_detection == true ) {
			$raindrops_browser_detection = 1;
		} else {
			$raindrops_browser_detection = 0;
		}
		if ( is_singular() == true ) {
			$raindrops_is_singular = 1;
		} else {
			$raindrops_is_singular = 0;
		}
		if ( is_single() == true ) {
			$raindrops_is_single = 1;
		} else {
			$raindrops_is_single = 0;
		}
		if ( is_page() == true ) {
			$raindrops_is_page = 1;
		} else {
			$raindrops_is_page = 0;
		}

		$raindrops_link_unique_text = raindrops_link_unique_text();
		/* @1.328 */

		if ( true == $raindrops_fallback_image_for_entry_content_enable ) {

			$raindrops_fallback_image_for_entry_content = esc_url( raindrops_warehouse_clone( 'raindrops_fallback_image_for_entry_content' ) );
		} else {

			$raindrops_fallback_image_for_entry_content = false;
		}
		if ( wp_is_mobile() ) {
			$kind_of_browser = 'rd-mobile';
		} else {
			$kind_of_browser = 'rd-pc';
		}
		/* comments */
		if ( 1 == get_option( 'require_name_email' ) ) {
			$raindrops_required_name_email = 1;
		} else {
			$raindrops_required_name_email = 0;
		}
		/* menu percent font size */
		$raindrops_menu_primary_font_size		 = absint( raindrops_warehouse_clone( 'raindrops_menu_primary_font_size' ) );
		$raindrops_menu_primary_font_size		 = $raindrops_menu_primary_font_size / 100;
		/* base font size of pixel */
		$raindrops_basefont_size				 = raindrops_warehouse_clone( 'raindrops_basefont_settings' );
		$raindrops_current_menu_font_size		 = (float) $raindrops_basefont_size * $raindrops_menu_primary_font_size;
		$raindrops_current_menu_button_height	 = $raindrops_current_menu_font_size * 3.4; //3.4 is line-height

		$raindrops_menu_height_check_value = apply_filters( 'raindrops_menu_height_check_value', absint( $raindrops_current_menu_button_height * 1.8 ), $raindrops_basefont_size, $raindrops_menu_primary_font_size ); //near 2 line

		/* @since 1.445 */
		if ( function_exists( 'has_header_video' ) && has_header_video() && ( true == is_home() && true == is_front_page() || false == is_home() && true == is_front_page() ) ) {

			$raindrops_header_video_active = 'yes';
		} else {

			$raindrops_header_video_active = 'no';
		}
		$raindrops_doc_type = raindrops_warehouse_clone( 'raindrops_doc_type_settings' );

		if( true === raindrops_is_grid_archives() ) {
			$raindrops_is_grid_archives = 'yes';
		} else {
			$raindrops_is_grid_archives = 'no';
		}

		$use_settings = raindrops_warehouse_clone( 'raindrops_default_sidebar_responsive' );

		if ( 1 < raindrops_get_column_count() && 'yes' == $use_settings ) {

			$default_sidebar_breakpoint = absint( raindrops_warehouse_clone( 'raindrops_default_sidebar_responsive_breakpoint' ) );
		} else {
			$default_sidebar_breakpoint = 0;
		}

		$use_settings = raindrops_warehouse_clone( 'raindrops_extra_sidebar_responsive' );

		if ( 1 < raindrops_get_column_count() && 'yes' == $use_settings ) {

			$extra_sidebar_breakpoint = absint( raindrops_warehouse_clone( 'raindrops_extra_sidebar_responsive_breakpoint' ) );

		} else {
			$extra_sidebar_breakpoint = 0;
		}
		// @since 1.524 grid layout page link add data-no-instant attribute
		$data_no_instant_link = '';
		$flag = false;
		if ( 'excerpt_grid' == raindrops_warehouse_clone( 'raindrops_entry_content_is_home' ) ) {

			if ( is_multisite() ) {
				
				$data_no_instant_link .= 'a[href="'. esc_url( get_site_url() ).'/"]';
				
			} else{

				$data_no_instant_link .= 'a[href="'. esc_url( home_url() ).'/"]';
			}
			$flag = true;
		}
		if ( 'excerpt_grid' == raindrops_warehouse_clone( 'raindrops_entry_content_is_category' ) && ! is_multisite() ) {
			$comma = $flag ? ',':'';
			
			$data_no_instant_link .= $comma.' a[href^="'. esc_url( dirname(get_category_link( 1 )) ).'"]';
			$flag = true;
		}
		if ( 'excerpt_grid' == raindrops_warehouse_clone( 'raindrops_entry_content_is_search' ) ) {
			$comma = $flag ? ',':'';
			$data_no_instant_link .= $comma.' a[href^="'. esc_url( get_search_link( ) ). '"]';
		}
		
		
		
		
		wp_localize_script( 'raindrops_helper_script', 'raindrops_script_vars', array(
			'is_ie'										 => $is_IE,
			'fluid_maximum_width'						 => $raindrops_fluid_maximum_width,
			'browser_detection'							 => $raindrops_browser_detection,
			'template'									 => $template,
			'link_unique_text'							 => $raindrops_link_unique_text,
			'header_image_uri'							 => $raindrops_header_image_uri,
			'header_image_width'						 => $raindrops_header_image_width,
			'header_image_height'						 => $raindrops_header_image_height,
			'field_exists_check'						 => $raindrops_field_exists_check,
			'restore_check'								 => $raindrops_restore_check,
			'ratio'										 => apply_filters( 'raindrops_header_image_ratio', $ratio ),
			'has_ratio_filter'							 => has_filter( 'raindrops_header_image_ratio' ),
			'current_template'							 => $raindrops_current_template,
			'ignore_template'							 => $raindrops_ignore_template,
			'is_single'									 => $raindrops_is_single,
			'is_page'									 => $raindrops_is_page,
			'is_singular'								 => $raindrops_is_singular,
			'browser_detection'							 => $raindrops_browser_detection,
			'color_type'								 => $color_type,
			'column_type'								 => $column_type,
			'page_width'								 => $raindrops_page_width,
			'accessibility_settings'					 => raindrops_warehouse_clone( 'raindrops_accessibility_settings' ),
			'fallback_image_for_entry_content'			 => $raindrops_fallback_image_for_entry_content,
			'blockquote_cite_i18n'						 => esc_html__( 'cite:', 'raindrops' ),
			'kind_of_browser'							 => $kind_of_browser,
			'require_name_email'						 => $raindrops_required_name_email,
			'placeholder_text_message'					 => esc_html__( "Message", 'raindrops' ),
			'placeholder_text_required_message'			 => esc_html__( "Required Your Message", 'raindrops' ),
			'placeholder_text_comment_name'				 => esc_html__( "Name", 'raindrops' ),
			'placeholder_text_required_comment_name'	 => esc_html__( "Required Your Name", 'raindrops' ),
			'placeholder_text_email'					 => esc_html__( "Email Address", 'raindrops' ),
			'placeholder_text_required_email'			 => esc_html__( "Required Your Email", 'raindrops' ),
			'placeholder_text_url'						 => esc_html__( "Website", 'raindrops' ),
			'home_url'									 => home_url(),
		/* @1.516	'content_shareing'							 => raindrops_content_shareing(),*/
			'raindrops_primary_menu_responsive'			 => raindrops_warehouse_clone( 'raindrops_primary_menu_responsive' ),
			'raindrops_primary_menu_responsive_height'	 => $raindrops_menu_height_check_value,
			'raindrops_raindrops_sticky_menu'			 => raindrops_warehouse_clone( 'raindrops_sticky_menu' ),
			'raindrops_default_sidebar_responsive'		 => raindrops_warehouse_clone( 'raindrops_default_sidebar_responsive' ),
			'default_sidebar_breakpoint'				 => $default_sidebar_breakpoint,
			'raindrops_extra_sidebar_responsive'		 => raindrops_warehouse_clone( 'raindrops_extra_sidebar_responsive' ),
			'extra_sidebar_breakpoint'                   => $extra_sidebar_breakpoint,
			'raindrops_sidebar_responsive_text_op'		 => esc_html__( 'Open', 'raindrops' ),
			'raindrops_sidebar_responsive_text_cl'		 => esc_html__( 'Close', 'raindrops' ),
			'raindrops_archive_has_count'				 => raindrops_archive_has_count(),
			'raindrops_add_inline_style_for_sidebars'	 => $raindrops_add_inline_style_for_sidebars,
			'raindrops_header_video_active'				 => $raindrops_header_video_active,
			'raindrops_video_header_tagline_title_attr'	 => esc_html__( 'Link to Main Content', 'raindrops' ),
			'doc_type'									 => $raindrops_doc_type,
			'raindrops_layout_change_label_to_list'		 => esc_html__( 'Change to list layout', 'raindrops' ),
			'raindrops_layout_change_label_to_grid'		 => esc_html__( 'Change to grid layout', 'raindrops' ),
			'raindrops_is_grid_archives'				 => $raindrops_is_grid_archives,
		//	'raindrops_allow_safe_link_target'			=> $raindrops_allow_safe_link_target, removed @1.533 
			'raindrops_grid_layout_break_point_small_max'	 => apply_filters( 'raindrops_grid_break_point_small', 640 ),
			'enable_writing_mode_mix'					=> raindrops_warehouse_clone( 'raindrops_enable_writing_mode_mix' ),
			'writing_mode_vertical_label'				=> esc_html__('Change to writing mode vertical', 'raindrops' ),
			'writing_mode_horizontal_label'				=> esc_html__('change to writing mode horizontal', 'raindrops' ),
			'locale'									=> get_locale(),
			'delete_writing_mode_mix'					=> apply_filters( 'raindrops_delete_writing-mode-mix', false ),
			'parallax_header_image'						=> raindrops_warehouse_clone( 'raindrops_parallax_header_image' ),
			'class_rd_justify_enable'                   => $raindrops_class_rd_justify_enable,
			'data_no_instant_link'						=> $data_no_instant_link,
		) );

		wp_reset_postdata();
	}
}

if ( ! function_exists( 'raindrops_custom_width' ) ) {
	/**
	 *
	 * @global type $raindrops_page_width
	 * @return type
	 */
	function raindrops_custom_width() {

		global $raindrops_page_width;
		$c_width	 = (int) $raindrops_page_width;
		$width		 = $c_width / 13;
		$ie_width	 = $width * 0.9759;

		$custom_content_width = '/* set custom content width start */' . '#custom-doc {margin:auto;text-align:left;' . "\n" . 'width:' . round( $width, 0 ) . 'em;' . "\n" . '*width:' . round( $ie_width, 0 ) . 'em;' . "\n" . 'min-width:' . round( $width * 0.7, 0 ) . 'em;}/* set custom content width end */';
		return apply_filters( "raindrops_custom_width", $custom_content_width );
	}

}

if ( ! function_exists( 'raindrops_is_fluid' ) ) {
	/**
	 *
	 * @global type $post
	 * @global type $is_IE
	 * @global type $raindrops_fluid_minimum_width
	 * @global type $raindrops_fluid_maximum_width
	 * @global type $raindrops_current_column
	 * @global type $raindrops_stylesheet_type
	 * @global type $raindrops_header_image_default_ratio
	 * @return type
	 */
	function raindrops_is_fluid() {

		global $post, $is_IE, $raindrops_fluid_minimum_width, $raindrops_fluid_maximum_width, $raindrops_current_column, $raindrops_stylesheet_type, $raindrops_header_image_default_ratio;

		if ( !isset( $raindrops_stylesheet_type ) ) {

			$raindrops_stylesheet_type = raindrops_warehouse_clone( 'raindrops_stylesheet_in_html' );
		}
		$content_width		 = raindrops_content_width_clone();
		$width				 = intval( $raindrops_fluid_minimum_width );
		$extra_sidebar_width = raindrops_warehouse_clone( 'raindrops_right_sidebar_width_percent' );
		$fluid_width		 = '';
		$page_width			 = raindrops_warehouse_clone( 'raindrops_page_width' );

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

		$padding_height					 = $raindrops_header_image_default_ratio * 100;
		$raindrops_header_image_width	 = absint( raindrops_detect_header_image_size_clone( 'width' ) );
		$raindrops_header_image_height	 = absint( raindrops_detect_header_image_size_clone( 'height' ) );
		$raindrops_field_exists_check	 = get_post_custom_values( '_raindrops_this_header_image' );

		if ( is_singular() && $raindrops_field_exists_check !== null ) {
			$display_header_image_file	 = get_post_meta( $post->ID, '_raindrops_this_header_image', true );
			$display_header_image_attr	 = wp_get_attachment_image_src( $display_header_image_file, 'full' );

			if ( !empty( $display_header_image_attr ) ) {
				$raindrops_header_image_uri		 = $display_header_image_attr[ 0 ];
				$raindrops_header_image_width	 = $display_header_image_attr[ 1 ];
				$raindrops_header_image_height	 = $display_header_image_attr[ 2 ];
			}
		}
		if ( $raindrops_header_image_height !== 0 && $raindrops_header_image_width !== 0 ) {
			$padding_height = $raindrops_header_image_height / $raindrops_header_image_width * 100;
		}

		if ( 'doc3' == $page_width ) {

			$fluid_width = "\n" . '/* raindrops is fluid start */' .
			"\n#doc3,.raindrops-auto-fit-width{min-width:" . $raindrops_fluid_minimum_width .
			'px;max-width:' . $raindrops_fluid_maximum_width . 'px;}' .
			"\n#access{min-width:" . $raindrops_fluid_minimum_width . 'px;}' .
			"\n" .
			".rd-pw-doc3.rd-col-1 .breadcrumbs{width:" . $content_width . 'px;margin:auto;}' .
			"\n";
			if ( false == has_filter( 'raindrops_header_image_ratio' ) ) {

				$fluid_width .= "#doc3 #header-image{
			display:block;
			position: relative;
			padding-bottom: {$padding_height}%;
			height: 0!important;
			max-width:100%;
		}";
			}

			$fluid_width .= '/* raindrops is fluid end */';
		} elseif ( 'doc5' == $page_width ) {

			$raindrops_full_width_limit_window_width			 = raindrops_warehouse_clone( 'raindrops_full_width_limit_window_width' );
			$raindrops_full_width_max_width						 = raindrops_warehouse_clone( 'raindrops_full_width_max_width' );
			$raindrops_document_type							 = raindrops_warehouse_clone( 'raindrops_doc_type_settings' );
			$sticky_post_count									 = count( get_option( 'sticky_posts' ) );
			$post_per_page										 = get_option( 'posts_per_page' );
			$total_loop											 = absint( $sticky_post_count ) + absint( $post_per_page );
			$raindrops_full_width_max_width_keep_content_width	 = raindrops_content_width_clone();

			/* loop-12 replace loop-0 */
			$post_per_page_relate_style = '';

			if ( 'html5' == $raindrops_document_type ) {
				$post_per_page_relate_style = '.rd-pw-doc5.rd-col-1 .loop-0  article,';
			}
			if ( 'xhtml' == $raindrops_document_type ) {
				$post_per_page_relate_style = '.rd-pw-doc5.rd-col-1 .loop-0  > div > div,';
			}

			for ( $i = 0; $i < $total_loop; $i++ ) {

				$num = absint( $i + 1 );
				if ( 'html5' == $raindrops_document_type ) {

				//	$post_per_page_relate_style .= '.rd-pw-doc5.rd-col-1:not(.rd-grid) .loop-' . $num . '  article,';
					$post_per_page_relate_style .= '.rd-pw-doc5.rd-col-1:not(.rd-grid)  .loop-' . $num . ' .entry-title,';
					$post_per_page_relate_style .= '.rd-pw-doc5.rd-col-1:not(.rd-grid)  .loop-' . $num . ' .posted-on,';
					$post_per_page_relate_style .= '.rd-pw-doc5.rd-col-1:not(.rd-grid)  .loop-' . $num . ' .entry-content,';
					$post_per_page_relate_style .= '.rd-pw-doc5.rd-col-1:not(.rd-grid)  .loop-' . $num . ' .click-drawing-container,';
					$post_per_page_relate_style .= '.rd-pw-doc5.rd-col-1:not(.rd-grid)  .loop-' . $num . ' .entry-meta,';
				}
				if ( 'xhtml' == $raindrops_document_type ) {

					$post_per_page_relate_style .= '.rd-pw-doc5.rd-col-1 .loop-' . $num . '  > div > div,';
				}
			}

			$fluid_width = "\n" . '/* raindrops is fluid start  */' .
			'#header-image,' .
			"\n#doc5{min-width:" . $raindrops_fluid_minimum_width .
			'px;max-width:' . $raindrops_full_width_limit_window_width . 'px;}' .
			"\n#access{min-width:" . $raindrops_fluid_minimum_width . 'px;}' .
			'.raindrops-auto-fit-width, ' .
			"\n#doc5 .static-front-content,
	.page-template-front-page #doc5 .topsidebar,
	#doc5 .front-page-top-container,
	.page-template-page-featured .poster .line,
	.page-template-page-featured .page article,
	#hd,
	.social,
	#portfolio,
	#raindrops-recent-posts,
	.commentlist,
	#nav-above-comments,
	#nav-below-comments,
	#nav-below,
	.no-header-image #header-inner,
	#access .menu-header,
	#access > .menu,
	#top ol.breadcrumbs,
	.rd-tag-description,
	.rd-category-description,
	#bd,
	.related-posts,
	#ft .widget-wrapper,
	.rd-col-1.rd-grid.rd-content-width-fit .index.search-results,
	.rd-col-1.rd-grid.rd-content-width-fit .index.archives{
		max-width:{$raindrops_full_width_max_width}px;
		margin-left:auto;
		margin-right:auto;
	}
	#ft address{
		max-width:{$raindrops_full_width_max_width}px;
	}
	#top > a{
		display:block;

	}";

			if ( false == has_filter( 'raindrops_header_image_ratio' ) ) {

				$fluid_width .= "#doc5 #header-image{
			display:block;
			position: relative;
			padding-bottom: {$padding_height}%;
			height: 0!important;
			max-width:100%;
		}";
			}

			$fluid_width .= "\n" . '/* raindrops is fluid end */';

			$fluid_width .= "\n" . '/* raindrops is fluid 1 column start  */' .
			"\n#doc5{
			min-width:{$raindrops_fluid_minimum_width}px;
			max-width: {$raindrops_full_width_limit_window_width}px;
			}
		.rd-pw-doc5.rd-col-1 #doc5 #header-image{
			display:block;
			position: relative;
			padding-bottom: {$padding_height}%;
			height: 0!important;
			max-width:100%;
		}
		.rd-pw-doc5.rd-col-1 .raindrops-expand-width{
			padding-right:0;
		}
		.rd-pw-doc5.rd-col-1 #bd{
			max-width:none;
		}

		.loop-before-toolbar,
		.rd-pw-doc5.rd-col-1 .topsidebar .metaslider,
		.rd-pw-doc5.rd-col-1 .topsidebar > ul > .widget_calendar #calendar_wrap,
		.rd-pw-doc5.rd-col-1 .topsidebar > ul > .raindrops-pinup-entries .page,
		.rd-pw-doc5.rd-col-1 .topsidebar > ul > .raindrops-pinup-entries .post,
		.rd-pw-doc5.rd-col-1 .topsidebar > ul > .raindrops-extend-archive .eco-archive,
		.rd-pw-doc5.rd-col-1 .topsidebar > ul > .widget_categories ul,
		.rd-pw-doc5.rd-col-1 .topsidebar > ul > .widget_nav_menu > div,
		.rd-pw-doc5.rd-col-1 .topsidebar > ul > .widget_tag_cloud .tagcloud,
		.rd-pw-doc5.rd-col-1 .topsidebar > ul > .widget_text .textwidget,
		.rd-pw-doc5.rd-col-1 .topsidebar > ul > .widget_media_image img,
		.rd-pw-doc5.rd-col-1 .topsidebar > ul > .widget_media_image figure,
		.rd-pw-doc5.rd-col-1 .topsidebar > ul > .widget_media_video .wp-video,
		.rd-pw-doc5.rd-col-1 .topsidebar > ul > .widget_search #searchform,
		.rd-pw-doc5.rd-col-1 .topsidebar > ul > li > .widgettitle,
		.rd-pw-doc5.rd-col-1 .topsidebar > ul > li > ul,
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
			.rd-pw-doc5.rd-col-1 #archives-title,
			.rd-pw-doc5.rd-col-1 .page-title,
			.rd-pw-doc5.rd-col-1.page-template-date-php #doc3 .raindrops-monthly-archive-prev-next-avigation,
			.rd-pw-doc5.rd-col-1 #nav-above,
			.rd-pw-doc5.rd-col-1 #ft .widget-wrapper,
			.rd-pw-doc5.rd-col-1 #ft address{
									max-width:{$raindrops_full_width_max_width}px;
									margin-left:auto;
									margin-right:auto;
			}
			.rd-pw-doc5.rd-col-1 #ft address{
				margin:1em auto;
			}
			/* div > div for xhtml */
			.rd-pw-doc5.rd-col-1.search .search-results > div > div,
			.rd-pw-doc5.rd-col-1.tag > div > div,
			.rd-pw-doc5.rd-col-1.single .post,
			.rd-pw-doc5.rd-col-1.page .page .page," . $post_per_page_relate_style . "
			.rd-pw-doc5.rd-col-1 .loop-item-show-allways > div > div,
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
			.rd-pw-doc5.rd-col-1.single .raindrops-no-keep-content-width article,
			.rd-pw-doc5.rd-col-1.page-template .raindrops-no-keep-content-width article,
			.rd-pw-doc5.rd-col-1.page .raindrops-no-keep-content-width article,
			.rd-pw-doc5.rd-col-1.page > div > article,
			/*.rd-pw-doc5.rd-col-1 .loop-item-show-allways > div > article,*/
			.rd-pw-doc5.rd-col-1 [class|=\"loop\"] > div > .post_format-post-format-status,
			.rd-pw-doc5.rd-col-1 [class|=\"loop\"]  > div > .category-blog,
			.rd-pw-doc5.rd-col-1 [class|=\"loop\"]  > div > article .entry-title,
			.rd-pw-doc5.rd-col-1 [class|=\"loop\"]  > div > article .posted-on,
			.rd-pw-doc5.rd-col-1 [class|=\"loop\"]  > div > article .entry-content,
			.rd-pw-doc5.rd-col-1:not(.rd-grid) [class|=\"loop\"] > div > article .click-drawing-container,
			.rd-pw-doc5.rd-col-1 [class|=\"loop\"]  > div > article .entry-meta{
								  max-width:{$raindrops_full_width_max_width}px;
									  /* @1.456 */
								  margin-left:auto!important;
								  margin-right:auto!important;

			}
			/* @since1.443 */
			.rd-pw-doc5.rd-col-1.single .raindrops-keep-content-width article{
				max-width:{$raindrops_full_width_max_width_keep_content_width}px;
				margin-left:auto!important;
				margin-right:auto!important;
			}
			/* @since1.446 */
			.page-template-front-page .topsidebar ul > li > .widgettitle ~ select[name=\"archive-dropdown\"],
			.page-template-front-page .topsidebar ul > li > .widgettitle ~ .postform{

				margin-left: 30%;
				margin-right:30%;
				width: 40%;

			}
			.page-template-front-page .topsidebar ul > li > .widgettitle + form .searchform,
			.page-template-front-page .topsidebar ul > li > .widgettitle + table,
			.page-template-front-page .topsidebar ul > li > .widgettitle + div,
			.page-template-front-page .topsidebar ul > li > #calendar_wrap,
			.page-template-front-page .topsidebar ul > li > .widgettitle + ul,
			.page-template-front-page .topsidebar ul > li > .widgettitle,
			.page-template-front-page #portfolio .portfolio-nav,
			.page-template-front-page #portfolio .index,
			.page-template-front-page .front-page-template-pages .rd-tpl-front-page,
			.page-template-front-page .raindrops-toc-front,
			.page-template-front-page > .line{
				max-width:{$raindrops_full_width_max_width}px;
				margin-left:auto!important;
				margin-right:auto!important;
			}
			.page-template-front-page #portfolio,
			.page-template-front-page #bd{
				max-width:{$raindrops_full_width_limit_window_width}px;
				margin-left:auto!important;
				margin-right:auto!important;
			}
			@media screen and (max-width : {$raindrops_full_width_max_width}px){
				/* @1.469 */
				.rd-col-1 .related-posts,
				.rd-col-1 .raindrops-no-keep-content-width .topsidebar .widget,
				.rd-col-1.single .first div[id^=\"post-\"],
				.rd-col-1.page .first div[id^=\"post-\"]{
					padding-left:1em;
					padding-right:1em;
					box-sizing:border-box;
				}
			}" . '/* raindrops is fluid 1 column end  */';
		}


		$fluid_width = raindrops_remove_spaces_from_css( $fluid_width );

		return apply_filters( "raindrops_is_fluid", $fluid_width );
	}

}

if ( ! function_exists( 'raindrops_is_fixed' ) ) {
	/**
	 *
	 * @global type $is_IE
	 * @global type $raindrops_page_width
	 * @global type $raindrops_base_font_size
	 * @return type
	 */
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

add_filter( 'raindrops_embed_meta_css', 'raindrops_add_gallery_css' );

if ( ! function_exists( 'raindrops_add_gallery_css' ) ) {
	/**
	 *
	 * @param type $css
	 * @return type
	 */
	function raindrops_add_gallery_css( $css ) {

		return $css . raindrops_gallerys();
	}

}

if ( ! function_exists( 'raindrops_gallerys' ) ) {
	/**
	 *
	 * @global type $raindrops_document_type
	 * @return type
	 */
	function raindrops_gallerys() {

		global $raindrops_document_type;

		$raindrops_gallerys = raindrops_gallerys_clone();

		$raindrops_gallerys = raindrops_remove_spaces_from_css( $raindrops_gallerys );

		return $raindrops_gallerys;
	}

}

add_filter( 'raindrops_prev_next_post', 'raindrops_remove_empty_span' );
add_filter( 'raindrops_posted_on', 'raindrops_remove_empty_span' );
add_filter( 'raindrops_posted_in', 'raindrops_remove_empty_span' );

if ( ! function_exists( 'raindrops_remove_empty_span' ) ) {
	/**
	 *
	 * @param type $content
	 * @return type
	 */
	function raindrops_remove_empty_span( $content ) {

		return preg_replace( '!<span[^>]*>(\s*)?<\/span>!', '', $content );
	}

}

if ( ! function_exists( 'raindrops_page_menu_args' ) ) {
	/**
	 *
	 * @global type $raindrops_nav_menu_home_link
	 * @param array $args
	 * @return boolean
	 * thanks  aison
	 */
	function raindrops_page_menu_args( $args ) {

		global $raindrops_nav_menu_home_link;
		$args[ 'show_home' ] = $raindrops_nav_menu_home_link;

		return $args;
	}

}

if ( ! function_exists( 'raindrops_insert_message_action_hook_position' ) ) {
	/**
	 *
	 * @global type $wp_customize
	 * @param type $hook_name
	 * @since 0.980
	 */
	function raindrops_insert_message_action_hook_position( $hook_name = '' ) {
		global $wp_customize;

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
			add_action( 'raindrops_before_article', 'raindrops_action_hook_messages' );
			add_action( 'raindrops_after_article', 'raindrops_action_hook_messages' );
			add_action( 'raindrops_prepend_widget_sticky', 'raindrops_action_hook_messages' );
			add_action( 'raindrops_append_widget_sticky', 'raindrops_action_hook_messages' );
		}
	}

}

raindrops_insert_message_action_hook_position();

if ( ! function_exists( 'raindrops_prepend_loop' ) ) {
	/**
	 * @since 1.204
	 */
	function raindrops_prepend_loop() {
		$args = array( 'hook_name' => 'raindrops_prepend_loop', 'template_part_name' => 'hook-prepend-loop.php' );

		get_template_part( 'hook', 'prepend-loop' );
		do_action( 'raindrops_prepend_loop', $args );
	}

}

if ( ! function_exists( 'raindrops_append_loop' ) ) {
	/**
	 * @since 1.204
	 */
	function raindrops_append_loop() {
		$args = array( 'hook_name' => 'raindrops_append_loop', 'template_part_name' => 'hook-append-loop.php' );

		get_template_part( 'hook', 'append-loop' );
		do_action( 'raindrops_append_loop', $args );
	}

}

if ( ! function_exists( 'raindrops_action_hook_messages' ) ) {
	/**
	 *
	 * @global type $raindrops_actions_hook_message
	 * @param type $args
	 * @since 0.980
	 */
	function raindrops_action_hook_messages( $args ) {
		global $raindrops_actions_hook_message;
		/**
		 * When WP_DEBUG value true and $raindrops_actions_hook_message value true
		 * Show Raindrops action filter position and examples
		 *
		 * $raindrops_actions_hook_message
		 * @since 0.980
		 */
		if ( !isset( $raindrops_actions_hook_message ) ) {

			$customizer_modify_value = raindrops_warehouse_clone( 'raindrops_actions_hook_message' );

			if ( 'show' !== $customizer_modify_value ) {

				$raindrops_actions_hook_message = false;
			} else {
				$raindrops_actions_hook_message = true;
			}
		}

		if ( true == $raindrops_actions_hook_message ) {

			if ( isset( $args ) && array_key_exists( 'hook_name', $args ) && array_key_exists( 'template_part_name', $args ) ) {
				/* translators: 1: hook name. please not translate 2: template name. please not translate */
				$message = esc_html__( 'add_action(  \'%1$s\', \'your_function\'  ) or add template part file the name \'%2$s\'.', 'raindrops' );
				$message = sprintf( $message, $args[ 'hook_name' ], $args[ 'template_part_name' ] );
				printf( '<div style="%2$s" class="color4 pad-m corner solid-border">%1$s</div>', $message, 'word-break:break-all;word-wrap:break-word;' );
			}
		}
	}

}

if ( ! function_exists( 'raindrops_after_nav_menu' ) ) {
	/**
	 * @since 0.980
	 */
	function raindrops_after_nav_menu() {

		get_template_part( 'hook', 'after-nav-menu' );
		$args = array( 'hook_name' => 'raindrops_after_nav_menu', 'template_part_name' => 'hook-after-nav-menu.php' );
		do_action( 'raindrops_after_nav_menu', $args );
	}

}

if ( ! function_exists( 'raindrops_prepend_doc' ) ) {
	/**
	 * @since 0.980
	 */
	function raindrops_prepend_doc() {

		$args = array( 'hook_name' => 'raindrops_prepend_doc', 'template_part_name' => 'hook-prepend-doc.php' );
		get_template_part( 'hook', 'prepend-doc' );
		do_action( 'raindrops_prepend_doc', $args );
	}

}

if ( ! function_exists( 'raindrops_append_doc' ) ) {
	/**
	 * @since 0.980
	 */
	function raindrops_append_doc() {

		$args = array( 'hook_name' => 'raindrops_append_doc', 'template_part_name' => 'hook-append-doc.php' );
		get_template_part( 'hook', 'append-doc' );
		do_action( 'raindrops_append_doc', $args );
	}

}

if ( ! function_exists( 'raindrops_prepend_entry_content' ) ) {
	/**
	 * @since 0.980
	 */
	function raindrops_prepend_entry_content() {

		$args = array( 'hook_name' => 'raindrops_prepend_entry_content', 'template_part_name' => 'hook-prepend-entry-content.php' );
		get_template_part( 'hook', 'prepend-entry-content' );
		do_action( 'raindrops_prepend_entry_content', $args );
	}

}


if ( ! function_exists( 'raindrops_prepend_widget_sticky' ) ) {
	/**
	 *
	 */
	function raindrops_prepend_widget_sticky() {

		$args = array( 'hook_name' => 'raindrops_prepend_widget_sticky', 'template_part_name' => 'hook-prepend-widget-sticky.php' );
		get_template_part( 'hook', 'prepend-widget-sticky' );
		do_action( 'raindrops_prepend_widget_sticky', $args );
	}

}
if ( ! function_exists( 'raindrops_append_widget_sticky' ) ) {
	/**
	 *
	 */
	function raindrops_append_widget_sticky() {

		$args = array( 'hook_name' => 'raindrops_append_widget_sticky', 'template_part_name' => 'hook-append-widget-sticky.php' );
		get_template_part( 'hook', 'append-widget-sticky' );
		do_action( 'raindrops_append_widget_sticky', $args );
	}

}

if ( ! function_exists( 'raindrops_prepend_extra_sidebar' ) ) {
	/**
	 * @since 0.980
	 */
	function raindrops_prepend_extra_sidebar() {

		$args = array( 'hook_name' => 'raindrops_prepend_extra_sidebar', 'template_part_name' => 'hook-prepend-extra-sidebar.php' );
		get_template_part( 'hook', 'prepend-extra-sidebar' );
		do_action( 'raindrops_prepend_extra_sidebar', $args );
	}

}

if ( ! function_exists( 'raindrops_prepend_default_sidebar' ) ) {
	/**
	 * @since 0.980
	 */
	function raindrops_prepend_default_sidebar() {

		$args = array( 'hook_name' => 'raindrops_prepend_default_sidebar', 'template_part_name' => 'hook-prepend-default-sidebar.php' );
		get_template_part( 'hook', 'prepend-default-sidebar' );
		do_action( 'raindrops_prepend_default_sidebar', $args );
	}

}

if ( ! function_exists( 'raindrops_prepend_footer' ) ) {
	/**
	 * @since 0.980
	 */
	function raindrops_prepend_footer() {

		$args = array( 'hook_name' => 'raindrops_prepend_footer', 'template_part_name' => 'hook-prepend-footer.php' );
		get_template_part( 'hook', 'prepend-footer' );
		do_action( 'raindrops_prepend_footer', $args );
	}

}

if ( ! function_exists( 'raindrops_append_entry_content' ) ) {
	/**
	 * @since 0.980
	 */
	function raindrops_append_entry_content() {

		$args = array( 'hook_name' => 'raindrops_append_entry_content', 'template_part_name' => 'hook-append-entry-content.php' );
		get_template_part( 'hook', 'append-entry-content' );
		do_action( 'raindrops_append_entry_content', $args );
	}

}

if ( ! function_exists( 'raindrops_append_extra_sidebar' ) ) {
	/**
	 * @since 0.980
	 */
	function raindrops_append_extra_sidebar() {

		$args = array( 'hook_name' => 'raindrops_append_extra_sidebar', 'template_part_name' => 'hook-append-extra-sidebar.php' );
		get_template_part( 'hook', 'append-extra-sidebar' );
		do_action( 'raindrops_append_extra_sidebar', $args );
	}

}

if ( ! function_exists( 'raindrops_append_default_sidebar' ) ) {
	/**
	 * @since 0.980
	 */
	function raindrops_append_default_sidebar() {

		$args = array( 'hook_name' => 'raindrops_append_default_sidebar', 'template_part_name' => 'hook-append-default-sidebar.php' );
		get_template_part( 'hook', 'append-default-sidebar' );
		do_action( 'raindrops_append_default_sidebar', $args );
	}

}

if ( ! function_exists( 'raindrops_append_footer' ) ) {
	/**
	 * @since 0.980
	 */
	function raindrops_append_footer() {

		$args = array( 'hook_name' => 'raindrops_append_footer', 'template_part_name' => 'hook-append-footer.php' );
		get_template_part( 'hook', 'append-footer' );
		do_action( 'raindrops_append_footer', $args );
	}

}

if ( ! function_exists( 'raindrops_before_article' ) ) {
	/**
	 * @since 1.334
	 */
	function raindrops_before_article() {

		$args = array( 'hook_name' => 'raindrops_before_article', 'template_part_name' => 'hook-before_article.php' );
		get_template_part( 'hook', 'before_article' );
		do_action( 'raindrops_before_article', $args );
	}

}

if ( ! function_exists( 'raindrops_after_article' ) ) {
	/**
	 * @since 1.334
	 */
	function raindrops_after_article() {

		$args = array( 'hook_name' => 'raindrops_after_article', 'template_part_name' => 'hook-after_article.php' );
		get_template_part( 'hook', 'after_article' );
		do_action( 'raindrops_after_article', $args );
	}

}

if ( ! function_exists( 'raindrops_entry_title' ) ) {
	/**
	 * remove title filtered raindrops fallbacktitie
	 * meny plugins use esc_html(title) I think it is wrong ,It does not go against the tide of the world
	 * @since 1.492
	 * @global type $post
	 * @global type $templates
	 * @global type $raindrops_link_unique_text
	 * @param type $args
	 * @param type $post_id
	 * @return type
	 * @since 0.980
	 */

	function raindrops_entry_title( $args = array(), $post_id = 0 ) {
		global $post, $templates, $raindrops_link_unique_text;

		$default				 = array( 'raindrops_title_element' => 'h2', 'echo' => true );
		$args					 = wp_parse_args( $args, $default );
		extract( $args, EXTR_SKIP );

		$raindrops_link_unique_text = raindrops_link_unique_text();

		if ( isset( $post_id ) && $raindrops_link_unique_text == true ) {

			$raindrops_unique_label = raindrops_unique_entry_title(  $post_id );
		}

		$thumbnail							= '';
		$raindrops_unique_label				= '';
		$raindrops_entry_title_text_class	= apply_filters( 'raindrops_entry_title_text_class', '' );
		$title_text_open_element			= '<span>';
		$title_text_close_element			= '</span>';

		$title								= the_title( '', '', false );

		if ( isset( $post_id ) && $raindrops_link_unique_text == true ) {

			$raindrops_unique_label = raindrops_unique_entry_title(  $post_id );
		}

		if( $post_id !== 0 && is_int( $post_id )){

			$title = get_the_title( $post_id );
			$html = '<' . $raindrops_title_element . ' class="%1$s"><span>%4$s<span>%2$s%3$s</span></span></' . $raindrops_title_element . '>';
			$html = sprintf( $html,
				apply_filters( 'raindrops_entry_title_class', 'h2 entry-title' ),
				$title,
				$raindrops_unique_label,
				raindrops_post_thumbnail_for_loop_title( $post_id, $title )
			);
			return $html;
		}

		if ( !is_singular() && in_the_loop() ) {

				$raindrops_entry_title_text_allow = apply_filters( 'raindrops_entry_title_text_elements_allow', true );

				if ( true == $raindrops_entry_title_text_allow ) {

					$title_text_open_element = '<span class="entry-title-text">';
					$title_text_close_element = '</span>';
				}
		}

		if( ! empty( $raindrops_entry_title_text_class ) ) {

			$title_text_open_element = '<span class="'.esc_attr( $raindrops_entry_title_text_class ).'">';
			$title_text_close_element = '</span>';
		}

		if ( !is_singular() || is_page_template( 'page-templates/list-of-post.php' )
			|| ( is_page_template( 'page-templates/full-width.php' ) && is_front_page() )
			|| ( is_page_template( 'page-templates/front-page.php' ) && is_front_page() ) ) {

			$html = '%8$s<%7$s class="%1$s">%2$s<a href="%3$s" rel="bookmark" title="%4$s"><span>%10$s%11$s  %5$s%6$s %12$s</span></a>%9$s</%7$s>';

			$html = sprintf( $html,
				apply_filters( 'raindrops_entry_title_class', 'h2 entry-title' ),									//1
				$thumbnail,																							//2
				get_permalink(),																					//3
				the_title_attribute( array( 'before' => '', 'after' => '', 'echo' => false ) ),						//4
				$title,																								//5
				$raindrops_unique_label,																			//6
				$raindrops_title_element,																			//7
				"\n" . str_repeat( "\t", 11 ),																		//8
				"\n" . str_repeat( "\t", 11 ),																		//9
				raindrops_post_thumbnail_for_loop_title($post->ID, $title ),										//10
				! empty($title) ? $title_text_open_element: '',														//11
				! empty($title) ? $title_text_close_element: ''														//12

			);
		} else {

			$html = '<' . $raindrops_title_element . ' class="%1$s">%4$s<span>%2$s%3$s</span></' . $raindrops_title_element . '>';
			$html = sprintf( $html,
				apply_filters( 'raindrops_entry_title_class', 'h2 entry-title' ),
				the_title( '', '', false ),
				$raindrops_unique_label,
				$thumbnail );
		}

		if ( true == $echo ) {

			echo apply_filters( 'raindrops_entry_title', $html );
		} else {

			return apply_filters( 'raindrops_entry_title', $html );
		}
	}
}
if ( ! function_exists( 'raindrops_post_thumbnail_for_loop_title' ) ) {
	/**
	 * @1.492 raindrops_entry_title relate change
	 * @global type $post
	 * @global type $raindrops_link_unique_text
	 * @param type $post_id
	 * @param type $title
	 * @return type
	 */
	function raindrops_post_thumbnail_for_loop_title( $post_id = 0, $title = '', $in_the_loop = true ) {

		global $post, $raindrops_link_unique_text;

		$format_label	 = '';
		$id				 = absint( $post_id );

		if ( !is_admin() ) {

			$format = get_post_format( $id, $title );

			if ( false === $format ) {

				$image_uri		 = get_template_directory_uri() . '/images/link.png';
				$class			 = 'icon-link-no-title entry-title-text';
				$format_label	 = esc_html__( 'Article', 'raindrops' );
			} else {

				$image_uri	 = get_template_directory_uri() . '/images/post-format-' . $format . '.png';
				$class		 = 'icon-post-format-notitle icon-post-format-' . $format;

				if ( 'link' == $format ) {

					$add_label = esc_html__( ' to entry', 'raindrops' );
				} else {

					$add_label = '';
				}

				$format_labels = array(
					'standard'	 => __( 'Standard', 'raindrops' ),
					'aside'		 => __( 'Aside', 'raindrops' ),
					'chat'		 => __( 'Chat', 'raindrops' ),
					'gallery'	 => __( 'Gallery', 'raindrops' ),
					'link'		 => __( 'Link', 'raindrops' ),
					'image'		 => __( 'Image', 'raindrops' ),
					'quote'		 => __( 'Quote', 'raindrops' ),
					'status'	 => __( 'Status', 'raindrops' ),
					'video'		 => __( 'Video', 'raindrops' ),
					'audio'		 => __( 'Audio', 'raindrops' ),
				);

				if ( isset( $format_labels[ $format ] ) ) {
					$format_label = esc_attr( $format_labels[ $format ] );
				} else {

					$format_label = esc_attr( $format );
				}

				$format_label = esc_html__( 'Post Format ', 'raindrops' ) . $format_label . $add_label;
			}

			$raindrops_post_thumbnail_size = array( 48, 48 );

			if( $in_the_loop == true ) {

				$loop_check = in_the_loop();
			} else {

				$loop_check = true;
			}

			if ( $loop_check ) {

				$raindrops_post_thumbnail_size = apply_filters( 'raindrops_post_thumbnail_size_main_query', array( 48, 48 ), $id, get_post_class( '', $id ) );
			}

			$thumbnail = '';

			if ( $loop_check && has_post_thumbnail( $id ) && !post_password_required() && !is_singular() ) {

				$thumbnail_image = get_the_post_thumbnail( $post->ID, $raindrops_post_thumbnail_size, array( "style" => "vertical-align:middle;", "alt" => null ) );

				if ( !empty( $thumbnail_image ) ) {

					$thumbnail .= '<span class="h2-thumb">' . $thumbnail_image . '</span>';
				}
			}

			// @1.487 remove && !has_post_thumbnail( $id )
			if ( isset( $id ) && !is_404() && !is_singular() && !post_password_required() ) {

				$thumbnail = apply_filters( 'raindrops_title_thumbnail', $thumbnail, '<span class="h2-thumb">', '</span>' );
			}

			if ( empty( $title ) ) {
				/**
				 * @since 1.491 add screen reader text
				 */
				$html	 = $thumbnail . '<span class="' . esc_attr( $class ) . '" title="' . $format_label . '" ><span class="screen-reader-text">' . esc_html__( 'No Title', 'raindrops' ) . '</span></span>';
				/**
				 * @since 1.491
				 */
				$html	 = apply_filters( 'raindrops_fallback_title_none', $html, $class, $format_label );
				return $html;
			}
			return $thumbnail;
		}
	}
}

if ( ! function_exists( 'raindrops_excerpt_with_html' ) ) {

	/**
	 *
	 * @param type $content
	 * @return type
	 * @since 1.278
	 */
	function raindrops_excerpt_with_html( $content ) {

		$raindrops_excerpt_condition		 = raindrops_detect_excerpt_condition();
		$raindrops_excerpt_enable			 = raindrops_warehouse_clone( 'raindrops_excerpt_enable' );
		$raindrops_allow_oembed_excerpt_view = raindrops_warehouse_clone( 'raindrops_allow_oembed_excerpt_view' );

		if ( true == $raindrops_excerpt_condition && 'yes' == $raindrops_excerpt_enable ) {

			return raindrops_html_excerpt_with_elements( $content, 200, ' ...', true, true );
		}
		return $content;
	}

}

if ( ! function_exists( 'raindrops_maybe_multibyte' ) ) {

	/**
	 *
	 * @param type $text
	 * @return boolean
	 * @since 1.278
	 */
	function raindrops_maybe_multibyte( $text ) {

		$filter_value = apply_filters( 'raindrops_maybe_multibyte', 0, $text );

		if ( is_bool( $filter_value ) ) {

			return $filter_value;
		}

		if ( !is_string( $text ) ) {

			return false;
		}
		if ( strlen( $text ) !== mb_strlen( $text, "UTF-8" ) ) {

			return true;
		}

		return false;
	}

}
if ( ! function_exists( 'raindrops_html_excerpt_with_elements' ) ) {

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
	function raindrops_html_excerpt_with_elements( $content, $length = 200, $more = '...', $exact = true,
										  $allow_html = false ) {
		global $post;
		$no_closed_elements	 = '(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param|embed)';
		$length				 = apply_filters( 'excerpt_length', $length );
		$length				 = apply_filters( 'raindrops_html_excerpt_with_elements_length', $length );
		$allow_html			 = apply_filters( 'raindrops_html_excerpt_with_elements_allow_html', $allow_html );

		if ( isset( $post ) && has_excerpt() ) {

			return apply_filters( 'the_excerpt', get_the_excerpt() );
		}

		if ( isset( $post->ID ) && is_sticky( $post->ID ) ) {

			return $content;
		}

		if ( $allow_html ) {

			$raindrops_skip_excerpt = apply_filters( 'raindrops_skip_excerpt', false );

			if ( preg_match( '!\[raindrops skip-excerpt\]!', $content ) || true == $raindrops_skip_excerpt ) {
				return $content;
			}

			$striped_shortcode_content	 = strip_shortcodes( $content );
			$striped_content			 = wp_kses( $striped_shortcode_content, array() );

			if ( mb_strlen( $striped_content, "UTF-8" ) <= $length ) {
				return $content;
			}

			preg_match_all( '/(<.+?>|\[.+\])?([^<>]*)/s', $content, $lines, PREG_SET_ORDER );

			$total_length	 = mb_strlen( $more, "UTF-8" );
			$open_tags		 = array();
			$truncate		 = '';

			foreach ( $lines as $line_matchings ) {

				if ( isset( $line_matchings[ 1 ] ) and ! empty( $line_matchings[ 1 ] ) ) {

					if ( preg_match( '/^<(\s*.+?\/\s*|\s*' . $no_closed_elements . '(\s.+?)?)>$/is', $line_matchings[ 1 ] ) ) {

					} elseif ( preg_match( '!\[\/([^\]]+)\]!', $line_matchings[ 1 ], $tag_matchings ) ) {

						$pos = array_search( $tag_matchings[ 1 ], $open_tags );

						if ( $pos !== false ) {

							unset( $open_tags[ $pos ] );
						}
					} elseif ( preg_match( '/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[ 1 ], $tag_matchings ) ) {

						$pos = array_search( $tag_matchings[ 1 ], $open_tags );

						if ( $pos !== false ) {

							unset( $open_tags[ $pos ] );
						}
					} elseif ( preg_match( '/^<\s*([^\s>!]+).*?>$/s', $line_matchings[ 1 ], $tag_matchings ) ) {

						array_unshift( $open_tags, strtolower( $tag_matchings[ 1 ] ) );
					} elseif ( preg_match( '/^\[\s*([^\s\]!]+).*?\]$/s', $line_matchings[ 1 ], $tag_matchings ) ) {

						array_unshift( $open_tags, strtolower( $tag_matchings[ 1 ] ) );
					}
					$truncate .= $line_matchings[ 1 ];
				}

				$content_length = mb_strlen( preg_replace( '/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', ' ', $line_matchings[ 2 ] ), "UTF-8" );

				if ( $total_length + $content_length > $length ) {

					$left			 = $length - $total_length;
					$entities_length = 0;

					if ( preg_match_all( '/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $line_matchings[ 2 ], $entities, PREG_OFFSET_CAPTURE ) ) {

						foreach ( $entities[ 0 ] as $entity ) {
							if ( $entity[ 1 ] + 1 - $entities_length <= $left ) {
								$left--;
								$entities_length += mb_strlen( $entity[ 0 ], "UTF-8" );
							} else {
								break;
							}
						}
					}

					$truncate .= wp_html_excerpt( $line_matchings[ 2 ], $left + $entities_length, '' );
					break;
				} else {

					$truncate .= $line_matchings[ 2 ];
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

		if ( !$exact ) {

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


if ( ! function_exists( 'raindrops_entry_content' ) ) {

	/**
	 * @since 0.980
	 */
	function raindrops_entry_content( $more_link_text = null, $stripteaser = false ) {

		global $post, $more_link_text, $raindrops_change_html_excerpt_when_post_formats;

		if ( raindrops_detect_display_none_condition() ) {

			return;
		}
		if ( empty( $more_link_text ) ) {

			$more_link_text = esc_html__( 'Continue&nbsp;reading ', 'raindrops' ) . '<span class="meta-nav">&#8594;</span><span class="more-link-post-unique">' . esc_html__( '&nbsp;Post ID&nbsp;', 'raindrops' ) . get_the_ID() . '</span>';
		}

		$raindrops_excerpt_condition		 = apply_filters( 'raindrops_excerpt_conditional', raindrops_detect_excerpt_condition() );
		$raindrops_excerpt_enable			 = raindrops_warehouse_clone( 'raindrops_excerpt_enable' );
		$raindrops_allow_oembed_excerpt_view = raindrops_warehouse_clone( 'raindrops_allow_oembed_excerpt_view' );

		$raindrops_excerpt_length = raindrops_warehouse_clone( 'raindrops_excerpt_length' );

		if ( isset( $post ) ) {

			$raindrops_skip_excerpt = apply_filters( 'raindrops_skip_excerpt', false, $post->ID );
		} else {

			$raindrops_skip_excerpt = false;
		}

		if ( has_excerpt() && ! is_singular() && ! is_search() ) {
			/* @1.466 */
			the_excerpt();

		} else {

			if ( ( true == $raindrops_excerpt_condition && !is_sticky() && 'no' == $raindrops_excerpt_enable &&
			!preg_match( '!\[raindrops skip-excerpt\]!', $post->post_content ) ) && false == $raindrops_skip_excerpt ) {

				if ( !has_post_format() || 'no' == $raindrops_allow_oembed_excerpt_view && has_post_format( 'video' ) || false == $raindrops_change_html_excerpt_when_post_formats ) {

					$excerpt = get_the_excerpt();
					$excerpt = strip_shortcodes( $excerpt );
					$excerpt = wp_html_excerpt( $excerpt, $raindrops_excerpt_length, '...' );
					$excerpt = preg_replace( '!\[raindrops[^\]]+\]!', '', $excerpt );
					$excerpt = apply_filters( 'the_excerpt', $excerpt );
					$excerpt = apply_filters( 'raindrops_the_excerpt', $excerpt, __FUNCTION__ );

					echo apply_filters( 'raindrops_entry_content', $excerpt );
				} elseif ( isset( $post ) && true == $raindrops_change_html_excerpt_when_post_formats && true == $raindrops_excerpt_condition && has_post_format() ) {

					$content = get_the_content( $more_link_text, $stripteaser );
					$content = apply_filters( 'the_content', $content );
					$content = apply_filters( 'raindrops_the_excerpt', $content, __FUNCTION__ );
					echo raindrops_html_excerpt_with_elements( $content, $raindrops_excerpt_length, ' ...', true, true );
				}
			} else {

				$content = ''; // wp-includes/post-template.php:265 - Trying to get property of non-object

				if ( isset( $post ) ) {

					$content .= get_the_content( $more_link_text, $stripteaser );
				}

				$content = apply_filters( 'the_content', $content );
				$content = apply_filters( 'raindrops_entry_content', $content );
				$content = str_replace( ']]>', ']]&gt;', $content );
				/**
				 * @1.325
				 */
				if ( has_excerpt() && empty( $content ) && !wp_attachment_is_image( $post->ID ) ) {

					$content .= sprintf( '<div class="entry-content-fallback">%1$s</div>', get_the_excerpt() );
				}

				echo $content;
			}
		}
	}

}

if ( ! function_exists( 'raindrops_next_prev_links' ) ) {
	/**
	 *
	 * @global type $wp_query
	 * @global type $paged
	 * @param type $position
	 *  @since 0.980
	 */
	function raindrops_next_prev_links( $position = 'nav-above' ) {

		global $wp_query, $paged;

		$raindrops_old	 = $paged + 1;
		$raindrops_new	 = $paged - 1;
		$raindrops_old	 = raindrops_link_unique( $text			 = 'Next Page', $raindrops_old );
		$raindrops_new	 = raindrops_link_unique( $text			 = 'Next Page', $raindrops_new );

		if ( $wp_query->max_num_pages > 1 ) {

			$html	 = '<div id="%3$s" class="clearfix">' . "\n" . str_repeat( "\t", 8 ) . '<span class="nav-previous">%1$s</span><span class="nav-next">%2$s</span>' . "\n" . str_repeat( "\t", 7 ) . '</div>' . "\n";
			$html	 = sprintf( $html, get_next_posts_link( '<span class="meta-nav">&#8592;</span>' . $raindrops_old . esc_html__( ' Older posts', 'raindrops' ) ), get_previous_posts_link( '<span>' . $raindrops_new . esc_html__( 'Newer posts', 'raindrops' ) . '<span class="meta-nav">&#8594;</span></span>' ), $position );
			echo apply_filters( 'raindrops_next_prev_links', $html, $position );
		}
	}

}

add_filter( 'raindrops_next_prev_links', 'raindrops_the_pagenation', 10, 2 );

if ( ! function_exists( 'raindrops_the_pagenation' ) ) {
	/**
	 *
	 * @global type $raindrops_document_type
	 * @param type $html
	 * @param type $position
	 * @return type
	 */
	function raindrops_the_pagenation( $html, $position ) {
		global $raindrops_document_type;
		if ( function_exists( 'get_the_posts_pagination' ) && $position == 'nav-below' ) {

			if ( $raindrops_document_type == 'html5' ) {

				$result = str_replace( array( 'role="navigation"' ), array( '' ), get_the_posts_pagination() );
				return $result;
			} elseif ( $raindrops_document_type == 'xhtml' ) {
				$result	 = str_replace( array( 'role="navigation"' ), array( '' ), get_the_posts_pagination() );
				$result	 = str_replace( array( '<nav ', '</nav>', '&hellip;' ), array( '<div ', '</div>', '&#8230;' ), $result );

				return $result;
			} else {
				return $html;
			}
		}

		$html = raindrops_remove_empty_span( $html );
		return $html;
	}

}

if ( ! function_exists( 'raindrops_sidebar_menus' ) ) {

	function raindrops_sidebar_menus( $position = 'default' ) {
		/**
		 * @1.447 comment out
		 * Next version remobe this
		 *
		  if ( 'default' == $position ) {
		  echo '<li>';
		  the_widget( 'WP_Widget_Categories' );
		  echo '</li>';
		  } else {
		  echo '<li>';
		  the_widget( 'WP_Widget_Archives' );
		  echo '</li>';
		  } */
	}

}
if ( ! function_exists( 'raindrops_link_get' ) ) {

	/**
	 *
	 * @param type $text
	 * @return boolean
	 * @since 1.246
	 */
	function raindrops_link_get( $text = '' ) {
		/**
		 * @1.325
		 * remove ~ from regex
		 * for theme check plugin
		 */
		if ( preg_match_all( "/(https?:\/\/)([-_.!*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/iu", $text, $matches, PREG_SET_ORDER ) ) {

			return $matches;
		}
		return false;
	}

}
if ( ! function_exists( 'raindrops_replace_oembed_link_to_icon' ) ) {

	/**
	 *
	 * @param type $post_content
	 * @return type
	 * @since 1.246
	 */
	function raindrops_replace_oembed_link_to_icon( $post_content = '' ) {
		$replaced_content				 = $post_content;
		$link_removed_content			 = $post_content;
		$icon_html						 = '';
		$raindrops_post_content_links	 = raindrops_link_get( $post_content );

		if ( isset( $raindrops_post_content_links ) && !empty( $raindrops_post_content_links ) ) {

			foreach ( $raindrops_post_content_links[ 0 ] as $key => $uri ) {

				if ( $embed_result = wp_oembed_get( $uri ) ) {

					$css_class = parse_url( $uri );

					$css_class = str_replace( '.', '-', $css_class );

					if ( !isset( $css_class[ 'host' ] ) ) {

						continue;
					}
					if ( preg_match( '!wp-embedded-content!', $embed_result ) ) {

						continue;
					}

					$icon_html_1 = '<span class="oembed-content-icon ' . esc_attr( $css_class[ 'host' ] ) . '">Cloud</span>';
					$icon_html .= apply_filters( 'raindrops_replace_oembed_link_to_icon_icon', $icon_html_1 );

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


if ( ! function_exists( 'raindrops_transient_update' ) ) {
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

if ( ! function_exists( 'raindrops_recent_posts' ) ) {
	/**
	 *
	 * @param array $args
	 * @return html
	 * @since 1.246
	 */
	function raindrops_recent_posts( $args = array() ) {
		global $raindrops_bf_recent_posts_setting, $raindrops_use_transient;

		if ( false === ( $val = get_transient( __FUNCTION__ ) ) || get_transient( 'raindrops_bf_recent_posts_setting' ) !== md5( serialize( $raindrops_bf_recent_posts_setting ) ) ) {

			$result = raindrops_get_recent_posts( $args );

			if ( $raindrops_use_transient == true ) {

				set_transient( 'raindrops_bf_recent_posts_setting', md5( serialize( $raindrops_bf_recent_posts_setting ) ) );
				set_transient( __FUNCTION__, $result );
			}
			echo $result;
			return;
		}

		echo $val;
		if ( $raindrops_use_transient == false ) {
			delete_transient( 'raindrops_bf_recent_posts_setting' );
			delete_transient( __FUNCTION__ );
		}
	}

}

if ( ! function_exists( 'raindrops_category_posts' ) ) {
	/**
	 *
	 * @param array $args
	 * @return html
	 * @since 1.246
	 */
	function raindrops_category_posts( $args = array() ) {
		global $raindrops_bf_category_posts_setting, $raindrops_use_transient;

		if ( false === ( $val = get_transient( __FUNCTION__ ) ) || get_transient( 'raindrops_bf_category_posts_setting' ) !== md5( serialize( $raindrops_bf_category_posts_setting ) ) ) {

			$result = raindrops_get_category_posts( $args );

			if ( $raindrops_use_transient == true ) {
				set_transient( 'raindrops_bf_category_posts_setting', md5( serialize( $raindrops_bf_category_posts_setting ) ) );
				set_transient( __FUNCTION__, $result );
			}

			echo $result;
			return;
		}

		echo $val;
		if ( $raindrops_use_transient == false ) {

			delete_transient( 'raindrops_bf_category_posts_setting' );
			delete_transient( __FUNCTION__ );
		}
	}

}

if ( ! function_exists( 'raindrops_tag_posts' ) ) {

	/**
	 *
	 * @param array $args
	 * @return html
	 * @since 1.246
	 */
	function raindrops_tag_posts( $args = array() ) {
		global $raindrops_bf_tag_posts_setting, $raindrops_use_transient;
		if ( false === ( $val = get_transient( __FUNCTION__ ) ) || get_transient( 'raindrops_bf_tag_posts_setting' ) !== md5( serialize( $raindrops_bf_tag_posts_setting ) ) ) {

			$result = raindrops_get_tag_posts( $args );
			if ( $raindrops_use_transient == true ) {
				set_transient( 'raindrops_bf_tag_posts_setting', md5( serialize( $raindrops_bf_tag_posts_setting ) ) );
				set_transient( __FUNCTION__, $result );
			}
			echo $result;
			return;
		}

		echo $val;
		if ( $raindrops_use_transient == false ) {

			delete_transient( 'raindrops_bf_tag_posts_setting' );
			delete_transient( __FUNCTION__ );
		}
	}

}

if ( ! function_exists( 'raindrops_get_recent_posts' ) ) {
	/**
	 *
	 * @global type $raindrops_bf_recent_posts_setting
	 * @global type $post
	 * @global type $raindrops_base_font_size
	 * @global type $raindrops_link_unique_text
	 * @global type $template
	 * @param type $args
	 * @return type
	 */
	function raindrops_get_recent_posts( $args = array() ) {

		global $raindrops_bf_recent_posts_setting, $post, $raindrops_base_font_size, $raindrops_link_unique_text, $template;

		$raindrops_link_unique_text = raindrops_link_unique_text();

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
			'title'											 => esc_html__( 'Recent Post', 'raindrops' ),
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
			'raindrops_post_thumbnail'						 => true,
			'raindrops_recent_post_thumbnail_default_uri'	 => '',
			'raindrops_show_related_posts_line_clip'          => 'no',
		);
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

		if( is_numeric( $args['raindrops_show_related_posts_line_clip'] ) ) {

			$html	 = '<li class="%3$s">%10$s<%4$s id="post-%5$s-recentpost" %6$s style="%11$s"><div class="posted-on">
%7$s%8$s</div><h3 class="entry-title"><a href="%1$s" class="trancate" data-rows="'.absint( $args['raindrops_show_related_posts_line_clip'] ).'">%2$s</a></h3><div class="entry-content clearfix">%9$s</div></%4$s></li>';
		} else {

			$html	 = '<li class="%3$s">%10$s<%4$s id="post-%5$s-recentpost" %6$s style="%11$s"><div class="posted-on">
%7$s%8$s</div><h3 class="entry-title"><a href="%1$s"><span>%2$s</span></a></h3><div class="entry-content clearfix">%9$s</div></%4$s></li>';
		}
		$html	 = apply_filters( 'raindrops_recent_posts_li', $html );
		$results = wp_get_recent_posts( $args );

		$result	 = sprintf( '<h2 class="%2$s">%1$s</h2>', $title, 'title h2' );

		$result	 = apply_filters( 'raindrops_recent_posts_title', $result );

		$result .= sprintf( '<ul class="%1$s">', 'raindrops-recent-posts' );

		foreach ( $results as $key => $val ) {

			$classes		 = '';
			$article_margin	 = '';

			$archive_year	 = get_the_time( 'Y' , $val['ID'] );
			$archive_month	 = get_the_time( 'm' , $val['ID'] );
			$archive_day	 = get_the_time( 'd' , $val['ID'] );

			$raindrops_date_format	 = get_option( 'date_format' ) . ' ' . get_option( 'time_format' );
			$day_link				 = esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) . '#post-' . $val['ID'] );

			if ( array_key_exists( 'raindrops_post_thumbnail', $args ) &&
			true == $args[ "raindrops_post_thumbnail" ] && !post_password_required() ) {

				$thumbnail = '<span class="raindrops_recent_posts thumb">';

				if ( has_post_thumbnail( $val[ "ID" ] ) ) {
					if ( $raindrops_link_unique_text == false ) {
						$thumbnail .= '<a href="' . esc_url( get_permalink( $val[ "ID" ] ) ) . '">';
					}
					$thumbnail .= get_the_post_thumbnail( $val[ "ID" ], $thumbnail_size, array( "alt" => null ) );
					if ( $raindrops_link_unique_text == false ) {
						$thumbnail .= '</a>';
					}
				} elseif ( !empty( $raindrops_recent_post_thumbnail_default_uri ) ) {
					if ( $raindrops_link_unique_text == false ) {
						$thumbnail .= '<a href="' . esc_url( get_permalink( $val[ "ID" ] ) ) . '">';
					}
					$thumbnail .= '<img src="' . apply_filters( 'raindrops_recent_post_thumbnail_default_uri', $raindrops_recent_post_thumbnail_default_uri ) . '" width="' . $thumbnail_width . '" height="' . $thumbnail_height . '" alt="" />';
					if ( $raindrops_link_unique_text == false ) {
						$thumbnail .= '</a>';
					}
				}


				$thumbnail .= '</span>';
			} else {
				$thumbnail = '';
			}
			$post_content = strip_shortcodes( $val[ "post_content" ] );

			$oembed_replace_array	 = raindrops_replace_oembed_link_to_icon( $post_content );
			$oembed_flag			 = $oembed_replace_array[ 'icon_html' ];
			$post_content			 = $oembed_replace_array[ 'link_removed_content' ];

			$author = get_the_author_meta( 'display_name', $val[ "post_author" ] );

			$list_num_class = 'recent-' . $val[ 'ID' ];

			$raindrops_now			 = (int) current_time( 'timestamp' );
			$raindrops_publish_time	 = (int) strtotime( $val[ "post_date" ] );
			$raindrops_period		 = apply_filters( 'raindrops_new_period', 3 );
			$raindrops_Period		 = (int) 60 * 60 * 24 * $raindrops_period;


			if ( $raindrops_now < $raindrops_Period + $raindrops_publish_time ) {

				$classes = array( 'raindrops-pub-new ' );
				$classes = get_post_class( $classes, $val[ 'ID' ] );
			} else {

				$classes = get_post_class( '', $val[ 'ID' ] );
			}

			$classes = 'class="' . join( ' ', $classes ) . '"';

			if ( function_exists('raindrops_japan_date') ) {

				$date_strings = esc_html( raindrops_japan_date( get_the_date($raindrops_date_format, $val['ID']) ) );
			} else {

				$date_strings = esc_html( get_the_date(), $val['ID'] ) ;
			}

			$result .= sprintf( $html,
			esc_url( get_permalink( $val[ 'ID' ] ) ),
			$val[ 'post_title' ],
			$list_num_class,
			raindrops_doctype_elements( 'div', 'article', false ),
			$val[ 'ID' ],
			$classes,
			sprintf( '<a href="%1$s" title="%2$s"><%4$s class="entry-date" %5$s>%3$s</%4$s></a>&nbsp;',
				$day_link,
				esc_attr( 'archives daily ' . mysql2date( $val[ "post_date" ], 	$raindrops_date_format ) ),
				$date_strings,
				raindrops_doctype_elements( 'span', 'time', false ),
				raindrops_doctype_elements( '', 'datetime="' . esc_attr( get_the_date( 'c' ) ) . '"', false )
			),
			sprintf( '<span class="author vcard"><a class="url fn nickname" href="%1$s" title="%2$s">%3$s</a></span> ',
			/* translators: 1: author name. ( display name ) */
			get_author_posts_url( $val[ "post_author" ] ), sprintf( esc_attr__( 'View all posts by %s', 'raindrops' ), $author ), $author
			), wp_html_excerpt( $post_content, $raindrops_excerpt_length, $raindrops_excerpt_more ) . $oembed_flag, $thumbnail, $article_margin
			);
		}

		$result .= sprintf( '</ul>' );
		$result = sprintf( '<div id="%3$s" class="%1$s">%2$s</div>', 'clearfix', $result, 'raindrops-recent-posts' );
		return apply_filters( 'raindrops_recent_posts', $result );
	}

}

if ( ! function_exists( 'raindrops_get_category_posts' ) ) {
	/**
	 *
	 * @global type $post
	 * @global type $raindrops_bf_category_posts_setting
	 * @global type $template
	 * @global type $raindrops_link_unique_text
	 * @param type $args
	 * @return type
	 */
	function raindrops_get_category_posts( $args = '' ) {

		global $post, $raindrops_bf_category_posts_setting, $template, $raindrops_link_unique_text;

		$raindrops_link_unique_text = raindrops_link_unique_text();

		if ( empty( $args ) ) {

			if ( !isset( $raindrops_bf_category_posts_setting ) && basename( $template ) == 'blank-front.php' ) {

				return;
			}
		} else {

			$raindrops_bf_category_posts_setting = wp_parse_args( $args, $raindrops_bf_category_posts_setting );
		}

		$thumbnail_size = apply_filters( 'raindrops_category_posts_thumb_size', array( 125, 125 ) );

		$article_margin = 0;

		$thumbnail_width	 = (int) $thumbnail_size[ 0 ];
		$thumbnail_height	 = (int) $thumbnail_size[ 0 ];

		$html			 = '<li class="%3$s">%10$s<%4$s id="post-%5$s-catpost" %6$s style="%11$s"><div class="posted-on">
%7$s%8$s</div><h3 class="entry-title"><a href="%1$s"><span>%2$s</span></a></h3><div class="entry-content clearfix">%9$s</div></%4$s></li>';

		$settings				 = array( 'title'											 => esc_html__( 'Categories', 'raindrops' ),
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
			'raindrops_category_post_thumbnail_default_uri'	 => '',
			'raindrops_show_related_posts_line_clip'          => 'no',
			);
		$settings				 = wp_parse_args( $raindrops_bf_category_posts_setting, $settings );

		if ( is_numeric( $settings['raindrops_show_related_posts_line_clip'] ) ) {
			$html			 = '<li class="%3$s">%10$s<%4$s id="post-%5$s-catpost" %6$s style="%11$s"><div class="posted-on">
%7$s%8$s</div><h3 class="entry-title"><a href="%1$s" class="trancate" data-rows="'.absint( $settings['raindrops_show_related_posts_line_clip'] ).'">%2$s</a></h3><div class="entry-content clearfix">%9$s</div></%4$s></li>';
		}

		$title = $settings[ 'title' ];
		unset( $settings[ 'title' ] );

		$result = '';
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

		$posts = get_posts( $settings );

		if ( $posts ) {

			$result = sprintf( '<h2 class="%2$s">%1$s</h2>', $title, 'title h2' );
			$result .= sprintf( '<ul class="list">' );

			foreach ( $posts as $post ) {
				setup_postdata( $post );
				$classes		 = '';
				$article_margin	 = '';

				$archive_year	 = get_the_time( 'Y' );
				$archive_month	 = get_the_time( 'm' );
				$archive_day	 = get_the_time( 'd' );

				$raindrops_date_format	 = get_option( 'date_format' ) . ' ' . get_option( 'time_format' );
				$day_link				 = esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) . '#post-' . $post->ID );

				if ( array_key_exists( 'raindrops_post_thumbnail', $settings ) &&
				true == $settings[ "raindrops_post_thumbnail" ] &&
				!post_password_required() ) {

					$thumbnail = '<span class="raindrops_category_posts thumb">';

					if ( has_post_thumbnail( $post->ID ) ) {

						if ( $raindrops_link_unique_text == false ) {

							$thumbnail .= '<a href="' . esc_html( get_permalink( $post->ID ) ) . '">';
						}

						$thumbnail .= get_the_post_thumbnail( $post->ID, $thumbnail_size, array( "alt" => null ) );
						if ( $raindrops_link_unique_text == false ) {

							$thumbnail .= '</a>';
						}
					} elseif ( !empty( $raindrops_category_post_thumbnail_default_uri ) ) {

						if ( $raindrops_link_unique_text == false ) {

							$thumbnail .= '<a href="' . esc_url( get_permalink( $post->ID ) ) . '">';
						}
						$thumbnail .= '<img src="' . apply_filters( 'raindrops_category_post_thumbnail_default_uri', $raindrops_category_post_thumbnail_default_uri ) . '" width="' . $thumbnail_width . '" height="' . $thumbnail_height . '" alt="" />';

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
				$list_num_class			 = 'cat-' . $post->ID;
				$raindrops_now			 = (int) current_time( 'timestamp' );
				$raindrops_publish_time	 = (int) strtotime( get_the_date() );
				$raindrops_period		 = apply_filters( 'raindrops_new_period', 3 );
				$raindrops_Period		 = (int) 60 * 60 * 24 * $raindrops_period;

				if ( $raindrops_now < $raindrops_Period + $raindrops_publish_time ) {

					$classes = array( 'raindrops-pub-new ' );
					$classes = get_post_class( $classes, $post->ID );
				} else {

					$classes = get_post_class( '', $post->ID );
				}

				if ( function_exists('raindrops_japan_date') ) {

					$date_strings = esc_html( raindrops_japan_date( get_the_date() ) );
				} else {

					$date_strings = esc_html( get_the_date() ) ;
				}
				$classes = 'class="' . join( ' ', $classes ) . '"';
				$result .= sprintf( $html,
					esc_url( get_permalink( $post->ID ) ),
					get_the_title(),
					$list_num_class,
					raindrops_doctype_elements( 'div', 'article', false ),
					$post->ID,
					$classes,
					sprintf( '<a href="%1$s" title="%2$s"><%4$s class="entry-date" %5$s>%3$s</%4$s></a>&nbsp;',
						$day_link,
						esc_attr( 'archives daily ' . mysql2date( get_the_date(), $raindrops_date_format ) ),
						esc_html( $date_strings ),
						raindrops_doctype_elements( 'span', 'time', false ),
						raindrops_doctype_elements( '', 'datetime="' . esc_attr( get_the_date( 'c' ) ) . '"', false )
				), sprintf( '<span class="author vcard"><a class="url fn nickname" href="%1$s" title="%2$s">%3$s</a></span> ', get_author_posts_url( get_the_author() ),
					/* translators: 1: author name */
					sprintf( esc_attr__( 'View all posts by %s', 'raindrops' ), get_the_author() ), get_the_author()
				), wp_html_excerpt( $post_content, $raindrops_excerpt_length, $raindrops_excerpt_more ) . $oembed_flag, $thumbnail, $article_margin
				);
			}
			$result .= sprintf( '</ul>' );
		}

		$result = sprintf( '<div class="%1$s">%2$s</div>', 'raindrops-category-posts clearfix', $result );
		wp_reset_postdata();
		return apply_filters( 'raindrops_category_posts', $result );
	}

}

if ( ! function_exists( 'raindrops_get_tag_posts' ) ) {
	/**
	 *
	 * @global type $post
	 * @global type $raindrops_bf_tag_posts_setting
	 * @global type $raindrops_link_unique_text
	 * @global type $template
	 * @param type $args
	 * @return type
	 */
	function raindrops_get_tag_posts( $args = '' ) {

		global $post, $raindrops_bf_tag_posts_setting, $raindrops_link_unique_text, $template;

		$raindrops_link_unique_text = raindrops_link_unique_text();

		if ( empty( $args ) ) {

			if ( !isset( $raindrops_bf_tag_posts_setting ) && basename( $template ) == 'blank-front.php' ) {

				return;
			}
		} else {

			$raindrops_bf_tag_posts_setting = wp_parse_args( $args, $raindrops_bf_tag_posts_setting );
		}
		$result					 = '';
		$thumbnail_size			 = apply_filters( 'raindrops_tag_posts_thumb_size', array( 125, 125 ) );
		$article_margin			 = 0;
		$thumbnail_width		 = (int) $thumbnail_size[ 0 ];
		$thumbnail_height		 = (int) $thumbnail_size[ 0 ];
		$html					 = '<li class="%3$s">%10$s<%4$s id="post-%5$s-tagpost" %6$s style="%11$s"><div class="posted-on">
%7$s%8$s</div><h3 class="entry-title"><a href="%1$s"><span>%2$s</span></a></h3><div class="entry-content clearfix">%9$s</div></%4$s></li>';

		$settings				 = array(
			'title'										 => esc_html__( 'Tags', 'raindrops' ),
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
			'raindrops_tag_post_thumbnail_default_uri'	 => '',
			'raindrops_show_related_posts_line_clip'          => 'no',
		);
		$settings				 = wp_parse_args( $raindrops_bf_tag_posts_setting, $settings );
		$title					 = $settings[ 'title' ];
		unset( $settings[ 'title' ] );

		if ( is_numeric( $settings['raindrops_show_related_posts_line_clip'] ) ) {
			$html					 = '<li class="%3$s">%10$s<%4$s id="post-%5$s-tagpost" %6$s style="%11$s"><div class="posted-on">
%7$s%8$s</div><h3 class="entry-title"><a href="%1$s" class="trancate" data-rows="'.absint($settings['raindrops_show_related_posts_line_clip'] ).'">%2$s</a></h3><div class="entry-content clearfix">%9$s</div></%4$s></li>';
		}


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

			$result .= sprintf( '<h2 class="%2$s">%1$s</h2>', $title, 'title h2' );
			$result .= sprintf( '<ul class="%1$s">', 'list' );

			foreach ( $posts as $post ) {
				setup_postdata( $post );
				$classes		 = '';
				$article_margin	 = '';

				$archive_year			 = get_the_time( 'Y' );
				$archive_month			 = get_the_time( 'm' );
				$archive_day			 = get_the_time( 'd' );
				$raindrops_date_format	 = get_option( 'date_format' ) . ' ' . get_option( 'time_format' );
				$day_link				 = esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) . '#post-' . $post->ID );


				if ( array_key_exists( 'raindrops_post_thumbnail', $settings ) &&
				true == $settings[ "raindrops_post_thumbnail" ] &&
				!post_password_required() ) {

					$thumbnail = '<span class="raindrops_tag_posts thumb">';

					if ( has_post_thumbnail( $post->ID ) ) {

						if ( $raindrops_link_unique_text == false ) {

							$thumbnail .= '<a href="' . esc_url( get_permalink( $post->ID ) ) . '">';
						}

						$thumbnail .= get_the_post_thumbnail( $post->ID, $thumbnail_size, array( "alt" => null ) );

						if ( $raindrops_link_unique_text == false ) {

							$thumbnail .= '</a>';
						}
					} elseif ( !empty( $raindrops_tag_post_thumbnail_default_uri ) ) {
						if ( $raindrops_link_unique_text == false ) {

							$thumbnail .= '<a href="' . esc_url( get_permalink( $post->ID ) ) . '">';
						}

						$thumbnail .= '<img src="' . apply_filters( 'raindrops_tag_post_thumbnail_default_uri', $raindrops_tag_post_thumbnail_default_uri ) . '" width="' . $thumbnail_width . '" height="' . $thumbnail_height . '" alt="" />';

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
				$list_num_class			 = 'tag-' . $post->ID;
				$raindrops_now			 = (int) current_time( 'timestamp' );
				$raindrops_publish_time	 = (int) strtotime( get_the_date() );
				$raindrops_period		 = apply_filters( 'raindrops_new_period', 3 );
				$raindrops_Period		 = (int) 60 * 60 * 24 * $raindrops_period;

				if ( $raindrops_now < $raindrops_Period + $raindrops_publish_time ) {

					$classes = array( 'raindrops-pub-new ' );
					$classes = get_post_class( $classes, $post->ID );
				} else {

					$classes = get_post_class( '', $post->ID );
				}

				$classes = 'class="' . join( ' ', $classes ) . '"';

				if ( function_exists('raindrops_japan_date') ) {

					$date_strings = esc_html( raindrops_japan_date( get_the_date() ) );
				} else {

					$date_strings = esc_html( get_the_date() ) ;
				}

				$result .= sprintf( $html,
				esc_url( get_permalink( $post->ID ) ),
				get_the_title(),
				$list_num_class,
				raindrops_doctype_elements( 'div', 'article', false ),
				$post->ID, $classes,
				sprintf( '<a href="%1$s" title="%2$s"><%4$s class="entry-date" %5$s>%3$s</%4$s></a>&nbsp;',
					$day_link,
					esc_attr( 'archives daily ' . mysql2date( get_the_date(), $raindrops_date_format ) ),
					esc_html( $date_strings ),
					raindrops_doctype_elements( 'span', 'time', false ),
					raindrops_doctype_elements( '', 'datetime="' . esc_attr( get_the_date( 'c' ) ) . '"', false )
				), sprintf( '<span class="author vcard"><a class="url fn nickname" href="%1$s" title="%2$s">%3$s</a></span> ',
				get_author_posts_url( get_the_author() ),
				/* translators: 1: author name */
				sprintf( esc_attr__( 'View all posts by %s', 'raindrops' ), get_the_author() ), get_the_author()
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

if ( ! function_exists( 'raindrops_monthly_archive_prev_next_navigation' ) ) {
	/**
	 *
	 * @global type $wpdb
	 * @global type $wp_query
	 * @global type $wp_locale
	 * @param type $echo
	 * @param type $show_year
	 * @return type
	 */
	function raindrops_monthly_archive_prev_next_navigation( $echo = true, $show_year = false ) {

		global $wpdb, $wp_query, $wp_locale;

		if ( !is_singular() && !is_404() ) {

			if ( !isset( $wp_query->posts[ 0 ]->post_date ) || !isset( $wp_query->posts[ 0 ]->post_date ) ) {
				return;
			}

			$post_type	 = get_post_type( get_the_ID() );
			$post_query	 = 'post';
			if ( is_post_type_archive( $post_type ) ) {

				$post_type_object			 = get_post_type_object( $post_type );
				$post_type_title			 = esc_html( apply_filters( 'raindrops_post_type_day_archive_title', $post_type_object->label ) );
				$post_type_title_separator	 = esc_html( apply_filters( 'raindrops_post_type_day_archive_title_separator', ' : ' ) );
				$post_query					 = $post_type;
			}


			$thisyear		 = mysql2date( 'Y', $wp_query->posts[ 0 ]->post_date );
			$thismonth		 = mysql2date( 'm', $wp_query->posts[ 0 ]->post_date );
			$unixmonth		 = mktime( 0, 0, 0, $thismonth, 1, $thisyear );
			$last_day		 = date( 't', $unixmonth );
			$calendar_output = '';

			$previous	 = $wpdb->get_row( "SELECT MONTH(post_date) AS month, YEAR(post_date) AS year
FROM $wpdb->posts
WHERE post_date < '$thisyear-$thismonth-01'
AND post_type = '$post_query' AND post_status = 'publish'
ORDER BY post_date DESC
LIMIT 1" );
			$next		 = $wpdb->get_row( "SELECT MONTH(post_date) AS month, YEAR(post_date) AS year
FROM $wpdb->posts
WHERE post_date > '$thisyear-$thismonth-{$last_day} 23:59:59'
AND post_type = '$post_query' AND post_status = 'publish'
ORDER BY post_date ASC
LIMIT 1" );

			$html = '<a href="%1$s" class="%3$s">%2$s</a>';

			if ( $previous ) {

				$previous_label = $wp_locale->get_month( $previous->month );

				$calendar_output = sprintf( $html, get_month_link( $previous->year, $previous->month ),
				/* translators: 1: previous month name */
				sprintf( esc_html__( '&#171; %s ', 'raindrops' ), $previous_label ), 'alignleft' );
			}
			$calendar_output .= "\t";

			if ( true == $show_year ) {
				// @since 1.491 add mktime()
				$year_label = apply_filters( 'raindrops_archive_year_label', esc_html( $thisyear ), mktime( 0, 0, 0, $thismonth, 1, $thisyear ) );
				$calendar_output .= '<span class="year">' . $year_label . '</span>';
			}

			if ( $next ) {
				$next_label = $wp_locale->get_month( $next->month );

				$calendar_output .= sprintf( $html, get_month_link( $next->year, $next->month ),
				/* translators: 1: next month name */
				sprintf( esc_html__( ' %s &#187;', 'raindrops' ), $next_label ), 'alignright' );
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

if ( ! function_exists( 'raindrops_customize_controls_print_styles' ) ) {
	/**
	 *
	 * @global type $raindrops_current_data_version
	 */
	function raindrops_customize_controls_print_styles() {

		global $raindrops_current_data_version;
		?>
	<style <?php raindrops_doctype_elements( ' type="text/css" ', '');?> id="raindrops-customizer-1">
		.accordion-section label{
			display:inline-block!important;
			margin-right:1em;
		}
		#customize-control-raindrops_theme_settings-raindrops_style_type label,/* new */
		#customize-control-raindrops_style_type label{
			width:220px;
			display:inline-block!important;
			margin-right:1em;
		}
		.wp-customizer .theme-browser .theme{
			width: calc(100% - 1em);
			padding-top:1em;
			border:none;
		}
		.wp-customizer .theme-browser .theme-screenshot{
			border:1px solid #eee;
		}
		.customize-control .customize-inside-control-row{
			/* Wordpress 4.9 */
			display:inline-block;
		}
		#customize-control-raindrops_style_type .customize-inside-control-row label[for$="dark"],
		#customize-control-raindrops_theme_settings-raindrops_style_type .customize-inside-control-row label[for$="dark"] ,/* Wordpress 4.9 */
		#customize-control-raindrops_theme_settings-raindrops_style_type .customize-control-notifications-container +label ,/* Wordpress 4.6 */
		#customize-control-raindrops_style_type .customize-control-notifications-container + label,
		#customize-control-raindrops_theme_settings-raindrops_style_type .customize-control-title +label ,/* Wordpress 4.5 */
		#customize-control-raindrops_style_type .customize-control-title + label{

			background:url( <?php echo get_template_directory_uri() . '/images/screen-shot-dark.png'; ?> );
			height:200px;
			display:block;
			background-position:0px 40px;
			background-repeat:no-repeat;
			background-size:contain;
		}
		#customize-control-raindrops_style_type .customize-inside-control-row label[for$="w3standard"] ,/* Wordpress 4.9 */
		#customize-control-raindrops_theme_settings-raindrops_style_type .customize-inside-control-row label[for$="w3standard"] ,/* Wordpress 4.9 */
		#customize-control-raindrops_theme_settings-raindrops_style_type .customize-control-notifications-container +label + label,/* Wordpress 4.6 */
		#customize-control-raindrops_style_type .customize-control-notifications-container  + label + label,
		#customize-control-raindrops_theme_settings-raindrops_style_type .customize-control-title +label + label,/* Wordpress 4.5 */
		#customize-control-raindrops_style_type .customize-control-title  + label + label{

			background:url( <?php echo get_template_directory_uri() . '/images/screen-shot-w3standard.png'; ?> );
			height:200px;
			display:block;
			background-position:0px 40px;
			background-repeat:no-repeat;
			background-size:contain;
		}
		#customize-control-raindrops_style_type .customize-inside-control-row label[for$="light"] ,/* Wordpress 4.9 */
		#customize-control-raindrops_theme_settings-raindrops_style_type .customize-inside-control-row label[for$="light"] ,/* Wordpress 4.9 */
		#customize-control-raindrops_theme_settings-raindrops_style_type .customize-control-notifications-container +label + label + label,/* Wordpress 4.6 */
		#customize-control-raindrops_style_type .customize-control-notifications-container  + label +label + label,
		#customize-control-raindrops_theme_settings-raindrops_style_type .customize-control-title +label + label + label,/* Wordpress 4.5 */
		#customize-control-raindrops_style_type .customize-control-title  + label +label + label{

			background:url( <?php echo get_template_directory_uri() . '/images/screen-shot-light.png'; ?> );
			height:200px;
			display:block;
			background-position:0px 40px;
			background-repeat:no-repeat;
			background-size:contain;
		}
		#customize-control-raindrops_style_type .customize-inside-control-row label[for$="minimal"] ,/* Wordpress 4.9 */
		#customize-control-raindrops_theme_settings-raindrops_style_type .customize-inside-control-row label[for$="minimal"] ,/* Wordpress 4.9 */
		#customize-control-raindrops_theme_settings-raindrops_style_type .customize-control-notifications-container +label + label + label + label,/* Wordpress 4.6 */
		#customize-control-raindrops_style_type .customize-control-notifications-container  + label +label + label + label,
		#customize-control-raindrops_theme_settings-raindrops_style_type .customize-control-title +label + label + label + label,/* Wordpress 4.5 */
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
			#customize-control-raindrops_style_type span.customize-inside-control-row:nth-of-type(6) label ,/* Wordpress 4.9 */
			#customize-control-raindrops_theme_settings-raindrops_style_type span.customize-inside-control-row:nth-of-type(6) label ,/* Wordpress 4.9 */
			#customize-control-raindrops_theme_settings-raindrops_style_type .customize-control-notifications-container +label + label + label + label + label,/* Wordpress 4.6 */
			#customize-control-raindrops_style_type .customize-control-notifications-container  + label +label + label + label + label,
			#customize-control-raindrops_theme_settings-raindrops_style_type .customize-control-title +label + label + label + label + label,/* Wordpress 4.5 */
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

		<?php } ?>
		#customize-control-raindrops_theme_settings-raindrops_use_featured_image_emphasis,
		#customize-control-raindrops_use_featured_image_emphasis{
			background:rgba(0,128,128,.3);
			padding:1em;
			box-sizing:border-box;
		}
	</style>
<?php
	}

}

if ( ! function_exists( 'raindrops_mobile_meta' ) ) {
	/**
	 * @since: 0.992
	 */
	function raindrops_mobile_meta() {
	/* 1.213 remove wp_is_mobile() && works improperly ? */
		if ( 'doc3' == raindrops_warehouse( 'raindrops_page_width' ) || 'doc5' == raindrops_warehouse( 'raindrops_page_width' ) ) {
		?><meta name="viewport" content="width=device-width, initial-scale=1" id="raindrops-viewport" />
			<meta name="apple-mobile-web-app-capable" content="yes" />
			<meta name="apple-mobile-web-app-status-bar-style" content="default" />
			<?php
		}
	}

}

if ( ! function_exists( 'raindrops_dinamic_class' ) ) {
	/**
	 *
	 * @global type $rsidebar_show
	 * @global type $raindrops_keep_content_width
	 * @global type $raindrops_current_column
	 * @global type $template
	 * @param type $id
	 * @param type $echo
	 * @return type
	 * @since 0.999
	 */
	function raindrops_dinamic_class( $id = 'yui-u first', $echo = false ) {

		global $rsidebar_show, $raindrops_keep_content_width, $raindrops_current_column, $template;

		$template_name = basename( $template, '.php' );

		$class = '';

		if ( 'yui-u first' == $id ) {

			if ( 3 == $raindrops_current_column ) {

				$class = $id;
			} elseif ( 1 == $raindrops_current_column ) {

				$class = $id . ' raindrops-expand-width';
			} elseif ( $raindrops_current_column == 2 ) {

				$class = $id . ' raindrops-expand-width';
			} elseif ( false == $raindrops_current_column ) {

				$check = raindrops_is_2col( 'not-add-class', false );

				if ( false == $check ) {

					$class = $id;
				} elseif ( 'not-add-class' == $check ) {

					$class = $id . ' raindrops-expand-width';
				} else {

					$class = $id;
				}
			}
		}

		if ( 'yui-b' == $id ) {

			if ( 1 == $raindrops_current_column ) {

				$class = $id . " raindrops-expand-width raindrops-margin-left-none";
			} else {

				$class = $id;
			}
		}

		if ( 'yui-main' == $id ) {

			$raindrops_content_width_setting = raindrops_warehouse_clone( 'raindrops_content_width_setting' );

			if ( 'full-width' == $template_name ) {

				if ( 'keep' == $raindrops_content_width_setting ) {

					$class = $id . " raindrops-keep-content-width";
				} elseif ( 'fit' == $raindrops_content_width_setting ) {

					$class = $id . " raindrops-no-keep-content-width";
				} else {
					$class = $id;
				}
			} else {

				if ( 1 == $raindrops_current_column && 'keep' == $raindrops_content_width_setting ) {

					$class = $id . " raindrops-keep-content-width";
				} elseif ( 1 == $raindrops_current_column && 'fit' == $raindrops_content_width_setting ) {

					$class = $id . " raindrops-no-keep-content-width";
				} else {

					if ( 1 == $raindrops_current_column && true == $raindrops_keep_content_width ) {

						$class = $id . " raindrops-keep-content-width";
					} elseif ( 1 == $raindrops_current_column && false == $raindrops_keep_content_width ) {
						/**
						 * @since1.442
						 */
						$class = $id . " raindrops-no-keep-content-width";
					} else {
						$class = $id;
					}
				}
			}
		}

		if ( false !== $echo ) {

			if ( !empty( $class ) ) {

				echo $class;
			}
		} else {

			if ( !empty( $class ) ) {

				return $class;
			} else {

				return;
			}
		}
	}

}

if ( ! function_exists( 'raindrops_debug_navitation' ) ) {
	/**
	 *
	 * @param type $template
	 */
	function raindrops_debug_navitation( $template ) {

		if ( true == WP_DEBUG ) {
			do_action( 'raindrops_debug_navitation' );
			echo '<!-- Template[' . basename( $template ) . '] Theme[' . basename( dirname( __FILE__ ) ) . '] -->';
		}
	}

}

if ( ! function_exists( 'raindrops_doctype_elements' ) ) {
	/**
	 *
	 */
	function raindrops_doctype_elements( $xhtml, $html5, $echo = true ) {

		global $raindrops_document_type;

		if ( true == $echo ) {

			echo ${$raindrops_document_type};
		} else {

			return ${$raindrops_document_type};
		}
	}

}

if ( ! function_exists( 'raindrops_img_caption_shortcode_filter' ) ) {
	/**
	 * Switch elements from div to figure when doctype html5
	 * @global type $raindrops_document_type
	 * @param type $val
	 * @param type $attr
	 * @param type $content
	 * @return type
	 * @since 1.003
	 */
	function raindrops_img_caption_shortcode_filter( $val, $attr, $content = null ) {

		global $raindrops_document_type;

		extract( shortcode_atts( array( 'id' => '', 'align' => '', 'width' => '', 'caption' => '', 'class' => '' ), $attr ) );

		if ( empty( $caption ) ) {

				return $val;
		}

		if ( 'html5' == $raindrops_document_type ) {

			$id				 = esc_attr( $id );
			$align			 = esc_attr( $align );
			$width			 = apply_filters( 'img_caption_shortcode_width', $width, $attr, $content );
			$attributes		 = apply_filters( 'raindrops_caption_shortcode_attribute', '', $attr, $content );
			/**
			 * raindrops_caption_shortcode_attribute filter
			 * must array('data-title'=>'value') key and value pair
			 */
			$width				 = absint( $width );
			$sanitized_class	 = '';
			$capid				 = '';
			$sanitized_attribute = '';
			$attribute			 = '';

			if ( ! empty( $attributes ) && is_array( $attributes ) ) {

				foreach ( $attributes as $attr_name => $attr_value ) {

					$sanitized_attribute .= sprintf('%1$s="%2$s"', esc_attr( $attr_name ), esc_attr( $attr_value ) );
				}
				$attribute = trim( $sanitized_attribute );
			}

			if ( ! empty( $class ) || ! empty( $align ) ) {

				if( ! empty( $align ) ) {

					$class = $align . ' '. $class;
				}

				$pos			 = strpos( $class, ' ' );

				if ( false === $pos ) {

					$class = sanitize_html_class( $class );
				} else {

					$classes = explode( ' ', $class );

					foreach ( $classes as $cls ) {

						$sanitized_class .= ' ' . sanitize_html_class( $cls );
					}
				}
				$class = $sanitized_class;
			}

			if ( ! empty( $id ) ) {

				$capid	 = 'id="' . esc_attr( 'figcaption_' . $id ) . '" ';
				$id		 = 'id="' . esc_attr( $id ) . '" aria-labelledby="' . esc_attr( 'figcaption_' . $id ) . '" ';
			}

			if ( empty( $width ) ) {

				$class .= ' ' . 'js-figure-fit';

				$html = '<figure %1$s class="wp-caption %2$s" %6$s>%3$s<figcaption %4$s class="wp-caption-text" style="flex:0 1 auto">%5$s</figcaption></figure>';
				return sprintf( $html, $id, trim($class), do_shortcode( $content ), $capid, $caption, $attribute );
			}

			$html = '<figure %1$s class="wp-caption %2$s" %6$s >%3$s<figcaption %4$s class="wp-caption-text">%5$s</figcaption></figure>';
			return sprintf( $html, $id, trim($class), do_shortcode( $content ), $capid, $caption, $attribute );
		}

		return $val;
	}
}

if ( ! function_exists( 'raindrops_featured_image' ) ) {
	/**
	 *
	 * @global type $post
	 * @global type $is_IE
	 * @global type $raindrops_featured_image_full_size
	 * @global type $raindrops_use_featured_image_light_box
	 * @return type
	 * @since 1.002
	 */
	function raindrops_featured_image() {

		global $post, $is_IE, $raindrops_featured_image_full_size, $raindrops_use_featured_image_light_box;

		$raindrops_featured_image_enable = apply_filters( 'raindrops_featured_image_enable', true );

		if ( is_single() && "hide" == raindrops_warehouse_clone( 'raindrops_featured_image_singular' ) ) {
			$raindrops_featured_image_enable = false;
		}

		if ( post_password_required() || !has_post_thumbnail() || false == $raindrops_featured_image_enable ) {

			return;
		}
		/**
		 * Show featured image
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

					printf( '<a href="%1$s">', esc_url( get_attachment_link( get_post_thumbnail_id() ) ) );
				}
				echo $thumb;

				echo '</a>';
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
		 */
		if ( has_post_thumbnail() && true == $raindrops_use_featured_image_light_box ) {

			$raindrops_html_piece = '<p class="raindrops-use-featured-image-light-box"><a href="%1$s">%2$s</a></p>';
			printf( $raindrops_html_piece, esc_url( get_attachment_link( get_post_thumbnail_id() ) ), esc_html__( 'Go to Attachment page', 'raindrops' ) );
		}
	}

}

if ( ! function_exists( 'raindrops_loop_class' ) ) {
	/**
	 *
	 * @global type $template
	 * @param int $raindrops_loop_number
	 * @param type $raindrops_tile_post_id
	 * @param type $add_class
	 * @return type
	 * @since 1.001
	 */
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



		if ( 12 == $raindrops_loop_number ) {

			$raindrops_loop_number = 0;
		} elseif ( 0 == $raindrops_loop_number % 5 ) {

			$raindrops_loop_five .= ' loop-five';
		}

		if ( !empty( $raindrops_tile_post_id ) ) {

			$post_thumbnail_id		 = get_post_thumbnail_id( $raindrops_tile_post_id );
			$raindrops_background	 = wp_get_attachment_image_src( $post_thumbnail_id, 'large' );

			list( $raindrops_background, $width, $height ) = $raindrops_background;
		} else {
			$raindrops_background = false;
		}

		if ( !$raindrops_background ) {

			$raindrops_loop_five .= ' loop-item-show-allways';
		} else {

			$raindrops_background = 'style="background:rgba(127,127,127,.2) url(  ' . $raindrops_background . '  );background-size:contain;    background-repeat:no-repeat;"';
		}

		return array( $raindrops_loop_number, $raindrops_loop_five, $raindrops_background );
	}

}

add_action( 'set_current_user', 'raindrops_postmeta_cap' );

if ( ! function_exists( 'raindrops_postmeta_cap' ) ) {
	/**
	 * @since 1.103
	 */
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

if ( !class_exists( 'raindrops_unique_identifier_walker_nav_menu' ) ) {
	/**
	 * @since 1.111
	 */
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

if ( ! function_exists( 'raindrops_nav_menu_primary' ) ) {
	/**
	 *
	 * @global type $raindrops_link_unique_text
	 * @global type $post
	 * @param type $args
	 */
	function raindrops_nav_menu_primary( $args = array() ) {
		global $raindrops_link_unique_text, $post;

		$raindrops_link_unique_text = raindrops_link_unique_text();

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
			'item_spacing'		 => 'discard', // default 'preserve
		);

		$args	 = wp_parse_args( $args, $defaults );
		$args	 = apply_filters( 'wp_nav_menu_args', $args );

		if ( "show" == raindrops_warehouse( 'raindrops_show_menu_primary' ) ) {

			if ( $raindrops_link_unique_text == true ) {

				$args['walker']			 = new raindrops_unique_identifier_walker_nav_menu();
				$raindrops_nav_menu_primary	 = wp_nav_menu( $args );
			} else {

				$raindrops_nav_menu_primary = wp_nav_menu( $args );
			}
			
			$template	 = "\n" . str_repeat( "\t", 4 ) . '<p class="' . $args['wrap_mobile_class'] . '">
					<a href="#%1$s" class="close"><span class="raindrops-nav-menu-shrunk" title="nav menu shrunk" ><span class="screen-reader-text">Shrunk</span></span></a>
					<a href="#access" class="open"><span class="raindrops-nav-menu-expand" title="nav menu expand"><span class="screen-reader-text">Expand</span></span></a>
					</p>
					<%3$s id="' . esc_attr( $args['wrap_element_id'] ) . '" class="clearfix" %4$s>
						<h2 class="screen-reader-text">%5$s</h2>
					%2$s
					</%3$s>';
					
			do_action( 'raindrops_nav_menu_primary' );
			$html		 = sprintf( $template, esc_attr( raindrops_warehouse( 'raindrops_page_width' ) ), $raindrops_nav_menu_primary, raindrops_doctype_elements( 'div', 'nav', false ),
					raindrops_doctype_elements( '', 'aria-label="' . esc_attr__( 'Primary Navigation', 'raindrops' ) . '"', false ), esc_attr__( 'Primary Navigation', 'raindrops' ) );

			if ( 'html5' !== raindrops_warehouse_clone( 'raindrops_doc_type_settings' ) ) {
				/**
				 * @since 1.411
				 */
				$template	 = "\n" . str_repeat( "\t", 4 ) . '<p class="' . $args['wrap_mobile_class'] . '">
					<a href="#access" class="open"><span class="raindrops-nav-menu-expand" title="nav menu expand">Expand</span></a><span class="menu-text">menu</span>
					<a href="#%1$s" class="close"><span class="raindrops-nav-menu-shrunk" title="nav menu shrunk">Shrunk</span></a>
					 </p>
					<%3$s id="' . esc_attr( $args['wrap_element_id'] ) . '" class="clearfix">
					%2$s
					</%3$s>';
				$html		 = sprintf( $template, esc_attr( raindrops_warehouse( 'raindrops_page_width' ) ), $raindrops_nav_menu_primary, raindrops_doctype_elements( 'div', 'nav', false ) );
			}

			echo apply_filters( 'raindrops_nav_menu_primary_html', $html );
		} //raindrops_warehouse(  'raindrops_show_menu_primary'  )
	}

}

if ( ! function_exists( 'raindrops_post_class' ) ) {
	/**
	 *
	 * @global type $post
	 * @global type $template
	 * @param type $class
	 * @param type $post_id
	 * @param type $echo
	 * @return type
	 * @since 0.48
	 */
	function raindrops_post_class( $class = '', $post_id = null, $echo = true ) {

		global $post, $template;

		$classes = get_post_class( $class, $post_id );

		if ( is_sticky() ) {

			$classes[] = 'raindrops-sticky';
		}
		$raindrops_title_empty_class	 = '';
		$raindrops_content_empty_class	 = ''; // wp-includes/post-template.php:265 - Trying to get property of non-object

		if ( isset( $post ) ) {

			$raindrops_content_empty_class = $post->post_content;
		}
		if ( isset( $template ) ) {

			$template_class	 = basename( $template, '.php' );
			$classes[]		 = sanitize_html_class( 'rd-tpl-' . $template_class );
		}

		if ( empty( $raindrops_content_empty_class ) ) {

			$classes[] = 'raindrops-empty-content';
		}
		if ( isset( $post ) ) {

			$raindrops_title_empty_class = $post->post_title;
		}

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

		/**
		 * @1.438
		 */
		if ( true == raindrops_is_custom_post_type() ) {

			$classes[] = 'rd-custom-post-type';
		}

		$classes = array_map( 'esc_attr', $classes );

		if ( true == $echo ) {

			echo 'class="' . join( ' ', $classes ) . '"';
		} else {

			return 'class="' . join( ' ', $classes ) . '"';
		}
	}

}

if ( ! function_exists( 'raindrops_chat_filter' ) ) {
	/**
	 *
	 * @param type $contents
	 * @return type
	 * @since 1.111
	 */
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
		$before			 = '';
		$after			 = '';
		$flag			 = false;
		$last			 = count( $new_contents ) - 1;
		foreach ( $new_contents as $key => $new ) {

			if ( !preg_match( '|([^\:]+)(\:)(.+)|si', $new, $regs ) && $flag == false ) {
				$before .= '<p>' . $new;
				continue;
			}

			if ( intval( $key ) == intval( $last ) ) {

				if ( false !== $after_result = strstr( $new, '<' ) ) {

					$after .= $after_result;
				}
				if ( false !== $after_result = strstr( $new, "<", true ) ) {

					$reg[ 3 ] = $after_result;
				}
				if ( false !== $after_result = strstr( $reg[ 3 ], ":" ) ) {

					$regs[ 3 ] = str_replace( ':', '', $after_result );
				}
			}
			$flag	 = true;
			$new	 = str_replace( '</p>', '', $new );
			if ( isset( $regs[ 3 ] ) && !empty( $regs[ 3 ] ) ) {

				$regs[ 3 ] = str_replace( '</p>', '', $regs[ 3 ] );
			}
			if ( isset( $regs[ 1 ] ) && !empty( $regs[ 1 ] ) ) {

				$regs[ 1 ] = strip_tags( $regs[ 1 ] );
			}

			if ( isset( $regs[ 1 ] ) && !preg_match( '!(http|https|ftp)!', $regs[ 1 ] ) && !empty( $regs[ 1 ] ) ) {

				$result .= sprintf( $html, esc_attr( raindrops_chat_author_id( $regs[ 1 ] ) ), esc_html( $regs[ 1 ] ), $regs[ 3 ] );
			} else {

				if ( !empty( $new ) ) {
					$result .= '<dd class="additional-block">' . $new . '</dd>';
				}
			}
		}

		return apply_filters( 'raindrops_chat_filter', sprintf( '%2$s<dl class="raindrops-post-format-chat">%1$s</dl>%3$s', $result, $before, $after ) );
	}

}

if ( ! function_exists( 'raindrops_chat_author_id' ) ) {
	/**
	 *
	 * @staticvar array $raindrops_chat_author_id
	 * @param type $author
	 * @return type
	 * @since 1.111
	 */
	function raindrops_chat_author_id( $author ) {

		static $raindrops_chat_author_id = array();
		$raindrops_chat_author_id[]		 = $author;
		$raindrops_chat_author_id		 = array_unique( $raindrops_chat_author_id );
		return array_search( $author, $raindrops_chat_author_id );
	}

}

if ( ! function_exists( 'raindrops_link_unique' ) ) {
	/**
	 *
	 * @global type $raindrops_link_unique_text
	 * @param type $text
	 * @param type $id
	 * @param type $class
	 * @return type
	 * @since 1.116
	 */
	function raindrops_link_unique( $text = '', $id = 0, $class = 'raindrops_unique_identifier' ) {

		global $raindrops_link_unique_text;

		$raindrops_link_unique_text = raindrops_link_unique_text();

		if ( true == $raindrops_link_unique_text && !is_admin() ) {
			$raindrops_aria_hidden	 = raindrops_doctype_elements( '', 'aria-hidden="true"', false );
			$html					 = '<span class="%1$s" %4$s>[%2$s %3$s]</span>';
			$html					 = sprintf( $html, esc_attr( $class ), esc_attr( $text ), (int) $id, $raindrops_aria_hidden );
			return apply_filters( 'raindrops_link_unique', $html, $text, $id, $class );
		}
		return;
	}

}

if ( ! function_exists( 'raindrops_counter' ) ) {
	/**
	 *
	 * @staticvar int $count
	 * @return type
	 * @since 1.118
	 */
	function raindrops_counter() {

		static $count = 1;
		return $count++;
	}

}

if ( ! function_exists( 'raindrops_accessible_titled' ) ) {
	/**
	 *
	 * @param type $link
	 * @return type
	 * @since 1.118
	 */
	function raindrops_accessible_titled( $link ) {

		/* care for screen reader */
		$link = str_replace( array( "title='", 'title="' ), array( "title='Archives ", 'title="Archives ' ), $link );
		return $link;
	}

}

if ( ! function_exists( 'raindrops_remove_category_rel' ) ) {
	/**
	 *
	 * @param type $output
	 * @return type
	 * @since 1.118
	 */
	function raindrops_remove_category_rel( $output ) {
		if ( 'html5' !== raindrops_warehouse_clone( 'raindrops_doc_type_settings' ) ) {
			$output = preg_replace( '!( rel="[^"]+")!', '', $output );
			return $output;
		}
		return $output;
	}

}
add_filter( 'widget_posts_args', 'raindrops_remove_sticky_link_from_recent_post_widget' );

if ( ! function_exists( 'raindrops_remove_sticky_link_from_recent_post_widget' ) ) {
	/**
	 *
	 * @param array $args
	 * @return type
	 */
	function raindrops_remove_sticky_link_from_recent_post_widget( $args ) {

		$args[ 'post__not_in' ] = get_option( 'sticky_posts' );
		return $args;
	}

}

if ( isset( $raindrops_use_wbr_for_title ) && true == $raindrops_use_wbr_for_title ) {
	/**
	 * Entry title none breaking text breakable
	 * test filter.
	 * @since 1.119
	 */
	add_filter( 'the_title', 'raindrops_non_breaking_title', 999 );
}

if ( ! function_exists( 'raindrops_non_breaking_title' ) ) {
	/**
	 *
	 * @global type $raindrops_document_type
	 * @param type $title
	 * @return type
	 */
	function raindrops_non_breaking_title( $title ) {

		global $raindrops_document_type;

		if ( !is_admin() && 'html5' == $raindrops_document_type ) {

			$title_text = strip_tags( $title );

			if ( preg_match( "/[\x20-\x7E]{30,}/", $title_text ) && preg_match( '!([A-Z])!', $title ) ) {

				$replace_text = preg_replace( '!([A-Z])!', '<wbr>$1', $title_text );
				return str_replace( $title_text, $replace_text, $title );
			} elseif ( preg_match( "/[\x20-\x7E]{30,}/", $title_text ) ) {

				$replace_text = preg_replace( '!([A-Z])!', '$1<wbr>', $title_text );
				return str_replace( $title_text, $replace_text, $title );
			}
		}
		return $title;
	}

}

if ( ! function_exists( 'raindrops_remove_wbr' ) ) {

	add_filter( 'esc_html', 'raindrops_remove_wbr', 999 );
	/**
	 * raindrops_non_breaking_title() assist function
	 * remove wbr escaped elements when another plugin escape title
	 * @param type $content
	 * @return type
	 */
	function raindrops_remove_wbr( $content ) {

		return str_replace( array( '&lt;wbr&gt;', '&lt;/wbr&gt;' ), '', $content );
	}

}

if ( ! function_exists( 'raindrops_non_breaking_content' ) ) {
	/**
	 * CURRENT NOT USE THIS
	 * @global type $raindrops_document_type
	 * @param type $content
	 * @return type
	 * add_filter( 'the_content', 'raindrops_non_breaking_content', 11 );
	 * Stop filter
	 * @1.446
	 */

	function raindrops_non_breaking_content( $content ) {

		global $raindrops_document_type;
		//long url link text breakable

		if ( !is_admin() && 'html5' == $raindrops_document_type ) {
			/**
			 * @1.325
			 * remove ~ from regex
			 * for theme check plugin
			 */
			return preg_replace_callback( "|>\s*?([-_.!*\'()a-zA-Z0-9;\/?:@&=+$,%#]{30,})\s*?<|", 'raindrops_add_wbr_content_long_text', $content );
		}
		return $content;
	}

}

if ( ! function_exists( 'raindrops_add_wbr_content_long_text' ) ) {
	/**
	 * CURRENT NOT USE THIS
	 * @param type $matches
	 * @return type
	 */
	function raindrops_add_wbr_content_long_text( $matches ) {

		foreach ( $matches as $match ) {

			return preg_replace( '!([/%])!', '<wbr>$1', $match );
		}
	}

}

if ( ! function_exists( 'raindrops_poster' ) ) {
	/**
	 *
	 * @global type $post
	 * @param type $args
	 */
	function raindrops_poster( $args ) {
		global $post;

		$args_count	 = count( $args );
		$html		 = '<a href="%1$s" title="link to %2$s" class="page-featured-template">%3$s</a>';
		echo '<ul class="poster">';
		for ( $i = 0; $i < $args_count; $i++ ) {
			echo '<li><div class="line poster-row-' . ($i + 1) . '">';

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

					echo '<div id="post-' . absint( $post->ID ) . '">';

					the_widget( $page_item[ 'type' ][ 1 ], $page_item[ 'type' ][ 2 ], $page_item[ 'type' ][ 3 ] );

					echo '</div>';
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
								$link			 = esc_url( get_permalink( $id ) );
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
			echo '</div></li>';
		}
		echo '<ul>';
	}

}

if ( ! function_exists( 'raindrops_comment_class' ) ) {
	/**
	 * comment list class
	 * @param type $comment_class
	 * @param type $add_start_attribute
	 * @since 1.136
	 */
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

if ( ! function_exists( 'raindrops_filter_header_text_color' ) ) {
	/**
	 *
	 * @global type $raindrops_fallback_human_interface_show
	 * @param type $color
	 * @return string
	 * @since 1.136
	 */
	function raindrops_filter_header_text_color( $color ) {

		global $raindrops_fallback_human_interface_show;

		if ( true == $raindrops_fallback_human_interface_show ) {

			return 'blank';
		}
		return $color;
	}

}

if ( ! function_exists( 'raindrops_list_of_posts' ) ) {
	/**
	 *
	 * @global type $raindrops_list_of_posts_per_page
	 * @global int $raindrops_list_of_posts_length
	 * @global string $raindrops_list_of_posts_more
	 * @global boolean $raindrops_list_of_posts_use_toggle
	 * @global string $raindrops_list_of_posts_type
	 * @since 1.148
	 */
	function raindrops_list_of_posts() {

		global $raindrops_list_of_posts_per_page;
		global $raindrops_list_of_posts_length;
		global $raindrops_list_of_posts_more;
		global $raindrops_list_of_posts_use_toggle;
		global $raindrops_list_of_posts_type;

		$query = get_query_var( 'paged' );
		if ( !isset( $raindrops_list_of_posts_type ) ) {
			$raindrops_list_of_posts_type = 'post';
		}
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
			'post_type'		 => $raindrops_list_of_posts_type,
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
				$raindrops_list_of_posts_excerpt	 = esc_html__( 'Empty content', 'raindrops' );
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
						raindrops_delete_post_link( __( 'Trash', 'raindrops' ), '<span class="delete-link">', '</span>' );

						edit_post_link( __( 'Edit', 'raindrops' ), '<span class="edit-link">', '</span>' );
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
				next_posts_link( __( '&#171; Older Entries', 'raindrops' ), $raindrops_list_of_post_query->max_num_pages )
				?>
	</div>
	<div class="right">
<?php
previous_posts_link( __( 'Newer Entries &#187;', 'raindrops' ), $raindrops_list_of_post_query->max_num_pages )
?>
	</div>
</div>
		<?php
	}

}

if ( ! function_exists( 'raindrops_tile' ) ) {
	/**
	 *
	 * @global type $query_string
	 * @global type $template
	 * @param type $args
	 */
	function raindrops_tile( $args = array() ) {

		global $query_string, $template;
		$current_template	 = basename( $template, '.php' );
		$defaults			 = array(
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
		$args				 = wp_parse_args( $args, $defaults );
		$args[ 'paged' ]	 = get_query_var( 'page' );

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
				<h2 class="entry-title"><a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>">
		<?php
		$title	 = get_the_title( $post->ID );
		$title	 = wp_html_excerpt( $title, apply_filters( 'raindrops_tile_title_length', 40 ), apply_filters( 'raindrops_tile_title_more', '...' ) );

		if( empty( $title )){
			/* @1.492 */
			$title = '<span class="icon-link-no-title entry-title-text">no title</span>';
		}
		$title	 = preg_replace( '|>.+</|', '>[link to ' . absint( $post->ID ) . ']</', $title );

		echo $title;

		?></a></h2>
				<div class="posted-on"><?php raindrops_posted_on(); ?></div>
				<div class="entry-content clearfix">

		<?php
		if ( 'front-page' == $current_template ) {
			$data_rows = 5;
		} else {
			$data_rows = 3;
		}
		$data_rows = apply_filters( 'raindrops_tile_content_line_num', $data_rows );
		?>
					<p class="trancate" data-rows="<?php echo $data_rows; ?>">
		<?php echo strip_tags( get_the_excerpt( $post->ID ) ) ?></p>
				</div>
				<div class="entry-meta">
		<?php edit_post_link( esc_html__( 'Edit', 'raindrops' ) . raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>', $post->ID ); ?>
				</div>
				<br class="clear" />
				</<?php raindrops_doctype_elements( 'div', 'article' ); ?>></div>
		</li>
					<?php }//foreach( $raindrops_posts as $post )
					?></ul>
	<br class="clear" />
					<?php
					$html = '';

					if ( 0 == $args[ 'paged' ] ) {

						if ( is_front_page() ) {

							$url	 = esc_url( add_query_arg( 'page', 2, get_permalink() ) ) . '#portfolio';
							$html	 = '<li><a href="' . esc_url( $url ) . '" title="page 2" class="portfolio-page2">' . esc_html__( 'Page', 'raindrops' ) . '2</a></li>';
						} else {

							$url	 = esc_url( add_query_arg( 'page', 2, get_permalink() ) ) . '#portfolio';
							$html	 = '<li><a href="' . esc_url( $url ) . '" title="page 2" class="portfolio-page2">' . esc_html__( 'Page', 'raindrops' ) . '2</a></li>';
						}
					} elseif ( $args[ 'paged' ] > 0 ) {

						$page	 = $args[ 'paged' ] + 1;
						$url	 = esc_url( add_query_arg( 'page', $page , get_permalink() ) ) . '#portfolio';
						$html	 = sprintf( $raindrops_html_page, esc_url( $url ), 'portfolio-next portfolio-' . $page, 'portfolio-nav-next', esc_html__( 'Page', 'raindrops' ) . ' ' . $page
						);
					}

					$url						 = esc_url( add_query_arg( 'page', $args[ 'paged' ], get_permalink() ) ) . '#portfolio';
					$raindrops_page_for_posts	 = get_option( 'page_for_posts' );
					$raindrops_html_page		 = '<li><a href="%1$s" class="%2$s"><span class="%3$st">%4$s</span></a></li>';

					if ( $args[ 'post_type' ] == 'post' && $raindrops_page_for_posts ) {

						$html .= sprintf(
						$raindrops_html_page, esc_url( get_permalink( $raindrops_page_for_posts ) ), 'portfolio-link-to-page-for-posts', 'link-to-page-title', get_the_title( $raindrops_page_for_posts )
						);
					}

					if ( 2 == $args[ 'paged' ] ) {

						$page	 = $args[ 'paged' ] - 1;
						$url	 = esc_url( add_query_arg( 'page', $page, get_permalink() ) ) . '#portfolio';
						$html .= sprintf( $raindrops_html_page, esc_url( $url ), 'portfolio-prev portfolio-home', 'portfolio-nav-prev', __( 'Portfolio Home', 'raindrops' )
						);
					} elseif ( $args[ 'paged' ] > 2 ) {

						$page	 = $args[ 'paged' ];
						$page	 = $page - 1;
						$url	 = esc_url( add_query_arg( 'page', $page, get_permalink() ) ) . '#portfolio';
						$html .= sprintf( $raindrops_html_page, esc_url( $url ), 'portfolio-prev portfolio-' . $page, 'portfolio-nav-prev', esc_html__( 'Page', 'raindrops' ) . ' ' . $page
						);
					}

					echo apply_filters( 'raindrops_portfolio_nav', sprintf( '<div class="portfolio-nav"><ul>%1$s</ul></div>', $html ) );
				} else { //! empty( $raindrops_posts )
					?><div  id="post-<?php the_ID(); ?>"><<?php raindrops_doctype_elements( 'div', 'article' ); ?> <?php raindrops_post_class( 'no-portfolio' ); ?> ><?php
					$url = remove_query_arg( 'page', get_permalink() );

					$raindrops_html_page = '<p style="text-align:center;"><a href="%1$s" class="%2$s" ><span class="%3$st">%4$s</span></a></p>';
					if ( preg_match( '!page=!', $query_string ) ) {
						?><h3 style="text-align:center" class="h1 portfolio-navigation-last">End</h3><?php
						echo apply_filters( 'raindrops_portfolio_nav', sprintf( $raindrops_html_page, esc_url( $url ), 'portfolio-home', 'portfolio-home-text', esc_html__( 'Portfolio Home', 'raindrops' )
						) );
					}
					echo apply_filters( 'raindrops_portfolio_nav', sprintf( $raindrops_html_page, home_url(), 'portfolio blog-home-link', 'portfolio-nav', esc_html__( 'Home', 'raindrops' )
					) );
					?></<?php raindrops_doctype_elements( 'div', 'article' ); ?>></div><?php
				}
				wp_reset_postdata();
				do_action( 'raindrops_tile_after' );
		?></div><?php
	}

}

if ( ! function_exists( 'raindrops_add_more' ) ) {
	/**
	 *
	 * @global type $multipage
	 * @global type $page
	 * @param type $id
	 * @param type $content
	 * @param type $more_link_text
	 * @return type
	 * @since 1.150
	 */
	function raindrops_add_more( $id, $content, $more_link_text = null ) {
		global $multipage, $page;

		$pre	 = apply_filters( 'raindrops_add_more_before', '' );
		$after	 = apply_filters( 'raindrops_add_more_after', '' );
		$html	 = ' <div class="raindrops-more-wrapper">' . $pre . '<a href="%1$s%2$s" class="poster-more-link">%3$s</a>' . $after . '</div>';
		if ( empty( $more_link_text ) ) {

			$raindrops_aria_hidden	 = raindrops_doctype_elements( '', 'aria-hidden="true"', false );
			$more_link_text			 = esc_html__( 'Continue&nbsp;reading ', 'raindrops' ) . '<span class="meta-nav" ' . $raindrops_aria_hidden . '>&#8594;</span><span class="more-link-post-unique">' . esc_html__( '&nbsp;Post ID&nbsp;', 'raindrops' ) . $id . '</span>';
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
			$content .= apply_filters( 'the_content_more_link', sprintf( $html, esc_url( get_permalink( $id ) ), $fragment_identifier, $more_link_text
			), $more_link_text
			);

			$content = force_balance_tags( $content );

			return apply_filters( 'raindrops_add_more', $content, $more );
		} else {

			return apply_filters( 'raindrops_add_more', $content, $more );
		}
	}

}

if ( ! function_exists( 'raindrops_status_bar' ) ) {
	/**
	 *
	 * @global type $raindrops_status_bar
	 * @global type $post
	 * @return type
	 * @since 1.211
	 */
	function raindrops_status_bar() {
		global $raindrops_status_bar, $post;

		/**
		 *
		 * Show Raindrops status bar at browser bottom
		 *
		 * shows true hide false
		 * @since 1.211
		 */
		if ( !isset( $raindrops_status_bar ) ) {

			$customizer_modify_value = raindrops_warehouse_clone( 'raindrops_status_bar' );

			if ( 'show' !== $customizer_modify_value ) {

				$raindrops_status_bar = false;
			} else {

				$raindrops_status_bar = true;
			}
		}
		if ( $raindrops_status_bar == false ) {

			return;
		}
		?>
		<div id="raindrops_status_bar">
		<?php
		do_action( 'raindrops_status_bar_before' );

		//@1.519 $link_to_top = '<p class="move-to-top"><a href="#top">top</a></p>';
		$link_to_top = '<a id="page-top" href="#top" style="display: inline;"><span></span></a>';
		echo apply_filters( 'raindrops_status_bar_top', $link_to_top );

		if ( 'posts' == get_option( 'show_on_front' ) ) {
			if ( is_month() ) {
				raindrops_monthly_archive_prev_next_navigation();
			}
		}
		?>
			<div class="raindrops-next-prev-links status-bar-child">
		<?php raindrops_next_prev_links( 'nav-status-bar' ); ?>
			</div>
			<div class="raindrops_prev_next_post status-bar-child">
		<?php
		if ( is_single() ) {
			raindrops_prev_next_post( 'nav-status-bar' );
		}
		?>
			</div>
		<?php
		if ( is_page() ) {
			?>
			<div class="child-pages status-bar-child">

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
				<span class="status-bar-page-title"><?php echo _nx( 'Child Page : ', 'Child Pages : ', $number, '', 'raindrops' ); ?></span>
				<?php
				foreach ( $child_pages as $child ) {
					$permalink	 = esc_url( apply_filters( 'the_permalink', get_permalink( $child->ID ) ) );
					$title		 = apply_filters( 'the_title', $child->post_title );

					printf( $html, $permalink, $title );

					if ( end( $child_pages ) !== $child ) {

						echo ' , ';
					}
				}
			}
			wp_reset_query();
				?></div>
			</div><?php

		} //is_page()

		do_action( 'raindrops_status_bar_after' );
		?></div><?php
	}

}
if ( ! function_exists( 'raindrops_base_font_size' ) ) {

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

if ( ! function_exists( 'raindrops_widget_tag_cloud_args' ) ) {
	/**
	 *
	 * @global type $raindrops_tag_cloud_widget_presentation
	 * @param type $args
	 * @return boolean
	 * @since 1.229
	 */
	function raindrops_widget_tag_cloud_args( $args ) {

		global $raindrops_tag_cloud_widget_presentation;

		if ( true == $raindrops_tag_cloud_widget_presentation && 'post_tag' == $args[ 'taxonomy' ] ) {

			$args[ 'smallest' ]	 = '108';
			$args[ 'largest' ]	 = '108';
			$args[ 'unit' ]		 = '%';
		} else {
			$args[ 'smallest' ]	 = '85';
			$args[ 'largest' ]	 = '277';
			$args[ 'unit' ]		 = '%';
		}
		$args[ 'echo' ] = false;

		return $args;
	}

}
if ( ! function_exists( 'raindrops_widget_ids' ) ) {
	/**
	 *
	 * @global type $raindrops_theme_settings
	 * @global type $raindrops_setting_type
	 * @global type $raindrops_current_theme_slug
	 * @param type $sidebars_widgets
	 * @return type
	 */
	function raindrops_widget_ids( $sidebars_widgets ) {

		global $raindrops_theme_settings, $raindrops_setting_type, $raindrops_current_theme_slug;

		if ( $raindrops_theme_settings !== 'no' ) {
			$copy = $sidebars_widgets;
			unset( $copy[ "wp_inactive_widgets" ] );

			$target_sidebars = array( 'sidebar-1', 'sidebar-2', 'sidebar-3', 'sidebar-4', );
			// Post Format Status Sidebar( sidebar-5 ) not support
			$copy_for_theme	 = array();
			foreach ( $copy as $key => $v ) {
				if ( !empty( $key ) ) {
					if ( in_array( $key, $target_sidebars ) && !empty( $v ) ) {
						$copy_for_theme[ $key ] = $v;
					}
				}
			}
			if ( isset( $copy_for_theme ) && !empty( $copy_for_theme ) ) {
				$raindrops_theme_settings[ 'widget_ids' ] = $copy_for_theme;
			}

			if ( 'option' == $raindrops_setting_type ) {

				update_option( 'raindrops_theme_settings', $raindrops_theme_settings );
			}
			if ( 'theme_mod' == $raindrops_setting_type ) {

				$old_mods = get_theme_mods();

				if ( is_array( $old_mods ) ) {
					$new_mods = array_merge( $old_mods, $raindrops_theme_settings );
				} else {
					$new_mods = $raindrops_theme_settings;
				}

				update_option( "theme_mods_$raindrops_current_theme_slug", $new_mods );
			}
		}
		return $sidebars_widgets;
	}

}

if ( ! function_exists( 'raindrops_skip_links' ) ) {
	/**
	 *
	 * @global type $raindrops_theme_settings
	 * @global type $wp_widget_factory
	 * @global type $rsidebar_show
	 * @global type $wp_customize
	 * @return type
	 * @since 1.231
	 */
	function raindrops_skip_links() {

		global $raindrops_theme_settings, $wp_widget_factory, $rsidebar_show, $wp_customize;

		if ( isset( $wp_customize ) ) {
			return;
		}

		$result	 = '';
		$html	 = "\n" . str_repeat( "\t", 1 ) . '<div class="skip-link"><a href="#%1$s" class="screen-reader-text" title="Skip to %2$s">Skip to %3$s</a></div>';
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
					if ( isset( $array_val ) && is_array( $array_val ) ) {
						foreach ( $array_val as $val ) {

							$result .= sprintf( $html, wp_kses( $val, array() ), esc_attr( $val ), esc_html( strtoupper( $val ) ) );
						}
					}
				}
				return apply_filters( 'raindrops_skip_links', $result );
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
			return apply_filters( 'raindrops_skip_links', $result );
		}
	}

}

if ( ! function_exists( 'raindrops_remove_wrong_p_before' ) ) {
	/**
	 *  Filter of paragraph correction
	 * @param type $content
	 * @return type
	 * @since 1.231
	 */
	function raindrops_remove_wrong_p_before( $content ) {
		return str_replace( array( '<div>', '</div>' ), array( "<div>\n\n", "\n</div>" ), $content );
	}

}

if ( ! function_exists( 'raindrops_remove_wrong_p' ) ) {
	/**
	 *
	 * @param type $content
	 * @return type
	 */
	function raindrops_remove_wrong_p( $content ) {
		
		$allblocks	 = '(?:table|thead|tfoot|caption|col|colgroup|tbody|tr|td|th|div|dl|dd|dt|ul|ol|li|pre|form|map|area|blockquote|address|math|style|h[1-6]|hr|fieldset|noscript|legend|section|article|aside|hgroup|header|footer|nav|figure|details|menu|summary|style)';
		/* 1.261 remove p at allblocks */
		$content	 = preg_replace( '!([^(<p>)]*)</p>(</' . $allblocks . '>)!', "$1$2", $content );
		$content	 = preg_replace( '!(<(select|del|option|canvas|mrow|svg|rect|optgroup) [^>]*>)(<br />|</p>)!', "$1", $content );
		$content	 = preg_replace( '!(</option>|</svg>|</figcaption>|<mrow>|<msup>|</msup>|</mi>|</mn>|</mrow>|</mo>|</rect>|</button>|</optgroup>|</select>)<br />!', "$1", $content );
		$content	 = preg_replace( '!<p>\s*(</?(ins|del|msup|input)[^>]*>)\s*</p>!', "$1", $content );
		$content	 = preg_replace( '!(</?(svg|msup|keygen|command|canvas|datalist|script)[^>]*>)\s*</p>!', "$1", $content );
		$content	 = preg_replace( '!(<p>)(</?(svg|msup|keygen|command|canvas|datalist|input)[^>]*>)!', "$2", $content );
		$content	 = preg_replace( '!(<p>[^<]*)(</' . $allblocks . '>)!', "$1</p>$2", $content );
		$content	 = preg_replace( '!(<' . $allblocks . '[^>]*>[^<]*)</p>!', "$1", $content );
		$content	 = preg_replace( '!(<' . $allblocks . '[^>]*>)([^(<|\s)]+)<p>!', "$1<p>$2</p>", $content );
		$content	 = str_replace( 'class="wp-caption-text"></p>', 'class="wp-caption-text">', $content );
		$content	 = preg_replace( '!<p>(<figure[^>]*>(.*)?</figure>)</p>!', "$1", $content );//@1.466 test figure has child element
		$content	 = preg_replace( '!<p>(<ruby[^>]*>(.*)?</ruby>)</p>!', "$1", $content );//@1.482 test figure has child element
		return $content;
	}

}

if ( ! function_exists( 'raindrops_link_text_filter' ) ) {

	/**
	 *
	 * @param type $content
	 * @return type
	 * @since 1.328
	 */
	function raindrops_link_text_filter( $content ) {

		$content = preg_replace_callback( "|<a[^>]+>.*?(https?:\/\/[-_.!*\'()a-zA-Z0-9;\/?:@&=+$,%#]+).*?</a>|", "raindrops_link_url_text_decode", $content );

		return $content;
	}

}
if ( ! function_exists( 'raindrops_link_pdf_filter' ) ) {

	/**
	 *
	 * @param type $content
	 * @return type
	 * @since 1.446
	 */
	function raindrops_link_pdf_filter( $content ) {

		$content = preg_replace_callback( "|<a class=\"rd-pdf\" [^>]+>([^<]+)</a>|", "raindrops_link_url_text_decode", $content );

		return $content;
	}

}
if ( ! function_exists( 'raindrops_link_url_text_decode' ) ) {

	/**
	 *
	 * @param type $matches
	 * @return type
	 * @since 1.328
	 */
	function raindrops_link_url_text_decode( $matches ) {

		if ( isset( $matches[ 1 ] ) && preg_match( '!%[0-9A-Z][0-9A-Z]+!', $matches[ 1 ] ) ) {

			$replace = urldecode( $matches[ 1 ] );
			$replace = esc_html( $replace );

			return preg_replace( "|>" . $matches[ 1 ] . "</a>|", ">{$replace}</a>", $matches[ 0 ] );
		}
		return $matches[ 0 ];
	}

}

if ( ! function_exists( 'raindrops_call_custom_css' ) ) {
	/**
	 *  @since 1.234
	 */
	function raindrops_call_custom_css() {

		new raindrops_custom_css();
	}

}

if ( ! class_exists( 'raindrops_custom_css' ) ) {
	/**
	 * post metabox
	 * Raindrops indivisual CSS
	 */
	class raindrops_custom_css {

		public function __construct() {
			add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
			add_action( 'save_post', array( $this, 'save' ) );
		}

		public function add_meta_box( $post_type ) {
			global $raindrops_widget_post_types;

			$post_types = apply_filters( 'raindrops_custom_css_supports', array( 'post', 'page' ) );

			if ( isset( $raindrops_widget_post_types ) && !empty( $raindrops_widget_post_types ) ) {

				$post_types = array_merge( $post_types, $raindrops_widget_post_types );
			}

			if ( in_array( $post_type, $post_types ) ) {

				add_meta_box(
				'raindrops_custom_css'
				, esc_html__( 'Custom CSS For This Entry', 'raindrops' )
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

				if ( !current_user_can( 'edit_page', $post_id ) ) {
					return $post_id;
				}
			} else {

				if ( !current_user_can( 'edit_post', $post_id ) ) {
					return $post_id;
				}
			}
			/**
			 * Change sanitize_text_field to wp_strip_all_tags
			 * sanitize_text_field() removing the octets.
			 * $data	 = sanitize_text_field( $_POST[ 'raindrops_custom_css_field' ] );
			 * @1.434
			 */
			$data = wp_strip_all_tags( $_POST[ 'raindrops_custom_css_field' ] );

			/**
			 * @since 1.447
			 */
			$data	 = preg_replace( '!\s{4,}!', '    ', $data );
			$data	 = preg_replace( '!\s{2,3}!', ' ', $data );

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
			//$value					 = str_replace( array( '{', '}', ), array( "{\n", "\n}\n", ), $value );
			$value					 = str_replace( array( '{', '}', "\t" ), array( "{\r\n\t", "}\r\n", '    ' ), $value );
			$value					 = str_replace( '![^(\"|\')];!', ";\r\n", $value );
			/**
			 * 1/307
			 * test
			 */
			$value					 = str_replace( ';', ";\r\n    ", $value );
			$value					 = str_replace( "    }", "}", $value );
			$value					 = preg_replace( "!^\s!msi", '', $value );
			$raindrops_restore_check = get_theme_mod( 'header_image', get_theme_support( 'custom-header', 'default-image' ) );
			$current_value_header	 = get_post_meta( $post->ID, '_raindrops_this_header_image', true );


			$form .= '<label for="%1$s">%2$s</label>'
			. '<textarea id="%1$s" name="%1$s" %4$s>%3$s</textarea>';


			$raindrops_show_on_front					 = get_option( 'show_on_front' ); // val posts or page
			$raindrops_static_front_page_id				 = get_option( 'page_on_front' );
			$raindrops_static_front_page_template_slug	 = basename( get_page_template_slug( $raindrops_static_front_page_id ) );
			$raindrops_current_screen					 = get_current_screen();
			$current_value								 = get_post_meta( $post->ID, '_add-to-front', true );
			$page_page_auto_include_template			 = apply_filters( 'raindrops_page_auto_include_template', 'front-page.php' );

			if ( $raindrops_static_front_page_template_slug == $page_page_auto_include_template &&
			$raindrops_current_screen->post_type == 'page' &&
			$raindrops_static_front_page_id !== $post->ID ) {

				$form .= '<h4>' . esc_html__( 'Add Front Page', 'raindrops' ) . '</h4>';
				$form .= '<p><input type="radio" name="add-to-front" id="add-to-front" value="add" ' . checked( 'add', $current_value, false ) . ' />' . __( 'Add Front Page This Content', 'raindrops' ) . '</p>';
				$form .= '<p><input type="radio" name="add-to-front" id="add-to-front" value="default" ' . checked( '', $current_value, false ) . checked( 'default', $current_value, false ) . '  />' . __( 'No Need', 'raindrops' ) . '</p>';
			}

			/**
			 * 1.295 change conditional test
			 * if ( 'remove-header' !== $raindrops_restore_check && $raindrops_static_front_page_template_slug !== 'front-page.php' ) {
			 * @1.400 add filter
			 */
			//$raindrops_show_on_front !== 'page' &&
			if ( 'remove-header' !== $raindrops_restore_check ) {

				$raindrops_override_control = true;
			} else {
				$raindrops_override_control = false;
			}
			$raindrops_header_img_override_option = apply_filters( 'raindrops_header_img_override_option', $raindrops_override_control );

			if ( true == $raindrops_header_img_override_option ) {

				$form .= '<h4>' . esc_html__( 'Custom Header Image For This Post', 'raindrops' ) . '</h4>';

				$images = get_uploaded_header_images();

				$form .= '<p><input type="radio" name="header-image-file" id="header-image-file" value="hide" ' . checked( 'hide', $current_value_header, false ) . ' />' . __( 'Hide Header Image', 'raindrops' ) . '</p>';
				$featured_flag = false;
				if ( 'hide' == raindrops_warehouse_clone( 'raindrops_featured_image_singular' ) ) {
					/**
					 * @1.436
					 */
					$post_image_id = get_post_thumbnail_id();

					if ( !empty( $post_image_id ) && is_numeric( $post_image_id ) ) {
						$featured_flag = true;
						$form .= '<p><input type="radio" name="header-image-file" id="header-image-file" value="' . $post_image_id . '" ' . checked( $post_image_id, $current_value_header, false ) . ' />' . __( 'Featured Image', 'raindrops' ) . '</p>';
					} else {
						$featured_flag			 = false;
						$current_value_header	 = 'default';
						$form .= '<p><input type="radio" name="header-image-file" id="header-image-file" value="default" ' . checked( '', $current_value_header, false ) . checked( 'default', $current_value_header, false ) . '  />' . __( 'Default Image', 'raindrops' ) . '</p>';
					}
				}
				if ( true == $featured_flag || 'hide' !== raindrops_warehouse_clone( 'raindrops_featured_image_singular' ) ) {
					$form .= '<p><input type="radio" name="header-image-file" id="header-image-file" value="default" ' . checked( '', $current_value_header, false ) . checked( 'default', $current_value_header, false ) . '  />' . __( 'Default Image', 'raindrops' ) . '</p>';
				}
				$form .= '<div class="header-image-wrapper" style="max-height:320px;overflow-y:scroll;overflow-x:hidden;">';

				$header_image_html = '<p %1$s>'
				. '<input %2$s type="radio" name="header-image-file" id="header-image-file-%3$s" value="%3$s"  %4$s />'
				. '<label for="header-image-file-%3$s"><img src="%5$s" width="160" alt="header image %3$s"  /></label>'
				. '</p>';

				foreach ( $images as $image ) {

					$attached_file_type = wp_check_filetype( $image[ 'url' ] );

					if ( $attached_file_type[ 'ext' ] == 'jpeg' ||
					$attached_file_type[ 'ext' ] == 'jpg' ||
					$attached_file_type[ 'ext' ] == 'png' ||
					$attached_file_type[ 'ext' ] == 'gif' ) {

						$form .= sprintf(
						$header_image_html, 'style="display:inline-block;"', 'style="position:relative;top:-1em;"', $image[ 'attachment_id' ], checked( $image[ 'attachment_id' ], $current_value_header, false ), $image[ 'url' ]
						);
					} else {
						continue;
					}
				}
				/**
				 * Attchment image to header image
				 * @1.434
				 */
				$attachment_args = array(
					'post_parent'	 => $post->ID,
					'post_type'		 => 'attachment',
					'numberposts'	 => -1,
					'post_status'	 => 'any',
					'post_mime_type' => 'image',
				);
				$images			 = get_children( $attachment_args );

				foreach ( $images as $image ) {
					$form .= sprintf(
					$header_image_html, 'style="display:inline-block;"', 'style="position:relative;top:-1em;"', $image->ID, checked( $image->ID, $current_value_header, false ), wp_get_attachment_url( $image->ID )
					);
				}

				$form .= '</div>';

				$form .= '<p><a class="button button-large" href="' . admin_url( 'customize.php?autofocus[section]=header_image' ) . '">' . esc_html__( 'Add Custom Header', 'raindrops' ) . '</a></p>';
			}
			if ( $raindrops_static_front_page_template_slug == 'front-page.php' && 'page' == get_option( 'show_on_front' ) ) {

				$form .= '<h4>' . esc_html__( 'Override header Image', 'raindrops' ) . '</h4>';
				$form .= '<p>' . esc_html__( 'Now Selected Front Page template,You can use Featured Image for override header image', 'raindrops' ) . '</p>';
			}

			printf( $form, 'raindrops_custom_css_field', __( 'The Custom CSS Field only for the current post', 'raindrops' ), esc_textarea( $value ), '' );

			do_action( ' raindrops_custom_css_after' );
		}

	}

}

if ( ! function_exists( 'raindrops_play_list_add_atts' ) ) {

	/**
	 *
	 * @param type $out
	 * @param type $pairs
	 * @param type $atts
	 * @return string
	 */
	function raindrops_play_list_add_atts( $out, $pairs, $atts ) {

		global $post;

		if ( false !== ($type = raindrops_has_indivisual_notation() ) ) {

			if ( isset( $type[ 'color_type' ] ) && 'dark' == $type[ 'color_type' ] ) {

				$out[ 'style' ] = 'dark';
			}
		} else {
			$color_type = raindrops_warehouse_clone( 'raindrops_style_type' );

			if ( 'dark' == $color_type ) {

				$out[ 'style' ] = 'dark';
			}
		}

		return $out;
	}

}
if ( ! function_exists( 'raindrops_complementary_color' ) ) {
	/**
	 *
	 * @param type $hex_color
	 * @return type
	 */
	function raindrops_complementary_color( $hex_color = '#444' ) {

		return raindrops_complementary_color_clone( $hex_color );
	}

}

if ( ! function_exists( 'raindrops_add_complementary_color' ) ) {
	/**
	 *
	 * @global type $post
	 */
	function raindrops_add_complementary_color() {
		global $post;

		if ( 'yes' == raindrops_warehouse_clone( 'raindrops_complementary_color_for_title_link' ) ) {

			$raindrops_link_color			 = raindrops_warehouse_clone( 'raindrops_hyperlink_color' );
			$raindrops_complementary_color	 = raindrops_complementary_color( $raindrops_link_color );
			$raindrops_css					 = sprintf( '.entry-title span{color:%1$s;}', $raindrops_complementary_color );
			$raindrops_css					 = apply_filters( 'raindrops_add_complementary_color', $raindrops_css, $raindrops_link_color, $raindrops_complementary_color );

			if ( false == raindrops_has_indivisual_notation() && $raindrops_complementary_color !== $raindrops_link_color ) {
				wp_add_inline_style( 'style', $raindrops_css );
			}
		}
	}

}

if ( ! function_exists( 'raindrops_oembed_filter' ) ) {

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
		global $is_IE, $post;
		if ( !$is_IE ) {

			$html = str_replace( 'frameborder="0"', '', $html );
		}
		
		$not_exists_gutenberg_class = 'wp-block-embed__wrapper';
		$repair_style				= '';
		
		if(function_exists( 'has_blocks' ) &&  has_blocks( $post_ID ) || isset( $post ) && preg_match( '$wp-block-embed__wrapper$', $post->post_content ) ) {
			
			//Since gutenberg encloses oembed with figure elements, do not use figure elements in themes
			$element = 'div';
			$not_exists_gutenberg_class = '';
			
			return $html;
		} else {
			// html5 - figure , xhtml - div 
			$element = raindrops_doctype_elements( 'div', 'figure', false );			
		}
		
		/**
		 * https://www.instagram.com/
		 * @since 1.504
		 */
		if ( preg_match( '!(instagram.com)!', $url ) ) {
			return sprintf( '<div class="rd-instagram clearfix">%1$s</div>', $html );
		}
		/**
		 * https://www.reverbnation.com/
		 */
		if ( preg_match( '!(reverbnation.com)!', $url ) ) {
			return sprintf( '<%2$s class="rd-reverbnation clearfix"><div>%1$s</div></%2$s>', $html, $element );
		}
		/*
		 * https://speakerd.s3.amazonaws.com/presentations/50021f75cf1db900020005e7/slide_0.jpg?1362165300
		 */
		if ( preg_match( '!(speakerdeck.com|speakerd)!', $url ) ) {
			return sprintf( '<%2$s class="rd-ratio-075 rd-speakerdeck clearfix"><div>%1$s</div></%2$s>', $html, $element );
		}
		/*
		 * https://www.slideshare.net/slideshow/embed_code/7306301
		 */
		if ( preg_match( '!(slideshare.net)!', $url ) ) {
			return sprintf( '<%2$s class="rd-slideshare clearfix %3$s" %4$s><div>%1$s</div></%2$s>', $html, $element, $not_exists_gutenberg_class,$repair_style );
			//wp-block-embed__wrapper 
		}

		/*
		 * https://www.mixcloud.com/
		 */
		if ( preg_match( '!(mixcloud.com)!', $url ) ) {
			return sprintf( '<%2$s class=" rd-mixcloud clearfix %3$s" %4$s><div>%1$s</div></%2$s>', $html, $element, $not_exists_gutenberg_class,$repair_style );
			//wp-block-embed__wrapper
		}
		/**
		 * https://www.reddit.com/
		 */
		if ( preg_match( '!(reddit.com)!', $url ) ) {
			return sprintf( '<%2$s class="rd-reddit clearfix"><div>%1$s</div></%2$s>', $html, $element );
		}
		/**
		 * https://www.screencast.com/
		 * @since 1.480
		 */
		if ( preg_match( '!(screencast.com)!', $url ) ) {
			return sprintf( '<%2$s class="rd-screencast clearfix"><div>%1$s</div></%2$s>', $html, $element );
		}
		/**
		 * note: 4:3 ratio can use .rd-ratio-075
		 */
		if ( !preg_match( '!(twitter.com|tumblr.com|speakerdeck)!', $url ) && !preg_match( '!(wp-embedded-content)!', $html ) ) {
			return sprintf( '<%2$s class="clearfix %3$s" %4$s>%1$s</%2$s>', $html, $element, $not_exists_gutenberg_class, $repair_style );
			//wp-block-embed__wrapper 
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

if ( !isset( $wp_customize ) ) {
	/**
	 * @1.254
	 */
	add_action( 'after_setup_theme', 'raindrops_setup_style_loader' );
}

if ( ! function_exists( 'raindrops_setup_style_loader' ) ) {

	/**
	 * @1.254
	 */
	function raindrops_setup_style_loader() {
		global $raindrops_stylesheet_type;

		if ( !isset( $raindrops_stylesheet_type ) ) {

			$raindrops_stylesheet_type = raindrops_warehouse_clone( 'raindrops_stylesheet_in_html' );
		}

		if ( $raindrops_stylesheet_type == 'external' ) {
			//@ see line:501 query var
			add_action( 'wp_enqueue_scripts', 'raindrops_register_color_type_style', 99 );
			add_action( 'template_redirect', 'raindrops_color_type_style_buffer' );
		}
	}

}
add_action( 'send_headers', 'raindrops_dinamic_css_header' );

add_action( 'save_post', 'raindrops_blog_last_modified_date', 10, 2 );

if ( ! function_exists( 'raindrops_blog_last_modified_date' ) ) {
	/**
	 *
	 * @param type $post_id
	 * @param type $post
	 */
	function raindrops_blog_last_modified_date( $post_id, $post ) {

		if ( $post->post_type == 'post' || $post->post_type == 'page' ) {
			set_theme_mod( 'raindrops_blog_last_modified_date', gmdate( 'D, d M Y H:i:s \G\M\T', time() ) );
		}
	}

}

if ( ! function_exists( 'raindrops_dinamic_css_header' ) ) {
	/**
	 *
	 * @param type $headers
	 */
	function raindrops_dinamic_css_header( $headers ) {

		$query_string = filter_input( INPUT_ENV, 'QUERY_STRING' );

		if ( preg_match( '!raindrops_color_type=1!', $query_string ) ) {

			header( 'Content-type: text/css' );
			header( "Cache-Control: public, maxage=3600" );
			header( 'Expires: ' . gmdate( 'D, d M Y H:i:s \G\M\T', time() + 3600 ) );
			header( "Pragma: cache" );
			$last_modified = get_theme_mod( 'raindrops_blog_last_modified_date' );
			if ( !empty( $last_modified ) ) {
				header( 'Last-Modified:' . $last_modified );
			} else {
				header( 'Last-Modified:' . gmdate( 'D, d M Y H:i:s \G\M\T', time() ) );
			}
		}
	}

}

if ( ! function_exists( 'raindrops_register_color_type_style' ) ) {

	/**
	 *
	 * @global type $raindrops_current_data_version
	 * @1.254
	 */
	function raindrops_register_color_type_style() {

		global $raindrops_current_data_version, $post, $posts, $raindrops_current_column;

		$query	 = '';
		$count	 = count( $posts );
		if ( isset( $post ) && $count == 1 ) {

			$query = sprintf( '&amp;raindrops_pid=%1$s', $post->ID );
		}
		$version = md5( raindrops_embed_css() );

		wp_register_style( 'raindrops_color_type', sprintf( '/?%1$s=1%2$s&amp;qcAC=1', 'raindrops_color_type', $query ), array(), $version );
		wp_enqueue_style( 'raindrops_color_type' );
	}

}
if ( ! function_exists( 'raindrops_color_type_style_buffer' ) ) {

	/**
	 * @1.254
	 */
	function raindrops_color_type_style_buffer() {
		global $raindrops_fallback_human_interface_show, $post, $raindrops_current_column;

		if ( intval( get_query_var( 'raindrops_color_type' ) ) == 1 ) {
			if ( $raindrops_fallback_human_interface_show == true ) {
				exit;
			}

			do_action( 'raindrops_external_css_pre' );

			$style = apply_filters( 'raindrops_color_type_style_buffer', raindrops_embed_css() );

			if ( is_child_theme() && function_exists( 'raindrops_child_embed_css' ) ) {
				$style = apply_filters( 'raindrops_color_type_style_buffer', raindrops_child_embed_css() );
				/* 1.304 todo structure change for external css */
			}

			if ( !defined( 'WP_DEBUG' ) || WP_DEBUG == false ) {

				//$style = preg_replace('!('. wp_spaces_regexp() .'){2,}!', ' ', $style );
			}
			ob_start();
			$css = $style;
			$css = wp_kses( $css, array() );
			$css = wp_strip_all_tags( $css );
			echo $css;
			exit;
			ob_clean();
		}
	}

}
if ( ! function_exists( 'raindrops_unique_entry_title' ) ) {
	/**
	 *
	 * @global type $post
	 * @param type $postid
	 * @param type $echo
	 * @return type
	 */
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
	/**
	 *
	 * @global type $raindrops_current_theme_name
	 * @global type $raindrops_current_data_theme_uri
	 * @global type $template
	 * @global type $raindrops_accessibility_link
	 * @return type
	 */
	function raindrops_footer_text() {

		global $raindrops_current_theme_name, $raindrops_current_data_theme_uri, $template, $raindrops_accessibility_link;

		$raindrops_custom_footer_credit = raindrops_warehouse_clone( 'raindrops_custom_footer_credit' );

		if ( !empty( $raindrops_custom_footer_credit ) ) {

			$current_year = date( 'Y' );
			echo str_replace( '%current_year%', $current_year, $raindrops_custom_footer_credit );
			return;
		}

		$raindrops_copyright_text = sprintf( apply_filters( 'raindrops_copyright_text', '&#169;%1$s ' . $raindrops_current_theme_name . ' ' ), date( "Y" ) );

		$raindrops_address_html = '<address>';

		$raindrops_address_html .= apply_filters( 'raindrops_prepend_footer_address', '' );

		$raindrops_address_rss = "\n" . str_repeat( "\t", 2 ) . '<small>%1$s<a href="%2$s" class="entry-rss">%3$s</a>' .
		"\n" . str_repeat( "\t", 3 ) . '<span>' . esc_html__( 'and', 'raindrops' ) . '</span>' .
		"\n" . str_repeat( "\t", 2 ) . '<a href="%4$s" class="comments-rss">%5$s</a>';

		$raindrops_address_html .= sprintf( $raindrops_address_rss, $raindrops_copyright_text, get_bloginfo( 'rss2_url' ), esc_html__( "Entries RSS", 'raindrops' ), get_bloginfo( 'comments_rss2_url' ), esc_html__( 'Comments RSS', 'raindrops' )
		);

		$raindrops_address_html .= '</small> ';

		if ( is_child_theme() ) {

			$raindrops_theme_name = 'Child theme ' . esc_html( ucwords( $raindrops_current_theme_name ) ) . ' of ' . esc_html__( "Raindrops Theme", 'raindrops' );
		} else {

			$raindrops_theme_name = esc_html__( "Raindrops Theme", 'raindrops' );
		}

		$raindrops_address_html .= sprintf( "\n" . str_repeat( "\t", 2 ) . '<small><a href="%s">%s</a></small> ', $raindrops_current_data_theme_uri, $raindrops_theme_name
		);
		/* @1.519 Privacy Policy */
		$raindrops_wp_page_for_privacy_policy = get_option( 'wp_page_for_privacy_policy' );

		if ( ! empty( $raindrops_wp_page_for_privacy_policy ) && function_exists( 'get_the_privacy_policy_link' ) ) {

			$raindrops_address_html .= get_the_privacy_policy_link('&nbsp;<small>','</small>');
		}

		$raindrops_address_html .= apply_filters( 'raindrops_append_footer_address', '' );

		$raindrops_address_html .= "\n" . str_repeat( "\t", 1 ) . '</address>';

		echo apply_filters( 'raindrops_footer_text', $raindrops_address_html );
	}

}

if ( ! function_exists( 'raindrops_wp_headers' ) ) {
	/**
	 *
	 * @global type $raindrops_xhtml_media_type
	 * @param string $headers
	 * @return string
	 */
	function raindrops_wp_headers( $headers ) {

		global $raindrops_xhtml_media_type;

		/**
		 * xhtml media type
		 * value 'application/xhtml+xml' or 'text/html'
		 */
		if ( !isset( $raindrops_xhtml_media_type ) ) {

			$raindrops_xhtml_media_type = raindrops_warehouse_clone( 'raindrops_xhtml_media_type' );
		}
		if ( !is_admin() && !is_user_logged_in() && 'xhtml' == raindrops_warehouse_clone( 'raindrops_doc_type_settings' ) && $raindrops_xhtml_media_type == 'application/xhtml+xml' ) {

			$headers[ "Content-Type" ] = $raindrops_xhtml_media_type . '; charset=' . get_bloginfo( 'charset' );
			add_filter( 'option_html_type', 'raindrops_xhtml_media_type', 10 );
		}

		return $headers;
	}

}
if ( ! function_exists( 'raindrops_xhtml_media_type' ) ) {
	/**
	 *
	 * @global type $raindrops_xhtml_media_type
	 * @param type $type
	 * @return \type
	 */
	function raindrops_xhtml_media_type( $type ) {
		global $raindrops_xhtml_media_type;

		if ( !is_admin() && !is_user_logged_in() && 'xhtml' == raindrops_warehouse_clone( 'raindrops_doc_type_settings' ) && $raindrops_xhtml_media_type == 'application/xhtml+xml' ) {

			return $raindrops_xhtml_media_type;
		}
		return $type;
	}

}
if ( ! function_exists( 'raindrops_xhtml_http_equiv' ) ) {
	/**
	 *
	 * @global type $raindrops_xhtml_media_type
	 * @param type $output
	 */
	function raindrops_xhtml_http_equiv( $output = true ) {
		global $raindrops_xhtml_media_type;
		if ( $raindrops_xhtml_media_type == 'text/html' && 'xhtml' == raindrops_warehouse_clone( 'raindrops_doc_type_settings' ) ) {
			/**
			 * By already header (), htmltype and charset has been sent
			 */
			//	printf( '<meta http-equiv="content-type" content="'. get_bloginfo( 'html_type' ).'" charset="'. strtolower ( get_bloginfo( 'charset' ) ) .'" />'. "\n" );
			printf( '<meta http-equiv="content-script-type" content="text/javascript" />' . "\n" );
			printf( '<meta http-equiv="content-style-type" content="text/css" />' . "\n" );
		}
	}

}

add_action( 'save_post', 'raindrops_register_webfonts', 10, 3 );

if ( ! function_exists( 'raindrops_register_webfonts' ) ) {

	/**
	 *
	 * @param type $post_ID
	 * @param type $post
	 * @param type $update
	 * @return boolean
	 * @1.264
	 */
	function raindrops_register_webfonts( $post_ID, $post, $update ) {

		if ( !current_user_can( 'edit_posts' ) ) {
			return false;
		}

		$early_access			 = array( 'notosansjp', 'sawarabimincho', 'kokoro', 'sawarabigothic', 'nikukyu', 'roundedmplus1c', 'hannari', 'mplus1p', 'nicomoji', 'alefhebrew', 'amiri', 'dhurjati', 'dhyana', 'droidarabickufi', 'droidarabicnaskh', 'droidsansethiopic', 'droidsanstamil', 'droidsansthai', 'droidserifthai', 'gidugu', 'gurajada', 'hanna', 'jejugothic', 'jejuhallasan', 'jejumyeongjo', 'karlatamilinclined', 'karlatamilupright', 'kopubbatang', 'lakkireddy', 'laomuangdon', 'laomuangkhong', 'laosanspro', 'lateef', 'lohitbengali', 'lohitdevanagari', 'lohittamil', 'mallanna', 'mandali', 'myanmarsanspro', 'nats', 'ntr', 'nanumbrushscript', 'nanumgothic', 'nanumgothiccoding', 'nanummyeongjo', 'nanumpenscript', 'notokufiarabic', 'notonaskharabic', 'notonastaliqurdudraft', 'notosansarmenian', 'notosansbengali', 'notosanscherokee', 'notosansdevanagari', 'notosansdevanagariui', 'notosansethiopic', 'notosansgeorgian', 'notosansgujarati', 'notosansgurmukhi', 'notosanshebrew', 'notosansjapanese', 'notosanskannada', 'notosanskhmer', 'notosanskufiarabic', 'notosanslao', 'notosanslaoui', 'notosansmalayalam', 'notosansmyanmar', 'notosansosmanya', 'notosanssinhala', 'notosanstamil', 'notosanstamilui', 'notosanstelugu', 'notosansthai', 'notosansthaiui', 'notoserifarmenian', 'notoserifgeorgian', 'notoserifkhmer', 'notoseriflao', 'notoserifthai', 'opensanshebrew', 'opensanshebrewcondensed', 'padauk', 'peddana', 'phetsarath', 'ponnala', 'ramabhadra', 'raviprakash', 'scheherazade', 'souliyo', 'sreekrushnadevaraya', 'suranna', 'suravaram', 'tenaliramakrishna', 'thabit', 'tharlon', 'cwtexfangsong', 'cwtexhei', 'cwtexkai', 'cwtexming' );
		$flag_early_access		 = false;
		$include_fonts			 = '';
		$link_html				 = '<link rel="stylesheet" id="%2$s" href="%1$s" type="text/css" media="all" />' . "\n";
		$url					 = apply_filters( 'google_fonts_endpoint_url', '//fonts.googleapis.com/css' );
		$secondary				 = '';
		$separator				 = '';
		$mid_name				 = '';
		$has_mid_name			 = array();
		$web_font_styles		 = '';
		$font_for_style_italic	 = '';
		$font_for_style_weight	 = '';

		if ( preg_match_all( '!class="([^\"]*)(google-font-)([a-z0-9-]+)([^\"]*)"!', $post->post_title . $post->post_content, $regs, PREG_SET_ORDER ) ) {

			if ( isset( $regs ) && !empty( $regs ) ) {
				foreach ( $regs as $reg ) {

					if ( strstr( $reg[ 3 ], '-' ) ) {
						if ( count( $has_mid_name = explode( '-', $reg[ 3 ] ) ) == 3 ) {

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
					$mid_name	 = preg_replace( '![0-9]00(i)?!', '', $mid_name );

					if ( true == array_search( $primary . $mid_name . $secondary, $early_access ) ) {

						$flag_early_access = true;
					}

					if ( !empty( $has_mid_name ) ) {
						$font_name		 = ucfirst( $primary ) . ' ' . ucfirst( $mid_name ) . ' ' . ucfirst( $secondary ) . $separator . $weight_and_italic_values;
						$font_for_style	 = ucfirst( $primary ) . ' ' . ucfirst( $mid_name ) . ' ' . ucfirst( $secondary );
						;
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
							if ( !empty( $weight_and_italic_values ) ) {

								if ( strstr( $weight_and_italic_values, 'italic' ) ) {
									$font_for_style_italic = 'font-style: italic;';
								}
								if ( preg_match( '!([0-9]00)(i)?!', $weight_and_italic_values, $font_weight_value ) ) {
									$font_for_style_weight = 'font-weight: ' . absint( $font_weight_value[ 1 ] ) . ';';
								}
							}
						}
						/* @since 1.486 */
						$fallback_font = apply_filters('raindrops_fallback_google_font', 'sans-serif', $font_for_style );

						$web_font_styles = str_replace( 'html .mce-content-body .google-font-' . sanitize_html_class( $reg[ 3 ] ) . ', .hfeed .google-font-' . sanitize_html_class( $reg[ 3 ] ) . '{ font-family:"' . $font_for_style . '", '. $fallback_font. ';' .
						$font_for_style_italic .
						$font_for_style_weight .
						'}' . "\n", '', $web_font_styles );

						$web_font_styles .= 'html .mce-content-body .google-font-' . sanitize_html_class( $reg[ 3 ] ) . ', .hfeed .google-font-' . sanitize_html_class( $reg[ 3 ] ) . '{ font-family:"' . $font_for_style . '", '. $fallback_font. ';' .
						$font_for_style_italic .
						$font_for_style_weight .
						'}' . "\n";
					}

					$query_val = str_replace( '%2B', '+', urlencode( $font_name ) );

					if ( preg_match( '!(font-effect-)([a-z-)]+)!', $reg[ 0 ], $effect ) ) {

						$font_url = add_query_arg( array( 'family' => $query_val, 'effect' => urlencode( $effect[ 2 ] ) ), $url );
					} else {

						$font_url = add_query_arg( 'family', $query_val, $url );
					}
					$font_url = str_replace( '&', '&amp;', $font_url );

					$id = $reg[ 3 ];


					if ( !empty( $effect[ 2 ] ) ) {
						$id = $id . '-' . $effect[ 2 ];
					}
					if ( true == $flag_early_access ) {

						$font_url = '//fonts.googleapis.com/earlyaccess/';
						$font_url .= str_replace( ' ', '', strtolower( $font_name . '.css' ) );

						$font_url	 = str_replace( $separator . $weight_and_italic_values, '', $font_url );

						$id			 = str_replace( $weight_and_italic_values, '', $id );

						$include_fonts = str_replace( sprintf( $link_html, $font_url, 'google-font-early-' . sanitize_html_class( $id ) . '-css' ), '', $include_fonts );
						$include_fonts .= sprintf( $link_html, $font_url, 'google-font-early-' . sanitize_html_class( $id ) . '-css' );
					} else {
						$include_fonts = str_replace( sprintf( $link_html, $font_url, 'google-font-' . sanitize_html_class( $id ) . '-css' ), '', $include_fonts );
						$include_fonts .= sprintf( $link_html, $font_url, 'google-font-' . sanitize_html_class( $id ) . '-css' );
					}

					unset( $regs );
					$primary					 = '';
					$secondary					 = '';
					$separator					 = '';
					$weight_and_italic_values	 = '';
					$font_name					 = '';
					$font_url					 = '';
					$font_for_style_italic		 = '';
					$font_for_style_weight		 = '';
					$mid_name					 = '';
					$has_mid_name				 = array();
					$flag_early_access			 = false;
				}

				/* patch 1.272 */
				$include_fonts = str_replace( '++', '+', $include_fonts );

					update_post_meta( $post_ID, '_web_fonts_link_element', $include_fonts );
					update_post_meta( $post_ID, '_web_fonts_styles', $web_font_styles );

			}
		} else {
				delete_post_meta( $post_ID, '_web_fonts_link_element' );
				delete_post_meta( $post_ID, '_web_fonts_styles' );
		}

	}

}


if ( ! function_exists( 'raindrops_tiny_mce_before_init' ) ) {
	/**
	 *
	 * @param array $init_array
	 * @return string
	 * @since 1.264
	 */
	function raindrops_tiny_mce_before_init( $init_array ) {

		$load_editor_css_setting = raindrops_warehouse_clone( 'raindrops_sync_style_for_tinymce' );

		if( 'yes' !== $load_editor_css_setting ) {

			return $init_array;
		}

		$separator = '';

		if ( ! empty( $init_array['content_css'] ) ) {

			$separator = ',';
		} else {

			$init_array['content_css'] = '';
		}
		$init_array['content_css'] = trim( $init_array['content_css'], ',' ) . $separator . raindrops_google_fonts_for_tinymce();

		return $init_array;
	}

}

if ( ! function_exists( 'raindrops_google_fonts_for_tinymce' ) ) {

	/**
	 *
	 * @global type $post
	 * @return type
	 * @since 1.264
	 */
	function raindrops_google_fonts_for_tinymce() {
		global $post;
		if ( raindrops_warehouse_clone( 'raindrops_sync_style_for_tinymce' ) !== 'yes' ) {
			return;
		}
		if( ! is_object( $post ) ) {
			$post_id = filter_input(INPUT_GET, 'post_id', FILTER_VALIDATE_INT );

			if( empty( $post_id ) ) {
			/* @since 1.482 for gutenberg */
			return;
			}
		} else {
			$post_id = absint( $post->ID );
		}

		$google_font_link_elements	 = get_post_meta( $post_id, '_web_fonts_link_element', true );
		$comma_separated_urls		 = '';
		if ( preg_match_all( '!href="([^"]+)"!', $google_font_link_elements, $regs, PREG_SET_ORDER ) ) {
			foreach ( $regs as $reg ) {
				$request_fonts  = apply_filters('raindrops_google_fonts_for_tinymce', $reg[1] );
				if( ! empty( $request_fonts ) ) {

					$comma_separated_urls .= ', ' . $request_fonts;
				}
			}
		}
		return trim( $comma_separated_urls, ',' );
	}

}

if ( ! function_exists( 'raindrops_editor_styles_callback' ) ) {

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
		$post_id		 = 0;


		if ( isset( $_REQUEST[ 'id' ] ) && !empty( $_REQUEST[ 'id' ] ) ) {
			$post_id = absint( $_REQUEST[ 'id' ] );

			$metabox_style	 = get_post_meta( $post_id, '_css', true );
			$metabox_style	 = str_replace( array( 'body', '.entry-content','article' ), array( 'no-body', 'html .mceContentBody', 'html .mceContentBody' ), $metabox_style );
			$style			 = get_post_meta( $post_id, '_web_fonts_styles', true );

			$result .= $style . $metabox_style;
		}

		$defined_colors					 = raindrops_embed_css();
		$defined_colors					 = str_replace( array( 'body', '.entry-content' ), array( 'no-body', 'html .mceContentBody' ), $defined_colors );
		$font_size						 = raindrops_warehouse_clone( 'raindrops_basefont_settings' );
		$font_color						 = raindrops_warehouse_clone( 'raindrops_default_fonts_color' );
		$link_color						 = raindrops_warehouse_clone( 'raindrops_hyperlink_color' );
		$raindrops_content_width_setting = raindrops_warehouse_clone( 'raindrops_content_width_setting' );
		$raindrops_page_width			 = raindrops_warehouse_clone( 'raindrops_page_width' );

		if ( 'keep' !== $raindrops_content_width_setting ) {
			/* @since 1.462 */
			if( 'doc3' == $raindrops_page_width ) {

				$raindrops_editor_styles_width = raindrops_warehouse_clone( 'raindrops_fluid_max_width' );
			} elseif( 'doc5' == $raindrops_page_width ) {

				$raindrops_editor_styles_width = raindrops_warehouse_clone( 'raindrops_full_width_max_width' );
			} else {

				$raindrops_editor_styles_width = $content_width;
			}
		} else {

			$raindrops_editor_styles_width = $content_width;
		}

		$raindrops_editor_styles_width	 = apply_filters( 'raindrops_editor_styles_width', $raindrops_editor_styles_width, $post_id );
		$editor_custom_styles			 = 'html .mceContentBody{max-width:' . $raindrops_editor_styles_width . 'px;}' . "\n";
		$editor_custom_styles .= 'html .mceContentBody{font-size:' . $font_size . 'px;}' . "\n";

		if( 'custom' == raindrops_warehouse_clone( 'raindrops_color_select' ) ) {
			/* @since 1.480 */
			$flag = true;
		} else {
			$flag = false;
		}

		if ( isset( $font_color ) && !empty( $font_color ) && true == $flag) {
			$editor_custom_styles .= 'html .mceContentBody.mce-content-body{color:' . $font_color . ';}' . "\n";
		}
		if ( isset( $link_color ) && !empty( $link_color ) && true == $flag) {
			$editor_custom_styles .= 'html .mceContentBody a{color:' . $link_color . ';}' . "\n";
		}
		/* @1.462 Add */

		header( 'Content-type: text/css' );
		echo $editor_custom_styles;
		echo apply_filters( 'raindrops_editor_styles_callback', $result );
		echo $defined_colors;
		echo $metabox_style;
		die();
	}

}
if ( ! function_exists( 'raindrops_get_pinup_widget_ids' ) ) {

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

					if ( is_array( $val_array ) ) {
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


if ( ! function_exists( 'raindrops_apply_pinup_styles' ) ) {
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
if ( ! function_exists( 'raindrops_pinup_widget_ids_to_post_ids' ) ) {

	/**
	 *
	 * @param type $ids
	 * @return boolean
	 * @since 1.265
	 */
	function raindrops_pinup_widget_ids_to_post_ids( $ids ) {

		$widget_array			 = get_option( 'widget_raindrops_pinup_entry_widget' );
		$raindrops_pinup_post_id = array();

		if ( is_array( $ids ) ) {
			foreach ( $ids as $id ) {
				if ( isset( $widget_array[ $id ][ "id" ] ) ) {
					$raindrops_pinup_post_id[] = $widget_array[ $id ][ "id" ];
				}
			}
			return $raindrops_pinup_post_id;
		}
		return false;
	}

}

if ( ! function_exists( 'raindrops_pinup_parse_styles' ) ) {

	/**
	 *
	 * @param type $id
	 * @return string
	 * @since 1.265
	 */
	function raindrops_pinup_parse_styles( $id ) {

		$id_prefix				 = 'pinup-';
		$widget_array			 = get_option( 'widget_raindrops_pinup_entry_widget' );
		$styles					 = $widget_array[ $id ][ "inline_style" ];
		$raindrops_pinup_post_id = $widget_array[ $id ][ "id" ];
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

if ( isset( $wp_customize ) ) {

	add_filter( 'raindrops_embed_meta_css', 'raindrops_pinup_entry_style' );
}

if ( ! function_exists( 'raindrops_pinup_entry_style' ) ) {

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

if ( ! function_exists( 'raindrops_add_header_archive_description' ) && function_exists( 'get_the_archive_description' ) ) {

	/**
	 *
	 * @since1.272
	 */
	function raindrops_add_header_archive_description() {

		if ( is_category() || is_tag() ) {

			$html = '<meta name="%1$s" content="%2$s" />' . "\n";

			$raindrops_archive_description_length	 = apply_filters( 'raindrops_archive_description_length', 115 );
			$description							 = apply_filters( 'raindrops_category_description', get_the_archive_description() );
			$description							 = wp_kses( $description, array() );
			$description							 = wp_html_excerpt( $description, $raindrops_archive_description_length, '' );

			if ( !empty( $description ) ) {
				$result = sprintf( $html, 'description', $description );
				echo apply_filters( 'raindrops_add_header_archive_description', $result );
			}
		}
	}

}

if ( ! function_exists( 'raindrops_show_one_column' ) ) {
	/**
	 * fallback function renema but child theme or custom user
	 * @return type
	 */
	function raindrops_show_one_column() {

		_deprecated_function( __FUNCTION__, '1.272', 'raindrops_column_controller()' );

		return raindrops_column_controller();
	}

}

if ( ! function_exists( 'raindrops_add_class' ) ) {
	/**
	 *
	 * @param type $id
	 * @param type $echo
	 * @return type
	 */
	function raindrops_add_class( $id = 'yui-u first', $echo = false ) {

		_deprecated_function( __FUNCTION__, '1.272', 'raindrops_dinamic_class()' );

		if ( false == $echo ) {
			return raindrops_dinamic_class( $id		 = 'yui-u first', $echo	 = false );
		} else {
			echo raindrops_dinamic_class( $id		 = 'yui-u first', $echo	 = false );
		}
	}

}

if ( ! function_exists( 'raindrops_category_navigation' ) ) {
	/**
	 *
	 * @global type $raindrops_category_navigation
	 * @return type
	 */
	function raindrops_category_navigation() {

		global $raindrops_category_navigation;

		if ( isset( $raindrops_category_navigation ) && false == $raindrops_category_navigation ) {

			return;
		}

		$result	 = '';
		$tmp_id	 = get_query_var( 'cat' );
		$tmp_id	 = absint( $tmp_id );
		$sibling = '';

		$tmp_parent = get_category_parents( $tmp_id, true, ' &#187; ' );

		if ( !is_object( $tmp_parent ) && strip_tags( $tmp_parent ) !== get_the_category_by_ID( $tmp_id ) . ' &#187; ' ) {

			$tmp_parent	 = trim( $tmp_parent, ' &#187; ' );
			$result		 = preg_replace( '!<a[^>]+>' . get_the_category_by_ID( $tmp_id ) . '</a>!', '', $tmp_parent );

			$result .= sprintf( '<span class="current">%1$s</span> &#187; ', get_the_category_by_ID( $tmp_id ) );
		}

		$tmp_child_ids = get_term_children( $tmp_id, 'category' );

		if ( isset( $tmp_child_ids ) && !empty( $tmp_child_ids ) ) {

			foreach ( $tmp_child_ids as $tmp_id ) {

				$tmp_id = absint( $tmp_id );

				$term = get_term_by( 'id', $tmp_id, 'category' );

				$url = esc_url( get_term_link( $tmp_id, 'category' ) );

				if ( is_wp_error( $url ) ) {
					continue;
				}

				if ( false !== $term && isset( $term->parent ) ) {

					if ( $sibling == $term->parent ) {
						$category_separator	 = '|';
						$flag				 = 'sibling';
					} else {
						$category_separator	 = "&#187;";
						$flag				 = 'parent';
					}

					$category_separator = apply_filters( 'raindrops_category_navigation_separator', $category_separator, $flag );

					$result .= " {$category_separator} " . '<a href="' . esc_url( $url ) . '"><span class="cat-item cat-item-' . $tmp_id . '">' . esc_html( $term->name ) . "</span></a>";

					$sibling = $term->parent;
				}
			}
		}

		$result = str_replace( '&#187;  &#187;', '&#187;', $result );

		return apply_filters( 'raindrops_category_navigation', '<div class="raindrops-category-navigation">' . trim( $result, ' &#187; ' ) . '</div>' );
	}

}


if ( ! function_exists( 'raindrops_post_category_relation' ) ) {
	/**
	 *
	 * @global type $post
	 * @return type
	 */
	function raindrops_post_category_relation() {
		global $post;

		// @1.416 todo

		$result		 = array();
		$tmp_id		 = absint( get_query_var( 'cat' ) );
		$categories	 = get_the_category( $post->ID );

		foreach ( $categories as $category ) {
			$category->term_id	 = absint( $category->term_id );
			$parents			 = get_category_parents( $category->term_id, true, '&#187;' );

			$parents_item = str_replace( '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . $category->name . "</a>&#187;", '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '"><span class="cat-item cat-item-' . absint( $category->term_id ) . '">' . $category->name . "</a>&#187;", $parents );

			$parents = explode( '&#187;', $parents_item );

			if ( !empty( $parents_item ) ) {
				//$result[] = '<span class="label title parent">'.esc_html__('Parent Category:','raindrops' ).'</span>';
			}

			foreach ( $parents as $links ) {

				$result[] = $links;
			}

			$replace_check	 = get_the_category_by_ID( $category->term_id );
			$replace_check	 = esc_url( get_category_link( $category->term_id ) );

			$tmp_child_ids = get_term_children( $category->term_id, 'category' );


			$child_result	 = '';
			$child_ready	 = array();
			if ( !empty( $tmp_child_ids ) ) {
				//$result[] = '<span class="label title child">'.esc_html__('Child Category:','raindrops' ).'</span>';

				foreach ( $tmp_child_ids as $tmp_id ) {

					$tmp_id	 = absint( $tmp_id );
					$term	 = get_term_by( 'id', $tmp_id, 'category' );
					//$result[]	 = '<a href="' . esc_url( get_term_link( $tmp_id, 'category' ) ) . '"><span class="cat-item cat-item-'. absint( $tmp_id ). '">' . $term->name . "</span></a>";
				}
			}
		}

		$result	 = array_unique( $result );
		$result	 = implode( ' ', $result );
		// @1.416 todo
		$result	 = preg_replace( '!<a[^>]+>[^<]+</a>!', '', $result );

		return apply_filters( 'raindrops_post_category_relation', rtrim( $result, ' &#187; ' ) );
	}

}
if ( ! function_exists( 'raindrops_article_wrapper_class' ) ) {

	/**
	 *
	 * @return string
	 * @since1.277
	 * todo: @1.333 works improperly when using cache plugin. needs client side add class.
	 * test code: raindrops-helper.js line:4 test code...
	 */
	function raindrops_article_wrapper_class() {
		global $post;
		$class = array();
		if ( isset( $post ) && preg_match( '!<[^>]*?(lang-ja|lang-not-ja)[^>]*?>!', $post->post_content ) ) {

			$detect_lang = raindrops_get_accept_language();

			if ( !empty( $detect_lang ) ) {

				array_push( $class, 'rd-l-' . $detect_lang );
			}
		}
		if ( isset( $post ) && preg_match( "!\[raindrops[^\]]+(class)=(\"|')*?([^\"']+)(\"|')*?[^\]]*\]!si", $post->post_content, $matches ) ) {

			if ( isset( $matches[ 3 ] ) && !empty( $matches[ 3 ] ) ) {

				$classes = preg_split( "/[\s,]+/", $matches[ 3 ] );

				foreach ( $classes as $extend_class ) {

					array_push( $class, $extend_class );
				}
			}
		}

		return apply_filters( 'raindrops_article_wrapper_class', $class );
	}

}
if ( ! function_exists( 'raindrops_the_article_wrapper_class' ) ) {
	/**
	 *
	 * @global type $post
	 */
	function raindrops_the_article_wrapper_class() {
		global $post;

		$results = raindrops_article_wrapper_class();

		$result = array();

		if ( !empty( $results ) ) {

			foreach ( $results as $v ) {

				array_push( $result, sanitize_html_class( $v ) );
			}
		}

		$result = array_unique( $result );

		$result = trim( implode( ' ', $result ) );

		if ( !empty( $result ) ) {

			printf( ' class="%1$s"', $result );
		}
	}

}
if ( ! function_exists( 'raindrops_get_accept_language' ) ) {

	/**
	 *
	 * @return boolean
	 * @since 1.278
	 */
	function raindrops_get_accept_language() {

		$accept_language = filter_input( INPUT_ENV, "HTTP_ACCEPT_LANGUAGE" );

		if ( !is_null( $accept_language ) && isset( $accept_language ) ) {

			$browser_lang	 = $accept_language;
			$browser_lang	 = explode( ",", $browser_lang );
			$browser_lang	 = wp_strip_all_tags( $browser_lang[ 0 ] );

			if ( isset( $browser_lang ) ) {
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
	function raindrops_excerpt_id() {
		if ( is_singular() && true !== is_home() && true !== is_front_page() ) {
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
	function raindrops_excerpt_after_link( $content, $function ) {
		global $post;
		$raindrops_excerpt_more = raindrops_warehouse_clone( 'raindrops_read_more_after_excerpt' );

		if( strpos( get_the_content(), 'more-link' ) !== false ) {
			/**
			 * @since 1.470
			 */
			return $content;
		}

		$more_link_text = esc_html__( 'Continue&nbsp;reading ', 'raindrops' ) .
		'<span class="meta-nav">&#8594;</span><span class="more-link-post-unique">' .
		esc_html__( '&nbsp;Post ID&nbsp;', 'raindrops' ) . get_the_ID() . '</span>';

		$html	 = '<br class="clear raindrops-excerpt-more-before" /><div class="raindrops-excerpt-more pad-s corner"><a href="%1$s" rel="bookmark">%2$s</a></div>';
		$link	 = sprintf( $html, esc_url( get_permalink( $post->ID ) . '#read' ), $more_link_text );

		if ( $raindrops_excerpt_more == 'yes' && isset( $post ) && ( $function == 'raindrops_entry_content' || $function == 'raindrops_html_excerpt_with_elements' ) && !is_singular() ) {

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

		$raindrops_excerpt_condition		 = raindrops_detect_excerpt_condition();
		$raindrops_excerpt_enable			 = raindrops_warehouse_clone( 'raindrops_excerpt_enable' );
		$raindrops_allow_oembed_excerpt_view = raindrops_warehouse_clone( 'raindrops_allow_oembed_excerpt_view' );

		if ( true == $raindrops_excerpt_condition && 'yes' == $raindrops_excerpt_enable ) {

			if ( 'yes' == $raindrops_allow_oembed_excerpt_view ) {
				return $html;
			} else {
				return;
			}
		}

		return $html;
	}

}


if ( ! function_exists( 'raindrops_parse_webfonts' ) ) {

	/**
	 *
	 * @param type $post_ID
	 * @param type $post
	 * @param type $update
	 * @return boolean
	 * @1.264
	 */
	function raindrops_parse_webfonts( $data ) {

		if ( is_admin() && !current_user_can( 'edit_posts' ) ) {
			return false;
		}

		$early_access			 = array( 'alefhebrew', 'amiri', 'dhurjati', 'dhyana', 'droidarabickufi', 'droidarabicnaskh', 'droidsansethiopic', 'droidsanstamil', 'droidsansthai', 'droidserifthai', 'gidugu', 'gurajada', 'hanna', 'jejugothic', 'jejuhallasan', 'jejumyeongjo', 'karlatamilinclined', 'karlatamilupright', 'kopubbatang', 'lakkireddy', 'laomuangdon', 'laomuangkhong', 'laosanspro', 'lateef', 'lohitbengali', 'lohitdevanagari', 'lohittamil', 'mallanna', 'mandali', 'myanmarsanspro', 'nats', 'ntr', 'nanumbrushscript', 'nanumgothic', 'nanumgothiccoding', 'nanummyeongjo', 'nanumpenscript', 'notokufiarabic', 'notonaskharabic', 'notonastaliqurdudraft', 'notosansarmenian', 'notosansbengali', 'notosanscherokee', 'notosansdevanagari', 'notosansdevanagariui', 'notosansethiopic', 'notosansgeorgian', 'notosansgujarati', 'notosansgurmukhi', 'notosanshebrew', 'notosansjapanese', 'notosanskannada', 'notosanskhmer', 'notosanskufiarabic', 'notosanslao', 'notosanslaoui', 'notosansmalayalam', 'notosansmyanmar', 'notosansosmanya', 'notosanssinhala', 'notosanstamil', 'notosanstamilui', 'notosanstelugu', 'notosansthai', 'notosansthaiui', 'notoserifarmenian', 'notoserifgeorgian', 'notoserifkhmer', 'notoseriflao', 'notoserifthai', 'opensanshebrew', 'opensanshebrewcondensed', 'padauk', 'peddana', 'phetsarath', 'ponnala', 'ramabhadra', 'raviprakash', 'scheherazade', 'souliyo', 'sreekrushnadevaraya', 'suranna', 'suravaram', 'tenaliramakrishna', 'thabit', 'tharlon', 'cwtexfangsong', 'cwtexhei', 'cwtexkai', 'cwtexming' );
		$flag_early_access		 = false;
		$include_fonts			 = '';
		$link_html				 = '@import url(%1$s);' . "\n";
		$url					 = apply_filters( 'google_fonts_endpoint_url', '//fonts.googleapis.com/css' );
		$secondary				 = '';
		$separator				 = '';
		$mid_name				 = '';
		$has_mid_name			 = array();
		$web_font_styles		 = '';
		$font_for_style_italic	 = '';
		$font_for_style_weight	 = '';

		if ( preg_match_all( '!([^\s]*)(google-font-)([a-z0-9-]+)([^\s]*)!', $data, $regs, PREG_SET_ORDER ) ) {

			if ( isset( $regs ) && !empty( $regs ) ) {
				foreach ( $regs as $reg ) {

					if ( strstr( $reg[ 3 ], '-' ) ) {
						if ( count( $has_mid_name = explode( '-', $reg[ 3 ] ) ) == 3 ) {

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
					$mid_name	 = preg_replace( '![0-9]00(i)?!', '', $mid_name );

					if ( true == array_search( $primary . $mid_name . $secondary, $early_access ) ) {

						$flag_early_access = true;
					}

					if ( !empty( $has_mid_name ) ) {
						$font_name		 = ucfirst( $primary ) . ' ' . ucfirst( $mid_name ) . ' ' . ucfirst( $secondary ) . $separator . $weight_and_italic_values;
						$font_for_style	 = ucfirst( $primary ) . ' ' . ucfirst( $mid_name ) . ' ' . ucfirst( $secondary );
						;
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
							if ( !empty( $weight_and_italic_values ) ) {

								if ( strstr( $weight_and_italic_values, 'italic' ) ) {
									$font_for_style_italic = 'font-style: italic;';
								}
								if ( preg_match( '!([0-9]00)(i)?!', $weight_and_italic_values, $font_weight_value ) ) {
									$font_for_style_weight = 'font-weight: ' . absint( $font_weight_value[ 1 ] ) . ';';
								}
							}
						}
						$fallback_font = apply_filters('raindrops_fallback_google_font', 'sans-serif', $font_for_style );


						$web_font_styles = str_replace( '.mce-content-body .google-font-' . sanitize_html_class( $reg[ 3 ] ) . ', .hfeed .google-font-' . sanitize_html_class( $reg[ 3 ] ) . ', h1.google-font-' . sanitize_html_class( $reg[ 3 ] ) . ' span{ font-family:"' . $font_for_style . '", '. $fallback_font. ';' .
						$font_for_style_italic .
						$font_for_style_weight .
						'}' . "\n", '', $web_font_styles );
						$web_font_styles .= '.mce-content-body .google-font-' . sanitize_html_class( $reg[ 3 ] ) . ', .hfeed .google-font-' . sanitize_html_class( $reg[ 3 ] ) . ', .google-font-' . sanitize_html_class( $reg[ 3 ] ) . ' span{ font-family:"' . $font_for_style . '", '. $fallback_font. ';' .
						$font_for_style_italic .
						$font_for_style_weight .
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


					if ( !empty( $effect[ 2 ] ) ) {
						$id = $id . '-' . $effect[ 2 ];
					}
					if ( true == $flag_early_access ) {

						//$font_url = 'http://fonts.googleapis.com/earlyaccess/';
						$font_url = 'https://fonts.google.com/earlyaccess';
						$font_url .= str_replace( ' ', '', strtolower( $font_name . '.css' ) );

						$font_url	 = str_replace( $separator . $weight_and_italic_values, '', $font_url );
						$id			 = str_replace( $weight_and_italic_values, '', $id );

						$include_fonts = str_replace( sprintf( $link_html, $font_url, 'google-font-early-' . sanitize_html_class( $id ) . '-css' ), '', $include_fonts );
						$include_fonts .= sprintf( $link_html, $font_url );
					} else {
						$include_fonts = str_replace( sprintf( $link_html, $font_url, 'google-font-' . sanitize_html_class( $id ) . '-css' ), '', $include_fonts );
						$include_fonts .= sprintf( $link_html, $font_url );
					}

					unset( $regs );
					$primary					 = '';
					$secondary					 = '';
					$separator					 = '';
					$weight_and_italic_values	 = '';
					$font_name					 = '';
					$font_url					 = '';
					$font_for_style_italic		 = '';
					$font_for_style_weight		 = '';
					$mid_name					 = '';
					$has_mid_name				 = array();
					$flag_early_access			 = false;
				}

				/* patch 1.272 */
				$include_fonts = str_replace( '++', '+', $include_fonts );

				return array( 'import_rule' => $include_fonts, 'apply_style' => $web_font_styles );
			}
		}
	}

}
if ( ! function_exists( 'raindrops_get_classes_from_primary_menu' ) ) {

	/**
	 *
	 * @return boolean
	 * @since1.278
	 */
	function raindrops_get_classes_from_primary_menu() {

		$menu_slug	 = 'primary';
		$locations	 = get_nav_menu_locations();

		if ( isset( $locations[ $menu_slug ] ) ) {
			$menu_id		 = $locations[ $menu_slug ];
			$items			 = wp_get_nav_menu_items( $menu_id );
			$class_strings	 = '';
			if ( isset( $items ) && !empty( $items ) ) {

				foreach ( $items as $val ) {
					if ( isset( $val->classes ) && is_array( $val ) ) {
						$class_strings .= ' ' . implode( ',', $val->classes ) . ' ';
					}
				}

				return esc_attr( $class_strings );
			} else {
				return false;
			}
		}
		return false;
	}

}
if ( ! function_exists( 'raindrops_apply_google_font_import_rule_for_article_title' ) ) {

	/**
	 *
	 * @param type $css
	 * @return type
	 * @since 1.278
	 */
	function raindrops_apply_google_font_import_rule_for_article_title( $css ) {

		$setting_value	 = raindrops_warehouse_clone( 'raindrops_article_title_css_class' );
		$fonts_get		 = raindrops_parse_webfonts( $setting_value );
		$import_rule	 = $fonts_get[ 'import_rule' ];

		if ( !empty( $import_rule ) ) {

			return wp_strip_all_tags( $import_rule . $css );
		}
		return $css;
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

		$setting_value	 = raindrops_warehouse_clone( 'raindrops_site_title_css_class' );
		$fonts_get		 = raindrops_parse_webfonts( $setting_value );
		$import_rule	 = $fonts_get[ 'import_rule' ];

		if ( !empty( $import_rule ) ) {

			return wp_strip_all_tags( $import_rule . $css );
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

		$fonts_get	 = raindrops_parse_webfonts( $setting_value );
		$import_rule = $fonts_get[ 'import_rule' ];

		if ( !empty( $import_rule ) ) {

			return wp_strip_all_tags( $import_rule . $css );
		}
		return $css;
	}

}
if ( ! function_exists( 'raindrops_apply_google_font_styles_for_article_title' ) ) {

	/**
	 *
	 * @param type $css
	 * @return type
	 * @since 1.278
	 */
	function raindrops_apply_google_font_styles_for_article_title( $css ) {
		$setting_value	 = raindrops_warehouse_clone( 'raindrops_article_title_css_class' );
		$fonts_get		 = raindrops_parse_webfonts( $setting_value );
		$style			 = $fonts_get[ 'apply_style' ];

		if ( !empty( $style ) ) {

			return wp_strip_all_tags( $style . $css );
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

		$setting_value	 = raindrops_warehouse_clone( 'raindrops_site_title_css_class' );
		$fonts_get		 = raindrops_parse_webfonts( $setting_value );
		$style			 = $fonts_get[ 'apply_style' ];

		if ( !empty( $style ) ) {

			return wp_strip_all_tags( $style . $css );
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

		$setting_value	 = raindrops_get_classes_from_primary_menu();
		$fonts_get		 = raindrops_parse_webfonts( $setting_value );
		$style			 = $fonts_get[ 'apply_style' ];

		if ( !empty( $style ) ) {

			return wp_strip_all_tags( $style . $css );
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
	function raindrops_is_place_of_site_title() {
		global $post;

		$raindrops_type_site_title = raindrops_warehouse_clone( 'raindrops_place_of_site_title' );

		if ( get_header_image() == false ) {

			raindrops_update_theme_option( 'raindrops_place_of_site_title', 'above' );
			$raindrops_type_site_title = 'above';
		}

		If ( $raindrops_type_site_title == 'header_image' ) {

			if ( isset( $post->ID ) ) {

				$display_header_image_file = get_post_meta( $post->ID, '_raindrops_this_header_image', true );
			}

			if ( isset( $post->ID ) && is_singular() && $display_header_image_file == 'hide' ) {

				return true;
			}

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

		If ( $setting_value == 'header_image' ) {
			return $content . raindrops_site_title();
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
			return $return_value . ' ' . wp_kses( $setting_value, array() );
		}
		return $return_value;
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
		global $post;
		$display_header_image_file = '';

		$style = apply_filters( 'raindrops_site_title_in_header_image_css', '', '#header-image #site-title, #raindrops_metaslider #site-title' );

		$setting_value = raindrops_warehouse_clone( 'raindrops_place_of_site_title' );

		If ( $setting_value == 'header_image' && get_header_image() !== false ) {

			if ( isset( $post->ID ) ) {
				$display_header_image_file = get_post_meta( $post->ID, '_raindrops_this_header_image', true );
			}

			if ( isset( $post->ID ) && is_singular() && $display_header_image_file == 'hide' ) {

				$style .= '#hd {display:block;}';
			} else {

				$style .= '#hd {display:none;}';
			}
		}

		$setting_value = raindrops_warehouse_clone( 'raindrops_tagline_in_the_header_image' );

		If ( $setting_value == 'hide' || $setting_value == 'above' ) {

			$style .= '#header-image .tagline{display:none;}';
		}

		$setting_value = raindrops_warehouse_clone( 'raindrops_site_title_font_size' );

		If ( is_numeric( $setting_value ) && $setting_value < 11 ) {

			$style .= '#header-image #site-title{font-size:' . $setting_value . 'vw;}';
		}

		$setting_value_left_type = raindrops_warehouse_clone( 'raindrops_site_title_left_margin_type' );

		if ( 'centered' == $setting_value_left_type ) {
			$setting_value_top = (float) raindrops_warehouse_clone( 'raindrops_site_title_top_margin' );
			$style .='#header-image #site-title, #raindrops_metaslider #site-title{position:absolute;left:0; right:0; margin-left: auto; margin-right: auto; text-align: center; top:' . $setting_value_top . '%; }';
		} elseif ( 'default' == $setting_value_left_type ) {

			$setting_value_top	 = (float) raindrops_warehouse_clone( 'raindrops_site_title_top_margin' );
			$setting_value_left	 = 1;

			if ( is_numeric( $setting_value_top ) && is_numeric( $setting_value_top ) ) {

				$style .='#header-image #site-title, #raindrops_metaslider #site-title{position:absolute;left:' . $setting_value_left . '%; top:' . $setting_value_top . '%; }';
			}
		} else {

			$setting_value_top	 = (float) raindrops_warehouse_clone( 'raindrops_site_title_top_margin' );
			$setting_value_left	 = (float) raindrops_warehouse_clone( 'raindrops_site_title_left_margin' );

			if ( is_numeric( $setting_value_top ) && is_numeric( $setting_value_top ) ) {

				$style .='#header-image #site-title, #raindrops_metaslider #site-title{position:absolute;left:' . $setting_value_left . '%; top:' . $setting_value_top . '%;}';
			}
		}

		return wp_strip_all_tags( $return_value . $style );
	}

}
if ( ! function_exists( 'raindrops_customizer_add_article_title_css_class' ) ) {

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
if ( ! function_exists( 'raindrops_customizer_hide_default_category' ) ) {

	/**
	 *
	 * @param type $css
	 * @return type
	 * @since 1.295
	 */
	function raindrops_customizer_hide_default_category( $css ) {

		$permalink_structure = get_option( 'permalink_structure' );
		$customizer_config	 = raindrops_warehouse_clone( 'raindrops_display_default_category' );

		$css_rule_set = '.entry-meta a[href$="%1$s/"],.entry-meta a[href$="%1$s"]{display:none;}';
		$css_rule_set .= '.author dd a[href$="%1$s/"],.author dd a[href$="%1$s"]{display:none;}';
		$css_rule_set .= '.format-status .entry-meta-list .category a, .category-blog .entry-meta-list .category a[href$="%1$s"]{display:none;}';

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
if ( ! function_exists( 'raindrops_customizer_hide_post_author' ) ) {

	/**
	 *
	 * @param type $css
	 * @return type
	 * @since 1.295
	 */
	function raindrops_customizer_hide_post_author( $css ) {
		$customizer_config = raindrops_warehouse_clone( 'raindrops_display_article_author' );

		if ( 'hide' == $customizer_config ) {
			$css_add = '.posted-on .author a,
				.ported-on .posted-by-string,
				div[class^="entry-meta"] .author a,
				div[class^="entry-meta"] .posted-by-string{display:none;}';
			return $css . $css_add;
		}
		return $css;
	}

}
if ( ! function_exists( 'raindrops_customizer_hide_post_date' ) ) {

	/**
	 *
	 * @param type $css
	 * @return type
	 * @since 1.295
	 */
	function raindrops_customizer_hide_post_date( $css ) {
		$customizer_config = raindrops_warehouse_clone( 'raindrops_display_article_publish_date' );

		if ( 'hide' == $customizer_config ) {
			$css_add = '.posted-on .posted-on-string,
				.posted-on .entry-date,
				div[class^="entry-meta"]  .posted-on-string,
				div[class^="entry-meta"] .entry-date{display:none;}';
			$css_add .= '.author time.entry-date{display:none;}';
			$css_add .= '.posted-on-after .posted-on-string,
				.posted-on-after .entry-date,
				div[class^="entry-meta"]  .posted-on-string,
				div[class^="entry-meta"] .entry-date{display:none;}';
			return $css . $css_add;
		}
		if ( 'emoji' == $customizer_config ) {
			$css_add = '.posted-on-after .posted-on-string,
				div[class^="entry-meta"] .posted-on-string,
				.posted-on .posted-on-string{display:none;}';

			return $css . $css_add;
		}

		return $css;
	}

}
if ( ! function_exists( 'raindrops_excerpt_length' ) ) {

	/**
	 *
	 * @param type $length
	 * @return type
	 * @since 1.296
	 */
	function raindrops_excerpt_length( $length ) {

		return absint( raindrops_warehouse_clone( 'raindrops_excerpt_length' ) );
	}

}
if ( ! function_exists( 'raindrops_import_parent_theme_mods' ) ) {

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

if ( ! function_exists( 'raindrops_recent_comments_avatar' ) ) {
	/**
	 *
	 * @global type $raindrops_recent_comments_avatar
	 * @param type $return
	 * @param type $author
	 * @param type $comment_ID
	 * @return type
	 */
	function raindrops_recent_comments_avatar( $return, $author, $comment_ID ) {

		global $raindrops_recent_comments_avatar;

		$core_avatar_setting = get_option( 'show_avatars' );

		if ( false == $raindrops_recent_comments_avatar || empty( $core_avatar_setting ) || is_admin() ) {
			return $return;
		}
		/**
		 * apply only widget
		 */
		if ( in_the_loop() ) {
			return $return;
		}
		$comment_object = get_comment( $comment_ID );

		if ( isset( $comment_object ) ) {

			$email_address	 = $comment_object->comment_author_email;
			$default_avatar	 = get_option( 'avatar_default' );
			$avatar			 = get_avatar( $email_address, 32, $default_avatar, $author );

			return $avatar . $return;
		}

		return $return;
	}

}

if ( ! function_exists( 'raindrops_localize_style_add' ) ) {

	/**
	 *
	 * @param type $style
	 * @return array
	 * @1.330
	 */
	function raindrops_localize_style_add( $style ) {

		$load_editor_css_setting = raindrops_warehouse_clone( 'raindrops_sync_style_for_tinymce' );

		if( 'yes' !== $load_editor_css_setting ) {
			/* @1.482 */
			return $style;
		}

		$locale = get_locale();

		if ( false !== ( $url = raindrops_locate_url( 'fonts.css' ) ) ) {
			$style[] = $url;
		}
		if ( false !== ( $url = raindrops_locate_url( 'languages/css/' . $locale . '.css' ) ) ) {
			$style[] = $url;
		}
		return $style;
	}

}
if ( ! function_exists( 'raindrops_archive_year_navigation' ) ) {

	/**
	 *
	 * @param type $echo
	 * @return string
	 * @since 1.335
	 */
	function raindrops_archive_year_navigation( $echo = true ) {

		$html			 = '<li><a href="%1$s" class="%2$s"><span class="screen-reader-text">%3$s</span>%4$s</a></li>';
		$result			 = '<ul class="archive-year-links">';
		$year_current	 = absint( get_query_var( 'year' ) );
		$year_list		 = get_posts( array( 'post_status' => 'publish', 'posts_per_page' => -1, 'order' => 'ASC' ) );

		foreach ( $year_list as $list ) {

			$years[] = substr( $list->post_date, 0, 4 );
		}
		$years = array_values( array_unique( $years, SORT_NUMERIC ) );

		$before	 = '';
		$after	 = '';

		$last	 = end( $years );
		$first	 = reset( $years );

		$not_set_before = false;

		foreach ( $years as $key => $year ) {

			$year				 = absint( $year );
			$class				 = sanitize_html_class( 'year-' . $year );
			$link				 = esc_url( get_year_link( $year ) );
			$screen_reader_text	 = esc_html__( 'Link to Year Archives ', 'raindrops' );
			if ( function_exists( 'raindrops_year_name_filter' ) ) {
				$year_text = raindrops_year_name_filter( $year );
			} else {
				$year_text = $year;
			}

			if ( $year_current == $year ) {
				if ( $first !== $year ) {
					$not_set_before = true;
				}
				if ( $last !== $year ) {
					$break_point = $key + 1;
				}
				$class = 'current-year';

				$current = sprintf( $html, $link, $class, $screen_reader_text, $year_text );
			}
			if ( isset( $break_point ) && $key == $break_point ) {
				$class	 = 'next-year';
				$after	 = sprintf( $html, $link, $class, $screen_reader_text, $year_text );
				break;
			}
			if ( true !== $not_set_before ) {
				$class	 = 'prev-year';
				$before	 = sprintf( $html, $link, $class, $screen_reader_text, $year_text );
			}
		}
		$result .= $before . $current . $after;
		$result .= '</ul>';

		wp_reset_postdata();

		if ( true !== $echo ) {

			return $result;
		} else {

			echo $result;
		}
	}

}

if ( ! function_exists( 'raindrops_post_password_form_html5' ) ) {

	/**
	 *
	 * @global type $post
	 * @param type $form
	 * @return type
	 * @since 1.336
	 */
	function raindrops_post_password_form_html5( $form ) {

		global $post;

		$document_type = raindrops_warehouse_clone( 'raindrops_doc_type_settings' );

		if ( 'html5' !== $document_type ) {

			return $form;
		}

		$label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );

		$form = <<< POST_FORM

<form action="%1\$s" class="post-password-form" method="post">
<p>
	<span class="screen-reader-text">%4\$s</span>
	<label for="%2\$s">%3\$s</label>
	<input name="post_password" id="%2\$s" type="password" size="20" placeholder="%3\$s" required="required" aria-required="true" title="%4\$s" />

	<input type="submit" name="Submit" value="%5\$s" />
</p>
</form>

POST_FORM;

		$form = str_replace( array( "\n", "\r" ), '', $form );

		$output = sprintf( $form, site_url( 'wp-login.php?action=postpass', 'login_post' ), $label, esc_html__( 'Password', 'raindrops' ), esc_attr__( 'This content is password protected. To view it please enter your password', 'raindrops' ), esc_attr__( 'Submit', 'raindrops' )
		);

		$output = apply_filters( 'raindrops_post_password_form_html5', $output );

		return $output;
	}

}
if ( ! function_exists( 'raindrops_color_pallet_tagcloud' ) ) {

	/**
	 *
	 * @global type $raindrops_tag_cloud_widget_presentation
	 * @param type $css
	 * @return type
	 */
	function raindrops_color_pallet_tagcloud( $css ) {

		global $raindrops_tag_cloud_widget_presentation, $raindrops_tag_cloud_widget_threshold_val;

		if ( false == $raindrops_tag_cloud_widget_presentation ) {
			return $css;
		}


		$raindrops_current_style_type = raindrops_warehouse_clone( 'raindrops_style_type' );
		if ( 'dark' == $raindrops_current_style_type ) {

			$saturation_base = 80;
			$lightness_base	 = 60;
		} else {
			$saturation_base = 80;
			$lightness_base	 = 40;
		}
		$start_angle = 0;
		$result		 = '';
		$count_sep	 = absint( $raindrops_tag_cloud_widget_threshold_val );
		/** end config */
		$taxonomies	 = array( 'post_tag' );
		$args		 = array(
			'orderby'	 => 'count',
			'order'		 => 'DESC',
		);
		$terms		 = get_terms( $taxonomies, $args );

		if ( empty( $terms ) ) {
			return $css;
		}

		$count_terms = count( $terms );

		$radian = 270 / $count_terms;

		if ( 'no' == raindrops_warehouse_clone( 'raindrops_color_coded_post_tag' ) ) {
			$flag = false;
			return $css;
		} else {
			$flag = true;
		}

		foreach ( $terms as $key => $term ) {
			$v			 = $key + 1;
			$hue		 = $start_angle + ( $radian * $v );
			$saturation	 = $saturation_base . '%';
			$lightness	 = $lightness_base . '%';
			if ( $term->count > $count_sep ) {
				$result .= '.widget_tag_cloud .tagcloud .tag-link-' . $term->term_id . '{color:hsl(' . $hue . ',' . $saturation . ',' . $lightness . ');} ';
				if ( true == $flag ) {
					$result .= '.rd-tag-em .post-tag .tag-link-' . $term->term_id . '{background:hsla(' . $hue . ',' . $saturation . ',' . $lightness . ',0.3 );} ';
					$result .= '.rd-tag-em .tag-' . $term->term_id . '-wrapper .title:before{color:hsl(' . $hue . ',' . $saturation . ',' . $lightness . ');} ';
				}
			} else {
				$result .= '.widget_tag_cloud .tagcloud .tag-link-' . $term->term_id . '{display:none;} ';
				if ( true == $flag ) {
					$result .= '.rd-tag-em .post-tag .tag-link-' . $term->term_id . '{display:none;} ';
				}
			}
		}

		$result = raindrops_remove_spaces_from_css( $result );

		return $css . apply_filters( 'raindrops_color_pallet_tagcloud', $result );
	}

}

if ( ! function_exists( 'raindrops_get_the_posted_in_category' ) ) {

	/**
	 *
	 * @global type $wp_rewrite
	 * @param type $separator
	 * @param type $parents
	 * @param type $post_id
	 * @return type
	 * @since 1.337
	 */
	function raindrops_get_the_posted_in_category( $separator = '', $parents = '', $post_id = false ) {

		global $wp_rewrite;

		if ( !is_object_in_taxonomy( get_post_type( $post_id ), 'category' ) ) {
			/** This filter is documented in wp-includes/category-template.php */
			return apply_filters( 'the_category', '', $separator, $parents );
		}

		$categories = get_the_category( $post_id );
		if ( empty( $categories ) ) {
			/** This filter is documented in wp-includes/category-template.php */
			return apply_filters( 'the_category', __( 'Uncategorized', 'raindrops' ), $separator, $parents );
		}

		$rel = ( is_object( $wp_rewrite ) && $wp_rewrite->using_permalinks() ) ? 'rel="category tag"' : 'rel="category"';

		$thelist = '';
		if ( '' == $separator ) {
			$html = '<li class="cat-item cat-item-%4$d"><a href="%1$s" %2$s>%3$s</a></li>';

			$thelist .= '<ul class="posted-in-categories">';
			foreach ( $categories as $category ) {
				$thelist .= "\n\t";
				$permalink = esc_url( get_category_link( $category->term_id ) );
				$thelist .= sprintf( $html, $permalink, $rel, $category->name, $category->term_id );
			}
			$thelist .= '</ul>';
		} else {
			$i = 0;
			foreach ( $categories as $category ) {
				if ( 0 < $i )
					$thelist .= $separator;
				$thelist .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" ' . $rel .
				'><span class="cat-item cat-item-' . absint( $category->term_id ) . '">' . $category->name . '</span></a>';
				++$i;
			}
		}

		return apply_filters( 'the_category', $thelist, $separator, $parents );
	}

}
if ( ! function_exists( 'raindrops_get_the_posted_in_tag' ) ) {

	/**
	 *
	 * @global type $post
	 * @param type $before
	 * @param type $sep
	 * @param type $after
	 * @return boolean
	 * @since 1.337
	 */
	function raindrops_get_the_posted_in_tag( $before = '', $sep = '', $after = '' ) {

		global $post;

		if ( !isset( $post ) ) {
			return;
		}

		$id			 = $post->ID;
		$taxonomy	 = 'post_tag';
		$terms		 = get_the_terms( $id, $taxonomy );

		if ( is_wp_error( $terms ) ) {
			return $terms;
		}

		if ( empty( $terms ) ) {
			return false;
		}

		$links = array();

		foreach ( $terms as $term ) {

			$link = get_term_link( $term, $taxonomy );
			if ( is_wp_error( $link ) ) {
				return $link;
			}

			$links[] = '<a href="' . esc_url( $link ) . '" rel="tag"><span class="tag-link-' . absint( $term->term_id ) . '">' . $term->name . '</span></a>';
		}

		$term_links = apply_filters( "term_links-$taxonomy", $links );

		$result = $before . join( $sep, $term_links ) . $after;

		return apply_filters( 'the_tags', $result, $before, $sep, $after, $id );
	}

}
if ( ! function_exists( 'raindrops_pdf_send_to_editor' ) ) {

	/**
	 *
	 * @param type $html
	 * @param type $attachment_id
	 * @param type $attachment
	 * @return type
	 * @1.343
	 */
	function raindrops_pdf_send_to_editor( $html, $attachment_id, $attachment ) {

		$post = get_post( $attachment_id );

		if ( substr( $post->post_mime_type, 0, 15 ) == 'application/pdf' ) {

			$check_encoded = get_url_in_content( $html );

			if ( mb_strlen( $check_encoded ) !== strlen( $check_encoded ) && !preg_match( '!%[0-9A-Z][0-9A-Z]+!', $check_encoded ) ) {

				/**
				 * Add PDF link Multibyte Languages URL Encode Check
				 * @since 1.448
				 */
				$encoded_url = esc_url( $check_encoded );
				$html		 = str_replace( $check_encoded, $encoded_url, $html );
			}

			return str_replace( '<a', '<a class="rd-pdf"', $html );
		}
		return $html;
	}

}

if ( ! function_exists( 'raindrops_automatic_modal_rel_rev' ) ) {

	/**
	 *
	 * @global type $post
	 * @param type $content
	 * @return type
	 * @since 1.348
	 */
	function raindrops_automatic_modal_rel_rev( $content ) {

		global $post;

		if ( isset( $post->ID ) && false !== strpos( $content, 'raindrops_modal_fragment_id_automatic' ) ) {

			$modals	 = explode( '#raindrops_modal', $content );
			$result	 = '';
			foreach ( $modals as $key => $modal ) {

				$unique_id		 = 'modal_box_' . absint( $post->ID ) . '_' . absint( $key );
				$flagment_link	 = esc_url( get_permalink( $post->ID ) . '#' . $unique_id );
				$result .= str_replace( array( 'raindrops_modal_fragment_id_automatic', '_fragment_id_automatic', ), array( $unique_id, $flagment_link ), $modal );
			}

			$result = str_replace( 'data-modal-id=', 'id=', $result );
			return $result;
		}
		return $content;
	}

}
if ( ! function_exists( 'raindrops_widget_page_style' ) ) {

	/**
	 * @since 1.405
	 */
	function raindrops_widget_page_style() {

		$colors = raindrops_wp_admin_css_colors( 'colors' );

		if ( isset( $colors[ 2 ] ) && !empty( $colors[ 2 ] ) ) {
			$background_theme = raindrops_header_image_filter_color_validate( $colors[ 2 ] );
		} else {
			$background_theme = '#1abc9c';
		}
		if ( isset( $colors[ 3 ] ) && !empty( $colors[ 3 ] ) ) {
			$background_addon = raindrops_header_image_filter_color_validate( $colors[ 3 ] );
		} else {
			$background_addon = '#95a5a6';
		}

		$custom_css = ".raindrops-widget-color-theme-excerpt,div[id*=\"_recent-post-groupby-cat-\"] h3,
			div[id*=\"_raindrops_pinup_entry_widget-\"] h3,div[id*=\"_raindrops_extend_archive_widget-\"] h3{
					background: {$background_theme};
						color: #000;
			}";
		$custom_css .= ".raindrops-widget-color-addon-excerpt,div[id*=\"_tribe-events-list-widget-\"] h3,
		div[id*=\"_metaslider_widget-\"] h3,div[id*=\"_bcn_widget\"] h3{
						background: {$background_addon};
						color: #000;
			}";
		$custom_css .= "
			.raindrops-widget-color-addon-excerpt,.raindrops-widget-color-theme-excerpt{
				padding:1em;
			}";
		$custom_css .= "
			#available-widgets-list div[id*=\"_tribe-events-list-widget-\"] h3,#available-widgets-list div[id*=\"_metaslider_widget-\"] h3,
			#available-widgets-list div[id*=\"_bcn_widget\"] h3,#available-widgets-list div[id*=\"_recent-post-groupby-cat-\"] h3,
			#available-widgets-list div[id*=\"_raindrops_pinup_entry_widget-\"] h3,#available-widgets-list div[id*=\"_raindrops_extend_archive_widget-\"] h3{
				padding:5px;
			}";

		wp_add_inline_style( 'widgets', $custom_css );
	}

}
if ( ! function_exists( 'raindrops_widget_style_description' ) ) {

	/**
	 * @since 1.405
	 */
	function raindrops_widget_style_description() {

		$html = '<p><span class="raindrops-widget-color-theme-excerpt">%1$s</span>	<span class="raindrops-widget-color-addon-excerpt">%2$s</span></p>';

		printf( $html, esc_html__( 'Theme Widget', 'raindrops' ), esc_html__( 'Add On Widget', 'raindrops' ) );
	}

}



if ( ! function_exists( 'raindrops_responsive_sidebar_switch' ) ) {

	/**
	 *
	 * @param type $items
	 * @return wp_nav_menu_items
	 * @1.410
	 */
	function raindrops_responsive_sidebar_switch( $items, $args ) {

		if ( 'primary' == $args->theme_location ) {

			global $raindrops_current_column;

			$after					 = '';
			$before					 = '';
			$sidebar_position		 = raindrops_warehouse_clone( 'raindrops_col_width' );
			$menu_text				 = esc_html__( 'Open', 'raindrops' );
			$extra_sidebar_title	 = esc_attr__( 'Extra Sidebar', 'raindrops' );
			$default_sidebar_title	 = esc_attr__( 'Main Sidebar', 'raindrops' );
			$extra_sidebar_html		 = '<li class="rsidebar-shrink button-wrapper"><button %1$s><span class="button-text">%2$s</span></button></li>';
			$default_sidebar_html	 = '<li class="lsidebar-shrink button-wrapper"><button %1$s><span class="button-text">%2$s</span></button></li>';
			/* @1.492 */
			$is_active_sidebar_1	 = is_active_sidebar( 'sidebar-1' );

			if ( 2 < raindrops_get_column_count() ) {

				$after .= sprintf( $extra_sidebar_html, raindrops_doctype_elements( '', 'title="' . $extra_sidebar_title . '"', false ), $menu_text );
			}

			if ( ( 't1' == $sidebar_position || 't2' == $sidebar_position || 't3' == $sidebar_position ) && true == $is_active_sidebar_1 ) {

				$before .= sprintf( $default_sidebar_html, raindrops_doctype_elements( '',  'title="' . $default_sidebar_title . '"', false ), $menu_text );
			} elseif( true == $is_active_sidebar_1 ) {

				$after .= sprintf( $default_sidebar_html, raindrops_doctype_elements( '', 'title="' . $default_sidebar_title . '"', false ), $menu_text );
			}

			return $before . $items . $after;
		}

		return $items;
	}
}
if ( ! function_exists( 'raindrops_get_column_count' ) ) {

	/**
	 *
	 * @global type $raindrops_current_column
	 * @return columns count
	 * @since 1.410
	 */
	function raindrops_get_column_count() {

		global $raindrops_current_column;
		$column = 3;

		if ( false !== ($type = raindrops_has_indivisual_notation() ) ) {
			if ( isset( $type[ 'col' ] ) ) {

				$column = absint( $type[ 'col' ] );
			}
		} else {
			if ( isset( $raindrops_current_column ) && !empty( $raindrops_current_column ) ) {
				$column = absint( $raindrops_current_column );
			}
		}
		return $column;
	}

}
if ( ! function_exists( 'raindrops_term_description' ) ) {

	/**
	 *
	 * @global type $raindrops_use_term_description
	 * @param type $title
	 * @since 1.410
	 */
	function raindrops_term_description( $title ) {

		global $raindrops_use_term_description;

		if ( false == $raindrops_use_term_description ) {
			return;
		}

		$html = apply_filters( 'raindrops_term_description_html', '<li class="rd-term-description "><div class="%2$s">%1$s</div></li>' );

		if ( is_category() ) {

			$description = apply_filters( 'raindrops_category_description', get_the_archive_description() );
			if ( !empty( $description ) ) {

				printf( $html, $description, 'rd-category-description' );
			}
		}
		if ( is_tag() ) {

			$description = apply_filters( 'raindrops_tag_description', tag_description() );
			if ( !empty( $description ) ) {

				printf( $html, $description, 'rd-tag-description' );
			}
		}
	}

}

if ( ! function_exists( 'raindrops_custom_image_send_to_editor' ) ) {

	/**
	 *
	 * @global type $raindrops_document_type
	 * @param type $html
	 * @return type
	 * @since 1.411
	 */
	function raindrops_custom_image_send_to_editor( $html ) {
		/**
		 * html5 can not use indivisual values
		 * change rel to class
		 */
		$html = preg_replace( '!\s*rel="([^"]+)"!', ' class="$1"', $html );

		return $html;
	}

}

if ( ! function_exists( 'raindrops_remove_itemprop_from_site_logo' ) ) {

	/**
	 * This attribute needs Set width itemscope attribute, itemtype attribute.
	 * Raindrops yet not support microdata
	 * @param type $logo
	 * @return type
	 * @1.411
	 */
	function raindrops_remove_itemprop_from_site_logo( $logo ) {

		$logo = preg_replace( '!itemprop="[^"]+"!', '', $logo );
		return $logo;

		return $logo;
	}

}

if ( ! function_exists( 'raindrops_remove_grabatar_srcset' ) ) {

	/**
	 * Raindrops avatar size is only 1 size, no needs responsive image sizes
	 * @param type $avatar
	 * @return type
	 * @1.411
	 */
	function raindrops_remove_grabatar_srcset( $avatar ) {
		$avatar = preg_replace( "!srcset='[^']+'!", '', $avatar );
		return $avatar;
	}

}
if ( ! function_exists( 'raindrops_gettext_with_context' ) ) {

	/**
	 * Raindrops Theme Support Document Type XHTML1.0
	 * Change reference to undeclared general entity raquo to numerical character references
	 * for link elements feed titles
	 *
	 * @param string $translated
	 * @param type $text
	 * @param type $context
	 * @param type $domain
	 * @return string
	 * @since 1.411
	 */
	function raindrops_gettext_with_context( $translated, $text, $context, $domain ) {

		if ( '&raquo;' == $text ) {
			$translated = '&#187;';
		}
		return $translated;
	}

}
if ( ! function_exists( 'raindrops_remove_sizes_attribute' ) ) {

	/**
	 * link sizes attribute is not support yet all populer browser
	 *
	 * @param type $site_icon
	 * @return type
	 * @since 1.411
	 */
	function raindrops_remove_sizes_attribute( $site_icon ) {

		$site_icon = preg_replace( '!sizes="[^"]+"!', '', $site_icon );
		return $site_icon;
	}

}
if ( ! function_exists( 'raindrops_current_post_hilight' ) ) {

	/**
	 *
	 * @global type $post
	 * @global type $wp_styles
	 * @since 1.413
	 */
	function raindrops_current_post_hilight() {
		global $post, $wp_styles;

		if ( is_singular() ) {
			$current_url	 = get_permalink( $post->ID );
			$inline_style	 = '.widget_recent_entries a[href="' . $current_url . '"]{background:rgba(127,127,127,.3);}';

			wp_add_inline_style( 'style', $inline_style );
		}
		if ( is_tag() ) {
			$id				 = get_queried_object_id();
			$current_url	 = get_tag_link( $id );
			$inline_style	 = '.widget_tag_cloud a[href="' . $current_url . '"]{background:rgba(127,127,127,.3);}';

			wp_add_inline_style( 'style', $inline_style );
		}
		if ( is_category() ) {
			$id				 = get_queried_object_id();
			$current_url	 = get_tag_link( $id );
			$inline_style	 = '.widget_recent-post-groupby-cat a[href="' . $current_url . '"] span{background:rgba(127,127,127,.3);}';

			wp_add_inline_style( 'style', $inline_style );
		}
		if ( is_date() && is_month() ) {

			$month	 = absint( get_query_var( 'monthnum' ) );
			$year	 = absint( get_query_var( 'year' ) );
			/**
			 * @1.442
			 * url?m=201402 can not get monthnum
			 */
			if ( empty( $month ) ) {
				$date_info = get_query_var( 'm' );
				list( $year, $month ) = sscanf( $date_info, "%4d%d" );
			}

			$current_url	 = get_month_link( $year, $month );
			$inline_style	 = '.widget_archive a[href="' . $current_url . '"]{background:rgba(127,127,127,.3);}';
			$inline_style .= '.raindrops-extend-archive li a[href="' . $current_url . '"]{background:rgba(127,127,127,.3);}';

			wp_add_inline_style( 'style', $inline_style );
		}
		if ( is_date() && is_day() ) {
			/* for calendar widget */
			$month	 = absint( get_query_var( 'monthnum' ) );
			$year	 = absint( get_query_var( 'year' ) );
			$day	 = absint( get_query_var( 'day' ) );

			/**
			 * @1.442
			 * url?m=201402 can not get monthnum
			 */
			if ( empty( $month ) ) {
				$date_info = get_query_var( 'm' );
				list( $year, $month ) = sscanf( $date_info, "%4d%d" );
			}

			$current_url	 = get_day_link( $year, $month, $day );
			$inline_style	 = '#wp-calendar a[href="' . $current_url . '"]{font-weight:700;text-decoration:none;}';
			wp_add_inline_style( 'style', $inline_style );
		}
	}

}
if ( ! function_exists( 'raindrops_archive_has_count' ) ) {

	/**
	 * It does not work properly if you are displaying a plurality of archive widgets.
	 * @return type
	 * @since 1.415
	 */
	function raindrops_archive_has_count() {
		return false;
		$archive_widget	 = new WP_Widget_Archives();
		$settings		 = $archive_widget->get_settings();
		$settings		 = array_filter($settings); /* @1.481 */
		$settings		 = reset( $settings );

		if ( isset( $settings[ 'count' ] ) ) {
			return (bool) $settings[ 'count' ];
		}

	}

}
if ( ! function_exists( 'raindrops_color_pallet_category' ) ) {
	/**
	 *
	 * @global type $raindrops_category_widget_presentation
	 * @global type $raindrops_category_widget_threshold_val
	 * @param type $css
	 * @return type
	 */
	function raindrops_color_pallet_category( $css ) {

		global $raindrops_category_widget_presentation, $raindrops_category_widget_threshold_val;

		if ( false == $raindrops_category_widget_presentation ) {
			return $css;
		}
		if ( 'yes' !== raindrops_warehouse_clone( 'raindrops_color_coded_category' ) ) {
			return $css;
		}

		$raindrops_current_style_type = raindrops_warehouse_clone( 'raindrops_style_type' );
		if ( 'dark' == $raindrops_current_style_type ) {

			$saturation_base = 80;
			$lightness_base	 = 60;
		} else {
			$saturation_base = 80;
			$lightness_base	 = 40;
		}
		$start_angle = 0;
		$result		 = '';
		$count_sep	 = absint( $raindrops_category_widget_threshold_val );
		/** end config */
		$taxonomies	 = array( 'category' );
		$args		 = array(
			'orderby'		 => 'count',
			'order'			 => 'DESC',
			'hierarchical'	 => false,
		);
		$terms		 = get_terms( $taxonomies, $args );

		if ( empty( $terms ) ) {
			return $css;
		}

		$count_terms = count( $terms );

		$radian = 270 / $count_terms;

		foreach ( $terms as $key => $term ) {
			$v			 = $key + 1;
			$hue		 = $start_angle + ( $radian * $v );
			$saturation	 = $saturation_base . '%';
			$lightness	 = $lightness_base . '%';
			$alpha		 = 0.3;
			$alpha_b	 = $alpha * 2;
			if ( 0.6 < $alpha || $lightness_base <= 40 ) {
				$color = '#000';
			} else {
				$color = '#fff';
			}


			if ( $term->count > $count_sep ) {
				// for article extend color class
				$result .= '.rd-cat-em .cat-color-' . $term->term_id . ' {color:' . $color . ';background:hsla(' . $hue . ',' . $saturation . ',' . $lightness . ',' . $alpha . ');} ';
				$result .= '.rd-cat-em .cat-color-' . $term->term_id . ' a{color:' . $color . ';}';
				// for article
				$result .= '.rd-cat-em .post .cat-item-' . $term->term_id . ' {background:hsla(' . $hue . ',' . $saturation . ',' . $lightness . ',' . $alpha . ');} ';
				// for sidebars
				$result .= '.rd-cat-em .yui-b .cat-item-' . $term->term_id . ' a:before{color:' . $color . ';background:hsla(' . $hue . ',' . $saturation . ',' . $lightness . ',' . $alpha_b . ');} ';
				$result .= '.rd-cat-em footer .cat-item-' . $term->term_id . ' a:before{color:' . $color . ';background:hsla(' . $hue . ',' . $saturation . ',' . $lightness . ',' . $alpha_b . ');} ';
				$result .= '.rd-cat-em footer .cat-item-' . $term->term_id . ' a{color:' . $color . ';}';
				//for archive title before icon
				$result .= '.rd-cat-em .category-archives .cat-item-' . $term->term_id . '-wrapper .title:before{color:hsla(' . $hue . ',' . $saturation . ',' . $lightness . ',' . $alpha_b . ');} ';
			} else {
				$result .= '.rd-cat-em .cat-item.cat-item-' . $term->term_id . ' {display:none;} ';
				$result .= '.rd-cat-em .category-archives .cat-item.cat-item-' . $term->term_id . ' {display:none;} ';
			}
		}

		$result = raindrops_remove_spaces_from_css( $result );

		return $css . apply_filters( 'raindrops_color_pallet_category', $result );
	}

}

if ( ! function_exists( 'raindrops_nextpage_tag_with_header_nav' ) ) {

	/**
	 *
	 * @global type $post
	 * @global type $page
	 * @return type
	 * @since1.420
	 */
	function raindrops_nextpage_tag_with_header_nav() {
		global $post, $page;

		$prev			 = '';
		$next			 = '';
		$current_page	 = 0;
		$count			 = 0;

		if ( isset( $page ) && isset( $post ) && preg_match_all( '#<!--nextpage-->#', $post->post_content, $result, PREG_SET_ORDER ) ) {

			$count			 = (int) count( $result );
			$current_page	 = (int) $page;
			$link			 = get_permalink( $post->ID );

			if ( $current_page <= $count ) {
				$next = esc_url( add_query_arg( 'page', $current_page + 1, $link ) );
			}

			if ( $current_page > 2 ) {
				$prev = esc_url( add_query_arg( 'page', $current_page - 1, $link ) );
			} elseif ( $current_page == 2 ) {
				$prev = esc_url( $link );
			}
		}
		return array( 'prev' => $prev, 'next' => $next );
	}

}
if ( ! function_exists( 'raindrops_nextpage_tag_with_header_rel' ) ) {

	/**
	 *
	 * @param type $rel_prev
	 * @return type
	 * @since 1.420
	 */
	function raindrops_nextpage_tag_with_header_rel( $rel_prev ) {

		$link		 = raindrops_nextpage_tag_with_header_nav();
		$result_html = '<link rel="prev" href="%1$s" />';
		$result		 = '';

		if ( !empty( $link[ 'prev' ] ) ) {
			$result_html = sprintf( $result_html, $link[ 'prev' ] );
			$result		 = apply_filters( 'raindrops_nextpage_tag_with_header_nav', $result_html . PHP_EOL, $link[ 'prev' ], $link[ 'next' ] );
		} else {
			$result = $rel_prev;
		}
		$result_html = '<link rel="next" href="%1$s" />';

		if ( !empty( $link[ 'next' ] ) ) {
			$result_html = sprintf( $result_html, $link[ 'next' ] );
			$result .= apply_filters( 'raindrops_nextpage_tag_with_header_nav', PHP_EOL . $result_html . PHP_EOL, $link[ 'prev' ], $link[ 'next' ] );
		}

		if ( !empty( $result ) ) {
			return $result;
		}
		return $rel_prev;
	}

}
if ( ! function_exists( 'raindrops_nextpage_tag_with_header_nav_helper' ) ) {

	/**
	 *
	 * @param type $rel_next
	 * @return type
	 * @since 1.420
	 */
	function raindrops_nextpage_tag_with_header_nav_helper( $rel_next ) {

		$link = raindrops_nextpage_tag_with_header_nav();

		if ( !empty( $link[ 'next' ] ) ) {
			return '';
		}
		return $rel_next;
	}

}
if ( ! function_exists( 'raindrops_remove_noteaser_link_scroll' ) ) {

	/**
	 *
	 * @global type $multipage
	 * @global type $page
	 * @global type $post
	 * @param type $link
	 * @return type
	 * @1.423
	 */
	function raindrops_remove_noteaser_link_scroll( $link ) {
		global $multipage, $page, $post;

		if ( false !== strpos( $post->post_content, '<!--noteaser-->' ) && (!$multipage || $page == 1 ) ) {
			$link = preg_replace( '|#more-[0-9]+|', '', $link );
			return $link;
		}
		return $link;
	}

}
if ( ! function_exists( 'raindrops_admin_post_stylesheet' ) ) {

	/**
	 *
	 * @1.434
	 */
	function raindrops_admin_post_stylesheet() {

		wp_enqueue_style( 'admin_options', get_template_directory_uri() . '/admin-options.css' );
	}

}
if ( ! function_exists( 'raindrops_cusotom_post_archive_link' ) ) {

	/**
	 *
	 * @param type $posted_in
	 * @return type
	 * @1.438
	 */
	function raindrops_cusotom_post_archive_link( $posted_in ) {

		$post_type = get_post_type( get_the_ID() );

		if ( "post" == $post_type || "page" == $post_type || "attachment" == $post_type || "revision" == $post_type || "nav_menu_item" == $post_type ) {
			return $posted_in;
		}
		$obj = get_post_type_object( $post_type );

		$taxes = get_object_taxonomies( $obj->name );

		if ( !empty( $taxes ) ) {

			$term_list = get_the_term_list( get_the_ID(), $taxes[ 0 ], '<span class="custom-taxsonomy ' . sanitize_html_class( 'tax-' . $taxes[ 0 ] ) . '">', ' ', '</span>' );

			if ( !empty( $term_list ) ) {

				$posted_in = $posted_in . $term_list;
			}
		}

		$html = '<a href="%1$s" class="%2$s post-type-archives-link">%3$s</a>';

		if ( !empty( $obj ) && true == $obj->has_archive && is_singular() ) {

			return $posted_in . sprintf( $html, get_post_type_archive_link( $obj->name ), sanitize_html_class( 'link-to-' . $obj->name ), $obj->label );
		}

		return apply_filters( 'raindrops_cusotom_post_archive_link', $posted_in );
	}

}

if ( ! function_exists( 'raindrops_is_custom_post_type' ) ) {

	/**
	 *
	 * @global type $post
	 * @return boolean
	 * @1.438
	 */
	function raindrops_is_custom_post_type() {
		global $post;

		$all_custom_post_types = get_post_types( array( '_builtin' => false ) );

		if ( empty( $all_custom_post_types ) ) {

			return false;
		}

		$custom_types		 = array_keys( $all_custom_post_types );

		if( ! empty( $post ) ) {

			$current_post_type	 = $post->post_type;

			if ( in_array( $current_post_type, $custom_types ) ) {

				return true;
			} else {

				return false;
			}
		} else {

			return false;
		}
	}

}
if ( ! function_exists( 'raindrops_post_type_exists' ) ) {

	/**
	 *
	 * @global type $post
	 * @return boolean
	 * @1.438
	 */
	function raindrops_post_type_exists( $post_type ) {
		global $post;

		$all_custom_post_types = get_post_types( array( '_builtin' => false ) );

		if ( empty( $all_custom_post_types ) ) {

			return false;
		}

		$custom_types		 = array_keys( $all_custom_post_types );
		$current_post_type	 = $post_type;

		if ( in_array( $current_post_type, $custom_types ) ) {

			return true;
		} else {

			return false;
		}
	}

}
if ( ! function_exists( 'raindrops_filter_custom_post_content' ) ) {

	/**
	 *
	 * @param type $args
	 * @return type
	 * @1.438
	 */
	function raindrops_filter_custom_post_content( $args ) {

		if ( is_singular() ) {
			$post_type = get_post_type( get_the_ID() );

			if ( isset( $post_type ) && ( "post" == $post_type || "page" == $post_type || "attachment" == $post_type || "revision" == $post_type || "nav_menu_item" == $post_type ) ) {
				return $args;
			}
			$obj = get_post_type_object( $post_type );

			if ( !empty( $obj ) && true == $obj->has_archive ) {
				$args[ 'post_type' ] = $post_type;
			}
		}
		return $args;
	}

}

if ( ! function_exists( 'raindrops_filter_custom_post_title' ) ) {

	/**
	 *
	 * @param type $title
	 * @param type $instance
	 * @param type $id_base
	 * @return type
	 * @1.438
	 */
	function raindrops_filter_custom_post_title( $title, $instance, $id_base ) {

		if ( 'recent-posts' == $id_base ) {
			if ( is_singular() ) {

				$post_type = get_post_type( get_the_ID() );

				if ( isset( $post_type ) && ( "post" == $post_type || "page" == $post_type || "attachment" == $post_type || "revision" == $post_type || "nav_menu_item" == $post_type ) ) {

					return $title;
				}

				if ( isset( $instance[ 'title' ] ) && !empty( $instance[ 'title' ] ) ) {

					return esc_html( $instance[ 'title' ] );
				}
				$obj = get_post_type_object( $post_type );
				if ( !empty( $obj ) && true == $obj->has_archive ) {
					/* translators: 1: post type */
					return sprintf( __( 'Recent %1$s', 'raindrops' ), $obj->label );
				}
			}
		}
		return $title;
	}

}

if ( ! function_exists( 'raindrops_filter_custom_post_archive_widget' ) ) {

	/**
	 *
	 * @param type $args
	 * @return type
	 * @1.440
	 */
	function raindrops_filter_custom_post_archive_widget( $args ) {

		$post_type = get_post_type( get_the_ID() );

		if ( is_singular() || is_post_type_archive( $post_type ) || is_tax() ) {

			$post_type = get_post_type( get_the_ID() );

			if ( isset( $post_type ) && ( "post" == $post_type || "page" == $post_type || "attachment" == $post_type || "revision" == $post_type || "nav_menu_item" == $post_type ) ) {
				return $args;
			}

			$obj = get_post_type_object( $post_type );

			if ( !empty( $obj ) && true == $obj->has_archive ) {
				$args[ 'post_type' ] = $post_type;
			}
		}
		return $args;
	}

}

if ( ! function_exists( 'raindrops_filter_custom_post_archive_widget_title' ) ) {

	/**
	 *
	 * @param type $title
	 * @param type $instance
	 * @param type $id_base
	 * @return type
	 * @1.440
	 */
	function raindrops_filter_custom_post_archive_widget_title( $title, $instance, $id_base ) {

		if ( 'archives' == $id_base ) {

			$post_type = get_post_type( get_the_ID() );

			if ( is_singular() || is_post_type_archive( $post_type ) || is_tax() ) {

				if ( isset( $post_type ) && ("post" == $post_type || "page" == $post_type || "attachment" == $post_type || "revision" == $post_type || "nav_menu_item" == $post_type ) ) {

					return $title;
				}
				$obj = get_post_type_object( $post_type );

				if ( !empty( $obj ) && true == $obj->has_archive ) {

					$post_type_label = apply_filters( 'raindrops_filter_custom_post_archive_widget_title', $obj->label, $obj, $id_base );
					$separator		 = apply_filters( 'raindrops_filter_custom_post_archive_widget_title', ' : ', $obj, $id_base );
					$post_type_title = apply_filters( 'raindrops_filter_custom_post_archive_widget_title', $title, $obj, $id_base );
					/* translators: 1: post type 2: separator 3: post type title */
					return sprintf( __( '%1$s %2$s %3$s', 'raindrops' ), $post_type_label, $separator, $post_type_title );
				}
			}
		}
		return $title;
	}

}

if ( ! function_exists( 'raindrops_filter_custom_post_category_widget' ) ) {

	/**
	 *
	 * @param type $posted_in
	 * @return type
	 * @1.440
	 */
	function raindrops_filter_custom_post_category_widget( $cat_args ) {

		$post_type = get_post_type( get_the_ID() );

		if ( is_singular() || is_post_type_archive( $post_type ) || is_tax() ) {

			if ( isset( $post_type ) && ( "post" == $post_type || "page" == $post_type || "attachment" == $post_type || "revision" == $post_type || "nav_menu_item" == $post_type ) ) {

				return $cat_args;
			}
			$obj	 = get_post_type_object( $post_type );
			$taxes	 = get_object_taxonomies( $obj->name );

			if ( is_array( $taxes ) && !empty( $taxes ) ) {

				$tax = $taxes[ 0 ];
			}

			if ( !empty( $tax ) ) {

				$cat_args[ 'taxonomy' ]				 = $tax;
				$cat_args[ 'hide_title_if_empty' ]	 = true;
			} elseif ( !empty( $obj ) ) {

				$cat_args[ 'taxonomy' ]				 = $obj->label;
				$cat_args[ 'hide_title_if_empty' ]	 = true;
			} else {

				return $cat_args;
			}

			return apply_filters( 'raindrops_filter_custom_post_category_widget', $cat_args );
		}
		return $cat_args;
	}

}

if ( ! function_exists( 'raindrops_filter_custom_post_category_widget_title' ) ) {

	/**
	 *
	 * @param type $title
	 * @param type $instance
	 * @param type $id_base
	 * @return type
	 * @1.440
	 */
	function raindrops_filter_custom_post_category_widget_title( $title, $instance, $id_base ) {

		if ( 'categories' == $id_base ) {

			$post_type = get_post_type( get_the_ID() );

			if ( is_singular() || is_post_type_archive( $post_type ) || is_tax() ) {

				$post_type = get_post_type( get_the_ID() );

				if ( isset( $post_type ) && ( "post" == $post_type || "page" == $post_type || "attachment" == $post_type || "revision" == $post_type || "nav_menu_item" == $post_type ) ) {

					return $title;
				}
				$obj = get_post_type_object( $post_type );

				$taxes = get_object_taxonomies( $obj->name );

				if ( is_array( $taxes ) && !empty( $taxes ) ) {

					$tax = $taxes[ 0 ];
				} else {

					return;
				}

				if ( !empty( $tax ) ) {

					$labels	 = get_taxonomy( $tax );
					$title	 = esc_html( $labels->labels->name );
				} else {

					return $title;
				}


				if ( !empty( $obj ) && true == $obj->has_archive ) {

					$post_type_label = apply_filters( 'raindrops_filter_custom_post_archive_widget_label', $obj->label, $obj, $id_base );
					$separator		 = apply_filters( 'raindrops_filter_custom_post_archive_widget_title', ' : ', $obj, $id_base );
					$post_type_title = apply_filters( 'raindrops_filter_custom_post_archive_widget_title', $title, $obj, $id_base );
					/* translators: 1: post type label 2:separator 3: post type title */
					return sprintf( __( '%1$s %2$s %3$s', 'raindrops' ), $post_type_label, $separator, $post_type_title );
				}
			}
		}
		return $title;
	}

}

if ( ! function_exists( 'raindrops_post_type_exclude_template' ) ) {

	/**
	 *
	 * @param type $template
	 * @return type
	 * @1.440
	 */
	function raindrops_post_type_exclude_template( $template ) {

		$post_type = get_post_type( get_the_ID() );

		if ( is_post_type_archive( $post_type ) && is_date() ) {

			return get_index_template();
		}
		return $template;
	}

}
/**
 * @since 1.445
 */
add_filter( 'header_video_settings', 'raindrops_header_video_settings', 11 );
if ( ! function_exists( 'raindrops_header_video_settings' ) ) {

	function raindrops_header_video_settings( $settings ) {
		$settings[ 'width' ]	 = 1920;
		$settings[ 'height' ]	 = 1080;
		return $settings;
	}

}
if ( ! function_exists( 'raindrops_exclude_html_attr_search' ) ) {

	/**
	 *
	 * @global type $wpdb
	 * @param type $where
	 * @return type
	 * @since 1.452
	 */
	function raindrops_exclude_html_attr_search( $where ) {
		if ( is_search() && !is_user_logged_in() ) {
			global $wpdb;
			$query	 = get_search_query();
			$query	 = $wpdb->esc_like( $query );
			$where .=" AND {$wpdb->posts}.post_content NOT REGEXP  '\<{1}[^\>]*$query*[^\>]*\>{1}' ";
		}
		return $where;
	}

}

$raindrops_content_width_setting = raindrops_warehouse_clone( 'raindrops_content_width_setting' );

if ( 'fit' == $raindrops_content_width_setting ) {
	add_filter( 'raindrops_keep_content_width', '__return_false' );
}

if( ! function_exists('raindrops_post_relate_contents') ) {
	/**
	 *
	 * @global type $post
	 */
	function raindrops_post_relate_contents() {
		/**
		 * @since 1.459
		 */

		global $post;

		$enable_relate_post						 = raindrops_warehouse_clone( 'raindrops_show_related_posts' );

		if ( 'yes' == $enable_relate_post ) {

			$raindrops_show_related_posts_thumbnail	 = raindrops_warehouse_clone( 'raindrops_show_related_posts_thumbnail' );
			$raindrops_show_related_posts_type		 = raindrops_warehouse_clone( 'raindrops_show_related_posts_type' );

			if ( "show" == $raindrops_show_related_posts_thumbnail ) {

				$raindrops_show_related_posts_thumbnail = true;
			} else {

				$raindrops_show_related_posts_thumbnail = false;
			}

			$algo	 = raindrops_relate_posts_algo( $raindrops_show_related_posts_type );

			$type	 = key( $algo );
			$id		 = $algo[ $type ];

			$args = array(
				'title'											 => raindrops_warehouse_clone( 'raindrops_show_related_posts_title' ),
				'numberposts'									 => raindrops_warehouse_clone( 'raindrops_show_related_posts_count' ),
				'raindrops_excerpt_length'						 => raindrops_warehouse_clone( 'raindrops_show_related_posts_excerpt_length' ),
				'raindrops_excerpt_more'						 => '...',
				'raindrops_post_thumbnail'						 => $raindrops_show_related_posts_thumbnail,
				'raindrops_recent_post_thumbnail_default_uri'	 => raindrops_warehouse_clone( 'raindrops_show_related_posts_thumbnail_fallback' ),
				'raindrops_show_related_posts_line_clip'			 => raindrops_warehouse_clone( 'raindrops_show_related_posts_line_clip' ),
				'post__not_in'									 => array( $post->ID ),
				'orderby'                                        => raindrops_warehouse_clone( 'raindrops_show_related_posts_orderby' ),

			);

			if ( 'recent_post' == $type ) {
				//$args['orderby'] = 'post_date';
			}
			if ( 'category' == $type ) {
				$args[ 'category' ]	 = $id;
				$args[ 'orderby' ]	 = 'rand';
				$args['raindrops_category_post_thumbnail_default_uri'] =  raindrops_warehouse_clone( 'raindrops_show_related_posts_thumbnail_fallback' );
			}
			if ( 'post_tag' == $type ) {
				$args['raindrops_tag_post_thumbnail_default_uri'] =  raindrops_warehouse_clone( 'raindrops_show_related_posts_thumbnail_fallback' );
				$args[ 'orderby' ]	 = 'rand';
				$args[ 'tax_query' ] = array(
					array(
						'taxonomy'	 => $type,
						'terms'		 => array( $id ),
						'field'		 => 'term_id',
						'operator'	 => 'IN'
					),
					'relation' => 'AND'
				);
			}

			if ( 'recent_post' == $type ) {
				echo '<div class="related-posts recent-posts">';
				raindrops_recent_posts( $args );

				echo '</div>';
			}
			if ( 'category' == $type ) {
				echo '<div class="related-posts category-posts">';
				raindrops_category_posts( $args );
				echo '</div>';
			}
			if ( 'post_tag' == $type ) {
				echo '<div class="related-posts tag-posts">';
				raindrops_tag_posts( $args );

				echo '</div>';
			}
		}
	}
}

if( ! function_exists('raindrops_relate_posts_algo') ) {
	/**
	 *
	 * @global type $post
	 * @param type $type
	 * @return type
	 * @since 1.459
	 */
	function raindrops_relate_posts_algo( $type = 'automatic' ) {

		global $post;

		$categories			 = get_the_category( $post->ID );
		$default_category	 = get_option( 'default_category' );
		$tags				 = wp_get_post_terms( $post->ID, 'post_tag', array( "fields" => 'ids' ) );
		$recent_post_flag	 = false;
		$cat_id_biggest		 = 0;
		$cat_count_biggest	 = 0;
		$tag_id_biggest		 = 0;
		$tag_count_biggest	 = 0;

		If ( 1 < count( $categories ) ) {

			foreach ( $categories as $category ) {

				if ( $category->cat_ID == $default_category ) {

					continue;
				}
				if ( isset( $prev_count ) && $category->count > $prev_count ) {

					$cat_id_biggest		 = $category->cat_ID;
					$cat_count_biggest	 = $category->count;
				}
				$prev_count = $category->count;
			}
		}
		If ( 1 == count( $categories ) ) {

			$cat_id_biggest		 = $categories[0]->cat_ID;
			$cat_count_biggest	 = $categories[0]->count;
		}

		$count_tags = wp_get_post_terms( $post->ID, 'post_tag', array( "fields" => 'all' ) );

		if ( 1 == count( $count_tags ) ) {

			$tag_id_biggest		 = $count_tags[0]->term_id;
			$tag_count_biggest	 = $count_tags[0]->count;
		} elseif ( !empty( $count_tags ) ) {

			foreach ( $count_tags as $tag ) {

				if ( isset( $prev_count ) && $tag->count > $prev_count ) {

					$tag_id_biggest		 = $tag->term_id;
					$tag_count_biggest	 = $tag->count;
				}

				$prev_count = $tag->count;
			}

			if ( empty( $tag_id_biggest ) ) {

				$tag_id_biggest		 = $count_tags[ 0 ]->term_id;
				$tag_count_biggest	 = $count_tags[ 0 ]->count;
			}
		}
		If ( 1 == count( $categories ) && empty( $count_tags ) && intval( $default_category ) == intval( $cat_id_biggest ) ) {

			$recent_post_flag = true;
		}

		if ( 'automatic' == $type ) {

			if ( true == $recent_post_flag ) {

				return array( 'recent_post' => 0 );
			} else {

				if ( $tag_count_biggest > $cat_count_biggest && intval( $default_category ) !== intval( $cat_id_biggest ) ) {

					return array( 'post_tag' => $tag_id_biggest );
				} elseif ( $tag_count_biggest < $cat_count_biggest && intval( $default_category ) !== intval( $cat_id_biggest ) ) {

					return array( 'category' => $cat_id_biggest );
				} else {

					$tag = count( get_terms( 'post_tag', array( 'hide_empty' => false, ) ) );
					$cat = count( get_terms( 'category', array( 'hide_empty' => false, ) ) );

					if ( $tag > $cat ) {
						return array( 'post_tag' => $tag_id_biggest );
					} else {
						return array( 'category' => $cat_id_biggest );
					}
				}
			}
		}

		if ( 'category' == $type ) {
			return array( 'category' => $cat_id_biggest );
		}
		if ( 'post_tag' == $type ) {
			return array( 'post_tag' => $tag_id_biggest );
		}
		if ( 'recent_posts' == $type ) {
			return array( 'recent_post' => 0 );
		}
	}
}

if ( ! function_exists( 'raindrops_filter_archive_grid' ) ) {
	/**
	 *
	 * @param type $css
	 * @return type
	 */
	function raindrops_filter_archive_grid( $css ) {

		return $css . raindrops_style_archive_grid();
	}
}

if ( ! function_exists( 'raindrops_style_archive_grid' ) ) {
	/**
	 *
	 * @return type
	 * @since 1.464
	 */
	function raindrops_style_archive_grid() {

		global $raindrops_change_all_excerpt_archives_to_grid_layout, $raindrops_where_excerpts, $raindrops_grid_posted_in;

		$home_excerpt			 = raindrops_warehouse_clone( 'raindrops_entry_content_is_home' );
		$cat_excerpt			 = raindrops_warehouse_clone( 'raindrops_entry_content_is_category' );
		$search_excerpt			 = raindrops_warehouse_clone( 'raindrops_entry_content_is_search' );
		$archive_type			 = '';
		$break_point_small_max	 = apply_filters( 'raindrops_grid_break_point_small', 640 );
		$break_point_mobile_min	 = intval( $break_point_small_max ) + 1;
		$break_point_mobile_max	 = apply_filters( 'raindrops_grid_break_point_mobile', 960 );
		$break_point_desktop_min = intval( $break_point_mobile_max ) + 1;
		$break_point_desktop_max = apply_filters( 'raindrops_grid_break_point_desktop', 1280 );
		$break_point_large_min	 = intval( $break_point_desktop_max ) + 1;

		if( false === raindrops_is_grid_archives() ) {
			return;
		}

		if ( is_home() && 'excerpt_grid' == $home_excerpt ) {

			$archive_type = 'archives';
		} elseif ( is_category() && 'excerpt_grid' == $cat_excerpt ) {

			$archive_type = 'category-archives';
		} elseif ( is_search() && 'excerpt_grid' == $search_excerpt ) {

			$archive_type = 'search-results';
		} else {

			if( ! empty( $raindrops_where_excerpts ) && true == $raindrops_change_all_excerpt_archives_to_grid_layout ) {

				foreach( $raindrops_where_excerpts as $excerpt ) {

					if( function_exists(  $excerpt ) ) {

						if( $excerpt() && 'is_tag' == $excerpt ) {

							$archive_type = 'tag-archives';
							break;

						} elseif ( $excerpt() && 'is_tax' == $excerpt ) {

							$archive_type = 'archives';
							break;
						} elseif ( $excerpt() && 'is_post_type_archive' == $excerpt ) {

							$archive_type = 'custom-post-archives';
							break;
						} else {

							continue;
						}

					}
				}
			} else {

				return;
			}
		}

		$result = <<<GRID_CSS
.rd-grid .{$archive_type} .entry-content {
     margin: .5em 0 0 0;
}
.rd-grid .title-wrapper .page-title{
	position:absolute;
	top:0;
	left:0;
	right:0;
	bottom:0;
	margin:auto;
	width:100%;
	height:2.3em;
}
.rd-grid dl{
	margin:1em 0;
}
.rd-grid blockquote{
	margin:1em .5em 0 0;
}
.rd-grid .wp-post-image{
	object-fit: contain;
	max-width:100%;
}
.rd-grid.ie11 .entry-title{
	max-height:300px;
    overflow:hidden;
}

.rd-grid .index .entry-title a,
.rd-grid .index .posted-on,
.rd-grid .index .entry-title{
	max-width:100%;
	width:100%;
}
.rd-grid .index .entry-title{
	line-height:1.15;
}
.rd-grid .posted-on + .this-posted-in:before{
	/* remove spaces */
	content:'';
}
.rd-grid .entry-title ~ .edit-link,
.rd-grid .posted-on ~  .edit-link{
	margin:.5em 0;
}
.rd-grid .entry-title ~  .edit-link a,
.rd-grid .posted-on ~  .edit-link a{
	padding:.3em .5em;
    border:1px solid rgba(127,127,127,.4);
	display:inline-block;
}
.rd-grid .format-link .entry-content{
	display:block;
}
.rd-grid .format-link .entry-content :not(.raindrops-excerpt-more) a:first-of-type,
.rd-grid .format-link .entry-content p:first-of-type a{
	padding:1em;
	box-sizing:border-box;
}
.rd-grid #doc3 ul.category-archives .raindrops-category-navigation,
.rd-grid #doc5 ul.category-archives .raindrops-category-navigation{
	padding:1em;
	box-sizing:border-box;
}
.rd-grid .index.{$archive_type}{
	display:-webkit-box;
	display: -moz-box;
	display: -ms-flexbox;
	display: -webkit-flex;
	display: flex;
    flex-wrap:wrap;
	-webkit-box-orient:vertical;
	justify-content: center;
	 margin-bottom:1em;
}
.safari.rd-grid .index.{$archive_type}{
	display:block;
}
.rd-col-1.rd-grid.rd-content-width-fit ul.{$archive_type} > li,
.rd-grid ul.{$archive_type} .title-wrapper,
.rd-grid ul.{$archive_type} > li, ul.{$archive_type} > li{
    position:relative;
	flex-basis:31.6%;
    clear:none;
    margin:5px;
	overflow:hidden;
    flex-grow: 1;
    min-width:210px;/* @1.492 */
}
.safari.rd-grid ul.{$archive_type} .title-wrapper,
.safari.rd-grid ul.{$archive_type} > li, ul.{$archive_type} > li{
    position:relative;
    width:100%;
    clear:none;
    margin:.5% 0;
}
.rd-grid .format-status-not-single-post,
.rd-grid ul.{$archive_type} article{
    margin-bottom:0;
    padding:0;
	box-sizing:border-box;
	width:100%;
    height:100%;
	display:-webkit-box;
	display: -moz-box;
	display: -ms-flexbox;
	display: -webkit-flex;
	display: flex;
	-webkit-box-orient:vertical;
	justify-content: center;
    flex-direction: column;

}
.rd-grid.rd-featured-yes-front:not(.paged) .index > li .entry-title-text{
	margin-right:0;
}
.rd-grid.rd-featured-yes-front:not(.paged) ul.{$archive_type} > li .entry-title > a > span > span:nth-child(2):nth-last-child(1){
	padding-left:.65em;
	padding-right:.65em;
	box-sizing:border-box;
}
.rd-grid .posted-on,
.rd-grid.rd-featured-yes-front .posted-on{
	padding-left:1em;
	padding-right:1em;
}
.rd-grid.search .posted-on{
	margin-top:1em;
}
.rd-grid ul.{$archive_type} .format-status-not-single-post{
	margin:auto;
	padding:0;
}
.rd-grid .format-status-not-single-post .entry-content{
	margin:auto;
}
.rd-grid .format-status-not-single-post .entry-meta-list .blog-avatar,
.rd-grid .format-status-not-single-post .entry-meta-list{
	width:100%;
	margin:0;
    max-width:100%;
}
.rd-grid ul.{$archive_type} article .entry-content{
	flex-grow: 1;
	max-width:100%;
	padding:0 1em 1em;
    box-sizing:border-box;
}
.rd-grid #doc3 ul.{$archive_type} > li > div,
.rd-grid #doc5 ul.{$archive_type} > li > div{
	height:100%;
	padding:0;
}
.rd-grid ul.{$archive_type} .entry-title-text{
    word-wrap:break-word;
    overflow-wrap:break-word;
    padding:0 0 0 13px;
}
.rd-grid ul.{$archive_type} > li .entry-title > a > span > span:nth-child(1):nth-last-child(1){
/* not exist featured image */
	padding:.65em .65em 0;
	display:block;
	max-width:100%;
	margin:0;
box-sizing:border-box;
}
.rd-grid ul.{$archive_type} .entry-meta{
	width:100%;
	margin-top: auto;
	align-self: flex-end;
	max-width:100%;
}
.rd-grid.rd-featured-yes-front:not(.paged) .index > li .entry-title-text{
    width:auto;
}
.rd-col-3.rd-grid.rd-content-width-fit #doc ul.{$archive_type} > li,
.rd-col-3.rd-grid #doc ul.{$archive_type} .title-wrapper,
.rd-col-3.rd-grid #doc ul.{$archive_type} > li, ul.{$archive_type} > li{
	flex-basis:90vw;
	margin:5px;
}
.rd-col-1.rd-grid #doc ul.{$archive_type} > li{
	flex-basis:47%;
	margin:5px;
}
.rd-col-3.rd-grid #doc ul.{$archive_type} > li,
.rd-col-2.rd-grid #doc ul.{$archive_type} > li{
	flex-basis:90%;
	margin:5px;
}
.rd-col-1.rd-grid #doc4 ul.{$archive_type} > li,
.rd-col-1.rd-grid #doc2 ul.{$archive_type} > li{
	flex-basis:31.6%;
	margin:5px;
}
.rd-col-3.rd-grid #doc4 ul.{$archive_type} > li,
.rd-col-2.rd-grid #doc4 ul.{$archive_type} > li,
.rd-col-3.rd-grid #doc2 ul.{$archive_type} > li,
.rd-col-2.rd-grid #doc2 ul.{$archive_type} > li{
	flex-basis:47%;
	margin:5px;

}
.rd-col-1.rd-grid #doc1 .index article,
.rd-col-1.rd-grid #doc2 .index article,
.rd-col-1.rd-grid #doc4 .index article{
	margin:auto;
}
@media screen and (max-width : {$break_point_small_max}px){

	.rd-grid ul.{$archive_type} .title-wrapper,
	.rd-grid ul.{$archive_type} > li{
		clear:none;
		margin:auto;
	}
	.rd-col-1.rd-grid.rd-content-width-fit ul.search-results > li,
	.rd-col-1.rd-grid.rd-content-width-fit ul.archives > li,
	.rd-grid.rd-content-width-fit ul.{$archive_type} > li,
	.rd-grid ul.{$archive_type} .title-wrapper,
	.rd-grid ul.{$archive_type} > li, ul.{$archive_type} > li{
		flex-basis:90vw;
		margin:1vw 1vw;
	}
}
@media screen and (max-width : {$break_point_mobile_max}px) and (min-width:{$break_point_mobile_min}px){
	.rd-col-1.rd-grid.rd-content-width-fit ul.{$archive_type} > li,
	.rd-col-1.rd-grid ul.{$archive_type} .title-wrapper,
	.rd-col-1.rd-grid ul.{$archive_type} > li{
		flex-basis:47vw;
		margin:5px;
	}
	.rd-col-1.rd-grid.rd-content-width-keep ul.{$archive_type} > li,
	.rd-col-2.rd-grid.rd-content-width-fit ul.{$archive_type} > li,
	.rd-col-2.rd-grid ul.{$archive_type} .title-wrapper,
	.rd-col-2.rd-grid ul.{$archive_type} > li,
	.rd-col-3.rd-grid.rd-content-width-fit ul.{$archive_type} > li,
	.rd-col-3.rd-grid ul.{$archive_type} .title-wrapper,
	.rd-col-3.rd-grid ul.{$archive_type} > li{
		flex-basis:47%;
		margin:5px;
	}
	.rd-grid.rd-content-width-fit #doc ul.{$archive_type} > li,
	.rd-grid #doc ul.{$archive_type} .title-wrapper,
	.rd-grid #doc ul.{$archive_type} > li, ul.{$archive_type} > li{
		flex-basis:47%;
		margin:5px;
	}
}
@media screen and (max-width : {$break_point_desktop_max}px) and (min-width:{$break_point_desktop_min}px){
	.rd-col-1.rd-grid.rd-content-width-fit ul.{$archive_type} > li,
	.rd-col-1.rd-grid ul.{$archive_type} .title-wrapper,
	.rd-col-1.rd-grid ul.{$archive_type} > li{
		flex-basis:31.6%;
		margin:5px;
	}

	.rd-col-1.rd-grid.rd-content-width-keep ul.{$archive_type} > li,
	.rd-col-3.rd-grid.rd-content-width-fit ul.{$archive_type} > li,
	.rd-col-3.rd-grid ul.{$archive_type} .title-wrapper,
	.rd-col-3.rd-grid ul.{$archive_type} > li{
		flex-basis:47%;
		margin:5px;
	}
}
@media screen  and (min-width:{$break_point_large_min}px){

	.rd-col-1.rd-grid.rd-content-width-fit ul.{$archive_type} > li,
	.rd-col-1.rd-grid ul.{$archive_type} .title-wrapper,
	.rd-col-1.rd-grid ul.{$archive_type} > li{
			flex-basis:23%;
			margin:5px;
	}

	.rd-col-1.rd-grid.rd-content-width-keep ul.{$archive_type} > li{
			flex-basis:31.6%;
		    margin:5px;
	}
}
GRID_CSS;

if ( true ==  $raindrops_grid_posted_in ) {

$result .=<<<GRID_POSTED_IN

.rd-grid ul.search-results .click-drawing-container,
.rd-grid ul.archives .click-drawing-container {
    outline:none;
    position:relative;
}
.rd-grid ul.search-results .click-drawing-container:before,
.rd-grid ul.archives .click-drawing-container:before {
    content:"+";
    outline:none;
    display:block;
    box-sizing:border-box;
    font-weight:700;
    line-height:22px;
    border-radius: 50%;
    width:24px;
	height:24px;
    text-align:center;
    position:absolute;
    top:-32px;
    right:8px;
}
.rd-grid ul.search-results .click-drawing-container .drawing-content:empty,
.rd-grid ul.archives .click-drawing-container .drawing-content:empty{
	display:none;
}
.rd-grid ul.search-results .click-drawing-container:active .drawing-content,
.rd-grid ul.search-results .click-drawing-container:focus .drawing-content,
.rd-grid ul.archives .click-drawing-container:active .drawing-content,
.rd-grid ul.archives .click-drawing-container:focus .drawing-content {
    visibility:visible;
    outline:none;
    position:absolute;
    top:-200px;
    transition:visibility 1s;
}
.rd-grid ul.search-results .click-drawing-container .drawing-content,
.rd-grid ul.archives .click-drawing-container .drawing-content {
    z-index:1;
    padding-top:1em;
    visibility:hidden;
    position:absolute;
    top:-200px;
    margin-top:0;
    border-top:1px solid rgba(127,127,127,.3);
    max-width:none;
    width:100%;
    height:200px;
    transition:visibility 1s;
    overflow:auto;
}
@media screen and (max-width : {$break_point_small_max}px){
	.rd-grid ul.search-results .click-drawing-container,
	.rd-grid ul.archives .click-drawing-container {

	}
	.rd-grid ul.search-results .click-drawing-container .drawing-content,
	.rd-grid ul.archives .click-drawing-container .drawing-content {
		height:.2em;
		top:1em;
		text-align:center;
		border:none;
	}
	.rd-grid ul.search-results .click-drawing-container:active .drawing-content,
	.rd-grid ul.search-results .click-drawing-container:focus .drawing-content,
	.rd-grid ul.archives .click-drawing-container:active .drawing-content,
	.rd-grid ul.archives .click-drawing-container:focus .drawing-content {
		height:200px;
		top:1em;
		text-align:center;
	}
	.rd-grid ul.search-results .click-drawing-container:before,
	.rd-grid ul.archives .click-drawing-container:before {
			top:-20px;
			right:20px;
	}
}
GRID_POSTED_IN;
}
		$result = apply_filters( 'raindrops_style_archive_grid', $result, $archive_type );

		return raindrops_remove_spaces_from_css( $result );
	}
}

if ( ! function_exists( 'raindrops_is_grid_archives' ) ) {
	/**
	 *
	 * @global type $raindrops_where_excerpts
	 * @global type $raindrops_change_all_excerpt_archives_to_grid_layout
	 * @return boolean
	 * @since 1.464
	 */

	function raindrops_is_grid_archives() {

		global $raindrops_where_excerpts, $raindrops_change_all_excerpt_archives_to_grid_layout;

		$filtered = apply_filters( 'raindrops_is_grid_archives', '' );

		if( true === is_bool( $filtered ) ) {

			return $filtered;
		}

		if ( is_home() && 'excerpt_grid' == raindrops_warehouse_clone( 'raindrops_entry_content_is_home' ) ) {
			return true;
		}
		if ( is_category() && 'excerpt_grid' == raindrops_warehouse_clone( 'raindrops_entry_content_is_category' ) ) {
			return true;
		}
		if ( is_search() && 'excerpt_grid' == raindrops_warehouse_clone( 'raindrops_entry_content_is_search' ) ) {
			return true;
		}

		if ( !empty( $raindrops_where_excerpts ) && true == $raindrops_change_all_excerpt_archives_to_grid_layout ) {

			foreach ( $raindrops_where_excerpts as $excerpt ) {

				if ( function_exists( $excerpt ) ) {

					if ( $excerpt() && 'is_tag' == $excerpt ) {

						return true;
						break;
					} elseif ( $excerpt() && 'is_tax' == $excerpt ) {

						return true;
						break;
					} elseif ( $excerpt() && 'is_post_type_archive' == $excerpt ) {

						return true;
						break;
					} else {
						continue;
					}
				}
			}
		}
		return false;
	}
}

if ( ! function_exists( 'raindrops_add_switch_layout_button' ) ) {
	/**
	 * @1.466
	 */
	function raindrops_add_switch_layout_button () {

		if( true == raindrops_is_grid_archives() ) {

			$html = '<button type="button" id="rd-swich-layout" class="layout-switch-button" title="'. esc_attr__( 'Change to list layout', 'raindrops' ). '"><span class="button-text">'. esc_html__( 'Change to list layout', 'raindrops' ) .'</span></button>';
			echo apply_filters( 'raindrops_add_switch_layout_button', $html );
		}
	}
}
if ( ! function_exists( 'raindrops_is_current_post' ) ) {
	/**
	 *
	 * @global type $post
	 * @param type $url
	 * @return boolean
	 */
	function raindrops_is_current_post($url) {
		global $post;

		$postid	 = absint( url_to_postid( $url ) );

		if ( $postid == $post->ID && is_singular() ) {

			return true;
		}
		return false;
	}
}
if ( ! function_exists( 'raindrops_add_front_page_template_css' ) ) {
	/**
	 *
	 * @global type $template
	 * @return type
	 */
	function raindrops_add_front_page_template_css() {
		global $template;

		$template_name	 = basename( $template, '.php' );
		$exclude_page	 = absint( get_option( 'page_on_front' ) );
		$collections	 = '';
		$result_indv	 = '';

		if ( 'front-page' !== $template_name ) {
			return;
		}

		$args = array(
			'meta_key'		 => '_add-to-front',
			'meta_value'	 => 'add',
			'meta_compare'	 => '=',
			'post_type'		 => 'page',
			'post_status'	 => 'publish',
			'orderby'		 => 'menu_order',
			'nopaging'		 => true,
			'post__not_in'	 => array( $exclude_page, ),
		);

		$raindrops_add_front_pages = get_posts( $args );

		foreach ( $raindrops_add_front_pages as $key => $post ) {

			$raindrops_sub_query_id	 = absint( $post->ID );
			$collections			 = get_post_meta( $post->ID, 'css', true );
			$collections .= get_post_meta( $post->ID, '_css', true );
			if ( !empty( $collections ) ) {

				$sub_query_id = $post->ID;

				$result_indv .= preg_replace_callback( '![^}]+{[^}]+}!siu', function($match) use ($sub_query_id) {
					return ( preg_replace( '!#post-[0-9]+!', '#post-' . $sub_query_id, raindrops_css_add_id( $match ) ) );
				}, $collections	);
			}
		}
		wp_reset_postdata();

		return $result_indv;
	}
}

if ( ! function_exists( 'raindrops_google_font_helper_for_japanese' ) ) {
	/**
	 * google font early access for japanese helper filter
	 * @param type $font_style
	 * @param type $font_name
	 * @return string
	 */
	function raindrops_google_font_helper_for_japanese( $font_style , $font_name ) {

		if( 'Kokoro' == $font_name || 'Hannari' == $font_name ) {

			return '"Times New Roman", serif';
		}
		return $font_style;
	}
}

if( ! function_exists( 'raindrops_ssl_link_helper' ) ) {
	/**
	 * @since 1.488
	 */
	function raindrops_ssl_link_helper( $content ) {

		global $raindrops_ssl_link_helper;

		if( is_ssl( ) && true == $raindrops_ssl_link_helper ) {

			$parsed_url = parse_url (  home_url() );
			$host = $parsed_url['host'];

			$replace_pairs = apply_filters( 'raindrops_ssl_link_helper_hosts', array( 'http://'.$host =>'https://'.$host ) );

			return strtr( $content, $replace_pairs );
		}
		return $content;
	}
}

if( ! function_exists( 'raindrops_media_insert_all_sizes' ) ) {
	/**
	 *
	 * @param type $default_sizes
	 * @return type
	 * @since 1.491
	 */
	function raindrops_media_insert_all_sizes( $default_sizes ) {

		$sizes = get_intermediate_image_sizes();

		foreach( $sizes as $size ) {

			if( ! array_key_exists( $size, $default_sizes ) ) {

				$default_sizes[ $size ] = esc_attr( ucfirst( $size ) );
			}

		}
		return $default_sizes;
	}
}

if( ! function_exists( 'raindrops_font_size_class' ) ) {
	/**
	 *
	 * @return type@since 1.492
	 */

	function raindrops_font_size_class(){
		global $template;

		$template_name = basename($template,'.php');

		$font_sizes = array('f10' => 0.77, 'f11' => 0.85, 'f12' => 0.93, 'f13' => 1, 'f14' => 1.08, 'f15' => 1.16,
			'f16' => 1.231, 'f17' => 1.31, 'f18' => 1.385, 'f19' => 1.465, 'f20' => 1.539, 'f21' => 1.616, 'f22' => 1.67,
			'f23' => 1.74, 'f24' => 1.827, 'f25' => 1.89, 'f26' => 1.97, 'f27' => 2.076, 'f28' => 2.153, 'f29' => 2.23,
			'f30' => 2.30, 'f31' => 2.384, 'f32' => 2.461, 'f33' => 2.538, 'f34' => 2.615, 'f35' => 2.692, 'f36' => 2.769,
			'f37' => 2.846, 'f38' => 2.923, 'f39' => 3.00, 'f40' => 3.076);

		$raindrops_basefont_current_val	 = (int) raindrops_warehouse_clone( 'raindrops_basefont_settings' );
		$default_basefont_val			 = raindrops_warehouse_clone( 'raindrops_basefont_settings', 'option_value' );
		$default_basefont_val			 = (int) apply_filters('raindrops_font_size_class_base_font_size', $default_basefont_val, $template_name );
		$ajust							 = $default_basefont_val / $raindrops_basefont_current_val;
		$font_class						 = '';
		$debug_output					 = '';
		$rule_set						 = '.%1$s{font-size: %2$s;}';

		foreach( $font_sizes as $key => $val ) {

			if( $raindrops_basefont_current_val > 0 ) {

				$selecter = 'entry-content .'. $key. ', .post .entry-title.'.$key.', div[role="banner"] h1.'. $key;

				$font_size_val = floatval( $val ) * 100 * $ajust;
				$font_class .= sprintf( $rule_set, $selecter, $font_size_val.'%' );
			}
		}
		/**
		 * basefont size relate line-height for paragraf
		 *
		 * @1.496
		 */
		$raindrops_basefont_val = raindrops_warehouse_clone( 'raindrops_basefont_settings' );
		$line_height_values		= array('13' => 1.65, '14' => 1.6, '15' => 1.55, '16' => 1.5, '17' => 1.45, '18' => 1.4, '19' => 1.4, '20' => 1.4 );
		$line_height_values		= apply_filters('raindrops_font_size_class_line_height', $line_height_values, $template_name );

		if( array_key_exists( $raindrops_basefont_val,  $line_height_values ) ) {

			$font_class .= "\n". '.rd-category-description p ,.entry-content p{ line-height:'.floatval( $line_height_values[ $raindrops_basefont_val ] ).';}';

		}
		foreach( $line_height_values as $key=>$val ) {

			$font_class .= "\n". '.entry-content .f'. intval( $key ). '{ line-height:'.floatval( $val ).';}';
		}

		/**
		 * Always keep base font size
		 */
		$rule_set					= '%1$s{font-size: %2$s;}';
		$keep_base_size				= apply_filters('raindrops_keep_base_font_size', true );
		$keep_base_size_proparties	= array(
										'.ui-tooltip-content' => array( $default_basefont_val,'px'),
										'.topsidebar ul li' => array( $default_basefont_val,'px'),
										'body, .menu-header' =>  array( $default_basefont_val,'px'),
										'.entry-meta-list, .comment-meta a, .entry-meta' =>  array( $default_basefont_val,'px'),
										'.posted-on' =>  array( $default_basefont_val,'px'),
										'.footer-widget-wrapper ul li' =>  array( $default_basefont_val,'px'),
										'.lsidebar ul li' =>  array( $default_basefont_val,'px'),
										'.rsidebar ul li' =>  array( $default_basefont_val,'px'),
										'.tagline' =>  array( $default_basefont_val * 2,'px'),
										'[role="banner"] h1' => array( $default_basefont_val * 2,'px'),
										'.single .related-posts .entry-title' => array( $default_basefont_val * 1.231,'px'),
										'.related-posts .entry-content' => array( $default_basefont_val,'px'),
										'#nav-below, #nav-above, #nav-above-comments, #nav-below-comments' => array( $default_basefont_val,'px'),
										'.raindrops-pinup-entries .entry-title' => array( $default_basefont_val * 1.231,'px'),
										'.raindrops-post-format-chat dt' => array( $default_basefont_val * 1.231,'px'),
										'.page .edit-link' =>  array( $default_basefont_val,'px'),
										'#raindrops-recent-posts .title,.raindrops-category-posts .title,.raindrops-tag-posts .title' => array( $default_basefont_val * 1.539,'px'),
										'.portfolio .entry-title' => array( $default_basefont_val * 1.231,'px'),
										'.raindrops-monthly-archive-prev-next-avigation, .pagination, .page-template-page-featured .widget' =>  array( $default_basefont_val,'px'),
										'.archive-year-links .current-year,.datetable > h2' => array( $default_basefont_val * 1.539,'px'),
										/* @1.515 '.author .entry-title-text' => array( $default_basefont_val,'px'),*/

									);
		$keep_base_size_proparties	= apply_filters('raindrops_keep_base_size_proparties', $keep_base_size_proparties );
		$keep_base_size				= apply_filters('raindrops_keep_base_font_size', true );

		$font_class .= "\n/* keep base font size */\n";

		foreach( $keep_base_size_proparties as $propaty => $val ) {

			if( $keep_base_size ) {

				$font_class .= sprintf( $rule_set,  $propaty, $val[0].$val[1] );
			}
		}

		//Backward compatibility
		$compatibility = apply_filters('raindrops_font_size_class_backword_compatibility', true );

		if(  true == $compatibility  && 'ja' !== get_locale() ) {

			$font_size = floor( $default_basefont_val * 1.539 );

			$font_class .= '/* raindrops_font_size_class */';

			$font_class .= '.search .pagetitle,	.date .page-title,.archive .archives .title-wrapper .title,	.entry-content h2, article div .h2, article .entry-title{
	font-size:230.7%;
}';
			$font_class .= '.entry-content h3, article div .h3{
	font-size:153.9%;
}';

			$font_class .= '@media screen and (max-width : 640px){
	.search .pagetitle,	.date .page-title,.archive .archives .title-wrapper .title, .entry-content h2, article div .h2, article .entry-title{
		font-size:'.$font_size.'px;
	}
	.entry-content h3{
		font-size:123.9%;
	}
}';
			$font_class .= '/* raindrops_font_size_class */';
		}

		$font_class = raindrops_remove_spaces_from_css( $font_class );
		return apply_filters( 'raindrops_font_size_class', $font_class );
	}
}

if ( ! function_exists( 'raindrops_category_link_fomat' ) ) {
	/**
	 *
	 * @param type $output
	 * @param type $args
	 * @return type
	 */
	function raindrops_category_link_fomat( $output, $args ) {

		if( isset( $args['show_count'] ) && $args['show_count'] ) {

			return preg_replace( '!\(([0-9]+)\)!',"<span class=\"rd-cat-count\">$1</span>",$output );
		}

		return $output;
	}
}

if ( ! function_exists( 'raindrops_archive_link_format' ) ) {
	/**
	 *
	 * @param string $link_html
	 * @param type $url
	 * @param type $text
	 * @param type $format
	 * @param type $before
	 * @param type $after
	 * @return type
	 */
	function raindrops_archive_link_format( $link_html, $url, $text, $format, $before, $after){

		if( $format == 'html'  ) {

			$after = str_replace( array('(',')','&nbsp;' ),'', $after );

			$link_html = '<li><a href="%1$s" class="rd-archive-link"><span class="rd-archive-date">%2$s</span>
<span class="rd-archive-count">%3$s</span></a></li>';

			return sprintf( $link_html, $url,$text, $after );
		}

		return $link_html;
	}
}

if( ! function_exists( 'raindrops_add_codemirror_for_raindrops_custom_css_field' ) ) {
	/**
	 *
	 * @return type
	 */
	function raindrops_add_codemirror_for_raindrops_custom_css_field(){

		if ( 'page' !== get_current_screen()->id && 'post' !== get_current_screen()->id ) {
			return;
		}
		if( ! function_exists( 'wp_enqueue_code_editor' ) ) {
			return;
		}

		$settings = wp_enqueue_code_editor( array( 'type' => 'text/css' ) );

		if ( false === $settings ) {
			return;
		}

		wp_add_inline_script(
			'code-editor',
			sprintf(
				'jQuery( function() { wp.codeEditor.initialize( "raindrops_custom_css_field", %s ); } );',
				wp_json_encode( $settings )
			)
		);
	}
}

if ( ! function_exists( 'raindrops_automatic_modal_rel_rev_sidebar' ) ) {
	/**
	 *
	 * @param type $content
	 * @param type $instance
	 * @return type
	 * @since 1.498
	 */
	function raindrops_automatic_modal_rel_rev_sidebar( $content, $instance ) {

			if ( false !== strpos( $content, 'raindrops_modal_fragment_id_automatic' ) ) {
				$id = md5($instance["content"]);
				$modals	 = explode( '#raindrops_modal', $content );
				$result	 = '';
				foreach ( $modals as $key => $modal ) {

					$unique_id		 = 'modal_box_' . esc_attr($id) . '_' . absint( $key );
					$flagment_link	 = '#' . $unique_id;
					$result .= str_replace( array( 'raindrops_modal_fragment_id_automatic', '_fragment_id_automatic', ), array( $unique_id, $flagment_link ), $modal );
				}

				$result = str_replace( 'data-modal-id=', 'id=', $result );

				return $result;
			}
			return $content;
	}
}

if( ! function_exists( 'raindrops_width_class_and_relate_settings' ) ) {
	/**
	 *
	 * @return type
	 * @since 1.505
	 */
	function raindrops_width_class_and_relate_settings(){

			/* @1.346  image width class */
			$thumbnail_size_w = get_option( 'thumbnail_size_w' );
			if ( !empty( $thumbnail_size_w ) ) {
				if ( $thumbnail_size_w < 160 ) {
					$thumbnail_size_w = 160;
				}
				$css = ' .rd-thumbnail{width:' . absint( $thumbnail_size_w ) . 'px; max-width:100%;}';
			}

			$medium_size_w = get_option( 'medium_size_w' );
			if ( !empty( $medium_size_w ) ) {

				$css .= ' .rd-medium{width:' . absint( $medium_size_w ) . 'px; max-width:100%;}';
			}
			$large_size_w = get_option( 'large_size_w' );
			if ( !empty( $large_size_w ) ) {

				$css .= ' .rd-large{width:' . absint( $large_size_w ) . 'px; max-width:100%;}';
			}

			$css .= ' .rd-w320{width:320px; max-width:100%;}';
			$css .= ' .rd-w480{width:480px; max-width:100%;}';
			$css .= ' .rd-w640{width:640px; max-width:100%;}';
			$css .= ' .alignleft.size1of2{ max-width:calc( 50% - 1em ); }';
			$css .= ' .alignleft.size1of3{ max-width:calc( 33.33333% - 1em ); }';
			$css .= ' .alignleft.size2of3{ max-width:calc( 66.66666% - 1em ); }';
			$css .= ' .alignleft.size1of4{ max-width:calc( 24.99% - 1em ); }';
			$css .= ' .alignleft.size3of4{ max-width:calc( 75% - 1em ); }';
			$css .= ' .alignleft.size1of5{ max-width:calc( 19.99% - 1em ); }';
			$css .= ' .alignleft.size2of5{ max-width:calc( 40% - 1em ); }';
			$css .= ' .alignleft.size3of5{ max-width:calc( 60% - 1em ); }';
			$css .= ' .alignleft.size4of5{ max-width:calc( 80% - 1em ); }';
			$css .= ' .alignright.size1of2{ max-width:calc( 50% - 1em ); }';
			$css .= ' .alignright.size1of3{ max-width:calc( 33.33333% - 1em ); }';
			$css .= ' .alignright.size2of3{ max-width:calc( 66.66666% - 1em ); }';
			$css .= ' .alignright.size1of4{ max-width:calc( 24.99% - 1em ); }';
			$css .= ' .alignright.size3of4{ max-width:calc( 75% - 1em ); }';
			$css .= ' .alignright.size1of5{ max-width:calc( 19.99% - 1em ); }';
			$css .= ' .alignright.size2of5{ max-width:calc( 40% - 1em ); }';
			$css .= ' .alignright.size3of5{ max-width:calc( 60% - 1em ); }';
			$css .= ' .alignright.size4of5{ max-width:calc( 80% - 1em ); }';
			$css .= ' .alignnone.size1of2{ max-width:calc( 50% - 1em ); }';
			$css .= ' .alignnone.size1of3{ max-width:calc( 33.33333% - 1em ); }';
			$css .= ' .alignnone.size2of3{ max-width:calc( 66.66666% - 1em ); }';
			$css .= ' .alignnone.size1of4{ max-width:calc( 24.99% - 1em ); }';
			$css .= ' .alignnone.size3of4{ max-width:calc( 75% - 1em ); }';
			$css .= ' .alignnone.size1of5{ max-width:calc( 19.99% - 1em ); }';
			$css .= ' .alignnone.size2of5{ max-width:calc( 40% - 1em ); }';
			$css .= ' .alignnone.size3of5{ max-width:calc( 60% - 1em ); }';
			$css .= ' .alignnone.size4of5{ max-width:calc( 80% - 1em ); }';

			/**
			 *
			 * This style for Gutenberg functionality.
			 * @since 1.505
			 * ToDo if gutenberg core, marge above code.
			 */
			$thumbnail_size_w = get_option( 'thumbnail_size_w' );
			if ( !empty( $thumbnail_size_w ) ) {

				if ( $thumbnail_size_w < 160 ) {

					$thumbnail_size_w = 160;
				}
				$css .= ' figure[class|="wp-block"].rd-thumbnail{width:' . absint( $thumbnail_size_w ) . 'px; max-width:100%;}';
			}

			$medium_size_w = get_option( 'medium_size_w' );
			if ( !empty( $medium_size_w ) ) {

				$css .= ' figure[class|="wp-block"].rd-medium{width:' . absint( $medium_size_w ) . 'px; max-width:100%;}';
			}
			$large_size_w = get_option( 'large_size_w' );
			if ( !empty( $large_size_w ) ) {

				$css .= ' figure[class|="wp-block"].rd-large{width:' . absint( $large_size_w ) . 'px; max-width:100%;}';
			}
			$css .= ' figure[class|="wp-block"].rd-w320{width:320px; max-width:100%;}';
			$css .= ' figure[class|="wp-block"].rd-w480{width:480px; max-width:100%;}';
			$css .= ' figure[class|="wp-block"].rd-w640{width:640px; max-width:100%;}';

			/* responsive percent width class */
			$css .= ' figure[class|="wp-block"].size1of2{ max-width:calc( 50% - 1em ); }';
			$css .= ' figure[class|="wp-block"].size1of3{ max-width:calc( 33.33333% - 1em ); }';
			$css .= ' figure[class|="wp-block"].size2of3{ max-width:calc( 66.66666% - 1em ); }';
			$css .= ' figure[class|="wp-block"].size1of4{ max-width:calc( 24.99% - 1em ); }';
			$css .= ' figure[class|="wp-block"].size3of4{ max-width:calc( 75% - 1em ); }';
			$css .= ' figure[class|="wp-block"].size1of5{ max-width:calc( 19.99% - 1em ); }';
			$css .= ' figure[class|="wp-block"].size2of5{ max-width:calc( 40% - 1em ); }';
			$css .= ' figure[class|="wp-block"].size3of5{ max-width:calc( 60% - 1em ); }';
			$css .= ' figure[class|="wp-block"].size4of5{ max-width:calc( 80% - 1em ); }';

			$css .= '.rd-w640,.rd-w480,.rd-w320,.rd-large,.rd-medium,.rd-thumbnail{margin-left:0;margin-right:0;}';
			//$css .= '.size1of2,.size1of3,.size2of3,.size1of4,.size3of4,.size1of5,.size2of5,.size3of5,.size4of5{margin-left:0;margin-right:0;}';
$css .= '.alignleft.size1of2,.alignleft.size1of3,
	.alignleft.size2of3,
	.alignleft.size1of4,
	.alignleft.size3of4,
	.alignleft.size1of5,
	.alignleft.size2of5,
	.alignleft.size3of5,
	.alignleft.size4of5{margin-top:.5em;margin-bottom:1em;margin-left:0;}';
$css .= '.alignright.size1of2,.alignright.size1of3,
	.alignright.size2of3,
	.alignright.size1of4,
	.alignright.size3of4,
	.alignright.size1of5,
	.alignright.size2of5,
	.alignright.size3of5,
	.alignright.size4of5{margin-top:.5em;margin-bottom:1em;margin-right:0;}';
$css .= '.alignnone.size1of2,.alignnone.size1of3,
	.alignnone.size2of3,
	.alignnone.size1of4,
	.alignnone.size3of4,
	.alignnone.size1of5,
	.alignnone.size2of5,
	.alignnone.size3of5,
	.alignnone.size4of5{margin-top:.5em;margin-bottom:1em;}';
$css .= '.paragraph_wrap_enable .size1of2,.paragraph_wrap_enable .size1of3,
	.paragraph_wrap_enable .size2of3,
	.paragraph_wrap_enable .size1of4,
	.paragraph_wrap_enable .size3of4,
	.paragraph_wrap_enable .size1of5,
	.paragraph_wrap_enable .size2of5,
	.paragraph_wrap_enable .size3of5,
	.paragraph_wrap_enable .size4of5{margin-left:auto;margin-right:auto;}';

			$style_rule = '.widgettext .rd-table-wrapper.alignright > .alignright.%2$s,
							.entry-content .rd-table-wrapper.alignright > .alignright.%2$s{
								position:relative;
								float:none;
								left:calc( -%1$dpx - 1.5em );
								   -webkit-transform: translate(calc( %1$dpx + 1.5em ), 0 );
									-ms-transform: translate(calc( %1$dpx + 1.5em ), 0 );
								transform: translate(calc( %1$dpx + 1.5em ), 0 );
							}';

			$thumbnail_size_w = get_option( 'thumbnail_size_w' );

			if ( !empty( $thumbnail_size_w ) ) {
				if ( $thumbnail_size_w < 160 ) {
					$thumbnail_size_w = 160;
				}
				$css .= sprintf( $style_rule, absint( $thumbnail_size_w / 2 ), 'rd-thumbnail' );
			}

			$medium_size_w = get_option( 'medium_size_w' );

			if ( !empty( $medium_size_w ) ) {

				$css .= sprintf( $style_rule, absint( $medium_size_w / 2 ), 'rd-medium' );
			}
			$large_size_w = get_option( 'large_size_w' );
			if ( !empty( $large_size_w ) ) {

				$css .= sprintf( $style_rule, absint( $large_size_w / 2 ), 'rd-large' );
			}

			$css .= sprintf( $style_rule, 160, 'rd-w320' );
			$css .= sprintf( $style_rule, 240, 'rd-w480' );
			$css .= sprintf( $style_rule, 320, 'rd-w640' );

			return $css;
	}
}

if ( ! function_exists( 'raindrops_convert_inline_style_to_attribute_style' ) ) {
	/**
	 *
	 * @global type $post
	 * @param type $tag
	 * @param type $handle
	 * @param type $src
	 * @return type
	 * @since 1.511
	 */

	function raindrops_convert_inline_style_to_attribute_style( $tag, $handle, $src ) {
		global $post;

		if ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) {
			return $tag;
		}

		$doc_type = raindrops_warehouse_clone( 'raindrops_doc_type_settings' );

		if ( !is_admin() && !empty( $post ) && $handle == "style" && 'html5' == $doc_type ) {

			return $tag . "\n<style class=\"raindrops-convert-inline-style-to-attribute-style\">\n" . raindrops_convert_inline_style_to_css() . "\n</style>\n";
		}
		return $tag;
	}
}

if ( ! function_exists( 'raindrops_convert_inline_style_to_data_attr' ) ) {
	/**
	 *
	 * @param type $post_content
	 * @return type
	 * @since 1.511
	 */
	function raindrops_convert_inline_style_to_data_attr( $post_content ) {

		if ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) {
			return $post_content;
		}
		$doc_type = raindrops_warehouse_clone( 'raindrops_doc_type_settings' );
		$allow = raindrops_warehouse_clone( 'raindrops_replace_style_sttr_width_data_attr');

		if ( !is_admin() && 'html5' == $doc_type && 'enable' == $allow ) {

			return preg_replace_callback( '! style="[^"]*"!', 'raindrops_convert_inline_style_to_data_attr_callback', $post_content );
		}
		return $post_content;
	}
}

if ( ! function_exists( 'raindrops_convert_inline_style_to_data_attr_callback' ) ) {
	/**
	 *
	 * @param type $matches
	 * @return type
	 */
	function raindrops_convert_inline_style_to_data_attr_callback($matches){

		$result = preg_replace( '!\s*!m','', wp_strip_all_tags( $matches[0] ) );

		return " data-rd-".trim($result);
	}
}

if ( ! function_exists( 'raindrops_convert_inline_style_to_css' ) ) {
	/**
	 * @since 1.511
	 */
	function raindrops_convert_inline_style_to_css() {

		if ( function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) {
			return;
		}

		$doc_type = raindrops_warehouse_clone( 'raindrops_doc_type_settings' );
		$allow = raindrops_warehouse_clone( 'raindrops_replace_style_sttr_width_data_attr');

		if ( !is_admin() && 'html5' == $doc_type  && 'enable' == $allow ) {

			$result		 = '';
			$attribute	 = array();
			$css		 = '.page .entry-content [data-rd-%1$s],.post .entry-content [data-rd-%1$s]{ %2$s }';

			if ( have_posts() ) {

				while ( have_posts() ) {

					the_post();
					$post_id = get_the_ID();

					preg_match_all( '!style="([^"]*)"!', get_post_field( 'post_content', $post_id ), $matches, PREG_SET_ORDER );

					foreach ( $matches as $inline_style ) {


						$inline_style[1] = preg_replace('$max-width:\s*50%$','', $inline_style[1] );

						$key = preg_replace( '!\s*!m','', wp_strip_all_tags( $inline_style[0] ) );
						$key = rtrim($key, ";");
						$val = preg_replace( '!\s*!m','', wp_strip_all_tags( $inline_style[1] ) );

						$attribute[ $key ] = $val;
					}
				}
			}

			rewind_posts();

			$class_array = array_unique( $attribute );

			foreach ( $class_array as $property => $value ) {

				$result .= sprintf( $css, $property, $value );
			}

			return apply_filters( 'raindrops_convert_inline_style_to_css', $result );
		}
		return;
	}
}

if ( ! function_exists( 'raindrops_tinymce_body_classes' ) ) {
	/**
	 *
	 * @param string $init_array
	 * @return string
	 * @since 1.511
	 */
	function raindrops_tinymce_body_classes( $init_array ) {

		$line_wrapping = raindrops_warehouse_clone( 'raindrops_paragraph_line_wrapping' );

		if ( 'enable' == $line_wrapping ) {
			$init_array[ 'body_class' ] = 'paragraph_wrap_enable';
		}

		return $init_array;
	}

}
if ( ! function_exists( 'raindrops_fallback_header_text_color' ) ) {
	/**
	 * 
	 * @global type $post
	 * @return type
	 */
	function raindrops_fallback_header_text_color(){

		global $post;

		if ( is_singular() ) {

			$raindrops_style_type = raindrops_warehouse_clone( "raindrops_style_type" );

			if ( isset( $raindrops_style_type ) && !empty( $raindrops_style_type ) ) {

				$color_type = sanitize_html_class( $raindrops_style_type );
			}
			if ( false !== ($type = raindrops_has_indivisual_notation() ) ) {

				if ( isset( $type['color_type'] ) ) {

					$color_type = sanitize_html_class( $type[ 'color_type' ] );
				}
			}
			if ( ! isset( $color_type ) ) { // When not using database
				$color_type = sanitize_html_class( raindrops_warehouse( 'raindrops_style_type', 'option_value' ) );
			}

			$raindrops_text_color = raindrops_default_colors_clone( $color_type, 'raindrops_header_color' );

			return $raindrops_text_color;
		}
	}
}
$search_condition = raindrops_warehouse_clone( 'raindrops_entry_content_is_search' );

if( 'keyword' == $search_condition ) {
	$raindrops_search_keyword_highlight = true;
	add_filter( 'the_title', 'raindrops_keyword_with_mark_elements_title', 99999 );
	add_filter( 'the_content', 'raindrops_keyword_with_mark_elements', 99999 );	
} else {
	$raindrops_search_keyword_highlight = false;
	if( has_filter( 'the_title', 'raindrops_keyword_with_mark_elements_title' ) ) {
		remove_filter( 'the_title', 'raindrops_keyword_with_mark_elements_title', 99999 );
	}
	if( has_filter( 'the_content', 'raindrops_keyword_with_mark_elements', 99999 ) ) {
		remove_filter( 'the_content', 'raindrops_keyword_with_mark_elements', 99999 );
	}
}
if ( ! function_exists( 'raindrops_search_from_terms' ) ) {

	function raindrops_search_from_terms( $target_terms = array( 'category', 'post_tag' ), $echo = true ) {
		global $raindrops_search_keyword_highlight;

		if( true !== $raindrops_search_keyword_highlight ) {
			return;
		}

		$search_query = mb_strtolower( get_search_query() );
		$results = '';

		foreach ( $target_terms as $target_term ) {

			$result = '';
			$args	 = apply_filters( 'function search_from_terms_args', array(), $target_term );
			$terms	 = get_terms( $target_term, $args );

			foreach ( $terms as $term ) {


				$id			 = $term->term_id;
				$term_link	 = get_category_link( $id );
				$term_name	 = mb_strtolower( $term->name );

				if ( preg_match( '!' . $search_query . '!', $term_name ) ) {

					$result .= sprintf( '<li><a href="%2$s" class="%3$s"><mark>%1$s</mark></a></li>', esc_html( $term->name ), esc_url( $term_link ),$target_term );
				}
				if ( preg_match( '!' . $term_name . '!', $search_query ) ) {

					$result .= sprintf( '<li><a href="%2$s" class="%3$s"><mark>%1$s</mark></a></li>', esc_html( $term->name ), esc_url( $term_link ),$target_term );
				}

			}

			$results .= $result;

		}

		if ( true == $echo && !empty($results)) {
					printf('<ul class="search-relate-terms horizontal-list-group">%1$s</ul>',$results );
		}
		if ( false == $echo && !empty($results)) {
					return sprintf('<ul class="search-relate-terms horizontal-list-group">%1$s</ul>',$results );
		}
	}
}
if ( ! function_exists( 'raindrops_keyword_with_mark_elements' ) ) {
	/**
	 * 
	 * @global type $raindrops_search_keyword_highlight
	 * @param type $text
	 * @return type
	 */
	function raindrops_keyword_with_mark_elements( $text ) {
			global $raindrops_search_keyword_highlight;

		if( true !== $raindrops_search_keyword_highlight ) {
			return $text;
		}
		/**
		 * The word search core search function will hit even if html class name,
		 * part of short code name etc. are searched in the contribution body.
		 * In such a case, they will not be highlighted with the mark element.
		 */

		if ( ! is_search() || ! is_main_query() ) {
			return $text;
		}

		$search_query					 = get_search_query();
		$text							 = strip_tags( $text );
		$style_rules_for_searched_text	 = 'color:#000;padding:0;';

		$hilight_rules = array(
			array( mb_strtolower( $search_query ) => $style_rules_for_searched_text ),
			array( mb_strtoupper( $search_query ) => $style_rules_for_searched_text ),
			array( mb_convert_case( $search_query, MB_CASE_TITLE, "UTF-8" ) => $style_rules_for_searched_text ),
			array( ucfirst( $search_query ) => $style_rules_for_searched_text ),
			array( ucwords( $search_query ) => $style_rules_for_searched_text ),
			array( $search_query => $style_rules_for_searched_text ),
		);

		$checksum		 = crc32( $text );
		$class_name		 = trim( sprintf( "search-result-%u\n", $checksum ) );
		$wrapper		 = '<mark style="%1$s">%2$s</mark>';
		$block_wrapper	 = '<span class="%1$s">%2$s</span>';

		foreach ( $hilight_rules as $value ) {

			$name			 = key( $value );
			$replace_value	 = sprintf( $wrapper, esc_attr( $value[ $name ] ), $name );
			$text			 = str_replace( $name, $replace_value, $text, $count );

			if ( $count > 0 ) {
				break;
			}
		}
		$result = '';
		preg_match_all('!(.*)(<[^>]+>[^<]*</mark>)(.*)!',$text,$matches,PREG_SET_ORDER);

		if( isset($matches) && !empty($matches)){
			foreach( $matches as $m ){
		$result .= sprintf( $block_wrapper, $class_name,'<p>...'.$m[0].'...</p>' );
			}
			$text = $result;
		}else{
			$text = '';
		}



		return apply_filters( 'raindrops_keyword_with_mark_elements_title', $text);
	}
}
if ( ! function_exists( 'raindrops_keyword_with_mark_elements_title' ) ) {
	/**
	 * 
	 * @global type $raindrops_search_keyword_highlight
	 * @param type $text
	 * @return type
	 */
	function raindrops_keyword_with_mark_elements_title( $text ) {
		global $raindrops_search_keyword_highlight;

		if( true !== $raindrops_search_keyword_highlight ) {
			return $text;
		}

		if ( ! is_search() || ! is_main_query() ) {
			return $text;
		}

		$search_query					 = get_search_query();
		$text							 = strip_tags( $text );
		$style_rules_for_searched_text	 = 'color:#000;padding:0;';

		$hilight_rules = array(
			array( mb_strtolower( $search_query ) => $style_rules_for_searched_text ),
			array( mb_strtoupper( $search_query ) => $style_rules_for_searched_text ),
			array( mb_convert_case( $search_query, MB_CASE_TITLE, "UTF-8" ) => $style_rules_for_searched_text ),
			array( ucfirst( $search_query ) => $style_rules_for_searched_text ),
			array( ucwords( $search_query ) => $style_rules_for_searched_text ),
			array( $search_query => $style_rules_for_searched_text ),
		);

		$checksum		 = crc32( $text );
		$class_name		 = trim( sprintf( "search-result-%u\n", $checksum ) );
		$wrapper		 = '<mark style="%1$s">%2$s</mark>';

		foreach ( $hilight_rules as $value ) {

			$name			 = key( $value );
			$replace_value	 = sprintf( $wrapper, esc_attr( $value[ $name ] ), $name );
			$text			 = str_replace( $name, $replace_value, $text, $count );

			if ( $count > 0 ) {
				break;
			}
		}
		return apply_filters( 'raindrops_keyword_with_mark_elements_title', $text);
	}
}



if ( ! function_exists( 'raindrops_add_lazyload_script' ) ) {
	/**
	 * 
	 */
	function raindrops_add_lazyload_script() {

		$raindrops_lazyload_image_enable		= raindrops_warehouse_clone( 'raindrops_lazyload_image' );
		$only_front_end							= raindrops_scripts_operate_only_front_end();
		$handle									= 'raindrops-lazyload';
		$list									= 'registered';
		
		if ( wp_script_is( $handle, $list ) ) {
			
			if('enable' == $raindrops_lazyload_image_enable && $only_front_end ) {

				wp_enqueue_script( 'raindrops-lazyload' );

			   $script = "jQuery('img:not(.avator)').each(function (index) {
			   var text = jQuery(this).attr('src');
			   jQuery(this).attr('data-src', text);
			   jQuery(this).attr('src', '" . get_template_directory_uri() . "/images/loader.svg');
			   jQuery(this).addClass('lazyload');
			   });";

			   $script .= ' jQuery("img.lazyload").lazyload();';
			   
				wp_add_inline_script( 'raindrops-lazyload', $script );
			}
		}
	}
}

if ( ! function_exists( 'raindrops_add_instantclick_script' ) ) {
	/**
	 * 
	 */
	function raindrops_add_instantclick_script() {
	
		$raindrops_performance_helper_enable	= raindrops_warehouse_clone( 'raindrops_performance_helper' );
		$only_front_end							= raindrops_scripts_operate_only_front_end();

		$handle = 'raindrops-instantclick';
		$list = 'registered';
		
		if (wp_script_is( $handle, $list )) {

			if('enable' == $raindrops_performance_helper_enable && $only_front_end ) {
				wp_enqueue_script( 'raindrops-instantclick' );

				   $script = "InstantClick.init();";

				  wp_add_inline_script( 'raindrops-instantclick', $script );
			}
		}
	}
}

if ( ! function_exists( 'disable_instantclick' ) ) {
	/**
	 * 
	 * @param type $tag
	 * @param type $handle
	 * @param type $src
	 * @return type
	 */
	function disable_instantclick( $tag, $handle, $src ) {
		//$support = petrusschoeffer_get_supports( 'instantclick' );
		if ( 'raindrops-instantclick' === $handle  ) {
			$tag = str_replace( 'src=', 'data-no-instant src=', $tag );
		}
		return $tag;
	}
	
}

if ( ! function_exists( 'raindrops_scripts_operate_only_front_end' ) ) {
	/**
	 * 
	 * @return boolean
	 */
	function raindrops_scripts_operate_only_front_end() {
		
		$raindrops_scripts_operate_only_front_end = apply_filters('raindrops_scripts_operate_only_front_end', 'none' );
		
		if( 'none' !== $raindrops_scripts_operate_only_front_end ) {
			
			return $raindrops_scripts_operate_only_front_end;
		}
		
		if( ! is_admin() && ! is_customize_preview() && ! is_user_logged_in() && empty( $_GET ) ) {
			
			return true;
		}
		return false;
		
	}
}

if ( ! function_exists( 'raindrops_custom_gutenberg_edit_link' ) ) {

	/**
	 *
	 * @param type $link
	 * @param type $post_id
	 * @param type $text
	 * @return type
	 */
	function raindrops_custom_gutenberg_edit_link( $link, $post_id, $text ) {

		$which				 = get_post_meta( $post_id, 'classic-editor-remember', true );
		$allow_users_option	 = get_option( 'classic-editor-allow-users' );

		$disallow_old_post_open_classic_editor = apply_filters( 'disallow_old_post_open_classic_editor', false );

		if ( 'allow' == $allow_users_option ) {

			if ( ( current_user_can( 'edit_posts' ) || current_user_can( 'edit_pages' ) ) && 'classic-editor' == $which ) {

				$gutenberg_action = sprintf(
						'<a href="%1$s" class="skin-button">%2$s</a>', esc_url( add_query_arg(
										array( 'post' => $post_id, 'action' => 'edit', 'classic-editor' => '', 'classic-editor__forget' => '' ), admin_url( 'post.php' )
						) ), esc_html__( 'Classic Editor', 'raindrops' ) );

				return $gutenberg_action;
			}
		}
		if ( ( current_user_can( 'edit_posts' ) || current_user_can( 'edit_pages' ) ) && ! metadata_exists( 'post', $post_id, 'classic-editor-remember' ) && ! $disallow_old_post_open_classic_editor ) {

			$gutenberg_action = sprintf(
					'<a href="%1$s" class="skin-button">%2$s</a>', esc_url( add_query_arg(
									array( 'post' => $post_id, 'action' => 'edit', 'classic-editor' => '', 'classic-editor__forget' => '' ), admin_url( 'post.php' )
					) ), esc_html__( 'Classic Editor', 'raindrops' ) );

			return $gutenberg_action;
		}

		return $link;
	}
}


if ( ! function_exists( 'raindrops_remove_verify_html' ) ) {
	/**
	 * 
	 * @param boolean $init
	 * @param type $block
	 * @return boolean
	 * @since 1.532
	 */
	function raindrops_remove_verify_html( $init , $block ) {

		if( 'classic-block' == $block ) {
			$init['verify_html'] = false;
		}
		return $init;
	}
}
/**
 *
 *
 *
 * @since 1.138
 */
do_action( 'raindrops_last' );
