<?php
/**
* Template part file for Sidebar.
* This template is not used except, when special.
* This template will be used when not exists sidebar-default or sidebar-extra templates
*
* @package Raindrops
*/
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $template;
do_action( 'raindrops_pre_part_'. basename( __FILE__, '.php' ). '_'. basename( $template ) );
?>
<div class="sidebar">
<ul>
<?php 
	if ( ! dynamic_sidebar('sidebar-1' ) ) {
	
		wp_list_pages( 'title_li=<h2 class="h2">'.  esc_html__( 'Pages', 'Raindrops' ).'</h2>' ); 
?>
	<li>
		<h2 class="h2"><?php  esc_html_e( 'Archives', 'Raindrops' ); ?></h2>
  		<ul>
<?php 
			wp_get_archives( 'type=monthly' ); 			
?>
  		</ul>
	</li>
<?php 
			wp_list_categories( 'show_count=1&title_li=<h2 class="h2">'.  esc_html__( 'Categories', 'Raindrops' ). '</h2>' ); 

 
		if ( is_front_page( ) || is_page( ) ) {
		
			wp_list_bookmarks( );
?>
	<li>
  		<h2 class="h2">Meta<?php  esc_html_e( 'Meta', 'Raindrops' ); ?></h2>
  		<ul>
<?php 
		wp_register( ); 
?>
    <li>
<?php 
		wp_loginout( ); 
?>
    </li>
<?php 
		wp_meta( ); 
?>
  </ul>
</li>
<?php 	} //if ( is_front_page( ) || is_page( ) ) ?>
<?php } //if ( ! dynamic_sidebar('sidebar-1' ) ) ?>
</ul>
</div>
<?php 		do_action( 'raindrops_after_part_'. basename( __FILE__, '.php' ). '_'. basename( $template ) ); ?>