<?php
/**
 * Template file Image
 *
 * @package Raindrops
 * @since Raindrops 1.272
 */
if ( !defined( 'ABSPATH' ) ) {
	exit;
}	
global $rsidebar_show, $raindrops_document_type, $content_width;
$raindrops_current_column = raindrops_column_controller();

get_header( $raindrops_document_type );
do_action( 'raindrops_pre_' . basename( __FILE__ ) );
raindrops_debug_navitation( __FILE__ );
?>

<div id="yui-main" class="<?php raindrops_dinamic_class( 'yui-main', true ); ?>">
	<div class="<?php raindrops_dinamic_class( 'yui-b', true ); ?>">
		<?php get_template_part( 'widget', 'sticky' ); ?>

		<div class="<?php echo raindrops_yui_class_modify(); ?>" id="container">
			<div class="<?php raindrops_dinamic_class( 'yui-u first', true ); ?>" <?php raindrops_doctype_elements( '', 'role="main"' ); ?>>
<?php
				if ( have_posts() ) {

					while ( have_posts() ) {

					the_post();
					?>
					<div id="post-<?php the_ID(); ?>"  <?php raindrops_post_class(); ?>>
						<div class="entry attachment raindrops-image-page">
							<h2 class="image-title h2"><?php the_title(); ?></h2>
							<?php
							if ( $post->post_parent !== 0 ) {
								?>
								<p class="parent-entry">
									<?php
									esc_html_e( "Entry : ", 'Raindrops' );
									?>
									<a href="<?php echo get_permalink( $post->post_parent ); ?>" rev="attachment">
										<?php
										echo get_the_title( $post->post_parent );
										?>
									</a>
								</p>
								<?php
							}

							$image = get_post_meta( $post->ID, 'image', true );

							$image = wp_get_attachment_image_src( $image, 'full' );
							?>
							<p class="image">
								<a href="<?php echo $image[ 0 ]; ?>" >
									<img src="<?php echo $image[ 0 ]; ?>" width="<?php echo $image[ 1 ]; ?>" height="<?php echo $image[ 2 ]; ?>" alt="<?php the_title_attribute(); ?>" />
								</a>
							</p>
							<div class="caption">
								<dl>
									<dd class="caption">
										<?php
										if ( !empty( $post->post_excerpt ) ) {
											the_excerpt(); // this is the "caption" 
										}
										?>
									</dd>
									<dd class="serif">
										<?php
										raindrops_prepend_entry_content();

										raindrops_entry_content();
										?>
										<br class="clear" />
										<?php
										raindrops_append_entry_content();
										?>  
									</dd>
								</dl>
							</div>
							<br class="clear" />
							<hr />
							<div class="attachment-navigation">
								<div class="prev">
									<?php
									previous_image_link( 0 );
									?>
								</div>
								<div class="next">
									<?php
									next_image_link( 0 );
									?>
								</div>
								<br class="clear" />
							</div>
						</div>
						<br class="clear" />
						<?php
						edit_post_link( esc_html__( 'Edit', 'Raindrops' ) . raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );

						raindrops_delete_post_link( esc_html__( 'Trash', 'Raindrops' ) . raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );
						?>
					</div>
					<?php
					} // while ( have_posts( ) )
				} else {
					?>
					<p>
						<?php
						esc_html_e( "Sorry, no attachments matched your criteria.", "Raindrops" );
						?>
					</p>
					<?php
				}
				?>							

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