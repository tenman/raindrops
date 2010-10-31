<?php
/**
 * functions and constats for Raindrops theme
 *
 *
 * @package WordPress
 * @subpackage Raindrops
 * @since Raindrops 0.1
 */
?>
<?php
    global $wpdb;

    $stylesheet_name = 'individual-css.php';


    if(!defined('COLOR_SCHEME')){
        define("COLOR_SCHEME","color_en_140");
    }
    if(!defined('TMN_TABLE_TITLE')){
        define("TMN_TABLE_TITLE",'options');
    }

    if(!defined('TMN_PLUGIN_TABLE')){
        define('TMN_PLUGIN_TABLE',$wpdb->prefix . TMN_TABLE_TITLE);
    }
    if(!defined('TMN_TABLE_VERSION')){
        define('TMN_TABLE_VERSION','0.1');
    }

    if(!defined('INDIVIDUAL_STYLE')){
        define('INDIVIDUAL_STYLE',$stylesheet_name);

    }
    if(!defined('NO_HEADER_TEXT')){
        define('NO_HEADER_TEXT', false );
    }
    if(!defined('HEADER_TEXTCOLOR')){
        define('HEADER_TEXTCOLOR', 'ffffff');
    }
    if(!defined('HEADER_IMAGE')){
        define('HEADER_IMAGE', '%s/images/headers/wp3.jpg');
    }
    if(!defined('HEADER_IMAGE_WIDTH')){
        define('HEADER_IMAGE_WIDTH', 950);
    }
    if(!defined('HEADER_IMAGE_HEIGHT')){
        define('HEADER_IMAGE_HEIGHT', 198);
    }
    if(!defined('SHOW_HEADER_IMAGE')){
        define('SHOW_HEADER_IMAGE',true);
    }
    if(!defined('TMN_THE_TIME_FORMAT')){
        define("TMN_THE_TIME_FORMAT",'F j, Y');//

    }
    if(!defined('TMN_THE_MONTH_FORMAT')){
        define("TMN_THE_MONTH_FORMAT",'F j');//archive.php

    }


    add_editor_style();
    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'primary' => __( 'Primary Navigation', 'raindrops' ),
    ) );

    // This theme allows users to set a custom background
    add_custom_background();



    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 48, 48, true );
    add_image_size( 'single-post-thumbnail', 600, 200, true);

    // Add default posts and comments RSS feed links to head
    add_theme_support( 'automatic-feed-links' );



    // custom content_width
    /*When the value is specified for this variable,
    it is not ..width of the page.. revokable from the management screen. */

        $content_width = '';

    if(isset($content_width) and !empty($content_width)){

        add_action("wp_head","tmn_custom_width");

        function tmn_custom_width($content,$key){
        global $content_width;
            //maybe
                $c_width = (int)$content_width;
                $width    = $c_width / 13;
                $ie_width = $width * 0.9759;
            $custom_content_width = '<style type="text/css">'.
            '#custom-doc {margin:auto;text-align:left;'."\n".
            'width:'.round($width,0).'em;'."\n".
            '*width:'.round($ie_width,0).'em;'."\n".
            'min-width:'.round($width * 0.7,0).'em;}</style>';


            echo $custom_content_width;
        }



    }


if ( function_exists( 'add_custom_image_header' ) ) {

add_custom_image_header('header_style', 'admin_header_style');

function header_style(){


}


function admin_header_style(){


}


    register_default_headers( array(

        'default' => array(
            'url' => '%s/images/headers/wp3.jpg',
            'thumbnail_url' => '%s/images/headers/wp3-thumbnail.jpg',
            /* translators: header image description */
            'description' => __( 'raindrops', 'raindrops' )
        )

    ) );
}


    load_textdomain( 'raindrops', get_template_directory().'/languages/'.get_locale().'.mo' );


    add_filter( 'comment_form_default_fields','tmn_comment_form');
    add_filter( 'the_meta_key', 'filter_explode_meta_keys', 10, 2 );
    add_filter('body_class','add_body_class');
    add_filter('contextual_help','raindrops_help');

    $is_submenu = new tmn_menu_create;
    add_action('admin_menu', array($is_submenu, 'add_menus'));

    if ( !is_admin() ) {
        wp_register_script('raindrops_script',get_bloginfo('stylesheet_directory') .'/lib/script.php',array('jquery'),'0.1' );
        wp_enqueue_script('raindrops_script');
        add_action('wp_print_styles', 'add_raindrops_stylesheet');
    }

    add_filter('mce_css', 'raindrops_editor_style');

    function my_editor_style($url) {

      if ( !empty($url) )
        $url .= ',';

      // Change the path here if using sub-directory
      $url .= trailingslashit( get_stylesheet_directory_uri() ) . 'editor-style.css';

      return $url;
    }


    wp_register_sidebar_widget('colorsample','Color Sample', 'raindrop_colors');

    add_action( 'widgets_init', 'raindrops_widgets_init' );

    function raindrops_widgets_init() {

        register_sidebar(array (
          'name' => __('Default Sidebar'),
          'id' => 'sidebar-1',
          'before_widget' => '<li class="widget default">',
          'after_widget' => '</li>
        ',
          'before_title' => '<h2 class="widgettitle default h2">',
          'after_title' => '</h2>
        ',
          'widget_id' => 'default',
          'widget_name' => 'default',
          'text' => "1"));
        register_sidebar(
          array (
          'name' => __('Extra Sidebar'),
          'id' => 'sidebar-2',
          'before_widget' => '<li class="widget extra">',
          'after_widget' => '</li>
        ',
          'before_title' => '<h2 class="widgettitle extra h2">',
          'after_title' => '</h2>
        ',
          'widget_id' => 'extra',
          'widget_name' => 'extra',
          'text' => "2"));
        register_sidebar(
          array (
          'name' => __('Sticky Widget'),
          'id' => 'sidebar-3',
          'before_widget' => '<li class="widget sticky-widget">',
          'after_widget' => '</li>',
          'before_title' => '<h2 class="widgettitle home-top-content h2">',
          'after_title' => '</h2>',
          'widget_id' => 'toppage2',
          'widget_name' => 'toppage2',
          'text' => "3"));
    }

if(!isset($raindrops_base_setting)){

$raindrops_base_setting = array(
    array('option_id' =>'null','blog_id' => 0 ,'option_name' => "raindrops_base_color",'option_value' => "#345678",'autoload'=>'yes'),
    array('option_id' =>'null','blog_id' => 0 ,'option_name' => "raindrops_style_type",'option_value' => "default",'autoload'=>'yes'),
    array('option_id' =>'null','blog_id' => 0 ,'option_name' => "raindrops_header_image",'option_value' => "header.png",'autoload'=>'yes'),
    array('option_id' =>'null','blog_id' => 0 ,'option_name' => "raindrops_footer_image",'option_value' => "footer.png",'autoload'=>'yes'),
    array('option_id' =>'null','blog_id' => 0 ,'option_name' => "raindrops_heading_image_position",'option_value' => "0",'autoload'=>'yes'),
    array('option_id' =>'null','blog_id' => 0 ,'option_name' => "raindrops_heading_image",'option_value' => "h2.png",'autoload'=>'yes'),
    array('option_id' =>'null','blog_id' => 0 ,'option_name' => "raindrops_page_width",'option_value' => "doc2",'autoload'=>'yes'),
    array('option_id' =>'null','blog_id' => 0 ,'option_name' => "raindrops_col_width",'option_value' => "t2",'autoload'=>'yes'),
    array('option_id' =>'null','blog_id' => 0 ,'option_name' => "raindrops_default_fonts_color",'option_value' => "#333333",'autoload'=>'yes'),
    array('option_id' =>'null','blog_id' => 0 ,'option_name' => "raindrops_footer_color",'option_value' => "#333333",'autoload'=>'yes'),
    array('option_id' =>'null','blog_id' => 0 ,'option_name' => "raindrops_show_right_sidebar",'option_value' => "show",'autoload'=>'yes'),
    array('option_id' =>'null','blog_id' => 0 ,'option_name' => "raindrops_right_sidebar_width_percent",'option_value' => "25",'autoload'=>'yes'),

        );

}

    include_once(STYLESHEETPATH."/lib/csscolor.css.php");


