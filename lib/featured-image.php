<?php
$raindrops_use_featured_image_emphasis = raindrops_warehouse_clone( 'raindrops_use_featured_image_emphasis' );

if (  'yes' == $raindrops_use_featured_image_emphasis  ) {

	$raindrops_post_image_position	 = raindrops_warehouse_clone( 'raindrops_featured_image_position' );

	add_filter( 'raindrops_post_thumbnail_size_main_query', 'raindrops_post_thumbnail_size_in_the_loop', 10, 3 );

	switch ( $raindrops_post_image_position ) {

		case( 'front' ):
			add_filter( 'raindrops_embed_meta_css', 'raindrops_post_thumbnail_size_block_style' );
			break;
		case( 'left' ):
			add_filter( 'raindrops_embed_meta_css', 'raindrops_post_thumbnail_size_lefty_style' );
			break;

		default:
	}
}

$raindrops_featured_image_singular = raindrops_warehouse_clone( 'raindrops_featured_image_singular' );

switch ( $raindrops_featured_image_singular ) {

	case( 'lightbox' ):
		$raindrops_featured_image_full_size = false;
		$raindrops_use_featured_image_light_box = true;
		break;
	case( 'hide' ):
		add_filter( 'raindrops_featured_image_enable', '__return_false' );
		break;

	default:
		$raindrops_featured_image_full_size = true;
		$raindrops_use_featured_image_light_box = false;
}

