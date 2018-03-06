<?php
/**
 * Template Name: front portfolio Template
 *
 *
 * The posts contain featured image shows 9
 *
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
                        <?php raindrops_before_article(); ?>
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
                            <?php  comments_template( '', true ); ?>
                            </<?php raindrops_doctype_elements( 'div', 'article' ); ?>>
							</div><?php raindrops_after_article(); ?>
                        <?php
                    } //endwhile

/**
 *  portfolio block
 *
 */
$raindrops_portfolio_page = absint( get_query_var( 'page' ) );
$raindrops_posts_per_page = 9;
$raindrops_offset         = 0;
$args                     = array(
    'posts_per_page' => $raindrops_posts_per_page,
    'paged'          => $raindrops_portfolio_page,
    'numberposts'    => -1,
    'offset'         => 0,
    'orderby'        => 'post_date',
    'order'          => 'DESC',
    'post_type'      => 'post',
    'meta_key'       => '_thumbnail_id',
    'post_status'    => 'publish',
    'post__not_in'   => get_option( 'sticky_posts' ),
	'raindrops_tile_col' => 3,
);

raindrops_tile( $args );
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
	//lsidebar start
	get_sidebar( 'default' );
}
get_footer( $raindrops_document_type ); 
?>