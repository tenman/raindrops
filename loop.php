<?php
/**
 * The xhtml1.0 transitional header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="bd">
 *
 * @package WordPress
 * @subpackage Raindrops
 * @since Raindrops 0.1
 */
 ?>
<?php
/**
 * Display navigation to next/previous pages when applicable
 *
 *
 *
 *
 */
 if ( $wp_query->max_num_pages > 1 ) : ?>

<div id="nav-above" class="clearfix"> <span class="nav-previous">
  <?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'raindrops' ) ); ?>
  </span> <span class="nav-next">
  <?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'raindrops' ) ); ?>
  </span> </div>
<!-- #nav-above -->
<?php endif; ?>
<?php

/**
 * 404not found
 *
 *
 *
 *
 */
 if ( ! have_posts() ) : ?>
<div id="post-0" class="post error404 not-found">
  <h1 class="entry-title h1">
    <?php _e( 'Not Found', 'raindrops' ); ?>
  </h1>
  <div class="entry-content">
    <p>
      <?php _e( 'Apologies, but no results were found for the requested Archive. Perhaps searching will help find a related post.', 'raindrops' ); ?>
    </p>
    <?php get_search_form(); ?>
  </div>
  <!-- .entry-content -->
</div>
<!-- #post-0 -->
<?php endif; ?>
<?php if(is_single()){

/**
 *　when Single page
 *
 *
 *
 *
 */
?>
<?php while (have_posts()) : the_post(); ?>

<?php
$cat = "default";
if ( in_category( "blog" )){
    $cat = "blog";
}elseif ( in_category( "gallery" )){
    $cat = "gallery";
}else{
    $cat = "default";

}


?>
<?php

            switch($cat){

            case ('blog'):

/**
 *  category blog
 *
 *
 *
 *
 */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
  <ul class="entry-meta left">
    <li>
      <?php the_time(TMN_THE_TIME_FORMAT) ?>
    </li>
    <li>
      <?php _e('Category:');?>
      <?php the_category(' ') ?>
    </li>
    <li>
      <?php _e('Tags:');?>
      <?php the_tags(); ?>
    </li>
    <li>
      <?php _e('Auther:');?>
      <?php the_author(); ?>
    </li>
    <li>
      <?php comments_popup_link( __( 'Leave a comment', 'raindrops' ), __( '1 Comment', 'raindrops' ), __( '% Comments', 'raindrops' ) ); ?>
    </li>
    <li>
      <?php edit_post_link('Edit', '', '  '); ?>
      .</li>
  </ul>
  <div class="blog-main left">
    <h2 class="entry-title  clearfix h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
      <?php the_title(); ?>
      </a></h2>
    <div class="entry-content clearfix">
      <?php the_content(__('Read the rest of this entry &raquo;', 'raindrops')) ?>
      <?php wp_link_pages('before=<p class="pagenate clearfix">&after=</p>&next_or_number=number&pagelink=<span>%</span>'); ?>
    </div>
  </div>
</div>
<?php

            break;


/**
 * category gallery
 *
 *
 *
 *
 */

            case("gallery"):
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <h2 class="entry-title h2"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'raindrops' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
    <?php the_title(); ?>
    </a></h2>
  <div class="entry-meta">
    <?php raindrops_posted_on(); ?>
  </div>
  <!-- .entry-meta -->
  <div class="entry-content">
    <?php
                    $images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );

                    $total_images = count( $images );
                    $image = array_shift( $images );
                    $attachment_page = $image->post_title;
                    ?>
    <div class="gallery-thumb"> <a class="size-thumbnail" href="<?php the_permalink(); ?><?php echo $attachment_page;?>/"> <?php echo wp_get_attachment_image( $image->ID, 'thumbnail' );?> </a> </div>
    <div style="float:left;overflow:hidden;margin-left:1em;">
      <?php the_content( '' ); ?>
    </div>
    <br style="clear:both;" />
    <p style="margin:1em;"><em><?php printf( __( 'This gallery contains <a %1$s>%2$s photos</a>.', 'raindrops' ),'href="' . get_permalink() .$attachment_page. '/" title="' . sprintf( esc_attr__( 'Permalink to %s', 'raindrops' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"',$total_images); ?></em></p>
  </div>
  <!-- .entry-content -->
  <div class="entry-utility">
    <?php
                    $category_id = get_cat_ID( 'Gallery' );
                    $category_link = get_category_link( $category_id );
                ?>
    <a href="<?php echo $category_link; ?>" title="<?php esc_attr_e( 'View posts in the Gallery category', 'raindrops' ); ?>">
    <?php _e( 'More Galleries', 'raindrops' ); ?>
    </a> <span class="meta-sep"> | </span> <span class="comments-link">
    <?php comments_popup_link( __( 'Leave a comment', 'raindrops' ), __( '1 Comment', 'raindrops' ), __( '% Comments', 'raindrops' ) ); ?>
    </span>
    <?php edit_post_link( __( 'Edit', 'raindrops' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
  </div>
  <!-- #entry-utility -->
</div>
<?php

            break;




            default:

/**
 * other single page
 *
 *
 *
 *
 */

            ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php
$thumb = get_the_post_thumbnail($post->ID,'single-post-thumbnail');
if(!empty($thumb)){
echo '<div class="single-post-thumbnail">';
echo $thumb;
echo '</div>';
} ?>
  <h2 class="h2 entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'raindrops' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
    <?php the_title(); ?>
    </a></h2>
  <div class="entry-meta">
    <?php raindrops_posted_on(); ?>
  </div>
  <!-- .entry-meta -->
  <?php if ( is_archive() || is_search() ) : // Only display Excerpts for archives & search ?>
  <div class="entry-summary">
    <?php the_excerpt( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'raindrops' ) ); ?>
  </div>
  <!-- .entry-summary -->
  <?php else : ?>
  <div class="entry-content clearfix">
    <?php the_content( __( 'Continue&nbsp;reading&nbsp;<span class="meta-nav">&rarr;</span>', 'raindrops' ) ); ?>
    <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'raindrops' ), 'after' => '</div>' ) ); ?>
  </div>
  <!-- .entry-content -->
  <?php endif;?>
  <div class="entry-utility"> <span class="cat-links"><span class="entry-utility-prep entry-utility-prep-cat-links">
    <?php _e( 'Posted in ', 'raindrops' ); ?>
    </span>
    <?php the_category( ', ' ); ?>
    </span> <span class="meta-sep"> | </span>
    <?php the_tags( '<span class="tag-links"><span class="entry-utility-prep entry-utility-prep-tag-links">' . __( 'Tagged ', 'raindrops' ) . '</span>', ', ', '<span class="meta-sep"> | </span>' ); ?>
    <span class="comments-link">
    <?php comments_popup_link( __( 'Leave a comment', 'raindrops' ), __( '1 Comment', 'raindrops' ), __( '% Comments', 'raindrops' ) ); ?>
    </span>
    <?php edit_post_link( __( 'Edit', 'raindrops' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
  </div>
  <!-- #entry-utility -->
  <?php comments_template( '', true ); ?>
</div>
<!-- #post-<?php the_ID(); ?> -->
<?php }?>
<?php endwhile; ?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
<div id="nav-below" class="clearfix"> <span class="nav-previous">
  <?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'raindrops' ) ); ?>
  </span> <span class="nav-next">
  <?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'raindrops' ) ); ?>
  </span> </div>
<!-- #nav-above -->
<?php endif; ?>
<?php }else{

/**
 *　list post
 *
 *
 *
 *
 */
?>
<!-- not single-->
<ul class="index">
  <?php while (have_posts()) : the_post(); ?>
  <li>
    <div id="post-<?php echo $post->ID; ?>" <?php post_class(); ?>>

    <span class="entry-date published">
      <abbr title="<?php the_time('c') ?>"><?php the_time(TMN_THE_TIME_FORMAT) ?></abbr>
    </span>

      <h2 class="h2 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
      <div style="entry-content">
        <div class="thumbnail_post" style="float:left;margin:0 1em 1em 0;">
          <?php the_post_thumbnail(); ?>
        </div>
        <?php the_content();?>
      </div>
      <?php edit_post_link(__('Edit'), '<span>', '</span> '); ?>
    </div>
  </li>
  <?php endwhile; ?>
</ul>


<?php if ( $wp_query->max_num_pages > 1 ) : ?>
<div id="nav-below" class="clearfix"> <span class="nav-previous">
  <?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'raindrops' ) ); ?>
  </span> <span class="nav-next">
  <?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'raindrops' ) ); ?>
  </span> </div>
<!-- #nav-above -->
<?php endif; ?>
<?php }?>
