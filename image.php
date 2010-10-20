<?php
/**
 * The xhtml1.0 transitional image for our theme.
 *
 *
 * @package WordPress
 * @subpackage Raindrops
 * @since Raindrops 0.1
 */
?>
<?php get_header('xhtml1'); ?>

<div id="yui-main">
  <!--<?php echo basename(__FILE__,'.php');?>[<?php echo basename(dirname(__FILE__));?>]-->
  <div class="yui-b">
    <!--main-->
    <!-- Use Standard Nesting Grids and Special Nesting Grids to subdivid regions of your layout. -->
    <!-- Special Nesting Grid C has two children, the first is 2/3, the second is 1/3 -->
    <?php
if(function_exists('bcn_display'))
{
// Display the breadcrumb
echo '<div class="breadcrumb">';
bcn_display();
echo '</div>';
}
?>
    <div class="<?php echo $yui_inner_layout;?>">
      <!-- content -->
      <div class="yui-u first" <?php if($rsidebar_show == false){echo "style=\"width:100%;\"";} ?>>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		
		
        <div class="post" id="post-<?php the_ID(); ?>">

			
			
          <div class="entry attachment">
	<h2 class="title"><?php the_title(); ?></h2>
	
          <p><?php _e("Entry");?><a href="<?php echo get_permalink($post->post_parent); ?>" rev="attachment">           
            <?php echo get_the_title($post->post_parent); ?></a></p>	
	
		
		<?php $image = get_post_meta($post->ID, 'image', true); ?>
		<?php $image = wp_get_attachment_image_src($my_image, 'full'); ?>

		<p class="image">
<?php //height="<?php echo round((190/$image[1])*$image[2]);?>
<img src="<?php echo $image[0];?>" width="100%"  alt="<?php the_title(); ?>" /></p>

<?php //echo wp_get_attachment_image( $post->ID, '' ); ?>

            <div class="caption">
			
			<dl>
	
              <dd class="caption"><?php if ( !empty($post->post_excerpt) ) the_excerpt(); // this is the "caption" ?></dd>

            <dd class="serif"><?php the_content('<p >Read the rest of this entry &raquo;</p>'); ?></dd>


            
            
			  </dl>
            </div>
			
            <br style="clear:both;" />
            <?php //the_taxonomies('<li class="taxonomies">Taxonomy(ies) ', ', ', '</li>'); ?>
			<hr />
            <div class="navigation">
                <div style="text-align:left;float:left;"><?php previous_image_link(0) ?></div><div style="float:right;text-align:right;"><?php next_image_link(0) ?></div>
            </div>



              <?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
// Both Comments and Pings are open ?>
              <?php
/*<li>You can <a href="#respond">leave a response</a>, or <a href="<?php trackback_url(); ?>" rel="trackback">trackback</a> from your own site.</li>*/
?>
              <?php } /*elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
// Only Pings are Open ?>
<li>Responses are currently closed, but you can <a href="<?php trackback_url(); ?> " rel="trackback">trackback</a> from your own site.</li>

<?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
// Comments are open, Pings are not ?>
<li>You can skip to the end and leave a response. Pinging is currently not allowed.</li>

						<?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
// Neither Comments, nor Pings are open ?>
<li>Both comments and pings are currently closed.</li>

<?php } */?>
            </ul>
          </div>
          <br class="clear" />
        </div>
        <?php endwhile; else: ?>
        <p>Sorry, no attachments matched your criteria.</p>
        <?php endif; ?>
      </div>
      <!-- navigation-->
      <div class="yui-u">
        <!--rsidebar start-->
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
<div class="yui-b">
  <!--lsidebar start-->
  <?php get_sidebar('1'); ?>
  <!--lsidebar end-->
</div>
<!-- navigation 2 -->
<!--sidebar-->
</div>

<?php get_footer(); ?>