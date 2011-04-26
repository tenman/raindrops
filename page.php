<?php
/**
 * pages for our theme.
 *
 *
 * @package WordPress
 * @subpackage Raindrops
 * @since Raindrops 0.1
 */
?>
<?php get_header('xhtml1'); ?>
<?php if(WP_DEBUG == true){echo '<!--'.basename(__FILE__,'.php').'['.basename(dirname(__FILE__)).']-->';}?>
<div id="yui-main">
  <div class="yui-b" >
    <div class="<?php echo raindrops_yui_class_modify();?>" id="container">
      <div class="yui-u first" <?php is_2col_raindrops('style="width:99%;"');?>>
        <?php if (have_posts()){ ?>
        <?php 		while (have_posts()){ the_post(); ?>
        <div class="entry page">
          <div id="post-<?php the_ID(); ?>" <?php post_class();?>>
            <h2 class="h2 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
              <?php the_title(); ?>
              </a></h2>
               <div style="entry-content">
              <?php the_content(__('Read the rest of this entry &raquo;','Raindrops')); ?>
              <br class="clear" />
            </div>
            <div class="linkpage clearfix">
              <?php wp_link_pages('before=<p class="pagenate">&after=</p>&next_or_number=number&pagelink=<span>%</span>'); ?>
            </div>
            <br class="clear" />
            <div class="postmetadata">
              <?php the_category(', ') ?>
              &nbsp;
              <?php edit_post_link( __( 'Edit', 'Raindrops' ), '<span class="edit-link">', '</span>' ); ?>
            </div>
            <?php comments_template( '', true ); ?>
          </div>
        </div>
        <?php 		} //endwhile ?>
        <?php 		if ( $wp_query->max_num_pages > 1 ){ ?>
        <div id="nav-below" class="clearfix"> <span class="nav-previous">
          <?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'Raindrops' ) ); ?>
          </span> <span class="nav-next">
          <?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'Raindrops' ) ); ?>
          </span> </div>
        <?php 		} //end max_num_pages > 1 ?>
        <?php } //end have post?>
      </div>
      <div class="yui-u"><?php if($rsidebar_show){get_sidebar('extra');} ?></div>
    </div>
  </div>
</div>
<div class="yui-b" ><?php get_sidebar('default'); ?></div>
</div>
<?php get_footer(); ?>
