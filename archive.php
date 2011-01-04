<?php
/*
Template Name: Archives
*/
/**
 *  The template for displaying Archives.
 *
 *
 * @package WordPress
 * @subpackage Raindrops
 * @since Raindrop 0.1
 */
global $rsidebar_show;
get_header('xhtml1'); ?>
<!--<?php echo basename(__FILE__,'.php');?>[<?php echo basename(dirname(__FILE__));?>]-->

<div id="yui-main">
  <div class="yui-b">
    <!--main-->

    <?php if(function_exists('bcn_display')){echo '<div class="breadcrumb">';bcn_display();echo '</div>';} ?>

    <div class="<?php if(isset($yui_inner_layout)){echo $yui_inner_layout;}else{echo 'yui-ge';}?>" id="container">
          <!-- content -->
      <div class="yui-u first <?php echo basename(__FILE__,'.php');?> <?php echo basename(dirname(__FILE__));?>" <?php if($rsidebar_show == false){echo "style=\"width:100%;\"";} ?>>

<?php
    /* Queue the first post, that way we know
     * what date we're dealing with (if that is the case).
     *
     * We reset this later so we can run the loop
     * properly with a call to rewind_posts().
     */
    if ( have_posts() )
        the_post();
?>

            <h2 class="page-title">
<?php if ( is_day() ) : ?>
                <?php printf( __( 'Daily Archives: <span>%s</span>', 'Raindrops' ), get_the_date('TMN_THE_TIME_FORMAT') ); ?>
<?php elseif ( is_month() ) : ?>
                <?php printf( __( 'Monthly Archives: <span>%s</span>', 'Raindrops' ), get_the_date(TMN_THE_MONTH_FORMAT) ); ?>
<?php elseif ( is_year() ) : ?>
                <?php printf( __( 'Yearly Archives: <span>%s</span>', 'Raindrops' ), get_the_date('Y') ); ?>
<?php else : ?>
                <?php _e( 'Blog Archives', 'Raindrops' ); ?>
<?php endif; ?>
            </h2>
<?php
    /* Since we called the_post() above, we need to
     * rewind the loop back to the beginning that way
     * we can run the loop properly, in full.
     */
    rewind_posts();

    /* Run the loop for the archives page to output the posts.
     * If you want to overload this in a child theme then include a file
     * called loop-archives.php and that will be used instead.
     */
     get_template_part( 'loop', 'archive' );
?>
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

<?php get_footer();?>