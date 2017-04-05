<?php
function raindrops_show_related_posts_thumbnail_fallback_validate($input){
	return esc_url_raw( $input );
}
function raindrops_show_related_posts_thumbnail_validate($input){
	if( 'show' == $input || 'hide' == $input ) {
		return $input;
	}
	return 'show';
}
function raindrops_show_related_posts_excerpt_length_validate($input){
	if( is_numeric( $input ) ) {

		return intval( $input );
	}
	return 100;
	
}
function raindrops_show_related_posts_line_clip_validate($input){
	if( is_numeric( $input ) || 'no' == $input ) {
		if( 'no' == $input ) {
			return $input;
		} else {
			return intval( $input );
		}
	} else {
		return 'no';
	}			
}
function raindrops_show_related_posts_title_validate($input){
	
	return esc_html($input);
}
function raindrops_show_related_posts_count_validate($input){
	
	if( is_numeric( $input ) ) {
		return intval( $input );
	} else {
		return 4;
	}			
	
}
function raindrops_show_related_posts_orderby_validate($input){
	
	if( 'rand' == $input || 'post_date' == $inpug ) {
		return $input;
	} else {
		return 'post_date';
	}
	
}
function raindrops_show_related_posts_type_validate($input) {
	
	if( 'automatic' == $input || 'category' == $input || 'post_tag' == $input || 'recent_posts' == $input ) {
		return $input;
	} else {
		return 'recent_posts';
	}
	
}
function raindrops_show_related_posts_validate($input) {
	
	if('yes' == $input || 'no' == $input){
		return $input;
	} else {
		return 'yes';
	}
}
function raindrops_text_transform_of_title_validate($input) {
	if( $input == 'yes' || $input == 'no'  ) {
		return $input;
	} else {
		return 'no';
	}		
}
function raindrops_content_elements_margin_validate($input) {
	if( is_numeric( $input ) ) {
		return floatval( $input );
	} else {
		return 1;
	}			
}
function raindrops_content_width_setting_validate($input) {
	if( $input == 'keep' || $input == 'fit'  ) {
		return $input;
	} else {
		return 'keep';
	}			
}
function raindrops_primary_menu_background_validate($input) {
	$input = str_replace( "#", "", $input );

	if ( ctype_xdigit( $input ) ) {

		return '#' . $input;
	} else {
		
		return '';
	}
}
function raindrops_primary_menu_color_validate($input) {
	$input = str_replace( "#", "", $input );

	if ( ctype_xdigit( $input ) ) {

		return '#' . $input;
	} else {
		
		return '';
	}
}
function raindrops_widget_archives_validate($input) {
	if( $input == 'yes' || $input == 'no'  ) {
		return $input;
	} else {
		return 'no';
	}			
}
function raindrops_widget_categories_validate($input) {
	if( $input == 'yes' || $input == 'no'  ) {
		return $input;
	} else {
		return 'no';
	}			
}
function raindrops_widget_recent_posts_validate($input) {
	if( $input == 'yes' || $input == 'no'  ) {
		return $input;
	} else {
		return 'no';
	}			
}
function raindrops_color_coded_post_tag_validate($input) {
	if( $input == 'yes' || $input == 'no'  ) {
		return $input;
	} else {
		return 'yes';
	}			
}
function raindrops_color_coded_category_validate($input) {
	if( $input == 'yes' || $input == 'no'  ) {
		return $input;
	} else {
		return 'yes';
	}			
}
function raindrops_extra_sidebar_responsive_breakpoint_validate($input) {
	if( is_numeric( $input )  ) {
		return absint( $input );
	} else {
		return raindrops_warehouse_clone( 'raindrops_extra_sidebar_responsive_breakpoint','option_value' );
	}			
}
function raindrops_default_sidebar_responsive_breakpoint_validate($input) {
	if( is_numeric( $input )  ) {
		return absint( $input );
	} else {
		return raindrops_warehouse_clone( 'raindrops_default_sidebar_responsive_breakpoint','option_value' );
	}			
}
function raindrops_extra_sidebar_responsive_validate($input) {
	if( $input == 'yes' || $input == 'no'  ) {
		return $input;
	} else {
		return 'yes';
	}			
}
function raindrops_default_sidebar_responsive_validate($input) {
	if( $input == 'yes' || $input == 'no'  ) {
		return $input;
	} else {
		return 'yes';
	}			
}

