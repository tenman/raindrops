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
<?php
if(WP_DEBUG == true){
    echo '<!--'.basename(__FILE__,'.php').'['.basename(dirname(__FILE__)).']-->';
}?>
<div id="yui-main">
  <div class="yui-b">
    <?php
    if(function_exists('bcn_display') and is_home() == false){
        echo '<div class="breadcrumb">';
        bcn_display();
        echo '</div>';
    }
    ?>
    <?php if ( is_home() ) { ?>
<?php  //This widget show only home;?>
    <div class="topsidebar">
      <ul>
       <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(3) ) : else : ?>
        <li>
          <div class="hide">dinamic_sidebar 3 none</div>
        </li>
        <?php endif; ?>
      </ul>
    </div>
    <br class="clearfix" />
    <?php  } ?>

    <div class="<?php if(isset($yui_inner_layout)){echo $yui_inner_layout;}else{echo 'yui-ge';}?>" id="container">
      <!-- content -->
      <div class="yui-u first <?php echo basename(__FILE__,'.php');?> <?php echo basename(dirname(__FILE__));?>" <?php if($rsidebar_show == false){echo "style=\"width:100%;\"";} ?>>
      <?php //the_post_thumbnail(); ?>

        <?php get_template_part( 'loop', 'default' );?>
        <br style="clear:both" />

      </div>
<?php //rsidebar start ?>
      <div class="yui-u"> 
        <?php if($rsidebar_show){get_sidebar('2');} ?>
      </div>
<?php //add nest grid here?>
    </div>
<?php //end main ?>
  </div>
</div>
<div class="yui-b">
<?php //lsidebar start ?>
  <?php get_sidebar('1'); ?>
</div>
</div>
<?php get_footer(); ?>