<?php
/**
 * create individual stylesheet
 *
 *
 * @package WordPress
 * @subpackage Raindrops
 * @since Raindrops 0.1
 */

if(!defined('ABSPATH')){exit;}

require_once(get_stylesheet_directory()."/lib/csscolor/csscolor.php");

    $images_path            = get_stylesheet_directory_uri().'/images/';

    $count                  = warehouse('raindrops_base_color');
    $style_type             = warehouse('raindrops_style_type');
    $navigation_title_img   = warehouse('raindrops_heading_image');
    $position_y             = warehouse('raindrops_heading_image_position');
    $tmn_header_image       = warehouse('raindrops_header_image');
    $tmn_header_color       = warehouse('raindrops_default_fonts_color');
    $tmn_footer_image       = warehouse('raindrops_footer_image');
    $tmn_footer_color       = warehouse('raindrops_footer_color');

    define("BASE_COLOR1",$count);

    //define("BASE_COLOR2","#ff0000");

    /**
     * save stylesheet
     *
     */

    $raindrops_indv_css = design_output($style_type).color_base();

    if(get_option("_raindrops_indv_css","none") == "none"){
        add_option("_raindrops_indv_css",$raindrops_indv_css);
    }else{
        update_option("_raindrops_indv_css",$raindrops_indv_css);
    }

    $parm = fileperms(get_stylesheet_directory().'/lib/');
    $parm = decoct($parm);


function colors($num = 0, $select = 'set',$color1 = null){
    global $images_path;

    if($color1 == null){



        $color1 = str_replace('#',"",BASE_COLOR1);
    }else{
        $color1 = str_replace('#',"",$color1);

    }
        $base = new CSS_Color( $color1 );

    switch($num){

    case(0):
        $bg         = $base->bg['0'];
        $fg         = $base->fg['0'];
        $color  = "color:#$fg;background-color:#$bg;";
        break;
        case(-1):
        $bg         = $base->bg['-1'];
        $fg         = $base->fg['-1'];
        $color  = "color:#$fg;background-color:#$bg;";
        break;
        case(-2):
        $bg         = $base->bg['-2'];
        $fg         = $base->fg['-2'];
        $color  = "color:#$fg;background-color:#$bg;";
        break;
        case(-3):
        $bg         = $base->bg['-3'];
        $fg         = $base->fg['-3'];
        $color  = "color:#$fg;background-color:#$bg;";
        break;
        case(-4):
        $bg         = $base->bg['-4'];
        $fg         = $base->fg['-4'];
        $color  = "color:#$fg;background-color:#$bg;";
        break;
        case(-5):
        $bg         = $base->bg['-5'];
        $fg         = $base->fg['-5'];
        $color  = "color:#$fg;\n\tbackground-color:#$bg;";
        break;
        case(1):
        $bg         = $base->bg['+1'];
        $fg         = $base->fg['+1'];
        $color  = "color:#$fg;\n\tbackground-color:#$bg;";
        break;
        case(2):
        $bg         = $base->bg['+2'];
        $fg         = $base->fg['+2'];
        $color  = "color:#$fg;\n\tbackground-color:#$bg;";
        break;
        case(3):
        $bg         = $base->bg['+3'];
        $fg         = $base->fg['+3'];
        $color  = "color:#$fg;\n\tbackground-color:#$bg;";
        break;
        case(4):
        $bg         = $base->bg['+4'];
        $fg         = $base->fg['+4'];
        $color  = "color:#$fg;\n\tbackground-color:#$bg;";
        break;
        case(5):
        $bg         = $base->bg['+5'];
        $fg         = $base->fg['+5'];
        $color  = "color:#$fg;\n\tbackground-color:#$bg;";
        break;
        default:
        $bg         = $base->bg['0'];
        $fg         = $base->fg['0'];
        $color  = "color:#$fg;\n\tbackground-color:#$bg;";
        break;

    }
    switch($select){

        case('set'):

        return $color;
        break;
        case('background'):

        return '#'.$bg;
        break;
        case('color'):

        return '#'.$fg;
        break;

    }

}

