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
<?php get_header('xhtml1'); ?>

<div id="yui-main">
  <div class="yui-b">
    <?php
	if(function_exists('bcn_display') and is_home() == false){
		echo '<div class="breadcrumb">';
		bcn_display();
		echo '</div>';
	}
	?>
     <div class="<?php echo $yui_inner_layout;?>" id="container">
      <div class="yui-u first <?php echo basename(__FILE__,'.php');?> <?php echo basename(dirname(__FILE__));?>" <?php if($rsidebar_show == false){echo "style=\"width:100%;\"";} ?>>
	  		

		
        <?php
		if(isset($_GET['author_name'])){
			$curauth = get_userdatabylogin($author_name);
		}else{
			$curauth = get_userdata(intval($author));
		}
		?>
		
<?php if(have_posts())	the_post();?>

<h2 class="page-title author h2"><?php printf( __( 'Author Archives: %s', 'raindrops' ), "<span class='vcard'><a class='url fn n' href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='me'>" . get_the_author() . "</a></span>" ); ?></h2>

<?php
// If a user has filled out their description, show a bio on their entries.
if ( get_the_author_meta( 'description' ) ) : ?>

     <dl class="<?php echo basename(__FILE__,'.php');?> <?php echo basename(dirname(__FILE__));?>">
		<dt style="border:none;"><?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyten_author_bio_avatar_size', 60 ) ); ?><br /><?php printf( __( 'About %s', 'raindrops' ), get_the_author() ); ?></dt>
		<dd style="border:none;"><?php the_author_meta( 'description' ); ?></dd>
		</dl>
		
<?php endif; ?>


		<dl class="<?php echo esc_attr(basename(__FILE__,'.php'));?> <?php echo esc_attr(basename(dirname(__FILE__)));?>">
		
		<?php if(!empty($curauth->user_url)){ ?>
          <dt>Website</dt>
          <dd><a href="<?php echo esc_url($curauth->user_url); ?>"><?php echo esc_url($curauth->user_url); ?></a></dd>
		<?php } //!empty($curauth->user_url) ?>
		<?php if(!empty($curauth->user_email) and is_email($curauth->user_email)){ ?>
		  <dt>email</dt>
          <dd><a href="mailto:<?php echo htmlspecialchars($curauth->user_email); ?>"><?php echo htmlspecialchars($curauth->user_email); ?></a></dd>
		<?php } //!empty($curauth->user_email) ?>
  
		<?php if(!empty($curauth->user_nicename)){ ?>		
		  <dt>nicename</dt>
          <dd><?php echo esc_html($curauth->user_nicename); ?></dd>
		<?php } //!empty($curauth->user_nicename) ?>
		
		  <dt>registered</dt>
          <dd><?php echo esc_html( $curauth->user_registered); ?></dd>
		  
		<?php if(!empty($curauth->user_displayname)){ ?>		
		  <dt>displayname</dt>
          <dd>　<?php echo $curauth->user_displayname; ?></dd>
		<?php } //!empty($curauth->user_displayname) ?>
		  
		 <?php if(!empty($curauth->user_description)){ ?>		
          <dt>description</dt>
          <dd>　<?php echo $curauth->user_description; ?></dd>
		<?php } //!empty($curauth->user_description) ?>
		 
        </dl>
		<br style="clear:both;" />
        <h2 class="h2">Posts by <?php echo $curauth->nickname; ?>:</h2>
		
       	<dl class="<?php echo basename(__FILE__,'.php');?> <?php echo basename(dirname(__FILE__));?>">
          <!-- The Loop -->
          <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <dt> <?php the_time(TMN_THE_TIME_FORMAT); ?></dt>
		  <dd><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>">
            <?php the_title(); ?></a><?php //the_category('&');?></dd>

          <?php endwhile; else: ?>

          <p>
            <?php _e('No posts by this author.'); ?>
          </p>
          <?php endif; ?>
          <!-- End Loop -->
       
		</dl>
</div>

    <!-- navigation-->
    <div class="yui-u"> <span style="display:none;">----------------ナビゲーションリンク-----------------</span>
      <?php if($rsidebar_show){get_sidebar('2');
		} ?>
      <!--rsidebar end-->
    </div>
    <!--add col here -->
  </div>
  <!--main-->
</div>
</div>
<!--sidebar-->
<!-- navigation 2 -->
<div class="yui-b"> <span style="display:none;">----------------ナビゲーションリンク-----------------</span>
  <!--lsidebar start-->
  <?php get_sidebar('1'); ?>
  <!--lsidebar end-->
</div>
<!-- navigation 2 -->
<!--sidebar-->
</div>

<?php get_footer(); ?>