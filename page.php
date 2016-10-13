<?php
/**
 * Template for display page
 *
 *
 * @package Raindrops
 * @since Raindrops 0.1
 *
 * @uses raindrops_column_controller( )
 * @uses add_filter( )
 * @uses get_header( )
 * @uses raindrops_yui_class_modify( )
 * @uses have_posts( )
 * @uses the_post( )
 * @uses the_ID( )
 * @uses raindrops_post_class( )
 * @uses the_title_attribute( )
 * @uses raindrops_entry_title( )
 * @uses raindrops_entry_content( )
 * @uses wp_link_pages( )
 * @uses the_category( ', ' )
 * @uses edit_post_link( )
 * @uses raindrops_delete_post_link( )
 * @uses comments_template( '', true )
 * @uses next_posts_link( )
 * @uses previous_posts_link( )
 * @uses get_sidebar( 'extra' )
 * @uses get_sidebar( 'default' )
 * @uses get_footer( $raindrops_document_type )
 * @uses raindrops_prepend_default_sidebar( )
 * @uses raindrops_append_default_sidebar( )
 * @uses the_post_thumbnail( )
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
do_action( 'raindrops_' . basename( __FILE__ ) );
$raindrops_current_column = raindrops_column_controller();

if ( $raindrops_current_column !== false ) {
    add_filter( "raindrops_theme_settings__raindrops_indv_css", "raindrops_color_type_custom" );
}
get_header( $raindrops_document_type );
do_action( 'raindrops_pre_' . basename( __FILE__ ) );
raindrops_debug_navitation( __FILE__ );
?>

<div id="yui-main" class="<?php raindrops_dinamic_class( 'yui-main',true ); ?>">
    <div class="<?php raindrops_dinamic_class( 'yui-b', true ); ?>">

        <div class="<?php echo raindrops_yui_class_modify(); ?>" id="container">
            <div class="<?php raindrops_dinamic_class( 'yui-u first', true ); ?>" <?php raindrops_doctype_elements( '', 'role="main"' ); ?>>
				<?php get_template_part( 'widget', 'sticky' ); ?>
                <?php
		if ( have_posts() ) {

                    while ( have_posts() ) {

                        the_post();

                        printf( '<!--%1$s-->', $raindrops_document_type );
                        ?>
                        <div class="entry the_post_thumbnailpage"><?php raindrops_before_article(); ?>
							<div  id="post-<?php the_ID(); ?>"<?php raindrops_the_article_wrapper_class(); ?>>

                            <<?php raindrops_doctype_elements( 'div', 'article' ); ?> <?php raindrops_post_class(); ?>>

                            <?php                         
							raindrops_featured_image();

                            raindrops_entry_title();

							if( 'yes' == raindrops_warehouse('raindrops_show_date_author_in_page') ) {
								raindrops_posted_on();
							}
                            ?>
                            <div class="entry-content">
                                <?php
                                raindrops_prepend_entry_content();

                                raindrops_entry_content();
                                ?>
                                <br class="clear" />
                                <?php
                                raindrops_append_entry_content();
                                ?>
                            </div>
                            <div class="linkpage clearfix">
                                <?php
                                wp_link_pages( 'before=<p class="pagenate">&after=</p>&next_or_number=number&pagelink=<span>%</span>' );
                                ?>
                            </div>
                            <br class="clear" />
                            <div class="postmetadata">
                                <?php
                                the_category( ', ' );

                                echo "&nbsp;";

                                edit_post_link( esc_html__( 'Edit', 'raindrops' ) . raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );

                                raindrops_delete_post_link( esc_html__( 'Trash', 'raindrops' ) . raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );
                                ?>
                            </div>
                            <?php
                            comments_template( '', true );
                            ?>
                            </<?php raindrops_doctype_elements( 'div', 'article' ); ?>>
							</div><?php raindrops_after_article(); ?>
                        </div>
                        <?php
                    } //endwhile

                    raindrops_next_prev_links( "nav-below" );
                } //end have post
                ?>
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
get_footer( $raindrops_document_type ); ?>