function color_base($color1=null,$color2=null){
global $images_path;
if($color1 == null){
    $color1 = str_replace('#',"",BASE_COLOR1);
}else{
    $color1 = str_replace('#',"",$color1);

}
/*
if($color2 == null){
    //$color2 = str_replace('#',"",BASE_COLOR2);
}else{

    //$color2 = str_replace('#',"",$color2);
}*/

    $base = new CSS_Color($color1);
   // $highlight = new CSS_Color($color2);

    $bg_1 = $base->bg['-1'];
    $fg_1 = $base->fg['-1'];
    $bg_2 = $base->bg['-2'];
    $fg_2 = $base->fg['-2'];
    $bg_3 = $base->bg['-3'];
    $fg_3 = $base->fg['-3'];
    $bg_4 = $base->bg['-4'];
    $fg_4 = $base->fg['-4'];
    $bg_5 = $base->bg['-5'];
    $fg_5 = $base->fg['-5'];
    $bg1 = $base->bg['+1'];
    $fg1 = $base->fg['+1'];
    $bg2 = $base->bg['+2'];
    $fg2 = $base->fg['+2'];
    $bg3 = $base->bg['+3'];
    $fg3 = $base->fg['+3'];
    $bg4 = $base->bg['+4'];
    $fg4 = $base->fg['+4'];
    $bg5 = $base->bg['+5'];
    $fg5 = $base->fg['+5'];

    $result=<<<CSS

.color-1{
  background:#{$bg_1};
  color:#{$fg_1};
}
.color-2 {
  background:#{$bg_2};
  color:#{$fg_2};
}
.color-3 {
  background:#{$bg_3};
  color:#{$fg_3};
}
.color-4 {
  /** Use the base color, two shades darker */
  background:#{$bg_4};
  /** Use the corresponding foreground color */
  color:#{$fg_4};
}
.color-5 {
  background:#{$bg_5};
  color:#{$fg_5};
}

.color1{
  background:#{$bg1};
  color:#{$fg1};
}
.color2 {
  background:#{$bg2};
  color:#{$fg2};
}
.color3 {
  background:#{$bg3};
  color:#{$fg3};
}
.color4 {
  /** Use the base color, two shades darker */
  background:#{$bg4};
  /** Use the corresponding foreground color */
  color:#{$fg4};
}
.color5 {
  background:#{$bg5};
  color:#{$fg5};
}
.face-1{
  color:#{$fg_1};
}
.face-2 {
  color:#{$fg_2};
}
.face-3 {
  color:#{$fg_3};
}
.face-4 {
  color:#{$fg_4};
}
.face-5 {
  color:#{$fg_5};
}
.face1{
  color:#{$fg1};
}
.face2 {
  color:#{$fg2};
}
.face3 {
  color:#{$fg3};
}
.face4 {
  color:#{$fg4};
}
.face5 {
  color:#{$fg5};
}

CSS;

return $result;
}

    function hex2rgba($color,$opecity){

        if ($color[0] == '#')
            $color = substr($color, 1);

        if (strlen($color) == 6)
            list($r, $g, $b) = array($color[0].$color[1],
                                     $color[2].$color[3],
                                     $color[4].$color[5]);
        elseif (strlen($color) == 3)
            list($r, $g, $b) = array($color[0].$color[0], $color[1].$color[1], $color[2].$color[2]);
        else
            return false;

        $r = hexdec($r); $g = hexdec($g); $b = hexdec($b);

        return "rgba({$r}, {$g}, {$b},{$opecity})";
    }



    function design_output($name = 'default'){

        $filename = get_stylesheet_directory().'/lib/templates/'.$name.'.php';
        $fp = fopen($filename, "r");
        $content = fread( $fp, filesize($filename) ); // ファイルサイズ分読みこみ
        fclose( $fp );
        $content = preg_replace_callback('|%([a-z0-9_-]+)?%|si',"style_rewite",$content);

        return apply_filters("raindrops_colors", $content );


    }

