<?php
/**
 * functions and constants for Raindrops theme
 *
 *
 * @package Raindrops
 * @since Raindrops 0.1
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Keyword highlight for Search results 
 * @since 1.521
 */
if( ! isset( $raindrops_search_keyword_highlight ) ) {
	$raindrops_search_keyword_highlight = false;
}

/**
 * 
 */
if( false == get_theme_mod( 'header_textcolor') ) {

	$header_textcolor = raindrops_default_color_clone( 'header_textcolor', 'fallback' );
	$header_textcolor = str_replace('#', '', $header_textcolor);
	set_theme_mod( 'header_textcolor', $header_textcolor );
}
/**
 * Use Raindrops Class rd-justify with javascript
 * purpose: Solve the river of white problem with short strings.
 * class rd-justify make equal spacing each string with javascript
 * when false Not using javascript. use only CSS .rd-justify{text-align: justify;} .
 */
if( ! isset( $raindrops_class_rd_justify_enable ) ) {
	$raindrops_class_rd_justify_enable = true;
}
/**
 * Use Raindrops gallery template
 * when category gallery, post format gallery
 */
if( ! isset( $raindrops_use_part_gallery_template ) ) {
	$raindrops_use_part_gallery_template = true;
}
/**
 * Use Raindrops blog template
 * when category blog, post format blog
 */
if( ! isset( $raindrops_use_part_blog_template ) ) {
	$raindrops_use_part_blog_template = true;
}
/**
 * When WEBSITE Change from http: to https
 * Old post content filtered to https://your domain/...
 */
if( ! isset( $raindrops_ssl_link_helper ) ) {

	$raindrops_ssl_link_helper = true;
}
/**
 * Customize / Featured Image Settings  Featured Image Special Layout Apply Post Count limit
 * @since 1.472
 * value 'posts_per_page' or 'none'
 * ver1.472 default none. Experimental implementation
 */
if( ! isset( $raindrops_featured_image_recent_post_count_limit ) ) {

	$raindrops_featured_image_recent_post_count_limit = 'none';
}
/**
 * @since 1.470
 * target='_blank' link add rel="noopener noreferrer" for security reason
 * removed @1.533 
 */
/*
if( ! isset( $raindrops_allow_safe_link_target ) ) {
	$raindrops_allow_safe_link_target = true;
}*/
/**
 * @since 1.470
 * Grid layout posted in style
 */
if( ! isset($raindrops_grid_posted_in ) ) {
	$raindrops_grid_posted_in = true;
}
/**
 * @since 1.464
 */
if( ! isset( $raindrops_change_all_excerpt_archives_to_grid_layout ) ) {
	$raindrops_change_all_excerpt_archives_to_grid_layout = false;
}
/**
 * custom format needs style
 * The excerpt display of WordPress removes all html, but the custom format has no meaning unless it has html
 * @since 1.464
 */
if( ! isset( $raindrops_change_html_excerpt_when_post_formats ) ) {
	$raindrops_change_html_excerpt_when_post_formats = true;
}
/**
 * Raindrops base setttings for Fresh Install Users
 * It applies when you have not created a post after installing the Raindrops theme, or when the $raindrops_year_2017_base_settings variable is true.
 * @since 1.449
 */

if ( isset($raindrops_year_2017_base_settings) && true == $raindrops_year_2017_base_settings ) {
	$raindrops_year_2017_base_settings = true;
	set_theme_mod( 'raindrops_year_2017_base_settings', 'yes' );
	set_theme_mod('raindrops_new_base_setting','yes');
}
if ( false == get_theme_mod( 'raindrops_blog_last_modified_date', false ) ) {
	set_theme_mod( 'raindrops_year_2017_base_settings', 'yes' );
	set_theme_mod('raindrops_new_base_setting','yes');
}
if ( isset($raindrops_year_2017_base_settings) && false == $raindrops_year_2017_base_settings  ) {
	$raindrops_year_2017_base_settings = false;
	remove_theme_mod( 'raindrops_year_2017_base_settings' );
	remove_theme_mod('raindrops_new_base_setting');
}
// year 2018 settings

if ( isset($raindrops_year_2018_base_settings) && true == $raindrops_year_2018_base_settings ) {
	$raindrops_year_2018_base_settings = true;
	$raindrops_year_2017_base_settings = false;
	set_theme_mod( 'raindrops_year_2018_base_settings', 'yes' );
	set_theme_mod('raindrops_new_base_setting','yes');
}
if ( false == get_theme_mod( 'raindrops_blog_last_modified_date', false ) ) {
	set_theme_mod( 'raindrops_year_2018_base_settings', 'yes' );
	set_theme_mod('raindrops_new_base_setting','yes');
}
if ( isset($raindrops_year_2018_base_settings) && false == $raindrops_year_2018_base_settings  ) {
	$raindrops_year_2018_base_settings = false;
	remove_theme_mod( 'raindrops_year_2018_base_settings' );
	remove_theme_mod('raindrops_new_base_setting');
}
/**
 * Pinup_entry_widget add custom post type
 * @since 1.441
 */
if ( !isset( $raindrops_widget_post_types ) ) {
	$raindrops_widget_post_types = array();
}
/**
 * add sidebar height with inline style from jQuery for equal height sidebar.
 * When false, Raindrops will use CSS equal height settings
 * default true
 * value bool, true or false
 *
 */
if ( !isset( $raindrops_add_inline_style_for_sidebars ) ) {
	$raindrops_add_inline_style_for_sidebars = true;
}
/**
 * Auto load minified CSS and javascript files
 * file naming rule
 *    css filename + $raindrops_minified_suffix + .css
 *
 * @since 1.411
 */
if ( !isset( $raindrops_load_minified_css_js ) ) {
	/**
	 * value true or false
	 * false  not load minified file
	 */
	$raindrops_load_minified_css_js = true;
}
if ( !isset( $raindrops_minified_files_js_dir ) ) {
	/**
	 * only string dirname
	 *     can not use directory separator
	 */
	$raindrops_minified_files_js_dir = '';
}
if ( !isset( $raindrops_minified_files_css_dir ) ) {
	/**
	 * only string dirname
	 *     can not use directory separator
	 */
	$raindrops_minified_files_css_dir = '';
}
if ( !isset( $raindrops_minified_suffix ) || empty( $raindrops_minified_suffix ) ) {
	/**
	 *  Suffix of minified files
	 *  do not use directory separator
	 */
	$raindrops_minified_suffix = '-min';
}

/**
 * Show category,tag description
 * @since 1.410
 */
if ( !isset( $raindrops_use_term_description ) ) {
	$raindrops_use_term_description = true;
}
/**
 * Tooltip Script
 */
if ( !isset( $raindrops_tooltip ) ) {
	$raindrops_tooltip = true;
}
/**
 * tagcloud widget presentation
 *  @see raindrops_color_pallet_tagcloud()
 *  value false then WordPress default widget style.
 */
if ( !isset( $raindrops_tag_cloud_widget_presentation ) ) {

	$raindrops_tag_cloud_widget_presentation = true;
}
/**
 * Tag shows or not by tagcloud item count ,Applied CSS
 */
if ( !isset( $raindrops_tag_cloud_widget_threshold_val ) ) {

	$raindrops_tag_cloud_widget_threshold_val = 0;
}
/**
 * category widget presentation
 *  @see raindrops_color_pallet_category()
 *  value false then WordPress default widget style.
 * @since 1.415
 */
if ( !isset( $raindrops_category_widget_presentation ) ) {

	$raindrops_category_widget_presentation = true;
}
/**
 * Tag shows or not by tagcloud item count ,Applied CSS
 * since 1.415
 */
if ( !isset( $raindrops_category_widget_threshold_val ) ) {

	$raindrops_category_widget_threshold_val = 0;
}

/**
 * fallback image for attachment , gallery
 * @since 1.328
 */
if ( !isset( $raindrops_fallback_image_for_entry_content_enable ) ) {

	$raindrops_fallback_image_for_entry_content_enable = true;
}
/**
 * Show Content Share Link
 * @since 1.315
 */
do_action( 'raindrops_var_before' );

if ( !isset( $raindrops_header_image_default_ratio ) ) {

	$raindrops_header_image_default_ratio = 0.303125;
}
if ( !isset( $raindrops_allow_share_link ) ) {

	$raindrops_allow_share_link = true;
}
/**
 * Eye Candy Image for Content Share Link
 * @since 1.315
 */
if ( !isset( $raindrops_share_link_image ) ) {

	$raindrops_share_link_image = 'post_thumbnail';
}
/**
 * emoji icon
 * must needs Hexadecimal HTML Entity
 */
if ( !isset( $raindrops_category_emoji ) ) {

	$raindrops_category_emoji = '&#x1f4c2;';
}
if ( !isset( $raindrops_tag_emoji ) ) {

	$raindrops_tag_emoji = '&#x1f4ce;';
}
if ( !isset( $raindrops_posted_on_date_emoji ) ) {

	$raindrops_posted_on_date_emoji = '&#x1f4c5;';
}
/**
 * Add avatar at Recent Comments
 * value true or false , default true
 */
if ( !isset( $raindrops_recent_comments_avatar ) ) {

	$raindrops_recent_comments_avatar = true;
}

/**
 * for highly customize
 * @since 1.307
 * value true or false , default false
 */
if ( !isset( $raindrops_automatic_color ) ) {

	if ( 'automatic' == raindrops_warehouse_clone( 'raindrops_color_select' ) ) {
		$raindrops_automatic_color = true;
	} else {
		$raindrops_automatic_color = false;
	}
}
if ( false !== raindrops_has_indivisual_notation() ) {

	$raindrops_automatic_color = true;
}
/**
 * @since 1.293
 * value 'yes' or 'no'
 */
