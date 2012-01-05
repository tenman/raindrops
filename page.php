<?php
/**
 * Template for display page
 *
 *
 * @package Raindrops
 * @since Raindrops 0.1
 */
$raindrops_current_column = raindrops_show_one_column();

if($raindrops_current_column !== false){
add_filter("raindrops_theme_settings__raindrops_indv_css","raindrops_color_type_custom");
}

?>
<?php get_header('xhtml1'); ?>
<?php if(WP_DEBUG == true){echo '<!--'.basename(__FILE__,'.php').'['.basename(dirname(__FILE__)).']-->';}?>
<div id="yui-main">
  <div class="yui-b" <?php if($raindrops_current_column == '1' ){
    echo "style=\"width:100%;margin-left:0;\"";}?>>
    <div class="<?php echo raindrops_yui_class_modify();?>" id="container">
<div class="yui-u first"
<?php
if($raindrops_current_column == 3){

}elseif($raindrops_current_column == 1){
    echo 'style="width:99%;"';
}elseif($raindrops_current_column == 2){

    echo 'style="width:99%;"';
}elseif($raindrops_current_column == false){
    is_2col_raindrops('style="width:99%;"');
}

?>>
<?php
/**
 * parent child links
 */
/*
$raindrops_ancestor         = array_pop(get_post_ancestors($post->ID));
$raindrops_list_pages       = wp_list_pages('depth=5&echo=0&child_of=' . $post->ID . '&title_li=<strong>' . __('Pages', 'Raubdrops') . '</strong>' );
$raindrops_ancestor_list_page = wp_list_pages('depth=5&echo=0&child_of=' . $raindrops_ancestor . '&title_li=<strong>' . __('Pages', 'Raindrops') . '</strong>' );

if(empty($ancestor) and !empty($raindrops_list_pages)) {
echo '<ul class="rd-page-navigation clearfix root">';
echo $raindrops_list_pages;
echo '</ul>';
}else {
echo '<ul class="rd-page-navigation clearfix">';
echo $raindrops_ancestor_list_page;
echo '</ul>';
}
*/
?>
        <?php if (have_posts()){ ?>
        <?php       while (have_posts()){ the_post(); ?>
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
			  <?php		raindrops_delete_post_link( __( 'Trash', 'Raindrops' ), '<span class="edit-link">', '</span>' ); ?>
            </div>
            <?php comments_template( '', true ); ?>
          </div>
        </div>
        <?php       } //endwhile ?>
        <?php       if ( $wp_query->max_num_pages > 1 ){ ?>
        <div id="nav-below" class="clearfix"> <span class="nav-previous">
          <?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'Raindrops' ) ); ?>
          </span> <span class="nav-next">
          <?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'Raindrops' ) ); ?>
          </span> </div>
        <?php       } //end max_num_pages > 1 ?>
        <?php } //end have post?>
      </div>
      <?php if(raindrops_show_one_column() == 3){?>
<div class="yui-u">
<?php get_sidebar('extra');?>
</div>
<?php
}elseif($rsidebar_show and raindrops_show_one_column() == false){?>
<div class="yui-u">
<?php get_sidebar('extra');?>
</div>
<?php } ?>
    </div>
  </div>
</div>
<?php if(raindrops_show_one_column() !== '1'){?>
<div class="yui-b">
<?php //lsidebar start ?>
<?php get_sidebar('default'); ?>
</div>
<?php }?>

</div>
<?php get_footer(); ?>