function raindrops_show_date_author_in_page_validate( $input ) {
	if( $input == 'yes' || $input == 'no'  ) {
		return $input;
	} else {
		return 'no';
	}				
}
function raindrops_show_date_author_in_attachment_validate( $input ) {
	if( $input == 'yes' || $input == 'no'  ) {
		return $input;
	} else {
		return 'no';
	}				
}
function raindrops_color_select_validate( $input ) {
	
	if( $input == 'automatic' || $input == 'custom'  ) {
		return $input;
	} else {
		return 'automatic';
	}			
}
function raindrops_reset_options_validate( $input ) {
	if( $input == 'yes' || $input == 'no'  ) {
		return $input;
	} else {
		return 'no';
	}			
	
}
function raindrops_sticky_menu_validate( $input ) {
	if( $input == 'yes' || $input == 'no'  ) {
		return $input;
	} else {
		return 'yes';
	}		
}
function raindrops_sidebar_posts_page_validate( $input ) {
	
	$input = (int) $input;
	if( $input == 1 || $input == 2 || $input == 3 ) {
		return $input;
	} else {
		return 3;
	}		
}
function raindrops_sidebar_format_aside_archive_validate( $input ) {
	
	$input = (int) $input;
	if( $input == 1 || $input == 2 || $input == 3 ) {
		return $input;
	} else {
		return 3;
	}		
}
function raindrops_sidebar_format_chat_archive_validate( $input ) {
	
	$input = (int) $input;
	if( $input == 1 || $input == 2 || $input == 3 ) {
		return $input;
	} else {
		return 3;
	}		
}
function raindrops_sidebar_format_gallery_archive_validate( $input ) {
	
	$input = (int) $input;
	if( $input == 1 || $input == 2 || $input == 3 ) {
		return $input;
	} else {
		return 3;
	}		
}
function raindrops_sidebar_format_audio_archive_validate( $input ) {
	
	$input = (int) $input;
	if( $input == 1 || $input == 2 || $input == 3 ) {
		return $input;
	} else {
		return 3;
	}		
}
function raindrops_sidebar_format_video_archive_validate( $input ) {
	
	$input = (int) $input;
	if( $input == 1 || $input == 2 || $input == 3 ) {
		return $input;
	} else {
		return 3;
	}		
}
function raindrops_sidebar_format_status_archive_validate( $input ) {
	
	$input = (int) $input;
	if( $input == 1 || $input == 2 || $input == 3 ) {
		return $input;
	} else {
		return 3;
	}		
}
function raindrops_sidebar_format_quote_archive_validate( $input ) {
	
	$input = (int) $input;
	if( $input == 1 || $input == 2 || $input == 3 ) {
		return $input;
	} else {
		return 3;
	}		
}
function raindrops_sidebar_format_image_archive_validate( $input ) {
	
	$input = (int) $input;
	if( $input == 1 || $input == 2 || $input == 3 ) {
		return $input;
	} else {
		return 3;
	}		
}
function raindrops_sidebar_format_link_archive_validate( $input ) {
	
	$input = (int) $input;
	if( $input == 1 || $input == 2 || $input == 3 ) {
		return $input;
	} else {
		return 3;
	}		
}
function raindrops_display_site_title_validate( $input ) {
	if( $input == 'show' || $input == 'hide'  ) {
		return $input;
	} else {
		return 'show';
	}			
}
function raindrops_tooltip_validate( $input ) {
	if( $input == 'yes' || $input == 'no'  ) {
		return $input;
	} else {
		return 'yes';
	}		
}
function raindrops_primary_menu_responsive_validate( $input ) {
	if( $input == 'yes' || $input == 'no'  ) {
		return $input;
	} else {
		return 'yes';
	}		
}
function raindrops_sidebar_pdf_archive_validate( $input ) {
	$input = (int) $input;
	if( $input == 1 || $input == 2 || $input == 3 ) {
		return $input;
	} else {
		return 3;
	}	
}
function raindrops_custom_footer_credit_validate( $input ) {
	
	if( empty( $input ) ) {
		
		return '';
	}else{
		
		$input = strip_tags( $input, '<address><span><a><br><img>');
		return $input;
	}

}
function raindrops_fallback_image_for_entry_content_validate( $input ) {

	$result = filter_var( trim($input), FILTER_VALIDATE_URL );
	if( false === $result || $input == 'default' ) {

		return raindrops_warehouse_clone( 'raindrops_fallback_image_for_entry_content','option_value' );
	}
	return $result;
}
function raindrops_posted_on_position_validate( $input ) {
	if( $input == 'before' || $input == 'after'  ) {
		return $input;
	} else {
		return 'before';
	}			
}
function raindrops_posted_in_position_validate( $input ) {
	if( $input == 'before' || $input == 'after'  ) {
		return $input;
	} else {
		return 'after';
	}			
}
function raindrops_archive_nav_above_validate( $input ) {
	if( $input == 'show' || $input == 'hide'  ) {
		return $input;
	} else {
		return 'hide';
	}		
}
function raindrops_archive_title_label_validate( $input ) {
	if( $input == 'show' || $input == 'hide' || $input == 'emoji' ) {
		return $input;
	} else {
		return 'hide';
	}	
}
function raindrops_comments_are_closed_validate( $input ) {
	if( $input == 'show' || $input == 'hide'  ) {
		return $input;
	} else {
		return 'hide';
	}	
}
function raindrops_posted_in_label_validate( $input ) {
	if( $input == 'show' || $input == 'hide' || $input == 'emoji' ) {
		return $input;
	} else {
		return 'hide';
	}	
}

