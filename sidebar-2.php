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
          <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(2) ) : else : ?>


          <li>
            <h2 class="h2">Recent Post</h2>
            <ul>
              <?php
$myposts = get_posts('numberposts=10&offset=1');
foreach($myposts as $post) :
?>
              <li><a href="<?php the_permalink(); ?>">
                <?php the_title();
?>
                </a></li>
              <?php endforeach; ?>
            </ul>
          </li>
          <?php endif; ?>
        </ul>
      </div>
