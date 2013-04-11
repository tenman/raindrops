<?php
/*
Template Name: Auther
*/
/**
 * The template for displaying Auther.
 *
 *
 * @package Raindrops
 * @since Raindrop 0.1
 *
 * @uses get_header( $raindrops_document_type )	include template part file
 * @uses raindrops_yui_class_modify( )	add class attribute value
 * @uses is_2col_raindrops( 'style="width:99%;"' )	add inline style attribute
 * @uses get_avatar( )
 * @uses apply_filters( 'raindrops_author_bio_avatar_size', 60 )
 * @uses have_posts( )
 * @uses have_posts( )
 * @uses the_post( )
 * @uses get_option( 'date_format' )
 * @uses the_time( $raindrops_date_format )
 * @uses the_permalink( )
 * @uses the_title_attribute( )
 * @uses raindrops_entry_title( )
 * @uses the_category( ', ' )
 * @uses get_the_tag_list( '', ', ' )
 * @uses get_sidebar( 'extra' )	include template part file
 * @uses get_sidebar( 'default' )	include template part file
 * @uses get_footer( $raindrops_document_type ) 
 * @uses raindrops_prepend_default_sidebar( )
 * @uses raindrops_append_default_sidebar( )
 */

		$curauth = get_userdata( intval( $author ) );
		
		get_header( $raindrops_document_type );
		
		raindrops_debug_navitation( __FILE__ ); 
?>
	<div id="yui-main">
		<div class="yui-b">
			<div class="<?php echo raindrops_yui_class_modify( );?>" id="container">
				<div class="yui-u first <?php raindrops_add_class( 'yui-u first', true );?>">
					<h2 class="h2">
<?php
		printf( esc_html__( 'Author Archives: %s', 'Raindrops' ), $curauth->nickname );
?>
					</h2>
					<table summary="author infomation" class="author-meta">
						<tr>
							<td class="avatar-col">
<?php 
		echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'raindrops_author_bio_avatar_size', 60 ) );
?>
							</td>
							<td>
								<dl class="author raindrops" style="margin:0;padding:0;">
<?php	
		if ( esc_html( $curauth->description ) ) {
?>
									<dt>
<?php 
			esc_html_e( 'Profile', 'Raindrops' );
?>
									</dt>
										<dd>
<?php 
			echo esc_html( $curauth->description );
?>
										</dd>
<?php
		}
?>
<?php
		if ( ! empty( $curauth->user_url ) ) {
?>
									<dt>
<?php 
			esc_html_e( 'Website', 'Raindrops' );
?>
									</dt>
										<dd>
											<a href="<?php echo esc_url( $curauth->user_url ); ?>">
<?php 
			echo esc_url( $curauth->user_url );
?>
											</a>
										</dd>
<?php
		}
?>
									<dt>
<?php 
			esc_html_e( 'registered','Raindrops' );
?>
									</dt>
										<dd>
<?php
			echo esc_html( $curauth->user_registered );
?>
										</dd>
		  						</dl>
		  					</td>
	  					</tr>
					</table>
        			<br class="clear" />
					<h2 class="h2">
<?php
			esc_html_e( "Recent post",'Raindrops' );
?>
					</h2>
					<dl class="author">
		  <!-- The Loop -->
<?php
		if ( have_posts( ) ){
		
			while ( have_posts( ) ){
			
			 the_post( );
?>
						<dt>
<?php 
				$raindrops_date_format = get_option( 'date_format' ); the_time( $raindrops_date_format );
?>
			&nbsp;&nbsp;<a href="<?php the_permalink( ) ?>" rel="bookmark" title="Permanent Link: <?php the_title_attribute( ); ?>">
<?php 
				the_title( );
?>
							</a>
						</dt>
		  					<dd>
<?php 
				esc_html_e( 'Categories :', 'Raindrops' );
				
				the_category( ', ' );
?>
		  					</dd>
		  					<dd>
<?php
				esc_html_e( 'Tag :', 'Raindrops' );
				echo get_the_tag_list( '', ', ' );
?>
							</dd>
<?php 
			} //end while
		} else {
?>
					<p>
			<?php esc_html_e( 'No posts by this author.', 'Raindrops' ); ?>
					</p>
<?php
		} 
?>
		  <!-- End Loop -->
					</dl>
				</div>
					<div class="yui-u">
<?php 
		raindrops_prepend_extra_sidebar( );
	  
		if ( $rsidebar_show ) {
	   
			get_sidebar( 'extra' );
		
		}
		
		raindrops_append_extra_sidebar( );
?>
					</div>
    			</div>
  			</div>
		</div>
	<div class="yui-b">
<?php 
		raindrops_prepend_default_sidebar( );
		
		get_sidebar( 'default' );
		
		raindrops_append_default_sidebar( );
?>
	</div>
</div>
<?php get_footer( $raindrops_document_type ); ?>