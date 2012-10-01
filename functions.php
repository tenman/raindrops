<?php

/**
 * functions and constants for Raindrops theme
 *
 *
 * @package Raindrops
 * @since Raindrops 0.1
 */
    if(!defined('ABSPATH')){
        exit;
    }
/** 
 * move from hooks.php
 * and change from load_textdomain() to load_theme_text_domain()
 *
 *
 * @since 0.988
 */
load_theme_textdomain( 'Raindrops', get_template_directory() . '/languages' );

/** NEW
 * When WP_DEBUG value true and $raindrops_actions_hook_message value true
 * Show Raindrops action filter position and examples
 *
 *
 * @since 0.980
 */
	if( ! isset( $raindrops_actions_hook_message ) ){
		$raindrops_actions_hook_message = false;
	}
/**
 * Current version of WordPress
 *
 *
 *
 * @since 0.965
 */
    $raindrops_check_wp_version = explode('-',$wp_version);
    $raindrops_wp_version       = $raindrops_check_wp_version[0];

    if( !isset( $raindrops_current_theme_name ) ){
        if( $raindrops_wp_version >= '3.4' ){
            $raindrops_current_theme_name = wp_get_theme();
        }else{
            $raindrops_current_theme_name = get_current_theme();
        }
    }
/* @since 0.974 */
    $raindrops_theme_data       = get_theme_data( get_theme_root() . '/' . $raindrops_current_theme_name . '/style.css' );
    $raindrops_version          = $raindrops_theme_data['Version'];

//if( $raindrops_wp_version >= '3.4' ){
/*----- Copy this area and paste Child functions.php when functions customize / Start------*/
/**
 * HTML document type
 *
 *
 *
 * Now only 'xhtml1'
 *
 */
    $raindrops_document_type = 'xhtml1';
/**
 * Include functions about the Raindrops options panel
 *
 *
 *
 *
 *
 */
    if (!class_exists('raindrops_menu_create')) {
        require_once( get_template_directory() . '/lib/option-panel.php' );
        $is_submenu = new raindrops_menu_create;
    }
     add_action('admin_menu', array($is_submenu, 'add_menus'));
/**
 * Include functions about colors ,backgrounds and borders
 *
 *
 *
 *
 */
    $raindrops_included_files = get_included_files();

    foreach($raindrops_included_files as $key => $val){
        $included_file[$key] = basename($val);
    }
    $raindrops_included_files = $included_file;
    $raindrops_color_file_path = get_stylesheet_directory().'/lib/csscolor/csscolor.php';
        if(!in_array('csscolor.php',$raindrops_included_files) and
             file_exists($raindrops_color_file_path)){
            require_once($raindrops_color_file_path);
        }elseif(!in_array('csscolor.php',$raindrops_included_files)){
            require_once(get_template_directory().'/lib/csscolor/csscolor.php');
        }
        $raindrops_color_file_path = get_stylesheet_directory().'/lib/csscolor.css.php';
        if(!in_array('csscolor.css.php',$raindrops_included_files) and
             file_exists($raindrops_color_file_path)){
            require_once($raindrops_color_file_path);
        }elseif(!in_array('csscolor.css.php',$raindrops_included_files)){
            require_once(get_template_directory().'/lib/csscolor.css.php');
        }
       add_filter('contextual_help','raindrops_edit_help');
/**
 * It has alias functions.
 *
 *
 *
 *
 */
    $raindrops_functions_file_path = get_stylesheet_directory().'/lib/alias_functions.php';
        if(!in_array('alias_functions.php',$raindrops_included_files)
            and file_exists($raindrops_functions_file_path)){
            require_once($raindrops_functions_file_path);
        }elseif(!in_array('alias_functions.php',$raindrops_included_files)){
            require_once(get_template_directory().'/lib/alias_functions.php');
        }

/**
 * It has hooks.
 *
 *
 *
 *
 */
    $raindrops_functions_file_path = get_stylesheet_directory().'/lib/hooks.php';
        if(!in_array('alias_functions.php',$raindrops_included_files)
            and file_exists($raindrops_functions_file_path)){
            require_once($raindrops_functions_file_path);
        }elseif(!in_array('alias_functions.php',$raindrops_included_files)){
            require_once(get_template_directory().'/lib/hooks.php');
        }

/*----- Copy this area and paste Child functions.php when functions customize / End------*/

/**
 * Your extend function , settings write below.
 *
 *
 *
 *
 */


/**
 * Original page width implementation by manual labor
 *
 * If you need original page width
 * you can specific pixel page width
 * e.g. '$raindrops_page_width = '776';' is  776px page width.
 *
 *
 */
    if(!isset($raindrops_page_width)){
        $raindrops_page_width = '';
    }
/**
 * Content width implementation by manual labor
 *
 * If you need specific $content_width.
 * value set 400 When not setting or empty.
 *
 */
    //$content_width = '';
/**
 * 750px,950px centered layout fluid or fixed page width switch
 *
 * Empty value makes like a Elastic layout
 *
 * value 'fixed' or empty
 *
 */
    if(!isset($raindrops_fluid_or_fixed)){
        $raindrops_fluid_or_fixed = 'fixed';
    }
/**
 * fluid page  main column minimum width px
 *
 *
 *
 *
 *
 */
    if( !isset( $raindrops_fluid_minimum_width ) ){
        $raindrops_fluid_minimum_width = '450';
    }
/**
 * fluid page  main column maximum width px
 *
 *
 *
 *
 *
 */

    if( !isset( $raindrops_fluid_maximum_width ) ){
        $raindrops_fluid_maximum_width = '1280';
    }
/**
 * Special simple view for mobile and small width browser
 * If it sets to true, a display simple compulsory always will be performed.
 *
 * default false
 *
 *
 */

    if( !isset( $raindrops_fallback_human_interface_show ) ){
        $raindrops_fallback_human_interface_show = false;
    }

/**
 * Raindrops header and footer image upload
 *
 *
 *
 *
 *
 */
// Allow image type Raindrops footer and header.
    if( !isset( $raindrops_allow_file_type ) ){
        $raindrops_allow_file_type  = array('image/png','image/jpeg','image/jpg','image/gif');
    }
//max upload size byte
    if( !isset( $raindrops_max_upload_size ) ){
        $raindrops_max_upload_size  = 2000000;
    }
//header or footer image max width px
    if( !isset( $raindrops_max_width  ) ){
        $raindrops_max_width        = 1300;
    }

/**
 *
 *
 *
 *
 *
 */
    if(!defined('SHOW_DELETE_POST_LINK')){
        define("SHOW_DELETE_POST_LINK",false);
    }
/**
 * the_content() or the_excerpt
 *
 * the_excerpt use where index,archive,other not single pages.
 * If RAINDROPS_USE_LIST_EXCERPT value false and use the_content .
 *
 */
    if(!defined('RAINDROPS_USE_LIST_EXCERPT')){
        define("RAINDROPS_USE_LIST_EXCERPT",false);
    }
/**
 * Auto Color On or Off
 * If you want no Auto Color when set value false.
 *
 *
 *
 *
 */
    if(!defined('RAINDROPS_USE_AUTO_COLOR')){
        define("RAINDROPS_USE_AUTO_COLOR",true);
    }



/**
 * Monthly archive, Daily archive  time format
 *
 *
 *
 *
 *
 */
    if(!defined('RAINDROPS_TABLE_TITLE')){
        define("RAINDROPS_TABLE_TITLE",'options');
    }
    if(!defined('RAINDROPS_PLUGIN_TABLE')){
        define('RAINDROPS_PLUGIN_TABLE',$wpdb->prefix . RAINDROPS_TABLE_TITLE);
    }
    if(!isset($raindrops_theme_settings)){
        $raindrops_theme_settings = get_option('raindrops_theme_settings','no');
    }
/**
 * single-post-thumbnail
 *
 *
 *
 *
 */
    if(!defined('RAINDROPS_SINGLE_POST_THUMBNAIL_WIDTH')){
        define('RAINDROPS_SINGLE_POST_THUMBNAIL_WIDTH',600);
    }
    if(!defined('RAINDROPS_SINGLE_POST_THUMBNAIL_HEIGHT')){
        define('RAINDROPS_SINGLE_POST_THUMBNAIL_HEIGHT',200);
    }
    add_image_size( 'single-post-thumbnail', RAINDROPS_SINGLE_POST_THUMBNAIL_WIDTH, RAINDROPS_SINGLE_POST_THUMBNAIL_HEIGHT, true);

/**
 * widget settings
 *
 * Registered Default Sidebar, Extra Sidebar, Sticky Widget, Footer Widget, Category Blog Widget
 *
 *
 *
 */
    if(!function_exists('raindrops_widgets_init')){
        function raindrops_widgets_init() {
            register_sidebar(array (
              'name' => __('Default Sidebar', 'Raindrops'),
              'id' => 'sidebar-1',
              'before_widget' => '<li  id="%1$s" class="%2$s widget default">',
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
              'name' => __('Extra Sidebar','Raindrops'),
              'id' => 'sidebar-2',
              'before_widget' => '<li  id="%1$s" class="%2$s widget extra">',
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
              'name' => __('Sticky Widget','Raindrops'),
              'id' => 'sidebar-3',
              'before_widget' => '<li  id="%1$s" class="%2$s widget sticky-widget">',
              'after_widget' => '</li>',
              'before_title' => '<h2 class="widgettitle home-top-content h2">',
              'after_title' => '</h2>',
              'widget_id' => 'toppage2',
              'widget_name' => 'toppage2',
              'text' => "3"));
            register_sidebar(
              array (
              'name' => __('Footer Widget', 'Raindrops'),
              'id' => 'sidebar-4',
              'before_widget' => '<li  id="%1$s" class="%2$s widget footer-widget">',
              'after_widget' => '</li>',
              'before_title' => '<h2 class="widgettitle footer-widget h2">',
              'after_title' => '</h2>',
              'widget_id' => 'footer',
              'widget_name' => 'footer',
              'text' => "4"));
            register_sidebar(
              array (
              'name' => __('Category Blog Widget', 'Raindrops'),
              'id' => 'sidebar-5',
              'before_widget' => '<li  id="%1$s" class="%2$s widget category-blog-widget">',
              'after_widget' => '</li>',
              'before_title' => '<h2 class="widgettitle category-blog-widget h2">',
              'after_title' => '</h2>',
              'widget_id' => 'categoryblog',
              'widget_name' => 'categoryblog',
              'text' => "5"));
        }
    }
/**
 *
 *
 *
 *
 *
 */
    if(!isset($raindrops_base_setting) ){
        $raindrops_base_setting = $raindrops_base_setting_args;
    }
    if(raindrops_warehouse_clone('raindrops_show_right_sidebar') == 'hide'){
        $rsidebar_show = false;
    }else{
        $rsidebar_show = true;
    }
    if(raindrops_warehouse_clone('raindrops_right_sidebar_width_percent') == '25'){
        $yui_inner_layout = 'yui-ge';
    }elseif(raindrops_warehouse_clone('raindrops_right_sidebar_width_percent') == '75'){
        $yui_inner_layout = 'yui-gf';
    }elseif(raindrops_warehouse_clone('raindrops_right_sidebar_width_percent') == '33'){
        $yui_inner_layout = 'yui-gc';
    }elseif(raindrops_warehouse_clone('raindrops_right_sidebar_width_percent') == '66'){
        $yui_inner_layout = 'yui-gd';
    }elseif(raindrops_warehouse_clone('raindrops_right_sidebar_width_percent') == '50'){
        $yui_inner_layout = 'yui-g';
    }else{
        $yui_inner_layout = 'yui-ge';
    }
    if( !isset( $raindrops_current_style_type ) ){
        $raindrops_current_style_type = raindrops_warehouse_clone("raindrops_style_type");

    }



/**
 * Content width setup
 *
 *
 *
 *
 *
 */
    if(!isset($content_width) or empty($content_width)){
        $content_width = raindrops_content_width_clone();
    }
/**
 *
 *
 *
 *
 *
 */
    $install_once = get_option('raindrops_theme_settings');
        if ($install_once == false or !array_key_exists('install', $install_once) ) {
            add_action('admin_init', 'setup_raindrops');
        }
    add_action( 'widgets_init', 'raindrops_widgets_init' );
/**
 * Add option helper
 *
 *
 *
 *
 *
 */
    foreach($raindrops_base_setting as $setting){
        $function_name = $setting['option_name'].'_validate';
        if(!function_exists($function_name)){
            $message = sprintf(__('If you add  %s when you must create function %s for data validation','Raindrops'),$setting['option_name'],$function_name);
            printf('<script type="text/javascript">alert(\'%s\');</script>',$message);
        return;
        }
    }
/**
 * Extend body_class()
 *
 *
 * add browser class, languages class,
 *
 *
 */
    if (!function_exists('raindrops_add_body_class')) {
        function raindrops_add_body_class($class) {
        global $post, $current_blog;
            $lang               = get_locale();
            $raindrops_options  = get_option("raindrops_theme_settings");
            if(isset($raindrops_options["raindrops_style_type"]) and !empty($raindrops_options["raindrops_style_type"])){
                $color_type = "rd-type-".$raindrops_options["raindrops_style_type"];
            }else{
                $color_type = '';
            }
            if(is_single() or is_page()){
                $raindrops_content_check = get_post($post->ID);
                $raindrops_content_check = $raindrops_content_check->post_content;
                if(preg_match("!\[raindrops[^\]]+(color_type)=(\"|')*?([^\"' ]+)(\"|')*?[^\]]*\]!si",$raindrops_content_check,$regs)){
                    $color_type = "rd-type-".trim($regs[3]);
                }
                if(preg_match("!\[raindrops[^\]]+(col)=(\"|')*?([^\"' ]+)(\"|')*?[^\]]*\]!si",$raindrops_content_check,$regs)){
                    $color_type .= ' ';
                    $color_type .= "rd-col-".$regs[3];
                }
            }
            if(isset($_SERVER["HTTP_ACCEPT_LANGUAGE"])){
                $browser_lang = $_SERVER["HTTP_ACCEPT_LANGUAGE"];
                $browser_lang = explode( ",", $browser_lang );
                $browser_lang = esc_html($browser_lang[0]);
                $browser_lang = 'accept-lang-'.$browser_lang;
                $classes= array($lang,$color_type,$browser_lang);
            }else{
                $classes= array($lang,$color_type);
            }
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


            if(isset($current_blog)){
                $classes[] = "b". $current_blog->blog_id;
            }

            return apply_filters("raindrops_add_body_class",$classes);

        }
    }

/**
 * wp_list_comments callback function
 *
 *
 *
 * comments.php
 *
 */
    if (!function_exists('raindrops_comment')) {
        function raindrops_comment( $comment, $args, $depth ) {
            $GLOBALS['comment'] = $comment; ?>
<?php if ( '' == $comment->comment_type ){ ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
  <div id="comment-<?php comment_ID(); ?>">
    <div class="comment-author vcard">
      <div class="raindrops-comment-avatar"> <?php echo get_avatar( $comment, 32 ); ?> </div>
      <div class="raindrops-comment-author-meta"> <?php printf( __( '%s <span class="says">says:</span>', 'Raindrops' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?> </div>
      <div class="comment-meta commentmetadata clearfix"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"> <?php printf( __( '%1$s at %2$s', 'Raindrops' ), get_comment_date(),  get_comment_time() ); ?></a>
        <?php edit_comment_link( __( '(Edit)', 'Raindrops' ), ' ' ); ?>
      </div>
    </div>
    <!-- .comment-author .vcard -->
    <?php if ( $comment->comment_approved == '0' ){ ?>
    <div class="clearfix awaiting"> <em><?php _e( 'Your comment is awaiting moderation.', 'Raindrops' ); ?></em><br /></div>
    <?php }//endif ?>
    <!-- .comment-meta .commentmetadata -->
    <div class="comment-body"><?php comment_text(); ?></div>
    <div class="reply">
      <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    </div>
    <!-- .reply -->
  </div>
  <!-- #comment-##  -->
  <?php }else{ ?>
<li class="post pingback">
  <p><?php _e( 'Pingback:', 'Raindrops' ); ?>
    <?php comment_author_link(); ?>
    <?php edit_comment_link( __('(Edit)', 'Raindrops'), ' ' ); ?>
  </p>
  <?php }//endif
        }
    }
/**
 * Template function posted in
 *
 *
 *
 * loop.php
 *
 */
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
            $result = sprintf(
                $posted_in,
                get_the_category_list( ', ' ),
                $tag_list,
                get_permalink(),
                the_title_attribute( 'echo=0' )
            );
            echo apply_filters("raindrops_posted_in",$result);
        }
    }
