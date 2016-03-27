<?php
if( is_paged() ) {
	return;
}
if ( ( is_home() == true && is_front_page() == true ) || // default
	 ( is_home() == false && is_front_page() == true )   // static front page
) {
?>
	<div class="topsidebar">
        <ul>
            <?php dynamic_sidebar( 'sidebar-3' ); ?>
        </ul>
    </div>
    <br class="clear" />
<?php
} 
?>