function style_rewite($element){


$element = $element[1];
    $name = warehouse("raindrops_style_type");

    global $images_path;
    global $navigation_title_img;
    global $tmn_header_image;
    global $tmn_header_color;
    global $tmn_footer_image;
    global $tmn_footer_color;

    $c_border   = colors(0,'background');

    if($c_border == '#'){
        $rgba_border = 'rgba(203,203,203, 0.8)';
    }else{
        $rgba_border = hex2rgba($c_border,0.5);
    }



    if(preg_match("|c([0-5])|",$element,$regs)){
        $$element = colors($regs[1]);

    }
    if(preg_match("|c_([0-5])|",$element,$regs)){
        $$element = colors( - $regs[1]);

    }


    $position_y = warehouse('raindrops_heading_image_position');

    $y = $position_y * 26;
    $y = '-'.$y.'px';

    switch( $position_y ){
        case(0):
            $h_position_rsidebar_h2 = "background-position:0 0;";
        break;
        case(1):
            $h_position_rsidebar_h2 = "background-position:0 $y;";
        break;
        case(2):
            $h_position_rsidebar_h2 = "background-position:0 $y;";
        break;
        case(3):
            $h_position_rsidebar_h2 = "background-position:0 $y;";
        break;
        case(4):
            $h_position_rsidebar_h2 = "background-position:0 $y;";
        break;
        case(5):
            $h_position_rsidebar_h2 = "background-position:0 $y;";
        break;
        case(6):
            $h_position_rsidebar_h2 = "background-position:0 $y;";
        break;
        case(7):
            $h_position_rsidebar_h2 = "background-position:0 $y;";
        break;
        default:
            $h_position_rsidebar_h2 = "background-position:0 208px;";
        break;

    }

        $h2_default_background = "background:".colors(4,'background').' ';
        $h2_default_background .= "url({$images_path}{$navigation_title_img});";
        $h2_default_background .= "color:".colors(4,'color').';';

        $h2_dark_background = "background:".colors(-3,'background').' ';
        $h2_dark_background .= "url({$images_path}{$navigation_title_img});";
        $h2_dark_background .= "color:".colors(-3,'color').';';

        $h2_light_background = "background:".colors(4,'background').' ';
        $h2_light_background .= "url({$images_path}{$navigation_title_img});";
        $h2_light_background .= "color:".colors(4,'color').';';



    switch($name){

        case("default"):
            $custom_dark_bg = colors('3','background');
            $custom_light_bg = colors('1','background');
            $custom_color = colors('1','color');
            if(!empty($tmn_footer_color)){
                $tmn_footer_color = 'color:'.$tmn_footer_color;
            }else{
                $tmn_footer_color = '';
            }
            if(!empty($tmn_header_color)){
                $tmn_header_color = 'color:'.$tmn_header_color;
            }else{
                $tmn_header_color = '';
            }


            $gradient = tmn_gradient();

        break;

        case("dark"):
        /**
         *
         *
         *dark
         *
         */

            $custom_dark_bg = colors('-1','background');
            $custom_light_bg = colors('-4','background');
            $custom_color = colors('-3','color');


            if(!empty($tmn_footer_color)){
                $tmn_footer_color = $tmn_footer_color;
            }else{
                $tmn_footer_color = '';
            }
            if(!empty($tmn_header_color)){
                $tmn_header_color = $tmn_header_color;
            }else{
                $tmn_header_color = '';
            }


        break;
        case("light"):
        /**
         * light
         *
         *
         *
         */
            $custom_dark_bg = colors('5','background');
            $custom_light_bg = colors('3','background');
            $custom_color = colors('3','color');
            $base_gradient = tmn_gradient_single(3,"asc");

            if(!empty($tmn_footer_color)){
                $tmn_footer_color = $tmn_footer_color;
            }else{
                $tmn_footer_color = '';
            }
            if(!empty($tmn_header_color)){
                $tmn_header_color = $tmn_header_color;
            }else{
                $tmn_header_color = '';
            }
        break;

        default:

            $custom_dark_bg = colors('3','background');
            $custom_light_bg = colors('1','background');
            $custom_color = colors('1','color');
            if(!empty($tmn_footer_color)){
                $tmn_footer_color = 'color:'.$tmn_footer_color;
            }else{
                $tmn_footer_color = '';
            }
            if(!empty($tmn_header_color)){
                $tmn_header_color = 'color:'.$tmn_header_color;
            }else{
                $tmn_header_color = '';
            }


            $gradient = tmn_gradient();

        break;

    }

    if(isset($$element)){
        return $$element;
        }else{
        return "/*--".$element." can not bind--*/";
        }


}




?>