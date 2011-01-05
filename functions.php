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

    if(!defined('TMN_USE_AUTO_COLOR')){
        define("TMN_USE_AUTO_COLOR",true);
    }

    if(!defined('TMN_COLOR_SCHEME')){
        define("TMN_COLOR_SCHEME","color_ja");
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
        define("TMN_THE_TIME_FORMAT",'Y/n/j');//

    }
    if(!defined('TMN_THE_MONTH_FORMAT')){
        define("TMN_THE_MONTH_FORMAT",'Y/m');//archive.php

    }


    add_editor_style();
    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'primary' => __( 'Primary Navigation', 'Raindrops' ),
    ) );

    // This theme allows users to set a custom background
    add_custom_background();



    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 48, 48, true );
    add_image_size( 'single-post-thumbnail', 600, 400, true);

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
            'description' => __( 'Raindrops', 'Raindrops' )
        )

    ) );
}


    load_textdomain( 'Raindrops', get_template_directory().'/languages/'.get_locale().'.mo' );


    add_filter( 'comment_form_default_fields','tmn_comment_form');
    add_filter( 'the_meta_key', 'filter_explode_meta_keys', 10, 2 );
    add_filter('body_class','add_body_class');
    add_filter('contextual_help','raindrops_help');
    add_filter('comment_form_field_comment','custom_remove_aria_required1');
    add_filter('comment_form_default_fields', 'custom_remove_aria_required2');
    add_filter( 'the_meta_key', 'filter_explode_meta_keys', 10, 2 );

    if ( !is_admin()) {
        wp_register_script('raindrops_script',get_stylesheet_directory_uri() .'/lib/script.php',array('jquery'),'0.1' );
        wp_enqueue_script('raindrops_script');

        add_action('wp_print_styles', 'add_raindrops_stylesheet');

    }

        $is_submenu = new tmn_menu_create;
        add_action('admin_menu', array($is_submenu, 'add_menus'));
        add_action('admin_menu', 'setup_raindrops');




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

        register_sidebar(
          array (
          'name' => __('Footer Widget'),
          'id' => 'sidebar-4',
          'before_widget' => '<li class="widget footer-widget">',
          'after_widget' => '</li>',
          'before_title' => '<h2 class="widgettitle footer-widget h2">',
          'after_title' => '</h2>',
          'widget_id' => 'footer',
          'widget_name' => 'footer',
          'text' => "4"));
        register_sidebar(
          array (
          'name' => __('Category Blog Widget'),
          'id' => 'sidebar-5',
          'before_widget' => '<li class="widget category-blog-widget">',
          'after_widget' => '</li>',
          'before_title' => '<h2 class="widgettitle category-blog-widget h2">',
          'after_title' => '</h2>',
          'widget_id' => 'categoryblog',
          'widget_name' => 'categoryblog',
          'text' => "5"));

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
    array('option_id' =>'null','blog_id' => 0 ,'option_name' => "raindrops_footer_color",'option_value' => "",'autoload'=>'yes'),
    array('option_id' =>'null','blog_id' => 0 ,'option_name' => "raindrops_show_right_sidebar",'option_value' => "show",'autoload'=>'yes'),
    array('option_id' =>'null','blog_id' => 0 ,'option_name' => "raindrops_right_sidebar_width_percent",'option_value' => "25",'autoload'=>'yes'),

        );

}


if(TMN_USE_AUTO_COLOR == true and is_admin() == true){

    include_once(STYLESHEETPATH."/lib/csscolor.css.php");
}

if (!function_exists('add_body_class')) {
function add_body_class($class) {

    /**
     * body class addlang
     *
     *example
     *
     *$classes= array('class1','class2');
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
            preg_match(" |(MSIE )([0-9])(\.)|si",$_SERVER['HTTP_USER_AGENT'],$regs);
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
      <div style="width:40px;float:left"> <?php echo get_avatar( $comment, 32 ); ?> </div>
      <div style="overflow:hidden;*width:100%;padding-left:1em;" class="clearfix"> <?php printf( __( '%s <span class="says">says:</span>', 'Raindrops' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?> </div>
    </div>
    <!-- .comment-author .vcard -->
    <?php if ( $comment->comment_approved == '0' ) : ?>
    <div style="overflow:hidden;*width:100%;padding-left:1em;" class="clearfix"> <em>
      <?php _e( 'Your comment is awaiting moderation.', 'Raindrops' ); ?>
      </em> <br />
    </div>
    <?php endif; ?>
    <div class="comment-meta commentmetadata clearfix" style="overflow:hidden;*width:100%;padding-left:1em;"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
      <?php
                    /* translators: 1: date, 2: time */
                    printf( __( '%1$s at %2$s', 'Raindrops' ), get_comment_date(),  get_comment_time() ); ?>
      </a>
      <?php edit_comment_link( __( '(Edit)', 'Raindrops' ), ' ' );
                ?>
    </div>
    <!-- .comment-meta .commentmetadata -->
    <div class="comment-body">
      <?php comment_text(); ?>
    </div>
    <div class="reply">
      <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    </div>
    <!-- .reply -->
  </div>
  <!-- #comment-##  -->
  <?php else : ?>
<li class="post pingback">
  <p>
    <?php _e( 'Pingback:', 'Raindrops' ); ?>
    <?php comment_author_link(); ?>
    <?php edit_comment_link( __('(Edit)', 'Raindrops'), ' ' ); ?>
  </p>
  <?php endif;
    }

}


if (!function_exists('raindrops_posted_in')) {

    function raindrops_posted_in() {
        // Retrieves tag list of current post, separated by commas.

        $tag_list = get_the_tag_list( '', ', ' );
        if ( $tag_list ) {
            $posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'Raindrops' );
        } elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
            $posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'Raindrops' );
        } else {
            $posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'Raindrops' );
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
        printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'Raindrops' ),
            'meta-prep meta-prep-author',
            sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
                get_permalink(),
                esc_attr( get_the_time(get_option('date_format')) ),
                get_the_date()
            ),
            sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="vcard:url">%3$s</a></span>',
                get_author_posts_url( get_the_author_meta( 'ID' ) ),
                sprintf( esc_attr__( 'View all posts by %s', 'Raindrops' ), get_the_author() ),
                get_the_author()
            )
        );
    }

}