/**
 * Template function posted_on
 *
 *
 *
 * loop.php
 *
 */
    if (!function_exists('raindrops_posted_on')) {
        function raindrops_posted_on() {
            $raindrops_date_format = get_option('date_format'). ' '. get_option( 'time_format' );
            $author = raindrops_blank_fallback(get_the_author(),'Somebody');
            if (comments_open()){
                $raindrops_comment_html = '<a href="%1$s" class="raindrops-comment-link"><span class="raindrops-comment-string point"></span><em>%2$s %3$s</em></a>';
                if(get_comments_number() > 0 ){
                    $raindrops_comment_string = _n('Comment','Comments',get_comments_number(),'Raindrops');
                    $raindrops_comment_number = get_comments_number();
                }else{
                    $raindrops_comment_string = 'Comment';
                    $raindrops_comment_number = '';
                }
            }else{
                $raindrops_comment_html   = '';
                $raindrops_comment_string = '';
                $raindrops_comment_number = '';
            }
            $result = sprintf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s %4$s'
, 'Raindrops' ),
                'meta-prep meta-prep-author',
                sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
                    get_permalink(),
                    esc_attr( get_the_time($raindrops_date_format) ),
                    get_the_date( $raindrops_date_format )
                ),
                sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="vcard:url">%3$s</a></span>',
                    get_author_posts_url( get_the_author_meta( 'ID' ) ),
                    sprintf( esc_attr__( 'View all posts by %s', 'Raindrops' ), $author ),
                    $author
                ),
                sprintf($raindrops_comment_html,get_comments_link(),$raindrops_comment_number,$raindrops_comment_string)
            );

            echo apply_filters("raindrops_posted_on",$result);
        }
    }
/**
 * Special custom fields key css, javascript, metatags
 *
 *
 * css,javascrip,meta is separated anothor Custom Field.
 *
 *
 */
    if (!function_exists('raindrops_filter_explode_meta_keys')) {
        function raindrops_filter_explode_meta_keys( $content, $key ) {
            $explode_keys = array( 'css', 'javascript', 'meta');
            if ( in_array( $key, $explode_keys ) ) return;
            else return $content;
        }
    }
/**
 * Like a get_option()
 *
 *
 * Raindrops conditional response.
 *
 * for templates
 */
 if (!function_exists('raindrops_warehouse')) {
    function raindrops_warehouse($name){
        return apply_filters("raindrops_warehouse",raindrops_warehouse_clone($name));
    }
 }
/**
 * Return $raindrops_base_setting value.
 *
 *
 *
 *
 *
 */
    if (!function_exists('raindrops_admin_meta')) {
        function raindrops_admin_meta($name,$meta_name){
            global $raindrops_base_setting;
            global $raindrops_page_width;
            $vertical = array();
            foreach($raindrops_base_setting as $key=>$val){
                if(!is_null($raindrops_base_setting)){
                    $vertical[] = $val['option_name'];
                }
            }
                $row = array_search($name,$vertical);
                return $raindrops_base_setting[$row][$meta_name];
        }
    }
/**
 * Admin Panel help
 *
 *
 *
 *
 *
 */
    if (!function_exists('raindrops_settings_page_contextual_help')) {

        function raindrops_settings_page_contextual_help() {
            global $raindrops_theme_data;
            $screen = get_current_screen();
            $html = '<dt>%1$s</dt><dd>%2$s</dd>';
            $link = '<a href="%1$s" %3$s>%2$s</a>';

            $content = '';

            /* theme description*/
            $content .= sprintf($html
                    , __('Description','Raindrops')
                    , $raindrops_theme_data['Description']
                    );
            /* theme URI*/
            $content .= sprintf($html
                    , __('Theme URI','Raindrops')
                    , sprintf($link,$raindrops_theme_data['URI'], $raindrops_theme_data['URI'], 'target="_self"' )
                    );
            /*AuthorURI*/
            $content .= sprintf($html
                    , __('Author','Raindrops')
                    , sprintf( $link,$raindrops_theme_data['AuthorURI'], $raindrops_theme_data['Author'], 'target="_self"' )
                    );
            /*Version*/
            $content .= sprintf($html
                    , __('Version','Raindrops')
                    , $raindrops_theme_data['Version']
                    );
            /*Changelog.txt*/

            $content .= sprintf($html
                    , __('Change log text','Raindrops')
                    , sprintf( $link, get_template_directory_uri().'/changelog.txt', __('Changelog , display new window', 'Raindrops'), 'target="_blank"' )
                    ,'target="_blank"'
                    );
            /*readme.txt*/
            $content .= sprintf($html
                    , __('Readme text','Raindrops')
                    , sprintf( $link, get_template_directory_uri().'/README.txt', __('Readme , display new window', 'Raindrops'), 'target="_blank"' )
                    );

            $content = '<dl id="raindrops-help">'.$content.'</dl>';

            $screen->add_help_tab( array(
                'id'      => 'raindrops-settings-help',
                'title'   => __( 'raindrops infomation', 'Raindrops' ),
                'content' => $content
            ) );
        }
    }
/**
 * Raindrops edit help
 *
 *
 * Check the real color of the Cradation Class and the Color Class.
 *
 *
 */
    if (!function_exists('raindrops_edit_help') and RAINDROPS_USE_AUTO_COLOR == true) {
        function raindrops_edit_help($text,$force = false){
        global $post_type_object;
        global $title;
        if((isset($post_type_object) and ($title == $post_type_object->labels->add_new_item or $title == $post_type_object->labels->edit_item) or $force == true)){
            $result = "<h2 class=\"h2\">".__('Tips',"Raindrops").'</h2>';
            $result .= '<p>'.__('If Raindrops Options panel is opened, and the reference color is set, this arrangement of color is changed at once.',"Raindrops")."</p>";
            $result .= "<dl><dt><h3>".__('Dinamic Color Class','Raindrops').'</strong></h3>';
            $result .= '<dd><table><tr>
            <td style="'.raindrops_colors_clone(5,'set').'padding:0.5em;">class color5</td>
            <td style="'.raindrops_colors_clone(4,'set').'padding:0.5em;">class color4</td>
            <td style="'.raindrops_colors_clone(3,'set').'padding:0.5em;">class color3</td>
            <td style="'.raindrops_colors_clone(2,'set').'padding:0.5em;">class color2</td>
            <td style="'.raindrops_colors_clone(1,'set').'padding:0.5em;">class color1</td></tr><tr>
            <td style="'.raindrops_colors_clone('-1','set').'padding:0.5em;">class color-1</td>
            <td style="'.raindrops_colors_clone('-2','set').'padding:0.5em;">class color-2</td>
            <td style="'.raindrops_colors_clone('-3','set').'padding:0.5em;">class color-3</td>
            <td style="'.raindrops_colors_clone('-4','set').'padding:0.5em;">class color-4</td>
            <td style="'.raindrops_colors_clone('-5','set').'padding:0.5em;">class color-5</td></tr>
            <tr><td colspan="5">
            '.__('code example:please HTML editor mode','Raindrops').'
            <div  style="'.raindrops_colors_clone(2,'set').'padding:1em;">&lt;div class="color3"&gt;
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum&lt;/div&gt;
            </div></td>
            </tr></table>
            </dd>';
            $result .= "<dt><h3>".__('Dinamic Gradient Class','Raindrops').'</h3></dt>';
            $result .= '<dd><table><tr>
            <td style="'.raindrops_gradient_single(1,"asc").'padding:0.5em;">class gradient5</td>
            <td style="'.raindrops_gradient_single(2,"asc").'padding:0.5em;">class gradient4</td>
            <td style="'.raindrops_gradient_single(3,"asc").'padding:0.5em;">class gradient3</td>
            <td style="'.raindrops_gradient_single(4,"asc").'padding:0.5em;">class gradient2</td>
            <td style="'.raindrops_gradient_single(5,"asc").'padding:0.5em;">class gradient1</td></tr><tr>
            <td style="'.raindrops_gradient_single(1,"desc").'padding:0.5em;">class gradient-1</td>
            <td style="'.raindrops_gradient_single(2,"desc").'padding:0.5em;">class gradient-2</td>
            <td style="'.raindrops_gradient_single(3,"desc").'padding:0.5em;">class gradient-3</td>
            <td style="'.raindrops_gradient_single(4,"desc").'padding:0.5em;">class gradient-4</td>
            <td style="'.raindrops_gradient_single(5,"desc").'padding:0.5em;">class gradient-5</td></tr>
            <tr><td colspan="5">
            '.__('code example:please HTML editor mode','Raindrops').'
            <div  style="'.raindrops_gradient_single(3,"asc").'padding:1em;">&lt;div class="gradient3"&gt;
            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.&lt;/div&gt;</div></td></tr></table></dd>';
            $result .= "<dl><dt><h3>".__('About Featured Image','Raindrops').'</strong></h3>';
            $result .= "<dl><dd><p>".__('image width and height aspect ratio is 3:1. another aspect ratio will be trimming center','Raindrops').'</p></dd>';
            $result .= "</dl>";
            $result .= $text;
            return $result;
        }else{
            return $text;
        }
        }
    }
/**
 * Create admin panel form and define input value.
 *
 *
 *
 *
 */
    if (!function_exists('raindrops_options_init')) {
        function raindrops_options_init(){
            global $raindrops_base_setting;
            if(isset($raindrops_base_setting)){
                foreach($raindrops_base_setting as $setting){
                    register_setting( 'raindrop_options', $setting['option_name'], $setting['validate'] );
                }
            }
        }
    }
/**
 * internal function File upload
 *
 *
 *@param $embed string inline or external or embed
 *@param $id #hd or #ft
 */
    if (!function_exists('raindrops_upload_image_parser')) {
        function raindrops_upload_image_parser($uri,$embed = "inline",$id="#hd"){
    /* upload image from raindrops admin panel saved filename
     * e.g. raindrops-item-header-style-no-repeat-top-0-left-0-aomoriken.jpg
     * filename parse and create style
     */
            $upload_info = wp_upload_dir();
            $filename = basename($uri);
            if(file_exists(get_stylesheet_directory().'/images/'.$filename)){
                 if($id == '#hd'){
                     if(!file_exists($upload_info['path'].'/'.$filename)){
                        return 'background:url('.get_stylesheet_directory_uri().'/images/'.$filename.');background-repeat:repeat-x;';
                    }
                 }elseif($id == '#ft'){
                     if(!file_exists($upload_info['path'].'/'.$filename)){
                        return 'background:url('.get_stylesheet_directory_uri().'/images/'.$filename.');background-repeat:repeat-x;';
                     }
                 }
            }elseif(file_exists(get_template_directory().'/images/'.$filename)){
                 if($id == '#hd'){
                     if(!file_exists($upload_info['path'].'/'.$filename)){
                        return 'background:url('.get_template_directory_uri().'/images/'.$filename.');background-repeat:repeat-x;';
                    }
                 }elseif($id == '#ft'){
                     if(!file_exists($upload_info['path'].'/'.$filename)){
                        return 'background:url('.get_template_directory_uri().'/images/'.$filename.');background-repeat:repeat-x;';
                    }
                }
            }
            if( file_exists($upload_info['path'].'/'.$filename) ){
                 preg_match("|raindrops-item-([^-]+)|",$filename,$regs);
                 $purpose = $regs[1];
                 $purpose = str_replace(array("header","footer"),array("#hd","#ft"),$purpose);
                 preg_match("|-style-([^-]+)|",$filename,$regs);
                 $style = $regs[1];
                 $style = str_replace(array('no','x'),array('no-','-x'),$style);
                 preg_match("|-top-(-?[^-]+)|",$filename,$regs);
                 $top = $regs[1];
                 preg_match("|-left-(-?[^-]+)|",$filename,$regs);
                 $left = $regs[1];
                 preg_match("|-height-([^-]+)|",$filename,$regs);
                 $height = $regs[1];

                 if($embed == 'inline'){
                    return 'background:url('.$uri.');background-repeat:'.$style.';background-position:'.$left.'px '.$top.'px;min-height:'.$height.'px;';
                 }elseif($embed == 'external' or $embed == 'embed'){
                    return $purpose. '{background:url('.$uri.');background-repeat:'.$style.';background-position:'.$left.'px '.$top.'px;min-height:'.$height.'px;}';
                 }else{
                    return;
                 }
             }
             return false;
        }
    }
/**
 * Alias function Show real gradient where admin panel help
 *
 *
 *
 *
 * return string inline style rule what gradient
 */

    if (!function_exists('raindrops_gradient_single')) {
        function raindrops_gradient_single($i,$order = "asc"){
            return apply_filters("raindrops_gradient_single",raindrops_gradient_single_clone($i,$order));
        }
    }
/**
 * Alias function Create gradient style rule
 *
 *
 *
 * return string embed header current style rule set what gradient
 */
    if (!function_exists('raindrops_gradient')) {
        function raindrops_gradient(){
            return apply_filters("raindrops_gradient",raindrops_gradient_clone());
        }
    }
/**
 * Set stylesheet and few javascript
 *
 *
 *
 *
 */
if(!function_exists("add_raindrops_stylesheet") and $wp_version >= 3.4 ){
    function add_raindrops_stylesheet() {
        global $raindrops_current_theme_name, $raindrops_version;
            $themes                 = wp_get_themes();
            $current_theme          = $raindrops_current_theme_name;
			$template_uri 			= get_template_directory_uri();
			$template_path 			= get_template_directory();
			$stylesheet_uri 		= get_stylesheet_directory_uri();
			$stylesheet_path 		= get_stylesheet_directory();
            $reset_font_grid    = $stylesheet_uri.'/reset-fonts-grids.css';
            if(!file_exists($stylesheet_path.'/reset-fonts-grids.css')){$reset_font_grid    = $template_uri.'/reset-fonts-grids.css';}
            wp_register_style('raindrops_reset_fonts_grids', $reset_font_grid,array(),$raindrops_version,'all');
            wp_enqueue_style( 'raindrops_reset_fonts_grids');
            $grids  = $stylesheet_uri.'/grids.css';
            if(!file_exists($stylesheet_path.'/grids.css')){$grids    = $template_uri.'/grids.css';}

            wp_register_style('raindrops_grids', $grids,array('raindrops_reset_fonts_grids'),$raindrops_version,'all');
            wp_enqueue_style( 'raindrops_grids');
            $fonts              = $stylesheet_uri.'/fonts.css';
            if(!file_exists($stylesheet_path.'/fonts.css')){$fonts    = $template_uri.'/fonts.css';}
            wp_register_style('raindrops_fonts', $fonts,array('raindrops_grids'),$raindrops_version,'all');
            wp_enqueue_style( 'raindrops_fonts');
            $language           = get_locale();
            $lang   = $stylesheet_uri.'/languages/css/'.$language.'.css';
            if(!file_exists($stylesheet_path.$language.'.css')){$lang    = $template_uri.'/languages/css/'.$language.'.css';}
            wp_register_style('lang_style', $lang,array('raindrops_fonts'),$raindrops_version,'all');
            wp_enqueue_style( 'lang_style');
            if(raindrops_warehouse_clone("raindrops_style_type") !== 'w3standard'){
                if(file_exists(get_stylesheet_directory().'/css3.css')){
                    $raindrops_css3   = $stylesheet_uri.'/css3.css';
                }else{
                    $raindrops_css3   = $template_uri.'/css3.css';
                }
            wp_register_style('raindrops_css3', $raindrops_css3,array('raindrops_fonts'),$raindrops_version,'all');
            wp_enqueue_style('raindrops_css3');
            }
            $child              = $template_uri.'/style.css';
            wp_register_style('style', $child,array('raindrops_fonts'),$raindrops_version,'all');
            wp_enqueue_style( 'style');

            if(is_child_theme()){

                $child              = $stylesheet_uri.'/style.css';
                wp_register_style('child', $child,array('style'),$raindrops_version,'all');
                wp_enqueue_style( 'child');

            }
/* add small js*/
            $raindrops_js   = $stylesheet_uri.'/raindrops.js';
            if(!file_exists($stylesheet_path.'/raindrops.js')){$raindrops_js    = $template_uri.'/raindrops.js';}
            wp_register_script('raindrops', $raindrops_js,array('jquery'),$raindrops_version,true);
            wp_enqueue_script('raindrops');
    }
}


/**
 * filter function comment form
 *
 *
 *
 *
 */
    if(!function_exists("raindrops_comment_form")){
        function raindrops_comment_form($form){
            global $commenter;
            $form['url'] = '<p class="comment-form-url"><label for="url">' . __( 'Website', 'Raindrops') . '</label><span class="option">'.__('Option','Raindrops').'</span><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>';
            return apply_filters("raindrops_comment_form",$form);
        }
    }
