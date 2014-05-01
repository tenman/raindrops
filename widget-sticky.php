<?php if ( is_home() && is_active_sidebar( 'sidebar-3' ) ) { // Widget only home  ?>
    <div class="topsidebar">
        <ul>
            <?php dynamic_sidebar( 'sidebar-3' ); ?>
        </ul>
    </div>
    <br class="clear" />
    <?php
} // end if ( is_home( ) &&  is_active_sidebar( 'sidebar-3' ) )
?>

