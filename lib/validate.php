<?php

function raindrops_display_default_category_validate( $input ) {
	if( $input == 'show' || $input == 'hide'  ) {
		return $input;
	} else {
		return 'show';
	}
}
function raindrops_display_article_author_validate( $input ) {
	if( $input == 'show' || $input == 'hide'  ) {
		return $input;
	} else {
		return 'show';
	}
}
function raindrops_display_article_publish_date_validate( $input ) {
	if( $input == 'show' || $input == 'hide'  ) {
		return $input;
	} else {
		return 'show';
	}
}
function raindrops_article_title_css_class_validate( $input ) {
	
	$post_class = sanitize_html_class( $input );
	return $post_class;
}
function raindrops_status_bar_validate( $input ) {
	if( $input == 'show' || $input == 'hide'  ) {
		return $input;
	} else {
		return 'show';
	}
}
function raindrops_actions_hook_message_validate( $input ) {
	if( $input == 'show' || $input == 'hide'  ) {
		return $input;
	} else {
		return 'hide';
	}
}
function raindrops_xhtml_media_type_validate( $input ) {

	if( $input == 'text/html' || $input == 'application/xhtml+xml'  ) {
		return $input;
	} else {
		return 'text/html';
	}
}
function raindrops_sidebar_catetory_validate( $input ) {
	if( $input == 1 || $input == 2 || $input == 3 ) {
		return $input;
	} else {
		return 3;
	}	
}
function raindrops_sidebar_author_validate( $input ) {
	if( $input == 1 || $input == 2 || $input == 3 ) {
		return $input;
	} else {
		return 3;
	}	
}
function raindrops_full_width_limit_window_width_validate( $input ) {
	if( is_mumeric( $input ) ) {
		return $input;
	} else {
		return 1920;
	}		
	
}
function raindrops_full_width_max_width_validate( $input ) {
	
	if( is_numeric( $input ) ) {
		return $input;
	} else {
		return 1280;
	}	
}
function raindrops_sidebar_list_of_post_validate( $input ) {
	if( $input == 1 || $input == 2 || $input == 3 ) {
		return $input;
	} else {
		return 3;
	}	
}

function raindrops_sidebar_404_validate( $input ) {
	if( $input == 1 || $input == 2 || $input == 3 ) {
		return $input;
	} else {
		return 3;
	}	
}
function raindrops_sidebar_search_validate( $input ) {
	if( $input == 1 || $input == 2 || $input == 3 ) {
		return $input;
	} else {
		return 3;
	}	
}
function raindrops_sidebar_single_validate( $input ) {
	if( $input == 1 || $input == 2 || $input == 3 ) {
		return $input;
	} else {
		return 3;
	}	
}
function raindrops_sidebar_page_validate( $input ) {
	if( $input == 1 || $input == 2 || $input == 3 ) {
		return $input;
	} else {
		return 3;
	}	
}
function raindrops_sidebar_date_validate( $input ) {
	if( $input == 1 || $input == 2 || $input == 3 ) {
		return $input;
	} else {
		return 3;
	}	
}
function raindrops_sidebar_index_validate( $input ) {
	if( $input == 1 || $input == 2 || $input == 3 ) {
		return $input;
	} else {
		return 3;
	}	
}
function raindrops_col_setting_type_validate( $input ) {
	if( $input == 'simple' || $input == 'details' ) {
		return $input;
	} else {
		return 'simple';
	}	
}
function raindrops_tagline_in_the_header_image_validate( $input ) {
	
	if( $input == 'show' || $input == 'hide' ) {
		return $input;
	}	
	return 'show';	
}
function raindrops_site_title_css_class_validate( $input ) {
	
	$input = wp_kses( $input, array() );
	
	return $input;
	
}
function raindrops_site_title_font_size_validate( $input ) {
	
	if( is_numeric( $input ) && $input < 11 ) {
		return $input;
	}
	return 'none';
}
function raindrops_site_title_top_margin_validate( $input ) {
	
	if( is_numeric( $input ) && $input < 101 ) {
		return $input;
	}
	return 0;	
}
function raindrops_site_title_left_margin_validate( $input ) {
	
	if( is_numeric( $input ) && $input < 101 ) {
		return $input;
	}
	return 0;	
}
function raindrops_place_of_site_title_validate( $input ) {
	
	if( $input == 'above' || $input == 'header_image' ) {
		return $input;
	}	
	return 'above';
}
function raindrops_allow_oembed_excerpt_view_validate( $input ) {

	if( $input == 'yes' || $input == 'no' ) {
		return $input;
	}
	return 'yes';	
}
function raindrops_excerpt_enable_validate( $input ) {

	if( $input == 'yes' || $input == 'no' ) {
		return $input;
	}
	return 'no';
}
function raindrops_read_more_after_excerpt_validate( $input ) {

	if( $input == 'yes' || $input == 'no' ) {
		return $input;
	}
	return 'no';	
}
function raindrops_japanese_date_validate( $input ) {
	
	if( $input == 'yes' || $input == 'no' ) {
		return $input;
	}
	return 'no';	
}

