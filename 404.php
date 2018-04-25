<?php
/**
 * The template for displaying 404 pages ( Not Found ).
 *
 * @package Raindrops
 * @since Raindrop 0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $rsidebar_show, $raindrops_document_type;
$raindrops_current_column = raindrops_column_controller();

get_header( $raindrops_document_type );

do_action( 'raindrops_pre_' . basename( __FILE__ ) );

raindrops_debug_navitation( __FILE__ );
?>
<div id="yui-main" class="<?php raindrops_dinamic_class( 'yui-main', true ); ?>">
	<div class="<?php raindrops_dinamic_class( 'yui-b', true ); ?>">
		<div class="<?php raindrops_extra_sidebar_classes(); ?>" id="container">
			<div class="<?php raindrops_dinamic_class( 'yui-u first', true ); ?>" <?php raindrops_doctype_elements( '', 'role="main"' ); ?>>
				<div id="post-0" class="post error404 not-found">
					<h2 class="entry-title title-404">
						<?php esc_html_e( 'Error 404 - Not Found', 'raindrops' ); ?>
					</h2>
					<div class="entry-content">
						<?php do_action( 'raindrops_prepend_404_entry_content' ); ?>
						<p class="message-404">
							<?php esc_html_e( 'Apologies, but no results were found for the requested Archive. Perhaps searching will help find a related post.', 'raindrops' ); ?>
						</p>
						<?php get_search_form(); ?>
						<?php do_action( 'raindrops_append_404_entry_content' ); ?>
					</div>
				</div>
			</div>
			<?php
			if ( 3 == $raindrops_current_column ) {
				?>
				<div class="yui-u"><?php get_sidebar( 'extra' ); ?></div>
				<?php
			} elseif ( $rsidebar_show && false == $raindrops_current_column ) {
				?>
				<div class="yui-u"><?php get_sidebar( 'extra' ); ?></div>
				<?php
			}
			?>
		</div>
	</div>
</div>
<?php
if ( 1 !== (int) $raindrops_current_column  || false == $raindrops_current_column ) {
// lsidebar start.
	get_sidebar( 'default' );
}
do_action( 'raindrops_after_' . basename( __FILE__ ) );
get_footer( $raindrops_document_type );
?>