<?php
/**
 * Template for search .
 *
 *
 * @package Raindrops
 * @since Raindrops 0.1
 *
 * @uses raindrops_prepend_default_sidebar( )
 * @uses raindrops_append_default_sidebar( )
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
do_action( 'raindrops_' . basename( __FILE__ ) );
$raindrops_current_column = raindrops_column_controller();

get_header( $raindrops_document_type );
do_action( 'raindrops_pre_' . basename( __FILE__ ) );
?>
<div id="yui-main" class="<?php raindrops_dinamic_class( 'yui-main',true ); ?>">
<?php raindrops_debug_navitation( __FILE__ ); ?>
    <div class="<?php raindrops_dinamic_class( 'yui-b', true ); ?>">
        <div class="<?php echo raindrops_yui_class_modify(); ?>" id="container">
            <div class="<?php raindrops_dinamic_class( 'yui-u first', true ); ?>" <?php raindrops_doctype_elements( '', 'role="main"' ); ?>>
<?php raindrops_prepend_loop(); ?>
<?php if ( have_posts() ) { ?>

                    <h1 class="pagetitle h1">Search Results : <?php the_search_query(); ?></h1>
                            <?php
                            raindrops_next_prev_links();
                            ?>					
                    <ul class="search-results">
                        <?php
						    $raindrops_loop_number = 1;
                        while ( have_posts() ) {

                            the_post();

							$raindrops_loop_class = raindrops_loop_class( $raindrops_loop_number, get_the_ID() );

								printf( "\n". str_repeat("\t", 8 ). '<li class="loop-%1$s%2$s">', 
										esc_attr( trim( $raindrops_loop_class[ 0 ] ) ), 
										esc_attr( rtrim( $raindrops_loop_class[ 1 ] ) )
									);

							$raindrops_loop_number++;
						?>
						
                                <div id="post-<?php the_ID(); ?>" class="<?php echo raindrops_article_wrapper_class();?>">
									 <<?php raindrops_doctype_elements( 'div', 'article' ); ?> <?php raindrops_post_class( array( 'clearfix' ) ); ?>>	
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
                                    <br class="clear" />
								</<?php raindrops_doctype_elements( 'div', 'article' ); ?>>
                                </div>
                            </li>

                        <?php }//while ( have_posts( ) )	?>
                    </ul>

                            <?php
                            raindrops_next_prev_links( "nav-below" );
                            ?>


                <?php } else { ?>
                    <div class="fail-search">
						<?php do_action( 'raindrops_prepend_fail_search');?>
                        <h2 class="center h2">
                            <?php
                            esc_html_e( "Nothing was found though it was regrettable. Please change the key word if it is good, and retrieve it.", "Raindrops" );
                            ?>
                        </h2>
                        <?php get_search_form(); ?>
						<?php do_action( 'raindrops_append_fail_search');?>
                    </div>
                <?php } ?>
                <?php raindrops_append_loop(); ?>
            </div>
            <?php
            if ( 3 == $raindrops_current_column ) {
                ?>
                <div class="yui-u">
                    <?php
                    raindrops_prepend_extra_sidebar();

                    get_sidebar( 'extra' );

                    raindrops_append_extra_sidebar();
                    ?>
                </div>
                <?php
            } elseif ( $rsidebar_show && false == $raindrops_current_column ) {
                ?>
                <div class="yui-u">
                    <?php
                    raindrops_prepend_extra_sidebar();

                    get_sidebar( 'extra' );

                    raindrops_append_extra_sidebar();
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<?php
if ( $raindrops_current_column !== 1 || false == $raindrops_current_column ) {
    ?>
    <div class="yui-b">
        <?php
        //lsidebar start 
        raindrops_prepend_default_sidebar();

        get_sidebar( 'default' );

        raindrops_append_default_sidebar();
        ?>
    </div>
    <?php
}
?>
<?php get_footer( $raindrops_document_type ); ?>