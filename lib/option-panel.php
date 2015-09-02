<?php
/**
 * Raindrops default settings and display the admin option panel.
 *
 * this scripts moved from functions.php 0.929
 *
 * @package WordPress
 * @subpackage Raindrops
 */
if ( !defined( 'ABSPATH' ) ) {

    exit;
}

/**
 * Raindrops option panel
 *
 *
 * @package WordPress
 * @subpackage Raindrops
 */
class raindrops_menu_create {

    var $accesskey                                          = array( "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z" );
    var $table_template                                     = '<table class="%s widefat post fixed raindrops-value-set-tables">';
    var $title_template                                     = '<a id="%s" href="#wpwrap" class="go-top"><span>page top</span></a><h3 title="%s" class="raindrops-options-title">%s</h3>';
    var $excerpt_template                                   = '<div class="raindrops-excerpt">%s</div>';
    var $line_select_element                                = '<select accesskey="%s" name="%s" size="%d" style="height:%spx;">';
    var $col_settings_raindrops_col_width                   = array(
        "left 160px"  => "t1",
        "left 180px"  => "t2",
        "left 300px"  => "t3",
        "right 180px" => "t4",
        "right 240px" => "t5",
        "right 300px" => "t6"
    );
    var $col_settings_raindrops_page_width                  = array(
        "750px centered" => "doc",
        "950px centered" => "doc2",
        "fluid"          => "doc3",
        "974px"          => "doc4",
		"full width" => "doc5",
    );
    var $col_settings_raindrops_right_sidebar_width_percent = array(
        "25%" => "25",
        "33%" => "33",
        "50%" => "50",
        "66%" => "66",
        "75%" => "75"
    );
    var $col_settings_raindrops_show_right_sidebar          = array(
        "show" => "show",
        "hide" => "hide"
    );
    var $col_settings_raindrops_style_type                  = array(
        "light"      => "light",
        "dark"       => "dark",
        "w3standard" => "w3standard",
        "minimal"    => "minimal",
        "helloworld" => "helloworld",
    );
    var $col_settings_raindrops_color_scheme                = array(
        "Japan"           => "raindrops_color_ja",
        "USA"             => "raindrops_color_en",
        "WWW"             => "raindrops_color_en_140",
        "Animation Color" => "raindrops_color_anime"
    );
    var $first_save_to_database                             = 'no';
	
