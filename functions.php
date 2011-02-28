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

    require_once(get_template_directory()."/config.php");

    if(TMN_USE_AUTO_COLOR == true and is_admin() == true ){
        require_once(get_template_directory()."/lib/csscolor.css.php");
        add_filter('contextual_help','raindrops_edit_help');
    }

    if($tmn_show_header_image !== 'yes'){
        add_action("admin_head","header_image_alert");
    }

    if(isset($_GET['page']) and $_GET['page'] == 'raindrops_settings'){
        add_action("admin_head","jquery_toggle_action");
    }

    if(isset($page_width) and !empty($page_width)){
        add_action("wp_head","tmn_custom_width");
        function tmn_custom_width($content,$key){
            global $page_width;
                $c_width = (int)$page_width;
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
    if(!isset($content_width) or empty($content_width)){
        $content_width = 400;
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

    add_action('load-themes.php', 'install_navigation');
    add_editor_style();
    register_nav_menus( array(
        'primary' => __( 'Primary Navigation', 'Raindrops' ),
    ) );
    add_custom_background();
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 48, 48, true );
    add_image_size( 'single-post-thumbnail', 600, 400, true);
    add_theme_support( 'automatic-feed-links' );
    load_textdomain( 'Raindrops', get_template_directory().'/languages/'.get_locale().'.mo' );
    add_filter("wp_head","tmn_embed_meta",'99');
    add_filter( 'comment_form_default_fields','tmn_comment_form');
    add_filter( 'the_meta_key', 'filter_explode_meta_keys', 10, 2 );
    add_filter('body_class','raindrops_add_body_class');
    add_filter('contextual_help','raindrops_help');
    add_filter('comment_form_field_comment','custom_remove_aria_required1');
    add_filter('comment_form_default_fields', 'custom_remove_aria_required2');
    add_filter( 'the_meta_key', 'filter_explode_meta_keys', 10, 2 );
    if ( !is_admin()) {
       add_action('wp_print_styles', 'add_raindrops_stylesheet');
    }
    $is_submenu = new tmn_menu_create;
    add_action( 'admin_init', 'raindrops_options_init' );
    add_action('admin_menu', array($is_submenu, 'add_menus'));
    add_action('admin_menu', 'setup_raindrops');
    add_action( 'widgets_init', 'raindrops_widgets_init' );
    foreach($raindrops_base_setting as $setting){
        $function_name = $setting['option_name'].'_validate';
        if(!function_exists($function_name)){
        $message = sprintf(__('If you add  %s when you must create function %s for data validation','Raindrops'),$setting['option_name'],$function_name);
            printf('<script type="text/javascript">alert(\'%s\');</script>',$message);
        return;
        }
    }


/**
 * Validate admin panel form value.
 *
 *
 *
 *
 */
    function raindrops_use_automatic_color_validate($input){
        return $input;
    }
    function raindrops_right_sidebar_width_percent_validate($input){
        $obj = new tmn_menu_create();
        $vals = $obj->col_settings_raindrops_right_sidebar_width_percent;
        foreach($vals as $val){
            if($input == $val){
            return $input;
            }
        }
        return get_option("raindrops_right_sidebar_width_percent");
    }
    function raindrops_show_right_sidebar_validate($input){
        $obj = new tmn_menu_create();
        $vals = $obj->col_settings_raindrops_show_right_sidebar;
        foreach($vals as $val){
            if($input == $val){
            return $input;
            }
        }
        return get_option("col_settings_raindrops_show_right_sidebar");
    }
    function raindrops_footer_color_validate($input){
    if($input == ''){return $input;}
        if(preg_match("|#[0-9a-f]{6}|i",$input)){
            return $input;
        }
        return get_option("raindrops_default_fonts_color");
    }
    function raindrops_default_fonts_color_validate($input){
        if($input == ''){return $input;}
        if(preg_match("|#[0-9a-f]{6}|i",$input)){
            return $input;
        }
        return get_option("raindrops_default_fonts_color");
    }
    function raindrops_col_width_validate($input){
        $obj = new tmn_menu_create();
        $vals = $obj->col_settings_raindrops_col_width;
        foreach($vals as $val){
            if($input == $val){
            return $input;
            }
        }
        return get_option("raindrops_col_width");
    }
    function raindrops_page_width_validate($input){
        $obj = new tmn_menu_create();
        $vals = $obj->col_settings_raindrops_page_width;
        foreach($vals as $val){
            if($input == $val){
            return $input;
            }
        }
        return get_option("raindrops_page_width");
    }
    function raindrops_heading_image_validate($input){
        if(preg_match('/[^(a-z|0-9|_|-|\.)]+/si',$input)){
        return get_option("raindrops_heading_image");
        }
        return $input;
    }
    function raindrops_heading_image_position_validate($input){
        if(is_numeric($input) and $input < 8 and -1 < $input ){
        return $input;
        }
        return get_option("raindrops_heading_image_position");
    }
    function raindrops_footer_image_validate($input){
       if(preg_match('/[^(a-z|0-9|_|-|\.)]+/si',$input)){
            return get_option("raindrops_header_image");
        }
            return $input;
    }
    function raindrops_header_image_validate($input){
        if(preg_match('/[^(a-z|0-9|_|-|\.)]+/si',$input)){
            return get_option("raindrops_header_image");
        }
         return $input;
    }
    function raindrops_style_type_validate($input){
        $obj = new tmn_menu_create();
        $vals = $obj->col_settings_raindrops_style_type;
        foreach($vals as $val){
            if($input == $val){
            return $input;
            }
        }
        return get_option("raindrops_style_type");
    }
    function raindrops_base_color_validate($input){
        if($input == ''){return $input;}
        if(preg_match("|#[0-9a-f]{6}|i",$input)){
            return $input;
        }
        return get_option("raindrops_base_color");
    }

    function raindrops_header_image_show_validate($input){
        if($input == 'yes'){
            return 'yes';
        }else{
            return 'no';
        }
    }

/**
 * Filter functon body_class()
 *
 * add browser class, languages class,
 *
 *
 */
    if (!function_exists('raindrops_add_body_class')) {
        function raindrops_add_body_class($class) {
            $lang = get_bloginfo("language");
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

/**
 * wp_list_comments callback function
 *
 *
 * comments.php
 *
 */

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
          <?php edit_comment_link( __( '(Edit)', 'Raindrops' ), ' ' ); ?>
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

/**
 * Echo posted in block
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
            printf(
                $posted_in,
                get_the_category_list( ', ' ),
                $tag_list,
                get_permalink(),
                the_title_attribute( 'echo=0' )
            );
        }
    }

/**
 * Echo posted_on block
 *
 *
 * loop.php
 *
 */

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

/**
 * Special custom field key CSS javascript metatags
 *
 * css,javascrip,meta is separated anothor Custom Field.
 *
 *
 */

    if (!function_exists('filter_explode_meta_keys')) {
        function filter_explode_meta_keys( $content, $key ) {
            $explode_keys = array( 'css', 'javascript', 'meta');
            if ( in_array( $key, $explode_keys ) ) return;
            else return $content;
        }
    }

/**
 * like get_option()
 *
 * Raindrops conditional response.
 *
 * for templates
 */
    function warehouse($name){
        global $raindrops_base_setting;
        global $page_width;
        $vertical = array();
        if(isset($raindrops_base_setting)){
            foreach($raindrops_base_setting as $key=>$val){
                if(!is_null($raindrops_base_setting)){
                    $vertical[] = $val['option_name'];
                }
            }

                $row = array_search($name,$vertical);
            if(isset($page_width) and !empty($page_width) and $name == 'raindrops_page_width'){
                return 'custom-doc';
            }

            return get_option($name, $raindrops_base_setting[$row]['option_value']);
        }
    }

/**
 * Return $raindrops_base_setting value.
 *
 *
 *
 *
 */

    function tmn_admin_meta($name,$meta_name){
        global $raindrops_base_setting;
        global $page_width;
        $vertical = array();
        foreach($raindrops_base_setting as $key=>$val){
            if(!is_null($raindrops_base_setting)){
                $vertical[] = $val['option_name'];
            }
        }
            $row = array_search($name,$vertical);
            return $raindrops_base_setting[$row][$meta_name];
    }

/**
 * Raindrops Admin Panel help
 *
 *
 *
 *
 */

    if (!function_exists('raindrops_help')) {
        function raindrops_help($text){
        global $title;
        if(TMN_TABLE_TITLE == $title){
    $result = "<h2 class=\"h2\">".__('Raindrops Another Settings').'</h2>';
    $result .= "<dl><dt><div class=\"icon32\" id=\"icon-options-general\"><br></div><strong>".__('When you do not want to use the automatic color setting','Raindrops').'</strong></dt>';
    $result .= "<dd>".__('raindrops/config.php TMN_USE_AUTO_COLOR value change false','Raindrops').'</dd><br class="clear" />';
    $result .= "<dt><div class=\"icon32\" id=\"icon-themes\"><br></div><strong>".__('When you want to display the custom header image','Raindrops').'</strong></dt>';
    $result .= "<dd>".__('Raindrops thme option tmn_show_header_image value change yes','Raindrops').'</dd><br class="clear" />';
    $result .= "<dt><div class=\"icon32\" id=\"icon-themes\"><br></div><strong>".__('When you want to all reset the settings','Raindrops').'</strong></dt>';
    $result .= "<dd>".__('Please install it switching to other themes once to reset all items, and again again. When switching to other themes, Raindrops restores all customizing information. ','Raindrops').'</dd><br class="clear" />';
    $result .= "<p>".sprintf(__('WEBSite:<a href="%1$s">%2$s</a>'),'http://www.tenman.info/wp3/raindrops','Raindrops').'</p>';
            return apply_filters("raindrops_help",$result);
        }else{
            return $text;
        }
        }
    }

/**
 * Raindrops edit help
 *
 * Check the real color of the Cradation Class and the Color Class.
 *
 *
 */

    if (!function_exists('raindrops_edit_help') and TMN_USE_AUTO_COLOR == true) {
        function raindrops_edit_help($text){
        global $post_type_object;
        global $title;
        if(isset($post_type_object) and ($title == $post_type_object->labels->add_new_item or $title == $post_type_object->labels->edit_item)){
            $result = "<h2 class=\"h2\">".__('Tips',"Raindrops").'</h2>';
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
 * Admin Panel toggle action
 *
 *
 *
 *
 */

    function jquery_toggle_action(){
        echo '<meta http-equiv="content-script-type" content="text/css" />';
        echo '<meta http-equiv="content-script-type" content="text/javascript" />';
        echo '<script type="text/javascript">';
        echo 'jQuery(function(){';
        echo '  jQuery(\'.widefat\').css({"margin":"2em"});';
        echo '  jQuery(".rd-excerpt").css({"margin-left":"3em"});';
        echo '    jQuery(\'*[class^="raindrops"]\').hide().css("width","100%");';
        echo '    jQuery(\'*[id^="raindrops"]\').css({ "cursor":"pointer", "color":"#009999"}).click(';
        echo '      function(){';
        echo '        var target ="."+jQuery(this).attr("id");';
        echo '        jQuery(target).toggle("slow");';
        echo '      });';
        echo '    jQuery(\'*[id^="showAll"]\').css("cursor","pointer").click(';
        echo '      function(){';
        echo '        jQuery(\'*[class^="raindrops"]\').show().css("width","100%");';
        echo '      }';
        echo '    );';
        echo '    jQuery(\'*[id^="hideAll"]\').css("cursor","pointer").click(';
        echo '      function(){';
        echo '        jQuery(\'*[class^="raindrops"]\').hide().css("width","100%");';
        echo '      }';
        echo '    );';
        echo '  });';
        echo '</script>';
    }

/**
 * Create admin panel form and define input value.
 *
 *
 *
 *
 */

    function raindrops_options_init(){
        global $raindrops_base_setting;
        if(isset($raindrops_base_setting)){
            foreach($raindrops_base_setting as $setting){
                register_setting( 'raindrop_options', $setting['option_name'], $setting['validate'] );
            }
        }
    }
    class tmn_menu_create {
        var $accesskey  = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
        var $table_template = '<table class="%s widefat post fixed" style="margin:2em;">';
        var $title_template = '<h3 title="%s" id="%s" style="position:relative;top:-0.3em;padding-bottom:0.6em;text-indent:1em;cursor:auto;background:none;">%s</h3>';
        var $excerpt_template = '<div style="margin:2em;">%s</div>';
        var $line_select_element='<select  accesskey="%s" name="%s" size="%d" style="width:150px;vertical-align:bottom;margin-bottom:0px;height:%spx;">';
        var $col_settings_raindrops_col_width = array(
            "left 160px"=>"t1",
            "left 180px"=>"t2",
            "left 300px"=>"t3",
            "right 180px"=>"t4",
            "right 240px"=>"t5",
            "right 300px"=>"t6"
            );
        var $col_settings_raindrops_page_width = array(
            "750px centered"=>"doc",
            "950px centered"=>"doc2",
            "100% fluid"=>"doc3",
            "974px fluid"=>"doc4"
            );
        var $col_settings_raindrops_right_sidebar_width_percent = array(
            "25%"=>"25",
            "33%"=>"33",
            "50%"=>"50",
            "66%"=>"66",
            "75%"=>"75"
            );
        var $col_settings_raindrops_show_right_sidebar = array(
            "show"=>"show",
            "hide"=>"hide"
            );
        var $col_settings_raindrops_style_type = array(
            "light"=>"light",
            "dark"=>"dark",
            "default"=>"default",
            "minimal"=>"minimal"
            );
        function SubMenu_GUI() {
            $result = "";
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
                $valid_function = $option_name.'_validate';
            if( !empty($_POST) and
                 isset($_POST) and
                 $option_value == $valid_function($option_value)
                  ){
                  if(update_option($option_name,$option_value)){
                    do_action( 'raindrops_change_style' );
                    $ok = true;
                   }
            }
            if($option_value !== $valid_function($option_value)){
                $add_str .= __("BAD value","Raindrops");
            }
            }
            $result .= '<div class="wrap"><div id="title-raindrops-header" style="height:100px">';
            $result .= screen_icon();
            $result .= "<h2>" . get_current_theme() . __(' Theme Settings') . "</h2>";
            $result .= "<p>Saved Database table name:<strong>".TMN_PLUGIN_TABLE."</strong></p></div>";
            $result .= '<div style="clear:both;margin:2em;"><button id="showAll" class="button">'.__("Show All", "Raindrops").'</button>&nbsp;&nbsp;<button id="hideAll" class="button">'.__("Hide All", "Raindrops").'</button></div><br style="clear:both;" />';

            if(isset($_POST) and !empty($_POST)){
            if($ok){
                $add_str = "";
                $scheme = TMN_COLOR_SCHEME;
                global $$scheme;
                $add_str = array_search($option_value,$$scheme);
                $add_str .= array_search($option_value,$this->col_settings_raindrops_col_width);
                $add_str .= array_search($option_value,$this->col_settings_raindrops_page_width);
                $add_str .= array_search($option_value,$this->col_settings_raindrops_right_sidebar_width_percent);
                $add_str .= array_search($option_value,$this->col_settings_raindrops_show_right_sidebar);
                $add_str .= array_search($option_value,$this->col_settings_raindrops_style_type);

                if($option_value !== $valid_function($option_value)){
                    $add_str = __("BAD value","Raindrops");
                }

            $result .= '<div id="message" class="updated fade" title="'.$option_name.'"><p>'.sprintf(__('<strong>%1$s</strong> updated %2$s => %3$s  successfully.'),tmn_admin_meta($option_name,'title'), $option_name, $add_str.' ['.$option_value.']').'</p></div>';
            }else{
            $result .= '<div id="message" class="error fade" ><p>'.__("Try again").$add_str.'</p></div>';
            }
            }
            $result .= '</div>';
            $result .= '<div id="reset2"></div>';
            $result .= $this->form_user_input();
            echo $result;
        }
        function add_menus() {
            if(function_exists('add_theme_page')) {

           add_theme_page(TMN_TABLE_TITLE, 'Raindrops Options', 'edit_theme_options', 'raindrops_settings', array($this, 'SubMenu_GUI'));
            }
        }
        function form_user_input(){
            global $raindrops_base_setting;
            global $wpdb;
            $option_value   = "-";
            $lines          = "";
            $i              = 0;
            $deliv          = htmlspecialchars($_SERVER['REQUEST_URI']);
            $sql = 'SELECT * FROM `'.TMN_PLUGIN_TABLE.'` WHERE `option_name` LIKE \'raindrops%\' order by `option_id` ASC';
            $results        = $wpdb->get_results($sql);
            foreach($results as $key=>$result){
                $excerpt = "";
                $table = sprintf($this->table_template,str_replace("_","-",$result->option_name));
                $excerpt = sprintf($this->title_template,str_replace("_"," ",$result->option_name),str_replace("_","-",$result->option_name),tmn_admin_meta($result->option_name,'title'));
                $excerpt .= sprintf($this->excerpt_template,tmn_admin_meta($result->option_name,'excerpt2'));
                if(!empty($excerpt)){
                    $excerpt = '<div class="postbox" style="margin:1em;width:90%;overflow:hidden;background:#dedede">'.$excerpt;
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
                if (TMN_USE_AUTO_COLOR == false and (   $result->option_name == "raindrops_footer_color" or
                                                        $result->option_name == "raindrops_default_fonts_color" or
                                                        $result->option_name == "raindrops_base_color" or
                                                        $result->option_name == "raindrops_header_image" or
                                                        $result->option_name == "raindrops_footer_image" or
                                                        $result->option_name == "raindrops_heading_image_position" or
                                                        $result->option_name == "raindrops_heading_image" or
                                                        $result->option_name == "raindrops_style_type") ){
                    continue;
                }
            $lines .= $excerpt;
            $lines .= $table;
                $lines .= $table_header;
                $lines .= "<form action=\"$deliv\" method=\"post\">".wp_nonce_field('update-options');
                $lines .= '<tbody>';
                $lines .= '<tr>';
                $lines .= '<td style="display:none;">';
                $lines .= '<input type="text" name="option_id" value="'.$result->option_id.'" />'.esc_html($result->option_id).'</td>';
                $lines .= '<td style="'.$style.'">';
                $lines .= '<input type="hidden" name="option_name" value="'.esc_attr($result->option_name).'" read-only="read-only" /></td>';
                $lines .= '<td>'.esc_html($result->option_value).'</td>';
                if( $result->option_name == "raindrops_base_color" or
                    $result->option_name == "raindrops_footer_color" or
                    $result->option_name == "raindrops_default_fonts_color" ){
                    $lines .= "<td>".$this->color_selector('option_value',esc_attr__($result->option_value,'Raindrops'),$i)."</td>";
                }elseif($result->option_name == "raindrops_col_width"){
                    $lines .= '<td>';
                    $lines .= sprintf($this->line_select_element,$this->accesskey[$i],"option_value",6,120);
                    foreach($this->col_settings_raindrops_col_width as $key=>$val){
                        if(strcmp($result->option_value,$val) == 0){ $selected = 'selected="selected"';}else{$selected = "";}
                        $lines .= '<option value="'.esc_attr__($val,'Raindrops').'" '.esc_attr($selected).'>'.esc_html($key).'</option>';
                    }
                    $lines .='</select></td>';
                }elseif($result->option_name == "raindrops_page_width"){
                    $lines .= '<td>';
                    $lines .= sprintf($this->line_select_element,esc_attr($this->accesskey[$i]),"option_value",4,80);
                    foreach($this->col_settings_raindrops_page_width as $key=>$val){
                        if(strcmp($result->option_value,$val) == 0){ $selected = 'selected="selected"';}else{$selected = "";}
                        $lines .= '<option value="'.esc_attr__($val,'Raindrops').'" '.esc_attr($selected).'>'.esc_html($key).'</option>';
                    }
                    $lines .='</select></td>';
                }elseif($result->option_name == "raindrops_right_sidebar_width_percent"){
                    $lines .= '<td>';
                    $lines .= sprintf($this->line_select_element,esc_attr($this->accesskey[$i]),"option_value",5,100);
                    foreach($this->col_settings_raindrops_right_sidebar_width_percent as $key=>$val){
                        if(strcmp($result->option_value,$val) == 0){ $selected = 'selected="selected"';}else{$selected = "";}
                        $lines .= '<option value="'.esc_attr__($val,'Raindrops').'" '.esc_attr($selected).'>'.esc_html($key).'</option>';
                    }
                    $lines .='</select></td>';
                }elseif($result->option_name == "raindrops_show_right_sidebar"){
                    $lines .= '<td>';
                    $lines .= sprintf($this->line_select_element,esc_attr($this->accesskey[$i]),esc_attr("option_value"),2,40);
                    foreach($this->col_settings_raindrops_show_right_sidebar as $key=>$val){
                        if(strcmp($result->option_value,$val) == 0){ $selected = 'selected="selected"';}else{$selected = "";}
                        $lines .= '<option value="'.esc_attr__($val,'Raindrops').'" '.esc_attr($selected).'>'.esc_html($key).'</option>';
                    }
                    $lines .='</select></td>';
                }elseif($result->option_name == "raindrops_style_type"){
                    $lines .= '<td>';
                    $lines .= sprintf($this->line_select_element,$this->accesskey[$i],"option_value",3,60);
                    foreach($this->col_settings_raindrops_style_type as $key=>$val){
                        if(strcmp($result->option_value,$val) == 0){ $selected = 'selected="selected"';}else{$selected = "";}
                        $lines .= '<option value="'.esc_attr__($val,'Raindrops').'" '.esc_attr($selected).'>'.esc_html($key).'</option>';
                    }
                    $lines .='</select></td>';
                }elseif($result->option_name == "raindrops_heading_image"){
                    $lines .= '<td style="height:225px">';
                    $lines .= '<input  accesskey="'.esc_attr($this->accesskey[$i]).'" type="text" name="option_value" value="'.esc_attr__($result->option_value,'Raindrops').'"';
                    //if($result->option_name == "raindrops_base_color"){
                        $lines .= 'id="'.$result->option_name.'"';
                    //}
                    $lines .= '/></td>';
                }else{
                    $lines .= '<td>';
                    $lines .= '<input  accesskey="'.esc_attr($this->accesskey[$i]).'" type="text" name="option_value" value="'.esc_attr__($result->option_value).'"';
                    $lines .= 'id="'.esc_attr($result->option_name).'"';
                    $lines .= '/></td>';
                }
                $i++;
                $lines .= '<td>';
                $lines .= "<input type=\"submit\" class=\"button-primary\" value=\"".esc_attr__('Save Changes').'" />';
                $lines .= '</p></td></tr></form>';
                $send_key_name = "";
                $lines .= "</tbody>";
                $lines .= "</table></div>";
            }
                $lines .= "</div>";
                if(!preg_match('|<tbody>|',$lines)){
                    $lines .= "<tbody><tr><td colspan=\"4\">".__("Please reload this page ex. windows F5",'Ranidrops').'</td></tr>';
                }
                return $lines;
        }
         function color_selector($name,$current_val,$i){
            global $color_ja,$color_en_140,$color_en;
            $result = sprintf($this->line_select_element,$this->accesskey[$i],$name,4,100);
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
    } //end class

/**
 * Show real gradient where admin panel help
 *
 *
 *
 *
 */

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

    function tmn_gradient(){
        $g = "";
        for($i = 1;$i<5;$i++){
        $custom_dark_bg1 = colors($i,'background');
        $custom_light_bg1 = colors($i+1,'background');
        $custom_dark_bg2 = colors($i,'background');
        $custom_light_bg2 = colors($i-1,'background');
        $g .= '.gradient'.$i.'{';
        $g .= 'color:'.colors($i,'color').';';
        $g .= 'background: -webkit-gradient(linear, left top, left bottom, from('.$custom_dark_bg1.'), to('.$custom_light_bg1.'));';
        $g .= 'background: -moz-linear-gradient(top,  '.$custom_dark_bg1.',  '.$custom_light_bg1.');';
        $g .= 'filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$custom_dark_bg1.'\', endColorstr=\''.$custom_light_bg1.'\');';
        $g .= "}\n";
        $g .= '.gradient-'.$i.'{';
        $g .= 'color:'.colors($i,'color').';';
        $g .= 'background: -webkit-gradient(linear, left top, left bottom, from('.$custom_dark_bg2.'), to('.$custom_light_bg2.'));';
        $g .= 'background: -moz-linear-gradient(top,  '.$custom_dark_bg2.',  '.$custom_light_bg2.');';
        $g .= 'filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$custom_dark_bg2.'\', endColorstr=\''.$custom_light_bg2.'\');';
        $g .= "}\n";
        }
        return $g;
    }
    function add_raindrops_stylesheet() {
        global $wpdb;
        $raindrops_url  = get_stylesheet_directory_uri(). '/lib/style.php';
        $raindrops_file = get_stylesheet_directory(). '/lib/style.php';
        if ( file_exists($raindrops_file) ) {
            wp_register_style('raindrops_style_sheet', $raindrops_url,array(),'0.1','all');
            wp_enqueue_style( 'raindrops_style_sheet');
        }
        //$stylesheet_name = 'b'.str_replace("wp","",$wpdb->prefix).'-csscolor.css';
        $raindrops_url  = get_stylesheet_directory_uri() . '/lib/' .INDIVIDUAL_STYLE;
        $raindrops_file = get_stylesheet_directory() . '/lib/' .INDIVIDUAL_STYLE;
        if ( file_exists($raindrops_file) and TMN_USE_AUTO_COLOR == true) {
            $ver = md5(get_option('_raindrops_indv_css'));
            wp_register_style('raindrops_individual_style_sheet', $raindrops_url,array(),$ver,'all');
            wp_enqueue_style( 'raindrops_individual_style_sheet');
        }
    }

/**
 * filter function comment form
 *
 *
 *
 *
 */

    function tmn_comment_form($form){
    global $commenter;
    $form['url'] = '<p class="comment-form-url"><label for="url">' . __( 'Website' ) . '</label><span class="option">'.__('Option','Raindrops').'</span><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>';
    return $form;
    }

/**
 * filter function remove area required
 *
 *
 *
 *
 */

    function custom_remove_aria_required1($arg){
        $change = array("aria-required=\"true\"","aria-required='true'");
        $arg = str_replace($change,'',$arg);
        return $arg;
    }

/**
 * filter function remove area required
 *
 *
 *
 *
 */

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

/**
 * Option value set when install.
 *
 *
 *
 *
 */

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

/**
 * Parse URL from html tags
 *
 *
 *
 *
 */

    function get_url_from_element($tag){
        preg_match('|(https?)(://[[:alnum:]\+\$\;\?\.%,!#~*/:@&=_-]+)|i',$tag,$regs);
        if(empty($regs[2])){return false;}
        return $regs[1].$regs[2];
    }

/**
 * Parse title from html tags
 *
 *
 *
 *
 */

    function get_title_from_element($tag){
        preg_match('|title=\"([^\"]+)\"|i',$tag,$regs);
        if(empty($regs[1])){return "no title";}
        return $regs[1];
    }

/**
 * Raindrops once message when install.
 *
 *
 *
 *
 */

    function first_only_msg($type=0) {
        if ( $type == 1 ) {
            $query  = 'raindrops_settings';
            $link   = get_site_url('', 'wp-admin/themes.php', 'admin') . '?page='.$query;
            $msg    = sprintf(__('Thank you for adopting the %s theme. It is necessary to set it to this theme. Please move to a set screen clicking this <a href="%s">Raindrops settings view</a>.','Raindrops'),get_current_theme() ,$link);
        }
        return '<div id="testmsg" class="error"><p>' . $msg . '</p></div>' . "\n";
    }

/**
 * Management of uninstall and install.
 *
 *
 *
 *
 */

    function install_navigation() {
        if ( false === get_option('_raindrops_install') ) {
            add_action('admin_notices', create_function(null, 'echo first_only_msg(1);'));
            add_option('_raindrops_install', true);
        } else {
            add_action('switch_theme', create_function(null, 'delete_option("_raindrops_install");'));
            add_action('switch_theme', create_function(null, 'delete_option("_raindrops_indv_css");'));
            add_action('switch_theme', 'bye_raindrops');
        }
    }

/**
 * delete option value when theme uninstall
 *
 *
 *
 *
 */

    function bye_raindrops(){
        global $raindrops_base_setting;
        foreach( $raindrops_base_setting as $bye){
            delete_option($bye['option_name']);
        }
    }

/**
 * Alert when $tmn_show_header_image not 'yes'
 *
 *
 *
 *
 */

    function header_image_alert(){
        if(isset($_GET['page']) and $_GET['page'] == 'custom-header'){

        printf('<script type="text/javascript">alert(\'%s\');</script>',__('Current theme setting is hide header image. You need Raindrops option setting. Please open Raindrops option panel, and set the value of tmn_show_header_image to yes.','Raindrops'));
        }

    }

/**
 * insert into embed style ,javascript script and embed tags from custom field
 *
 *
 *
 *
 */

    function tmn_embed_meta($content){
        $result = "";
        global $post;

        if (is_single() || is_page()) {
            if(have_posts()){
             while (have_posts()) : the_post();
                $css = get_post_meta($post->ID, 'css', true);
                if (!empty($css)) {
                $result .= '<style type="text/css">';
                $result .= "\n/*<![CDATA[*/\n";
                $result .=  $css;
                $result .= "\n/*]]>*/\n";
                $result .= "</style>";
                }
                $javascript = get_post_meta($post->ID, 'javascript', true);
                if (!empty($javascript)) {
                $result .= '<script type="text/javascript">';
                $result .= "\n/*<![CDATA[*/\n";
                $result .= $javascript;
                $result .= "\n/*]]>*/\n";
                $result .= "</script>";
                }
                $meta = get_post_meta($post->ID, 'meta', true);
                if (!empty($meta)) {
                $result .= $meta;
                }
              endwhile;
            }else{
            }
        }
        echo $result;
        return $content;
    }

/**
 *  Alternative character when no title
 *
 *
 *
 *
 */

    function blank_fallback($string,$fallback){
        if(!empty($string)){
            return $string;
        }else{
            return $fallback;
        }
    }

/**
 *
 *
 *
 *
 *
 */

    function raindrops_prev_next_post($position = "nav-above"){

        $raindrops_max_length     = 40;
        $raindrops_prev_length    = $raindrops_max_length + 1;

        if(!is_attachment()){

            $raindrops_max_length     = 40;
            $raindrops_prev_post_id   = get_adjacent_post(true,'',true) ;
            $raindrops_prev_length    = strlen(get_the_title($raindrops_prev_post_id));
            $raindrops_next_post_id   = get_adjacent_post(false,'',false) ;
            $raindrops_next_length    = strlen(get_the_title($raindrops_next_post_id));

        }
?>

<div id="<?php echo $position;?>" class="clearfix">
<?php if($raindrops_prev_length < $raindrops_max_length ){?>
  <span class="nav-previous"><?php previous_post_link('%link','<span class="button">&laquo; prev: %title</span>'); ?></span>
<?php }else{?>
  <span class="nav-previous"><?php previous_post_link('%link','<span class="long-title">&laquo;prev: %title</span>'); ?></span>
<?php }?>
<?php if($raindrops_next_length < $raindrops_max_length ){?>
  <div class="nav-next"><?php next_post_link('%link','<span class="button">next: %title &raquo;</span>'); ?></div>
<?php }else{?>
  <div class="nav-next"><?php next_post_link('%link','<span class="long-title">next: %title &raquo; </span>'); ?></div>
<?php }?>
</div>
<?php }?>