if (!function_exists('add_body_class')) {
function add_body_class($class) {

    /**
     * body class への追加 ブラウザ　lang
     *
     *　example
     *
     *　$classes= array('追加クラス名1'、'追加クラス名2');
     *
     */
    $lang = WPLANG;
    $classes= array($lang);

     $classes= array_merge($classes,$class);

        global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;


    switch(true){

        case($is_lynx):
             $classes[] = 'lynx';
        break;
        case($is_gecko):
            $classes[]  = 'gecko';
        break;
        case($is_IE):
            preg_match(" |(MSIE )([0-9])(\.) |si",$_SERVER['HTTP_USER_AGENT'],$regs);
            $classes[]      = 'ie'.$regs[2];
        break;
        case($is_opera):
             $classes[] = 'opera';
        break;
        case($is_NS4):
            $classes[]  = 'ns4';
        break;
        case($is_safari):
            $classes[]  = 'safari';
        break;
        case($is_chrome):
            $classes[]  = 'chrome';
        break;
        case($is_iphone):
            $classes[]  = 'iphone';
        break;
        default:
            $classes[]  = 'unknown';
        break;
        }

    return $classes;
}

}



if (!function_exists('raindrops_comment')) {


    function raindrops_comment( $comment, $args, $depth ) {

        $GLOBALS['comment'] = $comment; ?>
        <?php if ( '' == $comment->comment_type ) : ?>


        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
            <div id="comment-<?php comment_ID(); ?>">


            <div class="comment-author vcard">
             <div style="width:40px;float-left">
                <?php echo get_avatar( $comment, 32 ); ?>
            </div>
                <div style="overflow:hidden;*width:100%;padding-left:1em;" class="clearfix">

                <?php printf( __( '%s <span class="says">says:</span>', 'raindrops' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
                </div>
            </div><!-- .comment-author .vcard -->




            <?php if ( $comment->comment_approved == '0' ) : ?>
            <div style="overflow:hidden;*width:100%;padding-left:1em;" class="clearfix">
                <em><?php _e( 'Your comment is awaiting moderation.', 'raindrops' ); ?></em>
                <br />
                </div>
            <?php endif; ?>

            <div class="comment-meta commentmetadata clearfix" style="overflow:hidden;*width:100%;padding-left:1em;"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                <?php
                    /* translators: 1: date, 2: time */
                    printf( __( '%1$s at %2$s', 'raindrops' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'raindrops' ), ' ' );
                ?>
            </div><!-- .comment-meta .commentmetadata -->

            <div class="comment-body"><?php comment_text(); ?></div>

            <div class="reply">
                <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </div><!-- .reply -->

        </div><!-- #comment-##  -->

        <?php else : ?>

        <li class="post pingback">
            <p><?php _e( 'Pingback:', 'raindrops' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'raindrops'), ' ' ); ?></p>

        <?php endif;
    }

}


if (!function_exists('raindrops_posted_in')) {
    function raindrops_posted_in() {
        // Retrieves tag list of current post, separated by commas.
        $tag_list = get_the_tag_list( '', ', ' );
        if ( $tag_list ) {
            $posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'raindrops' );
        } elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
            $posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'raindrops' );
        } else {
            $posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'raindrops' );
        }
        // Prints the string, replacing the placeholders.
        printf(
            $posted_in,
            get_the_category_list( ', ' ),
            $tag_list,
            get_permalink(),
            the_title_attribute( 'echo=0' )
        );
    }

}


if (!function_exists('raindrops_posted_on')) {

    function raindrops_posted_on() {
        printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'raindrops' ),
            'meta-prep meta-prep-author',
            sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
                get_permalink(),
                esc_attr( get_the_time() ),
                get_the_date()
            ),
            sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="vcard:url">%3$s</a></span>',
                get_author_posts_url( get_the_author_meta( 'ID' ) ),
                sprintf( esc_attr__( 'View all posts by %s', 'raindrops' ), get_the_author() ),
                get_the_author()
            )
        );
    }

}


if (!function_exists('filter_explode_meta_keys')) {

    function filter_explode_meta_keys( $content, $key ) {
        $explode_keys = array( 'css', 'javascript', 'meta','embed','excerpt','template'); // 除外したいキーを設定
        if ( in_array( $key, $explode_keys ) ) return;
        else return $content;
    }

}


    if(warehouse('raindrops_show_right_sidebar') == 'hide'){
        $rsidebar_show = false;
    }else{
        $rsidebar_show = true;
    }

    if(warehouse('raindrops_right_sidebar_width_percent') == '25'){
        $yui_inner_layout = 'yui-ge';
    }elseif(warehouse('raindrops_right_sidebar_width_percent') == '75'){
        $yui_inner_layout = 'yui-gf';
    }elseif(warehouse('raindrops_right_sidebar_width_percent') == '33'){
        $yui_inner_layout = 'yui-gc';
    }elseif(warehouse('raindrops_right_sidebar_width_percent') == '66'){
        $yui_inner_layout = 'yui-gd';
    }elseif(warehouse('raindrops_right_sidebar_width_percent') == '50'){
        $yui_inner_layout = 'yui-g';
    }else{
        $yui_inner_layout = 'yui-ge';
    }






function raindrop_colors($args){
if(is_admin){
        extract($args);

        echo $before_widget;
        echo $before_title . "Color Sample". $after_title;
?>

<p>
<span id="toggle1" style="padding:5px 7px">color1</span>
<span id="toggle2" style="padding:5px 7px">color2</span>
<span id="toggle3"  style="padding:5px 7px">color3</span>
<span id="toggle4"  style="padding:5px 7px">color4</span>
<span id="toggle5"  style="padding:5px 7px">color5</span></p>
<p><span id="toggle-1"  style="padding:5px 7px">color-1</span>
<span id="toggle-2"  style="padding:5px 7px">color-2</span>
<span id="toggle-3"  style="padding:5px 7px">color-3</span>
<span id="toggle-4"  style="padding:5px 7px">color-4</span>
<span id="toggle-5"  style="padding:5px 7px">color-5</span></p>





<div class="toggle5 color5" style="text-align:center;padding:20px 0;">class color5</div>
<div class="toggle4 color4" style="text-align:center;padding:20px 0;">class color4</div>
<div class="toggle3 color3" style="text-align:center;padding:20px 0;">class color3</div>
<div class="toggle2 color2" style="text-align:center;padding:20px 0;">class color2</div>
<div class="toggle1 color1" style="text-align:center;padding:20px 0;">class color1</div>
<div class="toggle-1 color-1" style="text-align:center;padding:20px 0;">class color-1</div>
<div class="toggle-2 color-2" style="text-align:center;padding:20px 0;">class color-2</div>
<div class="toggle-3 color-3" style="text-align:center;padding:20px 0;">class color-3</div>
<div class="toggle-4 color-4" style="text-align:center;padding:20px 0;">class color-4</div>
<div class="toggle-5 color-5" style="text-align:center;padding:20px 0;">class color-5</div>

<?php
        echo $after_widget;
}




}





