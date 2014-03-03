<?php
/**
 * Template Name: front portfolio Template
 *
 *
 * The posts contain featured image shows 9
 *
 */
		do_action( 'raindrops_'. basename(__FILE__) );

        get_header( $raindrops_document_type );
		do_action( 'raindrops_pre_'.basename( __FILE__) );

        $raindrops_current_column = raindrops_show_one_column( );

        if ( $raindrops_current_column !== false ) {
            add_filter( "raindrops_theme_settings__raindrops_indv_css", "raindrops_color_type_custom" );
        }

        raindrops_debug_navitation( __FILE__ );
		
		get_template_part( 'widget', 'sticky' );

/**
 *  Sticky Posts
 *
 */
		$raindrops_get_posts_args   = array( 'numberposts' => -1, 'post_status' => 'publish' );
		
		$raindrops_posts            = get_posts( $raindrops_get_posts_args );
?>
	<div class="stickies">
<?php
		foreach( $raindrops_posts as $post ) {
		
            setup_postdata( $post );
			
			if ( is_sticky( ) ) {
?>
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
<?php 		
			}// is_sticky( )
		} // foreach 
?>
	</div>
<?php
    	wp_reset_postdata( );
?>
	<div class="portfolio-page-content" id="container">
<?php
/**
 *  portfolio entry content
 *
 */
		if ( have_posts( ) ) {
		
			while( have_posts( ) ) {
			
				the_post( );
				
				the_content( );
				
				wp_link_pages();
			}
		}
?>
	</div>
<?php
	
/**
 *  portfolio block
 *
 */
 		$raindrops_portfolio_page		= get_query_var('page');
		$raindrops_posts_per_page		= 9;
		$raindrops_offset				= 0;
		$args = array(
			'posts_per_page'  => $raindrops_posts_per_page,
			'paged' 		  => $raindrops_portfolio_page,
			'numberposts'     => -1,
			'offset'          => 0,
			'orderby'         => 'post_date',
			'order'           => 'DESC',
			'post_type'       => 'post',
			'meta_key'        => '_thumbnail_id',
			'post_status'     => 'publish',
			'post__not_in'    => get_option( 'sticky_posts' ) );
			
		raindrops_tile( $args );
		?>	
</div>			
<?php
 get_footer( $raindrops_document_type ); ?>