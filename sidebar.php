<?php
/**
* Template part file for Sidebar.
*
*
* @package Raindrops
*/
?>
<div class="sidebar">
<ul>
<?php if (!dynamic_sidebar('sidebar-1')){ ?>
<?php wp_list_pages('title_li=<h2 class="h2">'. __( 'Pages', 'Raindrops').'</h2>' ); ?>
<li><h2 class="h2"><?php _e( 'Archives', 'Raindrops' ); ?></h2>
  <ul>
    <?php wp_get_archives('type=monthly'); ?>
  </ul>
</li>
<?php wp_list_categories('show_count=1&title_li=<h2 class="h2">'. __( 'Categories', 'Raindrops'). '</h2>'); ?>
<?php /* If this is the frontpage */ if ( is_front_page() || is_page() ) { ?>
<?php wp_list_bookmarks(); ?>
<li>
  <h2 class="h2">Meta<?php _e( 'Meta', 'Raindrops' ); ?></h2>
  <ul>
    <?php wp_register(); ?>
    <li>
      <?php wp_loginout(); ?>
    </li>
    <?php wp_meta(); ?>
  </ul>
</li>
<?php } ?>
<?php } ?>
</ul>
</div>
