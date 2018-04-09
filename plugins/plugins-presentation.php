<?php
/**
 * Plugin Active or not raindrops_plugin_presentation_meta_slider
 */
register_activation_hook( WP_CONTENT_DIR . '/plugins/the-events-calendar/the-events-calendar.php', 'raindrops_the_events_calendar_activate_check' );

function raindrops_the_events_calendar_activate_check() {

	set_theme_mod( 'raindrops_the_events_calendar_status', 'yes' );
}

register_deactivation_hook( WP_CONTENT_DIR . '/plugins/the-events-calendar/the-events-calendar.php', 'raindrops_the_events_calendar_deactivate_check' );

function raindrops_the_events_calendar_deactivate_check() {

	set_theme_mod( 'raindrops_the_events_calendar_status', 'none' );
}

register_activation_hook( WP_CONTENT_DIR . '/plugins/ml-slider/ml-slider.php', 'raindrops_ml_slider_activate_check' );

function raindrops_ml_slider_activate_check() {

	set_theme_mod( 'raindrops_ml_slider_status', 'yes' );
}

register_deactivation_hook( WP_CONTENT_DIR . '/plugins/ml-slider/ml-slider.php', 'raindrops_ml_slider_deactivate_check' );

function raindrops_ml_slider_deactivate_check() {

	set_theme_mod( 'raindrops_ml_slider_status', 'none' );
}

register_activation_hook( WP_CONTENT_DIR . '/plugins/breadcrumb-navxt/breadcrumb-navxt.php', 'raindrops_breadcrumb_navxt_activate_check' );

function raindrops_breadcrumb_navxt_activate_check() {

	set_theme_mod( 'raindrops_breadcrumb_navxt_status', 'yes' );
}

register_deactivation_hook( WP_CONTENT_DIR . '/plugins/breadcrumb-navxt/breadcrumb-navxt.php', 'raindrops_breadcrumb_navxt_deactivate_check' );

function raindrops_breadcrumb_navxt_deactivate_check() {

	set_theme_mod( 'raindrops_breadcrumb_navxt_status', 'none' );
}

register_activation_hook( WP_CONTENT_DIR . '/plugins/wp-pagenavi/wp-pagenavi.php', 'raindrops_wp_pagenavi_activate_check' );

function raindrops_wp_pagenavi_activate_check() {

	set_theme_mod( 'raindrops_wp_pagenavi_status', 'yes' );
}

register_deactivation_hook( WP_CONTENT_DIR . '/plugins/wp-pagenavi/wp-pagenavi.php', 'raindrops_wp_pagenavi_deactivate_check' );

function raindrops_wp_pagenavi_deactivate_check() {

	set_theme_mod( 'raindrops_wp_pagenavi_status', 'none' );
}

/*
 *
 * @since 1.248
 */
add_action( 'after_setup_theme', 'raindrops_pagenav_setup' );
if ( !function_exists( 'raindrops_pagenav_setup' ) ) {
/**
 *
 *
 */
	function raindrops_pagenav_setup() {
		if ( 'yes' == get_theme_mod( 'raindrops_wp_pagenavi_status' ) &&
		'yes' == raindrops_warehouse_clone( 'raindrops_plugin_presentation_wp_pagenav' ) ) {
			add_filter( 'raindrops_next_prev_links', 'raindrops_use_wp_pagenav', 11, 2 );
			add_filter( 'wp_pagenavi', 'raindrops_pagenav_filter' );
			add_action( 'wp_enqueue_scripts', 'raindrops_pagenav_css' );

		}
	}
}
/**
 *
 * @since 1.248
 */
if ( !function_exists( 'raindrops_use_wp_pagenav' ) ) {
/**
 *
 * @param type $link
 * @param type $position
 * @return type
 */
	function raindrops_use_wp_pagenav( $link, $position ) {
		if ( 'yes' == get_theme_mod( 'raindrops_wp_pagenavi_status' ) &&
		'yes' == raindrops_warehouse_clone( 'raindrops_plugin_presentation_wp_pagenav' ) ) {

			if ( function_exists( 'wp_pagenavi' ) and $position == 'nav-below' ) {
				return wp_pagenavi( array( 'echo' => false, 'options' => array( 'prev_text' => esc_html__( 'Prev', 'raindrops' ), 'next_text' => esc_html__( 'Next', 'raindrops' ) ) ) );
			} else {
				return $link;
			}
		}
		return;
	}

}

if ( !function_exists( 'raindrops_pagenav_filter' ) ) {

	/**
	 *
	 * @param type $nav_html
	 * @return type
	 * @since 1.248
	 */
	function raindrops_pagenav_filter( $nav_html ) {
		if ( 'yes' == get_theme_mod( 'raindrops_wp_pagenavi_status' ) &&
		'yes' == raindrops_warehouse_clone( 'raindrops_plugin_presentation_wp_pagenav' ) ) {
			$before	 = array( 'previouspostslink"', 'nextpostslink"' );
			$after	 = array( 'previouspostslink', 'previouspostslink' );

			return str_replace( $before, $after, $nav_html );
		}
	}

}

if ( !function_exists( 'raindrops_pagenav_css' ) ) {

	/**
	 *
	 * @since 1.248
	 */
	function raindrops_pagenav_css() {
		if ( 'yes' == get_theme_mod( 'raindrops_wp_pagenavi_status' ) &&
		'yes' == raindrops_warehouse_clone( 'raindrops_plugin_presentation_wp_pagenav' ) ) {
			$color_type = raindrops_warehouse( 'raindrops_style_type' );

			switch ( $color_type ) {
				case 'dark':
					$color_type_value	 = -3;
					$border_rgba		 = '191, 156, 118, 0.8';
					break;
				case 'light':
					$color_type_value	 = 4;
					$border_rgba		 = '118, 156, 191, 1';
					break;
				default:
					$color_type_value	 = false;
					$border_rgba		 = '118, 156, 191, 1';
					break;
			}
			if ( $color_type_value !== false ) {
				$raindrops_gradient = raindrops_gradient_single_clone( $color_type_value );
			} else {
				$raindrops_gradient = '';
			}

			$raindrops_pagenav_css = '
			.wp-pagenavi a:hover,
			.wp-pagenavi span.current{

				border:2px solid rgba('. $border_rgba. ');
				margin:1px;
			}
			.wp-pagenavi{line-height:2.4;}
			.wp-pagenavi a, .wp-pagenavi span{
				padding:0 5px;}
			.wp-pagenavi .first,
			.wp-pagenavi .page,
			.wp-pagenavi .pages,
			.wp-pagenavi .current,
			.wp-pagenavi .extend,
			.wp-pagenavi .previouspostslink,
			.wp-pagenavi .last{
				display:inline-block;
				padding:0.23769em 0.76923em;
				border:1px solid rgba(222,222,222,.5);
				' . $raindrops_gradient . '
				}
			@media screen and (max-width : 640px){
			.wp-pagenavi{margin:auto;max-width:98%;box-sizing:border-box;text-align:center;font-size:123.2%}
			.wp-pagenavi span{display:inline-block;line-height:2}.wp-pagenavi .extend{border:none;}
			.wp-pagenavi .previouspostslink,.wp-pagenavi .first,.wp-pagenavi .last,.wp-pagenavi .pages{display:block;text-align:center;} }';

			$raindrops_pagenav_css = raindrops_remove_spaces_from_css( $raindrops_pagenav_css );

			wp_add_inline_style( 'wp-pagenavi', $raindrops_pagenav_css );
		}
	}

}

add_action( 'after_setup_theme', 'raindrops_bcn_setup' );

if ( !function_exists( 'raindrops_bcn_setup' ) ) {
/**
 *
 *
 */
	function raindrops_bcn_setup() {
		if ( 'yes' == get_theme_mod( 'raindrops_breadcrumb_navxt_status' ) &&
		'yes' == raindrops_warehouse_clone( 'raindrops_plugin_presentation_bcn_nav_menu' ) ) {
			
			add_action('raindrops_before_article', 'raindrops_bcn_nav_menu' );
			add_action( 'raindrops_prepend_loop', 'raindrops_bcn_nav_menu' );
			add_action( 'wp_enqueue_scripts', 'raindrops_bcn_css' );

			if ( get_locale() == 'ja' ) {

				/**
				 * Commentout Raindrops1.297
				 * Modify @1.403 filter active
				 */
				 add_filter( 'bcn_template_tags', 'raindrops_template_tags_change_date', 10, 3 );

			}
		}
	}

}
if ( !function_exists( 'raindrops_bcn_nav_menu' ) ) {
/**
 *
 * @global type $post
 */
	function raindrops_bcn_nav_menu() {
		global $post, $template;
		$template_name = basename( $template,'.php');

		if ( 'yes' == get_theme_mod( 'raindrops_breadcrumb_navxt_status' ) &&
		'yes' == raindrops_warehouse_clone( 'raindrops_plugin_presentation_bcn_nav_menu' ) ) {
			
			$html		 = '<ol class="breadcrumbs" itemprop="breadcrumbs">%1$s</ol>';

			if ( 'bbpress' !== $template_name && !is_home() && !is_front_page() && ( isset( $post ) && 0 !== $post->ID ) ) { // $post->ID for check the events calendar
				$breadcrumb = bcn_display_list( true );
				printf( $html, $breadcrumb );
			}
		}
	}

}

if ( !function_exists( 'raindrops_bcn_css' ) ) {
/**
 *
 *
 */
	function raindrops_bcn_css() {
		if ( 'yes' == get_theme_mod( 'raindrops_breadcrumb_navxt_status' ) &&
		'yes' == raindrops_warehouse_clone( 'raindrops_plugin_presentation_bcn_nav_menu' ) ) {

			$raindrops_bcn_css = '.rd-col-1 .breadcrumbs{
	margin-top:1.5em;
	margin-bottom:.75em;
}
.front-page-template-pages .breadcrumbs{
	display:none;
}
.breadcrumbs{
	margin-bottom:1em;
}
.breadcrumbs li{
list-style:none;
	display:inline-block;
	margin:0;
	padding:0;
}
.breadcrumbs li:after{
	content: "\bb";
	display:inline-block;
	width:2em;
	text-align:center;
}
.breadcrumbs li:last-child:after{
	content: "";
}
.breadcrumbs .current{
	font-weight:bold;
}
.entry-content li ul{
	margin-top:1em;
}
.breadcrumbs a:hover{
	opacity:0.75;
}
.entry-content ul .raindrops-toggle{
	list-style:none;
}
.raindrops-toggle + .raindrops-toggle{
	margin-top:1em;
}

@media screen and (max-width : 640px){
	   .breadcrumbs{
        display:block;
        width:90%;
        margin-left:5%;
		margin-right:5%;
		box-sizing:border-box;
    }
    .yui-main .breadcrumbs li{
        margin-left:1.5em;
    }
    .yui-main .breadcrumbs li{
        display:block;
    }
    .yui-main .breadcrumbs li:after{
        display:none;
    }
    .breadcrumbs{
        margin:0 0 0 1em;
        padding:0;
        list-style:none;
        position:relative;
    }  
    .yui-main .breadcrumbs:before {
        content:"";
        display:block;
        width:0;
        position:absolute;
        top:0;
        bottom:0;
        left:0;
        border-left:1px solid;
        font-weight:bold;

    }
    .breadcrumbs li {
        margin:0;
        padding:0 1.5em;
        line-height:2em;
        font-weight:bold;
        position:relative;
        text-align:left;
    }
    .breadcrumbs li:before {
        content:"";
        display:block;
        width:10px;
        height:0;
        border-top:1px solid;
        margin-top:-1px;
            position:absolute;
        top:1em;
        left:-1.5em;
    }
    
    .breadcrumbs li:last-child:before {
        height:auto;
        top:1em;
        bottom:0;
    }
}';
			$raindrops_bcn_css = raindrops_remove_spaces_from_css( $raindrops_bcn_css );
			
			wp_add_inline_style( 'style', $raindrops_bcn_css );
		}
	}

}
if ( !function_exists( 'raindrops_template_tags_change_date' ) ) {
/**
 *
 * @param type $replacements
 * @param type $type
 * @param type $id
 * @return string
 */

	function raindrops_template_tags_change_date( $replacements, $type, $id ) {

		if ( 'yes' == get_theme_mod( 'raindrops_breadcrumb_navxt_status' ) &&
		'yes' == raindrops_warehouse_clone( 'raindrops_plugin_presentation_bcn_nav_menu' ) ) {

			$this_type = implode( ',', $type );
							
			if ( preg_match( '!date-year!', $this_type ) ) {

				$replacements[ "%htitle%" ] = str_replace('年','', $replacements[ "%htitle%" ] );
			}
			if ( preg_match( '!date-day!', $this_type ) ) {

				$replacements[ "%htitle%" ] = str_replace('日','', $replacements[ "%htitle%" ] );
			}
			return $replacements;
		}
	}

}

