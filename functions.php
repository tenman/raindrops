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
add_filter( 'use_default_gallery_style', '__return_false' );


if(!defined('ABSPATH')){exit;}

    global $wpdb;

/**
 * If you need original page width
 * you can specific pixel page width
 * e.g. '$page_width = '776';' is  776px page width.
 *
 *
 */
    $page_width = '';

/**
 * If you need specific $content_width.
 * value set 400 When not setting or empty.
 *
 *
 *
 */

    //$content_width = '';


/**
 * 750px,950px centered layout fluid or fixed page width switch
 *
 *
 * value 'fixed' or empty
 *
 */
    $fluid_or_fixed = 'fixed';

/**
 * fluid page  main column minimam width px
 *
 *
 *
 *
 */
    $fluid_minimam_width = '400';
/**
 * the_excerpt use where index,archive,other not single pages.
 * If RAINDROPS_USE_LIST_EXCERPT value false and use the_content .
 *
 *
 *
 */

    if(!defined('RAINDROPS_USE_LIST_EXCERPT')){
        define("RAINDROPS_USE_LIST_EXCERPT",false);
    }

/**
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
 * If you want change colors when set value color_en,color_en_140 or color_ja.
 * this theme not use color picker why The range of the selection need not be infinity.
 * There is a traditional color, and the country and the region are shown symbolically in a lot of countries and regions.
 *
 *
 */

/*
    if(!defined('RAINDROPS_COLOR_SCHEME')){
        define("RAINDROPS_COLOR_SCHEME","color_ja");
    }*/

/**
 * header text
 *
 *
 *
 *
 */


    if(!defined('NO_HEADER_TEXT')){
        define('NO_HEADER_TEXT', false );
    }

/**
 *  Specific automatic color at title,description when value ''.
 *
 *
 *
 *
 */

    if(!defined('HEADER_TEXTCOLOR')){
        define('HEADER_TEXTCOLOR', '');
    }

/**
 * header image
 *
 *
 *
 *
 */

    if(!defined('HEADER_IMAGE')){
        define('HEADER_IMAGE', '%s/images/headers/wp3.jpg');
    }


    if(!defined('HEADER_IMAGE_WIDTH')){
        define('HEADER_IMAGE_WIDTH', 950);
    }
    if(!defined('HEADER_IMAGE_HEIGHT')){
        define('HEADER_IMAGE_HEIGHT', 198);
    }


/**
 * monthly archive, daily archive  time format
 *
 *
 *
 *
 */

    if(!defined('RAINDROPS_THE_TIME_FORMAT')){
        define("RAINDROPS_THE_TIME_FORMAT",'Y/n/j');//

    }
    if(!defined('RAINDROPS_THE_MONTH_FORMAT')){
        define("RAINDROPS_THE_MONTH_FORMAT",'Y/m');//archive.php

    }

    if(!defined('RAINDROPS_TABLE_TITLE')){
        define("RAINDROPS_TABLE_TITLE",'options');
    }

    if(!defined('RAINDROPS_PLUGIN_TABLE')){
        define('RAINDROPS_PLUGIN_TABLE',$wpdb->prefix . RAINDROPS_TABLE_TITLE);
    }
    if(!defined('RAINDROPS_TABLE_VERSION')){
        define('RAINDROPS_TABLE_VERSION','0.1');
    }

    $raindrops_theme_settings = get_option('raindrops_theme_settings','no');
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
/**
 * widget settings
 *
 *
 *
 *
 */
    if(!function_exists('raindrops_widgets_init')){

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
    }

/**
 * RAINDROPS_COLOR_SCHEME
 *
 *
 *
 *
 */

$color_ja= array(__('none','Raindrops') => "",__('toki','Raindrops') => "#F9A1D0",__('tutuji','Raindrops') => "#CB4B94",__('sakura','Raindrops') => "#FFDBED",__('bara','Raindrops') => "#D34778",__('karakurenai','Raindrops') => "#E3557F",__('sango','Raindrops') => "#FF87A0",__('koubai','Raindrops') => "#E08899",__('momo','Raindrops') => "#E38698",__('beni','Raindrops') => "#BD1E48",__('beniaka','Raindrops') => "#B92946",__('enji','Raindrops') => "#AE3846",__('suou','Raindrops') => "#974B52",__('akane','Raindrops') => "#A0283A",__('aka','Raindrops') => "#BF1E33",__('syu','Raindrops') => "#ED514E",__('benikaba','Raindrops') => "#A14641",__('benihi','Raindrops') => "#EE5145",__('entan','Raindrops') => "#D3503C",__('beniebitya','Raindrops') => "#703B32",__('tobi','Raindrops') => "#7D483E",__('azuki','Raindrops') => "#946259",__('bengara','Raindrops') => "#8A4031",__('ebitya','Raindrops') => "#6D3D33",__('kinaka','Raindrops') => "#ED542A",__('akatya','Raindrops') => "#B15237",__('akasabi','Raindrops') => "#923A21",__('ouni','Raindrops') => "#EF6D3E",__('sekitou','Raindrops') => "#ED551B",__('kaki','Raindrops') => "#E06030",__('nikkei','Raindrops') => "#B97761",__('kaba','Raindrops') => "#BD4A1D",__('renga','Raindrops') => "#974E33",__('sabi','Raindrops') => "#664134",__('hiwada','Raindrops') => "#8A604F",__('kuri','Raindrops') => "#754C38",__('kiaka','Raindrops') => "#E45E00",__('taisya','Raindrops') => "#BA6432",__('rakuda','Raindrops') => "#B67A52",__('kitye','Raindrops') => "#BB6421",__('hadairo','Raindrops') => "#F4BE9B",__('daidai','Raindrops') => "#FD7E00",__('haitya','Raindrops') => "#866955",__('tya','Raindrops') => "#734E30",__('kogetya','Raindrops') => "#594639",__('kouji','Raindrops') => "#FFA75E",__('anzu','Raindrops') => "#DDA273",__('mikan','Raindrops') => "#FA8000",__('kassyoku','Raindrops') => "#763900",__('tutiiro','Raindrops') => "#A96E2D",__('komugi','Raindrops') => "#D9A46D",__('kohaku','Raindrops') => "#C67400",__('kintya','Raindrops') => "#C47600",__('tamago','Raindrops') => "#FABE6F",__('yamabuki','Raindrops') => "#FFA500",__('oudo','Raindrops') => "#C18A39",__('kutiba','Raindrops') => "#897868",__('himawari','Raindrops') => "#FFB500",__('ukon','Raindrops') => "#FCAC00",__('suna','Raindrops') => "#C9B9A8",__('karasi','Raindrops') => "#CDA966",__('ki','Raindrops') => "#FFBE00",__('tanpopo','Raindrops') => "#FFBE00",__('uguisutya','Raindrops') => "#70613A",__('tyuki','Raindrops') => "#FAD43A",__('kariyasu','Raindrops') => "#EED67E",__('kihada','Raindrops') => "#D9CB65",__('miru','Raindrops') => "#736F55",__('biwa','Raindrops') => "#C2C05C",__('uguisu','Raindrops') => "#71714A",__('mattya','Raindrops') => "#BDBF92",__('kimidori','Raindrops') => "#B9C42F",__('koke','Raindrops') => "#7A7F46",__('wakakusa','Raindrops') => "#A9B735",__('moegi','Raindrops') => "#96AA3D",__('kusa','Raindrops') => "#72814B",__('wakaba','Raindrops') => "#AFC297",__('matuba','Raindrops') => "#6E815C",__('byakuroku','Raindrops') => "#CADBCF",__('midori','Raindrops') => "#4DB56A",__('tokiwa','Raindrops') => "#357C4C",__('rokusyou','Raindrops') => "#5F836D",__('titosemidori','Raindrops') => "#4A6956",__('fukamidori','Raindrops') => "#005731",__('moegi','Raindrops') => "#15543B",__('wakatake','Raindrops') => "#49A581",__('seiji','Raindrops') => "#80AA9F",__('aotake','Raindrops') => "#7AAAAC",__('tetu','Raindrops') => "#244344",__('aomidori','Raindrops') => "#0090A8",__('sabiasagi','Raindrops') => "#6C8D9B",__('mizuasagi','Raindrops') => "#7A99AA",__('sinbasi','Raindrops') => "#69AAC6",__('asagi','Raindrops') => "#0087AA",__('byakugun','Raindrops') => "#84B5CF",__('nando','Raindrops') => "#166A88",__('kamenozoki','Raindrops') => "#8CB4CE",__('mizu','Raindrops') => "#A9CEEC",__('ainezu','Raindrops') => "#5E7184",__('sora','Raindrops') => "#95C0EC",__('ao','Raindrops') => "#0067C0",__('ai','Raindrops') => "#2E4B71",__('koiai','Raindrops') => "#20324E",__('wasurenagusa','Raindrops') => "#92AFE4",__('tuyukusa','Raindrops') => "#3D7CCE",__('hanada','Raindrops') => "#3C639B",__('konjou','Raindrops') => "#3D496B",__('ruri','Raindrops') => "#3451A4",__('rurikon','Raindrops') => "#324784",__('kon','Raindrops') => "#333C5E",__('kakitubata','Raindrops') => "#4C5DAB",__('kati','Raindrops') => "#383C57",__('gunjou','Raindrops') => "#414FA3",__('tetukon','Raindrops') => "#232538",__('fujinando','Raindrops') => "#6869A8",__('kikyou','Raindrops') => "#4A49AD",__('konai','Raindrops') => "#35357D",__('fuji','Raindrops') => "#A09BD8",__('fujimurasaki','Raindrops') => "#948BDB",__('aomurasaki','Raindrops') => "#704CBC",__('sumire','Raindrops') => "#6D52AB",__('hatoba','Raindrops') => "#675D7E",__('syoubu','Raindrops') => "#7051AA",__('edomurasaki','Raindrops') => "#5F4C86",__('murasaki','Raindrops') => "#A260BF",__('kodaimurasaki','Raindrops') => "#775686",__('nasukon','Raindrops') => "#47384F",__('sikon','Raindrops') => "#402949",__('ayame','Raindrops') => "#C27BC8",__('botan','Raindrops') => "#C24DAE",__('akamurasaki','Raindrops') => "#C54EA0",__('siro','Raindrops') => "#F1F1F1",__('gofun','Raindrops') => "#F2E8EC",__('kinari','Raindrops') => "#F0E2E0",__('zouge','Raindrops') => "#E3D4CA",__('ginnezu','Raindrops') => "#A0A0A0",__('tyanezumi','Raindrops') => "#9F9190",__('nezumi','Raindrops') => "#868686",__('rikyunezumi','Raindrops') => "#787C7A",__('namari','Raindrops') => "#797A88",__('hai','Raindrops') => "#797979",__('susutake','Raindrops') => "#605448",__('kurotya','Raindrops') => "#3E2E28",__('sumi','Raindrops') => "#313131",__('kuro','Raindrops') => "#262626",__('tetukuro','Raindrops') => "#262626");

