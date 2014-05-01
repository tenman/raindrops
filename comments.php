<?php
/**
 * The template part file for displaying Comments.
 *
 * @package Raindrops
 * @since Raindrops 0.1
 *
 * @uses post_password_required( )
 * @uses have_comments( )
 * @uses get_comments_number( )
 * @uses number_format_i18n( get_comments_number( ) )
 * @uses get_the_title( )
 * @uses get_comment_pages_count( )
 * @uses previous_comments_link( )
 * @uses next_comments_link( )
 * @uses comments_open( )
 * @uses comment_form( )
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
global $raindrops_document_type;
?>
<div id="comments">
        <?php if ( post_password_required() ) { ?>
        <p class="nopassword">
    <?php esc_html_e( 'This post is password protected.', 'Raindrops' ); ?> 
    <?php esc_html_e( 'Enter the password to view any comments.', 'Raindrops' ); ?>
        </p>
    </div>
    <?php return; ?>
<?php } //end if ( post_password_required( ) )?>
    <?php if ( have_comments() ) { ?>
    <h2 id="comments-title" class="h2">
        <?php
        printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'Raindrops' ), number_format_i18n( get_comments_number() ), '<strong>' . get_the_title() . '</strong>', get_comments_number()
        );
        ?>
    </h2>
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { // Are there comments to navigate through??>
        <div id="nav-above-comments" class="clearfix">
            <span class="nav-previous">
        <?php previous_comments_link( '<span class="meta-nav">&larr;</span>' . esc_html__( 'Older Comments', 'Raindrops' ) ); ?>
            </span>
            <span class="nav-next">
                <?php next_comments_link( esc_html__( 'Newer Comments', 'Raindrops' ) . '<span class="meta-nav">&rarr;</span>' ); ?>
            </span>
        </div>
            <?php } // check for comment navigation?>
    <ol <?php raindrops_comment_class(); ?>>
    <?php wp_list_comments( array( 'callback' => 'raindrops_comment', 'format' => $raindrops_document_type ) ); ?>
    </ol>
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { // Are there comments to navigate through? ?>
        <div id="nav-below-comments" class="clearfix">
            <span class="nav-previous">
        <?php previous_comments_link( '<span class="meta-nav">&larr;</span> ' . esc_html__( 'Older Comments', 'Raindrops' ) ); ?>
            </span>
            <span class="nav-next">
                <?php next_comments_link( esc_html__( 'Newer Comments ', 'Raindrops' ) . '<span class="meta-nav">&rarr;</span>' ); ?>
            </span>
        </div>
            <?php } // check for comment navigation ?>
    <?php
} else { // or, if we don't have comments:

    /* If there are no comments and comments are closed,
     * let's leave a little note, shall we?
     */
    if ( !comments_open() ) {
        ?>
        <p class="nocomments">
        <?php esc_html_e( 'Comments are closed.', 'Raindrops' ); ?>
        </p>
        <?php } // end ! comments_open( ) 
    }// end have_comments( )
    ?>
<br class="clear" />
<div class="social">
    <?php comment_form(); ?>
</div>
</div>