/**
 * warehouse　get raindrops setting
 *
 *
 */
function warehouse($name){
    global $raindrops_base_setting;
    global $content_width;
    $vertical = array();


    foreach($raindrops_base_setting as $key=>$val){
        if(!is_null($raindrops_base_setting)){
            $vertical[] = $val['option_name'];
        }

    }

        $row = array_search($name,$vertical);


if(isset($content_width) and !empty($content_width) and $name == 'raindrops_page_width'){
        return 'custom-doc';

}


        return get_option($name, $raindrops_base_setting[$row]['option_value']);
}

if (!function_exists('raindrops_help')) {


    function raindrops_help($text){

    global $title;

    if(TMN_TABLE_TITLE == $title){

$result = "<h2>".__('Welcome Raindrops.').'</h2>';


$result .= "<p>".__('Your own blog offers some methods to improve it better to this theme file.').'</p>';
$result .= "<p>".__('For instance, it is a color.').'</p>';
$result .= "<p>".__('The color is influencing even the person who doesn\'t stick to decorated thing.').'</p>';
$result .= "<p>".__('Therefore, the color was made easy to change. ').'</p>';
$result .= "<p>".__('For instance, it is a layout. ').'</p>';
$result .= "<p>".__('There is a legible document even if the same thing was written, and is a document not read easily. ').'</p>';
$result .= "<p>".__('A legible document is one index in an excellent document. ').'</p>';
$result .= "<p>".__('Therefore, the layout was able to be tested.').'</p>';
$result .= "<p>".sprintf(__('WEBSite：<a href="%1$s">%2$s</a>'),'http://www.tenman.info/raindrops','Raindrops').'</p>';


        return apply_filters("raindrops_help",$result);

    }else{

        return $text;
    }

    }

}
/**
 * Raindrops admin menu
 *
 *
 */



class tmn_menu_create {

    function SubMenu_GUI() {

        global $wpdb;
         $count = $wpdb->query("SELECT * FROM `".TMN_PLUGIN_TABLE."`;");

          global $count;


        echo "table name:<strong>".TMN_PLUGIN_TABLE."</strong>";

        /**
         * POST　GET
         *
         *
         */

        if(isset($_POST) and !empty($_POST)){

            global $raindrops_base_setting;

            $ok = false;

            $option_id      = intval($_POST['option_id']);

            $option_value   = esc_html($_POST['option_value']);
            $option_name    = esc_html($_POST['option_name']);


        if( !empty($_POST) and
             isset($_POST) and
              $option_value !== get_option($option_name)){


              update_option($option_name,$option_value);
               $ok = true;



        }


        }


    echo '<div class="wrap">';
    echo '<h2>'.TMN_TABLE_TITLE.'</h2>';
    if(isset($_POST) and !empty($_POST)){

        if($ok){
            echo '<div id="message" class="updated fade"><p>'.sprintf(__('%1$s updated successfully.'),$option_name).'</p></div>';
        }else{
            echo '<div id="message" class="error fade"><p>'.__("Try again").'</p></div>';
        }
    }

    echo $this->form_user_input();


}

    function add_menus() {
        if(function_exists('add_options_page')) {

       add_options_page(TMN_TABLE_TITLE, 'RAINDROPS Options', 'edit_pages', __FILE__, array($this, 'SubMenu_GUI'));


        }
    }



