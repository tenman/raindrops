<?php
/**
 * Template for display loops.
 *
 * @package Raindrops
 * @since Raindrops 0.1
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
?>
<?php
/**
 * Display navigation to next/previous pages when applicable
 */
raindrops_prepend_loop();

raindrops_next_prev_links();

if ( have_posts() ) {

    raindrops_loop_title();

    $raindrops_loop_number = 1;

    while ( have_posts() ) {

        the_post();

        $raindrops_loop_class = raindrops_loop_class( $raindrops_loop_number, get_the_ID() );

        printf( '<li class="loop-%1$s%2$s">', esc_attr( trim( $raindrops_loop_class[ 0 ] ) ), esc_attr( rtrim( $raindrops_loop_class[ 1 ] ) )
        );

        $raindrops_loop_number++;
        ?>				
        <<?php raindrops_doctype_elements( 'div', 'article' ); ?> id="post-<?php the_ID(); ?>" <?php raindrops_post_class(); ?>>		
        <?php
        $format = get_post_format();
        /**
         * In category gallery
         *
         *
         *
         *
         */
        if ( in_category( "gallery" ) || has_post_format( "gallery" ) ) {

            get_template_part( 'part', 'gallery' );
            /**
             * In category blog 
             *
             *
             *
             *
             */
        } elseif ( in_category( "blog" ) || has_post_format( "status" ) ) {

            get_template_part( 'part', 'blog' );
        } elseif ( $format !== false ) {

            get_template_part( 'part', $format );
            /**
             * Default loop
             *
             *
             *
             *
             */
        } else {
            ?>
            <?php
            raindrops_entry_title();
            ?>

            <div class="posted-on">
                <?php
                raindrops_posted_on();
                ?>
            </div>

            <div class="entry-content clearfix">
                <?php
                raindrops_prepend_entry_content();

                raindrops_entry_content();
                ?>
                <br class="clear" />
                <?php
                raindrops_append_entry_content();
                ?>
            </div>
            <div class="entry-meta">
            <?php
            raindrops_posted_in();

            edit_post_link( esc_html__( 'Edit', 'Raindrops' ) . raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );

            raindrops_delete_post_link( esc_html__( 'Trash', 'Raindrops' ) . raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );
            ?>
            </div>
                <?php
            }
            ?>
        <br class="clear" />
        </<?php raindrops_doctype_elements( 'div', 'article' ); ?>>
        </li>
        <?php
    } //end while
    ?>
    </ul>
    <?php
    raindrops_next_prev_links( "nav-below" );
}//if have_posts
raindrops_append_loop();
?>