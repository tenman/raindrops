<?php
/**
 * Template for display page
 *
 *
 * @package Raindrops
 * @since Raindrops 0.1
 *
 * @uses raindrops_show_one_column( )
 * @uses add_filter( )
 * @uses get_header( )
 * @uses raindrops_yui_class_modify( )
 * @uses have_posts( )
 * @uses the_post( )
 * @uses the_ID( )
 * @uses raindrops_post_class( )
 * @uses the_title_attribute( )
 * @uses raindrops_entry_title( )
 * @uses raindrops_entry_content( )
 * @uses wp_link_pages( )
 * @uses the_category( ', ' )
 * @uses edit_post_link( )
 * @uses raindrops_delete_post_link( )
 * @uses comments_template( '', true )
 * @uses next_posts_link( )
 * @uses previous_posts_link( )
 * @uses get_sidebar( 'extra' )
 * @uses get_sidebar( 'default' )
 * @uses get_footer( $raindrops_document_type )
 * @uses raindrops_prepend_default_sidebar( )
 * @uses raindrops_append_default_sidebar( )
 * @uses the_post_thumbnail( )
 */
		do_action( 'raindrops_'. basename(__FILE__) );

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
        		<div class="yui-u first<?php raindrops_add_class( 'yui-u first', true );?>">
<?php 
		if ( have_posts( ) ) {
		 
			while ( have_posts( ) ) {
			
				the_post( );
				 
				printf( '<!--%1$s-->', $raindrops_document_type );
?>
        			<div class="entry page">
          				<<?php raindrops_doctype_elements( 'div', 'article' );?> id="post-<?php the_ID( ); ?>" <?php raindrops_post_class( );?>>

<?php 
				raindrops_entry_title( );
?>
            				<div class="entry-content">
<?php 
				raindrops_prepend_entry_content( );
				
				the_post_thumbnail( 'full','class=page-featured-image' );
				
				raindrops_entry_content( );
?>
              					<br class="clear" />
<?php
				raindrops_append_entry_content( );
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
				
				echo "&nbsp;";
				
				edit_post_link( esc_html__( 'Edit', 'Raindrops' ). raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );
				
				raindrops_delete_post_link( esc_html__( 'Trash', 'Raindrops' ). raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' ); 
?>
	            			</div>
<?php 
				comments_template( '', true );
?>
          				</<?php raindrops_doctype_elements( 'div', 'article' );?>>
        				</div>
<?php       
			} //endwhile 
		
		raindrops_next_prev_links( "nav-below" );

		} //end have post
?>
      				</div>
<?php 
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
?>
				</div>
			</div>
		</div>
<?php 
		if ( raindrops_show_one_column( ) !== '1' or $raindrops_current_column == false ) {
?>
		<div class="yui-b">
<?php //lsidebar start 
			raindrops_prepend_default_sidebar( );
			 
			get_sidebar( 'default' );
			
			raindrops_append_default_sidebar( );
?>
		</div>
<?php 
		}
?>
	</div>
<?php get_footer( $raindrops_document_type ); ?>