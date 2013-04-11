<?php
/**
 * Template for single post.
 *
 *
 * @package Raindrops
 * @since Raindrops 0.306
 * @uses raindrops_show_one_colum   Detect current post column count
 * @uses add_filter                 Overwrite Color type func raindrops_color_type_custom( )
 * @uses get_header( $raindrops_document_type )       Include template part file
 * @uses have_posts( )
 * @uses the_post( )
 * @uses in_category( )
 * @uses get_the_post_thumbnail( )
 * @uses has_post_thumbnail( )
 * @uses wp_get_attachment_image_src( )
 * @uses esc_url( )
 * @uses round( )
 * @uses esc_attr( )
 * @uses image_hwstring( )
 * @uses switch( )
 * @uses get_template_part( )
 * @uses raindrops_show_one_column( )
 * @uses next_posts_link( )
 * @uses previous_posts_link( )
 * @uses get_sidebar( )
 * @uses get_footer( $raindrops_document_type )
 * @uses get_attachment_link( )
 * @uses get_post_thumbnail_id( )
 * @uses raindrops_prepend_default_sidebar( )
 * @uses raindrops_append_default_sidebar( )
 *
 */
 
		$raindrops_current_column = raindrops_show_one_column( );
	
		if ( $raindrops_current_column !== false ) {
			add_filter( "raindrops_theme_settings__raindrops_indv_css", "raindrops_color_type_custom" );
		}
	
		get_header( $raindrops_document_type ); 
	
		raindrops_debug_navitation( __FILE__ ); 
?>
	<div id="yui-main">
		<div class="yui-b <?php raindrops_add_class( 'yui-b' ); ?>">
			<div class="<?php echo raindrops_yui_class_modify( );?>" id="container">
				<div class="yui-u first <?php raindrops_add_class( 'yui-u first', true );?>">
<?php
/**
 * Display navigation to next/previous pages when applicable
 */

		if ( have_posts( ) ) {
			/**
			 * when Single page
			 */
			while ( have_posts( ) ) {
			
				the_post( );
			
				$cat = "default";
				
				if ( in_category( "blog" ) or has_post_format( 'status' ) ) {
				
					$cat = "blog";
				}
				
				if ( in_category( "gallery" ) or has_post_format( 'gallery' ) ) {
				
					$cat = "gallery";
				}
			
				if ( WP_DEBUG == true ) {
				
					echo '<!--Single Category '.$cat.' start-->';
				}
				
				if ( $cat == "blog" or $cat == "gallery" ) {
?>			
					<div id="post-<?php the_ID( ); ?>" <?php  post_class( 'clearfix' ); ?> >
<?php
				}
/**
 * Show featured image
 *
 *
 *
 *
 */
				raindrops_featured_image( );
/**
 * Show Category base special layout and default single template part
 *
 *
 *
 *
 */
				switch ( $cat ) {
			
					case ( 'blog' ): 
					//category blog
						get_template_part( "part", "blog" );
						break;
					// category gallery
					case( 'gallery' ):
						get_template_part( "part", "gallery" );
						break;
					//another single page
					default:
						$format= get_post_format();
						
   						get_template_part( "part", $format );      
			
					if ( WP_DEBUG == true ) {
						echo '<!-- #post-'.get_the_ID( ).' -->';
					}
				}	//   end switch( $cat )
			
				if( $cat == "blog" or $cat == "gallery" or $format == 'blog' or $format == 'gallery' ) {
?>				
						</div>
<?php
				}
			
			}		//　endwhile
/**
 * Next Previous post link
 *
 *
 *
 *
 */
			raindrops_next_prev_links( "nav-below" );
	
		}			// if( have_posts( ) ) 
?>
					</div>
<?php
/**
 * Show Extra sidebar column rsidebar start
 *
 *
 *
 *
 */
		if ( raindrops_show_one_column( ) == 3 ) {
?>	
					<div class="yui-u">
<?php		
			raindrops_prepend_extra_sidebar( );
			
			get_sidebar( 'extra' );
			
			raindrops_append_extra_sidebar( );
?>
					</div>
<?php
	} elseif ( $rsidebar_show and $raindrops_current_column == false ) {
?>	
					<div class="yui-u">
<?php		
			raindrops_prepend_extra_sidebar( );
			
			get_sidebar( 'extra' );
			
			raindrops_append_extra_sidebar( );
?>
					</div>
<?php
		}
 			//add nest grid here 
?> 
				</div>
			</div>
		</div>
<?php
/**
 * Show main column lsidebar start
 *
 *
 *
 *
 */
		if ( raindrops_show_one_column( ) !== '1' or $raindrops_current_column == false ) {
?>		
		<div class="yui-b">
<?php			
					raindrops_prepend_default_sidebar( );
					
					get_sidebar( 'default' );
					
					raindrops_append_default_sidebar( );
?>					
		</div>
<?php		
		}
?>
	</div>
<?php get_footer( $raindrops_document_type );?>