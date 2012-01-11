<?php
/**
 * Template part file for extra sidebar.
 *
 *
 * @package Raindrops
 * @since Raindrops 0.1
 */
?>
<div class="rsidebar">
<ul>
<?php if (!dynamic_sidebar('sidebar-2')){ ?>
  <li><h2 class="h2"><?php _e('Recent Post', 'Raindrops');?></h2>
    <ul>
<?php
	$raindrops_get_posts    = get_posts('numberposts=0&offset=1');
	if(isset($raindrops_get_posts)){
		foreach($raindrops_get_posts as $post){
			setup_postdata($post); ?>
<li <?php if (!empty($wp_query->posts) and $post->ID == $wp_query->post->ID ) { echo ' class="current-post"'; } ?>><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></li>
<?php   } 
	}?>
    </ul>
  </li>
<?php } ?>
</ul>
</div>
