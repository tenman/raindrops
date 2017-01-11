<?php
if ( is_paged() ) {
	return;
}
if ( ( is_home() == true && is_front_page() == true ) || // default
( is_home() == false && is_front_page() == true )   // static front page
 ) {
	if ( is_active_sidebar( 'sidebar-3' ) ) {
		?>
		<div class="topsidebar">

			<ul>
				<?php
				raindrops_prepend_widget_sticky();
				dynamic_sidebar( 'sidebar-3' );
				raindrops_append_widget_sticky();
				?>
			</ul>
		</div>
		<br class="clear" />
		<?php
	}
}
?>