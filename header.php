<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $template, $raindrops_current_theme_slug;
$raindrops_link_unique_text = raindrops_link_unique_text();

do_action( 'raindrops_pre_part_' . basename( __FILE__, '.php' ) );
do_action( 'raindrops_pre_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) );
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>

	<head>
        <meta http-equiv="content-type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
		
<?php wp_head(); ?>
    </head>
    <body id="<?php echo $raindrops_current_theme_slug; ?>" <?php body_class();?>><?php has_action( 'wp_body_open' ) ? do_action('wp_body_open') : ''; ?>
		<?php if ( raindrops_warehouse( 'raindrops_disable_keyboard_focus' ) == 'enable' ) { ?>	
        <div class="skip-link"><a href="#container" class="screen-reader-text" title="<?php esc_attr_e( 'Skip to content', 'raindrops' ); ?>"><?php esc_html_e( 'Skip to content', 'raindrops' ); ?></a></div><?php echo raindrops_skip_links(); ?>
		<?php } // raindrops_disable_keyboard_focus ?>
		
        <div id="<?php echo esc_attr( raindrops_warehouse( 'raindrops_page_width' ) ); ?>" class="<?php echo esc_attr( 'yui-' . raindrops_warehouse( 'raindrops_col_width' ) ); ?> hfeed">
		<?php raindrops_prepend_doc(); ?><header id="top">
			<div id="hd" <?php raindrops_doctype_elements( '', 'role="banner"' ); ?>>
				<?php	
				if( raindrops_is_place_of_site_title() == true ) {
					
					echo raindrops_site_title();
				}
				 echo raindrops_site_description(); 
				?>               
			</div>
				<?php
				if ( function_exists('has_header_video') && function_exists('the_custom_header_markup' ) &&	has_header_video()
						&& ( true == is_home() && true == is_front_page() || false == is_home() && true == is_front_page() ) ) {
					raindrops_the_header_image();
					the_custom_header_markup();
					
				} else {
					raindrops_the_header_image();
				}

                raindrops_nav_menu_primary( );
				
				raindrops_after_nav_menu();
				?>			
		</header>
		<div id="bd" class="clearfix">
				
		<?php do_action( 'raindrops_after_part_' . basename( __FILE__, '.php' ) . '_' . basename( $template ) ); ?>	