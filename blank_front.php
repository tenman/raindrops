<?php
/**
 * Template Name: brank front
 *
 *
 *
 * @package Raindrops
 * @since Raindrops 0.959
 *
 *
 */
/**
 * When you display the Sticky post, $show_sticky_post set value true.
 *
 *
 *
 */
		$show_sticky_post 			= false;
		
		$raindrops_sticky_post_args = array( 'posts_per_page' => 3,
												'post__in'  => get_option( 'sticky_posts' ),
												//'ignore_sticky_posts' => 1
											);
/**
 * When you display links list of the Recent Posts , please delete comment out of add_action( ).
 *
 *
 *
 */
//position
//add_action('raindrops_append_entry_content','raindrops_recent_posts' );
//config
		$raindrops_recent_posts_setting= array( 'title'=> esc_html__( 'Recent posts', 'Raindrops' ),
												'numberposts'=> 5   //show count
												);

/**
 * When you display the category contain post list , please delete comment out of add_action( ).
 *
 *
 *
 *
 */
//position
//add_action('raindrops_append_entry_content','raindrops_category_posts' );
//config
		$raindrops_category_posts_setting= array( 'title'=> esc_html__( 'Categories', 'Raindrops' ) ,
													'numberposts' => 5 ,    //show count
													'category'=> 0 ,//category id
													'orderby'=> 'post_date',
													'order'=> 'DESC'
												);
/**
 *　When you display the tagged entry list , please delete comment out of add_action( ).
 *
 *
 *
 *
 */
//position
//add_action('raindrops_append_entry_content','raindrops_tag_posts' );
//config
		$raindrops_tag_posts_setting = array('title'=> esc_html__( 'Tags', 'Raindrops' ),
                                    'numberposts'=> 5 ,     //show count
                                    'tax_query'=> array(
                                                array(
                                                    'taxonomy'=>'post_tag',
                                                    'terms'=> array( 'post-formats' ) ,//tag slug
                                                    'field'=>'slug',
                                                    'operator'=>'IN'
                                                    ),
                                                'relation'=> 'AND'
                                                )
                                    );
/**
 * Display or not Site title
 *
 * value y then show other hide.
 *
 *
 */
		$raindrops_display_title                    = 'y';
/**
 * Display or not Site description
 *
 * value y then show other hide.
 *
 *
 */
		$raindrops_display_description              = 'y';

/**
 * Display or not Site header image
 *
 * value y then show other hide.
 *
 *
 */
		$raindrops_display_header_image             = 'y';
/**
 * Display or not horizontal navigation
 *
 * value y then show other hide.
 *
 *
 */
		$raindrops_display_nav_menus                = 'y';

/**
 * Display or not widget
 *
 * value y then show other hide.
 */
		$raindrops_display_widget                   = 'y';

/**
 * Add your html , line:211 $custom_text_extra_sidebar
 *
 * value y then show other hide.
 *
 */
		$raindrops_add_custom_text_extra_sidebar    = '';
/**
 * Add your html , line:194 $custom_text_default_sidebar
 *
 * value y then show other hide.
 *
 */
		$raindrops_add_custom_text_default_sidebar  = '';

/**
 * When you not need left margin ( blank default sidebar width ).
 *
 * value y then show other hide.
 *
 */
		$raindrops_remove_left_margin               = '';

/**
 * When you not need right margin ( blank extra sidebar width ).
 *
 * value y then show other hide.
 *
 */

		$raindrops_remove_right_margin              = '';
/**
 * Display or not page title
 * value y then show other hide.
 *
 */
		$raindrops_display_page_title               = 'y';

		$raindrops_display_page_content             = 'y';
/**
 * custom_text_default_sidebar
 *
 *
 *
 */

		$custom_text_default_sidebar = <<<SUBSTITUTION_CONTENT

<h2>hello world</h2>



SUBSTITUTION_CONTENT;

/**
 * substitution extra sidebar content
 *
 */

		$custom_text_extra_sidebar = <<<SUBSTITUTION_EXTRA_SIDEBAR

<h2>hello world</h2>



SUBSTITUTION_EXTRA_SIDEBAR;



