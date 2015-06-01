<?php
if ( !defined( 'ABSPATH' ) ) {

	exit;
}
/**
 * IDsraindrops_complementary_color_for_title_link
 *
 * raindrops_base_color
 * raindrops_default_fonts_color
 * raindrops_footer_color
 * raindrops_hyperlink_color
 * raindrops_footer_link_color
 * raindrops_style_type
 * raindrops_header_image
 * raindrops_footer_image
 * raindrops_page_width
 * raindrops_col_width
 * raindrops_show_right_sidebar
 * raindrops_right_sidebar_width_percent
 * raindrops_show_menu_primary
 * raindrops_accessibility_settings
 * raindrops_doc_type_settings
 * raindrops_basefont_settings
 * raindrops_fluid_max_width
 * raindrops_complementary_color_for_title_link
 * raindrops_disable_keyboard_focus
 * raindrops_sync_style_for_tinymce
 * raindrops_uninstall_option
 * raindrops_menu_primary_font_size
 * raindrops_menu_primary_min_width
 * raindrops_use_featured_image_emphasis
 * raindrops_featured_image_position
 * raindrops_featured_image_size
 * raindrops_featured_image_recent_post_count
 * raindrops_featured_image_singular
 * raindrops_entry_content_is_home
 * raindrops_entry_content_is_category
 * raindrops_entry_content_is_search
 * raindrops_allow_oembed_excerpt_view
 * raindrops_excerpt_enable
 * raindrops_read_more_after_excerpt
 * raindrops_plugin_presentation_bcn_nav_menu
 * raindrops_japanese_date
 * raindrops_place_of_site_title
 * raindrops_site_title_left_margin
 * raindrops_site_title_top_margin
 * raindrops_site_title_font_size
 * raindrops_site_title_css_class
 * raindrops_tagline_in_the_header_image
 * raindrops_col_setting_type
 * raindrops_sidebar_index
 * raindrops_sidebar_date
 * raindrops_sidebar_page
 * raindrops_sidebar_search
 * raindrops_sidebar_single
 * raindrops_sidebar_404
 * raindrops_sidebar_list_of_post
 */
