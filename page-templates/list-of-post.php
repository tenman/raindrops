<?php
/*
  Template Name: list of post
 */
/* Customize options
  $raindrops_list_of_posts_per_page	= 10;
  $raindrops_list_of_posts_length		= 200;
  $raindrops_list_of_posts_more		= '[...]';
  $raindrops_list_of_posts_use_toggle	= true;
 */

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
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
                    <?php get_template_part( 'widget', 'sticky' ); ?>
            <div class="<?php raindrops_dinamic_class( 'yui-u first', true ); ?>" <?php raindrops_doctype_elements( '', 'role="main"' ); ?>>
                <div class="entry page list-of-post-entry">
                    <?php
                    $query = get_query_var( 'paged' );

                    if ( have_posts() && is_page() && empty( $query ) ) {

                        while ( have_posts() ) {

                            the_post();
                            ?>
                            <div class="entry page"><div  id="post-<?php the_ID(); ?>"> 				 
                                <<?php raindrops_doctype_elements( 'div', 'article' ); ?> <?php raindrops_post_class(); ?>>
                                <?php
                                raindrops_entry_title();
                                ?>
                                <div class="entry-content">
                                    <?php
                                    raindrops_prepend_entry_content();

                                    the_post_thumbnail( 'full', 'class=page-featured-image' );

                                    raindrops_entry_content();
                                    ?>
                                    <br class="clear" />
                                    <?php
                                    raindrops_append_entry_content();
                                    ?>
                                </div>					
                                </<?php raindrops_doctype_elements( 'div', 'article' ); ?>></div>
                            </div>
                            <?php
                        } //end while
                    } //end have posts
                    ?>
                </div>
                <div id="list-of-post">
                    <?php
                    if ( !empty( $query ) ) {

                        raindrops_entry_title();
                    }
                    /**
                     * List of Posts
                     */
                    raindrops_list_of_posts();
                    ?>
                </div>
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