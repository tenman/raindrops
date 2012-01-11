<?php
/**
 * Template part file part
 *
 * @package Raindrops
 * @since Raindrops 0.940
 *
 */
?><div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<h2 class="entry-title h2"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_attr__( 'Permalink to %s', 'Raindrops' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a>
</h2>
<div class="entry-meta-default">
<?php raindrops_posted_on(); ?>
</div>

<?php if ( is_archive() || is_search() ){ // Only display Excerpts for archives & search ?>

<div class="entry-summary"><?php the_excerpt(); ?></div>

<?php }else{ // is not archives & search?>

<div class="entry-content clearfix">
<?php 
if(RAINDROPS_USE_LIST_EXCERPT !== false and !is_single()){
	the_excerpt();
}else{
	the_content( __( 'Continue&nbsp;reading&nbsp;<span class="meta-nav">&rarr;</span>', 'Raindrops' ) );
}
?>
<?php wp_link_pages('before=<p class="pagenate clearfix">&after=</p>&next_or_number=number&pagelink=<span>%</span>'); ?>
</div>
<?php } // end is_archive() || is_search() ?>

<div class="entry-utility entry-meta">
<?php echo raindrops_posted_in();?>
<?php edit_post_link( __( 'Edit', 'Raindrops' ), '<span class="edit-link">', '</span>' ); ?>
<?php		raindrops_delete_post_link( __( 'Trash', 'Raindrops' ), '<span class="edit-link">', '</span>' ); ?>
</div>
<?php if(is_single()){  raindrops_prev_next_post('nav-below');}?>
<?php comments_template( '', true ); ?>
</div>