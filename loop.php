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
$ht_deputy = "";
 if ( $wp_query->max_num_pages > 1 ) : ?>

<div id="nav-above" class="clearfix"> <span class="nav-previous">
  <?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'Raindrops' ) ); ?>
  </span> <span class="nav-next">
  <?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'Raindrops' ) ); ?>
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
    <?php _e( 'Not Found', 'Raindrops' ); ?>
  </h1>
  <div class="entry-content">
    <p>
      <?php _e( 'Apologies, but no results were found for the requested Archive. Perhaps searching will help find a related post.', 'Raindrops' ); ?>
    </p>
    <?php get_search_form(); ?>
  </div>
  <!-- .entry-content -->
</div>
<!-- #post-0 -->
<?php endif; ?>
<?php if(is_single()){

/**
 * when Single page
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

if(get_the_title() == ''){$ht_deputy = $post->ID;}


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
<?php
$thumb = get_the_post_thumbnail($post->ID,'single-post-thumbnail');

if(isset($thumb)){

$thumbnailsrc = get_url_from_element($thumb);
$thumbnail_title = get_title_from_element($thumb);

if(!empty($thumbnailsrc)){
    echo '<div class="single-post-thumbnail">';
    echo $thumb;
    echo '</div>';
    echo "<p class=\"thumb-link\"><a href=\"$thumbnailsrc\" onclick=\"javascrip:this.target='_blank'\"><span class=\"thumbnail-title\">$thumbnail_title</span></a></p>";
}
}
?>
  <ul class="entry-meta left">
    <li>
      <?php the_time(get_option('date_format')) ?>
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
      <?php //the_author(); 
	  echo sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s"   rel="vcard:url">%2$s</a></span>',
                get_author_posts_url( get_the_author_meta( 'ID' ) ), get_the_author() );?>
    </li>
    <li>
      <?php comments_popup_link( __( 'Leave a comment', 'Raindrops' ), __( '1 Comment', 'Raindrops' ), __( '% Comments', 'Raindrops' ) ); ?>
    </li>
<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(5) ) : else : ?>
<?php endif; ?>
    <li>
      <?php edit_post_link('Edit', '', '  '); ?></li>
  </ul>
  <div class="blog-main left">
    <h2 class="entry-title  clearfix h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
      <?php the_title(); echo $ht_deputy; ?>
      </a></h2>
    <div class="entry-content clearfix">
      <?php the_content(__('Read the rest of this entry &raquo;', 'Raindrops')) ?>
      <div class="clearfix"></div>
      <?php wp_link_pages('before=<p class="pagenate clearfix">&after=</p>&next_or_number=number&pagelink=<span>%</span>'); ?>
    </div>
	<?php comments_template( '', true ); ?>	
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
<?php
$thumb = get_the_post_thumbnail($post->ID,'single-post-thumbnail');

if(isset($thumb)){

$thumbnailsrc = get_url_from_element($thumb);
$thumbnail_title = get_title_from_element($thumb);

if(!empty($thumbnailsrc)){
    echo '<div class="single-post-thumbnail">';
    echo $thumb;
    echo '</div>';
    echo "<p class=\"thumb-link\"><a href=\"$thumbnailsrc\" onclick=\"javascrip:this.target='_blank'\"><span class=\"thumbnail-title\">$thumbnail_title</span></a></p>";
}
}
?>
  <h2 class="entry-title h2"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); echo $ht_deputy; ?></a></h2>
  <div class="entry-meta"><?php raindrops_posted_on(); ?></div>
  <!-- .entry-meta -->
  <div class="entry-content">
    <?php
                    $images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );

                    $total_images = count( $images );
                    $image = array_shift( $images );
                    $attachment_page = $image->post_title;
                    ?>
      <?php the_content( '' ); ?>
      <div class="clearfix"></div>
    <p style="margin:1em;"><em><?php printf( __( 'This gallery contains <a %1$s>%2$s photos</a>.', 'Raindrops' ),'href="' . get_permalink() .$attachment_page. '/" rel="bookmark"',$total_images); ?></em></p>
  </div>

  <!-- .entry-content -->
  <div class="entry-utility">
    <?php
                    $category_id = get_cat_ID( 'Gallery' );
                    $category_link = get_category_link( $category_id );
                ?>
    <a href="<?php echo $category_link; ?>" title="<?php esc_attr_e( 'View posts in the Gallery category', 'Raindrops' ); ?>">
    <?php _e( 'More Galleries', 'Raindrops' ); ?>
    </a> <span class="meta-sep"> | </span> <span class="comments-link">
    <?php comments_popup_link( __( 'Leave a comment', 'Raindrops' ), __( '1 Comment', 'Raindrops' ), __( '% Comments', 'Raindrops' ) ); ?>
    </span>
    <?php edit_post_link( __( 'Edit', 'Raindrops' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
  </div>
  <?php comments_template( '', true ); ?>
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

    if(isset($thumb)){

		$thumbnailsrc = get_url_from_element($thumb);
		$thumbnail_title = get_title_from_element($thumb);

        if(!empty($thumbnailsrc)){
            echo '<div class="single-post-thumbnail">';
            echo $thumb;
            echo '</div>';
            echo "<p class=\"thumb-link\"><a href=\"$thumbnailsrc\" onclick=\"javascrip:this.target='_blank'\"><span class=\"thumbnail-title\">$thumbnail_title</span></a></p>";
        }
    }
?>
  <h2 class="h2 entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); echo $ht_deputy; ?></a></h2>
  <div class="entry-meta">
    <?php raindrops_posted_on(); ?>
  </div>
  <!-- .entry-meta -->
  <?php if ( is_archive() || is_search() ) : // Only display Excerpts for archives & search ?>
  <div class="entry-summary">
    <?php the_excerpt( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'Raindrops' ) ); ?>
  </div>
  <!-- .entry-summary -->
  <?php else : ?>
  <div class="entry-content clearfix">
    <?php the_content( __( 'Continue&nbsp;reading&nbsp;<span class="meta-nav">&rarr;</span>', 'Raindrops' ) ); ?>
    <div class="clearfix"></div>
    <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'Raindrops' ), 'after' => '</div>' ) ); ?>
  </div>
  <!-- .entry-content -->
  <?php endif;?>

  <div class="entry-utility"> 
  <?php echo raindrops_posted_in();?>
  <?php edit_post_link( __( 'Edit', 'Raindrops' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
  </div>
  <!-- #entry-utility -->
  <?php comments_template( '', true ); ?>
</div>
<!-- #post-<?php the_ID(); ?> -->
<?php }?>
<?php endwhile; ?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
<div id="nav-below" class="clearfix"> <span class="nav-previous">
  <?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'Raindrops' ) ); ?>
  </span> <span class="nav-next">
  <?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'Raindrops' ) ); ?>
  </span> </div>
<!-- #nav-above -->
<?php endif; ?>
<?php }else{

/**
 * list post
 *
 *
 *
 *
 */
?>
<!-- not single-->
<ul class="index">
  <?php while (have_posts()) : the_post(); ?>
  <?php if(get_the_title() == ''){$ht_deputy = $post->ID;}?>

  <li>
    <div id="post-<?php echo $post->ID; ?>" <?php post_class(); ?>>

    <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); echo $ht_deputy; ?>"><span class="entry-date published">
     <?php the_time(get_option('date_format')) ?> </span></a>

      <?php
    echo sprintf( __( '<span class="time-diff">(Passage of %s)</span>', 'Raindrops' ), human_time_diff(get_the_time('U'),time()) ) ;