if (!function_exists('filter_explode_meta_keys')) {

    function filter_explode_meta_keys( $content, $key ) {
        $explode_keys = array( 'css', 'javascript', 'meta','embed','excerpt','template');
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













/**
 * warehouseget raindrops setting
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

$result = "<h2>".__('Raindrops Another Settings').'</h2>';


$result .= "<dl><dt><strong>".__('When you do not want to use the automatic color setting','Raindrops').'</strong></dt>';
$result .= "<dd><div class=\"icon32\" id=\"icon-options-general\"><br></div>".__('raindrops/functions.php TMN_USE_AUTO_COLOR value change false','Raindrops').'</dd><br style="clear:both;">';

$result .= "<dt><strong>".__('When you want to display the custom header image','Raindrops').'</strong></dt>';
$result .= "<dd><div class=\"icon32\" id=\"icon-themes\"><br></div>".__('raindrops/functions.php SHOW_HEADER_IMAGE value change true','Raindrops').'</dd><br style="clear:both;">';


$result .= "<p>".sprintf(__('WEBSite:<a href="%1$s">%2$s</a>'),'http://www.tenman.info/wp3/raindrops','Raindrops').'</p>';


        return apply_filters("raindrops_help",$result);

    }else{

        return $text;
    }

    }

}
    add_filter('contextual_help','raindrops_edit_help');

if (!function_exists('raindrops_edit_help')) {


    function raindrops_edit_help($text){
    global $post_type_object;
    global $title;

    if(isset($post_type_object) and ($title == $post_type_object->labels->add_new_item or $title == $post_type_object->labels->edit_item)){

$result = "<h2>".__('Tips',"Raindrops").'</h2>';
$result .= '<p>'.__('If Raindrops Options panel is opened, and the reference color is set, this arrangement of color is changed at once.',"Raindrops")."</p>";
$result .= "<dl><dt><h3>".__('Dinamic Color Class','Raindrops').'</strong></h3>';
$result .= '<dd><table><tr>
<td style="'.colors(5,'set').'padding:0.5em;">class color5</td>
<td style="'.colors(4,'set').'padding:0.5em;">class color4</td>
<td style="'.colors(3,'set').'padding:0.5em;">class color3</td>
<td style="'.colors(2,'set').'padding:0.5em;">class color2</td>
<td style="'.colors(1,'set').'padding:0.5em;">class color1</td></tr><tr>
<td style="'.colors('-1','set').'padding:0.5em;">class color-1</td>
<td style="'.colors('-2','set').'padding:0.5em;">class color-2</td>
<td style="'.colors('-3','set').'padding:0.5em;">class color-3</td>
<td style="'.colors('-4','set').'padding:0.5em;">class color-4</td>
<td style="'.colors('-5','set').'padding:0.5em;">class color-5</td></tr>
<tr><td colspan="5">
'.__('code example:please HTML editor mode','Raindrops').'
<div  style="'.colors(2,'set').'padding:1em;">&lt;div class="color3"&gt;
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum&lt;/div&gt;
</div></td>
</tr></table>
</dd>';
$result .= "<dt><h3>".__('Dinamic Gradient Class','Raindrops').'</h3></dt>';
$result .= '<dd><table><tr>
<td style="'.tmn_gradient_single(1,"asc").'padding:0.5em;">class gradient5</td>
<td style="'.tmn_gradient_single(2,"asc").'padding:0.5em;">class gradient4</td>
<td style="'.tmn_gradient_single(3,"asc").'padding:0.5em;">class gradient3</td>
<td style="'.tmn_gradient_single(4,"asc").'padding:0.5em;">class gradient2</td>
<td style="'.tmn_gradient_single(5,"asc").'padding:0.5em;">class gradient1</td></tr><tr>
<td style="'.tmn_gradient_single(1,"desc").'padding:0.5em;">class gradient-1</td>
<td style="'.tmn_gradient_single(2,"desc").'padding:0.5em;">class gradient-2</td>
<td style="'.tmn_gradient_single(3,"desc").'padding:0.5em;">class gradient-3</td>
<td style="'.tmn_gradient_single(4,"desc").'padding:0.5em;">class gradient-4</td>
<td style="'.tmn_gradient_single(5,"desc").'padding:0.5em;">class gradient-5</td></tr>
<tr><td colspan="5">
'.__('code example:please HTML editor mode','Raindrops').'
<div  style="'.tmn_gradient_single(3,"asc").'padding:1em;">&lt;div class="gradient3"&gt;
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/div&gt;</div></td></tr></table></dd>';

$result .= "</dl>";
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




        /**
         * POSTGET
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


    echo '<div class="wrap"><div id="raindrops-header" style="height:100px">';
    echo '<div id="icon-options-general" class="icon32"><br></div>';
    echo '<h2>Raindrops theme Settings</h2>';
    echo "Saved Database table name:<strong>".TMN_PLUGIN_TABLE."</strong></div>";

    if(isset($_POST) and !empty($_POST)){

        if($ok){
            echo '<div id="message" class="updated fade"><p>'.sprintf(__('%1$s updated successfully.'),$option_name).'</p></div>';
        }else{
            echo '<div id="message" class="error fade"><p>'.__("Try again").'</p></div>';
        }
    }
    echo '</div>';
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

        $sql = 'SELECT * FROM `'.TMN_PLUGIN_TABLE.'` WHERE `option_name` LIKE \'raindrops%\' order by `option_id` ASC';
        $results = $wpdb->get_results($sql);

$lines = "";
        $table = "<table class=\"widefat post fixed\" cellspacing=\"0\" style=\"margin-left:2em;width:90%;\">";




        foreach($results as $key=>$result){
$excerpt = "";
        switch($result->option_name){

        case("raindrops_col_width"):

        $excerpt = '<h3 style="position:relative;top:-0.3em;padding-bottom:0.6em;text-indent:1em;cursor:auto;background:none;">'.__('Width of Column Setting','Raindrops').'</h3>';
        break;
        case("raindrops_page_width"):

        $excerpt = '<h3 style="position:relative;top:-0.3em;padding-bottom:0.6em;text-indent:1em;cursor:auto;background:none;">'.__('Width of page Setting','Raindrops').'</h3>';


        break;
        case("raindrops_right_sidebar_width_percent"):

        $excerpt = '<h3 style="position:relative;top:-0.3em;padding-bottom:0.6em;text-indent:1em;cursor:auto;background:none;">'.__('Ratio to text when extra sidebar is displayed Setting','Raindrops').'</h3>';

        break;
        case("raindrops_show_right_sidebar"):

        $excerpt = '<h3 style="position:relative;top:-0.3em;padding-bottom:0.6em;text-indent:1em;cursor:auto;background:none;">'.__('Display of extra sidebar Setting','Raindrops').'</h3>';


        break;
        case("raindrops_footer_color"):

        $excerpt = '<h3 style="position:relative;top:-0.3em;padding-bottom:0.6em;text-indent:1em;cursor:auto;background:none;">'.__('Footer Fonts Color Setting','Raindrops').'</h3>';


        break;
        case("raindrops_default_fonts_color"):

        $excerpt = '<h3 style="position:relative;top:-0.3em;padding-bottom:0.6em;text-indent:1em;cursor:auto;background:none;">'.__('Default Fonts Color Setting','Raindrops').'</h3>';


        break;
        case("raindrops_col_width"):

        $excerpt = '<h3 style="position:relative;top:-0.3em;padding-bottom:0.6em;text-indent:1em;cursor:auto;background:none;">'.__('Width of Column Setting','Raindrops').'</h3>';


        break;

        case("raindrops_base_color"):

        $excerpt = '<h3 style="position:relative;top:-0.3em;padding-bottom:0.6em;text-indent:1em;cursor: auto;background:none;">'.__('Base color Setting','Raindrops').'</h3>';
        $excerpt .= '<p>'.__('The reference color of an automatic arrangement of color is decided.','Raindrops').'</p>';

        $excerpt .= '<div style="border:1px solild #999;padding:2em;">'.__('If it wants you other arrangement of color sets ..you.., themes/functions.php is opened, and it is ..value of const COLOR_SCHEME.. revokable. In default, color_en or color_en_140 can be set. ','Raindrops').'</div>';

        break;
        case("raindrops_style_type"):

        $excerpt = '<h3 style="position:relative;top:-0.3em;padding-bottom:0.6em;text-indent:1em;cursor:auto;background:none;">'.__('Base color Setting','Raindrops').'</h3>';
        $excerpt .= '<p>'.__('The mood like dark atmosphere and the bright note, etc. is decided.','Raindrops').'</p>';


        break;
        case("raindrops_header_image"):

        $excerpt = '<h3 style="position:relative;top:-0.3em;padding-bottom:0.6em;text-indent:1em;cursor:auto;background:none;">'.__('Header image Setting','Raindrops').'</h3>';
        $excerpt .= '<p>'.__('The name of the picture file used for the header is set. ','Raindrops').'</p>';
        $excerpt .= '<p>'.__('As for the image, the image that exists in themes/raindrops/image/is used.','Raindrops').'</p>';
        break;
        case("raindrops_footer_image"):

        $excerpt = '<h3 style="position:relative;top:-0.3em;padding-bottom:0.6em;text-indent:1em;cursor:auto;background:none;">'.__('Footer image Setting','Raindrops').'</h3>';
        $excerpt .= '<p>'.__('The name of the picture file used for the footer is set. ','Raindrops').'</p>';
        $excerpt .= '<p>'.__('As for the image, the image that exists in themes/raindrops/image/is used.','Raindrops').'</p>';


        break;
        case("raindrops_heading_image_position"):

        $excerpt = '<h3 style="position:relative;top:-0.3em;padding-bottom:0.6em;text-indent:1em;cursor:auto;background:none;">'.__('h2 headding image position Setting','Raindrops').'</h3>';
        $excerpt .= '<p>'.__('The name of the picture file used for the h2 headding is set. ','Raindrops').'</p>';
        $excerpt .= '<p>'.__('Please set the integral value from 0 to 7. ','Raindrops').'</p>';


        break;
        case("raindrops_heading_image"):

        $excerpt = '<h3 style="position:relative;top:-0.3em;padding-bottom:0.6em;text-indent:1em;cursor:auto;background:none;">'.__('h2 headding background image Setting','Raindrops').'</h3>';
        $excerpt .= '<p>'.__('The name of the picture file used for the h2 headding is set. ','Raindrops').'</p>';
        $excerpt .= '<p>'.__('As for the image, the image that exists in themes/raindrops/image/is used.','Raindrops').'</p>';
        $excerpt .= '<p>'.__('The header image can be chosen from among three kinds (h2.png,h2b,png,h2c.png) now. Of course, customizing is also possible. ','Raindrops').'</p>';


        break;

        default:

        $excerpt = "";


        break;


        }

    if(!empty($excerpt)){
        $excerpt = '<div class="postbox">'.$excerpt;
        }else{
        $excerpt = "";
        }


            if(preg_match("|#[0-9a-f]{6}|i",$result->option_value)){

                $style="background:".$result->option_value.';';
            }else{

                $style="";
            }

            if(preg_match("!\.(png|gif|jpeg|jpg)$!i",$result->option_value)){

                $style .="background:url(".get_stylesheet_directory_uri()."/images/".$result->option_value.');';
            }else{

                $style .='';
            }

            if(empty($style)){
                $style .='visibility:hidden';
        $table_header =  '<thead><tr><th>&nbsp;</th><th>'.__("Value").'</th><th >'.__("Edit").'</th><th>&nbsp;</th></tr></thead>';
            }else{
            $table_header =  '<thead><tr><th>'.__("Color").'</th><th>'.__("Value").'</th><th >'.__("Edit").'</th><th>&nbsp;</th></tr></thead>';

            }


        $lines .= $excerpt;
        $lines .= $table;
            $lines .= $table_header;
            $lines .= "<form action=\"$deliv\" method=\"post\">".wp_nonce_field('update-options');
            $lines .= '<tbody>';
            //$lines .= $excerpt;
            $lines .= '<tr>';
            $lines .= '<td style="display:none;">';
            $lines .= '<input type="text" name="option_id" value="'.$result->option_id.'" />'.$result->option_id.'</td>';





                $lines .= '<td style="'.$style.'">';
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



            }elseif($result->option_name == "raindrops_heading_image"){

                $lines .= '<td style="height:225px"><input type="text" name="option_value" value="'.$result->option_value.'"';

                if($result->option_name == "raindrops_base_color"){
                    $lines .= 'id="raindrops_base_color"';
                }

                $lines .= '/></td>';



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



            $lines .= "</tbody>";
            //$lines .=  '<tfoot><tr><th style=\"display:none;\">'.__("Color").'</th><th>'.__("Value").'</th><th >'.__("Edit").'</th><th>&nbsp;</th></tr></tfoot>';
            $lines .= "</table></div>";
        }


            $lines .= "</div>";

            if(!preg_match('|<tbody>|',$lines)){
            $lines .= "<tbody><tr><td colspan=\"4\">".__("Please reload this page ex. windows F5",'Ranidrops').'</td></tr>';

            }

            return $lines;

    }



     function color_selector($name,$current_val){

$color_ja= array(__('none','Raindrops') => "",__('toki','Raindrops') => "#F9A1D0",__('tutuji','Raindrops') => "#CB4B94",__('sakura','Raindrops') => "#FFDBED",__('bara','Raindrops') => "#D34778",__('karakurenai','Raindrops') => "#E3557F",__('sango','Raindrops') => "#FF87A0",__('koubai','Raindrops') => "#E08899",__('momo','Raindrops') => "#E38698",__('beni','Raindrops') => "#BD1E48",__('beniaka','Raindrops') => "#B92946",__('enji','Raindrops') => "#AE3846",__('suou','Raindrops') => "#974B52",__('akane','Raindrops') => "#A0283A",__('aka','Raindrops') => "#BF1E33",__('syu','Raindrops') => "#ED514E",__('benikaba','Raindrops') => "#A14641",__('benihi','Raindrops') => "#EE5145",__('entan','Raindrops') => "#D3503C",__('beniebitya','Raindrops') => "#703B32",__('tobi','Raindrops') => "#7D483E",__('azuki','Raindrops') => "#946259",__('bengara','Raindrops') => "#8A4031",__('ebitya','Raindrops') => "#6D3D33",__('kinaka','Raindrops') => "#ED542A",__('akatya','Raindrops') => "#B15237",__('akasabi','Raindrops') => "#923A21",__('ouni','Raindrops') => "#EF6D3E",__('sekitou','Raindrops') => "#ED551B",__('kaki','Raindrops') => "#E06030",__('nikkei','Raindrops') => "#B97761",__('kaba','Raindrops') => "#BD4A1D",__('renga','Raindrops') => "#974E33",__('sabi','Raindrops') => "#664134",__('hiwada','Raindrops') => "#8A604F",__('kuri','Raindrops') => "#754C38",__('kiaka','Raindrops') => "#E45E00",__('taisya','Raindrops') => "#BA6432",__('rakuda','Raindrops') => "#B67A52",__('kitye','Raindrops') => "#BB6421",__('hadairo','Raindrops') => "#F4BE9B",__('daidai','Raindrops') => "#FD7E00",__('haitya','Raindrops') => "#866955",__('tya','Raindrops') => "#734E30",__('kogetya','Raindrops') => "#594639",__('kouji','Raindrops') => "#FFA75E",__('anzu','Raindrops') => "#DDA273",__('mikan','Raindrops') => "#FA8000",__('kassyoku','Raindrops') => "#763900",__('tutiiro','Raindrops') => "#A96E2D",__('komugi','Raindrops') => "#D9A46D",__('kohaku','Raindrops') => "#C67400",__('kintya','Raindrops') => "#C47600",__('tamago','Raindrops') => "#FABE6F",__('yamabuki','Raindrops') => "#FFA500",__('oudo','Raindrops') => "#C18A39",__('kutiba','Raindrops') => "#897868",__('himawari','Raindrops') => "#FFB500",__('ukon','Raindrops') => "#FCAC00",__('suna','Raindrops') => "#C9B9A8",__('karasi','Raindrops') => "#CDA966",__('ki','Raindrops') => "#FFBE00",__('tanpopo','Raindrops') => "#FFBE00",__('uguisutya','Raindrops') => "#70613A",__('tyuki','Raindrops') => "#FAD43A",__('kariyasu','Raindrops') => "#EED67E",__('kihada','Raindrops') => "#D9CB65",__('miru','Raindrops') => "#736F55",__('biwa','Raindrops') => "#C2C05C",__('uguisu','Raindrops') => "#71714A",__('mattya','Raindrops') => "#BDBF92",__('kimidori','Raindrops') => "#B9C42F",__('koke','Raindrops') => "#7A7F46",__('wakakusa','Raindrops') => "#A9B735",__('moegi','Raindrops') => "#96AA3D",__('kusa','Raindrops') => "#72814B",__('wakaba','Raindrops') => "#AFC297",__('matuba','Raindrops') => "#6E815C",__('byakuroku','Raindrops') => "#CADBCF",__('midori','Raindrops') => "#4DB56A",__('tokiwa','Raindrops') => "#357C4C",__('rokusyou','Raindrops') => "#5F836D",__('titosemidori','Raindrops') => "#4A6956",__('fukamidori','Raindrops') => "#005731",__('moegi','Raindrops') => "#15543B",__('wakatake','Raindrops') => "#49A581",__('seiji','Raindrops') => "#80AA9F",__('aotake','Raindrops') => "#7AAAAC",__('tetu','Raindrops') => "#244344",__('aomidori','Raindrops') => "#0090A8",__('sabiasagi','Raindrops') => "#6C8D9B",__('mizuasagi','Raindrops') => "#7A99AA",__('sinbasi','Raindrops') => "#69AAC6",__('asagi','Raindrops') => "#0087AA",__('byakugun','Raindrops') => "#84B5CF",__('nando','Raindrops') => "#166A88",__('kamenozoki','Raindrops') => "#8CB4CE",__('mizu','Raindrops') => "#A9CEEC",__('ainezu','Raindrops') => "#5E7184",__('sora','Raindrops') => "#95C0EC",__('ao','Raindrops') => "#0067C0",__('ai','Raindrops') => "#2E4B71",__('koiai','Raindrops') => "#20324E",__('wasurenagusa','Raindrops') => "#92AFE4",__('tuyukusa','Raindrops') => "#3D7CCE",__('hanada','Raindrops') => "#3C639B",__('konjou','Raindrops') => "#3D496B",__('ruri','Raindrops') => "#3451A4",__('rurikon','Raindrops') => "#324784",__('kon','Raindrops') => "#333C5E",__('kakitubata','Raindrops') => "#4C5DAB",__('kati','Raindrops') => "#383C57",__('gunjou','Raindrops') => "#414FA3",__('tetukon','Raindrops') => "#232538",__('fujinando','Raindrops') => "#6869A8",__('kikyou','Raindrops') => "#4A49AD",__('konai','Raindrops') => "#35357D",__('fuji','Raindrops') => "#A09BD8",__('fujimurasaki','Raindrops') => "#948BDB",__('aomurasaki','Raindrops') => "#704CBC",__('sumire','Raindrops') => "#6D52AB",__('hatoba','Raindrops') => "#675D7E",__('syoubu','Raindrops') => "#7051AA",__('edomurasaki','Raindrops') => "#5F4C86",__('murasaki','Raindrops') => "#A260BF",__('kodaimurasaki','Raindrops') => "#775686",__('nasukon','Raindrops') => "#47384F",__('sikon','Raindrops') => "#402949",__('ayame','Raindrops') => "#C27BC8",__('botan','Raindrops') => "#C24DAE",__('akamurasaki','Raindrops') => "#C54EA0",__('siro','Raindrops') => "#F1F1F1",__('gofun','Raindrops') => "#F2E8EC",__('kinari','Raindrops') => "#F0E2E0",__('zouge','Raindrops') => "#E3D4CA",__('ginnezu','Raindrops') => "#A0A0A0",__('tyanezumi','Raindrops') => "#9F9190",__('nezumi','Raindrops') => "#868686",__('rikyunezumi','Raindrops') => "#787C7A",__('namari','Raindrops') => "#797A88",__('hai','Raindrops') => "#797979",__('susutake','Raindrops') => "#605448",__('kurotya','Raindrops') => "#3E2E28",__('sumi','Raindrops') => "#313131",__('kuro','Raindrops') => "#262626",__('tetukuro','Raindrops') => "#262626");


$color_en_140 = array("none"=>"","white"=>"#ffffff","whitesmoke"=>"#f5f5f5","gainsboro"=>"#dcdcdc","lightgrey"=>"#d3d3d3","silver"=>"#c0c0c0","darkgray"=>"#a9a9a9","gray"=>"#808080","dimgray"=>"#696969","black"=>"#000000","red"=>"#ff0000","orangered"=>"#ff4500","tomato"=>"#ff6347","coral"=>"#ff7f50","salmon"=>"#fa8072","lightsalmon"=>"#ffa07a","darksalmon"=>"#e9967a","peru"=>"#cd853f","saddlebrown"=>"#8b4513","sienna"=>"#a0522d","chocolate"=>"#d2691e","sandybrown"=>"#f4a460","darkred"=>"#8b0000","maroon"=>"#800000","brown"=>"#a52a2a","firebrick"=>"#b22222","crimson"=>"#dc143c","indianred"=>"#cd5c5c","lightcoral"=>"#f08080","rosybrown"=>"#bc8f8f","palevioletred"=>"#db7093","deeppink"=>"#ff1493","hotpink"=>"#ff69b4","lightpink"=>"#ffb6c1","pink"=>"#ffc0cb","mistyrose"=>"#ffe4e1","linen"=>"#faf0e6","seashell"=>"#fff5ee","lavenderblush"=>"#fff0f5","snow"=>"#fffafa","yellow"=>"#ffff00","gold"=>"#ffd700","orange"=>"#ffa500","darkorange"=>"#ff8c00","goldenrod"=>"#daa520","darkgoldenrod"=>"#b8860b","darkkhaki"=>"#bdb76b","burlywood"=>"#deb887","tan"=>"#d2b48c","khaki"=>"#f0e68c","peachpuff"=>"#ffdab9","navajowhite"=>"#ffdead","palegoldenrod"=>"#eee8aa","moccasin"=>"#ffe4b5","wheat"=>"#f5deb3","bisque"=>"#ffe4c4","blanchedalmond"=>"#ffebcd","papayawhip"=>"#ffefd5","cornsilk"=>"#fff8dc","lightyellow"=>"#ffffe0","lightgoldenrodyellow"=>"#fafad2","lemonchiffon"=>"#fffacd","antiquewhite"=>"#faebd7","beige"=>"#f5f5dc","oldlace"=>"#fdf5e6","ivory"=>"#fffff0","floralwhite"=>"#fffaf0","greenyellow"=>"#adff2f","yellowgreen"=>"#9acd32","olive"=>"#808000","darkolivegreen"=>"#556b2f","olivedrab"=>"#6b8e23","chartreuse"=>"#7fff00","lawngreen"=>"#7cfc00","lime"=>"#00ff00","limegreen"=>"#32cd32","forestgreen"=>"#228b22","green"=>"#008000","darkgreen"=>"#006400","seagreen"=>"#2e8b57","mediumseagreen"=>"#3cb371","darkseagreen"=>"#8fbc8f","lightgreen"=>"#90ee90","palegreen"=>"#98fb98","springgreen"=>"#00ff7f","mediumspringgreen"=>"#00fa9a","honeydew"=>"#f0fff0","mintcream"=>"#f5fffa","azure"=>"#f0ffff","lightcyan"=>"#e0ffff","aliceblue"=>"#f0f8ff","darkslategray"=>"#2f4f4f","steelblue"=>"#4682b4","mediumaquamarine"=>"#66cdaa","aquamarine"=>"#7fffd4","mediumturquoise"=>"#48d1cc","turquoise"=>"#40e0d0","lightseagreen"=>"#20b2aa","darkcyan"=>"#008b8b","teal"=>"#008080","cadetblue"=>"#5f9ea0","darkturquoise"=>"#00ced1","aqua"=>"#00ffff","cyan"=>"#00ffff","lightblue"=>"#add8e6","powderblue"=>"#b0e0e6","paleturquoise"=>"#afeeee","skyblue"=>"#87ceeb","lightskyblue"=>"#87cefa","deepskyblue"=>"#00bfff","dodgerblue"=>"#1e90ff","ghostwhite"=>"#f8f8ff","lavender"=>"#e6e6fa","lightsteelblue"=>"#b0c4de","slategray"=>"#708090","lightslategray"=>"#778899","indigo"=>"#4b0082","darkslateblue"=>"#483d8b","midnightblue"=>"#191970","navy"=>"#000080","darkblue"=>"#00008b","slateblue"=>"#6a5acd","mediumslateblue"=>"#7b68ee","cornflowerblue"=>"#6495ed","royalblue"=>"#4169e1","mediumblue"=>"#0000cd","blue"=>"#0000ff","thistle"=>"#d8bfd8","plum"=>"#dda0dd","orchid"=>"#da70d6","violet"=>"#ee82ee","fuchsia"=>"#ff00ff","magenta"=>"#ff00ff","mediumpurple"=>"#9370db","mediumorchid"=>"#ba55d3","darkorchid"=>"#9932cc","blueviolet"=>"#8a2be2","darkviolet"=>"#9400d3","purple"=>"#800080","darkmagenta"=>"#8b008b","mediumvioletred"=>"#c71585");


$color_en = array("none"=>"","american red" => "#bf0a30","american blue" => "#002868","american green" => "#006e53","american yellow" => "#deb301","american light blue" => "#cbddf3","american brown" => "#9a6b37","american gray" => "#afafb1","glory red" => "#cc0033","glory blue" => "#0000ff","glory white" => "#fff9f5","big apple red" => "#ff6331","big apple blue" => "#3131ce","empire blue" => "#001873","empire cyan" => "#00b5d6","empire red" => "#d60000","empire yellow" => "#f7f700","empire orange" => "#f79429","empire green" => "#084a29","empire ebony" => "#424a00","natural red" => "#cc0033","natural blue" => "#000099","natural light blue" => "#84c8ef","natural green" => "#90c924","natural orange" => "#f39234","natural brown" => "#843a2f","natural gray" => "#bfbfbf","hawkeye red" => "#e3003d","hawkeye blue" => "#3c3c9e","hawkeye yellow" => "#ffb30f","hawkeye brown" => "#a54a00","frontier blue" => "#000080","frontier light blue" => "#d3eef7","frontier green" => "#024900","frontier yellow" => "#ffff00","frontier purple" => "#8663bd","dixie red" => "#b10021","dixie blue" => "#083152","dixie green" => "#105a21","dixie yellow" => "#ffc621","grand canyon blue" => "#002868","grand canyon red" => "#bf0a30","grand canyon brown" => "#ce5c17","grand canyon yellow" => "#fed700","grand canyon green" => "#00320b","grand canyon pink" => "#efc1a9","lincoln red" => "#e2184f","lincoln pink" => "#e24a4f","lincoln light blue" => "#64b4ff","lincoln blue" => "#3c3c9e","lincoln green" => "#3f863f","lincoln yellow" => "#ffe60f","lincoln orange" => "#ffb316","hoosier blue" => "#101195","hoosier yellow" => "#ffe700","hoosier green" => "#197351","hoosier brown" => "#563837","badger blue" => "#002986","badger light blue" => "#00b2fd","badger pink" => "#f8b8de","badger red" => "#f3334b","badger green" => "#41ad16","badger yellow" => "#ffe618","badger brown" => "#66180b","badger gray" => "#a2b9b9","mountain red" => "#ff3516","mountain blue" => "#003776","mountain green" => "#20d942","mountain yellow" => "#ffb30f","mountain brown" => "#d15b25","mountain gray" => "#c0c0c0","sooner blue" => "#0e4892","sooner light blue" => "#00adc6","sooner green" => "#1b692b","sooner opal" => "#8ab87a","sooner yellow" => "#f0c016","sooner brown" => "#421000","sooner beige" => "#ffc69c","sooner gray" => "#d6c6c6","sooner black" => "#454442","buckeye blue" => "#1a3b86","buckeye red" => "#ff0000","buckeye green" => "#00784b","buckeye yellow" => "#f8c300","buckeye brown" => "#4e3330","buckeye light blue" => "#027bc2","beaver blue" => "#002a86","beaver yellow" => "#ffea0f","golden red" => "#c10435","golden green" => "#007e3a","golden brown" => "#391800","golden yellow" => "#bc8e07","golden cyan" => "#40a7aa","golden gray" => "#84948e","sunflower blue" => "#00009c","sunflower light blue" => "#0092df","sunflower green" => "#29b910","sunflower orange" => "#ff660f","sunflower brown" => "#b34e20","sunflower purple" => "#7c4790","sunflower yellow" => "#ffe400","sunflower gray" => "#dedede","new england" => "#e25c5c","midatlantic" => "#5c7a7a","south" => "#8a84a3","florida" => "#e9bda2","midwest" => "#ffd577","texas" => "#77cbb3","great plains" => "#b6bc4d","rocky mountain" => "#e9df25","southwest" => "#ee2222","california" => "#e0fa92","pacific northwest" => "#38911c","alaska" => "#d09440","hawaii" => "#4f93c0","mountains alabama" => "#999966","metropolitan alabama" => "#ff9933","river heritage alabama" => "#996699","gulf coast alabama" => "#99cccc","southern california" => "#e03030","california desert" => "#e0b000","california central coast" => "#00b000","san joaquin valley" => "#a0a0c0","sacramento valley" => "#e0b000","sierra nevada" => "#00e000","gold country" => "#e0e000","bay area california" => "#e06060","california north coast" => "#b0b000","shasta cascades" => "#e03030","mississippi capital river" => "#336699","mississippi delta" => "#663366","mississippi pines" => "#339966","gulf coast mississippi" => "#660033","mississippi hills" => "#996633","panhandle nebraska" => "#cc9966","north central nebraska" => "#cccc66","eastern nebraska" => "#99cccc","western nevada" => "#cc9999","northern nevada" => "#cc9966","central nevada" => "#9999cc","southern nevada" => "#99cccc","central new mexico" => "#e0fa92","north central new mexico" => "#6699aa","northeast new mexico" => "#b6bc4d","northwest new mexico" => "#d09440","southwest new mexico" => "#b2cc7f","southeast new mexico" => "#ffff99","northwest ohio" => "#666633","northeast ohio" => "#669999","midohio" => "#996666","southwest ohio" => "#666699","southeast ohio" => "#cc9933","western tennessee" => "#996699","central tennessee" => "#339999","eastern tennessee" => "#339966","panhandle texas" => "#80622f","prairies and lakes" => "#335c64","piney woods" => "#406324","gulf coast texas" => "#7895a3","south texas plains" => "#7d6b71","hill country" => "#d1a85e","big bend country" => "#c6ab7a","wasatch front" => "#99cc33","canyon country" => "#cc6600","northeastern utah" => "#669900","dixie" => "#b2cc7f","central utah" => "#999933","western utah" => "#ffff99","northern virginia" => "#9966ff","eastern virginia" => "#33bbee","central virginia" => "#ff6655","southwest virginia" => "#ffcc33","shenandoah valley" => "#339933","southeast wisconsin" => "#66cc99","southwest wisconsin" => "#99ccff","northeast wisconsin" => "#009999","north central wisconsin" => "#66ccff","northwest wisconsin" => "#99cccc");

    $result ='<select name="'.$name.'" size="4" style="width:150px;vertical-align:bottom;margin-bottom:0px;height:100px;">';

    $scheme = TMN_COLOR_SCHEME;
    $current_color = array_search($current_val,$$scheme);
    $result .= '<option value="'.$current_val.'" style="background:'.$current_val.'" selected="selected">'.$current_color.'</option>';

        foreach($$scheme as $key=>$val){

            $cr = hexdec(substr($val,1,2))*0.5;
            $cg = hexdec(substr($val,3,2))*0.5;
            $cb = hexdec(substr($val,5,2))*0.5;

            if($cr+$cg+$cb < 128 and !empty($val)){
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


function tmn_gradient_single($i,$order = "asc"){

    $g = "";

    if($i>4){$i = 4;}

    if($order == "asc"){
        $custom_dark_bg1 = colors($i,'background');
        $custom_light_bg1 = colors($i+1,'background');
    }elseif($order == "desc"){
        $custom_dark_bg1 = colors($i+1,'background');
        $custom_light_bg1 = colors($i,'background');
    }


    $g .= 'background: -webkit-gradient(linear, left top, left bottom, from('.$custom_dark_bg1.'), to('.$custom_light_bg1.'));';
    $g .= 'background: -moz-linear-gradient(top,  '.$custom_dark_bg1.',  '.$custom_light_bg1.');';
    $g .= 'filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$custom_dark_bg1.'\', endColorstr=\''.$custom_light_bg1.'\');';






return $g;


}


function tmn_gradient2(){

$g = "";
    for($i = 1;$i<6;$i++){

    $custom_dark_bg1 = colors($i,'background');
    $custom_light_bg1 = colors('-'.$i,'background');
    $custom_dark_bg2 = colors('-'.$i,'background');
    $custom_light_bg2 = colors($i,'background');

    $g .= '.gradient'.$i.'{';
    $g .= 'background: -webkit-gradient(linear, left top, left bottom, from('.$custom_dark_bg1.'), to('.$custom_light_bg1.'));';
    $g .= 'background: -moz-linear-gradient(top,  '.$custom_dark_bg1.',  '.$custom_light_bg1.');';
    $g .= 'filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$custom_dark_bg1.'\', endColorstr=\''.$custom_light_bg1.'\');';
    $g .= "}\n";
    $g .= '.gradient-'.$i.'{';
    $g .= 'background: -webkit-gradient(linear, left top, left bottom, from('.$custom_dark_bg2.'), to('.$custom_light_bg2.'));';
    $g .= 'background: -moz-linear-gradient(top,  '.$custom_dark_bg2.',  '.$custom_light_bg2.');';
    $g .= 'filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$custom_dark_bg2.'\', endColorstr=\''.$custom_light_bg2.'\');';
    $g .= "}\n";
    }


return $g;


}
function tmn_gradient(){

$g = "";
    for($i = 1;$i<5;$i++){

    $custom_dark_bg1 = colors($i,'background');
    $custom_light_bg1 = colors($i+1,'background');
    $custom_dark_bg2 = colors($i,'background');
    $custom_light_bg2 = colors($i-1,'background');

    $g .= '.gradient'.$i.'{';
    $g .= 'background: -webkit-gradient(linear, left top, left bottom, from('.$custom_dark_bg1.'), to('.$custom_light_bg1.'));';
    $g .= 'background: -moz-linear-gradient(top,  '.$custom_dark_bg1.',  '.$custom_light_bg1.');';
    $g .= 'filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$custom_dark_bg1.'\', endColorstr=\''.$custom_light_bg1.'\');';
    $g .= "}\n";
    $g .= '.gradient-'.$i.'{';
    $g .= 'background: -webkit-gradient(linear, left top, left bottom, from('.$custom_dark_bg2.'), to('.$custom_light_bg2.'));';
    $g .= 'background: -moz-linear-gradient(top,  '.$custom_dark_bg2.',  '.$custom_light_bg2.');';
    $g .= 'filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$custom_dark_bg2.'\', endColorstr=\''.$custom_light_bg2.'\');';
    $g .= "}\n";
    }


return $g;


}
function design_output($name = 'default'){

    global $images_path;
    global $navigation_title_img;
    $c_border   = colors(0,'background');

    if($c_border == '#'){
        $rgba_border = 'rgba(203,203,203, 0.8)';
    }else{
        $rgba_border = hex2rgba($c_border,0.5);
    }

    //$name = warehouse('raindrops_style_type');

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

    $position_y = warehouse('raindrops_heading_image_position');

    $y = $position_y * 26;
    $y = '-'.$y.'px';

    switch( $position_y ){
        case(0):
            $h_position_rsidebar_h2 = "background-position:0 0;";
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

    $h2_default_background = "background:".colors(3,'background').' ';
    $h2_default_background .= "url({$images_path}{$navigation_title_img});";
    $h2_default_background .= "color:".colors(3,'color').';';

    $h2_dark_background = "background:".colors(-3,'background').' ';
    $h2_dark_background .= "url({$images_path}{$navigation_title_img});";
    $h2_dark_background .= "color:".colors(-3,'color').';';

    $h2_light_background = "background:".colors(3,'background').' ';
    $h2_light_background .= "url({$images_path}{$navigation_title_img});";
    $h2_light_background .= "color:".colors(3,'color').';';


    $custom_dark_bg = colors('3','background');
    $custom_light_bg = colors('1','background');
    $custom_color = colors('1','color');
    if(!empty($tmn_footer_color)){
        $tmn_footer_color = 'color:'.$tmn_footer_color;
    }else{
        $tmn_footer_color = '';
    }



$gradient = tmn_gradient();

$default =<<<DEFAULT

$gradient

body {

margin:0!important;padding:0;
background-repeat:repeat-x;
color:$tmn_header_color;
}
#hd{
background-image:url({$images_path}{$tmn_header_image});


}
.hfeed{
    background:#fff;
    box-shadow: 0 0 5px rgba(0,0,0,0.5);
    -webkit-box-shadow: 0 0 5px rgba(0,0,0,5);
    -moz-box-shadow: 0 0 5px rgba(0,0,0,0.5);

}
#ft {
background:url({$images_path}{$tmn_footer_image}) repeat-x;
color:$tmn_footer_color;
$tmn_footer_color
}




.footer-widget h2,.rsidebar h2,.lsidebar h2 {
$h2_default_background
$h_position_rsidebar_h2
}
.home .sticky {
background: $c4
border-top:solid 6px $rgba_border;
border-bottom:solid 2px $rgba_border;

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
    border:1px solid $rgba_border;
    background: $c3

}

.social textarea#comment:focus,
.social input:focus{
    box-shadow: 0 0 5px $rgba_border;
    -webkit-box-shadow: 0 0 5px $rgba_border;
    -moz-box-shadow: 0 0 5px $rgba_border;
  /*  border:1px solid $rgba_border;*/
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
    /*$c3*/



    background: -webkit-gradient(linear, left top, left bottom, from($custom_dark_bg), to($custom_light_bg));
    background: -moz-linear-gradient(top,  $custom_dark_bg,  $custom_light_bg);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='$custom_dark_bg', endColorstr='$custom_light_bg');
    border-radius:1em 1em 1em 1em;
-moz-border-radius:1em 1em 1em 1em;
-webkit-border-radius:1em 1em 1em 1em!important;
border-top:1px solid rgba(255, 255, 255, 0.3);
-moz-box-shadow: 1px 1px 3px #000;
-webkit-box-shadow: 1px 1px 3px #000;
}
#access a {
    /*$c3*/

    background: -webkit-gradient(linear, left top, left bottom, from($custom_dark_bg), to($custom_light_bg));
    background: -moz-linear-gradient(top,  $custom_dark_bg,  $custom_light_bg);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='$custom_dark_bg', endColorstr='$custom_light_bg');
    color:$custom_color;


}
#access ul ul a {

    $c3
    border:1px solid $rgba_border;

}
#access li:active > a,
#access ul ul :active > a {
    top:0;
    $c2
    background: -webkit-gradient(linear, left top, left bottom, from($custom_light_bg), to($custom_dark_bg));
    background: -moz-linear-gradient(top,  $custom_light_bg,  $custom_dark_bg);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='$custom_light_bg', endColorstr='$custom_dark_bg');
    color:$custom_color;
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
#month_list,
#month_list td,
#year_list td,
#calendar_wrap td,
#date_list td{
    border:1px solid $c_border;
    border:1px solid $rgba_border;
}
td.month-date,td.month-name,td.time
{
    $c3
    border:1px solid $rgba_border;

}
address{margin:10px auto;}
DEFAULT;