$raindrops_slider_action = raindrops_warehouse_clone( "raindrops_plugin_presentation_meta_slider" );
if ( !function_exists( 'raindrops_metaslider_basic_settings' ) ) {
/**
 *
 * @global type $raindrops_slider_action
 * @param type $aFields
 * @return type
 */
	function raindrops_metaslider_basic_settings( $aFields ) {
		global $raindrops_slider_action;
		if ( is_int( $raindrops_slider_action ) && shortcode_exists( 'metaslider' ) ) {
			$raindrops_page_width = raindrops_warehouse_clone( 'raindrops_page_width' );

			switch ( $raindrops_page_width ) {

				case( 'doc' ):
					$aFields[ 'width' ][ 'value' ]	 = 750;
					break;
				case( 'doc2' ):
					$aFields[ 'width' ][ 'value' ]	 = 950;
					break;
				case( 'doc4' ):
					$aFields[ 'width' ][ 'value' ]	 = 974;
					break;
				default:
					$aFields[ 'width' ][ 'value' ]	 = raindrops_warehouse_clone( 'raindrops_fluid_max_width' );
					break;
			}

			return $aFields;
		}
	}

}
if ( !function_exists( 'raindrops_insert_metaslider' ) ) {
/**
 *
 * @global type $raindrops_slider_action
 * @param type $return_value
 * @return type
 */
	function raindrops_insert_metaslider( $return_value ) {
		global $raindrops_slider_action;
		if ( is_int( $raindrops_slider_action ) && !empty( $raindrops_slider_action ) ) {

			$html = '<div id="raindrops_metaslider" class="clearfix">%2$s%1$s</div>';
			$raindrops_insert_metaslider = apply_filters( 'raindrops_insert_metaslider', '');
			/**
			 * @since 1.452
			 * add ! is_paged()
			 */
			if ( ( is_home() || is_front_page() ) && ! is_paged() ) {

				return sprintf( $html, do_shortcode( "[metaslider id=" . $raindrops_slider_action . "]" ), $raindrops_insert_metaslider );
			}
		}

		return $return_value;
	}

}
add_action( 'after_setup_theme', 'raindrops_metaslider_setup' );

if ( !function_exists( 'raindrops_metaslider_setup' ) ) {
/**
 *
 * @global type $raindrops_slider_action
 */
	function raindrops_metaslider_setup() {
		global $raindrops_slider_action;
		if ( is_int( $raindrops_slider_action ) && !empty( $raindrops_slider_action ) ) {
			add_filter( 'metaslider_basic_settings', 'raindrops_metaslider_basic_settings' );
			add_action( 'wp_enqueue_scripts', 'raindrops_metaslider_css' );
			add_action( 'wp_head', 'raindrops_metaslider_shortcode_custom' );
			add_filter( 'raindrops_header_image_home_url', 'raindrops_insert_metaslider' );
			add_filter( 'raindrops_header_image_elements', 'raindrops_insert_metaslider' );

			$setting_value = raindrops_warehouse_clone( 'raindrops_place_of_site_title' );

			If( $setting_value == 'header_image' ) {
				add_filter( 'raindrops_insert_metaslider', 'raindrops_custom_header_image_home_url' );
			}

		}
	}

}
if ( !function_exists( 'raindrops_get_ml_slider_ids' ) ) {
	
	function raindrops_get_ml_slider_ids() {

			$slider_posts = get_posts( array(
					'post_type' => 'ml-slider',
					'post_status' => 'publish',
					'orderby' => 'date',
					'order' => 'ASC',
					'posts_per_page' => -1
				) );
			$result['none'] = esc_html__( 'Select', 'raindrops' );

			foreach( $slider_posts as $post ) {

				$post->ID = absint( $post->ID );

				$result[$post->ID] = wp_strip_all_tags( $post->post_title );

			}
			return $result;
		}
}




if ( !function_exists( 'raindrops_custom_header_image_home_url' ) ) {
	function raindrops_custom_header_image_home_url( $slider ) {

		return $slider.raindrops_site_title();
	}
}

if ( !function_exists( 'raindrops_metaslider_css' ) ) {
/**
 *
 * @global type $raindrops_slider_action
 */
	function raindrops_metaslider_css() {
		global $raindrops_slider_action;
		if ( is_int( $raindrops_slider_action ) && !empty( $raindrops_slider_action ) ) {

			$color_type = raindrops_warehouse( 'raindrops_style_type' );

			switch ( $color_type ) {
				case 'dark':
					$color_type_value	 = 5;
					break;
				case 'light':
					$color_type_value	 = -4;
					break;
				default:
					$color_type_value	 = false;
					break;
			}
			if ( $color_type_value !== false ) {
				$raindrops_gradient = raindrops_gradient_single_clone( $color_type_value );
			} else {
				$raindrops_gradient = '';
			}

			$raindrops_gradient_border	 = str_replace( 'color', 'border-color', $raindrops_gradient );
			$metaslider					 = '
				#raindrops_metaslider .caption h1,#raindrops_metaslider .caption h2,#raindrops_metaslider .caption h3{
				padding:.1em 0;}
				#top #raindrops_metaslider .metaslider-nivo,#top #raindrops_metaslider .metaslider-responsive,#top #raindrops_metaslider .metaslider-flex{
				min-width:100%;}
				#raindrops_metaslider{display:none;}
				#raindrops_metaslider img{width:100%;}
				.metaslider-flex{margin:auto;}
				.rd-type-dark .flex-control-nav a{border:2px solid rgba(222,222,222,.5);}
				.rd-type-dark .flex-control-nav .flex-active{' . $raindrops_gradient_border . '}
				.rslides_tabs{overflow:hidden;' . $raindrops_gradient_border . '}
				.rslides_tabs li a{' . $raindrops_gradient . '}/*r slider*/
				.rslides_tabs li.rslides_here a{ color:green;}/*r slider*//*nivo ok*/
				.metaslider-coin{margin:auto;}
				.entry-content .metaslider .slides{left:0;}';
			$setting_value = raindrops_warehouse_clone( 'raindrops_place_of_site_title' );

			If( $setting_value == 'header_image' && is_front_page() ) {
				$metaslider .= '
					#raindrops_metaslider{position:relative;}
					#raindrops_metaslider #site-title{position:absolute;z-index:9999;}';

				$metaslider .= apply_filters( 'raindrops_site_title_in_header_image_css', '' , '#raindrops_metaslider #site-title' );

				$setting_value = raindrops_warehouse_clone( 'raindrops_site_title_font_size' );

				If( is_numeric( $setting_value )  && $setting_value < 11 ) {

					$metaslider .= '#raindrops_metaslider #site-title{font-size:'. $setting_value. 'vw;}';

				}
				$setting_value_top = raindrops_warehouse_clone( 'raindrops_site_title_top_margin' );
				$setting_value_left = raindrops_warehouse_clone( 'raindrops_site_title_left_margin' );

				if ( is_numeric( $setting_value_top ) && is_numeric( $setting_value_top ) ) {

					$metaslider .='#raindrops_metaslider #site-title{position:absolute;left:'. $setting_value_left.'%; top:'. $setting_value_top.'%}';
				}
			}

			$metaslider = apply_filters( 'raindrops_metaslider_css', $metaslider);
			$metaslider = raindrops_remove_spaces_from_css( $metaslider );
			
			wp_add_inline_style( 'style', $metaslider );
		}
	}

}
if ( !function_exists( 'raindrops_metaslider_shortcode_custom' ) ) {
/*
 *
 *
 */
	function raindrops_metaslider_shortcode_custom( $return_value ) {
		global $raindrops_slider_action;

		if ( ( is_home() || is_front_page() ) && is_int( $raindrops_slider_action ) && !empty( $raindrops_slider_action ) ) {

			?>
<script <?php raindrops_doctype_elements( ' type="text/javascript" ', '' );?> id="raindrops-meta-slider"> jQuery( function ( $ ) { $( '#raindrops_metaslider' ).show(); } );</script>
<?php

		}
	}

}



add_action( 'init', 'raindrops_the_event_calendar_setup' );

if ( !function_exists( 'raindrops_the_event_calendar_setup' ) ) {
/**
 *
 *
 */
	function raindrops_the_event_calendar_setup() {

		add_filter( 'tribe_events_event_classes', 'raindrops_tribe_events_event_classes',999 );
		add_action( 'wp_enqueue_scripts', 'raindrops_the_event_calendar_css' );
	}
}
//	add_action( 'tribe_get_venue_details' ,'raindrops_title_remove_tag' );
	
if ( !function_exists( 'raindrops_title_remove_tag' ) ) {
	function raindrops_title_remove_tag( $content ) {
		
		$content["name"] = htmlspecialchars_decode( $content["name"] );
		$content["name"] = wp_kses( $content["name"],array() );
		/* hotfix for attribute title using wp_title() */
		add_filter( 'raindrops_entry_title_text_elements_allow', 'raindrops_entry_title_text_elements_no_needs' );

	}
}
if ( !function_exists( 'raindrops_entry_title_text_elements_no_needs' ) ) {
	function raindrops_entry_title_text_elements_no_needs( $return_value ) {
		return false;
	}
}
if ( !function_exists( 'raindrops_tribe_events_event_classes' ) ) {
/**
 *
 * @param type $return_value
 * @return type
 */
	function raindrops_tribe_events_event_classes( $return_value ) {
		if ( 'yes' == get_theme_mod( 'raindrops_the_events_calendar_status' ) &&
		'yes' == raindrops_warehouse_clone( 'raindrops_plugin_presentation_the_events_calendar' ) ) {

		}
		return $return_value;
	}

}

	add_filter( 'load_textdomain_mofile', 'raindrops_override_mo', 10, 2 );

if ( !function_exists( 'raindrops_override_mo' ) ) {
/**
 *
 * @param type $mofile
 * @param type $domain
 * @return type
 */
	function raindrops_override_mo( $mofile, $domain ) {
		$raindrops_locale = get_locale();
		if ( $domain == 'tribe-events-calendar' && 'ja' == $raindrops_locale ) {
			return get_template_directory() . '/languages/plugins/the-events-calendar/tribe-events-calendar-' . $raindrops_locale . '.mo';
		}
		return $mofile;
	}

}
if ( !function_exists( 'raindrops_the_event_calendar_css' ) ) {
/**
 *
 *
 */
	function raindrops_the_event_calendar_css( $main_css ) {

		if ( 'yes' == get_theme_mod( 'raindrops_the_events_calendar_status' ) &&
		'yes' == raindrops_warehouse_clone( 'raindrops_plugin_presentation_the_events_calendar' ) ) {

			$color_type	 = raindrops_warehouse( 'raindrops_style_type' );
			$border_rgba = '52,52,52,1';
			switch ( $color_type ) {
				case 'dark':
					$color_type_value	 = -3;
					$color_type_value_hover	 = 3;
					$border_rgba		 = '222,222,222,0.3';
					break;
				case 'light':
					$color_type_value	 = 4;
					$color_type_value_hover	 = -3;
					$border_rgba		 = '52,52,52,0.2';
					break;
				default:
					$color_type_value	 = false;
					break;
			}
			if ( $color_type_value !== false ) {
				$raindrops_gradient	 = raindrops_gradient_single_clone( $color_type_value );
				$custom_color		 = raindrops_colors_clone( $color_type_value, 'color' );
				$custom_background	 = raindrops_colors_clone( $color_type_value, 'background' );
				$custom_color_hover		 = raindrops_colors_clone( $color_type_value_hover, 'color' );
				$custom_background_hover	 = raindrops_colors_clone( $color_type_value_hover, 'background' );
			} else {
				$raindrops_gradient	 = '';
				$custom_color		 = '#000';
				$custom_background	 = '#fff';
				$custom_color_hover		 = '#fff';
				$custom_background_hover	 = '#000';
			}
			$raindrops_event_calendar_css = '@media screen and (max-width : 920px){
					div#tribe-bar-collapse-toggle{color:' . $custom_color . '; background:' . $custom_background . '}
				}
			.tribe-events-event-meta dt{padding:0;}
			.entry-content .tribe-events-schedule h2{display:block;}
			.tribe-events-loop .tribe-events-list .tribe-events-event-cost span{ color:red;}
			.datepicker{ width:280px;max-width:100%;}
			.tribe-events-list-widget li{padding:0 10px 20px;}
			.tribe-events-list-widget ol li{margin:10px 0;}
			.events-archive .entry-title,.icon-link-no-title,
			.events-single .entry-title{display:none;}
			.events-archive.events-gridview #tribe-events-content table .vevent .entry-title{display:block;margin:0;text-align:left;background:transparent;}
			.events-archive.events-gridview #tribe-events-content table .vevent .tribe-events-month-event-title:hover + .tribe-events-tooltip .entry-title{color:#000;}
			.events-archive.events-gridview #tribe-events-content  .vevent .entry-title,
			.events-list #tribe-events-content a, 
			.events-list .tribe-events-event-meta a,
			.events-archive #tribe-events-bar .tribe-bar-views-inner label,
			.tribe-events-day .tribe-events-day-time-slot h5,
			.tribe-bar-views-inner,
			#tribe-bar-form,
			.datepicker.dropdown-menu,
			.tribe-events-list .tribe-events-event-cost span,
			.tribe-events-list-separator-month span,
			#tribe-events-content .tribe-events-calendar td.tribe-events-othermonth,
			.single-tribe_events .tribe-events-event-meta{color:' . $custom_color . '; background:' . $custom_background . '}
			.datepicker thead tr:first-child th:hover, .datepicker tfoot tr th:hover,.datepicker.dropdown-menu td span:hover{color:' . $custom_color_hover . '; background:' . $custom_background_hover . '}
			.tribe-events-list-widget-events,
			.events-archive .tribe-events-calendar td.tribe-events-future div[id*="tribe-events-daynum-"],
			.events-archive .tribe-events-calendar td.tribe-events-future div[id*="tribe-events-daynum-"] > a,
			.events-archive .tribe-events-calendar td.tribe-events-past div[id*="tribe-events-daynum-"],
			.events-archive .tribe-events-calendar td.tribe-events-past div[id*="tribe-events-daynum-"] > a,
			.events-archive #tribe-events, .events-archive #tribe-events-content-wrapper,
			.single-tribe_events #tribe-events, .single-tribe_events #tribe-events-content-wrapper{' . $raindrops_gradient . '}
			.rd-type-minimal .tribe-events-calendar td.tribe-events-past div[id*="tribe-events-daynum-"],
			.rd-type-minimal .tribe-events-calendar td.tribe-events-past div[id*="tribe-events-daynum-"] > a,
			.rd-type-w3standard .tribe-events-calendar td.tribe-events-past div[id*="tribe-events-daynum-"],
			.rd-type-w3standard .tribe-events-calendar td.tribe-events-past div[id*="tribe-events-daynum-"] > a{
				color:#000; background:#eee:}
			.single-tribe_events .tribe-events-event-meta,
			#tribe-events-content .tribe-events-calendar td{border:1px solid rgba(' . $border_rgba . ');}
			.single-tribe_events #tribe-events-footer,
			.tribe-events-day #tribe-events-footer,
			.events-list #tribe-events-footer,
			.tribe-events-map #tribe-events-footer,
			.tribe-events-photo #tribe-events-footer{border-top:1px solid rgba(' . $border_rgba . ');}
			#tribe-events .tribe-events-notices li{background:#d9edf7; color:#000;}
			.entry-content #tribe-bar-views ul.tribe-bar-views-list{min-width:0;}
			#tribe-bar-views .tribe-bar-views-list .tribe-bar-views-option a:hover{background:#fff;color:#000;}
			.tribe-events-list-widget .tribe-events-widget-link a{margin:1em;
			background:' . $custom_background . '; text-align:center; padding:1em;display:inline-block;box-sizing:border-box;border:1px solid rgba(' . $border_rgba . ');}
			.tribe-events-list-widget .tribe-events-widget-link a,
			.tribe-events-list-widget .tribe-events-list-widget-events .entry-title{font-size:108%;}
			.tribe-events-list-widget ol li{margin-bottom:10px;}
			#tribe-bar-collapse-toggle,
			.tribe-events-sub-nav{background:transparent!important;}
			#tribe-events-content .tribe-events-calendar td:hover{background:' . $custom_background . '}';
			
			$raindrops_event_calendar_css = raindrops_remove_spaces_from_css( $raindrops_event_calendar_css );

			wp_add_inline_style( 'tribe-events-calendar-style', $raindrops_event_calendar_css );
		}
	}

}

