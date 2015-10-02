<?php
/**
 * Template part file part-gallery
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
raindrops_entry_title();
?>
        <div class="entry-meta-gallery"><?php
				if( 'before' == raindrops_warehouse( 'raindrops_posted_on_position' ) ) {
					?><div class="posted-on" ><?php
					raindrops_posted_on();
					?></div><?php
				}

				if( 'before' == raindrops_warehouse( 'raindrops_posted_in_position' ) ) {
					raindrops_posted_in();
				}?></div>
        <div class="entry-content">
            <?php
            raindrops_prepend_entry_content();

            $raindrops_attachment_args = array(
                'post_parent'    => $post->ID,
                'post_type'      => 'attachment',
                'post_mime_type' => 'image',
                'orderby'        => 'menu_order',
                'order'          => 'ASC',
                'numberposts'    => 999
            );

            $raindrops_images = get_children( $raindrops_attachment_args );

            if ( isset( $raindrops_images ) && !empty( $raindrops_images ) ) {

                $raindrops_format = true;

                $total_images = count( $raindrops_images );

                $raindrops_image_result = array_shift( $raindrops_images );
            } else {

                $raindrops_format = false;

                $total_images = 0;

                $raindrops_image_result = '';
            }

            if ( !preg_match( '!\[gallery!', get_the_content() ) && true == $raindrops_format ) {
                ?>
                <div class="gallery-thumb">
                    <?php
                    echo wp_get_attachment_link( $raindrops_image_result->ID, 'thumbnail', true );
                    ?>
                </div>
                <?php
            }
            raindrops_entry_content();
            ?>
            <div class="clearfix">
                <?php
                raindrops_append_entry_content();

                wp_link_pages( 'before=<p class="pagenate clearfix">&after=</p>&next_or_number=number&pagelink=<span>%</span>' );
                ?>
            </div>
            <?php
            if ( true == $raindrops_format ) {
                ?>
                <p style="margin:1em;"><em class="gallery-infomation">
                        <?php
                        echo sprintf( esc_html__( 'This gallery contains %1$s photographs in all as ', 'raindrops' ), $total_images ) . '&nbsp;' . wp_get_attachment_link( $raindrops_image_result->ID, false, true ) . '&nbsp;' . __( 'photograph etc.', 'raindrops' );
                        ?>
                    </em></p>
                <?php
            }
            ?>
        </div>
		<?php		
		if( 'after' == raindrops_warehouse( 'raindrops_posted_on_position' ) ) {
			?><div class="posted-on-after"><?php
				raindrops_posted_on();
			?></div><?php
		}
		?>
        <div class="entry-utility entry-meta">
            <?php
            $category_id = get_cat_ID( 'Gallery' );

            $category_link = get_category_link( $category_id );

            printf(
                    '%4$s<a href="%1$s" title="%2$s">%3$s</a> | ', esc_url( $category_link ), esc_attr__( 'View posts in the Gallery category', 'raindrops' ), ' ' . esc_html__( 'Gallery', 'raindrops' ), esc_html__( 'Link to Category', 'raindrops' )
            );
            ?>
            <span class="comments-link">
            <?php 
			
			$raindrops_comments_are_closed = raindrops_warehouse_clone('raindrops_comments_are_closed');
			
			if ( 'hide' == $raindrops_comments_are_closed ) {
				
				$comment_off_message = '';
			} else {
				
				$comment_off_message = 'Comments off';
			}
			
			comments_popup_link( esc_html__( 'Leave a comment', 'raindrops' ), esc_html__( '1 Comment', 'raindrops' ), esc_html__( '% Comments', 'raindrops' ), '', $comment_off_message ); ?>
            </span>
                <?php

               edit_post_link( esc_html__( 'Edit', 'raindrops' ) . raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );

                raindrops_delete_post_link( esc_html__( 'Trash', 'raindrops' ), '<span class="edit-link">', '</span>' );
                ?>
        </div>

<?php do_action( 'raindrops_after_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) ); ?>