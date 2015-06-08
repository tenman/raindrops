<?php
/**
 * This functions has alias function
 *
 *
 * @package WordPress
 * @subpackage Raindrops
 * @since Raindrops 0.931
 */

if ( !function_exists( 'raindrops_warehouse_clone' ) ) {

    /**
     * return Raindrops settings
     *
     *
     * @see raindrops_warehouse( )
     *
     */
	function raindrops_warehouse_clone( $name , $property = false, $fallback = false ) {
		
        global $raindrops_base_setting, $raindrops_page_width, $raindrops_setting_type;
		
		$row = '';
		
		if ( false !== $property ) {
			
			if( ! isset( $raindrops_base_setting ) ) {
				
				return 'bad';
			}
			

			foreach ( $raindrops_base_setting as $key => $val ) {

				if( $val['option_name'] == $name ) {
					$row = $key;
					break;
				}
			}

			if ( isset( $raindrops_base_setting[ $row ][ $property ] ) ) {
				
				return esc_html( $raindrops_base_setting[ $row ][ $property ] );
			}
			
			return 'bad';			
		}

		if ( 'option' == $raindrops_setting_type ) {

			if ( isset( $raindrops_base_setting ) ) {
				foreach ( $raindrops_base_setting as $key => $val ) {
				
					if( $val['option_name'] == $name ) {
						$row = $key;
						break;
					}
				}
			}			
	
			if ( isset( $raindrops_page_width ) && !empty( $raindrops_page_width ) && 'raindrops_page_width' == $name ) {
				
				return 'custom-doc';
			}				

			$result = get_option( 'raindrops_theme_settings' );

			if ( isset( $result[$name] ) && !empty( $result[$name] ) ) {

				return apply_filters( 'raindrops_theme_settings_' . $name, $result[$name] );

			} elseif ( empty($row) ) {

				return $fallback;
			} elseif ( isset( $raindrops_base_setting[$row]['option_value'] ) && !empty( $raindrops_base_setting[$row]['option_value'] ) ) {

				return apply_filters( 'raindrops_theme_settings_' . $row, $raindrops_base_setting[$row]['option_value'] );
			} else {

				return $fallback;
			}

			return $fallback;
		}
		
		if( 'theme_mod' == $raindrops_setting_type ) {
			
			if ( isset( $raindrops_base_setting ) ) {
				
				foreach ( $raindrops_base_setting as $key => $val ) {
				
					if( $val['option_name'] == $name ) {
						
						$row = $key;
						break;
					}
				}
			}			
				
			if ( isset( $raindrops_page_width ) && !empty( $raindrops_page_width ) && 'raindrops_page_width' == $name ) {
				
				return 'custom-doc';
			}
			$result = get_theme_mod( $name );
				
			if ( isset( $result ) && !empty( $result ) ) {
				
				return apply_filters( 'raindrops_theme_settings_' . $name, $result );
			}elseif( false === $result ) {
				
				return $fallback;
			} elseif ( isset( $raindrops_base_setting[$row]['option_value'] ) && !empty( $raindrops_base_setting[$row]['option_value'] ) ) {
				
				return apply_filters( 'raindrops_theme_settings_' . $row, $raindrops_base_setting[$row]['option_value'] );
			} else {
				
				return $fallback;
			}
		}
		return false;
    }
}

