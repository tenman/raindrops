<?php
/**
 * Template part file for default sidebar.
 *
 *
 * @package Raindrops
 * @since Raindrops 0.1
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $template;
do_action( 'raindrops_pre_part_'. basename( __FILE__, '.php' ). '_'. basename( $template ) );
?>
<<?php raindrops_doctype_elements( 'div','nav' );?> class="lsidebar">
<ul>
<?php
	if ( ! dynamic_sidebar('sidebar-1' ) ) {
		raindrops_sidebar_menus( 'default' );
	} 
?>
</ul>
</<?php raindrops_doctype_elements( 'div', 'nav' );?>>
<?php 		do_action( 'raindrops_after_part_'. basename( __FILE__, '.php' ). '_'. basename( $template ) ); ?>