$color_en_140 = array("none"=>"","white"=>"#ffffff","whitesmoke"=>"#f5f5f5","gainsboro"=>"#dcdcdc","lightgrey"=>"#d3d3d3","silver"=>"#c0c0c0","darkgray"=>"#a9a9a9","gray"=>"#808080","dimgray"=>"#696969","black"=>"#000000","red"=>"#ff0000","orangered"=>"#ff4500","tomato"=>"#ff6347","coral"=>"#ff7f50","salmon"=>"#fa8072","lightsalmon"=>"#ffa07a","darksalmon"=>"#e9967a","peru"=>"#cd853f","saddlebrown"=>"#8b4513","sienna"=>"#a0522d","chocolate"=>"#d2691e","sandybrown"=>"#f4a460","darkred"=>"#8b0000","maroon"=>"#800000","brown"=>"#a52a2a","firebrick"=>"#b22222","crimson"=>"#dc143c","indianred"=>"#cd5c5c","lightcoral"=>"#f08080","rosybrown"=>"#bc8f8f","palevioletred"=>"#db7093","deeppink"=>"#ff1493","hotpink"=>"#ff69b4","lightpink"=>"#ffb6c1","pink"=>"#ffc0cb","mistyrose"=>"#ffe4e1","linen"=>"#faf0e6","seashell"=>"#fff5ee","lavenderblush"=>"#fff0f5","snow"=>"#fffafa","yellow"=>"#ffff00","gold"=>"#ffd700","orange"=>"#ffa500","darkorange"=>"#ff8c00","goldenrod"=>"#daa520","darkgoldenrod"=>"#b8860b","darkkhaki"=>"#bdb76b","burlywood"=>"#deb887","tan"=>"#d2b48c","khaki"=>"#f0e68c","peachpuff"=>"#ffdab9","navajowhite"=>"#ffdead","palegoldenrod"=>"#eee8aa","moccasin"=>"#ffe4b5","wheat"=>"#f5deb3","bisque"=>"#ffe4c4","blanchedalmond"=>"#ffebcd","papayawhip"=>"#ffefd5","cornsilk"=>"#fff8dc","lightyellow"=>"#ffffe0","lightgoldenrodyellow"=>"#fafad2","lemonchiffon"=>"#fffacd","antiquewhite"=>"#faebd7","beige"=>"#f5f5dc","oldlace"=>"#fdf5e6","ivory"=>"#fffff0","floralwhite"=>"#fffaf0","greenyellow"=>"#adff2f","yellowgreen"=>"#9acd32","olive"=>"#808000","darkolivegreen"=>"#556b2f","olivedrab"=>"#6b8e23","chartreuse"=>"#7fff00","lawngreen"=>"#7cfc00","lime"=>"#00ff00","limegreen"=>"#32cd32","forestgreen"=>"#228b22","green"=>"#008000","darkgreen"=>"#006400","seagreen"=>"#2e8b57","mediumseagreen"=>"#3cb371","darkseagreen"=>"#8fbc8f","lightgreen"=>"#90ee90","palegreen"=>"#98fb98","springgreen"=>"#00ff7f","mediumspringgreen"=>"#00fa9a","honeydew"=>"#f0fff0","mintcream"=>"#f5fffa","azure"=>"#f0ffff","lightcyan"=>"#e0ffff","aliceblue"=>"#f0f8ff","darkslategray"=>"#2f4f4f","steelblue"=>"#4682b4","mediumaquamarine"=>"#66cdaa","aquamarine"=>"#7fffd4","mediumturquoise"=>"#48d1cc","turquoise"=>"#40e0d0","lightseagreen"=>"#20b2aa","darkcyan"=>"#008b8b","teal"=>"#008080","cadetblue"=>"#5f9ea0","darkturquoise"=>"#00ced1","aqua"=>"#00ffff","cyan"=>"#00ffff","lightblue"=>"#add8e6","powderblue"=>"#b0e0e6","paleturquoise"=>"#afeeee","skyblue"=>"#87ceeb","lightskyblue"=>"#87cefa","deepskyblue"=>"#00bfff","dodgerblue"=>"#1e90ff","ghostwhite"=>"#f8f8ff","lavender"=>"#e6e6fa","lightsteelblue"=>"#b0c4de","slategray"=>"#708090","lightslategray"=>"#778899","indigo"=>"#4b0082","darkslateblue"=>"#483d8b","midnightblue"=>"#191970","navy"=>"#000080","darkblue"=>"#00008b","slateblue"=>"#6a5acd","mediumslateblue"=>"#7b68ee","cornflowerblue"=>"#6495ed","royalblue"=>"#4169e1","mediumblue"=>"#0000cd","blue"=>"#0000ff","thistle"=>"#d8bfd8","plum"=>"#dda0dd","orchid"=>"#da70d6","violet"=>"#ee82ee","fuchsia"=>"#ff00ff","magenta"=>"#ff00ff","mediumpurple"=>"#9370db","mediumorchid"=>"#ba55d3","darkorchid"=>"#9932cc","blueviolet"=>"#8a2be2","darkviolet"=>"#9400d3","purple"=>"#800080","darkmagenta"=>"#8b008b","mediumvioletred"=>"#c71585");