/**
 *
 *
 *
 *
 */

    $custom_dark_bg = colors('-1','background');
    $custom_light_bg = colors('-4','background');
    $custom_color = colors('-3','color');

    if(!empty($tmn_footer_color)){
        $tmn_footer_color = 'color:'.$tmn_footer_color;
    }else{
        $tmn_footer_color = '';
    }

$dark =<<<DARK
$gradient
body{

    background: -webkit-gradient(linear, left top, left bottom, from($custom_dark_bg), to($custom_light_bg));
    background: -moz-linear-gradient(top,  $custom_dark_bg,  $custom_light_bg);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='$custom_dark_bg', endColorstr='$custom_light_bg');
}
#top{

    $c_3
   /* border-bottom: medium solid $c_border;*/


}

h2 a{
    background:inherit;

}



.entry div h2,.entry div h3{

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
border-bottom:solid 2px $rgba_border;

}

#yui-main{

background: $c_5

}
#hd{
    $c_5
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
    color:$tmn_header_color;
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
$tmn_footer_color
}
#ft #wp-calendar{
    $c_3
border:1px solid $c_border!important;

}
.lsidebar{
    $c_5
}

.footer-widget h2,.rsidebar h2,.lsidebar h2 {
$c_3
$h2_dark_background
$h_position_rsidebar_h2
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
  /*  border-top:1px solid $c_border;
    border-top:1px solid $rgba_border;*/

}
.itiran{
    border:1px solid $c_border;
}
.pagenate{

}

