<?php
/**
 * Child Theme config file
 *
 *
 */
$raindrops_current_data			 = wp_get_theme( 'raindrops' );
$raindrops_current_data_version	 = $raindrops_current_data->get( 'Version' );
$raindrops_version_compare		 = version_compare(  '1.255', $raindrops_current_data_version);

if ( ! function_exists( 'raindrops_child_customizer_relate' ) && $raindrops_version_compare !== 1 ) {

	add_filter( 'raindrops_embed_meta_echo', 'raindrops_child_customizer_relate' );

	function raindrops_child_customizer_relate( $content ) {

		if ( is_child_theme() ) {
			
			return raindrops_child_embed_css( );
		} else {
			return $content;
		}
	}
}

if ( !function_exists( 'raindrops_child_embed_css' ) ) {
	/**
	 * Apply style for the theme from customizer settings
	 *
	 * @global type $post
	 * @global type $raindrops_current_theme_name
	 * @global type $raindrops_base_font_size
	 * @global type $raindrops_fluid_minimum_width
	 * @global type $raindrops_fluid_maximum_width
	 * @return type string style_rules
	 */

	function raindrops_child_embed_css() {

		global $post, $raindrops_current_theme_name, $raindrops_base_font_size, $raindrops_fluid_minimum_width, $raindrops_fluid_maximum_width,$raindrops_header_image_default_ratio;
		$pinup_style				 = '';
		$result						 = '';
		$css						 = '/*raindrops_child_embed_css*/';
		$result_indv				 = '';
		$raindrops_page_width		 = raindrops_warehouse_clone( 'raindrops_page_width' );
		$raindrops_base_color		 = raindrops_warehouse_clone( 'raindrops_base_color' );
		$raindrops_hyperlink_color	 = raindrops_warehouse_clone( 'raindrops_hyperlink_color' );

		/* Single post , page check Raindrops notation */

		$color_check = raindrops_has_indivisual_notation();

		if ( false == $color_check ) {
			$raindrops_style_type = raindrops_warehouse_clone( 'raindrops_style_type' );
		} else {
			if ( isset( $color_check[ 'color_type' ] ) ) {
				$raindrops_style_type = $color_check[ 'color_type' ];
			}
			//$columns = $color_check['col'];
		}

		$raindrops_indv_css = raindrops_design_output( $raindrops_style_type ) . raindrops_color_base();

		//when this code exists [raindrops color_type="minimal" col="1"] in the post

		$raindrops_indv_css = raindrops_color_type_custom( $raindrops_indv_css );

		$css .= apply_filters( "raindrops_indv_css", $raindrops_indv_css );

		if ( $raindrops_hyperlink_color !== '' && false == raindrops_has_indivisual_notation() ) {

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

		$css .= raindrops_embed_css();

		$css = str_replace( "raindrops_color_ja", '', $css );

		$raindrops_text_color						 = get_theme_mod( 'header_textcolor', 'ffffff' );
		$header_image								 = get_header_image();
		$raindrops_header_imge_filter_color			 = raindrops_warehouse_clone( 'raindrops_header_image_filter_color' );
		$raindrops_header_image_color_rgb_array		 = raindrops_hex2rgb_array_clone( $raindrops_header_imge_filter_color );
		$raindrops_header_image_filter_apply_top	 = raindrops_warehouse_clone( 'raindrops_header_image_filter_apply_top' );
		$raindrops_header_image_filter_apply_bottom	 = raindrops_warehouse_clone( 'raindrops_header_image_filter_apply_bottom' );
		$raindrops_enable_header_image_filter		 = raindrops_warehouse_clone( 'raindrops_enable_header_image_filter' );
		$raindrops_field_exists_check				 = get_post_custom_values( '_raindrops_this_header_image' );

		$old_ie = '';

		$http_user_agent = filter_input( INPUT_ENV, 'HTTP_USER_AGENT' );
		preg_match( "|(MSIE )([0-9]{1,2})(\.)|si", $http_user_agent, $regs );
		if ( isset( $regs[ 2 ] ) ) {
			$old_ie = 'ie' . $regs[ 2 ];
		}

		$background_property = '';
		if ( false !== $raindrops_header_image_color_rgb_array &&
		'enable' == $raindrops_enable_header_image_filter &&
		$old_ie !== 'ie8' &&
		$old_ie !== 'ie9'
		) { // client side yet 1.298
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
			$style_rule_template, $raindrops_header_image_color_rgb_array[ 0 ], $raindrops_header_image_color_rgb_array[ 1 ], $raindrops_header_image_color_rgb_array[ 2 ], $raindrops_header_image_filter_apply_top, $raindrops_header_image_filter_apply_bottom, esc_url( $header_image )
			);
		} else {
			$background_property = 'background-image:url( ' . esc_url( $header_image ) . ' );';
		}
		
		$padding_height = $raindrops_header_image_default_ratio * 100;
		$raindrops_header_image_width = absint( raindrops_detect_header_image_size_clone(  'width' ) );
		$raindrops_header_image_height = absint( raindrops_detect_header_image_size_clone(  'height' ) );
		
		if( is_singular() && $raindrops_field_exists_check !== null) {

			$display_header_image_file = get_post_meta( $post->ID, '_raindrops_this_header_image', true );

			if ( !empty( $display_header_image_file ) && $display_header_image_file !== 'default' ) {

				$display_header_image_attr = wp_get_attachment_image_src( $display_header_image_file, 'full' );
				if ( !empty( $display_header_image_attr ) ) {
					$raindrops_header_image_uri		 = $display_header_image_attr[ 0 ];
					$raindrops_header_image_width	 = $display_header_image_attr[ 1 ];
					$raindrops_header_image_height	 = $display_header_image_attr[ 2 ];
					
				}
				if( isset( $raindrops_header_image_uri ) && !empty( $raindrops_header_image_uri ) ) {
					$background_property .= 'background-image:url( ' . esc_url( $raindrops_header_image_uri ) . ' );';
				}
			}
		}
		
		if( $raindrops_header_image_height !== 0 && $raindrops_header_image_width !== 0  ) {
				$padding_height = $raindrops_header_image_height / $raindrops_header_image_width * 100;
		}
		$background_property .= " display:block;
				position: relative;
				padding-bottom: {$padding_height}%;
				height: 0!important;
				max-width:100%; ";

		$css .= " \n#header-image{{$background_property} background-size:cover}";
//////////////////////////////////////////////		
		if( isset( $post ) && !empty( $post->ID ) ) {
			
			$boots_this_header_image = get_post_meta( $post->ID, '_raindrops_this_header_image', true );
		
			if ( $raindrops_text_color !== 'blank' && !empty( $header_image ) && 'hide' !== $boots_this_header_image ) {

				$css .= " \n#site-title a,#site-title span{color:#" . $raindrops_text_color . ';}';
				$css .= " \n.description{color:#" . $raindrops_text_color . ';}';
			}
		
			if ( 'hide' == $boots_this_header_image ) {

				$raindrops_text_color = apply_filters( 'boots_this_header_image_hide_title_color', '#000000' );
				$css .= " \n#site-title a,#site-title span{color:#" . $raindrops_text_color . ';}';
				$css .= " \n.description{color:#" . $raindrops_text_color . ';}';
			}
		}
		$raindrops_full_width_limit_window_width = raindrops_warehouse_clone( 'raindrops_full_width_limit_window_width' );
		$raindrops_full_width_max_width			 = raindrops_warehouse_clone( 'raindrops_full_width_max_width' );

		$css .= "\n#doc5 #header-inner{min-width:" . $raindrops_fluid_minimum_width .
		'px;max-width:' . $raindrops_full_width_max_width . 'px; margin:auto;}';
		$css .= "\n.rd-pw-doc3 #header-inner,
				\n#doc3 #header-inner{min-width:" . $raindrops_fluid_minimum_width .
		'px;max-width:' . $raindrops_fluid_maximum_width . 'px;	margin:auto;}';

		$setting_value = raindrops_warehouse_clone( 'raindrops_tagline_in_the_header_image' );

		If ( $setting_value !== 'show' ) {

			$css .= '#top #header-image .tagline{display:none;}';
		}

		$raindrops_options			 = get_option( 'raindrops_theme_settings' );
		$raindrops_hyperlink_color	 = raindrops_warehouse_clone( 'raindrops_hyperlink_color' );

		if ( $raindrops_hyperlink_color !== '' && false == raindrops_has_indivisual_notation() ) {
			$css .= ".yui-main a{color:" . $raindrops_hyperlink_color . ";}";
		}

		$raindrops_fonts_color = raindrops_warehouse_clone( 'raindrops_default_fonts_color' );

		if ( $raindrops_fonts_color !== '' && false == raindrops_has_indivisual_notation() ) {
			$css .= "article {color:" . $raindrops_fonts_color . ";}";
		}

		$raindrops_fonts_color = raindrops_warehouse_clone( 'raindrops_footer_color' );

		if ( $raindrops_fonts_color !== '' && false == raindrops_has_indivisual_notation() ) {
			$css .= "#ft {color:" . $raindrops_fonts_color . "!important;}";
		}


		$raindrops_footer_link_color = raindrops_warehouse_clone( 'raindrops_footer_link_color' );

		if ( !empty( $raindrops_footer_link_color ) && false == raindrops_has_indivisual_notation() ) {
			$css .= "#ft a{color:" . $raindrops_footer_link_color . ";}";
		}

		$background	 = get_background_image();
		$color		 = get_background_color();

		if ( !empty( $background ) || !empty( $color ) ) {

			$css .= preg_replace( "|body[^{]*{[^}]+}|", "", $css );
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

			$css .= "\nbody{background-color:#" . $body_background . '!important;}';
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

			$adding_style = '#access ul ul li,#access ul ul,#access a{min-width:%1$dem;}
							.ie8 #access .page_item_has_children > a:after,
							.ie8 #access .menu-item-has-children > a:after{ content :"";}
							#access .children li,#access .sub-menu li,#access .children ul,#access .sub-menu ul,#access .children a,#access .sub-menu a{
							 min-width:%2$dem;
							}';
			$css .= sprintf( $adding_style, $primary_menu_min_width, $child_width );
		}

		if ( function_exists( 'raindrops_gradient_clone' ) ) {

			$css .= raindrops_gradient_clone( '.rd-type-boots #yui-main .entry-content .gradient' );
		}
		if ( function_exists( 'raindrops_color_base_clone' ) ) {

			// $css .= raindrops_color_base_clone( $raindrops_base_color );
		}

		$raindrops_sticky_conditional = raindrops_warehouse_clone( 'raindrops_display_sticky_post' );

		if ( 'only_home' == $raindrops_sticky_conditional ) {

			$css .= ' .single .raindrops-sticky { display:none; }';
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

				$web_fonts_styles_wrapper = "<style type=\"text/css\" media=\"screen\">\n" . '%1$s</style>' . "\n";

				$result .= sprintf( $web_fonts_styles_wrapper, $web_fonts_styles . $pinup_style );
			}

			$css_single = get_post_meta( $post->ID, 'css', true );
			$css_single .= get_post_meta( $post->ID, '_css', true );

			if ( true == RAINDROPS_OVERRIDE_POST_STYLE_ALL_CONTENTS ) {

				$css .= preg_replace_callback( '![^}]+{[^}]+}!siu', 'raindrops_css_add_id', $css_single );
			} else {

				$css .= $css_single;
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
						$result_indv = str_replace( array( $web_fonts_style_each, "\n\n" ), array( '', "\n" ), $result_indv );
						$result_indv .= $web_fonts_style_each . "\n";
					}
				}
			}



			if ( true == RAINDROPS_OVERRIDE_POST_STYLE_ALL_CONTENTS ) {

				if ( have_posts() ) {

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
						$result_indv .= preg_replace_callback( '![^}]+{[^}]+}!siu', 'raindrops_css_add_id', $collections );
					}
					rewind_posts();
				}
			}

			$result_indv = raindrops_remove_spaces_from_css( $result_indv );
			
			$result .= '<style type="text/css">';
			$result .= "\n<!--/*<! [CDATA[*/\n";
			$result .= "\n/*start custom fields style for loop pages*/\n";
			$result .= $result_indv;

			$result .= "\n/*end custom fields style for loop pages*/\n";
			$result .= "\n/*]]>*/-->\n";
			$result .= "</style>";
		}
		$must_first_css = apply_filters( 'raindrops_embed_meta_pre', '' );

		$css = apply_filters( 'raindrops_embed_meta_css', $css );
		return '<style type="text/css"> ' . $must_first_css . $css . '</style>' . $result;
	}
}

