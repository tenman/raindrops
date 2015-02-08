<?php
/**
 * The template for displaying 404 pages ( Not Found ).
 *
 *
 * @package Raindrops
 * @since Raindrop 0.1
 *
 * @uses raindrops_prepend_default_sidebar( )
 * @uses raindrops_append_default_sidebar( )
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
global $rsidebar_show, $raindrops_document_type;
$raindrops_current_column = raindrops_column_controller();

get_header( $raindrops_document_type );

do_action( 'raindrops_pre_' . basename( __FILE__ ) );

raindrops_debug_navitation( __FILE__ );
?>
<div id="yui-main" class="<?php raindrops_dinamic_class( 'yui-main',true ); ?>">
    <div class="<?php raindrops_dinamic_class( 'yui-b', true ); ?>">
        <div class="<?php echo raindrops_yui_class_modify(); ?>" id="container">
            <div class="<?php raindrops_dinamic_class( 'yui-u first', true ); ?>" <?php raindrops_doctype_elements( '', 'role="main"' ); ?>>
                <h1 class="entry-title">
<?php esc_html_e( 'Error 404 - Not Found', 'Raindrops' ); ?>
                </h1>
                <div id="post-0" class="post error404 not-found">
                    <div class="entry-content">
                        <p>
                        <?php esc_html_e( 'Apologies, but no results were found for the requested Archive. Perhaps searching will help find a related post.', 'Raindrops' ); ?>
                        </p>
<?php get_search_form(); ?>
                    </div>
                </div>
            </div>
           <?php
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
            ?>
        </div>
    </div>
</div>
<?php
if ( $raindrops_current_column !== 1 || false == $raindrops_current_column ) {
    ?>
    <div class="yui-b">
        <?php
        //lsidebar start 
        raindrops_prepend_default_sidebar();

        get_sidebar( 'default' );

        raindrops_append_default_sidebar();
        ?>
    </div>
    <?php
}
do_action( 'raindrops_after_' . basename( __FILE__ ) );
get_footer( $raindrops_document_type );?>