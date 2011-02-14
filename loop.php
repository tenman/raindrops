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
  <?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'Raindrops' ) ); ?>
  </span> <span class="nav-next">
  <?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'Raindrops' ) ); ?>
  </span> </div>
<!-- #nav-above -->
<?php } ?>

<?php if(have_posts() and is_single()){
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
	
	$thumbnailsrc 		= get_url_from_element($thumb);
	$thumbnail_title 	= get_title_from_element($thumb);
	
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
  
  <h2 class="entry-title h2"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_attr__( 'Permalink to %s', 'obandes' ), the_title_attribute( 'echo=0' ) ); ?>"><?php echo blank_fallback(get_the_title(), $ht_deputy); ?></a>
  </h2>
  
    <div class="entry-content clearfix">
      <?php the_content( __( 'Continue&nbsp;reading&nbsp;<span class="meta-nav">&rarr;</span>', 'Raindrops' ) ); ?>
      <br class="clear" />
      <?php wp_link_pages('before=<p class="pagenate clearfix">&after=</p>&next_or_number=number&pagelink=<span>%</span>'); ?>
    </div>
    <?php comments_template( '', true ); ?>
  </div>
</div>
<?php
            break;
// category gallery
            case("gallery"):
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <h2 class="entry-title h2"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_attr__( 'Permalink to %s', 'obandes' ), the_title_attribute( 'echo=0' ) ); ?>"><?php echo blank_fallback(get_the_title(), $ht_deputy); ?></a>
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
	  <?php comments_template( '', true ); ?>
	</div>
<?php
            break;
//another single page
            default:
?>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
  <h2 class="entry-title h2"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_attr__( 'Permalink to %s', 'obandes' ), the_title_attribute( 'echo=0' ) ); ?>"><?php echo blank_fallback(get_the_title(), $ht_deputy); ?></a>
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
		<?php comments_template( '', true ); ?>
	</div>
	<?php
	if(WP_DEBUG == true){
		echo '<!-- #post-'.get_the_ID().' -->';
	}?>

	<?php }//	end switch($cat)	?>
	<?php }//　endwhile 			?>
	
	<?php if ( $wp_query->max_num_pages > 1 ){ ?>
	<div id="nav-below" class="clearfix"> <span class="nav-previous">
	  <?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'Raindrops' ) ); ?>
	  </span> <span class="nav-next">
	  <?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'Raindrops' ) ); ?>
	  </span> </div>
	<!-- #nav-above -->
	<?php } ?>

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
  <li>
    <div id="post-<?php echo $post->ID; ?>" <?php post_class(); ?>> <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to<?php echo blank_fallback(get_the_title(), $ht_deputy); ?>
"><span class="entry-date published">
      <?php the_time(get_option('date_format')) ?>
      </span></a>
      <?php
    echo sprintf( __( '<span class="time-diff">(Passage of %s)</span>', 'Raindrops' ), human_time_diff(get_the_time('U'),time()) ) ;
?>
      <?php if( in_category( "gallery" )){     ?>
      <h2 class="h2 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php echo blank_fallback(get_the_title(), $ht_deputy); ?></a></h2>
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
          <?php raindrops_posted_in();?>
          <?php edit_post_link( __( 'Edit', 'Raindrops' ), '<span class="edit-link">', '</span>' ); ?>
        </div>
      </div>
      <?php     }elseif( in_category( "blog" )){         ?>
	  
      <h2 class="h2 entry-title">
        <?php if( has_post_thumbnail($post->ID)){ echo '<span class="h2-thumb">';the_post_thumbnail();echo '</span>';} ?>
        <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_attr__( 'Permalink to %s', 'obandes' ), the_title_attribute( 'echo=0' ) ); ?>"><?php echo blank_fallback(get_the_title(), $ht_deputy); ?></a></h2>
      <div class="entry-content">
        <ul class="left" style="width:120px;margin:0;text-align:left;">
          <li><?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'raindrops_author_bio_avatar_size', 60 ) ); ?></li>
          <li><?php
      echo sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s"   rel="vcard:url">%2$s</a></span>',
                get_author_posts_url( get_the_author_meta( 'ID' ) ), get_the_author() );?>
          </li>
          <?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar(5) ) : else : ?>
          <?php endif; ?>
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
        <?php raindrops_posted_in();?>
        <?php edit_post_link( __( 'Edit', 'Raindrops' ), '<span class="edit-link">', '</span>' ); ?>
      </div>
      <?php }else{ ?>
      <h2 class="h2 entry-title">
        <?php if( has_post_thumbnail($post->ID)){
         echo '<span class="h2-thumb">';
         the_post_thumbnail(array(48,48),array("style"=>"vertical-align:middle;"));
         echo '</span>';
         } ?>
        <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_attr__( 'Permalink to %s', 'obandes' ), the_title_attribute( 'echo=0' ) ); ?>"><?php echo blank_fallback(get_the_title(), $ht_deputy); ?></a></h2>
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
        <?php raindrops_posted_in();?>
        <?php edit_post_link( __( 'Edit', 'Raindrops' ), '<span class="edit-link">', '</span>' ); ?>
      </div>
      <?php } ?>
      <br class="clear" />
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