/**
 * https://wordpress.org/plugins/amp/
 * @since 1.415
 */

if( function_exists( 'amp_init' ) ) {
	
	add_filter( 'the_content', 'raindrops_amp_filter' );
	add_action( 'amp_post_template_css', 'raindrops_amp_css' );	
	add_filter( 'amp_post_template_metadata', 'raindrops_amp_modify_json_metadata', 9, 2 );
	
	if( ! function_exists('raindrops_amp_filter') ) {
		/**
		 * 
		 * @param type $content
		 * @return type
		 * @since 1.415
		 */
		function raindrops_amp_filter( $content ) {
			if(is_amp_endpoint()){
				/**
				 * commentout @since 1.422 relate AMP 0.3.3
				 */
				//	$content = preg_replace('!<(/)?div[^>]*>!','<hr />', $content );
			}
			return $content;
		}
	}
	
	if( ! function_exists('raindrops_amp_css') ) {
		/**
		 * 
		 * @since 1.415
		 */
		function raindrops_amp_css(){
			
			$css = '';
			if( function_exists('raindrops_width_class_and_relate_settings') ) {
				
				$css = raindrops_width_class_and_relate_settings();
				$replace_pairs = array(
									'.entry-content' => '.amp-wp-content',				
								);
				
				$css .= strtr( $css, $replace_pairs );
			}
			
			if( function_exists( 'raindrops_warehouse_clone' ) ) {
				/**
				 * Paragraph line wrapping
				 */
				$paragraph_wrap_enable = raindrops_warehouse_clone( 'raindrops_paragraph_line_wrapping' );

				if( 'enable' == $paragraph_wrap_enable ) {

					$paragraph_wrap_width = raindrops_warehouse_clone( 'raindrops_paragraph_line_wrapping_value' );

					$paragraph_wrap_width_en = round( $paragraph_wrap_width / 2 );

					if ( 'ja' == get_locale() ) {

						$p_line_wrapp_css = '.amp-wp-content > p:not([class]){ max-width:'. $paragraph_wrap_width. 'em;}';
						$p_line_wrapp_css .= '.amp-wp-content .aligncenter{ max-width:'. $paragraph_wrap_width. 'em;}';
						$p_line_wrapp_css .= '.amp-wp-content .fit-p{ max-width:'. $paragraph_wrap_width. 'em;}';
					} else {
						$p_line_wrapp_css = '.amp-wp-content > p:not([class]){ max-width:'. $paragraph_wrap_width_en. 'em;}';
						$p_line_wrapp_css .= '.amp-wp-content .aligncenter{ max-width:'. $paragraph_wrap_width_en. 'em;}';
						$p_line_wrapp_css .= '.amp-wp-content .fit-p{ max-width:'. $paragraph_wrap_width. 'em;}';
					}
					$p_line_wrapp_css .= '.amp-wp-content > p{margin-left:auto;margin-right:auto;}';
					
					$css .= $p_line_wrapp_css;
					
				}
			}
			$css .=<<<THEME_CSS
			[lang="ja"] body{
				font-family:   "-apple-system", "Helvetica Neue", Meiryo, "Yu Gothic", YuGothic, Verdana, sans-serif;
				color:#333;
			}
			.alignnone,
			.alignright,
			.alignleft{
				display:inline-block;
				width:100%;
			}
			.alignnone{
				margin-left:.5em;
				margin-right:.5em;
			}
			.alignleft{
				clear:left;
				margin-right:1em;
			}
			.alignright{
				clear:right;
				margin-left:1em;
			}
			ul{

				padding:0;
			}
			figcaption{
				font-size:.8125em;
				line-height:1.231;
			}
			hr{
				clear:both;
			}
			hr + hr{
				display:none;
			}
			pre{
			background:#eee;
			padding:1em;
			box-sizing:border-box;
			white-space: pre-wrap; 
			}
			amp-carousel{
			max-width:300px;
			margin:2em auto;
			}
			amp-img.alignleft{
				margin:0 2em 1em 0;
			}
			.amp-wp-content br + br{
				display:none;
			}
			.rd-modal{
			display:none;
			}
			.wp-caption{
			border:1px solid #ccc;
			}
			.raindrops-tab-list{
			display:none;
			}
			.quote-raindrops .first{
				/* amp-anim destroy presentation */
				height:1em;
				margin-top:-4em;
				overflow:hidden;
			}
			div.clip-link + p{
			/* <p>&nbsp;</p> create funny space */
				display:inline;
			}

			.amp-wp-content ol,
			.amp-wp-content ul{
				position:relative;
				left:1.5em;
			}
			.has-background{
				padding:1em;
				box-sizing:border-box;
			}
			.amp-wp-article-content:after{
				content:'';
				display:table;
				clear:both;
			}
			@media screen and (max-width : 640px){
				.alignnone,
				.alignright,
				.alignleft,
				.alignleft.size1of2,
				.alignleft.size1of3,
				.alignleft.size2of3,
				.alignleft.size1of4,
				.alignleft.size3of4,
				.alignleft.size1of5,
				.alignleft.size2of5,
				.alignleft.size3of5,
				.alignleft.size4of5,
				.alignright.size1of2,
				.alignright.size1of3,
				.alignright.size2of3,
				.alignright.size1of4,
				.alignright.size3of4,
				.alignright.size1of5,
				.alignright.size2of5,
				.alignright.size3of5,
				.alignright.size4of5,
				.alignnone.size1of2,
				.alignnone.size1of3,
				.alignnone.size2of3,
				.alignnone.size1of4,
				.alignnone.size3of4,
				.alignnone.size1of5,
				.alignnone.size2of5,
				.alignnone.size3of5,
				.alignnone.size4of5{
					clear:both;
					float:none;
					width:100%;
					max-width:100%;
					margin-left:auto;
					margin-right:auto;
				 }
			
			}
THEME_CSS;
			
			$css = wp_strip_all_tags( $css );
			if ( function_exists('raindrops_remove_spaces_from_css' ) ) {
				echo raindrops_remove_spaces_from_css( $css );
			} else {
				
				echo $css;
			}
		}
	}

	if( ! function_exists('raindrops_amp_modify_json_metadata') ) {
		/**
		 * 
		 * @param type $metadata
		 * @param type $post
		 * @return type
		 * @since 1.421
		 */
		function raindrops_amp_modify_json_metadata( $metadata, $post ) {

			$post_image_url					 = '';
			$post_image_width				 = '';
			$post_image_height				 = '';
			$raindrops_header_image_width	 = raindrops_detect_header_image_size( 'width' );
			$raindrops_header_image_height	 = raindrops_detect_header_image_size( 'height' );

			if ( isset( $post ) && 	is_singular() && has_post_thumbnail() ) {

				$post_image_url		 = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
				$post_image_url		 = esc_url( $post_image_url[ 0 ] );
				$post_image_width	 = $post_image_url[ 1 ];
				$post_image_height	 = $post_image_url[ 2 ];
			} else {

				$raindrops_header_image		 = get_custom_header();
				$raindrops_header_image_uri	 = $raindrops_header_image->url;

				if ( empty( $raindrops_header_image_uri ) ) {

					$raindrops_header_image_uri = get_header_image();
				}
				
				$raindrops_field_exists_check = get_post_custom_values( '_raindrops_this_header_image' );
				
				if ( $raindrops_field_exists_check !== null ) {

					$display_header_image_file = get_post_meta( $post->ID, '_raindrops_this_header_image', true );

					if ( !empty( $display_header_image_file ) && $display_header_image_file !== 'default' && is_singular() ) {

						$display_header_image_attr = wp_get_attachment_image_src( $display_header_image_file, 'full' );

						if ( ! empty( $display_header_image_attr ) ) {
							$raindrops_header_image_uri		 = esc_url( $display_header_image_attr[ 0 ] );
							$raindrops_header_image_width	 = absint( $display_header_image_attr[ 1 ] );
							$raindrops_header_image_height	 = absint( $display_header_image_attr[ 2 ] );
						}
					}
				}
				
				$post_image_url = $raindrops_header_image_uri;
				$post_image_width = $raindrops_header_image_width;
				$post_image_height = $raindrops_header_image_height;
			}

			if ( 'post' === $post->post_type ) {

				$metadata['@type'] = 'Article';

				//if( ! isset( $metadata['publisher']['logo'] ) ) {
					
					$custom_logo_id = get_theme_mod( 'custom_logo' );
				
					if ( ! empty( $custom_logo_id ) ) {
						$logo_image  = wp_get_attachment_image_src( $custom_logo_id , 'full' );
						$logo_uri    = apply_filters( 'raindrops_amp_logo_uri', esc_url( $logo_image[0] ), absint( $post->ID ) );
						$logo_width	 = apply_filters( 'raindrops_amp_logo_width', absint( $logo_image[1] ), absint( $post->ID ) );
						$logo_height = apply_filters( 'raindrops_amp_logo_height', absint( $logo_image[2] ), absint( $post->ID ) );
						
						$metadata['publisher']['logo']	 = array(
							'@type'	 => 'ImageObject',
							'url'	 => $logo_uri,
							'width'	 => $logo_width,
							'height' => $logo_height,
						);	
						
					}
					
				//}
				if( ! empty( $post_image_url ) ) {
					$image_uri		 = apply_filters( 'raindrops_amp_image_uri', esc_url( $post_image_url ), absint( $post->ID ) );
					$image_width	 = apply_filters( 'raindrops_amp_image_width', absint( $post_image_width ), absint( $post->ID ) );
					$image_height	 = apply_filters( 'raindrops_amp_image_height', absint( $post_image_height ), absint( $post->ID ) );
				} else {
					$image_uri		 = apply_filters( 'raindrops_amp_image_uri', '', absint( $post->ID ) );
					$image_width	 = apply_filters( 'raindrops_amp_image_width', '', absint( $post->ID ) );
					$image_height	 = apply_filters( 'raindrops_amp_image_height', '', absint( $post->ID ) );				
				}
				if( ! isset( $metadata['image'] ) ) {

					$metadata['image'] = array(
						'@type'	 => 'ImageObject',
						'url'	 => $image_uri,
						'width'	 => $image_width,
						'height' => $image_height,
					);
				}
				return $metadata;
			}
		}
	}

	add_filter( 'amp_skip_post', 'raindrops_skip_amp', 10, 3 );

	if( ! function_exists('raindrops_skip_amp') ) {
		/**
		 * Skip AMP
		 * add <!--skipamp--> in entry content.
		 * 
		 * @param type $bool
		 * @param type $post_id
		 * @param type $post
		 * @return boolean
		 * @since 1.421
		 */
		function raindrops_skip_amp( $bool, $post_id, $post ) {

			if ( is_amp_endpoint() && preg_match( '#<!--skipamp-->#', $post->post_content ) ) {

				return true;
			}
			return $bool;
		}
	}
	
	add_filter( 'amp_frontend_show_canonical', 'raindrops_remove_amphtml__link_element' );
	
	if( ! function_exists('raindrops_remove_amphtml__link_element') ) {
		
		/**
		 * when <!--skipamp--> exists in entry content ,remove <link ref="amphtml".../>
		 * @1.438
		 */
		
		function raindrops_remove_amphtml__link_element($val) {

			global $post;
			if( preg_match('#<!--skipamp-->#',$post->post_content) ) {
				return false;
			}
			return $val;
		}
	}

	add_action( 'amp_post_template_css', 'raindrops_load_amp_css', 11 );

	if ( !function_exists( 'raindrops_load_amp_css' ) ) {

		/**
		 * When theme has amp.css then load style amp page header
		 * @since 1.421
		 */
		function raindrops_load_amp_css() {
			$css		 = '';
			$file_path	 = trailingslashit( get_stylesheet_directory() ) . 'amp.css';
			
			if ( file_exists( $file_path ) ) {

				$style_rules = file( $file_path );
				if ( !empty( $style_rules ) ) {
					foreach ( $style_rules as $rule ) {
						$css .= $rule;
					}

					$css = str_replace( array( "\n", "\r", "\t", '&quot;',  '\"' ), array( "", "", "", '"', '"' ), $css );
		
					echo wp_strip_all_tags( $css );
				}
			}
		}

	}
}
/**
 * GUTENBERG Plugin
 */