    function form_user_input(){
    global $raindrops_base_setting;
        global $wpdb;
        $option_value = "-";

        $deliv = htmlspecialchars($_SERVER['REQUEST_URI']);
        //if(get_option(TMN_TABLE_TITLE."_db_version") !== TMN_TABLE_VERSION){return;}

        $sql = 'SELECT * FROM `'.TMN_PLUGIN_TABLE.'` WHERE `option_name` LIKE \'raindrops%\'';
        $results = $wpdb->get_results($sql);


        $lines = "<table class=\"widefat post fixed\" cellspacing=\"0\">";
        $lines .=  '<thead><tr><th style=\"display:none;\">'.__("Color").'</th><th>'.__("Value").'</th><th >'.__("Edit").'</th><th>&nbsp;</th></tr></thead>';


        if(empty($results)){
            foreach($raindrops_base_setting as $add){

                add_option($add['option_name'],$add['option_value'],"description",$add['autoload']);

            }

        $host               = $_SERVER['HTTP_HOST'];
        $dirname            = dirname($_SERVER['PHP_SELF']);
        $filename           = basename($_SERVER['SCRIPT_FILENAME']);
        $query_str          = $_SERVER['QUERY_STRING'];
        $current_url        = "http://{$host}{$dirname}{$filename}{$query_str}";

        wp_redirect($current_url);
        }



        foreach($results as $key=>$result){

            $lines .= "<form action=\"$deliv\" method=\"post\">".wp_nonce_field('update-options');
            $lines .= '<tbody>';
            $lines .= '<tr>';
            $lines .= '<td style="display:none;">';
            $lines .= '<input type="text" name="option_id" value="'.$result->option_id.'" />'.$result->option_id.'</td>';


            if(preg_match("|#[0-9a-f]{6}|i",$result->option_value)){

                $style="background:".$result->option_value.';';
            }else{

                $style="";
            }

            if(preg_match("!\.(png|gif|jpeg|jpg)$!i",$result->option_value)){

                $style .="background:url(".get_bloginfo("stylesheet_directory")."/images/".$result->option_value.');';
            }else{

                $style .="";
            }

                $lines .= '<td style="'.$style.'"><span style="background:#fff;padding:3px;">'.$result->option_name.'</span>';
                $lines .= '<input type="hidden" name="option_name" value="'.$result->option_name.'" read-only="read-only" /></td>';
                $lines .= '<td>'.$result->option_value.'</td>';

                if( $result->option_name == "raindrops_base_color" or
                    $result->option_name == "raindrops_footer_color" or
                    $result->option_name == "raindrops_default_fonts_color" ){

                $lines .= "<td>".$this->color_selector('option_value',$result->option_value)."</td>";


            }elseif($result->option_name == "raindrops_col_width"){

                $lines .='<td><select name="option_value" size="6" ';
                $lines .='style="width:150px;vertical-align:bottom;margin-bottom:0px;height:120px;">';

                $col_settings = array("left 160px"=>"t1","left 180px"=>"t2","left 300px"=>"t3","right 180px"=>"t4","right 240px"=>"t5","right 300px"=>"t6");

                foreach($col_settings as $key=>$val){

                    if(strcmp($result->option_value,$val) == 0){ $selected = 'selected="selected"';}else{$selected = "";}

                    $lines .= '<option value="'.$val.'" '.$selected.'>'.$key.'</option>';

                }

                $lines .='</select></td>';

            }elseif($result->option_name == "raindrops_page_width"){

                $lines .='<td><select name="option_value" size="4" ';
                $lines .='style="width:150px;vertical-align:bottom;margin-bottom:0px;height:80px;">';

                $col_settings = array("750px centered"=>"doc","950px centered"=>"doc2","100% fluid"=>"doc3","974px fluid"=>"doc4");

                foreach($col_settings as $key=>$val){

                    if(strcmp($result->option_value,$val) == 0){ $selected = 'selected="selected"';}else{$selected = "";}
                    $lines .= '<option value="'.$val.'" '.$selected.'>'.$key.'</option>';
                }

                $lines .='</select></td>';

            }elseif($result->option_name == "raindrops_right_sidebar_width_percent"){

                $lines .='<td><select name="option_value" size="5" ';
                $lines .='style="width:150px;vertical-align:bottom;margin-bottom:0px;height:100px;">';

                $col_settings = array("25%"=>"25","33%"=>"33","50%"=>"50","66%"=>"66","75%"=>"75");

                foreach($col_settings as $key=>$val){

                    if(strcmp($result->option_value,$val) == 0){ $selected = 'selected="selected"';}else{$selected = "";}
                    $lines .= '<option value="'.$val.'" '.$selected.'>'.$key.'</option>';

                }

                $lines .='</select></td>';

            }elseif($result->option_name == "raindrops_show_right_sidebar"){

                $lines .='<td><select name="option_value" size="2" ';
                $lines .='style="width:150px;vertical-align:bottom;margin-bottom:0px;height:40px;">';

                $col_settings = array("show"=>"show","hide"=>"hide");

                foreach($col_settings as $key=>$val){

                    if(strcmp($result->option_value,$val) == 0){ $selected = 'selected="selected"';}else{$selected = "";}
                    $lines .= '<option value="'.$val.'" '.$selected.'>'.$key.'</option>';

                }

                $lines .='</select></td>';

            }elseif($result->option_name == "raindrops_style_type"){

                $lines .='<td><select name="option_value" size="3" ';
                $lines .='style="width:150px;vertical-align:bottom;margin-bottom:0px;height:60px;">';

                $col_settings = array("light"=>"light","dark"=>"dark","default"=>"default");

                foreach($col_settings as $key=>$val){

                    if(strcmp($result->option_value,$val) == 0){ $selected = 'selected="selected"';}else{$selected = "";}
                    $lines .= '<option value="'.$val.'" '.$selected.'>'.$key.'</option>';

                }

                $lines .='</select></td>';






            }else{

                $lines .= '<td><input type="text" name="option_value" value="'.$result->option_value.'"';

                if($result->option_name == "raindrops_base_color"){
                    $lines .= 'id="raindrops_base_color"';
                }

                $lines .= '/></td>';

            }

            $send_key_name = ",option_name";
            $send_key_name .= ",option_id";
            $send_key_name .= ",option_value";

            $lines .= '<td>';

            $send_key_name = str_replace("-,","",$send_key_name);
            $lines .= '<input type="hidden" name="action" value="update" />';
            $lines .= '<input type="hidden" name="page_options" value='.$send_key_name.' />';
            $lines .= "<input type=\"submit\" class=\"button-primary\" value=\"".__('Save Changes').'" />';
            $lines .= '</p></td></tr></form>';

            $send_key_name = "";
        }
            $lines .= "</tbody>";
            $lines .=  '<tfoot><tr><th style=\"display:none;\">'.__("Color").'</th><th>'.__("Value").'</th><th >'.__("Edit").'</th><th>&nbsp;</th></tr></tfoot>';

            $lines .= "</table></div>";

            if(!preg_match('|<tbody>|',$lines)){
            $lines .= "<tbody><tr><td colspan=\"4\">".__("Please reload this page ex. windows F5",'Ranidrops').'</td></tr>';

            }

            return $lines;

    }



