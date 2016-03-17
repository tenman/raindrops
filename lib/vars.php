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
/**
 * Tooltip Script
 */


if ( ! isset( $raindrops_tooltip ) ) {	
	$raindrops_tooltip = true;
} 
/**
 * tagcloud widget presentation
 *  @see raindrops_color_pallet_tagcloud()
 *  value false then WordPress default widget style.
 */
if ( ! isset( $raindrops_tag_cloud_widget_presentation) ) {
	
	 $raindrops_tag_cloud_widget_presentation = true;
}
/**
 * Tag shows or not by tagcloud item count ,Applied CSS
 */
if ( ! isset( $raindrops_tag_cloud_widget_threshold_val ) ) {
	
	 $raindrops_tag_cloud_widget_threshold_val = 0;
}

/**
 * fallback image for attachment , gallery
 * @since 1.328
 */
if ( ! isset( $raindrops_fallback_image_for_entry_content_enable) ) {
	
	$raindrops_fallback_image_for_entry_content_enable = true;
}
/**
 * Show Content Share Link
 * @since 1.315
 */
do_action('raindrops_var_before');

if( ! isset( $raindrops_header_image_default_ratio ) ) {

	$raindrops_header_image_default_ratio = 0.303125;
}
if( ! isset( $raindrops_allow_share_link ) ) {

	$raindrops_allow_share_link = true;
}
/**
 * Eye Candy Image for Content Share Link
 * @since 1.315
 */
if( ! isset( $raindrops_share_link_image ) ) {

	$raindrops_share_link_image = 'post_thumbnail';
}
/**
 * emoji icon
 * must needs Hexadecimal HTML Entity
 */
if( ! isset( $raindrops_category_emoji ) ) {

	$raindrops_category_emoji = '&#x1f4c2;';
}
if( ! isset( $raindrops_tag_emoji ) ) {

	$raindrops_tag_emoji = '&#x1f4ce;';
}
if( ! isset( $raindrops_posted_on_date_emoji ) ) {

	$raindrops_posted_on_date_emoji = '&#x1f4c5;';
}
/**
 * Add avatar at Recent Comments
 * value true or false , default true
 */
if( ! isset( $raindrops_recent_comments_avatar ) ) {

	$raindrops_recent_comments_avatar = true;
}

/**
 * for highly customize
 * @since 1.307
 * value true or false , default false
 */
if( ! isset( $raindrops_automatic_color ) ) {

	$raindrops_automatic_color = false;
}
if( false !== raindrops_has_indivisual_notation() ) {

	$raindrops_automatic_color = true;
}
/**
 * @since 1.293
 * value 'yes' or 'no'
 */