$color_en = array("none"=>"","american red" => "#bf0a30","american blue" => "#002868","american green" => "#006e53","american yellow" => "#deb301","american light blue" => "#cbddf3","american brown" => "#9a6b37","american gray" => "#afafb1","glory red" => "#cc0033","glory blue" => "#0000ff","glory white" => "#fff9f5","big apple red" => "#ff6331","big apple blue" => "#3131ce","empire blue" => "#001873","empire cyan" => "#00b5d6","empire red" => "#d60000","empire yellow" => "#f7f700","empire orange" => "#f79429","empire green" => "#084a29","empire ebony" => "#424a00","natural red" => "#cc0033","natural blue" => "#000099","natural light blue" => "#84c8ef","natural green" => "#90c924","natural orange" => "#f39234","natural brown" => "#843a2f","natural gray" => "#bfbfbf","hawkeye red" => "#e3003d","hawkeye blue" => "#3c3c9e","hawkeye yellow" => "#ffb30f","hawkeye brown" => "#a54a00","frontier blue" => "#000080","frontier light blue" => "#d3eef7","frontier green" => "#024900","frontier yellow" => "#ffff00","frontier purple" => "#8663bd","dixie red" => "#b10021","dixie blue" => "#083152","dixie green" => "#105a21","dixie yellow" => "#ffc621","grand canyon blue" => "#002868","grand canyon red" => "#bf0a30","grand canyon brown" => "#ce5c17","grand canyon yellow" => "#fed700","grand canyon green" => "#00320b","grand canyon pink" => "#efc1a9","lincoln red" => "#e2184f","lincoln pink" => "#e24a4f","lincoln light blue" => "#64b4ff","lincoln blue" => "#3c3c9e","lincoln green" => "#3f863f","lincoln yellow" => "#ffe60f","lincoln orange" => "#ffb316","hoosier blue" => "#101195","hoosier yellow" => "#ffe700","hoosier green" => "#197351","hoosier brown" => "#563837","badger blue" => "#002986","badger light blue" => "#00b2fd","badger pink" => "#f8b8de","badger red" => "#f3334b","badger green" => "#41ad16","badger yellow" => "#ffe618","badger brown" => "#66180b","badger gray" => "#a2b9b9","mountain red" => "#ff3516","mountain blue" => "#003776","mountain green" => "#20d942","mountain yellow" => "#ffb30f","mountain brown" => "#d15b25","mountain gray" => "#c0c0c0","sooner blue" => "#0e4892","sooner light blue" => "#00adc6","sooner green" => "#1b692b","sooner opal" => "#8ab87a","sooner yellow" => "#f0c016","sooner brown" => "#421000","sooner beige" => "#ffc69c","sooner gray" => "#d6c6c6","sooner black" => "#454442","buckeye blue" => "#1a3b86","buckeye red" => "#ff0000","buckeye green" => "#00784b","buckeye yellow" => "#f8c300","buckeye brown" => "#4e3330","buckeye light blue" => "#027bc2","beaver blue" => "#002a86","beaver yellow" => "#ffea0f","golden red" => "#c10435","golden green" => "#007e3a","golden brown" => "#391800","golden yellow" => "#bc8e07","golden cyan" => "#40a7aa","golden gray" => "#84948e","sunflower blue" => "#00009c","sunflower light blue" => "#0092df","sunflower green" => "#29b910","sunflower orange" => "#ff660f","sunflower brown" => "#b34e20","sunflower purple" => "#7c4790","sunflower yellow" => "#ffe400","sunflower gray" => "#dedede","new england" => "#e25c5c","midatlantic" => "#5c7a7a","south" => "#8a84a3","florida" => "#e9bda2","midwest" => "#ffd577","texas" => "#77cbb3","great plains" => "#b6bc4d","rocky mountain" => "#e9df25","southwest" => "#ee2222","california" => "#e0fa92","pacific northwest" => "#38911c","alaska" => "#d09440","hawaii" => "#4f93c0","mountains alabama" => "#999966","metropolitan alabama" => "#ff9933","river heritage alabama" => "#996699","gulf coast alabama" => "#99cccc","southern california" => "#e03030","california desert" => "#e0b000","california central coast" => "#00b000","san joaquin valley" => "#a0a0c0","sacramento valley" => "#e0b000","sierra nevada" => "#00e000","gold country" => "#e0e000","bay area california" => "#e06060","california north coast" => "#b0b000","shasta cascades" => "#e03030","mississippi capital river" => "#336699","mississippi delta" => "#663366","mississippi pines" => "#339966","gulf coast mississippi" => "#660033","mississippi hills" => "#996633","panhandle nebraska" => "#cc9966","north central nebraska" => "#cccc66","eastern nebraska" => "#99cccc","western nevada" => "#cc9999","northern nevada" => "#cc9966","central nevada" => "#9999cc","southern nevada" => "#99cccc","central new mexico" => "#e0fa92","north central new mexico" => "#6699aa","northeast new mexico" => "#b6bc4d","northwest new mexico" => "#d09440","southwest new mexico" => "#b2cc7f","southeast new mexico" => "#ffff99","northwest ohio" => "#666633","northeast ohio" => "#669999","midohio" => "#996666","southwest ohio" => "#666699","southeast ohio" => "#cc9933","western tennessee" => "#996699","central tennessee" => "#339999","eastern tennessee" => "#339966","panhandle texas" => "#80622f","prairies and lakes" => "#335c64","piney woods" => "#406324","gulf coast texas" => "#7895a3","south texas plains" => "#7d6b71","hill country" => "#d1a85e","big bend country" => "#c6ab7a","wasatch front" => "#99cc33","canyon country" => "#cc6600","northeastern utah" => "#669900","dixie" => "#b2cc7f","central utah" => "#999933","western utah" => "#ffff99","northern virginia" => "#9966ff","eastern virginia" => "#33bbee","central virginia" => "#ff6655","southwest virginia" => "#ffcc33","shenandoah valley" => "#339933","southeast wisconsin" => "#66cc99","southwest wisconsin" => "#99ccff","northeast wisconsin" => "#009999","north central wisconsin" => "#66ccff","northwest wisconsin" => "#99cccc");
//@see:http://www.nekomataya.info/teck_info/taiyo_color
$color_anime = array("bl" => "#110f11", "lb9" => "#1d1f29", "bb" => "#1c232b", "bl1" => "#283039", "10" => "#3c4249", "20" => "#4f5760", "30" => "#566169", "40" => "#66717a", "50" => "#717d87", "60" => "#7e8b94", "70" => "#8e9ba2", "80" => "#a5b3b8", "90" => "#b3c0c7", "95" => "#c2cdce", "100" => "#d2dad4", "w" => "#efefe2", "700g" => "#23262a", "600g" => "#2f2f39", "500g" => "#343649", "180g" => "#384156", "400g" => "#42435a", "300g" => "#5b5f73", "200g" => "#74798f", "99g" => "#909aae", "100g" => "#8fa4b9", "90g" => "#a5b5bf", "pb20" => "#2854a9", "cb6" => "#002289", "cb20" => "#0051b5", "cb30" => "#1160c0", "cb40" => "#3877c9", "cb50" => "#5a90d7", "cb60" => "#73a3d6", "cb80" => "#99badc", "cb90" => "#b3ccdc", "cb95" => "#cbdae0", "cb0" => "#d7e1e0", "nr0-1" => "#1b232c", "nr0" => "#222e40", "nr1" => "#303e62", "nr2" => "#41547a", "nr3" => "#4c6189", "nr4" => "#586f96", "nr5" => "#7694b0", "nr6" => "#8ba5c2", "bg6" => "#113f40", "144m" => "#007069", "tbg7" => "#2d9a9a", "bg5" => "#074b4f", "145m" => "#266966", "133m" => "#4e9d91", "x13" => "#005d71", "166m" => "#007589", "aa-7" => "#00adba", "bg16" => "#008f9b", "bg15" => "#00a5a8", "bg14" => "#4ebfc6", "o-01" => "#a1d4cb", "n13" => "#006074", "167m" => "#266372", "165m" => "#25808e", "c15" => "#3c8e98", "x4m" => "#2f5560", "x2m" => "#498291", "bg45" => "#009694", "bg85" => "#5cc2bd", "bg95" => "#a6dbcd", "n12" => "#003246", "n10" => "#004b67", "bs4" => "#00627b", "bs3" => "#008da5", "bs2" => "#2096ac", "bs1" => "#42b8c9", "bs-01" => "#7ec6ce", "b10" => "#004275", "b20" => "#0071a4", "b30" => "#0093c8", "b40" => "#009dcb", "b60" => "#20aed2", "b80" => "#70c7db", "b90" => "#a5d8dc", "b95" => "#badfdd", "n8" => "#0068a5", "n75" => "#007abd", "n7" => "#008dc7", "n6" => "#0097ce", "n4" => "#00a1d1", "n3" => "#42b5d5", "n2" => "#78c5ce", "cb10" => "#24354e", "a02" => "#4a6282", "a01" => "#6285ae", "bu5" => "#507fac", "bu4" => "#72a3c6", "gr6a" => "#99bcc7", "anr2" => "#1b4a76", "bu3" => "#245a81", "b36" => "#0051a7", "b37" => "#0063b2", "blue2" => "#007ec0", "bu2" => "#348fbb", "o" => "#89bfdb", "grb1" => "#a8cbdb", "bg20m" => "#455c60", "bg40m" => "#577977", "bg60m" => "#719a96", "bg70m" => "#82a9a2", "bg80m" => "#94bbaf", "bg90m" => "#b1cec1", "bw" => "#d1e7d8", "aw" => "#dfebdc", "yr10m" => "#4b3c38", "yr20m" => "#5f463d", "yr40m" => "#755549", "yr50m" => "#856757", "yr60m" => "#9e7d66", "yr2" => "#b1987f", "yr1" => "#cbb49c", "yr0" => "#dccbb5", "yr90m" => "#dcb995", "yr95m" => "#ddc3a2", "8a" => "#7c7e7e", "7a" => "#8b8d8c", "6a" => "#9d9f9d", "5a" => "#abaca9", "4a" => "#c4c1b8", "1a" => "#d2d2cb", "gt1" => "#969395", "gm1" => "#aea8a1", "gh3" => "#31292d", "gh2" => "#433d44", "gh1" => "#595058", "gb1" => "#777278", "yr100" => "#332c2a", "yr900" => "#3f3836", "yr28" => "#4e4342", "yr47" => "#5d524f", "yrd" => "#514c4c", "yrc" => "#61544f", "yrb" => "#7a6962", "yra" => "#897867", "yr3a" => "#9a8776", "yr85" => "#92857b", "yrm" => "#393532", "yy10" => "#3a3a39", "y28" => "#464240", "y9" => "#3e392f", "y47" => "#565449", "rb2" => "#7e8167", "rb1" => "#acae80", "yrf" => "#696861", "yre" => "#818377", "td1" => "#9c9b8a", "eb2" => "#595959", "eb1" => "#7b7d78", "et1" => "#969994", "gr6" => "#a7adac", "yr15" => "#774d3c", "yr50" => "#aa6a47", "s45" => "#c07d51", "lo1" => "#df8d5e", "mo1" => "#f8ae82", "ek55" => "#bc896b", "ek33" => "#f1ae87", "sm1" => "#fec89e", "sm3" => "#f8c5a5", "d50" => "#8d5b3f", "d40" => "#c0764e", "d30" => "#d7945d", "d20" => "#e9a472", "d1" => "#edb285", "d10" => "#e7b18a", "d0" => "#e7cfae", "63m" => "#6a4f3f", "bc60" => "#846b5b", "ek44" => "#c0a685", "tt2" => "#99927b", "tt1" => "#bcae93", "tm1" => "#d3c59f", "r20m" => "#674241", "r30m" => "#825453", "r40m" => "#8f554e", "r55m" => "#b76356", "r65m" => "#c77d70", "r70m" => "#d98778", "r75m" => "#df907e", "r80m" => "#f3ab94", "s1" => "#f2b8a4", "r90m" => "#f7bfae", "b35" => "#fa9b87", "bc9" => "#fcaf96", "b34" => "#f8b9a4", "11" => "#f3d4c5", "b32" => "#f4b497", "bc2" => "#f6ba9d", "bc20" => "#fabfa5", "bc0" => "#f9c6ad", "x20" => "#f1cfb5", "12" => "#f5dac9", "s20" => "#feb190", "s0" => "#f8c4a5", "x19" => "#f4caac", "13" => "#f6d2bd", "hb" => "#f1d4bb", "14" => "#f6ddc7", "s40" => "#db805a", "s3" => "#fba485", "c6" => "#7d4a36", "c5" => "#8c5341", "c4" => "#ab714c", "c3" => "#b88051", "c35" => "#c18b64", "c43" => "#ce9863", "yr75m" => "#c0844e", "c37" => "#cd9d6e", "c32" => "#e2bc8e", "ek44" => "#c5aa84", "c1a" => "#f0d2a3", "yr15m" => "#44342f", "yr25m" => "#563e32", "65m" => "#805842", "67m" => "#a16e4b", "69m" => "#cda36d", "bc1" => "#f5d7a7", "c0" => "#eee0c0", "bc01" => "#e4d2b3", "sf" => "#ece9cd", "sfm" => "#efecd3", "52" => "#50332d", "42" => "#5d342a", "45" => "#953c26", "46" => "#b24926", "or4" => "#d05c2b", "or3" => "#fc742a", "or2" => "#fe8a4f", "or1" => "#ffb56e", "yr20" => "#674032", "y8" => "#8d5134", "yr30" => "#ac4c35", "yr60" => "#c9633c", "yr65" => "#ee5e00", "d2" => "#fd803a", "yr75" => "#f28c4d", "yr80" => "#ffa157", "yr95" => "#ffba73", "s5" => "#feb973", "yr90" => "#deb87e", "c54" => "#e09d71", "bf40" => "#9f613e", "c70" => "#77452b", "c50" => "#915631", "yr70m" => "#b4845e", "yr80m" => "#d4a775", "yr90m" => "#dcb996", "yr95m" => "#ddc3a2", "y95" => "#eedf00", "y7" => "#886232", "y6" => "#b07727", "e2" => "#ce943d", "e34" => "#ffb347", "s6(old)" => "#ffc875", "x16" => "#ffc720", "s6" => "#ffcc59", "x18" => "#fdda7e", "d8" => "#4a3d30", "d6" => "#6f5135", "d4" => "#a26e40", "d3" => "#b9702b", "d04" => "#a6690d", "y50" => "#ee9611", "y85" => "#ffaf13", "f2" => "#fece20", "f32" => "#f8e473", "f31" => "#f0eab2", "f30" => "#f3e5be", "b7" => "#5e2923", "hb4" => "#8f2b1f", "bo6" => "#a94d2b", "bo5" => "#a83c26", "bo4" => "#be5e2a", "bo3" => "#ce6f30", "bo2" => "#fd871c", "bo1" => "#ffa100", "fd80" => "#8e6742", "aa5" => "#a57349", "c5a" => "#8a5a34", "pf1" => "#ab723b", "tpb1" => "#da9f53", "d1a" => "#dfa75e", "e30" => "#d3a047", "89" => "#d4a149", "aa4" => "#d3a454", "e70" => "#2e3128", "e60" => "#464027", "e5" => "#5d4f31", "e6" => "#836b40", "e4" => "#9c783b", "e3" => "#9e7f2e", "88" => "#c9b14d", "87" => "#d7bf65", "y136" => "#746638", "90m" => "#90753e", "89m" => "#c0a058", "ae1" => "#ad996f", "y91" => "#c3a569", "y92" => "#d1b26b", "e1" => "#e0c27d", "y10" => "#433931", "y20" => "#594638", "y40" => "#7a5d3f", "y60" => "#b88d2c", "y80" => "#cea645", "y70" => "#e0b800", "y90" => "#fdd010", "aa10" => "#916247", "cr25" => "#9c6a51", "bc57" => "#a67c64", "bc55" => "#ad866e", "bc47" => "#bb947c", "bc37" => "#ad8d75", "bc46" => "#be9d84", "bc45" => "#c7ad97", "bc10" => "#dbb49c", "cr5" => "#5a342c", "cr4" => "#784a3c", "cr3" => "#88503d", "cr2" => "#be7459", "cr1" => "#ce9276", "cr0" => "#d6ae94", "so19" => "#a67d6f", "so18" => "#ba8d7b", "pe2" => "#965d65", "pe1" => "#b9777f", "pn2" => "#956a66", "pn1" => "#be8680", "pfl2" => "#ab746d", "pfl1" => "#c6968b", "cfl2" => "#a36f62", "cfl1" => "#d19b87", "bc11" => "#d89e8b", "b81" => "#3b2928", "b9" => "#6f362e", "b7" => "#59271e", "b6" => "#7a322b", "821" => "#c7795b", "b5" => "#d72f2a", "b4" => "#e04236", "b3" => "#e75a4c", "b1" => "#ef7d71", "ps1" => "#c8433b", "td2" => "#904d3a", "afc" => "#a45750", "om4" => "#e66855", "r75" => "#f19175", "af1" => "#f28978", "cr30" => "#a05638", "yr40" => "#ad5c3d", "41-0m" => "#201d1f", "41m" => "#332226", "43m" => "#5a3c36", "44m" => "#693d32", "45m" => "#895340", "46m" => "#9f593e", "56n" => "#b37158", "66n" => "#c78f72", "sb80" => "#4e373b", "sb60" => "#6a4c51", "sb40" => "#866363", "sb20" => "#9b7a79", "sb0" => "#b59b97", "sb01" => "#cbb6ad", "rp20m" => "#532d2e", "rp30m" => "#6c3940", "rp40m" => "#974b57", "rp60m" => "#d96b7c", "rp2" => "#e09497", "rp1" => "#edb7b4", "rp0" => "#f0d0c5", "r30" => "#7f2734", "ar20" => "#901e34", "ar10" => "#b64957", "r10" => "#4a2a2d", "x37" => "#563132", "r10a" => "#6f3738", "x14" => "#552527", "aa2" => "#943a34", "30m" => "#7f3934", "26m" => "#a55146", "af1" => "#d26f5d", "r11" => "#251811", "x38" => "#3f2f31", "xr35" => "#534040", "r91" => "#73504e", "r89" => "#886868", "r77" => "#b89c98", "32r" => "#6c534f", "r82" => "#8a7070", "r78" => "#b29e95", "r76" => "#c9bbb2", "r83" => "#7f5750", "r79" => "#91675a", "ap40" => "#4e6db3", "ap60" => "#9b85c2", "ap80" => "#ccbfda", "p80" => "#cabad9", "p90" => "#d6cddd", "p40" => "#2657ab", "p50" => "#4a71be", "p60" => "#6887c4", "p70" => "#929dcf", "np2" => "#acabc6", "apb80" => "#cccbde", "nr12" => "#283459", "nr11" => "#333d6c", "p8(old)" => "#46539b", "pb40" => "#616eb2", "pb60" => "#7e8ac6", "pb70" => "#98a6d4", "pb80" => "#b4bad6", "pb90" => "#c3cbdd", "p8" => "#4b57a1", "p6" => "#6c79bf", "p4" => "#7789c8", "p2" => "#91a8d2", "p1" => "#aeb9d6", "p0" => "#c8cad8", "p01" => "#cbd0d2", "nrq9" => "#252944", "q9" => "#322e54", "q7" => "#3e3667", "p10" => "#625a85", "q5" => "#716691", "q3" => "#928aa8", "q50" => "#514269", "q40" => "#614c71", "q30" => "#7d6993", "q25" => "#8e7da3", "q20" => "#a893af", "q10" => "#bfb1b9", "p20" => "#601377", "v6" => "#352659", "v5" => "#4d3069", "v4" => "#74498a", "v3" => "#745ea4", "v2" => "#9383ba", "v1" => "#c7bcd6", "rp40" => "#9a6695", "rp60" => "#ca92b8", "rp70" => "#d1a2c0", "rp80" => "#e5d3e2", "rp90" => "#e8dae4", "rp95" => "#ebe1dd", "rp99" => "#ece6de", "rp100" => "#eceae0", "x33" => "#432131", "m128" => "#653947", "m127" => "#774956", "m3" => "#512d43", "m2" => "#6e3957", "m126" => "#9c5177", "a4" => "#a7588a", "a3" => "#b675a1", "a20" => "#d294b1", "a1" => "#e1ccdb", "r8" => "#562a58", "r6" => "#73396d", "xr5" => "#91508d", "r4" => "#b577ae", "r2" => "#d1acc8", "aa4" => "#9d83a5", "aa2" => "#be9db5", "aa1" => "#cab5c8", "r11" => "#1a0f11", "21" => "#3c1e21", "rp5" => "#5f2532", "r51" => "#b3214f", "rr5" => "#a74556", "rr4" => "#b86077", "rr3" => "#d99091", "rr2" => "#dd8d96", "rr1" => "#e8abad", "rr0" => "#f0c5bf", "871" => "#ab6e89", "ap2" => "#c390b3", "ap3" => "#c791b6", "ap4" => "#cc9fc1", "rp10" => "#381f2d", "rp20" => "#681e4d", "aa5" => "#a25f8b", "r12" => "#3f1912", "r26" => "#4e1d1c", "r20" => "#70071e", "r25" => "#930016", "r40" => "#d52839", "r70" => "#e75456", "r75" => "#f4876a", "x28" => "#ad002b", "x27" => "#d12b40", "sf4" => "#d93343", "sy4" => "#e75862", "sy3" => "#ee887e", "r5" => "#9c0025", "r1" => "#b8023f", "r3" => "#c1113f", "r7" => "#d7465b", "r50" => "#e38386", "pb6" => "#92002e", "pb4" => "#b74155", "r60" => "#cb6c70", "r80" => "#da8092", "r90" => "#e7a1a7", "ag2" => "#006841", "ag3" => "#008856", "ag4" => "#009e5b", "g11" => "#00372d", "g20" => "#005340", "g40" => "#007647", "g60" => "#00a071", "gt2" => "#27b680", "g80" => "#65c789", "g90" => "#8bd59f", "g90a" => "#9edbb1", "go5" => "#223d29", "go4" => "#3f5337", "go3" => "#596539", "go2" => "#788554", "go1" => "#a6ae7b", "x21" => "#b6c489", "g10b" => "#252c2a", "g10" => "#364132", "gy12" => "#49593f", "gy13" => "#566951", "gy11" => "#657158", "g9" => "#728567", "g8" => "#99b18e", "g7" => "#d6eab3", "gy20" => "#3f5336", "gy40" => "#71764c", "gy3" => "#798941", "g3" => "#7a9b31", "aa6" => "#bcbb55", "i7" => "#1d5429", "x29" => "#407a43", "x30" => "#58955a", "fg90" => "#346c53", "g6" => "#538561", "g4a" => "#63a874", "i6" => "#006a06", "i5" => "#009115", "gy60" => "#4fb42f", "gy80" => "#83c934", "gy90" => "#bbe07b", "x7" => "#242b37", "x6" => "#2f3c49", "x5" => "#334a5a", "x4" => "#4d5e6a", "x3" => "#53727c", "x2" => "#5b8288", "x1" => "#719ca3", "b70m" => "#74979d", "pan-2" => "#6d979f", "pan-1" => "#96bdc1", "o-50" => "#404e5b", "o-40" => "#586c75", "o-30" => "#5f8691", "o-20" => "#65a5af", "o-10" => "#8bc0c3", "ms20" => "#002631", "bg20" => "#00676d", "bg40" => "#008672", "bg60" => "#00a282", "bg80" => "#50c2aa", "bg90" => "#aee0c7");

