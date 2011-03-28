<?php
/*
date.php - calendar based archive navigation
copyright (c) 2005 Scott Merrill (skippy@skippy.net)
Released under the terms of the GNU GPL version 2
   http://www.gnu.org/licenses/gpl.html
*/
	if(isset($_GET['ec3_listing']) and !empty($_GET['ec3_listing'])){
	
		get_template_part('archive');
	exit;
	
	}
	$ht_deputy = "NoTitle";
    $weekdaynames = array(
        0 => __('Sunday','Raindrops'),
        1 => __('Monday','Raindrops'),
        2 => __('Tuesday','Raindrops'),
        3 => __('Wednesday','Raindrops'),
        4 => __('Thursday','Raindrops'),
        5 => __('Friday','Raindrops'),
        6 => __('Saturday','Raindrops')
    );

    if (have_posts()) {
            $ye = mysql2date('Y', $wp_query->posts[0]->post_date);
            $mo = mysql2date('m', $wp_query->posts[0]->post_date);
            $da = mysql2date('d', $wp_query->posts[0]->post_date);
    }else{

            get_template_part('404');
    }
?>
<?php get_header('xhtml1'); ?>
<?php if(WP_DEBUG == true){echo '<!--'.basename(__FILE__,'.php').'['.basename(dirname(__FILE__)).']-->';}?>
<div id="yui-main">
  <div class="yui-b">
    <div class="<?php echo yui_class_modify();?>" id="container">
     <!-- content -->
      <div class="yui-u first" <?php is_2col_raindrops('style="width:99%;"');?>>
<h2 class="page-title"><?php
    if (is_year()) {
            $one_year = query_posts("posts_per_page=-1&year=$ye");
            $output = get_year($one_year, $ye);
            wp_reset_query();
             _e( 'Yearly Archives', 'Raindrops');

    } elseif (is_month()) {
            $one_month = query_posts("posts_per_page=-1&year=$ye&monthnum=$mo");
            $output = month_list($one_month, $ye, $mo);
            wp_reset_query();
            _e('Monthly Archives','Raindrops');
    } elseif (is_day()) {
            $one_day = query_posts("posts_per_page=-1&year=$ye&monthnum=$mo&day=$da");
            $output = get_day($one_day, $ye, $mo, $da);
            wp_reset_query();
            _e('Daily Archives','Raindrops');
    }
?></h2>
		<div class="datetable"><?php echo $output;?></div>
      </div>
      <div class="yui-u"><?php if($rsidebar_show){get_sidebar('extra');} ?></div>
    </div>
  </div>
</div>
<div class="yui-b"><?php get_sidebar('default'); ?></div>
</div>
<?php get_footer(); ?>
