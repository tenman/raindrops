<?php
/**
 * The xhtml1.0 transitional header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="bd">
 *
 * @package Raindrops
 * @since Raindrops 0.1
 *
 * @uses get_bloginfo( 'charset' )
 * @uses language_attributes( 'xhtml' )
 * @uses bloginfo( 'html_type' )
 * @uses bloginfo( 'charset' )
 * @uses wp_title( '|', true, 'right' )
 * @uses bloginfo( 'name' )
 * @uses get_bloginfo( 'description', 'display' )
 * @uses bloginfo( 'pingback_url' )
 * @uses is_singular( )
 * @uses get_option( 'thread_comments' )
 * @uses wp_enqueue_script( 'comment-reply' )
 * @uses wp_head( )
 * @uses body_class( $this_blog )
 * @uses raindrops_warehouse( 'raindrops_page_width' )
 * @uses raindrops_warehouse( 'raindrops_col_width' )
 * @uses wp_upload_dir( )
 * @uses raindrops_upload_image_parser($header_image_uri,'inline','#hd' )
 * @uses get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR )
 * @uses get_header_textcolor( )
 * @uses preg_match( "!([0-9a-f]{6}|[0-9a-f]{3})!si", get_header_textcolor( ) )
 * @uses home_url( )
 * @uses esc_attr( )
 * @uses get_bloginfo( 'name', 'display' )
 * @uses raindrops_header_image( $args = array( ) )
 *
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $template,  $raindrops_xhtml_media_type;

$raindrops_link_unique_text = raindrops_link_unique_text();
do_action( 'raindrops_pre_part_' . basename( __FILE__, '.php' ) );
do_action( 'raindrops_pre_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) );

if ( $raindrops_xhtml_media_type == 'application/xhtml+xml' ) {

	echo '<' . '?' . 'xml version="1.0" encoding="' . get_bloginfo( 'charset' ) . '"' . '?' . '>' . "\n";
	do_action( 'raindrops_xhtml_media_xml' );
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>>
    <head>
<?php raindrops_xhtml_http_equiv();?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
    </head>
    <body <?php body_class( ); ?>><?php has_action( 'wp_body_open' ) ? do_action('wp_body_open') : ''; ?>
		<?php if ( raindrops_warehouse( 'raindrops_disable_keyboard_focus' ) == 'enable' ) { ?>
        <div class="skip-link"><a href="#container" class="screen-reader-text" title="<?php esc_attr_e( 'Skip to content', 'raindrops' ); ?>"><?php esc_html_e( 'Skip to content', 'raindrops' ); ?></a></div>
        <?php } // raindrops_disable_keyboard_focus ?>
		<div id="<?php echo esc_attr( raindrops_warehouse( 'raindrops_page_width' ) ); ?>" class="<?php echo esc_attr( 'yui-' . raindrops_warehouse( 'raindrops_col_width' ) ); ?> hfeed">
		<?php raindrops_prepend_doc(); ?>

			<div id="top">
				<div id="hd">
					<?php
					if( raindrops_is_place_of_site_title() == true ) {

						echo raindrops_site_title();
					}
					echo raindrops_site_description();
					?>
				</div>
				<?php  raindrops_the_header_image( 'elements' );?>

				<?php	raindrops_nav_menu_primary();

						raindrops_after_nav_menu();?>

			</div>
			<div id="bd" class="clearfix">
<?php do_action( 'raindrops_after_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) ); ?>