/**
 *
 * @param type $content
 * @return type
 */


if ( ! function_exists( 'raindrops_child_custom_header_image_content' ) ) {

    function raindrops_child_custom_header_image_content( $content ) {
		
        global $raindrops_link_unique_text, $raindrops_fluid_maximum_width, $post;
		
		$raindrops_link_unique_text = raindrops_link_unique_text();
        $boots_site_title			= raindrops_site_title();

        if ( true !== $raindrops_link_unique_text ) {

            /* remove nested a elements */
            $boots_site_title = strip_tags( raindrops_site_title(), '<span><h1><div>' );
        }

		$boots_site_title = '<a href="'. esc_url( home_url() ). '" rel="home">'. $boots_site_title.'</a>';

        $html = '<div class="tagline-wrapper no-header-image"><div id="header-inner" style="%3$s">'
                . '%1$s%2$s'
                . '</div></div>';

		$image = get_header_image();

		if ( empty( $image ) ) {

			return sprintf( $html,
						$boots_site_title,
						'<p class="tagline">' . get_bloginfo( 'description' ) . '</p>',
						apply_filters('boots_header_no_image_tagline_style', ' ')
					);
		}

		$post_meta = get_post_custom_values('_raindrops_this_header_image', $post->ID);

		if ( is_singular() && isset( $post_meta ) && $post_meta[0] == 'hide' ) {

			return sprintf( $html,
						$boots_site_title,
						'<p class="tagline">' . get_bloginfo( 'description' ) . '</p>',
						apply_filters('boots_header_no_image_tagline_style', ' ')
					);
		}
    }

}

