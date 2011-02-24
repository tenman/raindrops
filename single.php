<?php
/**
 * The xhtml1.0 transitional header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="bd">
 *
 * @package WordPress
 * @subpackage Raindrops
 * @since Raindrops 0.306
 */
get_header("xhtml1"); ?>
<?php if(WP_DEBUG == true){echo '<!--'.basename(__FILE__,'.php').'['.basename(dirname(__FILE__)).']-->';}?>
<div id="yui-main">
<div class="yui-b">
<?php
if(function_exists('bcn_display') and is_home() == false){
    echo '<div class="breadcrumb">';
    bcn_display();
    echo '</div>';
}
?>
<div class="<?php if(isset($yui_inner_layout)){echo $yui_inner_layout;}else{echo 'yui-ge';}?>" id="container">
<div class="yui-u first <?php echo basename(__FILE__,'.php');?> <?php echo basename(dirname(__FILE__));?>" <?php if($rsidebar_show == false){echo "style=\"width:100%;\"";} ?>>
<?php
/**
 * Display navigation to next/previous pages when applicable
 */
 $ht_deputy = "NoTitle";

//raindrops_prev_next_post();?>
<?php if(have_posts()){
/**
 * when Single page
 */
 while (have_posts()){
    the_post();

    $cat = "default";
    if ( in_category( "blog" )){    $cat = "blog";      }
    if ( in_category( "gallery" )){ $cat = "gallery";   }

    if(WP_DEBUG == true){
        echo '<!--Single Category '.$cat.' start-->';
    }

    $thumb = get_the_post_thumbnail($post->ID,'single-post-thumbnail');

    if(isset($thumb)){

    $thumbnailsrc       = get_url_from_element($thumb);
    $thumbnail_title    = get_title_from_element($thumb);

        if(!empty($thumbnailsrc)){
            echo '<div class="single-post-thumbnail" style="margin-top:1em;">';
            echo '<a href="'.esc_url($thumbnailsrc).'" onclick="javascrip:this.target=\'_blank\'" rel="lightbox">';
            echo $thumb;
            echo '</a>';
            echo '</div>';
        }
    }

    switch($cat){

        case ('blog'): //category blog
?>
<div id="post-<?php the_ID(); ?>" <?php  post_class('clearfix'); ?>>
<ul class="entry-meta-list left">
<li>
<?php the_time(get_option('date_format')) ?>
</li>
<li><?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'raindrops_author_bio_avatar_size', 90 ) ); ?></li>
<li>
<?php _e('Category:','Raindrops');?>
<?php the_category(' ') ?>
</li>
<li>
<?php _e('Tags:','Raindrops');?>
<?php the_tags(); ?>
</li>
<li>
<?php _e('Author:','Raindrops');?>
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
<?php edit_post_link( __( 'Edit', 'Raindrops' ), '<span class="edit-link">', '</span>' ); ?>
</li>
</ul>
<div class="blog-main left">

<h2 class="entry-title h2"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_attr__( 'Permalink to %s', 'Raindrops' ), the_title_attribute( 'echo=0' ) ); ?>"><?php echo blank_fallback(get_the_title(), $ht_deputy); ?></a>
</h2>

<div class="entry-content clearfix">
<?php the_content( __( 'Continue&nbsp;reading&nbsp;<span class="meta-nav">&rarr;</span>', 'Raindrops' ) ); ?>
<br class="clear" />
<?php wp_link_pages('before=<p class="pagenate clearfix">&after=</p>&next_or_number=number&pagelink=<span>%</span>'); ?>
</div>
  <br class="clear" />
<?php if(is_single()){  raindrops_prev_next_post('nav-below');}?>

<?php comments_template( '', true ); ?>
</div>
</div>
<?php
            break;
// category gallery
            case("gallery"):
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<h2 class="entry-title h2"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_attr__( 'Permalink to %s', 'Raindrops' ), the_title_attribute( 'echo=0' ) ); ?>"><?php echo blank_fallback(get_the_title(), $ht_deputy); ?></a>
</h2>

<div class="entry-meta-gallery">
<?php raindrops_posted_on(); ?>
</div>

<div class="entry-content">
<?php
$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );

$total_images = count( $images );
$image = array_shift( $images );
$attachment_page = $image->post_title;
?>
<div class="gallery-thumb"><?php echo wp_get_attachment_link( $image->ID ,array(150,150),true); ?></div>
<?php the_content( __( 'Continue&nbsp;reading&nbsp;<span class="meta-nav">&rarr;</span>', 'Raindrops' ) ); ?>
<br class="clear" />

<p style="margin:1em;"><em><?php echo sprintf( __( 'This gallery contains %1$s photographs in all as ', 'Raindrops' ),$total_images).'&nbsp;'.wp_get_attachment_link( $image->ID ,false,true).'&nbsp;'.__('photograph etc.','Raindrops');?></em></p>
</div>

<div class="entry-utility entry-meta">
<?php
$category_id = get_cat_ID( 'Gallery' );
$category_link = get_category_link( $category_id );

printf(
    '<a href="%s" title="%s">%s</a> | ',
    esc_url($category_link),
    esc_attr__( 'View posts in the Gallery category', 'Raindrops' ),
    __( 'More Galleries', 'Raindrops' )
    );
?>
<span class="comments-link">
<?php comments_popup_link( __( 'Leave a comment', 'Raindrops' ), __( '1 Comment', 'Raindrops' ), __( '% Comments', 'Raindrops' ) ); ?>
</span>
<?php edit_post_link( __( 'Edit', 'Raindrops' ), '<span class="edit-link">', '</span>' ); ?>
</div>
<?php if(is_single()){  raindrops_prev_next_post('nav-below');}?>

<?php comments_template( '', true ); ?>
</div>
<?php
break;
//another single page
default:
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<h2 class="entry-title h2"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_attr__( 'Permalink to %s', 'Raindrops' ), the_title_attribute( 'echo=0' ) ); ?>"><?php echo blank_fallback(get_the_title(), $ht_deputy); ?></a>
</h2>
<div class="entry-meta-default">
<?php raindrops_posted_on(); ?>
</div>

<?php if ( is_archive() || is_search() ){ // Only display Excerpts for archives & search ?>

<div class="entry-summary"><?php the_excerpt(); ?></div>

<?php }else{ // is not archives & search?>

<div class="entry-content clearfix"><?php the_content( __( 'Continue&nbsp;reading&nbsp;<span class="meta-nav">&rarr;</span>', 'Raindrops' ) ); ?><br class="clear" />
<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'Raindrops' ), 'after' => '</div>' ) ); ?>
</div>
<?php } // end is_archive() || is_search() ?>

<div class="entry-utility entry-meta">
<?php echo raindrops_posted_in();?>
<?php edit_post_link( __( 'Edit', 'Raindrops' ), '<span class="edit-link">', '</span>' ); ?>
</div>
<?php if(is_single()){  raindrops_prev_next_post('nav-below');}?>
<?php comments_template( '', true ); ?>
</div>
<?php
if(WP_DEBUG == true){
echo '<!-- #post-'.get_the_ID().' -->';
}?>

<?php }//   end switch($cat)    ?>
<?php }//　endwhile             ?>

<?php if ( $wp_query->max_num_pages > 1 ){ ?>
<div id="nav-below" class="clearfix"> <span class="nav-previous">
<?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'Raindrops' ) ); ?>
</span> <span class="nav-next">
<?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'Raindrops' ) ); ?>
</span> </div>
<!-- #nav-above -->
<?php } }?>


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