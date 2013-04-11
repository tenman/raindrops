<?php
/**
 * Template part file part-gallery
 *
 * @package Raindrops
 * @since Raindrops 0.940
 *
 */
		raindrops_entry_title( );
		
?>
	<div class="entry-meta-gallery">
<?php 
		raindrops_posted_on( ); 
?>
	</div>
	<div class="entry-content">
<?php 
		raindrops_prepend_entry_content( );

		$raindrops_attachment_args = array( 
					'post_parent' => $post->ID, 
					'post_type' => 'attachment', 
					'post_mime_type' => 'image', 
					'orderby' => 'menu_order', 
					'order' => 'ASC', 
					'numberposts' => 999 
				);
				
		$raindrops_images 		= get_children( $raindrops_attachment_args );
		
		if( isset( $raindrops_images ) and !empty( $raindrops_images ) ){
		
			$raindrops_format		= true;
				
			$total_images			= count( $raindrops_images );
			
			$raindrops_image_result	= array_shift( $raindrops_images );
			
		}else{
		
			$raindrops_format 		= false;
			
			$total_images 			= 0;
			
			$raindrops_image_result = '';
		}
		
		if ( ! preg_match( '!\[gallery!', get_the_content( ) ) and $raindrops_format == true ){
?>
	<div class="gallery-thumb">
<?php 
			echo wp_get_attachment_link( $raindrops_image_result->ID ,'thumbnail',true ); 
?>
	</div>
<?php
		}
		raindrops_entry_content ( );
?>
	<div class="clearfix">
<?php 
		raindrops_append_entry_content( );
	
		wp_link_pages( 'before=<p class="pagenate clearfix">&after=</p>&next_or_number=number&pagelink=<span>%</span>' ); 
?>
	</div>
<?php 
		if( $raindrops_format == true ){
?>
	<p style="margin:1em;"><em>
<?php 
			echo sprintf(  esc_html__( 'This gallery contains %1$s photographs in all as ', 'Raindrops' ), $total_images ).'&nbsp;'.wp_get_attachment_link( $raindrops_image_result->ID , false,true ).'&nbsp;'.__( 'photograph etc.', 'Raindrops' );
?>
	</em></p>
<?php 
		}
?>
	</div>
	<div class="entry-utility entry-meta">
<?php
		$category_id 	= get_cat_ID( 'Gallery' );
		
		$category_link 	= get_category_link( $category_id );
		
		printf(
			'<a href="%s" title="%s">%s</a> | ',
			esc_url( $category_link ),
			esc_attr__( 'View posts in the Gallery category', 'Raindrops' ),
			esc_html__( 'More Galleries', 'Raindrops' )
			);
?>
		<span class="comments-link">
<?php 
		comments_popup_link(  esc_html__( 'Leave a comment', 'Raindrops' ),  esc_html__( '1 Comment', 'Raindrops' ),  esc_html__( '% Comments', 'Raindrops' ) ); ?>
		</span>
<?php
		edit_post_link(  esc_html__( 'Edit', 'Raindrops' ), '<span class="edit-link">', '</span>' );

		raindrops_delete_post_link(  esc_html__( 'Trash', 'Raindrops' ), '<span class="edit-link">', '</span>' ); 
?>
	</div>
<?php
		if (is_single( ) ) {
		
			raindrops_prev_next_post( 'nav-below' );
		}
?>
<?php comments_template( '', true ); ?>