/**
 * Sections
 * 
 */
	if ( !isset( $raindrops_customize_args ) ) {
		$raindrops_theme_customize_sections = array(
		'raindrops_theme_settings'			 => array( 'title' => esc_html__( 'Color Scheme', 'Raindrops' ), 'priority' => 26, ),
		'raindrops_theme_settings_featured'	 => array( 'title'			 => esc_html__( 'Featured Image', 'Raindrops' ),
			'priority'		 => 40,
			'panel'			 => 'raindrops_theme_settings_presentation_panel',
			'theme_supports' => '',
			'title'			 => esc_html__( 'Featured Image Settings', 'Raindrops' ),
			'description'	 => __( 'Emphasis of new content using the Featured Image', 'Raindrops' ),
			),
		'raindrops_theme_settings_sidebar'	 => array( 
			'title' => esc_html__( 'Layout and Sidebars', 'Raindrops' ), 
			'priority' => 27,
			'panel'			 => 'raindrops_theme_settings_presentation_panel',
			),
		'raindrops_theme_settings_fonts'	 => array( 
			'title' => esc_html__( 'Fonts', 'Raindrops' ), 
			'priority' => 28, 
			'panel'			 => 'raindrops_theme_settings_presentation_panel',
			),
		'raindrops_theme_page_width'	 => array( 
			'title' => esc_html__( 'Page Width', 'Raindrops' ), 
			'priority' => 28, 
			'panel'			 => 'raindrops_theme_settings_presentation_panel',
			),
		'raindrops_theme_settings_document'	 => array( 'title' => esc_html__( 'Advanced', 'Raindrops' ), 'priority' => 24, ),
		'raindrops_theme_settings_content'	 => array( 'title' => esc_html__( 'Excerpt', 'Raindrops' ), 'priority' => 29, ),
		'raindrops_theme_settings_plugins'	 => array( 'title' => esc_html__( 'Add-ons', 'Raindrops' ), 'priority' => 30, ),
		'raindrops_theme_settings_uninstall' => array( 'title' => esc_html__( 'Uninstall Option', 'Raindrops' ), 'priority' => 99, ),
		'raindrops_theme_settings_presentation' => array( 
			'priority' => 25, 
			'panel'			 => 'raindrops_theme_settings_presentation_panel',
			'theme_supports' => '',
			'title'			 => esc_html__( 'Color Scheme', 'Raindrops' ),
			'description'	 => '',
			),
		'raindrops_theme_settings_post' => array( 
			'title' => esc_html__( 'Post Settings', 'Raindrops' ), 
			'priority' => 100, 
			'panel'			 => 'raindrops_theme_settings_presentation_panel',
			'theme_supports' => '',
			'description'	 => esc_html__( 'The following changes are made using the CSS', 'Raindrops' ),
			),
	);
/**
 * Panels
 * 
 */
	$raindrops_theme_customize_panels = array(
		'raindrops_theme_settings_featured_panel' => array( 'priority'		 => 40,
			'capability'	 => $raindrops_customize_cap,
			'theme_supports' => '',
			'title'			 => __( 'Featured Image', 'Raindrops' ),
			'description'	 => __( 'Emphasis of new content using the Featured Image', 'Raindrops' ),
		),
		'raindrops_theme_settings_presentation_panel' => array( 'priority'		 => 25,
			'capability'	 => $raindrops_customize_cap,
			'theme_supports' => '',
			'title'			 => __( 'Presentation', 'Raindrops' ),
			'description'	 => '',
		)
	);
	/**
	 * raindrops_featured_image_size
	 * choices
	 *
	 */
	$raindrops_featured_image_size_array	 = get_intermediate_image_sizes();
	$raindrops_featured_image_size_choices	 = array();

	foreach ( $raindrops_featured_image_size_array as $key => $val ) {

		$raindrops_featured_image_size_choices[ $val ] = ucfirst( $val );
	}
	/**
	 * raindrops_featured_image_recent_post_count
	 * description
	 */
	$raindrops_featured_image_post_max = get_option( 'posts_per_page' );

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

	$raindrops_customize_color_ja		 = array_flip( $raindrops_color_ja );
	$raindrops_customize_color_en_140	 = array_flip( $raindrops_color_en_140 );
	$raindrops_customize_color_en		 = array_flip( $raindrops_color_en );
	$raindrops_customize_color_anime	 = array_flip( $raindrops_color_anime );

	$raindrops_style_type_chices = raindrops_register_styles( "w3standard" );

	/*
	 * callback
	 */

	function raindrops_place_of_site_title_callback( $control ) {

		if ( $control->manager->get_setting( raindrops_data_store_relate_id( 'raindrops_place_of_site_title' ) )->value() == 'header_image' ) {
			return true;
		} else {
			return false;
		}
	}

	function raindrops_place_of_site_title_callback_b( $control ) {

		if ( $control->manager->get_setting( raindrops_data_store_relate_id( 'raindrops_site_title_left_margin_type' ) )->value() == 'manual' &&
			 $control->manager->get_setting( raindrops_data_store_relate_id( 'raindrops_place_of_site_title' ) )->value() == 'header_image'
		) {
			return true;
		} else {
			return false;
		}
	}
	function raindrops_show_right_sidebar_callback( $control ) {

		if ( $control->manager->get_setting( raindrops_data_store_relate_id( 'raindrops_show_right_sidebar' ) )->value() == 'show' ) {
			return true;
		} else {
			return false;
		}
	}

	function raindrops_post_content_type_callback( $control ) {

		if ( $control->manager->get_setting( raindrops_data_store_relate_id( 'raindrops_entry_content_is_home' ) )->value() == 'excerpt' ||
		$control->manager->get_setting( raindrops_data_store_relate_id( 'raindrops_entry_content_is_category' ) )->value() == 'excerpt' ||
		$control->manager->get_setting( raindrops_data_store_relate_id( 'raindrops_entry_content_is_search' ) )->value() == 'excerpt' ) {
			return true;
		} else {
			return false;
		}
	}

	function raindrops_use_featured_image_emphasis_callback( $control ) {

		if ( $control->manager->get_setting( raindrops_data_store_relate_id( 'raindrops_use_featured_image_emphasis' ) )->value() == 'yes' ) {
			return true;
		} else {
			return false;
		}
	}
	function raindrops_page_width_is_fluid( $control ) {
		
		if ( $control->manager->get_setting( raindrops_data_store_relate_id( 'raindrops_page_width' ) )->value() == 'doc3' ) {
			return true;
		} else {
			return false;
		}		
	}
	function raindrops_col_setting_type_is_details( $control ) {
		
		if ( $control->manager->get_setting( raindrops_data_store_relate_id( 'raindrops_col_setting_type' ) )->value() == 'details' ) {

			raindrops_update_theme_option( 'raindrops_show_right_sidebar', 'show' );
			return true;
		} else {
			return false;
		}		
	}
	function raindrops_col_setting_type_is_simple( $control ) {
		
		if ( $control->manager->get_setting( raindrops_data_store_relate_id( 'raindrops_col_setting_type' ) )->value() == 'simple' ) {
			return true;
		} else {
			return false;
		}		
	}
	
	function raindrops_raindrops_hyperlink_color_is_chromatic(  $control ) {
		/* Not showing gray color was set */

		$d = '[a-fA-F0-9]{1,2}';

		if ( preg_match( "/^#($d)($d)($d)\$/", 
		$control->manager->get_setting( raindrops_data_store_relate_id( 'raindrops_hyperlink_color' ) )->value(), 
			$rgb ) ) {
			 if( $rgb[1] == $rgb[2] && $rgb[1] == $rgb[3] ) {
				 return false;
			 } else {
				 return true;
			 }
		}else{
			return false;
		}
	}
	function raindrops_show_menu_primary_is_show( $control ) {
		if ( $control->manager->get_setting( raindrops_data_store_relate_id( 'raindrops_show_menu_primary' ) )->value() == 'show' ) {
			return true;
		} else {
			return false;
		}
	}
	function raindrops_page_width_is_full_size( $control ) {
		if ( $control->manager->get_setting( raindrops_data_store_relate_id( 'raindrops_page_width' ) )->value() == 'doc5' ) {
			return true;
		} else {
			return false;
		}		
	}
	function raindrops_doc_type_settings_is_xhtml( $control ) {
		if ( $control->manager->get_setting( raindrops_data_store_relate_id( 'raindrops_doc_type_settings' ) )->value() == 'xhtml' ) {
			return true;
		} else {
			return false;
		}		
	}
	function raindrops_permalink_is_default( $control ) {
		
		$permalink_structure = get_option( 'permalink_structure' );
		if( !empty( $permalink_structure )){
			return true;
		} else {
			return false;
		}
	}

	$raindrops_customize_args = array(
		/* Pending
		  "raindrops_color_scheme"							 => array(
		  'default'	 => "raindrops_color_picker",
		  'autoload'		 => 'yes',
		  'label'			 => esc_html__( 'Color Selection Type', 'Raindrops' ),
		  'excerpt1'		 => '',
		  'description'		 => esc_html__( 'Please choose the naming convention for the color list', 'Raindrops' ),
		  'sanitize_callback'		 => 'raindrops_color_scheme_validate',
		  'type'						 => 'radio',
		  'choices'					 => array(
		  'raindrops_color_ja' => __( 'Japan Colors', 'Raindrops' ),
		  'raindrops_color_en' => __( 'USA Colors', 'Raindrops' ),
		  'raindrops_color_en_140' => __( 'WEB Colors', 'Raindrops' ),
		  'raindrops_color_anime' => __( 'Animation Color', 'Raindrops' ),
		  'raindrops_color_picker' => __( 'Color Picker' ),
		  ),
		  ), */
// Color Picker
		"raindrops_base_color"							 => array(
			'default'					 => raindrops_warehouse_clone( 'raindrops_base_color' ),
			'data_type'					 => $raindrops_setting_type,
			'autoload'					 => 'yes',
			'capability'				 => $raindrops_customize_cap,
			'label'						 => esc_html__( 'Base color', 'Raindrops' ),
			'excerpt1'					 => '',
			'description'				 => esc_html__( 'Please specify your favorite color. and an automatic arrangement of color is designed.', 'Raindrops' ),
			'sanitize_callback'			 => 'raindrops_base_color_validate',
			'extend_customize_control'	 => 'WP_Customize_Color_Control',
			'extend_customize_setting'	 => '',
			'section'					 => 'raindrops_theme_settings_presentation',
			'priority'					 => 9,
		),
		"raindrops_default_fonts_color"					 => array(
			'default'					 => raindrops_warehouse_clone( 'raindrops_default_fonts_color' ),
			'data_type'					 => $raindrops_setting_type,
			'autoload'					 => 'yes',
			'capability'				 => $raindrops_customize_cap,
			'label'						 => esc_html__( 'Font Color', 'Raindrops' ),
			'excerpt1'					 => '',
			'description'				 => esc_html__( 'If you need to set contents Special font color.', 'Raindrops' ),
			'sanitize_callback'			 => 'raindrops_default_fonts_color_validate',
			'extend_customize_control'	 => 'WP_Customize_Color_Control',
			'extend_customize_setting'	 => '',
			'section'					 => 'colors',
		),
		"raindrops_footer_color"						 => array(
			'default'					 => raindrops_warehouse_clone( 'raindrops_footer_color' ),
			'data_type'					 => $raindrops_setting_type,
			'autoload'					 => 'yes',
			'capability'				 => $raindrops_customize_cap,
			'label'						 => esc_html__( 'Footer Font Color', 'Raindrops' ),
			'excerpt1'					 => '',
			'description'				 => esc_html__( 'If you need to set footer Special font color.', 'Raindrops' ),
			'sanitize_callback'			 => 'raindrops_footer_color_validate',
			'extend_customize_control'	 => 'WP_Customize_Color_Control',
			'extend_customize_setting'	 => '',
			'section'					 => 'colors',
		),
		"raindrops_hyperlink_color"						 => array(
			'default'					 => "",
			'data_type'					 => $raindrops_setting_type,
			'autoload'					 => 'yes',
			'capability'				 => $raindrops_customize_cap,
			'label'						 => esc_html__( 'Link Color', 'Raindrops' ),
			'excerpt1'					 => '',
			'description'				 => esc_html__( 'Hyper link color', 'Raindrops' ),
			'sanitize_callback'			 => 'raindrops_hyperlink_color_validate',
			'extend_customize_control'	 => 'WP_Customize_Color_Control',
			'extend_customize_setting'	 => '',
			'section'					 => 'colors',
		),
		"raindrops_footer_link_color"					 => array(
			'default'					 => raindrops_warehouse_clone( 'raindrops_footer_link_color' ),
			'data_type'					 => $raindrops_setting_type,
			'autoload'					 => 'yes',
			'capability'				 => $raindrops_customize_cap,
			'label'						 => esc_html__( 'Footer Link Color', 'Raindrops' ),
			'excerpt1'					 => '',
			'description'				 => esc_html__( 'If you need to set footer Special link color.hex color ex.#ff0000 or none', 'Raindrops' ),
			'sanitize_callback'			 => 'raindrops_footer_link_color_validate',
			'extend_customize_control'	 => 'WP_Customize_Color_Control',
			'extend_customize_setting'	 => '',
			'priority'					=> 20,
			'section'					 => 'colors',
		),
// End Color Picker
		"raindrops_style_type"							 => array(
			'default'					 => raindrops_warehouse_clone( 'raindrops_style_type' ),
			'data_type'					 => $raindrops_setting_type,
			'autoload'					 => 'yes',
			'capability'				 => $raindrops_customize_cap,
			'label'						 => esc_html__( 'Color Type', 'Raindrops' ),
			'excerpt1'					 => '',
			'description'				 => '',
			'sanitize_callback'			 => 'raindrops_style_type_validate',
			'type'						 => 'radio',
			'choices'					 => $raindrops_style_type_chices,
			'extend_customize_control'	 => '',
			'section'					 => 'raindrops_theme_settings_presentation',
		),
		"raindrops_header_image"						 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_header_image' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Header background image', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => esc_html__( 'The header image can be set by two methods.
One is a method of up-loading the image from the below up-loading form. Another is a method of filling in the filename from this textfield from Raindrops/images something image.', 'Raindrops' ),
			'type'				 => 'text', //仮
			'sanitize_callback'	 => 'raindrops_header_image_validate',
		),
		"raindrops_footer_image"						 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_footer_image' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Footer background image', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => esc_html__( 'The footer image can be set by two methods.
One is a method of up-loading the image from the below up-loading form. Another is a method of filling in the filename from this textfield from Raindrops/images something image.', 'Raindrops' ),
			'type'				 => 'text', // 仮
			'sanitize_callback'	 => 'raindrops_footer_image_validate',
		),
		/**
		 * Pending
		 *
		 * "raindrops_heading_image"							 => array(
		  'default'	 => "none",
		  'autoload'		 => 'yes',
		  'label'			 => esc_html__( 'Widget Title Background Image', 'Raindrops' ),
		  'excerpt1'		 => '',
		  'description'		 => esc_html__( 'The header image can be chosen from among three kinds [h2.png,h2b.png,h2c.png].', 'Raindrops' ),
		  'sanitize_callback'		 => 'raindrops_heading_image_validate',
		  ),
		  "raindrops_heading_image_position"					 => array(
		  'default'	 => "0",
		  'autoload'		 => 'yes',
		  'label'			 => esc_html__( 'Widget Title Background Image Position', 'Raindrops' ),
		  'excerpt1'		 => '',
		  'description'		 => esc_html__( 'The name of the picture file used for the h2 headding is set. Please set the integral value from 0 to 7. ', 'Raindrops' ),
		  'sanitize_callback'		 => 'raindrops_heading_image_position_validate',
		  ), */
		"raindrops_page_width"							 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_page_width' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'label'				 => esc_html__( 'Document Width', 'Raindrops' ),
			'capability'		 => $raindrops_customize_cap,
			'excerpt1'			 => '',
			'description'		 => '',
			'sanitize_callback'	 => 'raindrops_page_width_validate',
			'type'				 => 'radio',
			'choices'			 => array(
				'doc'	 => __( '750px centered', 'Raindrops' ),
				'doc2'	 => __( '950px centered', 'Raindrops' ),
				'doc4'	 => __( '974px', 'Raindrops' ),			
				'doc3'	 => __( 'Box Layout Responsive', 'Raindrops' ),
				'doc5'   => __( 'Full Width Resuponsive', 'Raindrops' ),
			),
			'section'			 => 'raindrops_theme_settings_sidebar',
			'priority'			=> 8,
		),
		"raindrops_col_setting_type"							 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_col_setting_type' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Side bar setting method', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => esc_html__( 'Please select Simple( All list pages same column ) or details ( It sets the column of the list page, such as archive and index individually )', 'Raindrops' ),
			'sanitize_callback'	 => 'raindrops_col_setting_type_validate',
			'type'				 => 'radio',
			'choices'			 => array(
				'simple' => __( 'Simple', 'Raindrops' ),
				'details' => __( 'Details', 'Raindrops' ),
				
			),			
			'section'			 => 'raindrops_theme_settings_sidebar',
		),		
		"raindrops_col_width"							 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_col_width' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Column Width and Position', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => esc_html__( 'Please specify the position and the width of Default Sidebar. Six kinds of sidebars of left 160px left 180px left 300px right 180px right 240px right 300px can be specified.', 'Raindrops' ),
			'sanitize_callback'	 => 'raindrops_col_width_validate',
			'type'				 => 'radio',
			'choices'			 => array(
				't1' => __( 'left 160px', 'Raindrops' ),
				't2' => __( 'left 180px', 'Raindrops' ),
				't3' => __( 'left 300px', 'Raindrops' ),
				't4' => __( 'right 180px', 'Raindrops' ),
				't5' => __( 'right 240px', 'Raindrops' ),
				't6' => __( 'right 300px', 'Raindrops' ),
			),
			'priority'			=> 12,			
			'section'			 => 'raindrops_theme_settings_sidebar',
		),
		"raindrops_show_right_sidebar"					 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_show_right_sidebar' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Display Extra Sidebar', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => esc_html__( 'Please specify show when you want to use three row layout. Please set Ratio to text when extra sidebar is displayed when you specify show', 'Raindrops' ),
			'sanitize_callback'	 => 'raindrops_show_right_sidebar_validate',
			'type'				 => 'radio',
			'choices'			 => array(
				'show'	 => __( 'Show', 'Raindrops' ),
				'hide'	 => __( 'Hide', 'Raindrops' ),
			),
			'priority'			=> 13,
			'active_callback'   => 'raindrops_col_setting_type_is_simple',
			'section'			 => 'raindrops_theme_settings_sidebar',

		),
		"raindrops_right_sidebar_width_percent"			 => array(
			'default'			 => "25",
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Extra Sidebar Width', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => esc_html__( 'When display extra sidebar is set to show', 'Raindrops' ) .
			esc_html__( 'it is necessary to specify it.', 'Raindrops' ) .
			esc_html__( 'It can decide to divide the width of which place of extra sidebar', 'Raindrops' ) .
			esc_html__( 'and to give it. Please select it from among 25% 33% 50% 66% 75%. ', 'Raindrops' ),
			'sanitize_callback'	 => 'raindrops_right_sidebar_width_percent_validate',
			'type'				 => 'radio',
			'choices'			 => array(
				'25' => __( '25%', 'Raindrops' ),
				'33' => __( '33%', 'Raindrops' ),
				'50' => __( '50%', 'Raindrops' ),
				'66' => __( '66%', 'Raindrops' ),
				'75' => __( '75%', 'Raindrops' ),
			),
			'active_callback'	 => 'raindrops_show_right_sidebar_callback',
			'priority'			=> 14,
			'section'			 => 'raindrops_theme_settings_sidebar',
		),
		"raindrops_sidebar_index"			 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_sidebar_index' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Index Page columns', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => '',
			'type'				 => 'radio',
			'choices'			 => array(
				1 => __( '1 column', 'Raindrops' ),
				2 => __( '2 columns', 'Raindrops' ),
				3 => __( '3 columns', 'Raindrops' ),
			),
			'priority'			=> 15,			
			'sanitize_callback'	 => 'raindrops_sidebar_index_validate',
			'active_callback'	 => 'raindrops_col_setting_type_is_details',
			'section'			 => 'raindrops_theme_settings_sidebar',
		),
		"raindrops_sidebar_date"			 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_sidebar_date' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Date Archive columns', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => '',
			'type'				 => 'radio',
			'choices'			 => array(
				1 => __( '1 column', 'Raindrops' ),
				2 => __( '2 columns', 'Raindrops' ),
				3 => __( '3 columns', 'Raindrops' ),
			),
			'priority'			=> 15,
			'sanitize_callback'	 => 'raindrops_sidebar_date_validate',
			'active_callback'	 => 'raindrops_col_setting_type_is_details',
			'section'			 => 'raindrops_theme_settings_sidebar',
		),
		"raindrops_sidebar_page"			 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_sidebar_page' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Static Page columns', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => '',
			'type'				 => 'radio',
			'choices'			 => array(
				1 => __( '1 column', 'Raindrops' ),
				2 => __( '2 columns', 'Raindrops' ),
				3 => __( '3 columns', 'Raindrops' ),
			),
			'priority'			=> 15,
			'sanitize_callback'	 => 'raindrops_sidebar_page_validate',
			'active_callback'	 => 'raindrops_col_setting_type_is_details',
			'section'			 => 'raindrops_theme_settings_sidebar',
		),
		"raindrops_sidebar_search"			 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_sidebar_search' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Search Result Page columns', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => '',
			'type'				 => 'radio',
			'choices'			 => array(
				1 => __( '1 column', 'Raindrops' ),
				2 => __( '2 columns', 'Raindrops' ),
				3 => __( '3 columns', 'Raindrops' ),
			),
			'priority'			=> 15,
			'sanitize_callback'	 => 'raindrops_sidebar_search_validate',
			'active_callback'	 => 'raindrops_col_setting_type_is_details',
			'section'			 => 'raindrops_theme_settings_sidebar',
		),
			
		"raindrops_sidebar_single"			 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_sidebar_single' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Single Post columns', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => '',
			'type'				 => 'radio',
			'choices'			 => array(
				1 => __( '1 column', 'Raindrops' ),
				2 => __( '2 columns', 'Raindrops' ),
				3 => __( '3 columns', 'Raindrops' ),
			),
			'priority'			=> 15,
			'sanitize_callback'	 => 'raindrops_sidebar_single_validate',
			'active_callback'	 => 'raindrops_col_setting_type_is_details',
			'section'			 => 'raindrops_theme_settings_sidebar',
		),
		
		"raindrops_sidebar_image_archive"			 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_sidebar_image_archive' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Image Archive columns', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => '',
			'type'				 => 'radio',
			'choices'			 => array(
				1 => __( '1 column', 'Raindrops' ),
				2 => __( '2 columns', 'Raindrops' ),
				3 => __( '3 columns', 'Raindrops' ),
			),
			'priority'			=> 15,
			'sanitize_callback'	 => 'raindrops_sidebar_image_archive_validate',
			'active_callback'	 => 'raindrops_col_setting_type_is_details',
			'section'			 => 'raindrops_theme_settings_sidebar',
		),
		"raindrops_sidebar_404"			 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_sidebar_404' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( '404 Page columns', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => '',
			'type'				 => 'radio',
			'choices'			 => array(
				1 => __( '1 column', 'Raindrops' ),
				2 => __( '2 columns', 'Raindrops' ),
				3 => __( '3 columns', 'Raindrops' ),
			),
			'priority'			=> 15,
			'sanitize_callback'	 => 'raindrops_sidebar_404_validate',
			'active_callback'	 => 'raindrops_col_setting_type_is_details',
			'section'			 => 'raindrops_theme_settings_sidebar',
		),
		"raindrops_sidebar_list_of_post"			 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_sidebar_list_of_post' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'List of Post Template columns', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => '',
			'type'				 => 'radio',
			'choices'			 => array(
				1 => __( '1 column', 'Raindrops' ),
				2 => __( '2 columns', 'Raindrops' ),
				3 => __( '3 columns', 'Raindrops' ),
			),
			'priority'			=> 20,
			'sanitize_callback'	 => 'raindrops_sidebar_list_of_post_validate',
			'active_callback'	 => 'raindrops_col_setting_type_is_details',
			'section'			 => 'raindrops_theme_settings_sidebar',
		),
		
		"raindrops_sidebar_catetory"			 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_sidebar_catetory' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Category Archive columns', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => '',
			'type'				 => 'radio',
			'choices'			 => array(
				1 => __( '1 column', 'Raindrops' ),
				2 => __( '2 columns', 'Raindrops' ),
				3 => __( '3 columns', 'Raindrops' ),
			),
			'priority'			=> 15,
			'sanitize_callback'	 => 'raindrops_sidebar_catetory_validate',
			'active_callback'	 => 'raindrops_col_setting_type_is_details',
			'section'			 => 'raindrops_theme_settings_sidebar',
		),
		"raindrops_sidebar_tag"			 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_sidebar_tag' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Tag Archive columns', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => '',
			'type'				 => 'radio',
			'choices'			 => array(
				1 => __( '1 column', 'Raindrops' ),
				2 => __( '2 columns', 'Raindrops' ),
				3 => __( '3 columns', 'Raindrops' ),
			),
			'priority'			=> 15,
			'sanitize_callback'	 => 'raindrops_sidebar_tag_validate',
			'active_callback'	 => 'raindrops_col_setting_type_is_details',
			'section'			 => 'raindrops_theme_settings_sidebar',
		),
		"raindrops_sidebar_author"			 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_sidebar_author' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Author Archives columns', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => '',
			'type'				 => 'radio',
			'choices'			 => array(
				1 => __( '1 column', 'Raindrops' ),
				2 => __( '2 columns', 'Raindrops' ),
				3 => __( '3 columns', 'Raindrops' ),
			),
			'priority'			=> 15,
			'sanitize_callback'	 => 'raindrops_sidebar_author_validate',
			'active_callback'	 => 'raindrops_col_setting_type_is_details',
			'section'			 => 'raindrops_theme_settings_sidebar',
		),
		"raindrops_show_menu_primary"					 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_show_menu_primary' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Display hide', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => esc_html__( 'Display or not Menu Primary. default value is show. set hide when not display menu primary', 'Raindrops' ),
			'sanitize_callback'	 => 'raindrops_show_menu_primary_validate',
			'type'				 => 'radio',
			'choices'			 => array(
				'show'	 => __( 'Show', 'Raindrops' ),
				'hide'	 => __( 'Hide', 'Raindrops' ),
			),
			'section'			 => 'nav',
		),
		
		"raindrops_accessibility_settings"				 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_accessibility_settings' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Force Unique Link Text', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => esc_html__( 'Accessibility Settings is create a unique link text. set to yes or no.', 'Raindrops' ),
			'sanitize_callback'	 => 'raindrops_accessibility_settings_validate',
			'type'				 => 'radio',
			'choices'			 => array(
				'yes'	 => __( 'Yes', 'Raindrops' ),				
				'no'	 => __( 'No', 'Raindrops' ),
			),
			'section'			 => 'raindrops_theme_settings_document',
		),
		"raindrops_doc_type_settings"					 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_doc_type_settings' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Document Type Definition', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => esc_html__( "Default Document type html5. Set to xhtml or html5.", 'Raindrops' ),
			'sanitize_callback'	 => 'raindrops_doc_type_settings_validate',
			'type'				 => 'radio',
			'choices'			 => array(
				'html5'	 => 'HTML5',
				'xhtml'	 => 'XHTML1.0',
			),
			'section'			 => 'raindrops_theme_settings_document',
		),
		"raindrops_xhtml_media_type"					 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_xhtml_media_type' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'XHTML Media Type', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => esc_html__( 'value text/html or application/xhtml+xml, default text/html', 'Raindrops' ),
			'sanitize_callback'	 => 'raindrops_xhtml_media_type_validate',
			'active_callback'    => 'raindrops_doc_type_settings_is_xhtml',
			'type'				 => 'radio',
			'choices'			 => array(
				'text/html'	 => 'text/html',
				'application/xhtml+xml'	 => 'application/xhtml+xml',
			),
			'section'			 => 'raindrops_theme_settings_document',
		),

		"raindrops_actions_hook_message"					 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_actions_hook_message' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Developer Settings', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => esc_html__( 'Show Insert Point hooks and auto include template name for Developer, default hide', 'Raindrops' ),
			'sanitize_callback'	 => 'raindrops_actions_hook_message_validate',
			'type'				 => 'radio',
			'choices'			 => array(
				'show'	 => esc_html__( 'Show', 'Raindrops' ),
				'hide'	 => esc_html__( 'Hide', 'Raindrops' ),
			),
			'section'			 => 'raindrops_theme_settings_document',
		),

		"raindrops_status_bar"					 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_status_bar' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Status Bar', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => esc_html__( 'Show or Hide, Raindrops Status Bar at Page bottom, default show', 'Raindrops' ),
			'sanitize_callback'	 => 'raindrops_status_bar_validate',
			'type'				 => 'radio',
			'choices'			 => array(
				'show'	 => esc_html__( 'Show', 'Raindrops' ),
				'hide'	 => esc_html__( 'Hide', 'Raindrops' ),
			),
			'section'			 => 'raindrops_theme_settings_document',
		),
		"raindrops_basefont_settings"					 => array(
			'default'			 => $raindrops_basefont_default_val,
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Base Font Size', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => esc_html__( "Base Font Size Value Recommend 13-20 (px size)", 'Raindrops' ),
			'sanitize_callback'	 => 'raindrops_basefont_settings_validate',
			'type'				 => 'radio',
			'choices'			 => array_flip( $raindrops_basefont_size ),
			'section'			 => 'raindrops_theme_settings_fonts',
		),
		"raindrops_fluid_max_width"						 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_fluid_max_width' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Fluid  Max Width (px)', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => esc_html__( "Default 1280 (px size)", 'Raindrops' ),
			'sanitize_callback'	 => 'raindrops_fluid_max_width_validate',
			'active_callback'	=> 'raindrops_page_width_is_fluid',
			'type'				 => 'text',
			'priority'			=> 9,			
			'section'			 => 'raindrops_theme_settings_sidebar',

		),
		"raindrops_full_width_max_width"						 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_full_width_max_width' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Content Container Width (px)', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => esc_html__( "Default 1280 (px size)", 'Raindrops' ),
			'sanitize_callback'	 => 'raindrops_full_width_max_width_validate',
			'active_callback'	=> 'raindrops_page_width_is_full_size',
			'type'				 => 'text',
			'priority'			=> 9,			
			'section'			 => 'raindrops_theme_settings_sidebar',
		),
		"raindrops_full_width_limit_window_width"						 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_full_width_limit_window_width' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Support limit Browser Width', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => esc_html__( "In the case of specified size abnormalities of the browser window size, it will show in the box layout. set px value, Default 1920 (px size)", 'Raindrops' ),
			'sanitize_callback'	 => 'raindrops_full_width_limit_window_width_validate',
			'active_callback'	=> 'raindrops_page_width_is_full_size',
			'type'				 => 'text',
			'priority'			=> 9,			
			'section'			 => 'raindrops_theme_settings_sidebar',
		),		
		"raindrops_complementary_color_for_title_link"	 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_complementary_color_for_title_link' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Complementary Link Color For Entry Title', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => esc_html__( 'If you need to set complementary color for entry title.(There is a need to link color is set to chromatic) value yes or none', 'Raindrops' ),
			'sanitize_callback'	 => 'raindrops_complementary_color_for_title_link_validate',
			'type'				 => 'radio',
			'choices'			 => array(
				'yes'	 => 'Yes',
				'no'	 => 'No' ),
			'priority'			=> 11,			
			'active_callback'   => 'raindrops_raindrops_hyperlink_color_is_chromatic',
			'section'			=> 'colors',
		),
		"raindrops_disable_keyboard_focus"				 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_disable_keyboard_focus' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Disable Keyboad Focus', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => esc_html__( 'Fallback Setting when Nav Menu displayed improperly, value set enable( defalt ) or disable', 'Raindrops' ),
			'sanitize_callback'	 => 'raindrops_disable_keyboard_focus_validate',
			'type'				 => 'radio',
			'choices'			 => array(
				'disable'	 => esc_html__( 'Disable', 'Raindrops' ),
				'enable'	 => esc_html__( 'Enable', 'Raindrops' ),
			),
			'section'			 => 'raindrops_theme_settings_document',
		),
		"raindrops_sync_style_for_tinymce"				 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_sync_style_for_tinymce' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Synchronize Style for Visual Editor', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => esc_html__( 'Reflect on Dynamically Editor Style Settings, value set yes ( default ) or none', 'Raindrops' ),
			'sanitize_callback'	 => 'raindrops_sync_style_for_tinymce_validate',
			'type'				 => 'radio',
			'choices'			 => array(
				'yes'	 => esc_html__( 'Yes', 'Raindrops' ),
				'none'	 => esc_html__( 'No', 'Raindrops' ), ),
			'section'			 => 'raindrops_theme_settings_document',
		),
		/**
		 * Pending not work at customizer
		 * old theme page works
		 * "raindrops_uninstall_option"					 => array(
		 
			'default'			 => raindrops_warehouse_clone( 'raindrops_uninstall_option' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Delete all Theme Settings when Switch Theme', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => '<strong style="color:red">' . esc_html__( 'The deleted data can not be restored', 'Raindrops' ) . '</strong>',
			'sanitize_callback'	 => 'raindrops_uninstall_option_validate',
			'type'				 => 'radio',
			'choices'			 => array(
				'keep'	 => 'Keep',
				'delete' => 'Delete All'
			),
			'priority'			=> 11,
			'section'			 => 'raindrops_theme_settings_document',
		),*/
		"raindrops_menu_primary_font_size"				 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_menu_primary_font_size' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Menu Primary Font Size', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => '<p>' . esc_html__( 'Menu Primary Font Size. default value is 100( % ). set font size between 77 and 182', 'Raindrops' ) . '</p>',
			'sanitize_callback'	 => 'raindrops_menu_primary_font_size_validate',
			'active_callback'	=> 'raindrops_show_menu_primary_is_show',
			'type'				 => 'range',
			'input_attrs'		 => array(
				'min'	 => 77,
				'max'	 => 182,
				'step'	 => 0.1,
				'class'	 => 'menu-primary-font-size raindrops',
				'style'	 => '',
			),
			'section'			 => 'nav',
		),
		"raindrops_menu_primary_min_width"				 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_menu_primary_min_width' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Menu Primary Min Width', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => '<p>' . esc_html__( 'Menu Primary Width. default value is 10 ( em ). set 1 between 95.999', 'Raindrops' ) . '</p>',
			'sanitize_callback'	 => 'raindrops_menu_primary_min_width_validate',
			'active_callback'	=> 'raindrops_show_menu_primary_is_show',
			'type'				 => 'range',
			'input_attrs'		 => array(
				'min'	 => 1,
				'max'	 => 95.9,
				'step'	 => 0.1,
				'class'	 => 'menu-primary-min-width raindrops',
				'style'	 => '',
			),
			'section'			 => 'nav',
		),
		"raindrops_use_featured_image_emphasis"			 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_use_featured_image_emphasis' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'USE or Not Emphasis of new content using the Featured Image', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => esc_html__( 'values yes or no default No', 'Raindrops' ),
			'sanitize_callback'	 => 'raindrops_use_featured_image_emphasis_validate',
			'type'				 => 'radio',
			'choices'			 => array(
				"yes"	 => esc_html__( "Yes", 'Raindrops' ),
				"no"	 => esc_html__( "No", 'Raindrops' ),
			),
			'section'			 => 'raindrops_theme_settings_featured',
		),
		"raindrops_featured_image_position"				 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_featured_image_position' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Featured Image Position', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => esc_html__( 'Loop Pages Layout of Featured Image', 'Raindrops' ),
			'sanitize_callback'	 => 'raindrops_featured_image_position_validate',
			'type'				 => 'radio',
			'choices'			 => array(
				"front"	 => esc_html__( "In front of Title", 'Raindrops' ),
				"left"	 => esc_html__( "Left of Article", 'Raindrops' ),
			),
			'active_callback'	 => 'raindrops_use_featured_image_emphasis_callback',
			'section'			 => 'raindrops_theme_settings_featured',
		),
		"raindrops_featured_image_size"					 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_featured_image_size' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Featured Image Size', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => esc_html__( 'values thumbnail, medium, large, default', 'Raindrops' ),
			'sanitize_callback'	 => 'raindrops_featured_image_size_validate',
			'type'				 => 'radio',
			'choices'			 => $raindrops_featured_image_size_choices,
			'active_callback'	 => 'raindrops_use_featured_image_emphasis_callback',
			'section'			 => 'raindrops_theme_settings_featured',
		),
		"raindrops_featured_image_recent_post_count"	 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_featured_image_recent_post_count' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Featured Image Special Layout Apply Post Count', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => esc_html__( 'Input Possible values are 1 - ', 'Raindrops' ) . $raindrops_featured_image_post_max . esc_html__( ' default value 3', 'Raindrops' ),
			'sanitize_callback'	 => 'raindrops_featured_image_recent_post_count_validate',
			'type'				 => 'text',
			'active_callback'	 => 'raindrops_use_featured_image_emphasis_callback',
			'section'			 => 'raindrops_theme_settings_featured',
		),
		"raindrops_featured_image_singular"				 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_featured_image_singular' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Singular ( post, page )', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => esc_html__( 'Featured Image Show, Hide or Lightbox on Singular Post,Page. default Show', 'Raindrops' ),
			'sanitize_callback'	 => 'raindrops_featured_image_singular_validate',
			'type'				 => 'radio',
			'choices'			 => array(
				"show"		 => esc_html__( "Show", 'Raindrops' ),
				"hide"		 => esc_html__( "Hide", 'Raindrops' ),
				"lightbox"	 => esc_html__( "Light Box", 'Raindrops' ),
			),
			'active_callback'	 => 'raindrops_use_featured_image_emphasis_callback',
			'section'			 => 'raindrops_theme_settings_featured',
		),
		//////////////////////////////////////////
		"raindrops_article_title_css_class"					 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_article_title_css_class' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Entry Title CSS Class', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => esc_html__( 'default empty', 'Raindrops' ),
			'sanitize_callback'	 => 'raindrops_article_title_css_class_validate',
			'type'				 => 'text',
			'section'			 => 'raindrops_theme_settings_post',
		),
		"raindrops_display_article_publish_date"					 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_display_article_publish_date' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Display Publish Date', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => esc_html__( 'default Show', 'Raindrops' ),
			'sanitize_callback'	 => 'raindrops_display_article_publish_date_validate',
			'type'				 => 'radio',
			'choices'			 => array(
				'show'	 => esc_html__( 'Show', 'Raindrops' ),
				'hide'	 => esc_html__( 'Hide', 'Raindrops' ),
			),
			'section'			 => 'raindrops_theme_settings_post',
		),
		"raindrops_display_article_author"					 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_display_article_author' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Display Author', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => esc_html__( 'default Show', 'Raindrops' ),
			'sanitize_callback'	 => 'raindrops_display_article_author_validate',
			'type'				 => 'radio',
			'choices'			 => array(
				'show'	 => esc_html__( 'Show', 'Raindrops' ),
				'hide'	 => esc_html__( 'Hide', 'Raindrops' ),
			),
			'section'			 => 'raindrops_theme_settings_post',
		),		
		"raindrops_display_default_category"					 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_display_default_category' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Display Default Category', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => esc_html__( 'default show', 'Raindrops' ),
			'sanitize_callback'	 => 'raindrops_display_default_category_validate',
			'active_callback'	 => 'raindrops_permalink_is_default',
			'type'				 => 'radio',
			'choices'			 => array(
				'show'	 => esc_html__( 'Show', 'Raindrops' ),
				'hide'	 => esc_html__( 'Hide', 'Raindrops' ),
			),
			'section'			 => 'raindrops_theme_settings_post',
		),
	);

	/**
	 * Conditional args
	 */
	$raindrops_customize_args_conditional_1 = array(
		"raindrops_entry_content_is_home"		 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_entry_content_is_home' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Home Listed Entry Contents', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => '',
			'sanitize_callback'	 => 'raindrops_entry_content_is_home_validate',
			'type'				 => 'radio',
			'choices'			 => array(
				'content'	 => esc_html__( 'Show Content', 'Raindrops' ),
				'excerpt'	 => esc_html__( 'Show Excerpt', 'Raindrops' ),
				'none'		 => esc_html__( 'Hide', 'Raindrops' ),
			),
			'section'			 => 'raindrops_theme_settings_content',
		),
		"raindrops_entry_content_is_category"	 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_entry_content_is_category' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Category Archives Entry Contents', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => '',
			'sanitize_callback'	 => 'raindrops_entry_content_is_category_validate',
			'type'				 => 'radio',
			'choices'			 => array(
				'content'	 => esc_html__( 'Show Content', 'Raindrops' ),
				'excerpt'	 => esc_html__( 'Show Excerpt', 'Raindrops' ),
				'none'		 => esc_html__( 'Hide', 'Raindrops' ),
			),
			'section'			 => 'raindrops_theme_settings_content',
		),
		"raindrops_entry_content_is_search"		 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_entry_content_is_search' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Search Result Entry Contents', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => '',
			'sanitize_callback'	 => 'raindrops_entry_content_is_tag_validate',
			'type'				 => 'radio',
			'choices'			 => array(
				'content'	 => esc_html__( 'Show Content', 'Raindrops' ),
				'excerpt'	 => esc_html__( 'Show Excerpt', 'Raindrops' ),
				'none'		 => esc_html__( 'Hide', 'Raindrops' ),
			),
			'section'			 => 'raindrops_theme_settings_content',
		),
		"raindrops_allow_oembed_excerpt_view"	 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_allow_oembed_excerpt_view' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Allow Oembed in Excerpt', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => esc_html__( 'Overview display, if you set no, you can reduce the load time of the page. values yes or no default yes', 'Raindrops' ),
			'sanitize_callback'	 => 'raindrops_allow_oembed_excerpt_view_validate',
			'type'				 => 'radio',
			'choices'			 => array(
				'no'	 => esc_html__( 'No', 'Raindrops' ),
				'yes'	 => esc_html__( 'Yes', 'Raindrops' ),
			),
			'active_callback'	 => 'raindrops_post_content_type_callback',
			'section'			 => 'raindrops_theme_settings_content',
		),
		"raindrops_excerpt_enable"				 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_excerpt_enable' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Excerpt Type', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => esc_html__( 'Default WordPress Excerpt, HTML in Excerpt is Raindrops original excerpt', 'Raindrops' ),
			'sanitize_callback'	 => 'raindrops_excerpt_enable_validate',
			'type'				 => 'radio',
			'choices'			 => array(
				'no'	 => esc_html__( 'WordPress Excerpt', 'Raindrops' ),
				'yes'	 => esc_html__( 'HTML in Excerpt', 'Raindrops' ),
			),
			'active_callback'	 => 'raindrops_post_content_type_callback',
			'section'			 => 'raindrops_theme_settings_content',
		),
		"raindrops_read_more_after_excerpt"		 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_read_more_after_excerpt' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Add More Link After Excerpt', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => '',
			'sanitize_callback'	 => 'raindrops_read_more_after_excerpt_validate',
			'type'				 => 'radio',
			'choices'			 => array(
				'yes'	 => esc_html__( 'Yes', 'Raindrops' ),
				'no'	 => esc_html__( 'No', 'Raindrops' ), 
			),
			'active_callback'	 => 'raindrops_post_content_type_callback',
			'section'			 => 'raindrops_theme_settings_content',
		),
		"raindrops_excerpt_length"		 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_excerpt_length' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Excerpt Length', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => esc_html__( 'Value 20-400', 'Raindrops' ),
			'sanitize_callback'	 => 'raindrops_excerpt_length_validate',
			'type'				 => 'range',
			'input_attrs'		 => array(
				'min'	 => 20,
				'max'	 => 400,
				'step'	 => 1,
			),
			'active_callback'	 => 'raindrops_post_content_type_callback',
			'section'			 => 'raindrops_theme_settings_content',
		),
	);

	$raindrops_customize_args_conditional_2 = array(
		"raindrops_plugin_presentation_bcn_nav_menu" => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_plugin_presentation_bcn_nav_menu' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Breadcrumbs', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => esc_html__( 'Theme, will make a presentation of applying the plugin automatically, value set yes or none. using Breadcrumb NavXT', 'Raindrops' ),
			'sanitize_callback'	 => 'raindrops_plugin_presentation_bcn_nav_menu_validate',
			'type'				 => 'radio',
			'choices'			 => array(
				'yes'	 => esc_html__( 'Yes', 'Raindrops' ),
				'none'	 => esc_html__( 'No', 'Raindrops' ), 
			),
			'section'			 => 'raindrops_theme_settings_plugins',
		),
	);

	$raindrops_customize_args_conditional_3 = array(
		"raindrops_plugin_presentation_wp_pagenav" => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_plugin_presentation_wp_pagenav' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Custom Page Navigation', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => esc_html__( 'Theme, will make a presentation of applying the plugin automatically, value set yes or none. using WP PageNavi', 'Raindrops' ),
			'sanitize_callback'	 => 'raindrops_plugin_presentation_wp_pagenav_validate',
			'type'				 => 'radio',
			'choices'			 => array(
				'yes'	 => esc_html__( 'Yes', 'Raindrops' ),
				'none'	 => esc_html__( 'No', 'Raindrops' ),
			),
			'section'			 => 'raindrops_theme_settings_plugins',
		),
	);

	$raindrops_customize_args_conditional_4	 = array(
		"raindrops_plugin_presentation_meta_slider" => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_plugin_presentation_meta_slider' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Slider for HomePage', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => esc_html__( 'Please Set Meta Slider ID or none. using Meta Slider', 'Raindrops' ),
			'sanitize_callback'	 => 'raindrops_plugin_presentation_meta_slider_validate',
			'type'				 => 'select',
			'choices'			 => raindrops_get_ml_slider_ids(),
			'section'			 => 'raindrops_theme_settings_plugins',
		),
	);
	$raindrops_customize_args_conditional_5	 = array(
		"raindrops_plugin_presentation_the_events_calendar" => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_plugin_presentation_the_events_calendar' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'The Events Calendar Automatic Presentation', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => esc_html__( 'Theme, will make a presentation of applying the plugin automatically. using The Events Calendar Plugin', 'Raindrops' ),
			'sanitize_callback'	 => 'raindrops_plugin_presentation_the_events_calendarr_validate',
			'type'				 => 'radio',
			'choices'			 => array(
				'yes'	 => esc_html__( 'Yes', 'Raindrops' ),
				'none'	 => esc_html__( 'No', 'Raindrops' ),
			),
			'section'			 => 'raindrops_theme_settings_plugins',
		),
	);
	$raindrops_customize_args_conditional_6	 = array(
		"raindrops_japanese_date" => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_japanese_date' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'USE or Not Japanese Date', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => '',
			'sanitize_callback'	 => 'raindrops_japanese_date_validate',
			'type'				 => 'radio',
			'choices'			 => array(
				'yes'	 => esc_html__( 'Yes', 'Raindrops' ),
				'no'	 => esc_html__( 'No', 'Raindrops' ),
			),
			'section'			 => 'raindrops_theme_settings_plugins',
		),
	);

	$raindrops_customize_args_conditional_7 = array(
		"raindrops_place_of_site_title"		 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_place_of_site_title' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Place of the Title', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => '',
			'sanitize_callback'	 => 'raindrops_place_of_site_title_validate',
			'type'				 => 'radio',
			'choices'			 => array(
				'above'			 => esc_html__( 'Above the header image', 'Raindrops' ),
				'header_image'	 => esc_html__( 'In the header image', 'Raindrops' ),
			),
			'section'			 => 'title_tagline',
		),
		"raindrops_site_title_font_size"	 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_site_title_font_size' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Font Size of Site Title', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => '<p>' . esc_html__( 'default value none, or 1-10( percent of viewport width )', 'Raindrops' ) . '</p>',
			'sanitize_callback'	 => 'raindrops_site_title_font_size_validate',
			'type'				 => 'range',
			'input_attrs'		 => array(
				'min'	 => 1,
				'max'	 => 10,
				'step'	 => 0.1,
				'class'	 => 'site-title-font-size test',
				'style'	 => '',
			),
			'active_callback'	 => 'raindrops_place_of_site_title_callback',
			'section'			 => 'title_tagline',
		),
		"raindrops_site_title_top_margin"	 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_site_title_top_margin' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Top Margin in the header image', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => '<p>' . esc_html__( ' default value is 1 . set 0 between 100 ( percent )', 'Raindrops' ) . '</p>',
			'sanitize_callback'	 => 'raindrops_site_title_top_margin_validate',
			/* 'type'				 => 'text', */
			'type'				 => 'range',
			'input_attrs'		 => array(
				'min'	 => 1,
				'max'	 => 100,
				'step'	 => 1,
				'class'	 => 'site-title-left_margin',
				'style'	 => 'color: #0a0',
			),
			'active_callback'	 => 'raindrops_place_of_site_title_callback',
			'section'			 => 'title_tagline',
		),
		
		"raindrops_site_title_left_margin_type"	 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_site_title_left_margin_type' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'The choice of left margin how to set', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => '',
			'sanitize_callback'	 => 'raindrops_site_title_left_margin_type_validate',
			'type'				 => 'radio',
			'choices'		 => array(
				'default'	 => esc_html__('Default', 'Raindrops' ),
				'centered'	 => esc_html__('Centered', 'Raindrops' ),
				'manual'	 => esc_html__('Manual Settings', 'Raindrops' ),
			),
			'active_callback'	 => 'raindrops_place_of_site_title_callback',
			'section'			 => 'title_tagline',
		),
		
		"raindrops_site_title_left_margin"	 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_site_title_left_margin' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Left Margin in the header image', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => '<p>' . esc_html__( ' default value is 1. set 0 between 100 ( percent )', 'Raindrops' ) . '</p>',
			'sanitize_callback'	 => 'raindrops_site_title_left_margin_validate',
			'type'				 => 'range',
			'input_attrs'		 => array(
				'min'	 => 1,
				'max'	 => 100,
				'step'	 => 1,
				'class'	 => 'site_title_top_margin test',
				'style'	 => 'color: #0a0',
			),
			'active_callback'	 => 'raindrops_place_of_site_title_callback_b',
			'section'			 => 'title_tagline',
		),
		

		"raindrops_site_title_css_class"		 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_site_title_css_class' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'CSS Class of Site Title', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => esc_html__( 'for example google-font-lobster default value none', 'Raindrops' ),
			'sanitize_callback'	 => 'raindrops_site_title_css_class_validate',
			'type'				 => 'text',
			'section'			 => 'title_tagline',
		),
		"raindrops_tagline_in_the_header_image"	 => array(
			'default'			 => raindrops_warehouse_clone( 'raindrops_tagline_in_the_header_image' ),
			'data_type'			 => $raindrops_setting_type,
			'autoload'			 => 'yes',
			'capability'		 => $raindrops_customize_cap,
			'label'				 => esc_html__( 'Tagline in the header image', 'Raindrops' ),
			'excerpt1'			 => '',
			'description'		 => esc_html__( 'tagline show or hide', 'Raindrops' ),
			'sanitize_callback'	 => 'raindrops_tagline_in_the_header_image_validate',
			'type'				 => 'radio',
			'choices'			 => array(
				'show'	 => esc_html__( 'Show', 'Raindrops' ),
				'hide'	 => esc_html__( 'Hide', 'Raindrops' ),
			),
			'active_callback'	 => 'raindrops_place_of_site_title_callback',
			'section'			 => 'title_tagline',
		),
	);

	if ( RAINDROPS_USE_LIST_EXCERPT !== false ) {
		$raindrops_customize_args = array_merge( $raindrops_customize_args, $raindrops_customize_args_conditional_1 );
	}


	if ( 'yes' == get_theme_mod( 'raindrops_breadcrumb_navxt_status' ) ) { //Check this when option
		$raindrops_customize_args = array_merge( $raindrops_customize_args, $raindrops_customize_args_conditional_2 );
	}

	if ( 'yes' == get_theme_mod( 'raindrops_wp_pagenavi_status' ) ) {

		$raindrops_customize_args = array_merge( $raindrops_customize_args, $raindrops_customize_args_conditional_3 );
	}

	if ( 'yes' == get_theme_mod( 'raindrops_ml_slider_status' ) ) {

		$raindrops_customize_args = array_merge( $raindrops_customize_args, $raindrops_customize_args_conditional_4 );
	}
	if ( 'yes' == get_theme_mod( 'raindrops_the_events_calendar_status' ) ) {

		$raindrops_customize_args = array_merge( $raindrops_customize_args, $raindrops_customize_args_conditional_5 );
	}
	if ( get_locale() == 'ja' ) {

		$raindrops_customize_args = array_merge( $raindrops_customize_args, $raindrops_customize_args_conditional_6 );
	}

	$place_of_site_title_setting = raindrops_warehouse_clone( 'raindrops_place_of_site_title' );

	if ( get_header_image() !== false || $place_of_site_title_setting == 'header_image' ) {

		$wp_customize->get_setting( 'raindrops_theme_settings[raindrops_place_of_site_title]' )->default = 'above';
		$raindrops_customize_args																		 = array_merge( $raindrops_customize_args, $raindrops_customize_args_conditional_7 );
	}
}