/**
 * filter function remove area required
 *
 *
 *
 *
 */
    if(!function_exists("custom_remove_aria_required1")){
        function custom_remove_aria_required1($arg){
            $change = array("aria-required=\"true\"","aria-required='true'");
            $arg = str_replace($change,'',$arg);
            return $arg;
        }
    }
/**
 * filter function remove area required
 *
 *
 *
 *
 */
    if(!function_exists("custom_remove_aria_required2")){
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
    }
/**
 * Option value set when install.
 *
 *
 *
 *
 */
    if(!function_exists("setup_raindrops")){
        function setup_raindrops(){
            global $wpdb,$raindrops_base_setting;
            if(RAINDROPS_USE_AUTO_COLOR == false){
                return;
            }
            $raindrops_theme_settings = get_option('raindrops_theme_settings');
            foreach($raindrops_base_setting as $add){
                $option_name = $add['option_name'];
                if(!isset($raindrops_theme_settings[$option_name])){
                    $raindrops_theme_settings[$option_name] = $add['option_value'];
                }
            }
            $style_type                                         = raindrops_warehouse_clone("raindrops_style_type");
            $raindrops_indv_css                                 = raindrops_design_output_clone($style_type).raindrops_color_base_clone();
            $raindrops_theme_settings['_raindrops_indv_css']    = $raindrops_indv_css;
            update_option('raindrops_theme_settings',$raindrops_theme_settings,"",$add['autoload']);
        }
    }
/**
 * image element has attribute 'width','height' and image size > column width
 * style max-width value 100% set when expand height height attribute value.
 *
 * IE filter
 *
 */
    if(!function_exists("raindrops_ie_height_expand_issue")){
        function raindrops_ie_height_expand_issue($content){
            global $is_IE,$content_width;
            if($is_IE){
                preg_match_all('#(<img)([^>]+)(height|width)(=")([0-9]+)"([^>]+)(height|width)(=")([0-9]+)"([^>]+)>#',$content,$images,PREG_SET_ORDER);
                foreach($images as $image){
                    if(($image[3] == "width" and $image[5] > $content_width) or ($image[7] == "width" and $image[9] > $content_width)){
                        $content = str_replace($image[0],$image[1].$image[2].$image[6].$image[10].'>',$content);
                    }
                }
                return $content;
            }else{
                return $content;
            }
        }
    }
/**
 * Raindrops once message when install.
 *
 *
 *
 *
 *
 */
    if(!function_exists("raindrops_first_only_msg") ){
        function raindrops_first_only_msg($type=0) {
        global $raindrops_current_theme_name;
		
            if ( $type == 1 ) {
                $query  = 'raindrops_settings';
                $link   = get_site_url('', 'wp-admin/themes.php', 'admin') . '?page='.$query;
                if (version_compare(PHP_VERSION, '5.0.0', '<')) {
                $msg    = sprintf(__('Sorry Your PHP version is %s Please use PHP version 5 or later.','Raindrops'),PHP_VERSION);
                }else{
                $msg    = sprintf (__('Thank you for adopting the %1$s theme. It is necessary to set it to this theme. Please move to a set screen clicking this <a href="%2$s">Raindrops settings view</a>.', 'Raindrops' ), $raindrops_current_theme_name, $link );
                }
            }
            return '<div id="testmsg" class="error"><p>' . $msg . '</p></div>' . "\n";
        }
    }
/**
 * Management of uninstall and install.
 *
 *
 *
 *
 */
    if(!function_exists("raindrops_install_navigation")){
        function raindrops_install_navigation() {
            $install = get_option('raindrops_theme_settings');
            if ($install == false or !array_key_exists('install', $install)) {
                add_action('admin_notices', create_function(null, 'echo raindrops_first_only_msg(1);'));
                $install['install'] = true;
                update_option('raindrops_theme_settings',$install);
            } else {
                add_action('switch_theme', create_function(null, 'delete_option("raindrops_theme_settings");'));
            }
        }
    }
/**
 * insert into embed style ,javascript script and embed tags from custom field
 *
 *
 *
 *
 */

    if(!function_exists("raindrops_embed_css")){
        function raindrops_embed_css(){
            global $post, $raindrops_fluid_or_fixed,$raindrops_fluid_minimum_width,$raindrops_wp_version,$raindrops_current_theme_name;

            $css                    = raindrops_gallerys();
//#header-image
            $css                    .= "\n".raindrops_header_image( 'css' )."\n";
//site-title
            $raindrops_text_color = get_theme_mod('header_textcolor', 'dddddd' );
            if(  $raindrops_text_color !== 'blank' ){
                $css                    .= "\n#site-title a{color:#".$raindrops_text_color.';}';
            }
//page type
            if( isset($raindrops_fluid_or_fixed) and
                !empty($raindrops_fluid_or_fixed) and
                (raindrops_warehouse_clone("raindrops_page_width") == 'doc' or raindrops_warehouse_clone("raindrops_page_width") == 'doc2' or raindrops_warehouse_clone("raindrops_page_width") == 'custom-doc')){
                $css .= raindrops_is_fixed();
            }elseif(isset($raindrops_fluid_minimum_width) and !empty($raindrops_fluid_minimum_width)){
                $css .= raindrops_is_fluid();
                add_action( "wp_head", 'raindrops_fluid_layout_helper' );
            }
//#hd
            $uploads = wp_upload_dir();
            $header_image_uri = $uploads['url'].'/'.raindrops_warehouse('raindrops_header_image');
            if( $raindrops_current_theme_name !== 'raindrops' and raindrops_warehouse('raindrops_header_image') == 'header.png' ){
                $header_image_uri = str_replace( $raindrops_current_theme_name, 'raindrops', $header_image_uri );
            }

            $css                    .= "\n#hd{".raindrops_upload_image_parser($header_image_uri,'inline','#hd').'}';
//#ft
            $footer_image_uri = $uploads['url'].'/'.raindrops_warehouse('raindrops_footer_image');
            if( $raindrops_current_theme_name !== 'raindrops' and raindrops_warehouse('raindrops_footer_image') == 'footer.png' ){
                $header_image_uri = str_replace( $raindrops_current_theme_name, 'raindrops', $header_image_uri );
            }

            $css                    .=  "\n#ft{".raindrops_upload_image_parser($footer_image_uri,'inline','#ft').'}';
// 2col 3col change style helper
            $css .= '/*'. raindrops_warehouse_clone('raindrops_show_right_sidebar').'*/';
            if( raindrops_warehouse_clone('raindrops_show_right_sidebar') == "show" ){
                $css .= ' .rsidebar{display:block;} ';

            }else{
                $css .= ' .rsidebar{display:none;} ';
            }
// Custom page width helper
            if(isset($raindrops_page_width) and !empty($raindrops_page_width)){
                        $css .= raindrops_custom_width();
            }
//when manual style rule mode
            if( raindrops_warehouse_clone("raindrops_style_type") == $raindrops_current_theme_name ){
                return $css.raindrops_warehouse_clone('_raindrops_indv_css');
            }


            $raindrops_options          = get_option("raindrops_theme_settings");
            $raindrops_style_type       = $raindrops_options['raindrops_style_type'];
            $raindrops_options          = get_option('raindrops_theme_settings');
            $raindrops_base_color       = raindrops_warehouse_clone( 'raindrops_base_color' );
            $raindrops_hyperlink_color  = raindrops_warehouse_clone( 'raindrops_hyperlink_color' );
            $raindrops_indv_css         = raindrops_design_output($raindrops_style_type).raindrops_color_base($raindrops_base_color);
				//when this code exists [raindrops color_type="minimal" col="1"] in the post		
			$raindrops_indv_css         = raindrops_color_type_custom( $raindrops_indv_css );


            $css                    .= apply_filters("raindrops_indv_css",$raindrops_indv_css);
            if( $raindrops_hyperlink_color !== '' ){
                $css .= raindrops_custom_link_color( $raindrops_hyperlink_color );
            }

            $background = get_background_image();
            $color      = get_background_color();

            if(!empty($background) or !empty($color)){
                $css = preg_replace("|body[^{]*{[^}]+}|","",$css);
            }

//body background
            $body_background				= get_theme_mod( "background_color" );
            $body_background_image			= get_theme_mod( "background_image" );
            $body_background_repeat			= get_theme_mod( "background_repeat" );
            $body_background_position_x		= get_theme_mod( "background_position_x" );
            $body_background_attachment		= get_theme_mod( "background_attachment" );
			

            if( $body_background !== false and !empty( $body_background ) and !empty( $body_background_image ) ){
                $css .= "\nbody{background:#".$body_background.' url('. $body_background_image. ');}';
            }elseif( $body_background !== false and !empty( $body_background ) ){
                $css .= "\nbody{background-color:#".$body_background.';}';
            }elseif( !empty( $body_background_image ) ){
                $css                    .= "\nbody{background-image: url(". $body_background_image. ');}';
            }
			
			if( isset( $body_background_repeat ) and !empty( $body_background_repeat ) ){
                $css                    .= "\nbody{background-repeat: ". $body_background_repeat. ';}';
			}
			if( isset( $body_background_position_x ) and !empty( $body_background_position_x ) ){
                $css                    .= "\nbody{background-position:top ". $body_background_position_x. ';}';
			}
			if( isset( $body_background_attachment ) and !empty( $body_background_attachment ) ){
                $css                    .= "\nbody{background-attachment: ". $body_background_attachment. ';}';
			}

            if(empty($css)){
                $css = "cannot get style value check me";
            }

        /*  $raindrops_options['_raindrops_indv_css'] = $css;
            update_option( "raindrops_theme_settings", $raindrops_options );*/

            if(WP_DEBUG !== true){
            $css = str_replace(array("\n","\r","\t",'&quot;','--','\"'),array("","","",'"','','"'),$css);
            }else{
            $css = str_replace(array('&quot;','--','\"'),array('"','','"'),$css);
            }

            return apply_filters("raindrops_embed_meta_css",$css);

        }
    }

/**
 *
 *
 *
 *
 *
 */

if(!function_exists("raindrops_custom_link_color")){
	function raindrops_custom_link_color( $color ){
		$css =<<< LINK_COLOR_CSS
	.entry-content a:link,
	.entry-content a:active,
	.entry-content a:visited,
	.entry-content a:hover{
	color:{$color};
	}
	
	.entry-title a:link,
	.entry-title a:active,
	.entry-title a:visited,
	.entry-title a:hover{
	color:{$color};
	}
	
	.posted-on a:link,
	.posted-on a:active,
	.posted-on a:visited,
	.posted-on a:hover{
	color:{$color};
	}
	.entry-meta-default .entry-date{
	color:{$color};
	}/*single.php*/
	.entry-meta-default .author a{
	color:{$color};
	}/*single.php*/
	
	.post .entry-meta,
	.entry-meta a:link,
	.entry-meta a:active,
	.entry-meta a:visited,
	.entry-meta a:hover{
	color:{$color};
	}
	
	.rsidebar a:link,
	.rsidebar a:active,
	.rsidebar a:visited,
	.rsidebar a:hover{
	color:{$color};
	}
	.lsidebar a:link,
	.lsidebar a:active,
	.lsidebar a:visited,
	.lsidebar a:hover{
	color:{$color};
	}
	
	.lsidebar .widgettitle,
	.rsidebar .h2{
	color:{$color};
	}
	#wp-calendar{
	color:{$color};
	}
	.raindrops-comment-link em,
	.raindrops-comment-link a:link em,
	.raindrops-comment-link a:active em,
	.raindrops-comment-link a:visited em,
	.raindrops-comment-link a:hover em{
	color:{$color}!important;
	}
	
	#nav-above .nav-previous a,
	#nav-above .nav-next a,
	#nav-below .nav-previous a,
	#nav-below .nav-next a{
	color:{$color};
	
	}
	.logged-in-as a:link,
	.logged-in-as a:active,
	.logged-in-as a:visited,
	.logged-in-as a:hover{
	color:{$color};
	}
LINK_COLOR_CSS;
	

    if(preg_match("!#([0-9a-f]{6}|[0-9a-f]{3})!si",$color)){
		return apply_filters("raindrops_custom_link_color",$css);
	}
	
	}
}
/**
 *
 *
 *
 *
 *
 */

    if(!function_exists("raindrops_embed_meta")){
        function raindrops_embed_meta($content){
            global $post;
            $result = "";
            $css = raindrops_embed_css();

            if ( is_single() || is_page() ){
                if(have_posts()){
                 while (have_posts()) : the_post();
                    if(RAINDROPS_USE_AUTO_COLOR !== true){
                        $css = '';
                    }
                    $css    .= get_post_meta($post->ID, 'css', true);
                    if (!empty($css)) {
                    $result .= '<style type="text/css" id="raindrops-embed-css">';
                    $result .= "\n<!--/*<![CDATA[*/\n";
                    $result .=  $css;
                    $result .= "\n/*]]>*/-->\n";
                    $result .= "</style>";
                    }
                    $javascript = get_post_meta($post->ID, 'javascript', true);
                    if (!empty($javascript)) {
                    $result .= '<script type="text/javascript">';
                    $result .= "\n<!--/*<![CDATA[*/\n";
                    $result .= $javascript;
                    $result .= "\n/*]]>*/-->\n";
                    $result .= "</script>";
                    }
                    $meta = get_post_meta($post->ID, 'meta', true);
                    if (!empty($meta)) {
                    $result .= $meta;
                    }
                  endwhile;
                }
            }else{
                    if(RAINDROPS_USE_AUTO_COLOR == true){
                        $result .= '<style type="text/css">';
                        $result .= "\n<!--/*<![CDATA[*/\n";
                        $result .=  $css;
                        $result .= "\n/*]]>*/-->\n";
                        $result .= "</style>";
                    }
            }
            echo $result;
            return $content;
        }
    }
/**
 * Alternative character when value is blank
 *
 *
 *
 *
 */
    if(!function_exists("raindrops_blank_fallback")){
        function raindrops_blank_fallback($string,$fallback){
            if(!empty($string)){
                return $string;
            }else{
                return $fallback;
            }
        }
    }
/**
 * Article navigation
 *
 *
 *
 *
 */
    if(!function_exists("raindrops_prev_next_post")){
        function raindrops_prev_next_post($position = "nav-above"){
            $raindrops_max_length       = 40;
            $raindrops_prev_length      = $raindrops_max_length + 1;
            if(!is_attachment()){
                $raindrops_max_length   = 40;
                $raindrops_prev_post_id = get_adjacent_post(true,'',true) ;
                $raindrops_prev_length  = strlen(get_the_title($raindrops_prev_post_id));
                $raindrops_next_post_id = get_adjacent_post(false,'',false) ;
                $raindrops_next_length  = strlen(get_the_title($raindrops_next_post_id));
            }
            $html = '<div id="%1$s" class="%2$s"><span class="%3$s">';

            printf($html,$position,"clearfix","nav-previous");
            previous_post_link('%link','<span class="button"><span class="meta-nav">&laquo;</span> %title</span>');
            $html = '</span><div class="%1$s">';
            printf($html,"nav-next");
            next_post_link('%link','<span class="button"> %title <span class="meta-nav">&raquo;</span></span>');
            $html = '</div></div>';
            echo apply_filters("raindrops_prev_next_post",$html);
        }
    }

/**
 * date.php
 *
 *
 *
 *
 */
    if(!function_exists("raindrops_days_in_month")){
        function raindrops_days_in_month($month, $year) {
                $daysInMonth = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
                if ($month != 2) {
                        return $daysInMonth[$month - 1];
                }
                return (checkdate($month, 29, $year)) ? 29 : 28;
        }
    }