	function __construct(){
		
	}
    /**
     *
     *
     *
     *
     *
     */
    function raindrops_SubMenu_GUI() {

        do_action( 'raindrops_SubMenu_GUI_pre' );

        global $wpdb, $raindrops_base_setting, $raindrops_wp_version, $raindrops_current_theme_name;

        if ( true == RAINDROPS_USE_AUTO_COLOR ) {

            $this->col_settings_raindrops_style_type = raindrops_register_styles( "w3standard" );
        } else {

            $this->col_settings_raindrops_style_type = array( "w3standard" => "w3standard" );
        }

        $settings_check = get_option( 'raindrops_theme_settings' );

        if ( $settings_check == false ) {

            $this->first_save_to_database = 'yes';
        }


        $ok     = false;
        $result = "";
        /**
         * POSTGET
         *
         *
         */
        if ( isset( $_POST[ 'raindrops_option_values' ] ) && !empty( $_POST[ 'raindrops_option_values' ] ) ) {

            if ( !wp_verify_nonce( $_POST[ '_wpnonce' ], 'update-options' ) ) {

                wp_die( esc_html__( 'Post Errors 14', 'raindrops' ) );
            }

            if ( !check_admin_referer( 'update-options', '_wpnonce' ) ) {

                wp_die( esc_html__( 'Post Errors 18', 'raindrops' ) );
            }


            $option_id         = intval( $_POST[ 'option_id' ] );
            $raindrops_updates = "";

            foreach ( $_POST[ "raindrops_option_values" ] as $key => $val ) {

                $valid_function       = $key . '_validate';
                $new_settings         = get_option( 'raindrops_theme_settings' );
                $new_settings[ $key ] = $valid_function( $val );

                $upload_dir                                   = wp_upload_dir();
                $new_settings[ 'current_stylesheet_dir_url' ] = get_stylesheet_directory_uri();
                $new_settings[ 'current_upload_base_url' ]    = $upload_dir[ 'baseurl' ];
                $new_settings[ 'install' ]                    = true;
                if ( $key == "raindrops_style_type" ) {
                    $style_type                            = raindrops_warehouse( "raindrops_style_type" );
                    $raindrops_indv_css                    = raindrops_design_output( $style_type ) . raindrops_color_base();
                    $new_settings[ '_raindrops_indv_css' ] = $raindrops_indv_css;
                }

                if ( update_option( 'raindrops_theme_settings', $new_settings ) ) {
                    $ok = true;
                    $raindrops_updates .= ',<span class="' . esc_attr( $key ) . '">' . $key . '</span>';
                }
            }
        }
        $result .= '<div class="wrap"><div id="title-raindrops-header" >';
        $result .= "<h2>" . ucfirst( $raindrops_current_theme_name ) . esc_html__( ' Theme Settings', 'raindrops' ) . "</h2>";


        $install_condition = get_option( 'raindrops_theme_settings' );

        if ( $install_condition !== false ) {

            $result .= "<p>" . __( 'Saved Database table name:', 'raindrops' ) . " <strong>" . RAINDROPS_PLUGIN_TABLE . "</strong></p></div>";
        } else {

            $result .= "<p>" . __( 'Now, Raindrops Not Using Database Table', 'raindrops' ) . "</p></div>";
        }
        /**
         *
         *
         *
         *
         *
         */
        if ( isset( $_POST[ 'reset' ] ) ) {

            foreach ( $raindrops_base_setting as $add ) {

                $option_name                              = $add[ 'option_name' ];
                $raindrops_theme_settings[ $option_name ] = $add[ 'option_value' ];
            }
            $style_type                                               = raindrops_warehouse( "raindrops_style_type" );
            $raindrops_indv_css                                       = raindrops_design_output( $style_type ) . raindrops_color_base();
            $raindrops_theme_settings[ '_raindrops_indv_css' ]        = $raindrops_indv_css;
            $upload_dir                                               = wp_upload_dir();
            $raindrops_theme_settings[ 'current_stylesheet_dir_url' ] = get_stylesheet_directory_uri();
            $raindrops_theme_settings[ 'current_upload_base_url' ]    = $upload_dir[ 'baseurl' ];
            $raindrops_theme_settings[ 'install' ]                    = true;

            update_option( 'raindrops_theme_settings', $raindrops_theme_settings, "", $add[ 'autoload' ] );
            //1.213 nav_menu hide issue
           //remove_theme_mods();

            do_action( 'raindrops_remove_theme_mods' );

            if ( file_exists( get_stylesheet_directory() . '/images/headers/wp3.jpg' ) ) {

                $raindrops_site_image           = get_stylesheet_directory_uri() . '/images/headers/wp3.jpg';
                $raindrops_site_thumbnail_image = get_stylesheet_directory_uri() . '/images/headers/wp3-thumbnail.jpg';
            } else {

                $raindrops_site_image           = get_template_directory_uri() . '/images/headers/wp3.jpg';
                $raindrops_site_thumbnail_image = get_template_directory_uri() . '/images/headers/wp3-thumbnail.jpg';
            }

            set_theme_mod( 'default-image', $raindrops_site_image );
        }
        /**
         *
         *
         *
         *
         *
         */
        if ( isset( $_POST[ 'raindrops_option_values' ] ) && !empty( $_POST[ 'raindrops_option_values' ] ) ) {

            $scheme = raindrops_warehouse( "raindrops_color_scheme" );
            global $$scheme;

            if ( $ok == true ) {

                if ( $this->first_save_to_database == 'yes' ) {

                    $result .= '<div id="message" class="updated fade" title="' . esc_attr( $raindrops_updates ) . '"><p>' . __( 'updated saved database successfully.', 'raindrops' );
                } else {

                    $result .= '<div id="message" class="updated fade" title="' . esc_attr( $raindrops_updates ) . '"><p>' . sprintf( __( 'updated %1$s successfully.', 'raindrops' ), $raindrops_updates );
                }

                if ( is_multisite() ) {

                    $result .= sprintf( '<a href="%s">%s</a></p></div>', 'themes.php?page=raindrops_settings', esc_html__( " MultiSite User must Click here !!", 'raindrops' ) );
                } else {

                    $result .= '</p></div>';
                }
            }
        }
        /**
         *
         *
         *
         *
         *
         */
        if ( isset( $_POST[ 'raindrops_upload' ] ) ) {

            global $raindrops_max_upload_size, $raindrops_max_width, $raindrops_allow_file_type;

            $upload_result = raindrops_upload_image( $raindrops_max_upload_size, $raindrops_max_width, $raindrops_allow_file_type );

            if ( true == $upload_result[ 0 ] ) {

                $result .= '<div id="message" class="updated fade" title="' . esc_attr( basename( $upload_result[ 1 ] ) ) . '"><img src="' . $upload_result[ 2 ] . '" width="100" style="vertical-align:middle;">&nbsp;&nbsp;&nbsp;&nbsp;' . sprintf( __( 'updated %1$s successfully.', 'raindrops' ), basename( $upload_result[ 2 ] ) );
            } else {

                $result .= '<div id="message" class="updated fade" title="' . esc_attr( basename( $upload_result[ 1 ] ) ) . '">' . sprintf( __( 'updated %s fail.', 'raindrops' ), $upload_result[ 1 ] );
            }
        }
        $result .= '</div>';
        $result .= '<div id="reset2"></div>';
        $result .= '<div>' . $this->raindrops_form_user_input() . '</div>';

        echo $result;
    }

    /**
     *
     *
     *
     *
     *
     */
    function raindrops_add_menus() {

        global $raindrops_wp_version, $raindrops_current_theme_name;

        if ( function_exists( 'add_theme_page' ) ) {

            $option_name = ucwords( $raindrops_current_theme_name ) . ' Options';
            $hook_suffix = add_theme_page( RAINDROPS_TABLE_TITLE, $option_name, 'edit_theme_options', 'raindrops_settings', array( $this, 'raindrops_SubMenu_GUI' ) );

            if ( $hook_suffix ) {

                add_action( 'admin_print_styles-' . $hook_suffix, array( $this, 'raindrops_admin_print_styles' ) );
            }
        }
    }

