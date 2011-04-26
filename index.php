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
<?php if(WP_DEBUG == true){echo '<!--'.basename(__FILE__,'.php').'['.basename(dirname(__FILE__)).']-->';}?>

<div id="yui-main">
  <div class="yui-b">
    <?php
/**
 *	Widget only home
 *
 */
	if ( is_home() ) { 
		echo '<div class="topsidebar">'."\n".'<ul>';
		if (dynamic_sidebar('sidebar-3') ){  
		}else{
			echo '<li><div class="hide">dinamic_sidebar 3 none</div></li>';
		} 
		echo '</ul>'."\n".'</div>'."\n".'<br class="clear" />';
	} ?>
	
    <div class="<?php echo raindrops_yui_class_modify();?>" id="container">
      <div class="yui-u first" <?php is_2col_raindrops('style="width:99%;"');?>>
        <?php get_template_part( 'loop', 'default' );?>
        <br style="clear:both" />
      </div>
      <div class="yui-u"><?php if($rsidebar_show){get_sidebar('extra');} ?></div>
      <?php //add nest grid here?>
    </div>
  </div>
</div>
<div class="yui-b"> <?php get_sidebar('default'); ?></div>
</div>
<?php get_footer(); ?>