/**
 *
 *
 *
 *
 *
 */
    if(!function_exists("raindrops_get_month")){
        function raindrops_get_month ($posts = '', $year = '', $this_month = '', $pad = 1) {
            global $wpdb, $weekdaynames, $month;
            // info about this month
            $raindrops_days_in_month      = raindrops_days_in_month($this_month, $year);
            $first_day_of_month = date('w', mktime(0, 0, 0, $this_month, '1', $year));
            $last_day_of_month  = date('w', mktime(0, 0, 0, $this_month, $raindrops_days_in_month, $year));
            // what day starts the week here?
            $start_of_week = get_option('start_of_week');
            if (0 != $start_of_week) {
                    $end_of_week = 6 - (7 - $start_of_week);
            } else {
                    $end_of_week = 7;
            }
            // one week here
            for ($i = $start_of_week; $i < ($start_of_week + 7); $i++) {
                    if ($i >= 7) {
                            $one_week[] = $weekdaynames[$i - 7];
                    } else {
                            $one_week[] = $weekdaynames[$i];
                    }
            }
            // pad the beginning of the calendar with dates from last month
            // grab any post data for those days
            $pre_pad = 0;
            $before = '';
            if ($start_of_week != $first_day_of_month) {
                    if ($first_day_of_month > $start_of_week) {
                            $pre_pad = ($first_day_of_month - $start_of_week);
                    } elseif ($start_of_week > $first_day_of_month) {
                            $pre_pad = (7 - $start_of_week) + $first_day_of_month;
                    }
            }
            $days_in_last_month = date('t', mktime(0, 0, 0, $this_month-1, '1', $year));
            if ( (0 != $pre_pad) && ($pad) ) {
                    $start = ($days_in_last_month - $pre_pad)+1;
                    $lastmonth = $this_month - 1;
                $old_posts = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_status = 'publish' AND post_date >
            '$year-$lastmonth-$start 00:00:01' AND post_date < '$year-$lastmonth-$days_in_last_month 23:59:59' ORDER BY post_date");
                if ($old_posts) {
                        $last_month = array();
                        foreach ($old_posts as $post) {
                                $day = substr($post->post_date, 8, 2);
                                if (! isset($last_month[$day])) {
                                        $last_month[$day] = "<a href=\"" . get_permalink($post->ID) . "\"
        title=\"$post->post_title\">$day</a>";
                                } else {
                                        $last_month[$day] = "<a href=\"" . home_url() . "/$year/$lastmonth/$day\"
        title=\"/$year/$lastmonth/$day\">$day</a>";
                                }
                        }
                }
            }
            for ($i = ($days_in_last_month - $pre_pad)+1; $i <= $days_in_last_month; $i++) {
                            if (! $pad) {
                                    $before .= '<td> </td>';
                            } else {
                                    $before .= '<td class="lastmonth">';
                                    if (isset($last_month[$i])) {
                                            $before .= $last_month[$i];
                                    } else {
                                            $before .= $i;
                                    }
                                    $before .= '</td>';
                            }
            } // end if ($pad) ...
            $the_month = array();
            // prepare an array for this month's posts, by date
            if (! empty($posts)) {
                    foreach ($posts as $post) {
                            $day = substr($post->post_date, 8, 2);
                            if (10 > $day) {
                                    $day = substr($day, 1, 1);
                            }
                            if (! isset($the_month[$day])) {
                                    $the_month[$day] = "<a href=\"" . get_permalink($post->ID) . "\" title=\"$post->post_title\">$day</a>";
                            } else {
                                    $the_month[$day] = "<a href=\"" . home_url() . "/$year/$this_month/" . zeroise($day, 2) . "\"
            title=\"$year/$this_month/" . zeroise($day, 2) . "\">$day</a>";
                            }
                    }
            }
            $daycount = $pre_pad;
            $cal = "<h2 class=\"h2\"><a href=\"".raindrops_get_year_link($year)."\" title=\"$year\">$year</a> <a href=\"". get_month_link($year,$this_month)."\"
            title=\"$year/$this_month\">" .
            $month[zeroise($this_month, 2)] . "</a></h2>";
            $cal .= '<table summary="Archives in '.$this_month.', '.$year.'"><tr>';
            foreach ($one_week as $day) {
                    $cal .= "<th>$day</th>";
            }
            $cal .= '</tr><tr>' . $before;
            for ($i = 1; $i <= $raindrops_days_in_month; $i++) {
                    $cal .= '<td> ';
                    if (isset($the_month[$i])) {
                            $cal .=  $the_month[$i];
                    } else {
                            $cal .= $i;
                    }
                    $cal .= ' </td>';
                    $daycount++;
                    if ($daycount >= 7) {
                            $cal .= '</tr><tr>';
                            $daycount = 0;
                    }
            }
            $after = '';
            // if necessary, pad the end of the calendar with dates from next month
            // grab any post data for those days
            if ( ($end_of_week != $last_day_of_month) && ($pad) ) {
                    $end = (7 - $daycount);
                    $nextmonth = $this_month + 1;
                    $new_posts = $wpdb->get_results("SELECT ID, post_title, post_date FROM $wpdb->posts WHERE post_status = 'publish' AND
            post_date > '$year-$nextmonth-01 00:00:01' AND post_date < '$year-$nextmonth-0$end 23:59:59' ORDER BY post_date");
                    if ($new_posts) {
                            if (10 > $nextmonth) {
                                    $nextmonth = printf("%02d", $nextmonth);
                            }
                            $next_month = array();
                            foreach ($new_posts as $post) {
                                    $day = substr($post->post_date, 9, 1);
                                    if (! isset($next_month[$day])) {
                                            $next_month[$day] = "<a href=\"" . get_permalink($post->ID) . "\"
            title=\"$post->post_title\">$day</a>";
                                    } else {
                                            $next_month[$day] = "<a href=\"" . home_url() . "/$year/$nextmonth/0$day\"
            title=\"/$year/0$nextmonth/$day\">$day</a>";
                                    }
                            }
                    }
            }
            for ($i = 1; $i <= (7 - $daycount); $i++) {
                    if (! $pad) {
                            $after .= '<td> </td>';
                    } else {
                            $after .= '<td class="lastmonth">';
                            if (isset($next_month[$i])) {
                                    $after .= $next_month[$i];
                            } else {
                                    $after .= $i;
                            }
                            $after .= '</td>';
                    }
            } // end if ($pad) ...
            $cal .= $after;
            $cal .= '</tr></table>';
            return $cal;
        }
    }
/*end raindrops_get_month()*/
/**
 * for date.php
 *
 *
 *
 *
 */
    if(!function_exists("raindrops_get_year")){
        function raindrops_get_year($posts = '', $year = '', $pad = 0) {
            global $calendar_page_number,$post_per_page, $calendar_page_last, $calendar_page_start;
            $months = array();
            $y = "";
            $m = "";
            $d = "";
            // first let's parse through our posts, organizing them by month
            foreach ($posts as $post) {
                    $y = substr($post->post_date, 0, 4);
                    $m = substr($post->post_date, 5, 2);
                    $d = substr($post->post_date, 8, 2);
                    $months[$m][] = $post;
            }
            $output = "<h2 class=\"h2 year\"><span class=\"year-name\">$year</span></h2>";
                $table_year = array(
                    '<table id="raindrops_year_list" summary="Archives in '.$year.'"><tbody>',
                    '<tr><td class="month-name">1</td><td></td></tr>',
                    '<tr><td class="month-name">2</td><td></td></tr>',
                    '<tr><td class="month-name">3</td><td></td></tr>',
                    '<tr><td class="month-name">4</td><td></td></tr>',
                    '<tr><td class="month-name">5</td><td></td></tr>',
                    '<tr><td class="month-name">6</td><td></td></tr>',
                    '<tr><td class="month-name">7</td><td></td></tr>',
                    '<tr><td class="month-name">8</td><td></td></tr>',
                    '<tr><td class="month-name">9</td><td></td></tr>',
                    '<tr><td class="month-name">10</td><td></td></tr>',
                    '<tr><td class="month-name">11</td><td></td></tr>',
                    '<tr><td class="month-name">12</td><td></td></tr>',
                    '</tbody></table>');
            foreach ($months as $num => $val) {
                $num = (int)$num;
                 $table_year[$num] = '<tr><td class="month-name"><a href="'.get_month_link($year,$num)."\" title=\"$year/$num\">".$num.'</a></td><td class="month-excerpt"><a href="'. get_month_link($year,$num)."\" title=\"$year/$num\">".sprintf(__("%s Articles archived","Raindrops"),count($val)).'</a></td></tr>';
            }
        return $output.implode("\n",$table_year);
        }
    }
/* end raindrops_get_year()*/
/**
 * for date.php
 *
 *
 *
 *
 */
    if(!function_exists("raindrops_get_day")){
        function raindrops_get_day($posts = '', $year = '', $mon = '', $day = '', $pad = 1){
            global $month;
            $here = home_url();
            $output = "<h2 class=\"h2 year-month-date\"><a href=\"".get_year_link($year)."\" title=\"$year\"><span class=\"year-name\">$year</span></a> <a href=\"".get_month_link($year,$mon)."\" title=\"$year/$mon\"><span class=\"month-name\">" .
           $mon . "</span></a>&nbsp;<span class=\"day-name\">". $day ."</span></h2>";
            $output .= '<table id="date_list" summary="Archive in '.$day.', '.$mon.', '.$year.'">';
            foreach ($posts as $mytime) {
                    $h = substr($mytime->post_date, 11, 2);
                    if (10 > $h) {
                            $h = substr($h, 1, 1);
                    }
                    $today[$h][] = $mytime;
            }
            for ($i = 0; $i <= 24; $i++) {
                    $output .= '<tr><td class="time">';
                    if (10 > $i) {
                            $output .= "0$i:00";
                    } else {
                            $output .= "$i:00";
                    }
                    $output .= '</td><td>';
                    if (isset($today[$i])) {
                                    foreach ($today[$i] as $mytime) {
                                        $mytime->post_title = raindrops_fallback_title($mytime->post_title);
                                            $output .= "<a href=\"" . get_permalink($mytime->ID) . "\"
            title=\"".esc_attr($mytime->post_title)."\">$mytime->post_title</a><br />";
                                    }
                    } else {
                            $output .= '<span style="visibility:hidden;">.</span>';
                    }
                    $output .= '</td></tr>';
            }
            $output .= '</table>';
            return $output;
        }
    }
/* end raindrops_get_day()*/
/**
 * for date.php
 *
 *
 *
 *
 */
    if(!function_exists("raindrops_year_list")){
        function raindrops_year_list($one_month,$ye,$mo){
            $result = "";
            global $calendar_page_number,$post_per_page, $calendar_page_last, $calendar_page_start;
            $d = "";
            $links = "";
                foreach($one_month as $key=>$month){
                    list($y,$m,$d) = sscanf($month->post_date,"%d-%d-%d $d:$d:$d");
                         $month->post_title = raindrops_fallback_title($month->post_title);
                        if($m == $mo and $ye == $y){
                            $links .= "<li class=\"$mo\"><a href=\"" . get_permalink($month->ID) . "\" title=\"".esc_attr($month->post_title)."\">".$month->post_title."</a></li>";
                        }
                }
                if(!empty($links)){
                    $result .= " <td><ul>";
                    $result .= $links;
                    $result .= "</ul></td>";
                 }
            return $result;
        }
    }
/**
 * sort month_list
 *
 *
 *
 *
 */
    if(!function_exists("raindrops_cmp_ids")){
        function raindrops_cmp_ids( $a , $b){
          $cmp = strcmp( $a->post_date , $b->post_date );
          return $cmp;
        }
    }
/**
 * for date.php
 *
 *
 *
 *
 *
 */
if(!function_exists("month_list")){
    function month_list($one_month,$ye,$mo){
    global $calendar_page_number,$post_per_page, $calendar_page_last, $calendar_page_start;
        $result = "";
        $here = home_url();
        $z = -1;
            $c = 0;
    for($i=1;$i <= raindrops_days_in_month($mo, $ye);$i++){
        $links = "";
    usort( $one_month , "raindrops_cmp_ids" );
        $page_break = false;
        $first_data = false;
        foreach($one_month as $key=>$month){
             $month->post_title = raindrops_fallback_title($month->post_title);
            list($y,$m,$d,$h,$m,$s) = sscanf($month->post_date,"%d-%d-%d %d:%d:%d");
            if($key <  $calendar_page_last and $key >= $calendar_page_start){
                if($d == $i and $m == $mo and $y == $ye){
                $first_data = true;
                 $month->post_title = raindrops_fallback_title($month->post_title);
                $links .= "<li><a href=\"" . get_permalink($month->ID) . "\" title=\"".esc_attr($month->post_title)."\">".$month->post_title."</a></li>";
                $c++;
                }
            }
        }
        if($z == $c and $c == $post_per_page){
            break ;
        }
        if(!empty($links)){
        $result .= "<tr><td class=\"month-date\"><span class=\"day-name\">";
        $result .= "<a href=\"".get_day_link($y, $mo, $i)."\">";
        $result .= $i;
        $result .= " </a></span></td><td><ul>";
        $result .= $links;
        $result .= "</ul></td></tr>";
        }else{
        $result .= "<tr class=\"no-archive\"><td class=\"month-date\"><span class=\"day-name\">";
            $result .= $i;
            $result .= " </span></td><td>&nbsp;</td></tr>";
        }
        $z = $c;
    }
        $output = "<h2 id=\"date_title\" class=\"h2 year-month\"><a href=\"".get_year_link($y)."\" title=\"$y\"><span class=\"year-name\">{$y} </span></a> <span class=\"month-name\">" . $m . " </span></h2>";
        return $output."<table id=\"month_list\">".$result."</table>";
    }
}
/**
 * index ,archive,loops page title
 *
 * echo Archives title
 *
 *
 */
if(!function_exists("raindrops_loop_title")){
    function raindrops_loop_title(){
        $Raindrops_class_name = "";
        $page_title = "";
        if(is_search()){
            $Raindrops_class_name = 'serch-result';
            $page_title = __("Search Results",'Raindrops');
            $page_title_c = get_search_query();
        }elseif(is_tag()){
            $Raindrops_class_name = 'tag-archives';
            $page_title = __("Tag Archives",'Raindrops');
            $page_title_c = single_term_title("", false);
        }elseif(is_category()){
            $Raindrops_class_name = 'category-archives';
            $page_title = __("Category Archives",'Raindrops');
            $page_title_c = single_cat_title('', false);
        }elseif (is_archive()){
             $raindrops_date_format = get_option('date_format');
            if (is_day()){
                $Raindrops_class_name = 'dayly-archives';
                $page_title = __('Daily Archives', 'Raindrops');
                $page_title_c = get_the_date(get_option($raindrops_date_format));
            }elseif (is_month()){
                $Raindrops_class_name = 'monthly-archives';
                $page_title = __('Monthly Archives', 'Raindrops');
                if(get_locale() == 'ja'){
                    $page_title_c = get_the_date('Y / F');
                }else{
                    $page_title_c = get_the_date('F Y');
                }
            }elseif (is_year()){
                $Raindrops_class_name = 'yearly-archives';
                $page_title = __('Yearly Archives', 'Raindrops');
                $page_title_c = get_the_date('Y');
            }elseif (is_author()){
                $Raindrops_class_name = 'author-archives';
                $page_title =   __("Author Archives",'Raindrops');
                while (have_posts()){ the_post();
                    $page_title_c = get_avatar( get_the_author_meta( 'user_email' ),  32  ).' '.get_the_author();
                    break;
                }
                rewind_posts();
            }else{
                $Raindrops_class_name = 'blog-archives';
                $page_title = __("Blog Archives",'Raindrops');
            }
        }
    echo '<ul class="index '.esc_attr($Raindrops_class_name).'">';
        if(!empty($page_title)){
            printf('<li><strong class="f16" id="archives-title">%s <span>%s</span></strong></li>',
                    $page_title,
                    $page_title_c
            );
        }
    }
}
/**
 * yui helper function
 *
 *
 *
 *
 *
 */
    if(!function_exists("raindrops_yui_class_modify")){
        function raindrops_yui_class_modify($raindrops_inner_class = 'yui-ge'){
            global $yui_inner_layout;
            if(isset($yui_inner_layout)){
                $raindrops_inner_class = $yui_inner_layout;
            }
            return $raindrops_inner_class;
        }
    }
/**
 * Template conditional function Raindrops display 2column or not
 *
 *
 * @param string   css rule or text
 * @param bool      if value is true echo or false return
 * @return string  input strings text
 */
    if(!function_exists("is_2col_raindrops")){
        function is_2col_raindrops($action = true,$echo = true){
            if(raindrops_warehouse_clone('raindrops_show_right_sidebar') == 'hide'){
                if($echo == true){
                    echo $action;
                }else{
                    return $action;
                }
            }else{
                return false;
            }
        }
    }
/**
 * yui layout curc
 *
 *
 *
 * @return content width
 */
    if(!function_exists("raindrops_main_width")){
        function raindrops_main_width(){
            return raindrops_content_width_clone();
        }
    }
/**
 * content width curc
 *
 *
 *
 *
 * @return main column width
 */
    if(!function_exists("raindrops_content_width")){
        function raindrops_content_width(){
            return raindrops_content_width_clone();

        }
    }
/**
 * fallback stylesheet
 *
 *
 *
 *
 */
if(!function_exists("raindrops_w3standard")){
    function raindrops_w3standard(){
$font_color = raindrops_colors($num = 5, $select = 'color',$color1 = null);
$style =<<<DOC
legend,
a:link,a:active,a:visited,a:hover,
.lsidebar,
#sidebar,
.rsidebar,
#doc,#doc2,#doc3,#doc4,
#hd,
h1,
#yui-main,
.entry ol ol ,.entry ul,
.entry ul * {
%c5%
}
.footer-widget h2,.rsidebar h2,.lsidebar h2 {
%c5%
%h2_w3standard_background%
%h_position_rsidebar_h2%
}
body {
    margin:0!important;padding:0;
    background-repeat:repeat-x;
}
#yui-main{
    color:%raindrops_header_color%;
}
#hd{
    background-image:url(%raindrops_hd_images_path%%raindrops_header_image%);
}
.hfeed{
    background:#fff;
}
#ft {
    background:url(%raindrops_images_path%%raindrops_footer_image%) repeat-x;
    color:%raindrops_footer_color%;
}
.footer-widget h2,
.rsidebar h2,
.lsidebar h2 {
/*%h2_w3standard_background%*/
%h_position_rsidebar_h2%
}
.rsidebar ul li ul li,
.lsidebar ul li ul li{
list-style-type:square;
list-style-position:inside;
}
.ie8 .lsidebar .widget ul li a {
    list-style:none;
}
.home .sticky {
%c5%
border-top:solid 6px %c_border%;
border-bottom:solid 2px %c_border%;
}
.entry-meta{
%c4%
border-top:solid 1px %c_border%;
border-bottom:solid 1px %c_border%;
}
textarea,
input[type="password"],
input[type="text"],
input[type="submit"],
input[type="reset"],
input[type="file"]{
    %c4%
}
input[type="checkbox"],
input[type="radio"],
select{
    %c4%
}
.social textarea#comment,
.social input[type="text"] {
    outline:none;
    %c3%
}
.social textarea#comment:focus,
.social input:focus{
    %c4%
}
.entry-content ul li{
    list-style-type:square;
}
.entry-content input[type="submit"],
.entry-content input[type="reset"],
.entry-content input[type="file"]{
    %c4%
}
.entry-content input[type="submit"],
.entry-content input[type="radio"]{
    %c3%
}
.entry-content select{
    %c4%
}
.entry-content blockquote{
    %c4%
    border-left:solid 6px %c_border%;
}
cite{
    %c4%
}
cite a:link,
cite a:active,
cite a:visited,
cite a:hover{
    $font_color
}
.entry-content fieldset {
    border:solid 1px %c_border%;
}
.entry-content legend{
    %c5%
}
.entry-content td{
    %c4%
    border:solid 1px %c_border%;
}
.entry-content th{
    %c3%
    border:solid 1px %c_border%;
}
hr{
border-top:1px dashed %c_border%;
}
/*--------------------------------*/
#access{
    /*%c3%*/
}
#access a {
}
#access ul ul a {
    %c3%
}
#access li:active > a,
#access ul ul :active > a {
    top:0;
    %c2%
    color:%custom_color%
}
#access ul li.current_page_item > a,
#access ul li.current-menu-ancestor > a,
#access ul li.current-menu-item > a,
#access ul li.current-menu-parent > a {
    %c3%
}
.ie6 #access ul li.current_page_item a,
.ie6 #access ul li.current-menu-ancestor a,
.ie6 #access ul li.current-menu-item a,
.ie6 #access ul li.current-menu-parent a,
.ie6 #access ul li a:hover {
    %c2%
}
table,
table td,
#access > li{
    border:1px solid #ccc;
}
tfoot td{
    border:none;
}
.lsidebar  li,
.rsidebar li{
    border:none!important;
}
td.month-date,td.month-name,td.time{
    %c4%
}
.datetable td li{
}
address{margin:10px auto;}
.wp-caption {
}
li.byuser,
li.bypostauthor {
%c5%
}
.comment-meta a,
cite.fn{
}
.datetable td li{
}
.fail-search,
#not-found {
%c3%
border:3px double;
}
.rd-page-navigation li{
border-left:solid 1px %c_border%;
%c5%
}
.rd-page-navigation a{
%c5%
}
.rd-page-navigation .current_page_item{
%c4%
}
.raindrops-tab-content,
.raindrops-tab-list li{
border:1px solid %c_border%;
}
/*comment bubble*/
a.raindrops-comment-link {
}
.raindrops-comment-link em {
%c4%
  position: relative;
}
.raindrops-comment-link .point {
  border-left: 0.45em solid %c_border%;
  border-bottom: 0.45em solid #FFF; /* IE fix */
  border-bottom: 0.45em solid %c_border%;
  overflow: hidden; /* IE fix */
}
a.raindrops-comment-link:hover {
}
a.raindrops-comment-link:hover em {
%c5%
}
a.raindrops-comment-link:hover .point {
border-left:1px solid %c_border%;
}
DOC;
return $style;
    }
}
/**
 * plugin API
 *
 *
 *
 *
 *
 */
    if(!function_exists("plugin_is_active")){
        function plugin_is_active($plugin_path) {
            $return_var = in_array( $plugin_path, get_option( 'active_plugins' ) );
            return $return_var;
        }
        if (plugin_is_active('tmn-quickpost/tmn-quickpost.php')) {
                global $base_info;
                foreach( $base_info['root'] as $key=>$val ) {
                    $wp_cockneyreplace['%'.$key.'%'] = $val;
                }
            function raindrops_import_post_meta(){
                global $post,$base_info;
                $r = get_post_meta($post->ID, 'template', true);
                foreach( $base_info['root'] as $key=>$val ) {
                    $r = str_replace('%'.$key.'%', $val,$r);
                }
                if(class_exists('trans')){
                    $n = new trans($r);
                    return $n->text2html();
                }else{
                    return $r;
                }
            }
        }
    }
