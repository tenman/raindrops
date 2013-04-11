<?php
/**
 * Template part file part
 *
 * @package Raindrops
 * @since Raindrops 0.940
 *
 */
?>
	<<?php raindrops_doctype_elements( 'div', 'article' );?> id="post-<?php the_ID( ); ?>" <?php post_class( ); ?> >
<?php 
		raindrops_entry_title( );
?>
		<div class="entry-meta-default">
<?php 
		raindrops_posted_on( ); 
?>
		</div>
<?php 
	if ( is_archive( ) or is_search( ) ) { // Only display Excerpts for archives & search 
?>
		<div class="entry-summary"><?php the_excerpt( ); ?></div>
<?php 
	} else { // is not archives & search
?>
		<div class="entry-content clearfix">
<?php 
		raindrops_prepend_entry_content( );
		
		raindrops_entry_content( );
		
		wp_link_pages( 'before=<p class="pagenate clearfix">&after=</p>&next_or_number=number&pagelink=<span>%</span>' );
		 
		raindrops_append_entry_content( );
?>
		</div>
<?php 
	} // end is_archive( ) || is_search( ) 
?>
		<div class="entry-utility entry-meta">
<?php 
		echo raindrops_posted_in( );
		
		edit_post_link(  esc_html__( 'Edit', 'Raindrops' ), '<span class="edit-link">', '</span>' );
		 
		raindrops_delete_post_link(  esc_html__( 'Trash', 'Raindrops' ), '<span class="edit-link">', '</span>' );
?>
		</div>
<?php 
	if( is_single( ) ) {
	
		raindrops_prev_next_post( 'nav-below' );
		
	}
	
	comments_template( '', true ); 
?>
	</<?php raindrops_doctype_elements( 'div', 'article' );?>>