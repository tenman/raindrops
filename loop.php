<?php
/**
 * Template for display loops.
 *
 * @package Raindrops
 * @since Raindrops 0.1
 */
 ?>
<?php
/**
 * Display navigation to next/previous pages when applicable
 */

	raindrops_next_prev_links();
  
	if(have_posts()){
		raindrops_loop_title();
		while (have_posts()){
				the_post();
		//default: sticky exists 2page when sticky post shown
		//The sticky post displays once where home top.
				$raindrops_add_class = array();
				
		if( is_sticky() ){
			$raindrops_add_class = array( 'raindrops-sticky' );
		} ?>
		<li>
		  <div id="post-<?php the_ID(); ?>" <?php post_class( $raindrops_add_class ); ?>>
<?php
/**
 * In category gallery
 *
 *
 *
 *
 */
		if( in_category( "gallery" )){     
			get_template_part('part','gallery');
/**
 * In category blog 
 *
 *
 *
 *
 */
		}elseif(in_category( "blog" )){	
			get_template_part('part','blog');
/**
 * Default loop
 *
 *
 *
 *
 */
		}else{ ?>
		
			<?php raindrops_entry_title(); ?>
	
			<div class="posted-on">
			  <?php raindrops_posted_on();?>
			</div>
			
			<div class="entry-content clearfix">
			<?php raindrops_prepend_entry_content();?>
			
			<?php raindrops_entry_content();?>
			
			<?php raindrops_append_entry_content();?>
			</div>
			<div class="entry-meta">
			  <?php		raindrops_posted_in();?>
			  <?php		edit_post_link( __( 'Edit', 'Raindrops' ), '<span class="edit-link">', '</span>' ); ?>
			  <?php		raindrops_delete_post_link( __( 'Trash', 'Raindrops' ), '<span class="edit-link">', '</span>' ); ?>
			</div>
		<?php } ?>
			<br class="clear" />
		  </div>
		</li>
		<?php	} //end while	?>
	</ul>
	
	<?php raindrops_next_prev_links( "nav-below" );
}//if have_posts
?>