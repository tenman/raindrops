<?php
/*
Template Name: 索引
*/
?>
<?php get_header(); ?>
<!--<?php echo basename(__FILE__,'.php');?>[<?php echo basename(dirname(__FILE__));?>]-->
<div id="yui-main">
  <div class="yui-b">
    <!--main-->
    <!-- Use Standard Nesting Grids and Special Nesting Grids to subdivid regions of your layout. -->
    <!-- Special Nesting Grid C has two children, the first is 2/3, the second is 1/3 -->
<?php if(!isset($_GET['t']) and empty($_GET['t']) and have_posts()){?>    
      <!-- content -->
      <?php while (have_posts()) : the_post(); ?>

	  
      <div class="<?php echo basename(__FILE__,'.php');?> entry">
	  
        <h2  class="h2 items<?php echo cat_id();?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
		
        <div id="post-<?php the_ID(); ?>" class="content">
          <?php the_content('Read the rest of this entry &raquo;'); ?>
          <?php wp_link_pages('before=<p class="pagenate">&after=</p>&next_or_number=number&pagelink=<span>%</span>'); ?>
            <?php edit_post_link('Edit', '', '  '); ?>

        </div>
      </div>
<br class="clearfix" />
	  
  <div>
        <?php endwhile; }?>

<?php if(isset($_GET['t']) and !empty($_GET['t'])){?>
        <?php $p = htmlspecialchars($_GET['t']);?>
<?php echo "<h2 class=\"h2\"><a href=\"".get_permalink( $post->ID )."\">".get_the_title($post->ID)."</a>&nbsp;".$p."</h2>"; ?>	
        <div style="text-align:center;margin-bottom:30px;">
          <?php next_posts_link(); ?>
          <span style="margin:1em 20%;">&nbsp;</span>
          <?php previous_posts_link(); ?>
        </div>
        <ul id="items">
          <?php $q =array("$p"); echo tag_report($q);?>
        </ul>
		<br style="clear:both;" />
        <div style="text-align:center;margin-bottom:30px;">
          <?php next_posts_link(); ?>
          <span style="margin:1em 20%;">&nbsp;</span>
          <?php previous_posts_link(); ?>
        </div>
<?php }?>
<br class="clearfix" />
      </div>
	  
<div class="yui-gb">	 
      <div class="yui-u first <?php echo basename(__FILE__,'.php');?>>
		 <ul class="sitemap">
		  
		  <li >
		   <h2 class="h2">月別</h2>
			<ul>
			  <?php wp_get_archives('type=monthly&limit=12&before=<p>&after=</p>'); ?>
			</ul>
			</li>
		  </ul>

      </div>
      <div class="yui-u">

		<ul class="sitemap">
			<?php wp_list_categories('show_count=0&title_li=<h2 class="h2">カテゴリ</h2>'); ?>  
		</ul>

      </div>
	  
      <div class="yui-u">
		<ul class="sitemap">
			<li class="pagenav">
					<h2 class="h2">タグ</h2>
				<ul>		
				<?php /*wp_tag_cloud('smallest=8&largest=22');*/
				
					$a = wp_tag_cloud('format=array' );
					
					//print_r(wp_specialchars($a));
					$allowedposttags = array('a' => array('class' => array (),'href' => array ()));
					foreach($a as $tag_propaty){
					
					echo "<li class=\"pageitem\">".wp_kses($tag_propaty,$allowedposttags)."</li>";
		
					}
				?>
				</ul>
			</li>
		</ul>
      </div>



</div>

<div class="sitemap new">
    <?php 
		$posts = get_posts('numberposts=-1&order=desc'); 	
		$count = count($posts);
		$harf = floor($count/2);
	?>

		<h2 class="h2">最近の<?php echo $count;?>件のお知らせ</h2>
		
		  <ul style="float:left;width:48%">
			<?php foreach($posts as $key=>$post): ?>
			<li>
			  <?php the_time('Y.m.d') ?>
			  -<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			  <?php echo mb_strimwidth(the_title("","",false), 0, 30, "..");?></a></li>
			<?php if($key == $harf){echo "</ul><ul style=\"float:left;width:48%;\">";}
			
			?>
			  
			<?php endforeach; ?>
		  </ul>


	</div>
    <!--main-->
  </div>
</div>
<!--sidebar-->
<div class="yui-b">
  <!--rsidebar start-->
  <div class="lsidebar">
    <ul>
      <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(1) ) : else : ?>

<?php wp_list_pages('title_li=<h2 class="h2">Pages</h2>' ); ?>  

      <?php /* If this is the frontpage */ if ( is_home() || is_page() ) { ?>
      <?php wp_list_bookmarks(); ?>
      <li>
        <h2 class="h2">Meta</h2>
        <ul>
          <?php wp_register(); ?>
          <li>
            <?php wp_loginout(); ?>
          </li>
<li>
          <?php wp_meta(); ?></li>
        </ul>
      </li>
      <?php } ?>
      <?php endif; ?>
    </ul>
  </div>
  <!--rsidebar end-->
</div>
<!-- navigation 2 -->
<!--sidebar-->
</div>

<?php get_footer(); ?>