if ( !function_exists( 'raindrops_content_width_clone' ) ) {

    /**
     * Caluculate Raindrops content width
     *
     *
     * @see raindrops_content_width( )
     *
     */
    function raindrops_content_width_clone() {
        global $raindrops_page_width, $raindrops_fluid_maximum_width;
        $adjust              = 16;
        $default             = 400;
        $document_width      = raindrops_warehouse_clone( 'raindrops_page_width' );
        $sidebar_width       = 'yui-' . raindrops_warehouse_clone( 'raindrops_col_width' );
        $extra_sidebar_width = raindrops_warehouse_clone( 'raindrops_right_sidebar_width_percent' );
        if ( isset( $raindrops_page_width ) && !empty( $raindrops_page_width ) ) {
            $w      = $raindrops_page_width;
            $adjust = 16;
            if ( 'yui-t1' == $sidebar_width ) {
                $raindrops_content_width = $w - 160 - $adjust;
            } elseif ( 'yui-t2' == $sidebar_width ) {
                $raindrops_content_width = $w - 180 - $adjust;
            } elseif ( 'yui-t3' == $sidebar_width ) {
                $raindrops_content_width = $w - 300 - $adjust;
            } elseif ( 'yui-t4' == $sidebar_width ) {
                $raindrops_content_width = $w - 180 - $adjust;
            } elseif ( 'yui-t5' == $sidebar_width ) {
                $raindrops_content_width = $w - 240 - $adjust;
            } elseif ( 'yui-t6' == $sidebar_width ) {
                $raindrops_content_width = $w - 300 - $adjust;
            } else {
                $raindrops_content_width = $default;
            }
        } else {
            if ( 'doc' == $document_width ) {
                $w      = 750;
                $adjust = 16;
                if ( 'yui-t1' == $sidebar_width ) {
                    $raindrops_content_width = $w - 160 - $adjust;
                } elseif ( 'yui-t2' == $sidebar_width ) {
                    $raindrops_content_width = $w - 180 - $adjust;
                } elseif ( 'yui-t3' == $sidebar_width ) {
                    $raindrops_content_width = $w - 300 - $adjust;
                } elseif ( 'yui-t4' == $sidebar_width ) {
                    $raindrops_content_width = $w - 180 - $adjust;
                } elseif ( 'yui-t5' == $sidebar_width ) {
                    $raindrops_content_width = $w - 240 - $adjust;
                } elseif ( 'yui-t6' == $sidebar_width ) {
                    $raindrops_content_width = $w - 300 - $adjust;
                } else {
                    $raindrops_content_width = $default;
                }
            } elseif ( 'doc2' == $document_width ) {
                $w      = 950;
                $adjust = 16;
                if ( 'yui-t1' == $sidebar_width ) {
                    $raindrops_content_width = $w - 160 - $adjust;
                } elseif ( 'yui-t2' == $sidebar_width ) {
                    $raindrops_content_width = $w - 180 - $adjust;
                } elseif ( 'yui-t3' == $sidebar_width ) {
                    $raindrops_content_width = $w - 300 - $adjust;
                } elseif ( 'yui-t4' == $sidebar_width ) {
                    $raindrops_content_width = $w - 180 - $adjust;
                } elseif ( 'yui-t5' == $sidebar_width ) {
                    $raindrops_content_width = $w - 240 - $adjust;
                } elseif ( 'yui-t6' == $sidebar_width ) {
                    $raindrops_content_width = $w - 300 - $adjust;
                } else {
                    $raindrops_content_width = $default;
                }
            } elseif ( $document_width == 'doc3' ) {
                //$raindrops_content_width = 0;
                $w = $raindrops_fluid_maximum_width;
                if ( 'yui-t1' == $sidebar_width ) {
                    $raindrops_content_width = $w - 160 - $adjust;
                } elseif ( 'yui-t2' == $sidebar_width ) {
                    $raindrops_content_width = $w - 180 - $adjust;
                } elseif ( 'yui-t3' == $sidebar_width ) {
                    $raindrops_content_width = $w - 300 - $adjust;
                } elseif ( 'yui-t4' == $sidebar_width ) {
                    $raindrops_content_width = $w - 180 - $adjust;
                } elseif ( 'yui-t5' == $sidebar_width ) {
                    $raindrops_content_width = $w - 240 - $adjust;
                } elseif ( 'yui-t6' == $sidebar_width ) {
                    $raindrops_content_width = $w - 300 - $adjust;
                } else {
                    $raindrops_content_width = $default;
                }
                /*
                  Fluid Responsive layout can not set correct value
                  but needs fallback value.
                  return 0 makes full size editor display improperly.
                 */
            } elseif ( $document_width == 'doc4' ) {
                $w      = 974;
                $adjust = 16;
                if ( 'yui-t1' == $sidebar_width ) {
                    $raindrops_content_width = $w - 160 - $adjust;
                } elseif ( 'yui-t2' == $sidebar_width ) {
                    $raindrops_content_width = $w - 180 - $adjust;
                } elseif ( 'yui-t3' == $sidebar_width ) {
                    $raindrops_content_width = $w - 300 - $adjust;
                } elseif ( 'yui-t4' == $sidebar_width ) {
                    $raindrops_content_width = $w - 180 - $adjust;
                } elseif ( 'yui-t5' == $sidebar_width ) {
                    $raindrops_content_width = $w - 240 - $adjust;
                } elseif ( 'yui-t6' == $sidebar_width ) {
                    $raindrops_content_width = $w - 300 - $adjust;
                } else {
                    $raindrops_content_width = $default;
                }
            } elseif ( $document_width == 'doc5' ) {
                //$raindrops_content_width = 0;
                $w = raindrops_warehouse_clone( 'raindrops_full_width_max_width' );
				
                if ( 'yui-t1' == $sidebar_width ) {
                    $raindrops_content_width = $w - 160 - $adjust;
                } elseif ( 'yui-t2' == $sidebar_width ) {
                    $raindrops_content_width = $w - 180 - $adjust;
                } elseif ( 'yui-t3' == $sidebar_width ) {
                    $raindrops_content_width = $w - 300 - $adjust;
                } elseif ( 'yui-t4' == $sidebar_width ) {
                    $raindrops_content_width = $w - 180 - $adjust;
                } elseif ( 'yui-t5' == $sidebar_width ) {
                    $raindrops_content_width = $w - 240 - $adjust;
                } elseif ( 'yui-t6' == $sidebar_width ) {
                    $raindrops_content_width = $w - 300 - $adjust;
                } else {
                    $raindrops_content_width = $default;
                }
                /*
                  Fluid Responsive layout can not set correct value
                  but needs fallback value.
                  return 0 makes full size editor display improperly.
                 */
			}
			
        }
        if ( raindrops_warehouse_clone( 'raindrops_show_right_sidebar' ) !== 'show' ) {
			if ( isset( $raindrops_content_width ) ) {
				return $raindrops_content_width;
			}

        } else {
			if( ! empty( $raindrops_content_width ) ) {
				if ( '25' == $extra_sidebar_width ) {
					return round( $raindrops_content_width * 0.74 );
				} elseif ( '75' == $extra_sidebar_width ) {
					return round( $raindrops_content_width * 0.24 );
				} elseif ( '33' == $extra_sidebar_width ) {
					return round( $raindrops_content_width * 0.646 );
				} elseif ( '66' == $extra_sidebar_width ) {
					return round( $raindrops_content_width * 0.32 );
				} elseif ( '50' == $extra_sidebar_width ) {
					return round( $raindrops_content_width * 0.49 );
				} else {
					return round( $raindrops_content_width );
				}
			}
        }
		if ( isset( $raindrops_content_width ) ) {
			return $raindrops_content_width;
		}
    }

}
if ( !function_exists( 'raindrops_gradient_single_clone' ) ) {

    /**
     * create gradient color and background style rule
     *
     *
     * @see raindrops_gradient_single( )
     *
     */
    function raindrops_gradient_single_clone( $i, $order = "asc" ) {
        $g = "";
        if ( $i > 4 ) {
            $i = 4;
        }
        if ( "asc" == $order ) {
            $custom_dark_bg1  = raindrops_colors_clone( $i, 'background' );
            $custom_light_bg1 = raindrops_colors_clone( $i + 1, 'background' );
        } elseif ( "desc" == $order ) {
            $custom_dark_bg1  = raindrops_colors_clone( $i + 1, 'background' );
            $custom_light_bg1 = raindrops_colors_clone( $i, 'background' );
        }
        $g.= 'color:' . raindrops_colors_clone( $i, 'color' ) . ';';
        $g.= 'background: -webkit-gradient( linear, left top, left bottom, from( ' . $custom_dark_bg1 . ' ), to( ' . $custom_light_bg1 . ' ) );';
        $g.= 'background: -moz-linear-gradient( top,  ' . $custom_dark_bg1 . ',  ' . $custom_light_bg1 . ' );';
        $g.= 'background: -ms-linear-gradient( top,  ' . $custom_dark_bg1 . ',  ' . $custom_light_bg1 . ' );';
        $g.= 'filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'' . $custom_dark_bg1 . '\', endColorstr=\'' . $custom_light_bg1 . '\' );';
        return $g;
    }

}
if ( !function_exists( 'raindrops_gradient_clone' ) ) {

    /**
     * create gradient set color and background style rule
     *
     *
     * @see raindrops_gradient( )
     *
     */
    function raindrops_gradient_clone( $selector = '', $color1 = null ) {
        
        if ( !empty( $selector ) ) {
            
            $selector = strip_tags( $selector ) ;
        } else {
            
            $selector = '.gradient' ;
        }

         if ( !empty( $color1 ) ) {
        
            $color1_check = str_replace( '#', "", $color1 );
            
            if ( ctype_xdigit( $color1_check ) ) {

              $color1 = $color1_check;
            }else{
                
               $color1 = str_replace( '#', "", raindrops_warehouse_clone( 'raindrops_base_color' ) );
            }
        } else {
            
            $color1 = str_replace( '#', "", raindrops_warehouse_clone( 'raindrops_base_color' ) );
        }
        $g = "";

        for ( $i = 1; $i < 5; $i++ ) {
            $custom_dark_bg1  = raindrops_colors_clone( $i, 'background', $color1 );
            $custom_light_bg1 = raindrops_colors_clone( $i + 1, 'background', $color1 );
            $custom_dark_bg2  = raindrops_colors_clone( $i, 'background', $color1 );
            $custom_light_bg2 = raindrops_colors_clone( $i - 1, 'background', $color1 );
            $g.= $selector . $i . '{';
            $g.= 'color:' . raindrops_colors_clone( $i, 'color' ) . ';';
            $g.= 'background: -webkit-gradient( linear, left top, left bottom, from( ' . $custom_dark_bg1 . ' ), to( ' . $custom_light_bg1 . ' ) );';
            $g.= 'background: -moz-linear-gradient( top,  ' . $custom_dark_bg1 . ',  ' . $custom_light_bg1 . ' );';
            $g.= 'filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'' . $custom_dark_bg1 . '\', endColorstr=\'' . $custom_light_bg1 . '\' );';
            $g.= 'background-image: -ms-linear-gradient( top,  ' . $custom_dark_bg1 . ',  ' . $custom_light_bg1 . ' );';		
            $g.= "}\n";
            $g.= $selector . $i . ' a{';
            $g.= 'color:' . raindrops_colors_clone( $i, 'color' ) . ';';
            $g.= "}\n";
            $g.= $selector . '-' . $i . '{';
            $g.= 'color:' . raindrops_colors_clone( $i, 'color' ) . ';';
            $g.= 'background: -webkit-gradient( linear, left top, left bottom, from( ' . $custom_dark_bg2 . ' ), to( ' . $custom_light_bg2 . ' ) );';
            $g.= 'background: -moz-linear-gradient( top,  ' . $custom_dark_bg2 . ',  ' . $custom_light_bg2 . ' );';
            $g.= 'background-image: -ms-linear-gradient( top,  ' . $custom_dark_bg2 . ',  ' . $custom_light_bg2 . ' );';			
            $g.= 'filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'' . $custom_dark_bg2 . '\', endColorstr=\'' . $custom_light_bg2 . '\' );';
            $g.= "}\n";
            $g.= $selector . '-' . $i . ' a{';
            $g.= 'color:' . raindrops_colors_clone( $i, 'color' ) . ';';
            $g.= "}\n";
			/* nav menu gradient class support @since 1.272 */
			$g.= '#access '. $selector . $i . ' a{';
            $g.= 'color:' . raindrops_colors_clone( $i, 'color' ) . ';';
            $g.= 'background: -webkit-gradient( linear, left top, left bottom, from( ' . $custom_dark_bg1 . ' ), to( ' . $custom_light_bg1 . ' ) );';
            $g.= 'background: -moz-linear-gradient( top,  ' . $custom_dark_bg1 . ',  ' . $custom_light_bg1 . ' );';
            $g.= 'filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'' . $custom_dark_bg1 . '\', endColorstr=\'' . $custom_light_bg1 . '\' );';
			$g.= 'background-image: -ms-linear-gradient( top,  ' . $custom_dark_bg1 . ',  ' . $custom_light_bg1 . ' );';	
            $g.= "}\n";
			$g.= '#access '. $selector . '-' . $i . ' a{';
            $g.= 'color:' . raindrops_colors_clone( $i, 'color' ) . ';';
            $g.= 'background: -webkit-gradient( linear, left top, left bottom, from( ' . $custom_dark_bg1 . ' ), to( ' . $custom_light_bg1 . ' ) );';
            $g.= 'background: -moz-linear-gradient( top,  ' . $custom_dark_bg1 . ',  ' . $custom_light_bg1 . ' );';
            $g.= 'filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'' . $custom_dark_bg1 . '\', endColorstr=\'' . $custom_light_bg1 . '\' );';
			$g.= 'background-image: -ms-linear-gradient( top,  ' . $custom_dark_bg1 . ',  ' . $custom_light_bg1 . ' );';	
            $g.= "}\n";
            $g.= $selector . $i . ' a{';
            $g.= 'color:' . raindrops_colors_clone( $i, 'color' ) . ';';
            $g.= "}\n";
            $g.= '#access '. $selector . '-' . $i . ' a{';
            $g.= 'color:' . raindrops_colors_clone( $i, 'color' ) . ';';
            $g.= 'background: -webkit-gradient( linear, left top, left bottom, from( ' . $custom_dark_bg2 . ' ), to( ' . $custom_light_bg2 . ' ) );';
            $g.= 'background: -moz-linear-gradient( top,  ' . $custom_dark_bg2 . ',  ' . $custom_light_bg2 . ' );';
			$g.= 'background-image: -ms-linear-gradient( top,  ' . $custom_dark_bg2 . ',  ' . $custom_light_bg2 . ' );';		
            $g.= 'filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'' . $custom_dark_bg2 . '\', endColorstr=\'' . $custom_light_bg2 . '\' );';
            $g.= "}\n";
            $g.= $selector . '-' . $i . ' a{';
            $g.= 'color:' . raindrops_colors_clone( $i, 'color' ) . ';';
            $g.= "}\n";
        }
        return apply_filters( 'raindrops_gradient', $g );
    }

}

