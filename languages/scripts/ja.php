<?php
add_filter( 'raindrops_month_list_year_name', 'raindrops_year_name_filter' );
add_filter( 'raindrops_archive_year_label', 'raindrops_year_name_filter' );
add_filter( 'raindrops_archive_month_label', 'raindrops_archive_day_filter_month' );
add_filter( 'raindrops_archive_day_label', 'raindrops_archive_day_filter_day' );
add_filter( 'get_the_date', 'raindrops_japan_date', 11 );
add_filter( 'get_comment_date','raindrops_japan_date', 11 );
add_filter( 'get_archives_link', 'raindrops_category_widget_wareki' );
add_filter( 'get_calendar','raindrops_category_widget_wareki' );

if ( class_exists( 'breadcrumb_navxt') ) {
	add_filter( 'bcn_template_tags', 'raindrops_bcn_template_tags_filter', 11, 3 );
	add_filter( 'bcn_breadcrumb_title', 'raindrops_bcn_breadcrumb_title',11,3);
}

if ( ! function_exists( 'raindrops_year_name_filter' ) ) {
/**
 * 
 * @param type $year
 * @return type $string
 * @since 1.277
 */
	function raindrops_year_name_filter( $year ) {
		
		$year_name = "&#24180;";
		
		if( raindrops_warehouse_clone( 'raindrops_japanese_date' ) !== 'yes' ) {
			
			return $year;
		}
		

		return raindrops_year_to_gengou( $year ). $year_name; 
	}
}
if ( ! function_exists( 'raindrops_archive_day_filter_month' ) ) {
/**
 * 
 * @param type $month
 * @return type $string
 * @since 1.277
 */
	function raindrops_archive_day_filter_month( $month ) {
		if( raindrops_warehouse_clone( 'raindrops_japanese_date' ) !== 'yes' ) {
			
			return $month;
		}

		return $month. '&#26376;';
	}
}
if ( ! function_exists( 'raindrops_archive_day_filter_day' ) ) {
/**
 * 
 * @param type $day
 * @return type $string
 * @since 1.277
 */
	function raindrops_archive_day_filter_day( $day ) {
		if( raindrops_warehouse_clone( 'raindrops_japanese_date' ) !== 'yes' ) {
			
			return $day;
		}
		return $day . '&#26085;';
	}
}

