<?php
/**
 * sidebar-1 for our theme.
 *
 *
 * @package WordPress
 * @subpackage Raindrops
 * @since Raindrops 0.1
 */
?>
				<div class="lsidebar">
				  <ul>
					<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(1) ) : else : ?>
					
					<?php wp_list_pages('title_li=<h2 class="h2">Pages</h2>' ); ?>
					<li>
					  <h2 class="h2">Archives</h2>
					  <ul>
						<?php wp_get_archives('type=monthly'); ?>
					  </ul>
					</li>
					<?php wp_list_categories('show_count=1&title_li=<h2 class="h2">Categories</h2>'); ?>
					<?php /* If this is the frontpage */ if ( is_home() || is_page() ) { ?>
					<?php wp_list_bookmarks(); ?>
					<li>
					  <h2 class="h2">Meta</h2>
					  <ul>
						<?php wp_register(); ?>
						<li>
						  <?php wp_loginout(); ?>
						</li>


						<?php wp_meta(); ?>
					  </ul>
					</li>
					<?php } ?>
					<?php endif; ?>
				  </ul>
			   </div>	 