/**
 * Create CSS Color Declaration
 *
 *
 *
 *
 */
function raindrops_colors_clone( $num = 0, $select = 'set', $color1 = null ) {
    global $raindrops_images_path;
	
    if ( $color1 == null ) {
		
        $color1 = str_replace( '#', "", raindrops_warehouse_clone( 'raindrops_base_color' ) );
    } else {
		
        $color1 = str_replace( '#', "", $color1 );
    }
	if( class_exists ( 'raindrops_CSS_Color' ) ) {
		
		$base = new raindrops_CSS_Color( $color1 );
	} else {
		
		return;
	}
	/**
	 * Validation
	 */
	$options = array(
		'options' => array(
			'default'	 => 0,
			'min_range'	 => -5,
			'max_range'	 => 5,
		)
	);
	
	$num = filter_var( $num , FILTER_VALIDATE_INT, $options );
	
	if( $num > 0 ) {
		
		$num = '+'. $num;
	}
	$args_select = array( 'set', 'background', 'color' );
	
	if(false == array_search( $select, $args_select) ) {
		
		$select = 'set';
	}
	if( ! empty( $color1 ) && !ctype_xdigit( $color1 ) ) {
	
		$color1 = null;
	}

	if( isset( $base->bg[ $num ] )  ) {
		
		$bg = $base->bg[ $num ];
	}
	if( isset( $base->fg[ $num ] )  ) {
		
		$fg = $base->fg[ $num ];
	}
	if( isset( $bg ) && isset( $fg ) ) {

		$color = "color:#$fg;background-color:#$bg;";
	}

    switch ( $select ) {
        case ( 'set' ):
			if ( isset( $color ) ) {
				return safecss_filter_attr( $color );
			}
            break;

        case ( 'background' ):
			if ( isset( $bg ) ) {
				return '#' . $bg ;
			}
            break;

        case ( 'color' ):
			if ( isset( $fg ) ) {
				return  '#' . $fg ;
			}
            break;
    }
	return false;
}
/**
 * Will remove Old function at 1.299 
 * @global type $raindrops_images_path
 * @param type $num
 * @param type $select
 * @param type $color1
 * @return 
 */
/*
function raindrops_colors_clone( $num = 0, $select = 'set', $color1 = null ) {
    global $raindrops_images_path;
    if ( $color1 == null ) {
        $color1 = str_replace( '#', "", raindrops_warehouse_clone( 'raindrops_base_color' ) );
    } else {
        $color1 = str_replace( '#', "", $color1 );
    }
    $base = new raindrops_CSS_Color( $color1 );
	


    switch ( $num ) {
        case  0:
            $bg    = $base->bg['0'];
            $fg    = $base->fg['0'];
            $color = "color:#$fg;background-color:#$bg;";
            break;

        case -1:
			if( isset( $base->bg['-1'] ) && isset( $base->fg['-1'] ) ) {
				$bg    = $base->bg['-1'];
				$fg    = $base->fg['-1'];
				$color = "color:#$fg;background-color:#$bg;";
			}
            break;

        case -2:
            $bg    = $base->bg['-2'];
            $fg    = $base->fg['-2'];
            $color = "color:#$fg;background-color:#$bg;";
            break;

        case -3:
			if( isset( $base->bg['-3'] ) && isset(  $base->fg['-3'] ) ) {
				$bg    = $base->bg['-3'];
				$fg    = $base->fg['-3'];
				$color = "color:#$fg;background-color:#$bg;";
			}
            break;

        case -4:
			if( isset( $base->bg['-4'] ) && isset(  $base->fg['-4'] ) ) {
				$bg    = $base->bg['-4'];
				$fg    = $base->fg['-4'];
				$color = "color:#$fg;background-color:#$bg;";
			}
            break;

        case -5:
            $bg    = $base->bg['-5'];
            $fg    = $base->fg['-5'];
            $color = "color:#$fg;\n\tbackground-color:#$bg;";
            break;

        case 1:
            $bg    = $base->bg['+1'];
            $fg    = $base->fg['+1'];
            $color = "color:#$fg;\n\tbackground-color:#$bg;";
            break;

        case 2:
            $bg    = $base->bg['+2'];
            $fg    = $base->fg['+2'];
            $color = "color:#$fg;\n\tbackground-color:#$bg;";
            break;

        case 3:
            $bg    = $base->bg['+3'];
            $fg    = $base->fg['+3'];
            $color = "color:#$fg;\n\tbackground-color:#$bg;";
            break;

        case 4:
            $bg    = $base->bg['+4'];
            $fg    = $base->fg['+4'];
            $color = "color:#$fg;\n\tbackground-color:#$bg;";
            break;

        case 5:
            $bg    = $base->bg['+5'];
            $fg    = $base->fg['+5'];
            $color = "color:#$fg;\n\tbackground-color:#$bg;";
            break;

        default:
            $bg    = $base->bg['0'];
            $fg    = $base->fg['0'];
            $color = "color:#$fg;\n\tbackground-color:#$bg;";
            break;
    }
    switch ( $select ) {
        case ( 'set' ):
			if ( isset( $color ) ) {
				return $color;
			}
            break;

        case ( 'background' ):
			if ( isset( $bg ) ) {
				return '#' . $bg;
			}
            break;

        case ( 'color' ):
			if ( isset( $fg ) ) {
				return '#' . $fg;
			}
            break;
    }
}
*/
/**
 * Declaration Calculator
 *
 *
 *
 *
 */
