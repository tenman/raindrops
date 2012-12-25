<?php
/**
 * Template Name: Front Page Template
 *
 * @package Raindrops
 * @since Raindrops 0.940
 *
 * @uses get_header( $raindrops_document_type )	include template part file
 * @uses is_front_page()	Check Conditional is home page or not
 * @uses is_active_sidebar('sidebar-3')	include template part file
 * @uses dynamic_sidebar('sidebar-3')	include template part file
 * @uses get_footer( $raindrops_document_type ) 
 */
get_header( 'front' );?>
<?php raindrops_debug_navitation( __FILE__ ); ?>
<div id="yui-main">
<?php
/**
 *  Widget only home
 *
 */
    if ( is_front_page() and  is_active_sidebar('sidebar-3') ) {
        echo '<div class="topsidebar">'."\n".'<ul>';
        dynamic_sidebar('sidebar-3');
        echo '</ul>'."\n".'</div>'."\n".'<br class="clear" />';
    } ?>
</div>
</div>
<?php get_footer( $raindrops_document_type ); ?>