function raindrops_sitewide_css_validate( $input ) {

	$value =  wp_strip_all_tags( $input );
	
	if ( empty( $value ) ) {
		return '';
	}	
	// format
	$value = str_replace(array("\r\n","\r","\n"),'',$value);
	$value = str_replace( array( '{', '}', "\t"), array( "{\n\t", "}\n", '    '), $value );
	$value = str_replace( '![^(\"|\')];!', ";\n", $value );
	$value = str_replace( ';',";\n    ", $value);
	$value = str_replace( "    }","}", $value);
	$value = preg_replace("!^(\s|\t)*$!msi",'',$value);
	
	return $value;
}
function raindrops_display_sticky_post_validate( $input ) {
	
	if( $input == 'anytime' || $input == 'only_home' ) {
		return $input;
	}
	return 'anytime';
}
function raindrops_options_owner_validate( $input ) {

	if( $input == 'raindrops' || $input == 'boots' ) {
		return $input;
	}
	return 'not valid';
}
function raindrops_enable_header_image_filter_validate( $input ) {
	
	if ( 'enable' == $input) {
		return $input;
	}
	return 'disable';
}
function raindrops_header_image_filter_apply_bottom_validate( $input ) {
	
	if( is_numeric( $input ) && ( $input == 0 || $input > 0 || $input < 1 || $input == 1) ) {
		return $input;
	}
	return 0;
}
function raindrops_header_image_filter_apply_top_validate( $input ) {
	
	if( is_numeric( $input ) && ( $input == 0 || $input > 0 || $input < 1 || $input == 1) ) {
		return $input;
	}
	return 0;
}
function raindrops_header_image_filter_color_validate( $input ) {
	/*
	 * @since 1.306
	 */
	$input = str_replace( "#", "", $input );

	if ( ctype_xdigit( $input ) ) {

		return '#' . $input;
	} else {
		
		return '';
	}
	//return sanitize_hex_color( $input );
}
function raindrops_parent_theme_mods_validate( $input ) {
	if( $input == 'import'  ) {
		return $input;
	} 
	return 'no';
}
function raindrops_stylesheet_in_html_validate( $input ) {
	if( $input == 'embed' || $input == 'external' ) {
		return $input;
	} 
	return 'embed';
}
function raindrops_excerpt_length_validate( $input ) {	
	if( is_numeric( $input ) ) {
		$input = absint( $input );
		if( $input > 19 && $input < 401 ) {
			
			return $input;
		}		
	}
	return 200;
}
function raindrops_sidebar_tag_validate( $input ) {
	$input = (int) $input;
	if( $input == 1 || $input == 2 || $input == 3 ) {
		return $input;
	} else {
		return 3;
	}	
}
function raindrops_site_title_left_margin_type_validate( $input ) {
	
	if( $input == 'default' || $input == 'centered' || $input == 'manual' ) {
		return $input;
	} else {
		return 'default';
	}		
}
function raindrops_sidebar_image_archive_validate( $input ) {
	$input = (int) $input;
	if( $input == 1 || $input == 2 || $input == 3 ) {
		return $input;
	} else {
		return 3;
	}	
}
function raindrops_display_default_category_validate( $input ) {
	if( $input == 'show' || $input == 'hide'  ) {
		return $input;
	} else {
		return 'show';
	}
}
function raindrops_display_article_author_validate( $input ) {
	if( $input == 'show' || $input == 'hide' || $input == 'avatar' ) {
		return $input;
	} else {
		return 'show';
	}
}
function raindrops_display_article_publish_date_validate( $input ) {
	if( $input == 'show' || $input == 'hide' || $input == 'emoji' ) {
		return $input;
	} else {
		return 'show';
	}
}
function raindrops_article_title_css_class_validate( $input ) {
	
	$post_class = '';
	
	$classes = explode(' ', $input );

	
	if( 1 == count( $classes ) ) {

		$post_class = sanitize_html_class( $input );
		
	}elseif(  1 < count( $classes ) ) {
		
		foreach( $classes as $class ) {
			
			$post_class .= ' '. sanitize_html_class( $class );
		}
		$post_class = trim( $post_class );
	}

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
function raindrops_sidebar_category_validate( $input ) {
	$input = (int) $input;
	if( $input == 1 || $input == 2 || $input == 3 ) {
		return $input;
	} else {
		return 3;
	}	
}
function raindrops_sidebar_author_validate( $input ) {
	$input = (int) $input;
	if( $input == 1 || $input == 2 || $input == 3 ) {
		return $input;
	} else {
		return 3;
	}	
}
function raindrops_full_width_limit_window_width_validate( $input ) {
	if( is_numeric( $input ) ) {
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
	$input = (int) $input;
	if( $input == 1 || $input == 2 || $input == 3 ) {
		return $input;
	} else {
		return 3;
	}	
}

function raindrops_sidebar_404_validate( $input ) {
	$input = (int) $input;
	if( $input == 1 || $input == 2 || $input == 3 ) {
		return $input;
	} else {
		return 3;
	}	
}
function raindrops_sidebar_search_validate( $input ) {
	$input = (int) $input;
	if( $input == 1 || $input == 2 || $input == 3 ) {
		return $input;
	} else {
		return 3;
	}	
}
function raindrops_sidebar_single_validate( $input ) {
	$input = (int) $input;
	if( $input == 1 || $input == 2 || $input == 3 ) {
		return $input;
	} else {
		return 3;
	}	
}
function raindrops_sidebar_page_validate( $input ) {
	$input = (int) $input;
	if( $input == 1 || $input == 2 || $input == 3 ) {
		return $input;
	} else {
		return 3;
	}	
}
function raindrops_sidebar_date_validate( $input ) {
	$input = (int) $input;
	if( $input == 1 || $input == 2 || $input == 3 ) {
		return $input;
	} else {
		return 3;
	}	
}
function raindrops_sidebar_index_validate( $input ) {
	$input = (int) $input;
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
	
	if( $input == 'show' || $input == 'hide' || $input == 'above') {
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
	return $max_num_post;
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

	if ( $input == 'content' || $input == 'excerpt' || $input == 'none' || $input == 'excerpt_grid' ) {

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

	if ( $input == 'content' || $input == 'excerpt' || $input == 'none' || $input == 'excerpt_grid' ) {

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

	if ( $input == 'content' || $input == 'excerpt' || $input == 'none' || $input == 'excerpt_grid' ) {

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

		$value = array( 'choices'			 => array(
				'25' => __( '25%', 'raindrops' ),
				'33' => __( '33%', 'raindrops' ),
				'50' => __( '50%', 'raindrops' ),
				'66' => __( '66%', 'raindrops' ),
				'75' => __( '75%', 'raindrops' ),
			),
		);
		if( array_key_exists ( $input, $value['choices'] ) ) {
			return $input;
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

		$value = array( 'choices'			 => array(
				'show'	 => __( 'Show', 'raindrops' ),
				'hide'	 => __( 'Hide', 'raindrops' ),
			),
		);
		if( array_key_exists ( $input, $value['choices'] ) ) {
			return $input;
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

		$value = array( 'choices'			 => array(
				't1' => __( 'left 160px', 'raindrops' ),
				't2' => __( 'left 180px', 'raindrops' ),
				't3' => __( 'left 300px', 'raindrops' ),
				't4' => __( 'right 180px', 'raindrops' ),
				't5' => __( 'right 240px', 'raindrops' ),
				't6' => __( 'right 300px', 'raindrops' ),
			),
		);
		if( array_key_exists ( $input, $value['choices'] ) ) {
			return $input;
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

		$value = array('choices'			 => array(
				'doc'	 => __( '750px centered', 'raindrops' ),
				'doc2'	 => __( '950px centered', 'raindrops' ),
				'doc4'	 => __( '974px', 'raindrops' ),			
				'doc3'	 => __( 'Box Layout Responsive', 'raindrops' ),
				'doc5'   => __( 'Full Width Resuponsive', 'raindrops' ),
				),
			);

		if( array_key_exists ( $input, $value['choices'] ) ) {
			return $input;
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

		return ' ' .wp_strip_all_tags( $input );
		
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

/**
 * for @1.401+
 */
		$options = get_option( 'raindrops_theme_settings' );

		if( isset($options[$option]) && !empty( $options[$option] ) ) {
			
			foreach( $options as $key => $val) {
				
				if( $key == $option ) {
					
					$validate_function = $key.'_validate';
					
					$val = $validate_function( $new_value );
			
					$options[ $key ] = $val;
				}
			}
			
			$result = update_option( 'raindrops_theme_settings', $options );
			return $result;
		}
		
/* below old code lt @1.400 */
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