<?php 
		global $template;
		do_action( 'raindrops_pre_part_'. basename( __FILE__, '.php' ). '_'. basename( $template ) );
	?><!DOCTYPE html>
<html <?php language_attributes( ); ?>>
	<head>
		<meta http-equiv="content-type" content="<?php bloginfo( 'html_type' );?>; charset=<?php bloginfo( 'charset' ); ?>" />
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]--> 
<?php
		global $raindrops_link_unique_text;
		wp_head( );
?>
	</head>
<body <?php body_class( ); ?>>
	<div id="<?php echo esc_attr( raindrops_warehouse( 'raindrops_page_width' ) ); ?>" class="<?php echo esc_attr( 'yui-'.raindrops_warehouse( 'raindrops_col_width' ) ); ?> hfeed">
<?php
		raindrops_prepend_doc( );
?>
		<header id="top">
			<div id="hd" <?php raindrops_doctype_elements( '','role="banner"' );?>>
				<div class="skip-link screen-reader-text">
				<a href="#container" title="<?php esc_attr_e( 'Skip to content', 'Raindrops' );?>"><?php esc_html_e( 'Skip to content', 'Raindrops' ); ?></a>
				</div>
<?php
/**
 * Conditional Switch html headding element
 *
 * example
 *  raindrops_site_title( " add some text" );
 *
 */
		echo raindrops_site_title( );
/**
 * Site description diaplay 
 *
 *
 *
 */
		echo raindrops_site_description( );
?>
			</div>
<?php
/**
 * header image
 *
 * if no link home_url( ) then use 'elements'
 * if need link home_url( ) then use 'home_url'
 *
 * var 1.116 default setting change from home_url to elements
 * FAE accessibility rule Ensure that links that point to the same HREF use the same link text.
 *
 *
 * Tips
 * Header Image and Site description
 * Fixed width page can change a header image from this template ( without fluid layout )
 *
 	echo raindrops_header_image( 'default', 
									array('height'=> '300px',
									'img' => 'http://tenman.info/images/pen.jpg',
									//'img' => 'http://example.com/images/example.jpg',
									'text_attr' => 'style="color:red;"' ,
									'text'=> 'change text' ) 
							);
 * Page width fluid can below
 *
  	echo raindrops_header_image( 'default', 
									array( 'text_attr' => 'class="hello"' ,
									'text'=> 'change text' ) 
							);
 *
 */
		if ( true == $raindrops_link_unique_text ) {
		 
			echo raindrops_header_image( 'elements' );
		} else {
		 
			echo raindrops_header_image( 'home_url' );
		}
		
/**
 * horizontal menubar
 *
 *
 *
 *
 */
 
		raindrops_nav_menu_primary( );

		raindrops_after_nav_menu( );
?>
		</header>
		<div id="bd" class="clearfix">
<?php 		do_action( 'raindrops_after_part_'. basename( __FILE__, '.php' ). '_'. basename( $template ) ); ?>