function raindrops_use_featured_image_emphasis_validate( $input ) {
	
	if( $input == 'yes' || $input == 'no' ) {
		return $input;
	}
	return 'no';
}

function raindrops_featured_image_singular_validate( $input ) {

	if ( $input == 'show' || $input == 'hide' || $input == 'lightbox' ) {
		
		return $input;
	}
	return 'show';
}
function raindrops_featured_image_recent_post_count_validate( $input ) {
// todo post per page
	$max_num_post = get_option('posts_per_page');

	if( is_numeric( $input ) && $input < $max_num_post + 1 ) {
		
		return absint( $input ) ;
	}
	return 3;
}
function raindrops_featured_image_size_validate( $input ) {
// todo get_intermadiate_image_sizes
	$raindrops_featured_image_size_array = get_intermediate_image_sizes();
			
	if ( false !== array_search ( $input , $raindrops_featured_image_size_array ) ) {
		
		return $input;
	}	
	return 'thumbnail';
}
function raindrops_featured_image_position_validate( $input ) {
	
	if ( $input == 'left' || $input == 'front' ) {
		
		return $input;
	}
	return 'left';
}

function raindrops_menu_primary_min_width_validate( $input ) {
	
	if( is_numeric( $input ) && 0 < $input && 96 > $input ) {
		
		return $input;
	}
	return 10;
}
function raindrops_menu_primary_font_size_validate( $input ) {
	
	if( is_numeric( $input ) && 76 < $input && 183 > $input ) {
		
		return $input;
	}
	return 100;
}
function raindrops_uninstall_option_validate( $input ) {
	
	if( $input == 'delete' ) {
		
		return 'delete';
	}
	return 'keep';
}
function raindrops_sync_style_for_tinymce_validate( $input ) {
	
	if ( $input == 'yes' ) {

		return 'yes';
	}
	return 'none';		
}
function raindrops_disable_keyboard_focus_validate( $input ) {
	
	if ( $input == 'disable' ) {

		return 'disable';
	}
	return 'enable';	
}
function raindrops_plugin_presentation_the_events_calendar_validate( $input ) {
	
	if ( $input == 'yes' ) {

		return 'yes';
	}
	return 'none';		
	
}
function raindrops_plugin_presentation_meta_slider_validate( $input ) {

	if ( preg_match( '/[^(0-9)]+/si', $input ) ) {
		
		return 'none';
		
	} else {
		
		return absint( $input );
	}
	
}
function raindrops_plugin_presentation_wp_pagenav_validate( $input ) {
	
	if ( $input == 'yes' ) {

		return 'yes';
	}
	return 'none';	
}
function raindrops_plugin_presentation_bcn_nav_menu_validate( $input ) {
	
	if ( $input == 'yes' ) {

		return 'yes';
	}
	return 'none';	
}
/**
 * 
 * @param type $input
 * @return string
 * @since 1.243
 */
function raindrops_complementary_color_for_title_link_validate( $input ) {

	if ( $input == 'yes' ) {

		return 'yes';
	}
	return 'none';
}

/**
 * 
 * @param type $input
 * @return type
 */
function raindrops_footer_link_color_validate( $input ) {

	$input = str_replace( "#", "", $input );

	if ( ctype_xdigit( $input ) ) {

		return '#' . $input;
	} else {
		
		return '';
	}
}

/**
 * 
 * @param type $input
 * @return string
 * @since 1.238
 */
function raindrops_entry_content_is_search_validate( $input ) {

	if ( $input == 'content' || $input == 'excerpt' || $input == 'none') {

		return $input;
	}

	return 'content';
}

/**
 * 
 * @param type $input
 * @return string
 * @since 1.238
 */
function raindrops_entry_content_is_tag_validate( $input ) {

	if ( $input == 'content' || $input == 'excerpt' || $input == 'none') {

		return $input;
	}

	return 'content';
}

/**
 * 
 * @param type $input
 * @return string
 * @since 1.238
 */
function raindrops_entry_content_is_category_validate( $input ) {

	if ( $input == 'content' || $input == 'excerpt' || $input == 'none') {

		return $input;
	}

	return 'content';
}

