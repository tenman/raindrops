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
  <address>
<?php printf('<small>&copy;%s %s <a href="%s">%s</a> and <a href="%s">%s</a></small>&nbsp;',date("Y"),get_bloginfo('name'),get_bloginfo('rss2_url') ,__("Entries (RSS)","Raindrops"),get_bloginfo('comments_rss2_url'),__('Comments (RSS)',"Raindrops"));

printf('&nbsp;<small><a href="%s">%s</a></small>&nbsp;&nbsp;','http://www.tenman.info/wp3/raindrops',__("Raindrops Theme","Raindrops"));

?>
    </address>

<?php wp_footer(); ?>

  </div>
 </div>
</body>
</html>
