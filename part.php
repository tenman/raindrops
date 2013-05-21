<?php
/**
 * Template part file part
 *
 * @package Raindrops
 * @since Raindrops 0.940
 *
 */
 	$format = get_post_format( );
	
	if ( $format === false ) {
	
		$raindrops_entry_meta_class = 'entry-meta-default';
	}else{
	
		$raindrops_entry_meta_class = 'entry-meta-'. $format;
	}
	
?>
<?php 
		raindrops_entry_title( );
		
		
?>
		<div class="<?php echo $raindrops_entry_meta_class; ?>">
<?php 
		raindrops_posted_on( ); 
?>
		</div>
<?php 
	if ( ( is_archive( ) or is_search( ) ) and !is_tax() ) { // Only display Excerpts for archives & search 
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
		
		edit_post_link(  esc_html__( 'Edit', 'Raindrops' ). raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );
		 
		raindrops_delete_post_link(  esc_html__( 'Trash', 'Raindrops' ). raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );
?>
		</div>
<?php 
	if( is_single( ) ) {
	
		raindrops_prev_next_post( 'nav-below' );
		
	}
	
	comments_template( '', true ); 
?>