/**
 * 
 * @param type $input
 * @return string
 * @since 1.238
 */
function raindrops_entry_content_is_home_validate( $input ) {

	if ( $input == 'content' || $input == 'excerpt' || $input == 'none') {

		return $input;
	}

	return 'content';
}

/**
 * Validate admin panel form value.
 *
 *
 * @param type $output
 * @return int
 */
if ( !function_exists( 'raindrops_basefont_settings_validate' ) ) {

	function raindrops_basefont_settings_validate( $output ) {

		if ( is_numeric( $output ) ) {
			return absint( $output );
		} else {
			return 13;
		}
	}

}
/**
 *
 *
 * @param type $output
 * @return int
 */
if ( !function_exists( 'raindrops_fluid_max_width_validate' ) ) {

	function raindrops_fluid_max_width_validate( $output ) {

		if ( is_numeric( $output ) ) {
			return absint( $output );
		} else {
			return 1280;
		}
	}

}
/**
 *
 * @param type $output
 * @return string
 */
if ( !function_exists( 'raindrops_doc_type_settings_validate' ) ) {

	function raindrops_doc_type_settings_validate( $output ) {

		$output = (string) $output;

		if ( 'html5' == $output || 'xhtml' == $output ) {

			return $output;
		}

		return 'html5';
	}

}
/**
 *
 * @param type $output
 * @return string
 */
if ( !function_exists( 'raindrops_accessibility_settings_validate' ) ) {


	function raindrops_accessibility_settings_validate( $output ) {

		$output = (string) $output;

		if ( 'yes' == $output || 'no' == $output ) {

			return $output;
		}
		return 'no';
	}

}
/**
 *
 * @param type $input
 * @return type
 */
if ( !function_exists( 'raindrops_use_automatic_color_validate' ) ) {

	function raindrops_use_automatic_color_validate( $input ) {

		$input = str_replace( "#", "", $input );

		if ( ctype_xdigit( $input ) ) {

			return '#' . $input;
		} else {

			return "#444444";
		}

	}

}
/**
 *
 * @param type $input
 * @return type
 */
if ( !function_exists( 'raindrops_right_sidebar_width_percent_validate' ) ) {

	function raindrops_right_sidebar_width_percent_validate( $input ) {

		$obj	 = new raindrops_menu_create();
		$vals	 = $obj->col_settings_raindrops_right_sidebar_width_percent;

		foreach ( $vals as $val ) {

			if ( $input == $val ) {

				return $input;
			}
		}
		return 25;
	}

}
/**
 *
 * @param type $input
 * @return type
 */
if ( !function_exists( 'raindrops_show_right_sidebar_validate' ) ) {

	function raindrops_show_right_sidebar_validate( $input ) {

		$obj	 = new raindrops_menu_create();
		$vals	 = $obj->col_settings_raindrops_show_right_sidebar;

		foreach ( $vals as $val ) {

			if ( $input == $val ) {

				return $input;
			}
		}
		return 'show';
	}

}
/**
 *
 * @param type $input
 * @return type
 */
if ( !function_exists( 'raindrops_footer_color_validate' ) ) {

	function raindrops_footer_color_validate( $input ) {

		if ( $input == '' ) {
			return $input;
		}

		if ( preg_match( "!#([0-9a-f]{6}|[0-9a-f]{3})!si", $input ) ) {

			return $input;
		}
		return '';
	}

}
/**
 *
 * @param type $input
 * @return type
 */
if ( !function_exists( 'raindrops_default_fonts_color_validate' ) ) {

	function raindrops_default_fonts_color_validate( $input ) {

		if ( $input == '' ) {
			return $input;
		}

		if ( preg_match( "!#([0-9a-f]{6}|[0-9a-f]{3})!si", $input ) ) {

			return $input;
		}
		return '';
	}

}
/**
 *
 * @param type $input
 * @return type
 */
if ( !function_exists( 'raindrops_col_width_validate' ) ) {

	function raindrops_col_width_validate( $input ) {

		$obj	 = new raindrops_menu_create();
		$vals	 = $obj->col_settings_raindrops_col_width;

		foreach ( $vals as $val ) {

			if ( $input == $val ) {

				return $input;
			}
		}
		return 't2';
	}

}
/**
 *
 * @param type $input
 * @return type
 */
if ( !function_exists( 'raindrops_page_width_validate' ) ) {

	function raindrops_page_width_validate( $input ) {

		$obj	 = new raindrops_menu_create();
		$vals	 = $obj->col_settings_raindrops_page_width;

		foreach ( $vals as $val ) {

			if ( $input == $val ) {

				return $input;
			}
		}
		return 'doc3';
	}

}
/**
 *
 * @param type $input
 * @return type
 */
