<?php
/**
 * Template Name: Full-width Page Template, No Sidebar
 *
 */
do_action( 'raindrops_' . basename( __FILE__ ) );

get_header( $raindrops_document_type );
do_action( 'raindrops_pre_' . basename( __FILE__ ) );

$raindrops_current_column = raindrops_show_one_column();

if ( $raindrops_current_column !== false ) {
	add_filter( "raindrops_theme_settings__raindrops_indv_css", "raindrops_color_type_custom" );
}

raindrops_debug_navitation( __FILE__ );
?>
<div id="yui-main">
    <div id="container">
		<?php
		get_template_part( 'widget', 'sticky' );

		if ( have_posts() ) {

			while ( have_posts() ) {

				the_post();
				?>
				<div class="entry page">
					<div id="post-<?php the_ID(); ?>" <?php raindrops_post_class(); ?>>
						<?php
						raindrops_entry_title();
						?>
						<div class="entry-content">
							<?php
							raindrops_prepend_entry_content();

							raindrops_entry_content();
							?>
							<br class="clear" />
							<?php
							raindrops_append_entry_content();
							?>
						</div>
						<div class="linkpage clearfix">
							<?php
							wp_link_pages( 'before=<p class="pagenate">&after=</p>&next_or_number=number&pagelink=<span>%</span>' );
							?>
						</div>
						<br class="clear" />
						<div class="postmetadata">
							<?php
							the_category( ', ' );

							echo '&nbsp;';

							edit_post_link( esc_html__( 'Edit', 'Raindrops' ) . raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );

							raindrops_delete_post_link( esc_html__( 'Trash', 'Raindrops' ) . raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );
							?>
						</div>
						<?php
						comments_template( '', true );
						?>
					</div>
				</div>
				<?php
			} //endwhile 
			raindrops_next_prev_links( "nav-below" );
		} //end have post

		if ( is_front_page() ) {
			$args						 = array(
				'meta_key'		 => '_add-to-front', 'meta_value'	 => 'add', 'meta_compare'	 => '='
				, 'post_type'		 => 'page'
				, 'post_status'	 => 'public'
				, 'orderby'		 => 'menu_order'
				, 'nopaging'		 => true
			);
			$raindrops_add_front_pages	 = get_posts( $args );

			if ( $raindrops_add_front_pages ) {
				// TABLE OF CONTENTS
				?>
				<ul class="raindrops-toc-front">
					<?php
					foreach ( $raindrops_add_front_pages as $key => $post ) {

						setup_postdata( $post );
						$raindrops_toc_count = $key + 1;

						the_title( '<li class="list-' . absint( $raindrops_toc_count ) . ' h2"><a href="#post-' . absint( get_the_ID() ) . '">', '</a></li>' );
					}
					wp_reset_postdata();
					?>
				</ul>

				<div id="front-page-template-pages">	
					<?php
					raindrops_prepend_loop();

					foreach ( $raindrops_add_front_pages as $post ) {
						?><<?php raindrops_doctype_elements( 'div', 'article' ); ?> id="post-<?php the_ID(); ?>" <?php raindrops_post_class(); ?>><?php
						setup_postdata( $post );
						get_template_part( 'part', 'additional' );
						?></<?php raindrops_doctype_elements( 'div', 'article' ); ?>><?php
					}
					wp_reset_postdata();
					?>
				</div>
				<?php
			}
		}
		?>
    </div>
</div>
</div>
<?php get_footer( $raindrops_document_type ); ?>