<?php
/**
 * Child Theme config file
 *
 *
 */
if ( !function_exists( 'raindrops_child_customizer_relate' ) ) {
    add_filter( 'raindrops_embed_meta_echo', 'raindrops_child_customizer_relate' );

    function raindrops_child_customizer_relate( $content ) {

        $style_type = raindrops_warehouse_clone( "raindrops_style_type" );
        $theme_name = wp_get_theme()->get( 'Name' );
        if ( $style_type == $theme_name ) {
            return raindrops_child_live_change_customizer();
        } else {
            return $content;
        }
    }

}

/**
 *
 * @return type
 *
 *
 */
if ( !function_exists( 'raindrops_child_live_change_customizer' ) ) {

    function raindrops_child_live_change_customizer() {

        global $post, $raindrops_current_theme_name, $raindrops_base_font_size;
        $result                    = '';
        $css                       = '';
        $result_indv               = '';
        $raindrops_base_color      = raindrops_warehouse_clone( 'raindrops_base_color' );
        $raindrops_style_type      = raindrops_warehouse_clone( "raindrops_style_type" );
        // $css .= raindrops_design_output( $raindrops_style_type ) /* . raindrops_color_base() */;
        //when this code exists [raindrops color_type="minimal" col="1"] in the post
        $raindrops_hyperlink_color = raindrops_warehouse_clone( 'raindrops_hyperlink_color' );
        $raindrops_indv_css        = raindrops_design_output( $raindrops_style_type ) . raindrops_color_base( $raindrops_base_color, array( 'color' => 'rd-type-boots .color', 'face' => 'rd-type-boots .face' ) );
        $raindrops_indv_css        = raindrops_color_type_custom( $raindrops_indv_css );




        $raindrops_fluid_maximum_width = raindrops_warehouse_clone( 'raindrops_fluid_max_width' );

        $css .= "\n.rd-type-boots #access .menu-header,.rd-type-boots #access .menu,";
        $css .= "\nbody #doc3{max-width:" . $raindrops_fluid_maximum_width . 'px;}';

        $css .= apply_filters( "raindrops_indv_css", $raindrops_indv_css );

        if ( $raindrops_hyperlink_color !== '' ) {

            $css .= raindrops_custom_link_color( $raindrops_hyperlink_color );
        }
        $background = get_background_image();
        $color      = get_background_color();

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


        $raindrops_text_color = get_theme_mod( 'header_textcolor', 'ffffff' );
        $header_image         = get_header_image();

        if ( $raindrops_text_color !== 'blank' && !empty( $header_image ) ) {

            $css .= " \n#site-title a,#site-title span{color:#" . $raindrops_text_color . ';}';
            $css .= " \n.description{color:#" . $raindrops_text_color . ';}';
        }
        $raindrops_options         = get_option( 'raindrops_theme_settings' );
        $raindrops_hyperlink_color = raindrops_warehouse_clone( 'raindrops_hyperlink_color' );

        if ( $raindrops_hyperlink_color !== '' ) {
            $css .= "#bd a{color:" . $raindrops_hyperlink_color . "!important;}";
        }

        $raindrops_fonts_color = raindrops_warehouse_clone( 'raindrops_default_fonts_color' );

        if ( $raindrops_fonts_color !== '' ) {
            $css .= "article {color:" . $raindrops_fonts_color . "!important;}";
        }

        $raindrops_fonts_color = raindrops_warehouse_clone( 'raindrops_footer_color' );

        if ( $raindrops_fonts_color !== '' ) {
            $css .= "#ft {color:" . $raindrops_fonts_color . "!important;}";
        }

        $raindrops_footer_link_color = raindrops_warehouse_clone( 'raindrops_footer_link_color' );

        if ( !empty( $raindrops_footer_link_color ) ) {
            $css .= "#ft a{color:" . $raindrops_footer_link_color . "!important;}";
        }



        $background = get_background_image();
        $color      = get_background_color();

        if ( !empty( $background ) || !empty( $color ) ) {

            $css .= preg_replace( "|body[^{]*{[^}]+}|", "", $css );
        }

        //body background
        $body_background            = get_theme_mod( "background_color" );
        $body_background_image      = get_theme_mod( "background_image" );
        $body_background_repeat     = get_theme_mod( "background_repeat" );
        $body_background_position_x = get_theme_mod( "background_position_x" );
        $body_background_attachment = get_theme_mod( "background_attachment" );

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
        if ( function_exists( 'raindrops_gradient_clone' ) ) {

            $css .= raindrops_gradient_clone( '.rd-type-boots #yui-main .entry-content' );
        }
        if ( function_exists( 'raindrops_color_base_clone' ) ) {

            // $css .= raindrops_color_base_clone( $raindrops_base_color );
        }

        if ( is_single() || is_page() ) {


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

            $result .= '<style type="text/css">';
            $result .= "\n<!--/*<! [CDATA[*/\n";

            if ( true == RAINDROPS_OVERRIDE_POST_STYLE_ALL_CONTENTS ) {

                if ( have_posts() ) {

                    if ( false == RAINDROPS_USE_AUTO_COLOR ) {
                        
                    }
                    $result .= "\n/*start custom fields style for loop pages*/\n";
                    while ( have_posts() ) {
                        the_post();
                        $collections = get_post_meta( $post->ID, 'css', true );
                        $collections .= get_post_meta( $post->ID, '_css', true );
                        $result_indv .= preg_replace_callback( '![^}]+{[^}]+}!siu', 'raindrops_css_add_id', $collections );
                    }
                    rewind_posts();
                }
            }

            if ( WP_DEBUG !== true ) {

                $result_indv = str_replace( array( "\n", "\r", "\t", '&quot;', '--', '\"' ), array( "", "", "", '"', '', '"' ), $result_indv );
            }
            $result .= $result_indv;
            $result .= "\n/*end custom fields style for loop pages*/\n";
            $result .= "\n/*]]>*/-->\n";
            $result .= "</style>";
        }

        return '<style type="text/css">' . $css . '</style>' . $result;
    }

}