if ( !isset( $raindrops_customizer_admin_color ) ) {
	$raindrops_customizer_admin_color = 'yes';
}
/**
 * Current version of WordPress
 *
 *
 * $raindrops_current_data_theme_uri
 * $raindrops_current_data_author_uri
 * @since 0.965
 */
$raindrops_check_wp_version				 = explode( '-', $wp_version );
$raindrops_wp_version					 = $raindrops_check_wp_version[ 0 ];
/* @since 1.103 */
$raindrops_current_data					 = wp_get_theme();
$raindrops_current_data_theme_uri		 = apply_filters( 'raindrops_theme_url', $raindrops_current_data->get( 'ThemeURI' ) );
$raindrops_current_data_author_uri		 = apply_filters( 'raindrops_author_url', $raindrops_current_data->get( 'AuthorURI' ) );
$raindrops_current_data_version			 = $raindrops_current_data->get( 'Version' );

if ( is_child_theme() ) {
	/* for cache remove correctly */
	$raindrops_this_parent_theme = wp_get_theme( get_template() );
	$raindrops_current_data_version		 = $raindrops_this_parent_theme->get( 'Version' ). '-'. $raindrops_current_data_version;
}
$raindrops_current_theme_name			 = $raindrops_current_data->get( 'Name' );
$raindrops_current_theme_slug			 = str_replace( ' ', '-', $raindrops_current_theme_name );
$raindrops_current_theme_slug			 = sanitize_html_class( $raindrops_current_theme_slug );
$raindrops_description_for_translation	 = __( 'This theme can change freely fonts,layout,color scheme and header image for each post,page. The google fonts, you can use freely in the post more than 90percent of the fonts.Color scheme and layout, you can freely change from theme customizer.For more updates, please make sure to open the link of the changelog from the help tab of this theme page.Add new post, so also to help tab of edit post page has been described how to use tips, please visit. Supported languages Japanese - JAPAN (ja) French - FRANCE (fr_FR) Polish - POLAND (PL) (pl_PL) Portuguese - BRAZIL (pt_BR)', 'raindrops' );
$raindrops_text_domain					 = $raindrops_current_data->get( 'TextDomain' );

/**
 * Show or Hide Radindrops customize settings
 * value true or false default true;
 */
if ( !isset( $raindrops_extend_customizer ) ) {

	$raindrops_extend_customizer = true;
}
/**
 * Setting of theme settings data store
 * value theme_mod or option default option
 */
if ( !isset( $raindrops_setting_type ) ) {

	$raindrops_setting_type = apply_filters( 'raindrops_theme_data_store', 'option' );
}

/** DON'T CHANGE NOW TEST
 * Customizer Option Field Name
 */
if ( !defined( 'THEME_OPTION_FIELD_NAME' ) ) {

	define( 'THEME_OPTION_FIELD_NAME', 'raindrops_theme_settings' );
}
/**
 * Customizer Capability
 */
if ( !isset( $raindrops_customize_cap ) ) {

	$raindrops_customize_cap = 'edit_theme_options';
}
/**
 * $content_width keep When pege 1 column
 * @since 1.272
 * value true or false
 */
if ( !isset( $raindrops_keep_content_width ) ) {

	$raindrops_keep_content_width = apply_filters( 'raindrops_keep_content_width', true );
}
/**
 * Use transient or not
 * value true or false
 */
if ( !isset( $raindrops_use_transient ) ) {


	/* change value to false @1.518 front end style issue */
	$raindrops_use_transient = false;

	if ( WP_DEBUG == true ) {
		$raindrops_use_transient = false;
	}
}
/**
 * Raindrops Gallery Presentation
 * value false shows WordPress Standard Gallery Style.
 * @since 1.269
 */

if ( !isset( $raindrops_extend_galleries ) ) {

	$raindrops_extend_galleries = true;
}
if( 'xhtml' == raindrops_warehouse_clone('raindrops_doc_type_settings')){
	/* @1.506 */
	$raindrops_extend_galleries = false;	
}

if ( !defined( 'RAINDROPS_USE_AUTO_COLOR' ) ) {

	define( 'RAINDROPS_USE_AUTO_COLOR', true );
}

/**
 * Add to style for each post, page
 *
 * need role edit page.
 * @since 1.201
 */
if ( !defined( 'RAINDROPS_CUSTOM_FIELD_CSS' ) ) {

	define( 'RAINDROPS_CUSTOM_FIELD_CSS', true );
}
/**
 * Add to script or metatag singlure page from custom field
 *
 *
 * javascript custom field key name: javascript
 * metatag name : meta
 * need role edit page.
 * @since 1.201
 */
if ( !defined( 'RAINDROPS_CUSTOM_FIELD_META' ) ) {

	define( 'RAINDROPS_CUSTOM_FIELD_META', true );
}

if ( !defined( 'RAINDROPS_CUSTOM_FIELD_SCRIPT' ) ) {

	define( 'RAINDROPS_CUSTOM_FIELD_SCRIPT', false );
}
/**
 *
 * Add <wbr> element for entry title.
 *
 * uses true no use false
 * @since 1.228
 */
if ( !isset( $raindrops_use_wbr_for_title ) ) {

	$raindrops_use_wbr_for_title = false;
}
/**
 *
 * @since 1.239
 */
if ( !isset( $raindrops_css_auto_include ) ) {

	$raindrops_css_auto_include = true;
}
/**
 * Include the TGM_Plugin_Activation class.
 *
 * @since 1.248
 */
if ( !isset( $raindrops_recommend_plugins ) ) {

	$raindrops_recommend_plugins = true;
}
/**
 * Functionality limited. Now testing
 * Current TGM Not works at multisite
 * @since 1.250
 */
if ( is_multisite() ) {

	$raindrops_recommend_plugins = false;
}
/**
 * Enabling accessibility links when Setting value no at Raindrops options page Accessibility Settings
 *
 *
 * @since1.217
 */
if ( !isset( $raindrops_accessibility_link ) ) {

	$raindrops_accessibility_link = true;
}
/**
 * browser detection
 * use server side browser detection or javascript browser ditection
 *
 * javascript browser ditection is At a target [ operate / even when cash plug-in is used / properly ]
 * value bool
 * $raindrops_browser_detection
 * ver 1.121
 */
if ( !isset( $raindrops_browser_detection ) ) {

	$raindrops_browser_detection = false;
}
/**
 * 750px,950px centered layout fluid or fixed page width switch
 *
 * Empty value makes like a Elastic layout
 *
 * value 'fixed' or empty
 *
 */
if ( !isset( $raindrops_fluid_or_fixed ) ) {

	$raindrops_fluid_or_fixed = 'fixed';
}
/**
 * fluid page  main column minimum width px
 *
 *
 *
 * $raindrops_fluid_minimum_width
 *
 */
if ( !isset( $raindrops_fluid_minimum_width ) ) {
	/* @1.337 from 320 to 296 */
	$raindrops_fluid_minimum_width = '296';
}
/**
 * Special simple view for mobile and small width browser
 * If it sets to true, a display simple compulsory always will be performed.
 *
 * default false
 * $raindrops_fallback_human_interface_show
 *
 */
if ( !isset( $raindrops_fallback_human_interface_show ) ) {

	$raindrops_fallback_human_interface_show = false;
}

/**
 * No support IE8
 * Showing fallback style.
 * @since 1.410
 */
$raindrops_lt_ie9_shows_simple_mode = apply_filters( 'raindrops_lt_ie9_shows_simple_mode', true );

if ( true == $raindrops_lt_ie9_shows_simple_mode ) {

	$http_user_agent = filter_input( INPUT_ENV, 'HTTP_USER_AGENT' );

	if ( preg_match( "|(MSIE )([0-9]{1,2})(\.)|si", $http_user_agent, $regs ) && isset( $regs[ 2 ] ) && absint( $regs[ 2 ] ) < 9 ) {

		$raindrops_fallback_human_interface_show = true;
	}
}


/**
 * Raindrops header and footer image upload
 *
 * $raindrops_max_width
 * $raindrops_max_upload_size
 * $raindrops_allow_file_type
 *
 */
// Allow image type Raindrops footer and header.

if ( !isset( $raindrops_allow_file_type ) ) {

	$raindrops_allow_file_type = array( 'image/png', 'image/jpeg', 'image/jpg', 'image/gif' );
}
//max upload size byte

if ( !isset( $raindrops_max_upload_size ) ) {

	$raindrops_max_upload_size = 2000000;
}
//header or footer image max width px

if ( !isset( $raindrops_max_width ) ) {

	$raindrops_max_width = 1300;
}
/**
 * Custom fields name css is add to post style rules.
 *
 * When false add to style single post and pages
 * When true add to style all list style posts and pages
 * RAINDROPS_OVERRIDE_POST_STYLE_ALL_CONTENTS
 * @since 0.992
 */
if ( !defined( 'RAINDROPS_OVERRIDE_POST_STYLE_ALL_CONTENTS' ) ) {

	define( "RAINDROPS_OVERRIDE_POST_STYLE_ALL_CONTENTS", true );
}
/**
 *
 *
 *
 * RAINDROPS_SHOW_DELETE_POST_LINK
 *
 */