/** Custom Image Header for Raindrops theme
 *
 *
 *
 *
 *
 */
if ( ! function_exists( 'raindrops_header_style' ) ){
    function raindrops_header_style(){
        ?>
        <?php
    }
}
if ( ! function_exists( 'raindrops_admin_header_style' ) ){
    function raindrops_admin_header_style() {
        $raindrops_options  = get_option("raindrops_theme_settings");
        $css                = $raindrops_options['_raindrops_indv_css'];
        $css                = raindrops_color_type_custom($css);
        $background         = get_background_image();
        $color              = get_background_color();
        $text_color         = get_header_textcolor();
        $page_width         = raindrops_warehouse_clone('raindrops_page_width');
        switch($page_width){
            case("doc"):
                $custom_header_width = '750px';
            break;
            case("doc2"):
                $custom_header_width = '950px';
            break;
            case("doc3"):
                $custom_header_width = '974px';
            break;
            case("doc4"):
                $custom_header_width = '100%';
            break;
        }
        if(!empty($background) or !empty($color)){
            $css = preg_replace("|body[^{]*{[^}]+}|","",$css);
        }
        $css_result = "";
        $csses = explode("\n",$css);
        foreach($csses as $k=>$v){
           if(preg_match('!^.+(,|{)!si',$v,$regs)){
            $css_result .= '#headimg '.$regs[0]."\n";
           }else{
            $css_result .= $v."\n";
           }
        }
        $css_result = str_replace(array('#headimg body','a:hover'),array('#headimg','a'),$css_result);
?>
        <style type="text/css">
<!--
a:hover{color:none;}
#headimg{
width:<?php echo $custom_header_width;?>!important;
position:relative;
}
#headimg #hd {
    overflow:hidden;
    padding:.5em 1em;
    min-height:5em;
}
#headimg #hd h1,
#headimg #hd h1 a,
#headimg #hd .h1 a,
#headimg #hd #site-title{
    font-size:174%;
    letter-spacing: 0.05em;
    background:none;
    }
#headimg #hd #site-title{
    display:inline-block!important;
    max-width:74%;
}
#headimg #hd #site-title a{
    color:#<?php echo $text_color;?>!important;}
}
#headimg #top{
    padding-bottom:5px;
    position:relative;
}
#headimg #site-title{
    display:inline-block!important;
    max-width:74%;
    clear:both;
    font-weight:bold;
    overflow:hidden;
    margin:.5em 0;
    font-family:"Times New Roman", Times, serif;
}
#headimg #site-description {
    position:absolute;
    top:10px;
    right:10px;
}
#headimg #access {
    display: block;
    float: left;
    margin: 0 auto;
    width:99%;
    margin-left:0.5%;
    margin-top:5px;
}
#headimg #access .menu,
#headimg #access div.menu ul{
    font-family: "Helvetica Neue", Arial, Helvetica, "Nimbus Sans L", sans-serif;
}
#headimg #headimg .ie8 #access {
    margin-left:0;
    width:100%;
    margin-top:0;
}
#headimg #header-image{
    position:relative;
}
#headimg #header-image p{
    position:relative;
    top:35%;
    text-align:center;
    font-size:200%;
    position:relative;
    top:35%;
    text-align:center;
    font-size:200%;
    text-shadow: 0 0 2px #fff, 0 0 2px #fff, 0 0 2px #fff, 0 0 2px #fff;
    /*filter:progid:DXImageTransform.Microsoft.Glow(Color=white,Strength=2);*/
}
#headimg #site-description {
    text-align:right;
}
#headimg #site-description {
    max-width:24%;
    }
#headimg #access ul ul {
    box-shadow: 0px 3px 3px rgba(0,0,0,0.2);
    -moz-box-shadow: 0px 3px 3px rgba(0,0,0,0.2);
    -webkit-box-shadow: 0px 3px 3px rgba(0,0,0,0.2);
}
#headimg .wp-caption {
   /* optional rounded corners for browsers that support it */
   -moz-border-radius: 3px;
   -khtml-border-radius: 3px;
   -webkit-border-radius: 3px;
   border-radius: 3px;
}
#headimg .wp-caption {
   /* optional rounded corners for browsers that support it */
   -moz-border-radius: 3px;
   -khtml-border-radius: 3px;
   -webkit-border-radius: 3px;
   border-radius: 3px;
}
#headimg .shadow{
    box-shadow: 7px 7px 8px #cccccc;
    -webkit-box-shadow: 7px 7px 8px #cccccc;
    -moz-box-shadow: 7px 7px 8px #cccccc;
    /*filter: progid:DXImageTransform.Microsoft.dropShadow(color=#cccccc, offX=7, offY=7, positive=true);zoom:1;*/
}
#headimg #access{
    -webkit-text-size-adjust: 120%;
}
<?php echo $css_result;?>
 a, a:hover{
background:none;
}
#wp-admin-bar-comments a,
#wp-admin-bar-view-site a{
    color:#ddd!important;
}
span#site-title,
#message a{
    color: #21759B!important;
}-->
        </style>
<?php
    }
}






if ( ! function_exists( 'raindrops_admin_header_image' ) ){
    function raindrops_admin_header_image(){
        global $raindrops_current_theme_name;
        $raindrops_header_image = get_header_image();
        /*get_bloginfo( 'name' );*/
        $raindrops_header_style = 'style="color:#'.get_theme_mod( 'header_textcolor' ).'"';
        $html ='<div id="%1$s"><div id="%2$s">';
        printf($html,'headimg','top');
        $uploads            = wp_upload_dir();
        $header_image_uri   = $uploads['url'].'/'.raindrops_warehouse_clone('raindrops_header_image');
        $html = '<div id="%1$s" style="%2$s">';
        $exception_page_width = raindrops_warehouse_clone('raindrops_page_width');
        if($exception_page_width == 'doc3'){
        /* doc3 fluid layout , image displayed shrink , expand */
            $add_fluid_style = "width:480px;";
            $add_fluid_style_description_html = '<div style="position:absolute;left:520px;top:20px;"><p>'.__( 'Current theme is fluid settings','Raindrops' ).'</p><p>'.__( 'image size will be shrink to fit page' , 'Raindrops' ).'</p>';

            $add_fluid_style_description_html .= '<li><a href="'.admin_url().'themes.php?page=raindrops_settings#raindrops-page-width">'. __( 'Theme Settings', 'Raindrops' ).'</a></li>';

            $add_fluid_style_description_html .= '<li><a href="'.admin_url().'admin.php?customize=on&theme='. $raindrops_current_theme_name.'">'.__( 'Settings with Live preview ', 'Raindrops' ).'</a></li></ul>';

            $add_fluid_style_description_html .= '</div>';
        }else{
            $add_fluid_style = "";
            $add_fluid_style_description_html = '';
        }

        printf($html,'hd',raindrops_upload_image_parser($header_image_uri,'inline','#hd').$add_fluid_style);

/** Site description display position
 *
 *
 * Site description diaplay at image when if header text Display Text value is yes.
 * Site description diaplay at header bar when if header text Display Text value is no.
 *
 *
 */
        if ( 'blank' == get_theme_mod('header_textcolor') || '' == get_theme_mod('header_textcolor')  ){
            $raindrops_show_hide = '';
            $style = ' style="display:none;"';
        }elseif(preg_match("!([0-9a-f]{6}|[0-9a-f]{3})!si",get_header_textcolor())){
            $style = ' style="color:#' . get_header_textcolor() . ';"';
            $raindrops_show_hide = ' style="display:none;"';
        }else{
            $style = '';
            $raindrops_show_hide = ' style="display:none;"';
        }
/**
 * Conditional Switch html headding element
 *
 *
 *
 *
 *
 */
        if( is_home() or is_front_page() ){
            $heading_elememt = 'h1';
        }else{
            $heading_elememt = 'div';
        }

        $title_format = '<%s class="h1" id="site-title"><span><a href="%s" title="%s" rel="%s">%s</a></span></%s>';
        printf(
            $title_format,
            $heading_elememt,
            home_url(),
            esc_attr(get_bloginfo( 'name', 'display' )),
            "home",
            get_bloginfo( 'name', 'display' ),
            $heading_elememt
        );
/**
 * Site description diaplay at header bar when if header text Display Text value is no.
 *
 *
 *
 *
 */
        $raindrops_site_desctiption_html = '<div id="site-description" %s>%s</div></div>';
        printf(
            $raindrops_site_desctiption_html,
            $raindrops_show_hide,
            get_bloginfo( 'description' )
        );
/**
 * header image
 *
 *
 *
 *
 *
 */
        echo raindrops_header_image();
        echo $add_fluid_style_description_html;
    }
}
/**
 * Empty title fallback
 *
 *
 */
    if ( ! function_exists( 'raindrops_fallback_title' ) ){
        function raindrops_fallback_title($title,$display = 'hide'){
            if(!is_admin()){
                if(empty($title)){
                    $image_uri = get_template_directory_uri().'/images/link.png';
                    $html = '<img src="%1$s" alt="no title entry link" /><span class="%4$s">%2$s posted on %3$s</span>';
                    $raindrops_date_format = get_option('date_format');
                    return sprintf($html,$image_uri,__("This entry has no title",'Raindrops'),get_the_time($raindrops_date_format),$display);
                }
            }
            return $title;
        }
    }