/**
 * Add Broad Screenshot at Customizer
 *
 *
 */
if ( !function_exists( 'raindrops_customize_controls_print_styles' ) ) {

    function raindrops_customize_controls_print_styles() {
        ?>
        <style type="text/css">

            #customize-control-raindrops_style_type .customize-control-title + label{

                background:url( <?php echo get_template_directory_uri() . '/images/screen-shot-dark.png'; ?> );
                height:200px;
                display:block;
                background-position:0px 40px;
                background-repeat:no-repeat;
                background-size:cover;
            }
            #customize-control-raindrops_style_type .customize-control-title  + label + label{

                background:url( <?php echo get_template_directory_uri() . '/images/screen-shot-w3standard.png'; ?> );
                height:200px;
                display:block;
                background-position:0px 40px;
                background-repeat:no-repeat;
                background-size:cover;
            }
            #customize-control-raindrops_style_type .customize-control-title  + label +label + label{

                background:url( <?php echo get_template_directory_uri() . '/images/screen-shot-light.png'; ?> );
                height:200px;
                display:block;
                background-position:0px 40px;
                background-repeat:no-repeat;
                background-size:cover;
            }
            #customize-control-raindrops_style_type .customize-control-title  + label +label + label + label{

                background:url( <?php echo get_template_directory_uri() . '/images/screen-shot-minimal.png'; ?> );
                height:200px;
                display:block;
                background-position:0px 40px;
                background-repeat:no-repeat;
                background-size:cover;
            }
            #customize-control-raindrops_style_type .customize-control-title  + label +label + label + label + label{

                background:url( <?php echo get_stylesheet_directory_uri() . '/screenshot.png'; ?> );
                height:180px;
                display:block;
                background-position:0px 40px;
                background-repeat:no-repeat;
                background-size:cover;
            }
        </style>
        <?php
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

        delete_option( "raindrops_theme_settings" );
    }

}
/**
 * Overwrite Parent Theme Settings
 */