    /**
     *
     *
     *
     *
     *
     */
    function raindrops_admin_print_styles() {

        global $raindrops_wp_version;

        if ( file_exists( get_stylesheet_directory() . '/admin-options.css' ) ) {

            echo '<style type="text/css">@import url("' . get_stylesheet_directory_uri() . '/admin-options.css?ver=' . $raindrops_wp_version . '");</style>';
        } else {

            echo '<style type="text/css">@import url("' . get_template_directory_uri() . '/admin-options.css?ver=' . $raindrops_wp_version . '");</style>';
        }
    }

    /**
     *
     *
     *
     *
     *
     */

    function raindrops_form_user_input() {

        global $raindrops_base_setting;
        global $wpdb;
        global $raindrops_wp_version;
        global $raindrops_current_theme_name;
        global $raindrops_current_data_theme_uri;

        $option_value = "-";
        $lines        = "";
        $i            = 0;
		$deliv		  = filter_input(INPUT_ENV,'REQUEST_URI');
        $results      = get_option( 'raindrops_theme_settings' );

        if ( $results == false ) {
            $this->first_save_to_database = 'yes';
            $results                      = array();

            foreach ( $raindrops_base_setting as $key => $row ) {

                $raindrops_option_name             = $raindrops_base_setting[ $key ][ 'option_name' ];
                $raindrops_option_value            = $raindrops_base_setting[ $key ][ 'option_value' ];
                $results[ $raindrops_option_name ] = $raindrops_base_setting[ $key ][ 'option_value' ];
            }
        }

        foreach ( $raindrops_base_setting as $key => $row ) {

            $raindrops_option_name  = $raindrops_base_setting[ $key ][ 'option_name' ];
            $raindrops_option_value = $raindrops_base_setting[ $key ][ 'option_value' ];

            if ( !empty( $results[ $raindrops_option_name ] ) ) {

                $raindrops_sort[ $raindrops_option_name ] = $results[ $raindrops_option_name ];
            } else {

                $raindrops_sort[ $raindrops_option_name ] = $raindrops_option_value;
            }
        }
        $results = $raindrops_sort;

        $current_heading_image     = raindrops_warehouse( "raindrops_heading_image" );
        $raindrops_navigation_add  = '';
        $raindrops_navigation_list = '<div class="raindrops-navigation-wrapper"><h3 class="raindrops-navigation-title">' . __( 'WordPress Native Theme Options', 'raindrops' ) . '</h3><ul style="margin-bottom:5px;" class="raindrops-native-menu">';


        $raindrops_navigation_list .= '<li><a href="' . admin_url( 'customize.php' ) . '">' . esc_html__( 'Theme customizer', 'raindrops' ) . '</a></li>';

        $raindrops_navigation_list .= '<li><a href="' . admin_url( 'themes.php?page=custom-header' ) . '">' . esc_html__( 'Custom Header', 'raindrops' ) . '</a></li>';
        $raindrops_navigation_list .= '<li><a href="' . admin_url( 'themes.php?page=custom-background' ) . '">' . esc_html__( 'Custom Background', 'raindrops' ) . '</a></li>';
        $raindrops_navigation_list .= '<li><a href="' . admin_url( 'widgets.php' ) . '">' . esc_html__( 'Widget', 'raindrops' ) . '</a></li>';
        $raindrops_navigation_list .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">' . esc_html__( 'Menus', 'raindrops' ) . '</a></li>';
        $raindrops_navigation_list .= '<li><a href="' . admin_url( 'theme-editor.php' ) . '">' . esc_html__( 'Theme Editor', 'raindrops' ) . '</a></li>';
        $raindrops_navigation_list .= '</ul>';

        if ( true == RAINDROPS_USE_AUTO_COLOR ) {

            $raindrops_navigation_list .= '<h3 class="raindrops-navigation-title">' . __( 'Raindrops Extend Theme Options', 'raindrops' ) . '</h3><ul id="raindrops_navigation_list" class="raindrops-options-menu">';
        } else {

            $raindrops_navigation_list = '<div class="raindrops-navigation-wrapper">';
        }

        $raindrops_navigation_add = '';
        unset( $results[ '_raindrops_indv_css' ] );
        unset( $results[ 'install' ] );

        $lines .= "<form action=\"$deliv\" method=\"post\">" . wp_nonce_field( 'update-options' );

        foreach ( $results as $key => $val ) {

            $add_box = '';

            if ( true == RAINDROPS_USE_AUTO_COLOR ) {

                $raindrops_navigation_list .= '<li><a href="#' . str_replace( "_", "-", $key ) . '">' . raindrops_admin_meta( $key, 'title' ) . '</a></li>';
                if ( 'raindrops_base_color' == $key ) {

                    $raindrops_navigation_add = '<ul style="padding:0 30px;"><li><a href="#raindrops-style-type">' . __( 'go to Color Type', 'raindrops' ) . '</a></li></ul>';
                } elseif ( 'raindrops_header_image' == $key || 'raindrops_footer_image' == $key ) {

                    $raindrops_navigation_add = '<ul style="padding:0 30px;"><li><a href="#raindrops_upload_form">' . __( 'Go to upload form', 'raindrops' ) . '</a></li></ul>';
                } elseif ( 'raindrops_style_type' == $key ) {

                    $raindrops_navigation_add = '<ul style="padding:0 30px;"><li><a href="#raindrops-base-color">' . __( 'Go to Base Color', 'raindrops' ) . '</a></li></ul>';
                } else {

                    $raindrops_navigation_add = '';
                }
            }

            $excerpt = "";
            $table   = sprintf( $this->table_template, str_replace( "_", "-", $key ) );
            $excerpt = sprintf( $this->title_template, str_replace( "_", "-", $key ), str_replace( "_", " ", $key ), raindrops_admin_meta( $key, 'title' ) );
            $excerpt .= sprintf( $this->excerpt_template, raindrops_admin_meta( $key, 'excerpt2' ) );

            if ( !empty( $excerpt ) ) {

                $excerpt = '<div class="postbox" style="margin:1em;color:#339999">' . $excerpt;
            } else {

                $excerpt = "";
            }

            if ( preg_match( "!([0-9a-f]{6}|[0-9a-f]{3})!si", $val ) ) {

                $style = "background:" . $val . ';';
            } else {

                $style = "";
            }

            if ( preg_match( "!\.(png|gif|jpeg|jpg)$!i", $val ) && $key !== "raindrops_footer_image" && $key !== "raindrops_header_image" ) {

                if ( file_exists( get_stylesheet_directory() . "/images/" . $val ) ) {

                    $style .="background:url(" . get_stylesheet_directory_uri() . "/images/" . $val . ');';
                } else {

                    $style .="background:url(" . get_template_directory_uri() . "/images/" . $val . ');';
                }
            } else {

                $style .='';
            }

            if ( empty( $style ) ) {

                $style .='visibility:hidden';
                $table_header = '<thead><tr><th>&nbsp;</th><th>' . __( "Value", 'raindrops' ) . '</th><th>' . __( "Edit", 'raindrops' ) . '</th><th style="width:6em;">&nbsp;</th></tr></thead>';
            } else {

                $table_header = '<thead><tr><th >' . __( "Color", 'raindrops' ) . '</th><th>' . __( "Value", 'raindrops' ) . '</th><th>' . __( "Edit", 'raindrops' ) . '</th><th style="width:6em;">&nbsp;</th></tr></thead>';
            }

            if ( false == RAINDROPS_USE_AUTO_COLOR && ( "raindrops_footer_color" == $key or
                    "raindrops_default_fonts_color" == $key or
                    "raindrops_base_color" == $key or
                    "raindrops_header_image" == $key or
                    "raindrops_footer_image" == $key or
                    "raindrops_heading_image_position" == $key or
                    "raindrops_heading_image" == $key or
                    "raindrops_style_type" == $key or
                    "raindrops_hyperlink_color" == $key or
                    "raindrops_color_scheme" == $key ) ) {
                continue;
            }

            $lines .= $excerpt;
            $lines .= $table;
            $lines .= $table_header;
            $lines .= '<tbody>';
            $lines .= '<tr>';
            $lines .= '<td style="display:none;">';
            $lines .= '<input type="text" name="option_id" value="' . $i . '" />' . $i . '</td>';
//background setting

            if ( "raindrops_heading_image_position" == $key ) {

                if ( file_exists( get_stylesheet_directory() . '/images/' . $current_heading_image ) ) {

                    $lines .= '<td style="background:url( ' . get_stylesheet_directory_uri() . '/images/' . $current_heading_image . ' );"><img src="' . get_stylesheet_directory_uri() . '/images/number.png" />';
                } elseif ( file_exists( get_template_directory() . '/images/' . $current_heading_image ) ) {

                    $lines .= '<td style="background:url( ' . get_template_directory_uri() . '/images/' . $current_heading_image . ' );"><img src="' . get_template_directory_uri() . '/images/number.png" />';
                } else {
					$lines .= '<td><img src="' . get_template_directory_uri() . '/images/number.png" />';
				}
            } elseif ( $key == "raindrops_header_image" ) {

                $uploads          = wp_upload_dir();
                $header_image_uri = $uploads[ 'url' ] . '/' . raindrops_warehouse( 'raindrops_header_image' );
                $lines .= '<td colspan="4" style="height:150px;' . raindrops_upload_image_parser( $header_image_uri, 'inline', '#hd' ) . '"></td></tr><tr><td>&nbsp;</td>';
            } elseif ( $key == "raindrops_footer_image" ) {

                $uploads          = wp_upload_dir();
                $footer_image_uri = $uploads[ 'url' ] . '/' . raindrops_warehouse( 'raindrops_footer_image' );
                $lines .= '<td colspan="4" style="height:150px;' . raindrops_upload_image_parser( $footer_image_uri, 'inline', '#ft' ) . '" ></td></tr><tr><td>&nbsp;</td>';
            } else {

                $lines .= '<td style="' . $style . '">';
            }

            $lines .= '<input type="hidden" name="option_name" value="' . esc_attr( $key ) . '" read-only="read-only" /></td>';
            $lines .= '<td>' . esc_html( $val ) . '</td>';

            if ( $key == "raindrops_hyperlink_color" ||
                    $key == "raindrops_base_color" ||
                    $key == "raindrops_footer_color" ||
                    $key == "raindrops_default_fonts_color" ) {

                $lines .= "<td>" . $this->raindrops_color_selector( $key, esc_attr( $val ), $i ) . "</td>";
            } elseif ( $key == "raindrops_col_width" ) {

                $lines .= '<td>';
                $lines .= sprintf( $this->line_select_element, $this->accesskey[ $i ], 'raindrops_option_values[' . $key . ']', 6, 120 );

                foreach ( $this->col_settings_raindrops_col_width as $key => $current ) {

                    $lines .= '<option value="' . esc_attr( $current ) . '" ' . selected( strcmp( $val, $current ), 0, false ) . '>' . esc_html( $key ) . '</option>';
                }

                $lines .='</select></td>';
            } elseif ( $key == "raindrops_page_width" ) {

                $lines .= '<td>';
                $lines .= sprintf( $this->line_select_element, esc_attr( $this->accesskey[ $i ] ), 'raindrops_option_values[' . $key . ']', 4, 80 );

                foreach ( $this->col_settings_raindrops_page_width as $key => $current ) {

                    $lines .= '<option value="' . esc_attr( $current ) . '" ' . selected( strcmp( $val, $current ), 0, false ) . '>' . esc_html( $key ) . '</option>';
                }
                $lines .='</select></td>';
            } elseif ( $key == "raindrops_show_right_sidebar" ) {

                $lines .= '<td>';
                $lines .= sprintf( $this->line_select_element, esc_attr( $this->accesskey[ $i ] ), 'raindrops_option_values[' . $key . ']', 2, 40 );

                foreach ( $this->col_settings_raindrops_show_right_sidebar as $key => $current ) {

                    $lines .= '<option value="' . esc_attr( $current ) . '" ' . selected( strcmp( $val, $current ), 0, false ) . '>' . esc_html( $key ) . '</option>';
                }

                $lines .='</select></td>';
            } elseif ( $key == "raindrops_right_sidebar_width_percent" ) {

                $lines .= '<td>';
                $lines .= sprintf( $this->line_select_element, esc_attr( $this->accesskey[ $i ] ), 'raindrops_option_values[' . $key . ']', 5, 100 );

                foreach ( $this->col_settings_raindrops_right_sidebar_width_percent as $key => $current ) {

                    $lines .= '<option value="' . esc_attr( $current ) . '" ' . selected( strcmp( $val, $current ), 0, false ) . '>' . esc_html( $key ) . '</option>';
                }
                $lines .='</select></td>';
            } elseif ( $key == "raindrops_style_type" ) {

                $lines .= '<td>';
                $lines .= sprintf( $this->line_select_element, $this->accesskey[ $i ], 'raindrops_option_values[' . $key . ']', 3, 60 );

                foreach ( $this->col_settings_raindrops_style_type as $key => $current ) {

                    $lines .= '<option value="' . esc_attr( $current ) . '" ' . selected( strcmp( $val, $current ), 0, false ) . '>' . esc_html( $key ) . '</option>';
                }
                $lines .='</select></td>';
            } elseif ( $key == "raindrops_heading_image" ) {

                $lines .= '<td style="height:225px">';
                $lines .= '<input accesskey="' . esc_attr( $this->accesskey[ $i ] ) . '" type="text" name="raindrops_option_values[' . $key . ']" value="' . esc_attr( $val ) . '"';
                $lines .= ' /></td>';
            } elseif ( $key == "raindrops_color_scheme" ) {

                $lines .= '<td>';
                $lines .= sprintf( $this->line_select_element, $this->accesskey[ $i ], 'raindrops_option_values[' . $key . ']', 3, 60 );

                foreach ( $this->col_settings_raindrops_color_scheme as $key => $current ) {

                    $lines .= '<option value="' . esc_attr( $current ) . '" ' . selected( strcmp( $val, $current ), 0, false ) . '>' . esc_html( $key ) . '</option>';
                }
            } else {

                $lines .= '<td>';
				if ( isset( $this->accesskey[ $i ] ) ) {
					$lines .= '<input accesskey="' . esc_attr( $this->accesskey[ $i ] ) . '" type="text" name="raindrops_option_values[' . $key . ']" value="' . esc_attr( $val ) . '"';
				} else {
					$lines .= '<input type="text" name="raindrops_option_values[' . $key . ']" value="' . esc_attr( $val ) . '"';
				}
				$lines .= ' /></td>';
            }

            $i++;
            $lines .= "<td style=\"vertical-align:bottom;text-align:right;\"><input type=\"submit\" class=\"button-primary\" value=\"" . esc_attr__( 'Save', 'raindrops' ) . '" /></td>';
            $lines .= '</tr>';
            $send_key_name = "";
            $lines .= "</tbody></table><br />{$add_box}{$raindrops_navigation_add}</div>";
        } // foreach ( $results as $key => $val )

        $lines .= "<div style=\"margin:0 50px;\"><input type=\"submit\" class=\"button-primary\" value=\"" . esc_attr( 'Save Changes' ) . '" />&nbsp;&nbsp;&nbsp;';
        $lines .= "<input type=\"submit\" name=\"reset\" class=\"button-primary\" value=\"" . esc_attr( 'Reset All Settings' ) . '" /></form><br style="clear:both;</div>"';
        $lines .= "</div>";

        if ( !preg_match( '|<tbody>|', $lines ) ) {

            $lines .= "<tbody><tr><td colspan=\"4\">" . __( "Please reload this page ex. windows F5", 'raindrops' ) . '</td></tr></tbody>';
        }

        $lines .= raindrops_upload_form();

        if ( is_child_theme() ) {

            $raindrops_theme_name = 'Child theme ' . ucwords( wp_get_theme() ) . ' of ' . __( "Raindrops Theme", 'raindrops' );
        } else {

            $raindrops_theme_name = esc_html__( "Raindrops Theme", 'raindrops' );
        }

        if ( true == RAINDROPS_USE_AUTO_COLOR ) {

            $add_infomation = sprintf( '<div class="raindrops-option-footer-infomation"><a href="%s">%s</a></div>', $raindrops_current_data_theme_uri, $raindrops_theme_name );
        } else {

            $add_infomation = sprintf( '<div class="raindrops-option-footer-infomation"><a href="%s">%s</a>%s</div>', $raindrops_current_data_theme_uri, $raindrops_theme_name, '&nbsp;&nbsp;<span class="raindrops-use-auto-color-disable">' . __( "Now constant RAINDROPS_USE_AUTO_COLOR is false", 'raindrops' ) . '</span>' );
        }
        return apply_filters( 'raindrops_form_user_input',  $raindrops_navigation_list . '</ul>' . $add_infomation . '</div>' . $lines . '<br style="clear:both" />' );
    }

