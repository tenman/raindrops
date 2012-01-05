<?php
/**
 * The template for footer.
 *
 *
 * @package Raindrops
 * @since Raindrops 0.1
 */
?>
<?php
$uploads = wp_upload_dir();
$footer_image_uri = $uploads['url'].'/'.raindrops_warehouse('raindrops_footer_image');
?>
<div id="ft" style="<?php echo raindrops_upload_image_parser($footer_image_uri,'inline','#ft'); ?>">
<!--footer-widget start-->
<div class="widget-wrapper clearfix">
  <ul>
    <?php if ( !dynamic_sidebar('sidebar-4') ){ ?>
    <li class="hide">
      <div>dinamic_sidebar 4 none</div>
    </li>
    <?php } ?>
  </ul>
  <br class="clear" />
</div>
<!--footer-widget end-->
<address>
<?php
printf(
'<small>&copy;%s %s <a href="%s" class="entry-rss">%s</a> and <a href="%s" class="comments-rss">%s</a></small>&nbsp;',
date("Y"),
get_bloginfo('name'),
get_bloginfo('rss2_url') ,
__("Entries <span>(RSS)</span>","Raindrops"),
get_bloginfo('comments_rss2_url'),
__('Comments <span>(RSS)</span>',"Raindrops")
);
if( is_child_theme() ){
    $raindrops_theme_name = 'Child theme '.ucwords(get_current_theme()).' of '.__("Raindrops Theme","Raindrops");
}else{
    $raindrops_theme_name = __("Raindrops Theme","Raindrops");
}
printf(
'&nbsp;<small><a href="%s">%s</a></small>&nbsp;&nbsp;',
'http://www.tenman.info/wp3/raindrops',
$raindrops_theme_name
);
?>
</address>
</div>
</div>
<?php wp_footer(); ?>
</body>
</html>