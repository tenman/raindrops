<?php
/**
 * The template for displaying Comments.
 *
 * @package WordPress
 * @subpackage Raindrops
 * @since Raindrops 0.1
 */
?>

<div id="comments">
<?php if ( post_password_required() ) : ?>
    <p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'raindrops' ); ?></p>
</div><!-- #comments -->
<?php return;   endif;?>

<?php if ( have_comments() ) : ?>

    <h2 id="comments-title" class="h2"><?php printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'raindrops' ),number_format_i18n( get_comments_number() ), '<strong>' . get_the_title() . '</strong>' ,get_comments_number());?></h2>



<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>


<div id="nav-above" class="clearfix">
                <span class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'raindrops' ) ); ?></span>
                <span class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'raindrops' ) ); ?></span>
            </div> <!-- .navigation -->



<?php endif; // check for comment navigation ?>

            <ol class="commentlist">
                <?php   wp_list_comments( array( 'callback' => 'raindrops_comment' ) );?>
            </ol>



<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>

<div id="nav-below" class="clearfix">
                <span class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'raindrops' ) ); ?></span>
                <span class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'raindrops' ) ); ?></span>
            </div> <!-- .navigation -->

<?php endif; // check for comment navigation ?>



<?php else : // or, if we don't have comments:

    /* If there are no comments and comments are closed,
     * let's leave a little note, shall we?
     */
if ( ! comments_open() ) :
?>
    <p class="nocomments"><?php _e('Comments are closed.','Raindrops'); ?></p>
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

<br class="clearfix" />
<div class="social">
<?php comment_form(); ?>
</div>
</div><!-- #comments -->
