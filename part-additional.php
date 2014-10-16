<?php
/**
 * Template part file part-additional.php
 *
 * @package Raindrops
 * @since Raindrops 1.247
 *
 */
if ( !defined( 'ABSPATH' ) ) {
	exit;
}
global $template;
do_action( 'raindrops_pre_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) );
$format = get_post_format();

if ( false === $format ) {

	$raindrops_entry_meta_class = 'entry-meta-default';
} else {

	$raindrops_entry_meta_class = 'entry-meta-' . $format;
}
raindrops_entry_title();
?>
<div class="<?php echo $raindrops_entry_meta_class; ?>">
	<?php
	raindrops_posted_on();
	?>
</div>

<div class="entry-content clearfix">
	<?php
	raindrops_prepend_entry_content();

	$content	 = $post->post_content;
	$content	 = apply_filters( 'the_content', $content );
	$content	 = apply_filters( 'raindrops_entry_content', $content );
	$content	 = str_replace( ']]>', ']]&gt;', $content );
	$content	 = str_replace( '<span id="more-' . $post->ID . '"></span>', '<!--more-->', $content );
	$text_array	 = get_extended( $content );

	if ( empty( $text_array[ 'more_text' ] ) ) {

		$text_array[ 'more_text' ] = esc_html__( 'Continue&nbsp;reading ', 'Raindrops' ) . '<span class="meta-nav">&rarr;</span><span class="more-link-post-unique">' . esc_html__( '&nbsp;Post ID&nbsp;', 'Raindrops' ) . get_the_ID() . '</span>';
	}
	
	if ( $text_array[ 'extended' ] !== '' ) {

		$text_array[ 'main' ] .= sprintf( '<p class="additional-more"><a href="%1$s"><span>%2$s</span></a></p>', get_permalink(), $text_array[ 'more_text' ] );
	}
	if ( has_post_thumbnail( $post->ID ) && is_front_page() ) {
		?>
		<div class="line">
			<div class="unit size1of4"><?php the_post_thumbnail(); ?></div>
			<div class="unit size3of4"><?php echo $text_array[ 'main' ]; ?></div>
		</div>
		<?php
	} else {

		echo $text_array[ 'main' ];
	}

	wp_link_pages( 'before=<p class="pagenate clearfix">&after=</p>&next_or_number=number&pagelink=<span>%</span>' );
	?>
	<br class="clear" />
	<?php
	raindrops_append_entry_content();
	?>
</div>

<div class="entry-utility entry-meta">
	<?php
	edit_post_link( esc_html__( 'Edit', 'Raindrops' ) . raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );

	raindrops_delete_post_link( esc_html__( 'Trash', 'Raindrops' ) . raindrops_link_unique( 'Post', $post->ID ), '<span class="edit-link">', '</span>' );
	?>
</div>
<?php
if ( is_singular() && !is_front_page() ) {

	raindrops_prev_next_post( 'nav-below' );

	comments_template( '', true );
}
do_action( 'raindrops_after_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) );
?>	
