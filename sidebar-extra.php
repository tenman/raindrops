<?php
/**
 * Template for extra sidebar.
 *
 *
 * @package WordPress
 * @subpackage Raindrops
 * @since Raindrops 0.1
 */
?>
<div class="rsidebar">
<ul>
<?php if (!dynamic_sidebar('sidebar-2')){ ?>
  <li><h2 class="h2"><?php _e('Recent Post', 'Raindrops');?></h2>
    <ul>
<?php       
		$raindrops_get_posts    = get_posts('numberposts=10&offset=1');
		foreach($raindrops_get_posts as $post){
			setup_postdata($post); ?>
<li <?php if ( $post->ID == $wp_query->post->ID ) { echo ' class="current-post"'; } ?>><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></li>
<?php   } ?>
    </ul>
  </li>
<?php } ?>
</ul>
</div>
