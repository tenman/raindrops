<?php
/**
 * This functions has alias function
 *
 *
 * @package WordPress
 * @subpackage Raindrops
 * @since Raindrops 0.931
 * 
 */
if ( !function_exists( 'raindrops_warehouse_clone' ) ) {

	/**
	 * 
	 * @global type $raindrops_base_setting
	 * @global type $raindrops_page_width
	 * @global type $raindrops_setting_type
	 * @global type $raindrops_base_setting_args
	 * @param type $name
	 * @param type $property
	 * @param type $fallback
	 * @return string|boolean
	 * @since 1.400
	 */
	function raindrops_warehouse_clone( $name, $property = false, $fallback = false ) {

		global $raindrops_base_setting, $raindrops_page_width, $raindrops_setting_type, $raindrops_base_setting_args, $raindrops_child_base_setting_args;

		$raindrops_current_data			 = wp_get_theme();
		$raindrops_current_data_version	 = $raindrops_current_data->get( 'Version' );
		$raindrops_current_theme_name	 = $raindrops_current_data->get( 'Name' );
		/**
		 * Theme version trainsitional setting
		 * Note: Maybe remove new version live
		 */
		if ( version_compare( $raindrops_current_data_version, '1.356.1', '<=' ) && 'boots' == $raindrops_current_theme_name ) {

			return raindrops_warehouse_clone_transitional( $name, $property, $fallback );
		}

		if ( version_compare( $raindrops_current_data_version, '1.216', '<=' ) && 'puddle' == $raindrops_current_theme_name ) {

			return raindrops_warehouse_clone_transitional( $name, $property, $fallback );
		}
		if ( apply_filters( 'raindrops_warehouse_clone_transitional', false ) ) {

			return raindrops_warehouse_clone_transitional( $name, $property, $fallback );
		}

		$name = trim( $name );
		
		if ( is_child_theme() ) {

			if ( isset( $raindrops_child_base_setting_args ) && ! empty( $name ) && !array_key_exists( $name, $raindrops_child_base_setting_args ) ) {

				return false;
			}
		}


		if ( isset( $raindrops_base_setting_args ) && !array_key_exists( $name, $raindrops_base_setting_args ) ) {

			return $fallback;
		}

		if ( 'option_value' == $property ) {
			
			$raindrops_custom_values = apply_filters('raindrops_custom_option_vals', false );
			
			if( false !== $raindrops_custom_values && ! empty( $raindrops_custom_values ) ) {
				
					if( array_key_exists( $name, $raindrops_custom_values ) ) {

						$validate_function_name = $name.'_validate';					
						return $validate_function_name( $raindrops_custom_values[$name] );
					}
			}
			
			if ( is_child_theme() && isset( $raindrops_child_base_setting_args ) ) {

				if ( isset( $raindrops_child_base_setting_args[ $name ][ 'option_value' ] ) ) {

					return $raindrops_child_base_setting_args[ $name ][ 'option_value' ];
				} else {

					return 'bad';
				}
			} else {

				if ( isset( $raindrops_base_setting_args[ $name ][ 'option_value' ] ) ) {

					return $raindrops_base_setting_args[ $name ][ 'option_value' ];
				} else {

					return 'bad';
				}
			}
		}

		if ( 'option' == $raindrops_setting_type ) {

			if ( is_child_theme() && isset( $raindrops_child_base_setting_args ) ) {

				if ( isset( $raindrops_page_width ) && !empty( $raindrops_page_width ) && 'raindrops_page_width' == $name ) {

					return 'custom-doc';
				}
				$result = get_option( 'raindrops_theme_settings' );

				if ( isset( $result[ $name ] ) && !empty( $result[ $name ] ) ) {

					return apply_filters( 'raindrops_theme_settings_' . $name, $result[ $name ] );
				} else {

					if ( isset( $raindrops_child_base_setting_args[ $name ][ 'option_value' ] ) ) {

						$result = $raindrops_child_base_setting_args[ $name ][ 'option_value' ];
					} else {

						$result = false;
					}

					if ( isset( $result ) && !empty( $result ) ) {

						return apply_filters( 'raindrops_theme_settings_' . $name, $result );
					}
				}
				return $fallback;
			} else {

				if ( isset( $raindrops_page_width ) && !empty( $raindrops_page_width ) && 'raindrops_page_width' == $name ) {

					return 'custom-doc';
				}
				$result = get_option( 'raindrops_theme_settings' );

				if ( isset( $result[ $name ] ) && !empty( $result[ $name ] ) ) {

					return apply_filters( 'raindrops_theme_settings_' . $name, $result[ $name ] );
				} else {

					if ( isset( $raindrops_base_setting_args[ $name ][ 'option_value' ] ) ) {

						$result = $raindrops_base_setting_args[ $name ][ 'option_value' ];
					} else {

						$result = false;
					}

					if ( isset( $result ) && !empty( $result ) ) {

						return apply_filters( 'raindrops_theme_settings_' . $name, $result );
					}
				}
				return $fallback;
			}
		} elseif ( 'theme_mod' == $raindrops_setting_type ) {

			if ( isset( $raindrops_page_width ) && !empty( $raindrops_page_width ) && 'raindrops_page_width' == $name ) {

				return 'custom-doc';
			}

			$result = get_theme_mod( $name, false );
			
			if ( false !== $result ) {

				return apply_filters( 'raindrops_theme_settings_' . $name, get_theme_mod( $name ) );
			}
			if ( false === $result && is_child_theme() && isset( $raindrops_child_base_setting_args ) ) {

						if ( isset( $raindrops_child_base_setting_args[ $name ][ 'option_value' ] ) ) {

							$result = $raindrops_child_base_setting_args[ $name ][ 'option_value' ];
						
						} else {
							$result = false;
						}
			} elseif ( false === $result ) {
				
			if ( isset( $raindrops_base_setting_args[ $name ][ 'option_value' ] ) ) {

					$result = $raindrops_base_setting_args[ $name ][ 'option_value' ];
				} else {
					$result = false;
				}
			}

			if ( isset( $result ) && !empty( $result ) ) {

				return apply_filters( 'raindrops_theme_settings_' . $name, $result );
			} else {

				return $fallback;
			}
		}
		return false;
	}
}

