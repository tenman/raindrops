<?php
/**
 * Template file index
 *
 * @package Raindrops
 * @since Raindrops 0.940
 *
 * @uses get_header("xhtml1")	include template part file
 * @uses is_home()	Check Conditional is home page or not
 * @uses is_active_sidebar('sidebar-3')	include template part file
 * @uses dynamic_sidebar('sidebar-3')	include template part file
 * @uses raindrops_yui_class_modify()	add class attribute value
 * @uses is_2col_raindrops('style="width:99%;"')	add inline style attribute
 * @uses get_template_part( 'loop', 'default' )	include template part file
 * @uses get_sidebar('extra')	include template part file
 * @uses get_sidebar('default')	include template part file
 * @uses get_footer() 
 */
get_header("xhtml1");?>
<?php if(WP_DEBUG == true){echo '<!--'.basename(__FILE__,'.php').'['.basename(dirname(__FILE__)).']-->';}?>
<div id="yui-main">
  <div class="yui-b">
    <?php
/**
 *  Widget only home
 *
 */
    if ( is_home() and  is_active_sidebar('sidebar-3') ) {
        echo '<div class="topsidebar">'."\n".'<ul>';
        dynamic_sidebar('sidebar-3');
        echo '</ul>'."\n".'</div>'."\n".'<br class="clear" />';
    } ?>

    <div class="<?php echo raindrops_yui_class_modify();?>" id="container">
      <div class="yui-u first" <?php is_2col_raindrops('style="width:99%;"');?>>
        <?php get_template_part( 'loop', 'default' );?>
        <br style="clear:both" />
      </div>
      <div class="yui-u"><?php if($rsidebar_show){get_sidebar('extra');} ?></div>
      <?php //add nest grid here?>
    </div>
  </div>
</div>
<div class="yui-b"> <?php get_sidebar('default'); ?></div>
</div>
<?php get_footer(); ?>