/**
 * Template function print header image
 *
 * This function has filter hook name raindrops_header_image
 * @param array( 'img'=> 'image uri' , 'height' => 'image height' , 'color' => 'text color', 'style' => '(default) background-size:cover;' , 'description' => 'replace text from bloginfo(description) to your text','description_style' => 'Your description style rule')
 * @return string htmlblock <div id="['header-image']" style="background-image:url([img]);height:[height];color:#[color]][style]"><p [description_style]>[WordPress site description]</p></div>
 */
    if ( ! function_exists( 'raindrops_header_image' ) and $wp_version >= 3.4){
        function raindrops_header_image($type = 'default', $args = array() ){
        //  $image_modify   = get_theme_mods();
        //  $image_modify   = $image_modify['header_image_data'];
            $url            = get_theme_mod( 'header_image' );

            if( empty( $url ) ){ //child theme $url empty
                $url            = get_header_image();
            }

            if( $url == 'remove-header'){
                return;
            }
			
            if( $url == 'random-uploaded-image'){
                $url = get_random_header_image();
            }

            $uploads        = wp_upload_dir();
            $path           = $uploads['path'].'/'. basename( $url );

            if( ! file_exists( $path ) ){ //fallback
                $path       = get_template_directory().'/images/headers/wp3.jpg';
            }

            list($img_width, $img_height, $img_type, $img_attr) = getimagesize($path);
            $ratio = $img_height / $img_width;

            $raindrops_page_width = raindrops_warehouse_clone('raindrops_page_width');
        switch( true ){

            case 'doc' == $raindrops_page_width :
                $raindrops_document_width = 750;
            break;
            case 'doc2' == $raindrops_page_width :
                $raindrops_document_width = 950;
            break;
            case 'doc4' == $raindrops_page_width :
                $raindrops_document_width = 974;
            break;
            case is_numeric($raindrops_page_width):
                $raindrops_document_width = $raindrops_page_width;
            break;
            case 'doc3' == $raindrops_page_width :
                $raindrops_document_width = 500;//this value is fake following javascript

            break;
        }


    if( $img_width >= $raindrops_document_width ){
        $height_current = round($raindrops_document_width * $ratio). 'px';

        $block_style    = 'background-size:cover;';

    }else{
        $height_current = round( $img_height ).'px';
        $block_style = 'background-repeat:no-repeat;background-position:center;background-color:#000;background-size:auto;  background-origin:content-box;';
    }
	//w3standard can not use CSS3

	if( raindrops_warehouse( 'raindrops_style_type' ) == 'w3standard' ){
			$block_style = 'background-repeat:no-repeat;background-position:center;background-color:#000;';
	}
            if ( 'blank' == get_theme_mod('header_textcolor') or
                 '' == get_theme_mod( 'header_textcolor' )  ){
                $description_style = ' style="display:none;"';
            }elseif(preg_match("!([0-9a-f]{6}|[0-9a-f]{3})!si", get_theme_mod('header_textcolor'))){

                $description_style = ' style="color:#' . get_theme_mod('header_textcolor') . ';"';
            }else{

                $description_style = '';
                $height = 0;
            }
            if(get_header_image() == ''){
                $height = 0;
                $description_style = ' style="display:none;"';
            }
			
			$description_style = apply_filters( 'raindrops_header_image_description_attr', $description_style );
            $defaults = array(
              /*  'img' => get_theme_mod( 'header_image' ),*/
                'img' => $url,
                'height' => $height_current,
                'color' => get_theme_mod( 'header_textcolor' ),
                'style' => $block_style ,
                'description' => get_bloginfo( 'description' ),
                'description_style' => $description_style
            );
            $args = wp_parse_args( $args, $defaults );
            extract( $args, EXTR_SKIP );
                if(raindrops_warehouse_clone( "raindrops_page_width" ) == 'doc3' ){
                    $width = 'width:100%';
                }else{
                    $width = 'width:'.$raindrops_document_width.'px';
                }

            if($type == 'default' or !isset($type) ){

                $html = '<div id="%1$s" style="background-image:url(%2$s);%8$s;height:%3$s;color:#%4$s;%5$s"><p %6$s>%7$s</p></div>';
                $html = sprintf($html,
                            'header-image',
                            esc_url( $img ),
                            esc_html( $height ),
                            esc_html( $color ),
                            esc_html( $style ),// css needs > but this style is inline
                            htmlspecialchars($description_style,ENT_NOQUOTES),// css needs > but this style is inline
                            esc_html($description),
                            $width
                            );


                return apply_filters("raindrops_header_image",$html);
            }elseif($type == 'css'){

                $css = '#%1$s{background-image:url(%2$s);%8$s;height:%3$s;color:#%4$s;%5$s} #%1$s p {%6$s}';
                $description_style = str_replace( array( 'style=', '"' ),'',$description_style );
                $css = sprintf($css,
                            'header-image',
                            esc_url( $img ),
                            esc_html( $height ),
                            esc_html( $color ),
                            esc_html( $style ),// css needs > but this style is inline
                            htmlspecialchars($description_style,ENT_NOQUOTES),// css needs > but this style is inline
                            esc_html($description),
                            $width
                            );
                return apply_filters("raindrops_header_image_css",$css);
            }elseif($type == 'elements'){

                $elements = '<div id="%1$s"><p>%7$s</p></div>';
                $elements = sprintf($elements,
                            'header-image',
                            esc_url( $img ),
                            esc_html( $height ),
                            esc_html( $color ),
                            esc_html( $style ),// css needs > but this style is inline
                            htmlspecialchars($description_style,ENT_NOQUOTES),// css needs > but this style is inline
                            esc_html($description),
                            $width
                            );
                return apply_filters("raindrops_header_image_elements",$elements);
            }
        }
    }
/**
 * Print site description html
 *
 * This function has filter hook name raindrops_site_description
 *
 * @param array( "text" => 'Some text' , "switch" => ' style="display:none;"')
 * @return string htmlblock  <div id="site-description" [input switch]>[input text]</div>
 *
 */
    if ( ! function_exists( 'raindrops_site_description' ) ){
        function raindrops_site_description($args = array()){
           if ('blank' == get_theme_mod('header_textcolor') or
                     '' == get_theme_mod('header_textcolor')  ){
                $raindrops_show_hide = '';
            }elseif(preg_match("!([0-9a-f]{6}|[0-9a-f]{3})!si",get_header_textcolor())){
                $raindrops_show_hide = ' style="display:none;"';
            }else{
                $raindrops_show_hide = ' style="display:none;"';
            }
            $defaults = array(
                'text' => get_bloginfo( 'description' ),
                'switch' => $raindrops_show_hide
            );
            $args = wp_parse_args($args, $defaults );
            extract( $args, EXTR_SKIP );
            $html = '<div id="site-description" %1$s>%2$s</div>';
            $html = sprintf( $html, $switch, $text );

            return apply_filters("raindrops_site_description",$html);
        }
    }
/**
 * Print the site title
 *
 * This function has filter hook name raindrops_site_title( #site-title )
 *
 * 
 * @param $text string  append to title strings
 * @return htmlblock <[h1|div] class="h1" id="site-title"><span><a href="[home url()]" title="[blog_info(name)]" rel="['home']" [style get_header_textcolor()]>[bloginfo(name)]</a></span></[h1|div]>
 */
    if ( ! function_exists( 'raindrops_site_title' ) ){
        function raindrops_site_title($text = ""){

            if( is_home() or is_front_page() ){
                $heading_elememt = 'h1';
            }else{
                $heading_elememt = 'div';
            }
            $header_text_color = get_theme_mod('header_textcolor');
            if ( 'blank' == $header_text_color || '' == $header_text_color ){
                $hd_style = '';
            }else{

                $hd_style = ' style="color:#'. $header_text_color . ';"';

            }

            $title_format = '<%1$s class="h1" id="site-title"><a href="%2$s" title="%3$s" rel="%4$s"><span>%5$s</span></a></%1$s>';
            $html = sprintf(
                $title_format,
                $heading_elememt,
                home_url(),
                esc_attr(get_bloginfo( 'name', 'display' )),
                "home",
                get_bloginfo( 'name', 'display' ).esc_html($text)
                );
			return apply_filters( "raindrops_site_title" , $html );
        }
    }
/**
 * filter function for wp_title hook
 * element title
 */
    if ( ! function_exists( 'raindrops_filter_title' ) ){
        function raindrops_filter_title( $title, $sep = true, $seplocation = 'right' ){
            global $page, $paged;
            $page_info          = '';
            $add_title          = array();
            $site_description   = get_bloginfo( 'description', 'display' );

            if(!empty($title)){
                $add_title[]    = str_replace($sep,'',$title);
            }
                $add_title[]    = get_bloginfo( 'name' );

            if ( !empty($site_description) and ( is_home() or is_front_page() ) ){
                $add_title[]    = $site_description;
            }
            // Add a page number
            if ( $paged > 1 or $page > 1 ){
                $page_info      = sprintf( __( ' Page %s', 'Raindrops' ), max( $paged, $page ) );
            }
            if('right' == $seplocation){
                $add_title      = array_reverse( $add_title );
                $title          = implode( " $sep ", $add_title ). $page_info;
            }else{
                $title          = implode( " $sep ", $add_title ). $page_info;
            }
            return  $title ;
        }
    }
/**
 *
 *
 *
 *
 *
 */
if(!function_exists("raindrops_show_one_column")){
    function raindrops_show_one_column(){
        global $post;
        if(isset($post)){
            $raindrops_content_check = get_post($post->ID);
            $raindrops_content_check = $raindrops_content_check->post_content;
            if(preg_match("!\[raindrops[^\]]+(col)=(\"|')*?([^\"' ]+)(\"|')*?[^\]]*\]!si",$raindrops_content_check,$regs)){
                return $regs[3];
            }else{
                return false;

            }
        }elseif(raindrops_warehouse_clone('raindrops_show_right_sidebar') == 'hide'){
                return 2;
        }elseif(raindrops_warehouse_clone('raindrops_show_right_sidebar') == 'show'){
                return 3;
        }
    }
}
/**
 *
 *
 *
 *
 *
 */
if(!function_exists("raindrops_color_type_custom")){
    function raindrops_color_type_custom($css){
        global $post;
        if(isset($post) and is_single() ){
            $raindrops_content_check = get_post($post->ID);
            $raindrops_content_check = $raindrops_content_check->post_content;
            if(preg_match("!\[raindrops[^\]]+(color_type)=(\"|')*?([^\"' ]+)(\"|')*?[^\]]*\]!si",$raindrops_content_check,$regs)){
            $color_type = trim($regs[3]);
            return raindrops_design_output($color_type).raindrops_color_base();
            }else{
			return $css;
			}
        }else{
            return $css;
        }
    }
}

/**
 *
 *
 *
 *
 *
 */
if(!function_exists("raindrops_delete_post_link")){

    function raindrops_delete_post_link($link_text = null, $before = '', $after = '', $id = 0, $echo = true){
        if(SHOW_DELETE_POST_LINK !== true){
            return;
        }
        global $post;
        if(empty($link_text)){
            $link_text = __('Trash', 'Raindrops');
        }
        if (current_user_can('edit_post', $post->ID) and $url = get_delete_post_link()){

            $html = $before.'<a href="%1$s">%2$s</a>'.$after;
            $html = sprintf( $html
                        , $url
                        , $link_text
                    );
            if($echo !== true){
                return $html;
            }else{
                echo $html;
            }
        }
    }
}

/**
 * comment reply
 *
 *
 *
 * @since 0.956
 */