if ( !function_exists( 'raindrops_warehouse_clone_transitional' ) ) {
    /**
     * return Raindrops settings
     *  Note: Maybe remove new version live
     *
     * @see raindrops_warehouse( )
     *
     */

	function raindrops_warehouse_clone_transitional( $name , $property = false, $fallback = false ) {
		
        global $raindrops_base_setting, $raindrops_page_width, $raindrops_setting_type;

		$row = '';
		$name = trim( $name );
		
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
			
			$theme_slug = get_option( 'stylesheet' );
			
			if( false === $result && strpos($name, $theme_slug ) !== false ) {
				
				$result = raindrops_warehouse_clone( $name ,'option_value' );
			}
				
			if ( isset( $result ) && !empty( $result ) ) {
				
				return apply_filters( 'raindrops_theme_settings_' . $name, $result );

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
		global $raindrops_page_width, $raindrops_fluid_maximum_width, $raindrops_keep_content_width;
		$adjust				 = 16;
		$default			 = 400;
		$document_width		 = raindrops_warehouse_clone( 'raindrops_page_width' );
		$sidebar_width		 = 'yui-' . raindrops_warehouse_clone( 'raindrops_col_width' );
		$extra_sidebar_width = raindrops_warehouse_clone( 'raindrops_right_sidebar_width_percent' );
		$raindrops_content_width_setting = raindrops_warehouse_clone( 'raindrops_content_width_setting' );
		
		if( ( isset( $raindrops_keep_content_width ) && false == $raindrops_keep_content_width || 
			'fit' == $raindrops_content_width_setting && ! is_active_sidebar( 'sidebar-1' ) && ! is_active_sidebar( 'sidebar-2' ) ) 
			&& ( 'doc3' == $document_width || 'doc5' == $document_width ) ) {
			/**
			 * @since 1.442
			 */
			if ( 'doc3' == $document_width ) {
				$w = raindrops_warehouse_clone( 'raindrops_fluid_max_width' );
			}
			if ( 'doc5' == $document_width ) {
				$w = raindrops_warehouse_clone( 'raindrops_full_width_max_width' );
			}

			return $w;
		}
		
		if ( isset( $raindrops_page_width ) && !empty( $raindrops_page_width ) ) {
			$w		 = $raindrops_page_width;
			$adjust	 = 16;
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
				$w		 = 750;
				$adjust	 = 16;
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
				$w		 = 950;
				$adjust	 = 16;
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
				$w		 = 974;
				$adjust	 = 16;
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
			if ( !empty( $raindrops_content_width ) ) {
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
			return apply_filters( 'raindrops_content_width', $raindrops_content_width );
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
        $g.= 'background: -moz-linear-gradient( top, ' . $custom_dark_bg1 . ',  ' . $custom_light_bg1 . ' );';
        $g.= 'background: -ms-linear-gradient( top, ' . $custom_dark_bg1 . ',  ' . $custom_light_bg1 . ' );';
        $g.= 'filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'' . $custom_dark_bg1 . '\', endColorstr=\'' . $custom_light_bg1 . '\' );';
        return wp_strip_all_tags( $g );
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
            $g.= "}";
            $g.= $selector . $i . ' a{';
            $g.= 'color:' . raindrops_colors_clone( $i, 'color' ) . ';';
            $g.= "}";
            $g.= $selector . '-' . $i . '{';
            $g.= 'color:' . raindrops_colors_clone( $i, 'color' ) . ';';
            $g.= 'background: -webkit-gradient( linear, left top, left bottom, from( ' . $custom_dark_bg2 . ' ), to( ' . $custom_light_bg2 . ' ) );';
            $g.= 'background: -moz-linear-gradient( top,  ' . $custom_dark_bg2 . ',  ' . $custom_light_bg2 . ' );';
            $g.= 'background-image: -ms-linear-gradient( top,  ' . $custom_dark_bg2 . ',  ' . $custom_light_bg2 . ' );';			
            $g.= 'filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'' . $custom_dark_bg2 . '\', endColorstr=\'' . $custom_light_bg2 . '\' );';
            $g.= "}";
            $g.= $selector . '-' . $i . ' a{';
            $g.= 'color:' . raindrops_colors_clone( $i, 'color' ) . ';';
            $g.= "}";
			/* nav menu gradient class support @since 1.272 */
			$g.= '#access '. $selector . $i . ' a{';
            $g.= 'color:' . raindrops_colors_clone( $i, 'color' ) . ';';
            $g.= 'background: -webkit-gradient( linear, left top, left bottom, from( ' . $custom_dark_bg1 . ' ), to( ' . $custom_light_bg1 . ' ) );';
            $g.= 'background: -moz-linear-gradient( top,  ' . $custom_dark_bg1 . ',  ' . $custom_light_bg1 . ' );';
            $g.= 'filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'' . $custom_dark_bg1 . '\', endColorstr=\'' . $custom_light_bg1 . '\' );';
			$g.= 'background-image: -ms-linear-gradient( top,  ' . $custom_dark_bg1 . ',  ' . $custom_light_bg1 . ' );';	
            $g.= "}";
			$g.= '#access '. $selector . '-' . $i . ' a{';
            $g.= 'color:' . raindrops_colors_clone( $i, 'color' ) . ';';
            $g.= 'background: -webkit-gradient( linear, left top, left bottom, from( ' . $custom_dark_bg1 . ' ), to( ' . $custom_light_bg1 . ' ) );';
            $g.= 'background: -moz-linear-gradient( top,  ' . $custom_dark_bg1 . ',  ' . $custom_light_bg1 . ' );';
            $g.= 'filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'' . $custom_dark_bg1 . '\', endColorstr=\'' . $custom_light_bg1 . '\' );';
			$g.= 'background-image: -ms-linear-gradient( top,  ' . $custom_dark_bg1 . ',  ' . $custom_light_bg1 . ' );';	
            $g.= "}";
            $g.= $selector . $i . ' a{';
            $g.= 'color:' . raindrops_colors_clone( $i, 'color' ) . ';';
            $g.= "}";
            $g.= '#access '. $selector . '-' . $i . ' a{';
            $g.= 'color:' . raindrops_colors_clone( $i, 'color' ) . ';';
            $g.= 'background: -webkit-gradient( linear, left top, left bottom, from( ' . $custom_dark_bg2 . ' ), to( ' . $custom_light_bg2 . ' ) );';
            $g.= 'background: -moz-linear-gradient( top,  ' . $custom_dark_bg2 . ',  ' . $custom_light_bg2 . ' );';
			$g.= 'background-image: -ms-linear-gradient( top,  ' . $custom_dark_bg2 . ',  ' . $custom_light_bg2 . ' );';		
            $g.= 'filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'' . $custom_dark_bg2 . '\', endColorstr=\'' . $custom_light_bg2 . '\' );';
            $g.= "}";
            $g.= $selector . '-' . $i . ' a{';
            $g.= 'color:' . raindrops_colors_clone( $i, 'color' ) . ';';
            $g.= "}";
        }
		$g = wp_strip_all_tags( $g );
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
if ( ! function_exists( 'raindrops_colors_clone' ) ) {
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
}
if ( ! function_exists( 'raindrops_switch_default_by_color_type_clone' ) ) {
	function raindrops_switch_default_by_color_type_clone( $name = 'dark', $option_name = false, $default_val = '', $conditional_val = '' ) {
		
		switch ( $name ) {

			case ( "minimal" ):
				if( !empty( $option_name )  && 'bad' !== raindrops_warehouse_clone( $option_name ) ) {

					/**
					 * Pending @1.430
					 * return $conditional_val;
					 */
				}


			break;
		}	
		return $default_val;
	}
}
/**
 * Declaration Calculator
 *
 *
 *
 *
 */
if ( ! function_exists( 'raindrops_default_colors_clone' ) ) {
	function raindrops_default_colors_clone( $name = 'dark', $option_name = false, $default = false ) {

		$raindrops_images_path		 = get_stylesheet_directory_uri() . '/images/';
		// Sidebar Image
		$navigation_title_img		 = raindrops_warehouse_clone( 'raindrops_heading_image' );
		$navigation_title_img_uri	 = esc_url( $raindrops_images_path . $navigation_title_img );

		switch ( $name ) {

			case ( "w3standard" ):
				$custom_dark_bg					 = apply_filters( 'raindrops_w3_default_bg_dark', raindrops_colors_clone( '3', 'background' ) );
				$custom_light_bg				 = apply_filters( 'raindrops_w3_default_bg_light', raindrops_colors_clone( '1', 'background' ) );
				$custom_color					 = apply_filters( 'raindrops_w3_default_color', raindrops_colors_clone( '3', 'color' ) );
				$custom_link_color				 = apply_filters( 'raindrops_w3_default_link_color', '#0000EE' );
				$custom_footer_link_color		 = apply_filters( 'raindrops_w3_default_footer_link_color', '#0000EE' );		
				$raindrops_footer_color_default	 = apply_filters( 'raindrops_w3_default_footer_color', '#000' );
				$raindrops_header_color_default	 = apply_filters( 'raindrops_w3_default_header_color', '#000' );
				break;
			case ( "dark" ):
				/**
				 * dark
				 */
				$custom_dark_bg					 = apply_filters( 'raindrops_dark_default_bg_dark', raindrops_colors_clone( '-1', 'background' ) );
				$custom_light_bg				 = apply_filters( 'raindrops_dark_default_bg_light', raindrops_colors_clone( '-4', 'background' ) );
				$custom_color					 = apply_filters( 'raindrops_dark_default_color', raindrops_colors_clone( '-3', 'color' ) );
				$custom_link_color				 = apply_filters( 'raindrops_dark_default_link_color', raindrops_colors_clone( '-3', 'color' ) );
				$custom_footer_link_color		 = apply_filters( 'raindrops_dark_default_footer_link_color', raindrops_colors_clone( '-3', 'color' ) );
				$raindrops_footer_color_default	 = apply_filters( 'raindrops_dark_default_footer_color', '#ccc' );
				$raindrops_header_color_default	 = apply_filters( 'raindrops_dark_default_header_color', '#fff' );
				break;
			case ( "light" ):
				/**
				 * light
				 */
				$custom_dark_bg					 = apply_filters( 'raindrops_light_default_bg_dark', raindrops_colors_clone( '5', 'background' ) );
				$custom_light_bg				 = apply_filters( 'raindrops_light_default_bg_light', raindrops_colors_clone( '3', 'background' ) );
				$custom_color					 = apply_filters( 'raindrops_light_default_color', raindrops_colors_clone( '3', 'color' ) );
				$custom_link_color				 = apply_filters( 'raindrops_light_default_link_color', raindrops_colors_clone( '3', 'color' ) );
				$custom_footer_link_color		 = apply_filters( 'raindrops_light_default_footer_link_color', raindrops_colors_clone( '3', 'color' ) );
				$raindrops_footer_color_default	 = apply_filters( 'raindrops_light_default_footer_color', '#333' );
				$raindrops_header_color_default	 = apply_filters( 'raindrops_light_default_header_color', '#333' );
				break;
			case ( "minimal" ):
				/**
				 * minimal
				 */
				$custom_dark_bg					 = apply_filters( 'raindrops_light_default_bg_dark', raindrops_colors_clone( '5', 'background' ) );
				$custom_light_bg				 = apply_filters( 'raindrops_light_default_bg_light', raindrops_colors_clone( '3', 'background' ) );
				$custom_color					 = apply_filters( 'raindrops_light_default_color', raindrops_colors_clone( '3', 'color' ) );
				$custom_link_color				 = apply_filters( 'raindrops_light_default_link_color', raindrops_colors_clone( '3', 'color' ) );
				$custom_footer_link_color		 = apply_filters( 'raindrops_light_default_footer_link_color', raindrops_colors_clone( '3', 'color' ) );
				$raindrops_footer_color_default	 = apply_filters( 'raindrops_light_default_footer_color', '#333' );
				$raindrops_header_color_default	 = apply_filters( 'raindrops_light_default_header_color', '#333' );
				break;
			default:
				$custom_dark_bg					 = apply_filters( 'raindrops_color_type_default_bg_dark', raindrops_colors_clone( '5', 'background' ) );
				$custom_light_bg				 = apply_filters( 'raindrops_color_type_default_bg_light', raindrops_colors_clone( '3', 'background' ) );
				$custom_color					 = apply_filters( 'raindrops_color_type_default_color', raindrops_colors_clone( '3', 'color' ) );
				$custom_link_color				 = apply_filters( 'raindrops_color_type_default_link_color', raindrops_colors_clone( '3', 'color' ) );
				$custom_footer_link_color		 = apply_filters( 'raindrops_color_type_default_footer_link_color', raindrops_colors_clone( '3', 'color' ) );
				$raindrops_footer_color_default	 = apply_filters( 'raindrops_color_type_default_footer_color', '#333' );
				$raindrops_header_color_default	 = apply_filters( 'raindrops_color_type_default_header_color', '#333' );
				break;
		}
		
		if ( !empty( $option_name ) ) {

			if ( 'raindrops_background_color' == $option_name || 'custom_dark_bg' == $option_name ) {
				return $custom_dark_bg;
			}
			if ( 'custom_light_bg' == $option_name ) {
				return $custom_light_bg;
			}
			if ( 'raindrops_hyperlink_color' == $option_name ) {

				return $custom_link_color;
			}
			
			if ( 'raindrops_footer_link_color' == $option_name ) {
				return $custom_footer_link_color;
			}

			if ( 'raindrops_header_color' == $option_name ) {

				$raindrops_header_color = raindrops_warehouse_clone( 'raindrops_default_fonts_color' );
				
				if ( false == $default && isset( $raindrops_header_color ) && !empty( $raindrops_header_color ) ) {
					return $raindrops_header_color;
				} else {
					return $raindrops_header_color_default;
				}
			}
		
			if ( 'raindrops_footer_color' == $option_name ) {

				$raindrops_footer_color = raindrops_warehouse_clone( 'raindrops_footer_color' );

				if ( false == $default && isset( $raindrops_footer_color ) && !empty( $raindrops_footer_color ) ) {

					return $raindrops_footer_color;
					
				} else {
					
					return $raindrops_footer_color_default;
				}
			}
			
			if ( 'raindrops_default_fonts_color' == $option_name || 'custom_color' == $option_name || 'default-text-color' == $option_name ) {
				return $custom_color;
			}		

			if ( 'raindrops_header_image_filter_color' == $option_name ) {
				return $custom_light_bg;
			}

			if ( 'h2_w3standard_background' == $option_name ) {

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

}

if ( ! function_exists( 'raindrops_design_output_clone' ) ) {
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

					if ( isset( ${$reg[1]} ) ) {
						
						$content = str_replace( $reg[0], ${$reg[1]}, $content );			
					} else {
						$content = str_replace( $reg[0], '/*cannot bind data [%' . $reg[1] . '%]*/', $content );
					}
				}
			}
			return apply_filters( "raindrops_colors", $content );
		}
	}
}
if ( ! function_exists( 'raindrops_default_color_clone' ) ) {
	
	function raindrops_default_color_clone( $option_name = '' , $style_type = '') {
		
		if ( empty( $style_type ) ) {
			$style_type = raindrops_warehouse_clone( 'raindrops_style_type' );
	    }
		return raindrops_default_colors_clone( $style_type, $option_name );
			
	
	}
}

/**
 * Base Color Class Create
 *
 *
 * $selecter = array( 'face'=> 'font color class name','color' => 'font and background class name');
 *
 */
if ( ! function_exists( 'raindrops_color_base_clone' ) ) {
	function raindrops_color_base_clone( $color1 = null, $selector = null ) {
		global $raindrops_images_path;
		if ( null == $color1 ) {
			$color1 = str_replace( '#', "", raindrops_warehouse_clone( 'raindrops_base_color' ) );
		} else {
			$color1 = str_replace( '#', "", $color1 );
		}

		$class = '.color';
		$face  = '.face';

		if ( !empty( $selector ) && array_key_exists( 'color', $selector ) && array_key_exists( 'face', $selector ) ) {

			$face  = strip_tags( $selector['face'] );
			$class = strip_tags( $selector['color'] );
		}


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
	{$class}-1 a,
	{$class}-1{
	  background:#{$bg_1};
	  color:#{$fg_1};
	}
	{$class}-2 a,
	{$class}-2 {
	  background:#{$bg_2};
	  color:#{$fg_2};
	}
	{$class}-3 a,
	{$class}-3 {
	  background:#{$bg_3};
	  color:#{$fg_3};
	}
	{$class}-4 a,
	{$class}-4 {
	  /** Use the base {$class}, two shades darker */
	  background:#{$bg_4};
	  /** Use the corresponding foreground {$class} */
	  color:#{$fg_4};
	}
	{$class}-5 a,
	{$class}-5 {
	  background:#{$bg_5};
	  color:#{$fg_5};
	}
	{$class}1 a,
	{$class}1{
	  background:#{$bg1};
	  color:#{$fg1};
	}
	{$class}2 a,
	{$class}2 {
	  background:#{$bg2};
	  color:#{$fg2};
	}
	{$class}3 a,
	{$class}3 {
	  background:#{$bg3};
	  color:#{$fg3};
	}
	{$class}4 a,
	{$class}4 {
	  /** Use the base color, two shades darker */
	  background:#{$bg4};
	  /** Use the corresponding foreground color */
	  color:#{$fg4};
	}
	{$class}5 a,
	{$class}5 {
	  background:#{$bg5};
	  color:#{$fg5};
	}
	{$face}-1{
	  color:#{$fg_1};
	}
	{$face}-2 {
	  color:#{$fg_2};
	}
	{$face}-3 {
	  color:#{$fg_3};
	}
	{$face}-4 {
	  color:#{$fg_4};
	}
	{$face}-5 {
	  color:#{$fg_5};
	}
	{$face}1{
	  color:#{$fg1};
	}
	{$face}2 {
	  color:#{$fg2};
	}
	{$face}3 {
	  color:#{$fg3};
	}
	{$face}4 {
	  color:#{$fg4};
	}
	{$face}5 {
	  color:#{$fg5};
	}
CSS;

		return wp_strip_all_tags( $result );
	}
}
/**
 * register style name
 *
 *
 *
 *
 */
if ( ! function_exists( 'raindrops_register_styles_clone' ) ) {
	function raindrops_register_styles_clone( $style_name ) {
		static $vals;
		$vals[$style_name] = $style_name;
		return $vals;
	}
}

/**
 * 
 * @return string
 * 
 * 
 */
function raindrops_get_image_sizes( $size = '' ) {

        global $_wp_additional_image_sizes;

        $sizes = array();
        $get_intermediate_image_sizes = get_intermediate_image_sizes();

        // Create the full array with sizes and crop info
        foreach( $get_intermediate_image_sizes as $_size ) {

                if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {

                        $sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
                        $sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
                        $sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );

                } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {

                        $sizes[ $_size ] = array( 
                                'width' => $_wp_additional_image_sizes[ $_size ]['width'],
                                'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                                'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
                        );

                }

        }

        // Get only 1 size if found
        if ( $size ) {

                if( isset( $sizes[ $size ] ) ) {
                        return $sizes[ $size ];
                } else {
                        return false;
                }

        }

        return $sizes;
}

if ( ! function_exists( 'raindrops_gallerys_clone' ) ) {
	function raindrops_gallerys_clone() {

		global $raindrops_extend_galleries, $post;

			$clear_float = ".gallery,
				.gallery-columns-1 .gallery-item:nth-child(2),
				.gallery-columns-2 .gallery-item:nth-child(3),
				.gallery-columns-3 .gallery-item:nth-child(4),
				.gallery-columns-4 .gallery-item:nth-child(5),
				.gallery-columns-5 .gallery-item:nth-child(6),
				.gallery-columns-6 .gallery-item:nth-child(7),
				.gallery-columns-7 .gallery-item:nth-child(8),
				.gallery-columns-8 .gallery-item:nth-child(9),
				.gallery-columns-9 .gallery-item:nth-child(10),
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
	
		$all_sizes = raindrops_get_image_sizes();
		$raindrops_gallerys = '.entry-content .gallery{margin:1em auto;}';
		foreach( $all_sizes as $name => $value ) {
				$width = absint( $value['width'] );
				
					$width2	 = round( $width * 2 );
					$width3	 = round( $width * 3 );
					$width4	 = round( $width * 4 );
					$width5	 = round( $width * 5 );
					$width6	 = round( $width * 6 );
					$width7	 = round( $width * 7 );
					$width8	 = round( $width * 8 );
					$width9	 = round( $width * 9 );
					$width10 = round( $width * 10 );
			
				
				$raindrops_gallerys .= '.gallery-columns-1.gallery-size-'. $name. '{ width: '. $width. 'px ; max-width:100%; }
				.gallery-columns-2.gallery-size-'. $name. ' { width:'. $width2. 'px ; max-width:100%; }
				.gallery-columns-3.gallery-size-'. $name. ' { width: '. $width3. 'px ; max-width:100%; }
				.gallery-columns-4.gallery-size-'. $name. ' { width: '. $width4. 'px ; max-width:100%; }
				.gallery-columns-5.gallery-size-'. $name. ' { width: '. $width5. 'px ; max-width:100%; }
				.gallery-columns-6.gallery-size-'. $name. ' { width: '. $width6. 'px ; max-width:100%; }
				.gallery-columns-7.gallery-size-'. $name. ' { width: '. $width7. 'px ; max-width:100%; }
				.gallery-columns-8.gallery-size-'. $name. ' { width: '. $width8. 'px ; max-width:100%; }
				.gallery-columns-9.gallery-size-'. $name. ' { width: '. $width9. 'px ; max-width:100%; }
				.gallery-columns-10.gallery-size-'. $name. ' { width: '. $width10. 'px ; max-width:100%; }';			
		}		
		
		$raindrops_gallerys .= "
				.gallery .gallery-item { margin: 0px; }
				.gallery .gallery-item {". $display_property. " margin-top: .5em; text-align: center; }
				.gallery img { max-width:100%; }
				.gallery .gallery-caption { margin-left: 0; }
				.gallery br { clear: both }
				.gallery-columns-1 .gallery-item{ width: 100% }
				.gallery-columns-2 .gallery-item{ width: 50% }
				.gallery-columns-3 .gallery-item{ width: 33.3% }
				.gallery-columns-4 .gallery-item{ width: 25% }
				.gallery-columns-5 .gallery-item{ width: 20% }
				.gallery-columns-6 .gallery-item{ width: 16.6% }
				.gallery-columns-7 .gallery-item{ width: 14.28% }
				.gallery-columns-8 .gallery-item{ width: 12.5% }
				.gallery-columns-9 .gallery-item{ width: 11.1% }
				.gallery-columns-10 .gallery-item{ width: 9.9% }";
		
		
		
		
		$raindrops_gallerys .= $clear_float;

		/* caption text presentation */
		$raindrops_gallerys .= ".gallery:after{content:'';clear:both;display:block;}.gallery-item{position:relative;}
				.gallery figcaption{
				box-sizing:border-box;
				position:absolute;
				min-height:66%;
				left:3px;
				width:100%;
				min-width:199px;
				height:auto;
				bottom:30%;
				padding:1em;
				text-align:left;
				margin:auto;
				background:#000;
				color:#fff;
				opacity:0;
				transition:opacity .7s;
				/*border-radius: 10% 0 10% 0; 
				-moz-border-radius:10% 0 10% 0; 
				-webkit-border-radius: 10% 0 10% 0; */
				border: 1px solid rgba(222,222,222,.5);
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
}
/**
 * 
 * @since 1.243
 * @param type $hex color value
 * @return array rgb value
 */
if ( ! function_exists( 'raindrops_hex2rgb_array_clone' ) ) {
	
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
  }
 if ( !function_exists( 'raindrops_detect_header_image_size_clone' ) ) {

	function raindrops_detect_header_image_size_clone( $xy = 'width' ) {

		global $raindrops_custom_header_args, $raindrops_header_image_default_ratio;

		$all_header_images		 = array();
		$header_image			 = get_custom_header();
		$header_image_uri		 = $header_image->url;
		$header_image_basename	 = basename( $header_image_uri );
		$page_width				 = raindrops_warehouse_clone( 'raindrops_page_width' );
		$all_header_images		 = get_uploaded_header_images();
		
		if ( 'width' == $xy ) {
			if ( ! empty( $header_image->width ) ) {

				return absint( $header_image->width );
			}
		} elseif ( 'height' == $xy ) {
			if ( ! empty( $header_image->height ) ) {

				return absint( $header_image->height );
			}
		}

		if ( 'width' == $xy ) {

			if ( isset( $all_header_images[ $header_image_basename ][ 'width' ] ) ) {
				if ( false !== $all_header_images[ $header_image_basename ][ 'width' ] ) {
					return $all_header_images[ $header_image_basename ][ 'width' ];
				}
			} else {
				if ( false !== $header_image->width ) {
					return $header_image->width;
				}
			}
		} elseif ( 'height' == $xy ) {

			if ( isset( $all_header_images[ $header_image_basename ][ 'height' ] ) ) {
				if ( false !== $all_header_images[ $header_image_basename ][ 'height' ] ) {
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
				$custom_header_width	 = 750;
				$custom_header_height	 = round( $custom_header_width * $raindrops_header_image_default_ratio );
				break;

			case ( "doc2" ):
				$custom_header_width	 = 950;
				$custom_header_height	 = round( $custom_header_width * $raindrops_header_image_default_ratio );
				break;

			case ( "doc3" ):

				$custom_header_width	 = raindrops_warehouse_clone( 'raindrops_fluid_max_width' );
				$custom_header_height	 = round( $custom_header_width * $raindrops_header_image_default_ratio );
				break;

			case ( "doc4" ):

				$custom_header_width	 = 974;
				$custom_header_height	 = round( $custom_header_width * $raindrops_header_image_default_ratio );
				break;
			case ( "doc5" ):

				$custom_header_width	 = raindrops_warehouse_clone( 'raindrops_full_width_limit_window_width' );
				$custom_header_height	 = round( $custom_header_width * $raindrops_header_image_default_ratio );
				
				
				break;
		}

		if ( $xy == 'width' ) {
			return $custom_header_width;
		}
		if ( $xy == 'height' ) {
			return $custom_header_height;
		}
		return false;
	}

}

if ( ! function_exists( 'raindrops_complementary_color_clone') ) {
	
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
}

if( ! function_exists( 'raindrops_minified_file_suffix_validate') ) {
	
	function raindrops_minified_file_suffix_validate( $suffix ) {
		
		if( empty( $suffix ) ) {
			return '';
		}

		if( preg_match("/^[a-zA-Z0-9-]+$/", $suffix ) ) {
			return $suffix;
		}
		return false;
	}
	
}


if ( !function_exists( 'raindrops_locate_url' ) ) {

	function raindrops_locate_url( $filename, $type = 'url' ) {


		global $raindrops_minified_suffix, $raindrops_load_minified_css_js, $raindrops_minified_files_js_dir, $raindrops_minified_files_css_dir;
		
		$minified_flag						 = true;
		$raindrops_minified_suffix			 = raindrops_minified_file_suffix_validate( $raindrops_minified_suffix );
		$raindrops_minified_files_js_dir	 = raindrops_minified_file_suffix_validate( $raindrops_minified_files_js_dir );
		$raindrops_minified_files_css_dir	 = raindrops_minified_file_suffix_validate( $raindrops_minified_files_css_dir );

		if( false === $raindrops_minified_suffix || false === $raindrops_minified_files_js_dir || 
			false === $raindrops_minified_files_css_dir ||  false === $raindrops_load_minified_css_js ) {
			
			$minified_flag = false;
		}
		
		$filetype		 = wp_check_filetype( $filename );
		$template_uri	 = trailingslashit( get_template_directory_uri() );
		$template_path	 = trailingslashit( get_template_directory() );

		if ( !empty( $raindrops_minified_files_js_dir ) && 'js' == $filetype[ 'ext' ] ) {
			
			$raindrops_minified_files_dir = trailingslashit( basename( $raindrops_minified_files_js_dir ) );
		} elseif ( !empty( $raindrops_minified_files_css_dir ) && 'css' == $filetype[ 'ext' ] ) {
			
			$raindrops_minified_files_dir = trailingslashit( basename( $raindrops_minified_files_css_dir ) );
		} else {
			$raindrops_minified_files_dir = '';
		}

		$file_name_extension = '.' . $filetype[ 'ext' ];

		if ( is_child_theme() ) {

			$stylesheet_uri	 = trailingslashit( get_stylesheet_directory_uri() );
			$stylesheet_path = trailingslashit( get_stylesheet_directory() );

			if ( true == $minified_flag && isset( $filetype[ 'ext' ] ) && ('css' == $filetype[ 'ext' ] || 'js' == $filetype[ 'ext' ] ) ) {

				$minified_name = str_replace( $file_name_extension, $raindrops_minified_suffix . $file_name_extension, $filename );

				if ( file_exists( $stylesheet_path . $raindrops_minified_files_dir . $minified_name ) ) {

					if ( $type == 'url' ) {
						return $stylesheet_uri . $raindrops_minified_files_dir . $minified_name;
					}
					if ( $type == 'path' ) {
						return $stylesheet_path . $raindrops_minified_files_dir . $minified_name;
					}
				}
			}

			if ( file_exists( $stylesheet_path . $filename ) ) {

				if ( $type == 'url' ) {
					return $stylesheet_uri . $filename;
				}
				if ( $type == 'path' ) {
					return $stylesheet_path . $filename;
				}
			}
		}

		if ( true == $minified_flag && isset( $filetype[ 'ext' ] ) && ('css' == $filetype[ 'ext' ] || 'js' == $filetype[ 'ext' ] ) ) {

			$minified_name = str_replace( $file_name_extension, $raindrops_minified_suffix . $file_name_extension, $filename );

			if ( file_exists( $template_path . $raindrops_minified_files_dir . $minified_name ) ) {

				if ( $type == 'url' ) {
					return $template_uri . $raindrops_minified_files_dir . $minified_name;
				}
				if ( $type == 'path' ) {
					return $template_path . $raindrops_minified_files_dir . $minified_name;
				}
			}
		}

		if ( !file_exists( $template_path . $filename ) ) {

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

}
if ( ! class_exists( 'RaindropsPostHelp') ) {	
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
				, 'title'		 => __( 'Raindrops Help', 'raindrops' )
				, 'content'	 => '<h1>' . __( 'About Base Color related Class', 'raindrops' ) . '</h1>'
				, 'callback'	 => array( $this, 'prepare' )
			) );
		}
	}

	public function add_tabs_theme() {

		foreach ( $this->tabs as $id => $data ) {

			get_current_screen()->add_help_tab( array(
				'id'		 => $id
				, 'title'		 => __( 'Raindrops Theme Help', 'raindrops' )
				, 'content'	 => '<h1>' . __( 'About Raindrops Theme', 'raindrops' ) . '</h1>'
				, 'callback'	 => array( $this, 'prepare_theme' )
			) );
		}
	}

	public function add_tabs_theme_editor() {

		foreach ( $this->tabs as $id => $data ) {

			get_current_screen()->add_help_tab( array(
				'id'		 => $id
				, 'title'		 => __( 'Raindrops Theme Help', 'raindrops' )
				, 'content'	 => '<h1>' . __( 'About Raindrops Theme', 'raindrops' ) . '</h1>'
				, 'callback'	 => array( $this, 'prepare_theme' )
			) );
		}
	}

	public function prepare( $screen, $tab ) {

		if ( RAINDROPS_USE_AUTO_COLOR !== false ) {

			echo raindrops_edit_help( '' );
		} else {

			printf( '<p class="disable-color-gradient">%1$s</p>', esc_html__( 'Now RAINDROPS_USE_AUTO_COLOR value false and Cannot show this help', 'raindrops' ) );
		}
	}

	public function prepare_theme( $screen, $tab ) {

		echo raindrops_settings_page_contextual_help();
	}

	public function prepare_theme_editor( $screen, $tab ) {

		echo raindrops_editor_page_contextual_help();
	}
}
}
/**
 * for customizer functions
 * @param type $args
 * @return type
 */
if ( ! function_exists( 'raindrops_theme_mod_default_normalize') ) {
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
}
if ( ! function_exists( 'raindrops_data_store_relate_id') ) {	
	
	function raindrops_data_store_relate_id( $id ) {

		if ( 'option' == raindrops_theme_mod( $id, 'data_type' ) ) {

			return THEME_OPTION_FIELD_NAME . '[' . $id . ']';
		}
		return $id;
	}
}
if ( ! function_exists( 'raindrops_theme_mod') ) {
	
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
}
if ( ! function_exists( 'raindrops_filter_page_column_control') ) {
	function raindrops_filter_page_column_control() {

		global $raindrops_current_column, $post, $template, $raindrops_keep_content_width;
		/**
		 * @since 1.448
		 */
		if ( ! is_active_sidebar( 1 ) && ! is_active_sidebar( 2 ) ) {
			$raindrops_current_column = 1;
			$raindrops_keep_content_width	 = raindrops_keep_content_width( $raindrops_current_column );
			   return;				
		   }
		if ( is_active_sidebar( 1 ) && ! is_active_sidebar( 2 ) ) {
			$raindrops_current_column = 2;
			$raindrops_keep_content_width	 = raindrops_keep_content_width( $raindrops_current_column );
			   return;				
		 }
		/**
		 * @1.401
		 */
		if ( is_child_theme() &&
			'simple' == raindrops_warehouse_clone( 'raindrops_col_setting_type' ) &&
			'hide' == raindrops_warehouse_clone( 'raindrops_show_right_sidebar' ) ) {
			$raindrops_current_column = 2;
			$raindrops_keep_content_width	 = raindrops_keep_content_width( $raindrops_current_column );
			return;						
		}
		

		if ( is_tax( 'post_format', 'post-format-link' ) ) {
			$raindrops_current_column = (int) raindrops_warehouse_clone( 'raindrops_sidebar_format_link_archive' );
			$raindrops_keep_content_width	 = raindrops_keep_content_width( $raindrops_current_column );
			return;
		}
		if ( is_tax( 'post_format', 'post-format-image' ) ) {
			$raindrops_current_column = (int) raindrops_warehouse_clone( 'raindrops_sidebar_format_image_archive' );
			$raindrops_keep_content_width	 = raindrops_keep_content_width( $raindrops_current_column );
			return;
		}
		if ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$raindrops_current_column = (int) raindrops_warehouse_clone( 'raindrops_sidebar_format_quote_archive' );
			$raindrops_keep_content_width	 = raindrops_keep_content_width( $raindrops_current_column );
			return;
		}
		if ( is_tax( 'post_format', 'post-format-status' ) ) {
			$raindrops_current_column = (int) raindrops_warehouse_clone( 'raindrops_sidebar_format_status_archive' );
			$raindrops_keep_content_width	 = raindrops_keep_content_width( $raindrops_current_column );
			return;
		}
		if ( is_tax( 'post_format', 'post-format-video' ) ) {
			$raindrops_current_column = (int) raindrops_warehouse_clone( 'raindrops_sidebar_format_video_archive' );
			$raindrops_keep_content_width	 = raindrops_keep_content_width( $raindrops_current_column );
			return;
		}
		if ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$raindrops_current_column = (int) raindrops_warehouse_clone( 'raindrops_sidebar_format_audio_archive' );
			$raindrops_keep_content_width	 = raindrops_keep_content_width( $raindrops_current_column );
			return;
		}

		if ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$raindrops_current_column = (int) raindrops_warehouse_clone( 'raindrops_sidebar_format_gallery_archive' );
			$raindrops_keep_content_width	 = raindrops_keep_content_width( $raindrops_current_column );
			return;
		}
		if ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$raindrops_current_column = (int) raindrops_warehouse_clone( 'raindrops_sidebar_format_chat_archive' );
			$raindrops_keep_content_width	 = raindrops_keep_content_width( $raindrops_current_column );
			return;
		}		
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$raindrops_current_column = (int) raindrops_warehouse_clone( 'raindrops_sidebar_format_aside_archive' );
			$raindrops_keep_content_width	 = raindrops_keep_content_width( $raindrops_current_column );
			return;
		}		
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
		if ( 'pdf' == $template ) {
			$raindrops_current_column = ( int ) raindrops_warehouse_clone( 'raindrops_sidebar_pdf_archive' );
			$raindrops_keep_content_width	 = raindrops_keep_content_width( $raindrops_current_column );
			return;
		}
		if (  is_home() == false && is_front_page() == true ) { // static front page
			$raindrops_current_column = (int) raindrops_warehouse_clone( 'raindrops_sidebar_index' );
			$raindrops_keep_content_width	 = raindrops_keep_content_width( $raindrops_current_column );
			return;
		}
		if (  is_home() == true && is_front_page() == false ) { // page_for_posts blog archive
			$raindrops_current_column = (int) raindrops_warehouse_clone( 'raindrops_sidebar_posts_page' );
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
			$raindrops_current_column = (int) raindrops_warehouse_clone( 'raindrops_sidebar_category' );
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
}
if ( ! function_exists( 'raindrops_keep_content_width') ) {
	
	function raindrops_keep_content_width( $column ) {
		global $raindrops_keep_content_width;
		
		$raindrops_content_width_setting = raindrops_warehouse_clone( 'raindrops_content_width_setting' );
		

		$page_width	= raindrops_warehouse_clone( 'raindrops_page_width' );
		
		if( 1 == (int) $column && 'doc5' == $page_width ) {
			/* @since 1.447 */
			if( !empty( $raindrops_content_width_setting ) && 'keep' == $raindrops_content_width_setting ) {
				return true;
			}elseif( 'fit' == $raindrops_content_width_setting ) {
				return false;
			}
			if( is_child_theme() ) {
				/* todo @1.420 */
				return apply_filters('raindrops_keep_content_width', true );
			}

			return apply_filters('raindrops_keep_content_width', false );
		} else {
			/* @since 1.447 */
			if( !empty( $raindrops_content_width_setting ) && 'keep' == $raindrops_content_width_setting ) {
				
				return true;
			}elseif( 'fit' == $raindrops_content_width_setting ) {
				
				return false;
			}

			if( isset( $raindrops_keep_content_width ) ) {

				return apply_filters('raindrops_keep_content_width', $raindrops_keep_content_width );
			}
			return apply_filters( 'raindrops_keep_content_width', true );
		}
	}
}
if ( ! function_exists( 'raindrops_merge_config_customizer_to_theme') ) {
	function raindrops_merge_config_customizer_to_theme( $customizer_args, $theme_args ) {

		foreach( $customizer_args as $key => $val ) {

			$theme_args[] = array('option_name'=>$key, 'title' => $val['label'],'validate' => $val['sanitize_callback'],'excerpt2' =>$val['description'] , 'option_value' => $val['default'] );
		}
		return $theme_args;
	}
}	
if ( ! function_exists( 'raindrops_link_unique_text') ) {
/**
 * 
 * @global type $raindrops_link_unique_text
 * @return boolean
 * @1.303
 */	
	function raindrops_link_unique_text(){
		global $raindrops_link_unique_text;

		if ( !isset( $raindrops_link_unique_text ) ) {

			if ( 'yes' == raindrops_warehouse_clone( 'raindrops_accessibility_settings' ) ) {

				$raindrops_link_unique_text = true;
			} else {

				$raindrops_link_unique_text = false;
			}
		}

		return $raindrops_link_unique_text;
	}
}

