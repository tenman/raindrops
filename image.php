<?php
/**
 * The xhtml1.0 transitional image for our theme.
 *
 *
 * @package WordPress
 * @subpackage Raindrops
 * @since Raindrops 0.1
 */
?>
<?php get_header('xhtml1'); ?>

<div id="yui-main">
<?php if(WP_DEBUG == true){echo '<!--'.basename(__FILE__,'.php').'['.basename(dirname(__FILE__)).']-->';}?>
  <div class="yui-b">
    <div class="<?php echo raindrops_yui_class_modify();?>" id="container">
      <div class="yui-u first" <?php is_2col_raindrops('style="width:99%;"');?>>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div id="post-<?php the_ID(); ?>"  <?php post_class(); ?>>
          <div class="entry attachment raindrops-image-page">
            <h2 class="image-title h2"><?php the_title(); ?></h2>
            <p class="parent-entry"><?php _e("Entry : ",'Raindrops');?>
              <a href="<?php echo get_permalink($post->post_parent); ?>" rev="attachment"><?php echo get_the_title($post->post_parent); ?></a>
			</p>
            <?php $image = get_post_meta($post->ID, 'image', true); ?>
            <?php $image = wp_get_attachment_image_src($image, 'full'); ?>
            <p class="image"><a href="<?php echo $image[0];?>" ><img src="<?php echo $image[0];?>" width="100%"  alt="<?php the_title(); ?>" style="max-image:100%;height:auto;" /></a></p>
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
              <div class="prev" style="text-align:left;float:left;">
                <?php previous_image_link(0) ?>
              </div>
              <div class="next" style="float:right;">
                <?php next_image_link(0) ?>
              </div>
			  <br class="clear" />
            </div>
          </div>
          <br class="clear" />
		  <?php edit_post_link( __( 'Edit', 'Raindrops' ), '<span class="edit-link">', '</span>' ); ?>
        </div>
        <?php endwhile; else: ?>
        <p><?php _e("Sorry, no attachments matched your criteria.","Raindrops");?></p>
        <?php endif; ?>
      </div>
      <div class="yui-u"><?php if($rsidebar_show){get_sidebar('extra');} ?></div>
    </div>
  </div>
</div>
<div class="yui-b"><?php get_sidebar('default'); ?></div>
</div>
<?php get_footer(); ?>