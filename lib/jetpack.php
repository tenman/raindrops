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
	height:auto;
	}
	.embed-youtube{
	position: relative;
    padding-bottom: 56.25%;
    padding-top: 30px;
    height: 0;
	}
	.embed-youtube iframe,
	.embed-youtube object,
	.embed-youtube embed {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    min-width:160px;
    }';

		wp_add_inline_style( 'jetpack-widgets', $raindrops_css );
	}

}
?>