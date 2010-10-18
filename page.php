<?php
	 get_header('xhtml1');?>
<!--<?php echo basename(__FILE__,'.php');?>[<?php echo basename(dirname(__FILE__));?>]-->
<div id="yui-main">
  <div class="yui-b" >
    <?php
	if(function_exists('bcn_display')){
	// Display the breadcrumb
	echo '<div class="breadcrumb">';
	bcn_display();
	echo '</div>';
	}
	?>
    <div class="<?php echo $yui_inner_layout;?>">
      <!-- content -->
      <div class="yui-u first" <?php if($rsidebar_show == false){echo "style=\"width:100%;\"";} ?>>
        <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
        <div class="entry page">
          <div id="post-<?php the_ID(); ?>">
            <h2 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
              <?php the_title(); ?>
              </a></h2>
            
            <p style="margin-left:25px;"><small><?php the_time('Y年 n月 j日') ?>&nbsp;<?php the_author() ?></small></p>
            

            <?php the_content('Read the rest of this entry &raquo;'); ?>
			
			<div class="linkpage">
			    <?php wp_link_pages('before=<p class="pagenate">&after=</p>&next_or_number=number&pagelink=<span>%</span>'); ?>
			</div>
            <p class="postmetadata"><?php the_category(', ') ?>&nbsp;<?php edit_post_link('Edit', '', '  '); ?></p>
          </div>
        </div>
      
        <?php endwhile; ?>
  
		
		<?php if ( $wp_query->max_num_pages > 1 ) : ?>

		<div id="nav-below" class="clearfix">
		  <span class="nav-previous">
			<?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'raindrops' ) ); ?>
		  </span>
		  <span class="nav-next">
			<?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'raindrops' ) ); ?>
		  </span>
		</div>
		<!-- #nav-above -->
		<?php endif; ?>
		
        <?php else : ?>
        <div class="entry">
          <div id="top-main" style="border:1px solid #ccc;background:#fee;padding:2em;color:#333;">
            <h2 class="h2">Not Found</h2>
            <p>ご指定のページが見当たりません<br />
              <small>Sorry, but you are looking for something that isn't here. </small></p>
          </div>
        </div>
        <?php endif; ?>
      </div>
      <!-- navigation 1 -->
      <div class="yui-u">
        <!--rsidebar start-->
        <?php if($rsidebar_show){get_sidebar('2');} ?>
        <!--rsidebar end-->
      </div>
      <!--yui-u end-->
    </div>
  </div>
  <!--main-->
</div>
<!--sidebar-->
<!-- navigation 2 -->
<div class="yui-b" >
  <!--lsidebar start-->
  <?php get_sidebar('1'); ?>
  <!--lsidebar end-->
</div>
<!-- navigation 2 -->
<!--sidebar-->
</div>

<?php get_footer(); 
	

?>