#month_list,
#month_list td,
#year_list td,
#calendar_wrap td,
#date_list td{
    border:1px solid $c_border;
    border:1px solid $rgba_border;
}
td.month-date,td.month-name,td.time
{
    $c_3
    border-bottom:1px solid $c_border;
    border:1px solid $rgba_border;

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
div.social{


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
   box-shadow: 0 0 5px $rgba_border;
    -webkit-box-shadow: 0 0 5px $rgba_border;
    -moz-box-shadow: 0 0 5px $rgba_border;
   /* border:1px solid $rgba_border;*/
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

    background: -webkit-gradient(linear, left top, left bottom, from($custom_dark_bg), to($custom_light_bg));
    background: -moz-linear-gradient(top,  $custom_dark_bg,  $custom_light_bg);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='$custom_dark_bg', endColorstr='$custom_light_bg');
    border-radius:1em 1em 1em 1em;
-moz-border-radius:1em 1em 1em 1em;
-webkit-border-radius:1em 1em 1em 1em!important;
border-top:1px solid rgba(255, 255, 255, 0.3);
-moz-box-shadow: 1px 1px 3px #000;
-webkit-box-shadow: 1px 1px 3px #000;

}
#access a {

        background: -webkit-gradient(linear, left top, left bottom, from($custom_dark_bg), to($custom_light_bg));
    background: -moz-linear-gradient(top,  $custom_dark_bg,  $custom_light_bg);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='$custom_dark_bg', endColorstr='$custom_light_bg');
    color:$custom_color;

}
#access ul ul a {

    $c_3
   /* border:1px solid $rgba_border;*/

}
#access li:active > a,
#access ul ul :active > a {
    /*$c_2*/
    top:0;
        background: -webkit-gradient(linear, left top, left bottom, from($custom_light_bg), to($custom_dark_bg));
    background: -moz-linear-gradient(top,  $custom_light_bg,  $custom_dark_bg);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='$custom_light_bg', endColorstr='$custom_dark_bg');
    color:$custom_color;
}
#access ul li.current_page_item > a,
#access ul li.current-menu-ancestor > a,
#access ul li.current-menu-item > a,
#access ul li.current-menu-parent > a {
   /* border:1px solid $rgba_border;*/

    $c_3
}
* html #access ul li.current_page_item a,
* html #access ul li.current-menu-ancestor a,
* html #access ul li.current-menu-item a,
* html #access ul li.current-menu-parent a,
* html #access ul li a:hover {
   /* border:1px solid $rgba_border;*/

    $c_2
}
address{margin:10px auto;}
DARK;

