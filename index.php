<?php
/**
 * Template file index
 *
 * @package Raindrops
 * @since Raindrops 0.940
 *
 * @uses get_header( $raindrops_document_type )	include template part file
 * @uses is_home( )	Check Conditional is home page or not
 * @uses is_active_sidebar( 'sidebar-3' )	include template part file
 * @uses dynamic_sidebar( 'sidebar-3' )	include template part file
 * @uses raindrops_yui_class_modify( )	add class attribute value
 * @uses raindrops_is_2col( 'style="width:99%;"' )	add inline style attribute
 * @uses get_template_part( 'loop', 'default' )	include template part file
 * @uses get_sidebar( 'extra' )	include template part file
 * @uses get_sidebar( 'default' )	include template part file
 * @uses get_footer( $raindrops_document_type ) 
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

global $rsidebar_show, $raindrops_document_type,$content_width;
$raindrops_current_column = raindrops_column_controller();
get_header( $raindrops_document_type );
do_action( 'raindrops_pre_' . basename( __FILE__ ) );
raindrops_debug_navitation( __FILE__ );
?>

			<div id="yui-main" class="<?php raindrops_dinamic_class( 'yui-main',true ); ?>">
				
				<div class="<?php raindrops_dinamic_class( 'yui-b',true ); ?>">
					<div class="<?php echo raindrops_yui_class_modify(); ?>" id="container">
						<div class="<?php raindrops_dinamic_class( 'yui-u first', true ); ?>" <?php raindrops_doctype_elements( '', 'role="main"' ); ?>>
<?php get_template_part( 'widget', 'sticky' ); ?>							
							<?php get_template_part( 'loop', $raindrops_document_type ); ?>
							<br style="clear:both" />
						</div>
					<?php
					if ( 3 == $raindrops_current_column ) {
						?>
						<div class="yui-u">
							<?php
							raindrops_prepend_extra_sidebar();

							get_sidebar( 'extra' );

							raindrops_append_extra_sidebar();
							?>
						</div>
						<?php
					} elseif ( $rsidebar_show && false == $raindrops_current_column ) {
						?>
						<div class="yui-u">
							<?php
							raindrops_prepend_extra_sidebar();

							get_sidebar( 'extra' );

							raindrops_append_extra_sidebar();
							?>
						</div>
						<?php
					}
					?>
			</div>
		</div>
	</div>
	<?php
	if ( $raindrops_current_column !== 1 || false == $raindrops_current_column ) {
		?>
		<div class="yui-b">
			<?php
			//lsidebar start 
			raindrops_prepend_default_sidebar();

			get_sidebar( 'default' );

			raindrops_append_default_sidebar();
			?>
		</div>
		<?php
	}
	?>
<?php get_footer( $raindrops_document_type ); ?>