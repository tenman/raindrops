<?php
/**
 * Template part file for default sidebar.
 *
 *
 * @package Raindrops
 * @since Raindrops 0.1
 */
?>
<<?php raindrops_doctype_elements( 'div','nav' );?> class="lsidebar">
<ul>
<?php
	if (!dynamic_sidebar('sidebar-1')){
		raindrops_sidebar_menus( 'default' );
	} 
?>
</ul>
</<?php raindrops_doctype_elements( 'div','nav' );?>>