if ( ! isset( $raindrops_customizer_admin_color ) ) {
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
$raindrops_check_wp_version			 = explode( '-', $wp_version );
$raindrops_wp_version				 = $raindrops_check_wp_version[ 0 ];
/* @since 1.103 */
$raindrops_current_data				 = wp_get_theme();
$raindrops_current_data_theme_uri	 = apply_filters( 'raindrops_theme_url', $raindrops_current_data->get( 'ThemeURI' ) );
$raindrops_current_data_author_uri	 = apply_filters( 'raindrops_author_url', $raindrops_current_data->get( 'AuthorURI' ) );
$raindrops_current_data_version		 = $raindrops_current_data->get( 'Version' );
$raindrops_current_theme_name		 = $raindrops_current_data->get( 'Name' );
$raindrops_current_theme_slug		 = str_replace( ' ', '-', $raindrops_current_theme_name );
$raindrops_current_theme_slug		 = sanitize_html_class( $raindrops_current_theme_slug );
$raindrops_description_for_translation = __( 'This theme can change freely fonts,layout,color scheme and header image for each post,page. The google fonts, you can use freely in the post more than 90percent of the fonts.Color scheme and layout, you can freely change from theme customizer.For more updates, please make sure to open the link of the changelog from the help tab of this theme page.Add new post, so also to help tab of edit post page has been described how to use tips, please visit. Supported languages Japanese - JAPAN (ja) French - FRANCE (fr_FR) Polish - POLAND (PL) (pl_PL) Portuguese - BRAZIL (pt_BR)', 'raindrops' );
$raindrops_text_domain				 = $raindrops_current_data->get( 'TextDomain' );

/**
 * Show or Hide Radindrops customize settings
 * value true or false default true;
 */
if( ! isset( $raindrops_extend_customizer ) ) {

	$raindrops_extend_customizer = true;
}
/** DON'T CHANGE NOW TEST
 * value theme_mod or option
 */
if( ! isset( $raindrops_setting_type ) ) {
	
	$raindrops_setting_type	= 'option';	
}
/** DON'T CHANGE NOW TEST
 * Customizer Option Field Name
 */
if( ! defined('THEME_OPTION_FIELD_NAME') ) {

	define( 'THEME_OPTION_FIELD_NAME', 'raindrops_theme_settings' );
}
/**
 * Customizer Capability
 */
if( ! isset( $raindrops_customize_cap ) ) {

	$raindrops_customize_cap = 'edit_theme_options';
}
/**
 * $content_width keep When pege 1 column
 * @since 1.272
 * value true or false
 */
if ( ! isset( $raindrops_keep_content_width ) ) {

	$raindrops_keep_content_width = apply_filters( 'raindrops_keep_content_width', true );
}

/**
 * Use transient or not
 * value true or false
 */
if ( ! isset( $raindrops_use_transient ) ) {

	$raindrops_use_transient = true;
}
/**
 * Raindrops Gallery Presentation
 * value false shows WordPress Standard Gallery Style.
 * @since 1.269
 */
if( ! isset( $raindrops_extend_galleries ) ) {

	$raindrops_extend_galleries = true;
}
/**
 * Show theme options page
 * If set false then hide Raindrops theme option and Raindrops options page
 *
 * $raindrops_show_theme_option
 * @since 1.149
 * default value change 1.293
 */
if ( !isset( $raindrops_show_theme_option ) ) {

	$raindrops_show_theme_option = false;
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
if ( ! isset( $raindrops_recommend_plugins ) ) {

	$raindrops_recommend_plugins = true;
}
/**
 * Functionality limited. Now testing
 * Current TGM Not works at multisite
 * @since 1.250
 */
 if( is_multisite() ) {

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
	/* @1.337 from 320 to 296*/
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

if( ! isset( $raindrops_use_featured_image_light_box ) ) {

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
if ( ! isset( $raindrops_base_setting_args ) ) {

	$raindrops_current_style_type = raindrops_warehouse_clone( 'raindrops_style_type' );
	
	

$raindrops_base_setting_args = array(
array( 'option_id'    => 1,
	'blog_id'      => 0,
	'option_name'  => "raindrops_color_scheme",
	'option_value' => "raindrops_color_ja",
	'autoload'     => 'yes',
	'title'        => esc_html__( 'Color Scheme', 'raindrops' ),
	'excerpt1'     => '',
	'excerpt2'     => esc_html__( 'Please choose the naming convention for the color list', 'raindrops' ),
	'validate'     => 'raindrops_color_scheme_validate', 'list'         => 12 ),
array( 'option_id'    => 2,
	'blog_id'      => 0,
	'option_name'  => "raindrops_base_color",
	'option_value' => "#444444",
	'autoload'     => 'yes',
	'title'        => esc_html__( 'Base Color for Automatic Color Arrangement', 'raindrops' ),
	'excerpt1'     => '',
	'excerpt2'     => esc_html__( 'Please specify your favorite color. and an automatic arrangement of color is designed.', 'raindrops' ),
	'validate'     => 'raindrops_base_color_validate',
	'list'         => 1 ),
array( 'option_id'    => 3,
	'blog_id'      => 0,
	'option_name'  => "raindrops_style_type",
	'option_value' => "dark",
	'autoload'     => 'yes',
	'title'        => esc_html__( 'Color Type', 'raindrops' ),
	'excerpt1'     => '',
	'excerpt2'     => esc_html__( 'The mood like dark atmosphere and the bright note, etc. is decided. and The editor is displayed when themename is selected, and a present style can be edited in detail.', 'raindrops' ),
	'validate'     => 'raindrops_style_type_validate',
	'list'         => 2,
),
array( 'option_id'    => 4,
	'blog_id'      => 0,
	'option_name'  => "raindrops_header_image",
	'option_value' => "none",
	'autoload'     => 'yes',
	'title'        => esc_html__( 'Header background image', 'raindrops' ),
	'excerpt1'     => '',
	'excerpt2'     => esc_html__( 'The header image can be set by two methods.
One is a method of up-loading the image from the below up-loading form. Another is a method of filling in the filename from this textfield from Raindrops/images something image.', 'raindrops' ),
	'validate'     => 'raindrops_header_image_validate',
	'list'         => 3,
),
array( 'option_id'    => 5,
	'blog_id'      => 0,
	'option_name'  => "raindrops_footer_image",
	'option_value' => "none",
	'autoload'     => 'yes',
	'title'        => esc_html__( 'Footer background image', 'raindrops' ),
	'excerpt1'     => '',
	'excerpt2'     => esc_html__( 'The footer image can be set by two methods.
One is a method of up-loading the image from the below up-loading form. Another is a method of filling in the filename from this textfield from Raindrops/images something image.', 'raindrops' ),
	'validate'     => 'raindrops_footer_image_validate', 'list'         => 4 ),
array( 'option_id'    => 6,
	'blog_id'      => 0,
	'option_name'  => "raindrops_heading_image",
	'option_value' => "none",
	'autoload'     => 'yes',
	'title'        => esc_html__( 'Widget Title Background Image', 'raindrops' ),
	'excerpt1'     => '',
	'excerpt2'     => esc_html__( 'The header image can be chosen from among three kinds [h2.png,h2b.png,h2c.png].', 'raindrops' ),
	'validate'     => 'raindrops_heading_image_validate', 'list'         => 5 ),
array( 'option_id'    => 7,
	'blog_id'      => 0,
	'option_name'  => "raindrops_heading_image_position",
	'option_value' => "0",
	'autoload'     => 'yes',
	'title'        => esc_html__( 'Widget Title Background Image Position', 'raindrops' ),
	'excerpt1'     => '',
	'excerpt2'     => esc_html__( 'The name of the picture file used for the h2 headding is set. Please set the integral value from 0 to 7. ', 'raindrops' ),
	'validate'     => 'raindrops_heading_image_position_validate', 'list'         => 6 ),
array( 'option_id'    => 8,
	'blog_id'      => 0,
	'option_name'  => "raindrops_page_width",
	'option_value' => "doc3",
	'autoload'     => 'yes',
	'title'        => __( 'Page Width', 'raindrops' ),
	'excerpt1'     => '',
	'excerpt2'     => esc_html__( 'Please choose width on the page.', 'raindrops' ) .
	esc_html__( 'Please choose from four kinds of inside of', 'raindrops' ) .
	esc_html__( '750px centerd 950px centerd fluid 974px.', 'raindrops' ),
	'validate'     => 'raindrops_page_width_validate', 'list'         => 7 ),
array( 'option_id'    => 9,
	'blog_id'      => 0,
	'option_name'  => "raindrops_col_width",	
	'option_value' => raindrops_switch_default_by_color_type_clone($raindrops_current_style_type,"raindrops_col_width", "t2", "t6" ),
	'autoload'     => 'yes',
	'title'        => esc_html__( 'Column Width and Position', 'raindrops' ),
	'excerpt1'     => '',
	'excerpt2'     => esc_html__( 'Please specify the position and the width of Default Sidebar. Six kinds of sidebars of left 160px left 180px left 300px right 180px right 240px right 300px can be specified.', 'raindrops' ),
	'validate'     => 'raindrops_col_width_validate', 'list'         => 8 ),
array( 'option_id'    => 10,
	'blog_id'      => 0,
	'option_name'  => "raindrops_default_fonts_color",
	'option_value' => raindrops_default_colors_clone( $raindrops_current_style_type,  "raindrops_default_fonts_color", true ) ,
	'autoload'     => 'yes',
	'title'        => esc_html__( 'Text color in content ', 'raindrops' ),
	'excerpt1'     => '',
	'excerpt2'     => esc_html__( 'If you need to set contents Special font color.', 'raindrops' ),
	'validate'     => 'raindrops_default_fonts_color_validate', 'list'         => 9 ),
array( 'option_id'    => 11,
	'blog_id'      => 0,
	'option_name'  => "raindrops_footer_color",
	'option_value' => raindrops_default_colors_clone( $raindrops_current_style_type,  "raindrops_footer_color", true ) ,
	'autoload'     => 'yes',
	'title'        => esc_html__( 'Text color in footer ', 'raindrops' ),
	'excerpt1'     => '',
	'excerpt2'     => esc_html__( 'If you need to set footer Special font color.', 'raindrops' ),
	'validate'     => 'raindrops_footer_color_validate', 'list'         => 10 ),
array( 'option_id'    => 12,
	'blog_id'      => 0,
	'option_name'  => "raindrops_show_right_sidebar",
	'option_value' => raindrops_switch_default_by_color_type_clone($raindrops_current_style_type, "raindrops_show_right_sidebar", "show", "hide" ), 
	'autoload'     => 'yes',
	'title'        => esc_html__( 'Extra Sidebar', 'raindrops' ),
	'excerpt1'     => '',
	'excerpt2'     => esc_html__( 'Please specify show when you want to use three row layout. Please set Ratio to text when extra sidebar is displayed when you specify show', 'raindrops' ),
	'validate'     => 'raindrops_show_right_sidebar_validate', 'list'         => 11 ),
array( 'option_id'    => 13,
	'blog_id'      => 0,
	'option_name'  => "raindrops_right_sidebar_width_percent",
	'option_value' => "25",
	'autoload'     => 'yes',
	'title'        => esc_html__( 'Extra Sidebar Width', 'raindrops' ),
	'excerpt1'     => '',
	'excerpt2'     => esc_html__( 'When display extra sidebar is set to show', 'raindrops' ) .
	esc_html__( 'it is necessary to specify it.', 'raindrops' ) .
	esc_html__( 'It can decide to divide the width of which place of extra sidebar', 'raindrops' ) .
	esc_html__( 'and to give it. Please select it from among 25% 33% 50% 66% 75%. ', 'raindrops' ),
	'validate'     => 'raindrops_right_sidebar_width_percent_validate', 'list'         => 12 ),
array( 'option_id'    => 14,
	'blog_id'      => 0,
	'option_name'  => "raindrops_show_menu_primary",
	'option_value' => "show",
	'autoload'     => 'yes',
	'title'        => esc_html__( 'Menu Primary', 'raindrops' ),
	'excerpt1'     => '',
	'excerpt2'     => esc_html__( 'Display or not Menu Primary. default value is show. set hide when not display menu primary', 'raindrops' ),
	'validate'     => 'raindrops_show_menu_primary_validate', 'list'         => 13 ),
array( 'option_id'    => 15,
	'blog_id'      => 0,
	'option_name'  => "raindrops_hyperlink_color",
	'option_value' => raindrops_default_colors_clone( $raindrops_current_style_type,  "raindrops_hyperlink_color", true ) ,
	'autoload'     => 'yes',
	'title'        => esc_html__( 'Link color', 'raindrops' ),
	'excerpt1'     => '',
	'excerpt2'     => esc_html__( 'Hyper link color', 'raindrops' ),
	'validate'     => 'raindrops_hyperlink_color_validate', 'list'         => 14 ),
array( 'option_id'    => 16,
	'blog_id'      => 0,
	'option_name'  => "raindrops_accessibility_settings",
	'option_value' => "no",
	'autoload'     => 'yes',
	'title'        => esc_html__( 'Accessibility Settings', 'raindrops' ),
	'excerpt1'     => '',
	'excerpt2'     => esc_html__( 'Accessibility Settings is create a unique link text. set to yes or no.', 'raindrops' ),
	'validate'     => 'raindrops_accessibility_settings_validate',
	'list'         => 15
),
array( 'option_id'    => 17,
	'blog_id'      => 0,
	'option_name'  => "raindrops_doc_type_settings",
	'option_value' => "html5",
	'autoload'     => 'yes',
	'title'        => esc_html__( "Document Type Settings", 'raindrops' ),
	'excerpt1'     => '',
	'excerpt2'     => esc_html__( "Default Document type html5. Set to xhtml or html5.", 'raindrops' ),
	'validate'     => 'raindrops_doc_type_settings_validate',
	'list'         => 16
),
 array( 'option_id'    => 18,
	'blog_id'      => 0,
	'option_name'  => "raindrops_basefont_settings",
	'option_value' => "13",
	'autoload'     => 'yes',
	'title'        => esc_html__( "Base Font Size Setting", 'raindrops' ),
	'excerpt1'     => '',
	'excerpt2'     => esc_html__( "Base Font Size Value Recommend 13-20 (px size)", 'raindrops' ),
	'validate'     => 'raindrops_basefont_settings_validate',
	 'list'         => 17
),
  array( 'option_id'    => 19,
	'blog_id'      => 0,
	'option_name'  => "raindrops_fluid_max_width",
	'option_value' => "1280",
	'autoload'     => 'yes',
	'title'        => esc_html__( "Fluid ( Responsive ) Max Page Width", 'raindrops' ),
	'excerpt1'     => '',
	'excerpt2'     => esc_html__( "Default 1280 (px size)", 'raindrops' ),
	'validate'     => 'raindrops_fluid_max_width_validate',
	 'list'         => 18
),
array( 'option_id'    => 20,
	'blog_id'      => 0,
	'option_name'  => "raindrops_entry_content_is_home",
	'option_value' => "content",
	'autoload'     => 'yes',
	'title'        => esc_html__( "Home Entry Content Type", 'raindrops' ),
	'excerpt1'     => '',
	'excerpt2'     => esc_html__( "value content, excerpt, none", 'raindrops' ),
	'validate'     => 'raindrops_entry_content_is_home_validate',
	 'list'         => 19
),
array( 'option_id'    => 21,
	'blog_id'      => 0,
	'option_name'  => "raindrops_entry_content_is_category",
	'option_value' => "content",
	'autoload'     => 'yes',
	'title'        => esc_html__( "Category Archive Content Type", 'raindrops' ),
	'excerpt1'     => '',
	'excerpt2'     => esc_html__( "value content, excerpt, none", 'raindrops' ),
	'validate'     => 'raindrops_entry_content_is_category_validate',
	 'list'         => 20
),

   array( 'option_id'    => 22,
	'blog_id'      => 0,
	'option_name'  => "raindrops_entry_content_is_search",
	'option_value' => "content",
	'autoload'     => 'yes',
	'title'        => esc_html__( "Search Result Content Type", 'raindrops' ),
	'excerpt1'     => '',
	'excerpt2'     => esc_html__( "value content, excerpt, none", 'raindrops' ),
	'validate'     => 'raindrops_entry_content_is_tag_validate',
	 'list'         => 21
),
array( 'option_id'    => 23,
	'blog_id'      => 0,
	'option_name'  => "raindrops_footer_link_color",
	'option_value' => raindrops_default_colors_clone( $raindrops_current_style_type,  "raindrops_footer_link_color", true ),
	'autoload'     => 'yes',
	'title'        => esc_html__( 'Link color in footer ', 'raindrops' ),
	'excerpt1'     => '',
	'excerpt2'     => esc_html__( 'If you need to set footer Special link color.hex color ex.#ff0000 or empty string', 'raindrops' ),
	'validate'     => 'raindrops_footer_link_color_validate',
	'list'         => 22
),
array( 'option_id'    => 24,
	'blog_id'      => 0,
	'option_name'  => "raindrops_complementary_color_for_title_link",
	'option_value' => "none",
	'autoload'     => 'yes',
	'title'        => esc_html__( 'Complementary Color For Entry Title Link ', 'raindrops' ),
	'excerpt1'     => '',
	'excerpt2'     => esc_html__( 'If you need to set complementary color for entry title.(There is a need to link color is set to chromatic) value yes or none', 'raindrops' ),
	'validate'     => 'raindrops_complementary_color_for_title_link_validate',
	'list'         => 23
),
array( 'option_id'    => 25,
	'blog_id'      => 0,
	'option_name'  => "raindrops_plugin_presentation_bcn_nav_menu",
	'option_value' => "none",
	'autoload'     => 'yes',
	'title'        => esc_html__( 'Breadcrumb NavXT Automatic Presentation ', 'raindrops' ),
	'excerpt1'     => '',
	'excerpt2'     => esc_html__( 'Theme, will make a presentation of applying the plugin automatically, value set yes or none', 'raindrops' ),
	'validate'     => 'raindrops_plugin_presentation_bcn_nav_menu_validate',
	'list'         => 24
),
array( 'option_id'    => 26,
	'blog_id'      => 0,
	'option_name'  => "raindrops_plugin_presentation_wp_pagenav",
	'option_value' => "none",
	'autoload'     => 'yes',
	'title'        => esc_html__( 'WP-PageNavi Automatic Presentation ', 'raindrops' ),
	'excerpt1'     => '',
	'excerpt2'     => esc_html__( 'Theme, will make a presentation of applying the plugin automatically, value set yes or none', 'raindrops' ),
	'validate'     => 'raindrops_plugin_presentation_wp_pagenav_validate',
	'list'         => 25
),
array( 'option_id'    => 27,
	'blog_id'      => 0,
	'option_name'  => "raindrops_plugin_presentation_meta_slider",
	'option_value' => "none",
	'autoload'     => 'yes',
	'title'        => esc_html__( 'Meta Slider Automatic Presentation ', 'raindrops' ),
	'excerpt1'     => '',
	'excerpt2'     => esc_html__( 'Please Set Meta Slider ID or none', 'raindrops' ),
	'validate'     => 'raindrops_plugin_presentation_wp_pagenav_validate',
	'list'         => 26
),
array( 'option_id'    => 28,
	'blog_id'      => 0,
	'option_name'  => "raindrops_plugin_presentation_the_events_calendar",
	'option_value' => "none",
	'autoload'     => 'yes',
	'title'        => esc_html__( 'The Events Calendar Automatic Presentation ', 'raindrops' ),
	'excerpt1'     => '',
	'excerpt2'     => esc_html__( 'Theme, will make a presentation of applying the plugin automatically, value set yes or none', 'raindrops' ),
	'validate'     => 'raindrops_plugin_presentation_the_events_calendarr_validate',
	'list'         => 27
),
array( 'option_id'    => 29,
	'blog_id'      => 0,
	'option_name'  => "raindrops_disable_keyboard_focus",
	'option_value' => "enable",
	'autoload'     => 'yes',
	'title'        => esc_html__( 'Disable Keyboard Focus ', 'raindrops' ),
	'excerpt1'     => '',
	'excerpt2'     => esc_html__( 'Fallback Setting when Nav Menu displayed improperly, value set enable( defalt ) or disable', 'raindrops' ),
	'validate'     => 'raindrops_disable_keyboard_focus_validate',
	'list'         => 28
),
array( 'option_id'    => 30,
	'blog_id'      => 0,
	'option_name'  => "raindrops_sync_style_for_tinymce",
	'option_value' => "yes",
	'autoload'     => 'yes',
	'title'        => esc_html__( 'Synchronize Style for Visual Editor', 'raindrops' ),
	'excerpt1'     => '',
	'excerpt2'     => esc_html__( 'Reflect on Dynamically Editor Style Settings, value set yes ( default ) or none', 'raindrops' ),
	'validate'     => 'raindrops_sync_style_for_tinymce_validate',
	'list'         => 29
),
array( 'option_id'    => 31,
	'blog_id'      => 0,
	'option_name'  => "raindrops_uninstall_option",
	'option_value' => "keep",
	'autoload'     => 'yes',
	'title'        => esc_html__( 'Uninstall Option', 'raindrops' ),
	'excerpt1'     => '',
	'excerpt2'     => esc_html__( 'Delete all Theme Settings when switch theme. default keep ( or delete )', 'raindrops' ),
	'validate'     => 'raindrops_uninstall_option_validate',
	'list'         => 30
),
 array( 'option_id'    => 32,
	'blog_id'      => 0,
	'option_name'  => "raindrops_menu_primary_font_size",
	'option_value' => 100,
	'autoload'     => 'yes',
	'title'        => esc_html__( 'Menu Primary Font Size', 'raindrops' ),
	'excerpt1'     => '',
	'excerpt2'     => esc_html__( 'Menu Primary Font Size. default value is 100( % ). set font size between 77 and 182', 'raindrops' ),
	'validate'     => 'raindrops_menu_primary_font_size_validate',
	'list'         => 31 ),
array( 'option_id'    => 33,
	'blog_id'      => 0,
	'option_name'  => "raindrops_menu_primary_min_width",
	'option_value' => 10,
	'autoload'     => 'yes',
	'title'        => esc_html__( 'Menu Primary Menu Width', 'raindrops' ),
	'excerpt1'     => '',
	'excerpt2'     => esc_html__( 'Menu Primary Menu Width. default value is 10 ( em ). set 1 between 95.999', 'raindrops' ),
	'validate'     => 'raindrops_menu_primary_min_width_validate',
	'list'         => 32 ),
array( 'option_id'    => 34,
        'blog_id'      => 0,
        'option_name'  => "raindrops_featured_image_position",
        'option_value' => 'left',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Featured Image Position', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'Featured Image Position for Emphasis of new content using the Featured Image values default,left,front', 'raindrops' ),
        'validate'     => 'raindrops_featured_image_position_validate',
		'list'         => 33 ),
array( 'option_id'    => 35,
        'blog_id'      => 0,
        'option_name'  => "raindrops_featured_image_size",
        'option_value' => 'thumbnail',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Featured Image Size', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'values thumbnail, medium, large, default', 'raindrops' ),
        'validate'     => 'raindrops_featured_image_size_validate',
		'list'         => 34 ),
array( 'option_id'    => 36,
        'blog_id'      => 0,
        'option_name'  => "raindrops_featured_image_recent_post_count",
        'option_value' => 3,
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Featured Image Special Layout Apply Post Count', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'values from 1 to Post Per Page count default value none', 'raindrops' ),
        'validate'     => 'raindrops_featured_image_recent_post_count_validate',
		'list'         => 35 ),
array( 'option_id'    => 37,
        'blog_id'      => 0,
        'option_name'  => "raindrops_featured_image_singular",
        'option_value' => 'show',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Featured Image Show, lightbox or Hide on Singular Post,Page', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'values show or hide or lightbox ( light box is crop height ,add lightbox )', 'raindrops' ),
        'validate'     => 'raindrops_featured_image_singular_validate',
		'list'         => 36 ),
array( 'option_id'    => 38,
        'blog_id'      => 0,
        'option_name'  => "raindrops_use_featured_image_emphasis",
        'option_value' => 'no',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'USE or Not Emphasis of new content using the Featured Image', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'values yes or no default no', 'raindrops' ),
        'validate'     => 'raindrops_use_featured_image_emphasis_validate',
		'list'         => 37 ),
array( 'option_id'    => 39,
        'blog_id'      => 0,
        'option_name'  => "raindrops_japanese_date",
        'option_value' => 'no',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'USE or Not Japanese Date', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'values yes or no default no', 'raindrops' ),
        'validate'     => 'raindrops_japanese_date_validate',
		'list'         => 38 ),
array( 'option_id'    => 40,
        'blog_id'      => 0,
        'option_name'  => "raindrops_read_more_after_excerpt",
        'option_value' => 'no',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Add Read More Link', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'Add read more link after excerpt. values yes or no default no', 'raindrops' ),
        'validate'     => 'raindrops_read_more_after_excerpt_validate',
		'list'         => 39 ),
array( 'option_id'    => 41,
        'blog_id'      => 0,
        'option_name'  => "raindrops_excerpt_enable",
        'option_value' => 'no',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Use Raindrops Extend Excerpt', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'HTML in Excerpt. values yes or no default no', 'raindrops' ),
        'validate'     => 'raindrops_excerpt_enable_validate',
		'list'         => 40 ),
array( 'option_id'    => 42,
        'blog_id'      => 0,
        'option_name'  => "raindrops_allow_oembed_excerpt_view",
        'option_value' => 'yes',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Allow Oembed Media at Raindrops Extend Excerpt', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'Overview display, if you set no, you can reduce the load time of the page. values yes or no default yes', 'raindrops' ),
        'validate'     => 'raindrops_allow_oembed_excerpt_view_validate',
		'list'         => 41 ),
array( 'option_id'    => 43,
        'blog_id'      => 0,
        'option_name'  => "raindrops_place_of_site_title",
        'option_value' => 'above',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Place of Title', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'value header_image, above. default above ', 'raindrops' ),
        'validate'     => 'raindrops_place_of_site_title_validate',
		'list'         => 42 ),
array( 'option_id'    => 44,
        'blog_id'      => 0,
        'option_name'  => "raindrops_site_title_left_margin",
        'option_value' => 1,
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Left Margin of Site Title', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'Works only Place of Title value set header_image, default value  1', 'raindrops' ),
        'validate'     => 'raindrops_site_title_left_margin_validate',
		'list'         => 43 ),
array( 'option_id'    => 45,
        'blog_id'      => 0,
        'option_name'  => "raindrops_site_title_top_margin",
        'option_value' => 1,
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Top Margin of Site Title', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'Works only Place of Title value set header_image, default value  1', 'raindrops' ),
        'validate'     => 'raindrops_site_title_top_margin_validate',
		'list'         => 44 ),
array( 'option_id'    => 46,
        'blog_id'      => 0,
        'option_name'  => "raindrops_site_title_font_size",
        'option_value' => 'none',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Font Size of Site Title', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'default value none, or 1-10( percent of viewport width )', 'raindrops' ),
        'validate'     => 'raindrops_site_title_font_size_validate',
		'list'         => 45 ),
array( 'option_id'    => 47,
        'blog_id'      => 0,
        'option_name'  => "raindrops_site_title_css_class",
        'option_value' => 'none',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Site Title CSS', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'for example google-font-lobster default value none', 'raindrops' ),
        'validate'     => 'raindrops_site_title_css_class_validate',
		'list'         => 46 ),
array( 'option_id'    => 47,
        'blog_id'      => 0,
        'option_name'  => "raindrops_tagline_in_the_header_image",
        'option_value' => 'show',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Tagline in the header image', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'tagline show or hide', 'raindrops' ),
        'validate'     => 'raindrops_tagline_in_the_header_image_validate',
		'list'         => 46 ),
array( 'option_id'    => 48,
        'blog_id'      => 0,
        'option_name'  => "raindrops_col_setting_type",
        'option_value' => 'simple',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Side bar setting method', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'value details or simple. default simple', 'raindrops' ),
        'validate'     => 'raindrops_col_setting_type_validate',
		'list'         => 47 ),
array( 'option_id'    => 49,
        'blog_id'      => 0,
        'option_name'  => "raindrops_sidebar_index",
        'option_value' => '3',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Index Page, Static Front Page columns', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'value 1-3. default 3', 'raindrops' ),
        'validate'     => 'raindrops_sidebar_index_validate',
		'list'         => 48 ),
array( 'option_id'    => 51,
        'blog_id'      => 0,
        'option_name'  => "raindrops_sidebar_date",
        'option_value' => '3',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Date Archive columns', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'value 1-3. default 3', 'raindrops' ),
        'validate'     => 'raindrops_sidebar_date_validate',
		'list'         => 50 ),
array( 'option_id'    => 52,
        'blog_id'      => 0,
        'option_name'  => "raindrops_sidebar_page",
        'option_value' => '3',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Static Page columns', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'value 1-3. default 3', 'raindrops' ),
        'validate'     => 'raindrops_sidebar_page_validate',
		'list'         => 51 ),
array( 'option_id'    => 53,
        'blog_id'      => 0,
        'option_name'  => "raindrops_sidebar_single",
        'option_value' => '3',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Single Post columns', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'value 1-3. default 3', 'raindrops' ),
        'validate'     => 'raindrops_sidebar_single_validate',
		'list'         => 52 ),
array( 'option_id'    => 54,
        'blog_id'      => 0,
        'option_name'  => "raindrops_sidebar_search",
        'option_value' => '3',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Search Result Page columns', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'value 1-3. default 3', 'raindrops' ),
        'validate'     => 'raindrops_sidebar_search_validate',
		'list'         => 53 ),
array( 'option_id'    => 55,
        'blog_id'      => 0,
        'option_name'  => "raindrops_sidebar_404",
        'option_value' => '3',
        'autoload'     => 'yes',
        'title'        => esc_html__( '404 Page columns', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'value 1-3. default 3', 'raindrops' ),
        'validate'     => 'raindrops_sidebar_404_validate',
		'list'         => 54 ),
array( 'option_id'    => 56,
        'blog_id'      => 0,
        'option_name'  => "raindrops_sidebar_list_of_post",
        'option_value' => '3',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'List of Post Template columns', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'value 1-3. default 3', 'raindrops' ),
        'validate'     => 'raindrops_sidebar_list_of_post_validate',
		'list'         => 55 ),
array( 'option_id'    => 57,
        'blog_id'      => 0,
        'option_name'  => "raindrops_full_width_max_width",
        'option_value' => 1280,
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Content Container Width', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'px value, default 1280', 'raindrops' ),
        'validate'     => 'raindrops_full_width_max_width_validate',
		'list'         => 56 ),
array( 'option_id'    => 58,
        'blog_id'      => 0,
        'option_name'  => "raindrops_full_width_limit_window_width",
        'option_value' => 1920,
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Support limit Browser Width', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'In the case of specified size abnormalities of the browser window size, it will show in the box layout. set px value, default 1920', 'raindrops' ),
        'validate'     => 'raindrops_full_width_limit_window_width_validate',
		'list'         => 57 ),
array( 'option_id'    => 59,
        'blog_id'      => 0,
        'option_name'  => "raindrops_sidebar_category",
        'option_value' => '3',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Category Archive columns', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'value 1-3. default 3', 'raindrops' ),
        'validate'     => 'raindrops_sidebar_category_validate',
		'list'         => 58 ),
array( 'option_id'    => 60,
        'blog_id'      => 0,
        'option_name'  => "raindrops_sidebar_author",
        'option_value' => '3',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Category Archive columns', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'value 1-3. default 3', 'raindrops' ),
        'validate'     => 'raindrops_sidebar_author_validate',
		'list'         => 59 ),
array( 'option_id'    => 61,
        'blog_id'      => 0,
        'option_name'  => "raindrops_xhtml_media_type",
        'option_value' => 'text/html',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'xhtml media type', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'value text/html or application/xhtml+xml, default text/html', 'raindrops' ),
        'validate'     => 'raindrops_xhtml_media_type_validate',
		'list'         => 60 ),
array( 'option_id'    => 62,
        'blog_id'      => 0,
        'option_name'  => "raindrops_actions_hook_message",
        'option_value' => 'hide',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Insert Point hooks and auto load template name for Developer', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'value show or hide, default hide', 'raindrops' ),
        'validate'     => 'raindrops_actions_hook_message_validate',
		'list'         => 61 ),
array( 'option_id'    => 63,
        'blog_id'      => 0,
        'option_name'  => "raindrops_status_bar",
        'option_value' => raindrops_switch_default_by_color_type_clone($raindrops_current_style_type, "raindrops_status_bar", "show", "hide" ), 
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Bottom Status Bar', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'value show or hide, default show', 'raindrops' ),
        'validate'     => 'raindrops_status_bar_validate',
		'list'         => 62 ),
////////////////////////////////////////////////
array( 'option_id'    => 64,
        'blog_id'      => 0,
        'option_name'  => "raindrops_article_title_css_class",
        'option_value' => ' ',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Entry Title CSS Class', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'default empty', 'raindrops' ),
        'validate'     => 'raindrops_article_title_css_class_validate',
		'list'         => 63 ),
array( 'option_id'    => 65,
        'blog_id'      => 0,
        'option_name'  => "raindrops_display_article_publish_date",
        'option_value' => 'show',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Display Post Publish Date', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'default show', 'raindrops' ),
        'validate'     => 'raindrops_display_article_publish_date_validate',
		'list'         => 64 ),
array( 'option_id'    => 66,
        'blog_id'      => 0,
        'option_name'  => "raindrops_display_article_author",
        'option_value' => 'avatar',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Display Post Author', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'default avatar', 'raindrops' ),
        'validate'     => 'raindrops_display_article_author_validate',
		'list'         => 65 ),
array( 'option_id'    => 67,
        'blog_id'      => 0,
        'option_name'  => "raindrops_display_default_category",
        'option_value' => 'show',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Display Default Category', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'default show', 'raindrops' ),
        'validate'     => 'raindrops_display_default_category_validate',
		'list'         => 66 ),
array( 'option_id'    => 68,
        'blog_id'      => 0,
        'option_name'  => "raindrops_sidebar_image_archive",
        'option_value' => '3',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Attachment Page Image Columns', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'value 1-3. default 3', 'raindrops' ),
        'validate'     => 'raindrops_sidebar_image_archive_validate',
		'list'         => 67 ),
array( 'option_id'    => 69,
        'blog_id'      => 0,
        'option_name'  => "raindrops_site_title_left_margin_type",
        'option_value' => 'default',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Left Margin of Site Title', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'Works only Place of Title value set header_image, default value  1', 'raindrops' ),
        'validate'     => 'raindrops_site_title_left_margin_type_validate',
		'list'         => 68 ),
array( 'option_id'    => 70,
        'blog_id'      => 0,
        'option_name'  => "raindrops_sidebar_tag",
        'option_value' => '3',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Tag Archive columns', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'value 1-3. default 3', 'raindrops' ),
        'validate'     => 'raindrops_sidebar_tag_validate',
		'list'         => 69 ),
array( 'option_id'    => 71,
        'blog_id'      => 0,
        'option_name'  => "raindrops_excerpt_length",
        'option_value' => '200',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Excerpt Length', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( '20-400', 'raindrops' ),
        'validate'     => 'raindrops_excerpt_length_validate',
		'list'         => 70 ),
array( 'option_id'    => 72,
        'blog_id'      => 0,
        'option_name'  => "raindrops_stylesheet_in_html",
        'option_value' => 'embed',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Location of the style sheet', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'Select link stylesheet to their source HTML or document with the LINK element', 'raindrops' ),
        'validate'     => 'raindrops_stylesheet_in_html_validate',
		'list'         => 71 ),
array( 'option_id'    => 73,
        'blog_id'      => 0,
        'option_name'  => "raindrops_parent_theme_mods",
        'option_value' => 'no',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Import Raindrops Theme Current Settings', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => '',
        'validate'     => 'raindrops_parent_theme_mods_validate',
		'list'         => 72 ),
array( 'option_id'    => 74,
        'blog_id'      => 0,
        'option_name'  => "raindrops_header_image_filter_color",
        'option_value' => '',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Header Image Filter Color', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => '',
        'validate'     => 'raindrops_header_image_filter_color_validate',
		'list'         => 73 ),
array( 'option_id'    => 75,
        'blog_id'      => 0,
        'option_name'  => "raindrops_header_image_filter_apply_top",
        'option_value' => 0,
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Filter Image Top', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => '',
        'validate'     => 'raindrops_header_image_filter_apply_top_validate',
		'list'         => 74 ),
array( 'option_id'    => 76,
        'blog_id'      => 0,
        'option_name'  => "raindrops_header_image_filter_apply_bottom",
        'option_value' => 0,
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Filter Image Bottom', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => '',
        'validate'     => 'raindrops_header_image_filter_apply_bottom_validate',
		'list'         => 75 ),
array( 'option_id'    => 77,
        'blog_id'      => 0,
        'option_name'  => "raindrops_enable_header_image_filter",
        'option_value' => 'disable',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Header Image Filter', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => '',
        'validate'     => 'raindrops_enable_header_image_filter_validate',
		'list'         => 76 ),
array( 'option_id'    => 78,
        'blog_id'      => 0,
        'option_name'  => 'raindrops_options_owner',
        'option_value' => 'raindrops',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Header Image Filter', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => '',
        'validate'     => 'raindrops_options_owner_validate',
		'list'         => 77 ),
array( 'option_id'    => 79,
        'blog_id'      => 0,
        'option_name'  => 'raindrops_display_sticky_post',
        'option_value' => 'anytime',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Sticky Post Show Single Post', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'Sticky Post Show only Home Page or Always it displayed ( default Always it displayed )', 'raindrops' ),
        'validate'     => 'raindrops_display_sticky_post_validate',
		'list'         => 78 ),
array( 'option_id'    => 80,
        'blog_id'      => 0,
        'option_name'  => 'raindrops_sitewide_css',
        'option_value' => '',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Site-wide CSS', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'Style  It will be retained even if the theme is updated', 'raindrops' ),
        'validate'     => 'raindrops_sitewide_css_validate',
		'list'         => 79 ),
array( 'option_id'    => 81,
        'blog_id'      => 0,
        'option_name'  => 'raindrops_posted_in_label',
        'option_value' => 'emoji',
        'autoload'     => 'show',
        'title'        => esc_html__( 'Posted in Labels', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'Hide Posted in Labels ', 'raindrops' ) . esc_html__( 'This entry was posted in', 'raindrops' ) .esc_html__( 'and tagged', 'raindrops' ),
        'validate'     => 'raindrops_posted_in_label_validate',
		'list'         => 80 ),
array( 'option_id'    => 81,
        'blog_id'      => 0,
        'option_name'  => 'raindrops_comments_are_closed',
        'option_value' => 'hide',
        'autoload'     => 'show',
        'title'        => esc_html__( 'Comments are closed Label', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'Hide ', 'raindrops' ) .esc_html__( 'Comments are closed.', 'raindrops' ),
        'validate'     => 'raindrops_comments_are_closed_validate',
		'list'         => 80 ),
array( 'option_id'    => 82,
        'blog_id'      => 0,
        'option_name'  => 'raindrops_archive_title_label',
        'option_value' => 'emoji',
        'autoload'     => 'show',
        'title'        => esc_html__( 'Archives label', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'Hide or Show like Category Archives, Tag Archives label', 'raindrops' ),
        'validate'     => 'raindrops_archive_title_label_validate',
		'list'         => 81 ),
array( 'option_id'    => 83,
        'blog_id'      => 0,
        'option_name'  => 'raindrops_archive_nav_above',
        'option_value' => 'hide',
        'autoload'     => 'show',
        'title'        => esc_html__( 'Archive Page Top Navigation', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'Hide or Show Blog Archives page top navigation', 'raindrops' ),
        'validate'     => 'raindrops_archive_nav_above_validate',
		'list'         => 82 ),
array( 'option_id'    => 84,
        'blog_id'      => 0,
        'option_name'  => 'raindrops_posted_on_position',
        'option_value' => 'before',
        'autoload'     => 'show',
        'title'        => esc_html__( 'Position of Posted on', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'default before contents', 'raindrops' ),
        'validate'     => 'raindrops_posted_on_position_validate',
		'list'         => 83 ),
array( 'option_id'    => 85,
        'blog_id'      => 0,
        'option_name'  => 'raindrops_posted_in_position',
        'option_value' => 'after',
        'autoload'     => 'show',
        'title'        => esc_html__( 'Position of Posted in', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'default after contents', 'raindrops' ),
        'validate'     => 'raindrops_posted_in_position_validate',
		'list'         => 84 ),
array( 'option_id'    => 86,
        'blog_id'      => 0,
        'option_name'  => 'raindrops_fallback_image_for_entry_content',
        'option_value' => get_template_directory_uri().'/images/image-not-found.png',
        'autoload'     => 'show',
        'title'        => esc_html__( 'Fallback Image for Entry Content', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'Image, to display an alternative image if that can not be displayed', 'raindrops' ),
        'validate'     => 'raindrops_fallback_image_for_entry_content_validate',
		'list'         => 85 ),
array( 'option_id'    => 87,
        'blog_id'      => 0,
        'option_name'  => 'raindrops_custom_footer_credit',
        'option_value' => false,
        'autoload'     => 'show',
        'title'        => esc_html__( 'Custom Footer Credit', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'Show your custom footer credit when anything input. You can use element address, span, a, br,img, %current_year% (replase current year )', 'raindrops' ),
        'validate'     => 'raindrops_custom_footer_credit_validate',
		'list'         => 86 ),
array( 'option_id'    => 88,
        'blog_id'      => 0,
        'option_name'  => "raindrops_sidebar_pdf_archive",
        'option_value' => '3',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Attachment Page PDF Columns', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'value 1-3. default 3', 'raindrops' ),
        'validate'     => 'raindrops_sidebar_pdf_archive_validate',
		'list'         => 87 ),
array( 'option_id'    => 89,
        'blog_id'      => 0,
        'option_name'  => "raindrops_primary_menu_responsive",
        'option_value' => 'yes',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Primary Menu Automatic Responsive', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'value yes or no. default yes', 'raindrops' ),
        'validate'     => 'raindrops_primary_menu_responsive_validate',
		'list'         => 88 ),
array( 'option_id'    => 90,
        'blog_id'      => 0,
        'option_name'  => "raindrops_tooltip",
        'option_value' => 'yes',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Tooltip', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'Enable Tooltip. value yes or no. default yes', 'raindrops' ),
        'validate'     => 'raindrops_tooltip_validate',
		'list'         => 89 ),
array( 'option_id'    => 91,
        'blog_id'      => 0,
        'option_name'  => "raindrops_display_site_title",
        'option_value' => 'show',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Display Site Title Text', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'value show, hide. default show', 'raindrops' ),
        'validate'     => 'raindrops_display_site_title_validate',
		'list'         => 90 ),
array( 'option_id'    => 92,
        'blog_id'      => 0,
        'option_name'  => "raindrops_sidebar_format_link_archive",
        'option_value' => '3',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Archives Post Format link Columns', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'value 1-3. default 3', 'raindrops' ),
        'validate'     => 'raindrops_sidebar_format_link_archive_validate',
		'list'         => 91 ),
array( 'option_id'    => 93,
        'blog_id'      => 0,
        'option_name'  => "raindrops_sidebar_format_image_archive",
        'option_value' => '3',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Archives Post Format Image Columns', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'value 1-3. default 3', 'raindrops' ),
        'validate'     => 'raindrops_sidebar_format_image_archive_validate',
		'list'         => 92 ),
array( 'option_id'    => 94,
        'blog_id'      => 0,
        'option_name'  => "raindrops_sidebar_format_quote_archive",
        'option_value' => '3',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Archives Post Format Quote Columns', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'value 1-3. default 3', 'raindrops' ),
        'validate'     => 'raindrops_sidebar_format_quote_archive_validate',
		'list'         => 93 ),
array( 'option_id'    => 95,
        'blog_id'      => 0,
        'option_name'  => "raindrops_sidebar_format_status_archive",
        'option_value' => '3',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Archives Post Format Status Columns', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'value 1-3. default 3', 'raindrops' ),
        'validate'     => 'raindrops_sidebar_format_status_archive_validate',
		'list'         => 94 ),
array( 'option_id'    => 96,
        'blog_id'      => 0,
        'option_name'  => "raindrops_sidebar_format_video_archive",
        'option_value' => '3',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Archives Post Format Video Columns', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'value 1-3. default 3', 'raindrops' ),
        'validate'     => 'raindrops_sidebar_format_video_archive_validate',
		'list'         => 95 ),
array( 'option_id'    => 97,
        'blog_id'      => 0,
        'option_name'  => "raindrops_sidebar_format_audio_archive",
        'option_value' => '3',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Archives Post Format Audio Columns', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'value 1-3. default 3', 'raindrops' ),
        'validate'     => 'raindrops_sidebar_format_audio_archive_validate',
		'list'         => 96 ),
array( 'option_id'    => 98,
        'blog_id'      => 0,
        'option_name'  => "raindrops_sidebar_format_gallery_archive",
        'option_value' => '3',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Archives Post Format Galley Columns', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'value 1-3. default 3', 'raindrops' ),
        'validate'     => 'raindrops_sidebar_format_gallery_archive_validate',
		'list'         => 97 ),
array( 'option_id'    => 99,
        'blog_id'      => 0,
        'option_name'  => "raindrops_sidebar_format_chat_archive",
        'option_value' => '3',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Archives Post Format Chat Columns', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'value 1-3. default 3', 'raindrops' ),
        'validate'     => 'raindrops_sidebar_format_chat_archive_validate',
		'list'         => 98 ),
array( 'option_id'    => 100,
        'blog_id'      => 0,
        'option_name'  => "raindrops_sidebar_format_aside_archive",
        'option_value' => '3',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Archives Post Format Aside Columns', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'value 1-3. default 3', 'raindrops' ),
        'validate'     => 'raindrops_sidebar_format_aside_archive_validate',
		'list'         => 99 ),
array( 'option_id'    => 101,
        'blog_id'      => 0,
        'option_name'  => "raindrops_sidebar_posts_page",
        'option_value' => '3',
        'autoload'     => 'yes',
        'title'        => esc_html__( 'Static Front Page / Posts page ', 'raindrops' ),
        'excerpt1'     => '',
        'excerpt2'     => esc_html__( 'value 1-3. default 3', 'raindrops' ),
        'validate'     => 'raindrops_sidebar_posts_page_validate',
		'list'         => 100 ),
);
}

if ( ! isset( $raindrops_base_setting ) ) {

    $raindrops_base_setting = $raindrops_base_setting_args;
}
/**
 * RAINDROPS_COLOR_SCHEME
 *
 *
 *
 *
 */
if( ! isset( $raindrops_color_ja ) ) {
	$raindrops_color_ja     = array( __( 'none', 'raindrops' ) => "", __( 'toki', 'raindrops' ) => "#F9A1D0", __( 'tutuji', 'raindrops' ) => "#CB4B94", __( 'sakura', 'raindrops' ) => "#FFDBED", __( 'bara', 'raindrops' ) => "#D34778", __( 'karakurenai', 'raindrops' ) => "#E3557F", __( 'sango', 'raindrops' ) => "#FF87A0", __( 'koubai', 'raindrops' ) => "#E08899", __( 'momo', 'raindrops' ) => "#E38698", __( 'beni', 'raindrops' ) => "#BD1E48", __( 'beniaka', 'raindrops' ) => "#B92946", __( 'enji', 'raindrops' ) => "#AE3846", __( 'suou', 'raindrops' ) => "#974B52", __( 'akane', 'raindrops' ) => "#A0283A", __( 'aka', 'raindrops' ) => "#BF1E33", __( 'syu', 'raindrops' ) => "#ED514E", __( 'benikaba', 'raindrops' ) => "#A14641", __( 'benihi', 'raindrops' ) => "#EE5145", __( 'entan', 'raindrops' ) => "#D3503C", __( 'beniebitya', 'raindrops' ) => "#703B32", __( 'tobi', 'raindrops' ) => "#7D483E", __( 'azuki', 'raindrops' ) => "#946259", __( 'bengara', 'raindrops' ) => "#8A4031", __( 'ebitya', 'raindrops' ) => "#6D3D33", __( 'kinaka', 'raindrops' ) => "#ED542A", __( 'akatya', 'raindrops' ) => "#B15237", __( 'akasabi', 'raindrops' ) => "#923A21", __( 'ouni', 'raindrops' ) => "#EF6D3E", __( 'sekitou', 'raindrops' ) => "#ED551B", __( 'kaki', 'raindrops' ) => "#E06030", __( 'nikkei', 'raindrops' ) => "#B97761", __( 'kaba', 'raindrops' ) => "#BD4A1D", __( 'renga', 'raindrops' ) => "#974E33", __( 'sabi', 'raindrops' ) => "#664134", __( 'hiwada', 'raindrops' ) => "#8A604F", __( 'kuri', 'raindrops' ) => "#754C38", __( 'kiaka', 'raindrops' ) => "#E45E00", __( 'taisya', 'raindrops' ) => "#BA6432", __( 'rakuda', 'raindrops' ) => "#B67A52", __( 'kitye', 'raindrops' ) => "#BB6421", __( 'hadairo', 'raindrops' ) => "#F4BE9B", __( 'daidai', 'raindrops' ) => "#FD7E00", __( 'haitya', 'raindrops' ) => "#866955", __( 'tya', 'raindrops' ) => "#734E30", __( 'kogetya', 'raindrops' ) => "#594639", __( 'kouji', 'raindrops' ) => "#FFA75E", __( 'anzu', 'raindrops' ) => "#DDA273", __( 'mikan', 'raindrops' ) => "#FA8000", __( 'kassyoku', 'raindrops' ) => "#763900", __( 'tutiiro', 'raindrops' ) => "#A96E2D", __( 'komugi', 'raindrops' ) => "#D9A46D", __( 'kohaku', 'raindrops' ) => "#C67400", __( 'kintya', 'raindrops' ) => "#C47600", __( 'tamago', 'raindrops' ) => "#FABE6F", __( 'yamabuki', 'raindrops' ) => "#FFA500", __( 'oudo', 'raindrops' ) => "#C18A39", __( 'kutiba', 'raindrops' ) => "#897868", __( 'himawari', 'raindrops' ) => "#FFB500", __( 'ukon', 'raindrops' ) => "#FCAC00", __( 'suna', 'raindrops' ) => "#C9B9A8", __( 'karasi', 'raindrops' ) => "#CDA966", __( 'ki', 'raindrops' ) => "#FFBE00", __( 'tanpopo', 'raindrops' ) => "#FFBE00", __( 'uguisutya', 'raindrops' ) => "#70613A", __( 'tyuki', 'raindrops' ) => "#FAD43A", __( 'kariyasu', 'raindrops' ) => "#EED67E", __( 'kihada', 'raindrops' ) => "#D9CB65", __( 'miru', 'raindrops' ) => "#736F55", __( 'biwa', 'raindrops' ) => "#C2C05C", __( 'uguisu', 'raindrops' ) => "#71714A", __( 'mattya', 'raindrops' ) => "#BDBF92", __( 'kimidori', 'raindrops' ) => "#B9C42F", __( 'koke', 'raindrops' ) => "#7A7F46", __( 'wakakusa', 'raindrops' ) => "#A9B735", __( 'moegi', 'raindrops' ) => "#96AA3D", __( 'kusa', 'raindrops' ) => "#72814B", __( 'wakaba', 'raindrops' ) => "#AFC297", __( 'matuba', 'raindrops' ) => "#6E815C", __( 'byakuroku', 'raindrops' ) => "#CADBCF", __( 'midori', 'raindrops' ) => "#4DB56A", __( 'tokiwa', 'raindrops' ) => "#357C4C", __( 'rokusyou', 'raindrops' ) => "#5F836D", __( 'titosemidori', 'raindrops' ) => "#4A6956", __( 'fukamidori', 'raindrops' ) => "#005731", __( 'moegi', 'raindrops' ) => "#15543B", __( 'wakatake', 'raindrops' ) => "#49A581", __( 'seiji', 'raindrops' ) => "#80AA9F", __( 'aotake', 'raindrops' ) => "#7AAAAC", __( 'tetu', 'raindrops' ) => "#244344", __( 'aomidori', 'raindrops' ) => "#0090A8", __( 'sabiasagi', 'raindrops' ) => "#6C8D9B", __( 'mizuasagi', 'raindrops' ) => "#7A99AA", __( 'sinbasi', 'raindrops' ) => "#69AAC6", __( 'asagi', 'raindrops' ) => "#0087AA", __( 'byakugun', 'raindrops' ) => "#84B5CF", __( 'nando', 'raindrops' ) => "#166A88", __( 'kamenozoki', 'raindrops' ) => "#8CB4CE", __( 'mizu', 'raindrops' ) => "#A9CEEC", __( 'ainezu', 'raindrops' ) => "#5E7184", __( 'sora', 'raindrops' ) => "#95C0EC", __( 'ao', 'raindrops' ) => "#0067C0", __( 'ai', 'raindrops' ) => "#2E4B71", __( 'koiai', 'raindrops' ) => "#20324E", __( 'wasurenagusa', 'raindrops' ) => "#92AFE4", __( 'tuyukusa', 'raindrops' ) => "#3D7CCE", __( 'hanada', 'raindrops' ) => "#3C639B", __( 'konjou', 'raindrops' ) => "#3D496B", __( 'ruri', 'raindrops' ) => "#3451A4", __( 'rurikon', 'raindrops' ) => "#324784", __( 'kon', 'raindrops' ) => "#333C5E", __( 'kakitubata', 'raindrops' ) => "#4C5DAB", __( 'kati', 'raindrops' ) => "#383C57", __( 'gunjou', 'raindrops' ) => "#414FA3", __( 'tetukon', 'raindrops' ) => "#232538", __( 'fujinando', 'raindrops' ) => "#6869A8", __( 'kikyou', 'raindrops' ) => "#4A49AD", __( 'konai', 'raindrops' ) => "#35357D", __( 'fuji', 'raindrops' ) => "#A09BD8", __( 'fujimurasaki', 'raindrops' ) => "#948BDB", __( 'aomurasaki', 'raindrops' ) => "#704CBC", __( 'sumire', 'raindrops' ) => "#6D52AB", __( 'hatoba', 'raindrops' ) => "#675D7E", __( 'syoubu', 'raindrops' ) => "#7051AA", __( 'edomurasaki', 'raindrops' ) => "#5F4C86", __( 'murasaki', 'raindrops' ) => "#A260BF", __( 'kodaimurasaki', 'raindrops' ) => "#775686", __( 'nasukon', 'raindrops' ) => "#47384F", __( 'sikon', 'raindrops' ) => "#402949", __( 'ayame', 'raindrops' ) => "#C27BC8", __( 'botan', 'raindrops' ) => "#C24DAE", __( 'akamurasaki', 'raindrops' ) => "#C54EA0", __( 'siro', 'raindrops' ) => "#F1F1F1", __( 'gofun', 'raindrops' ) => "#F2E8EC", __( 'kinari', 'raindrops' ) => "#F0E2E0", __( 'zouge', 'raindrops' ) => "#E3D4CA", __( 'ginnezu', 'raindrops' ) => "#A0A0A0", __( 'tyanezumi', 'raindrops' ) => "#9F9190", __( 'nezumi', 'raindrops' ) => "#868686", __( 'rikyunezumi', 'raindrops' ) => "#787C7A", __( 'namari', 'raindrops' ) => "#797A88", __( 'hai', 'raindrops' ) => "#797979", __( 'susutake', 'raindrops' ) => "#605448", __( 'kurotya', 'raindrops' ) => "#3E2E28", __( 'sumi', 'raindrops' ) => "#313131", __( 'kuro', 'raindrops' ) => "#262626", __( 'tetukuro', 'raindrops' ) => "#262626" );
}
if( ! isset( $raindrops_color_en_140 ) ) {
	$raindrops_color_en_140 = array( "none" => "", "white" => "#ffffff", "whitesmoke" => "#f5f5f5", "gainsboro" => "#dcdcdc", "lightgrey" => "#d3d3d3", "silver" => "#c0c0c0", "darkgray" => "#a9a9a9", "gray" => "#808080", "dimgray" => "#696969", "black" => "#000000", "red" => "#ff0000", "orangered" => "#ff4500", "tomato" => "#ff6347", "coral" => "#ff7f50", "salmon" => "#fa8072", "lightsalmon" => "#ffa07a", "darksalmon" => "#e9967a", "peru" => "#cd853f", "saddlebrown" => "#8b4513", "sienna" => "#a0522d", "chocolate" => "#d2691e", "sandybrown" => "#f4a460", "darkred" => "#8b0000", "maroon" => "#800000", "brown" => "#a52a2a", "firebrick" => "#b22222", "crimson" => "#dc143c", "indianred" => "#cd5c5c", "lightcoral" => "#f08080", "rosybrown" => "#bc8f8f", "palevioletred" => "#db7093", "deeppink" => "#ff1493", "hotpink" => "#ff69b4", "lightpink" => "#ffb6c1", "pink" => "#ffc0cb", "mistyrose" => "#ffe4e1", "linen" => "#faf0e6", "seashell" => "#fff5ee", "lavenderblush" => "#fff0f5", "snow" => "#fffafa", "yellow" => "#ffff00", "gold" => "#ffd700", "orange" => "#ffa500", "darkorange" => "#ff8c00", "goldenrod" => "#daa520", "darkgoldenrod" => "#b8860b", "darkkhaki" => "#bdb76b", "burlywood" => "#deb887", "tan" => "#d2b48c", "khaki" => "#f0e68c", "peachpuff" => "#ffdab9", "navajowhite" => "#ffdead", "palegoldenrod" => "#eee8aa", "moccasin" => "#ffe4b5", "wheat" => "#f5deb3", "bisque" => "#ffe4c4", "blanchedalmond" => "#ffebcd", "papayawhip" => "#ffefd5", "cornsilk" => "#fff8dc", "lightyellow" => "#ffffe0", "lightgoldenrodyellow" => "#fafad2", "lemonchiffon" => "#fffacd", "antiquewhite" => "#faebd7", "beige" => "#f5f5dc", "oldlace" => "#fdf5e6", "ivory" => "#fffff0", "floralwhite" => "#fffaf0", "greenyellow" => "#adff2f", "yellowgreen" => "#9acd32", "olive" => "#808000", "darkolivegreen" => "#556b2f", "olivedrab" => "#6b8e23", "chartreuse" => "#7fff00", "lawngreen" => "#7cfc00", "lime" => "#00ff00", "limegreen" => "#32cd32", "forestgreen" => "#228b22", "green" => "#008000", "darkgreen" => "#006400", "seagreen" => "#2e8b57", "mediumseagreen" => "#3cb371", "darkseagreen" => "#8fbc8f", "lightgreen" => "#90ee90", "palegreen" => "#98fb98", "springgreen" => "#00ff7f", "mediumspringgreen" => "#00fa9a", "honeydew" => "#f0fff0", "mintcream" => "#f5fffa", "azure" => "#f0ffff", "lightcyan" => "#e0ffff", "aliceblue" => "#f0f8ff", "darkslategray" => "#2f4f4f", "steelblue" => "#4682b4", "mediumaquamarine" => "#66cdaa", "aquamarine" => "#7fffd4", "mediumturquoise" => "#48d1cc", "turquoise" => "#40e0d0", "lightseagreen" => "#20b2aa", "darkcyan" => "#008b8b", "teal" => "#008080", "cadetblue" => "#5f9ea0", "darkturquoise" => "#00ced1", "aqua" => "#00ffff", "cyan" => "#00ffff", "lightblue" => "#add8e6", "powderblue" => "#b0e0e6", "paleturquoise" => "#afeeee", "skyblue" => "#87ceeb", "lightskyblue" => "#87cefa", "deepskyblue" => "#00bfff", "dodgerblue" => "#1e90ff", "ghostwhite" => "#f8f8ff", "lavender" => "#e6e6fa", "lightsteelblue" => "#b0c4de", "slategray" => "#708090", "lightslategray" => "#778899", "indigo" => "#4b0082", "darkslateblue" => "#483d8b", "midnightblue" => "#191970", "navy" => "#000080", "darkblue" => "#00008b", "slateblue" => "#6a5acd", "mediumslateblue" => "#7b68ee", "cornflowerblue" => "#6495ed", "royalblue" => "#4169e1", "mediumblue" => "#0000cd", "blue" => "#0000ff", "thistle" => "#d8bfd8", "plum" => "#dda0dd", "orchid" => "#da70d6", "violet" => "#ee82ee", "fuchsia" => "#ff00ff", "magenta" => "#ff00ff", "mediumpurple" => "#9370db", "mediumorchid" => "#ba55d3", "darkorchid" => "#9932cc", "blueviolet" => "#8a2be2", "darkviolet" => "#9400d3", "purple" => "#800080", "darkmagenta" => "#8b008b", "mediumvioletred" => "#c71585" );
}
if( ! isset( $raindrops_color_en ) ) {
	$raindrops_color_en     = array( "none" => "", "american red" => "#bf0a30", "american blue" => "#002868", "american green" => "#006e53", "american yellow" => "#deb301", "american light blue" => "#cbddf3", "american brown" => "#9a6b37", "american gray" => "#afafb1", "glory red" => "#cc0033", "glory blue" => "#0000ff", "glory white" => "#fff9f5", "big apple red" => "#ff6331", "big apple blue" => "#3131ce", "empire blue" => "#001873", "empire cyan" => "#00b5d6", "empire red" => "#d60000", "empire yellow" => "#f7f700", "empire orange" => "#f79429", "empire green" => "#084a29", "empire ebony" => "#424a00", "natural red" => "#cc0033", "natural blue" => "#000099", "natural light blue" => "#84c8ef", "natural green" => "#90c924", "natural orange" => "#f39234", "natural brown" => "#843a2f", "natural gray" => "#bfbfbf", "hawkeye red" => "#e3003d", "hawkeye blue" => "#3c3c9e", "hawkeye yellow" => "#ffb30f", "hawkeye brown" => "#a54a00", "frontier blue" => "#000080", "frontier light blue" => "#d3eef7", "frontier green" => "#024900", "frontier yellow" => "#ffff00", "frontier purple" => "#8663bd", "dixie red" => "#b10021", "dixie blue" => "#083152", "dixie green" => "#105a21", "dixie yellow" => "#ffc621", "grand canyon blue" => "#002868", "grand canyon red" => "#bf0a30", "grand canyon brown" => "#ce5c17", "grand canyon yellow" => "#fed700", "grand canyon green" => "#00320b", "grand canyon pink" => "#efc1a9", "lincoln red" => "#e2184f", "lincoln pink" => "#e24a4f", "lincoln light blue" => "#64b4ff", "lincoln blue" => "#3c3c9e", "lincoln green" => "#3f863f", "lincoln yellow" => "#ffe60f", "lincoln orange" => "#ffb316", "hoosier blue" => "#101195", "hoosier yellow" => "#ffe700", "hoosier green" => "#197351", "hoosier brown" => "#563837", "badger blue" => "#002986", "badger light blue" => "#00b2fd", "badger pink" => "#f8b8de", "badger red" => "#f3334b", "badger green" => "#41ad16", "badger yellow" => "#ffe618", "badger brown" => "#66180b", "badger gray" => "#a2b9b9", "mountain red" => "#ff3516", "mountain blue" => "#003776", "mountain green" => "#20d942", "mountain yellow" => "#ffb30f", "mountain brown" => "#d15b25", "mountain gray" => "#c0c0c0", "sooner blue" => "#0e4892", "sooner light blue" => "#00adc6", "sooner green" => "#1b692b", "sooner opal" => "#8ab87a", "sooner yellow" => "#f0c016", "sooner brown" => "#421000", "sooner beige" => "#ffc69c", "sooner gray" => "#d6c6c6", "sooner black" => "#454442", "buckeye blue" => "#1a3b86", "buckeye red" => "#ff0000", "buckeye green" => "#00784b", "buckeye yellow" => "#f8c300", "buckeye brown" => "#4e3330", "buckeye light blue" => "#027bc2", "beaver blue" => "#002a86", "beaver yellow" => "#ffea0f", "golden red" => "#c10435", "golden green" => "#007e3a", "golden brown" => "#391800", "golden yellow" => "#bc8e07", "golden cyan" => "#40a7aa", "golden gray" => "#84948e", "sunflower blue" => "#00009c", "sunflower light blue" => "#0092df", "sunflower green" => "#29b910", "sunflower orange" => "#ff660f", "sunflower brown" => "#b34e20", "sunflower purple" => "#7c4790", "sunflower yellow" => "#ffe400", "sunflower gray" => "#dedede", "new england" => "#e25c5c", "midatlantic" => "#5c7a7a", "south" => "#8a84a3", "florida" => "#e9bda2", "midwest" => "#ffd577", "texas" => "#77cbb3", "great plains" => "#b6bc4d", "rocky mountain" => "#e9df25", "southwest" => "#ee2222", "california" => "#e0fa92", "pacific northwest" => "#38911c", "alaska" => "#d09440", "hawaii" => "#4f93c0", "mountains alabama" => "#999966", "metropolitan alabama" => "#ff9933", "river heritage alabama" => "#996699", "gulf coast alabama" => "#99cccc", "southern california" => "#e03030", "california desert" => "#e0b000", "california central coast" => "#00b000", "san joaquin valley" => "#a0a0c0", "sacramento valley" => "#e0b000", "sierra nevada" => "#00e000", "gold country" => "#e0e000", "bay area california" => "#e06060", "california north coast" => "#b0b000", "shasta cascades" => "#e03030", "mississippi capital river" => "#336699", "mississippi delta" => "#663366", "mississippi pines" => "#339966", "gulf coast mississippi" => "#660033", "mississippi hills" => "#996633", "panhandle nebraska" => "#cc9966", "north central nebraska" => "#cccc66", "eastern nebraska" => "#99cccc", "western nevada" => "#cc9999", "northern nevada" => "#cc9966", "central nevada" => "#9999cc", "southern nevada" => "#99cccc", "central new mexico" => "#e0fa92", "north central new mexico" => "#6699aa", "northeast new mexico" => "#b6bc4d", "northwest new mexico" => "#d09440", "southwest new mexico" => "#b2cc7f", "southeast new mexico" => "#ffff99", "northwest ohio" => "#666633", "northeast ohio" => "#669999", "midohio" => "#996666", "southwest ohio" => "#666699", "southeast ohio" => "#cc9933", "western tennessee" => "#996699", "central tennessee" => "#339999", "eastern tennessee" => "#339966", "panhandle texas" => "#80622f", "prairies and lakes" => "#335c64", "piney woods" => "#406324", "gulf coast texas" => "#7895a3", "south texas plains" => "#7d6b71", "hill country" => "#d1a85e", "big bend country" => "#c6ab7a", "wasatch front" => "#99cc33", "canyon country" => "#cc6600", "northeastern utah" => "#669900", "dixie" => "#b2cc7f", "central utah" => "#999933", "western utah" => "#ffff99", "northern virginia" => "#9966ff", "eastern virginia" => "#33bbee", "central virginia" => "#ff6655", "southwest virginia" => "#ffcc33", "shenandoah valley" => "#339933", "southeast wisconsin" => "#66cc99", "southwest wisconsin" => "#99ccff", "northeast wisconsin" => "#009999", "north central wisconsin" => "#66ccff", "northwest wisconsin" => "#99cccc" );
//@see:http://www.nekomataya.info/teck_info/taiyo_color
}
if( ! isset( $raindrops_color_anime ) ) {
	$raindrops_color_anime  = array( "bl" => "#110f11", "lb9" => "#1d1f29", "bb" => "#1c232b", "bl1" => "#283039", "10" => "#3c4249", "20" => "#4f5760", "30" => "#566169", "40" => "#66717a", "50" => "#717d87", "60" => "#7e8b94", "70" => "#8e9ba2", "80" => "#a5b3b8", "90" => "#b3c0c7", "95" => "#c2cdce", "100" => "#d2dad4", "w" => "#efefe2", "700g" => "#23262a", "600g" => "#2f2f39", "500g" => "#343649", "180g" => "#384156", "400g" => "#42435a", "300g" => "#5b5f73", "200g" => "#74798f", "99g" => "#909aae", "100g" => "#8fa4b9", "90g" => "#a5b5bf", "pb20" => "#2854a9", "cb6" => "#002289", "cb20" => "#0051b5", "cb30" => "#1160c0", "cb40" => "#3877c9", "cb50" => "#5a90d7", "cb60" => "#73a3d6", "cb80" => "#99badc", "cb90" => "#b3ccdc", "cb95" => "#cbdae0", "cb0" => "#d7e1e0", "nr0-1" => "#1b232c", "nr0" => "#222e40", "nr1" => "#303e62", "nr2" => "#41547a", "nr3" => "#4c6189", "nr4" => "#586f96", "nr5" => "#7694b0", "nr6" => "#8ba5c2", "bg6" => "#113f40", "144m" => "#007069", "tbg7" => "#2d9a9a", "bg5" => "#074b4f", "145m" => "#266966", "133m" => "#4e9d91", "x13" => "#005d71", "166m" => "#007589", "aa-7" => "#00adba", "bg16" => "#008f9b", "bg15" => "#00a5a8", "bg14" => "#4ebfc6", "o-01" => "#a1d4cb", "n13" => "#006074", "167m" => "#266372", "165m" => "#25808e", "c15" => "#3c8e98", "x4m" => "#2f5560", "x2m" => "#498291", "bg45" => "#009694", "bg85" => "#5cc2bd", "bg95" => "#a6dbcd", "n12" => "#003246", "n10" => "#004b67", "bs4" => "#00627b", "bs3" => "#008da5", "bs2" => "#2096ac", "bs1" => "#42b8c9", "bs-01" => "#7ec6ce", "b10" => "#004275", "b20" => "#0071a4", "b30" => "#0093c8", "b40" => "#009dcb", "b60" => "#20aed2", "b80" => "#70c7db", "b90" => "#a5d8dc", "b95" => "#badfdd", "n8" => "#0068a5", "n75" => "#007abd", "n7" => "#008dc7", "n6" => "#0097ce", "n4" => "#00a1d1", "n3" => "#42b5d5", "n2" => "#78c5ce", "cb10" => "#24354e", "a02" => "#4a6282", "a01" => "#6285ae", "bu5" => "#507fac", "bu4" => "#72a3c6", "gr6a" => "#99bcc7", "anr2" => "#1b4a76", "bu3" => "#245a81", "b36" => "#0051a7", "b37" => "#0063b2", "blue2" => "#007ec0", "bu2" => "#348fbb", "o" => "#89bfdb", "grb1" => "#a8cbdb", "bg20m" => "#455c60", "bg40m" => "#577977", "bg60m" => "#719a96", "bg70m" => "#82a9a2", "bg80m" => "#94bbaf", "bg90m" => "#b1cec1", "bw" => "#d1e7d8", "aw" => "#dfebdc", "yr10m" => "#4b3c38", "yr20m" => "#5f463d", "yr40m" => "#755549", "yr50m" => "#856757", "yr60m" => "#9e7d66", "yr2" => "#b1987f", "yr1" => "#cbb49c", "yr0" => "#dccbb5", "yr90m" => "#dcb995", "yr95m" => "#ddc3a2", "8a" => "#7c7e7e", "7a" => "#8b8d8c", "6a" => "#9d9f9d", "5a" => "#abaca9", "4a" => "#c4c1b8", "1a" => "#d2d2cb", "gt1" => "#969395", "gm1" => "#aea8a1", "gh3" => "#31292d", "gh2" => "#433d44", "gh1" => "#595058", "gb1" => "#777278", "yr100" => "#332c2a", "yr900" => "#3f3836", "yr28" => "#4e4342", "yr47" => "#5d524f", "yrd" => "#514c4c", "yrc" => "#61544f", "yrb" => "#7a6962", "yra" => "#897867", "yr3a" => "#9a8776", "yr85" => "#92857b", "yrm" => "#393532", "yy10" => "#3a3a39", "y28" => "#464240", "y9" => "#3e392f", "y47" => "#565449", "rb2" => "#7e8167", "rb1" => "#acae80", "yrf" => "#696861", "yre" => "#818377", "td1" => "#9c9b8a", "eb2" => "#595959", "eb1" => "#7b7d78", "et1" => "#969994", "gr6" => "#a7adac", "yr15" => "#774d3c", "yr50" => "#aa6a47", "s45" => "#c07d51", "lo1" => "#df8d5e", "mo1" => "#f8ae82", "ek55" => "#bc896b", "ek33" => "#f1ae87", "sm1" => "#fec89e", "sm3" => "#f8c5a5", "d50" => "#8d5b3f", "d40" => "#c0764e", "d30" => "#d7945d", "d20" => "#e9a472", "d1" => "#edb285", "d10" => "#e7b18a", "d0" => "#e7cfae", "63m" => "#6a4f3f", "bc60" => "#846b5b", "ek44" => "#c0a685", "tt2" => "#99927b", "tt1" => "#bcae93", "tm1" => "#d3c59f", "r20m" => "#674241", "r30m" => "#825453", "r40m" => "#8f554e", "r55m" => "#b76356", "r65m" => "#c77d70", "r70m" => "#d98778", "r75m" => "#df907e", "r80m" => "#f3ab94", "s1" => "#f2b8a4", "r90m" => "#f7bfae", "b35" => "#fa9b87", "bc9" => "#fcaf96", "b34" => "#f8b9a4", "11" => "#f3d4c5", "b32" => "#f4b497", "bc2" => "#f6ba9d", "bc20" => "#fabfa5", "bc0" => "#f9c6ad", "x20" => "#f1cfb5", "12" => "#f5dac9", "s20" => "#feb190", "s0" => "#f8c4a5", "x19" => "#f4caac", "13" => "#f6d2bd", "hb" => "#f1d4bb", "14" => "#f6ddc7", "s40" => "#db805a", "s3" => "#fba485", "c6" => "#7d4a36", "c5" => "#8c5341", "c4" => "#ab714c", "c3" => "#b88051", "c35" => "#c18b64", "c43" => "#ce9863", "yr75m" => "#c0844e", "c37" => "#cd9d6e", "c32" => "#e2bc8e", "ek44" => "#c5aa84", "c1a" => "#f0d2a3", "yr15m" => "#44342f", "yr25m" => "#563e32", "65m" => "#805842", "67m" => "#a16e4b", "69m" => "#cda36d", "bc1" => "#f5d7a7", "c0" => "#eee0c0", "bc01" => "#e4d2b3", "sf" => "#ece9cd", "sfm" => "#efecd3", "52" => "#50332d", "42" => "#5d342a", "45" => "#953c26", "46" => "#b24926", "or4" => "#d05c2b", "or3" => "#fc742a", "or2" => "#fe8a4f", "or1" => "#ffb56e", "yr20" => "#674032", "y8" => "#8d5134", "yr30" => "#ac4c35", "yr60" => "#c9633c", "yr65" => "#ee5e00", "d2" => "#fd803a", "yr75" => "#f28c4d", "yr80" => "#ffa157", "yr95" => "#ffba73", "s5" => "#feb973", "yr90" => "#deb87e", "c54" => "#e09d71", "bf40" => "#9f613e", "c70" => "#77452b", "c50" => "#915631", "yr70m" => "#b4845e", "yr80m" => "#d4a775", "yr90m" => "#dcb996", "yr95m" => "#ddc3a2", "y95" => "#eedf00", "y7" => "#886232", "y6" => "#b07727", "e2" => "#ce943d", "e34" => "#ffb347", "s6(old)" => "#ffc875", "x16" => "#ffc720", "s6" => "#ffcc59", "x18" => "#fdda7e", "d8" => "#4a3d30", "d6" => "#6f5135", "d4" => "#a26e40", "d3" => "#b9702b", "d04" => "#a6690d", "y50" => "#ee9611", "y85" => "#ffaf13", "f2" => "#fece20", "f32" => "#f8e473", "f31" => "#f0eab2", "f30" => "#f3e5be", "b7" => "#5e2923", "hb4" => "#8f2b1f", "bo6" => "#a94d2b", "bo5" => "#a83c26", "bo4" => "#be5e2a", "bo3" => "#ce6f30", "bo2" => "#fd871c", "bo1" => "#ffa100", "fd80" => "#8e6742", "aa5" => "#a57349", "c5a" => "#8a5a34", "pf1" => "#ab723b", "tpb1" => "#da9f53", "d1a" => "#dfa75e", "e30" => "#d3a047", "89" => "#d4a149", "aa4" => "#d3a454", "e70" => "#2e3128", "e60" => "#464027", "e5" => "#5d4f31", "e6" => "#836b40", "e4" => "#9c783b", "e3" => "#9e7f2e", "88" => "#c9b14d", "87" => "#d7bf65", "y136" => "#746638", "90m" => "#90753e", "89m" => "#c0a058", "ae1" => "#ad996f", "y91" => "#c3a569", "y92" => "#d1b26b", "e1" => "#e0c27d", "y10" => "#433931", "y20" => "#594638", "y40" => "#7a5d3f", "y60" => "#b88d2c", "y80" => "#cea645", "y70" => "#e0b800", "y90" => "#fdd010", "aa10" => "#916247", "cr25" => "#9c6a51", "bc57" => "#a67c64", "bc55" => "#ad866e", "bc47" => "#bb947c", "bc37" => "#ad8d75", "bc46" => "#be9d84", "bc45" => "#c7ad97", "bc10" => "#dbb49c", "cr5" => "#5a342c", "cr4" => "#784a3c", "cr3" => "#88503d", "cr2" => "#be7459", "cr1" => "#ce9276", "cr0" => "#d6ae94", "so19" => "#a67d6f", "so18" => "#ba8d7b", "pe2" => "#965d65", "pe1" => "#b9777f", "pn2" => "#956a66", "pn1" => "#be8680", "pfl2" => "#ab746d", "pfl1" => "#c6968b", "cfl2" => "#a36f62", "cfl1" => "#d19b87", "bc11" => "#d89e8b", "b81" => "#3b2928", "b9" => "#6f362e", "b7" => "#59271e", "b6" => "#7a322b", "821" => "#c7795b", "b5" => "#d72f2a", "b4" => "#e04236", "b3" => "#e75a4c", "b1" => "#ef7d71", "ps1" => "#c8433b", "td2" => "#904d3a", "afc" => "#a45750", "om4" => "#e66855", "r75" => "#f19175", "af1" => "#f28978", "cr30" => "#a05638", "yr40" => "#ad5c3d", "41-0m" => "#201d1f", "41m" => "#332226", "43m" => "#5a3c36", "44m" => "#693d32", "45m" => "#895340", "46m" => "#9f593e", "56n" => "#b37158", "66n" => "#c78f72", "sb80" => "#4e373b", "sb60" => "#6a4c51", "sb40" => "#866363", "sb20" => "#9b7a79", "sb0" => "#b59b97", "sb01" => "#cbb6ad", "rp20m" => "#532d2e", "rp30m" => "#6c3940", "rp40m" => "#974b57", "rp60m" => "#d96b7c", "rp2" => "#e09497", "rp1" => "#edb7b4", "rp0" => "#f0d0c5", "r30" => "#7f2734", "ar20" => "#901e34", "ar10" => "#b64957", "r10" => "#4a2a2d", "x37" => "#563132", "r10a" => "#6f3738", "x14" => "#552527", "aa2" => "#943a34", "30m" => "#7f3934", "26m" => "#a55146", "af1" => "#d26f5d", "r11" => "#251811", "x38" => "#3f2f31", "xr35" => "#534040", "r91" => "#73504e", "r89" => "#886868", "r77" => "#b89c98", "32r" => "#6c534f", "r82" => "#8a7070", "r78" => "#b29e95", "r76" => "#c9bbb2", "r83" => "#7f5750", "r79" => "#91675a", "ap40" => "#4e6db3", "ap60" => "#9b85c2", "ap80" => "#ccbfda", "p80" => "#cabad9", "p90" => "#d6cddd", "p40" => "#2657ab", "p50" => "#4a71be", "p60" => "#6887c4", "p70" => "#929dcf", "np2" => "#acabc6", "apb80" => "#cccbde", "nr12" => "#283459", "nr11" => "#333d6c", "p8(old)" => "#46539b", "pb40" => "#616eb2", "pb60" => "#7e8ac6", "pb70" => "#98a6d4", "pb80" => "#b4bad6", "pb90" => "#c3cbdd", "p8" => "#4b57a1", "p6" => "#6c79bf", "p4" => "#7789c8", "p2" => "#91a8d2", "p1" => "#aeb9d6", "p0" => "#c8cad8", "p01" => "#cbd0d2", "nrq9" => "#252944", "q9" => "#322e54", "q7" => "#3e3667", "p10" => "#625a85", "q5" => "#716691", "q3" => "#928aa8", "q50" => "#514269", "q40" => "#614c71", "q30" => "#7d6993", "q25" => "#8e7da3", "q20" => "#a893af", "q10" => "#bfb1b9", "p20" => "#601377", "v6" => "#352659", "v5" => "#4d3069", "v4" => "#74498a", "v3" => "#745ea4", "v2" => "#9383ba", "v1" => "#c7bcd6", "rp40" => "#9a6695", "rp60" => "#ca92b8", "rp70" => "#d1a2c0", "rp80" => "#e5d3e2", "rp90" => "#e8dae4", "rp95" => "#ebe1dd", "rp99" => "#ece6de", "rp100" => "#eceae0", "x33" => "#432131", "m128" => "#653947", "m127" => "#774956", "m3" => "#512d43", "m2" => "#6e3957", "m126" => "#9c5177", "a4" => "#a7588a", "a3" => "#b675a1", "a20" => "#d294b1", "a1" => "#e1ccdb", "r8" => "#562a58", "r6" => "#73396d", "xr5" => "#91508d", "r4" => "#b577ae", "r2" => "#d1acc8", "aa4" => "#9d83a5", "aa2" => "#be9db5", "aa1" => "#cab5c8", "r11" => "#1a0f11", "21" => "#3c1e21", "rp5" => "#5f2532", "r51" => "#b3214f", "rr5" => "#a74556", "rr4" => "#b86077", "rr3" => "#d99091", "rr2" => "#dd8d96", "rr1" => "#e8abad", "rr0" => "#f0c5bf", "871" => "#ab6e89", "ap2" => "#c390b3", "ap3" => "#c791b6", "ap4" => "#cc9fc1", "rp10" => "#381f2d", "rp20" => "#681e4d", "aa5" => "#a25f8b", "r12" => "#3f1912", "r26" => "#4e1d1c", "r20" => "#70071e", "r25" => "#930016", "r40" => "#d52839", "r70" => "#e75456", "r75" => "#f4876a", "x28" => "#ad002b", "x27" => "#d12b40", "sf4" => "#d93343", "sy4" => "#e75862", "sy3" => "#ee887e", "r5" => "#9c0025", "r1" => "#b8023f", "r3" => "#c1113f", "r7" => "#d7465b", "r50" => "#e38386", "pb6" => "#92002e", "pb4" => "#b74155", "r60" => "#cb6c70", "r80" => "#da8092", "r90" => "#e7a1a7", "ag2" => "#006841", "ag3" => "#008856", "ag4" => "#009e5b", "g11" => "#00372d", "g20" => "#005340", "g40" => "#007647", "g60" => "#00a071", "gt2" => "#27b680", "g80" => "#65c789", "g90" => "#8bd59f", "g90a" => "#9edbb1", "go5" => "#223d29", "go4" => "#3f5337", "go3" => "#596539", "go2" => "#788554", "go1" => "#a6ae7b", "x21" => "#b6c489", "g10b" => "#252c2a", "g10" => "#364132", "gy12" => "#49593f", "gy13" => "#566951", "gy11" => "#657158", "g9" => "#728567", "g8" => "#99b18e", "g7" => "#d6eab3", "gy20" => "#3f5336", "gy40" => "#71764c", "gy3" => "#798941", "g3" => "#7a9b31", "aa6" => "#bcbb55", "i7" => "#1d5429", "x29" => "#407a43", "x30" => "#58955a", "fg90" => "#346c53", "g6" => "#538561", "g4a" => "#63a874", "i6" => "#006a06", "i5" => "#009115", "gy60" => "#4fb42f", "gy80" => "#83c934", "gy90" => "#bbe07b", "x7" => "#242b37", "x6" => "#2f3c49", "x5" => "#334a5a", "x4" => "#4d5e6a", "x3" => "#53727c", "x2" => "#5b8288", "x1" => "#719ca3", "b70m" => "#74979d", "pan-2" => "#6d979f", "pan-1" => "#96bdc1", "o-50" => "#404e5b", "o-40" => "#586c75", "o-30" => "#5f8691", "o-20" => "#65a5af", "o-10" => "#8bc0c3", "ms20" => "#002631", "bg20" => "#00676d", "bg40" => "#008672", "bg60" => "#00a282", "bg80" => "#50c2aa", "bg90" => "#aee0c7" );
}