if ( !defined( 'RAINDROPS_SHOW_DELETE_POST_LINK' ) ) {

	define( "RAINDROPS_SHOW_DELETE_POST_LINK", false );
}
/**
 * the_content(   ) or the_excerpt
 *
 * the_excerpt use where index,archive,other not single pages.
 * If RAINDROPS_USE_LIST_EXCERPT value false and use the_content .
 *
 * RAINDROPS_USE_LIST_EXCERPT
 * add ver 1.127
 * When use excerpt please set $raindrops_where_excerpts
 */
if ( !defined( 'RAINDROPS_USE_LIST_EXCERPT' ) ) {

	define( "RAINDROPS_USE_LIST_EXCERPT", true );
}

// values 'is_search', 'is_archive', 'is_category' ,'is_tax', 'is_tag' any conditional function name
/**
 * Auto Color On or Off
 * If you want no Auto Color when set value false.
 *
 *
 * RAINDROPS_USE_AUTO_COLOR
 *
 */
if ( !defined( 'RAINDROPS_USE_AUTO_COLOR' ) ) {

	define( "RAINDROPS_USE_AUTO_COLOR", true );
}
/**
 * single-post-thumbnail
 *
 *
 * RAINDROPS_SINGLE_POST_THUMBNAIL_WIDTH
 * RAINDROPS_SINGLE_POST_THUMBNAIL_HEIGHT
 *
 */
if ( !isset( $raindrops_featured_image_full_size ) ) {

	$raindrops_featured_image_full_size = false;
}

if ( !defined( 'RAINDROPS_SINGLE_POST_THUMBNAIL_WIDTH' ) ) {

	define( 'RAINDROPS_SINGLE_POST_THUMBNAIL_WIDTH', 600 );
}

if ( !defined( 'RAINDROPS_SINGLE_POST_THUMBNAIL_HEIGHT' ) ) {

	define( 'RAINDROPS_SINGLE_POST_THUMBNAIL_HEIGHT', 200 );
}
add_image_size( 'single-post-thumbnail', RAINDROPS_SINGLE_POST_THUMBNAIL_WIDTH, RAINDROPS_SINGLE_POST_THUMBNAIL_HEIGHT, true );

/**
 *
 *
 * Change const RAINDROPS_USE_FEATURED_IMAGE_LIGHT_BOX to var $raindrops_use_featured_image_light_box
 * @since 1.289
 */
if ( !isset( $raindrops_use_featured_image_light_box ) ) {

	$raindrops_use_featured_image_light_box = false;
}
/**
 * Original page width implementation by manual labor
 *
 * If you need original page width
 * you can specific pixel page width
 * e.g. '$raindrops_page_width = '776';' is  776px page width.
 *
 *
 */
if ( !isset( $raindrops_page_width ) ) {

	$raindrops_page_width = '';
}

/**
 * Default Setting vars
 */
