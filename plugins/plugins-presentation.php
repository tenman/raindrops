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
			add_filter( 'raindrops_next_prev_links', 'raindrops_use_wp_pagenav', 10, 2 );
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
				return wp_pagenavi( array( 'echo' => false, 'options' => array( 'prev_text' => esc_html__( 'Prev', 'Raindrops' ), 'next_text' => esc_html__( 'Next', 'Raindrops' ) ) ) );
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
			$after	 = array( 'previouspostslink" rel="prev"', 'previouspostslink" rel="next"' );

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
					break;
				case 'light':
					$color_type_value	 = 3;
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
			$raindrops_pagenav_css = '
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
			.wp-pagenavi .previouspostslink,.wp-pagenavi .last,.wp-pagenavi .pages{display:block;text-align:center;} }';

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

			add_action( 'raindrops_after_nav_menu', 'raindrops_bcn_nav_menu' );
			add_action( 'wp_enqueue_scripts', 'raindrops_bcn_css' );

			if ( get_locale() == 'ja' ) {

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
		global $post;
		if ( 'yes' == get_theme_mod( 'raindrops_breadcrumb_navxt_status' ) &&
		'yes' == raindrops_warehouse_clone( 'raindrops_plugin_presentation_bcn_nav_menu' ) ) {

			$html		 = '<ol class="breadcrumbs" itemprop="breadcrumbs">%1$s</ol>';
			$breadcrumb	 = bcn_display_list( true );

			if ( (!is_home() || !is_front_page() ) && ( isset( $post ) && 0 !== $post->ID ) ) { // $post->ID for check the events calendar
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

			$raindrops_bcn_css = 'ol.breadcrumbs{
    margin:1em;
}
.breadcrumbs li{
    list-style:none;
    display:inline-block;
    margin:0;
    padding:0;
}
.breadcrumbs li:after{
    content: ">";
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
.entry-content ul .raindrops-toggle{
    list-style:none;
}
.raindrops-toggle + .raindrops-toggle{
    margin-top:1em;
}

@media screen and (max-width : 640px){
    ol.breadcrumbs{
        margin:2em 0;
        border-top:1px solid rgba(222,222,222,.5);

    }
    .breadcrumbs li{
        list-style:none;
        display:block;
        margin:0;
        padding:1em;
        border-bottom:1px solid rgba(222,222,222,.5);
    }
    .breadcrumbs li:nth-child(2) a{
        margin:0 0 0 10px;
    }

    .breadcrumbs li:nth-child(3) a{
        margin:0 0 0 20px;
    }
    .breadcrumbs li:nth-child(4) a{
        margin:0 0 0 30px;
    }
    .breadcrumbs li:nth-child(5) a,
    .breadcrumbs li:nth-child(6) a,
    .breadcrumbs li:nth-child(7) a,
    .breadcrumbs li:nth-child(8) a,
    .breadcrumbs li:nth-child(9) a,
    .breadcrumbs li:nth-child(10) a{
        margin:0 0 0 40px;
    }

    .breadcrumbs li:after{
        content: "";
        display:inline-block;
        width:2em;
        text-align:center;
    }
    .current_item{
        text-align:center;
    }
}';
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

				$replacements[ "%htitle%" ] = $replacements[ "%htitle%" ] . esc_html__( 'year_name', 'Raindrops' );
			}
			if ( preg_match( '!date-day!', $this_type ) ) {

				$replacements[ "%htitle%" ] = $replacements[ "%htitle%" ] . esc_html__( 'day_name', 'Raindrops' );
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

			$html = '<div id="raindrops_metaslider" class="clearfix">%1$s</div>';

			if ( is_home() || is_front_page() ) {

				return sprintf( $html, do_shortcode( "[metaslider id=" . $raindrops_slider_action . "]" ) );
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
		}
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
				.metaslider-coin{margin:auto;}';
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
			<script type="text/javascript">
			    jQuery( function ( $ ) {
			        $( '#raindrops_metaslider' ).show();
			    } );
			</script> 
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
		add_filter( 'tribe_events_event_classes', 'raindrops_tribe_events_event_classes', 999 );
		add_action( 'wp_enqueue_scripts', 'raindrops_the_event_calendar_css' );
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
			/* 	$return_value[] = 'gradient-1';
			  $return_value[] = 'corner';
			  $return_value[] = 'block'; */
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
	function raindrops_the_event_calendar_css() {
		if ( 'yes' == get_theme_mod( 'raindrops_the_events_calendar_status' ) &&
		'yes' == raindrops_warehouse_clone( 'raindrops_plugin_presentation_the_events_calendar' ) ) {
			$color_type	 = raindrops_warehouse( 'raindrops_style_type' );
			$border_rgba = '52,52,52,1';
			switch ( $color_type ) {
				case 'dark':
					$color_type_value	 = -3;
					$border_rgba		 = '222,222,222,0.3';
					break;
				case 'light':
					$color_type_value	 = 4;
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
			} else {
				$raindrops_gradient	 = '';
				$custom_color		 = '#000';
				$custom_background	 = '#fff';
			}
			$raindrops_pagenav_css = '@media screen and (max-width : 920px){
					div#tribe-bar-collapse-toggle{color:' . $custom_color . '; background:' . $custom_background . '} 
				}	
.tribe-events-loop .tribe-events-list .tribe-events-event-cost span{ color:red;}
			.tribe-events-list-widget li{padding:0 10px 20px}
			.tribe-events-list-widget li{}
			.events-archive .entry-title,.icon-link-no-title,
			.events-single .entry-title{display:none;}
			.events-archive.events-gridview #tribe-events-content table .vevent .entry-title{display:block;margin:0;text-align:left;background:transparent;}
			.events-archive.events-gridview #tribe-events-content table .vevent .tribe-events-month-event-title:hover + .tribe-events-tooltip .entry-title{color:#000;}
			.events-archive.events-gridview #tribe-events-content  .vevent .entry-title,
			.events-archive #tribe-events-bar .tribe-bar-views-inner label,
			.tribe-events-day .tribe-events-day-time-slot h5,
			.tribe-bar-views-inner,
			#tribe-bar-form,
			.tribe-events-list .tribe-events-event-cost span,
			.tribe-events-list-separator-month span,
			.single-tribe_events .tribe-events-event-meta{color:' . $custom_color . '; background:' . $custom_background . '}

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
			#tribe-bar-views .tribe-bar-views-list .tribe-bar-views-option a:hover{background:#fff;color:#000;}
			.tribe-events-list-widget .tribe-events-widget-link a,
			.tribe-events-list-widget .tribe-events-list-widget-events .entry-title{font-size:108%;}
			.tribe-events-list-widget ol li{margin-bottom:10px;}
			#tribe-events-content .tribe-events-calendar td:hover{background:' . $custom_background . '}';

			wp_add_inline_style( 'tribe-events-calendar-style', $raindrops_pagenav_css );
		}
	}

}


add_filter( 'load_textdomain_mofile', 'raindrops_override_quick_cache_mo', 10, 2 );

if ( !function_exists( 'raindrops_override_quick_cache_mo' ) ) {
/**
 * 
 * @param type $mofile
 * @param type $domain
 * @return type
 */
	function raindrops_override_quick_cache_mo( $mofile, $domain ) {
		$raindrops_locale = get_locale();
		if ( $domain == 'quick-cache' && 'ja' == $raindrops_locale ) {
			return get_template_directory() . '/languages/plugins/quick-cache/quick-cache-' . $raindrops_locale . '.mo';
		}
		return $mofile;
	}

}
?>