/**
 *
 *
 *
 *
 */
    $custom_dark_bg = colors('4','background');
    $custom_light_bg = colors('2','background');
    $custom_color = colors('3','color');
    $base_gradient = tmn_gradient_single(2,"asc");

    if(!empty($tmn_footer_color)){
        $tmn_footer_color = 'color:'.$tmn_footer_color;
    }else{
        $tmn_footer_color = '';
    }
$light =<<<LIGHT

$gradient

h1,h2,h3,h4,h5,h6,#bd a,.postmetadata{background:none!important;}
body{
    margin:0!important;
    $c4
    background: -webkit-gradient(linear, left top, left bottom, from($custom_dark_bg), to($custom_light_bg));
background: -moz-linear-gradient(top,  $custom_dark_bg,  $custom_light_bg);
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='$custom_dark_bg', endColorstr='$custom_light_bg');
}
.hfeed{
    $base_gradient
    box-shadow: 0 0 5px $rgba_border;
    -webkit-box-shadow: 0 0 5px $rgba_border;
    -moz-box-shadow: 0 0 5px $rgba_border;

}
#top{
    $c3
    /*border-bottom: medium solid $c_border;*/
}
h2,h3{
    $c5
}
.home .sticky {
background: $c4
border-top:solid 6px $rgba_border;
border-bottom:solid 2px $rgba_border;

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
   $c1
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
    $tmn_footer_color
}

