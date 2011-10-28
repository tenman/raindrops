<?php
/**
 * Functions for shortcodes
 *
 * @package WordPress
 * @subpackage Raindrops
 */
?>
<?php
if(!defined('ABSPATH')){exit;}
/**
 * shortcode content clean up
 *
 */

    add_filter('the_content','raindrops_remove_para',99);

    function raindrops_remove_para($content){
        $target = array("|<p>(</?div)|u",'|(</?div[^<]+)</p>|','|(</?h3[^<]+)</p>|');
        $change = array("$1", "$1","$1");
        $content = preg_replace($target,$change,$content);
        return $content;
    }

/**
 * dialog shortcode
 *
 * return value e.g.<div class="gradient3 raindrops-dialog" style="[attr style]"><h3 class="gradient-2 raindrops-dialog-title" style="margin: 0; padding: 0.2em 1em;">[attr title]</h3><div class="raindrops-dialog-content pad-m">[content]</div></div>
 *
 * @param array()
 * @param string
 * @return string html block
 */
    add_shortcode('dialog', 'raindrops_dialog_shortcode');

    function raindrops_dialog_shortcode( $atts, $content = null ) {
        extract( shortcode_atts( array(
           'title' => 'title',
           'style' => 'min-height: 100px;'
           ), $atts ) );

        return '<div class="gradient3 raindrops-dialog" style="'.$style.'"><h3 class="gradient-2 raindrops-dialog-title" style="margin: 0; padding: 0.2em 1em;">'.$title.'</h3><div class="raindrops-dialog-content pad-m">'.$content.'</div></div>';
    }
/**
 * Tab shortcode
 *
 * return value e.g.<div class="raindrops-tab"><ul class="raindrops-tab-list clearfix"><li class="dummy">Tab Area</li></ul><div class="raindrops-tab-content clearfix  [attr class]" >[content]</div></div>
 *
 * @param array()
 * @param string
 * @return string html block
 */
    add_shortcode('tab', 'raindrops_tab_shortcode');
    add_shortcode('tab_item', 'raindrops_tab_content_shortcode');

    /*check br ploblem  now stylesheet display:none;*/
    function raindrops_tab_shortcode( $atts, $content = null ) {
            extract( shortcode_atts( array(
           'title' => 'title',
           'class' => '',
           'before' => '<div class="raindrops-tab"><ul class="raindrops-tab-list clearfix"><li class="dummy">Tab Area</li></ul><div class="raindrops-tab-content clearfix  %1$s" >',
           'after' => '</div></div>'
           ), $atts ) );

            $before = sprintf($before, $class);
            $content = trim($content);

        return $before. do_shortcode(shortcode_unautop($content)) . $after;
    }

/**
 * Tab content shortcode
 *
 * return value e.g. <div class="raindrops-tab-page"><h3>[attr title]</h3>[content]</div>
 *
 * @param array()
 * @return string html block
 */

    function raindrops_tab_content_shortcode( $atts, $content = null ) {
        extract( shortcode_atts( array(
           'title' => 'title',
           ), $atts ) );

           return '<div class="raindrops-tab-page"><h3>'.$title.'</h3>'. do_shortcode(shortcode_unautop($content)) . '</div>';
    }

/**
 * Toggle shortcode
 *
 *
 *
 * @param array()
 * @param string
 * @return string html block
 */
    add_shortcode('toggle', 'raindrops_toggle_shortcode');

    function raindrops_toggle_shortcode( $atts, $content = null ) {
        extract( shortcode_atts( array(
           'title' => 'title',
           'class_title' => '',
           'class_content' => ''
           ), $atts ) );

           $result = sprintf('<ul><li class="raindrops-toggle raindrops-toggle-title '.$class_title.'">'.$title.'</li><li class="raindrops-toggle '.$class_content.'">'.do_shortcode(shortcode_unautop($content)).'</li></ul>');

           return $result;

    }
/**
 * Entry divides shortcode
 *
 * It divides entry. Special grid, 2/3 - 1/3
 *
 * @param array()
 * @param string
 * @return string html block
 */
    add_shortcode('bar_right_m', 'raindrops_bar_right_middle');
    function raindrops_bar_right_middle( $atts, $content = null ) {
        extract( shortcode_atts( array(
           'class' => '',
           ), $atts ) );

           $result = sprintf('<div class="yui-gc %1$s">%2$s</div>',$class,do_shortcode(shortcode_unautop($content)));

           return $result;
    }
/**
 * Entry divides shortcode
 *
 * It divides entry. Special grid, 3/4 - 1/4
 *
 * @param array()
 * @param string
 * @return string html block
 */
    add_shortcode('bar_right_s', 'raindrops_bar_right_narrow');
    function raindrops_bar_right_narrow( $atts, $content = null ) {
        extract( shortcode_atts( array(
           'class' => '',
           ), $atts ) );

           $result = sprintf('<div class="yui-ge %1$s">%2$s</div>',$class,do_shortcode(shortcode_unautop($content)));

           return $result;
    }
