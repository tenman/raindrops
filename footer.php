<?php
/**
 * The template part file for footer.
 *
 *
 * @package Raindrops
 * @since Raindrops 0.1
 *
 * @uses wp_upload_dir( )
 * @uses raindrops_upload_image_parser( $footer_image_uri, 'inline','#ft' )
 * @uses is_active_sidebar( 'sidebar-4' )
 * @uses get_bloginfo( 'name' )
 * @uses get_bloginfo( 'rss2_url' )
 * @uses ucwords( )
 * @uses wp_footer( )
 * @uses raindrops_prepend_footer( )
 * @uses raindrops_append_footer( )
 * @uses raindrops_append_doc( )
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
global $raindrops_current_theme_name, $raindrops_current_data_theme_uri, $template, $raindrops_accessibility_link;
do_action( 'raindrops_pre_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) );
?>
</div>
<<?php raindrops_doctype_elements( 'div', 'footer' ); ?> id="ft" class="clear" <?php raindrops_doctype_elements( '', 'role="contentinfo"' ); ?>>
<?php raindrops_prepend_footer(); ?>
<!--footer-widget start-->
<div class="widget-wrapper clearfix">
    <?php if ( is_active_sidebar( 'sidebar-4' ) ) { ?>
        <ul>
            <?php dynamic_sidebar( 'sidebar-4' ); ?>
        </ul>
    <?php }//end if ( is_active_sidebar( 'sidebar-4' ) )  ?>
    <br class="clear" />
</div>
<!--footer-widget end-->
	<?php raindrops_footer_text();?>
    <?php raindrops_append_footer(); ?>
</<?php raindrops_doctype_elements( 'div', 'footer' ); ?>>
    <?php raindrops_append_doc(); ?>
</div>
    <?php wp_footer(); ?>
</body>
</html><?php do_action( 'raindrops_after_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) ); ?>