/**
 * Overwrite Parent default colors
 * @param type $val
 * @return type
 * 
 */
if ( ! function_exists( 'raindrops_child_fallback_footer_color_default' ) ) {
	function raindrops_child_fallback_footer_color_default( $val ) {
		global $raindrops_child_base_setting_args;
		return raindrops_warehouse_clone( 'raindrops_footer_color' );
	}
}
if ( ! function_exists( 'raindrops_child_fallback_hyperlink_color_default' ) ) {
	function raindrops_child_fallback_hyperlink_color_default( $val ) {
		global $raindrops_child_base_setting_args;
		return raindrops_warehouse_clone( 'raindrops_hyperlink_color' );
	}
}
if ( ! function_exists( 'raindrops_child_fallback_fonts_color_default' ) ) {
	function raindrops_child_fallback_fonts_color_default( $val ) {
		global $raindrops_child_base_setting_args;
		
		return raindrops_warehouse_clone( 'raindrops_default_fonts_color' );
	}
}
if ( ! function_exists( 'raindrops_child_fallback_footer_link_color' ) ) {
	function raindrops_child_fallback_footer_link_color( $val ) {
		global $raindrops_child_base_setting_args;
		return raindrops_warehouse_clone( 'raindrops_footer_link_color' );
	}
}
if ( ! function_exists( 'raindrops_child_fallback_header_textcolor' ) ) {
	function raindrops_child_fallback_header_textcolor( $val ) {
		global $raindrops_child_base_setting_args;
		
		return  get_theme_mod( 'header_textcolor', 'ffffff' );
	}
}
/**
 * Remove table data when Uninstall Theme
 *
 *
 */
if ( !function_exists( 'raindrops_child_uninstall' ) ) {
	
    add_action( 'switch_theme', 'raindrops_child_uninstall' );

    function raindrops_child_uninstall() {

       // delete_option( "raindrops_theme_settings" );
    }

}
if ( !function_exists( 'raindrops_remove_spaces_from_css' ) ) {
	/**
	 * 
	 * @param type $css
	 * @return type
	 * @since 1.416
	 */
	function raindrops_remove_spaces_from_css( $css = '' ) {
		// Test for CSS custom property
		if ( WP_DEBUG !== true ) {

			//$css = str_replace( array( "\n", "\r", "\t", '&quot;', '--', '\"' ), array( "", "", "", '"', '', '"' ), $css );
			$css = str_replace( array( "\n", "\r", "\t", '&quot;',  '\"' ), array( "", "", "", '"', '"' ), $css );
		} else {

			//$css = str_replace( array( '&quot;', '--', '\"' ), array( '"', '', '"' ), $css );
			$css = str_replace( array( '&quot;', '\"' ), array( '"', '"' ), $css );
		}

		return $css;
	}

}