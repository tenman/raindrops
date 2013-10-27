<?php
/**
 * Template Name: Page Featured
 *
 * This template is a top page etc. and can create the layout of arbitrary complicated composition. 
 */
do_action( 'raindrops_'. basename(__FILE__) );
//args
/*
	$page_lists = array( array([first block settings]), array([second block settings]) ... );
	
	type[0] values page, post, include, widget
	type[1] values int page id, array page ids,Widget Name
	
	class values unit and size1of1, size1of2, size1of3, size2of3, size1of4, size3of4, size1of5, size2of5, size3of5, size4of5
*/
//Demo settings

	if( ! isset( $page_lists ) ) {
		$page_args 	= array( 'posts_per_page' => 1, 'orderby' => 'rand', 'post_type' => 'page');
		$rand_pages = get_posts( $page_args );
		$page_args 	= array( 'posts_per_page' => 1, 'orderby' => 'rand', 'post_type' => 'post');
		$rand_posts = get_posts( $page_args );
		
			
			$page_lists = array(
				array(
					array('type' => array( 'page', $rand_pages[0]->ID ), 'class' => 'unit size4of5' ),
					array('type' => array( 'widget', 'WP_Widget_Tag_Cloud',$instans='', $args='' ), 'page_id'=> 2, 'class' => 'unit size1of5' )
					
				),
				array(
					array('type' => array( 'page', $rand_pages[0]->ID ), 'class' => 'unit size3of5' ),
					array('type' => array( 'post', array($rand_posts[0]->ID, $rand_posts[0]->ID) ), 'class' => 'unit size1of5' ),
					array('type' => array( 'widget', 'WP_Widget_Tag_Cloud',$instans='', $args='' ), 'page_id'=> 2, 'class' => 'unit size1of5' )
					
				),

				array(
					array('type' => array( 'page', $rand_pages[0]->ID ), 'class' => 'unit size2of5' ),
					array('type' => array( 'post', array($rand_posts[0]->ID, $rand_posts[0]->ID) ), 'class' => 'unit size1of5' ),
					array('type' => array( 'post', array($rand_posts[0]->ID, $rand_posts[0]->ID) ), 'class' => 'unit size1of5' ),
					array('type' => array( 'widget', 'WP_Widget_Tag_Cloud',$instans='', $args='' ), 'page_id'=> 2, 'class' => 'unit size1of5' )
					
				),

				array(
					array('type' => array( 'page', $rand_pages[0]->ID ), 'class' => 'unit size1of5' ),
					array('type' => array( 'post', array($rand_posts[0]->ID, $rand_posts[0]->ID) ), 'class' => 'unit size1of5' ),
					array('type' => array( 'post', array($rand_posts[0]->ID, $rand_posts[0]->ID) ), 'class' => 'unit size1of5' ),
					array('type' => array( 'post', array( $rand_posts[0]->ID,$rand_posts[0]->ID, $rand_posts[0]->ID) ), 'class' => 'unit size1of5' ),
					array('type' => array( 'widget', 'WP_Widget_Tag_Cloud',$instans='', $args='' ), 'page_id'=> 2, 'class' => 'unit size1of5' )
					
				),

				array(
					array('type' => array( 'page', $rand_pages[0]->ID ), 'class' => 'unit size1of4' ),
					array('type' => array( 'post', array($rand_posts[0]->ID, $rand_posts[0]->ID) ), 'class' => 'unit size1of4' ),
					array('type' => array( 'post', array( $rand_posts[0]->ID,$rand_posts[0]->ID, $rand_posts[0]->ID) ), 'class' => 'unit size1of4' ),
					array('type' => array( 'widget', 'WP_Widget_Tag_Cloud',$instans='', $args='' ), 'page_id'=> 2, 'class' => 'unit size1of4' )
					
				),
				array(
					array('type' => array( 'page', $rand_pages[0]->ID ), 'class' => 'unit size1of2' ),
					array('type' => array( 'post', array($rand_posts[0]->ID, $rand_posts[0]->ID) ), 'class' => 'unit size1of4' ),
					array('type' => array( 'widget', 'WP_Widget_Tag_Cloud',$instans='', $args='' ), 'page_id'=> 2, 'class' => 'unit size1of4' )
					
				),
				array(
					array('type' => array( 'page', $rand_pages[0]->ID ), 'class' => 'unit size3of4' ),
					array('type' => array( 'widget', 'WP_Widget_Tag_Cloud',$instans='', $args='' ), 'page_id'=> 2, 'class' => 'unit size1of4' )
					
				),
				array(
					array('type' => array( 'page', $rand_pages[0]->ID ), 'class' => 'unit size1of3' ),
					array('type' => array( 'post', array($rand_posts[0]->ID) ), 'class' => 'unit size1of3' ),
					array('type' => array( 'widget', 'WP_Widget_Tag_Cloud',$instans='', $args='' ), 'page_id'=> 2, 'class' => 'unit size1of3' )
					
				),
				array(
					array('type' => array( 'page', $rand_pages[0]->ID ), 'class' => 'unit size2of3' ),
					array('type' => array( 'widget', 'WP_Widget_Tag_Cloud',$instans='', $args='' ), 'page_id'=> 2, 'class' => 'unit size1of3' )
					
				),
				array(
					array('type' => array( 'page', $rand_pages[0]->ID ), 'class' => 'unit size1of2' ),
					array('type' => array( 'widget', 'WP_Widget_Tag_Cloud',$instans='', $args='' ), 'page_id'=> 2, 'class' => 'unit size1of2' )
					
				),

				array(
					array('type' => array( 'widget', 'WP_Widget_Pages' ,$instans='', $args=''), 'class' => 'unit size1of5' ),
					array('type' => array( 'post', array( $rand_posts[0]->ID,$rand_posts[0]->ID, $rand_posts[0]->ID) ), 'class' => 'unit size2of5' ),
					array('type' => array( 'include', 'sidebar.php' ), 'class' => 'unit size2of5' ),
				),
			);
	
	
	
	}


			
// Template
			
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
		 

			
//////////////////////////////////////////////////////////	


			
			raindrops_poster( $page_lists );
			
			
			
/////////////////////////////////////////////////////////////

			while ( have_posts( ) ) { 
			
				the_post( );
?>
			<div class="entry page">
          		<div id="post-<?php the_ID( ); ?>" <?php raindrops_post_class( );?>>
<?php
				//raindrops_entry_title( ); 
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