function raindrops_default_colors_clone( $name = 'dark', $option_name = false, $default = false ) {

    $raindrops_images_path  = get_stylesheet_directory_uri() . '/images/';
	// Sidebar Image
    $navigation_title_img   = raindrops_warehouse_clone( 'raindrops_heading_image' );
	$navigation_title_img_uri = esc_url( $raindrops_images_path. $navigation_title_img );
	
    switch ( $name ) {

        case ( "w3standard" ):
            $custom_dark_bg  = raindrops_colors_clone( '3', 'background' );
            $custom_light_bg = raindrops_colors_clone( '1', 'background' );
            $custom_color    = raindrops_colors_clone( '1', 'color' );
			$raindrops_footer_color_default = '#000';
			$raindrops_header_color_default = '#000';

        break;
        case ( "dark" ):
            /**
             * dark
             */
            $custom_dark_bg  = raindrops_colors_clone( '-1', 'background' );
            $custom_light_bg = raindrops_colors_clone( '-4', 'background' );
            $custom_color    = raindrops_colors_clone( '-3', 'color' );
			$raindrops_footer_color_default = '#fff';
			$raindrops_header_color_default = '#fff';
            break;
        case ( "light" ):
            /**
             * light
             */
            $custom_dark_bg  = raindrops_colors_clone( '5', 'background' );
            $custom_light_bg = raindrops_colors_clone( '3', 'background' );
            $custom_color    = raindrops_colors_clone( '3', 'color' );
			$raindrops_footer_color_default = '#333';
			$raindrops_header_color_default = '#333';

            break;
        default:
            $custom_dark_bg  = raindrops_colors_clone( '3', 'background' );
            $custom_light_bg = raindrops_colors_clone( '1', 'background' );
            $custom_color    = raindrops_colors_clone( '1', 'color' );
			$raindrops_footer_color_default = '#000';
			$raindrops_header_color_default = '#000';
           
            break;
    }
	
	if( ! empty( $option_name ) ) {

		if( 'raindrops_background_color' == $option_name ||	'custom_dark_bg' == $option_name ) {
			return $custom_dark_bg;
		}
		if( 'custom_light_bg' == $option_name ) {
			return $custom_light_bg;
		}
		if( 'raindrops_default_fonts_color' == $option_name || 'custom_color' == $option_name || 'default-text-color' ) {
			return $custom_color;
		}
		if( 'raindrops_header_color' == $option_name ) {
			
		    $raindrops_header_color = raindrops_warehouse_clone( 'raindrops_default_fonts_color' );
			
			if( false == $default && isset( $raindrops_header_color ) && !empty( $raindrops_header_color ) ) {
				return $raindrops_header_color;
			} else {
				return $raindrops_header_color_default;
			}
		}
		if( 'raindrops_footer_color' == $option_name ) {
			
			$raindrops_footer_color = raindrops_warehouse_clone( 'raindrops_footer_color' );
			
			if( false == $default && isset( $raindrops_footer_color ) && !empty( $raindrops_footer_color ) ) {
				return $raindrops_footer_color;
			} else {
				return $raindrops_footer_color_default;
			}
			
		}
		if( 'raindrops_footer_link_color' == $option_name ) {
			return $custom_color;
		}
		if( 'raindrops_hyperlink_color' == $option_name ) {

			return $custom_color;
		}
		if( 'raindrops_header_image_filter_color' == $option_name ) {
			return $custom_light_bg;
		}

		if( 'h2_w3standard_background' == $option_name ) {

	    	$style = "background:" . raindrops_colors_clone( 5, 'background' ) . ' ';
			$style .= "url( {$navigation_title_img_uri} );";
	   		$style .= "color:" . raindrops_colors_clone( 4, 'color' ) . ';';
			return safecss_filter_attr( $style );
		}
		if ( 'h2_dark_background' == $option_name ) {

	    	$style = "background:" . raindrops_colors_clone( -3, 'background' ) . ' ';
	        $style .= "url( {$navigation_title_img_uri} );";
	    	$style .= "color:" . raindrops_colors_clone( -3, 'color' ) . ';';
			return safecss_filter_attr( $style );
		}
		if ( 'h2_light_background' == $option_name ) {

	    	$style = "background:" . raindrops_colors_clone( 4, 'background' ) . ' ';
	     	$style .= "url( {$navigation_title_img_uri} );";
	    	$style .= "color:" . raindrops_colors_clone( 4, 'color' ) . ';';
			return safecss_filter_attr( $style );
		}
		
	}
	return false;
}

function raindrops_design_output_clone( $name = 'dark' ) {
	/* Header banner line image , footer background image */
    $raindrops_header_image = raindrops_warehouse_clone( 'raindrops_header_image' );
    $raindrops_footer_image = raindrops_warehouse_clone( 'raindrops_footer_image' );
	
    if ( empty( $name ) ) {
        $name = 'dark';
    }
    $c_border = raindrops_colors_clone( 0, 'background' );
    if ( '#' == $c_border ) {
        $rgba_border = 'rgba( 203,203,203, 0.8 )';
    } else {
        $rgba_border = raindrops_hex2rgba( $c_border, 0.5 );
    }
    $c1 = raindrops_colors_clone( 0 );
    $c1 = raindrops_colors_clone( 1 );

    $c2         = raindrops_colors_clone( 2 );
    $c3         = raindrops_colors_clone( 3 );
    $c4         = raindrops_colors_clone( 4 );
    $c5         = raindrops_colors_clone( 5 );
    $c_1        = raindrops_colors_clone( -1 );
    $c_2        = raindrops_colors_clone( -2 );
    $c_3        = raindrops_colors_clone( -3 );
    $c_4        = raindrops_colors_clone( -4 );
    $c_5        = raindrops_colors_clone( -5 );
    $position_y = raindrops_warehouse_clone( 'raindrops_heading_image_position' );
    $y          = $position_y * 26;
    $y          = '-' . $y . 'px';
    switch ( $position_y ) {
        case ( 0 ):
            $h_position_rsidebar_h2 = "background-position:0 0;";
            break;

        case ( 1 ):
            $h_position_rsidebar_h2 = "background-position:0 $y;";
            break;

        case ( 2 ):
            $h_position_rsidebar_h2 = "background-position:0 $y;";
            break;

        case ( 3 ):
            $h_position_rsidebar_h2 = "background-position:0 $y;";
            break;

        case ( 4 ):
            $h_position_rsidebar_h2 = "background-position:0 $y;";
            break;

        case ( 5 ):
            $h_position_rsidebar_h2 = "background-position:0 $y;";
            break;

        case ( 6 ):
            $h_position_rsidebar_h2 = "background-position:0 $y;";
            break;

        case ( 7 ):
            $h_position_rsidebar_h2 = "background-position:0 $y;";
            break;

        default:
            $h_position_rsidebar_h2 = "background-position:0 208px;";
            break;
    }
    $h2_w3standard_background	 = raindrops_default_colors_clone( $name, 'h2_w3standard_background' );
	$h2_dark_background			 = raindrops_default_colors_clone( $name, 'h2_dark_background' );
	$h2_light_background		 = raindrops_default_colors_clone( $name, 'h2_light_background' );
	$custom_dark_bg				 = raindrops_default_colors_clone( $name, 'custom_dark_bg' );
	$custom_light_bg			 = raindrops_default_colors_clone( $name, 'custom_light_bg' );
	$custom_color				 = raindrops_default_colors_clone( $name, 'custom_color' );
	$raindrops_footer_color		 = raindrops_default_colors_clone( $name, 'raindrops_footer_color' );
	$raindrops_header_color		 = raindrops_default_colors_clone( $name, 'raindrops_header_color' );
	$gradient					 = raindrops_gradient_clone();

	switch ( $name ) {
        case ( "light" ):
            /**
             * light
             */
            $base_gradient   = raindrops_gradient_single_clone( 3, "asc" );
        break;
    }
	
    $function_name = 'raindrops_indv_css_' . $name;
    if ( function_exists( $function_name ) ) {

        $content = $function_name();

        foreach ( explode( ' ', $content, -1 ) as $line ) {

            preg_match_all( '|%([a-z0-9_-]+)?%|si', $line, $regs, PREG_SET_ORDER );

            foreach ( $regs as $reg ) {

                if ( isset( $$reg[1] ) ) {

                    $content = str_replace( $reg[0], $$reg[1], $content );
                } else {
                    $content = str_replace( $reg[0], '/*cannot bind data [%' . $reg[1] . '%]*/', $content );
                }
            }
        }
        return apply_filters( "raindrops_colors", $content );
    }
}
/////////////////////////////////////////////////

