<?php
/**
 * Template for display image.
 *
 *
 * @package Raindrops
 * @since Raindrops 0.1
 *
 * @uses get_header( )
 * @uses raindrops_yui_class_modify( )
 * @uses is_2col_raindrops( 'style="width:99%;"' )
 * @uses have_posts( )
 * @uses have_posts( )
 * @uses the_post( )
 * @uses the_ID( )
 * @uses post_class( )
 * @uses raindrops_entry_title( )
 * @uses get_permalink( $post->post_parent )
 * @uses get_the_title( $post->post_parent )
 * @uses get_post_meta( $post->ID, 'image', true ) 
 * @uses wp_get_attachment_image_src( $image, 'full' )
 * @uses the_title_attribute( )
 * @uses raindrops_prepend_default_sidebar( )
 * @uses raindrops_append_default_sidebar( )
 */
do_action( 'raindrops_' . basename( __FILE__ ) );
get_header( $raindrops_document_type );
do_action( 'raindrops_pre_' . basename( __FILE__ ) );
?>
<div id="yui-main">
    <?php raindrops_debug_navitation( __FILE__ ); ?>
    <div class="yui-b">
        <div class="<?php echo raindrops_yui_class_modify(); ?>" id="container">
            <?php
            switch ( $raindrops_document_type ) {

                case( 'html5' ):
                    ?>
                    <div class="yui-u first<?php raindrops_add_class( 'yui-u first', true ); ?>" <?php raindrops_doctype_elements( '', 'role="main"' ); ?>>
                        <?php
                        if ( have_posts() ) {

                            while ( have_posts() ) {

                                the_post();
                                ?>
                                <div id="post-<?php the_ID(); ?>"  <?php raindrops_post_class(); ?>>
                                    <div class="entry attachment raindrops-image-page">
                                        <h2 class="image-title h2"><?php the_title(); ?></h2>
                                        <?php
                                        if ( $post->post_parent !== 0 ) {
                                            ?>
                                            <p class="parent-entry">
                                                <?php
                                                esc_html_e( "Entry : ", 'Raindrops' );
                                                ?>
                                                <a href="<?php echo get_permalink( $post->post_parent ); ?>" rev="attachment">
                                                    <?php
                                                    echo get_the_title( $post->post_parent );
                                                    ?>
                                                </a>
                                            </p>
                                            <?php
                                        }

                                        $image = get_post_meta( $post->ID, 'image', true );

                                        $image = wp_get_attachment_image_src( $image, 'full' );
                                        ?>
                                        <p class="image">
                                            <a href="<?php echo $image[ 0 ]; ?>" >
                                                <img src="<?php echo $image[ 0 ]; ?>" width="<?php echo $image[ 1 ]; ?>" height="<?php echo $image[ 2 ]; ?>" alt="<?php the_title_attribute(); ?>" />
                                            </a>
                                        </p>
                                        <div class="caption">
                                            <dl>
                                                <dd class="caption">
                                                    <?php
                                                    if ( !empty( $post->post_excerpt ) ) {
                                                        the_excerpt(); // this is the "caption" 
                                                    }
                                                    ?>
                                                </dd>
                                                <dd class="serif">
                                                    <?php
                                                    raindrops_prepend_entry_content();

                                                    raindrops_entry_content();
                                                    ?>
                                                    <br class="clear" />
                                                    <?php
                                                    raindrops_append_entry_content();
                                                    ?>  
                                                </dd>
                                            </dl>
                                        </div>
                                        <br class="clear" />
                                        <hr />
                                        <div class="attachment-navigation">
                                            <div class="prev">
                <?php
                previous_image_link( 0 );
                ?>
                                            </div>
                                            <div class="next">
                <?php
                next_image_link( 0 );
                ?>
                                            </div>
                                            <br class="clear" />
                                        </div>
                                    </div>
                                    <br class="clear" />
                <?php
                edit_post_link( esc_html__( 'Edit', 'Raindrops' ) . raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );

                raindrops_delete_post_link( esc_html__( 'Trash', 'Raindrops' ) . raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );
                ?>
                                </div>
                                    <?php
                                } // while ( have_posts( ) )
                            } else {
                                ?>
                            <p>
                            <?php
                            esc_html_e( "Sorry, no attachments matched your criteria.", "Raindrops" );
                            ?>
                            </p>
                                <?php
                            }
                            ?>
                    </div>
                        <?php
                        break;

                    default:

                        printf( '<!--%$1s-->', $raindrops_document_type );
                        ?>
                    <div class="yui-u first<?php raindrops_add_class( 'yui-u first', true ); ?>" <?php raindrops_doctype_elements( '', 'role="main"' ); ?>>

        <?php
        if ( have_posts() ) {

            while ( have_posts() ) {

                the_post();
                ?>
                                <div id="post-<?php the_ID(); ?>"  <?php raindrops_post_class(); ?>>
                                    <div class="entry attachment raindrops-image-page">
                                        <h2 class="image-title h2">
                <?php
                the_title();
                ?>
                                        </h2>
                                            <?php
                                            if ( $post->post_parent !== 0 ) {
                                                ?>
                                            <p class="parent-entry">
                                            <?php
                                            esc_html_e( "Entry : ", 'Raindrops' );
                                            ?>
                                                <a href="<?php echo get_permalink( $post->post_parent ); ?>" rev="attachment">
                                                <?php
                                                echo get_the_title( $post->post_parent );
                                                ?>
                                                </a>
                                            </p>
                                                    <?php
                                                }

                                                $image = get_post_meta( $post->ID, 'image', true );

                                                $image = wp_get_attachment_image_src( $image, 'full' );
                                                ?>
                                        <p class="image">
                                            <a href="<?php echo $image[ 0 ]; ?>" >
                                                <img src="<?php echo $image[ 0 ]; ?>" width="100%"  alt="<?php the_title_attribute(); ?>" />
                                            </a>
                                        </p>
                                        <div class="caption">
                                            <dl>
                                                <dd class="caption">
                <?php
                if ( !empty( $post->post_excerpt ) ) {

                    the_excerpt(); // this is the "caption"
                }
                ?>
                                                </dd>
                                                <dd class="serif">
                                                    <?php
                                                    raindrops_prepend_entry_content();

                                                    raindrops_entry_content();
                                                    ?>
                                                    <br class="clear" />
                                                    <?php
                                                    raindrops_append_entry_content();
                                                    ?>
                                                </dd>
                                            </dl>
                                        </div>
                                        <br class="clear" />
                                        <hr />
                                        <div class="attachment-navigation">
                                            <div class="prev">
                <?php
                previous_image_link( 0 );
                ?>
                                            </div>
                                            <div class="next">
                                                <?php
                                                next_image_link( 0 );
                                                ?>
                                            </div>
                                            <br class="clear" />
                                        </div>
                                    </div>
                                    <br class="clear" />
                                                <?php
                                                edit_post_link( esc_html__( 'Edit', 'Raindrops' ) . raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );

                                                raindrops_delete_post_link( esc_html__( 'Trash', 'Raindrops' ) . raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );
                                                ?>
                                </div>
                                    <?php
                                }// endwhile ( have_posts( ) )
                            } else {
                                ?>
                            <p>
                            <?php
                            esc_html_e( "Sorry, no attachments matched your criteria.", "Raindrops" );
                            ?>
                            </p>
                            <?php
                        }
                        ?>
                    </div>
                            <?php
                            break;
                    }
                    ?>	
            <div class="yui-u">
                <?php
                raindrops_prepend_extra_sidebar();

                if ( $rsidebar_show ) {
                    get_sidebar( 'extra' );
                }

                raindrops_append_extra_sidebar();
                ?>
            </div>
        </div>
    </div>
</div>
<div class="yui-b">
                <?php
                raindrops_prepend_default_sidebar();

                get_sidebar( 'default' );

                raindrops_append_default_sidebar();
                ?>	
</div>
</div>
    <?php get_footer( $raindrops_document_type ); ?>