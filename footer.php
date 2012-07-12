<?php
/**
 * The template part file for footer.
 *
 *
 * @package Raindrops
 * @since Raindrops 0.1
 *
 * @uses wp_upload_dir() 
 * @uses raindrops_upload_image_parser($footer_image_uri,'inline','#ft')
 * @uses is_active_sidebar( 'sidebar-4' )
 * @uses get_bloginfo('name')
 * @uses get_bloginfo('rss2_url')
 * @uses ucwords()
 * @uses get_current_theme()
 * @uses wp_footer()
 * @uses raindrops_prepend_footer()
 * @uses raindrops_append_footer()
 * @uses raindrops_append_doc()
 */
?>
<div id="ft" class="clear">
<?php raindrops_prepend_footer();?>
<!--footer-widget start-->
<div class="widget-wrapper clearfix">
<?php if ( is_active_sidebar( 'sidebar-4' ) ) {?>
    <ul><?php dynamic_sidebar('sidebar-4');?></ul>
<?php } ?>
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
<?php raindrops_append_footer();?>
  </div>
<?php raindrops_append_doc();?>
</div>
<?php wp_footer(); ?>
</body>
</html>