if ( !isset( $raindrops_base_setting_args ) ) {

	$raindrops_current_style_type	 = raindrops_warehouse_clone( 'raindrops_style_type' );
	$raindrops_style_types			 = raindrops_register_styles();
	/**
	 * @since 1.426
	 * When color type not exists then reset settings
	 */
	if ( !is_child_theme() &&
	(!empty( $raindrops_current_style_type ) && !array_key_exists( $raindrops_current_style_type, $raindrops_style_types ) ||
	empty( $raindrops_current_style_type ) ) ) {
		//@1.433 todo
		$raindrops_current_style_type = 'dark';
	}

	$raindrops_base_setting_args = array(
		"raindrops_color_scheme"				 => array( 'option_id'		 => 1,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_color_scheme",
			'option_value'	 => "raindrops_color_ja",
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Color Scheme', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Please choose the naming convention for the color list', 'raindrops' ),
			'validate'		 => 'raindrops_color_scheme_validate', 'list'			 => 12 ),
		"raindrops_base_color"					 => array( 'option_id'		 => 2,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_base_color",
			'option_value'	 => "#444444",
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Base Color for Automatic Color Arrangement', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Please specify your favorite color. and an automatic arrangement of color is designed.', 'raindrops' ),
			'validate'		 => 'raindrops_base_color_validate',
			'list'			 => 1 ),
		"raindrops_style_type"					 => array( 'option_id'		 => 3,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_style_type",
			'option_value'	 => "dark",
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Color Type', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'The mood like dark atmosphere and the bright note, etc. is decided. and The editor is displayed when themename is selected, and a present style can be edited in detail.', 'raindrops' ),
			'validate'		 => 'raindrops_style_type_validate',
			'list'			 => 2,
		),
		"raindrops_header_image"				 => array( 'option_id'		 => 4,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_header_image",
			'option_value'	 => "none",
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Header background image', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'The header image can be set by two methods.
One is a method of up-loading the image from the below up-loading form. Another is a method of filling in the filename from this textfield from Raindrops/images something image.', 'raindrops' ),
			'validate'		 => 'raindrops_header_image_validate',
			'list'			 => 3,
		),
		"raindrops_footer_image"				 => array( 'option_id'		 => 5,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_footer_image",
			'option_value'	 => "none",
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Footer background image', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'The footer image can be set by two methods.
One is a method of up-loading the image from the below up-loading form. Another is a method of filling in the filename from this textfield from Raindrops/images something image.', 'raindrops' ),
			'validate'		 => 'raindrops_footer_image_validate', 'list'			 => 4 ),
		"raindrops_heading_image"				 => array( 'option_id'		 => 6,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_heading_image",
			'option_value'	 => "none",
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Widget Title Background Image', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'The header image can be chosen from among three kinds [h2.png,h2b.png,h2c.png].', 'raindrops' ),
			'validate'		 => 'raindrops_heading_image_validate', 'list'			 => 5 ),
		"raindrops_heading_image_position"		 => array( 'option_id'		 => 7,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_heading_image_position",
			'option_value'	 => "0",
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Widget Title Background Image Position', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'The name of the picture file used for the h2 headding is set. Please set the integral value from 0 to 7. ', 'raindrops' ),
			'validate'		 => 'raindrops_heading_image_position_validate', 'list'			 => 6 ),
		"raindrops_page_width"					 => array( 'option_id'		 => 8,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_page_width",
			'option_value'	 => "doc3",
			'autoload'		 => 'yes',
			'title'			 => __( 'Document Width', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Please choose width on the page.', 'raindrops' ) .
			esc_html__( 'Please choose from four kinds of inside of', 'raindrops' ) .
			esc_html__( '750px centerd 950px centerd fluid 974px.', 'raindrops' ),
			'validate'		 => 'raindrops_page_width_validate', 'list'			 => 7 ),
		"raindrops_col_width"					 => array( 'option_id'		 => 9,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_col_width",
			'option_value'	 => raindrops_switch_default_by_color_type_clone( $raindrops_current_style_type, "raindrops_col_width", "t2", "t6" ),
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Column Width and Position', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Please specify the position and the width of Default Sidebar. Six kinds of sidebars of left 160px left 180px left 300px right 180px right 240px right 300px can be specified.', 'raindrops' ),
			'validate'		 => 'raindrops_col_width_validate', 'list'			 => 8 ),
		"raindrops_default_fonts_color"			 => array( 'option_id'		 => 10,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_default_fonts_color",
			'option_value'	 => raindrops_default_colors_clone( $raindrops_current_style_type, "raindrops_default_fonts_color", true ),
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Text color in content ', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'If you need to set contents Special font color.', 'raindrops' ),
			'validate'		 => 'raindrops_default_fonts_color_validate', 'list'			 => 9 ),
		"raindrops_footer_color"				 => array( 'option_id'		 => 11,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_footer_color",
			'option_value'	 => raindrops_default_colors_clone( $raindrops_current_style_type, "raindrops_footer_color", true ),
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Text color in footer ', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'If you need to set footer Special font color.', 'raindrops' ),
			'validate'		 => 'raindrops_footer_color_validate', 'list'			 => 10 ),
		"raindrops_show_right_sidebar"			 => array( 'option_id'		 => 12,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_show_right_sidebar",
			'option_value'	 => raindrops_switch_default_by_color_type_clone( $raindrops_current_style_type, "raindrops_show_right_sidebar", "show", "hide" ),
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Extra Sidebar', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Please specify show when you want to use three row layout. Please set Ratio to text when extra sidebar is displayed when you specify show', 'raindrops' ),
			'validate'		 => 'raindrops_show_right_sidebar_validate', 'list'			 => 11 ),
		"raindrops_right_sidebar_width_percent"	 => array( 'option_id'		 => 13,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_right_sidebar_width_percent",
			'option_value'	 => "25",
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Extra Sidebar Width', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'When display extra sidebar is set to show', 'raindrops' ) .
			esc_html__( 'it is necessary to specify it.', 'raindrops' ) .
			esc_html__( 'It can decide to divide the width of which place of extra sidebar', 'raindrops' ) .
			esc_html__( 'and to give it. Please select it from among 25% 33% 50% 66% 75%. ', 'raindrops' ),
			'validate'		 => 'raindrops_right_sidebar_width_percent_validate', 'list'			 => 12 ),
		"raindrops_show_menu_primary"			 => array( 'option_id'		 => 14,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_show_menu_primary",
			'option_value'	 => "show",
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Enable Menu Primary', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Display or not Menu Primary. default value is show. set hide when not display menu primary', 'raindrops' ),
			'validate'		 => 'raindrops_show_menu_primary_validate', 'list'			 => 13 ),
		"raindrops_hyperlink_color"				 => array( 'option_id'		 => 15,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_hyperlink_color",
			'option_value'	 => raindrops_default_colors_clone( $raindrops_current_style_type, "raindrops_hyperlink_color", true ),
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Link color', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Hyper link color', 'raindrops' ),
			'validate'		 => 'raindrops_hyperlink_color_validate', 'list'			 => 14 ),
		"raindrops_accessibility_settings"		 => array( 'option_id'		 => 16,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_accessibility_settings",
			'option_value'	 => "no",
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Force Unique Link Text', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Accessibility Settings is create a unique link text. set to yes or no.', 'raindrops' ),
			'validate'		 => 'raindrops_accessibility_settings_validate',
			'list'			 => 15
		),
		"raindrops_doc_type_settings"			 => array( 'option_id'		 => 17,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_doc_type_settings",
			'option_value'	 => "html5",
			'autoload'		 => 'yes',
			'title'			 => esc_html__( "Document Type Definition", 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( "Default Document type html5. Set to xhtml or html5.", 'raindrops' ),
			'validate'		 => 'raindrops_doc_type_settings_validate',
			'list'			 => 16
		),
		"raindrops_basefont_settings"			 => array( 'option_id'		 => 18,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_basefont_settings",
			'option_value'	 => "13",
			'autoload'		 => 'yes',
			'title'			 => esc_html__( "Base Font Size", 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( "Base Font Size Value Recommend 13-20 (px size)", 'raindrops' ),
			'validate'		 => 'raindrops_basefont_settings_validate',
			'list'			 => 17
		),
		"raindrops_fluid_max_width"				 => array( 'option_id'		 => 19,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_fluid_max_width",
			'option_value'	 => "1280",
			'autoload'		 => 'yes',
			'title'			 => esc_html__( "Fluid ( Responsive ) Max Page Width", 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( "Default 1280 (px size)", 'raindrops' ),
			'validate'		 => 'raindrops_fluid_max_width_validate',
			'list'			 => 18
		),
		"raindrops_entry_content_is_home"		 => array( 'option_id'		 => 20,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_entry_content_is_home",
			'option_value'	 => "content",
			'autoload'		 => 'yes',
			'title'			 => esc_html__( "Home Listed Entry Contents", 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( "value content, excerpt, excerpt_grid, none", 'raindrops' ),
			'validate'		 => 'raindrops_entry_content_is_home_validate',
			'list'			 => 19
		),
		"raindrops_entry_content_is_category"	 => array( 'option_id'		 => 21,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_entry_content_is_category",
			'option_value'	 => "content",
			'autoload'		 => 'yes',
			'title'			 => esc_html__( "Category Archives Entry Contents", 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( "value content, excerpt, excerpt_grid, none", 'raindrops' ),
			'validate'		 => 'raindrops_entry_content_is_category_validate',
			'list'			 => 20
		),
		"raindrops_entry_content_is_search"					 => array( 'option_id'		 => 22,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_entry_content_is_search",
			'option_value'	 => "content",
			'autoload'		 => 'yes',
			'title'			 => esc_html__( "Search Result Entry Contents", 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( "value content, excerpt, excerpt_grid, none", 'raindrops' ),
			'validate'		 => 'raindrops_entry_content_is_tag_validate',
			'list'			 => 21
		),
		"raindrops_footer_link_color"						 => array( 'option_id'		 => 23,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_footer_link_color",
			'option_value'	 => raindrops_default_colors_clone( $raindrops_current_style_type, "raindrops_footer_link_color", true ),
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Link color in footer ', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'If you need to set footer Special link color.hex color ex.#ff0000 or empty string', 'raindrops' ),
			'validate'		 => 'raindrops_footer_link_color_validate',
			'list'			 => 22
		),
		"raindrops_complementary_color_for_title_link"		 => array( 'option_id'		 => 24,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_complementary_color_for_title_link",
			'option_value'	 => "none",
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Complementary Link Color For Entry Title', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'If you need to set complementary color for entry title.(There is a need to link color is set to chromatic) value yes or none', 'raindrops' ),
			'validate'		 => 'raindrops_complementary_color_for_title_link_validate',
			'list'			 => 23
		),
		"raindrops_plugin_presentation_bcn_nav_menu"		 => array( 'option_id'		 => 25,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_plugin_presentation_bcn_nav_menu",
			'option_value'	 => "none",
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Breadcrumbs NavXT Automatic Presentation ', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Theme, will make a presentation of applying the plugin automatically, value set yes or none', 'raindrops' ),
			'validate'		 => 'raindrops_plugin_presentation_bcn_nav_menu_validate',
			'list'			 => 24
		),
		"raindrops_plugin_presentation_wp_pagenav"			 => array( 'option_id'		 => 26,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_plugin_presentation_wp_pagenav",
			'option_value'	 => "none",
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Custom Page Navigation WP-PageNavi', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Theme, will make a presentation of applying the plugin automatically, value set yes or none', 'raindrops' ),
			'validate'		 => 'raindrops_plugin_presentation_wp_pagenav_validate',
			'list'			 => 25
		),
		"raindrops_plugin_presentation_meta_slider"			 => array( 'option_id'		 => 27,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_plugin_presentation_meta_slider",
			'option_value'	 => "none",
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Slider for HomePage Meta Slider', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Please Set Meta Slider ID or none', 'raindrops' ),
			'validate'		 => 'raindrops_plugin_presentation_wp_pagenav_validate',
			'list'			 => 26
		),
		"raindrops_plugin_presentation_the_events_calendar"	 => array( 'option_id'		 => 28,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_plugin_presentation_the_events_calendar",
			'option_value'	 => "none",
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'The Events Calendar Automatic Presentation ', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Theme, will make a presentation of applying the plugin automatically, value set yes or none', 'raindrops' ),
			'validate'		 => 'raindrops_plugin_presentation_the_events_calendarr_validate',
			'list'			 => 27
		),
		"raindrops_disable_keyboard_focus"					 => array( 'option_id'		 => 29,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_disable_keyboard_focus",
			'option_value'	 => "enable",
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Disable Keyboard Focus ', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Fallback Setting when Nav Menu displayed improperly, value set enable( defalt ) or disable', 'raindrops' ),
			'validate'		 => 'raindrops_disable_keyboard_focus_validate',
			'list'			 => 28
		),
		"raindrops_sync_style_for_tinymce"					 => array( 'option_id'		 => 30,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_sync_style_for_tinymce",
			'option_value'	 => "yes",
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Synchronize Style for Visual Editor', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Reflect on Dynamically Editor Style Settings, value set yes ( default ) or none', 'raindrops' ),
			'validate'		 => 'raindrops_sync_style_for_tinymce_validate',
			'list'			 => 29
		),
		"raindrops_uninstall_option"						 => array( 'option_id'		 => 31,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_uninstall_option",
			'option_value'	 => "keep",
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Uninstall Option', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Delete all Theme Settings when switch theme. default keep ( or delete )', 'raindrops' ),
			'validate'		 => 'raindrops_uninstall_option_validate',
			'list'			 => 30
		),
		"raindrops_menu_primary_font_size"					 => array( 'option_id'		 => 32,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_menu_primary_font_size",
			'option_value'	 => 100,
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Menu Primary Font Size', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Menu Primary Font Size. default value is 100( % ). set font size between 77 and 182', 'raindrops' ),
			'validate'		 => 'raindrops_menu_primary_font_size_validate',
			'list'			 => 31 ),
		"raindrops_menu_primary_min_width"					 => array( 'option_id'		 => 33,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_menu_primary_min_width",
			'option_value'	 => 10,
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Menu Primary Min Width', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Menu Primary Menu Width. default value is 10 ( em ). set 1 between 95.999', 'raindrops' ),
			'validate'		 => 'raindrops_menu_primary_min_width_validate',
			'list'			 => 32 ),
		"raindrops_featured_image_position"					 => array( 'option_id'		 => 34,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_featured_image_position",
			'option_value'	 => 'left',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Featured Image Position', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Featured Image Position for Emphasis of new content using the Featured Image values default,left,front', 'raindrops' ),
			'validate'		 => 'raindrops_featured_image_position_validate',
			'list'			 => 33 ),
		"raindrops_featured_image_size"						 => array( 'option_id'		 => 35,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_featured_image_size",
			'option_value'	 => 'thumbnail',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Featured Image Size', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'values thumbnail, medium, large, default', 'raindrops' ),
			'validate'		 => 'raindrops_featured_image_size_validate',
			'list'			 => 34 ),
		"raindrops_featured_image_recent_post_count"		 => array( 'option_id'		 => 36,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_featured_image_recent_post_count",
			'option_value'	 => get_option( 'posts_per_page' ),
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Featured Image Special Layout Apply Post Count', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'values from 1 to Post Per Page count default value none', 'raindrops' ),
			'validate'		 => 'raindrops_featured_image_recent_post_count_validate',
			'list'			 => 35 ),
		"raindrops_featured_image_singular"					 => array( 'option_id'		 => 37,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_featured_image_singular",
			'option_value'	 => 'hide',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Singular ( post, page ) Show Featured Image', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'values show or hide or lightbox ( light box is crop height ,add lightbox )', 'raindrops' ),
			'validate'		 => 'raindrops_featured_image_singular_validate',
			'list'			 => 36 ),
		"raindrops_use_featured_image_emphasis"				 => array( 'option_id'		 => 38,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_use_featured_image_emphasis",
			'option_value'	 => 'no',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'USE or Not Emphasis of new content using the Featured Image', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'values yes or no default no', 'raindrops' ),
			'validate'		 => 'raindrops_use_featured_image_emphasis_validate',
			'list'			 => 37 ),
		"raindrops_japanese_date"							 => array( 'option_id'		 => 39,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_japanese_date",
			'option_value'	 => 'no',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'USE or Not Japanese Date', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'values yes or no default no', 'raindrops' ),
			'validate'		 => 'raindrops_japanese_date_validate',
			'list'			 => 38 ),
		"raindrops_read_more_after_excerpt"					 => array( 'option_id'		 => 40,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_read_more_after_excerpt",
			'option_value'	 => 'no',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Add More Link After Excerpt', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Add read more link after excerpt. values yes or no default no', 'raindrops' ),
			'validate'		 => 'raindrops_read_more_after_excerpt_validate',
			'list'			 => 39 ),
		"raindrops_excerpt_enable"							 => array( 'option_id'		 => 41,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_excerpt_enable",
			'option_value'	 => 'no',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Excerpt Type', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'HTML in Excerpt. values yes or no default no', 'raindrops' ),
			'validate'		 => 'raindrops_excerpt_enable_validate',
			'list'			 => 40 ),
		"raindrops_allow_oembed_excerpt_view"				 => array( 'option_id'		 => 42,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_allow_oembed_excerpt_view",
			'option_value'	 => 'yes',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Allow Oembed in HTML Excerpt', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Overview display, if you set no, you can reduce the load time of the page. values yes or no default yes', 'raindrops' ),
			'validate'		 => 'raindrops_allow_oembed_excerpt_view_validate',
			'list'			 => 41 ),
		"raindrops_place_of_site_title"						 => array( 'option_id'		 => 43,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_place_of_site_title",
			'option_value'	 => 'above',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Place of Title', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'value header_image, above. default above ', 'raindrops' ),
			'validate'		 => 'raindrops_place_of_site_title_validate',
			'list'			 => 42 ),
		"raindrops_site_title_left_margin"					 => array( 'option_id'		 => 44,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_site_title_left_margin",
			'option_value'	 => 1,
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Left Margin of Site Title', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Works only Place of Title value set header_image, default value  1', 'raindrops' ),
			'validate'		 => 'raindrops_site_title_left_margin_validate',
			'list'			 => 43 ),
		"raindrops_site_title_top_margin"					 => array( 'option_id'		 => 45,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_site_title_top_margin",
			'option_value'	 => 1,
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Top Margin in the header image', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Works only Place of Title value set header_image, default value  1', 'raindrops' ),
			'validate'		 => 'raindrops_site_title_top_margin_validate',
			'list'			 => 44 ),
		"raindrops_site_title_font_size"					 => array( 'option_id'		 => 46,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_site_title_font_size",
			'option_value'	 => 'none',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Font Size of Site Title', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'default value none, or 1-10( percent of viewport width )', 'raindrops' ),
			'validate'		 => 'raindrops_site_title_font_size_validate',
			'list'			 => 45 ),
		"raindrops_site_title_css_class"					 => array( 'option_id'		 => 47,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_site_title_css_class",
			'option_value'	 => 'none',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'CSS Class of Site Title', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'for example google-font-lobster default value none', 'raindrops' ),
			'validate'		 => 'raindrops_site_title_css_class_validate',
			'list'			 => 46 ),
		"raindrops_tagline_in_the_header_image"				 => array( 'option_id'		 => 47,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_tagline_in_the_header_image",
			'option_value'	 => 'show',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Place of the Tagline', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'tagline show or hide', 'raindrops' ),
			'validate'		 => 'raindrops_tagline_in_the_header_image_validate',
			'list'			 => 46 ),
		"raindrops_col_setting_type"						 => array( 'option_id'		 => 48,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_col_setting_type",
			'option_value'	 => 'simple',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Side bar setting method', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'value details or simple. default simple', 'raindrops' ),
			'validate'		 => 'raindrops_col_setting_type_validate',
			'list'			 => 47 ),
		"raindrops_sidebar_index"							 => array( 'option_id'		 => 49,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_sidebar_index",
			'option_value'	 => '3',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Index Page, Static Front Page columns', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'value 1-3. default 3', 'raindrops' ),
			'validate'		 => 'raindrops_sidebar_index_validate',
			'list'			 => 48 ),
		"raindrops_sidebar_date"							 => array( 'option_id'		 => 51,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_sidebar_date",
			'option_value'	 => '3',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Date Archive columns', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'value 1-3. default 3', 'raindrops' ),
			'validate'		 => 'raindrops_sidebar_date_validate',
			'list'			 => 50 ),
		"raindrops_sidebar_page"							 => array( 'option_id'		 => 52,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_sidebar_page",
			'option_value'	 => '3',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Static Page columns', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'value 1-3. default 3', 'raindrops' ),
			'validate'		 => 'raindrops_sidebar_page_validate',
			'list'			 => 51 ),
		"raindrops_sidebar_single"							 => array( 'option_id'		 => 53,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_sidebar_single",
			'option_value'	 => '3',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Single Post columns', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'value 1-3. default 3', 'raindrops' ),
			'validate'		 => 'raindrops_sidebar_single_validate',
			'list'			 => 52 ),
		"raindrops_sidebar_search"							 => array( 'option_id'		 => 54,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_sidebar_search",
			'option_value'	 => '3',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Search Result Page columns', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'value 1-3. default 3', 'raindrops' ),
			'validate'		 => 'raindrops_sidebar_search_validate',
			'list'			 => 53 ),
		"raindrops_sidebar_404"								 => array( 'option_id'		 => 55,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_sidebar_404",
			'option_value'	 => '3',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( '404 Page columns', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'value 1-3. default 3', 'raindrops' ),
			'validate'		 => 'raindrops_sidebar_404_validate',
			'list'			 => 54 ),
		"raindrops_sidebar_list_of_post"					 => array( 'option_id'		 => 56,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_sidebar_list_of_post",
			'option_value'	 => '3',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'List of Post Template columns', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'value 1-3. default 3', 'raindrops' ),
			'validate'		 => 'raindrops_sidebar_list_of_post_validate',
			'list'			 => 55 ),
		"raindrops_full_width_max_width"					 => array( 'option_id'		 => 57,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_full_width_max_width",
			'option_value'	 => 1280,
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Content Container Width', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'px value, default 1280', 'raindrops' ),
			'validate'		 => 'raindrops_full_width_max_width_validate',
			'list'			 => 56 ),
		"raindrops_full_width_limit_window_width"			 => array( 'option_id'		 => 58,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_full_width_limit_window_width",
			'option_value'	 => 1920,
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Support limit Browser Width', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'In the case of specified size abnormalities of the browser window size, it will show in the box layout. set px value, default 1920', 'raindrops' ),
			'validate'		 => 'raindrops_full_width_limit_window_width_validate',
			'list'			 => 57 ),
		"raindrops_sidebar_category"						 => array( 'option_id'		 => 59,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_sidebar_category",
			'option_value'	 => '3',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Category Archive columns', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'value 1-3. default 3', 'raindrops' ),
			'validate'		 => 'raindrops_sidebar_category_validate',
			'list'			 => 58 ),
		"raindrops_sidebar_author"							 => array( 'option_id'		 => 60,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_sidebar_author",
			'option_value'	 => '3',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Category Archive columns', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'value 1-3. default 3', 'raindrops' ),
			'validate'		 => 'raindrops_sidebar_author_validate',
			'list'			 => 59 ),
		"raindrops_xhtml_media_type"						 => array( 'option_id'		 => 61,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_xhtml_media_type",
			'option_value'	 => 'text/html',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'xhtml media type', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'value text/html or application/xhtml+xml, default text/html', 'raindrops' ),
			'validate'		 => 'raindrops_xhtml_media_type_validate',
			'list'			 => 60 ),
		"raindrops_actions_hook_message"					 => array( 'option_id'		 => 62,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_actions_hook_message",
			'option_value'	 => 'hide',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Developer Settings', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'value show or hide, default hide', 'raindrops' ),
			'validate'		 => 'raindrops_actions_hook_message_validate',
			'list'			 => 61 ),
		"raindrops_status_bar"								 => array( 'option_id'		 => 63,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_status_bar",
			'option_value'	 => 'hide',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Status Bar', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'value show or hide, default hide', 'raindrops' ),
			'validate'		 => 'raindrops_status_bar_validate',
			'list'			 => 62 ),
