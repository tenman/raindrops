<?php
/**
 * Template part file for extra sidebar.
 *
 *
 * @package Raindrops
 * @since Raindrops 0.1
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $template;
do_action( 'raindrops_pre_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) );
?>
<<?php raindrops_doctype_elements( 'div', 'aside' ); ?> class="rsidebar">
<?php raindrops_prepend_extra_sidebar();?>
<ul>
    <?php
    if ( !dynamic_sidebar( 'sidebar-2' ) ) {

        raindrops_sidebar_menus( 'extra' );
    }
    ?>
</ul>
<?php raindrops_append_extra_sidebar();?>
</<?php raindrops_doctype_elements( 'div', 'aside' ); ?>>
<?php do_action( 'raindrops_after_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) ); ?>
