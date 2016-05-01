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


		<div class="<?php echo raindrops_yui_class_modify(); ?>" id="container">

			<div class="<?php raindrops_dinamic_class( 'yui-u first', true ); ?>" <?php raindrops_doctype_elements( '', 'role="main"' ); ?>>						
				<?php get_template_part( 'widget', 'sticky' ); ?>				
				<?php
				if ( have_posts() ) {

					while ( have_posts() ) {

						the_post();
						raindrops_before_article();
						?>
						<div  id="post-<?php the_ID(); ?>" class="<?php echo raindrops_article_wrapper_class(); ?>">
							<<?php raindrops_doctype_elements( 'div', 'article' ); ?> <?php raindrops_post_class(); ?>>
							<div class="entry attachment raindrops-image-page">

								<?php
								$image = get_post_meta( $post->ID, 'image', true );

								$image = wp_get_attachment_image_src( $image, 'full' );
								?>
								<p class="image">
									<a href="<?php echo $image[ 0 ]; ?>" >
										<img src="<?php echo $image[ 0 ]; ?>" width="<?php echo $image[ 1 ]; ?>" height="<?php echo $image[ 2 ]; ?>" alt="<?php the_title_attribute(); ?>" class="aligncenter" />
									</a>
								</p>

								<div class="attachment-info">
									<?php do_action( 'raindrops_prepend_attachment_info' ); ?>

									<h2 class="image-title entry-title h2"><a href="<?php echo esc_url( $image[ 0 ] ); ?>"><?php the_title(); ?></a></h2>
									<?php 
									if( 'yes' == raindrops_warehouse('raindrops_show_date_author_in_attachment') ) {
										raindrops_posted_on();
									}								
									?>
									
									<div class="serif entry-content">
										<?php
										raindrops_prepend_entry_content();
										
										raindrops_entry_content();
										?>
										<br class="clear" />
										<?php
										raindrops_append_entry_content();
										?>  
									</div>
									<?php
									if ( !empty( $post->post_excerpt ) ) {
											?>
										<div class="image-caption caption entry-summary">
											<p class="section-title"><?php esc_html_e( 'Caption', 'raindrops' ); ?></p>
											<div class="image-caption-text">
												<?php the_excerpt(); ?>
											</div>
										</div>
									<?php
									}
									if ( $post->post_parent > 0 ) {
										?>
										<div class="image-caption parent-entry">
											<p class="section-title"><?php esc_html_e( "Attached Source", 'raindrops' ); ?></p>								
											<h3 class="parent-entry-title h3"><a href="<?php echo get_permalink( $post->post_parent ); ?>" rev="attachment">
													<?php echo get_the_title( $post->post_parent ); ?>
												</a></h3>
										</div>
										<?php
										$parent					 = get_post( $post->post_parent );
										$parent					 = strip_shortcodes( $parent->post_content );
										$parent_excerpt_length	 = raindrops_warehouse_clone( 'raindrops_excerpt_length' );
										$more					 = '...';
										$parent_excerpt			 = wp_html_excerpt( $parent, $parent_excerpt_length, $more );

										if( ! empty( $parent_excerpt ) ) {
											?><div class="parent-entry-excerpt entry-summary"><?php
											echo $parent_excerpt; // this is the "parent post excerpt" 
											?></div><?php
										}
									}

									do_action( 'raindrops_append_attachment_info' );
									?>
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
							edit_post_link( esc_html__( 'Edit', 'raindrops' ) . raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );

							raindrops_delete_post_link( esc_html__( 'Trash', 'raindrops' ) . raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );
							?>
							</<?php raindrops_doctype_elements( 'div', 'article' ); ?>>
						</div><?php raindrops_after_article(); ?>	
						<?php
					} // while ( have_posts( ) )
				} else {
					?>
					<p>
						<?php
						esc_html_e( "Sorry, no attachments matched your criteria.", 'raindrops' );
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