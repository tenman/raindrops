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
<script type="text/javascript"> jQuery( function ( $ ) { $( '#raindrops_metaslider' ).show(); } );</script>
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
	add_filter( 'amp_post_template_metadata', 'raindrops_amp_modify_json_metadata', 10, 2 );
	
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
			?>
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
			.alignleft{
			clear:left;
			}
			.alignright{
			clear:right;
			}
			.amp-wp-article-content:after{
				content:'';
				display:table;
				clear:both;
			}

			<?php
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

				if( ! isset( $metadata['publisher']['logo'] ) ) {
					
					$custom_logo_id = get_theme_mod( 'custom_logo' );
				
					if ( ! empty( $custom_logo_id ) ) {
						$logo_image  = wp_get_attachment_image_src( $custom_logo_id , 'full' );
						$logo_uri    = apply_filters( 'raindrops_amp_logo_uri', esc_url( $logo_image[0] ), absint( $post->ID ) );
						$logo_width	 = apply_filters( 'raindrops_amp_logo_width', absint( $logo_image[1] ), absint( $post->ID ) );
						$logo_height = apply_filters( 'raindrops_amp_logo_height', absint( $logo_image[2] ), absint( $post->ID ) );
					} else {
						$logo_uri    = apply_filters( 'raindrops_amp_logo_uri', '', absint( $post->ID ) );
						$logo_width	 = apply_filters( 'raindrops_amp_logo_width', '', absint( $post->ID ) );
						$logo_height = apply_filters( 'raindrops_amp_logo_height', '', absint( $post->ID ) );				
					}

					$metadata['publisher']['logo']	 = array(
						'@type'	 => 'ImageObject',
						'url'	 => $logo_uri,
						'width'	 => $logo_width,
						'height' => $logo_height,
					);
					
				}
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
if ( !function_exists( 'raindrops_gutenberg_enqueue_common_assets' ) ) {
	
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
add_action( 'enqueue_block_assets', 'raindrops_gutenberg_enqueue_common_assets' );

function raindrops_gutenberg_front_end_style(){
	
	$style =<<<GUTENBERG

/**
 * GUTENBERG
 *
 * Block Grid
 * Block Latest Posts
 * Block Gallery
 * Block Video, Block Image
 * Block Class alignleft, alignright
 * Block Table
 * Block Preformatted, Code
 * Block Pullquote
 * Block Verse
 * Block Button
 * Block Categories
 * Block Cover Image
 * Block Blockquote
 * Block Column
 * Gutenberg Misc
 * Note: color and border Apply filter
 */
/**
 * Block Grid
 */
.is-grid,
.is-grid li{
    padding:1em;
    margin:0 auto;
}
.is-grid{
    display:flex;
    flex-wrap:wrap;
}
.is-grid > li{
    flex:1 0 auto;
    margin:6px;
    text-align:center;
}
.is-grid > li a span{
    display:block;
    width:100%;
    height:100%;
    padding:1em;
    box-sizing:border-box;
}
/**
 * Block Latest Posts
 */
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
}
ul.wp-block-latest-posts:not(.is-grid) li:last-child{
    margin-bottom:0;
}
ul.wp-block-latest-posts:not(.is-grid) li{
    display:flex;
    flex-direction: row;
    justify-content: flex-start;
}
ul.wp-block-latest-posts:not(.is-grid) li time,
ul.wp-block-latest-posts:not(.is-grid) li a{
    flex:0 0 auto;
    margin-left:1em;
    text-align:left;
}
ul.wp-block-latest-posts:not(.is-grid) li time{
    order:1;
}
ul.wp-block-latest-posts:not(.is-grid) li a{
    order:2;
}
ul.wp-block-latest-posts.is-grid{
    display:flex;
    left:0;
    max-width:100%;
}
ul.wp-block-latest-posts.is-grid li{
    flex:1 1 auto;
	margin: 0 .5em .5em 0;
}
.wp-block-latest-posts__post-date{
    display:block;
    margin-bottom:.5em;  
}
.wp-block-latest-posts.is-grid a{
    padding:.5em;
    display:block;
    max-width:100%;
    box-sizing:border-box;
}
.wp-block-latest-posts.is-grid.columns-5 li{
	flex-basis:9%;
}
.wp-block-latest-posts.is-grid.columns-4 li{
	flex-basis:18%;
}
.wp-block-latest-posts.is-grid.columns-3 li{
	flex-basis:26%;
}
.wp-block-latest-posts.is-grid.columns-2 li{
	flex-basis:43%;
}
.wp-block-latest-posts.is-grid.columns-5 li:nth-last-of-type(1),
.wp-block-latest-posts.is-grid.columns-5 li:nth-of-type(5n),
.wp-block-latest-posts.is-grid.columns-4 li:nth-last-of-type(1),
.wp-block-latest-posts.is-grid.columns-4 li:nth-of-type(4n),
.wp-block-latest-posts.is-grid.columns-3 li:nth-last-of-type(1),
.wp-block-latest-posts.is-grid.columns-3 li:nth-of-type(3n),
.wp-block-latest-posts.is-grid.columns-2 li:nth-last-of-type(1),
.wp-block-latest-posts.is-grid.columns-2 li:nth-of-type(2n){
    margin-right:0;
}
/**
 * Block Gallery
 */
.wp-block-gallery figure{
    overflow:hidden;
}
.wp-block-gallery.alignnone{
    display:flex;
	margin-left:auto;
	margin-right:auto;
}
.wp-block-gallery.columns-6 .blocks-gallery-image:nth-last-of-type(1),
.wp-block-gallery.columns-6 .blocks-gallery-image:nth-of-type(6n),
.wp-block-gallery.columns-5 .blocks-gallery-image:nth-last-of-type(1),
.wp-block-gallery.columns-5 .blocks-gallery-image:nth-of-type(5n),
.wp-block-gallery.columns-4 .blocks-gallery-image:nth-last-of-type(1),
.wp-block-gallery.columns-4 .blocks-gallery-image:nth-of-type(4n),
.wp-block-gallery.columns-3 .blocks-gallery-image:nth-last-of-type(1),
.wp-block-gallery.columns-3 .blocks-gallery-image:nth-of-type(3n),
.wp-block-gallery.columns-2 .blocks-gallery-image:nth-last-of-type(1),
.wp-block-gallery.columns-2 .blocks-gallery-image:nth-of-type(2n),
.wp-block-gallery.columns-1 .blocks-gallery-image{
    margin-right:0;
}
.wp-block-gallery.alignwide{
    width:100%;
}

.gallery-size-thumbnail .gallery-icon img,
.gallery-size-quotthumbnailquot .gallery-icon img{
    vertical-align:middle;
    max-width:100%;
    width:150px;
    height:auto;
}
.gallery-size-thumbnail .gallery-icon,
.gallery-size-quotthumbnailquot .gallery-icon{
    overflow:hidden;
}
.wp-block-gallery .blocks-gallery-image, 
.wp-block-gallery.aligncenter .blocks-gallery-image{
	margin:0 .5em .5em 0;
}
.ie9 .wp-block-gallery .blocks-gallery-image,
.ie10 .wp-block-gallery .blocks-gallery-image,
.ie11 .wp-block-gallery .blocks-gallery-image{
	display:inline-block;
}
/**
 * Block Video, Block Image
 */
.wp-block-video video{
    max-width:100%;
    outline:none;
}
figure[class|="wp-block-embed"]{
    margin:1em 0;
    max-width:100%;
}
.wp-block-image figcaption:focus,
.blocks-gallery-image:focus,
.wp-block-image:focus,
.click-drawing-container:focus,
.wp-block-video:focus,
.wp-block-video *:focus{
    outline:none;
}
.wp-block-image{
	/* for ie11 */
	max-width:100%;
}
.wp-block-image img{
    overflow:hidden;
	max-width:100%;
}
.wp-block-image.alignright{
    text-align:right;
    padding:0;
    min-width:0;
}
.wp-block-image.alignleft > img,
.wp-block-image.alignright > img{
    text-align:center;
    margin:.25em;
}
/**
 * Block Class alignleft, alignright
 */
/*
.wp-block-video.alignleft,
.wp-block-video.alignright,
.wp-block-gallery.alignleft,
.wp-block-gallery.alignright{
    width:50%;
}*/

p.alignleft{
	/* @1.494 */
	display:inline-block;
	margin-right:1em;
	padding:1em;
	margin-top:.5em;
	border:1px solid #ccc;
	max-width:calc( 50% - 2em );
}

p.alignright{
	/* @1.494 */
	display:inline-block;
	margin-left:1em;
	padding:1em;
	margin-top:.5em;
	border:1px solid #ccc;
	max-width:calc( 50% - 2em );	
}

/**
 * Block Table
 */
.wp-block-table{
    display:table;
    
}
.wp-block-table.alignleft{
    /* todo rd-table-wrapper */
}
.wp-block-table.alignright{
    /* todo rd-table-wrapper */
}
/**
 * Block Preformatted, Code
 */
.wp-block-preformatted{
    white-space: pre-wrap; 
    white-space: moz-pre-wrap; 
    white-space: -pre-wrap; 
    white-space: -o-pre-wrap; 
    word-wrap: break-word; 
}
.wp-block-preformatted{
    padding:1em;
    margin:21px auto;
    line-height:2;
}
.wp-block-code{
    padding:0 1em;
    margin:21px auto;
    line-height:2;
}
/**
 * Block Pullquote
 */
.wp-block-pullquote,
.textwidget .wp-block-pullquote, 
.entry-content .wp-block-pullquote{
    border-left:none;
    margin-left:0;
    margin-right:0;
}
.wp-block-pullquote.alignleft{
    margin-right:1em;
}
.wp-block-pullquote.alignright{
    margin-left:1em;
}
.wp-block-pullquote footer{
    margin-bottom:1em;
}
.wp-block-pullquote footer:empty{
    display:none;
}
/**
 * Block Verse
 */
.wp-block-verse{
    font-family:arial,helvetica,clean,sans-serif;
    line-height:2;
    white-space:pre-wrap;
}
/**
 * Block Button
 */
div.wp-block-button.alignright,
div.wp-block-button.aligncenter,
.wp-block-button.alignnone{
    display:inline-block;
    height:auto;
    padding:0 1.275em;
}

.wp-block-button.aligncenter{
    position: relative;
    left: 50%;
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
/**
 * Block Categories
 */
.entry-content .wp-block-categories{
    margin-top:0;
    max-width:100%;
    padding-left:6px;
    padding-top:6px;
    padding-right:6px;
    display:flex;
}
.wp-block-categories > ul{
    margin-top:0;
    left:0;
    display:flex;
    flex-wrap:wrap;
    max-width:none; 
}
.entry-content .wp-block-categories.alignright,
.entry-content .wp-block-categories.alignleft{
    width:296px;   
}
.wp-block-categories > ul > li{
    padding:.5em;
    list-style:none;
    display:inline-block;
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
}
.wp-block-categories .children{
    position:static;
    padding-left:1em;
}
.entry-content .wp-block-categories .children li{
    list-style:none;
    max-width:100%;
    min-width:0;
    background:transparent;
}
.wp-block-audio{
    max-width:100%;
    width:296px;
    height:32px;
}
div[class|="wp-block"].alignleft,
figure[class|="wp-block"].alignleft{
	clear:left;
	margin-right:1em;
	padding:1em;
	box-sizing:border-box;
	margin-top:.5em;
	max-width:calc( 50% - 1em );
	outline:1px solid #ccc;
}
div[class|="wp-block"].alignright,
figure[class|="wp-block"].alignright{
	clear:right;
	margin-left:1em;
	padding:1em;
	box-sizing:border-box;
	margin-top:.5em;
	max-width:calc( 50% - 1em );
	outline:1px solid #ccc;
}
div.wp-block-gallery.alignleft,
div.wp-block-gallery.alignright{
	padding-bottom:0;
}
.entry-content .wp-block-separator{
    border:none;
    clear:both;
    float:none;
    height:2em;
    margin-top:1em;
    margin-bottom:.5em;
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
#doc5 section.wp-block-cover-image,
section.wp-block-cover-image{
    margin:21px -150%;
    padding:21px 150%;
    background-size:auto;
    background-position:center center;
    background-repeat:no-repeat;
}
.wp-block-cover-image:not(.has-background-dim):before{
	content: '';
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
	background:#000;
	z-index:-1;
}
.home .wp-block-cover-image{
	margin-top:21px;
	margin-bottom:21px;
}
.wp-block-cover-image:hover{
	z-index:100;
}
#container .yui-u.first{
    z-index:1;
}
#yui-main + .yui-b,
#container .yui-u:last-child{
    z-index:99;
    position:relative;
}
/**
 * Block Blockquote
 * wp-block-quote
 */
.wp-block-quote.blocks-quote-style-1 footer{
    margin-bottom:1em;
}
.ja .wp-block-quote.blocks-quote-style-2 p{
    font-style:normal;
}
.wp-block-quote.blocks-quote-style-2{
	border-left:none;
	margin:1em 0;
	padding:1em 40px;
}
/**
 * Block Column
 */
.entry-content section.wp-block-column{
    display:flex;
}
/**
 * Gutenberg Misc 
 */
.effect-child-image-zoom img,
.hover-zoom img{
  -moz-transition: all 0.3s;
  -webkit-transition: all 0.3s;
  transition: all 0.3s;
}
.effect-child-image-zoom img:hover,
.hover-zoom img:hover{
	  -moz-transform: scale(1.1);
	-webkit-transform: scale(1.1);
  transform: scale(1.1);
}
/*　todo raindrops_column_controller() works improperly on gutenberg　*/
.rd-col-1 .lsidebar,
.rd-col-1 .rsidebar{
    display:none!important;
}
@media screen and (min-width : 641px){
    .wp-block-latest-posts.is-grid li{
        flex:1;
        flex-basis: 28%;   
    }
    .is-grid.columns-6 li{
        flex:1;
        flex-basis: 13%;
    }
    .is-grid.columns-5 li{
        flex:1;
        flex-basis: 16%;
    }
    .is-grid.columns-4 li{
        flex:1;
        flex-basis: 21%;
    }

    .is-grid.columns-2 li{
        flex:1;
        flex-basis: 45%;
    }
}
@media screen and (max-width : 640px){
	
	article ul.wp-block-latest-posts.is-grid{
		display:block;
		margin:2em;
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
        flex:1 1 auto;
        margin:0;
        border:2px solid transparent;
    }
    div.entry-content .wp-block-gallery{
        width:100%;
        padding:0;
        display:flex;
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
        display:flex;
        float:none;
        margin-left:0;
        margin-right:0;
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
        flex:1;
        width:100%;
    }
    .entry-content section.wp-block-text-columns{
        display:flex;
        flex-direction:column;
    }
    .entry-content .wp-block-text-columns .wp-block-column{
        width:100%;
       flex:1 1 100%;
       margin-right:0;
       margin-left:0;
    }
	.entry-content p.alignleft,
	.entry-content p.alignright{
		/* @1.494 */
		float:none;
		display:block;
		margin:1em;
		padding:1em;
		border:1px solid #ccc;
		max-width:none;	
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
.wp-block-button a{
	color:#fff;
}

.wp-block-latest-posts.is-grid li,
.wp-block-code,
pre.wp-block-preformatted{
    %c_3%;
}
.wp-block-code,
.wp-block-latest-posts.is-grid li{
    border:1px solid %rgba_border%;
}
.wp-block-latest-posts__post-date{
	%c_3%;
}	
.wp-block-gallery:not(.is-cropped) figure{
	%c_4%;
}
.wp-block-quote.blocks-quote-style-2,
.wp-block-quote.blocks-quote-style-1{
    %c_3%;
	border: 1px solid rgba(68, 68, 68,0.5);
    border-left:solid 6px %c_border%;
	
}
.rd-content-width-fit.rd-pw-doc5 .index > li:nth-child(even) .wp-block-gallery:not(.is-cropped) figure{
	
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
.wp-block-button a{
	color:#fff;
}

.wp-block-latest-posts.is-grid li{
	background:#fff;
}
pre.wp-block-preformatted,
.wp-block-code{
    %c5%;
}
pre.wp-block-preformatted,
.wp-block-code,
.wp-block-latest-posts.is-grid li{
    border:1px solid %rgba_border%;
}
.wp-block-latest-posts__post-date{
	color:#555;
}	
.wp-block-gallery:not(.is-cropped) figure{
	%c5%;
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
.wp-block-button a{
	color:#fff;
}

.wp-block-latest-posts.is-grid li,
.wp-block-code,
pre.wp-block-preformatted,
.entry-content .wp-block-categories{
   background:#fff;
}
.wp-block-code,
pre.wp-block-preformatted,
.wp-block-latest-posts.is-grid li{
    border:1px solid %rgba_border%;
}
.wp-block-latest-posts__post-date{
	color:#555;
}
.wp-block-gallery:not(.is-cropped) figure{
	background:#fff;
}
.rd-content-width-fit.rd-pw-doc5 .index > li:nth-child(even) .wp-block-gallery:not(.is-cropped) figure{
	
}	
@media screen and (max-width : 641px){
	
}
	
CSS;
	
	return $css. raindrops_gutenberg_front_end_style(). $style;
}


function raindrops_gutengerg_indv_css_minimal( $css ){
	
	$style=<<<CSS
.wp-block-button a:hover,
.wp-block-button:hover{
	filter: brightness(120%);
	color:#fff;
}
.wp-block-button a{
	color:#fff;
}
.wp-block-latest-posts.is-grid li,
.entry-content .wp-block-categories{

    background:#fff;
}

.wp-block-code,
pre.wp-block-preformatted{
	%c5%;	
}
.wp-block-code,
pre.wp-block-preformatted,
.wp-block-latest-posts.is-grid li{
    border:1px solid %rgba_border%;
}
.wp-block-latest-posts__post-date{
	color:#555;
}		
.wp-block-gallery:not(.is-cropped) figure{
	%c5%;
}
.rd-content-width-fit.rd-pw-doc5 .index > li:nth-child(even) .wp-block-gallery:not(.is-cropped) figure{
	background:#fff;
}

@media screen and (max-width : 641px){
	
}
	
CSS;
	
	return $css. raindrops_gutenberg_front_end_style(). $style;
}