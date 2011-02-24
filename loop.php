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
<?php 		next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'Raindrops' ) ); ?>
</span><span class="nav-next">
<?php 		previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'Raindrops' ) ); ?>
</span></div>
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
<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to<?php echo esc_attr(blank_fallback(get_the_title(), $ht_deputy)); ?>">
<span class="entry-date published"><?php the_time(get_option('date_format')) ?></span></a><?php printf( __( '<span class="time-diff">(Passage of %s)</span>', 'Raindrops' ), human_time_diff(get_the_time('U'),time()));?>
	
	
<?php 	if( in_category( "gallery" )){     ?>
		
<h2 class="h2 entry-title">
<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php echo blank_fallback(get_the_title(), $ht_deputy); ?></a>
</h2>
<div class="entry-content clearfix">
<?php
			$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
		
			$total_images = count( $images );
			$image = array_shift( $images );
			$attachment_page = $image->post_title;
?>
<div class="gallery-thumb"><?php echo wp_get_attachment_link( $image->ID ,array(150,150),true); ?></div>
<?php
			if(TMN_USE_LIST_EXCERPT == true){
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
</div><?php //end entry-content?>
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
<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_attr__( 'Permalink to %s', 'Raindrops' ), the_title_attribute( 'echo=0' ) ); ?>"><?php echo blank_fallback(get_the_title(), $ht_deputy); ?></a>
</h2>
<div class="entry-content">
<ul class="left" style="width:120px;margin:0;text-align:left;">
<li><?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'raindrops_author_bio_avatar_size', 60 ) ); ?></li>
<li>
<?php 	
			printf( '<span class="author vcard"><a class="url fn n" href="%1$s"   rel="vcard:url">%2$s</a></span>',
					get_author_posts_url( get_the_author_meta( 'ID' ) ), 
					get_the_author() 
			);
?>
</li>
<?php 	
			if(function_exists('dynamic_sidebar') && dynamic_sidebar(5)){
			}else{ 
			
			}
?>
</ul>
<?php
			if(TMN_USE_LIST_EXCERPT == true){
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
				the_post_thumbnail(array(48,48),array("style"=>"vertical-align:middle;"));
				echo '</span>';
			} 
?>
<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_attr__( 'Permalink to %s', 'Raindrops' ), the_title_attribute( 'echo=0' ) ); ?>"><?php echo blank_fallback(get_the_title(), $ht_deputy); ?></a></h2>
<div class="entry-content clearfix">
<?php
			if(TMN_USE_LIST_EXCERPT == true){
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
} //end shile 
?>
</ul>
<?php 		if ( $wp_query->max_num_pages > 1 ){ ?>
<div id="nav-below" class="clearfix"> <span class="nav-previous">
<?php 			next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'Raindrops' ) ); ?>
</span><span class="nav-next">
<?php 			previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'Raindrops' ) ); ?>
</span>
</div>
<?php }//if have_posts?>
<?php 
}


function raindrops_loop_title(){

/**
 * list post
 *
 *
 *
 *
 */
	$Raindrops_class_name = "";
	$page_title = "";
	if(is_search()){
		$Raindrops_class_name = 'serch-result'; 
		$page_title = __("Search Results",'Raindrops');
		$page_title_c = get_search_query();
	}elseif(is_tag()){
		$Raindrops_class_name = 'tag-archives'; 
		$page_title = __("Tag Archives",'Raindrops');
		$page_title_c = single_term_title("", false);
	}elseif(is_category()){
		$Raindrops_class_name = 'category-archives'; 
		$page_title = __("Category Archives",'Raindrops');
		$page_title_c = single_cat_title('', false);
	}elseif (is_archive()){
		if (is_day()){
			$Raindrops_class_name = 'dayly-archives'; 
			$page_title = __('Daily Archives', 'Raindrops');
			$page_title_c = get_the_date(get_option('date_format'));
		}elseif (is_month()){
			$Raindrops_class_name = 'monthly-archives'; 
			$page_title = __('Monthly Archives', 'Raindrops');
			if(get_bloginfo("language") == 'ja'){
				$page_title_c = get_the_date('Y / F');
			}else{
				$page_title_c = get_the_date('F Y');
			}
		}elseif (is_year()){
			$Raindrops_class_name = 'yearly-archives'; 
			$page_title = __('Yearly Archives', 'Raindrops');
			$page_title_c = get_the_date('Y');
		}elseif (is_author()){
			$Raindrops_class_name = 'author-archives'; 
			$page_title =	__("Author Archives",'Raindrops');

			while (have_posts()){ the_post();
				$page_title_c = get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'Raindrops_author_bio_avatar_size', 32 ) ).' '.get_the_author();
				break;
			}
			rewind_posts();
		}else{
			$Raindrops_class_name = 'blog-archives';
			$page_title = __("Blog Archives",'Raindrops');
		}
	}
	
echo '<ul class="index '.esc_attr($Raindrops_class_name).'">';
	
	if(!empty($page_title)){
		printf('<li><h1 class="h1" id="archives-title">%s <span>%s</span></h1></li>',
				$page_title,
				$page_title_c
		);
	}	
	
}
?>