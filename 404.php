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

<div id="yui-main">
  <div class="yui-b">
    <?php
	if(function_exists('bcn_display') and is_home() == false){
		echo '<div class="breadcrumb">';
		bcn_display();
		echo '</div>';
	}
	?>
    <div class="<?php echo $yui_inner_layout;?>" id="container">
      <!-- content -->
      <div class="yui-u first <?php echo basename(__FILE__,'.php');?> <?php echo basename(dirname(__FILE__));?>" <?php if($rsidebar_show == false){echo "style=\"width:100%;\"";} ?>>
        <div id="post-0" class="post error404 not-found">
          <h1 class="entry-title">
            <?php _e( 'Not Found', 'raindrops' ); ?>
          </h1>
          <div class="entry-content">
            <p>
              <?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'raindrops' ); ?>
            </p>
            <?php get_search_form(); ?>
          </div>
          <!-- .entry-content -->
        </div>
        <!-- #post-0 -->
      </div>
      <!--rsidebar start-->
      <div class="yui-u"> <span style="display:none;">--</span>
        <?php if($rsidebar_show){get_sidebar('2');
		} ?>
        <!--rsidebar end-->
      </div>
      <!--add col here -->
    </div>
    <!--main-->
  </div>
</div>
<!--sidebar-->
<!-- navigation 2 -->
<div class="yui-b"> <span style="display:none;">--</span>
  <!--lsidebar start-->
  <?php get_sidebar('1'); ?>
  <!--lsidebar end-->
</div>
<!-- navigation 2 -->
<!--sidebar-->
</div>
<?php get_footer(); ?>