if(!function_exists("raindrops_enqueue_comment_reply")){
	function raindrops_enqueue_comment_reply() {
		if ( is_singular() and comments_open() and get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}



    add_filter('the_content', 'raindrops_fallback_human_interface');
    add_filter('raindrops_posted_in', 'raindrops_fallback_human_interface');

/**
 *
 *
 *
 *
 * @since 0.958
 */

if(!function_exists("raindrops_fallback_human_interface")){
    function raindrops_fallback_human_interface($content){
        if((is_home() or is_front_page()) and small_screen_check() == true){
            return;
        }else{
            return $content;
        }
    }
}

/**
 *
 *
 *
 *
 * @since 0.958
 */
if(!function_exists("small_screen_check")){

    function small_screen_check() {
        global $raindrops_fluid_minimum_width, $raindrops_fallback_human_interface_show;
        $size = '';

      if (isset( $_SERVER['HTTP_UA_PIXELS'] ) and !empty( $_SERVER['HTTP_UA_PIXELS'] )) {
        $size = $_SERVER['HTTP_UA_PIXELS'];
      }
      if(isset( $_SERVER['HTTP_X_UP_DEVCAP_SCREENPIXELS'] ) and !empty( $_SERVER['HTTP_X_UP_DEVCAP_SCREENPIXELS'] ) ){
        $size = $_SERVER['HTTP_X_UP_DEVCAP_SCREENPIXELS'];
      }
      if(isset( $_SERVER['HTTP_X_JPHONE_DISPLAY'] ) and !empty( $_SERVER['HTTP_X_JPHONE_DISPLAY'] ) ){
        $size = $_SERVER['HTTP_X_JPHONE_DISPLAY'];
      }


      $size = split('[x,*]', $size);

        if($raindrops_fallback_human_interface_show == true){
            return true;
        }

      if (isset($size[0]) and is_numeric($size[0])) {

        if($size[0] < $raindrops_fluid_minimum_width){
            return true;
        }else{
            return false;
        }
      }

      return false;

    }
}

/**
 *
 *
 *
 *
 * @since 0.958
 */

if(!function_exists("fallback_user_interface_view") ){

    function fallback_user_interface_view() {
    global $raindrops_current_theme_name, $raindrops_version;
        wp_deregister_style( 'style' );
        wp_deregister_style( 'raindrops_reset_fonts_grids' );
        wp_deregister_style( 'raindrops_grids' );
        wp_deregister_style( 'raindrops_fonts' );
        wp_deregister_style( 'raindrops_css3' );
        wp_deregister_style( 'child' );
        $current_theme      = $raindrops_current_theme_name;
        $fallback_style     = get_template_directory_uri().'/fallback.css';
                    wp_register_style('fallback_style', $fallback_style,array(),$raindrops_version,'all');
                    wp_enqueue_style( 'fallback_style');
        add_filter( 'raindrops_indv_css', '__return_false' );
        add_filter( 'raindrops_is_fluid', '__return_false' );

        add_filter( 'raindrops_is_fixed' , '__return_false' );
        add_filter( 'raindrops_embed_meta_css', '__return_false' );

    }

    if(small_screen_check() == true){
        add_action('wp_print_styles', 'fallback_user_interface_view',99);
    }

}



/**
 *
 *
 *
 *
 *
 */
    if(raindrops_warehouse_clone('raindrops_page_width') == "doc3"){
        add_action('wp_footer','raindrops_small_device_helper');
    }

    if ( ! function_exists( 'raindrops_small_device_helper' ) ) {
        function raindrops_small_device_helper(){
            global $is_IE, $raindrops_fluid_maximum_width;
            $raindrops_header_image_uri   = get_header_image();
        ?>
            <script type="text/javascript">
            (function(){
            jQuery(function(){
                var width = jQuery(window).width();
                function raindrops_resizes(){
                    var image_exists = '<?php echo $raindrops_header_image_uri;?>';
                    var width = jQuery(window).width();

                    if( image_exists !== '' ){
    <?php
            $url        = get_theme_mod( 'header_image' );
			
		    if( $url == 'random-uploaded-image'){
                $url = get_random_header_image();
            }
	
            $uploads    = wp_upload_dir();
            $path       = $uploads['path'].'/'. basename( $url );
                if( ! file_exists( $path ) ){
                    $raindrops_hd_images_path = get_template_directory().'/images/headers/'. basename( $url );
                }

            if( $url !== 'remove-header' ){

                list($img_width, $img_height, $img_type, $img_attr) = getimagesize($path);
                $ratio = $img_height / $img_width;
                if( ! empty( $ratio )){


                }else{
                    //first_time can not get ratio
                    //$header_image_width  = get_custom_header()->width;
                    //$header_image_height = get_custom_header()->height;
                    //this value HEADER_IMAGE_HEIGHT / HEADER_IMAGE_WIDTH
                    $ratio = 0.2084210;
                }//empty $ratio
            ?>
                var ratio = <?php echo $ratio;?>;
                var height = width * ratio;

                jQuery('#header-image').removeAttr('style').css({'background-image':'url('+ image_exists + ')','height': height, 'background-size': 'cover'});
    <?php }//remove header ?>
                    }
        <?php
        /**
         * Check window size and mouse position
         * Controll childlen menu show right or left side.
         *
         *
         *
         */
         ?>
                 if ( jQuery('body > div').is('#doc3') ) {
                        jQuery("#access").mousemove(function(e){
                            var menu_item_position = e.pageX ;

                            if( width - 200 < menu_item_position){
                                jQuery('#access ul ul ul').addClass('left');
                            }else if( width / 2 >  menu_item_position){
                                jQuery('#access ul ul ul ul').removeClass('left');
                            }
                        });

                        if( width > <?php echo $raindrops_fluid_maximum_width;?>){
                            //centering page when browser width > $raindrops_fluid_maximun_width
                            jQuery('#doc3').css({'margin':'auto'});
                        }


                    }
                }
                raindrops_resizes();
                jQuery(window).resize( function () {raindrops_resizes()});
                });
            })(jQuery);
            </script>
            <?php
        }
    }

/**
 *
 *
 *
 *
 *
 */
    if ( ! function_exists( 'raindrops_custom_width' ) ) {
         function raindrops_custom_width(){
                    global $raindrops_page_width;
                        $c_width = (int)$raindrops_page_width;
                        $width    = $c_width / 13;
                        $ie_width = $width * 0.9759;
                    $custom_content_width = '/* set custom content width start */'.
                    '#custom-doc {margin:auto;text-align:left;'."\n".
                    'width:'.round($width,0).'em;'."\n".
                    '*width:'.round($ie_width,0).'em;'."\n".
                    'min-width:'.round($width * 0.7,0).'em;}/* set custom content width end */';

                    return apply_filters("raindrops_custom_width",$custom_content_width);
         }

    }

/**
 *
 *
 *
 *
 *
 */

    if ( ! function_exists( 'raindrops_is_fluid' ) ) {
        function raindrops_is_fluid(){
            global  $is_IE, $raindrops_fluid_minimum_width, $raindrops_fluid_maximum_width;
            $width                  = intval($raindrops_fluid_minimum_width);
            $extra_sidebar_width    = raindrops_warehouse_clone('raindrops_right_sidebar_width_percent');

            if($extra_sidebar_width == '25'){
                $main_column_width_fluid = 74;
            }elseif($extra_sidebar_width == '75'){
                $main_column_width_fluid =  24;
            }elseif($extra_sidebar_width == '33'){
                $main_column_width_fluid = 64;
            }elseif($extra_sidebar_width == '66'){
                $main_column_width_fluid =  32;
            }elseif($extra_sidebar_width == '50'){
                $main_column_width_fluid =  49;
            }else{
                $main_column_width_fluid = 100;
            }

            $fluid_width = '/* raindrops is fluid start */'.
                            "\n#doc3{min-width:".
                            $raindrops_fluid_minimum_width.
                            'px;max-width:'.$raindrops_fluid_maximum_width.'px;}'.
                            "\n#container > .first{width:".$main_column_width_fluid."%;}".
                            "\n#access{min-width:".
                            $raindrops_fluid_minimum_width.
                            'px;}/* raindrops is fluid end */';
            return apply_filters("raindrops_is_fluid",$fluid_width);
        }
    }


    if (!function_exists('raindrops_is_fixed')) {
        function raindrops_is_fixed(){
            global $is_IE,$raindrops_page_width;
            $add_ie = '';
            $pw = raindrops_warehouse_clone("raindrops_page_width");
            if($pw == 'doc'){
                $width      = 750;
                $px = 'width:'.$width.'px;';
                $width      = $width / 13;
            }
            if($pw == 'doc2'){
                $width      = 950;
                $px = 'width:'.$width.'px;';
                $width      = $width / 13;
            }
            if($pw == 'custom-doc'){
                $width      = $raindrops_page_width;
                $px = 'width:'.$width.'px;';
                $width      = $width / 13;
            }
            $raindrops_main_width = raindrops_main_width();
            $raindrops_main_width = $raindrops_main_width / 13;
            if($is_IE){
                $width                  = round($width * 0.9759,1);
                $add_ie                 = '';
                $raindrops_main_width   = round($raindrops_main_width * 0.9759,1);
            }else{
                $width                  = round($width,1);
                $raindrops_main_width   = round($raindrops_main_width,1);
            }
            $custom_fixed_width = '/* raindrops is fixed start*/'."
                \n#".$pw.'{margin:auto;text-align:left;'."\n".
                            'min-width:'.$width.'em;'.
                            $add_ie.
                            $px.
                            '}'.
                            "\n#container{min-width:".
                            $raindrops_main_width.
                            'em;}/* raindrops is fixed end */';

            return apply_filters("raindrops_is_fixed",$custom_fixed_width);
        }
    }

/**
 *
 *
 *
 *
 *
 */
    if( ! function_exists( 'raindrops_gallerys' ) ){

        function raindrops_gallerys(){

            $raindrops_gallerys = ".gallery { margin: auto; overflow: hidden; width: 100%; }\n
            .gallery dl { margin: 0px; }\n
            .gallery .gallery-item { float: left; margin-top: 10px; text-align: center; }\n
            .gallery img { border: 2px solid #cfcfcf;max-width:100%; }\n
            .gallery .gallery-caption { margin-left: 0; }\n
            .gallery br { clear: both }\n
            .gallery-columns-2 dl{ width: 50% }\n
            .gallery-columns-3 dl{ width: 33.3% }\n
            .gallery-columns-4 dl{ width: 25% }\n
            .gallery-columns-5 dl{ width: 20% }\n
            .gallery-columns-6 dl{ width: 16.6% }\n
            .gallery-columns-7 dl{ width: 14.28% }\n
            .gallery-columns-8 dl{ width: 12.5% }\n
            .gallery-columns-9 dl{ width: 11.1% }\n";


            return apply_filters("raindrops_gallerys_css",$raindrops_gallerys);
        }
    }
/**
 *
 *
 *
 *
 * @since 0.965
 */

if( $raindrops_wp_version >= '3.4' ){
    add_action( 'customize_register', 'raindrops_customize_register' );
}

if( ! function_exists( 'raindrops_customize_register' ) ){
    function raindrops_customize_register($wp_customize) {
    global $raindrops_current_theme_name;

        $wp_customize->add_section( 'raindrops_theme_settings', array(
            'title'          => __( 'Raindrops theme settings', 'Raindrops' ),
            'priority'       => 25,
        ) );
		 $wp_customize->add_section( 'raindrops_navigation_setting'
            , array( 'title' => __( 'Another Settings link', 'Raindrops' )
            , 'priority'	 => 120,
                )
        );

        $wp_customize->add_setting( 'raindrops_theme_settings[raindrops_style_type]', array(
            'default'        => 'dark',
            'type'           => 'option',
            'capability'     => 'edit_theme_options',
        ) );

        $wp_customize->add_setting( 'raindrops_theme_settings[raindrops_page_width]', array(
            'default'        => 'doc2',
            'type'           => 'option',
            'capability'     => 'edit_theme_options',
        ) );

        $wp_customize->add_setting( 'raindrops_theme_settings[raindrops_base_color]', array(
            'default'        => '#444444',
            'type'           => 'option',
            'capability'     => 'edit_theme_options',
        ) );
        $wp_customize->add_setting( 'raindrops_theme_settings[raindrops_show_right_sidebar]', array(
            'default'        => 'show',
            'type'           => 'option',
            'capability'     => 'edit_theme_options',
        ) );
        $wp_customize->add_setting( 'raindrops_theme_settings[raindrops_col_width]', array(
            'default'        => 't2',
            'type'           => 'option',
            'capability'     => 'edit_theme_options',
        ) );
        $wp_customize->add_setting( 'raindrops_theme_settings[raindrops_show_menu_primary]', array(
            'default'        => 'show',
            'type'           => 'option',
            'capability'     => 'edit_theme_options',
        ) );

        $wp_customize->add_setting( 'raindrops_theme_settings[raindrops_default_fonts_color]', array(
            'default'        => '',
            'type'           => 'option',
            'capability'     => 'edit_theme_options',
        ) );
        $wp_customize->add_setting( 'raindrops_theme_settings[raindrops_hyperlink_color]', array(
            'default'        => '',
            'type'           => 'option',
            'capability'     => 'edit_theme_options',
        ) );
		$wp_customize->add_setting( 'navigation_setting', array(
			'default' => array( 
					array( 'label' => __( 'Custom Header', 'Raindrops' ), 'path' => 'themes.php?page=custom-header', 'target' => 'b'), 
					array( 'label' => __( 'Widget', 'Raindrops' ), 'path' => 'widgets.php', 'target' => 'b' ), 
					array( 'label' => __( 'Nav Menus', 'Raindrops' ), 'path' => 'nav-menus.php', 'target' => 'b' ), 
					array( 'label' => __( 'Raindrops Settings', 'Raindrops' ), 'path' => 'themes.php?page=raindrops_settings' , 'target' => 'b'), 
					array( 'label' => __( 'Theme', 'Raindrops' ), 'path' => 'themes.php' , 'target' => 's'), 
					array( 'label' => __( 'Dashbord', 'Raindrops' ), 'path' => 'index.php', 'target' => 's' ),
					
				),
		) );


    /*  global $color_en_140;

        $native_color = $color_en_140;

        $wp_customize->add_control( 'raindrops_base_color', array(
            'label'      => __( 'Base color', 'Raindrops' ),
            'section'    => 'raindrops_theme_settings',
            'settings'   => 'raindrops_theme_settings[raindrops_base_color]',
            'type'       => 'select',
            'choices'    => array_flip($native_color),
        ) );*/

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize
                    , 'raindrops_base_color'
                    , array(
                        'label'   => __( 'Base color', 'Raindrops' )
                        , 'section' => 'raindrops_theme_settings'
                        , 'settings'   => 'raindrops_theme_settings[raindrops_base_color]'
                        )
                )
            );

        $raindrops_style_type_choices = raindrops_register_styles("w3standard");
        //unset($raindrops_style_type_choices[$raindrops_current_theme_name]);

        $wp_customize->add_control( 'raindrops_style_type', array(
            'label'      => __( 'Color Type', 'Raindrops' ),
            'section'    => 'raindrops_theme_settings',
            'settings'   => 'raindrops_theme_settings[raindrops_style_type]',
            'type'       => 'radio',
            'choices'    => $raindrops_style_type_choices,
        ) );
        $wp_customize->add_control( 'raindrops_page_width', array(
            'label'      => __( 'Page width', 'Raindrops' ),
            'section'    => 'raindrops_theme_settings',
            'settings'   => 'raindrops_theme_settings[raindrops_page_width]',
            'type'       => 'radio',
            'choices'    => array(
                'doc' => '750px fix',
                'doc2' => '950px fix',
                'doc3' => 'fluid',
                'doc4' => '974px fix',
                ),
        ) );

        $wp_customize->add_control( 'raindrops_show_right_sidebar', array(
            'label'      => __( 'Extra Sidebar', 'Raindrops' ),
            'section'    => 'raindrops_theme_settings',
            'settings'   => 'raindrops_theme_settings[raindrops_show_right_sidebar]',
            'type'       => 'radio',
            'choices'    => array(
                'show' => 'Show',
                'hide' => 'Hide',
                ),
        ) );
        $raindrops_col_width = array(
                "left 160px"=>"t1",
                "left 180px"=>"t2",
                "left 300px"=>"t3",
                "right 180px"=>"t4",
                "right 240px"=>"t5",
                "right 300px"=>"t6"
                );

        $wp_customize->add_control( 'raindrops_col_width', array(
            'label'      => __( 'Default Sidebar', 'Raindrops' ),
            'section'    => 'raindrops_theme_settings',
            'settings'   => 'raindrops_theme_settings[raindrops_col_width]',
            'type'       => 'radio',
            'choices'    => array_flip( $raindrops_col_width ),
        ) );

        $wp_customize->add_control( 'raindrops_show_menu_primary', array(
            'label'      => __( 'Menu Primary', 'Raindrops' ),
            'section'    => 'raindrops_theme_settings',
            'settings'   => 'raindrops_theme_settings[raindrops_show_menu_primary]',
            'type'       => 'radio',
            'choices'    => array(
                'show' => 'Show',
                'hide' => 'Hide',
                ),
        ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize
                    , 'raindrops_default_fonts_color'
                    , array(
                        'label'   => __( 'Font Color', 'Raindrops' )
                        , 'section' => 'raindrops_theme_settings'
                        , 'settings'   => 'raindrops_theme_settings[raindrops_default_fonts_color]'
                        )
                )
            );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize
                    , 'raindrops_hyperlink_color'
                    , array(
                        'label'   => __( 'Link Color', 'Raindrops' )
                        , 'section' => 'raindrops_theme_settings'
                        , 'settings'   => 'raindrops_theme_settings[raindrops_hyperlink_color]'
                        )
                )
            );
		$wp_customize->add_control( new Raindrops_Customize_Navigation_Control(  $wp_customize
					, 'navigation_setting'
					, array(
						'label' => 'Navigation_Setting'
						, 'section'=> 'raindrops_navigation_setting'
						, 'settings' => 'navigation_setting' 
						) 
				) 
			);

    }

}

    add_filter( 'raindrops_prev_next_post', 'raindrops_remove_element');
    add_filter( 'raindrops_posted_on', 'raindrops_remove_element');
    add_filter( 'raindrops_posted_in', 'raindrops_remove_element');
if( ! function_exists( 'raindrops_remove_element' ) ){
    function raindrops_remove_element($content){
    return preg_replace('!<span[^>]+><\/span>!','',$content);

    }
}
/**
 *
 *
 *
 *
 * thanks  aison
 */
if( ! function_exists( 'raindrops_page_menu_args' ) ){
    function raindrops_page_menu_args( $args ) {
        $args['show_home'] = true;
        return $args;
    }
}

/**
 *
 *
 *
 *
 * @since 0.980
 */
if( ! function_exists( 'insert_message_action_hook_position' ) ){
	function insert_message_action_hook_position($hook_name=''){
			add_action( 'raindrops_after_nav_menu','raindrops_action_hook_messages' );
			add_action( 'raindrops_append_entry_content','raindrops_action_hook_messages' );
			add_action( 'raindrops_prepend_extra_sidebar','raindrops_action_hook_messages' );
			add_action( 'raindrops_append_extra_sidebar','raindrops_action_hook_messages' );
			add_action( 'raindrops_prepend_doc','raindrops_action_hook_messages' );
			add_action( 'raindrops_append_doc','raindrops_action_hook_messages' );
			add_action( 'raindrops_prepend_default_sidebar','raindrops_action_hook_messages' );
			add_action( 'raindrops_append_default_sidebar','raindrops_action_hook_messages' );
			add_action( 'raindrops_prepend_footer','raindrops_action_hook_messages' );
			add_action( 'raindrops_append_footer','raindrops_action_hook_messages' );
			add_action( 'raindrops_prepend_entry_content','raindrops_action_hook_messages' );	
	}
}
if( WP_DEBUG == true and $raindrops_actions_hook_message == true ){
	insert_message_action_hook_position();
}

/**
 *
 *
 *
 *
 * @since 0.980
 */
if( ! function_exists( 'raindrops_action_hook_messages' ) ){
	function raindrops_action_hook_messages($args){
	
		if( isset( $args ) and array_key_exists( 'hook_name', $args ) and array_key_exists( 'template_part_name', $args ) ){
			$message = __('add_action( \'%1$s\', \'your_function\' ) or add template part file the name \'%2$s\'.');
			$message = sprintf( $message, $args['hook_name'], $args['template_part_name'] );
			printf ('<div style="%2$s" class="color3 pad-m corner">%1$s</div>', $message,'word-break:break-all;word-wrap:break-word;' );
		}
	}
}
/**
 *
 *
 *
 *
 * @since 0.980
 */

if( ! function_exists( 'raindrops_after_nav_menu' ) ){
	function raindrops_after_nav_menu(){
		get_template_part('hook', 'after-nav-menu' );
		$args = array( 'hook_name' => 'raindrops_after_nav_menu', 'template_part_name' => 'hook-after-nav-menu.php' );
		do_action( 'raindrops_after_nav_menu' ,$args );
	}
}
/**
 *
 *
 *
 *
 * @since 0.980
 */

if( ! function_exists( 'raindrops_prepend_doc' ) ){
	function raindrops_prepend_doc(){
		$args = array( 'hook_name' => 'raindrops_prepend_doc', 'template_part_name' => 'hook-prepend-doc.php' );
		get_template_part('hook', 'prepend-doc' );
		do_action( 'raindrops_prepend_doc', $args );
	}
}
/**
 *
 *
 *
 *
 * @since 0.980
 */

if( ! function_exists( 'raindrops_append_doc' ) ){
	function raindrops_append_doc(){
		$args = array( 'hook_name' => 'raindrops_append_doc', 'template_part_name' => 'hook-append-doc.php' );
		get_template_part( 'hook', 'append-doc' );
		do_action( 'raindrops_append_doc', $args );
	}
}
/**
 *
 *
 *
 *
 * @since 0.980
 */

if( ! function_exists( 'raindrops_prepend_entry_content' ) ){
	function raindrops_prepend_entry_content(){
		$args = array( 'hook_name' => 'raindrops_prepend_entry_content', 'template_part_name' => 'hook-prepend-entry-content.php' );
		get_template_part( 'hook', 'prepend-entry-content' );
		do_action( 'raindrops_prepend_entry_content', $args );
	}
}
/**
 *
 *
 *
 *
 * @since 0.980
 */

if( ! function_exists( 'raindrops_prepend_extra_sidebar' ) ){
	function raindrops_prepend_extra_sidebar(){
		$args = array( 'hook_name' => 'raindrops_prepend_extra_sidebar', 'template_part_name' => 'hook-prepend-extra-sidebar.php' );

		get_template_part( 'hook', 'prepend-extra-sidebar' );
		do_action( 'raindrops_prepend_extra_sidebar', $args );
	}
}
/**
 *
 *
 *
 *
 * @since 0.980
 */

if( ! function_exists( 'raindrops_prepend_default_sidebar' ) ){
	function raindrops_prepend_default_sidebar(){
		$args = array( 'hook_name' => 'raindrops_prepend_default_sidebar', 'template_part_name' => 'hook-prepend-default-sidebar.php' );
		get_template_part( 'hook', 'prepend-default-sidebar' );
		do_action( 'raindrops_prepend_default_sidebar', $args );
	}
}
/**
 *
 *
 *
 *
 * @since 0.980
 */

