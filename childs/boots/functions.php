<?php
/**
 *  Custom Header for boots Theme
 *
 *
 *
 */
if ( !isset( $boots_custom_header_args ) ) {
    $boots_custom_header_args = array(
        'default-text-color'     => 'ffffff'
        , 'width'                  => apply_filters( 'raindrops_header_image_width', '1600' )
        , 'flex-width'             => true
        , 'height'                 => apply_filters( 'raindrops_header_image_height', '160' )
        , 'flex-height'            => true
        , 'header-text'            => false
        , 'default-image'          => get_stylesheet_directory_uri() . '/images/headers/wp3.jpg'
        , 'wp-head-callback'       => apply_filters( 'raindrops_wp-head-callback', 'raindrops_embed_meta' )
        , 'admin-preview-callback' => 'raindrops_admin_header_image'
        , 'admin-head-callback'    => 'raindrops_admin_header_style'
    );

    add_theme_support( 'custom-header', $boots_custom_header_args );
}


/**
 * Setup Broad
 *
 */
if ( !function_exists( 'raindrops_child_init' ) ) {
    add_action( 'after_setup_theme', 'raindrops_child_init' );

    function raindrops_child_init() {
        /* Insert Site Title and Description to Header Image */
        add_filter( 'raindrops_header_image_contents', 'boots_custom_header_image_content' );
        /* broad color type setting */
        add_action( 'raindrops_include_after', 'boots_extend_styles' );

    }

}
/**
 *
 *
 *
 */
 
/*
if ( !function_exists( 'boots_extend_styles' ) ) {

    function boots_extend_styles() {
        $boots_child_theme_name = wp_get_theme()->get('Name');
        raindrops_register_styles(  $boots_child_theme_name );
    }

}
*/
/**
 *
 * @return string style rules
 */
/*
if ( !function_exists( 'raindrops_indv_css_'. $boots_child_theme_name ) ) {

    function raindrops_indv_css_broad() {

        $css = raindrops_gallerys_clone();
        // Color base style
        if ( function_exists( 'raindrops_indv_css_minimal' ) ) {

            $css .= raindrops_indv_css_minimal();
        }
        return $css;
    }

}
*/
/**
 *
 * @param type $content
 * @return type
 */
if ( !function_exists( 'boots_custom_header_image_content' ) ) {

    function boots_custom_header_image_content( $content ) {

        $html = '<div class="tagline-wrapper"><div id="header-inner" style="%6$s">'
                . '<div class="skip-link screen-reader-text" %1$s><a href="#container" title="%2$s">%3$s</a></div>'
                . '%4$s%5$s'
                . '</div></div>';

        $page_width = boots_page_width();

        return sprintf( $html, raindrops_doctype_elements( '', 'role="banner"', false ), esc_attr( 'Skip to content', 'Raindrops' ), esc_html__( 'Skip to content', 'Raindrops' ), raindrops_site_title(), '<div class="description">' . get_bloginfo( 'description' ) . '</div>', 'max-width:1280px;display:block;margin:auto; width:' . $page_width . ';'
        );
    }

}

/**
 * Page width for style
 * @return string
 *
 */
if ( !function_exists( 'boots_page_width' ) ) {

    function boots_page_width() {

        $id = raindrops_warehouse_clone( 'raindrops_page_width' );

        switch ( $id ) {
            case('doc'):
                return '750px';
                break;
            case('doc2'):
                return '950px';
                break;
            case('doc4'):
                return '974px';
                break;
            default:
                return '100%';
                break;
        }
    }

}

if ( !function_exists( 'boots_link_change' ) ) {
    add_filter( 'raindrops_nav_menu_primary_html', 'broad_hash_link_change' );

    function broad_hash_link_change( $html ) {

        return str_replace( 'href="#doc3"', 'href="#"', $html );
    }

}
   
    