if ( ! function_exists( 'raindrops_japan_date' ) ) {
/**
 * 
 * @global type $post
 * @param type $date
 * @return type $string
 * @since 1.277
 */
	function raindrops_japan_date( $date ) {
		global $post;
		if( raindrops_warehouse_clone( 'raindrops_japanese_date' ) !== 'yes' ) {
			
			return $date;
		}

		$time_format	 = get_option( 'time_format' );
		$time			 = get_the_time( $time_format, $post->ID );
		$html			 = '%1$s %2$s %3$s %4$s %5$s %6$s %7$s %8$s';
		$force_gengou	 = '';
		$year_name		 = '&#24180;';
		$month_name		 = '&#26376;';
		$day_name		 = '&#26085;';
		$error			 = $date;

		$gengou = array( '&#24179;&#25104;' => mktime( 0, 0, 0, 1, 8, 1989 ),
			'&#26157;&#21644;' => mktime( 0, 0, 0, 12, 25, 1926 ),
			'&#22823;&#27491;' => mktime( 0, 0, 0, 7, 30, 1912 )
		);

		$date	 = preg_replace( '|[^0-9A-z]+|', '-', $date );
		$date	 = str_replace( array( 'am', 'pm', 'AM', 'PM' ), '', $date );
		$date	 = apply_filters( 'japan_date_input', $date );

		arsort( $gengou );

		$date			 = date_parse( $date );
		$year			 = $date[ "year" ];
		$month			 = $date[ "month" ];
		$day			 = $date[ "day" ];
		$hour			 = $date[ "hour" ];
		$minute			 = $date[ "minute" ];
		$second			 = $date[ "second" ];
		$fraction		 = $date[ "fraction" ];
		$warning_count	 = $date[ "warning_count" ];
		$warnings		 = $date[ "warnings" ];
		$error_count	 = $date[ "error_count" ];
		$errors			 = $date[ "errors" ];
		$is_localtime	 = $date[ "is_localtime" ];

		if ( $year == false ) {
			return $error;
		}
		if ( $month == false ) {
			return $error;
		}
		if ( $day == false ) {
			return $error;
		}
		if ( $error_count > 1 ) {
			return $error;
		}

		if ( $hour == false or
		$minute == false or
		$second == false ) {

			$hour	 = 0;
			$minute	 = 0;
			$second	 = 0;
		}

		$input_date = mktime( $hour, $minute, $second, $month, $day, $year );
		if ( empty( $force_gengou ) ) {
			foreach ( $gengou as $key => $val ) {

				if ( $input_date >= $val ) {
					$start	 = date( 'Y', $val );
					$year	 = $year - $start + 1;

					$result	 = sprintf( $html, $key, $year, $year_name, $month, $month_name, $day, $day_name, $time );
					return $date	 = apply_filters( 'japan_date_output', $result );
				}
			}
		} else {
			$start	 = date( 'Y', $gengou[ $force_gengou ] );
			$year	 = $year - $start + 1;

			$result	 = sprintf( $html, $force_gengou, $year, $year_name, $month, $month_name, $day, $day_nam, $timee );
			return $date	 = apply_filters( 'japan_date_output', $result );
		}
	}
}
if ( ! function_exists( 'raindrops_category_widget_wareki' ) ) {
/**
 * 
 * @param type $html
 * @return type $string
 * @since 1.277
 */
	function raindrops_category_widget_wareki( $html ) {
		
		if( raindrops_warehouse_clone( 'raindrops_japanese_date' ) !== 'yes' ) {
			
			return $html;
		}
		// archives dropdown has space
		$html = str_replace( '> ','>', $html);
		
		if ( preg_match( '!>([0-9]{4})!', $html, $regs ) && isset( $regs[ 1 ] ) && 2002 < $regs[ 1 ] ) {

			$before	 = $regs[ 1 ];
			$nen	 = $regs[ 1 ] - 1988;
			$gengou	 = raindrops_year_to_gengou( $regs[ 1 ] );

			return str_replace( array( '>'. $before,), array( '>'. $gengou,), $html );
		}

		return $html;
	}
}

if ( class_exists( 'breadcrumb_navxt') ) {


	function raindrops_bcn_breadcrumb_title( $title ,$type,$id) {
		if( raindrops_warehouse_clone( 'raindrops_japanese_date' ) !== 'yes' ) {
			
			return $title;
		}

		if ( preg_match( '![0-9]{4}!', $title )  ) {

			return raindrops_year_to_gengou( $title );
		}

		return $title;
	}
}
if ( ! function_exists( 'raindrops_year_to_gengou' ) ) {
/**
 * 
 * @param type $year
 * @return type $string
 * @since 1.277
 */
	function raindrops_year_to_gengou( $year ) {

		$nen	 = $year - 1988;
		$gengou	 = apply_filters( 'raindrops_wareki_gengou', "&#24179;&#25104;" . $nen, "&#24179;&#25104;", $year - 1988, $year );

		return $gengou;
	}
}
/* Breadcrump navxt */


if ( ! function_exists( 'raindrops_bcn_template_tags_filter' ) && class_exists( 'breadcrumb_navxt') ) {
	

	
	function raindrops_bcn_template_tags_filter( $replacements, $type, $id ) {
		
		if ( WPLANG == 'ja' ) {

			$this_type = implode( ',', $type );

			if ( preg_match( '!date-year!', $this_type ) ) {

				$replacements["%htitle%"] = $replacements["%htitle%"] . '&#24180;';
			}
			if ( preg_match( '!date-day!', $this_type ) ) {

				$replacements["%htitle%"] = $replacements["%htitle%"] . '&#26085;';
			}

			return $replacements;
		}

		return $replacements;
	}
}