if ( !isset( $raindrops_child_base_setting_args ) ) {
    $raindrops_child_base_setting_args = array(
        array( 'option_id'    => 1,
            'blog_id'      => 0,
            'option_name'  => "raindrops_color_scheme",
            'option_value' => "raindrops_color_ja",
            'autoload'     => 'yes',
            'title'        => esc_html__( 'Color Scheme', 'Raindrops' ),
            'excerpt1'     => '',
            'excerpt2'     => esc_html__( 'Please choose the naming convention for the color list', 'Raindrops' ),
            'validate'     => 'raindrops_color_scheme_validate', 'list'         => 12 ),
        array( 'option_id'    => 2,
            'blog_id'      => 0,
            'option_name'  => "raindrops_base_color",
            'option_value' => "#444444",
            'autoload'     => 'yes',
            'title'        => esc_html__( 'Base Color for Automatic Color Arrangement', 'Raindrops' ),
            'excerpt1'     => '',
            'excerpt2'     => esc_html__( 'Please specify your favorite color. and an automatic arrangement of color is designed.', 'Raindrops' ),
            'validate'     => 'raindrops_base_color_validate',
            'list'         => 1 ),
        array( 'option_id'    => 3,
            'blog_id'      => 0,
            'option_name'  => "raindrops_style_type",
            'option_value' => "boots",
            'autoload'     => 'yes',
            'title'        => esc_html__( 'Color Type', 'Raindrops' ),
            'excerpt1'     => '',
            'excerpt2'     => esc_html__( 'The mood like dark atmosphere and the bright note, etc. is decided. and The editor is displayed when themename is selected, and a present style can be edited in detail.', 'Raindrops' ),
            'validate'     => 'raindrops_style_type_validate',
            'list'         => 2,
        ),
        array( 'option_id'    => 4,
            'blog_id'      => 0,
            'option_name'  => "raindrops_header_image",
            'option_value' => "none",
            'autoload'     => 'yes',
            'title'        => esc_html__( 'Header background image', 'Raindrops' ),
            'excerpt1'     => '',
            'excerpt2'     => esc_html__( 'The header image can be set by two methods.
One is a method of up-loading the image from the below up-loading form. Another is a method of filling in the filename from this textfield from Raindrops/images something image.', 'Raindrops' ),
            'validate'     => 'raindrops_header_image_validate',
            'list'         => 3,
        ),
        array( 'option_id'    => 5,
            'blog_id'      => 0,
            'option_name'  => "raindrops_footer_image",
            'option_value' => "none",
            'autoload'     => 'yes',
            'title'        => esc_html__( 'Footer background image', 'Raindrops' ),
            'excerpt1'     => '',
            'excerpt2'     => esc_html__( 'The footer image can be set by two methods.
One is a method of up-loading the image from the below up-loading form. Another is a method of filling in the filename from this textfield from Raindrops/images something image.', 'Raindrops' ),
            'validate'     => 'raindrops_footer_image_validate', 'list'         => 4 ),
        array( 'option_id'    => 6,
            'blog_id'      => 0,
            'option_name'  => "raindrops_heading_image",
            'option_value' => "none",
            'autoload'     => 'yes',
            'title'        => esc_html__( 'Widget Title Background Image', 'Raindrops' ),
            'excerpt1'     => '',
            'excerpt2'     => esc_html__( 'The header image can be chosen from among three kinds [h2.png,h2b.png,h2c.png].', 'Raindrops' ),
            'validate'     => 'raindrops_heading_image_validate', 'list'         => 5 ),
        array( 'option_id'    => 7,
            'blog_id'      => 0,
            'option_name'  => "raindrops_heading_image_position",
            'option_value' => "0",
            'autoload'     => 'yes',
            'title'        => esc_html__( 'Widget Title Background Image Position', 'Raindrops' ),
            'excerpt1'     => '',
            'excerpt2'     => esc_html__( 'The name of the picture file used for the h2 headding is set. Please set the integral value from 0 to 7. ', 'Raindrops' ),
            'validate'     => 'raindrops_heading_image_position_validate', 'list'         => 6 ),
        array( 'option_id'    => 8,
            'blog_id'      => 0,
            'option_name'  => "raindrops_page_width",
            'option_value' => "doc3",
            'autoload'     => 'yes',
            'title'        => __( 'Page Width', 'Raindrops' ),
            'excerpt1'     => '',
            'excerpt2'     => esc_html__( 'Please choose width on the page.', 'Raindrops' ) .
            esc_html__( 'Please choose from four kinds of inside of', 'Raindrops' ) .
            esc_html__( '750px centerd 950px centerd fluid 974px.', 'Raindrops' ),
            'validate'     => 'raindrops_page_width_validate', 'list'         => 7 ),
        array( 'option_id'    => 9,
            'blog_id'      => 0,
            'option_name'  => "raindrops_col_width",
            'option_value' => "t2",
            'autoload'     => 'yes',
            'title'        => esc_html__( 'Column Width and Position', 'Raindrops' ),
            'excerpt1'     => '',
            'excerpt2'     => esc_html__( 'Please specify the position and the width of Default Sidebar. Six kinds of sidebars of left 160px left 180px left 300px right 180px right 240px right 300px can be specified.', 'Raindrops' ),
            'validate'     => 'raindrops_col_width_validate', 'list'         => 8 ),
        array( 'option_id'    => 10,
            'blog_id'      => 0,
            'option_name'  => "raindrops_default_fonts_color",
            'option_value' => "",
            'autoload'     => 'yes',
            'title'        => esc_html__( 'Text color in content ', 'Raindrops' ),
            'excerpt1'     => '',
            'excerpt2'     => esc_html__( 'If you need to set contents Special font color.', 'Raindrops' ),
            'validate'     => 'raindrops_default_fonts_color_validate', 'list'         => 9 ),
        array( 'option_id'    => 11,
            'blog_id'      => 0,
            'option_name'  => "raindrops_footer_color",
            'option_value' => "",
            'autoload'     => 'yes',
            'title'        => esc_html__( 'Text color in footer ', 'Raindrops' ),
            'excerpt1'     => '',
            'excerpt2'     => esc_html__( 'If you need to set footer Special font color.', 'Raindrops' ),
            'validate'     => 'raindrops_footer_color_validate', 'list'         => 10 ),
        array( 'option_id'    => 12,
            'blog_id'      => 0,
            'option_name'  => "raindrops_show_right_sidebar",
            'option_value' => "show",
            'autoload'     => 'yes',
            'title'        => esc_html__( 'Extra Sidebar', 'Raindrops' ),
            'excerpt1'     => '',
            'excerpt2'     => esc_html__( 'Please specify show when you want to use three row layout. Please set Ratio to text when extra sidebar is displayed when you specify show', 'Raindrops' ),
            'validate'     => 'raindrops_show_right_sidebar_validate', 'list'         => 11 ),
        array( 'option_id'    => 13,
            'blog_id'      => 0,
            'option_name'  => "raindrops_right_sidebar_width_percent",
            'option_value' => "25",
            'autoload'     => 'yes',
            'title'        => esc_html__( 'Extra Sidebar Width', 'Raindrops' ),
            'excerpt1'     => '',
            'excerpt2'     => esc_html__( 'When display extra sidebar is set to show', 'Raindrops' ) .
            esc_html__( 'it is necessary to specify it.', 'Raindrops' ) .
            esc_html__( 'It can decide to divide the width of which place of extra sidebar', 'Raindrops' ) .
            esc_html__( 'and to give it. Please select it from among 25% 33% 50% 66% 75%. ', 'Raindrops' ),
            'validate'     => 'raindrops_right_sidebar_width_percent_validate', 'list'         => 12 ),
        array( 'option_id'    => 14,
            'blog_id'      => 0,
            'option_name'  => "raindrops_show_menu_primary",
            'option_value' => "show",
            'autoload'     => 'yes',
            'title'        => esc_html__( 'Menu Primary', 'Raindrops' ),
            'excerpt1'     => '',
            'excerpt2'     => esc_html__( 'Display or not Menu Primary. default value is show. set hide when not display menu primary', 'Raindrops' ),
            'validate'     => 'raindrops_show_menu_primary_validate', 'list'         => 13 ),
        array( 'option_id'    => 15,
            'blog_id'      => 0,
            'option_name'  => "raindrops_hyperlink_color",
            'option_value' => "",
            'autoload'     => 'yes',
            'title'        => esc_html__( 'Link color', 'Raindrops' ),
            'excerpt1'     => '',
            'excerpt2'     => esc_html__( 'Hyper link color', 'Raindrops' ),
            'validate'     => 'raindrops_hyperlink_color_validate', 'list'         => 14 ),
        array( 'option_id'    => 16,
            'blog_id'      => 0,
            'option_name'  => "raindrops_accessibility_settings",
            'option_value' => "no",
            'autoload'     => 'yes',
            'title'        => esc_html__( 'Accessibility Settings', 'Raindrops' ),
            'excerpt1'     => '',
            'excerpt2'     => esc_html__( 'Accessibility Settings is create a unique link text. set to yes or no.', 'Raindrops' ),
            'validate'     => 'raindrops_accessibility_settings_validate', 'list'         => 15
        ),
        array( 'option_id'    => 17,
            'blog_id'      => 0,
            'option_name'  => "raindrops_doc_type_settings",
            'option_value' => "html5",
            'autoload'     => 'yes',
            'title'        => esc_html__( "Document Type Settings", 'Raindrops' ),
            'excerpt1'     => '',
            'excerpt2'     => esc_html__( "Default Document type html5. Set to xhtml or html5.", 'Raindrops' ),
            'validate'     => 'raindrops_doc_type_settings_validate', 'list'         => 16
        ),
        array( 'option_id'    => 18,
            'blog_id'      => 0,
            'option_name'  => "raindrops_basefont_settings",
            'option_value' => "13",
            'autoload'     => 'yes',
            'title'        => esc_html__( "Base Font Size Setting", 'Raindrops' ),
            'excerpt1'     => '',
            'excerpt2'     => esc_html__( "Base Font Size Value Recommend 13-20 (px size)", 'Raindrops' ),
            'validate'     => 'raindrops_basefont_settings_validate',
            'list'         => 17
        ),
        array( 'option_id'    => 19,
            'blog_id'      => 0,
            'option_name'  => "raindrops_fluid_max_width",
            'option_value' => "1280",
            'autoload'     => 'yes',
            'title'        => esc_html__( "Fluid ( Responsive ) Max Page Width", 'Raindrops' ),
            'excerpt1'     => '',
            'excerpt2'     => esc_html__( "Default 1280 (px size)", 'Raindrops' ),
            'validate'     => 'raindrops_fluid_max_width_validate',
            'list'         => 18
        ),
        array( 'option_id'    => 20,
            'blog_id'      => 0,
            'option_name'  => "raindrops_entry_content_is_home",
            'option_value' => "content",
            'autoload'     => 'yes',
            'title'        => esc_html__( "Home Entry Content Type", 'Raindrops' ),
            'excerpt1'     => '',
            'excerpt2'     => esc_html__( "value content, excerpt, none", 'Raindrops' ),
            'validate'     => 'raindrops_entry_content_is_home_validate',
            'list'         => 19
        ),
        array( 'option_id'    => 21,
            'blog_id'      => 0,
            'option_name'  => "raindrops_entry_content_is_category",
            'option_value' => "content",
            'autoload'     => 'yes',
            'title'        => esc_html__( "Category Archive Content Type", 'Raindrops' ),
            'excerpt1'     => '',
            'excerpt2'     => esc_html__( "value content, excerpt, none", 'Raindrops' ),
            'validate'     => 'raindrops_entry_content_is_category_validate',
            'list'         => 20
        ),
        array( 'option_id'    => 22,
            'blog_id'      => 0,
            'option_name'  => "raindrops_entry_content_is_search",
            'option_value' => "content",
            'autoload'     => 'yes',
            'title'        => esc_html__( "Search Result Content Type", 'Raindrops' ),
            'excerpt1'     => '',
            'excerpt2'     => esc_html__( "value content, excerpt, none", 'Raindrops' ),
            'validate'     => 'raindrops_entry_content_is_tag_validate',
            'list'         => 21
        ),
        array( 'option_id'    => 23,
            'blog_id'      => 0,
            'option_name'  => "raindrops_footer_link_color",
            'option_value' => "",
            'autoload'     => 'yes',
            'title'        => esc_html__( 'Link color in footer ', 'Raindrops' ),
            'excerpt1'     => '',
            'excerpt2'     => esc_html__( 'If you need to set footer Special link color.', 'Raindrops' ),
            'validate'     => 'raindrops_footer_link_color_validate',
            'list'         => 10
        ),
    );
}