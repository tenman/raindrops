<?php
/**
 * Template for single post.
 *
 *
 * @package WordPress
 * @subpackage Raindrops
 * @since Raindrops 0.306
 */
get_header("xhtml1"); ?>
<?php if(WP_DEBUG == true){echo '<!--'.basename(__FILE__,'.php').'['.basename(dirname(__FILE__)).']-->';}?>
<div id="yui-main">
<div class="yui-b">
<div class="<?php echo raindrops_yui_class_modify();?>" id="container">
<div class="yui-u first" <?php is_2col_raindrops('style="width:99%;"');?>>
<?php
/**
 * Display navigation to next/previous pages when applicable
 */
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

    if(has_post_thumbnail() and isset($thumb) and $is_IE){
    /*IE8 img element has width height attribute. and style max-width and height auto makes conflict expand height*/
            $thumbnailsrc       = wp_get_attachment_image_src(get_post_thumbnail_id(), 'single-post-thumbnail');
            $thumbnailuri       = esc_url($thumbnailsrc[0]);
            $thumbnailwidth     = $thumbnailsrc[1];


        if($thumbnailwidth > $content_width){
            $thumbnailheight    = $thumbnailsrc[2];
            $ratio              = round(RAINDROPS_SINGLE_POST_THUMBNAIL_HEIGHT/ RAINDROPS_SINGLE_POST_THUMBNAIL_WIDTH,2);
            $ie_height          = round($content_width * $ratio);

            $thumbnail_title    = basename($thumbnailsrc[0]);
            $thumbnail_title    = esc_attr($thumbnail_title);
            $size_attribute     = image_hwstring($content_width, $ie_height);

            echo '<div class="single-post-thumbnail">';
            echo '<img src="'.$thumbnailuri.'" '.$size_attribute.'" alt="'.$thumbnail_title.'" style="max-width:100%;" />';
            echo '</div>';

        }else{
            echo '<div class="single-post-thumbnail">';
            echo $thumb;
            echo '</div>';
        }

    }else{
            echo '<div class="single-post-thumbnail">';
            echo $thumb;
            echo '</div>';
    }

    switch($cat){

        case ('blog'): //category blog
?>
<div id="post-<?php the_ID(); ?>" <?php  post_class('clearfix'); ?>>
<ul class="entry-meta-list left">
<li class="category-blog-publish-date"><?php $raindrops_date_format = get_option('date_format'); the_time($raindrops_date_format); ?>
</li>
<li class="blog-avatar"><?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'raindrops_author_bio_avatar_size', 90 ) ); ?></li>
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
<?php dynamic_sidebar('sidebar-5');?>
<li>
<?php edit_post_link( __( 'Edit', 'Raindrops' ), '<span class="edit-link">', '</span>' ); ?>
</li>
</ul>
<div class="blog-main left">

<h2 class="entry-title h2"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_attr__( 'Permalink to %s', 'Raindrops' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a>
</h2>

<div class="entry-content clearfix">
<?php the_content( __( 'Continue&nbsp;reading&nbsp;<span class="meta-nav">&rarr;</span>', 'Raindrops' ) ); ?>
<div class="clearfix"></div>
<?php wp_link_pages('before=<p class="pagenate clearfix">&after=</p>&next_or_number=number&pagelink=<span>%</span>'); ?>
</div>
<div class="clearfix"></div>
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

<h2 class="entry-title h2"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_attr__( 'Permalink to %s', 'Raindrops' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a>
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
<div class="clearfix"></div>

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

<h2 class="entry-title h2"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_attr__( 'Permalink to %s', 'Raindrops' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a>
</h2>
<div class="entry-meta-default">
<?php raindrops_posted_on(); ?>
</div>

<?php if ( is_archive() || is_search() ){ // Only display Excerpts for archives & search ?>

<div class="entry-summary"><?php the_excerpt(); ?></div>

<?php }else{ // is not archives & search?>

<div class="entry-content clearfix"><?php the_content( __( 'Continue&nbsp;reading&nbsp;<span class="meta-nav">&rarr;</span>', 'Raindrops' ) ); ?>
<div class="clearfix"></div>
<?php wp_link_pages('before=<p class="pagenate clearfix">&after=</p>&next_or_number=number&pagelink=<span>%</span>'); ?>
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
<div class="clearfix"></div>
</div>
<?php //rsidebar start ?>
<div class="yui-u">
<?php if($rsidebar_show){get_sidebar('extra');} ?>
</div>
<?php //add nest grid here?>
</div>
<?php //end main ?>
</div>
</div>
<div class="yui-b">
<?php //lsidebar start ?>
<?php get_sidebar('default'); ?>
</div>
</div>
<?php get_footer(); ?>