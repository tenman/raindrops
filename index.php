<?php
/**
 * The xhtml1.0 transitional header for our theme.
 *
 *
 * @package WordPress
 * @subpackage Raindrops
 * @since Raindrops 0.1
 */
get_header("xhtml1"); ?>
<!--<?php echo basename(__FILE__,'.php');?>[<?php echo basename(dirname(__FILE__));?>]-->

<div id="yui-main">
  <div class="yui-b">
    <!--main-->
    <!-- Use Standard Nesting Grids and Special Nesting Grids to subdivid regions of your layout. -->
    <!-- Special Nesting Grid C has two children, the first is 2/3, the second is 1/3 --><!--dddd-->

      <?php //the_post_thumbnail(); ?>
    <?php
    if(function_exists('bcn_display') and is_home() == false){
        echo '<div class="breadcrumb">';
        bcn_display();
        echo '</div>';
    }
    ?>
    <?php if ( is_home() ) { ?>
    <!--widget only toppage start-->
    <div class="topsidebar">
      <ul>
        <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(3) ) : else : ?>
        <li>
          <div style="display:none;">dinamic_sidebar 3 none</div>
        </li>
        <?php endif; ?>
      </ul>
    </div>
    <!--topsidebar end-->
    <br class="clearfix" />
    <?php  } ?>


    <div class="<?php if(isset($yui_inner_layout)){echo $yui_inner_layout;}else{echo 'yui-ge';}?>" id="container">
      <!-- content -->
      <div class="yui-u first <?php echo basename(__FILE__,'.php');?> <?php echo basename(dirname(__FILE__));?>" <?php if($rsidebar_show == false){echo "style=\"width:100%;\"";} ?>>
      <?php //the_post_thumbnail(); ?>

        <?php get_template_part( 'loop', 'default' );?>
        <br style="clear:both" />

      </div>
      <!--rsidebar start-->
      <div class="yui-u"> 
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