////////////////////////////////////////////////
		"raindrops_article_title_css_class"					 => array( 'option_id'		 => 64,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_article_title_css_class",
			'option_value'	 => ' ',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Entry Title CSS Class', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'default empty', 'raindrops' ),
			'validate'		 => 'raindrops_article_title_css_class_validate',
			'list'			 => 63 ),
		"raindrops_display_article_publish_date"			 => array( 'option_id'		 => 65,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_display_article_publish_date",
			'option_value'	 => 'show',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Display Publish Date', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'default show', 'raindrops' ),
			'validate'		 => 'raindrops_display_article_publish_date_validate',
			'list'			 => 64 ),
		"raindrops_display_article_author"					 => array( 'option_id'		 => 66,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_display_article_author",
			'option_value'	 => 'avatar',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Display Author', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'default avatar', 'raindrops' ),
			'validate'		 => 'raindrops_display_article_author_validate',
			'list'			 => 65 ),
		"raindrops_display_default_category"				 => array( 'option_id'		 => 67,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_display_default_category",
			'option_value'	 => 'show',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Display Default Category', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'default show', 'raindrops' ),
			'validate'		 => 'raindrops_display_default_category_validate',
			'list'			 => 66 ),
		"raindrops_sidebar_image_archive"					 => array( 'option_id'		 => 68,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_sidebar_image_archive",
			'option_value'	 => '3',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Attachment Page Image Columns', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'value 1-3. default 3', 'raindrops' ),
			'validate'		 => 'raindrops_sidebar_image_archive_validate',
			'list'			 => 67 ),
		"raindrops_site_title_left_margin_type"				 => array( 'option_id'		 => 69,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_site_title_left_margin_type",
			'option_value'	 => 'default',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'The choice of left margin how to set', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Works only Place of Title value set header_image, default value  1', 'raindrops' ),
			'validate'		 => 'raindrops_site_title_left_margin_type_validate',
			'list'			 => 68 ),
		"raindrops_sidebar_tag"								 => array( 'option_id'		 => 70,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_sidebar_tag",
			'option_value'	 => '3',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Tag Archive columns', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'value 1-3. default 3', 'raindrops' ),
			'validate'		 => 'raindrops_sidebar_tag_validate',
			'list'			 => 69 ),
		"raindrops_excerpt_length"							 => array( 'option_id'		 => 71,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_excerpt_length",
			'option_value'	 => '200',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Excerpt Length', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( '20-400', 'raindrops' ),
			'validate'		 => 'raindrops_excerpt_length_validate',
			'list'			 => 70 ),
		"raindrops_stylesheet_in_html"						 => array( 'option_id'		 => 72,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_stylesheet_in_html",
			'option_value'	 => 'embed',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Location of the style sheet', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Select link stylesheet to their source HTML or document with the LINK element', 'raindrops' ),
			'validate'		 => 'raindrops_stylesheet_in_html_validate',
			'list'			 => 71 ),
		"raindrops_parent_theme_mods"						 => array( 'option_id'		 => 73,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_parent_theme_mods",
			'option_value'	 => 'no',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Import Raindrops Theme Current Settings', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => '',
			'validate'		 => 'raindrops_parent_theme_mods_validate',
			'list'			 => 72 ),
		"raindrops_header_image_filter_color"				 => array( 'option_id'		 => 74,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_header_image_filter_color",
			'option_value'	 => '',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Header Image Filter Color', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => '',
			'validate'		 => 'raindrops_header_image_filter_color_validate',
			'list'			 => 73 ),
		"raindrops_header_image_filter_apply_top"			 => array( 'option_id'		 => 75,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_header_image_filter_apply_top",
			'option_value'	 => 0,
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Filter Image Top', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => '',
			'validate'		 => 'raindrops_header_image_filter_apply_top_validate',
			'list'			 => 74 ),
		"raindrops_header_image_filter_apply_bottom"		 => array( 'option_id'		 => 76,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_header_image_filter_apply_bottom",
			'option_value'	 => 0,
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Filter Image Bottom', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => '',
			'validate'		 => 'raindrops_header_image_filter_apply_bottom_validate',
			'list'			 => 75 ),
		"raindrops_enable_header_image_filter"				 => array( 'option_id'		 => 77,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_enable_header_image_filter",
			'option_value'	 => 'disable',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Header Image Filter', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => '',
			'validate'		 => 'raindrops_enable_header_image_filter_validate',
			'list'			 => 76 ),
		'raindrops_options_owner'							 => array( 'option_id'		 => 78,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_options_owner',
			'option_value'	 => 'raindrops',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Header Image Filter', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => '',
			'validate'		 => 'raindrops_options_owner_validate',
			'list'			 => 77 ),
		'raindrops_display_sticky_post'						 => array( 'option_id'		 => 79,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_display_sticky_post',
			'option_value'	 => 'anytime',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Sticky Post Show Single Post', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Sticky Post Show only Home Page or Always it displayed ( default Always it displayed )', 'raindrops' ),
			'validate'		 => 'raindrops_display_sticky_post_validate',
			'list'			 => 78 ),
		'raindrops_sitewide_css'							 => array( 'option_id'		 => 80,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_sitewide_css',
			'option_value'	 => '',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Site-wide CSS', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Style  It will be retained even if the theme is updated', 'raindrops' ),
			'validate'		 => 'raindrops_sitewide_css_validate',
			'list'			 => 79 ),
		'raindrops_posted_in_label'							 => array( 'option_id'		 => 81,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_posted_in_label',
			'option_value'	 => 'emoji',
			'autoload'		 => 'show',
			'title'			 => esc_html__( 'Posted in Labels', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Hide Posted in Labels ', 'raindrops' ) . esc_html__( 'This entry was posted in', 'raindrops' ) . esc_html__( 'and tagged', 'raindrops' ),
			'validate'		 => 'raindrops_posted_in_label_validate',
			'list'			 => 80 ),
		'raindrops_comments_are_closed'						 => array( 'option_id'		 => 81,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_comments_are_closed',
			'option_value'	 => 'hide',
			'autoload'		 => 'show',
			'title'			 => esc_html__( 'Comments are closed Label', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Hide ', 'raindrops' ) . esc_html__( 'Comments are closed.', 'raindrops' ),
			'validate'		 => 'raindrops_comments_are_closed_validate',
			'list'			 => 80 ),
		'raindrops_archive_title_label'						 => array( 'option_id'		 => 82,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_archive_title_label',
			'option_value'	 => 'emoji',
			'autoload'		 => 'show',
			'title'			 => esc_html__( 'Archives label', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Hide or Show like Category Archives, Tag Archives label', 'raindrops' ),
			'validate'		 => 'raindrops_archive_title_label_validate',
			'list'			 => 81 ),
		'raindrops_archive_nav_above'						 => array( 'option_id'		 => 83,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_archive_nav_above',
			'option_value'	 => 'hide',
			'autoload'		 => 'show',
			'title'			 => esc_html__( 'Archive Page Top Navigation', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Hide or Show Blog Archives page top navigation', 'raindrops' ),
			'validate'		 => 'raindrops_archive_nav_above_validate',
			'list'			 => 82 ),
		'raindrops_posted_on_position'						 => array( 'option_id'		 => 84,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_posted_on_position',
			'option_value'	 => 'before',
			'autoload'		 => 'show',
			'title'			 => esc_html__( 'Position of Posted on', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'default before contents', 'raindrops' ),
			'validate'		 => 'raindrops_posted_on_position_validate',
			'list'			 => 83 ),
		'raindrops_posted_in_position'						 => array( 'option_id'		 => 85,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_posted_in_position',
			'option_value'	 => 'after',
			'autoload'		 => 'show',
			'title'			 => esc_html__( 'Position of Posted in', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'default after contents', 'raindrops' ),
			'validate'		 => 'raindrops_posted_in_position_validate',
			'list'			 => 84 ),
		'raindrops_fallback_image_for_entry_content'		 => array( 'option_id'		 => 86,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_fallback_image_for_entry_content',
			'option_value'	 => get_template_directory_uri() . '/images/image-not-found.png',
			'autoload'		 => 'show',
			'title'			 => esc_html__( 'Fallback Image for Entry Content', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Image, to display an alternative image if that can not be displayed', 'raindrops' ),
			'validate'		 => 'raindrops_fallback_image_for_entry_content_validate',
			'list'			 => 85 ),
		'raindrops_custom_footer_credit'					 => array( 'option_id'		 => 87,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_custom_footer_credit',
			'option_value'	 => '',
			'autoload'		 => 'show',
			'title'			 => esc_html__( 'Custom Footer Credit', 'raindrops' ),
			'excerpt1'		 => '',
			/* translators: %current_year%: Please not translate */
			'excerpt2'		 => esc_html__( 'Show your custom footer credit when anything input. You can use element address, span, a, br,img, %current_year% (replase current year )', 'raindrops' ),
			'validate'		 => 'raindrops_custom_footer_credit_validate',
			'list'			 => 86 ),
		"raindrops_sidebar_pdf_archive"						 => array( 'option_id'		 => 88,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_sidebar_pdf_archive",
			'option_value'	 => '3',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Attachment Page PDF Columns', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'value 1-3. default 3', 'raindrops' ),
			'validate'		 => 'raindrops_sidebar_pdf_archive_validate',
			'list'			 => 87 ),
		"raindrops_primary_menu_responsive"					 => array( 'option_id'		 => 89,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_primary_menu_responsive",
			'option_value'	 => 'yes',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Primary Menu Automatic Responsive', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'value yes or no. default yes', 'raindrops' ),
			'validate'		 => 'raindrops_primary_menu_responsive_validate',
			'list'			 => 88 ),
		"raindrops_tooltip"									 => array( 'option_id'		 => 90,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_tooltip",
			'option_value'	 => 'yes',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Tooltip', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Enable Tooltip. value yes or no. default yes', 'raindrops' ),
			'validate'		 => 'raindrops_tooltip_validate',
			'list'			 => 89 ),
		"raindrops_display_site_title"						 => array( 'option_id'		 => 91,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_display_site_title",
			'option_value'	 => 'show',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Display Site Title Text', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'value show, hide. default show', 'raindrops' ),
			'validate'		 => 'raindrops_display_site_title_validate',
			'list'			 => 90 ),
		"raindrops_sidebar_format_link_archive"				 => array( 'option_id'		 => 92,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_sidebar_format_link_archive",
			'option_value'	 => '3',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Archives Post Format link Columns', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'value 1-3. default 3', 'raindrops' ),
			'validate'		 => 'raindrops_sidebar_format_link_archive_validate',
			'list'			 => 91 ),
		"raindrops_sidebar_format_image_archive"			 => array( 'option_id'		 => 93,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_sidebar_format_image_archive",
			'option_value'	 => '3',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Archives Post Format Image Columns', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'value 1-3. default 3', 'raindrops' ),
			'validate'		 => 'raindrops_sidebar_format_image_archive_validate',
			'list'			 => 92 ),
		"raindrops_sidebar_format_quote_archive"			 => array( 'option_id'		 => 94,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_sidebar_format_quote_archive",
			'option_value'	 => '3',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Archives Post Format Quote Columns', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'value 1-3. default 3', 'raindrops' ),
			'validate'		 => 'raindrops_sidebar_format_quote_archive_validate',
			'list'			 => 93 ),
		"raindrops_sidebar_format_status_archive"			 => array( 'option_id'		 => 95,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_sidebar_format_status_archive",
			'option_value'	 => '3',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Archives Post Format Status Columns', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'value 1-3. default 3', 'raindrops' ),
			'validate'		 => 'raindrops_sidebar_format_status_archive_validate',
			'list'			 => 94 ),
		"raindrops_sidebar_format_video_archive"			 => array( 'option_id'		 => 96,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_sidebar_format_video_archive",
			'option_value'	 => '3',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Archives Post Format Video Columns', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'value 1-3. default 3', 'raindrops' ),
			'validate'		 => 'raindrops_sidebar_format_video_archive_validate',
			'list'			 => 95 ),
		"raindrops_sidebar_format_audio_archive"			 => array( 'option_id'		 => 97,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_sidebar_format_audio_archive",
			'option_value'	 => '3',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Archives Post Format Audio Columns', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'value 1-3. default 3', 'raindrops' ),
			'validate'		 => 'raindrops_sidebar_format_audio_archive_validate',
			'list'			 => 96 ),
		"raindrops_sidebar_format_gallery_archive"			 => array( 'option_id'		 => 98,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_sidebar_format_gallery_archive",
			'option_value'	 => '3',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Archives Post Format Galley Columns', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'value 1-3. default 3', 'raindrops' ),
			'validate'		 => 'raindrops_sidebar_format_gallery_archive_validate',
			'list'			 => 97 ),
		"raindrops_sidebar_format_chat_archive"				 => array( 'option_id'		 => 99,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_sidebar_format_chat_archive",
			'option_value'	 => '3',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Archives Post Format Chat Columns', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'value 1-3. default 3', 'raindrops' ),
			'validate'		 => 'raindrops_sidebar_format_chat_archive_validate',
			'list'			 => 98 ),
		"raindrops_sidebar_format_aside_archive"			 => array( 'option_id'		 => 100,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_sidebar_format_aside_archive",
			'option_value'	 => '3',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Archives Post Format Aside Columns', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'value 1-3. default 3', 'raindrops' ),
			'validate'		 => 'raindrops_sidebar_format_aside_archive_validate',
			'list'			 => 99 ),
		"raindrops_sidebar_posts_page"						 => array( 'option_id'		 => 101,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_sidebar_posts_page",
			'option_value'	 => '3',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Static Front Page / Posts page ', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'value 1-3. default 3', 'raindrops' ),
			'validate'		 => 'raindrops_sidebar_posts_page_validate',
			'list'			 => 100 ),
		"raindrops_sticky_menu"								 => array( 'option_id'		 => 102,
			'blog_id'		 => 0,
			'option_name'	 => "raindrops_sticky_menu",
			'option_value'	 => 'yes',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Sticky Menu ', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'value yes or no. default yes', 'raindrops' ),
			'validate'		 => 'raindrops_sticky_menu_validate',
			'list'			 => 101 ),
		'raindrops_reset_options'							 => array( 'option_id'		 => 103,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_reset_options',
			'option_value'	 => 'no',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Reset Theme Settings', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Carefully Use! Reset All Theme Settings', 'raindrops' ),
			'validate'		 => 'raindrops_reset_options_validate',
			'list'			 => 102 ),
		'raindrops_color_select'							 => array( 'option_id'		 => 104,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_color_select',
			'option_value'	 => 'automatic',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Color Setting', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Select Automatic Color or Custom Color', 'raindrops' ),
			'validate'		 => 'raindrops_color_select_validate',
			'list'			 => 103 ),
		'raindrops_show_date_author_in_attachment'			 => array( 'option_id'		 => 105,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_show_date_author_in_attachment',
			'option_value'	 => 'no',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Show Attach to Post Date and Author in Attachment', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Default no', 'raindrops' ),
			'validate'		 => 'raindrops_show_date_author_in_attachment_validate',
			'list'			 => 104 ),
		'raindrops_show_date_author_in_page'				 => array( 'option_id'		 => 106,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_show_date_author_in_page',
			'option_value'	 => 'no',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Show Publish Date and Author in Page', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Default no', 'raindrops' ),
			'validate'		 => 'raindrops_show_date_author_in_page_validate',
			'list'			 => 105 ),
		'raindrops_default_sidebar_responsive'				 => array( 'option_id'		 => 107,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_default_sidebar_responsive',
			'option_value'	 => 'no',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Responsive Default Sidebar', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Default no', 'raindrops' ),
			'validate'		 => 'raindrops_default_sidebar_responsive_validate',
			'list'			 => 106 ),
		'raindrops_extra_sidebar_responsive'				 => array( 'option_id'		 => 108,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_extra_sidebar_responsive',
			'option_value'	 => 'yes',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Responsive Extra Sidebar', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Default yes', 'raindrops' ),
			'validate'		 => 'raindrops_extra_sidebar_responsive_validate',
			'list'			 => 107 ),
		'raindrops_default_sidebar_responsive_breakpoint'	 => array( 'option_id'		 => 107,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_default_sidebar_responsive_breakpoint',
			'option_value'	 => 800,
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Responsive Breakpoint for Default Sidebar', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Please Set Numeric Pixel Value', 'raindrops' ),
			'validate'		 => 'raindrops_default_sidebar_responsive_breakpoint_validate',
			'list'			 => 106 ),
		'raindrops_extra_sidebar_responsive_breakpoint'		 => array( 'option_id'		 => 108,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_extra_sidebar_responsive_breakpoint',
			'option_value'	 => 960,
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Responsive Breakpoint for Extra Sidebar', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Please Set Numeric Pixel Value', 'raindrops' ),
			'validate'		 => 'raindrops_extra_sidebar_responsive_breakpoint_validate',
			'list'			 => 107 ),
		'raindrops_color_coded_category'					 => array( 'option_id'		 => 109,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_color_coded_category',
			'option_value'	 => 'yes',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Enable Color-coded category', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Please Set yes or no. default yes', 'raindrops' ),
			'validate'		 => 'raindrops_color_coded_category_validate',
			'list'			 => 108 ),
		'raindrops_color_coded_post_tag'					 => array( 'option_id'		 => 110,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_color_coded_post_tag',
			'option_value'	 => 'yes',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Enable Color-coded Post Tag', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Please Set yes or no. default yes', 'raindrops' ),
			'validate'		 => 'raindrops_color_coded_post_tag_validate',
			'list'			 => 109 ),
		'raindrops_widget_recent_posts'					 => array( 'option_id'		 => 111,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_widget_recent_posts',
			'option_value'	 => 'no',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Relate Custom Post Type', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Recent Post Widget shows Post Type Recent Post on Custom Post Type Single Post', 'raindrops' ),
			'validate'		 => 'raindrops_widget_recent_posts_validate',
			'list'			 => 110 ),
		'raindrops_widget_categories'					 => array( 'option_id'		 => 112,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_widget_categories',
			'option_value'	 => 'no',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Relate Custom Post Type and Categories Widget', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Categories Widget shows Post Type relate Taxonomy on Custom Post Type Pages', 'raindrops' ),
			'validate'		 => 'raindrops_widget_categories_validate',
			'list'			 => 111 ),
		'raindrops_widget_archives'					 => array( 'option_id'		 => 113,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_widget_archives',
			'option_value'	 => 'no',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Relate Custom Post Type and Archives Widget', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Archives Widget shows Post Type relate Archives on Custom Post Type Pages', 'raindrops' ),
			'validate'		 => 'raindrops_widget_archives_validate',
			'list'			 => 112 ),
		'raindrops_primary_menu_color'					 => array( 'option_id'		 => 114,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_primary_menu_color',
			'option_value'	 => '',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Primary Menu Link Color', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'You can specify the color of the Primary Menu Link', 'raindrops' ),
			'validate'		 => 'raindrops_primary_menu_color_validate',
			'list'			 => 113 ),
		'raindrops_primary_menu_background'					 => array( 'option_id'		 => 114,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_primary_menu_background',
			'option_value'	 => '',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Primary Menu Background Color', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'You can specify the color of the Primary Menu Background Color', 'raindrops' ),
			'validate'		 => 'raindrops_primary_menu_background_validate',
			'list'			 => 113 ),
		'raindrops_content_width_setting'					 => array( 'option_id'		 => 115,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_content_width_setting',
			'option_value'	 => 'fit',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Content Width', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'keep: TinyMCE relate width, full: fit article width', 'raindrops' ),
			'validate'		 => 'raindrops_content_width_setting_validate',
			'list'			 => 114 ),
		'raindrops_content_elements_margin'					 => array( 'option_id'		 => 116,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_content_elements_margin',
			'option_value'	 => 1,
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Vertical Rhythm for Entry Content', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Line spacing adjustment. paragraf and headdings', 'raindrops' ),
			'validate'		 => 'raindrops_content_elements_margin_validate',
			'list'			 => 115 ),
		'raindrops_text_transform_of_title'					 => array( 'option_id'		 => 116,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_text_transform_of_title',
			'option_value'	 => 'no',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Convert All Titles to Uppercase', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Convert All Titles to Uppercase by CSS (Site Title,Entry Title,Widget Title and Archive Title)', 'raindrops' ),
			'validate'		 => 'raindrops_text_transform_of_title_validate',
			'list'			 => 115 ),
		'raindrops_show_related_posts'					 => array( 'option_id'		 => 117,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_show_related_posts',
			'option_value'	 => 'yes',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Show related posts on single post', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Display posts and related articles on single post default yes', 'raindrops' ),
			'validate'		 => 'raindrops_show_related_posts_validate',
			'list'			 => 116 ),
		'raindrops_show_related_posts_type'					 => array( 'option_id'		 => 117,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_show_related_posts_type',
			'option_value'	 => 'automatic',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'What is it associated with ?', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Please select from categories, tags, or recent posts. default Automatic', 'raindrops' ),
			'validate'		 => 'raindrops_show_related_posts_type_validate',
			'list'			 => 116 ),
		'raindrops_show_related_posts_orderby'					 => array( 'option_id'		 => 118,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_show_related_posts_orderby',
			'option_value'	 => 'post_date',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Oderby', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Please select randum or new post. default post date', 'raindrops' ),
			'validate'		 => 'raindrops_show_related_posts_orderby_validate',
			'list'			 => 117 ),
		'raindrops_show_related_posts_count'					 => array( 'option_id'		 => 119,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_show_related_posts_count',
			'option_value'	 => 2,
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Counts of post', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Please specify the number of display. default 4', 'raindrops' ),
			'validate'		 => 'raindrops_show_related_posts_count_validate',
			'list'			 => 118 ),
		'raindrops_show_related_posts_line_clip'					 => array( 'option_id'		 =>120,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_show_related_posts_line_clip',
			'option_value'	 => 'no',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Maximum row number of title,if you need', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'default no', 'raindrops' ),
			'validate'		 => 'raindrops_show_related_posts_line_clip_validate',
			'list'			 => 119 ),
		'raindrops_show_related_posts_title'					 => array( 'option_id'		 =>121,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_show_related_posts_title',
			'option_value'	 => esc_html__( 'Related Posts', 'raindrops' ),
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Counts of post', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Please specify the number of display', 'raindrops' ),
			'validate'		 => 'raindrops_show_related_posts_title_validate',
			'list'			 => 120 ),
		'raindrops_show_related_posts_excerpt_length'					 => array( 'option_id'		 =>122,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_show_related_posts_excerpt_length',
			'option_value'	 => 100,
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Excerpt length of Related Posts', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Please specify the number of excerpt length. use string length , not word count. default 100', 'raindrops' ),
			'validate'		 => 'raindrops_show_related_posts_excerpt_length_validate',
			'list'			 => 121 ),
		'raindrops_show_related_posts_thumbnail'					 => array( 'option_id'		 =>122,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_show_related_posts_thumbnail',
			'option_value'	 => 'show',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Featured Image', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Please specify the number of excerpt length. use string length , not word count. default 100', 'raindrops' ),
			'validate'		 => 'raindrops_show_related_posts_thumbnail_validate',
			'list'			 => 121 ),
		'raindrops_show_related_posts_thumbnail_fallback'					 => array( 'option_id'		 =>123,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_show_related_posts_thumbnail_fallback',
			'option_value'	 => get_template_directory_uri() . '/images/dummy.png',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Fallback Featured Image', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Fallback Featured image URL if featured image is not set in the post, leave it blank if you do not need it', 'raindrops' ),
			'validate'		 => 'raindrops_show_related_posts_thumbnail_fallback_validate',
			'list'			 => 122 ),
		'raindrops_enable_writing_mode_mix'					 => array( 'option_id'		 =>124,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_enable_writing_mode_mix',
			'option_value'	 => 'no',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Support Vertical Writing Mode', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'If you use the theme in the Japanese environment, you will be able to write vertically if you enable it.', 'raindrops' ),
			'validate'		 => 'raindrops_enable_writing_mode_mix_validate',
			'list'			 => 123 ),
		'raindrops_enable_writing_mode_mix_line_size'					 => array( 'option_id'		 =>125,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_enable_writing_mode_mix_line_size',
			'option_value'	 => 400,
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'The length of one line', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'You can specify the length of one line in pixels', 'raindrops' ),
			'validate'		 => 'raindrops_enable_writing_mode_mix_line_size_validate',
			'list'			 => 124 ),
		'raindrops_enable_writing_mode_mix_scope'					 => array( 'option_id'		 =>126,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_enable_writing_mode_mix_scope',
			'option_value'	 => 'article',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Range for vertical writing', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'You can specify whether to vertically write the title and entry content or only the entry content.', 'raindrops' ),
			'validate'		 => 'raindrops_enable_writing_mode_mix_scope_validate',
			'list'			 => 125 ),
		'raindrops_enable_writing_mode_mix_auto_add_class'					 => array( 'option_id'		 =>127,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_enable_writing_mode_mix_auto_add_class',
			'option_value'	 => 'p+h+li',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Automatically vertically write the specified element', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Vertical writing class (.d-tate) is added automatically when you specify the element to be vertically written.', 'raindrops' ),
			'validate'		 => 'raindrops_enable_writing_mode_mix_auto_add_class_validate',
			'list'			 => 126 ),
		'raindrops_parallax_header_image'					 => array( 'option_id'		 =>128,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_parallax_header_image',
			'option_value'	 => 'enable',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Parallax Header Image', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Make the header image parallax', 'raindrops' ),
			'validate'		 => 'raindrops_parallax_header_image_validate',
			'list'			 => 127 ),
		'raindrops_replace_style_sttr_width_data_attr'					 => array( 'option_id'		 =>129,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_replace_style_sttr_width_data_attr',
			'option_value'	 => 'enable',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Replace style attributes with data attributes', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'The corresponding CSS is created automatically.', 'raindrops' ),
			'validate'		 => 'raindrops_replace_style_sttr_width_data_attr_validate',
			'list'			 => 128 ),
		'raindrops_paragraph_line_wrapping'					 => array( 'option_id'		 =>130,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_paragraph_line_wrapping',
			'option_value'	 => 'disable',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Paragraph line wrapping', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Adjust the paragraph width becomes large and difficult to read', 'raindrops' ),
			'validate'		 => 'raindrops_paragraph_line_wrapping_validate',
			'list'			 => 129 ),
		'raindrops_paragraph_line_wrapping_value'					 => array( 'option_id'		 =>131,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_paragraph_line_wrapping_value',
			'option_value'	 => 50,
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Specify the number of characters to display on one line.', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Please set it while checking the number of characters in customizer', 'raindrops' ),
			'validate'		 => 'raindrops_paragraph_line_wrapping_value_validate',
			'list'			 => 130 ),
		'raindrops_performance_helper'					 => array( 'option_id'		 =>132,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_performance_helper',
			'option_value'	 => 'disable',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Improve the response of the website', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'When using plug-in etc., operation may be hindered. This function works only in the logout status.', 'raindrops' ),
			'validate'		 => 'raindrops_performance_helper_validate',
			'list'			 => 131 ),
		'raindrops_lazyload_image'					 => array( 'option_id'		 =>133,
			'blog_id'		 => 0,
			'option_name'	 => 'raindrops_lazyload_image',
			'option_value'	 => 'enable',
			'autoload'		 => 'yes',
			'title'			 => esc_html__( 'Lazy load image', 'raindrops' ),
			'excerpt1'		 => '',
			'excerpt2'		 => esc_html__( 'Improving the display of the web site by delay loading the image loading.', 'raindrops' ),
			'validate'		 => 'raindrops_lazyload_image_validate',
			'list'			 => 132 ),
	);
}

