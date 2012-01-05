<?php
/**
 * Template for search .
 *
 *
 * @package Raindrops
 * @since Raindrops 0.1
 */
?>
<?php get_header("xhtml1"); ?>
<div id="yui-main">
  <?php if(WP_DEBUG == true){echo '<!--'.basename(__FILE__,'.php').'['.basename(dirname(__FILE__)).']-->';}?>
  <div class="yui-b">
    <div class="<?php echo raindrops_yui_class_modify();?>" id="container">
      <div class="yui-u first" <?php is_2col_raindrops('style="width:99%;"');?>>
        <?php if (have_posts()){ ?>
        <h1 class="pagetitle h1">Search Results :<?php the_search_query(); ?></h1>
        <ul class="search-results">
        <li>
        <?php
        if ( $wp_query->max_num_pages > 1 ){ ?>
        <div id="nav-above" class="clearfix"> <span class="nav-previous">
          <?php     next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'Raindrops' ) ); ?>
          </span><span class="nav-next">
          <?php     previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'Raindrops' ) ); ?>
          </span></div>
        <?php   }?>
        </li>
      <?php while (have_posts()){ the_post(); ?>
          <li>
            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
              <h2 class="h2 entry-title">
                <?php
            if( has_post_thumbnail($post->ID)){
                echo '<span class="h2-thumb">';
                the_post_thumbnail(array(48,48),array("style"=>"vertical-align:middle;"));
                echo '</span>';
            }
?>
                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_attr__( 'Permalink to %s', 'Raindrops' ), the_title_attribute( 'echo=0' ) ); ?>"><?php echo the_title(); ?></a></h2>

              <div class="posted-on"><?php raindrops_posted_on();?></div>
              <div class="entry-content clearfix"><?php     the_excerpt();?></div>
              <div class="entry-meta">
                <?php raindrops_posted_in();?>
                <?php   edit_post_link( __( 'Edit', 'Raindrops' ), '<span class="edit-link">', '</span>' ); ?>
				<?php		raindrops_delete_post_link( __( 'Trash', 'Raindrops' ), '<span class="edit-link">', '</span>' ); ?>
              </div>
              <br class="clear" />
            </div>
          </li>

      <?php }?>
        <li>
        <?php if ( $wp_query->max_num_pages > 1 ){ ?>
        <div id="nav-below" class="clearfix"><span class="nav-previous">
          <?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'Raindrops' ) ); ?>
          </span><span class="nav-next">
          <?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'Raindrops' ) ); ?>
          </span> </div>
        <?php }?>
        </li>
        </ul>

        <?php }else{ ?>
        <div class="fail-search">
          <h2 class="center h2">
            <?php _e("Nothing was found though it was regrettable. Please change the key word if it is good, and retrieve it.","Raindrops");?>
          </h2>
          <?php get_search_form(); ?>
        </div>
        <?php } ?>
      </div>
      <div class="yui-u"><?php if($rsidebar_show){get_sidebar('extra');} ?></div>
    </div>
  </div>
</div>
<div class="yui-b">
  <?php get_sidebar('default'); ?>
</div>
</div>
<?php get_footer(); ?>
