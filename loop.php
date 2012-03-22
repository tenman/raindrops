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
	if ( $wp_query->max_num_pages > 1 ){ ?>
<div id="nav-above" class="clearfix"> <span class="nav-previous">
<?php       next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'Raindrops' ) ); ?></span><span class="nav-next">
<?php       previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'Raindrops' ) ); ?></span></div>
<?php }?>

<?php   
	if(have_posts()){
		raindrops_loop_title();
		while (have_posts()){
				the_post();?>
		<li>
		  <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
			<h2 class="h2 entry-title">
			  <?php
					if( has_post_thumbnail($post->ID)){
						echo '<span class="h2-thumb">';
						the_post_thumbnail(array(48,48),array("style"=>"vertical-align:text-bottom;"));
						echo '</span>';
					}?>
			  <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_attr__( 'Permalink to %s', 'Raindrops' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h2>
			<div class="posted-on">
			  <?php raindrops_posted_on();?>
			</div>
			<div class="entry-content clearfix">
			  <?php
					if(RAINDROPS_USE_LIST_EXCERPT == true){
						the_excerpt();
					}else{
	the_content( __( 'Continue&nbsp;reading&nbsp;<span class="meta-nav">&rarr;</span>', 'Raindrops' ) );
					}?>
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
	
<?php       if ( $wp_query->max_num_pages > 1 ){ ?>
<div id="nav-below" class="clearfix"> <span class="nav-previous">
	  <?php		next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'Raindrops' ) ); ?></span><span class="nav-next">
	  <?php		previous_posts_link( __( '<span>Newer posts <span class="meta-nav">&rarr;</span></span>', 'Raindrops' ) ); ?>
	  </span></div>
	<?php 	}
}//if have_posts
?>