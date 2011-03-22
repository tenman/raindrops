<?php
/**
 * sidebar-2 for our theme.
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
<?php		$myposts = get_posts('numberposts=10&offset=1');
			foreach($myposts as $post){?>
			
<li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
<?php 		} ?>
	</ul>
  </li>
<?php } ?>
</ul>
</div>