/*.lsidebar h2{
    $h2_light_background

}*/
.footer-widget h2,.rsidebar h2,.lsidebar h2 {
$c3
$h2_light_background;
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
   /* border-top:1px solid $c_border;
    border-top:1px solid $rgba_border;*/

}
.itiran{
    border:1px solid $c_border;
}

#month_list,
#month_list td,
#year_list td,
#calendar_wrap td,
#date_list td{
    border:1px solid $c_border;
    border:1px solid $rgba_border!important;
}
td.month-date,td.month-name,td.time{
    $c_3
    border-bottom:1px solid $c_border;
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
    box-shadow: 0 0 5px $rgba_border;
    -webkit-box-shadow: 0 0 5px $rgba_border;
    -moz-box-shadow: 0 0 5px $rgba_border;
    border:1px solid $rgba_border;
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


    background: -webkit-gradient(linear, left top, left bottom, from($custom_dark_bg), to($custom_light_bg));
    background: -moz-linear-gradient(top,  $custom_dark_bg,  $custom_light_bg);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='$custom_dark_bg', endColorstr='$custom_light_bg');
    border-radius:1em 1em 1em 1em;
-moz-border-radius:1em 1em 1em 1em;
-webkit-border-radius:1em 1em 1em 1em!important;
border-top:1px solid rgba(255, 255, 255, 0.3);
-moz-box-shadow: 1px 1px 3px #000;
-webkit-box-shadow: 1px 1px 3px #000;

}
#access a {
    background: -webkit-gradient(linear, left top, left bottom, from($custom_dark_bg), to($custom_light_bg));
    background: -moz-linear-gradient(top,  $custom_dark_bg,  $custom_light_bg);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='$custom_dark_bg', endColorstr='$custom_light_bg');
    color:$custom_color;


}
#access ul ul a {

    $c3

}