$raindrops_customize_args = raindrops_theme_mod_default_normalize( $raindrops_customize_args );

add_action( 'customize_register', 'raindrops_extend_customize_register' );

if ( !function_exists( 'raindrops_extend_customize_register' ) ) {

	function raindrops_extend_customize_register( $wp_customize ) {

		global $raindrops_theme_customize_sections, $raindrops_customize_args, $raindrops_theme_customize_panels;
		/**
		 * Create Section
		 */
		foreach ( $raindrops_theme_customize_sections as $raindrops_section_key => $raindrops_section_val ) {

			$wp_customize->add_section( $raindrops_section_key, $raindrops_section_val );
		}
		/**
		 * Create Panel
		 */
		foreach ( $raindrops_theme_customize_panels as $raindrops_panel_key => $raindrops_panel_val ) {

			$wp_customize->add_panel( $raindrops_panel_key, $raindrops_panel_val );
		}
		/**
		 * Create Default Controls
		 */
		foreach ( $raindrops_customize_args as $key => $raindrops_mod_val ) {

			if ( !isset( $raindrops_customize_args[ $key ][ 'extend_customize_setting' ] ) || empty( $raindrops_customize_args[ $key ][ 'extend_customize_setting' ] ) ) {

				$id = raindrops_data_store_relate_id( $key );

				$wp_customize->add_setting( $id, array(
					'default'				 => $raindrops_customize_args[ $key ][ 'default' ],
					'type'					 => $raindrops_customize_args[ $key ][ 'data_type' ],
					'capability'			 => $raindrops_customize_args[ $key ][ 'capability' ],
					'sanitize_callback'		 => $raindrops_customize_args[ $key ][ 'sanitize_callback' ],
					'sanitize_js_callback'	 => $raindrops_customize_args[ $key ][ 'sanitize_js_callback' ],
					'theme_supports'		 => $raindrops_customize_args[ $key ][ 'theme_supports' ],
					'transport'				 => $raindrops_customize_args[ $key ][ 'transport' ],
					'dirty'					 => $raindrops_customize_args[ $key ][ 'dirty' ],
				) );
			}

			if ( !isset( $raindrops_customize_args[ $key ][ 'extend_customize_control' ] ) || empty( $raindrops_customize_args[ $key ][ 'extend_customize_control' ] ) ) {
				$id = raindrops_data_store_relate_id( $key );
				$wp_customize->add_control( $id, array(
					'label'				 => $raindrops_customize_args[ $key ][ 'label' ],
					'section'			 => $raindrops_customize_args[ $key ][ 'section' ],
					'settings'			 => $id,
					'type'				 => $raindrops_customize_args[ $key ][ 'type' ],
					'choices'			 => $raindrops_customize_args[ $key ][ 'choices' ],
					'active_callback'	 => $raindrops_customize_args[ $key ][ 'active_callback' ],
					'priority'			 => $raindrops_customize_args[ $key ][ 'priority' ],
					'input_attrs'		 => $raindrops_customize_args[ $key ][ 'input_attrs' ],
					'description'		 => $raindrops_customize_args[ $key ][ 'description' ],
					'json'				 => $raindrops_customize_args[ $key ][ 'json' ],
				) );
			}
		}

		/**
		 * Create Custom Control
		 */
		// check
		$settings	 = 'raindrops_base_color';
		$key		 = raindrops_data_store_relate_id( $settings );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $key, array(
			'label'				 => raindrops_theme_mod( $settings, 'label' ),
			'section'			 => raindrops_theme_mod( $settings, 'section' ),
			'settings'			 => $key,
			'active_callback'	 => raindrops_theme_mod( $settings, 'active_callback' ),
			'priority'			 => raindrops_theme_mod( $settings, 'priority' ),
		) ) );
		// check
		$settings	 = 'raindrops_default_fonts_color';
		$key		 = raindrops_data_store_relate_id( $settings );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $key, array(
			'label'				 => raindrops_theme_mod( $settings, 'label' ),
			'section'			 => raindrops_theme_mod( $settings, 'section' ),
			'settings'			 => $key,
			'active_callback'	 => raindrops_theme_mod( $settings, 'active_callback' ),
			'priority'			 => raindrops_theme_mod( $settings, 'priority' ),
		) ) );

		$settings	 = 'raindrops_footer_color';
		$key		 = raindrops_data_store_relate_id( $settings );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $key, array(
			'label'				 => raindrops_theme_mod( $settings, 'label' ),
			'section'			 => raindrops_theme_mod( $settings, 'section' ),
			'settings'			 => $key,
			'active_callback'	 => raindrops_theme_mod( $settings, 'active_callback' ),
			'priority'			 => raindrops_theme_mod( $settings, 'priority' ),
		) ) );

		$settings	 = 'raindrops_hyperlink_color';
		$key		 = raindrops_data_store_relate_id( $settings );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $key, array(
			'label'		 => raindrops_theme_mod( $settings, 'label' ),
			'section'	 => raindrops_theme_mod( $settings, 'section' ),
			'settings'	 => $key,
			//'active_callback'	 => raindrops_theme_mod( $settings, 'active_callback' ),
			'priority'	 => raindrops_theme_mod( $settings, 'priority' ),
		) ) );

		$settings	 = 'raindrops_footer_link_color';
		$key		 = raindrops_data_store_relate_id( $settings );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $key, array(
			'label'				 => raindrops_theme_mod( $settings, 'label' ),
			'section'			 => raindrops_theme_mod( $settings, 'section' ),
			'settings'			 => $key,
			'active_callback'	 => raindrops_theme_mod( $settings, 'active_callback' ),
			'priority'			 => raindrops_theme_mod( $settings, 'priority' ),
		) ) );
		
		/**
		 * Exstra Menu
		 */
		$wp_customize->add_setting( 'raindrops_changelog_setting', array(
			'default'			 => '',
			'type'				 => '',
			'capability'		 => 'edit_theme_options',
			'sanitize_callback'	 => 'esc_html',
		) );
		$wp_customize->add_control( new Raindrops_Customize_Changelog_Control( $wp_customize,  'raindrops_changelog_setting'  , array(
			'label'			 => esc_html__('Change Log','Raindrops' ),
			'description'	 => esc_html__( 'Most Recent Changes', 'Raindrops' ),
			'section'		 => 'raindrops_theme_settings_document',
			'settings'		 => 'raindrops_changelog_setting',			
		) ) );


	}

}
if ( class_exists( 'WP_Customize_Control' ) ) {

	if ( !class_exists( 'Raindrops_Customize_Changelog_Control' ) ) {

		class Raindrops_Customize_Changelog_Control extends WP_Customize_Control {

			public $type = 'changelog';

			public function render_content() {
				$changelog_url = get_template_directory_uri(). '/changelog.txt';
				$part_data = wp_remote_get(  $changelog_url );			
				$part_data = preg_match( '!Changelog(.+?)Files Modified!siu',$part_data['body'],$regs);
				$part_data = esc_html( $regs[1] );
				$part_data = wpautop( $part_data );

				$html = '<div class="raindrops-changelog">
							<span class="raindrops-customize-content customize-control-title">%1$s</span>
							<span class="raindrops-description changelog">%4$s</span>
							<div class="raindrops-recent-changes raindrops-box">					
							%2$s</div>
							<p><a href="%3$s" target="_blank">%1$s</a></p>
						</div>';
				printf( $html, esc_html( $this->label ), $part_data, esc_url( $changelog_url ),esc_html( $this->description ) );
			}
		}
	}
}


