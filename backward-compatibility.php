<?php

if( $raindrops_wp_version < '3.4' ){
	
	/**
	 * header text
	 * for backward compatibility 3.3 or before
	 */
		if(!defined('NO_HEADER_TEXT')){
			define('NO_HEADER_TEXT', false );
		}
	/**
	 * title and description default color
	 * for backward compatibility 3.3 or before
	 */
		if(!defined('HEADER_TEXTCOLOR')){
			define('HEADER_TEXTCOLOR', 'dddddd');
		}
	/**
	 * header image
	 * for backward compatibility 3.3 or before
	 */
		if(!defined('HEADER_IMAGE')){
			if(file_exists(get_stylesheet_directory().'/images/headers/wp3.jpg')){
				define('HEADER_IMAGE', get_stylesheet_directory_uri().'/images/headers/wp3.jpg');
			}else{
				define('HEADER_IMAGE', get_template_directory_uri().'/images/headers/wp3.jpg');
			}
		}
		if(!defined('HEADER_IMAGE_WIDTH')){
			define('HEADER_IMAGE_WIDTH', 950);
		}
		if(!defined('HEADER_IMAGE_HEIGHT')){
			define('HEADER_IMAGE_HEIGHT', 198);
		}
		if(!defined('RAINDROPS_HEADER_BACKGROUND_COLOR')){
			define('RAINDROPS_HEADER_BACKGROUND_COLOR','');
		}
		if(!defined('RAINDROPS_HEADER_BACKGROUND_IMAGE')){
			define('RAINDROPS_HEADER_BACKGROUND_IMAGE','');
		}
}