#access li:active > a,
#access ul ul :active > a {
    top:0;
    background: -webkit-gradient(linear, left top, left bottom, from($custom_light_bg), to($custom_dark_bg));
    background: -moz-linear-gradient(top,  $custom_light_bg,  $custom_dark_bg);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='$custom_light_bg', endColorstr='$custom_dark_bg');
    color:$custom_color;
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
address{margin:10px auto;}
LIGHT;


if(isset($$name)){
return apply_filters("raindrops_colors", $$name );

}else{
    return false;
}

}



function add_raindrops_stylesheet() {

global $wpdb;

    $raindrops_url  = get_stylesheet_directory_uri(). '/lib/style.php';
    $raindrops_file = STYLESHEETPATH. '/lib/style.php';

    if ( file_exists($raindrops_file) ) {
        wp_register_style('raindrops_style_sheet', $raindrops_url,array(),'0.1','all');
        wp_enqueue_style( 'raindrops_style_sheet');
    }

    $stylesheet_name = 'b'.str_replace("wp","",$wpdb->prefix).'-csscolor.css';
    $raindrops_url  = get_stylesheet_directory_uri() . '/lib/' .INDIVIDUAL_STYLE;
    $raindrops_file = STYLESHEETPATH . '/lib/' .INDIVIDUAL_STYLE;

    if ( file_exists($raindrops_file) and TMN_USE_AUTO_COLOR == true) {
        wp_register_style('raindrops_individual_style_sheet', $raindrops_url,array(),time(),'all');
        wp_enqueue_style( 'raindrops_individual_style_sheet');
    }
}



