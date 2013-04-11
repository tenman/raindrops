<?php
/**
 * Template part file for extra sidebar.
 *
 *
 * @package Raindrops
 * @since Raindrops 0.1
 */
?>
<<?php raindrops_doctype_elements( 'div', 'aside' );?> class="rsidebar">
<ul>
<?php 
	if ( ! dynamic_sidebar('sidebar-2' ) ) {
	
		raindrops_sidebar_menus( 'extra' );
		
	} 
?>
</ul>
</<?php raindrops_doctype_elements( 'div', 'aside' );?>>
