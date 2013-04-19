<?php
/**
 * Template Name: front portfolio Template
 *
 */
        get_header( $raindrops_document_type );

        $raindrops_current_column = raindrops_show_one_column( );

        if ( $raindrops_current_column !== false ) {
            add_filter( "raindrops_theme_settings__raindrops_indv_css", "raindrops_color_type_custom" );
        }

        raindrops_debug_navitation( __FILE__ );
/**
 *  Widget only home
 *
 */
        if ( is_front_page( ) and  is_active_sidebar( 'sidebar-3' ) ) {
            echo '<div class="topsidebar">'."\n".'<ul>';
            dynamic_sidebar( 'sidebar-3' );
            echo '</ul>'."\n".'</div>'."\n".'<br class="clear" />';
        }
?>
	<div class="portfolio-page-content" id="container">
<?php
/**
 *  portfolio entry content
 *
 */

		if( have_posts( ) ){
		
			while( have_posts( ) ){
			
				the_post( );
				
				the_content( );
			}
		}
?>
	</div>
<?php
/**
 *  Sticky Posts
 *
 */
		$raindrops_get_posts_args   = array( 'numberposts' => -1, 'post_status' => 'publish' );
		$raindrops_posts            = get_posts( $raindrops_get_posts_args );
?>
	<div class="stickies">
<?php
		foreach( $raindrops_posts as $post ){
            setup_postdata( $post );?>
		<?php if ( is_sticky( ) ) {?>
			<<?php raindrops_doctype_elements( 'div', 'article' );?> id="post-<?php the_ID( ); ?>" <?php raindrops_post_class( ); ?> >
	<?php
	
				the_title( '<h2 class="h2 entry-title">', '</h2>' );
	?>
			<div class="entry-content">
	<?php
				the_content( );  
	?>
				</div>
			</<?php raindrops_doctype_elements( 'div', 'article' );?>>
		<?php }// is_sticky( )?>
<?php 
		} ?>
	</div>
<?php
    wp_reset_postdata( );
/**
 *  portfolio block
 *
 */
    $args = array(
        'numberposts'     => '9',
        'offset'          => 0,
        'category'        => '',
        'orderby'         => 'post_date',
        'order'           => 'DESC',
        'include'         => '',
        'exclude'         => '',
        'meta_key'        => '',
        'meta_value'      => '',
        'post_type'       => 'post',
        'post_mime_type'  => '',
        'post_parent'     => '',
        'post_status'     => 'publish',
        'post__not_in' => get_option( 'sticky_posts' ) );

    $raindrops_posts = get_posts( $args );
    if( ! empty( $raindrops_posts ) ){
?>  <div id="yui-main" class="portfolio">
<?php
/**
 * Display navigation to next/previous pages when applicable
 */
    raindrops_next_prev_links( );
        raindrops_loop_title( );
        $raindrops_loop_number = 1;

 foreach( $raindrops_posts as $post ){
            setup_postdata( $post );
            $raindrops_loop_class   = raindrops_loop_class( $raindrops_loop_number );
            printf( '<li class="loop-%1$s%2$s">', $raindrops_loop_class[0], $raindrops_loop_class[1] );
            $raindrops_loop_number++;
?>
          <<?php raindrops_doctype_elements( 'div', 'article' );?> id="post-<?php the_ID( ); ?>" <?php raindrops_post_class( ); ?> <?php echo $raindrops_loop_class[2]; ?> >
		  
<?php 
		raindrops_entry_title( ); 
?>
            <div class="entry-content clearfix">
        <a href="<?php echo get_comments_link( );?>" class="raindrops-comment-link"><span class="raindrops-comment-string point"></span><em><?php esc_html_e( 'Comment', 'Raindrops' );?></em></a>
            </div>
            <div class="entry-meta">
              <?php     edit_post_link( esc_html__( 'Edit', 'Raindrops' ), '<span class="edit-link">', '</span>' ); ?>
              <?php     raindrops_delete_post_link( esc_html__( 'Trash', 'Raindrops' ), '<span class="edit-link">', '</span>' ); ?>
            </div>
            <br class="clear" />
          </<?php raindrops_doctype_elements( 'div', 'article' );?>>
        </li>
<?php }//foreach( $raindrops_posts as $post ) ?>
<?php raindrops_next_prev_links( "nav-below" );?>

    </ul><br class="clear" />
<?php
}//! empty( $raindrops_posts )
    wp_reset_postdata( );
?>
    </div>
</div>
<?php get_footer( $raindrops_document_type ); ?>