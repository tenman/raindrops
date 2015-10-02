<?php
/**
 * Template part file part
 *
 * @package Raindrops
 * @since Raindrops 0.940
 *
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
global $template;
do_action( 'raindrops_pre_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) );
$format = get_post_format();

if ( false === $format ) {

    $raindrops_entry_meta_class = 'entry-meta-default';
} else {

    $raindrops_entry_meta_class = 'entry-meta-' . $format;
}
        raindrops_entry_title();
?>
        <div class="posted-on <?php echo $raindrops_entry_meta_class; ?>">
			<?php 
			if( 'before' == raindrops_warehouse( 'raindrops_posted_on_position' ) ) {

				raindrops_posted_on(); 
			}
		  ?></div><?php
			if( 'before' == raindrops_warehouse( 'raindrops_posted_in_position' ) ) {
				raindrops_posted_in(); 
			}
			?>
      

        <div class="entry-content clearfix">
            <?php
            raindrops_prepend_entry_content();

            raindrops_entry_content();

            wp_link_pages( 'before=<p class="pagenate clearfix">&after=</p>&next_or_number=number&pagelink=<span>%</span>' );
            ?>
            <br class="clear" />
            <?php
            raindrops_append_entry_content();
            ?>
        </div>

       <?php										
		if( 'after' == raindrops_warehouse( 'raindrops_posted_on_position' ) ) {
			?><div class="posted-on-after"><?php
			raindrops_posted_on();
			?></div><?php
		}

		if( 'after' == raindrops_warehouse( 'raindrops_posted_in_position' ) ) {
			?><div class="entry-meta"><?php
			raindrops_posted_in();
			?></div><?php
		}
		?>
<?php
do_action( 'raindrops_after_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) );
?>