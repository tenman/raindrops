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
/**
 * Display navigation to next/previous pages when applicable
 */
raindrops_prepend_loop();

raindrops_next_prev_links();
?>
<div class="loop-before-toolbar" ><?php do_action('raindrops_loop_before_toolbar','');?></div>
<?php
if ( have_posts() ) {

    raindrops_loop_title();

    $raindrops_loop_number = 1;

	do_action( 'raindrops_in_the_loop', '', 0 ); 

    while ( have_posts() ) {

        the_post();

        $raindrops_loop_class = raindrops_loop_class( $raindrops_loop_number, get_the_ID() );

        printf( "\n". str_repeat("\t", 8 ). '<li class="loop-%1$s%2$s">', esc_attr( trim( $raindrops_loop_class[ 0 ] ) ), esc_attr( rtrim( $raindrops_loop_class[ 1 ] ) )
        );

        $raindrops_loop_number++;
        ?>

									<div id="post-<?php the_ID(); ?>"<?php raindrops_the_article_wrapper_class(); ?>>
										<<?php raindrops_doctype_elements( 'div', 'article' ); ?>  <?php raindrops_post_class(); ?>>		
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
										<?php raindrops_entry_title();?> 
										<?php
										if( 'before' == raindrops_warehouse( 'raindrops_posted_on_position' ) ) {
											?>	<div class="posted-on" ><?php
											raindrops_posted_on();
											?>
											
											</div>
										<?php
										}
										
										if( 'before' == raindrops_warehouse( 'raindrops_posted_in_position' ) ) {
											?><?php
											raindrops_posted_in();
											?><?php
										}
										?>

											<div class="entry-content clearfix">
											
										<?php raindrops_prepend_entry_content();?>
											<?php raindrops_entry_content(); ?>
												<br class="clear" />
										<?php raindrops_append_entry_content(); ?>
											
											</div>
										<?php 
										
										if( 'after' == raindrops_warehouse( 'raindrops_posted_on_position' ) ) {
											?><div class="posted-on-after"><?php
											raindrops_posted_on();
											?></div><?php
										}
										
										if( 'after' == raindrops_warehouse( 'raindrops_posted_in_position' ) ) {
											?><div class="entry-meta"><?php
											raindrops_posted_in();
											?></div><?php
										}
										?>
		<?php
		}
		?>

									</<?php raindrops_doctype_elements( 'div', 'article' ); ?>>
		</div>
								</li>
								<?php 
								$action_key = absint( $raindrops_loop_number - 1 );
								do_action('raindrops_in_the_loop_'.  $action_key,'', $action_key ); 
								?>
        <?php
    } //end while
    ?>
						</ul>
							<?php raindrops_next_prev_links( "nav-below" );
}//if have_posts
raindrops_append_loop();
?>