//function raindrops_design_output_clone( $name = 'dark' ) {
//    $raindrops_images_path  = get_stylesheet_directory_uri() . '/images/';
//    $navigation_title_img   = raindrops_warehouse_clone( 'raindrops_heading_image' );
//    $raindrops_header_image = raindrops_warehouse_clone( 'raindrops_header_image' );
//    $raindrops_header_color = raindrops_warehouse_clone( 'raindrops_default_fonts_color' );
//    $raindrops_footer_image = raindrops_warehouse_clone( 'raindrops_footer_image' );
//    $raindrops_footer_color = raindrops_warehouse_clone( 'raindrops_footer_color' );
//    if ( empty( $name ) ) {
//        $name = 'dark';
//    }
//    $c_border = raindrops_colors_clone( 0, 'background' );
//    if ( '#' == $c_border ) {
//        $rgba_border = 'rgba( 203,203,203, 0.8 )';
//    } else {
//        $rgba_border = raindrops_hex2rgba( $c_border, 0.5 );
//    }
//    $c1 = raindrops_colors_clone( 0 );
//    $c1 = raindrops_colors_clone( 1 );
//
//    $c2         = raindrops_colors_clone( 2 );
//    $c3         = raindrops_colors_clone( 3 );
//    $c4         = raindrops_colors_clone( 4 );
//    $c5         = raindrops_colors_clone( 5 );
//    $c_1        = raindrops_colors_clone( -1 );
//    $c_2        = raindrops_colors_clone( -2 );
//    $c_3        = raindrops_colors_clone( -3 );
//    $c_4        = raindrops_colors_clone( -4 );
//    $c_5        = raindrops_colors_clone( -5 );
//    $position_y = raindrops_warehouse_clone( 'raindrops_heading_image_position' );
//    $y          = $position_y * 26;
//    $y          = '-' . $y . 'px';
//    switch ( $position_y ) {
//        case ( 0 ):
//            $h_position_rsidebar_h2 = "background-position:0 0;";
//            break;
//
//        case ( 1 ):
//            $h_position_rsidebar_h2 = "background-position:0 $y;";
//            break;
//
//        case ( 2 ):
//            $h_position_rsidebar_h2 = "background-position:0 $y;";
//            break;
//
//        case ( 3 ):
//            $h_position_rsidebar_h2 = "background-position:0 $y;";
//            break;
//
//        case ( 4 ):
//            $h_position_rsidebar_h2 = "background-position:0 $y;";
//            break;
//
//        case ( 5 ):
//            $h_position_rsidebar_h2 = "background-position:0 $y;";
//            break;
//
//        case ( 6 ):
//            $h_position_rsidebar_h2 = "background-position:0 $y;";
//            break;
//
//        case ( 7 ):
//            $h_position_rsidebar_h2 = "background-position:0 $y;";
//            break;
//
//        default:
//            $h_position_rsidebar_h2 = "background-position:0 208px;";
//            break;
//    }
//    $h2_w3standard_background = "background:" . raindrops_colors_clone( 5, 'background' ) . ' ';
//    $h2_w3standard_background.= "url( {$raindrops_images_path}{$navigation_title_img} );";
//    $h2_w3standard_background.= "color:" . raindrops_colors_clone( 4, 'color' ) . ';';
//    $h2_dark_background       = "background:" . raindrops_colors_clone( -3, 'background' ) . ' ';
//    $h2_dark_background.= "url( {$raindrops_images_path}{$navigation_title_img} );";
//    $h2_dark_background.= "color:" . raindrops_colors_clone( -3, 'color' ) . ';';
//    $h2_light_background      = "background:" . raindrops_colors_clone( 4, 'background' ) . ' ';
//    $h2_light_background.= "url( {$raindrops_images_path}{$navigation_title_img} );";
//    $h2_light_background.= "color:" . raindrops_colors_clone( 4, 'color' ) . ';';
//    switch ( $name ) {
//        case ( "w3standard" ):
//            $custom_dark_bg  = raindrops_colors_clone( '3', 'background' );
//            $custom_light_bg = raindrops_colors_clone( '1', 'background' );
//            $custom_color    = raindrops_colors_clone( '1', 'color' );
//            if ( !empty( $raindrops_footer_color ) ) {
//                $raindrops_footer_color = $raindrops_footer_color;
//            } else {
//                $raindrops_footer_color = '#000';
//            }
//            if ( !empty( $raindrops_header_color ) ) {
//                $raindrops_header_color = $raindrops_header_color;
//            } else {
//                $raindrops_header_color = '#000';
//            }
//            $gradient = raindrops_gradient_clone();
//            break;
//
//        case ( "dark" ):
//            /**
//             * dark
//             */
//            $custom_dark_bg  = raindrops_colors_clone( '-1', 'background' );
//            $custom_light_bg = raindrops_colors_clone( '-4', 'background' );
//            $custom_color    = raindrops_colors_clone( '-3', 'color' );
//            if ( !empty( $raindrops_footer_color ) ) {
//                $raindrops_footer_color = $raindrops_footer_color;
//            } else {
//                $raindrops_footer_color = '#fff';
//            }
//            if ( !empty( $raindrops_header_color ) ) {
//                $raindrops_header_color = $raindrops_header_color;
//            } else {
//                $raindrops_header_color = '#fff';
//            }
//            $gradient = raindrops_gradient_clone();
//            break;
//
//        case ( "light" ):
//            /**
//             * light
//             */
//            $custom_dark_bg  = raindrops_colors_clone( '5', 'background' );
//            $custom_light_bg = raindrops_colors_clone( '3', 'background' );
//            $custom_color    = raindrops_colors_clone( '3', 'color' );
//            $base_gradient   = raindrops_gradient_single_clone( 3, "asc" );
//            if ( !empty( $raindrops_footer_color ) ) {
//                $raindrops_footer_color = $raindrops_footer_color;
//            } else {
//                $raindrops_footer_color = '#333';
//            }
//            if ( !empty( $raindrops_header_color ) ) {
//                $raindrops_header_color = $raindrops_header_color;
//            } else {
//                $raindrops_header_color = '#333';
//            }
//            $gradient = raindrops_gradient_clone();
//            break;
//
//        default:
//            $custom_dark_bg  = raindrops_colors_clone( '3', 'background' );
//            $custom_light_bg = raindrops_colors_clone( '1', 'background' );
//            $custom_color    = raindrops_colors_clone( '1', 'color' );
//            if ( !empty( $raindrops_footer_color ) ) {
//                $raindrops_footer_color = $raindrops_footer_color;
//            } else {
//                $raindrops_footer_color = '#000';
//            }
//            if ( !empty( $raindrops_header_color ) ) {
//                $raindrops_header_color = $raindrops_header_color;
//            } else {
//                $raindrops_header_color = '#000';
//            }
//            $gradient = raindrops_gradient_clone();
//            break;
//    }
//	
//    $function_name = 'raindrops_indv_css_' . $name;
//    if ( function_exists( $function_name ) ) {
//
//        $content = $function_name();
//
//        foreach ( explode( ' ', $content, -1 ) as $line ) {
//
//            preg_match_all( '|%([a-z0-9_-]+)?%|si', $line, $regs, PREG_SET_ORDER );
//
//            foreach ( $regs as $reg ) {
//
//                if ( isset( $$reg[1] ) ) {
//
//                    $content = str_replace( $reg[0], $$reg[1], $content );
//                } else {
//                    $content = str_replace( $reg[0], '/*cannot bind data [%' . $reg[1] . '%]*/', $content );
//                }
//            }
//        }
//        return apply_filters( "raindrops_colors", $content );
//    }
//}
/////////////////////////////////////////////////////////////////////////////////////////////////////////
function raindrops_default_color_clone( $option_name ) {
   
 	$name = raindrops_warehouse_clone( 'raindrops_style_type' );

    switch ( $name ) {

        case ( "w3standard" ):
            $custom_dark_bg  = raindrops_colors_clone( '3', 'background' );
            $custom_light_bg = raindrops_colors_clone( '1', 'background' );
            $custom_color    = raindrops_colors_clone( '1', 'color' );

        break;
        case ( "dark" ):
            /**
             * dark
             */
            $custom_dark_bg  = raindrops_colors_clone( '-1', 'background' );
            $custom_light_bg = raindrops_colors_clone( '-4', 'background' );
            $custom_color    = raindrops_colors_clone( '-3', 'color' );

            break;
        case ( "light" ):
            /**
             * light
             */
            $custom_dark_bg  = raindrops_colors_clone( '5', 'background' );
            $custom_light_bg = raindrops_colors_clone( '3', 'background' );
            $custom_color    = raindrops_colors_clone( '3', 'color' );

            break;
        default:
            $custom_dark_bg  = raindrops_colors_clone( '3', 'background' );
            $custom_light_bg = raindrops_colors_clone( '1', 'background' );
            $custom_color    = raindrops_colors_clone( '1', 'color' );

           
            break;
    }
	if( 'raindrops_background_color' == $option_name ) {
		return $custom_dark_bg;
	}
	if( 'raindrops_default_fonts_color' == $option_name ) {
		return $custom_color;
	}
	if( 'raindrops_footer_color' == $option_name ) {
		return $custom_color;
	}
	if( 'raindrops_footer_link_color' == $option_name ) {
		return $custom_color;
	}
	if( 'raindrops_hyperlink_color' == $option_name ) {
		return $custom_color;
	}
	if( 'raindrops_header_image_filter_color' == $option_name ) {
		return $custom_light_bg;
	}
	return false;
}
/**
 * Base Color Class Create
 *
 *
 *
 *
 */
