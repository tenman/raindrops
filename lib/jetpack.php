<?php
add_action( 'wp_enqueue_scripts', 'raindrops_jetpack_css' );

if ( !function_exists( 'raindrops_jetpack_css' ) ) {
/**
 * 
 * @since 1.247
 */
	function raindrops_jetpack_css() {

		$raindrops_css = '	.jetpack-image-container img,
	.jetpack-display-remote-posts img{
	max-width:100%;
	height:auto;';

		wp_add_inline_style( 'jetpack-widgets', $raindrops_css );
	}

}
?>