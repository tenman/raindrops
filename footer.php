<?php
/**
 * footer for our theme.
 *
 *
 * @package WordPress
 * @subpackage Raindrops
 * @since Raindrops 0.1
 */
?>
   <div id="ft">
      <!--footer-widget start-->
    <div class="widget-wrapper clearfix">
      <ul>
        <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(4) ) : else : ?>
        <li>
          <div style="display:none;">dinamic_sidebar 4 none</div>
        </li>
        <?php endif; ?>
      </ul>
	  <br style="clear:both;" />
    </div>
    <!--footer-widget end-->
  <address><small>&copy;<?php date("Y");?><?php bloginfo('name'); ?>    <a href="<?php bloginfo('rss2_url'); ?>">Entries (RSS)</a> and <a href="<?php bloginfo('comments_rss2_url'); ?>">Comments (RSS)</a></small>&nbsp;&nbsp;<small><a href="http://www.tenman.info/wp3/raindrops">Raindrops Theme</a></small>&nbsp;&nbsp;
    <!-- <?php echo get_num_queries(); ?> queries. <?php timer_stop(1); ?> seconds. -->
    <?php wp_footer(); ?>
	</address>
  </div>
 </div>
</body>
</html>
