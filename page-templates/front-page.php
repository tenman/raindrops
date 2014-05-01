<?php
/**
 * Template Name: Front Page Template
 *
 * @package Raindrops
 * @since Raindrops 0.940
 *
 * @uses get_header( $raindrops_document_type )	include template part file
 * @uses is_front_page( )	Check Conditional is home page or not
 * @uses is_active_sidebar( 'sidebar-3' )	include template part file
 * @uses dynamic_sidebar( 'sidebar-3' )	include template part file
 * @uses get_footer( $raindrops_document_type ) 
 */
do_action( 'raindrops_' . basename( __FILE__ ) );

get_header( 'front' );
do_action( 'raindrops_pre_' . basename( __FILE__ ) );

raindrops_debug_navitation( __FILE__ );
?>
<div id="yui-main">
    <?php get_template_part( 'widget', 'sticky' ); ?>
</div>
</div>
<?php get_footer( $raindrops_document_type ); ?>