/**
 *  Sidebar CSS
 */
/**
 * Pending Now
 * 	/*
  .wp-full-overlay-sidebar{ background: #000; }
  #customize-theme-controls{border:1px solid red;}

  #customize-theme-controls .control-section .accordion-section-title{
  background:#000;color:#fff;
  }
  #customize-theme-controls .control-section.open .accordion-section-title{
  background:#000;color:#fff;
  }
  #customize-theme-controls .control-section.control-panel > .accordion-section-title:after{
  background:#000;color:#fff;
  }
  #customize-theme-controls .control-section.open .accordion-section-content{
  background:#000;color:#fff;
  }
  #customize-theme-controls .control-section.open .accordion-section-content{
  background:#000;color:#fff;
  }
  #customize-controls .description{
  background:#000;color:#fff;
  }

  } */
/**
 * Pending Now
 * active callback menu, has child settings marker test
#customize-control-raindrops_theme_settings-raindrops_hyperlink_color label{
	width:100%;
	}
#customize-control-raindrops_theme_settings-raindrops_hyperlink_color .customize-control-title{
	display:block;
	width:100%;
	}
#customize-control-raindrops_theme_settings-raindrops_hyperlink_color .customize-control-title:after {
	color:#000;
	position:absolute;
	right:20px;
    content: "v";
}
 */