     function color_selector($name,$current_val){




$color_en_140 = array("white"=>"#ffffff","whitesmoke"=>"#f5f5f5","gainsboro"=>"#dcdcdc","lightgrey"=>"#d3d3d3","silver"=>"#c0c0c0","darkgray"=>"#a9a9a9","gray"=>"#808080","dimgray"=>"#696969","black"=>"#000000","red"=>"#ff0000","orangered"=>"#ff4500","tomato"=>"#ff6347","coral"=>"#ff7f50","salmon"=>"#fa8072","lightsalmon"=>"#ffa07a","darksalmon"=>"#e9967a","peru"=>"#cd853f","saddlebrown"=>"#8b4513","sienna"=>"#a0522d","chocolate"=>"#d2691e","sandybrown"=>"#f4a460","darkred"=>"#8b0000","maroon"=>"#800000","brown"=>"#a52a2a","firebrick"=>"#b22222","crimson"=>"#dc143c","indianred"=>"#cd5c5c","lightcoral"=>"#f08080","rosybrown"=>"#bc8f8f","palevioletred"=>"#db7093","deeppink"=>"#ff1493","hotpink"=>"#ff69b4","lightpink"=>"#ffb6c1","pink"=>"#ffc0cb","mistyrose"=>"#ffe4e1","linen"=>"#faf0e6","seashell"=>"#fff5ee","lavenderblush"=>"#fff0f5","snow"=>"#fffafa","yellow"=>"#ffff00","gold"=>"#ffd700","orange"=>"#ffa500","darkorange"=>"#ff8c00","goldenrod"=>"#daa520","darkgoldenrod"=>"#b8860b","darkkhaki"=>"#bdb76b","burlywood"=>"#deb887","tan"=>"#d2b48c","khaki"=>"#f0e68c","peachpuff"=>"#ffdab9","navajowhite"=>"#ffdead","palegoldenrod"=>"#eee8aa","moccasin"=>"#ffe4b5","wheat"=>"#f5deb3","bisque"=>"#ffe4c4","blanchedalmond"=>"#ffebcd","papayawhip"=>"#ffefd5","cornsilk"=>"#fff8dc","lightyellow"=>"#ffffe0","lightgoldenrodyellow"=>"#fafad2","lemonchiffon"=>"#fffacd","antiquewhite"=>"#faebd7","beige"=>"#f5f5dc","oldlace"=>"#fdf5e6","ivory"=>"#fffff0","floralwhite"=>"#fffaf0","greenyellow"=>"#adff2f","yellowgreen"=>"#9acd32","olive"=>"#808000","darkolivegreen"=>"#556b2f","olivedrab"=>"#6b8e23","chartreuse"=>"#7fff00","lawngreen"=>"#7cfc00","lime"=>"#00ff00","limegreen"=>"#32cd32","forestgreen"=>"#228b22","green"=>"#008000","darkgreen"=>"#006400","seagreen"=>"#2e8b57","mediumseagreen"=>"#3cb371","darkseagreen"=>"#8fbc8f","lightgreen"=>"#90ee90","palegreen"=>"#98fb98","springgreen"=>"#00ff7f","mediumspringgreen"=>"#00fa9a","honeydew"=>"#f0fff0","mintcream"=>"#f5fffa","azure"=>"#f0ffff","lightcyan"=>"#e0ffff","aliceblue"=>"#f0f8ff","darkslategray"=>"#2f4f4f","steelblue"=>"#4682b4","mediumaquamarine"=>"#66cdaa","aquamarine"=>"#7fffd4","mediumturquoise"=>"#48d1cc","turquoise"=>"#40e0d0","lightseagreen"=>"#20b2aa","darkcyan"=>"#008b8b","teal"=>"#008080","cadetblue"=>"#5f9ea0","darkturquoise"=>"#00ced1","aqua"=>"#00ffff","cyan"=>"#00ffff","lightblue"=>"#add8e6","powderblue"=>"#b0e0e6","paleturquoise"=>"#afeeee","skyblue"=>"#87ceeb","lightskyblue"=>"#87cefa","deepskyblue"=>"#00bfff","dodgerblue"=>"#1e90ff","ghostwhite"=>"#f8f8ff","lavender"=>"#e6e6fa","lightsteelblue"=>"#b0c4de","slategray"=>"#708090","lightslategray"=>"#778899","indigo"=>"#4b0082","darkslateblue"=>"#483d8b","midnightblue"=>"#191970","navy"=>"#000080","darkblue"=>"#00008b","slateblue"=>"#6a5acd","mediumslateblue"=>"#7b68ee","cornflowerblue"=>"#6495ed","royalblue"=>"#4169e1","mediumblue"=>"#0000cd","blue"=>"#0000ff","thistle"=>"#d8bfd8","plum"=>"#dda0dd","orchid"=>"#da70d6","violet"=>"#ee82ee","fuchsia"=>"#ff00ff","magenta"=>"#ff00ff","mediumpurple"=>"#9370db","mediumorchid"=>"#ba55d3","darkorchid"=>"#9932cc","blueviolet"=>"#8a2be2","darkviolet"=>"#9400d3","purple"=>"#800080","darkmagenta"=>"#8b008b","mediumvioletred"=>"#c71585");


$color_en = array("american red" => "#bf0a30","american blue" => "#002868","american green" => "#006e53","american yellow" => "#deb301","american light blue" => "#cbddf3","american brown" => "#9a6b37","american gray" => "#afafb1","glory red" => "#cc0033","glory blue" => "#0000ff","glory white" => "#fff9f5","big apple red" => "#ff6331","big apple blue" => "#3131ce","empire blue" => "#001873","empire cyan" => "#00b5d6","empire red" => "#d60000","empire yellow" => "#f7f700","empire orange" => "#f79429","empire green" => "#084a29","empire ebony" => "#424a00","natural red" => "#cc0033","natural blue" => "#000099","natural light blue" => "#84c8ef","natural green" => "#90c924","natural orange" => "#f39234","natural brown" => "#843a2f","natural gray" => "#bfbfbf","hawkeye red" => "#e3003d","hawkeye blue" => "#3c3c9e","hawkeye yellow" => "#ffb30f","hawkeye brown" => "#a54a00","frontier blue" => "#000080","frontier light blue" => "#d3eef7","frontier green" => "#024900","frontier yellow" => "#ffff00","frontier purple" => "#8663bd","dixie red" => "#b10021","dixie blue" => "#083152","dixie green" => "#105a21","dixie yellow" => "#ffc621","grand canyon blue" => "#002868","grand canyon red" => "#bf0a30","grand canyon brown" => "#ce5c17","grand canyon yellow" => "#fed700","grand canyon green" => "#00320b","grand canyon pink" => "#efc1a9","lincoln red" => "#e2184f","lincoln pink" => "#e24a4f","lincoln light blue" => "#64b4ff","lincoln blue" => "#3c3c9e","lincoln green" => "#3f863f","lincoln yellow" => "#ffe60f","lincoln orange" => "#ffb316","hoosier blue" => "#101195","hoosier yellow" => "#ffe700","hoosier green" => "#197351","hoosier brown" => "#563837","badger blue" => "#002986","badger light blue" => "#00b2fd","badger pink" => "#f8b8de","badger red" => "#f3334b","badger green" => "#41ad16","badger yellow" => "#ffe618","badger brown" => "#66180b","badger gray" => "#a2b9b9","mountain red" => "#ff3516","mountain blue" => "#003776","mountain green" => "#20d942","mountain yellow" => "#ffb30f","mountain brown" => "#d15b25","mountain gray" => "#c0c0c0","sooner blue" => "#0e4892","sooner light blue" => "#00adc6","sooner green" => "#1b692b","sooner opal" => "#8ab87a","sooner yellow" => "#f0c016","sooner brown" => "#421000","sooner beige" => "#ffc69c","sooner gray" => "#d6c6c6","sooner black" => "#454442","buckeye blue" => "#1a3b86","buckeye red" => "#ff0000","buckeye green" => "#00784b","buckeye yellow" => "#f8c300","buckeye brown" => "#4e3330","buckeye light blue" => "#027bc2","beaver blue" => "#002a86","beaver yellow" => "#ffea0f","golden red" => "#c10435","golden green" => "#007e3a","golden brown" => "#391800","golden yellow" => "#bc8e07","golden cyan" => "#40a7aa","golden gray" => "#84948e","sunflower blue" => "#00009c","sunflower light blue" => "#0092df","sunflower green" => "#29b910","sunflower orange" => "#ff660f","sunflower brown" => "#b34e20","sunflower purple" => "#7c4790","sunflower yellow" => "#ffe400","sunflower gray" => "#dedede","new england" => "#e25c5c","midatlantic" => "#5c7a7a","south" => "#8a84a3","florida" => "#e9bda2","midwest" => "#ffd577","texas" => "#77cbb3","great plains" => "#b6bc4d","rocky mountain" => "#e9df25","southwest" => "#ee2222","california" => "#e0fa92","pacific northwest" => "#38911c","alaska" => "#d09440","hawaii" => "#4f93c0","mountains alabama" => "#999966","metropolitan alabama" => "#ff9933","river heritage alabama" => "#996699","gulf coast alabama" => "#99cccc","southern california" => "#e03030","california desert" => "#e0b000","california central coast" => "#00b000","san joaquin valley" => "#a0a0c0","sacramento valley" => "#e0b000","sierra nevada" => "#00e000","gold country" => "#e0e000","bay area california" => "#e06060","california north coast" => "#b0b000","shasta cascades" => "#e03030","mississippi capital river" => "#336699","mississippi delta" => "#663366","mississippi pines" => "#339966","gulf coast mississippi" => "#660033","mississippi hills" => "#996633","panhandle nebraska" => "#cc9966","north central nebraska" => "#cccc66","eastern nebraska" => "#99cccc","western nevada" => "#cc9999","northern nevada" => "#cc9966","central nevada" => "#9999cc","southern nevada" => "#99cccc","central new mexico" => "#e0fa92","north central new mexico" => "#6699aa","northeast new mexico" => "#b6bc4d","northwest new mexico" => "#d09440","southwest new mexico" => "#b2cc7f","southeast new mexico" => "#ffff99","northwest ohio" => "#666633","northeast ohio" => "#669999","midohio" => "#996666","southwest ohio" => "#666699","southeast ohio" => "#cc9933","western tennessee" => "#996699","central tennessee" => "#339999","eastern tennessee" => "#339966","panhandle texas" => "#80622f","prairies and lakes" => "#335c64","piney woods" => "#406324","gulf coast texas" => "#7895a3","south texas plains" => "#7d6b71","hill country" => "#d1a85e","big bend country" => "#c6ab7a","wasatch front" => "#99cc33","canyon country" => "#cc6600","northeastern utah" => "#669900","dixie" => "#b2cc7f","central utah" => "#999933","western utah" => "#ffff99","northern virginia" => "#9966ff","eastern virginia" => "#33bbee","central virginia" => "#ff6655","southwest virginia" => "#ffcc33","shenandoah valley" => "#339933","southeast wisconsin" => "#66cc99","southwest wisconsin" => "#99ccff","northeast wisconsin" => "#009999","north central wisconsin" => "#66ccff","northwest wisconsin" => "#99cccc");

    $result ='<select name="'.$name.'" size="4" style="width:150px;vertical-align:bottom;margin-bottom:0px;height:100px;">';

    $scheme = COLOR_SCHEME;
    $current_color = array_search($current_val,$$scheme);
    $result .= '<option value="'.$current_val.'" style="background:'.$current_val.'" selected="selected">'.$current_color.'</option>';

        foreach($$scheme as $key=>$val){

            $cr = hexdec(substr($val,1,2))*0.5;
            $cg = hexdec(substr($val,3,2))*0.5;
            $cb = hexdec(substr($val,5,2))*0.5;

            if($cr+$cg+$cb < 128){
                $color = "#ccc";
            }else{
                if($cr > $cg and $cg > $cb){

                $color = "#".dechex($cb).dechex($cg).dechex($cr);

                }elseif($cr > $cb and $cb > $cg){
                    $color = "#".dechex($cg).dechex($cb).dechex($cr);
                }elseif( $cg > $cr and $cr > $cb){
                    $color = "#".dechex($cb).dechex($cg).dechex($cg);
                }elseif( $cg > $cb and $cb > $cr ){
                    $color = "#".dechex($cr).dechex($cb).dechex($cg);
                }elseif( $cb > $cg and $cg > $cr ){
                    $color = "#".dechex($cr).dechex($cg).dechex($cb);
                }elseif( $cb > $cr and $cr > $cg ){
                    $color = "#".dechex($cg).dechex($cr).dechex($cb);
                }else{
                    $color = "#000";

                }
            }

            $result .= '<option value="'.$val.'" style="background:'.$val.';color:'.$color.'">'.$key.'</option>';

        }

        $result .='</select>';

        return $result;

    }
}


