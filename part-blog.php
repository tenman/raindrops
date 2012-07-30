<?php
/**
 * Template part file part-blog
 *
 * @package Raindrops
 * @since Raindrops 0.1
 *
 * @uses the_ID()
 * @uses post_class()
 * @uses get_option('date_format')
 * @uses the_time()
 * @uses get_avatar()
 * @uses apply_filters()
 * @uses the_category()
 * @uses the_tags()
 * @uses sprintf()
 * @uses get_author_posts_url()
 * @uses comments_popup_link()
 * @uses dynamic_sidebar()
 * @uses edit_post_link()
 * @uses the_permalink()
 * @uses the_title_attribute()
 * @uses raindrops_entry_title()
 * @uses raindrops_entry_content()
 * @uses wp_link_pages()
 * @uses is_single()
 * @uses raindrops_prev_next_post()
 * @uses comment_template()
 */
?>
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
<?php  
	if ( comments_open( ) ) { 
	 	comments_popup_link( __( 'Leave a comment', 'Raindrops' ), __( '1 Comment', 'Raindrops' ), __( '% Comments', 'Raindrops' ) ); 
	}
?>
</li>
<?php dynamic_sidebar('sidebar-5');?>
<li>
<?php edit_post_link( __( 'Edit', 'Raindrops' ), '<span class="edit-link">', '</span>' ); ?>
<?php		raindrops_delete_post_link( __( 'Trash', 'Raindrops' ), '<span class="edit-link">', '</span>' ); ?>
</li>
</ul>
<div class="blog-main left">

<?php raindrops_entry_title();?>

<div class="entry-content clearfix">
<?php raindrops_prepend_entry_content();?>

<?php raindrops_entry_content();?>

<div class="clearfix">
<?php raindrops_append_entry_content();?>
</div>
<?php wp_link_pages('before=<p class="pagenate clearfix">&after=</p>&next_or_number=number&pagelink=<span>%</span>'); ?>
</div>
<div class="clearfix"></div>
<?php if(is_single()){  raindrops_prev_next_post('nav-below');}?>

<?php comments_template( '', true ); ?>
</div>