    /**
     *
     *
     *
     *
     *
     */
    function raindrops_color_selector( $name, $current_val, $i ) {

        global $raindrops_color_ja, $raindrops_color_en_140, $raindrops_color_en, $raindrops_color_anime;

        $result = sprintf( $this->line_select_element, $this->accesskey[ $i ], 'raindrops_option_values[' . $name . ']', 4, 100 );
        $scheme = raindrops_warehouse( "raindrops_color_scheme" );
        $scheme = $$scheme;

        //1.122
        if ( isset( $scheme ) && is_array( $scheme ) ) {

            $current_color = array_search( $current_val, $scheme );

            $result .= '<option value="' . $current_val . '" style="background:' . $current_val . '" ' . selected( 1, 1, false ) . '>' . $current_color . '</option>';

            foreach ( $scheme as $key => $val ) {

                $cr = hexdec( substr( $val, 1, 2 ) ) * 0.5;
                $cg = hexdec( substr( $val, 3, 2 ) ) * 0.5;
                $cb = hexdec( substr( $val, 5, 2 ) ) * 0.5;

                if ( $cr + $cg + $cb < 128 && !empty( $val ) ) {

                    $color = "#ccc";
                } else {

                    if ( $cr > $cg && $cg > $cb ) {

                        $color = "#" . dechex( $cb ) . dechex( $cg ) . dechex( $cr );
                    } elseif ( $cr > $cb && $cb > $cg ) {

                        $color = "#" . dechex( $cg ) . dechex( $cb ) . dechex( $cr );
                    } elseif ( $cg > $cr && $cr > $cb ) {

                        $color = "#" . dechex( $cb ) . dechex( $cg ) . dechex( $cg );
                    } elseif ( $cg > $cb && $cb > $cr ) {

                        $color = "#" . dechex( $cr ) . dechex( $cb ) . dechex( $cg );
                    } elseif ( $cb > $cg && $cg > $cr ) {

                        $color = "#" . dechex( $cr ) . dechex( $cg ) . dechex( $cb );
                    } elseif ( $cb > $cr && $cr > $cg ) {

                        $color = "#" . dechex( $cg ) . dechex( $cr ) . dechex( $cb );
                    } else {

                        $color = "#000";
                    }
                }

                $result .= '<option value="' . esc_attr( $val ) . '" style="background:' . esc_attr( $val ) . ';color:' . esc_attr( $color ) . '">' . esc_html( $key ) . '</option>';
            }
        } else {

            $result .= '<option disabled>' . esc_html( 'Not selectable', 'raindrops' ) . '</option>';
        }

        $result .='</select>';
        return $result;
    }

}