if( ! function_exists( 'raindrops_prepend_footer' ) ){
	function raindrops_prepend_footer(){
		$args = array( 'hook_name' => 'raindrops_prepend_footer', 'template_part_name' => 'hook-prepend-footer.php' );
		get_template_part( 'hook', 'prepend-footer' );
		do_action( 'raindrops_prepend_footer', $args );
	}
}
/**
 *
 *
 *
 *
 * @since 0.980
 */

if( ! function_exists( 'raindrops_append_entry_content' ) ){
	function raindrops_append_entry_content(){
		$args = array( 'hook_name' => 'raindrops_append_entry_content', 'template_part_name' => 'hook-append-entry-content.php' );
		get_template_part( 'hook', 'append-entry-content' );
		do_action( 'raindrops_append_entry_content', $args );
	}
}
/**
 *
 *
 *
 *
 * @since 0.980
 */

if( ! function_exists( 'raindrops_append_extra_sidebar' ) ){
	function raindrops_append_extra_sidebar(){
		$args = array( 'hook_name' => 'raindrops_append_extra_sidebar', 'template_part_name' => 'hook-append-extra-sidebar.php' );
		get_template_part( 'hook', 'append-extra-sidebar' );
		do_action( 'raindrops_append_extra_sidebar', $args );
	}
}
/**
 *
 *
 *
 *
 * @since 0.980
 */

if( ! function_exists( 'raindrops_append_default_sidebar' ) ){
	function raindrops_append_default_sidebar(){
		$args = array( 'hook_name' => 'raindrops_append_default_sidebar', 'template_part_name' => 'hook-append-default-sidebar.php' );
		get_template_part( 'hook', 'append-default-sidebar' );
		do_action( 'raindrops_append_default_sidebar', $args );
	}
}
/**
 *
 *
 *
 *
 * @since 0.980
 */

if( ! function_exists( 'raindrops_append_footer' ) ){
	function raindrops_append_footer(){
		$args = array( 'hook_name' => 'raindrops_append_footer', 'template_part_name' => 'hook-append-footer.php' );
		get_template_part( 'hook', 'append-footer' );
		do_action( 'raindrops_append_footer', $args );
	}
}


/**
 *
 *
 *
 *
 * @since 0.980
 */

if( ! function_exists( 'raindrops_entry_title' ) ){
	function raindrops_entry_title(){
		global $post;
		$thumbnail = '';
	
		if( has_post_thumbnail($post->ID) and ! is_single() ){
			$thumbnail .= '<span class="h2-thumb">';
			$thumbnail .= get_the_post_thumbnail($post->ID, array(48,48),array("style"=>"vertical-align:text-bottom;"));
			$thumbnail .= '</span>';
		}
						
		$html = '<h2 class="%1$s">%5$s<a href="%2$s" rel="bookmark" title="%3$s">%4$s</a></h2>';
		 
		$html = sprintf( $html,
						'h2 entry-title', 
						get_permalink(),
						the_title_attribute( array('before' => '', 'after' =>  '', 'echo' => false) ),
						the_title('','',false),
						$thumbnail				
						);
		echo apply_filters( 'raindrops_entry_title', $html );
	}
}

/**
 *
 *
 *
 *
 * @since 0.980
 */

if( ! function_exists( 'raindrops_entry_content' ) ){
	function raindrops_entry_content($more_link_text = null, $stripteaser = false){
		global $post;

		if(RAINDROPS_USE_LIST_EXCERPT == true and ! is_single() and ! is_page() ){
			$excerpt = apply_filters( 'the_excerpt', get_the_excerpt() );
			echo apply_filters('raindrops_entry_content', $excerpt );
		}else{
			if( empty( $more_link_text ) ){ 
				$more_link_text = __( 'Continue&nbsp;reading&nbsp;<span class="meta-nav">&rarr;</span>', 'Raindrops' ) ;
			}
			$content = get_the_content($more_link_text, $stripteaser);
			$content = apply_filters('the_content', $content);
			$content = apply_filters('raindrops_entry_content', $content);
			$content = str_replace(']]>', ']]&gt;', $content);
			echo $content;
		
		}
		


	}
}

/**
 *
 *
 *
 *
 * @since 0.980
 */

if( ! function_exists( 'raindrops_next_prev_links' ) ){
	function raindrops_next_prev_links($position = 'nav-above'){
		global $wp_query;
		
		if ( $wp_query->max_num_pages > 1 ){
		
			$html = '<div id="%3$s" class="clearfix"><span class="nav-previous">%1$s</span><span class="nav-next">%2$s</span></div>';		
			$html = sprintf( $html,
					get_next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'Raindrops' ) ),
					get_previous_posts_link( __( '<span>Newer posts <span class="meta-nav">&rarr;</span></span>', 'Raindrops' ) ),
					$position
					);
			
			echo apply_filters(  'raindrops_next_prev_links' , $html );
		}

	}
}


/**
 *
 *
 *
 *
 * @since 0.980
 */

if( ! function_exists( 'raindrops_sidebar_menus' ) ){
	function raindrops_sidebar_menus($position = 'default'){
		global $post;
		$attr = '';
		if( $position == 'default' ){
		
			$html = wp_list_pages('title_li=<h2 class="h2">'. __( 'Pages', 'Raindrops').'</h2>&echo=0' );
			$html .= '<li><h2 class="h2">'. __( 'Archives', 'Raindrops' ). '</h2>';
			$html .= '<ul>'. wp_get_archives('type=monthly&echo=0'). '</ul>';
			$html .= '</li>';
			$html .= wp_list_categories('show_count=1&title_li=<h2 class="h2">'. __( 'Categories', 'Raindrops'). '</h2>&echo=0' );
			if ( is_front_page() || is_page() ) {
				$html .= wp_list_bookmarks( 'echo=0' );
				$html .= '<li><h2 class="h2">Meta'. __( 'Meta', 'Raindrops' ). '</h2>';
				$html .= '<ul>'. wp_register( '<li>', '</li>', false ).'<li>';
				$html .= wp_loginout('', false ).'</li>';
				// wp_meta();
				$html .= '</ul></li>';
			} 	
				
		}else{
		// extra sidebar
		
			$html = '<li><h2 class="h2">'. __('Recent Post', 'Raindrops'). '</h2>';
			
			$raindrops_get_posts    = get_posts('numberposts=0&offset=1');
			
			if(isset($raindrops_get_posts)){
			$html .= '<ul>';
				foreach($raindrops_get_posts as $post){
					setup_postdata($post);
					if (!empty($wp_query->posts) and $post->ID == $wp_query->post->ID ) { 
						$attr = ' class="current-post"';
					}
				$html .= '<li '.$attr.'><a href="'. get_permalink(). '">	'.the_title('','',false).'</a></li>';	
					
			   } 
			$html .= '</ul></li>';
		
			}
		}
		
		echo apply_filters( 'raindrops_sidebar_menus', $html );
		wp_reset_postdata();
	}
}


/**
 * recent posta
 *
 *
 *
 *
 */
if( ! function_exists( 'raindrops_recent_posts' ) ){
	function raindrops_recent_posts( ){
		global $raindrops_recent_posts_setting,$post;
		if( ! isset( $raindrops_recent_posts_setting ) ){return;}
		$default= array(
				'title'=> __('Recent Post','Raindrops' ),
				'numberposts'=> 10,
				'offset'=> 0,
				'category'=> 0,
				'orderby'=> 'post_date',
				'order'=> 'DESC',
				'include'=> '',
				'exclude'=> '',
				'meta_key'=> '',
				'meta_value'=>'',
				'post_type'=> 'post',
				'post_status'=> 'publish',
				'suppress_filters'=> true
		);
		$args= wp_parse_args($raindrops_recent_posts_setting, $default);
		$title= $args['title'];
		unset( $args['title'] );
		$html = '<li class="%3$s"><a href="%1$s">%2$s</a></li>';			
		$results= wp_get_recent_posts( $args ) ;
			 
		$result		= sprintf('<h2 class="%2$s">%1$s</h2>',$title,'title h2');
		$result		.= sprintf( '<ul class="%1$s">' , 'list' );
		
		foreach( $results as $key=> $val ){
			$result .= sprintf( $html,
								$val['guid'],
								$val['post_title'],
								'raindrops-recent-posts'
								);
		}
		
		$result		.= sprintf( '</ul>' );
		
		$result = sprintf('<div class="%1$s">%2$s</div>', 'raindrops-recent-posts pad-m clearfix', $result );
		
		echo apply_filters( 'raindrops_recent_posts', $result );
	}
}		

/**
 *　category posts
 *
 *
 *
 *
 */
if( ! function_exists( 'raindrops_category_posts' ) ){
	function raindrops_category_posts( ){
		global $post, $raindrops_category_posts_setting;
		
		if( ! isset( $raindrops_category_posts_setting ) ){return;}
		
		$settings= array( 'title'			 => __('Categories','Raindrops' ), 
							'numberposts' => 0,
							'offset'=> 0,
							'category' => 0,
							'orderby' => 'post_date',
							'order'=> 'DESC',
							'include' => '',
							'exclude' => '',
							'meta_key' => '',
							'meta_value' => '',
							'post_type' => 'post',
							'post_mime_type' => '',
							'post_parent' => '',
							'post_status' => 'publish'
						);
		$settings= wp_parse_args($raindrops_category_posts_setting,$settings);
		$title= $settings['title'];
		unset( $settings['title'] );
		$posts= get_posts($settings);
		if($posts){
			$result		 = sprintf('<h2 class="%2$s">%1$s</h2>', $title ,'title h2'); 
			$result		 .= sprintf('<ul class="list">');
			
			foreach($posts as $post){ 
				setup_postdata($post);
				$result		 .= sprintf( '<li><a href="%2$s">%1$s</a></li>' , the_title('','', false), get_permalink() );
			}
				$result		 .= sprintf('</ul>');
		}
				$result = sprintf('<div class="%1$s">%2$s</div>','raindrops-category-posts pad-m clearfix', $result );

		echo apply_filters( 'raindrops_category_posts', $result );
		wp_reset_postdata();
	}
}

/**
 *　tag posta
 *
 *
 *
 *
 */
if( ! function_exists( 'raindrops_tag_posts' ) ){
	function raindrops_tag_posts( ){
		global $post, $raindrops_tag_posts_setting;
		
		if( ! isset( $raindrops_tag_posts_setting ) ){return;}
			
		$settings= array( 'title' => __('Tags','Raindrops' ), 
							'numberposts' => 0,
							'offset'=> 0,
							'category' => 0,
							'orderby' => 'post_date',
							'order'=> 'DESC',
							'include' => '',
							'exclude' => '',
							'meta_key' => '',
							'meta_value' => '',
							'post_type' => 'post',
							'post_mime_type' => '',
							'post_parent' => '',
							'post_status' => 'publish',
						);
		$settings= wp_parse_args($raindrops_tag_posts_setting,$settings);
		$title= $settings['title'];
		unset( $settings['title'] );

		$posts= get_posts($settings);
		
		if( $posts ){
			$result		 = sprintf('<h2 class="%2$s">%1$s</h2>', $title, 'title h2' ); 
			$result		.= sprintf( '<ul class="%1$s">' , 'list' );
			foreach($posts as $key=>$post){ 
				setup_postdata( $post );
				$result	 .= sprintf('<li><a href="%1$s">%2$s</a></li>',
										get_permalink(),
										the_title( '', '', false ) 
								);
			}
			$result		 .= sprintf('</ul>');
		}
		$result = sprintf('<div class="%1$s">%2$s</div>','raindrops-tag-posts pad-m clearfix', $result );

		echo apply_filters( 'raindrops_tag_posts', $result );
		wp_reset_postdata();
	}
}

if( ! function_exists( 'raindrops_monthly_archive_prev_next_navigation' ) ){
function raindrops_monthly_archive_prev_next_navigation(){
	global $wpdb, $wp_query;

	if( is_month() ){
	
		$thisyear 	= mysql2date('Y', $wp_query->posts[0]->post_date);
		$thismonth 	= mysql2date('m', $wp_query->posts[0]->post_date);
		
		$unixmonth 	= mktime(0, 0 , 0, $thismonth, 1, $thisyear);
		$last_day 	= date('t', $unixmonth);
		
		$previous 	= $wpdb->get_row("SELECT MONTH(post_date) AS month, YEAR(post_date) AS year	FROM $wpdb->posts
			WHERE post_date < '$thisyear-$thismonth-01'
			AND post_type = 'post' AND post_status = 'publish'
				ORDER BY post_date DESC
				LIMIT 1");
		$next 		= $wpdb->get_row("SELECT MONTH(post_date) AS month, YEAR(post_date) AS year FROM $wpdb->posts
			WHERE post_date > '$thisyear-$thismonth-{$last_day} 23:59:59'
			AND post_type = 'post' AND post_status = 'publish'
				ORDER BY post_date ASC
				LIMIT 1");
				
		$html 		= '<a href="%1$s" class="%3$s">%2$s</a>';
				
		if ( $previous ) {
			$calendar_output = sprintf( $html,
										get_month_link($previous->year,
										$previous->month) ,
										sprintf(__('Prev Month( %sth )','Raindrops'),
										$previous->month),
										'alignleft' 
									  );
		}
		$calendar_output .= "\t" ;
		if ( $next ) {
			$calendar_output .= sprintf( $html, 
										get_month_link($next->year, 
										$next->month),
										sprintf(__('Next Month( %sth )','Raindrops'),
										$next->month),
										'alignright'
										);
		}
		
		$html = '<div class="%1$s">%2$s</div>';
		
			$calendar_output = sprintf( $html,
										'raindrops-monthly-archive-prev-next-avigation',
										$calendar_output
									);
		
		echo apply_filters( 'raindrops_monthly_archive_prev_next_navigation', $calendar_output );
	}
}
}
/**
 *
 *
 *
 *
 *
 */
if( ! function_exists( 'raindrops_customize_controls_print_styles' ) ){
	function raindrops_customize_controls_print_styles(){
	
	?>
	<style>
	#customize-control-raindrops_style_type .customize-control-title + label{
	
		background:url(<?php echo get_template_directory_uri().'/images/screen-shot-dark.png';?>);
		height:180px;
		display:block;
		background-position:0px 20px;
		background-repeat:no-repeat;
		background-size:cover;
	}
	#customize-control-raindrops_style_type .customize-control-title  + label + label{
	
		background:url(<?php echo get_template_directory_uri().'/images/screen-shot-w3standard.png';?>);
		height:180px;
		display:block;
		background-position:0px 20px;
		background-repeat:no-repeat;
		background-size:cover;
	}
	#customize-control-raindrops_style_type .customize-control-title  + label +label + label{
	
		background:url(<?php echo get_template_directory_uri().'/images/screen-shot-light.png';?>);
		height:180px;
		display:block;
		background-position:0px 20px;
		background-repeat:no-repeat;
		background-size:cover;
	}
	#customize-control-raindrops_style_type .customize-control-title  + label +label + label + label{
	
		background:url(<?php echo get_template_directory_uri().'/images/screen-shot-minimal.png';?>);
		height:180px;
		display:block;
		background-position:0px 20px;
		background-repeat:no-repeat;
		background-size:cover;
	}
	
	</style>
	
	<?php
	
	
	}
}



/**
 *
 *
 *
 *
 * @since 0.990
 */

if( class_exists( 'WP_Customize_Control' ) ){
    class Raindrops_Customize_Navigation_Control extends WP_Customize_Control {
        public $type= 'navigation';
     
        public function render_content() {
		
		
		
		$url 					= admin_url();
		$result 				= '<ul class="raindrops-customize-section-content">';
		$result_after 			= '</ul>';
		$html_place_holder_s 	= '<li><h4><a href="%1$s">%2$s</a></h4></li>';
		$html_place_holder_b 	= '<li><h4><a href="%1$s">%2$s</a>&nbsp;<a href="%1$s" target="_blank">('. __('New window', 'Raindrops' ).')</a></h4></li>';

			foreach( $this->value() as $link ){
				if( $link['target'] == 'b' ){
					$result 	.= sprintf( $html_place_holder_b, $url.$link['path'], $link['label'] );
				}else{
					$result 	.= sprintf( $html_place_holder_s, $url.$link['path'], $link['label'] );
				}
			}
		$result 				= $result.$result_after;
		echo $result;
        }
         
    }
}		
/**
 *
 *
 *
 *
 *
 */
if( $raindrops_wp_version < '3.4' ){
	include(get_template_directory().'/backward-compatibility.php');
}

?>