<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Raindrops
 * @since Raindrops 1.0
 */

get_header('xhtml1'); ?>
<!--<?php echo basename(__FILE__,'.php');?>[<?php echo basename(dirname(__FILE__));?>]-->

<div id="yui-main">
  <div class="yui-b">
    <div class="<?php echo $yui_inner_layout;?>" id="container">
	
<?php $cat = get_the_category();$cat = $cat[0];?>	
	
	
      <!-- content -->
      <div class="yui-u first <?php echo basename(__FILE__,'.php');?> <?php echo basename(dirname(__FILE__));?>" <?php if($rsidebar_show == false){echo "style=\"width:100%;\"";} ?>>
        <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		
		
        <div id="nav-above" class="clearfix">
          <span class="nav-previous">
            <?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'raindrops' ) . '</span> %title' ); ?>
          </span>
          <span class="nav-next">
            <?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'raindrops' ) . '</span>' ); ?>
          </span>
        </div>
        <!-- #nav-above -->
		
	
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		
	<?php if ( has_post_thumbnail()){?>		
		<div class="eye-catch" style="width:100%;overflow:hidden;height:200px;">
		<?php the_post_thumbnail('single-post-thumbnail'); ?>
		</div>
	<?php } //has_post_thumbnail?>
		
          <h1 class="entry-title">
            <?php the_title(); ?>
          </h1>
		  
		  
		  
          <div class="entry-meta"><?php raindrops_posted_on(); ?></div>
          <!-- .entry-meta -->
          <div class="entry-content">
            <?php the_content();?>
			
            <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'raindrops' ), 'after' => '</div>' ) ); ?>
          </div>
          <!-- .entry-content -->
          <?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
          <div id="entry-author-info">
            <div id="author-avatar"> <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyten_author_bio_avatar_size', 60 ) ); ?> </div>
            <!-- #author-avatar -->
            <div id="author-description">
              <h2><?php printf( esc_attr__( 'About %s', 'raindrops' ), get_the_author() ); ?></h2>
              <?php the_author_meta( 'description' ); ?>
              <div id="author-link"> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"> <?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'raindrops' ), get_the_author() ); ?> </a> </div>
              <!-- #author-link	-->
            </div>
            <!-- #author-description -->
          </div>
          <!-- #entry-author-info -->
          <?php endif; ?>
          <div class="entry-utility">
            <?php raindrops_posted_in(); ?>
            <?php edit_post_link( __( 'Edit', 'raindrops' ), '<span class="edit-link">', '</span>' ); ?>
          </div>
          <!-- .entry-utility -->
        </div>
        <!-- #post-## -->
        <div id="nav-below" class="clearfix">
          <span class="nav-previous">
            <?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'raindrops' ) . '</span> %title' ); ?>
          </span>
          <span class="nav-next">
            <?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'raindrops' ) . '</span>' ); ?>
          </span>
        </div>
        <!-- #nav-below -->
        <?php comments_template( '', true ); ?>
        <?php endwhile; // end of the loop. ?>
      </div>
	  
	  
	 <!--rsidebar start-->
      <div class="yui-u"> <span style="display:none;">--</span>
        <?php if($rsidebar_show){get_sidebar('2');
		} ?>
        <!--rsidebar end-->
      </div>
      <!--add col here --> 
    </div>
  </div>
</div>
<div class="yui-b"> <span style="display:none;">--</span>
  <!--lsidebar start-->
  <?php get_sidebar('1'); ?>
  <!--lsidebar end-->
</div>
<!-- navigation 2 -->
<!--sidebar-->
</div>

<?php get_footer();?>