function design_output($name="default",$position_y = 1){

    global $images_path;
    global $navigation_title_img;
    $c_border   = colors(0,'background');

    $rgba_border = hex2rgba($c_border,0.5);
    $c_5        = colors(-5);
    $c_4        = colors(-4);
    $c_3        = colors(-3);
    $c_2        = colors(-2);
    $c_1        = colors(-1);
    $c5         = colors(5);
    $c4         = colors(4);
    $c3         = colors(3);
    $c2         = colors(2);
    $c1         = colors(1);


    $y = $position_y * 26;
    $y = '-'.$y.'px';

    switch( $position_y ){
        case(0):
            $h_position_rsidebar_h2 = "background-position:0 0";
            $color = "color:#333333;";
        break;
        case(1):
            $h_position_rsidebar_h2 = "background-position:0 $y;";
            $color = "color:#333333;";
        break;
        case(2):
            $h_position_rsidebar_h2 = "background-position:0 $y;";
            $color = "color:#333333;";
        break;
        case(3):
            $h_position_rsidebar_h2 = "background-position:0 $y;";
            $color = "color:#333333;";
        break;
        case(4):
            $h_position_rsidebar_h2 = "background-position:0 $y;";
            $color = "color:#333333;";
        break;
        case(5):
            $h_position_rsidebar_h2 = "background-position:0 $y;";
            $color = "color:#333333;";
        break;
        case(6):
            $h_position_rsidebar_h2 = "background-position:0 $y;";
            $color = "color:#333333;";
        break;
        case(7):
            $h_position_rsidebar_h2 = "background-position:0 $y;";
            $color = "color:#333333;";
        break;
        default:
            $h_position_rsidebar_h2 = "background-position:0 208px;";
        break;


    }

    global $tmn_header_image;
    global $tmn_header_color;
    global $tmn_footer_image;
    global $tmn_footer_color;

    $h2_default_background = "background:".colors(3,background).' ';
    $h2_default_background .= "url({$images_path}{$navigation_title_img});";
    $h2_default_background .= "color:".colors(3,color).';';

    //$h2_dark_background = "background:".colors(-3,background).' ';
    $h2_dark_background .= "url({$images_path}{$navigation_title_img});";
    $h2_dark_background .= "color:".colors(-3,color).';';

    //$h2_light_background = "background:".colors(3,background).' ';
    $h2_light_background .= "url({$images_path}{$navigation_title_img});";
    $h2_light_background .= "color:".colors(3,color).';';


$default =<<<DEFAULT
body {

margin:0!important;padding:0;
background-repeat:repeat-x;
color:$tmn_header_color;
}
#hd{
background-image:url({$images_path}{$tmn_header_image});


}

#ft {
background:url({$images_path}{$tmn_footer_image}) repeat-x;
color:$tmn_footer_color;

}

.rsidebar h2,.lsidebar h2 {
$h2_default_background
$h_position_rsidebar_h2
}
.home .sticky {
background: $c4
border-top:solid 6px $rgba_border;

}
.social textarea#comment,
.social input[type="text"] {
    outline:none;
    transition: all 0.25s ease-in-out;
    -webkit-transition: all 0.25s ease-in-out;
    -moz-transition: all 0.25s ease-in-out;
    border-radius:3px;
    -webkit-border-radius:3px;
    -moz-border-radius:3px;
    border:1px solid rgba(203,203,203, 0.5);
    background: $c3

}

.social textarea#comment:focus,
.social input:focus{
    box-shadow: 0 0 5px rgba(0, 0, 255, 1);
    -webkit-box-shadow: 0 0 5px rgba(0, 0, 255, 1);
    -moz-box-shadow: 0 0 5px rgba(0, 0, 255, 1);
    border:1px solid rgba(0,0,255, 0.8);
    background: $c4

}
.entry-content input[type="submit"],
.entry-content input[type="reset"],
.entry-content input[type="file"]{

border:double 3px $rgba_border;
background: $c4
}
.entry-content input[type="submit"],
.entry-content input[type="radio"]{
background: $c3
border:double 3px $rgba_border;
}
.entry-content select{
background: $c4
border:double 3px $rgba_border;
}

.entry-content blockquote {
    border-top:double 3px $c_border;
    border-bottom:double 3px $c_border;
    border-top:double 3px $rgba_border;
    border-bottom:double 3px $rgba_border;

    $c4
}
.entry-content fieldset {
    border:1px solid $rgba_border;
}
.entry-content legend{
    $c5
}

.entry-content td{
    $c4
    border:solid 1px $rgba_border;
}
.entry-content th{
    $c3
    border:solid 1px $rgba_border;
}
.entry-content tr:nth-child(even) {
    background-color:rgba(255,255,255,0.3);
}
/*--------------------------------*/
#access{
    $c3

}
#access a {
    $c3


}
#access ul ul a {

    $c3
    border:1px solid $rgba_border;

}
#access li:hover > a,
#access ul ul :hover > a {
    $c2

}

#access ul li.current_page_item > a,
#access ul li.current-menu-ancestor > a,
#access ul li.current-menu-item > a,
#access ul li.current-menu-parent > a {
    border:1px solid $rgba_border;

    $c3
}
* html #access ul li.current_page_item a,
* html #access ul li.current-menu-ancestor a,
* html #access ul li.current-menu-item a,
* html #access ul li.current-menu-parent a,
* html #access ul li a:hover {
    border:1px solid $rgba_border;

    $c2
}