function raindrops_setup_theme_supported_features() {
	
	//if( ! is_active_sidebar( 'sidebar-1' ) && ! is_active_sidebar( 'sidebar-2' ) ) {
			add_theme_support( 'align-wide' );
	//}

}
add_action( 'after_setup_theme', 'raindrops_setup_theme_supported_features' );
/* front end , editor css*/
add_action( 'enqueue_block_assets', 'raindrops_gutenberg_enqueue_common_assets' );

/* Gutenberg style for TinyMCE */
add_filter( 'raindrops_editor_styles_callback', 'raindrops_gutenberg_front_end_style_filter');

/* Custom CSS For This Entry and Customizer Color Settings */
add_action( 'enqueue_block_editor_assets', 'raindrops_editor_styles_gutenberg' );

if ( !function_exists( 'raindrops_gutenberg_enqueue_common_assets' ) ) {
	/**
	 * Front end
	 */
	function raindrops_gutenberg_enqueue_common_assets() {

		$color_type = raindrops_warehouse_clone( 'raindrops_style_type' );

		switch( $color_type ) {
			case( 'dark' ):
				add_filter('raindrops_indv_css_dark','raindrops_gutengerg_indv_css_dark', 9);
			case( 'w3standard' ):
				add_filter('raindrops_indv_css_w3standard','raindrops_gutengerg_indv_css_w3standard', 9);
			case( 'light' ):
				add_filter('raindrops_indv_css_light','raindrops_gutengerg_indv_css_light', 9);
			case( 'minimal' ):
				add_filter('raindrops_indv_css_minimal','raindrops_gutengerg_indv_css_minimal', 9);
			default:
				if( function_exists( 'custom_raindrops_indv_css_' . $color_type ) ) {
					add_filter('raindrops_indv_css_minimal','custom_raindrops_indv_css_'. $color_type , 9);
				}
		}	

	}
}

if( ! function_exists( 'raindrops_gutenberg_front_end_style_filter' ) ) {
	
	function raindrops_gutenberg_front_end_style_filter( $content ) {

		return $content. raindrops_gutenberg_front_end_style();
	}
}

if( ! function_exists( 'raindrops_editor_styles_gutenberg' ) ) {
	/**
	 * Apply CSS Custom CSS For This Entry and Customizer Color Settings
	 * 
	 * @global type $content_width
	 * @return type
	 */
	function raindrops_editor_styles_gutenberg() {
		global $content_width;
		if ( raindrops_warehouse_clone( 'raindrops_sync_style_for_tinymce' ) !== 'yes' ) {
			return;
		}

		$metabox_style	 = '';
		$result			 = '';
		$post_id		 = 0;

		if ( isset( $_REQUEST[ 'post' ] ) && !empty( $_REQUEST[ 'post' ] ) ) {
			$post_id = absint( $_REQUEST[ 'post' ] );

			$metabox_style	 = get_post_meta( $post_id, '_css', true );
			$metabox_style	 = str_replace( array( 'body', '.entry-content','article' ), array( '.mceContentBody', '.editor-block-list__block', '.editor-visual-editor' ), $metabox_style );
			$metabox_style = preg_replace_callback( '![^}]+{[^}]+}!siu', 'raindrops_css_gutenberg_specificity', $metabox_style );

			/* NOTWORK editor No has defined CSS Class ,Front End OK */
			$style			 = get_post_meta( $post_id, '_web_fonts_styles', true );
			$style =  str_replace('.mce-content-body', '.gutenberg-editor-page', $style);
			$result .= $style . $metabox_style;
		}

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
		$editor_custom_styles			 = '.gutenberg-editor-page .editor-block-list__block{max-width:' . $raindrops_editor_styles_width . 'px;}' . "\n";
		$editor_custom_styles			.= '.gutenberg-editor-page .editor-visual-editor, .gutenberg-editor-page .editor-visual-editor p{font-size:' . $font_size . 'px;}' . "\n";

		if( 'custom' == raindrops_warehouse_clone( 'raindrops_color_select' ) ) {
			/* @since 1.480 */
			$flag = true;
		} else {
			$flag = false;
		}

		if ( isset( $font_color ) && !empty( $font_color ) && true == $flag) {
			$editor_custom_styles .= '.editor-block-list__block{color:' . $font_color . ';}' . "\n";
		}
		if ( isset( $link_color ) && !empty( $link_color ) && true == $flag) {
			$editor_custom_styles .= 'div.editor-block-list__block a{color:' . $link_color . ';}' . "\n";
		}

	echo '<style class="test">';
		echo $editor_custom_styles;
		echo $result ;
	echo '</style>';
	}
}

if( ! function_exists( 'raindrops_css_gutenberg_specificity' ) ) {
	/**
	 * from the CSS For This Entry transform to gutenberg editor style
	 * @global type $post
	 * @param type $matches
	 * @return stringCSS Custom 
	 */
	function raindrops_css_gutenberg_specificity( $matches ) {
		/**
		 * 
		 */
		global $post;
		$result			 = '';
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

				//$match_1 = str_replace( ',', ', #post-' . $post->ID . ' ', $regs[ 1 ] );
				$match_1 = str_replace( ',', ', .editor-block-list__block ', $regs[ 1 ] );
				$match	 = $match_1 . '{' . $regs[ 2 ];

				$result .= '.editor-block-list__block ' . trim( $match ) . "\n";
			} else {

				$result .= ' ' . trim( $match ) . "\n";
			}
		}
		return $result;
	}
}

function raindrops_gutenberg_front_end_style(){
	$theme_url = get_stylesheet_directory_uri();
	$style =<<<GUTENBERG

/**
 * GUTENBERG
 * Color Classes
 * Entry Title
 * Heading in Entry Content
 * Block Grid
 * Block Latest Posts
 * Block Gallery
 * Block Video, Block Image
 * Block Table
 * Block Preformatted, Code
 * Block Pullquote
 * Block Verse
 * Block Button
 * Block Categories
 * Block Cover Image
 * Block Blockquote
 * Block Column
 * Paragraph
 * Gutenberg Misc
 * Note: color and border Apply filter
 */
/**
 * Block Subhead
 * gutenberg 2.1.0
 */
.entry-content .wp-block-subhead{
	border-bottom:1px solid;
	padding:.5em 0 1em;
	box-sizing:border-box;
	margin-bottom:1.5em;
	opacity:1;
}
.entry-content .wp-block-subhead.alignleft,
.entry-content .wp-block-subhead.alignright{
	float:none;
	display:block;
}
.entry-content .wp-block-subhead.alignright{
	margin-left:50%;
}
h3 + .wp-block-subhead,
h2 + .wp-block-subhead,
h1 + .wp-block-subhead{
	font-size:108%;	
}
h4 + p.wp-block-subhead,
h5 + p.wp-block-subhead,
h6 + p.wp-block-subhead{
	font-size:100%;	
}
.ja p.wp-block-subhead{
	font-style:normal;
}
/**
 * Color Classes
 */
[class|="wp-block"].mark-blue,
[class|="wp-block"].mark-cool{
	background:rgba(52, 152, 219,.1);
}

[class|="wp-block"].mark-notice,
[class|="wp-block"].mark-yellow{
    background:rgba(163, 140, 8,.1);
}

[class|="wp-block"].mark-info,
[class|="wp-block"].mark-green{
    background:rgba(22, 160, 133,.1);
}
[class|="wp-block"].mark-alert,
[class|="wp-block"].mark-red{
    background:rgba(231, 76, 60,.1);
}
p[class|="mark"]{
	padding:1em;
	box-sizing:border-box;
}
figure[class|="wp-block"] .rd-reverbnation,
figure[class|="wp-block"] .rd-reddit,
figure[class|="wp-block"] .oembed-container{
	max-width:none;
	margin:0;
}
/**
 * Entry Title
 */
.editor-visual-editor > div > .editor-post-title{
	
}
/**
 * Heading in Entry Content
 */
/*
.entry-content h1[style="text-align:center"],
.entry-content h2[style="text-align:center"],
.entry-content h3[style="text-align:center"],
.entry-content h4[style="text-align:center"],
.entry-content h5[style="text-align:center"],
.entry-content h6[style="text-align:center"],
.entry-content h1[style="text-align:right"],
.entry-content h2[style="text-align:right"],
.entry-content h3[style="text-align:right"],
.entry-content h4[style="text-align:right"],
.entry-content h5[style="text-align:right"],
.entry-content h6[style="text-align:right"],
.entry-content h1[style="text-align:left"],
.entry-content h2[style="text-align:left"],
.entry-content h3[style="text-align:left"],
.entry-content h4[style="text-align:left"],
.entry-content h5[style="text-align:left"],
.entry-content h6[style="text-align:left"]{
	display:block;
}*/

/**
 * Raindrops Grid Layout
 */
.rd-grid #bd .index .entry-content{
	max-width:100%;
	width:100%;
}
/**
 * Block Grid
 */
.is-grid,
.is-grid li{
    padding:1em;
    margin:0 auto;
}
.is-grid{
    display:-webkit-box;
    display:-ms-flexbox;
    display:flex;
    -ms-flex-wrap:wrap;
        flex-wrap:wrap;
}
.is-grid > li{
    -webkit-box-flex:1;
        -ms-flex:1 0 auto;
            flex:1 0 auto;
    margin:6px;
    text-align:center;
}
.is-grid > li a span{
    display:block;
    width:100%;
    height:100%;
    padding:1em;
    -webkit-box-sizing:border-box;
            box-sizing:border-box;
}
/**
 * Block Latest Posts
 */
/* Pending
ul.wp-block-latest-posts.aligncenter{
	width:66.666%;
	margin-left:auto;
	margin-right:auto;
	clear:both;
	float:none;
}*/
.wp-block-latest-posts.is-grid li{
	list-style-type:none;
}
ul.wp-block-latest-posts li a{
    font-size:108%;
}
.wp-block-latest-posts .h2-thumb:empty{
    display:none;
}
.wp-block-latest-posts .h2-thumb:empty + .entry-title-text{
    padding-left:0;
}
.wp-block-latest-posts.is-grid .h2-thumb:empty + .entry-title-text{
    padding:1em;
}
ul.wp-block-latest-posts:not(.is-grid) {
    border-top:1px solid rgba(0,0,0,.3);
    border-bottom:1px solid rgba(0,0,0,.3);
    margin: 1em auto;
	position:static;
	padding:1.5em 0 .75em;
}
	
ul.wp-block-latest-posts:not(.is-grid) li:last-child{
    margin-bottom:0;
}
ul.wp-block-latest-posts:not(.is-grid) li{
	list-style-position:inside;
	padding-left:1.5em;
}
ul.wp-block-latest-posts:not(.is-grid) li time,
ul.wp-block-latest-posts:not(.is-grid) li a{

}
ul.wp-block-latest-posts:not(.is-grid) li time{
	text-indent:1.5em;
}
ul.wp-block-latest-posts:not(.is-grid) li a{
	font-weight:700;	
}
ul.wp-block-latest-posts.is-grid{
    display:-webkit-box;
    display:-ms-flexbox;
    display:flex;
    left:0;
    max-width:100%;
}
ul.wp-block-latest-posts.is-grid li{
    -webkit-box-flex:1;
        -ms-flex:1 1 auto;
            flex:1 1 auto;
	margin: 0 6px 6px 0;
	background:url($theme_url/images/sticky.png);
}
.wp-block-latest-posts__post-date{
    display:block;
    margin-bottom:.5em;  
}
.wp-block-latest-posts.is-grid a{
    padding:.5em;
    display:block;
    max-width:100%;
    -webkit-box-sizing:border-box;
            box-sizing:border-box;
}
.wp-block-latest-posts.is-grid.columns-5 li{
	-ms-flex-preferred-size:9%;
	    flex-basis:9%;
}
.wp-block-latest-posts.is-grid.columns-4 li{
	-ms-flex-preferred-size:18%;
	    flex-basis:18%;
}
.wp-block-latest-posts.is-grid.columns-3 li{
	-ms-flex-preferred-size:26%;
	    flex-basis:26%;
}
.wp-block-latest-posts.is-grid.columns-2 li{
	-ms-flex-preferred-size:43%;
	    flex-basis:43%;
}

/**
 * Block wp-block-embed
 */
