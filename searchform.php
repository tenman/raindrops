<?php
/**
 * Template for search form.
 *
 *
 * @package Raindrops
 * @since Raindrops 0.1
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
global $raindrops_document_type, $template;
do_action( 'raindrops_pre_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) );

if ( 'html5' == $raindrops_document_type ) {
    ?>
    <form method="get" name="searchform" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <div class="searchform">
            <label class="screen-reader-text" for="s">Search for:</label>
            <input type="text" value="<?php the_search_query(); ?>" pattern="^[^(<|>)]+$" title="<?php esc_attr_e( 'must not contain html tags', 'Raindrops' ); ?>" placeholder="<?php esc_attr_e( 'Search', 'Raindrops' ); ?>" name="s" id="s"  />
            <input type="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'Raindrops' ); ?>" />
        </div>
    </form>
    <?php
} else {
    ?>
    <form method="get" name="searchform" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <div class="searchform">
            <label class="screen-reader-text" for="s">Search for:</label>
            <input type="text" value="<?php the_search_query(); ?>" name="s" id="s" accesskey="s" tabindex="1" />
            &nbsp;
            <input type="submit" id="searchsubmit" value="<?php esc_html_e( 'Search', 'Raindrops' ); ?>" accesskey="b" tabindex="2" />
        </div>
    </form>
    <?php
}
do_action( 'raindrops_after_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) );
?>