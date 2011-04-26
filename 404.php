<?php
/**
 *  The template for displaying 404 pages (Not Found).
 *
 *
 * @package WordPress
 * @subpackage Raindrops
 * @since Raindrop 0.1
 */
?>
<?php get_header("xhtml1"); ?>
<?php if(WP_DEBUG == true){echo '<!--'.basename(__FILE__,'.php').'['.basename(dirname(__FILE__)).']-->';}?>
<div id="yui-main">
  <div class="yui-b">
     <div class="<?php echo raindrops_yui_class_modify();?>" id="container">
      <div class="yui-u first" <?php is_2col_raindrops('style="width:99%;"');?>>
        <h1 class="entry-title"><?php _e( 'Not Found', 'raindrops' ); ?></h1>
        <div id="post-0" class="post error404 not-found">
          <div class="entry-content">
          <p><?php _e( 'Apologies, but no results were found for the requested Archive. Perhaps searching will help find a related post.', 'Raindrops' ); ?></p>
            <?php get_search_form(); ?>
          </div>
        </div>
      </div>
      <div class="yui-u"><?php if($rsidebar_show){get_sidebar('extra');} ?></div>
    </div>
  </div>
</div>
<div class="yui-b"><?php get_sidebar('default'); ?></div>
</div>
<?php get_footer(); ?>