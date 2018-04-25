<?php
/**
 * The template for displaying Auther.
 * *
 * @package Raindrops
 * @since Raindrop 0.1
 *
 * @uses get_header( $raindrops_document_type )	include template part file
 * @uses raindrops_yui_class_modify( )	add class attribute value
 * @uses raindrops_is_2col( 'style="width:99%;"' )	add inline style attribute
 * @uses get_avatar( )
 * @uses apply_filters( 'raindrops_author_bio_avatar_size', 60 )
 * @uses have_posts( )
 * @uses have_posts( )
 * @uses the_post( )
 * @uses get_option( 'date_format' )
 * @uses the_time( $raindrops_date_format )
 * @uses the_permalink( )
 * @uses the_title_attribute( )
 * @uses raindrops_entry_title( )
 * @uses the_category( ', ' )
 * @uses get_the_tag_list( '', ', ' )
 * @uses get_sidebar( 'extra' )	include template part file
 * @uses get_sidebar( 'default' )	include template part file
 * @uses get_footer( $raindrops_document_type ) 
 * @uses raindrops_prepend_default_sidebar( )
 * @uses raindrops_append_default_sidebar( )
 */
if ( !defined( 'ABSPATH' ) ) {
	exit;
}
$raindrops_current_column = raindrops_column_controller();

$curauth = get_userdata( intval( $author ) );

get_header( $raindrops_document_type );

do_action( 'raindrops_pre_' . basename( __FILE__ ) );

raindrops_debug_navitation( __FILE__ );
?>
<div id="yui-main" class="<?php raindrops_dinamic_class( 'yui-main', true ); ?>">
    <div class="<?php raindrops_dinamic_class( 'yui-b', true ); ?>">
        <div class="<?php raindrops_extra_sidebar_classes(); ?>" id="container">

            <div class="<?php raindrops_dinamic_class( 'yui-u first', true ); ?>" >
                <<?php raindrops_doctype_elements( 'div', 'main' ); ?> <?php raindrops_doctype_elements( '', 'role="main"' ); ?>>	
                <h2 class="h2"><?php 
				/* translators: 1: author-nickname */
				printf( esc_html__( 'Author Archives: %s', 'raindrops' ), esc_html( $curauth->nickname ) ); ?></h2>

                <table <?php raindrops_doctype_elements( 'summary="author infomation"', '' ); ?> class="author-meta left auto">
                    <tr>
                        <td class="avatar-col">
							<?php
							echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'raindrops_author_bio_avatar_size', 60 ), '', esc_attr__( 'Author Avatar Image', 'raindrops' ) );
							?>
                        </td>
                        <td>
                            <dl class="author raindrops">
								<?php if ( esc_html( $curauth->description ) ) { ?>
									<dt><?php esc_html_e( 'Profile', 'raindrops' ); ?></dt>
									<dd><?php echo wpautop( esc_html( $curauth->description ) ); ?>	</dd>
								<?php }// end if ( esc_html( $curauth->description ) ) ?>
								<?php if ( !empty( $curauth->user_url ) ) { ?>
									<dt><?php esc_html_e( 'Website', 'raindrops' ); ?></dt>
									<dd><?php
										$raindrops_html_author_url = '<span class="author vcard"><a class="url fn nickname" href="%1$s" title="%2$s">%3$s</a></span>';

										printf( $raindrops_html_author_url, esc_url( $curauth->user_url ), sprintf( 'link to author %1$s', esc_attr( $curauth->display_name ) ), esc_url( $curauth->user_url )
										);
								  ?></dd>
								<?php } //if ( ! empty( $curauth->user_url ) ) {?>
                                <dt><?php esc_html_e( 'registered', 'raindrops' ); ?></dt>
                                <dd><?php echo apply_filters( 'get_the_date', $curauth->user_registered ); ?></dd>
                            </dl>
                        </td>
                    </tr>
                </table>
                <br class="clear" />
                <h2 class="h2"><?php esc_html_e( "Recent post", 'raindrops' ); ?></h2>
                <dl class="author">
                    <!-- The Loop -->
					<?php
					if ( have_posts() ) {
						while ( have_posts() ) {
							the_post();
							?>
							<dt>
								<?php
								$raindrops_date_format	 = get_option( 'date_format' );
								$raindrops_year			 = get_the_time( 'Y' );
								$raindrops_month		 = get_the_time( 'm' );
								$raindrops_day			 = get_the_time( 'd' );
								$day_link				 = esc_url( get_day_link( $raindrops_year, $raindrops_month, $raindrops_day ) . '#post-' . $post->ID );

								printf( '<a href="%1$s" title="%2$s"><%4$s class="entry-date updated" %5$s>%3$s</%4$s></a>', $day_link, esc_attr( 'archives daily ' . get_the_time( $raindrops_date_format ) ), get_the_date( $raindrops_date_format ), raindrops_doctype_elements( 'span', 'time', false ), raindrops_doctype_elements( '', 'datetime="' . esc_attr( get_the_date( 'c' ) ) . '"', false )
								);

								raindrops_entry_title( array( 'raindrops_title_element' => 'span' ) );
								?>
							</dt>
							<dd>
								<?php
								esc_html_e( 'Categories :', 'raindrops' );

								the_category( ', ' );
								?>
							</dd>
							<dd><?php
								esc_html_e( 'Tag :', 'raindrops' );

								echo get_the_tag_list( '', ', ' );
								?>
							</dd>
							<?php
							$format = get_post_format();

							if ( $format !== false ) {
								?>
								<dd><?php
									esc_html_e( 'Format :', 'raindrops' );

									echo ' <a href="' . esc_url( get_post_format_link( $format ) ) . '">' . esc_html( get_post_format_string( $format ) ) . '</a>';
									?>
								</dd>
								<?php
							} //end if ( $format !== false ) 
						} //end while			
					} else {
						?>
						<p><?php esc_html_e( 'No posts by this author.', 'raindrops' ); ?></p>
					<?php } //if ( have_posts( ) ) 
					?>
                </dl>
				<?php raindrops_next_prev_links( "nav-below" ); ?>
				</<?php raindrops_doctype_elements( 'div', 'main' ); ?>>                
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