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
<!--<?php echo basename(__FILE__,'.php');?>[<?php echo basename(dirname(__FILE__));?>]-->
<div id="yui-main">
  <div class="yui-b">
    <?php
    if(function_exists('bcn_display') and is_home() == false){
        echo '<div class="breadcrumb">';
        bcn_display();
        echo '</div>';
    }
    ?>
    <div class="<?php if(isset($yui_inner_layout)){echo $yui_inner_layout;}else{echo 'yui-ge';}?>" id="container">

      <!-- content -->
      <div class="yui-u first <?php echo basename(__FILE__,'.php');?> <?php echo basename(dirname(__FILE__));?>" <?php if($rsidebar_show == false){echo "style=\"width:100%;\"";} ?>>
        <h1 class="entry-title"><?php _e( 'Not Found', 'raindrops' ); ?></h1>
        <div id="post-0" class="post error404 not-found">
          <div class="entry-content">
          <p><?php _e( 'Apologies, but no results were found for the requested Archive. Perhaps searching will help find a related post.', 'Raindrops' ); ?></p>
            <?php get_search_form(); ?>
          </div>
          <!-- .entry-content -->
        </div>
        <!-- #post-0 -->
      </div>
      <!--rsidebar start-->
      <div class="yui-u"><?php if($rsidebar_show){get_sidebar('2');} ?></div>
      <!--rsidebar end-->
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