/**
 * Raindrops header footer image upload
 *
 *
 *
 *
 */
function raindrops_upload_form() {

    global $max_upload_size, $dirlist;
	$deliv = filter_input(INPUT_ENV,'REQUEST_URI');
   $result = '<div class="postbox raindrops" id="raindrops_upload_form">
			<h3 id="raindrops-style-type" title="raindrops style type">
			<div id="icon-upload" class="icon32"></div>
			<span>' .
            esc_html__( 'Image Upload', 'raindrops' ) .
            '</span></h3>
			<fieldset ><legend>' . esc_html__( 'Upload', 'raindrops' ) . '</legend>
			<form enctype="multipart/form-data" action="' . $deliv . '" method="POST">' . wp_nonce_field( 'update-options2' ) . '<p>
			<input name="uploadfile" type="file"></p><p>' .
            esc_html__( 'Purpose:', 'raindrops' ) . '<label>
			<input type="radio" name="purpose" value="header" checked="checked" />' .
            '<strong>' .
            esc_html__( 'Header Image', 'raindrops' ) .
            '</strong></label>
			&nbsp;&nbsp;&nbsp;<label><input type="radio" name="purpose" value="footer" />' .
            '<strong>' .
            esc_html__( 'Footer Image', 'raindrops' ) .
            '</strong></label></p><p>' .
            esc_html__( 'Style:', 'raindrops' ) . '<label>
			<input type="radio" name="style" value="norepeat" checked="checked" />' .
            esc_html__( 'no-repeat', 'raindrops' ) .
            '</label>&nbsp;&nbsp;&nbsp;<label>
			<input type="radio" name="style" value="repeatx" />' .
            esc_html__( 'repeat-x', 'raindrops' ) . '</label></p>
			<p>' . esc_html__( 'position:', 'raindrops' ) . '<label>' .
            esc_html__( 'top:', 'raindrops' ) . '<input type="text" name="position-top" value="0" style="text-align:right;" />' .
            esc_html__( 'px', 'raindrops' ) . '</label>&nbsp;&nbsp;&nbsp;' .
            esc_html__( 'left:', 'raindrops' ) .
            '<label><input type="text" name="position-left" value="0" style="text-align:right;" />' .
            esc_html__( 'px', 'raindrops' ) . '</label></p><p>' .
            esc_html__( 'box height:', 'raindrops' ) . '<label>
			<input type="text" name="height" value="0" style="text-align:right;" />' .
            esc_html__( 'px', 'raindrops' ) . '</label></p><p>
			<input type="submit" value="upload" name="raindrops_upload" class="button-primary"></p>
			</form>
			</fieldset>' .
            '<div class="raindrops_navigation_list">
			<ul>
			<li><a href="#raindrops-header-image">' .
            esc_html__( 'Go to current header image', 'raindrops' ) .
            '</a></li>
			<li><a href="#raindrops-footer-image">' .
            esc_html__( 'Go to current footer image', 'raindrops' ) .
            '</a></li></ul></div>' .
            '</div>';
    return $result;
}

