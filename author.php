<?php
/*
Template Name: Auther
*/
/**
 * The template for displaying Auther.
 *
 *
 * @package WordPress
 * @subpackage Raindrops
 * @since Raindrop 0.1
 */

?>        
<?php $curauth = get_userdata(intval($author));?>
<?php get_header('xhtml1'); ?>
<div id="yui-main">
  <div class="yui-b">
    <div class="<?php echo raindrops_yui_class_modify();?>" id="container">
      <div class="yui-u first author-infomation" <?php is_2col_raindrops('style="width:99%;"');?>>
	  
<h2 class="h2"><?php	printf( __( 'Author Archives: %s','Raindrops'), $curauth->nickname);?></h2>

	<table summary="author infomation" class="author-meta">
	  <tr>
		<td class="avatar-col"><?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'raindrops_author_bio_avatar_size', 60 ) ); ?> </td>
		<td><dl class="author raindrops" style="margin:0;padding:0;">
			<?php	if ( esc_html( $curauth->description) ){ ?>
			<dt>
			  <?php _e('Profile','Raindrops');?>
			</dt>
			<dd>
			  <?php echo esc_html( $curauth->description); ?>
			</dd>
			<?php } ?>
			<?php if(!empty($curauth->user_url)){ ?>
			<dt>
			  <?php _e('Website','Raindrops'); ?>
			</dt>
			<dd><a href="<?php echo esc_url($curauth->user_url); ?>"><?php echo esc_url($curauth->user_url); ?></a></dd>
			<?php }  ?>
			<dt>
			  <?php _e('registered','Raindrops'); ?>
			</dt>
			<dd><?php echo esc_html( $curauth->user_registered); ?></dd>
			

		  </dl></td>
	  </tr>
	</table>
		
        <br class="clear" />
		
<h2 class="h2"><?php _e("Recent post",'Raindrops'); ?></h2>

		<dl class="author">
		  <!-- The Loop -->
		  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		  <dt>
			<?php $raindrops_date_format = get_option('date_format'); the_time($raindrops_date_format); ?>
			&nbsp;&nbsp;<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>">
			<?php the_title(); ?>
			</a> </dt>
		  <dd>
			<?php _e( 'Categories :', 'Raindrops');?>
			<?php the_category(', ');?>
		  </dd>
		  <dd>
			<?php _e( 'Tag :', 'Raindrops');?>
			<?php echo get_the_tag_list( '', ', ' );?> </dd>
		  <?php endwhile; else: ?>
		  <p>
			<?php _e('No posts by this author.','Raindrops'); ?>
		  </p>
		  <?php endif; ?>
		  <!-- End Loop -->
		</dl>
      </div>
      <div class="yui-u"><?php if($rsidebar_show){get_sidebar('extra');} ?></div>
    </div>
  </div>
</div>
<div class="yui-b"><?php get_sidebar('default'); ?></div>
</div>
<?php get_footer(); ?>
