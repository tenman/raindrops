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
        <div class="<?php echo $raindrops_entry_meta_class; ?>">
            <?php
            raindrops_posted_on();
            ?>
        </div>

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

        <div class="entry-utility entry-meta">
            <?php
            echo raindrops_posted_in();
			
            edit_post_link( esc_html__( 'Edit', 'Raindrops' ) . raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );

            raindrops_delete_post_link( esc_html__( 'Trash', 'Raindrops' ) . raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );
            ?>
        </div>
<?php


do_action( 'raindrops_after_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) );
?>