/**
 * Template function print header image
 *
 * This function has filter hook name raindrops_header_image
 * @param array( 'img'=> 'image uri' , 'height' => 'image height' , 'color' => 'text color', 'style' => '(default) background-size:cover;' , 'description' => 'replace text from bloginfo(description) to your text','description_style' => 'Your description style rule')
 * @return string htmlblock <div id="['header-image']" style="background-image:url([img]);height:[height];color:#[color]][style]"><p [description_style]>[WordPress site description]</p></div>
 */
    if ( ! function_exists( 'raindrops_header_image' ) and $wp_version < 3.4 ){
        function raindrops_header_image($args = array()){
            if ( 'blank' == get_theme_mod('header_textcolor', HEADER_TEXTCOLOR) or
                 '' == get_theme_mod('header_textcolor', HEADER_TEXTCOLOR)  ){
                $description_style = ' style="display:none;"';
                $height = HEADER_IMAGE_HEIGHT.'px';
            }elseif(preg_match("!([0-9a-f]{6}|[0-9a-f]{3})!si",get_header_textcolor())){
                $description_style = ' style="color:#' . get_header_textcolor() . ';"';
                $height = HEADER_IMAGE_HEIGHT.'px';
            }else{
                $description_style = '';
                $height = 0;
            }
            if(get_header_image() == ''){
                $height = 0;
                $description_style = ' style="display:none;"';
            }
            $defaults = array(
                'img' => get_header_image(),
                'height' => $height,
                'color' => HEADER_TEXTCOLOR,
                'style' => 'background-size:cover;',
                'description' => get_bloginfo( 'description' ),
                'description_style' => $description_style
            );
            $args = wp_parse_args( $args, $defaults );
            extract( $args, EXTR_SKIP );
            $html = '<div id="%1$s" style="background-image:url(%2$s);height:%3$s;color:#%4$s;%5$s"><p %6$s>%7$s</p></div>';
            $html = sprintf($html,
                            'header-image',
                            esc_url($img),
                            esc_html($height),
                            esc_html($color),
                            esc_html($style),// css needs > but this style is inline
                            htmlspecialchars($description_style,ENT_NOQUOTES),// css needs > but this style is inline
                            esc_html($description)
                            );
            return apply_filters("raindrops_header_image",$html);
        }
    }

    if ( ! function_exists( 'add_raindrops_stylesheet' ) and $wp_version < 3.4 ){

    function add_raindrops_stylesheet() {
		global $raindrops_current_theme_name, $raindrops_version;
        //$themes                 = get_themes();
        //$current_theme          = $raindrops_current_theme_name;
       
        $template_uri = get_template_directory_uri();
        $template_path = get_template_directory();
        $stylesheet_uri = get_stylesheet_directory_uri();
        $stylesheet_path = get_stylesheet_directory();
            $reset_font_grid    = $stylesheet_uri.'/reset-fonts-grids.css';
            if(!file_exists($stylesheet_path.'/reset-fonts-grids.css')){$reset_font_grid    = $template_uri.'/reset-fonts-grids.css';}
            wp_register_style('raindrops_reset_fonts_grids', $reset_font_grid,array(),$raindrops_version,'all');
            wp_enqueue_style( 'raindrops_reset_fonts_grids');
            $grids  = $stylesheet_uri.'/grids.css';
            if(!file_exists($stylesheet_path.'/grids.css')){$grids    = $template_uri.'/grids.css';}

            wp_register_style('raindrops_grids', $grids,array('raindrops_reset_fonts_grids'),$raindrops_version,'all');
            wp_enqueue_style( 'raindrops_grids');
            $fonts              = $stylesheet_uri.'/fonts.css';
            if(!file_exists($stylesheet_path.'/fonts.css')){$fonts    = $template_uri.'/fonts.css';}
            wp_register_style('raindrops_fonts', $fonts,array('raindrops_grids'),$raindrops_version,'all');
            wp_enqueue_style( 'raindrops_fonts');
            $language           = get_locale();
            $lang   = $stylesheet_uri.'/languages/css/'.$language.'.css';
            if(!file_exists($stylesheet_path.$language.'.css')){$lang    = $template_uri.'/languages/css/'.$language.'.css';}
            wp_register_style('lang_style', $lang,array('raindrops_fonts'),$raindrops_version,'all');
            wp_enqueue_style( 'lang_style');
            if(raindrops_warehouse_clone("raindrops_style_type") !== 'w3standard'){
                if(file_exists(get_stylesheet_directory().'/css3.css')){
                    $raindrops_css3   = $stylesheet_uri.'/css3.css';
                }else{
                    $raindrops_css3   = $template_uri.'/css3.css';
                }
            wp_register_style('raindrops_css3', $raindrops_css3,array('raindrops_fonts'),$raindrops_version,'all');
            wp_enqueue_style('raindrops_css3');
            }
            $child              = $template_uri.'/style.css';
            wp_register_style('style', $child,array('raindrops_fonts'),$raindrops_version,'all');
            wp_enqueue_style( 'style');

            if(is_child_theme()){

                $child              = $stylesheet_uri.'/style.css';
                wp_register_style('child', $child,array('style'),$raindrops_version,'all');
                wp_enqueue_style( 'child');

            }
/* add small js*/
            $raindrops_js   = $stylesheet_uri.'/raindrops.js';
            if(!file_exists($stylesheet_path.'/raindrops.js')){$raindrops_js    = $template_uri.'/raindrops.js';}
            wp_register_script('raindrops', $raindrops_js,array('jquery'),$raindrops_version,true);
            wp_enqueue_script('raindrops');
    }
	
	}

/**
 * Deprecated function
 * Must use wp_title() and filter function raindrops_filter_title
 *
 * Template function return title for html title element
 *
 * This function has filter hook name raindrops_wp_title
 * @param string text  append to title strings
 * @return string text
 */
    if ( ! function_exists( 'raindrops_wp_title' ) ){
        function raindrops_wp_title($text = ""){
            global $page, $paged;
            $title = wp_title( '|', false, 'right' );
            $title .= get_bloginfo( 'name' );
            $site_description = get_bloginfo( 'description', 'display' );
            if ( $site_description and ( is_home() or is_front_page() ) ){
                $title .= " | $site_description";
            }
            // Add a page number if necessary:
            if ( $paged >= 2 or $page >= 2 ){
                $title .= ' | ' . sprintf( __( 'Page %s', 'raindrops' ), max( $paged, $page ) );
            }
            if(!empty($string)){
                $title .= esc_html($text);
            }
            return  $title ;
        }
    }