if ( ! function_exists( 'raindrops_enable_keyboard') ) {
/**
 *
 * Add enable keyboard focus
 *
 * uses true no use false
 * @since 1.229
 */

	function raindrops_enable_keyboard() {

		global $raindrops_enable_keyboard;
		
		if ( isset( $raindrops_enable_keyboard ) && 'enable' == $raindrops_enable_keyboard ) {
			
			return 'enable';
		} else {
			
			$raindrops_enable_keyboard = 'disable';
			
			/* when wp_nav_menu using fallback_cb keyboard accessibility desable why menu structure issue */
			$raindrops_nav_menu_nothing_check = wp_get_nav_menus();
			
			if( empty( $raindrops_nav_menu_nothing_check ) ) {

				$raindrops_enable_keyboard = 'disable';
			}

			if( raindrops_warehouse_clone( 'raindrops_disable_keyboard_focus' ) == 'enable' ) {

				$raindrops_enable_keyboard = 'enable';

			} 			
		}
		
		return $raindrops_enable_keyboard;
	}
}
if ( ! function_exists( 'raindrops_responsive_width_ajust') ) {

	function raindrops_responsive_width_ajust( $width ) {
		$page_type_check = raindrops_warehouse_clone( 'raindrops_page_width' );

		if( $page_type_check == 'doc3' ) {

			$width = absint( raindrops_detect_header_image_size_clone(  'width' ) );
			$max_width = raindrops_warehouse_clone( 'raindrops_fluid_max_width' );

			if ( $width <  $max_width  ) {

				return $width;
			}

			return raindrops_warehouse_clone( 'raindrops_fluid_max_width' );
		}
		if( $page_type_check == 'doc5' ) {

			$width = absint( raindrops_detect_header_image_size_clone(  'width' ) );
			$raindrops_full_width_limit_window_width	= raindrops_warehouse_clone( 'raindrops_full_width_limit_window_width' );
			$raindrops_full_width_max_width				= raindrops_warehouse_clone( 'raindrops_full_width_max_width' );

			if ( $width <  $raindrops_full_width_max_width  ) {

				return $width;
			}

			return raindrops_warehouse_clone( 'raindrops_fluid_max_width' );
		}
		return $width;
	}
}
if ( ! function_exists( 'raindrops_responsive_height_ajust') ) {

	function raindrops_responsive_height_ajust( $height ) {

		$page_type_check = raindrops_warehouse_clone( 'raindrops_page_width' );

		if( $page_type_check == 'doc3' ) {
			$max_width = raindrops_warehouse_clone( 'raindrops_fluid_max_width' );
			$width = absint( raindrops_detect_header_image_size_clone(  'width' ) );

			if( $width < $max_width ) {
				$orrection_amount = $width / $max_width;

				return round( $height * $orrection_amount );
			}
			if( $width > $max_width ) {
				$orrection_amount = $max_width / $width;

				return round( $height * $orrection_amount );
			}
			return $height;

		}
		if( $page_type_check == 'doc5' ) {
			$raindrops_full_width_limit_window_width	= raindrops_warehouse_clone( 'raindrops_full_width_limit_window_width' );
			$max_width				= raindrops_warehouse_clone( 'raindrops_full_width_max_width' );
			$width = absint( raindrops_detect_header_image_size_clone(  'width' ) );

			if( $width < $max_width ) {
				$orrection_amount = $width / $max_width;

				return round( $height * $orrection_amount );
			}
			if( $width > $max_width ) {
				$orrection_amount = $max_width / $width;

				return round( $height * $orrection_amount );
			}
			return $height;

		}
		return $height;
	}
}
if ( ! function_exists( 'raindrops_wp_admin_css_colors') ) {
	
	function raindrops_wp_admin_css_colors( $property = 'name' ) {
		$current_admin_color = get_user_option( 'admin_color' );
		$standard_color		 = array(
			'light'		 => array( 'label'	 => _x( 'Light', 'admin color scheme', 'raindrops' ),
				'colors' => array( '#e5e5e5', '#999', '#d64e07', '#04a4cc' ),
				//'name'	 => array( 'base' => '#999', 'focus' => '#ccc', 'current' => '#ccc' )
				'name'	 => array( 'base' => '#333', 'focus' => '#000', 'current' => '#555' )
			),
			'blue'		 => array( 'label'	 => _x( 'Blue', 'admin color scheme', 'raindrops' ),
				'colors' => array( '#096484', '#4796b3', '#52accc', '#74B6CE' ),
				'name'	 => array( 'base' => '#e5f8ff', 'focus' => '#fff', 'current' => '#fff' )
			),
			'midnight'	 => array( 'label'	 => _x( 'Midnight', 'admin color scheme', 'raindrops' ),
				'colors' => array( '#25282b', '#363b3f', '#69a8bb', '#e14d43' ),
				'name'	 => array( 'base' => '#f1f2f3', 'focus' => '#fff', 'current' => '#fff' )
			),
			'sunrise'	 => array( 'label'	 => _x( 'Sunrise', 'admin color scheme', 'raindrops' ),
				'colors' => array( '#b43c38', '#cf4944', '#dd823b', '#ccaf0b' ),
				'name'	 => array( 'base' => '#f3f1f1', 'focus' => '#fff', 'current' => '#fff' )
			),
			'ectoplasm'	 => array( 'label'	 => _x( 'Ectoplasm', 'admin color scheme', 'raindrops' ),
				'colors' => array( '#413256', '#523f6d', '#a3b745', '#d46f15' ),
				'name'	 => array( 'base' => '#ece6f6', 'focus' => '#fff', 'current' => '#fff' )
			),
			'ocean'		 => array( 'label'	 => _x( 'Ocean', 'admin color scheme', 'raindrops' ),
				'colors' => array( '#627c83', '#738e96', '#9ebaa0', '#aa9d88' ),
				'name'	 => array( 'base' => '#f2fcff', 'focus' => '#fff', 'current' => '#fff' )
			),
			'coffee'	 => array( 'label'	 => _x( 'Coffee', 'admin color scheme', 'raindrops' ),
				'colors' => array( '#46403c', '#59524c', '#c7a589', '#9ea476' ),
				'name'	 => array( 'base' => '#f3f2f1', 'focus' => '#fff', 'current' => '#fff' )
			),
			'bbp-evergreen'	 => array( 'label'	 => _x( 'Evergreen', 'admin color scheme', 'raindrops' ),
				'colors' => array( '#324d3a', '#446950', '#56b274', '#324d3a' ),
				'name'	 => array( 'base' => '#fff', 'focus' => '#fff', 'current' => '#fff' )
			),
			'bbp-mint'	 => array( 'label'	 => _x( 'Mint', 'admin color scheme', 'raindrops' ),
				'colors' => array( '#4f6d59', '#33834e', '#5FB37C', '#81c498' ),
				'name'	 => array( 'base' => '#fff', 'focus' => '#fff', 'current' => '#fff' )
			) );

		if ( isset( $standard_color[ $current_admin_color ][ $property ] ) ) {

			return $standard_color[ $current_admin_color ][ $property ];
		}

		return false;
	}

}
if ( !function_exists( 'raindrops_has_indivisual_notation' ) ) {
	
	function raindrops_has_indivisual_notation( $post_id = '' ) {
		global $post, $raindrops_automatic_color;

		if( empty( $post_id ) && isset( $post->ID ) ) {

			$post_id = $post->ID;
		}

		if ( ! empty( $post_id ) && is_singular() ) {

			$post_id = absint( $post_id );

			$raindrops_content_check = get_post( $post_id );
			$raindrops_content_check = $raindrops_content_check->post_content;

			if( preg_match( "!\[raindrops.+(color_type|col)=(\"|')*?([^(\"|')]+)(\"|' ).+(color_type|col)=(\"|')*?([^(\"|')]+)(\"|' )[^\]]*\]!si", $raindrops_content_check, $regs ) ) {

				return array( trim( $regs[1] ) => trim( $regs[3] ), trim( $regs[5] ) => trim( $regs[7] ) );
			}
		}
		return false;
	}
}
if ( !function_exists( 'raindrops_remove_spaces_from_css' ) ) {
	/**
	 * 
	 * @param type $css
	 * @return type
	 * @since 1.416
	 */
	function raindrops_remove_spaces_from_css( $css = '' ) {
		// Test for CSS custom property
		if ( WP_DEBUG !== true ) {

			//$css = str_replace( array( "\n", "\r", "\t", '&quot;', '--', '\"' ), array( "", "", "", '"', '', '"' ), $css );
			$css = str_replace( array( "\n", "\r", "\t", '&quot;',  '\"' ), array( "", "", "", '"', '"' ), $css );
		} else {

			//$css = str_replace( array( '&quot;', '--', '\"' ), array( '"', '', '"' ), $css );
			$css = str_replace( array( '&quot;', '\"' ), array( '"', '"' ), $css );
		}

		return $css;
	}

}
?>