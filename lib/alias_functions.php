<?php
/**
* This functions has alias function
*
*
* @package WordPress
* @subpackage Raindrops
* @since Raindrops 0.931
*/
?>
<?php
    if (!function_exists('raindrops_content_width_clone')) {

/**
 * Caluculate Raindrops content width
 *
 *
 * @see raindrops_content_width()
 *
 */
        function raindrops_content_width_clone(){
        global $raindrops_page_width;
        $adjust                 = 16;
        $default                = 400;
        $document_width         = raindrops_warehouse_clone('raindrops_page_width');
        $sidebar_width          = 'yui-'.raindrops_warehouse_clone('raindrops_col_width');
        $extra_sidebar_width    = raindrops_warehouse_clone('raindrops_right_sidebar_width_percent');

        if(isset($raindrops_page_width) and !empty($raindrops_page_width)){
            $w = $raindrops_page_width;
            $adjust = 16;
            if($sidebar_width == 'yui-t1'){
                $raindrops_content_width = $w - 160 - $adjust;
            }elseif($sidebar_width == 'yui-t2'){
                $raindrops_content_width = $w - 180 - $adjust;
            }elseif($sidebar_width == 'yui-t3'){
                $raindrops_content_width = $w - 300 - $adjust;
            }elseif($sidebar_width == 'yui-t4'){
                $raindrops_content_width = $w - 180 - $adjust;
            }elseif($sidebar_width == 'yui-t5'){
                $raindrops_content_width = $w - 240 - $adjust;
            }elseif($sidebar_width == 'yui-t6'){
                $raindrops_content_width = $w - 300 - $adjust;
            }else{
                $raindrops_content_width = $default;
            }
        }else{
            if($document_width == 'doc'){
                $w = 750;
                $adjust = 16;
                if($sidebar_width == 'yui-t1'){
                    $raindrops_content_width = $w - 160 - $adjust;
                }elseif($sidebar_width == 'yui-t2'){
                    $raindrops_content_width = $w - 180 - $adjust;
                }elseif($sidebar_width == 'yui-t3'){
                    $raindrops_content_width = $w - 300 - $adjust;
                }elseif($sidebar_width == 'yui-t4'){
                    $raindrops_content_width = $w - 180 - $adjust;
                }elseif($sidebar_width == 'yui-t5'){
                    $raindrops_content_width = $w - 240 - $adjust;
                }elseif($sidebar_width == 'yui-t6'){
                    $raindrops_content_width = $w - 300 - $adjust;
                }else{
                    $raindrops_content_width = $default;
                }
            }elseif($document_width == 'doc2'){
                $w = 950;
                    $adjust = 16;
                if($sidebar_width == 'yui-t1'){
                    $raindrops_content_width = $w - 160 - $adjust;
                }elseif($sidebar_width == 'yui-t2'){
                    $raindrops_content_width = $w - 180 - $adjust;
                }elseif($sidebar_width == 'yui-t3'){
                    $raindrops_content_width = $w - 300 - $adjust;
                }elseif($sidebar_width == 'yui-t4'){
                    $raindrops_content_width = $w - 180 - $adjust;
                }elseif($sidebar_width == 'yui-t5'){
                    $raindrops_content_width = $w - 240 - $adjust;
                }elseif($sidebar_width == 'yui-t6'){
                    $raindrops_content_width = $w - 300 - $adjust;
                }else{
                    $raindrops_content_width = $default;
                }
            }elseif($document_width == 'doc3'){
                $w = 750;
                if($sidebar_width == 'yui-t1'){
                    $raindrops_content_width = $w - 160 - $adjust;
                }elseif($sidebar_width == 'yui-t2'){
                    $raindrops_content_width = $w - 180 - $adjust;
                }elseif($sidebar_width == 'yui-t3'){
                    $raindrops_content_width = $w - 300 - $adjust;
                }elseif($sidebar_width == 'yui-t4'){
                    $raindrops_content_width = $w - 180 - $adjust;
                }elseif($sidebar_width == 'yui-t5'){
                    $raindrops_content_width = $w - 240 - $adjust;
                }elseif($sidebar_width == 'yui-t6'){
                    $raindrops_content_width = $w - 300 - $adjust;
                }else{
                    $raindrops_content_width = $default;
                }
            }elseif($document_width == 'doc4'){
                $w = 974;
                $adjust = 16;
                if($sidebar_width == 'yui-t1'){
                    $raindrops_content_width = $w - 160 - $adjust;
                }elseif($sidebar_width == 'yui-t2'){
                    $raindrops_content_width = $w - 180 - $adjust;
                }elseif($sidebar_width == 'yui-t3'){
                    $raindrops_content_width = $w - 300 - $adjust;
                }elseif($sidebar_width == 'yui-t4'){
                    $raindrops_content_width = $w - 180 - $adjust;
                }elseif($sidebar_width == 'yui-t5'){
                    $raindrops_content_width = $w - 240 - $adjust;
                }elseif($sidebar_width == 'yui-t6'){
                    $raindrops_content_width = $w - 300 - $adjust;
                }else{
                    $raindrops_content_width = $default;
                }
            }
        }

        if(raindrops_warehouse_clone('raindrops_show_right_sidebar') == 'hide'){
            return $raindrops_content_width;
        }else{

            if($extra_sidebar_width == '25'){
                return round($raindrops_content_width * 0.74);
            }elseif($extra_sidebar_width == '75'){
                return round($raindrops_content_width * 0.24);
            }elseif($extra_sidebar_width == '33'){
                return round($raindrops_content_width * 0.74);
            }elseif($extra_sidebar_width == '66'){
                return round($raindrops_content_width * 0.32);
            }elseif($extra_sidebar_width == '50'){
                return round($raindrops_content_width * 0.49);
            }else{
                return round($raindrops_content_width);
            }
        }
    return $raindrops_content_width;
    }
    }


    if (!function_exists('raindrops_warehouse_clone')) {

/**
 * return Raindrops settings
 *
 *
 * @see raindrops_warehouse()
 *
 */
    function raindrops_warehouse_clone($name){
        global $raindrops_base_setting;
        global $raindrops_page_width;
        $vertical = array();
        if(isset($raindrops_base_setting)){
            foreach($raindrops_base_setting as $key=>$val){
                if(!is_null($raindrops_base_setting)){
                    $vertical[] = $val['option_name'];
                }
            }


            $row = array_search($name,$vertical);
            if(isset($raindrops_page_width) and !empty($raindrops_page_width) and $name == 'raindrops_page_width'){
                return 'custom-doc';
            }

            $result = get_option('raindrops_theme_settings');

            if(isset($result[$name]) and !empty($result[$name])){
                return $result[$name];
            }elseif(isset($raindrops_base_setting[$row]['option_value'])
                    and !empty($raindrops_base_setting[$row]['option_value'])){
                return $raindrops_base_setting[$row]['option_value'];
            }else{
                return false;
            }
        }
    }
    }


    if (!function_exists('raindrops_gradient_single_clone')) {

/**
 * create gradient color and background style rule
 *
 *
 * @see raindrops_gradient_single()
 *
 */
    function raindrops_gradient_single_clone($i,$order = "asc"){
        $g = "";
        if($i>4){$i = 4;}
        if($order == "asc"){
            $custom_dark_bg1 = raindrops_colors($i,'background');
            $custom_light_bg1 = raindrops_colors($i+1,'background');
        }elseif($order == "desc"){
            $custom_dark_bg1 = raindrops_colors($i+1,'background');
            $custom_light_bg1 = raindrops_colors($i,'background');
        }
        $g .= 'background: -webkit-gradient(linear, left top, left bottom, from('.$custom_dark_bg1.'), to('.$custom_light_bg1.'));';
        $g .= 'background: -moz-linear-gradient(top,  '.$custom_dark_bg1.',  '.$custom_light_bg1.');';
        $g .= 'filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$custom_dark_bg1.'\', endColorstr=\''.$custom_light_bg1.'\');';

        return $g;
    }
    }

    if (!function_exists('raindrops_gradient_clone')) {
/**
 * create gradient set color and background style rule
 *
 *
 * @see raindrops_gradient()
 *
 */

    function raindrops_gradient_clone(){
        $g = "";
        for($i = 1;$i<5;$i++){
        $custom_dark_bg1 = raindrops_colors($i,'background');
        $custom_light_bg1 = raindrops_colors($i+1,'background');
        $custom_dark_bg2 = raindrops_colors($i,'background');
        $custom_light_bg2 = raindrops_colors($i-1,'background');
        $g .= '.gradient'.$i.'{';
        $g .= 'color:'.raindrops_colors($i,'color').';';
        $g .= 'background: -webkit-gradient(linear, left top, left bottom, from('.$custom_dark_bg1.'), to('.$custom_light_bg1.'));';
        $g .= 'background: -moz-linear-gradient(top,  '.$custom_dark_bg1.',  '.$custom_light_bg1.');';
        $g .= 'filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$custom_dark_bg1.'\', endColorstr=\''.$custom_light_bg1.'\');';
        $g .= "}\n";
        $g .= '.gradient'.$i.' a{';
        $g .= 'color:'.raindrops_colors($i+1,'color').';';
        $g .= "}\n";
        $g .= '.gradient-'.$i.'{';
        $g .= 'color:'.raindrops_colors($i,'color').';';
        $g .= 'background: -webkit-gradient(linear, left top, left bottom, from('.$custom_dark_bg2.'), to('.$custom_light_bg2.'));';
        $g .= 'background: -moz-linear-gradient(top,  '.$custom_dark_bg2.',  '.$custom_light_bg2.');';
        $g .= 'filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$custom_dark_bg2.'\', endColorstr=\''.$custom_light_bg2.'\');';
        $g .= "}\n";
        $g .= '.gradient'.$i.' a{';
        $g .= 'color:'.raindrops_colors($i-1,'color').';';
        $g .= "}\n";
        }
        return $g;
    }
    }

?>