figure[class|="wp-block-embed"]{
	padding:0;
	/* display:inline-block; gutenberg 2.3 */
}
figure[class|="wp-block-embed"] .oembed-container iframe, 
figure[class|="wp-block-embed"] .oembed-container object, 
figure[class|="wp-block-embed"] .oembed-container embed {
	display:block;
	position: absolute;
	top: 0;
	left: 0;
	right:0;
	bottom:0;
	width: 100%;
	height: 100%;
	margin:auto;
}
.wp-block-embed figcaption,
.entry-content [class|="wp-block-embed"] figcaption{
	text-align:left;
	font-style: italic;
	padding-bottom:.5em;
}
.ja .wp-block-embed figcaption,
.ja [class|="wp-block-embed"] figcaption{
	font-style: normal;
}
.wp-block-video.alignleft,
.wp-block-embed.alignleft,
.wp-block-embed-vimeo.alignleft,
.wp-block-embed-facebook.alignleft,
.wp-block-embed-twitter.alignleft,
.wp-block-embed-instagram.alignleft,
.wp-block-embed-wordpress-tv.alignleft,
.wp-block-embed-reddit.alignleft,
.wp-block-embed-flickr.alignleft,
.wp-block-embed-kickstarter.alignleft,
.wp-block-embed-wordpress.alignleft,
.wp-block-embed-soundcloud.alignleft,
.wp-block-embed-slideshare.alignleft,
.wp-block-embed-ted.alignleft,
.wp-block-embed-issuu.alignleft,
.wp-block-embed-cloudup.alignleft,
.wp-block-embed-reverbnation.alignleft, 
.wp-block-embed-youtube.alignleft{
	clear:left;
	margin-right:1em;
	width:calc(50% - 1em);
}
.rd-grid .wp-block-video.alignleft,
.rd-grid .wp-block-embed.alignleft,
.rd-grid .wp-block-embed-vimeo.alignleft,
.rd-grid .wp-block-embed-facebook.alignleft,
.rd-grid .wp-block-embed-twitter.alignleft,
.rd-grid .wp-block-embed-instagram.alignleft,
.rd-grid .wp-block-embed-wordpress-tv.alignleft,
.rd-grid .wp-block-embed-reddit.alignleft,
.rd-grid .wp-block-embed-flickr.alignleft,
.rd-grid .wp-block-embed-kickstarter.alignleft,
.rd-grid .wp-block-embed-wordpress.alignleft,
.rd-grid .wp-block-embed-soundcloud.alignleft,
.rd-grid .wp-block-embed-slideshare.alignleft,
.rd-grid .wp-block-embed-ted.alignleft,
.rd-grid .wp-block-embed-issuu.alignleft,
.rd-grid .wp-block-embed-cloudup.alignleft,
.rd-grid .wp-block-embed-reverbnation.alignleft, 
.rd-grid .wp-block-embed-youtube.alignleft{
	clear:left;
	margin-right:0;
 	width:100%;
	max-width:100%;
	padding:0;
}
.wp-block-embed-instagram > .oembed-container{
	padding-bottom:120%;
}
.wp-block-embed-flickr > .oembed-container{
	padding:0;
	position:relative;
	height:auto;

}
.wp-block-embed-flickr a{
	display:block;
	width:100%;
	height:auto;
}
.wp-block-embed-flickr .oembed-container{
	padding-top:0;
}
.wp-block-embed-flickr figcaption{
	clear:both;
	margin-top:4em;
	display:block;
}
.rd-grid .wp-block-video.alignright,
.rd-grid .wp-block-embed.alignright,
.rd-grid .wp-block-embed-vimeo.alignright,
.rd-grid .wp-block-embed-facebook.alignright,
.rd-grid .wp-block-embed-twitter.alignright,
.rd-grid .wp-block-embed-twitter.alignright,
.rd-grid .wp-block-embed-instagram.alignright,
.rd-grid .wp-block-embed-wordpress-tv.alignright,
.rd-grid .wp-block-embed-reddit.alignright,
.rd-grid .wp-block-embed-flickr.alignright, 
.rd-grid .wp-block-embed-kickstarter.alignright,
.rd-grid .wp-block-embed-wordpress.alignright,
.rd-grid .wp-block-embed-soundcloud.alignright,
.rd-grid .wp-block-embed-slideshare.alignright,
.rd-grid .wp-block-embed-ted.alignright,
.rd-grid .wp-block-embed-issuu.alignright,
.rd-grid .wp-block-embed-cloudup.alignright,
.rd-grid .wp-block-embed-reverbnation.alignright,
.rd-grid .wp-block-embed-youtube.alignright{
	clear:right;
	margin-left:0;
 	width:100%;
	max-width:100%;
	padding:0;
}	
.wp-block-video.alignright,
.wp-block-embed.alignright,
.wp-block-embed-vimeo.alignright,
.wp-block-embed-facebook.alignright,
.wp-block-embed-twitter.alignright,
.wp-block-embed-twitter.alignright,
.wp-block-embed-instagram.alignright,
.wp-block-embed-wordpress-tv.alignright,
.wp-block-embed-reddit.alignright,
.wp-block-embed-flickr.alignright, 
.wp-block-embed-kickstarter.alignright,
.wp-block-embed-wordpress.alignright,
.wp-block-embed-soundcloud.alignright,
.wp-block-embed-slideshare.alignright,
.wp-block-embed-ted.alignright,
.wp-block-embed-issuu.alignright,
.wp-block-embed-cloudup.alignright,
.wp-block-embed-reverbnation.alignright,
.wp-block-embed-youtube.alignright{
	clear:right;
	margin-left:1em;
	max-width:calc(50% - 1em);
	
}
figure[class|="wp-block-video"]:not(.aligncenter),
figure[class|="wp-block-video"]:not(.allignright),
figure[class|="wp-block-video"]:not(.alignleft),
figure[class|="wp-block-embed"]:not(.aligncenter),
figure[class|="wp-block-embed"]:not(.allignright),
figure[class|="wp-block-embed"]:not(.alignleft){
	/* align Undefined elements overlap */
	clear:both;
}
.wp-block-video.aligncenter,
.wp-block-embed.aligncenter,
.wp-block-embed-vimeo.aligncenter,
.wp-block-embed-facebook.aligncenter,
.wp-block-embed-twitter.aligncenter,
.wp-block-embed-twitter.aligncenter,
.wp-block-embed-instagram.aligncenter,
.wp-block-embed-wordpress-tv.aligncenter,
.wp-block-embed-reddit.aligncenter,
.wp-block-embed-flickr.aligncenter, 
.wp-block-embed-kickstarter.aligncenter,
.wp-block-embed-wordpress.aligncenter,
.wp-block-embed-soundcloud.aligncenter,
.wp-block-embed-slideshare.aligncenter,
.wp-block-embed-ted.aligncenter,
.wp-block-embed-issuu.aligncenter,
.wp-block-embed-cloudup.aligncenter,
.wp-block-embed-reverbnation.aligncenter,
.wp-block-embed-youtube.aligncenter{
	clear:both;
	margin-left:auto;
	margin-right:auto;
	max-width:calc(50% - 1em - 40px);
	max-width:66.666%;
}
	
/* embed indivisual */
figure.wp-block-embed-reddit,
figure.wp-block-embed-twitter,
figure.wp-block-embed-reverbnation{
	background:transparent;
}
figure.wp-block-embed-instagram,
.wp-block-embed-reddit{
	max-width:600px;
}
figure.wp-block-embed-instagram{
	margin-left:auto;
	margin-right:auto;
}
/**
 * Block Gallery
 * move to raindrops_gallerys_clone()
 */

/**
 * Block Video, Block Image
 */
.wp-block-video video{
    max-width:100%;
    outline:none;
}
.wp-block-video figcaption{
	padding:0 1em .5em;
}
.wp-block-image.alignfull{
	width:100%;
	max-width:100%;
	overflow:visible;
	margin-left:auto;
	margin-right:auto;
	text-align:center;
}
.wp-block-image.alignfull img{
	/* margin:5px auto 5px;*/
	width:100%;
	height:auto;
	-o-object-fit:fill;
	   object-fit:fill;
	display:block;
}
.wp-block-image figcaption:focus,
.blocks-gallery-image:focus,
.wp-block-image:focus,
.click-drawing-container:focus,
.wp-block-video:focus,
.wp-block-video *:focus{
    outline:none;
}


p.alignleft.shadow,
.wp-block-image.alignleft.shadow{
	margin-right:2em;
}
p.alignright.shadow,
.wp-block-image.alignright.shadow{
	margin-left:2em;
}
.wp-block-image{
	/* for ie11 */
	display:inline-block;/* @1.505 */
}
.wp-block-image figcaption{
	text-align:left;
}
:not( figure ) > img.alignright,
:not( figure ) > img.alignleft{
	/* old image structure with insert with shift + alt + m */
	/* @1.505 
	   not gutenberg affects post	
   max-width:calc(50% - 1em); */
}
figure.wp-block-image.alignleft{
	margin-left:0;
	padding:0;
	min-width:0;
}
figure.wp-block-image.alignright{
    padding:0;
    min-width:0;
	margin-right:0;
}
.wp-block-image.alignleft > img,
.wp-block-image.alignright > img{
	display:block;
    margin:5px auto;
}
.wp-block-image.aligncenter{
	display:table;
	margin-left:auto;
	margin-right:auto;
	padding:0;
	max-width:66.666%;/* needs to shrinkfit for smaller than harf size image */
}
.wp-block-image.aligncenter figcaption,
.wp-block-image.aligncenter img{
	margin-left:auto;
	margin-right:auto;
	margin-bottom:.5em;
}
.rd-grid .wp-block-image.aligncenter{
	display:block;
	box-sizing:border-box;
}
.blocks-gallery-image{
    max-width:none;
}
.rsidebar .gallery .gallery-item:focus,/* for without linking image */
.lsidebar .gallery .gallery-item:focus,/* for without linking image */
.flex-expand.flex-expand > .blocks-gallery-image:focus{
    height:auto;
	width:100%;	
    -ms-flex-preferred-size:100%;	
        flex-basis:100%;
    -webkit-transition: width 1s ease-in-out;
    transition: width 1s ease-in-out;
    outline:none;
	background:rgba(222,222,222,.3);
	-webkit-box-ordinal-group:0;
	    -ms-flex-order:-1;
	        order:-1;
	margin:0 0 6px;
}
.flex-expand.flex-expand > .blocks-gallery-image:focus ~ figure{
	margin-right:6px;
}
.gallery.flex-expand .gallery-item:focus figcaption,
.rsidebar .gallery .gallery-item:focus figcaption,
.lsidebar .gallery .gallery-item:focus figcaption{
	display:none;
	
}
/**
 * Block Table
 */
.wp-block-table{
    display:table;   
}
.wp-block-table.alignleft{
	margin-right:1em;
}
.wp-block-table.alignright{
	margin-left:1em;
}

/**
 * Block Preformatted, Code
 */
.wp-block-preformatted{
    white-space: pre-wrap; 
    white-space: -moz-pre-wrap; 
    white-space: -pre-wrap; 
    white-space: -o-pre-wrap; 
    word-wrap: break-word;
	clear:both;
}
.wp-block-preformatted{
    padding:1em;
    margin:21px auto;
    line-height:2;
}
.wp-block-code{
    padding:0 1em;
    margin:21px auto;
	-moz-tab-size: 4;
    -o-tab-size: 4;
    tab-size: 4;
	clear:both;
}
.wp-block-code code{
	line-height:1.231;
}

.wp-block-code::-webkit-scrollbar {
    width: 0;
    height:.5em;
}
.wp-block-code::-webkit-scrollbar-thumb{
    background-color: darkgrey;
    outline: 1px solid grey;
}

/**
 * Block Verse
 */
.wp-block-verse{
    font-family:arial,helvetica,clean,sans-serif;
    line-height:2;
    white-space:pre-wrap;
	clear:both;
	background:transparent;
	margin-left:40px;
	margin-right:40px;
	outline:none;
}
.wp-block-preformatted{
	
}
/**
 * Block Button
 */
body div.wp-block-button.alignleft,
body div.wp-block-button.alignright,
div.wp-block-button.aligncenter,
.wp-block-button.alignnone{
    display:inline-block;
    height:auto;
    padding:0 1.275em;
	margin:6px 4px;
}
.wp-block-button.aligncenter{
    position: relative;
    left: 50%;
    -webkit-transform:translateX( -50% );
            transform:translateX( -50% );
}
.wp-block-button > p{
    margin-bottom:0;
    text-align:center;
    display:block;
}
.wp-block-button, .wp-block-button > p{
    line-height:2.55;
    vertical-align:middle;
}
.wp-block-button > p > a{
    display:block;
    width:100%;
    height:100%;
}
.wp-block-button.clear{
	display: table;
}
/**
 * Ghost Button Class
   ========================================================================== */