if ( !function_exists( 'raindrops_heading_image_validate' ) ) {

	function raindrops_heading_image_validate( $input ) {

		if ( preg_match( '/[^(a-z|0-9|_|-|\.)]+/si', $input ) ) {

			return raindrops_warehouse_clone( 'raindrops_heading_image' );
		}
		return $input;
	}

}
/**
 *
 * @param type $input
 * @return type
 */
if ( !function_exists( 'raindrops_heading_image_position_validate' ) ) {

	function raindrops_heading_image_position_validate( $input ) {

		if ( is_numeric( $input ) && $input < 8 && -1 < $input ) {

			return $input;
		}

		return 0;
	}

}

/**
 *
 * @global type $raindrops_options
 * @param type $input
 * @return type
 */
if ( !function_exists( 'raindrops_footer_image_validate' ) ) {

	function raindrops_footer_image_validate( $input ) {

		global $raindrops_options;
		
		if ( preg_match( '/[^(a-z|0-9|_|-|\.)]+/si', $input ) ) {

			return raindrops_warehouse_clone( 'raindrops_footer_image' );
		}
		return $input;
	}

}
/**
 *
 * @param type $input
 * @return type
 */
if ( !function_exists( 'raindrops_header_image_validate' ) ) {

	function raindrops_header_image_validate( $input ) {

		if ( preg_match( '/[^(a-z|0-9|_|-|\.)]+/si', $input ) ) {

			return raindrops_warehouse_clone( 'raindrops_header_image' );
		}
		return $input;
	}

}
/**
 *
 * @param type $input
 * @return string
 */

if ( !function_exists( 'raindrops_style_type_validate' ) ) {

	function raindrops_style_type_validate( $input ) {

		if ( function_exists( 'raindrops_indv_css_'. $input ) ) {

			return esc_html( $input );
		} else {

			return "w3standard";
		}
	}

}
/**
 *
 * @param type $input
 * @return type
 */
if ( !function_exists( 'raindrops_base_color_validate' ) ) {

	function raindrops_base_color_validate( $input ) {

		if ( $input == '' ) {
			return $input;
		}

		if ( preg_match( "!([0-9a-f]{6}|[0-9a-f]{3})!si", $input ) ) {

			return $input;
		}
		return '#444444';
	}

}
/**
 *
 * @param type $input
 * @return type
 */
if ( !function_exists( 'raindrops_color_scheme_validate' ) ) {

	function raindrops_color_scheme_validate( $input ) {

		if ( $input == '' ) {
			return $input;
		}
		return esc_html( $input );
	}

}
/**
 *
 * @param type $input
 * @return type
 */
if ( !function_exists( '_raindrops_indv_css_validate' ) ) {

	function _raindrops_indv_css_validate( $input ) {

		// if needs core support style only
		//return safecss_filter_attr($input);
		return ' ' . strip_tags( $input );
	}

}
/**
 *
 * @param type $input
 * @return string
 */
if ( !function_exists( 'raindrops_show_menu_primary_validate' ) ) {

	function raindrops_show_menu_primary_validate( $input ) {

		if ( "show" == $input ) {

			return 'show';
		}

		return 'hide';
	}

}
/**
 *
 * @param type $input
 * @return string
 */
if ( !function_exists( 'raindrops_hyperlink_color_validate' ) ) {

	function raindrops_hyperlink_color_validate( $input ) {

		if ( '' == $input ) {
			return 'auto';
		}

		if ( preg_match( "!([0-9a-f]{6}|[0-9a-f]{3})!si", $input ) ) {

			return $input;
		}
		return '';
	}

}

/**
 * 
 * @param type $option
 * @param type $new_value
 * @return type
 */
if ( !function_exists( 'raindrops_update_theme_option' ) ) {

	function raindrops_update_theme_option( $option, $new_value ) {

		$validate_function_name = $option . '_validate';

		$options = get_option( 'raindrops_theme_settings' );

		$result = false;

		if ( !isset( $option ) or empty( $option ) ) {

			return $result;
		}
		if ( !isset( $new_value ) or empty( $new_value ) ) {

			return $result;
		}

		if ( isset( $options[ $option ] ) ) {

			$old_val = $options[ $option ];

			if ( $old_val !== $new_value ) {

				if ( function_exists( $validate_function_name ) ) {

					$options[ $option ] = $validate_function_name( $new_value );

					$result = update_option( 'raindrops_theme_settings', $options );
				} else {

					return $result;
				}
			}
		}
		return $result;
	}

}
