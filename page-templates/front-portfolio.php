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
/**
 *  Widget only home
 *
 */
        if ( is_front_page( ) && is_active_sidebar( 'sidebar-3' ) ) {
		
            echo '<div class="topsidebar">'."\n".'<ul>';
            dynamic_sidebar( 'sidebar-3' );
            echo '</ul>'."\n".'</div>'."\n".'<br class="clear" />';
        }
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
		$raindrops_posts_per_page		= 9;
		$raindrops_offset				= 0;
		$raindrops_portfolio_page		= get_query_var('page');
	
		if ( $raindrops_portfolio_page > 0 ) {
		
			$raindrops_offset 			= $raindrops_portfolio_page * $raindrops_posts_per_page;
			//$raindrops_offset_b			= $raindrops_portfolio_page * ( $raindrops_posts_per_page - 1 );
		} else {
		
			$raindrops_offset			= 0;
			//$raindrops_offset_b			= 0;
		}

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
	
		$raindrops_posts = get_posts( $args );		
		
		$raindrops_html 		= '<li><a href="%1$s?page=%2$s" class="%3$s"><span class="%4$s">%5$s</span></a></li>';
		$raindrops_html_page	= '<li><a href="%1$s" class="%2$s"><span class="%3$st">%4$s</span></a></li>';
		
		global $query_string;
		
		if ( ! empty( $query_string ) && preg_match( '!(pagename|page_id)!',$query_string ,$regs) ) {
		
			$raindrops_q = strstr( $query_string, $regs[1].'=' );
			
			list( $raindrops_key, $raindrops_val ) = explode( '=', $raindrops_q );
			
			$url = add_query_arg( $raindrops_key, $raindrops_val, home_url() );

		} else {
		
			$url = home_url();
		}
	
    	if ( ! empty( $raindrops_posts ) ) {
?>  
	<div id="yui-main" class="portfolio">
<?php
/**
 * Display navigation to next/previous pages when applicable
 */
			raindrops_loop_title( );
			
			$raindrops_loop_number = 1;
	
			foreach( $raindrops_posts as $post ) {
			
				setup_postdata( $post );
				
				$raindrops_loop_class   = raindrops_loop_class( $raindrops_loop_number );
				
				printf( '<li class="loop-%1$s%2$s">', trim( $raindrops_loop_class[0] ), trim( $raindrops_loop_class[1] ) );
				
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
<?php
			edit_post_link( esc_html__( 'Edit', 'Raindrops' ). raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );
			
			raindrops_delete_post_link( esc_html__( 'Trash', 'Raindrops' ). raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );
?>
				</div>
				<br class="clear" />
			  </<?php raindrops_doctype_elements( 'div', 'article' );?>>
			</li>
<?php
			}//foreach( $raindrops_posts as $post ) 
?>

		</ul>
		<br class="clear" />
<?php
			$html = '';

			

					
			if ( 0 == $raindrops_portfolio_page ) {
			
				if ( is_front_page() ) {
				
					$html	= '<li><a href="'.home_url().'?page=2" title="page 2" class="portfolio-page2">'.esc_html__( 'Page' , 'Raindrops' ).'2</a></li>';
				} else {
		

					$url	= add_query_arg( 'page', 2, $url );
					$html	= '<li><a href="'.esc_url( $url ).'" title="page 2" class="portfolio-page2">'.esc_html__( 'Page' , 'Raindrops' ).'2</a></li>';

				}
			
			} elseif ( $raindrops_portfolio_page > 0 ) {
		
					$page = $raindrops_portfolio_page + 1;
				
					$url = add_query_arg( 'page', $page, $url );
					
					$html = sprintf( $raindrops_html_page,
									esc_url( $url),
									'portfolio-next portfolio-'.$page,
									'portfolio-nav-next',
									esc_html__( 'Page' , 'Raindrops' ).' '. $page
								);
					

			}

			if ( $raindrops_portfolio_page > 0 ) {
					$url = add_query_arg( 'page', $raindrops_portfolio_page, $url );

					$html .= sprintf( $raindrops_html_page,
									esc_url( $url),
									'portfolio-current current-'. $raindrops_portfolio_page,
									'portfolio-nav-current',
									esc_html__( 'Now Page' , 'Raindrops' ).' '. $raindrops_portfolio_page
								);
			}
	
			if ( 2 == $raindrops_portfolio_page ) {
			
					$url = remove_query_arg( 'page', $url );
				
					$html .= sprintf( $raindrops_html_page,
									esc_url( $url ),
									'portfolio-prev portfolio-home',
									'portfolio-nav-prev',
									__('Portfolio Home', 'Raindrops') 
								);		
			
			}elseif ( $raindrops_portfolio_page > 2 ) {
		
				$page = $raindrops_portfolio_page;
				$page = $page -1;
				$url = add_query_arg( 'page', $page, $url );
				$html .= sprintf( $raindrops_html_page,
								esc_url( $url ),
								'portfolio-prev portfolio-'.$page,
								'portfolio-nav-prev',
								esc_html__( 'Page' , 'Raindrops' ).' '. $page
							);
			}
			
			printf( '<div class="portfolio-nav"><ul>%1$s</ul></div>', $html );

		} else { //! empty( $raindrops_posts )
		
?>
			  <<?php raindrops_doctype_elements( 'div', 'article' );?> id="post-<?php the_ID( ); ?>" <?php raindrops_post_class( 'no-portfolio' ); ?> >
<?php
	
					$url = remove_query_arg( 'page', $url );
					$raindrops_html_page = '<p style="text-align:center;"><a href="%1$s" class="%2$s" ><span class="%3$st">%4$s</span></a></p>';

			if ( preg_match( '!page=!', $query_string ) ) {	
?>		
		<h3 style="text-align:center" class="h1">End</h3>
				
<?php					
					printf( $raindrops_html_page,
									esc_url( $url ),
									'portfolio-home',
									'portfolio-home-text',
									__('Portfolio Home', 'Raindrops') 
								);
			}		
					printf( $raindrops_html_page,
									home_url(),
									'portfolio blog-home-link',
									'portfolio-nav',
									get_bloginfo() 
								);		
?>
			  </<?php raindrops_doctype_elements( 'div', 'article' );?>>
<?php
		}
		wp_reset_postdata( );
?>
    	</div>
	</div>
<?php get_footer( $raindrops_document_type ); ?>