/* for status */
.wp-block-button.ghost-s.rd-alert:hover a,
.wp-block-button.ghost-m.rd-alert:hover a,
.wp-block-button.ghost-l.rd-alert:hover a,
.wp-block-button.ghost.rd-alert:hover a,
.wp-block-button.rd-alert:hover a{
    color:#e14d43;
}
.wp-block-button.ghost-s.rd-info:hover a,
.wp-block-button.ghost-m.rd-info:hover a,
.wp-block-button.ghost-l.rd-info:hover a,
.wp-block-button.ghost.rd-info:hover a,
.wp-block-button.rd-info:hover a{
    color:#56b274;
}
.wp-block-button.ghost-s.rd-notice:hover a,
.wp-block-button.ghost-m.rd-notice:hover a,
.wp-block-button.ghost-l.rd-notice:hover a,
.wp-block-button.ghost.rd-notice:hover a,
.wp-block-button.rd-notice a{
    color: #a38c08;
}
.wp-block-button.ghost-s.rd-alert-bg:hover a,
.wp-block-button.ghost-m.rd-alert-bg:hover a,
.wp-block-button.ghost-l.rd-alert-bg:hover a,
.wp-block-button.ghost.rd-alert-bg:hover a,
.wp-block-button.rd-alert-bg:hover a{
    background:#e14d43;
    color:#fff;
}
.wp-block-button.ghost-s.rd-info-bg:hover a,
.wp-block-button.ghost-m.rd-info-bg:hover a,
.wp-block-button.ghost-l.rd-info-bg:hover a,
.wp-block-button.ghost.rd-info-bg:hover a,
.wp-block-button.rd-info-bg:hover a{
    background:#56b274;
    color:#fff;
}
.wp-block-button.ghost-s.rd-notice-bg:hover a,
.wp-block-button.ghost-m.rd-notice-bg:hover a,
.wp-block-button.ghost-l.rd-notice-bg:hover a,
.wp-block-button.ghost.rd-notice-bg:hover a,
.wp-block-button.rd-notice-bg:hover a{
    background: #a38c08;
    color:#fff;
}
.wp-block-button.ghost-s.rd-notice a,
.wp-block-button.ghost-m.rd-notice a,
.wp-block-button.ghost-l.rd-notice a,
.wp-block-button.ghost.rd-notice a,
.wp-block-button.ghost-s.rd-info a,
.wp-block-button.ghost-m.rd-info a,
.wp-block-button.ghost-l.rd-info a,
.wp-block-button.ghost.rd-info a,
.wp-block-button.ghost-s.rd-alert a,
.wp-block-button.ghost-m.rd-alert a,
.wp-block-button.ghost-l.rd-alert a,
.wp-block-button.ghost.rd-alert a,
.wp-block-button.ghost-s.rd-notice-bg a,
.wp-block-button.ghost-m.rd-notice-bg a,
.wp-block-button.ghost-l.rd-notice-bg a,
.wp-block-button.ghost.rd-notice-bg a,
.wp-block-button.ghost-s.rd-info-bg a,
.wp-block-button.ghost-m.rd-info-bg a,
.wp-block-button.ghost-l.rd-info-bg a,
.wp-block-button.ghost.rd-info-bg a,
.wp-block-button.ghost-s.rd-alert-bg a,
.wp-block-button.ghost-m.rd-alert-bg a,
.wp-block-button.ghost-l.rd-alert-bg a,
.wp-block-button.ghost.rd-alert-bg a{
    background:transparent;
}
.wp-block-button.ghost-s.rd-notice:hover a,
.wp-block-button.ghost-m.rd-notice:hover a,
.wp-block-button.ghost-l.rd-notice:hover a,
.wp-block-button.ghost.rd-notice:hover a,
.wp-block-button.ghost-s.rd-info:hover a,
.wp-block-button.ghost-m.rd-info:hover a,
.wp-block-button.ghost-l.rd-info:hover a,
.wp-block-button.ghost.rd-info:hover a,
.wp-block-button.ghost-s.rd-alert:hover a,
.wp-block-button.ghost-m.rd-alert:hover a,
.wp-block-button.ghost-l.rd-alert:hover a,
.wp-block-button.ghost.rd-alert:hover a,
.wp-block-button.ghost-s.rd-notice-bg:hover a,
.wp-block-button.ghost-m.rd-notice-bg:hover a,
.wp-block-button.ghost-l.rd-notice-bg:hover a,
.wp-block-button.ghost.rd-notice-bg:hover a,
.wp-block-button.ghost-s.rd-info-bg:hover a,
.wp-block-button.ghost-m.rd-info-bg:hover a,
.wp-block-button.ghost-l.rd-info-bg:hover a,
.wp-block-button.ghost.rd-info-bg:hover a,
.wp-block-button.ghost-s.rd-alert-bg:hover a,
.wp-block-button.ghost-m.rd-alert-bg:hover a,
.wp-block-button.ghost-l.rd-alert-bg:hover a,
.wp-block-button.ghost.rd-alert-bg:hover a{
    color:#fff;
    opacity:1!important;
}
/**
 * Block Categories
 */
.entry-content .wp-block-categories{
    margin-top:0;
    max-width:100%;
    padding-left:6px;
    padding-top:6px;
    padding-right:6px;
    display:-webkit-box;
    display:-ms-flexbox;
    display:flex;
}
.wp-block-categories > ul{
    margin-top:0;
    left:0;
    display:-webkit-box;
    display:-ms-flexbox;
    display:flex;
    -ms-flex-wrap:wrap;
        flex-wrap:wrap;
    max-width:none; 
}
.entry-content .wp-block-categories.aligncenter{
	clear:both;
	float:none;
	width:66.666%;
}
.wp-block-categories > ul .cat-item{
    padding:.5em;
    list-style:none;
    display:inline-block;
    -webkit-box-flex:1;
        -ms-flex:1 1 auto;
            flex:1 1 auto;
    margin:3px;
    text-align:center;   
}
.wp-block-categories ul{
    width:100%;
    max-width:100%;
    min-width:0;  
}
.wp-block-categories .has-children{
    text-align:left;
	font-weight:700;
}
.wp-block-categories .children{
	display:-webkit-box;
	display:-ms-flexbox;
	display:flex;
	-ms-flex-wrap:wrap;
	    flex-wrap:wrap;
	padding-left:0;
	position:static;
	font-weight:normal;
}
.wp-block-categories .children .cat-item{
	border:1px solid #fff;
}
.entry-content .wp-block-categories .children li{
    list-style:none;
    max-width:100%;
    min-width:0;
    background:transparent;
}
.wp-block-audio{
    max-width:100%;
   /* @1.510 max-width:296px; */
   /* @1.510 height:32px; */
	margin-left:auto;
	margin-right:auto;
	margin-bottom:2em;
	border:1px solid #ccc;
}
.wp-block-audio audio{
	width:100%;
}
.wp-block-audio figcaption{
	margin: 1em auto .5em;
	text-align:left;
}
.rd-grid figure[class|="wp-block"].aligncenter{
	max-width:100%;
}

[class|="wp-block"].alignleft,
figure[class|="wp-block"].alignleft{
	clear:left;
	-webkit-box-sizing:border-box;
	        box-sizing:border-box;
	margin-right:1em;	
	max-width:calc( 50% - 1em );
	width:100%;
}
[class|="wp-block"].alignright,
figure[class|="wp-block"].alignright{
	clear:right;
	margin-left:1em;
	-webkit-box-sizing:border-box;
	        box-sizing:border-box;
	max-width:calc( 50% - 1em );
	width:100%;
}

figure.wp-block-audio.alignright,
figure.wp-block-audio.alignleft{
	padding:0;
}
figure.wp-block-audio.aligncenter{
	clear:both;
	float:none;
	max-width:66.666%;
	margin-left:auto;
	margin-right:auto;
}
ul.wp-block-gallery{
	max-width:100%;
	margin-left:auto;
	margin-right:auto;
}
ul.wp-block-gallery.aligncenter{
	max-width:calc( 50% - 1em );
	max-width:66.666%;
	margin:0 auto 1.5em;
}

ul.wp-block-gallery.alignleft,
ul.wp-block-gallery.alignright{
	clear:both;
	padding-bottom:0;
	padding-right:0;/* relate flex-expand class */
}
.entry-content .wp-block-separator{
    border:none;
    clear:both;
    float:none;
    height:2em;
    margin-top:1.5em;
    margin-bottom:.75em;
    position:relative;
    font-size:2em;
}
.entry-content .wp-block-separator:before{
    content: '...';
    display: block;
	clear:both;
    position: absolute;
    text-align:center;
    left:0;
    right:0;
    margin:auto;
}

/**
 * Block Cover Image
 */
.has-background-dim{
	
}
#doc5 .wp-block-cover-image.alignwide{
	
}
/*.wp-block-cover-image .wp-block-cover-image-text,*/
.enable-align-wide .wp-block-cover-image{
    height:30vw;
    background-size:cover;
    background-position:center center;
    background-repeat:no-repeat;
    margin-left:-100%;
    margin-right:-100%;
    padding-left:100%;
    padding-right:100%;
    background-attachment:fixed;
    display:flex;
    align-items: center;
    justify-content: center;
}
	.enable-align-wide .wp-block-cover-image:after{
		content:none;
		display:none;
	}
/*	.wp-block-cover-image .wp-block-cover-image-text{
		height:auto;
	}*/

.enable-align-wide .wp-block-cover-image.alignleft{
    height:30vw;
    background-size:cover;
    background-position:center center;
    background-repeat:no-repeat;
    margin-left:-100%;
    margin-right:calc( -50% - 1em );
    padding-left:100%;
    padding-right:calc( 50% - 1em );
    background-attachment:fixed;
}
.enable-align-wide .wp-block-cover-image.alignright{
    height:30vw;
    background-size:cover;
    background-position:center center;
    background-repeat:no-repeat;
    margin-left:calc( -50% - 1em );
    margin-right:-100%;
    padding-left:calc( 50% - 1em );
    padding-right:100%;
    background-attachment:fixed;
}
.enable-align-wide #doc5 .wp-block-cover-image.has-parallax.alignfull {
    background-attachment: fixed;
	background-size:100%;
}

.enable-align-wide .wp-block-cover-image.aligncenter{
    height:30vw;
	margin-left:auto;
	margin-right:auto;
    background-size:66.666%;
    background-position:center center;
    background-repeat:no-repeat;
    margin-left:-100%;
    margin-right:-100%;
    padding-left:100%;
    padding-right:100%;
    background-attachment:fixed;
	display:flex;
    align-items: center;
    justify-content: center;
}
	
.enable-align-wide .wp-block-cover-image.alignnone{
	clear:none;
	float:left;
	margin-left:.5em;
	margin-right:.5em;
	background-size: 50vw;
	min-height:25vw;
	background-attachment:initial;
	background-position:center center;
}
@media screen and (max-width : 640px){
	
	.enable-align-wide .wp-block-cover-image.alignleft,
	.enable-align-wide .wp-block-cover-image.alignright{
		float:none;
		max-width:100%;
	width:100%;
	padding:0;
		margin-left:0;
		margin-right:0;
		clear:both;
		background-size:100vw;
		background-attachment:initial;
	}
	body.enable-align-wide  .wp-block-cover-image .wp-block-cover-image-text{
		position:absolute;
		transform: none;
		width:100%;
	}
}
.enable-align-wide .wp-block-cover-image.has-background-dim:before{
	display:block;
	content: "";
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    background-color: rgba(0,0,0,.5);
}
.enable-align-wide .wp-block-cover-image.aligncenter{
	display:flex;
}
.enable-align-wide .wp-block-cover-image .wp-block-cover-image-text{
	flex:1 1 auto;
    color: #fff;
    font-size: 2em;
    line-height: 1.25;
	max-width:100%;
	transform: translate(0,-1em);
    text-align: center;
}
.rd-col-1.enable-align-wide  .wp-block-cover-image .wp-block-cover-image-text{
	transform: translate(0,-1em);
}
.enable-align-wide .wp-block-cover-image.alignwide .wp-block-cover-image-text{
	transform:none;
	transform: translate(0,0);
}
.enable-align-wide .wp-block-cover-image.alignfull .wp-block-cover-image-text{
	transform: none;
}
.enable-align-wide .wp-block-cover-image.alignleft .wp-block-cover-image-text{
	position:absolute;
	width:calc( 50vw - 24px );
        margin-top:0;
    left:calc( 100vw - 48px );
}

.enable-align-wide .wp-block-cover-image.alignright .wp-block-cover-image-text{
	position:absolute;
	margin:auto;
	width:calc( 50vw - 24px );
        margin-top:0;
        right:calc( 100vw - 48px );
}
@media screen and (min-width : 1280px){
	
	.enable-align-wide .wp-block-cover-image.alignleft .wp-block-cover-image-text{
		position:absolute;
		width:calc( 45vw );
			margin-top:0;
		left:calc( 100% - 48vw );
	}
	.enable-align-wide .wp-block-cover-image.alignright .wp-block-cover-image-text{
		position:absolute;
		margin:auto;
		width:calc( 45vw );
			margin-top:0;
			right:calc( 100% - 48vw );
	}		
}
.enable-align-wide .wp-block-cover-image:not(.has-background-dim):before{
	content: '';
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
	background:#000;
	z-index:-1;
}
.enable-align-wide #container .alignfull:hover,
.enable-align-wide #container .wp-block-gallery:hover,
.enable-align-wide #container .wp-block-image:hover,
.enable-align-wide #container .wp-block-cover-image:hover{
    /* gutenberg */
    z-index:100;
}
#container .yui-u.first{
    /* gutenberg */
    z-index:1;
}
#yui-main + .yui-b,
#container .yui-u:nth-child(2){
    /* gutenberg */
    z-index:90;
    position:relative;
}
figure.alignfull{
    /* gutenberg */   
    margin-left:0;
    margin-right:0;
    max-width:100%;
}
figure.alignfull img {
    /* gutenberg */
 /*   margin: 5px auto 5px;*/
    width: 100%;
    height: auto;
    -o-object-fit: fill;
    object-fit: fill;
    display: block;
}

/**
 * Block Blockquote
 * wp-block-quote
 */
