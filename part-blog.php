<?php
/**
 * Template part file part-blog
 *
 * @package Raindrops
 * @since Raindrops 0.1
 *
 * @uses the_ID( )
 * @uses raindrops_post_class( )
 * @uses get_option( 'date_format' )
 * @uses the_time( )
 * @uses get_avatar( )
 * @uses apply_filters( )
 * @uses the_category( )
 * @uses the_tags( )
 * @uses sprintf( )
 * @uses get_author_posts_url( )
 * @uses comments_popup_link( )
 * @uses dynamic_sidebar( )
 * @uses edit_post_link( )
 * @uses the_permalink( )
 * @uses the_title_attribute( )
 * @uses raindrops_entry_title( )
 * @uses raindrops_entry_content( )
 * @uses wp_link_pages( )
 * @uses is_single( )
 * @uses raindrops_prev_next_post( )
 * @uses comment_template( )
 * @uses get_day_link( )
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $template,$raindrops_tag_emoji, $raindrops_category_emoji,$post,$raindrops_grid_posted_in;

do_action( 'raindrops_pre_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) );
$raindrops_date_html_module ='<a href="%1$s"><%3$s class="entry-date updated" %4$s>%2$s</%3$s></a>';
$raindrops_date_format      = get_option( 'date_format' ) . ' ' . get_option( 'time_format' );
$raindrops_archive_year     = get_the_time( 'Y' );
$raindrops_archive_month    = get_the_time( 'm' );
$raindrops_archive_day      = get_the_time( 'd' );
$raindrops_day_link         = esc_url( get_day_link( $raindrops_archive_year, $raindrops_archive_month, $raindrops_archive_day ) . '#post-' . $post->ID
);
$raindrops_display_article_publish_date = raindrops_warehouse_clone( 'raindrops_display_article_publish_date' );
$raindrops_display_article_author = raindrops_warehouse_clone( 'raindrops_display_article_author' );

$use_japanese_date = raindrops_warehouse('raindrops_japanese_date');

if ( 'yes' == $use_japanese_date && 'ja' == get_locale() ) {
	// japanese date
	$raindrops_archive_year     = raindrops_year_name_filter( $raindrops_archive_year );
	$raindrops_archive_month    = raindrops_archive_day_filter_month( $raindrops_archive_month );
	$raindrops_archive_day      = raindrops_archive_day_filter_day( $raindrops_archive_day );
	
	
	$raindrops_status_date = $raindrops_archive_year. $raindrops_archive_month. $raindrops_archive_day;
} else {
	
	$raindrops_status_date      = get_the_time( $raindrops_date_format );
}



if ( is_single() ) {

    /**
     * 	Template for Single post
     *
     *
     *
     */
    ?>
    <ul class="entry-meta-list left">
		<?php 
		if( 'show' == $raindrops_display_article_publish_date ) {
			
			echo '<li class="category-blog-publish-date post-format-status-publish-date">';
			
			printf( $raindrops_date_html_module, 
							$raindrops_day_link, 
							$raindrops_status_date, raindrops_doctype_elements( 'span', 'time', false ),
							raindrops_doctype_elements( '', 'datetime="' . esc_attr( get_the_date( 'c' ) ) . '"', false ) );
			echo '</li>';
		 } 

		if( 'avatar' == $raindrops_display_article_author ) { 
			
			echo '<li class="blog-avatar post-format-status-avatar">';

			$raindrops_avatar = get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'raindrops_author_bio_avatar_size', 64 ), '', get_the_author_meta( 'display_name' ) );
			$blog_avatar_html = '<span class="author vcard"><a class="url" href="%1$s">%2$s<span class="fn n">%3$s</span></a></span>';

			printf( $blog_avatar_html, 
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), 
					$raindrops_avatar, 
					get_the_author_meta( 'display_name' ) 
			);
			
			echo '</li>';
		} ?>
		
		<li class="blog-entry-meta"><?php raindrops_posted_in(); ?></li>
        
        <?php
		if ( comments_open() ) {

			echo '<li class="comment">';

			comments_popup_link( esc_html__( 'Leave a comment', 'raindrops' ) . raindrops_link_unique( 'Post', $post->ID ), esc_html__( '1 Comment', 'raindrops' ), esc_html__( '% Comments', 'raindrops' )
			);
			echo '</li>';
		}
 
        dynamic_sidebar( 'sidebar-5' );
        ?>      
    </ul>

    <div class="blog-main right post-format-status-main">
            <?php
            raindrops_entry_title();
            ?>
        <div class="entry-content clearfix">
            <?php
            raindrops_prepend_entry_content();

            raindrops_entry_content();
            ?>
            <div class="clearfix">
        <?php
        raindrops_append_entry_content();
        ?>
            </div>
            <?php
            wp_link_pages( 'before=<p class="paginate clearfix">&after=</p>&next_or_number=number&pagelink=<span>%</span>' );
            ?>
        </div>

    </div>
    <div class="clearfix"></div>
            <?php              
} else {

	/**
	 * Template for Not Single post
	 *
	 *
	 *
	 */
                ?>
    <div class="format-status-not-single-post">
       
        <ul class="entry-meta-list left">
		<?php 
		if( 'show' == $raindrops_display_article_publish_date ) {
			
			echo '<li class="category-blog-publish-date post-format-status-publish-date">';
			
            printf( $raindrops_date_html_module, 
							$raindrops_day_link, 
							$raindrops_status_date, raindrops_doctype_elements( 'span', 'time', false ),
							raindrops_doctype_elements( '', 'datetime="' . esc_attr( get_the_date( 'c' ) ) . '"', false ) 
			);
			
			echo '</li>';
		 } 
		?>
		<?php 
		if( 'avatar' == $raindrops_display_article_author ) {
			
            echo '<li class="blog-avatar">';
 
			$raindrops_avatar = get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'raindrops_author_bio_avatar_size', 48 ), '', get_the_author_meta( 'display_name' )
    );
			$blog_avatar_html = '<span class="author vcard"><a class="url" href="%1$s">%2$s<span class="fn n">%3$s</span></a></span>';
			
			printf( $blog_avatar_html, esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), $raindrops_avatar, get_the_author_meta( 'display_name' ) );

			echo '</li>';		
		} 
		
		if( 'show' == $raindrops_display_article_author ) {
			
			echo '<li class="author">';

			printf(	'<span class="author-label">%1$s</span><span class="author vcard"><a class="url fn n" href="%2$s">%3$s</a></span>',
				esc_html__( 'Author:', 'raindrops' ), 
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_html( get_the_author()
				) );

			echo '</li>';
		} 
		?></ul>

        <div class="blog-main right post-format-status-main">
                <?php
                raindrops_entry_title();
                ?>

            <div class="entry-content clearfix">
                <?php
                raindrops_prepend_entry_content();

                raindrops_entry_content();
                ?>
                <div class="clearfix">
                <?php
                raindrops_append_entry_content();
                ?>
                </div>
    <?php
    wp_link_pages( 'before=<p class="paginate clearfix">&after=</p>&next_or_number=number&pagelink=<span>%</span>' );
    ?>
            </div>
        </div>
            <?php
            if ( !is_tax() ) {
                
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
				
            }

                if ( is_user_logged_in() && is_tax() ) {
                    ?>
            <div class="entry-utility entry-meta clear">
            <?php
            edit_post_link( esc_html__( 'Edit', 'raindrops' ) . raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );

            raindrops_delete_post_link( esc_html__( 'Trash', 'raindrops' ) . raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );
            ?>
            </div>
            <?php
            } elseif ( is_tax() ) {

                $raindrops_date_html_module = '<p style="text-align:right;">' . $raindrops_date_html_module . '</p>';

				printf( $raindrops_date_html_module, 
							$raindrops_day_link, 
							$raindrops_status_date, raindrops_doctype_elements( 'span', 'time', false ),
							raindrops_doctype_elements( '', 'datetime="' . esc_attr( get_the_date( 'c' ) ) . '"', false ) );
            }
            ?>
    </div>
<?php
    }
    do_action( 'raindrops_after_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) );
?>