function raindrops_color_base_clone( $color1 = null, $selector = null ) {
    global $raindrops_images_path;
    if ( null == $color1 ) {
        $color1 = str_replace( '#', "", raindrops_warehouse_clone( 'raindrops_base_color' ) );
    } else {
        $color1 = str_replace( '#', "", $color1 );
    }

    $class = 'color';
    $face  = 'face';
 /*   if ( !empty( $selector ) && array_key_exists( 'color', $selector ) && array_key_exists( 'face', $selector ) ) {

        $face  = strip_tags( $selector['face'] );
        $class = strip_tags( $selector['color'] );
    }*/

   	
	if( class_exists ( 'raindrops_CSS_Color' ) ) {
		
		$base = new raindrops_CSS_Color( $color1 );
	} else {
		
		return;
	}
	
	$colors_values = array( '-1', '-2', '-3', '-4', '-5', 0, '+1','+2','+3','+4', '+5' );
	$bg_1 = '';
	$fg_1 = '';
	$bg_2 = '';
	$fg_2 = '';
	$bg_3 = '';
	$fg_3 = '';
	$bg_4 = '';
	$fg_4 = '';	
	$bg_5 = '';
	$fg_5 = '';
	$bg1 = '';
	$fg1 = '';
	$bg2 = '';
	$fg2 = '';
	$bg3 = '';
	$fg3 = '';
	$bg4 = '';
	$fg4 = '';	
	$bg5 = '';
	$fg5 = '';
	
	if( isset( $base->bg['-1'] ) ) {
		$bg_1   = $base->bg['-1'];
	}
	if( isset( $base->fg['-1'] ) ) {
		$fg_1   = $base->fg['-1'];
	}
	if( isset( $base->bg['-2'] ) ) {
		$bg_2   = $base->bg['-2'];
	}
	if( isset( $base->fg['-2'] ) ) {
		$fg_2   = $base->fg['-2'];
	}
	if( isset( $base->bg['-3'] ) ) {
		$bg_3   = $base->bg['-3'];
	}
	if( isset( $base->fg['-3'] ) ) {	
		$fg_3   = $base->fg['-3'];
	}
	if( isset( $base->bg['-4'] ) ) {	
		$bg_4   = $base->bg['-4'];
	}
	if( isset( $base->fg['-4'] ) ) {	
		$fg_4   = $base->fg['-4'];
	}
	if( isset( $base->bg['-5'] ) ) {	
		$bg_5   = $base->bg['-5'];
	}
	if( isset( $base->fg['-5'] ) ) {	
		$fg_5   = $base->fg['-5'];
	}
	if( isset( $base->bg['+1'] ) ) {	
		$bg1    = $base->bg['+1'];
	}
	if( isset( $base->fg['+1'] ) ) {	
		$fg1    = $base->fg['+1'];
	}
	if( isset( $base->bg['+2'] ) ) {	
		$bg2    = $base->bg['+2'];
	}
	if( isset( $base->fg['+2'] ) ) {	
		$fg2    = $base->fg['+2'];
	}
	if( isset( $base->bg['+3'] ) ) {		
		$bg3    = $base->bg['+3'];
	}
	if( isset( $base->fg['+3'] ) ) {	
		$fg3    = $base->fg['+3'];
	}
	if( isset( $base->bg['+4'] ) ) {	
		$bg4    = $base->bg['+4'];
	}
	if( isset( $base->fg['+4'] ) ) {	
		$fg4    = $base->fg['+4'];
	}
	if( isset( $base->bg['+5'] ) ) {		
		$bg5    = $base->bg['+5'];
	}
	if( isset( $base->fg['+5'] ) ) {
		$fg5    = $base->fg['+5'];
	}
	
	
    $result = <<<CSS
.{$class}-1 a,
.{$class}-1{
  background:#{$bg_1};
  color:#{$fg_1};
}
.{$class}-2 a,
.{$class}-2 {
  background:#{$bg_2};
  color:#{$fg_2};
}
.{$class}-3 a,
.{$class}-3 {
  background:#{$bg_3};
  color:#{$fg_3};
}
.{$class}-4 a,
.{$class}-4 {
  /** Use the base {$class}, two shades darker */
  background:#{$bg_4};
  /** Use the corresponding foreground {$class} */
  color:#{$fg_4};
}
.{$class}-5 a,
.{$class}-5 {
  background:#{$bg_5};
  color:#{$fg_5};
}
.{$class}1 a,
.{$class}1{
  background:#{$bg1};
  color:#{$fg1};
}
.{$class}2 a,
.{$class}2 {
  background:#{$bg2};
  color:#{$fg2};
}
.{$class}3 a,
.{$class}3 {
  background:#{$bg3};
  color:#{$fg3};
}
.{$class}4 a,
.{$class}4 {
  /** Use the base color, two shades darker */
  background:#{$bg4};
  /** Use the corresponding foreground color */
  color:#{$fg4};
}
.{$class}5 a,
.{$class}5 {
  background:#{$bg5};
  color:#{$fg5};
}
.{$face}-1{
  color:#{$fg_1};
}
.{$face}-2 {
  color:#{$fg_2};
}
.{$face}-3 {
  color:#{$fg_3};
}
.{$face}-4 {
  color:#{$fg_4};
}
.{$face}-5 {
  color:#{$fg_5};
}
.{$face}1{
  color:#{$fg1};
}
.{$face}2 {
  color:#{$fg2};
}
.{$face}3 {
  color:#{$fg3};
}
.{$face}4 {
  color:#{$fg4};
}
.{$face}5 {
  color:#{$fg5};
}
CSS;
    return $result;
}

/**
 * register style name
 *
 *
 *
 *
 */
function raindrops_register_styles_clone( $style_name ) {
    static $vals;
    $vals[$style_name] = $style_name;
    return $vals;
}

/**
 * 
 * @return string
 * 
 * 
 */