if( 'yes' == get_theme_mod( 'raindrops_year_2017_base_settings' ) ) {

	$raindrops_base_setting_args["raindrops_page_width"]['option_value'] = 'doc5';
	$raindrops_base_setting_args["raindrops_featured_image_recent_post_count"]['option_value'] = 10;
	$raindrops_base_setting_args["raindrops_place_of_site_title"]['option_value'] = 'header_image';
	$raindrops_base_setting_args["raindrops_style_type"]['option_value'] = 'minimal';
}
if( 'yes' == get_theme_mod( 'raindrops_year_2018_base_settings' ) ) {

	$raindrops_base_setting_args["raindrops_page_width"]['option_value'] = 'doc5';
	$raindrops_base_setting_args["raindrops_featured_image_recent_post_count"]['option_value'] = 100;
	$raindrops_base_setting_args["raindrops_place_of_site_title"]['option_value'] = 'header_image';
	$raindrops_base_setting_args["raindrops_style_type"]['option_value'] = 'minimal';
	$raindrops_base_setting_args["raindrops_col_width"]['option_value'] = 't3';
	$raindrops_base_setting_args["raindrops_right_sidebar_width_percent"]['option_value'] = '33';
	$raindrops_base_setting_args["raindrops_default_sidebar_responsive"]['option_value'] = 'yes';
	$raindrops_base_setting_args["raindrops_default_sidebar_responsive_breakpoint"]['option_value'] = 980;
	$raindrops_base_setting_args["raindrops_extra_sidebar_responsive_breakpoint"]['option_value'] = 980;
	$raindrops_base_setting_args["raindrops_content_width_setting"]['option_value'] = 'fit';
}

if ( !isset( $raindrops_base_setting ) || empty( $raindrops_base_setting ) ) {

	$raindrops_base_setting = apply_filters( 'raindrops_base_setting_args', $raindrops_base_setting_args );
}