function tmn_comment_form($form){
global $commenter;
$form['url'] = '<p class="comment-form-url"><label for="url">' . __( 'Website' ) . '</label><span class="option">'.__('Option','Raindrops').'</span><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>';

return $form;
}


/**
 * remove aria_required
 *
 */




function custom_remove_aria_required1($arg){

    $change = array("aria-required=\"true\"","aria-required='true'");
    $arg = str_replace($change,'',$arg);
    return $arg;

}

function custom_remove_aria_required2($args) {

    $change = array("aria-required=\"true\"","aria-required='true'");
    if(isset($args['author'])){
    $args['author'] = str_replace($change,'',$args['author']);
}


if(isset($args['email'])){
$args['email'] = str_replace($change,'',$args['email']);
}
    return $args;
}

function setup_raindrops(){

    global $wpdb,$raindrops_base_setting;
        $sql = 'SELECT * FROM `'.TMN_PLUGIN_TABLE.'` WHERE `option_name` LIKE \'raindrops%\'';
        $results = $wpdb->get_results($sql);

        if(empty($results)){
            foreach($raindrops_base_setting as $add){

                add_option($add['option_name'],$add['option_value'],"",$add['autoload']);

            }

        }

    }

function get_url_from_element($tag){

preg_match('|(https?)(://[[:alnum:]\+\$\;\?\.%,!#~*/:@&=_-]+)|i',$tag,$regs);

if(empty($regs[2])){return false;}
return $regs[1].$regs[2];

}
function get_title_from_element($tag){

preg_match('|title=\"([^\"]+)\"|i',$tag,$regs);

if(empty($regs[1])){return "no title";}

return $regs[1];

}

?>