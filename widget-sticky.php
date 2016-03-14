<?php

 $page_for_posts	= get_option( 'page_for_posts' );
 $page_id			= get_queried_object_id();
 
if ( ( is_front_page() || ( is_home() && absint( $page_for_posts ) !==  absint( $page_id ) ) ) && is_active_sidebar( 'sidebar-3' ) ) { 
?>
	<div class="topsidebar">
        <ul>
            <?php dynamic_sidebar( 'sidebar-3' ); ?>
        </ul>
    </div>
    <br class="clear" />
    <?php
} // end if ( is_home( ) &&  is_active_sidebar( 'sidebar-3' ) )
?>