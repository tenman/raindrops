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
 */
 $ht_deputy = "NoTitle";
 
	 	if ( $wp_query->max_num_pages > 1 ){ ?>

<div id="nav-above" class="clearfix"> <span class="nav-previous">
<?php 		next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'Raindrops' ) ); ?></span><span class="nav-next">
<?php 		previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'Raindrops' ) ); ?></span></div>
<?php 	}


if(have_posts()){

/**
 * echo title Archive ,Author,etc
 *
 * 
 *
 *
 */

raindrops_loop_title();


/**
 * entry loop start
 *
 *
 *
 *
 */
while (have_posts()){
	 
		the_post();
?>
<li>
  <div id="post-<?php echo $post->ID; ?>" <?php post_class(); ?>>
<?php 	if( in_category( "gallery" )){     ?>
    <h2 class="h2 entry-title"> <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php echo esc_html(raindrops_blank_fallback(get_the_title(), $ht_deputy)); ?></a> </h2>
    <div class="posted-on">
      <?php raindrops_posted_on();?>
    </div>
    <div class="entry-content clearfix">
      <?php
			$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
		
			$total_images = count( $images );
			$image = array_shift( $images );
			$attachment_page = $image->post_title;
?>
      <div class="gallery-thumb"><?php echo wp_get_attachment_link( $image->ID ,array(150,150),true); ?></div>
      <?php
			if(RAINDROPS_USE_LIST_EXCERPT == true){
				the_excerpt();
			}else{
				the_content();
			}
?>
      <br class="clear" />
      <p style="margin:1em;"><em><?php printf( __( 'This gallery contains %1$s photos.', 'Raindrops' ),$total_images); ?></em></p>
      <div class="entry-meta">
        <?php 		raindrops_posted_in();?>
        <?php 		edit_post_link( __( 'Edit', 'Raindrops' ), '<span class="edit-link">', '</span>' ); ?>
      </div>
    </div>
    <?php //end entry-content?>
    <?php     
		}elseif(in_category( "blog" )){
?>
    <h2 class="h2 entry-title">
      <?php 
			if( has_post_thumbnail($post->ID)){ 
				echo '<span class="h2-thumb">';
				the_post_thumbnail();
				echo '</span>';
			} 
?>
      <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_attr__( 'Permalink to %s', 'Raindrops' ), the_title_attribute( 'echo=0' ) ); ?>"><?php echo esc_html(raindrops_blank_fallback(get_the_title(), $ht_deputy)); ?></a> </h2>
    <div class="posted-on">
      <?php raindrops_posted_on();?>
    </div>
    <div class="entry-content">
      <ul class="left entry-meta-list categoryblog">
        <li class="avatar"><?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'raindrops_author_bio_avatar_size', 60 ) ); ?></li>
        <li class="author">
          <?php 	
			printf( '<span class="author vcard"><a class="url fn n" href="%1$s"   rel="vcard:url">%2$s</a></span>',
					get_author_posts_url( get_the_author_meta( 'ID' ) ), 
					get_the_author() 
			);
?>
        </li>
        <?php 		dynamic_sidebar('sidebar-5');?>
      </ul>
      <?php
			if(RAINDROPS_USE_LIST_EXCERPT == true){
				the_excerpt();
			}else{
				the_content();
			}
?>
    </div>
    <br class="clear" />
    <div class="entry-meta">
      <?php 		raindrops_posted_in();?>
      <?php 		edit_post_link( __( 'Edit', 'Raindrops' ), '<span class="edit-link">', '</span>' ); ?>
    </div>
    <?php }else{ ?>
    <h2 class="h2 entry-title">
      <?php 
			if( has_post_thumbnail($post->ID)){
				echo '<span class="h2-thumb">';
				the_post_thumbnail(array(48,48),array("style"=>"vertical-align:text-bottom;"));
				echo '</span>';
			} 
?>
      <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_attr__( 'Permalink to %s', 'Raindrops' ), the_title_attribute( 'echo=0' ) ); ?>"><?php echo esc_html(raindrops_blank_fallback(get_the_title(), $ht_deputy)); ?></a></h2>
    <div class="posted-on">
      <?php raindrops_posted_on();?>
    </div>
    <div class="entry-content clearfix">
      <?php
			if(RAINDROPS_USE_LIST_EXCERPT == true){
				the_excerpt();
			}else{
				the_content();
			}
?>
    </div>
    <div class="entry-meta">
      <?php 		raindrops_posted_in();?>
      <?php 		edit_post_link( __( 'Edit', 'Raindrops' ), '<span class="edit-link">', '</span>' ); ?>
    </div>
<?php } ?>
    <br class="clear" />
  </div>
</li>
<?php 
} //end while 
?>
</ul>
<?php 		if ( $wp_query->max_num_pages > 1 ){ ?>
<div id="nav-below" class="clearfix"> <span class="nav-previous">
  <?php 			next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'Raindrops' ) ); ?>
  </span><span class="nav-next">
  <?php 			previous_posts_link( __( '<span>Newer posts <span class="meta-nav">&rarr;</span></span>', 'Raindrops' ) ); ?>
  </span></div>
<?php }//if have_posts?>
<?php 
}
?>