/**
 * Entry divides shortcode
 *
 * It divides entry. Special grid, 1/3 - 2/3
 *
 * @param array()
 * @param string
 * @return string html block
 */

    add_shortcode('bar_left_m', 'raindrops_bar_left_middle');
    function raindrops_bar_left_middle( $atts, $content = null ) {
        extract( shortcode_atts( array(
           'class' => '',
           ), $atts ) );

           $result = sprintf('<div class="yui-gd %1$s">%2$s</div>',$class,do_shortcode(shortcode_unautop($content)));

           return $result;
    }
/**
 * Entry divides shortcode
 *
 * It divides entry. Special grid, 1/4 - 3/4
 *
 * @param array()
 * @param string
 * @return string html block
 */

    add_shortcode('bar_left_s', 'raindrops_bar_left_narrow');
    function raindrops_bar_left_narrow( $atts, $content = null ) {
        extract( shortcode_atts( array(
           'class' => '',
           ), $atts ) );

           $result = sprintf('<div class="yui-gf %1$s">%2$s</div>',$class,do_shortcode(shortcode_unautop($content)));

           return $result;
    }
/**
 * Entry divides shortcode
 *
 * It divides entry. Standard half grid
 *
 * @param array()
 * @param string
 * @return string html block
 */
    add_shortcode('bar_harf', 'raindrops_bar_harf_shortcode');
    function raindrops_bar_harf_shortcode( $atts, $content = null ) {
        extract( shortcode_atts( array(
           'class' => '',
           ), $atts ) );

           $result = sprintf('<div class="yui-g %1$s">%2$s</div>',$class,do_shortcode(shortcode_unautop($content)));

           return $result;
    }
/**
 * Entry divides shortcode
 *
 * It divides entry.  - Special grid, 1/3 - 1/3 - 1/3
 *
 * @param array()
 * @param string
 * @return string html block
 */

    add_shortcode('bar_3', 'raindrops_bar_3_shortcode');
    function raindrops_bar_3_shortcode( $atts, $content = null ) {
        extract( shortcode_atts( array(
           'class' => '',
           ), $atts ) );

           $result = sprintf('<div class="yui-gb %1$s">%2$s</div>',$class,do_shortcode(shortcode_unautop($content)));

           return $result;
    }
/**
 * Entry divides shortcode content
 *
 * first content
 *
 * @param array()
 * @param string
 * @return string html block
 */

    add_shortcode('col1', 'raindrops_div_left_shortcode');

    function raindrops_div_left_shortcode( $atts, $content = null ) {
        extract( shortcode_atts( array(
           'class' => '',
           ), $atts ) );

           $result = sprintf('<div class="yui-u first"><div class=" %1$s">%2$s</div></div>',$class,do_shortcode(shortcode_unautop($content)));

           return $result;
    }
/**
 * Entry divides shortcode content
 *
 * second content
 *
 * @param array()
 * @param string
 * @return string html block
 */

    add_shortcode('col2', 'raindrops_div_right_shortcode');

    function raindrops_div_right_shortcode( $atts, $content = null ) {
        extract( shortcode_atts( array(
           'class' => '',
           ), $atts ) );

           $result = sprintf('<div class="yui-u"><div class=" %1$s">%2$s</div></div>',$class,do_shortcode(shortcode_unautop($content)));

           return $result;
    }
/**
 * Entry divides shortcode content
 *
 * third content only use bar_3
 *
 * @param array()
 * @param string
 * @return string html block
 */

    add_shortcode('col3', 'raindrops_div_center_shortcode');
    function raindrops_div_center_shortcode( $atts, $content = null ) {
        extract( shortcode_atts( array(
           'class' => '',
           ), $atts ) );

           $result = sprintf('<div class="yui-u"><div class=" %1$s">%2$s</div></div>',$class,do_shortcode(shortcode_unautop($content)));

           return $result;
    }


/**
 * Custom field shortcode
 *
 * display custom field value
 *
 * @param array()
 * @param string
 * @return string html block
 */
    add_shortcode('custom_field', 'raindrops_custom_field_shortcode');

    function raindrops_custom_field_shortcode( $atts, $content = null ) {
        extract( shortcode_atts( array(
           'name' => '',
           'fallback' => '',
           'class' => '',
           'before' => '<%1$s class="custom-field-shortcode %2$s">',
           'after' => '</%s>',
           'element' => 'div'
           ), $atts ) );

          $keys = get_post_custom_keys();
          $before = sprintf($before,$element,$class);
          $after = sprintf($after,$element);
          if(in_array($name,$keys,true)){
            return $before.post_custom($name).$after;
          }else{
            return $before.$fallback.$after;
          }
    }