function raindrops_gallerys_clone() {
	
	global $raindrops_extend_galleries;
	
		$clear_float = ".gallery,
			.gallery-columns-1 .gallery-item:nth-child(2),\n
			.gallery-columns-2 .gallery-item:nth-child(3),\n
			.gallery-columns-3 .gallery-item:nth-child(4),\n
			.gallery-columns-4 .gallery-item:nth-child(5),\n
			.gallery-columns-5 .gallery-item:nth-child(6),\n
			.gallery-columns-6 .gallery-item:nth-child(7),\n
			.gallery-columns-7 .gallery-item:nth-child(8),\n
			.gallery-columns-8 .gallery-item:nth-child(9),\n
			.gallery-columns-9 .gallery-item:nth-child(10),\n
			.gallery-columns-10 .gallery-item:nth-child(11){clear:both;}";
	
		if ( $raindrops_extend_galleries !== true ){
			
			return apply_filters( "raindrops_gallerys_css", $clear_float, $raindrops_extend_galleries );
		}
	
	$doc_type = 'html5';	
	
	$doc_type = raindrops_warehouse_clone( 'raindrops_doc_type_settings' );

	if( $doc_type == 'xhtml' ){
		$display_property = 'float:left;';
	} else {
		$display_property = 'display:inline-block;';
	}

    $raindrops_gallerys = ".gallery { margin: auto; width: 100%; }\n
            .gallery .gallery-item { margin: 0px; }\n
            .gallery .gallery-item {". $display_property. " margin-top: 10px; text-align: center; }\n
            .gallery img { max-width:100%; }\n
            .gallery .gallery-caption { margin-left: 0; }\n
            .gallery br { clear: both }\n
            .gallery-columns-1 .gallery-item{ width: 100% }\n
            .gallery-columns-2 .gallery-item{ width: 50% }\n
            .gallery-columns-3 .gallery-item{ width: 33.3% }\n
            .gallery-columns-4 .gallery-item{ width: 25% }\n
            .gallery-columns-5 .gallery-item{ width: 20% }\n
            .gallery-columns-6 .gallery-item{ width: 16.6% }\n
            .gallery-columns-7 .gallery-item{ width: 14.28% }\n
            .gallery-columns-8 .gallery-item{ width: 12.5% }\n
            .gallery-columns-9 .gallery-item{ width: 11.1% }\n
            .gallery-columns-10 .gallery-item{ width: 9.9% }\n";
	
	$raindrops_gallerys .= $clear_float;
	
	/* caption text presentation */
    $raindrops_gallerys .= ".gallery:after{content:'';clear:both;display:block;}.gallery-item{position:relative;}
			.gallery figcaption{
            box-sizing:border-box;
            position:absolute;
            top:-10%;
            left:30%;
            width:160px;
			height:auto;
            bottom:30%;
            padding:1em;
            text-align:left;
            margin:auto;
            background:#000;
            color:#fff;
			opacity:0;
			transition:opacity .7s;
			border-radius: 10% 0 10% 0; 
            -moz-border-radius:10% 0 10% 0; 
            -webkit-border-radius: 10% 0 10% 0; 
            border: 1px solid #fff;
            visibility:hidden;
            transition:visibility .7s, opacity .7s;
			-webkit-transition:visibility .7s,opacity .7s;
            z-index:99999;
        }
		.gallery figure:focus figcaption{
			visibility:visible;
            opacity:.7;
			transition:visibility 1s, opacity 1s;
			-webkit-transition:visibility .7s,opacity .7s;
            overflow:hidden;
            margin:4px;
			outline:0;
		}
        .gallery .gallery-item:hover figcaption{
            visibility:visible;
            opacity:.7;
			transition:visibility 1s, opacity 1s;
			-webkit-transition:visibility .7s,opacity .7s;
            overflow:hidden;
            margin:4px;
            
        }";
    return apply_filters( "raindrops_gallerys_css", $raindrops_gallerys );
}
/**
 * 
 * @since 1.243
 * @param type $hex color value
 * @return array rgb value
 */
 function raindrops_hex2rgb_array_clone( $hex ) {

	$hex	= str_replace( '#', '', $hex);
    $d		= '[a-fA-F0-9]';

    if ( preg_match( "/^($d$d)($d$d)($d$d)\$/", $hex, $rgb ) ) {

      return array(
           hexdec($rgb[1]),
           hexdec($rgb[2]),
           hexdec($rgb[3])
           );
    }
	
    if ( preg_match("/^($d)($d)($d)$/", $hex, $rgb ) ) {

      return array(
           hexdec($rgb[1] . $rgb[1]),
           hexdec($rgb[2] . $rgb[2]),
           hexdec($rgb[3] . $rgb[3])
           );
    }
    return false;
  }
  
 if ( !function_exists( 'raindrops_detect_header_image_size_clone' ) ) {
	 
	function raindrops_detect_header_image_size_clone( $xy = 'width' ) {

		global $raindrops_custom_header_args;

		$all_header_images		 = array();
		$header_image			 = get_custom_header();
		$header_image_uri		 = $header_image->url;
		$header_image_basename	 = basename( $header_image_uri );
		$page_width			     = raindrops_warehouse_clone( 'raindrops_page_width' );

		if ( $raindrops_custom_header_args[ "default-image" ] == $header_image_uri ) {

			if ( 'width' == $xy ) {
				if ( false !== $raindrops_custom_header_args[ "width" ] ) {
				return $raindrops_custom_header_args[ "width" ];
				}
			} elseif ( 'height' == $xy ) {
				if ( false !== $raindrops_custom_header_args[ "height" ] ) {
				return $raindrops_custom_header_args[ "height" ];
				}
			}
		}
		
		$all_header_images = get_uploaded_header_images();

		if ( 'width' == $xy ) {

			if ( isset( $all_header_images[ $header_image_basename ][ 'width' ] ) ) {
				if( false !== $all_header_images[ $header_image_basename ][ 'width' ]){
				return $all_header_images[ $header_image_basename ][ 'width' ];
				}
			} else {
				if ( false !== $header_image->width ) {
				return $header_image->width;
				}
			}
		} elseif ( 'height' == $xy ) {

			if ( isset( $all_header_images[ $header_image_basename ][ 'height' ] ) ) {
				if( false !== $all_header_images[ $header_image_basename ][ 'height' ]){
				return $all_header_images[ $header_image_basename ][ 'height' ];
				}
			} else {
				if ( false !== $header_image->height ) {
					
					return $header_image->height;
				}
			}
		}
		

		switch ( $page_width ) {
			case ( "doc" ):
				$custom_header_width = 750;
				$custom_header_height = 335;
				break;

			case ( "doc2" ):
				$custom_header_width = 950;
				$custom_header_height = 425;
				break;

			case ( "doc3" ):

				$custom_header_width = raindrops_warehouse_clone( 'raindrops_fluid_max_width' );
				$custom_header_height = round( $custom_header_width * 0.40859375 );
        		break;

			case ( "doc4" ):

				$custom_header_width = 974;
				$custom_header_height = 436;
				break;
			case ( "doc5" ):

				$custom_header_width = raindrops_warehouse_clone( 'raindrops_full_width_limit_window_width' );
				$custom_header_height = round( $custom_header_width * 0.40859375 );
        		break;
		}
	
		if( $xy == 'width' ) {
			return $custom_header_width;
		}
		if( $xy == 'height' ) {
			return  $custom_header_height;
		}
		return false;
	}
 }
function raindrops_complementary_color_clone( $hex_color = '#444' ) {

		$rgb_array = raindrops_hex2rgb_array_clone( $hex_color );

		if ( false !== $rgb_array ) {

			$rgb_max_value	 = max( $rgb_array );
			$rgb_min_value	 = min( $rgb_array );
			$rgb_total		 = $rgb_max_value + $rgb_min_value;


			$r_value = sprintf( '%02s', dechex( $rgb_total - $rgb_array[ 0 ] ) );
			$g_value = sprintf( '%02s', dechex( $rgb_total - $rgb_array[ 1 ] ) );
			$b_value = sprintf( '%02s', dechex( $rgb_total - $rgb_array[ 2 ] ) );

			return '#' . $r_value . $g_value . $b_value;
		}
		return false;
	}
	
	function raindrops_locate_url( $filename , $type = 'url' ) {

		$template_uri	 = trailingslashit( get_template_directory_uri() );
		$template_path	 = trailingslashit( get_template_directory() );

		if ( is_child_theme() ) {

				$stylesheet_uri	 = trailingslashit( get_stylesheet_directory_uri() );
				$stylesheet_path = trailingslashit( get_stylesheet_directory() );

				if ( file_exists( $stylesheet_path . $filename ) ) {

						if ( $type == 'url' ) {
							return $stylesheet_uri . $filename;
						}
						if ( $type == 'path' ) {
							return $stylesheet_path . $filename;
						}

				}
		}

		if ( ! file_exists( $template_path . $filename ) ) {

			return false;
		}
		if ( $type == 'url' ) {
			return $template_uri . $filename;
		}
		if ( $type == 'path' ) {
			return $template_path . $filename;
		}
		return false;

	}
	
	class RaindropsPostHelp {

	public $tabs = array(
		'raindrops-post' => array(
			'title'		 => 'Raindrops Help'
			, 'content'	 => 'help'
		),
	);

	static public function init() {
		$class = __CLASS__;
		new $class;
	}

	public function __construct() {

		switch ( $GLOBALS[ 'pagenow' ] ) {
			case( 'theme-editor.php' ):

				$this->tabs = array( 'raindrops-settings-help' => array( 'title' => 'Raindrops Infomation', 'content' => 'help' ) );

				add_action( "load-{$GLOBALS[ 'pagenow' ]}", array( $this, 'add_tabs_theme_editor' ), 20 );
				break;

			case( 'themes.php' ):

				$this->tabs = array( 'raindrops-settings-help' => array( 'title' => 'Raindrops Infomation', 'content' => 'help' ) );

				add_action( "load-{$GLOBALS[ 'pagenow' ]}", array( $this, 'add_tabs_theme' ), 20 );
				break;

			case( 'post-new.php' ):

				add_action( "load-{$GLOBALS[ 'pagenow' ]}", array( $this, 'add_tabs' ), 20 );
				break;
			case( 'post.php' ):

				add_action( "load-{$GLOBALS[ 'pagenow' ]}", array( $this, 'add_tabs' ), 20 );
				break;
		}


	}

	public function add_tabs() {

		foreach ( $this->tabs as $id => $data ) {

			get_current_screen()->add_help_tab( array(
				'id'		 => $id
				, 'title'		 => __( 'Raindrops Help', 'Raindrops' )
				, 'content'	 => '<h1>' . __( 'About Base Color related Class', 'Raindrops' ) . '</h1>'
				, 'callback'	 => array( $this, 'prepare' )
			) );
		}
	}

	public function add_tabs_theme() {

		foreach ( $this->tabs as $id => $data ) {

			get_current_screen()->add_help_tab( array(
				'id'		 => $id
				, 'title'		 => __( 'Raindrops Theme Help', 'Raindrops' )
				, 'content'	 => '<h1>' . __( 'About Raindrops Theme', 'Raindrops' ) . '</h1>'
				, 'callback'	 => array( $this, 'prepare_theme' )
			) );
		}
	}

	public function add_tabs_theme_editor() {

		foreach ( $this->tabs as $id => $data ) {

			get_current_screen()->add_help_tab( array(
				'id'		 => $id
				, 'title'		 => __( 'Raindrops Theme Help', 'Raindrops' )
				, 'content'	 => '<h1>' . __( 'About Raindrops Theme', 'Raindrops' ) . '</h1>'
				, 'callback'	 => array( $this, 'prepare_theme' )
			) );
		}
	}

	public function prepare( $screen, $tab ) {

		if ( RAINDROPS_USE_AUTO_COLOR !== false ) {

			echo raindrops_edit_help( '' );
		} else {

			printf( '<p class="disable-color-gradient">%1$s</p>', esc_html__( 'Now RAINDROPS_USE_AUTO_COLOR value false and Cannot show this help', 'Raindrops' ) );
		}
	}

	public function prepare_theme( $screen, $tab ) {

		echo raindrops_settings_page_contextual_help();
	}

	public function prepare_theme_editor( $screen, $tab ) {

		echo raindrops_editor_page_contextual_help();
	}
}

