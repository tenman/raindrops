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
			<li><?php raindrops_prepend_widget_sticky(); ?></li>
            <?php dynamic_sidebar( 'sidebar-3' ); ?>
			<li><?php raindrops_append_widget_sticky(); ?></li>
        </ul>
    </div>
    <br class="clear" />
<?php
} 
?>