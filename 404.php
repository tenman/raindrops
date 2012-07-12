<?php
/**
 *  The template for displaying 404 pages (Not Found).
 *
 *
 * @package Raindrops
 * @since Raindrop 0.1
 *
 * @uses raindrops_prepend_default_sidebar()
 * @uses raindrops_append_default_sidebar()
 */
?>
<?php get_header( $raindrops_document_type ); ?>
<?php if(WP_DEBUG == true){echo '<!--'.basename(__FILE__,'.php').'['.basename(dirname(__FILE__)).']-->';}?>
<div id="yui-main">
  <div class="yui-b">
     <div class="<?php echo raindrops_yui_class_modify();?>" id="container">
      <div class="yui-u first" <?php is_2col_raindrops('style="width:99%;"');?>>
        <h1 class="entry-title"><?php _e( 'Error 404 - Not Found', 'raindrops' ); ?></h1>
        <div id="post-0" class="post error404 not-found">
          <div class="entry-content">
          <p><?php _e( 'Apologies, but no results were found for the requested Archive. Perhaps searching will help find a related post.', 'Raindrops' ); ?></p>
            <?php get_search_form(); ?>
          </div>
        </div>
      </div>
      <div class="yui-u">
	  <?php raindrops_prepend_extra_sidebar( );?>
	  <?php if($rsidebar_show){get_sidebar('extra');} ?>
	  <?php raindrops_append_extra_sidebar();?>
	  </div>
    </div>
  </div>
</div>
<div class="yui-b">
<?php raindrops_prepend_default_sidebar();?>	
      <?php get_sidebar('default'); ?>
<?php raindrops_append_default_sidebar();?>
</div>
</div>
<?php get_footer( $raindrops_document_type ); ?>