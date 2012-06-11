<?php
/**
 * Template for display image.
 *
 *
 * @package Raindrops
 * @since Raindrops 0.1
 *
 * @uses get_header()
 * @uses raindrops_yui_class_modify()
 * @uses is_2col_raindrops('style="width:99%;"')
 * @uses have_posts()
 * @uses have_posts()
 * @uses the_post()
 * @uses the_ID()
 * @uses post_class()
 * @uses the_title()
 * @uses get_permalink($post->post_parent)
 * @uses get_the_title($post->post_parent)
 * @uses get_post_meta($post->ID, 'image', true) 
 * @uses wp_get_attachment_image_src($image, 'full')
 * @uses the_title_attribute()
 * @uses  
 */
?>
<?php get_header( $raindrops_document_type ); ?>
<div id="yui-main">
<?php if(WP_DEBUG == true){echo '<!--'.basename(__FILE__,'.php').'['.basename(dirname(__FILE__)).']-->';}?>
  <div class="yui-b">
    <div class="<?php echo raindrops_yui_class_modify();?>" id="container">
      <div class="yui-u first" <?php is_2col_raindrops('style="width:99%;"');?>>
        <?php if (have_posts()){ while (have_posts()){ the_post(); ?>
        <div id="post-<?php the_ID(); ?>"  <?php post_class(); ?>>
          <div class="entry attachment raindrops-image-page">
            <h2 class="image-title h2"><?php the_title(); ?></h2>
            <p class="parent-entry"><?php _e("Entry : ",'Raindrops');?>
              <a href="<?php echo get_permalink($post->post_parent); ?>" rev="attachment"><?php echo get_the_title($post->post_parent); ?></a>
            </p>
            <?php $image = get_post_meta($post->ID, 'image', true); ?>
            <?php $image = wp_get_attachment_image_src($image, 'full'); ?>
            <p class="image"><a href="<?php echo $image[0];?>" ><img src="<?php echo $image[0];?>" width="100%"  alt="<?php the_title_attribute(); ?>" /></a></p>
            <div class="caption">
              <dl>
                <dd class="caption">
                  <?php if ( !empty($post->post_excerpt) ) the_excerpt(); // this is the "caption" ?>
                </dd>
                <dd class="serif">
                  <?php the_content('<p >Read the rest of this entry &raquo;</p>'); ?>
                  <br class="clear" />
                </dd>
              </dl>
            </div>
            <br class="clear" />
            <hr />
            <div class="attachment-navigation">
              <div class="prev">
                <?php previous_image_link(0) ?>
              </div>
              <div class="next">
                <?php next_image_link(0) ?>
              </div>
              <br class="clear" />
            </div>
          </div>
          <br class="clear" />
          <?php edit_post_link( __( 'Edit', 'Raindrops' ), '<span class="edit-link">', '</span>' ); ?>
		  <?php		raindrops_delete_post_link( __( 'Trash', 'Raindrops' ), '<span class="edit-link">', '</span>' ); ?>
        </div>
        <?php } }else{ ?>
        <p><?php _e("Sorry, no attachments matched your criteria.","Raindrops");?></p>
        <?php } ?>
      </div>
      <div class="yui-u"><?php if($rsidebar_show){get_sidebar('extra');} ?></div>
    </div>
  </div>
</div>
<div class="yui-b"><?php get_sidebar('default'); ?></div>
</div>
<?php get_footer( $raindrops_document_type ); ?>