if ( ! function_exists( 'raindrops_post_thumbnail_size_in_the_loop' ) ) {
/**
 * 
 * @global type $raindrops_post_image_size
 * @global type $raindrops_thumb_apply_count
 * @param type $size
 * @param type $post_id
 * @param type $array_classes
 * @return type
 * @since 1.274
 */
	function raindrops_post_thumbnail_size_in_the_loop( $size, $post_id, $array_classes ) {

		$raindrops_post_image_size		 = raindrops_warehouse_clone( 'raindrops_featured_image_size' );
		$raindrops_thumb_apply_count     = raindrops_warehouse_clone( 'raindrops_featured_image_recent_post_count' );
		$raindrops_thumb_apply_count = $raindrops_thumb_apply_count + 1;
		$raindrops_use_featured_image_emphasis = raindrops_warehouse_clone( 'raindrops_use_featured_image_emphasis' );
		if( $raindrops_use_featured_image_emphasis !== 'yes' ){

			return $size;
		}	
		preg_match( "|(MSIE )([0-9]{1,2})(\.)|si", $_SERVER[ 'HTTP_USER_AGENT' ], $regs );

		if ( isset( $regs[ 2 ] ) && $regs[ 2 ] < 9 ) {

			return $size;
		}
		if ( is_array( $raindrops_post_image_size ) ) {

			return $size;
		}

		$recent_posts = wp_get_recent_posts( array( 'numberposts' => $raindrops_thumb_apply_count ) );

		foreach ( $recent_posts as $key => $val ) {

			$id = absint( $recent_posts[ $key ][ 'ID' ] );

			if ( has_post_thumbnail( $id ) && $id == $post_id && !has_post_format( 'status', $id ) ) {

				$size = $raindrops_post_image_size;
			}
		}
		return $size;
	}
}
if ( ! function_exists( 'raindrops_post_thumbnail_size_block_style' ) ) {
/**
 * 
 * @global type $content_width
 * @global type $_wp_additional_image_sizes
 * @global type $raindrops_post_image_size
 * @global type $raindrops_thumb_apply_count
 * @param type $css
 * @return type
 * @since 1.274
 */
	function raindrops_post_thumbnail_size_block_style( $css ) {

		global $content_width, $_wp_additional_image_sizes;
		$raindrops_post_image_position	 = raindrops_warehouse_clone( 'raindrops_featured_image_position' );
		if( $raindrops_post_image_position !== 'front' ){

			return $css;
		}

		$raindrops_post_image_size		 = raindrops_warehouse_clone( 'raindrops_featured_image_size' );
		$raindrops_thumb_apply_count = raindrops_warehouse_clone( 'raindrops_featured_image_recent_post_count' );
		$raindrops_thumb_apply_count = $raindrops_thumb_apply_count;
		$raindrops_use_featured_image_emphasis = raindrops_warehouse_clone( 'raindrops_use_featured_image_emphasis' );		
		if ( $raindrops_use_featured_image_emphasis !== 'yes' ) {

			return $css;
		}
		preg_match( "|(MSIE )([0-9]{1,2})(\.)|si", $_SERVER[ 'HTTP_USER_AGENT' ], $regs );

		if ( isset( $regs[ 2 ] ) && $regs[ 2 ] < 9 ) {

			return $css;
		}

		$custom_css				 = '';
		$recent_posts			 = wp_get_recent_posts( array( 'numberposts' => $raindrops_thumb_apply_count, 'post_status' => 'publish' ) );
		$post_image_background	 = apply_filters( 'raindrops_post_image_background_style', 'rgba(123,123,123,.1);' );
		$post_image_background	 = str_replace( array( '{', '}' ), '', $post_image_background );

		foreach ( $recent_posts as $key => $val ) {

			$id					 = absint( $recent_posts[ $key ][ 'ID' ] );
			$thumb_image_size	 = raindrops_get_post_image_size( $raindrops_post_image_size );
			$padding			 = 0;

			if ( isset( $thumb_image_size[ 'width' ] ) && $thumb_image_size[ 'width' ] < $content_width ) {
				
				$padding = ( $content_width - $thumb_image_size[ 'width' ] ) / 2;
				$padding = round( ( $padding / $content_width ) * 100 );
				$padding = 'padding:0 ' . $padding . '%;';
			}

			if ( has_post_thumbnail( $id ) ) {
				$post_id = '#post-' . $id;
				$custom_css .= $post_id . " .wp-post-image{margin-bottom:1em;display:block;width:100%;" . $padding;
				$custom_css .= ' background:' . $post_image_background;
				$custom_css .= "}";
			}
		}
		return $css . $custom_css;
	}
}
if ( ! function_exists( 'raindrops_post_thumbnail_size_lefty_style' ) ) {
/**
 * 
 * @global type $raindrops_post_image_size
 * @global type $content_width
 * @global type $raindrops_thumb_apply_count
 * @param type $css
 * @return type
 * @since 1.274
 */
	function raindrops_post_thumbnail_size_lefty_style( $css ) {

		global $content_width;
		$raindrops_post_image_position	 = raindrops_warehouse_clone( 'raindrops_featured_image_position' );

		if( $raindrops_post_image_position !== 'left' ){
			return $css;
		}

		$raindrops_post_image_size		 = raindrops_warehouse_clone( 'raindrops_featured_image_size' );
		$raindrops_thumb_apply_count = raindrops_warehouse_clone( 'raindrops_featured_image_recent_post_count' );
		$raindrops_thumb_apply_count = $raindrops_thumb_apply_count;
		$raindrops_use_featured_image_emphasis = raindrops_warehouse_clone( 'raindrops_use_featured_image_emphasis' );
		
		if( $raindrops_use_featured_image_emphasis !== 'yes' ){
			
			return $css;
		}	

		preg_match( "|(MSIE )([0-9]{1,2})(\.)|si", $_SERVER[ 'HTTP_USER_AGENT' ], $regs );

		if ( isset( $regs[ 2 ] ) && $regs[ 2 ] < 9 ) {

			return $css;
		}
		if ( is_array( $raindrops_post_image_size ) ) {

			return $css;
		}

		if ( is_singular() ) {
			return $css;
		}

		if ( $raindrops_post_image_size == 'thumbnail' ) {
			$featured_image_column_width = '19.8%';
			$featured_image_column_val	 = 0.198;
		}
		if ( $raindrops_post_image_size !== 'thumbnail' ) {
			$featured_image_column_width = '30%';
			$featured_image_column_val	 = 0.3;
		}
		$padding				 = '';
		$custom_css				 = '';
		$article_column_width	 = str_replace( '%', '', $featured_image_column_width ) * 1.1;
		$article_column_width	 = $article_column_width . '%';
		$recent_posts			 = wp_get_recent_posts( array( 'numberposts' => $raindrops_thumb_apply_count, 'post_status' => 'publish' ) );
		$post_image_background	 = apply_filters( 'raindrops_post_image_background_style', 'rgba(123,123,123,.1);' );
		$post_image_background	 = str_replace( array( '{', '}' ), '', $post_image_background );

		foreach ( $recent_posts as $key => $val ) {

			$thumb_image_size = raindrops_get_post_image_size( $raindrops_post_image_size );

			if ( $thumb_image_size[ 'width' ] < $content_width ) {
				$padding = ( $content_width - $thumb_image_size[ 'width' ] ) / 2;
				$padding = round( ( $padding / $content_width ) * 100 );
				$padding = 'padding:0 ' . $padding . '%;';
			}

			$thumb_ratio = $thumb_image_size[ 'height' ] / $thumb_image_size[ 'width' ];
			$height		 = $content_width * $featured_image_column_val * $thumb_ratio;
			$height		 = apply_filters( 'raindrops_post_thumbnail_size_lefty_style_height', $height );

			$id = absint( $recent_posts[ $key ][ 'ID' ] );

			if ( has_post_thumbnail( $id ) && !has_post_format( 'status', $id ) ) {
				$post_id = '#post-' . $id;
				$custom_css .= "{$post_id} .h2-thumb{display:block; margin-bottom:1em;}
							 {$post_id} .hentry{position:relative; min-height:{$height}px;}
							 {$post_id} .wp-post-image{	position:absolute; left:0; width:{$featured_image_column_width};}
							 {$post_id} .entry-meta-list, {$post_id}  #nav-below, {$post_id}  .entry-meta-default, 
							 {$post_id} .entry-meta, {$post_id} .entry-title, {$post_id} .posted-on, 
							 {$post_id} .hentry .entry-content, {$post_id} .posted-in{
								margin-left:{$article_column_width}; }";

				$custom_css .= '@media screen and (max-width : 960px){';
				$custom_css .= $post_id . " .wp-post-image{margin-bottom:1em;display:block;width:100%;" . $padding;
				$custom_css .= ' background:' . $post_image_background;
				$custom_css .= "}";
				$custom_css .= "{$post_id} .wp-post-image{position:static; }
							 {$post_id} .entry-meta-list, {$post_id}  #nav-below, {$post_id}  .entry-meta-default, 
							 {$post_id} .entry-meta, {$post_id} .entry-title, {$post_id} .posted-on, 
							 {$post_id} .hentry .entry-content, {$post_id} .posted-in{
								margin-left:0; }";
				$custom_css .= '}';
			}
		}
		return $css . $custom_css;
	}
}
if ( ! function_exists( 'raindrops_get_post_image_size' ) ) {
/**
 * 
 * @global type $_wp_additional_image_sizes
 * @param type $size
 * @return \type|boolean
 * @since 1.274
 */
	function raindrops_get_post_image_size( $size = '' ) {

		global $_wp_additional_image_sizes;

		$sizes							 = array();
		$get_intermediate_image_sizes	 = get_intermediate_image_sizes();

		foreach ( $get_intermediate_image_sizes as $_size ) {

			if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {

				$sizes[ $_size ][ 'width' ]	 = get_option( $_size . '_size_w' );
				$sizes[ $_size ][ 'height' ]	 = get_option( $_size . '_size_h' );
				$sizes[ $_size ][ 'crop' ]	 = (bool) get_option( $_size . '_crop' );
			} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {

				$sizes[ $_size ] = array(
					'width'	 => $_wp_additional_image_sizes[ $_size ][ 'width' ],
					'height' => $_wp_additional_image_sizes[ $_size ][ 'height' ],
					'crop'	 => $_wp_additional_image_sizes[ $_size ][ 'crop' ]
				);
			}
		}

		if ( $size ) {

			if ( isset( $sizes[ $size ] ) ) {
				return $sizes[ $size ];
			} else {
				return false;
			}
		}
		return $sizes;
	}
}
?>