<?php
/**
 * Template for search .
 *
 *
 * @package Raindrops
 * @since Raindrops 0.1
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $raindrops_skip_excerpt, $raindrops_excerpt_condition, $raindrops_grid_posted_in;
do_action( 'raindrops_' . basename( __FILE__ ) );
$raindrops_current_column = raindrops_column_controller();

get_header( $raindrops_document_type );
do_action( 'raindrops_pre_' . basename( __FILE__ ) );
?>
<div id="yui-main" class="<?php raindrops_dinamic_class( 'yui-main',true ); ?>">
<?php raindrops_debug_navitation( __FILE__ ); ?>
    <div class="<?php raindrops_dinamic_class( 'yui-b', true ); ?>">
        <div class="<?php raindrops_extra_sidebar_classes(); ?>" id="container">
            <div class="<?php raindrops_dinamic_class( 'yui-u first', true ); ?>" <?php raindrops_doctype_elements( '', 'role="main"' ); ?>>
<?php raindrops_prepend_loop(); ?>

<?php if ( have_posts() ) { 
            raindrops_next_prev_links(); ?>	
                    <h1 class="pagetitle h1">Search Results : <?php the_search_query(); ?></h1>
					
					<?php raindrops_search_from_terms(); ?>
					<div class="loop-before-toolbar" ><?php do_action('raindrops_loop_before_toolbar','');?></div>
			
                    <ul class="index search-results">
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
						
                                <div id="post-<?php the_ID(); ?>"<?php raindrops_the_article_wrapper_class(); ?>>
									 <<?php raindrops_doctype_elements( 'div', 'article' ); ?> <?php raindrops_post_class( array( 'clearfix' ) ); ?>>	
                                    <?php
                                    raindrops_entry_title();
                                   
										if( 'before' == raindrops_warehouse( 'raindrops_posted_on_position' ) ) {
											?><div class="posted-on" ><?php
											raindrops_posted_on();
											?></div><?php
										}
										
										if( 'before' == raindrops_warehouse( 'raindrops_posted_in_position' ) ) {
											?><?php
											raindrops_posted_in();
											?><?php
										}
									?>
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
                                    <?php 
										if( 'after' == raindrops_warehouse( 'raindrops_posted_on_position' ) && true !== $raindrops_grid_posted_in ) {
											raindrops_posted_on(); 
										}
										if ( 'after' == raindrops_warehouse( 'raindrops_posted_in_position' ) ) {
											if( true == $raindrops_grid_posted_in ) {
											?><div class="click-drawing-container" tabindex="0"><div class="entry-meta drawing-content"><?php
											
											if( 'after' == raindrops_warehouse( 'raindrops_posted_on_position' ) && true == $raindrops_grid_posted_in ) {
												raindrops_posted_on(); 
											}
											
												raindrops_posted_in();
												?></div></div><?php
											} else {
												?><div class="entry-meta"><?php
												raindrops_posted_in();
												?></div><?php
											}		
										}
										?>
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
                            esc_html_e( "Nothing was found though it was regrettable. Please change the key word if it is good, and retrieve it.", 'raindrops' );
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
                <div class="yui-u"><?php get_sidebar( 'extra' ); ?></div>
                <?php
            } elseif ( $rsidebar_show && false == $raindrops_current_column ) {
                ?>
                <div class="yui-u"><?php get_sidebar( 'extra' ); ?></div>
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