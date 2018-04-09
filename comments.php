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
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $raindrops_document_type;
?>
<div id="comments">
        <?php if ( post_password_required() ) { ?>
        <p class="nopassword">
    <?php esc_html_e( 'This post is password protected.', 'raindrops' ); ?> 
    <?php esc_html_e( 'Enter the password to view any comments.', 'raindrops' ); ?>
        </p>
    </div>
    <?php return; ?>
<?php } //end if ( post_password_required( ) )?>
    <?php if ( have_comments() ) { ?>

		<h2 id="comments-title" class="h2"><?php
				 $comments_number = intval( get_comments_number() );
				 if ( 1 === $comments_number ) { 
					 /* translators: 1: comments title */
					  printf( _x( 'One Response to %1$s', 'comments title', 'raindrops' ),
					  '<strong>' . get_the_title() . '</strong>' );
				 } else {
					 /* translators: 1: comments count 2: comments title */
					 printf( _nx( '%1$s Response to %2$s', '%1$s Responses to %2$s', $comments_number, 'comments title', 'raindrops' ), 
					 number_format_i18n( $comments_number ), 
					'<strong>' . get_the_title() . '</strong>' );
				 }
	 ?></h2>
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { // Are there comments to navigate through? ?>
        <div id="nav-above-comments" class="clearfix">
            <span class="nav-previous"><?php previous_comments_link( '<span class="meta-nav">&#8592;</span>' . esc_html__( 'Older Comments', 'raindrops' ) ); ?></span>
            <span class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'raindrops' ) . '<span class="meta-nav">&#8594;</span>' ); ?></span>
        </div>
            <?php } // check for comment navigation?>
    <ol <?php raindrops_comment_class(); ?>>
    <?php wp_list_comments( array( 'callback' => 'raindrops_comment', 'format' => $raindrops_document_type ) ); ?>
    </ol>
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { // Are there comments to navigate through? ?>
        <div id="nav-below-comments" class="clearfix">
            <span class="nav-previous"><?php previous_comments_link( '<span class="meta-nav">&#8592;</span> ' . esc_html__( 'Older Comments', 'raindrops' ) ); ?></span>
            <span class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments ', 'raindrops' ) . '<span class="meta-nav">&#8594;</span>' ); ?></span>
        </div>
            <?php } // check for comment navigation ?>
    <?php
} else { // or, if we don't have comments:

    /* If there are no comments and comments are closed,
     * let's leave a little note, shall we?
     */
    if ( !comments_open() ) {
        ?>
        <p class="nocomments"><?php esc_html_e( 'Comments are closed.', 'raindrops' ); ?></p>
        <?php } // end ! comments_open( ) 
    }// end have_comments( )
    ?>
<br class="clear" />
<div class="social"><?php comment_form(); ?></div>
</div>