////////////////////////////////Functions and filters//////////////////////////////////////////////

		if ( $raindrops_display_title !== 'y' ) {
		
			add_filter( 'raindrops_site_title', '__return_null' );
		}
		
		if ( $raindrops_display_description !== 'y' ) {
		
			add_filter( 'raindrops_site_description', '__return_null' );
			
			add_filter( 'raindrops_header_image_elements' , 'raindrops_remove_header_text' );
		}
	
		function raindrops_remove_header_text( $content ){
		
			return preg_replace( '!<p[^>]*>(.*)</p>!siu', '', $content );
		}
		
		if ( $raindrops_display_header_image !== 'y' ) {
		
			add_filter( 'raindrops_header_image_elements', '__return_null' );
			add_filter( 'raindrops_header_image_home_url', '__return_null' );

		}
		
		if ( $raindrops_display_nav_menus !== 'y' ) {
		
			if ( has_nav_menu( 'primary' ) ) {
			
				add_filter( 'wp_nav_menu', '__return_null' );
			} else {
			
				add_filter( 'wp_page_menu_args', '__return_empty_array' );
			}
		}
		
		if( $raindrops_display_page_content !== 'y' ){
		
				add_filter( 'raindrops_entry_content', '__return_null' );
		}

        add_filter( 'raindrops_posted_in', '__return_null' );
		
        add_filter( 'raindrops_posted_on', '__return_null' );

		/*
		if ( $raindrops_display_wp_link_pages !== 'y' ) {
			add_filter( 'wp_link_pages_args', 'raindrops_wp_link_pages_filter' );
		}
		*/
		
		function raindrops_wp_link_pages_filter( $args ) {
		
			$args['echo'] = false;
			
			return $args;
		}
		
		if( $raindrops_display_widget          !== 'y' ){
		
			add_filter( 'dynamic_sidebar', '__return_empty_array' );
			
			add_filter( 'raindrops_sidebar_menus', '__return_null' );
		}
		
		if( $raindrops_add_custom_text_default_sidebar   == 'y' ){
		
			add_action( 'raindrops_prepend_default_sidebar', 'raindrops_prepend_default_sidebar_filter' );
		}

		if( $raindrops_add_custom_text_extra_sidebar   == 'y' ){
		
			add_action( 'raindrops_prepend_extra_sidebar', 'raindrops_prepend_default_sidebar_filter' );
		}

		function raindrops_prepend_default_sidebar_filter( ){
		
			global $custom_text_default_sidebar;
			
			echo $custom_text_default_sidebar;
		}
		
		function raindrops_prepend_extra_sidebar_filter( ){
		
			global $custom_text_extra_sidebar;
			
			echo $custom_text_extra_sidebar;
		}

		if( $raindrops_display_page_title !== 'y' ){
		
			add_filter( 'raindrops_entry_title',  '__return_null' );
		
		}

		if( $raindrops_remove_left_margin !== 'y' or $raindrops_add_custom_text_default_sidebar == 'y' ){
		
			$raindrops_devide_column_class= 'yui-b';
		}else{
		
			$raindrops_devide_column_class= '';
		}

		if( $raindrops_remove_left_margin !== 'y' or $raindrops_add_custom_text_extra_sidebar == 'y' ){
		
			$raindrops_devide_column_extra_class= 'yui-u';
		}else{
		
			$raindrops_devide_column_extra_class= '';
		}
		
////////////////////////////////Template ////////////////////////////////

		get_header( $raindrops_document_type );
		do_action( 'raindrops_pre_'.basename( __FILE__) );

		raindrops_debug_navitation( __FILE__ ); 
?>
	<div id="yui-main">
		<div class="<?php echo $raindrops_devide_column_class;?>">
<?php
/**
 *  Widget only home
 *
 */
		if ( is_home( ) and  is_active_sidebar( 'sidebar-3' ) ) {
			echo '<div class="topsidebar">'."\n".'<ul>';
			dynamic_sidebar( 'sidebar-3' );
			echo '</ul>'."\n".'</div>'."\n".'<br class="clear" />';
		}
?>
			<div class="<?php echo raindrops_yui_class_modify( );?>" id="container">
				<div class="<?php echo $raindrops_devide_column_extra_class; ?> first" <?php 
				
				is_2col_raindrops( 'style="width:99%;"' );
				
				if( $raindrops_devide_column_extra_class !== 'yui-u' ){
					echo 'style="width:99%;"';
				}?> >
				
<?php 
		if( $show_sticky_post == true ){ 
?>
      				<div>
						<ul class="raindrops-sticky-posts">
<?php
/**
 *  Sticky post
 *
 */
			$the_query = new WP_Query( $raindrops_sticky_post_args );
	
			while ( $the_query->have_posts( ) ){ $the_query->the_post( );
	
					$html = '<div id="post-%1$s" class="%2$s">';
	
					printf( $html,
							get_the_ID( ),
							join( ' ', get_post_class( ) )
							);
	
					$html = '<h2 class="%1$s"><a href="%2$s">%3$s</a></h2>';
	
					printf( $html,
							'entry-title h2',
							get_permalink( ),
							the_title( '', '', false )
							);
	
					$html = '<div class="%1$s">';
					printf( $html, 'entry-content clearfix' );
	
					$raindrops_excerpt_condition = raindrops_detect_excerpt_condition();
					
					if ( $raindrops_excerpt_condition == true ) {
						the_excerpt( );
					} else {
						the_content( esc_html__( 'Continue&nbsp;reading', 'Raindrops' ). ' <span class="meta-nav">&rarr;</span>' );
					}
	
					print( '</div>' );
	
			}   //end while
					wp_reset_postdata( ); 
?>
						</ul>
      				</div>
<?php 
		}    //endif( $show_sticky_post == true ) 

		 get_template_part( 'loop', 'default' );
?>
        			<br style="clear:both" />
      			</div>
<?php 
		if( $raindrops_devide_column_extra_class == 'yui-u' ){
?>
      			<div class="yui-u">
<?php 
			raindrops_prepend_extra_sidebar( );
		  
			if ( $rsidebar_show ) {
			
				get_sidebar( 'extra' );
			
			}
		
			raindrops_append_extra_sidebar( );
?>
      			</div>
<?php 
	 	}//if( $raindrops_devide_column_class == 'yui-u' )
	
	 //add nest grid here 
?>
			</div>
		</div>
	</div>
<?php 
		if( $raindrops_devide_column_class == 'yui-b' ){
?>
	<div class="yui-b">
<?php
			raindrops_prepend_default_sidebar( );
			
			get_sidebar( 'default' );
			
			raindrops_append_default_sidebar( );
?>
	</div>
<?php
		}//if( $raindrops_devide_column_class == 'yui-b' ) 
?>
</div>
<?php get_footer( $raindrops_document_type ); ?>