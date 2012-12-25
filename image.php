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
 * @uses raindrops_entry_title()
 * @uses get_permalink($post->post_parent)
 * @uses get_the_title($post->post_parent)
 * @uses get_post_meta($post->ID, 'image', true) 
 * @uses wp_get_attachment_image_src($image, 'full')
 * @uses the_title_attribute()
 * @uses raindrops_prepend_default_sidebar()
 * @uses raindrops_append_default_sidebar()
 */
?>
<?php get_header( $raindrops_document_type ); ?>
<div id="yui-main">
<?php raindrops_debug_navitation( __FILE__ ); ?>
<div class="yui-b">
    <div class="<?php echo raindrops_yui_class_modify();?>" id="container">
	
<?php 
switch(	$raindrops_document_type ){
case( 'html5' ):
?><!--<?php echo $raindrops_document_type;?>-->
	
	
		<div class="yui-u first <?php raindrops_add_class('yui-u first',true);?>">
        <?php if (have_posts()){ while (have_posts()){ the_post(); ?>
        <div id="post-<?php the_ID(); ?>"  <?php post_class(); ?>>
          <div class="entry attachment raindrops-image-page">
            <h2 class="image-title h2"><?php the_title(); ?></h2>
			<?php if( $post->post_parent !== 0){?>
            <p class="parent-entry"><?php _e("Entry : ",'Raindrops');?>
              <a href="<?php echo get_permalink($post->post_parent); ?>" rev="attachment"><?php echo get_the_title($post->post_parent); ?></a>
            </p>
			<?php }?>
            <?php $image = get_post_meta($post->ID, 'image', true); ?>
            <?php $image = wp_get_attachment_image_src($image, 'full'); ?>
            <p class="image"><a href="<?php echo $image[0];?>" ><img src="<?php echo $image[0];?>" width="100%"  alt="<?php the_title_attribute(); ?>" /></a></p>
            <div class="caption">
              <dl>
                <dd class="caption">
                  <?php if ( !empty($post->post_excerpt) ) the_excerpt(); // this is the "caption" ?>
                </dd>
                <dd class="serif">
				<?php raindrops_prepend_entry_content();?>
                  <?php raindrops_entry_content(); ?>
                  <br class="clear" />
				<?php raindrops_append_entry_content();?>  
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
	  
<?php
break;
default:
?><!--<?php echo $raindrops_document_type;?>-->



		<div class="yui-u first <?php raindrops_add_class('yui-u first',true);?>">
        <?php if (have_posts()){ while (have_posts()){ the_post(); ?>
        <div id="post-<?php the_ID(); ?>"  <?php post_class(); ?>>
          <div class="entry attachment raindrops-image-page">
            <h2 class="image-title h2"><?php the_title(); ?></h2>
			<?php if( $post->post_parent !== 0){?>
            <p class="parent-entry"><?php _e("Entry : ",'Raindrops');?>
              <a href="<?php echo get_permalink($post->post_parent); ?>" rev="attachment"><?php echo get_the_title($post->post_parent); ?></a>
            </p>
			<?php }?>
            <?php $image = get_post_meta($post->ID, 'image', true); ?>
            <?php $image = wp_get_attachment_image_src($image, 'full'); ?>
            <p class="image"><a href="<?php echo $image[0];?>" ><img src="<?php echo $image[0];?>" width="100%"  alt="<?php the_title_attribute(); ?>" /></a></p>
            <div class="caption">
              <dl>
                <dd class="caption">
                  <?php if ( !empty($post->post_excerpt) ) the_excerpt(); // this is the "caption" ?>
                </dd>
                <dd class="serif">
				<?php raindrops_prepend_entry_content();?>
                  <?php raindrops_entry_content(); ?>
                  <br class="clear" />
				<?php raindrops_append_entry_content();?>  
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
<?php
break;
}?>	
	  
	  
	  
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