DEFAULT;


/**
 *
 *
 *
 *
 */


$dark =<<<DARK

body{
    $c_4

}
#top{

    $c_3
    border-bottom: medium solid $c_border;


}

h2 a{
    background:inherit;

}
.entry div h2,.entry div h3{
    $face-3

}
.entry ol ol ,.entry ul {
    $c_5
}
.entry ul * {
    $c_5
}

.home .sticky {
background: $c_4
border-top:solid 6px $rgba_border;

}

#yui-main{

background: $c_5

}
#hd{
    $c_3
    background-image:url({$images_path}{$tmn_header_image});


}

#hd h1,.h1,#site-title{
    $c_3
    background:none;

}

#site-description{
    $c_3
    background:none;
}
#doc,#doc2,#doc3,#doc4{
    $c_5
}
#nav{
    $c_3
}
ul.nav{
    $c_3
}
ul.nav li a,ul.nav li a:link,ul.nav li a:visited{
    $c_4
}
ul.nav li a:hover,ul.nav li a:active{
    $c_4
}
#sidebar{
    $c_5

}
.rsidebar{
    $c_5
}
.rsidebar h2,.lsidebar h2{
    $face-3
}
ol.commentlist :hover{
    background:url({$images_path}latestbck.gif) repeat-x;
    }
ol.commentlist li :hover{background:none;}

ol.tblist li{
    background:transparent url({$images_path}c.gif) 0 2px no-repeat;
    }
#ft{
    $c_3
border-top: medium solid $c_border;
background:url({$images_path}{$tmn_footer_image}) repeat-x;
color:$tmn_footer_color;
}
.lsidebar{
    $c_5
}

.rsidebar h2,.lsidebar h2 {
$h2_dark_background
}
a:link,a:active,a:visited,a:hover{
    $c_5
}

#hd h1 a:link,#hd h1 a:active,#hd h1 a:visited,#hd h1 a:hover{
    $c_3
    background:none;
}

.rsidebar ul li ul li,
.lsidebar ul li ul li{
    border-bottom:1px solid $c_border;
    border-bottom:1px solid $rgba_border;
    }
dl.author dd,
dl.author dt,
dl.my_tags dd,
dl.my_tags dt{
    border-bottom:1px solid $c_border;
    }
#items li{
    border-bottom:1px solid $c_border;
    }
.attachment .caption dd{
    border-bottom:1px solid $c_border;
    }
.attachment .caption dt{
    border-bottom:double 3px $c_border;
    }
ul.archive,ul.index{
    margin:2em 0;border-bottom:
    1px solid $c_border;
    border-bottom:1px solid $rgba_border;

    }
.sitemap.new li{
    border-bottom:1px solid $c_border;
    }
.social{

    border-top:3px double $c_border;
    border-bottom:3px double $c_border;
    border-bottom:3px double $rgba_border;
    border-top:3px double $rgba_border;

    }

ul.all_entry h2{
    border-bottom:3px double $c_border;
    }
ul.category li{
    border-bottom:1px solid $c_border;
    border-bottom:1px solid $rgba_border;

    }

ul.sitemap ul li,
ul.archive ul li {
    border-bottom:1px solid $c_border;
    }
.blog .entry-utility li{
    border-bottom:1px solid $c_border;
    }
.mycomment{
    border-bottom:1px dashed $c_border;
    }
.blog .entry-utility li{
    border-bottom:1px solid $c_border;
}
hr{
border:none;
border-top:1px solid $c_border;
border-top:1px solid $rgba_border;
}
ul.archive li,
ul.index li{
    border-top:1px solid $c_border;
    border-top:1px solid $rgba_border;

}
.itiran{
    border:1px solid $c_border;
}
.pagenate{
    /*$c_3*/
    $face-3
}

#month_list td,#year_list td,#calendar_wrap td{
    border:1px solid $rgba_border;
}
td.month-date,td.month-name,td.time{
    $c_3
    border:1px solid $rgba_border;

}
.footer-widget h2{
background:none;

}
blockquote {
    border-top:double 3px $c_border;
    border-bottom:double 3px $c_border;
    border-top:double 3px $rgba_border;
    border-bottom:double 3px $rgba_border;

    $c_4
}
fieldset {
    border:1px solid $rgba_border;
}
legend{
    $c_5
}

.social textarea#comment,
.social input[type="text"] {
    outline:none;
    transition: all 0.25s ease-in-out;
    -webkit-transition: all 0.25s ease-in-out;
    -moz-transition: all 0.25s ease-in-out;
    border-radius:3px;
    -webkit-border-radius:3px;
    -moz-border-radius:3px;
    border:1px solid rgba(203,203,203, 0.5);
    background: $c3

}

.social textarea#comment:focus,
.social input:focus{
    box-shadow: 0 0 5px rgba(0, 0, 255, 1);
    -webkit-box-shadow: 0 0 5px rgba(0, 0, 255, 1);
    -moz-box-shadow: 0 0 5px rgba(0, 0, 255, 1);
    border:1px solid rgba(0,0,255, 0.8);
    background: $c4

}
.social input[type="submit"] {

border:double 3px $rgba_border;
background: $c3
}
.entry-content td{
    $c4
    border:solid 1px $rgba_border;
}
.entry-content th{
    $c3
    border:solid 1px $rgba_border;
}
.entry-content input[type="submit"],
.entry-content input[type="reset"],
.entry-content input[type="file"]{

border:double 3px $rgba_border;
background: $c3
}
.entry-content input[type="checkbox"],
.entry-content input[type="radio"]{
background: $c3
border:double 3px $rgba_border;
}
.entry-content select{
background: $c3
border:double 3px $rgba_border;
}
.entry-content textarea{
background: $rgba_border
border:double 3px $rgba_border;
}
/*--------------------------------*/
#access{
    $c_5

    border-bottom:1px solid $rgba_border;

}
#access a {
    $c_4
    border-top:1px solid $rgba_border;
    border-bottom:1px solid $rgba_border;

}
#access ul ul a {

    $c_3
    border:1px solid $rgba_border;

}
#access li:hover > a,
#access ul ul :hover > a {
    $c_2
        border:1px solid $rgba_border;
}
#access ul li.current_page_item > a,
#access ul li.current-menu-ancestor > a,
#access ul li.current-menu-item > a,
#access ul li.current-menu-parent > a {
    border:1px solid $rgba_border;

    $c_3
}
* html #access ul li.current_page_item a,
* html #access ul li.current-menu-ancestor a,
* html #access ul li.current-menu-item a,
* html #access ul li.current-menu-parent a,
* html #access ul li a:hover {
    border:1px solid $rgba_border;

    $c_2
}
DARK;

/**
 *
 *
 *
 *
 */

$light =<<<LIGHT


body{
    margin:0!important;
    $c4
}
#top{
    $c3
    border-bottom: medium solid $c_border;
}
h2,h3{
    $c5
}
.home .sticky {
background: $c4
border-top:solid 6px $rgba_border;

}
.home .sticky a{
background: none;

}

.entry div h2,.entry div h3{
    $c5
}
.entry ol ol ,.entry ul {
    $c5
}
.entry ul *{
    $c5
}

