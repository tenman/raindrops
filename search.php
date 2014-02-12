<?php
/**
 * Template for search .
 *
 *
 * @package Raindrops
 * @since Raindrops 0.1
 *
 * @uses raindrops_prepend_default_sidebar( )
 * @uses raindrops_append_default_sidebar( )
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }
do_action( 'raindrops_'. basename(__FILE__) );
get_header( $raindrops_document_type );
do_action( 'raindrops_pre_'.basename( __FILE__) );
?>
<div id="yui-main">
  <?php raindrops_debug_navitation( __FILE__ ); ?>
  <div class="yui-b">
    <div class="<?php echo raindrops_yui_class_modify( );?>" id="container">
		<div class="yui-u first<?php raindrops_add_class( 'yui-u first', true );?>" <?php raindrops_doctype_elements( '', 'role="main"' );?>>
		
<?php if ( have_posts( ) ) { ?>
		
		<h1 class="pagetitle h1">Search Results : <?php the_search_query( ); ?></h1>
		<ul class="search-results">
		<li>
<?php 
		raindrops_next_prev_links( );
?>
		</li>
<?php 	
		while ( have_posts( ) ) {
 
					the_post( ); 
?>
		<li>
		<div id="post-<?php the_ID( ); ?>" <?php raindrops_post_class( ); ?> >
<?php 
			raindrops_entry_title( );
?>
		<div class="posted-on">
<?php
			raindrops_posted_on( );
?>
		</div>
		<div class="entry-content clearfix">
		
<?php 		
			raindrops_prepend_entry_content( );
			
			raindrops_entry_content( );
			
?>
			<br class="clear" />
<?php 
			
			raindrops_append_entry_content( );
?>
		</div>
		<div class="entry-meta">
<?php 		
			raindrops_posted_in( );
			
			edit_post_link(  esc_html__( 'Edit', 'Raindrops' ). raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );
			
			raindrops_delete_post_link(  esc_html__( 'Trash', 'Raindrops' ). raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );
?>
		</div>
		<br class="clear" />
		</div>
		</li>
		
<?php 	}//while ( have_posts( ) )	?>

        <li>
<?php
			raindrops_next_prev_links( "nav-below" );
?>
        </li>
        </ul>
<?php } else { ?>
        <div class="fail-search">
          <h2 class="center h2">
<?php 
			 esc_html_e( "Nothing was found though it was regrettable. Please change the key word if it is good, and retrieve it.","Raindrops" );
?>
          </h2>
          <?php get_search_form( ); ?>
        </div>
<?php } ?>
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