<?php
add_filter( 'raindrops_month_list_year_name', 'raindrops_year_name_filter',11, 2 );
add_filter( 'raindrops_archive_year_label', 'raindrops_year_name_filter',11, 2 );
add_filter( 'raindrops_archive_month_label', 'raindrops_archive_day_filter_month' );
add_filter( 'raindrops_archive_day_label', 'raindrops_archive_day_filter_day' );
add_filter( 'get_the_date', 'raindrops_japan_date', 11 );
add_filter( 'get_comment_date','raindrops_japan_date', 11 );
add_filter( 'get_archives_link', 'raindrops_archive_month_widget_wareki',10, 2 );
add_filter( 'get_calendar','raindrops_calender_widget_wareki',10 );

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
	function raindrops_year_name_filter( $year, $date = '' ) {

		$year_name = "&#24180;";

		if( raindrops_warehouse_clone( 'raindrops_japanese_date' ) !== 'yes' ) {

			return $year;
		}

		return raindrops_year_to_gengou( $year,$date ). $year_name;
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
if ( ! function_exists( 'raindrops_gengou_names' ) ) {
	
	function raindrops_gengou_names(){

		$names = apply_filters('raindrops_gengou_names', array( 
				'&#24179;&#25104;' => mktime( 0, 0, 0, 1, 8, 1989 ),
				'&#26157;&#21644;' => mktime( 0, 0, 0, 12, 25, 1926 ),
				'&#22823;&#27491;' => mktime( 0, 0, 0, 7, 30, 1912 ),
				) );
		arsort( $names );
		return $names;
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

		$gengou = raindrops_gengou_names();
		
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

		if ( preg_match( '!>([0-9]{4})([^0-9]*)([0-9]{1,2})!', $html, $regs ) && isset( $regs[ 1 ] ) && 2002 < $regs[ 1 ] ) {

			$year	 = intval($regs[ 1 ]);
			//$month	 = intval($regs[3]);
			//$date = mktime( 0, 0, 0, $month, 1, $year);
			$gengou	 = raindrops_year_to_gengou( $year );
			//Do not consider the month
			return str_replace( array( '>'. $year,), array( '>'. $gengou,), $html );
		}

		return $html;
	}
}
if ( ! function_exists( 'raindrops_calender_widget_wareki' ) ) {

	function raindrops_calender_widget_wareki( $html ) {

		if( raindrops_warehouse_clone( 'raindrops_japanese_date' ) !== 'yes' ) {

			return $html;
		}
		// archives dropdown has space
		$html = str_replace( '> ','>', $html);

		if ( preg_match( '!>([0-9]{4})([^0-9]*)([0-9]{1,2})!', $html, $regs ) && isset( $regs[ 1 ] ) && 2002 < $regs[ 1 ] ) {

			$year	 = intval($regs[ 1 ]);
			$month	 = intval($regs[3]);
			$date = mktime( 0, 0, 0, $month, 1, $year);
			$gengou	 = raindrops_year_to_gengou( $year,$date );
			return str_replace( array( '>'. $year,), array( '>'. $gengou,), $html );
		}

		return $html;
	}
}
if ( ! function_exists( 'raindrops_archive_month_widget_wareki' ) ) {
/**
 *
 * @param type $html
 * @return type $string
 * @since 1.277
 */
	function raindrops_archive_month_widget_wareki( $html,$month ) {

		if( raindrops_warehouse_clone( 'raindrops_japanese_date' ) !== 'yes' ) {

			return $html;
		}
		// archives dropdown has space
		$html = str_replace( '> ','>', $html);

		if ( preg_match( '!>([0-9]{4})([^0-9]*)([0-9]{1,2})!', $html, $regs ) && isset( $regs[ 1 ] ) && 2002 < $regs[ 1 ] ) {

			$year	 = intval($regs[ 1 ]);
			$month	 = intval($regs[3]);

			$date = mktime( 0, 0, 0, $month, 1, $year);
			$gengou	 = raindrops_year_to_gengou( $year,$date );
			//Do not consider the month
			return str_replace( array( '>'. $year,), array( '>'. $gengou,), $html );
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
	function raindrops_year_to_gengou( $year , $date = '' ) {

		$nen	 = $year - 1988;
		
		if( ! empty( $date ) ) {
			
			$nen = $year - (int) date( 'Y', $date );


			$gengou = raindrops_gengou_names();

			foreach( $gengou as $key => $val ) {

				$current_diff = intval($date) - intval($val);
				$nen = (int) $year - (int) date('Y',$val) + 1;
				
				if( ! empty( $date ) && ! isset( $prev_diff )  ) {
					
					if( $val > $date ) {
						continue;
					}

					$result = $key . $nen;
					$geugou = $key;
					
				}

				if( ! empty( $date ) && 0 < $current_diff && isset( $prev_diff ) &&  $current_diff < $prev_diff &&  $val < $date ) {

					$result = $key . $nen;
					$gengou = $key;
				}

				$prev_diff = intval($date) - intval($val);
			}
		
		return apply_filters( 'raindrops_wareki_gengou', $result, $geugou, $nen, $year,$date );
		}
		
		
	if( empty( $date ) ) {
		
			$gengou = raindrops_gengou_names();

			foreach( $gengou as $key => $val ) {

				$current_diff = intval($year) - intval($val);

				if( ! isset( $prev_diff )  ) {
					$nen = (int) $year - (int) date('Y',$val) + 1;
					if( $nen <= 0 ) {
						continue;
					}
					$result = $key . $nen;
					$geugou = $key;
					
				}

				if(  0 < $current_diff && isset( $prev_diff ) && 0 < $prev_diff &&  $current_diff < $prev_diff ) {
					
					$nen = (int) $year - (int) date('Y',$val) + 1;
					if( $nen <= 0 ) {
						continue;
					}
					$result = $key . $nen;
					$gengou = $key;
				}

				$prev_diff = intval($year) - intval($val);
			}
		
		return apply_filters( 'raindrops_wareki_gengou', $result, $geugou, $nen, $year );
		}
		
		
		//$gengou	 = apply_filters( 'raindrops_wareki_gengou', "&#24179;&#25104;" . $nen, "&#24179;&#25104;", $year - 1988, $year );


		return $gengou;
	}
}
/* Breadcrump navxt */


if ( ! function_exists( 'raindrops_bcn_template_tags_filter' ) && class_exists( 'breadcrumb_navxt') ) {



	function raindrops_bcn_template_tags_filter( $replacements, $type, $id ) {

		if ( 'ja' == get_locale() ) {

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
/**
 * Writing Mode Mix
 */
if ( ! function_exists( 'raindrops_writing_mode_disable' ) ) {

	function raindrops_writing_mode_disable() {

		$format = get_post_format();

		if( 'chat' == $format || 'link' == $format ) {

			return true;
		}

		return false;
	}
}
if ( ! function_exists( 'raindrops_writing_mode_preparation_check' ) ) {

	function raindrops_writing_mode_preparation_check(){

		$force_remove						 = apply_filters( 'raindrops_delete_writing-mode-mix', false );
		$raindrops_enable_writing_mode_mix	 = raindrops_warehouse_clone( 'raindrops_enable_writing_mode_mix' );

		if ( false == $force_remove && 'yes' == $raindrops_enable_writing_mode_mix ) {

			return true;
		}
		return false;
	}
}

$raindrops_enable_writing_mode_mix = raindrops_warehouse_clone( 'raindrops_enable_writing_mode_mix' );

if ( 'yes' == $raindrops_enable_writing_mode_mix ) {

	add_filter( 'post_class', 'raindrops_style_writing_mode_mix_add_post_class' );
	add_filter( 'the_content', 'raindrops_writing_mode_mix_add_attribute', 11 );
	add_action( 'wp_enqueue_scripts', 'raindrops_writing_mode_mix_add_font' );
	add_filter( 'raindrops_entry_title_class', 'raindrops_style_writing_mode_mix_add_title_class' );
	add_filter( 'raindrops_embed_meta_css', 'raindrops_filter_writing_mode_mix' );
	add_filter( 'raindrops_delete_writing-mode-mix', 'raindrops_writing_mode_disable' );
}

if ( !function_exists( 'raindrops_writing_mode_mix_add_attribute' ) ) {

	function raindrops_writing_mode_mix_add_attribute( $content ) {

		$change_elements					 = array();
		$class_array						 = raindrops_article_wrapper_class();
		$force_remove						 = apply_filters( 'raindrops_delete_writing-mode-mix', false );
		$raindrops_enable_writing_mode_mix	 = raindrops_warehouse_clone( 'raindrops_enable_writing_mode_mix' );
		$automatic_add_class				 = raindrops_warehouse_clone( 'raindrops_enable_writing_mode_mix_auto_add_class' );

		if ( false == raindrops_writing_mode_preparation_check() ) {
			return $content;
		}
		if ( 'no' == $automatic_add_class ) {
			return $content;
		}
		if ( 'p' == $automatic_add_class ) {
			$change_elements[ '<p>' ] = '<p class="d-tate">';
		}
		if ( 'p+h' == $automatic_add_class ) {
			$change_elements[ '<p>' ]	 = '<p class="d-tate">';
			$change_elements[ '<h1>' ] = '<h1  class="d-tate">';
			$change_elements[ '<h2>' ] = '<h2  class="d-tate">';
			$change_elements[ '<h3>' ] = '<h3  class="d-tate">';
			$change_elements[ '<h4>' ] = '<h4  class="d-tate">';
			$change_elements[ '<h5>' ] = '<h5  class="d-tate">';
			$change_elements[ '<h6>' ] = '<h6  class="d-tate">';
		}
		if ( 'p+h+li' == $automatic_add_class ) {
			$change_elements[ '<p>' ]	 = '<p class="d-tate">';
			$change_elements[ '<h1>' ] = '<h1  class="d-tate">';
			$change_elements[ '<h2>' ] = '<h2  class="d-tate">';
			$change_elements[ '<h3>' ] = '<h3  class="d-tate">';
			$change_elements[ '<h4>' ] = '<h4  class="d-tate">';
			$change_elements[ '<h5>' ] = '<h5  class="d-tate">';
			$change_elements[ '<h6>' ] = '<h6  class="d-tate">';
			$change_elements[ '<ul>' ] = '<ul  class="d-tate">';
			$change_elements[ '<ol>' ] = '<ol  class="d-tate">';
		}
		if ( 'p+h+li+dl' == $automatic_add_class ) {
			$change_elements[ '<p>' ]	 = '<p class="d-tate">';
			$change_elements[ '<h1>' ] = '<h1  class="d-tate">';
			$change_elements[ '<h2>' ] = '<h2  class="d-tate">';
			$change_elements[ '<h3>' ] = '<h3  class="d-tate">';
			$change_elements[ '<h4>' ] = '<h4  class="d-tate">';
			$change_elements[ '<h5>' ] = '<h5  class="d-tate">';
			$change_elements[ '<h6>' ] = '<h6  class="d-tate">';
			$change_elements[ '<ul>' ] = '<ul  class="d-tate">';
			$change_elements[ '<ol>' ] = '<ol  class="d-tate">';
			$change_elements[ '<dl>' ] = '<dl  class="d-tate">';
		}

		if ( in_array( "writing-mode-mix", $class_array ) ) {

			$content = str_replace( array_keys( $change_elements ), array_values( $change_elements ), $content );

			/* Tiny MCE style */
			$tiny_mce = array( '<p style="text-align: right;">' => '<p class="d-tate bottom" style="text-align: right">',
							'<p style="text-align: center;">' => '<p class="d-tate center" style="text-align: center">',
							'<p data-rd-style="text-align: right;">' => '<p class="d-tate bottom" style="text-align: right">',
							'<p data-rd-style="text-align: center;">' => '<p class="d-tate center" style="text-align: center">',
				
			);
			// @1.511 data-rd-style value is remove whitespaces
			$tiny_mce = apply_filters( 'raindrops_writing_mode_mix_mce_attribute_change', $tiny_mce );

			$content = str_replace( array_keys( $tiny_mce ), array_values( $tiny_mce ), $content );
		}
		return $content;
	}
}
if ( !function_exists( 'raindrops_writing_mode_mix_add_font' ) ) {

	function raindrops_writing_mode_mix_add_font() {

		$raindrops_enable_writing_mode_mix = raindrops_warehouse_clone( 'raindrops_enable_writing_mode_mix' );

		if ( false == raindrops_writing_mode_preparation_check() ) {

			return;
		}

		if ( get_locale() == 'ja' && 'yes' == $raindrops_enable_writing_mode_mix ) {

			$stylesheet_url = '//fonts.googleapis.com/earlyaccess/notosansjapanese.css';
			wp_register_style( 'noto-sans-ja-site', $stylesheet_url, array(), '2015-1-21' );
			wp_enqueue_style( 'noto-sans-ja-site' );
		}
	}
}

if ( !function_exists( 'raindrops_filter_writing_mode_mix' ) ) {

	function raindrops_filter_writing_mode_mix( $css ) {

		if ( false == raindrops_writing_mode_preparation_check() ) {

			return $css;
		}

		return $css . raindrops_style_writing_mode_mix();
	}

}
if ( !function_exists( 'raindrops_style_writing_mode_mix_add_title_class' ) ) {

	function raindrops_style_writing_mode_mix_add_post_class( $classes ) {

		if ( false == raindrops_writing_mode_preparation_check() ) {
			return $classes;
		}
		if ( is_singular() ) {
			$classes[] = 'writing-mode-mix-article';
		}
		return $classes;
	}

}

if ( !function_exists( 'raindrops_style_writing_mode_mix_add_title_class' ) ) {

	function raindrops_style_writing_mode_mix_add_title_class( $class ) {

		if ( false == raindrops_writing_mode_preparation_check() ) {
			return $class;
		}

		$scope = raindrops_warehouse_clone( 'raindrops_enable_writing_mode_mix_scope' );

		if ( is_singular() && 'article' == $scope ) {
			return $class . ' d-tate';
		}
		return $class;
	}
}
if ( !function_exists( 'raindrops_style_writing_mode_mix' ) ) {

	function raindrops_style_writing_mode_mix() {

		$line_size	 = raindrops_warehouse_clone( 'raindrops_enable_writing_mode_mix_line_size' );
		$line_size	 = $line_size . 'px';
		$scope		 = raindrops_warehouse_clone( 'raindrops_enable_writing_mode_mix_scope' );

		$css = <<< CSS
@media screen and (min-width : 641px) {
	/**
	 * Pending CSS variables Crash Edge Browser
	 */
/**
 * Vertical writing Start
   ========================================================================== */
    .writing-mode-mix $scope *[class|="d-tate"]{
        direction:rtl;
        font-family:'Noto Sans Japanese','Meiryo',Arial,sans-serif;
        font-weight:300;
    }
    .writing-mode-mix $scope .d-tate .upright{
		/* Not support Edge */
        font-weight:500;
        padding:0;
		-ms-text-orientation: upright;
        text-orientation: upright;
        text-indent:0;
    }
    .writing-mode-mix $scope .indent{
        text-indent: 1em;
    }
	.writing-mode-mix $scope .indent-2{
        text-indent: 2em;
    }
	.writing-mode-mix $scope [style="text-align: right"],/* TinyMCE ensuring compatibility */
	.writing-mode-mix $scope .entry-content :not(.d-tate-wrap).right,
	.writing-mode-mix $scope .entry-content :not(.d-tate-wrap).bottom{
		text-align-last:right!important;
	}
	.writing-mode-standard $scope .entry-content :not(.d-tate-wrap).right,
	.writing-mode-standard $scope .entry-content :not(.d-tate-wrap).bottom{
		text-align:right!important;
	}
	.writing-mode-standard $scope .centered .d-tate.right,
	.writing-mode-mix $scope .centered .d-tate.bottom{
		/* edge */
		text-align:right;
   }
	.writing-mode-mix $scope .centered .d-tate.center{
		/* edge */
		text-align:center;
   }
	.writing-mode-mix $scope :not(.d-tate-wrap).center{
		text-align: center;
		text-align-last:center!important;
	}
	.writing-mode-standard $scope :not(.d-tate-wrap).center{
		text-align:center!important;
	}

	div.writing-mode-mix $scope .centered{
		display:block;
		text-align:center;
		direction: rtl;
   }
	.writing-mode-mix $scope .centered .d-tate{
		float:none;
		text-align:left;
   }
	.writing-mode-standard $scope .centered .d-tate{
		margin-bottom:1em;
		display:block;
		width:100%;
   }

 /**
  * Inline Elements
   ========================================================================== */
    .writing-mode-mix $scope .d-tate em {
        -webkit-text-emphasis-style:circle filled;
        -webkit-text-emphasis-position:over right;
        text-emphasis-style:circle filled;
        -webkit-text-emphasis-position:over;
                text-emphasis-position:over right;
        font-weight:normal;
    }
    .writing-mode-mix $scope .d-tate:not(.entry-title) a{
                text-decoration:underline;
        -webkit-text-decoration-line:underline;
                text-decoration-line:underline;
        -webkit-text-decoration-style:dotted;
                text-decoration-style:dotted;
    }
    .writing-mode-mix $scope .d-yoko a{
                text-decoration:underline;
        -webkit-text-decoration-line:underline;
                text-decoration-line:underline;
        -webkit-text-decoration-style:solid;
                text-decoration-style:solid;
    }
    .writing-mode-mix $scope em rt {
        display: none; /* Hide ruby inside <em> elements */
    }
    .writing-mode-mix $scope .d-tate .d-tate,
    .writing-mode-mix $scope .d-tate insert,
    .writing-mode-mix $scope .d-tate delete,
    .writing-mode-mix $scope .d-tate mark,
    .writing-mode-mix $scope .d-tate a,
    .writing-mode-mix $scope .d-tate ruby,
    .writing-mode-mix $scope .d-tate rt,
    .writing-mode-mix $scope .d-tate rp,
    .writing-mode-mix $scope .d-tate mark,
    .writing-mode-mix $scope .d-tate strong,
    .writing-mode-mix $scope .d-tate em,
    .writing-mode-mix $scope .d-tate span{
        text-justify:inter-ideograph;
        direction:ltr;
        -webkit-box-sizing:border-box;
                box-sizing:border-box;
    }
/**
 * Ruby child
   ========================================================================== */
    .writing-mode-mix $scope .d-tate rt,
    .writing-mode-mix $scope .d-tate rp{

    }
/**
 * Block Elements
   ========================================================================== */
	.writing-mode-mix $scope blockquote,
   .writing-mode-mix $scope .d-tate-wrap,
   .writing-mode-mix $scope div.d-tate-wrap{
       -webkit-box-sizing:border-box;
               box-sizing:border-box;
       float:right;
       height:360px;
       margin:0 24px 1em;
       max-height:360px;
       padding:16px 8px;
	   position:relative;
	   width:296px;
	   max-width:100%;
       max-height:$line_size;
       height:$line_size;
    }
	.writing-mode-mix $scope blockquote{
		width:auto;

	}
	.writing-mode-mix $scope blockquote p:first-child{
		margin-top:0;
	}
	.writing-mode-mix $scope blockquote *,
	.writing-mode-mix $scope .d-tate-wrap *,
    .writing-mode-mix $scope div.d-tate-wrap * {
        max-height:360px;
       /* @1.483 max-height:$line_size; */
		max-height:100%;
    }
	.writing-mode-mix $scope .d-tate-wrap .wp-block-embed__wrapper,
    .writing-mode-mix $scope div.d-tate-wrap .wp-block-embed__wrapper{
        width:100%;
    }

    .writing-mode-mix $scope dl.d-tate,
    .writing-mode-mix $scope ol.d-tate,
    .writing-mode-mix $scope ul.d-tate,
    .writing-mode-mix $scope hr.d-tate,
    .writing-mode-mix $scope h6.d-tate,
    .writing-mode-mix $scope h5.d-tate,
    .writing-mode-mix $scope h4.d-tate,
    .writing-mode-mix $scope h3.d-tate,
    .writing-mode-mix $scope h2.d-tate,
    .writing-mode-mix $scope h1.d-tate,
    .writing-mode-mix $scope p[class|="d"]{
        height:360px;
        inline-size:360px;
        padding:16px 8px;
        display:inline-block;
        vertical-align:middle;
    /*    text-align:justify;*/
        text-justify:inter-ideograph;
        text-align-last:left;
        direction:ltr;
        float:right;
        letter-spacing:.15em;
        line-height:1.8;
        -webkit-box-sizing:border-box;
                box-sizing:border-box;

        height:$line_size;
    }
	/* @1.484 */
	.writing-mode-mix $scope p.d-yoko,
    .writing-mode-standard $scope p.d-yoko{
		 letter-spacing:normal;
	}
	.rd-grid .writing-mode-mix $scope .entry-title{
		 padding:0;
	}
	.single .writing-mode-mix $scope .entry-title{
		margin:0;
	}
    .writing-mode-mix $scope hr.d-tate{
        -webkit-writing-mode: vertical-rl;
            -ms-writing-mode: tb-rl;
                writing-mode: vertical-rl;
        padding:16px 8px;
        margin:0 24px 1em;
        height:360px;
		height:$line_size;
		clear:none;
    }
    .writing-mode-mix $scope h6.d-tate,
    .writing-mode-mix $scope h5.d-tate,
    .writing-mode-mix $scope h4.d-tate,
    .writing-mode-mix $scope h3.d-tate,
    .writing-mode-mix $scope h2.d-tate,
    .writing-mode-mix $scope h1.d-tate{
        margin:0;
        padding:.84em 1.26em;
        font-family:'Noto Sans Japanese','Meiryo',Arial,sans-serif;
        font-weight:700;
    }

    .writing-mode-mix  $scope figure.alignright + p,
    .writing-mode-mix  $scope figure.alignleft + p{
        min-width:0;
    }
    .writing-mode-mix $scope h6.d-tate,
    .writing-mode-mix $scope h5.d-tate,
    .writing-mode-mix $scope h4.d-tate,
    .writing-mode-mix $scope h3.d-tate,
    .writing-mode-mix $scope h2.d-tate,
    .writing-mode-mix $scope h1.d-tate,
    .writing-mode-mix $scope img:not(.wp-post-image),
    .writing-mode-mix $scope .d-tate {
        -webkit-writing-mode: vertical-rl;
            -ms-writing-mode: tb-rl;
                writing-mode: vertical-rl;
    }
    .writing-mode-mix $scope table:before,
    .writing-mode-mix $scope p.d-yoko:before{
        content:'';
        display:table;
        clear:both;
    }
	.writing-mode-mix $scope .wp-caption img,
	.rd-grid .writing-mode-mix $scope .entry-title,
    .writing-mode-mix $scope .d-yoko,
    .writing-mode-mix $scope table,
    .writing-mode-mix $scope p.d-yoko{
        clear:both;
        direction:ltr;
        text-indent:0;
        height:auto;
        width:auto;
        block-size:auto;
        inline-size:auto;
        -webkit-writing-mode:horizontal-tb;
            -ms-writing-mode:lr-tb;
                writing-mode:horizontal-tb;
        max-width:100%;
        float:none;
    }
	.writing-mode-mix $scope table{
		width:100%;
		border-collapse: separate;
	}
	.writing-mode-mix $scope p.d-yoko{
		padding:0;
	}
	.writing-mode-mix $scope .d-yoko.full-width{
        clear:both;
        direction:ltr;
		display:block;
        text-indent:0;
        height:auto;
        -webkit-writing-mode:horizontal-tb;
            -ms-writing-mode:lr-tb;
                writing-mode:horizontal-tb;
        width:100%;
        float:none;
	}
	.writing-mode-mix $scope .full-width .d-yoko{
		display:block;
	}
	.writing-mode-mix $scope .full-wide:before,
	.writing-mode-mix $scope .full-wide:after{
		content:'';
		display:table;
	}
    .writing-mode-mix $scope .rd-table-wrapper{
        direction:ltr;
        -webkit-writing-mode: horizontal-tb;
            -ms-writing-mode: lr-tb;
                writing-mode: horizontal-tb;
        clear:both;
    }
    .writing-mode-mix $scope p:empty{
        display:none!important;
    }
    .writing-mode-mix $scope ol.d-tate{
        direction:ltr;
        float:right;
        height:320px;
        margin:40px 1em 1em;

        height:calc( $line_size - 40px );
    }

	.edge .writing-mode-mix $scope ol.d-tate li,
	.edge .writing-mode-mix $scope ol.d-tate{
		margin:auto;
		list-style-position: inside;
		 height:$line_size;
	}
    .writing-mode-mix $scope ol.d-tate li{
        direction:ltr;
        height:280px;
        max-height:100%;

        height:calc( $line_size - 80px );
    }
    .writing-mode-mix $scope ul.d-tate{
        direction:ltr;
        float:right;
        text-orientation: mixed;
        height:360px;
        margin:0 2em 1em;

        height:$line_size;
    }
    .writing-mode-mix $scope ul.d-tate li{
        direction:ltr;
        height:300px;
        padding:0 8px;

        height:calc( $line_size - 60px );
    }
	.edge .writing-mode-mix $scope ul.d-tate{
        margin:auto;
        height: $line_size;
    }
	.edge .writing-mode-mix $scope ul.d-tate li{
        direction:ltr;
        height:300px;
        padding:0 8px;
        margin:auto;
        height:$line_size;
    }
    .writing-mode-mix $scope dl.d-tate{
        direction:ltr;
        float:right;
        height:360px;
        padding:16px 8px;
        margin:0 1em 1em;

       height:$line_size;
    }
    .writing-mode-mix $scope .d-tate dd,
    .writing-mode-mix $scope .d-tate dt{
        direction:ltr;
        height:320px;

         height:calc( $line_size -40px );
    }
    .writing-mode-mix $scope .d-tate dd{
        margin:auto auto 0 auto;
        padding-top:32px;
        padding-bottom:0;
        -webkit-box-sizing: border-box;
                box-sizing: border-box;
    }
    .writing-mode-mix $scope .alignnone,
    .writing-mode-mix $scope .alignleft{
        clear:none;
        float:right;
    }

	.writing-mode-mix $scope .columns{
		/* MUST NOT */
        -moz-columns: initial!important;
		-webkit-columns:initial!important;
		-o-columns:initial!important;
		-ms-columns: initial!important;
		columns: initial!important;
    }
/**
 * Color and Border
   ========================================================================== */
    .writing-mode-mix .d-tate li,
    .writing-mode-mix .d-tate-wrap,
    .writing-mode-mix .d-tate {
      /*  background-color: rgba(236, 240, 241,1);*/
    }
    .writing-mode-mix .d-tate a,
    .writing-mode-mix .d-yoko a{
        -webkit-text-decoration-color: rgba(41, 128, 185,.5);
                text-decoration-color: rgba(41, 128, 185,.5);
    }
    .writing-mode-mix hr.d-tate{
        border:none;
        border-left:3px dotted rgba(182,182,182,.5);
    }
    .writing-mode-mix .d-tate em {
        -webkit-text-emphasis-color: rgba(41, 128, 185,.5);
                text-emphasis-color: rgba(41, 128, 185,.5);
    }
	.writing-mode-mix .d-tate em {
        -webkit-text-emphasis-color: rgba(41, 128, 185,1);
                text-emphasis-color: rgba(41, 128, 185,1);
    }
	.writing-mode-mix .entry-content blockquote{
		border:1px solid #ccc;
	}
	.rd-type-dark .writing-mode-mix .entry-content blockquote{
		border:1px solid rgba(222,222,222,.4);
	}
/**
 * Misc for writing mode switch
   ========================================================================== */
	.writing-mode-mix .entry-title .direction-button{
		display:inline-block;
		font-family:sans-serif;
		text-align-last:center;
		font-weight:bold;

	}
	.writing-mode-standard .entry-title .direction-button:hover,
	.writing-mode-mix .entry-title .direction-button:hover{
		cursor:pointer;
		display:inline-block;
	}
	.writing-mode-standard .d-tate #rd-horizontal-tb{
		text-align:center;
		margin-left:1em;

	}
	.writing-mode-mix .d-tate #rd-vertical-rl{
		text-align:center;
		margin-top:1em;
		transform: rotate( 90deg );

	}
	.writing-mode-mix .entry-title #rd-vertical-rl,
	.writing-mode-standard .entry-title #rd-horizontal-tb{
		text-align:center;
		margin-left:1em;
	}
	.writing-mode-mix .format-link .entry-content :not(.raindrops-excerpt-more) a:first-of-type,
	.writing-mode-mix .format-link .entry-content p:first-of-type a{
		display:inline;
		vertical-align:baseline;
		font-size:1em;
		background:none;
	}

	.writing-mode-mix .cite-url{
		margin-top:1em;
		float:right;
		-webkit-writing-mode: vertical-rl;
            -ms-writing-mode: tb-rl;
                writing-mode: vertical-rl;
	}
	.writing-mode-mix legend{
		direction:ltr;
	}
	.raindrops-tag-posts  #rd-vertical-rl,
	.raindrops-tag-posts  #rd-horizontal-tb,
	.raindrops-category-posts  #rd-vertical-rl,
	.raindrops-category-posts  #rd-horizontal-tb,
	.raindrops-recent-posts #rd-horizontal-tb,
	.raindrops-recent-posts #rd-vertical-rl,
	.page-template-front-page article.writing-mode-mix-article #rd-vertical-rl,
	.page-template-front-page article.writing-mode-mix-article #rd-horizontal-tb{
		/* MUST NOT SHOW! Do not display multiple switching buttons in front-page.php template */
		display:none!important;
	}

	.writing-mode-mix $scope .d-tate a.ghost{
		height:100%;
		text-decoration:none;
		text-align:center;
		text-align-last:center;
	}
	body:not(.rd-type-minimal) .writing-mode-mix $scope .d-tate .more-link{
		text-decoration:none;
	}
/**
 * Vertical writing End
   ========================================================================== */
}
CSS;
		return raindrops_remove_spaces_from_css( $css );
	}
}