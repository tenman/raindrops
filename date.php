<?php
/**
 * The template for Yearly monthly each date Archives
 *
 *
 * @package Raindrops
 *
 * License: GNU General Public License v2.0
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * @uses user_trailingslashit( )
 * @uses trailingslashit( )
 * @uses remove_query_arg( )
 * @uses get_query_var( 'paged' )
 * @uses get_option( 'posts_per_page' )
 * @uses get_template_part( 'archive' )
 * @uses mysql2date( )
 * @uses raindrops_yui_class_modify( )
 * @uses raindrops_is_2col( 'style="width:99%;"' )
 * @uses query_posts( "posts_per_page=-1&year=$ye" )
 * @uses raindrops_get_year( $one_year, $ye )
 * @uses wp_reset_query( )
 * @uses raindrops_month_list( $one_month, $ye, $mo )
 * @uses raindrops_get_day( $one_day, $ye, $mo, $da )
 * @uses paginate_links( $pagination )
 * @uses get_sidebar( 'extra' )
 * @uses get_sidebar( 'default' )
 * @uses get_footer( $raindrops_document_type )
 * @uses raindrops_prepend_default_sidebar( )
 * @uses raindrops_append_default_sidebar( )
 */
/*
  date.php - calendar based archive navigation
  copyright ( c ) 2005 Scott Merrill ( skippy@skippy.net )
  Released under the terms of the GNU GPL version 2
  http://www.gnu.org/licenses/gpl.html
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
do_action( 'raindrops_' . basename( __FILE__ ) );
global $wp_query, $wp_rewrite;
$raindrops_current_column = raindrops_column_controller();

if ( $wp_query->query_vars[ 'paged' ] > 1 ) {

    $current = $wp_query->query_vars[ 'paged' ];
} else {

    $current = 1;
}

if ( have_posts() ) {

    $ye = mysql2date( 'Y', $wp_query->posts[ 0 ]->post_date );
    $mo = mysql2date( 'm', $wp_query->posts[ 0 ]->post_date );
    $da = mysql2date( 'd', $wp_query->posts[ 0 ]->post_date );
} else {

    get_template_part( '404' );
}

$calendar_page_number = get_query_var( 'paged' );
$post_per_page_pre    = get_option( 'posts_per_page' );
$post_per_page        = apply_filters( 'raindrops_month_list_post_count', $post_per_page_pre );

if ( isset( $ye ) && !empty( $ye ) && isset( $mo ) && !empty( $mo ) ) {

    $raindrops_page_total = ( int ) ceil( $wp_query->max_num_pages * $post_per_page_pre / $post_per_page );
} else {

    $raindrops_page_total = $wp_query->max_num_pages;
}

$pagination = array( 'base'     => esc_url( add_query_arg( 'paged', '%#%' ) ),
    'format'   => '',
    'total'    => $raindrops_page_total,
    'current'  => $current,
    'show_all' => true,
    'type'     => 'plain'
);

if ( $wp_rewrite->using_permalinks() ) {

    $pagination[ 'base' ] = user_trailingslashit( trailingslashit( esc_url( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) ) . 'page/%#%/', 'paged' );
	$pagination[ 'base' ] = esc_url( $pagination[ 'base' ] );
}

if ( 0 == $calendar_page_number ) {

    $calendar_page_number = 1;
}

$calendar_page_last  = $calendar_page_number * $post_per_page;
$calendar_page_start = $calendar_page_last - $post_per_page;
$weekdaynames        = array(
    0 => esc_html__( 'Sunday', 'raindrops' ),
    1 => esc_html__( 'Monday', 'raindrops' ),
    2 => esc_html__( 'Tuesday', 'raindrops' ),
    3 => esc_html__( 'Wednesday', 'raindrops' ),
    4 => esc_html__( 'Thursday', 'raindrops' ),
    5 => esc_html__( 'Friday', 'raindrops' ),
    6 => esc_html__( 'Saturday', 'raindrops' )
);
get_header( $raindrops_document_type );
do_action( 'raindrops_pre_' . basename( __FILE__ ) );
raindrops_debug_navitation( __FILE__ );
?>
<div id="yui-main" class="<?php raindrops_dinamic_class( 'yui-main',true ); ?>">
    <div class="<?php raindrops_dinamic_class( 'yui-b', true ); ?>">
        <div class="<?php echo raindrops_yui_class_modify(); ?>" id="container">
            <!-- content -->
            <div class="<?php raindrops_dinamic_class( 'yui-u first', true ); ?>" <?php raindrops_doctype_elements( '', 'role="main"' ); ?>>
<?php raindrops_prepend_loop(); ?>

                <h2 id="archives-title" class="page-title">
                    <?php
					/**
					 * @1.440
					 */
					$post_type = get_post_type( get_the_ID() );				
					$post_type_object = get_post_type_object( $post_type );
					$post_type_title = esc_html( apply_filters('raindrops_post_type_day_archive_title', $post_type_object->label ) );
					$post_type_title_separator = esc_html( apply_filters('raindrops_post_type_day_archive_title_separator', ' : ' ) );
					
					$add_query = '';
					if( is_post_type_archive( $post_type )){
					
						if( !empty( $post_type ) && $post_type !== 'post' ) {

							$add_query = '&post_type='. wp_strip_all_tags($post_type);
						}
	
							echo $post_type_title. $post_type_title_separator;
					}
					
                    if ( is_year() ) {
                        $one_year = query_posts( "posts_per_page=-1&year=$ye".$add_query );
                        $output   = raindrops_get_year( $one_year, $ye, $post_type );
                        wp_reset_query();
                        esc_html_e( 'Yearly Archives', 'raindrops' );
                    } elseif ( is_month() ) {
                        $one_month = query_posts( "posts_per_page=-1&year=$ye&monthnum=$mo".$add_query );
                        $output    = raindrops_month_list( $one_month, $ye, $mo, $post_type );
                        wp_reset_query();
						
						
                        esc_html_e( 'Monthly Archives', 'raindrops' );
                    } elseif ( is_day() ) {
                        $one_day = query_posts( "posts_per_page=-1&year=$ye&monthnum=$mo&day=$da".$add_query );
                        $output  = raindrops_get_day( $one_day, $ye, $mo, $da );
                        wp_reset_query();
                        esc_html_e( 'Daily Archives', 'raindrops' );
                    }
					
                    ?>
                </h2>
				<?php get_template_part( 'widget', 'sticky' ); ?>				
                <?php 
				if(is_month()){
					raindrops_monthly_archive_prev_next_navigation();
				}
				?>
                <div class="datetable">
                    <?php echo $output; ?>
                </div>
                <?php if ( is_month() ) { ?>
                    <div class="monthly-archives-pagenate">
                        <?php echo paginate_links( $pagination ) . ''; ?>
                    </div>
                <?php }// end if ( is_month( ) )?>
                <?php raindrops_append_loop(); ?>

            </div>
            <?php
            if ( 3 == $raindrops_current_column ) {
                ?>
                <div class="yui-u">
                    <?php
                    raindrops_prepend_extra_sidebar();

                    get_sidebar( 'extra' );

                    raindrops_append_extra_sidebar();
                    ?>
                </div>
                <?php
            } elseif ( $rsidebar_show && false == $raindrops_current_column ) {
                ?>
                <div class="yui-u">
                    <?php
                    raindrops_prepend_extra_sidebar();

                    get_sidebar( 'extra' );

                    raindrops_append_extra_sidebar();
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<?php
if ( $raindrops_current_column !== 1 || false == $raindrops_current_column ) {
    ?>
    <div class="yui-b">
        <?php
        //lsidebar start 
        raindrops_prepend_default_sidebar();

        get_sidebar( 'default' );

        raindrops_append_default_sidebar();
        ?>
    </div>
    <?php
}
get_footer( $raindrops_document_type ); ?>