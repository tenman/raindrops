<?php
/**
 * Template part file part-blog
 *
 * @package Raindrops
 * @since Raindrops 0.1
 *
 * @uses the_ID( )
 * @uses raindrops_post_class( )
 * @uses get_option( 'date_format' )
 * @uses the_time( )
 * @uses get_avatar( )
 * @uses apply_filters( )
 * @uses the_category( )
 * @uses the_tags( )
 * @uses sprintf( )
 * @uses get_author_posts_url( )
 * @uses comments_popup_link( )
 * @uses dynamic_sidebar( )
 * @uses edit_post_link( )
 * @uses the_permalink( )
 * @uses the_title_attribute( )
 * @uses raindrops_entry_title( )
 * @uses raindrops_entry_content( )
 * @uses wp_link_pages( )
 * @uses is_single( )
 * @uses raindrops_prev_next_post( )
 * @uses comment_template( )
 * @uses get_day_link( )
 */

		$raindrops_date_html_module = '<a href="%1$s">%2$s</a>';
		$raindrops_date_format  = get_option( 'date_format' ). ' '. get_option( 'time_format' );		 
		//$raindrops_date_format		= get_option( 'date_format' );
		$raindrops_archive_year		= get_the_time( 'Y' );
		$raindrops_archive_month	= get_the_time( 'm' );
		$raindrops_archive_day		= get_the_time( 'd' );
		$raindrops_day_link			= esc_url( get_day_link( $raindrops_archive_year,
															 $raindrops_archive_month, 
															 $raindrops_archive_day ).'#post-'.$post->ID  
											);
		$raindrops_status_date		= get_the_time( $raindrops_date_format );

	if( is_single() ){
	
/**
 *	Template for Single post
 *
 *
 *
 */
?>
		<ul class="entry-meta-list left">
			<li class="category-blog-publish-date post-format-status-publish-date">
<?php
			printf( $raindrops_date_html_module, $raindrops_day_link, $raindrops_status_date );
?>
			</li>
			<li class="blog-avatar post-format-status-avatar">
<?php 
			echo get_avatar( get_the_author_meta( 'user_email' ),
								apply_filters( 'raindrops_author_bio_avatar_size',
								90 ),
								'',
								__('Author', 'Raindrops' ) .' '.  get_the_author_meta( 'display_name' ) 
							 ); 
?>
			</li>
			<li>
<?php
			esc_html_e( 'Category:', 'Raindrops' );
			
			the_category( ' ' ) 
?>
			</li>
			<li>
<?php
			esc_html_e( 'Tags:', 'Raindrops' );
			
			the_tags( ' ',' ' );
?>
			</li>
			<li>
<?php 
			esc_html_e( 'Author:', 'Raindrops' );
	
			printf( 
				'<span class="author vcard"><a class="url fn n" href="%1$s"   rel="vcard:url">%2$s</a></span>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), esc_html( get_the_author( ) )
			);
?>
			</li>
			<li>
<?php  
			if ( comments_open( ) ) { 
				comments_popup_link(  esc_html__( 'Leave a comment', 'Raindrops' ). raindrops_link_unique( 'Post', $post->ID ),
									  esc_html__( '1 Comment', 'Raindrops' ),
									  esc_html__( '% Comments', 'Raindrops' ) 
								); 
			}
?>
			</li>
<?php 
			dynamic_sidebar( 'sidebar-5' );
?>
			<li>
<?php 
			edit_post_link(  esc_html__( 'Edit', 'Raindrops' ).raindrops_link_unique( 'Post', $post->ID ),
							'<span class="edit-link">',
							'</span>' 
						); 
	
			raindrops_delete_post_link(  esc_html__( 'Trash', 'Raindrops' ). raindrops_link_unique( 'Post', $post->ID ),
										'<span class="edit-link">',
										'</span>' 
									); 
?>
			</li>
		</ul>
		
		<div class="blog-main left post-format-status-main">
<?php 
			raindrops_entry_title( );
?>
	
			<div class="entry-content clearfix">
<?php 
			raindrops_prepend_entry_content( );
			
			raindrops_entry_content( );
?>
				<div class="clearfix">
<?php 
			raindrops_append_entry_content( );
?>
				</div>
<?php 
			wp_link_pages( 'before=<p class="pagenate clearfix">&after=</p>&next_or_number=number&pagelink=<span>%</span>' );
?>
		</div>
	</div>
		<div class="clearfix"></div>
<?php 
			if ( is_single( ) ) {
			
				raindrops_prev_next_post( 'nav-below' );
			
			}
			 comments_template( '', true ); 

	} else {
	
/**
 * Template for Not Single post
 *
 *
 *
 */
?>
		<div class="format-status-not-single-post">
			<ul class="entry-meta-list left">
				<li class="blog-avatar">
<?php
	
			$raindrops_avatar = get_avatar( get_the_author_meta( 'user_email' ),
								apply_filters( 'raindrops_author_bio_avatar_size',
								48 ),
								'',
								get_the_author_meta( 'display_name' ) 
							 ); 
			printf( 
				'<span class="author vcard"><a class="url fn n" href="%1$s"   rel="vcard:url">%2$s</a></span>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), $raindrops_avatar );
?>
				</li>
			</ul>
		
			<div class="blog-main left post-format-status-main">
<?php 
			raindrops_entry_title( );
?>
				<div class="entry-content clearfix">
<?php 
			raindrops_prepend_entry_content( );
			
			raindrops_entry_content( );
?>
					<div class="clearfix">
<?php 
			raindrops_append_entry_content( );
?>
					</div>
<?php 
			wp_link_pages( 'before=<p class="pagenate clearfix">&after=</p>&next_or_number=number&pagelink=<span>%</span>' );
?>
				</div>
			</div>
<?php 
			if( ! is_tax( ) ) {
			
?>
			<div class="entry-utility entry-meta clear">
<?php
				echo raindrops_posted_in( );
				
				edit_post_link(  esc_html__( 'Edit', 'Raindrops' ). raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );
			 
				raindrops_delete_post_link(  esc_html__( 'Trash', 'Raindrops' ). raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );
?>		
			</div>
<?php		
			} 
			
			if( is_user_logged_in( ) and is_tax( ) ) {
?>
			<div class="entry-utility entry-meta clear">
<?php
				edit_post_link(  esc_html__( 'Edit', 'Raindrops' ). raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );
			 
				raindrops_delete_post_link(  esc_html__( 'Trash', 'Raindrops' ). raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );
?>
			</div>
<?php
			
			} elseif ( is_tax( ) ) {
			
				$raindrops_date_html_module = '<p style="text-align:right;">'. $raindrops_date_html_module. '</p>';
				
				printf( $raindrops_date_html_module, $raindrops_day_link, $raindrops_status_date );
			}

	}
?>