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
  <!--<?php echo basename(__FILE__,'.php');?>[<?php echo basename(dirname(__FILE__));?>]-->
  <div class="yui-b">
    <?php
        if(function_exists('bcn_display')){
            // Display the breadcrumb
            echo '<div class="breadcrumb">';
            bcn_display();
            echo '</div>';
        }
    ?>
    <div class="<?php if(isset($yui_inner_layout)){echo $yui_inner_layout;}else{echo 'yui-ge';}?>" id="container">
      <!-- content -->
      <div class="yui-u first" <?php if($rsidebar_show == false){echo "style=\"width:100%;\"";} ?>>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div id="post-<?php the_ID(); ?>"  <?php post_class(); ?>>
          <div class="entry attachment">
            <h2 class="image-title h2"><?php the_title(); ?></h2>
            <p>
              <?php _e("Entry",'Raindrops');?>
              <a href="<?php echo get_permalink($post->post_parent); ?>" rev="attachment"> <?php echo get_the_title($post->post_parent); ?></a></p>
            <?php $image = get_post_meta($post->ID, 'image', true); ?>
            <?php $image = wp_get_attachment_image_src($image, 'full'); ?>
            <p class="image"><img src="<?php echo $image[0];?>" width="100%"  alt="<?php the_title(); ?>" style="max-image:100%;height:auto;" /></p>
            <div class="caption">
              <dl>
                <dd class="caption">
                  <?php if ( !empty($post->post_excerpt) ) the_excerpt(); // this is the "caption" ?>
                </dd>
                <dd class="serif">
                  <?php the_content('<p >Read the rest of this entry &raquo;</p>'); ?>
                  <div class="clearfix"></div>
                </dd>
              </dl>
            </div>
            <div class="clearfix"></div>
            <hr />
            <div class="navigation">
              <div style="text-align:left;float:left;">
                <?php previous_image_link(0) ?>
              </div>
              <div style="float:right;text-align:right;">
                <?php next_image_link(0) ?>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
        <?php endwhile; else: ?>
        <p>
          <?php _e("Sorry, no attachments matched your criteria.","Raindrops");?>
        </p>
        <?php endif; ?>
      </div>
      <!-- navigation-->
      <div class="yui-u">
        <!--rsidebar start-->
        <?php if($rsidebar_show){get_sidebar('2');} ?>
        <!--rsidebar end-->
      </div>
      <!--add col here -->
    </div>
    <!--main-->
  </div>
</div>
<!--sidebar-->
<!-- navigation 2 -->
<div class="yui-b">
  <!--lsidebar start-->
  <?php get_sidebar('1'); ?>
  <!--lsidebar end-->
</div>
<!-- navigation 2 -->
<!--sidebar-->
</div>
<?php get_footer(); ?>