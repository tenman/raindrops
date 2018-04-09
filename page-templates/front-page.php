<?php
/**
 * Template Name: Front Page Template
 *
 * @package Raindrops
 * @since Raindrops 0.940
 *
 * @uses get_header( $raindrops_document_type )	include template part file
 * @uses is_front_page( )	Check Conditional is home page or not
 * @uses is_active_sidebar( 'sidebar-3' )	include template part file
 * @uses dynamic_sidebar( 'sidebar-3' )	include template part file
 * @uses get_footer( $raindrops_document_type ) 
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
do_action( 'raindrops_' . basename( __FILE__ ) );
$raindrops_current_column = raindrops_column_controller();
if ( $raindrops_current_column !== false ) {
    add_filter( "raindrops_theme_settings__raindrops_indv_css", "raindrops_color_type_custom" );
}
get_header( 'front' );
do_action( 'raindrops_pre_' . basename( __FILE__ ) );
raindrops_debug_navitation( __FILE__ );
?>
<div id="yui-main">
<?php get_template_part( 'widget', 'sticky' ); ?>

	<?php
	/* page_on_front */
	/**
	 *  portfolio block
	 *
	 */
	$raindrops_portfolio_page	 = absint( get_query_var( 'page' ) );
	$raindrops_posts_per_page	 = 3;
	$raindrops_offset			 = 0;
	$args						 = array(
		'posts_per_page' => $raindrops_posts_per_page,
		'paged'			 => $raindrops_portfolio_page,
		'numberposts'	 => -1,
		'offset'		 => 0,
		'orderby'		 => 'post_date',
		'order'			 => 'DESC',
		'post_type'		 => 'post',
		'post_status'	 => 'publish',
		'category'       => '',// category ID comma sapalated values		
		'post__not_in'	 => get_option( 'sticky_posts' ), 
		'raindrops_tile_col' => $raindrops_posts_per_page,		
		);

	raindrops_tile( $args );
	
	$exclude_page	= absint( get_option( 'page_on_front' ) );

	$args			= array(
		'meta_key'		 => '_add-to-front',
		'meta_value'	 => 'add',
		'meta_compare'	 => '=',
		'post_type'		 => 'page',
		'post_status'	 => 'publish',
		'orderby'		 => 'menu_order',
		'nopaging'		 => true,
		'post__not_in'   => array( $exclude_page, ),
	);
		
	$raindrops_add_front_pages	 = get_posts( $args );

	if ( $raindrops_add_front_pages ) {
		// TABLE OF CONTENTS
		?>
		<ul class="raindrops-toc-front">
			<?php
			foreach ( $raindrops_add_front_pages as $key => $post ) {

				setup_postdata( $post );
				$raindrops_toc_count = $key + 1;

				the_title( '<li class="list-' . absint( $raindrops_toc_count ) . ' h2"><a href="#post-' . absint( get_the_ID() ) . '">', '</a></li>' );
			}
			wp_reset_postdata();
			?>
		</ul>

		<ul id="front-page-template-pages" class="index front-page-template-pages">	
			<?php	raindrops_prepend_loop();?>
			<?php
			foreach ( $raindrops_add_front_pages as $post ) {
				?><li>
					<div id="post-<?php the_ID(); ?>"<?php raindrops_the_article_wrapper_class(); ?>>
					<<?php raindrops_doctype_elements( 'div', 'article' ); ?>  <?php raindrops_post_class(); ?>><?php
				setup_postdata( $post );
				get_template_part( 'part', 'additional' );
				?></<?php raindrops_doctype_elements( 'div', 'article' ); ?>></div></li><?php
			}
			wp_reset_postdata();
			?>
		</ul>
		<?php
	}
	
	?>
</div>
<?php get_footer( $raindrops_document_type ); ?>