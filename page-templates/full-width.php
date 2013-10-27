<?php
/**
 * Template Name: Full-width Page Template, No Sidebar
 *
 */
		do_action( 'raindrops_'. basename(__FILE__) );

		get_header( $raindrops_document_type );
		do_action( 'raindrops_pre_'.basename( __FILE__) );
		
		$raindrops_current_column = raindrops_show_one_column( );
		
		if ( $raindrops_current_column !== false ) {
			add_filter( "raindrops_theme_settings__raindrops_indv_css","raindrops_color_type_custom" );
		}

		raindrops_debug_navitation( __FILE__ );
?>
	<div id="yui-main">
		<div id="container">
<?php
/**
 *  Widget only home
 *
 */
		if ( is_front_page( ) and  is_active_sidebar( 'sidebar-3' ) ) {
		
			echo '<div class="topsidebar">'."\n".'<ul>';
			
			dynamic_sidebar( 'sidebar-3' );
			
			echo '</ul>'."\n".'</div>'."\n".'<br class="clear" />';
		}
		
		if ( have_posts( ) ) {
		 
			while ( have_posts( ) ) { 
			
				the_post( );
?>
			<div class="entry page">
          		<div id="post-<?php the_ID( ); ?>" <?php raindrops_post_class( );?>>
<?php
				raindrops_entry_title( ); 
?>
            	<div class="entry-content">
<?php
				raindrops_prepend_entry_content( );
				
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
				
				echo '&nbsp;';

				edit_post_link( esc_html__( 'Edit', 'Raindrops' ). raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );
				 
				raindrops_delete_post_link( esc_html__( 'Trash', 'Raindrops' ). raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );
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
?>
      </div>
    </div>
</div>
<?php get_footer( $raindrops_document_type ); ?>