#hd{
    $c3
    background-image:url({$images_path}{$tmn_header_image});

}
#hd h1,.h1,#site-title{
    $c3
    background:none;

}
#site-description{
    $c3
    background:none;

}
#doc,#doc2,#doc3,#doc4{
    $c5
}
div#bd{

}
#nav{
    $c3
}
ul.nav{
    $c3
}
ul.nav li a,ul.nav li a:link,ul.nav li a:visited{
    $c_4
}
ul.nav li a:hover,ul.nav li a:active{
    $c4
}
#sidebar{
    $c5
    border-color:$rgba_border;
}

.rsidebar{
    $c5
}
.rsidebar h2,
.lsidebar h2{
    $h2_light_background;

}


.postmetadata{
    $c5
}

ol.commentlist :hover{background:url({$images_path}latestbck.gif) repeat-x;}
ol.commentlist li :hover{background:none;}
ol.tblist li{background:transparent url({$images_path}c.gif) 0 2px no-repeat;}

#ft{
    $c3
    border-top: medium solid $c_border;
    background:url({$images_path}{$tmn_footer_image}) repeat-x;
    color:$tmn_footer_color;

}

/*.lsidebar h2{
    $h2_light_background

}*/
.rsidebar h2,.lsidebar h2 {
$h2_default_background
$h_position_rsidebar_h2
}

a:link,a:active,a:visited,a:hover{
    $c5
}
#hd h1 a:link,#hd h1 a:active,#hd h1 a:visited,#hd h1 a:hover{
    $c3
    background:none;
}

.rsidebar ul li ul li,
.lsidebar ul li ul li{
    border-bottom:1px solid $c_border;
    border-bottom:1px solid $rgba_border;
}

dl.author dd,
dl.author dt,
dl.my_tags dd,
dl.my_tags dt{
border-bottom:1px solid $c_border;
}

#items li{
border-bottom:1px solid $c_border;
}
.attachment .caption dd{
border-bottom:1px solid $c_border;
}
.attachment .caption dt{
border-bottom:double 3px $c_border;
}
ul.archive,
ul.index{
    margin:2em 0;
    border-bottom:1px solid $c_border;
    border-bottom:1px solid $rgba_border;

}
.sitemap.new li{
border-bottom:1px solid $c_border;
}
.social{
    border-top:3px double $c_border;border-bottom:3px double $c_border;
    border-bottom:3px double $c_border;
    border-bottom:3px double $rgba_border;
    border-top:3px double $rgba_border;

}

ul.all_entry h2{
border-bottom:3px double $c_border;
}
ul.category li{
    border-bottom:1px solid $c_border;
    border-bottom:1px solid $rgba_border;

}
ul.sitemap ul li,
ul.archive ul li {
    border-bottom:1px solid $c_border;
}
.blog .entry-utility li{
    border-bottom:1px solid $c_border;
}
.mycomment{
    border-bottom:1px dashed $c_border;
}
.blog .entry-utility li{
    border-bottom:1px solid $c_border;
}

hr{
    border:none;border-top:1px solid $c_border;
    border-top:1px solid $rgba_border;

}
ul.archive li,
ul.index li{
    border-top:1px solid $c_border;
    border-top:1px solid $rgba_border;

}
.itiran{
    border:1px solid $c_border;
}

#month_list td,#year_list td,#calendar_wrap td{
    border:1px solid $rgba_border!important;
}
td.month-date,td.month-name,td.time{
    $c_3
    border:1px solid $rgba_border;

}

td.month-date,td.month-name,td.time{
    $c3
}

.footer-widget h2{
background:none;

}
blockquote {
    border-top:double 3px $c_border;
    border-bottom:double 3px $c_border;
    border-top:double 3px $rgba_border;
    border-bottom:double 3px $rgba_border;

    background:#fefefe;
}
fieldset {
    border:1px solid $rgba_border;
}
legend{
    $c5
}
.social textarea#comment,.social input[type="text"]{
    outline:none;
    transition: all 0.25s ease-in-out;
    -webkit-transition: all 0.25s ease-in-out;
    -moz-transition: all 0.25s ease-in-out;
    border-radius:3px;
    -webkit-border-radius:3px;
    -moz-border-radius:3px;
    border:1px solid rgba(0,0,0, 0.2);
}

.social textarea#comment:focus,.social input[type="text"]{
    box-shadow: 0 0 5px rgba(0, 0, 255, 1);
    -webkit-box-shadow: 0 0 5px rgba(0, 0, 255, 1);
    -moz-box-shadow: 0 0 5px rgba(0, 0, 255, 1);
    border:1px solid rgba(0,0,255, 0.8);
}
.social input[type="submit"] {
    border:double 3px $rgba_border;
    background: $c4
}

.entry-content td{
    $c4
    border:solid 1px $rgba_border;
}
.entry-content th{
    $c3
    border:solid 1px $rgba_border;
}
.entry-content input[type="submit"],
.entry-content input[type="reset"],
.entry-content input[type="file"]{

border:double 3px $rgba_border;
background: $c4
}
.entry-content input[type="checkbox"],
.entry-content input[type="radio"]{
background: $c4
border:double 3px $rgba_border;
}
.entry-content select{
background: $c4
border:double 3px $rgba_border;
}
.entry-content textarea{
background: $rgba_border
border:double 3px $rgba_border;
}
/*--------------------------------*/
#access{
    $c3

}
#access a {
    $c3

}
#access ul ul a {

    $c3

}
#access li:hover > a,
#access ul ul :hover > a {
    $c2
}
#access ul li.current_page_item > a,
#access ul li.current-menu-ancestor > a,
#access ul li.current-menu-item > a,
#access ul li.current-menu-parent > a {

    $c3
}
* html #access ul li.current_page_item a,
* html #access ul li.current-menu-ancestor a,
* html #access ul li.current-menu-item a,
* html #access ul li.current-menu-parent a,
* html #access ul li a:hover {

    $c2
}
LIGHT;


if(isset($$name)){
return apply_filters("raindrops_colors", $$name );
    //return $$name;
}else{
    return false;
}

}



function add_raindrops_stylesheet() {

global $wpdb;

    $raindrops_url  = get_bloginfo('stylesheet_directory') . '/lib/style.php';
    $raindrops_file = STYLESHEETPATH. '/lib/style.php';

    if ( file_exists($raindrops_file) ) {
        wp_register_style('raindrops_style_sheet', $raindrops_url,array(),'0.1','all');
        wp_enqueue_style( 'raindrops_style_sheet');
    }

    $stylesheet_name = 'b'.str_replace("wp","",$wpdb->prefix).'-csscolor.css';
    $raindrops_url  = get_bloginfo('stylesheet_directory') . '/lib/' .INDIVIDUAL_STYLE;
    $raindrops_file = STYLESHEETPATH . '/lib/' .INDIVIDUAL_STYLE;

    if ( file_exists($raindrops_file) ) {
        wp_register_style('raindrops_individual_style_sheet', $raindrops_url,array(),time(),'all');
        wp_enqueue_style( 'raindrops_individual_style_sheet');
    }
}



function tmn_comment_form($form){
global $commenter;
$form['url'] = '<p class="comment-form-url"><label for="url">' . __( 'Website' ) . '</label><span class="option">'.__('Option','Raindrops').'</span><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>';

return $form;
}
?>