.wp-block-quote{
	line-height:1.6;
}
.ja .wp-block-quote{
    font-style:normal;
}
.wp-block-quote.is-large{
	padding:1em 1em .5em;
	-webkit-box-sizing:border-box;
	        box-sizing:border-box;
	clear:both;
	float:none;
	margin:2em 40px;
	font-size:123.1%;
	display:block;
}
.wp-block-quote.is-large p{
	font-size:123.1%;
	margin-bottom:0;
}
.is-large:before,
.is-large:after {
     content: " ";
     display: table;
}
.is-large:after {
     clear: both;
}
.wp-block-quote.is-large cite{
	font-size:108%;
	margin-bottom:0;
}
.ja .wp-block-quote.is-large p,
.ja cite{
	font-style:normal;
}
.entry-content .wp-block-quote p{
	margin-bottom:0;
}
/**
 * Block Pullquote
 */
.wp-block-pullquote{
	
}
	.wp-block-pullquote p:only-child {
		margin-bottom:1.5em;
	}
.wp-block-pullquote,
.textwidget .wp-block-pullquote, 
.entry-content .wp-block-pullquote{
    border-left:none;
	padding-top:calc( 1em * 1.5 );
	padding-bottom:calc( 1em * .75 );
	font-size:2em;
	text-align:left;
	width:fit-content;
	margin-left:auto;
	margin-right:auto;
	min-width:calc(100% - 96px);
	
}
.wp-block-pullquote cite,
.textwidget .wp-block-pullquote cite, 
.entry-content .wp-block-pullquote cite{
	display:block;
	width:fit-content;
	margin-left:auto;
	margin-right:auto;
}
.ja .wp-block-pullquote cite{
	font-style:normal;
}
.wp-block-pullquote.alignleft,
.wp-block-pullquote.alignright{
	min-width:0;
}
.wp-block-pullquote.alignleft{
    margin-right:1em;
	max-width:calc( 50% - 1em );	
}
.wp-block-pullquote.alignright{
    margin-left:1em;
	max-width:calc( 50% - 1em );
}
.wp-block-pullquote.aligncenter{
	/* gutenberg2.1.0 */
	max-width:none;
	min-width:0;
}
/* @1.510
.alignright ~ .wp-block-quote:not(.alignleft),	
.alignleft ~ .wp-block-quote:not(.alignleft),
.alignright ~ .wp-block-quote:not(.alignright),
.alignleft ~ .wp-block-quote:not(.alignright){
	display:table;
}*/
.wp-block-pullquote footer{
    margin-bottom:1em;
}
.wp-block-pullquote footer:empty{
    display:none;
}
.wp-block-pullquote.mark-blue,
.wp-block-pullquote.mark-cool{
	border-top: 4px solid rgba(52, 152, 219,.7);
	border-bottom: 4px solid rgba(52, 152, 219,.7);
	background:rgba(52, 152, 219,.1);
}
.wp-block-pullquote.mark-blue cite,
.wp-block-pullquote.mark-cool cite{
	background:transparent;
}
.wp-block-pullquote.mark-notice,
.wp-block-pullquote.mark-yellow{
	border-top: 4px solid rgba(163, 140, 8,.7);
	border-bottom: 4px solid rgba(163, 140, 8,.7);
    background:rgba(163, 140, 8,.1);
}
.wp-block-pullquote.mark-notice cite,
.wp-block-pullquote.mark-yellow cite{
	 background:transparent;
}
.wp-block-pullquote.mark-info,
.wp-block-pullquote.mark-green{
	border-top: 4px solid rgba(22, 160, 133,.7);
	border-bottom: 4px solid rgba(22, 160, 133,.7);
    background:rgba(22, 160, 133,.1);
}
.wp-block-pullquote.mark-info cite,
.wp-block-pullquote.mark-green cite{
	background:transparent;
}
.wp-block-pullquote.mark-alert,
.wp-block-pullquote.mark-red{
	border-top: 4px solid rgba(231, 76, 60,.7);
	border-bottom: 4px solid rgba(231, 76, 60,.7);
    background:rgba(231, 76, 60,.1);
}
.wp-block-pullquote.mark-alert cite,
.wp-block-pullquote.mark-red cite{
	 background:transparent;
}	
	
/**
 * Block Columns
 */
.entry-content .wp-block-columns:before{
	content:none;
	display:none;
}
.entry-content .wp-block-columns:after{
	content:none;
	display:none;
}
.wp-block-columns .wp-block-latest-posts,
.wp-block-columns figure{
	margin:.5em;
	width:100%;
	max-width:calc(100% - 1em);
}
.wp-block-columns .wp-block-embed{
	margin-top:5px;
}

/**
 * Block Column
 */
.wp-block-text-columns{
	display:-webkit-box;
	display:-ms-flexbox;
	display:flex;
	-ms-flex-wrap:wrap;
	    flex-wrap:wrap;
	clear:both;
    float:none;
	margin:1.5em auto .75em;
}
section.wp-block-text-columns .wp-block-column{
	-webkit-box-flex:1;
	    -ms-flex:1 1;
	        flex:1 1;
	margin:3.25px;
	outline:1px solid rgba(127,127,127,.3);
	padding:.75em 1em;
	-webkit-box-sizing:border-box;
	        box-sizing:border-box;
}
.wp-block-text-columns.columns-2 .wp-block-column{
	-ms-flex-preferred-size:49%;
	    flex-basis:49%;
	-ms-flex-preferred-size:calc(50% - 7px);
	    flex-basis:calc(50% - 7px);
		margin:3.25px;
}
.wp-block-text-columns.columns-3 .wp-block-column{
	-ms-flex-preferred-size:30%;
	    flex-basis:30%;
	-ms-flex-preferred-size:calc(33.333% - 13px);
	    flex-basis:calc(33.333% - 13px);
		margin:3.25px;
}
.wp-block-text-columns.columns-4 .wp-block-column{
	width:24%;
	-ms-flex-preferred-size:24%;
	    flex-basis:24%;
	-ms-flex-preferred-size:calc(25% - 20px);
	    flex-basis:calc(25% - 20px);
		margin:3.25px;
}
.wp-block-text-columns .wp-block-column p:last-child{
	margin-bottom:0;
}
/**
 * Gutenberg Misc 
 */
.ja p.has-drop-cap:first-letter{
	float: left;
    font-size: 3em;
    line-height: 1;
    margin: .2em .2em 0 0;
    font-style: normal;	
}
.effect-child-image-zoom img,
.hover-zoom img{
  -webkit-transition: all 0.3s;
  transition: all 0.3s;
}
.effect-child-image-zoom img:hover,
.hover-zoom img:hover{
	-webkit-transform: scale(1.1);
  transform: scale(1.1);
}
/**
 * Paragraph
 */
.is-small-text{
    
}
.is-regular-text{
    
}
.is-large-text{
    
}
.is-larger-text{
    
}
	
	
/* todo raindrops_column_controller() works improperly on gutenberg */
.rd-col-1 .lsidebar,
.rd-col-1 .rsidebar{
    display:none!important;
}
@media screen and (min-width : 641px){
    .wp-block-latest-posts.is-grid li{
        -webkit-box-flex:1;
            -ms-flex:1;
                flex:1;
        -ms-flex-preferred-size: 28%;
            flex-basis: 28%;   
    }
    .is-grid.columns-6 li{
        -webkit-box-flex:1;
            -ms-flex:1;
                flex:1;
        -ms-flex-preferred-size: 13%;
            flex-basis: 13%;
    }
    .is-grid.columns-5 li{
        -webkit-box-flex:1;
            -ms-flex:1;
                flex:1;
        -ms-flex-preferred-size: 16%;
            flex-basis: 16%;
    }
    .is-grid.columns-4 li{
        -webkit-box-flex:1;
            -ms-flex:1;
                flex:1;
        -ms-flex-preferred-size: 21%;
            flex-basis: 21%;
    }

    .is-grid.columns-2 li{
        -webkit-box-flex:1;
            -ms-flex:1;
                flex:1;
        -ms-flex-preferred-size: 45%;
            flex-basis: 45%;
    }

}
@media screen and (max-width : 640px){
	
	article ul.wp-block-latest-posts.is-grid{
		display:block;
	}
    .entry-content ul.wp-block-latest-posts.is-grid.columns-2 li,
	.entry-content ul.wp-block-latest-posts.is-grid.columns-3 li,
	.entry-content ul.wp-block-latest-posts.is-grid.columns-4 li,
	.entry-content ul.wp-block-latest-posts.is-grid.columns-5 li{
		margin:.5em;
		display:list-item;
		width:auto;
		max-width:100%;
	}

    .wp-block-gallery.columns-3 figure, 
    .wp-block-gallery.columns-4 figure, 
    .wp-block-gallery.columns-5 figure, 
    .wp-block-gallery.columns-6 figure, 
    .wp-block-gallery.columns-7 figure, 
    .wp-block-gallery.columns-8 figure, 
    .wp-block-gallery.aligncenter.columns-3 figure, 
    .wp-block-gallery.aligncenter.columns-4 figure, 
    .wp-block-gallery.aligncenter.columns-5 figure, 
    .wp-block-gallery.aligncenter.columns-6 figure, 
    .wp-block-gallery.aligncenter.columns-7 figure, 
    .wp-block-gallery.aligncenter.columns-8 figure{
        -webkit-box-flex:1;
            -ms-flex:1 1 auto;
                flex:1 1 auto;
        margin:0;
        border:2px solid transparent;
    }
    div.entry-content .wp-block-gallery{
        width:100%;
        padding:0;
        display:-webkit-box;
        display:-ms-flexbox;
        display:flex;
    }
	.wp-block-categories.wp-block-categories-list.alignright,
	.wp-block-categories.wp-block-categories-list.alignleft{
		max-width:none;
		clear:both;
		float:none;
		margin-left:0;
		margin-right:0;
	}

    .entry-content .wp-block-categories.alignright, 
    .entry-content .wp-block-categories.alignleft,
    .wp-block-latest-posts.alignleft, 
    .wp-block-latest-posts.alignright, 
    .wp-block-video.alignleft, 
    .wp-block-video.alignright, 
    .wp-block-gallery.alignleft, 
    .wp-block-gallery.alignright{
        width:100%;
    }
    .wp-block-gallery{
        display:-webkit-box;
        display:-ms-flexbox;
        display:flex;
        float:none;
        margin-left:0;
        margin-right:0;
    }
    .wp-block-button.alignright{
		float:right;
	}
	
    .blocks-gallery-image img,
    .gallery-size-thumbnail .gallery-icon img,
    .gallery-size-quotthumbnailquot .gallery-icon img{
        width:100%;
        height:auto;
    }
    .wp-block-latest-posts.is-grid li,
    .is-grid.columns-6 li,
    .is-grid.columns-5 li,
    .is-grid.columns-4 li,
    .is-grid.columns-2 li{
        -webkit-box-flex:1;
            -ms-flex:1;
                flex:1;
        width:100%;
    }
    .entry-content section.wp-block-text-columns{
        display:-webkit-box;
        display:-ms-flexbox;
        display:flex;
        -webkit-box-orient:vertical;
        -webkit-box-direction:normal;
            -ms-flex-direction:column;
                flex-direction:column;
    }
    .entry-content .wp-block-text-columns .wp-block-column{
        width:100%;
       -webkit-box-flex:1;
           -ms-flex:1 1 100%;
               flex:1 1 100%;
       margin-right:0;
       margin-left:0;
    }
	div.wp-block-gallery.alignright, 
	div.wp-block-gallery.alignleft{
		width:100%;
		max-width:100%;
		margin:0;
	}
	.entry-content p.aligncenter,	
	.entry-content p.alignleft,
	.entry-content p.alignright{
		/* @1.494 */
		float:none;
		display:block;
		margin:1em;
		padding:1em;
		/* border:1px solid #ccc;*/
		max-width:calc( 100% - 2em );	
	}
	figure.wp-block-audio,
	figure.wp-block-audio.alignright,
	figure.wp-block-audio.alignleft{
		margin-left:auto;
		margin-right:auto;
	}
/**
 * Block wp-block-embed
 */
	figure.wp-block-video.alignright,
	figure.wp-block-video.alignleft,
	figure.wp-block-embed.alignright,
	figure.wp-block-embed.alignleft,
	figure.wp-block-embed-vimeo.alignright,
	figure.wp-block-embed-vimeo.alignleft,
	figure.wp-block-embed-facebook.alignright,
	figure.wp-block-embed-facebook.alignleft,
	figure.wp-block-embed-twitter.alignleft,
	figure.wp-block-embed-twitter.alignright,
	figure.wp-block-embed-instagram.alignright,
	figure.wp-block-embed-instagram.alignleft,
	figure.wp-block-embed-wordpress-tv.alignleft,
	figure.wp-block-embed-wordpress-tv.alignright,
	figure.wp-block-embed-reddit.alignright,
	figure.wp-block-embed-flickr.alignright,	
	figure.wp-block-embed-reddit.alignleft,
	figure.wp-block-embed-flickr.alignleft,		
	figure.wp-block-embed-kickstarter.alignright,
	figure.wp-block-embed-kickstarter.alignleft,
	figure.wp-block-embed-wordpress.alignright,
	figure.wp-block-embed-wordpress.alignleft,
	figure.wp-block-embed-soundcloud.alignright,
	figure.wp-block-embed-soundcloud.alignleft,
	figure.wp-block-embed-slideshare.alignleft,
	figure.wp-block-embed-slideshare.alignright,
	figure.wp-block-embed-ted.alignright,
	figure.wp-block-embed-ted.alignleft,
    figure.wp-block-embed-issuu.alignleft,	
    figure.wp-block-embed-issuu.alignright,
	figure.wp-block-embed-cloudup.alignright,
	figure.wp-block-embed-cloudup.alignleft,
	figure.wp-block-embed-reverbnation.alignright, 
	figure.wp-block-embed-reverbnation.alignleft, 
	figure.wp-block-embed-youtube.alignleft,
	figure.wp-block-embed-youtube.alignright{
		float:none;
		clear:both;
		margin-left:0;
		width:100%;
		max-width:none;
	}
	.index :not( figure ) > img.alignright, 
	.index :not( figure ) > img.alignleft,
	.index .oembed-container,
	.entry-content .wp-caption.aligncenter,	
	.entry-content .wp-caption.alignnone,	
	.entry-content .wp-caption.alignleft,
	.entry-content .wp-caption.alignright,
	a.attachment img,
	figure.wp-block-image,
	figure.wp-block-image.aligncenter,
	figure.wp-block-image.alignright,
	figure.wp-block-image.alignleft{
		float:none;
		clear:both;
		margin-left:auto;
		margin-right:auto;
	}
	figure.wp-block-image.aligncenter > img,
	figure.wp-block-image > img,
	.wp-block-image.alignleft > img, 
	.wp-block-image.alignright > img{
		float:none;
		clear:both;
		/* @1.510 margin:0;*/
		display:inline;/* @1.510 */
	}	
	.wp-block-video,
	.wp-block-embed,
	.wp-block-embed-vimeo,
	.wp-block-embed-facebook,
	.wp-block-embed-twitter,
	.wp-block-embed-twitter,
	.wp-block-embed-instagram,
	.wp-block-embed-wordpress-tv,
	.wp-block-embed-reddit,
	.wp-block-embed-flickr, 
	.wp-block-embed-kickstarter,
	.wp-block-embed-wordpress,
	.wp-block-embed-soundcloud,
	.wp-block-embed-slideshare,
	.wp-block-embed-ted,
	.wp-block-embed-issuu,
	.wp-block-embed-cloudup,
	.wp-block-embed-reverbnation,
	.wp-block-embed-youtube,
	.wp-block-video.aligncenter,
	.wp-block-embed.aligncenter,
	.wp-block-embed-vimeo.aligncenter,
	.wp-block-embed-facebook.aligncenter,
	.wp-block-embed-twitter.aligncenter,
	.wp-block-embed-twitter.aligncenter,
	.wp-block-embed-instagram.aligncenter,
	.wp-block-embed-wordpress-tv.aligncenter,
	.wp-block-embed-reddit.aligncenter,
	.wp-block-embed-flickr.aligncenter, 
	.wp-block-embed-kickstarter.aligncenter,
	.wp-block-embed-wordpress.aligncenter,
	.wp-block-embed-soundcloud.aligncenter,
	.wp-block-embed-slideshare.aligncenter,
	.wp-block-embed-ted.aligncenter,
	.wp-block-embed-issuu.aligncenter,
	.wp-block-embed-cloudup.aligncenter,
	.wp-block-embed-reverbnation.aligncenter,
	.wp-block-embed-youtube.aligncenter{
		float:none;
		clear:both;
		margin-left:auto;
		margin-right:auto;
		padding:0;
		width:100%;
		max-width:none;
	}
	.wp-block-image.aligncenter,
	.wp-block-image.alignleft,
	.wp-block-image.alignright{
		display:inline-block;
		float:none;
		clear:both;
		margin-left:auto;
		margin-right:auto;
		padding:0;
		width:auto;
		max-width:none;	
	}
	.entry-content .wp-block-cover-image,
	.entry-content .wp-block-cover-image.alignleft{
		height:30vw;
		background-size:cover;
		background-position:center center;
		background-repeat:no-repeat;
		margin-left:0;
		margin-right:0;
		padding-left:0;
		padding-right:0;
		background-attachment:fixed;
	}
	article .wp-block-cover-image.alignright{
		height:30vw;
		background-size:cover;
		background-position:center center;
		background-repeat:no-repeat;
		margin-left:0;
		margin-right:0;
		padding-left:0;
		padding-right:0;
		background-attachment:fixed;
	}
	.wp-block-cover-image .wp-block-cover-image-text{
		flex:1 1 auto;
		color: #fff;
		font-size: 2em;
		line-height: 1.25;
		max-width:100%;
		transform: none;
		text-align: center;
	}
	.entry-content .wp-block-pullquote,
	.wp-block-quote.is-large{
		margin-left:0;
		margin-right:0;
		min-width:100%;
	}
	article .entry-content .wp-block-gallery .blocks-gallery-item{
		/* contain all aligns */
		flex:1 1 auto;
	}
}
	