add_action( 'customize_controls_enqueue_scripts', 'raindrops_customizer_style' );



function raindrops_customizer_style() {

	$css = <<<CUSTOMIZER_CSS

.customize-control-header .header-view{
	display:inline-block;
	max-width:285px;
	margin:3px;
	}
#raindrops-customizer-preview-menu {
	text-align: right;
	padding: 10px;
	display:block;
	height:46px;
	box-sizing:border-box;
}
#customize-header-actions{
		border-color:rgba(152,152,152,.9)!important;
	}
.accordion-section-content{
	color:#000;
	}
#customize-info .accordion-section-title{
		background:transparent;
		color:inherit;
		border:none;
	}
#raindrops-customizer-preview-menu #raindrops-customizer-label,
#raindrops-customizer-preview-menu #range_val,
#raindrops-customizer-preview-menu #raindrops-customizer-width{
	display:inline-block;
	margin:0 1em;
}
#raindrops-customizer-preview-menu a{
	
}
#raindrops-customizer-preview-menu a:hover{
	color:orange;
}
#customize-theme-controls li[id^=customize-control-widget_raindrops_pinup_entry_widget] label{
	width:100%;
}
#customize-theme-controls .raindrops-pinup-entry-style{
	width:100%;
	max-width:100%;
	margin-bottom:2em;
}
.raindrops-box{
	padding:1em;
	box-sizing:border-box;
	margin:1em 0;
}
.raindrops-recent-changes{
	background:#efefef;
	color:#333;
}
	/*test*/
