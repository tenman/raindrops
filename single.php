<?php
/**
 * Template for single post.
 *
 *
 * @package Raindrops
 * @since Raindrops 0.306
 * @uses raindrops_show_one_colum   Detect current post column count
 * @uses add_filter                 Overwrite Color type func raindrops_color_type_custom( )
 * @uses get_header( $raindrops_document_type )       Include template part file
 * @uses have_posts( )
 * @uses the_post( )
 * @uses in_category( )
 * @uses get_the_post_thumbnail( )
 * @uses has_post_thumbnail( )
 * @uses wp_get_attachment_image_src( )
 * @uses esc_url( )
 * @uses round( )
 * @uses esc_attr( )
 * @uses image_hwstring( )
 * @uses switch( )
 * @uses get_template_part( )
 * @uses raindrops_column_controller( )
 * @uses next_posts_link( )
 * @uses previous_posts_link( )
 * @uses get_sidebar( )
 * @uses get_footer( $raindrops_document_type )
 * @uses get_attachment_link( )
 * @uses get_post_thumbnail_id( )
 * @uses raindrops_prepend_default_sidebar( )
 * @uses raindrops_append_default_sidebar( )
 *
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
$raindrops_home_url       = trailingslashit( home_url() );
$raindrops_current_column = raindrops_column_controller();


if ( $raindrops_current_column !== false ) {
    add_filter( "raindrops_theme_settings__raindrops_indv_css", "raindrops_color_type_custom" );
}

get_header( $raindrops_document_type );
do_action( 'raindrops_pre_' . basename( __FILE__ ) );

raindrops_debug_navitation( __FILE__ );
?>
<div id="yui-main" class="<?php raindrops_dinamic_class( 'yui-main',true ); ?>">
    <div class="<?php raindrops_dinamic_class( 'yui-b',true ); ?>">
        <div class="<?php echo raindrops_yui_class_modify(); ?>" id="container">
            <div class="<?php raindrops_dinamic_class( 'yui-u first', true ); ?>" <?php raindrops_doctype_elements( '', 'role="main"' ); ?>>
                <?php
                /**
                 * Display navigation to next/previous pages when applicable
                 */
                if ( have_posts() ) {
                    /**
                     * when Single page
                     */
                    while ( have_posts() ) {

                        the_post();

                        $format = get_post_format();

                        $cat = "default";

                        if ( in_category( "blog" ) || has_post_format( "status" ) ) {

                            $cat = "blog";
                        } elseif ( in_category( "gallery" ) || has_post_format( "gallery" ) ) {

                            $cat = "gallery";
                        } elseif ( $format !== false ) {

                            $cat = $format;
                        }

                        if ( true == WP_DEBUG ) {

                            echo '<!--Single Post Format or 2 Category ' . $cat . ' start-->';
                        }
                        ?><div id="post-<?php the_ID(); ?>"  class="<?php echo raindrops_article_wrapper_class();?>">
                        <<?php raindrops_doctype_elements( 'div', 'article' ); ?> <?php raindrops_post_class( array( 'clearfix' ) ); ?>>	
                        <?php
						$raindrops_sticky_conditional = raindrops_warehouse_clone( 'raindrops_display_sticky_post' );
						
                        if ( is_sticky() && 'only_home' == $raindrops_sticky_conditional ) {
                            ?>
                            <div class="sticky-single-follow-text">

                                <strong><a href="<?php echo $raindrops_home_url; ?>"><?php esc_html_e( 'Sticky Post Shows Only WEB Site Home.', 'raindrops' ); ?></a></strong>

                            </div>
            <?php		}
						 if ( is_sticky() && 'anytime' == $raindrops_sticky_conditional ) {
                            ?>
                            <div class="sticky-single-follow-text anytime">

                                <strong><a href="<?php echo $raindrops_home_url; ?>"><?php esc_html_e( 'Sticky Post', 'raindrops' ); ?></a></strong>

                            </div>
            <?php		} 
        /**
         * Show featured image
         *
         *
         *
         *
         */
        raindrops_featured_image();
        /**
         * Show Category base special layout and default single template part
         *
         *
         *
         *
         */
        get_template_part( "part", $cat );

        if ( true == WP_DEBUG ) {
            echo '<!-- #post-' . get_the_ID() . ' -->';
        }
		?></<?php raindrops_doctype_elements( 'div', 'article' ); ?>></div>
		<?php
		raindrops_prev_next_post( 'nav-below' );
		
		comments_template( '', true );
    }       //　endwhiles
    /**
     * Next Previous post link
     *
     *
     *
     *
     */
    raindrops_next_prev_links( "nav-below" );
} else {
    
}           // if ( have_posts( ) )
?>

						
					
            </div>
                <?php
                /**
                 * Show Extra sidebar column rsidebar start
                 *
                 *
                 *
                 *
                 */
                if ( 3 == $raindrops_current_column ) {
                    ?>
                <div class="yui-u">
                <?php
                raindrops_prepend_extra_sidebar();

                get_sidebar( 'extra' );

                raindrops_append_extra_sidebar();
                ?>
                </div>
                    <?php
                } elseif ( $rsidebar_show && false == $raindrops_current_column ) {
                    ?>
                <div class="yui-u">
                    <?php
                    raindrops_prepend_extra_sidebar();

                    get_sidebar( 'extra' );

                    raindrops_append_extra_sidebar();
                    ?>
                </div>
                    <?php
                }
                //add nest grid here
                ?>
        </div>
    </div>
</div>
            <?php
            /**
             * Show main column lsidebar start
             *
             *
             *
             *
             */
            if ( 1 !== $raindrops_current_column || false == $raindrops_current_column ) {
                ?>
<div class="yui-b">
    <?php
    raindrops_prepend_default_sidebar();

    get_sidebar( 'default' );

    raindrops_append_default_sidebar();
    ?>
</div>
        <?php
    }
get_footer( $raindrops_document_type ); ?>