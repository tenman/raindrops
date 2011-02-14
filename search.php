<?php
/**
 * search for our theme.
 *
 *
 * @package WordPress
 * @subpackage Raindrops
 * @since Raindrops 0.1
 */
?>
<?php get_header("xhtml1"); ?>

<div id="yui-main">
  <div class="yui-b">
    <?php
if(function_exists('bcn_display'))
{
// Display the breadcrumb
echo '<div class="breadcrumb">';
bcn_display();
echo '</div>';
}
?>
    <div class="<?php if(isset($yui_inner_layout)){echo $yui_inner_layout;}else{echo 'yui-ge';}?>" id="container">
      <div class="yui-u first" <?php if($rsidebar_show == false){echo "style=\"width:100%;\"";} ?>>
        <!-- content start-->
        <!--filename search.php-->
        <?php if (have_posts()) : ?>
        <h2 class="pagetitle h2">Search Results</h2>
        <?php while (have_posts()) : the_post(); ?>
        <div class="entry">
          <h3 id="post-<?php the_ID(); ?>" class="h3"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
            <?php the_title(); ?>
            </a></h3>
          <small>
          <?php the_time(get_option('date_format')) ?>
          </small> <br />
          <br />
          <?php the_content('Read the rest of this entry &raquo;'); ?>
          <div class="clearfix"></div>
          <p class="postmetadata">Posted in
            <?php the_category(', ') ?>
            |
			<?php edit_post_link( __( 'Edit', 'Raindrops' ), '<span class="edit-link">', '</span>' ); ?>
            <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?>
          </p>
        </div>
        <?php endwhile; ?>
        <div class="navigation">
          <div class="alignleft">
            <?php next_posts_link('&laquo; Previous Entries') ?>
          </div>
          <div class="alignright">
            <?php previous_posts_link('Next Entries &raquo;') ?>
          </div>
        </div>
        <?php else : ?>
        <div class="fail-search">
          <h2 class="center h2">
            <?php _e("Nothing was found though it was regrettable. Please change the key word if it is good, and retrieve it.","Raindrops");?>
          </h2>
        </div>
        <?php endif; ?>
        <!-- content end-->
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