.raindrops-active {
    -webkit-animation-delay: 2s; 
    animation-delay: 2s;
    -webkit-animation: fadein 5s; 
       -moz-animation: fadein 5s;
        -ms-animation: fadein 5s;
         -o-animation: fadein 5s;
            animation: fadein 5s;

}

@keyframes fadein {
    from { background: yellow; }
    to   { background: white; }
}


@-moz-keyframes fadein {
    from { background: yellow; }
    to   { background: white; }
}

@-webkit-keyframes fadein {
    from { background: yellow; }
    to   { background: white; }
}

@-ms-keyframes fadein {
     from { background: yellow; }
    to   { background: white; }
}

@-o-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}
CUSTOMIZER_CSS;
/**
 * Transitonal conditional current version WordPress 4.3 No need below
 */
	$current_admin_color = get_user_option( 'admin_color' );
	
	if( 'fresh' == $current_admin_color ) {
		$css .= '#customize-info .accordion-section-title{ color:#333;}';	
	}
	wp_add_inline_style( 'customize-controls', $css );
}

add_action( 'customize_controls_print_scripts', 'raindrops_print_scripts' );

function raindrops_print_scripts() {
	global $raindrops_current_data_version, $raindrops_customizer_admin_color;
	wp_enqueue_script( 'raindrops-customize', get_template_directory_uri() . '/lib/customize.js', array( 'jquery' ), $raindrops_current_data_version, true );
	wp_localize_script( 'raindrops-customize', 'raindrops_customizer_script_vars', array(
		'preview_label' => __( 'Preview Width', 'Raindrops' ),
		'basic_config_label' => __( 'Basic Config', 'Raindrops' ),
		'home_url' => esc_url( home_url() ),
		'admin_color' => $raindrops_customizer_admin_color,
	) );
}

?>