/**
 * Raindrops settings.
 *
 *
 *
 *
 */
    $raindrops_base_setting = array(

        array('option_id' =>'null',
        'blog_id' => 0 ,
        'option_name' => "raindrops_base_color",
        'option_value' => "#444444",
        'autoload'=>'yes',
        'title'=> __('Base Color for Automatic Corlor Arrangement','Raindrops'),
        'excerpt1'=>'',
        'excerpt2'=>__('Please specify your favorite color. and an automatic arrangement of color is designed.','Raindrops'),
         'validate'=>'raindrops_base_color_validate',
         'list' => 1),

        array('option_id' =>'null',
        'blog_id' => 0 ,
        'option_name' => "raindrops_style_type",
        'option_value' => "dark",
        'autoload'=>'yes',
        'title'=>__('Color Type','Raindrops'),
        'excerpt1'=>'',
        'excerpt2'=>__('The mood like dark atmosphere and the bright note,
         etc. is decided.','Raindrops'),
         'validate'=>'raindrops_style_type_validate',
         'list' => 2,
        ),

        array('option_id' =>'null',
        'blog_id' => 0 ,
        'option_name' => "raindrops_header_image",
        'option_value' => "",
        'autoload'=>'yes',
        'title'=>__('Header bar background image','Raindrops'),
        'excerpt1'=>'',
        'excerpt2'=>__('The name of the picture file used for the header is set. As for the image,
         the image that exists in themes/raindrops/image/is used. for display test image "header.png"','Raindrops'),
         'validate'=>'raindrops_header_image_validate',
         'list' => 3,
        ),

        array('option_id' =>'null',
        'blog_id' => 0 ,
        'option_name' => "raindrops_footer_image",
        'option_value' => "",
        'autoload'=>'yes',
        'title'=>__('Footer bar background image','Raindrops'),
        'excerpt1'=>'',
        'excerpt2'=>__('The name of the picture file used for the footer is set.As for the image,
         the image that exists in themes/raindrops/image/is used. for display test image "footer.png".','Raindrops'),
         'validate'=>'raindrops_footer_image_validate','list' => 4),



        array('option_id' =>'null',
        'blog_id' => 0 ,
        'option_name' => "raindrops_heading_image",
        'option_value' => "h2.png",
        'autoload'=>'yes',
        'title'=>__('Widget Title(h2) Background Image','Raindrops'),
        'excerpt1'=>'',
        'excerpt2'=>__('The name of the picture file used for the h2 headding is set where sidebar widget titles. As for the image,
         the image that exists in themes/raindrops/image/is used.The header image can be chosen from among three kinds [h2.png,
        h2b.png,h2c.png] now. Of course, customizing is also possible. ','Raindrops'),
         'validate'=>'raindrops_heading_image_validate','list' => 5),

        array('option_id' =>'null',
        'blog_id' => 0 ,
        'option_name' => "raindrops_heading_image_position",
        'option_value' => "0",
        'autoload'=>'yes',
        'title'=>__('Widget Title(h2) Background Image Position','Raindrops'),
        'excerpt1'=>'',
        'excerpt2'=>__('The name of the picture file used for the h2 headding is set. Please set the integral value from 0 to 7. ','Raindrops'),
        'validate'=>'raindrops_heading_image_position_validate','list' => 6),

        array('option_id' =>'null',
        'blog_id' => 0 ,
        'option_name' => "raindrops_page_width",
        'option_value' => "doc2",
        'autoload'=>'yes',
        'title'=>__('Page Width','Raindrops'),
        'excerpt1'=>'',
        'excerpt2'=>__('Please choose width on the page.
    Please choose from four kinds of inside of 750px centerd 950px centerd 100% fluid 974px.','Raindrops'),
         'validate'=>'raindrops_page_width_validate','list' => 7),

        array('option_id' =>'null',
        'blog_id' => 0 ,
        'option_name' => "raindrops_col_width",
        'option_value' => "t2",
        'autoload'=>'yes',
        'title'=>__('Column Width and Position','Raindrops'),
        'excerpt1'=>'',
        'excerpt2'=>__('Please specify the position and the width of Default Sidebar. Six kinds of sidebars of left 160px left 180px left 300px right 180px right 240px right 300px can be specified.','Raindrops'),
        'validate'=>'raindrops_col_width_validate','list' => 8),

        array('option_id' =>'null',
        'blog_id' => 0 ,
        'option_name' => "raindrops_default_fonts_color",
        'option_value' => "",
        'autoload'=>'yes',
        'title'=>__('Fonts Color ','Raindrops'),
        'excerpt1'=>'',
        'excerpt2'=>__('Please specify the color of the entry content. Please use it when you want to decide the text color though the automatic arrangement of color function does well in most cases.When none is selected from the selection box,
         it becomes an automatic arrangement of color. ','Raindrops'),
         'validate'=>'raindrops_default_fonts_color_validate','list' => 9),

        array('option_id' =>'null',
        'blog_id' => 0 ,
        'option_name' => "raindrops_footer_color",
        'option_value' => "",
        'autoload'=>'yes',
        'title'=>__('Fonts Color Footer ','Raindrops'),
        'excerpt1'=>'',
        'excerpt2'=>__('Please specify the text color of the footer. Please use it when you want to decide the text color though the automatic arrangement of color function does well in most cases.When none is selected from the selection box,
         it becomes an automatic arrangement of color. ','Raindrops'),
         'validate'=>'raindrops_footer_color_validate','list' => 10),

        array('option_id' =>'null',
        'blog_id' => 0 ,
        'option_name' => "raindrops_show_right_sidebar",
        'option_value' => "show",
        'autoload'=>'yes',
        'title'=>__('Extra Sidebar','Raindrops'),
        'excerpt1'=>'',
        'excerpt2'=>__('Please specify show when you want to use three row layout. Please set Ratio to text when extra sidebar is displayed when you specify show','Raindrops'),
        'validate'=>'raindrops_show_right_sidebar_validate','list' => 11),

        array('option_id' =>'null',
        'blog_id' => 0 ,
        'option_name' => "raindrops_right_sidebar_width_percent",
        'option_value' => "25",
        'autoload'=>'yes',
        'title'=>__('Extra Sidebar Width','Raindrops'),
        'excerpt1'=>'',
        'excerpt2'=>__('When display extra sidebar is set to show,
         it is necessary to specify it. It can decide to divide the width of which place of extra sidebar and to give it. Please select it from among 25% 33% 50% 66% 75%. ','Raindrops'),
         'validate'=>'raindrops_right_sidebar_width_percent_validate','list' => 12),
		 
        array('option_id' =>'null',
        'blog_id' => 0 ,
        'option_name' => "raindrops_color_scheme",
        'option_value' => "color_ja",
        'autoload'=>'yes',
        'title'=>__('Color Scheme','Raindrops'),
        'excerpt1'=>'',
        'excerpt2'=>__('Colors list','Raindrops'),
         'validate'=>'raindrops_color_scheme_validate','list' => 12),
	 
    );
    if(raindrops_warehouse('raindrops_show_right_sidebar') == 'hide'){
        $rsidebar_show = false;
    }else{
        $rsidebar_show = true;
    }

    if(raindrops_warehouse('raindrops_right_sidebar_width_percent') == '25'){
        $yui_inner_layout = 'yui-ge';
    }elseif(raindrops_warehouse('raindrops_right_sidebar_width_percent') == '75'){
        $yui_inner_layout = 'yui-gf';
    }elseif(raindrops_warehouse('raindrops_right_sidebar_width_percent') == '33'){
        $yui_inner_layout = 'yui-gc';
    }elseif(raindrops_warehouse('raindrops_right_sidebar_width_percent') == '66'){
        $yui_inner_layout = 'yui-gd';
    }elseif(raindrops_warehouse('raindrops_right_sidebar_width_percent') == '50'){
        $yui_inner_layout = 'yui-g';
    }else{
        $yui_inner_layout = 'yui-ge';
    }

    if(RAINDROPS_USE_AUTO_COLOR == true and is_admin() == true ){
        get_template_part('lib/csscolor/csscolor');
        get_template_part('lib/csscolor.css');
        add_filter('contextual_help','raindrops_edit_help');
    }



    if(isset($page_width) and !empty($page_width)){
        add_action("wp_head","raindrops_custom_width");
        function raindrops_custom_width($content,$key){
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
/**
 * fluid or fixed page width
 *
 *
 *
 *
 */

        if( isset($fluid_or_fixed) and
            !empty($fluid_or_fixed) and
            (raindrops_warehouse("raindrops_page_width") == 'doc' or raindrops_warehouse("raindrops_page_width") == 'doc2')){
            add_action("wp_head","raindrops_is_fixed");
        }elseif(isset($fluid_minimam_width) and !empty($fluid_minimam_width)){
            add_action("wp_head","raindrops_is_fluid");


        }

        function raindrops_is_fluid(){
            global  $is_IE, $fluid_minimam_width;
            $width          = intval($fluid_minimam_width);
            $width          = $width / 13;
            $sidebar_width  = 'yui-'.raindrops_warehouse('raindrops_col_width');
            $adjust         = 20;

            if($sidebar_width == 'yui-t1'){
                $raindrops_default_col_width = 160 + $adjust;
            }elseif($sidebar_width == 'yui-t2'){
                $raindrops_default_col_width = 180 + $adjust;
            }elseif($sidebar_width == 'yui-t3'){
                $raindrops_default_col_width = 300 + $adjust;
            }elseif($sidebar_width == 'yui-t4'){
                $raindrops_default_col_width = 180 + $adjust;
            }elseif($sidebar_width == 'yui-t5'){
                $raindrops_default_col_width = 240 + $adjust;
            }elseif($sidebar_width == 'yui-t6'){
                $raindrops_default_col_width = 300 + $adjust;
            }else{
                $raindrops_default_col_width = 0;
            }

            $horizontal_nav_width = $raindrops_default_col_width + intval($fluid_minimam_width);
            $horizontal_nav_width = $horizontal_nav_width / 13;

            if($is_IE){
                $width                  = round($width * 0.9759,1);
                $horizontal_nav_width   = round($horizontal_nav_width * 0.9759,1) + 1;
            }else{
                $width                  = round($width,1);
                $horizontal_nav_width   = round($horizontal_nav_width * 0.9759,1);
            }


            $fluid_min_width = '<style type="text/css">'.
                            "\n#container{min-width:".
                            $width.
                            'em;}'.
                            "\n#access{min-width:".
                            $horizontal_nav_width.
                            'em;}</style>';
            echo $fluid_min_width;
        }

        function raindrops_is_fixed(){
            global $is_IE;
            $add_ie = '';
            $pw = raindrops_warehouse("raindrops_page_width");

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

            $raindrops_main_width = raindrops_main_width();
            $raindrops_main_width = $raindrops_main_width / 13;

            if($is_IE){
                $width                  = round($width * 0.9759,1);
                $add_ie                 = '';
                $raindrops_main_width   = round($raindrops_main_width * 0.9759,1);
            }else{
                $width                  = round($width,1);
            }

            $custom_fixed_width = '<style type="text/css">'."
                \n#".$pw.'{margin:auto;text-align:left;'."\n".
                            'min-width:'.$width.'em;'.
                            $add_ie.
                            $px.
                            '}'.
                            "\n#container{min-width:".
                            $raindrops_main_width.
                            'em;}</style>';
            echo $custom_fixed_width;
        }




    if(!isset($content_width) or empty($content_width)){
        $content_width = raindrops_content_width();
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

    add_action('load-themes.php', 'raindrops_install_navigation');
    add_editor_style();
    register_nav_menus( array(
        'primary' => __( 'Primary Navigation', 'Raindrops' ),
    ) );
    add_custom_background();
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 48, 48, true );

    add_image_size( 'single-post-thumbnail', RAINDROPS_SINGLE_POST_THUMBNAIL_WIDTH, RAINDROPS_SINGLE_POST_THUMBNAIL_HEIGHT, true);
    add_theme_support( 'automatic-feed-links' );
    load_textdomain( 'Raindrops', get_template_directory().'/languages/'.get_locale().'.mo' );
    add_filter("wp_head","raindrops_embed_meta",'99');
    add_filter( 'comment_form_default_fields','raindrops_comment_form');
    add_filter( 'the_meta_key', 'raindrops_filter_explode_meta_keys', 10, 2 );
    add_filter('body_class','raindrops_add_body_class');
    add_filter('contextual_help','raindrops_help');
    add_filter('comment_form_field_comment','custom_remove_aria_required1');
    add_filter('comment_form_default_fields', 'custom_remove_aria_required2');
    add_filter( 'the_meta_key', 'raindrops_filter_explode_meta_keys', 10, 2 );
    if ( !is_admin()) {
       add_action('wp_print_styles', 'add_raindrops_stylesheet');
    }
    $is_submenu = new raindrops_menu_create;
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
        $input = str_replace("#","",$input);
        if(ctype_xdigit($input)){
            return '#'.$input;
        }else{
            $raindrops_options = get_option("raindrops_theme_settings");
            return $raindrops_options["raindrops_use_automatic_color"];
        }
        return $input;
    }
    function raindrops_right_sidebar_width_percent_validate($input){
        $obj = new raindrops_menu_create();
        $vals = $obj->col_settings_raindrops_right_sidebar_width_percent;
        foreach($vals as $val){
            if($input == $val){
            return $input;
            }
        }
        $raindrops_options = get_option("raindrops_theme_settings");
        return $raindrops_options["raindrops_right_sidebar_width_percent"];
    }
    function raindrops_show_right_sidebar_validate($input){
        $obj = new raindrops_menu_create();
        $vals = $obj->col_settings_raindrops_show_right_sidebar;
        foreach($vals as $val){
            if($input == $val){
            return $input;
            }
        }
        $raindrops_options = get_option("raindrops_theme_settings");
        return $raindrops_options["col_settings_raindrops_show_right_sidebar"];
    }
    function raindrops_footer_color_validate($input){
    if($input == ''){return $input;}
        if(preg_match("|#[0-9a-f]{6}|i",$input)){
            return $input;
        }
        $raindrops_options = get_option("raindrops_theme_settings");
        return $raindrops_options["raindrops_default_fonts_color"];
    }
    function raindrops_default_fonts_color_validate($input){
        if($input == ''){return $input;}
        if(preg_match("|#[0-9a-f]{6}|i",$input)){
            return $input;
        }
        $raindrops_options = get_option("raindrops_theme_settings");
        return $raindrops_options["raindrops_default_fonts_color"];
    }
    function raindrops_col_width_validate($input){
        $obj = new raindrops_menu_create();
        $vals = $obj->col_settings_raindrops_col_width;
        foreach($vals as $val){
            if($input == $val){
            return $input;
            }
        }
        $raindrops_options = get_option("raindrops_theme_settings");
        return $raindrops_options["raindrops_col_width"];
    }
    function raindrops_page_width_validate($input){
        $obj = new raindrops_menu_create();
        $vals = $obj->col_settings_raindrops_page_width;
        foreach($vals as $val){
            if($input == $val){
            return $input;
            }
        }
        $raindrops_options = get_option("raindrops_theme_settings");
        return $raindrops_options["raindrops_page_width"];
    }
    function raindrops_heading_image_validate($input){
        if(preg_match('/[^(a-z|0-9|_|-|\.)]+/si',$input)){
        $raindrops_options = get_option("raindrops_theme_settings");
        return $raindrops_options["raindrops_heading_image"];
        }
        return $input;
    }
    function raindrops_heading_image_position_validate($input){
        if(is_numeric($input) and $input < 8 and -1 < $input ){
        return $input;
        }
        $raindrops_options = get_option("raindrops_theme_settings");
        return $raindrops_options["raindrops_heading_image_position"];
    }
    function raindrops_footer_image_validate($input){
        global $raindrops_options;
       if(preg_match('/[^(a-z|0-9|_|-|\.)]+/si',$input)){
        $raindrops_options = get_option("raindrops_theme_settings");
        return $raindrops_options["raindrops_header_image"];
        }
            return $input;
    }
    function raindrops_header_image_validate($input){
        if(preg_match('/[^(a-z|0-9|_|-|\.)]+/si',$input)){
            $raindrops_options = get_option("raindrops_theme_settings");
            return $raindrops_options["raindrops_header_image"];
        }
         return $input;
    }
    function raindrops_style_type_validate($input){
   		$array = raindrops_register_styles();
		if(array_search($input,$array)){
		return esc_html($input);
		}else{
		return "w3standard";
		}
    }
    function raindrops_base_color_validate($input){
        if($input == ''){return $input;}
        if(preg_match("|#[0-9a-f]{6}|i",$input)){
            return $input;
        }
        $raindrops_options = get_option("raindrops_theme_settings");
        return $raindrops_options["raindrops_base_color"];
    }

    function raindrops_color_scheme_validate($input){
        if($input == ''){return $input;}
        
            return esc_html($input);
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
            $lang = get_locale();

            $raindrops_options = get_option("raindrops_theme_settings");

            $color_type = "rd-type-".$raindrops_options["raindrops_style_type"];

            $classes= array($lang,$color_type);
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
          <div class="raindrops-comment-avatar"> <?php echo get_avatar( $comment, 32 ); ?> </div>
          <div class="raindrops-comment-author-meta"> <?php printf( __( '%s <span class="says">says:</span>', 'Raindrops' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?> </div>
          <div class="comment-meta commentmetadata clearfix"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
          <?php printf( __( '%1$s at %2$s', 'Raindrops' ), get_comment_date(),  get_comment_time() ); ?></a>
          <?php edit_comment_link( __( '(Edit)', 'Raindrops' ), ' ' ); ?>
        </div>
        </div>
        <!-- .comment-author .vcard -->
        <?php if ( $comment->comment_approved == '0' ) : ?>
        <div class="clearfix awaiting"> <em>
          <?php _e( 'Your comment is awaiting moderation.', 'Raindrops' ); ?>
          </em> <br />
        </div>
        <?php endif; ?>

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
            $raindrops_date_format = get_option('date_format');
            $author = raindrops_blank_fallback(get_the_author(),'Somebody');
            printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'Raindrops' ),
                'meta-prep meta-prep-author',
                sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
                    get_permalink(),
                    esc_attr( get_the_time($raindrops_date_format) ),
                    get_the_date()
                ),
                sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="vcard:url">%3$s</a></span>',
                    get_author_posts_url( get_the_author_meta( 'ID' ) ),
                    sprintf( esc_attr__( 'View all posts by %s', 'Raindrops' ), $author ),
                    $author
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

    if (!function_exists('raindrops_filter_explode_meta_keys')) {
        function raindrops_filter_explode_meta_keys( $content, $key ) {
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
    function raindrops_warehouse($name){
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

/**
 * Return $raindrops_base_setting value.
 *
 *
 *
 *
 */
    function raindrops_admin_meta($name,$meta_name){
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
        if(RAINDROPS_TABLE_TITLE == $title){
    $result = "<h2 class=\"h2\">".__('Raindrops Another Settings').'</h2>';
    $result .= "<dl><dt><div class=\"icon32\" id=\"icon-options-general\"><br /></div><strong>".__('When you do not want to use the automatic color setting','Raindrops').'</strong></dt>';
    $result .= "<dd>".__('raindrops/functions.php RAINDROPS_USE_AUTO_COLOR value change false','Raindrops').'<br class="clear" /></dd>';
    $result .= "<dt><div class=\"icon32\" id=\"icon-themes\"><br /></div><strong>".__('When you want to change horizontal menu','Raindrops').'</strong></dt>';
    $result .= "<dd>".__('Be careful! CSS Specificity: e.g .aciform strong{color:red;} is OK .aciform strong{background:black;} is not styled, background like this "div#access .menu li.aciform strong{background:black;}" is OK.','Raindrops').'<br class="clear" /></dd>';
    $result .= "<dt><div class=\"icon32\" id=\"icon-themes\"><br /></div><strong>".__('When you want to all reset the settings','Raindrops').'</strong></dt>';
    $result .= "<dd>".__('Please install it switching to other themes once to reset all items, and again again. When switching to other themes, Raindrops restores all customizing information. ','Raindrops').'<br class="clear" /></dd></dl>';
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

    if (!function_exists('raindrops_edit_help') and RAINDROPS_USE_AUTO_COLOR == true) {
        function raindrops_edit_help($text){
        global $post_type_object;
        global $title;
        if(isset($post_type_object) and ($title == $post_type_object->labels->add_new_item or $title == $post_type_object->labels->edit_item)){
            $result = "<h2 class=\"h2\">".__('Tips',"Raindrops").'</h2>';
            $result .= '<p>'.__('If Raindrops Options panel is opened, and the reference color is set, this arrangement of color is changed at once.',"Raindrops")."</p>";
            $result .= "<dl><dt><h3>".__('Dinamic Color Class','Raindrops').'</strong></h3>';
            $result .= '<dd><table><tr>
            <td style="'.raindrops_colors(5,'set').'padding:0.5em;">class color5</td>
            <td style="'.raindrops_colors(4,'set').'padding:0.5em;">class color4</td>
            <td style="'.raindrops_colors(3,'set').'padding:0.5em;">class color3</td>
            <td style="'.raindrops_colors(2,'set').'padding:0.5em;">class color2</td>
            <td style="'.raindrops_colors(1,'set').'padding:0.5em;">class color1</td></tr><tr>
            <td style="'.raindrops_colors('-1','set').'padding:0.5em;">class color-1</td>
            <td style="'.raindrops_colors('-2','set').'padding:0.5em;">class color-2</td>
            <td style="'.raindrops_colors('-3','set').'padding:0.5em;">class color-3</td>
            <td style="'.raindrops_colors('-4','set').'padding:0.5em;">class color-4</td>
            <td style="'.raindrops_colors('-5','set').'padding:0.5em;">class color-5</td></tr>
            <tr><td colspan="5">
            '.__('code example:please HTML editor mode','Raindrops').'
            <div  style="'.raindrops_colors(2,'set').'padding:1em;">&lt;div class="color3"&gt;
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


            return apply_filters("raindrops_help",$result);
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
    function raindrops_options_init(){
        global $raindrops_base_setting;
        if(isset($raindrops_base_setting)){
            foreach($raindrops_base_setting as $setting){
                register_setting( 'raindrop_options', $setting['option_name'], $setting['validate'] );
            }
        }
    }





/**
 * Raindrops option panel
 *
 *
 *
 *
 */

    class raindrops_menu_create {
        var $accesskey  = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
        var $table_template = '<table class="%s widefat post fixed" style="margin:2em;width:540px;">';
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
            "974px"=>"doc4"
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
            "w3standard"=>"w3standard",
            "minimal"=>"minimal",
			"helloworld"=>"helloworld",
            );
			
			
		var $col_settings_raindrops_color_scheme = array(
            "Japan"=>"color_ja",
            "USA"=>"color_en",
            "WWW"=>"color_en_140",
			"Animation Color" =>"color_anime"
            );


/**
 *
 *
 *
 *
 *
 */

        function SubMenu_GUI() {
            global $wpdb,$count, $raindrops_base_setting;
			$this->col_settings_raindrops_style_type = raindrops_register_styles("w3standard");

            $ok     = false;
            $result = "";
            $count = $wpdb->query("SELECT * FROM `".RAINDROPS_PLUGIN_TABLE."`;");
            /**
             * POSTGET
             *
             *
             */
            if(isset($_POST) and !empty($_POST)){

                $option_id      = intval($_POST['option_id']);
                $raindrops_updates = "";

                foreach($_POST["raindrops_option_values"] as $key=>$val){


                    $valid_function = $key.'_validate';

                   if($val == $valid_function($val)){

                      $new_settings         = get_option('raindrops_theme_settings');
                      $new_settings[$key]   = $val;

                      if(update_option('raindrops_theme_settings',$new_settings)){
                        $ok = true;
                        do_action( 'raindrops_change_style' );

                        $raindrops_updates .= ','.$key;

                      }

                    }else{
                        $raindrops_updates = $key."value error";
                    }

                }
            }

            $result .= '<div class="wrap"><div id="title-raindrops-header" >';
            $result .= screen_icon();
            $result .= "<h2>" . get_current_theme() . __(' Theme Settings') . "</h2>";
            $result .= "<p>Saved Database table name:<strong>".RAINDROPS_PLUGIN_TABLE."</strong></p></div>";
            if(isset($_POST) and !empty($_POST)){

                    $scheme = raindrops_warehouse("raindrops_color_scheme");
                    global $$scheme;
                if($ok == true){
                $result .= '<div id="message" class="updated fade" title="'.esc_attr($raindrops_updates).'"><p>'.sprintf(__('updated %1$s  successfully.'), $raindrops_updates);
                    if ( is_multisite() ) {
                        $result .= sprintf('<a href="%s">%s</a></p></div>',
                                            'themes.php?page=raindrops_settings',
                                            __(" Please click.The setting will be fixed.","Raindrops"));
                    }else{
                        $result .= '</p></div>';
                    }
					
                }

            }
			
if(raindrops_warehouse("raindrops_style_type") == 'raindrops'){

	$result 			.= '<div class="postbox" style="width:600px;margin:1em;color:#339999">';
	$text 				= array('-4' => 'R','-3' => 'A','-2' => 'I','-1' => 'N','0' => 'D','1' => 'R','2' => 'O','3' => 'P','4' => 'S');
	for($c = -4;$c < 5;$c++){
	$css 				= raindrops_gradient_css(raindrops_warehouse("raindrops_base_color"),$c,1,'asc');
	$raindrops_rnd1 	= rand(0,4);
	$raindrops_rnd2 	= rand(5,60);
	
	if($c == $raindrops_rnd1){ 
		$css 			.= 'border:5px solid #000;-moz-transform: rotate('.$raindrops_rnd2.'deg);-webkit-transform: rotate('.$raindrops_rnd2.'deg);transform: rotate('.$raindrops_rnd2.'deg);';}
		$result 		.= '<div style="text-align:center;font-size:56px;height:60px;width:60px;float:left;'.$css.'">'.$text[$c].'</div>';
	}
	$result .= '<br style="clear:both;" /></div>';

}
            $result .= '</div>';
            $result .= '<div id="reset2"></div>';
            $result .= '<div>'.$this->form_user_input().'</div>';
		
            echo $result;
        }

/**
 *
 *
 *
 *
 *
 */

        function add_menus() {
            if(function_exists('add_theme_page')) {
			$option_name          = ucwords(get_current_theme()).' Options';

           add_theme_page(RAINDROPS_TABLE_TITLE, $option_name, 'edit_theme_options', 'raindrops_settings', array($this, 'SubMenu_GUI'));
            }
        }


/**
 *
 *
 *
 *
 *
 */

        function form_user_input(){
            global $raindrops_base_setting;
            global $wpdb;
            $option_value   = "-";
            $lines          = "";
            $i              = 0;
            $deliv          = htmlspecialchars($_SERVER['REQUEST_URI']);
            $results        = get_option('raindrops_theme_settings');
            $current_heading_image = raindrops_warehouse("raindrops_heading_image");
            ksort($results);
            unset($results['_raindrops_indv_css']);
            unset($results['install']);
//$lines .= $excerpt;
$lines .= "<form action=\"$deliv\" method=\"post\">".wp_nonce_field('update-options');
            foreach( $results as $key => $val ){

                $excerpt    = "";
                $table      = sprintf($this->table_template,str_replace("_","-",$key));
                $excerpt    = sprintf($this->title_template,str_replace("_"," ",$key),str_replace("_","-",$key),raindrops_admin_meta($key,'title'));
                $excerpt .= sprintf($this->excerpt_template,raindrops_admin_meta($key,'excerpt2'));

                if(!empty($excerpt)){
                    $excerpt = '<div class="postbox" style="width:600px;margin:1em;color:#339999">'.$excerpt;
                }else{
                    $excerpt = "";
                }

                if(preg_match("|#[0-9a-f]{6}|i",$val)){
                    $style="background:".$val.';';
                }else{
                    $style="";
                }

                if(preg_match("!\.(png|gif|jpeg|jpg)$!i",$val)){
                    $style .="background:url(".get_stylesheet_directory_uri()."/images/".$val.');';
                }else{
                    $style .='';
                }


                if(empty($style)){
                    $style .='visibility:hidden';
                    $table_header =  '<thead><tr><th>&nbsp;</th><th>'.__("Value").'</th><th>'.__("Edit").'</th><th style="width:6em;">&nbsp;</th></tr></thead>';
                }else{
                    $table_header =  '<thead><tr><th >'.__("Color").'</th><th>'.__("Value").'</th><th>'.__("Edit").'</th><th style="width:6em;">&nbsp;</th></tr></thead>';
                }

                if (RAINDROPS_USE_AUTO_COLOR == false and (   $key == "raindrops_footer_color" or
                                                        $key == "raindrops_default_fonts_color" or
                                                        $key == "raindrops_base_color" or
                                                        $key == "raindrops_header_image" or
                                                        $key == "raindrops_footer_image" or
                                                        $key == "raindrops_heading_image_position" or
                                                        $key == "raindrops_heading_image" or
                                                        $key == "raindrops_style_type") ){
                    continue;
                }

                $lines .= $excerpt;
                $lines .= $table;
                $lines .= $table_header;
                $lines .= '<tbody>';
                $lines .= '<tr>';
                $lines .= '<td style="display:none;">';
                $lines .= '<input type="text" name="option_id" value="'.$i.'" />'.$i.'</td>';
                if($key == "raindrops_heading_image_position"){
                $lines .= '<td style="background:url('.get_stylesheet_directory_uri().'/images/'.$current_heading_image.');"><img src="'.get_stylesheet_directory_uri().'/images/number.png" />';
                }else{
                $lines .= '<td style="'.$style.'">';
                }
                $lines .= '<input type="hidden" name="option_name" value="'.esc_attr($key).'" read-only="read-only" /></td>';
                $lines .= '<td>'.esc_html($val).'</td>';

                if( $key == "raindrops_base_color" or
                    $key == "raindrops_footer_color" or
                    $key == "raindrops_default_fonts_color" ){
                    $lines .= "<td>".$this->color_selector($key,esc_attr__($val,'Raindrops'),$i)."</td>";
                }elseif($key == "raindrops_col_width"){
                    $lines .= '<td>';
                    $lines .= sprintf($this->line_select_element,$this->accesskey[$i],'raindrops_option_values['.$key.']',6,120);
                    foreach($this->col_settings_raindrops_col_width as $key=>$current){
                        $lines .= '<option value="'.esc_attr__($current,'Raindrops').'" '.selected(strcmp($val,$current),0,false).'>'.esc_html($key).'</option>';
                    }
                    $lines .='</select></td>';
                }elseif($key == "raindrops_page_width"){
                    $lines .= '<td>';
                    $lines .= sprintf($this->line_select_element,esc_attr($this->accesskey[$i]),'raindrops_option_values['.$key.']',4,80);
                    foreach($this->col_settings_raindrops_page_width as $key=>$current){
                        $lines .= '<option value="'.esc_attr__($current,'Raindrops').'" '.selected(strcmp($val,$current),0,false).'>'.esc_html($key).'</option>';
                    }
                    $lines .='</select></td>';
                }elseif($key == "raindrops_show_right_sidebar"){
                    $lines .= '<td>';
                    $lines .= sprintf($this->line_select_element,esc_attr($this->accesskey[$i]),'raindrops_option_values['.$key.']',2,40);
                    foreach($this->col_settings_raindrops_show_right_sidebar as $key=>$current){

                        $lines .= '<option value="'.esc_attr__($current,'Raindrops').'" '.selected(strcmp($val,$current),0,false).'>'.esc_html($key).'</option>';
                    }
                    $lines .='</select></td>';
                }elseif($key == "raindrops_right_sidebar_width_percent"){
                    $lines .= '<td>';
                    $lines .= sprintf($this->line_select_element,esc_attr($this->accesskey[$i]),'raindrops_option_values['.$key.']',5,100);
                    foreach($this->col_settings_raindrops_right_sidebar_width_percent as $key=>$current){

                        $lines .= '<option value="'.esc_attr__($current,'Raindrops').'" '.selected(strcmp($val,$current),0,false).'>'.esc_html($key).'</option>';
                    }
                    $lines .='</select></td>';

                }elseif($key == "raindrops_style_type"){
                    $lines .= '<td>';
                    $lines .= sprintf($this->line_select_element,$this->accesskey[$i],'raindrops_option_values['.$key.']',3,60);
                    foreach($this->col_settings_raindrops_style_type as $key=>$current){

                        $lines .= '<option value="'.esc_attr__($current,'Raindrops').'" '.selected(strcmp($val,$current),0,false).'>'.esc_html($key).'</option>';
                    }
                    $lines .='</select></td>';
                }elseif($key == "raindrops_heading_image"){
                    $lines .= '<td style="height:225px">';
                    $lines .= '<input  accesskey="'.esc_attr($this->accesskey[$i]).'" type="text" name="raindrops_option_values['.$key.']" value="'.esc_attr__($val,'Raindrops').'"';
                    $lines .= ' /></td>';
                }elseif($key == "raindrops_color_scheme"){
                    $lines .= '<td>';
                    $lines .= sprintf($this->line_select_element,$this->accesskey[$i],'raindrops_option_values['.$key.']',3,60);
                    foreach($this->col_settings_raindrops_color_scheme as $key=>$current){
                        $lines .= '<option value="'.esc_attr__($current,'Raindrops').'" '.selected(strcmp($val,$current),0,false).'>'.esc_html($key).'</option>';
                    }
                }else{
                    $lines .= '<td>';
                    $lines .= '<input  accesskey="'.esc_attr($this->accesskey[$i]).'" type="text" name="raindrops_option_values['.$key.']" value="'.esc_attr__($val).'"';
                    $lines .= ' /></td>';
                }
                $i++;
                $lines .= "<td style=\"vertical-align:bottom;text-align:right;\"><input type=\"submit\" class=\"button-primary\" value=\"".esc_attr__('Save').'" /></td>';

                $lines .= '</tr>';

                $send_key_name = "";
                $lines .= "</tbody></table><br /></div>";
            }
$lines .= $this->table_template."<tr><td><input type=\"submit\" class=\"button-primary\" value=\"".esc_attr__('Save Changes').'" /></td></tr></table></form><br style="clear:both;">';
                $lines .= "</div>";
                if(!preg_match('|<tbody>|',$lines)){
                    $lines .= "<tbody><tr><td colspan=\"4\">".__("Please reload this page ex. windows F5",'Ranidrops').'</td></tr></tbody>';
                }
                return $lines;
        }

/**
 *
 *
 *
 *
 *
 */

         function color_selector($name,$current_val,$i){
            global $color_ja,$color_en_140,$color_en,$color_anime;
            $result = sprintf($this->line_select_element,$this->accesskey[$i],'raindrops_option_values['.$name.']',4,100);
            $scheme = raindrops_warehouse("raindrops_color_scheme");
            $current_color = array_search($current_val,$$scheme);

$result .= '<option value="'.$current_val.'" style="background:'.$current_val.'" '.selected(1,1,false).'>'.$current_color.'</option>';
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
    function raindrops_gradient_single($i,$order = "asc"){
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

/**
 *
 *
 *
 *
 *
 */

    function raindrops_gradient(){
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
        $g .= '.gradient-'.$i.'{';
        $g .= 'color:'.raindrops_colors($i,'color').';';
        $g .= 'background: -webkit-gradient(linear, left top, left bottom, from('.$custom_dark_bg2.'), to('.$custom_light_bg2.'));';
        $g .= 'background: -moz-linear-gradient(top,  '.$custom_dark_bg2.',  '.$custom_light_bg2.');';
        $g .= 'filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$custom_dark_bg2.'\', endColorstr=\''.$custom_light_bg2.'\');';
        $g .= "}\n";
        }
        return $g;
    }

/**
 * add stylesheet and few javascript
 *
 *
 *
 *
 */
if(!function_exists("add_raindrops_stylesheet")){
    function add_raindrops_stylesheet() {

        $themes                 = get_themes();
        $current_theme          = get_current_theme();

        if(isset($themes[$current_theme]['Version'])){
            $raindrops_version  = $themes[$current_theme]['Version'];
        }else{
            $raindrops_version  = "0.1";
        }

        $template_uri = get_template_directory_uri();
        $stylesheet_uri = get_stylesheet_directory_uri();

            $reset_font_grid    = $template_uri.'/reset-fonts-grids.css';

            wp_register_style('raindrops_reset_fonts_grids', $reset_font_grid,array(),$raindrops_version,'all');
            wp_enqueue_style( 'raindrops_reset_fonts_grids');

            $grids  = $template_uri.'/grids.css';
            wp_register_style('raindrops_grids', $grids,array('raindrops_reset_fonts_grids'),$raindrops_version,'all');
            wp_enqueue_style( 'raindrops_grids');


            $fonts              = $template_uri.'/fonts.css';

            wp_register_style('raindrops_fonts', $fonts,array('raindrops_grids'),$raindrops_version,'all');
            wp_enqueue_style( 'raindrops_fonts');

        
            $language           = get_locale();

            $lang   = $template_uri.'/languages/css/'.$language.'.css';
            wp_register_style('lang_style', $lang,array('raindrops_fonts'),$raindrops_version,'all');
            wp_enqueue_style( 'lang_style');
			
            if(raindrops_warehouse("raindrops_style_type") !== 'w3standard'){
            $raindrops_css3   = $template_uri.'/css3.css';
            wp_register_style('raindrops_css3', $raindrops_css3,array('raindrops_fonts'),$raindrops_version,'all');
            wp_enqueue_style('raindrops_css3');

            }

            $child  			= $stylesheet_uri.'/style.css';
            wp_register_style('style', $child,array('raindrops_fonts'),$raindrops_version,'all');
            wp_enqueue_style( 'style');

/* add small js*/
            $raindrops_js   = $template_uri.'/raindrops.js';
            wp_register_script('raindrops', $raindrops_js,array('jquery'),$raindrops_version,'all');
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

    function raindrops_comment_form($form){
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

        if(RAINDROPS_USE_AUTO_COLOR == false){return;}
        $raindrops_theme_settings = get_option('raindrops_theme_settings');

       foreach($raindrops_base_setting as $add){

            $option_name = $add['option_name'];

            if(!isset($raindrops_theme_settings[$option_name])){
                $raindrops_theme_settings[$option_name] = $add['option_value'];
            }
        }
        $style_type                                         = raindrops_warehouse("raindrops_style_type");
        $raindrops_indv_css                                 = raindrops_design_output($style_type).raindrops_color_base();
        $raindrops_theme_settings['_raindrops_indv_css']    = $raindrops_indv_css;

        update_option('raindrops_theme_settings',$raindrops_theme_settings,"",$add['autoload']);

    }

/**
 * image element has attribute 'width','height' and image size > column width
 * style max-width value 100% set when expand height height attribute value.
 *
 * IE filter
 *
 */

    add_filter('the_content','raindrops_ie_height_expand_issue');

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

/**
 * Raindrops once message when install.
 *
 *
 *
 *
 */
    function raindrops_first_only_msg($type=0) {
        if ( $type == 1 ) {
            $query  = 'raindrops_settings';
            $link   = get_site_url('', 'wp-admin/themes.php', 'admin') . '?page='.$query;
            if (version_compare(PHP_VERSION, '5.0.0', '<')) {
            $msg    = sprintf(__('Sorry Your PHP version is %s Please use PHP version 5 or later.','Raindrops'),PHP_VERSION);
            }else{
            $msg    = sprintf(__('Thank you for adopting the %s theme. It is necessary to set it to this theme. Please move to a set screen clicking this <a href="%s">Raindrops settings view</a>.','Raindrops'),get_current_theme() ,$link);
            }
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

    function raindrops_install_navigation() {

        $install = get_option('raindrops_theme_settings');

        if (!array_key_exists('install', $install)) {
            add_action('admin_notices', create_function(null, 'echo raindrops_first_only_msg(1);'));
            $install['install'] = true;
            update_option('raindrops_theme_settings',$install);
        } else {
            add_action('switch_theme', create_function(null, 'delete_option("raindrops_theme_settings");'));
        }
    }

/**
 * insert into embed style ,javascript script and embed tags from custom field
 *
 *
 *
 *
 */
    function raindrops_embed_meta($content){
        $result = "";
        global $post;
$raindrops_gallerys = '.gallery { margin: auto; overflow: hidden; width: 100%; }
.gallery dl { margin: 0px; }
.gallery .gallery-item { float: left; margin-top: 10px; text-align: center; }
.gallery img { border: 2px solid #cfcfcf;max-width:100%; }
.gallery .gallery-caption { margin-left: 0; }
.gallery br { clear: both }
.gallery-columns-2 dl{ width: 50% }
.gallery-columns-3 dl{ width: 33.3% }
.gallery-columns-4 dl{ width: 25% }
.gallery-columns-5 dl{ width: 20% }
.gallery-columns-6 dl{ width: 16.6% }
.gallery-columns-7 dl{ width: 14.28% }
.gallery-columns-8 dl{ width: 12.5% }
.gallery-columns-9 dl{ width: 11.1% }';
        $css                = $raindrops_gallerys;

        $raindrops_options  = get_option("raindrops_theme_settings");
        $css                .= $raindrops_options['_raindrops_indv_css'];
        $background = get_background_image();
        $color = get_background_color();

        if(!empty($background) or !empty($color)){
            $css = preg_replace("|body[^{]*{[^}]+}|","",$css);
        }

        if(empty($css)){
            $css = "cannot get style value check me";
        }

        $css    = str_replace(array("\n","\r","\t",'&quot;','--'),array("","","",'"',''),$css);
        if (is_single() || is_page()) {
            if(have_posts()){

             while (have_posts()) : the_post();
                if(RAINDROPS_USE_AUTO_COLOR !== true){
                    $css = '';
                }
                $css    .= get_post_meta($post->ID, 'css', true);

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
            }
        }else{
                if(RAINDROPS_USE_AUTO_COLOR == true){
                    $result .= '<style type="text/css">';
                    $result .= "\n/*<![CDATA[*/\n";
                    $result .=  $css;
                    $result .= "\n/*]]>*/\n";
                    $result .= "</style>";
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
    function raindrops_blank_fallback($string,$fallback){
        if(!empty($string)){
            return $string;
        }else{
            return $fallback;
        }
    }
/**
 * Article navigation
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

  <span class="nav-previous"><?php previous_post_link('%link','<span class="button"><span class="meta-nav">&laquo;</span> %title</span>'); ?></span>

  <div class="nav-next"><?php next_post_link('%link','<span class="button"> %title <span class="meta-nav">&raquo;</span></span>'); ?></div>
</div>
<?php }
/**
 * date.php
 *
 *
 *
 *
 */


    function raindrops_days_in_month($month, $year) {
            $daysInMonth = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
            if ($month != 2) {
                    return $daysInMonth[$month - 1];
            }
            return (checkdate($month, 29, $year)) ? 29 : 28;
    }

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
/*end raindrops_get_month()*/


/**
 * for date.php
 *
 *
 *
 *
 */
    function raindrops_get_year($posts = '', $year = '', $pad = 0) {
        global $ht_deputy,$calendar_page_number,$post_per_page, $calendar_page_last, $calendar_page_start;

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
/* end raindrops_get_year()*/

/**
 * for date.php
 *
 *
 *
 *
 */

    function raindrops_get_day($posts = '', $year = '', $mon = '', $day = '', $pad = 1){

        global $month;
        global $ht_deputy;

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

                                    if($mytime->post_title == ''){$mytime->post_title = $ht_deputy;}

                                        $output .= "<a href=\"" . get_permalink($mytime->ID) . "\"
        title=\"$mytime->post_title\">$mytime->post_title</a><br />";
                                }

                } else {
                        $output .= '<span style="visibility:hidden;">.</span>';
                }
                $output .= '</td></tr>';
        }
        $output .= '</table>';
        return $output;
    }
/* end raindrops_get_day()*/

/**
 * for date.php
 *
 *
 *
 *
 */

    function raindrops_year_list($one_month,$ye,$mo){
        $result = "";
        global $ht_deputy,$calendar_page_number,$post_per_page, $calendar_page_last, $calendar_page_start;
        $d = "";
        $links = "";
            foreach($one_month as $key=>$month){
                list($y,$m,$d) = sscanf($month->post_date,"%d-%d-%d $d:$d:$d");

                    if($month->post_title == ''){
                        $month->post_title = $ht_deputy;
                    }

                    if($m == $mo and $ye == $y){
                        $links .= "<li class=\"$mo\"><a href=\"" . get_permalink($month->ID) . "\" title=\"$month->post_title\">".$month->post_title."</a></li>";
                    }

            }
            if(!empty($links)){
                $result .= " <td><ul>";
                $result .= $links;
                $result .= "</ul></td>";
             }
        return $result;
    }


/**
 * sort month_list
 *
 *
 *
 *
 */

function raindrops_cmp_ids( $a , $b){
  $cmp = strcmp( $a->post_date , $b->post_date );
  return $cmp;
}

/**
 * for date.php
 *
 *
 *
 *
 */

    function month_list($one_month,$ye,$mo){
    global $ht_deputy,$calendar_page_number,$post_per_page, $calendar_page_last, $calendar_page_start;

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

            if($month->post_title == ''){$month->post_title = $ht_deputy;}
            list($y,$m,$d,$h,$m,$s) = sscanf($month->post_date,"%d-%d-%d %d:%d:%d");
            if($key <  $calendar_page_last and $key >= $calendar_page_start){

                if($d == $i and $m == $mo and $y == $ye){
                $first_data = true;
                $links .= "<li><a href=\"" . get_permalink($month->ID) . "\" title=\"".$month->post_title."\">".$month->post_title."</a></li>";

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


/**
 * index ,archive,loops page title
 *
 *
 *
 *
 */

function raindrops_loop_title(){

/**
 * ardhive title
 *
 * loo.php
 *
 *
 */
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
                $page_title_c = get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'Raindrops_author_bio_avatar_size', 32 ) ).' '.get_the_author();
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

/**
 * yui helper function
 *
 *
 *
 *
 */

function raindrops_yui_class_modify($raindrops_inner_class = 'yui-ge'){
    global $yui_inner_layout;

    if(isset($yui_inner_layout)){
        $raindrops_inner_class = $yui_inner_layout;
    }
    return $raindrops_inner_class;
}

function is_2col_raindrops($action = true,$echo = true){

    if(raindrops_warehouse('raindrops_show_right_sidebar') == 'hide'){

        if($echo == true){
            echo $action;
        }else{
            return $action;
        }

    }else{
        return false;
    }


}

/**
 * yui layout curc
 *
 *
 *
 *
 */

    function raindrops_main_width(){

        $adjust                 = 16;
        $default                = 400;
        $document_width         = raindrops_warehouse('raindrops_page_width');
        $sidebar_width          = 'yui-'.raindrops_warehouse('raindrops_col_width');

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

            return $raindrops_content_width;
    }

/**
 * content width curc
 *
 *
 *
 *
 */

    function raindrops_content_width(){
        global $page_width;
        $adjust                 = 16;
        $default                = 400;
        $document_width         = raindrops_warehouse('raindrops_page_width');
        $sidebar_width          = 'yui-'.raindrops_warehouse('raindrops_col_width');
        $extra_sidebar_width    = raindrops_warehouse('raindrops_right_sidebar_width_percent');

        if(isset($page_width) and !empty($page_width)){
            $w = $page_width;
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

        if(raindrops_warehouse('raindrops_show_right_sidebar') == 'hide'){
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

/**
 *
 *
 *
 *
 *
 */
if(!function_exists("raindrops_w3standard")){
function raindrops_w3standard(){

$style =<<<DOC
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
	background-image:url(%images_path%%raindrops_header_image%);
}
.hfeed{
    background:#fff;
}
#ft {
	background:url(%images_path%%raindrops_footer_image%) repeat-x;
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
border-top:solid 2px %c_border%;
border-bottom:solid 2px %c_border%;
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
cite a:link,cite a:active,cite a:visited,cite a:hover{
    %c4%
    background:none!important;
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
%c2%
}
.comment-meta a,
cite.fn{
	background:none;
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
DOC;
return $style;
}
}

?>