?>



      <?php if(is_home()){?>
	  
       <h2 class="h2 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); echo $ht_deputy; ?></a></h2>
      <div class="entry-content clearfix">

    <?php    if( has_post_thumbnail($post->ID)){?>
        <div class="thumbnail_post" style="float:left;margin:.5em 1em 1em 0;width:50px;">
          <?php the_post_thumbnail(); ?>
        </div>
        <?php }


    if( in_category( "gallery" )){

                    $images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );

                    $total_images = count( $images );
                    $image = array_shift( $images );
                    $attachment_page = $image->post_title;

    ?>
    <div class="gallery-thumb"> <a class="size-thumbnail" href="<?php the_permalink(); ?><?php echo $attachment_page;?>/"> <?php echo wp_get_attachment_image( $image->ID, 'thumbnail' );?> </a> </div>


    <?php

            the_excerpt();?>

<p style="margin:1em;"><em><?php printf( __( 'This gallery contains <a %1$s>%2$s photos</a>.', 'Raindrops' ),'href="' . get_permalink() .$attachment_page. '/" rel="bookmark"',$total_images); ?></em></p>
    <?php

     }else{
            the_excerpt();

    }
                }else{

         ?> <h2 class="h2 entry-title"><?php if( has_post_thumbnail($post->ID)){echo '<span class="h2-thumb">';the_post_thumbnail();echo '</span>';}    ?>
      <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); echo $ht_deputy; ?></a></h2>
      <div class="entry-content clearfix">
<?php
                the_content( __( '<span class="button lt"><span class="text">'.__('Continue reading'.'Raindrops').'</span></span> ', 'Raindrops' ) );

                }
?>
      </div>
  	<div class="entry-meta">	  
	  <?php raindrops_posted_in();?>
	  </div>
      <?php edit_post_link(__('Edit'), '<span>', '</span> '); ?>
    </div>
  </li>
  <?php endwhile; ?>
</ul>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
<div id="nav-below" class="clearfix"> <span class="nav-previous">
  <?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'Raindrops' ) ); ?>
  </span> <span class="nav-next">
  <?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'Raindrops' ) ); ?>
  </span> </div>
<!-- #nav-above -->
<?php endif; ?>
<?php }?>