/**
 * for customizer functions
 * @param type $args
 * @return type
 */
function raindrops_theme_mod_default_normalize( $args ) {

	$defaults = array(
		'data_type'				 => 'theme_mod',
		'capability'			 => 'edit_theme_options',
		'theme_supports'		 => '',
		'default'				 => '',
		'transport'				 => 'refresh',
		'sanitize_callback'		 => '',
		'sanitize_js_callback'	 => '',
		'dirty'					 => false,
		'setting'				 => 'default',
		'priority'				 => 10,
		'section'				 => '',
		'label'					 => '',
		'description'			 => '',
		'choices'				 => array(),
		'input_attrs'			 => array(),
		'json'					 => array(),
		'type'					 => 'text',
		'active_callback'		 => '',
	);

	$results = array();

	foreach ( $args as $key => $val ) {

		$result_val = wp_parse_args( $val, $defaults );

		$results[ $key ] = apply_filters( 'default_settings_' . $key, $result_val );
	}
	return $results;
}
	
function raindrops_data_store_relate_id( $id ) {

	if ( 'option' == raindrops_theme_mod( $id, 'data_type' ) ) {

		return THEME_OPTION_FIELD_NAME . '[' . $id . ']';
	}
	return $id;
}

function raindrops_theme_mod( $name = '', $property = 'default' ) {

	global $raindrops_customize_args;

	if ( !empty( $raindrops_customize_args[ $name ] ) && array_key_exists( $name, $raindrops_customize_args ) ) {

		if ( $property == 'default_value' ) {
			return get_theme_mod( $name, $raindrops_customize_args[ $name ][ 'default' ] );
		} else {
			return $raindrops_customize_args[ $name ][ $property ];
		}
	} else {

		return false;
	}
}

function raindrops_filter_page_column_control() {

	global $raindrops_current_column, $post, $template, $raindrops_keep_content_width;
	
	if( isset( $template ) && !empty( $template ) ) {
		$template = basename( $template,'.php' );
	} else {
		$template = 'index';
	}
	if ( 'list-of-post' == $template ) {
		$raindrops_current_column = ( int ) raindrops_warehouse_clone( 'raindrops_sidebar_list_of_post' );
		$raindrops_keep_content_width	 = raindrops_keep_content_width( $raindrops_current_column );
		return;
	}
	if ( 'front-page' == $template ) {
		$raindrops_current_column = ( int ) 3;
		$raindrops_keep_content_width	 = raindrops_keep_content_width( $raindrops_current_column );
		return;
	}
	if ( 'blank-front' == $template ) {
		/**
		 * Feature implement		 
		$raindrops_current_column = (int) raindrops_warehouse_clone( 'raindrops_sidebar_brank_front' );
		*/
		$raindrops_current_column = (int) 3;
		$raindrops_keep_content_width	 = raindrops_keep_content_width( $raindrops_current_column );
		return;
	}
	if ( 'full-width' == $template ) {
		$raindrops_current_column = ( int ) 1;
		$raindrops_keep_content_width	 = raindrops_keep_content_width( $raindrops_current_column );
		return;
	}
	if ( 'page-featured' == $template ) {
		$raindrops_current_column = ( int ) 3;
		$raindrops_keep_content_width	 = raindrops_keep_content_width( $raindrops_current_column );
		return;
	}
	if ( 'front-portfolio' == $template ) {
		$raindrops_current_column = ( int ) 3;
		$raindrops_keep_content_width	 = raindrops_keep_content_width( $raindrops_current_column );
		return;
	}
	if ( 'image' == $template ) {
		$raindrops_current_column = ( int ) raindrops_warehouse_clone( 'raindrops_sidebar_image_archive' );
		$raindrops_keep_content_width	 = raindrops_keep_content_width( $raindrops_current_column );
		return;
	}

	if ( is_singular() && isset( $post ) ) {

		$raindrops_content_check = get_post( $post->ID );
		$raindrops_content_check = $raindrops_content_check->post_content;

		if ( preg_match( "!\[raindrops[^\]]+(col)=(\"|')*?([^\"' ]+)(\"|')*?[^\]]*\]!si", $raindrops_content_check, $regs ) ) {

			$raindrops_current_column = absint( $regs[ 3 ] );
			$raindrops_keep_content_width	 = raindrops_keep_content_width( $raindrops_current_column );
			return;
		} else {
			if( is_single() ) {
				$raindrops_current_column = ( int ) raindrops_warehouse_clone( 'raindrops_sidebar_single' );
			} else {
				$raindrops_current_column = ( int ) raindrops_warehouse_clone( 'raindrops_sidebar_page' );
			}
			$raindrops_keep_content_width	 = raindrops_keep_content_width( $raindrops_current_column );
			return;
		}
	} 
	if ( is_home() ) {
		$raindrops_current_column = (int) raindrops_warehouse_clone( 'raindrops_sidebar_index' );
		$raindrops_keep_content_width	 = raindrops_keep_content_width( $raindrops_current_column );
		return;
	}
	if ( is_date() ) {
		$raindrops_current_column = (int) raindrops_warehouse_clone( 'raindrops_sidebar_date' );
		$raindrops_keep_content_width	 = raindrops_keep_content_width( $raindrops_current_column );
		return;
	}

	if ( is_search() ) {
		$raindrops_current_column = (int) raindrops_warehouse_clone( 'raindrops_sidebar_search' );
		$raindrops_keep_content_width	 = raindrops_keep_content_width( $raindrops_current_column );
		return;
	}
	if ( is_404() ) {
		$raindrops_current_column = (int) raindrops_warehouse_clone( 'raindrops_sidebar_404' );
		$raindrops_keep_content_width	 = raindrops_keep_content_width( $raindrops_current_column );
		return;
	}
	if ( is_category() ) {
		$raindrops_current_column = (int) raindrops_warehouse_clone( 'raindrops_sidebar_catetory' );
		$raindrops_keep_content_width	 = raindrops_keep_content_width( $raindrops_current_column );
		return;
	}
	if ( is_author() ) {
		$raindrops_current_column = (int) raindrops_warehouse_clone( 'raindrops_sidebar_author' );
		$raindrops_keep_content_width	 = raindrops_keep_content_width( $raindrops_current_column );
		return;
	}
	if ( is_tag() ) {
		$raindrops_current_column = (int) raindrops_warehouse_clone( 'raindrops_sidebar_tag' );
		$raindrops_keep_content_width	 = raindrops_keep_content_width( $raindrops_current_column );
		return;
	}	
}

function raindrops_keep_content_width( $column ) {
	global $raindrops_keep_content_width;
	
	$page_width	= raindrops_warehouse_clone( 'raindrops_page_width' );

	if( 1 == $column && 'doc5' == $page_width ) {

		return false;
	} else {

		if( isset( $raindrops_keep_content_width ) ) {

			return $raindrops_keep_content_width;
		}
		return true;
	}
}

	function raindrops_merge_config_customizer_to_theme( $customizer_args, $theme_args ) {

		foreach( $customizer_args as $key => $val ) {

			$theme_args[] = array('option_name'=>$key, 'title' => $val['label'],'validate' => $val['sanitize_callback'],'excerpt2' =>$val['description'] , 'option_value' => $val['default'] );
		}
		return $theme_args;
	}
?>