GUTENBERG;
	return $style;
}


function raindrops_gutengerg_indv_css_dark( $css ){
	
	$style=<<<CSS
.wp-block-button a:hover,
.wp-block-button:hover{
	filter: brightness(120%);
	color:#fff;
}
.wp-block-button.ghost a{
	color:#fff;
}
.wp-block-pullquote,	
.wp-block-pullquote cite{
	%c_3%;
}

.wp-block-latest-posts.is-grid li,
.wp-block-code,
pre.wp-block-preformatted{
    %c_3%;
}
/*
.entry-content > p.aligncenter,	
.entry-content > p.alignleft,
.entry-content > p.alignright,*/
.wp-block-audio,
.wp-block-code,
.wp-block-latest-posts.is-grid li{
    border:solid 1px %c_border%;
}
.wp-block-audio figcaption,
.wp-block-audio,
.wp-block-latest-posts__post-date{
	%c_3%;
}	
.wp-block-gallery:not(.is-cropped) figure{
	%c_4%;
}

.rd-content-width-fit.rd-pw-doc5 .index > li:nth-child(even) .wp-block-gallery:not(.is-cropped) figure{
	
}

.wp-block-image{
    -moz-border-radius: 3px;
    -khtml-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    background: -webkit-gradient(linear, left top, left bottom, from(%custom_dark_bg%), to(%custom_light_bg%));
    background: -moz-linear-gradient(top, %custom_dark_bg%, %custom_light_bg%);
	background-image: -ms-linear-gradient(top, %custom_dark_bg%, %custom_light_bg%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='%custom_dark_bg%', endColorstr='%custom_light_bg%');
    border:solid 1px %rgba_border%;	
}
.wp-block-video,
.wp-block-embed,
.wp-block-embed-vimeo,
.wp-block-embed-wordpress-tv,
.wp-block-embed-flickr, 
.wp-block-embed-kickstarter,
.wp-block-embed-wordpress,
.wp-block-embed-soundcloud,
.wp-block-embed-slideshare,
.wp-block-embed-ted,
.wp-block-embed-issuu,
.wp-block-embed-cloudup,
.wp-block-embed-youtube{
	%c_5%;	
}
.wp-block-video,
.wp-block-embed,
.wp-block-embed-vimeo,
.wp-block-embed-wordpress-tv,
.wp-block-embed-flickr, 
.wp-block-embed-kickstarter,
.wp-block-embed-soundcloud,
.wp-block-embed-slideshare,
.wp-block-embed-ted,
.wp-block-embed-issuu,
.wp-block-embed-cloudup,
.wp-block-embed-youtube{
	%c_5%;	
}
.wp-block-latest-posts time{
	background:transparent;
}


	
@media screen and (max-width : 641px){
	
}
	
CSS;
	
	return $css. raindrops_gutenberg_front_end_style(). $style;
}

function raindrops_gutengerg_indv_css_w3standard( $css ){
	
	$style=<<<CSS
.wp-block-button a:hover,
.wp-block-button:hover{
	filter: brightness(120%);
	color:#fff;
}
.wp-block-button.ghost a{
	color:#333;
}

.wp-block-latest-posts.is-grid li{
	background:#fff;
}
pre.wp-block-preformatted,
.wp-block-code{
    %c5%;
}
/*
.entry-content > p.aligncenter,	
.entry-content > p.alignleft,
.entry-content > p.alignright,*/
pre.wp-block-preformatted,
.wp-block-code,
.wp-block-latest-posts.is-grid li{
    outline:1px solid %rgba_border%;
}
.wp-block-latest-posts__post-date{
	color:#555;
}	
.wp-block-gallery:not(.is-cropped) figure{
	%c5%;
}
.wp-block-image{
    border:solid 1px %rgba_border%;
    -moz-border-radius: 3px;
    -khtml-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius:0 0 3px 3px;
    border:solid 1px #999;
}
.wp-block-video,
.wp-block-embed,
.wp-block-embed-vimeo,
.wp-block-embed-wordpress-tv,
.wp-block-embed-flickr, 
.wp-block-embed-kickstarter,
.wp-block-embed-soundcloud,
.wp-block-embed-slideshare,
.wp-block-embed-ted,
.wp-block-embed-issuu,
.wp-block-embed-cloudup,
.wp-block-embed-youtube{
	%c_5%;
}

.rd-content-width-fit.rd-pw-doc5 .index > li:nth-child(even) .wp-block-gallery:not(.is-cropped) figure{
	
}
	
@media screen and (max-width : 641px){
	
}
	
CSS;
	
	return $css. raindrops_gutenberg_front_end_style().$style;
}


function raindrops_gutengerg_indv_css_light( $css ){
	
	$style=<<<CSS

.wp-block-button a:hover,
.wp-block-button:hover{
	filter: brightness(120%);
	color:#fff;
}
.wp-block-button.ghost a{
	color:#333;
}

.wp-block-latest-posts.is-grid li,
.wp-block-code,
pre.wp-block-preformatted,
.entry-content .wp-block-categories{
   background:#fff;
}
/*
.entry-content > p.aligncenter,	
.entry-content > p.alignleft,
.entry-content > p.alignright,*/
.wp-block-code,
pre.wp-block-preformatted,
.wp-block-latest-posts.is-grid li{
    outline:1px solid %rgba_border%;
}
.wp-block-latest-posts__post-date{
	color:#555;
}
.wp-block-gallery:not(.is-cropped) figure{
	background:#fff;
}
.wp-block-image{
    border:solid 1px %rgba_border%;
    -moz-border-radius: 3px;
    -khtml-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius:0 0 3px 3px;
    border:solid 1px #999;
}
.wp-block-video,
.wp-block-embed,
.wp-block-embed-vimeo,
.wp-block-embed-wordpress-tv,
.wp-block-embed-flickr, 
.wp-block-embed-kickstarter,
.wp-block-embed-soundcloud,
.wp-block-embed-slideshare,
.wp-block-embed-ted,
.wp-block-embed-issuu,
.wp-block-embed-cloudup,
.wp-block-embed-youtube{
	%c_5%;
}

.rd-content-width-fit.rd-pw-doc5 .index > li:nth-child(even) .wp-block-gallery:not(.is-cropped) figure{
	
}
@media screen and (max-width : 641px){
	
}
	
CSS;
	
	return $css. raindrops_gutenberg_front_end_style(). $style;
}


function raindrops_gutengerg_indv_css_minimal( $css ){
    $font_color = raindrops_colors( 5, "color" );
	$background_3 = raindrops_colors( -3, "background" );
	$background3 = raindrops_colors( 3, "background" );
	$background4 = raindrops_colors( 4, "background" );
	$background5 = raindrops_colors( 5, "background" );	
	$style=<<<CSS
.wp-block-button a:hover,
.wp-block-button:hover{
	filter: brightness(120%);
	color:#fff;
}
.wp-block-button.ghost a{
	 color:#333;
}
.wp-block-latest-posts.is-grid li,
.entry-content .wp-block-categories{

    background:#fff;
}

.wp-block-code,
pre.wp-block-preformatted{
	color:#555;
	background:#f8f8ff;
}
.wp-block-code,
pre.wp-block-preformatted,
.wp-block-latest-posts.is-grid li{
	outline:1px solid rgba(222,222,222,1);

}
.wp-block-latest-posts__post-date{
	color:#555;
}		
.wp-block-gallery:not(.is-cropped) figure{
	%c5%;
}
.wp-block-image{
/*	background:#fff;
    border:solid 1px %rgba_border%;
	border-bottom: 4px solid #1baae1;
    border-bottom-width: 4px;
    border-bottom-style: solid;
    border-bottom-color: rgb(27, 170, 225);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1), 0 1px 5px 0 rgba(0,0,0,.1);*/
}
.rd-has-caption-image:hover,
.wp-block-image:hover{
	outline:1px solid $background3;
    box-shadow: 0px 0px 6px 3px $background4;
    -moz-box-shadow: 0px 0px 6px 3px $background4;
    -webkit-box-shadow: 0px 0px 6px 3px $background4;
    transition: box-shadow 0.5s ease-in-out;
    -webkit-transition: box-shadow 0.5s ease-in-out;
}
.wp-block-embed-mixcloud,
.wp-block-video,
.wp-block-embed-vimeo,
.wp-block-embed-wordpress-tv,
.wp-block-embed-flickr, 
.wp-block-embed-kickstarter,
.wp-block-embed-soundcloud,
.wp-block-embed-slideshare,
.wp-block-embed-ted,
.wp-block-embed-issuu,
.wp-block-embed-cloudup,
.wp-block-embed-youtube{
	%c_5%;
}
.wp-block-embed{
	background:transparent;
	color:#333;
}
/*.entry-content > p.aligncenter,	
.entry-content > p.alignleft,
.entry-content > p.alignright{
	border:1px solid #ccc;	
}*/

.rd-content-width-fit.rd-pw-doc5 .index > li:nth-child(even) .wp-block-gallery:not(.is-cropped) figure{
	background:#fff;
}


@media screen and (max-width : 641px){
	
}
	
CSS;
	
	return $css. raindrops_gutenberg_front_end_style(). $style;
}