/**
 * Raindrops upload image check and save
 *
 *
 *
 *
 */
function raindrops_upload_image( $raindrops_max_upload_size, $raindrops_max_width, $raindrops_allow_file_type ) {

    global $raindrops_max_upload_size, $raindrops_max_width, $raindrops_allow_file_type;
    $upload_info = wp_upload_dir();
    $propaty     = '';
    $width       = '';
    $height      = '';
    $type        = '';
    $attr        = '';

    if ( isset( $_POST[ 'raindrops_upload' ] ) ) {

        if ( !isset( $_REQUEST[ '_wpnonce' ] ) ) {

            $result = esc_html__( "Cannot be trusted data", 'raindrops' );
            return array( false, $result );
        } else {

            if ( !wp_verify_nonce( $_REQUEST[ '_wpnonce' ], 'update-options2' ) ) {
                $result = esc_html__( "Can not Upload Security issue", 'raindrops' );
                return array( false, $result );
            }
        }

        if ( isset( $_POST[ 'purpose' ] ) && ( 'header' == $_POST[ 'purpose' ] || 'footer' == $_POST[ 'purpose' ] ) ) {

            $save_dir = $upload_info[ 'path' ] . '/raindrops-item';
            $propaty  = $propaty . '-' . sanitize_key( $_POST[ 'purpose' ] );
        } else {

            $result = esc_html__( "purpose no data", 'raindrops' );
            return array( false, $result );
        }

        if ( isset( $_POST[ 'style' ] ) && ( 'norepeat' == $_POST[ 'style' ] || 'repeatx' == $_POST[ 'style' ] ) ) {

            $style   = $_POST[ 'style' ];
            $propaty = $propaty . '-style-' . sanitize_key( $_POST[ 'style' ] );
        } else {

            $result = esc_html__( "style no data", 'raindrops' );
            return array( false, $result );
        }

        if ( isset( $_POST[ 'position-top' ] ) && is_numeric( $_POST[ 'position-top' ] ) ) {

            $top     = $_POST[ 'position-top' ];
            $propaty = $propaty . '-top-' . sanitize_key( $_POST[ 'position-top' ] );
        } else {

            $result = esc_html__( "position top no data", 'raindrops' );
            return array( false, $result . 'c' );
        }

        if ( isset( $_POST[ 'position-left' ] ) && is_numeric( $_POST[ 'position-left' ] ) ) {

            $left    = $_POST[ 'position-left' ];
            $propaty = $propaty . '-left-' . sanitize_key( $_POST[ 'position-left' ] ) . '-';
        } else {

            $result = esc_html__( "position no data", 'raindrops' );
            return array( false, $result );
        }

        if ( isset( $_POST[ 'height' ] ) && is_numeric( $_POST[ 'height' ] ) ) {

            $height  = $_POST[ 'height' ];
            $propaty = $propaty . 'x-height-' . sanitize_key( $_POST[ 'height' ] ) . '-';
        } else {

            $result = esc_html__( "box height no data", 'raindrops' );
            return array( false, $result );
        }

        if ( $_FILES[ 'uploadfile' ][ 'size' ] > $raindrops_max_upload_size ) {

            $result = "file size over" . $_FILES[ 'uploadfile' ][ 'size' ] . 'upload-image-size' . $raindrops_max_upload_size;
            return array( false, $result );
        }

        if ( false == in_array( $_FILES[ 'uploadfile' ][ 'type' ], $raindrops_allow_file_type ) ) {

            $result = sprintf( esc_html__( '%s is not permitted filetype.', 'raindrops' ), $_FILES[ 'uploadfile' ][ 'type' ] ) . implode( ',', $raindrops_allow_file_type );
            return array( false, $result );
        }

        if ( !function_exists( 'wp_handle_upload' ) ) {

            $result = sprintf( esc_html__( '%s function is not exists', 'raindrops' ), 'wp_handle_upload' );
            return array( false, $result );
        }

        $uploadedfile     = $_FILES[ 'uploadfile' ];
        $upload_overrides = array( 'test_form' => false, );

        function raindrops_theme_upload_filename( $filename ) {

            $info    = pathinfo( $filename );
            $ext     = empty( $info[ 'extension' ] ) ? '' : '.' . $info[ 'extension' ];
            $name    = basename( $filename, $ext );
            $propaty = 'raindrops-item';

            if ( isset( $_POST[ 'purpose' ] ) && ( 'header' == $_POST[ 'purpose' ] || 'footer' == $_POST[ 'purpose' ] ) ) {

                $propaty = $propaty . '-' . sanitize_key( $_POST[ 'purpose' ] );
            }

            if ( isset( $_POST[ 'style' ] ) && ( 'norepeat' == $_POST[ 'style' ] || 'repeatx' == $_POST[ 'style' ] ) ) {

                $style   = $_POST[ 'style' ];
                $propaty = $propaty . '-style-' . sanitize_key( $_POST[ 'style' ] );
            }

            if ( isset( $_POST[ 'position-top' ] ) && is_numeric( $_POST[ 'position-top' ] ) ) {

                $top     = $_POST[ 'position-top' ];
                $propaty = $propaty . '-top-' . sanitize_key( $_POST[ 'position-top' ] );
            }

            if ( isset( $_POST[ 'position-left' ] ) && is_numeric( $_POST[ 'position-left' ] ) ) {

                $left    = $_POST[ 'position-left' ];
                $propaty = $propaty . '-left-' . sanitize_key( $_POST[ 'position-left' ] ) . '-';
            }

            if ( isset( $_POST[ 'height' ] ) && is_numeric( $_POST[ 'height' ] ) ) {

                $height  = $_POST[ 'height' ];
                $propaty = $propaty . 'x-height-' . sanitize_key( $_POST[ 'height' ] ) . '-';
            }

            return $propaty . $name . $ext;
        }

        add_filter( 'sanitize_file_name', 'raindrops_theme_upload_filename', 10 );


        if ( ( $test = wp_handle_upload( $uploadedfile, $upload_overrides ) ) ) {

            if ( isset( $test[ 'error' ] ) ) {

                $result = $test[ 'error' ];
                return array( false, $result );
            }

            if ( file_exists( $save_dir . $_FILES[ 'uploadfile' ][ 'name' ] ) ) {

                chmod( $save_dir . $_FILES[ 'uploadfile' ][ 'name' ], 0644 );
                list( $width, $height, $type, $attr ) = getimagesize( $save_dir . $_FILES[ 'uploadfile' ][ 'name' ] );

                if ( $raindrops_max_width < $width || $height > $raindrops_max_width * 1.5 ) {

                    unlink( $save_dir . $_FILES[ 'uploadfile' ][ 'name' ] );
                    $result = sprintf( esc_html__( "%d px * %d width too big. limit %d px", 'raindrops' ), $width, $height, $raindrops_max_width );
                    return array( false, $result . 'g' );
                }
            }

            $uploaded_url = $upload_info[ 'url' ] . '/raindrops-item' . $propaty . $_FILES[ 'uploadfile' ][ 'name' ];
            $new_settings = get_option( 'raindrops_theme_settings' );

            if ( 'header' == $_POST[ 'purpose' ] ) {

                $new_settings[ 'raindrops_header_image' ] = 'raindrops-item' . $propaty . $_FILES[ 'uploadfile' ][ 'name' ];
            } elseif ( 'footer' == $_POST[ 'purpose' ] ) {

                $new_settings[ 'raindrops_footer_image' ] = 'raindrops-item' . $propaty . $_FILES[ 'uploadfile' ][ 'name' ];
            }

            update_option( 'raindrops_theme_settings', $new_settings );
            return array( true, 'success', $uploaded_url, $width, $height, true );
        } else {

            $result = esc_html__( "It failed in up-loading.", 'raindrops' );

            foreach ( $_FILES[ 'userfile' ][ 'error' ] as $error ) {

                $result .= $error;
            }
            return array( false, $result );
        }
    }
}
