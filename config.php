<?php
if(!defined('ABSPATH')){exit;}

    $stylesheet_name = 'individual-css.php';

    //$page_width = '';
    //$content_width = '';

    if(!defined('TMN_USE_LIST_EXCERPT')){
        define("TMN_USE_LIST_EXCERPT",false);
    }


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
        define('HEADER_TEXTCOLOR', '-none-');
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
    if(!defined('TMN_SHOW_HEADER_IMAGE')){
        define('TMN_SHOW_HEADER_IMAGE',false);
    }
    if(!defined('TMN_THE_TIME_FORMAT')){
        define("TMN_THE_TIME_FORMAT",'Y/n/j');//

    }
    if(!defined('TMN_THE_MONTH_FORMAT')){
        define("TMN_THE_MONTH_FORMAT",'Y/m');//archive.php

    }


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

$color_ja= array(__('none','Raindrops') => "",__('toki','Raindrops') => "#F9A1D0",__('tutuji','Raindrops') => "#CB4B94",__('sakura','Raindrops') => "#FFDBED",__('bara','Raindrops') => "#D34778",__('karakurenai','Raindrops') => "#E3557F",__('sango','Raindrops') => "#FF87A0",__('koubai','Raindrops') => "#E08899",__('momo','Raindrops') => "#E38698",__('beni','Raindrops') => "#BD1E48",__('beniaka','Raindrops') => "#B92946",__('enji','Raindrops') => "#AE3846",__('suou','Raindrops') => "#974B52",__('akane','Raindrops') => "#A0283A",__('aka','Raindrops') => "#BF1E33",__('syu','Raindrops') => "#ED514E",__('benikaba','Raindrops') => "#A14641",__('benihi','Raindrops') => "#EE5145",__('entan','Raindrops') => "#D3503C",__('beniebitya','Raindrops') => "#703B32",__('tobi','Raindrops') => "#7D483E",__('azuki','Raindrops') => "#946259",__('bengara','Raindrops') => "#8A4031",__('ebitya','Raindrops') => "#6D3D33",__('kinaka','Raindrops') => "#ED542A",__('akatya','Raindrops') => "#B15237",__('akasabi','Raindrops') => "#923A21",__('ouni','Raindrops') => "#EF6D3E",__('sekitou','Raindrops') => "#ED551B",__('kaki','Raindrops') => "#E06030",__('nikkei','Raindrops') => "#B97761",__('kaba','Raindrops') => "#BD4A1D",__('renga','Raindrops') => "#974E33",__('sabi','Raindrops') => "#664134",__('hiwada','Raindrops') => "#8A604F",__('kuri','Raindrops') => "#754C38",__('kiaka','Raindrops') => "#E45E00",__('taisya','Raindrops') => "#BA6432",__('rakuda','Raindrops') => "#B67A52",__('kitye','Raindrops') => "#BB6421",__('hadairo','Raindrops') => "#F4BE9B",__('daidai','Raindrops') => "#FD7E00",__('haitya','Raindrops') => "#866955",__('tya','Raindrops') => "#734E30",__('kogetya','Raindrops') => "#594639",__('kouji','Raindrops') => "#FFA75E",__('anzu','Raindrops') => "#DDA273",__('mikan','Raindrops') => "#FA8000",__('kassyoku','Raindrops') => "#763900",__('tutiiro','Raindrops') => "#A96E2D",__('komugi','Raindrops') => "#D9A46D",__('kohaku','Raindrops') => "#C67400",__('kintya','Raindrops') => "#C47600",__('tamago','Raindrops') => "#FABE6F",__('yamabuki','Raindrops') => "#FFA500",__('oudo','Raindrops') => "#C18A39",__('kutiba','Raindrops') => "#897868",__('himawari','Raindrops') => "#FFB500",__('ukon','Raindrops') => "#FCAC00",__('suna','Raindrops') => "#C9B9A8",__('karasi','Raindrops') => "#CDA966",__('ki','Raindrops') => "#FFBE00",__('tanpopo','Raindrops') => "#FFBE00",__('uguisutya','Raindrops') => "#70613A",__('tyuki','Raindrops') => "#FAD43A",__('kariyasu','Raindrops') => "#EED67E",__('kihada','Raindrops') => "#D9CB65",__('miru','Raindrops') => "#736F55",__('biwa','Raindrops') => "#C2C05C",__('uguisu','Raindrops') => "#71714A",__('mattya','Raindrops') => "#BDBF92",__('kimidori','Raindrops') => "#B9C42F",__('koke','Raindrops') => "#7A7F46",__('wakakusa','Raindrops') => "#A9B735",__('moegi','Raindrops') => "#96AA3D",__('kusa','Raindrops') => "#72814B",__('wakaba','Raindrops') => "#AFC297",__('matuba','Raindrops') => "#6E815C",__('byakuroku','Raindrops') => "#CADBCF",__('midori','Raindrops') => "#4DB56A",__('tokiwa','Raindrops') => "#357C4C",__('rokusyou','Raindrops') => "#5F836D",__('titosemidori','Raindrops') => "#4A6956",__('fukamidori','Raindrops') => "#005731",__('moegi','Raindrops') => "#15543B",__('wakatake','Raindrops') => "#49A581",__('seiji','Raindrops') => "#80AA9F",__('aotake','Raindrops') => "#7AAAAC",__('tetu','Raindrops') => "#244344",__('aomidori','Raindrops') => "#0090A8",__('sabiasagi','Raindrops') => "#6C8D9B",__('mizuasagi','Raindrops') => "#7A99AA",__('sinbasi','Raindrops') => "#69AAC6",__('asagi','Raindrops') => "#0087AA",__('byakugun','Raindrops') => "#84B5CF",__('nando','Raindrops') => "#166A88",__('kamenozoki','Raindrops') => "#8CB4CE",__('mizu','Raindrops') => "#A9CEEC",__('ainezu','Raindrops') => "#5E7184",__('sora','Raindrops') => "#95C0EC",__('ao','Raindrops') => "#0067C0",__('ai','Raindrops') => "#2E4B71",__('koiai','Raindrops') => "#20324E",__('wasurenagusa','Raindrops') => "#92AFE4",__('tuyukusa','Raindrops') => "#3D7CCE",__('hanada','Raindrops') => "#3C639B",__('konjou','Raindrops') => "#3D496B",__('ruri','Raindrops') => "#3451A4",__('rurikon','Raindrops') => "#324784",__('kon','Raindrops') => "#333C5E",__('kakitubata','Raindrops') => "#4C5DAB",__('kati','Raindrops') => "#383C57",__('gunjou','Raindrops') => "#414FA3",__('tetukon','Raindrops') => "#232538",__('fujinando','Raindrops') => "#6869A8",__('kikyou','Raindrops') => "#4A49AD",__('konai','Raindrops') => "#35357D",__('fuji','Raindrops') => "#A09BD8",__('fujimurasaki','Raindrops') => "#948BDB",__('aomurasaki','Raindrops') => "#704CBC",__('sumire','Raindrops') => "#6D52AB",__('hatoba','Raindrops') => "#675D7E",__('syoubu','Raindrops') => "#7051AA",__('edomurasaki','Raindrops') => "#5F4C86",__('murasaki','Raindrops') => "#A260BF",__('kodaimurasaki','Raindrops') => "#775686",__('nasukon','Raindrops') => "#47384F",__('sikon','Raindrops') => "#402949",__('ayame','Raindrops') => "#C27BC8",__('botan','Raindrops') => "#C24DAE",__('akamurasaki','Raindrops') => "#C54EA0",__('siro','Raindrops') => "#F1F1F1",__('gofun','Raindrops') => "#F2E8EC",__('kinari','Raindrops') => "#F0E2E0",__('zouge','Raindrops') => "#E3D4CA",__('ginnezu','Raindrops') => "#A0A0A0",__('tyanezumi','Raindrops') => "#9F9190",__('nezumi','Raindrops') => "#868686",__('rikyunezumi','Raindrops') => "#787C7A",__('namari','Raindrops') => "#797A88",__('hai','Raindrops') => "#797979",__('susutake','Raindrops') => "#605448",__('kurotya','Raindrops') => "#3E2E28",__('sumi','Raindrops') => "#313131",__('kuro','Raindrops') => "#262626",__('tetukuro','Raindrops') => "#262626");

$color_en_140 = array("none"=>"","white"=>"#ffffff","whitesmoke"=>"#f5f5f5","gainsboro"=>"#dcdcdc","lightgrey"=>"#d3d3d3","silver"=>"#c0c0c0","darkgray"=>"#a9a9a9","gray"=>"#808080","dimgray"=>"#696969","black"=>"#000000","red"=>"#ff0000","orangered"=>"#ff4500","tomato"=>"#ff6347","coral"=>"#ff7f50","salmon"=>"#fa8072","lightsalmon"=>"#ffa07a","darksalmon"=>"#e9967a","peru"=>"#cd853f","saddlebrown"=>"#8b4513","sienna"=>"#a0522d","chocolate"=>"#d2691e","sandybrown"=>"#f4a460","darkred"=>"#8b0000","maroon"=>"#800000","brown"=>"#a52a2a","firebrick"=>"#b22222","crimson"=>"#dc143c","indianred"=>"#cd5c5c","lightcoral"=>"#f08080","rosybrown"=>"#bc8f8f","palevioletred"=>"#db7093","deeppink"=>"#ff1493","hotpink"=>"#ff69b4","lightpink"=>"#ffb6c1","pink"=>"#ffc0cb","mistyrose"=>"#ffe4e1","linen"=>"#faf0e6","seashell"=>"#fff5ee","lavenderblush"=>"#fff0f5","snow"=>"#fffafa","yellow"=>"#ffff00","gold"=>"#ffd700","orange"=>"#ffa500","darkorange"=>"#ff8c00","goldenrod"=>"#daa520","darkgoldenrod"=>"#b8860b","darkkhaki"=>"#bdb76b","burlywood"=>"#deb887","tan"=>"#d2b48c","khaki"=>"#f0e68c","peachpuff"=>"#ffdab9","navajowhite"=>"#ffdead","palegoldenrod"=>"#eee8aa","moccasin"=>"#ffe4b5","wheat"=>"#f5deb3","bisque"=>"#ffe4c4","blanchedalmond"=>"#ffebcd","papayawhip"=>"#ffefd5","cornsilk"=>"#fff8dc","lightyellow"=>"#ffffe0","lightgoldenrodyellow"=>"#fafad2","lemonchiffon"=>"#fffacd","antiquewhite"=>"#faebd7","beige"=>"#f5f5dc","oldlace"=>"#fdf5e6","ivory"=>"#fffff0","floralwhite"=>"#fffaf0","greenyellow"=>"#adff2f","yellowgreen"=>"#9acd32","olive"=>"#808000","darkolivegreen"=>"#556b2f","olivedrab"=>"#6b8e23","chartreuse"=>"#7fff00","lawngreen"=>"#7cfc00","lime"=>"#00ff00","limegreen"=>"#32cd32","forestgreen"=>"#228b22","green"=>"#008000","darkgreen"=>"#006400","seagreen"=>"#2e8b57","mediumseagreen"=>"#3cb371","darkseagreen"=>"#8fbc8f","lightgreen"=>"#90ee90","palegreen"=>"#98fb98","springgreen"=>"#00ff7f","mediumspringgreen"=>"#00fa9a","honeydew"=>"#f0fff0","mintcream"=>"#f5fffa","azure"=>"#f0ffff","lightcyan"=>"#e0ffff","aliceblue"=>"#f0f8ff","darkslategray"=>"#2f4f4f","steelblue"=>"#4682b4","mediumaquamarine"=>"#66cdaa","aquamarine"=>"#7fffd4","mediumturquoise"=>"#48d1cc","turquoise"=>"#40e0d0","lightseagreen"=>"#20b2aa","darkcyan"=>"#008b8b","teal"=>"#008080","cadetblue"=>"#5f9ea0","darkturquoise"=>"#00ced1","aqua"=>"#00ffff","cyan"=>"#00ffff","lightblue"=>"#add8e6","powderblue"=>"#b0e0e6","paleturquoise"=>"#afeeee","skyblue"=>"#87ceeb","lightskyblue"=>"#87cefa","deepskyblue"=>"#00bfff","dodgerblue"=>"#1e90ff","ghostwhite"=>"#f8f8ff","lavender"=>"#e6e6fa","lightsteelblue"=>"#b0c4de","slategray"=>"#708090","lightslategray"=>"#778899","indigo"=>"#4b0082","darkslateblue"=>"#483d8b","midnightblue"=>"#191970","navy"=>"#000080","darkblue"=>"#00008b","slateblue"=>"#6a5acd","mediumslateblue"=>"#7b68ee","cornflowerblue"=>"#6495ed","royalblue"=>"#4169e1","mediumblue"=>"#0000cd","blue"=>"#0000ff","thistle"=>"#d8bfd8","plum"=>"#dda0dd","orchid"=>"#da70d6","violet"=>"#ee82ee","fuchsia"=>"#ff00ff","magenta"=>"#ff00ff","mediumpurple"=>"#9370db","mediumorchid"=>"#ba55d3","darkorchid"=>"#9932cc","blueviolet"=>"#8a2be2","darkviolet"=>"#9400d3","purple"=>"#800080","darkmagenta"=>"#8b008b","mediumvioletred"=>"#c71585");


$color_en = array("none"=>"","american red" => "#bf0a30","american blue" => "#002868","american green" => "#006e53","american yellow" => "#deb301","american light blue" => "#cbddf3","american brown" => "#9a6b37","american gray" => "#afafb1","glory red" => "#cc0033","glory blue" => "#0000ff","glory white" => "#fff9f5","big apple red" => "#ff6331","big apple blue" => "#3131ce","empire blue" => "#001873","empire cyan" => "#00b5d6","empire red" => "#d60000","empire yellow" => "#f7f700","empire orange" => "#f79429","empire green" => "#084a29","empire ebony" => "#424a00","natural red" => "#cc0033","natural blue" => "#000099","natural light blue" => "#84c8ef","natural green" => "#90c924","natural orange" => "#f39234","natural brown" => "#843a2f","natural gray" => "#bfbfbf","hawkeye red" => "#e3003d","hawkeye blue" => "#3c3c9e","hawkeye yellow" => "#ffb30f","hawkeye brown" => "#a54a00","frontier blue" => "#000080","frontier light blue" => "#d3eef7","frontier green" => "#024900","frontier yellow" => "#ffff00","frontier purple" => "#8663bd","dixie red" => "#b10021","dixie blue" => "#083152","dixie green" => "#105a21","dixie yellow" => "#ffc621","grand canyon blue" => "#002868","grand canyon red" => "#bf0a30","grand canyon brown" => "#ce5c17","grand canyon yellow" => "#fed700","grand canyon green" => "#00320b","grand canyon pink" => "#efc1a9","lincoln red" => "#e2184f","lincoln pink" => "#e24a4f","lincoln light blue" => "#64b4ff","lincoln blue" => "#3c3c9e","lincoln green" => "#3f863f","lincoln yellow" => "#ffe60f","lincoln orange" => "#ffb316","hoosier blue" => "#101195","hoosier yellow" => "#ffe700","hoosier green" => "#197351","hoosier brown" => "#563837","badger blue" => "#002986","badger light blue" => "#00b2fd","badger pink" => "#f8b8de","badger red" => "#f3334b","badger green" => "#41ad16","badger yellow" => "#ffe618","badger brown" => "#66180b","badger gray" => "#a2b9b9","mountain red" => "#ff3516","mountain blue" => "#003776","mountain green" => "#20d942","mountain yellow" => "#ffb30f","mountain brown" => "#d15b25","mountain gray" => "#c0c0c0","sooner blue" => "#0e4892","sooner light blue" => "#00adc6","sooner green" => "#1b692b","sooner opal" => "#8ab87a","sooner yellow" => "#f0c016","sooner brown" => "#421000","sooner beige" => "#ffc69c","sooner gray" => "#d6c6c6","sooner black" => "#454442","buckeye blue" => "#1a3b86","buckeye red" => "#ff0000","buckeye green" => "#00784b","buckeye yellow" => "#f8c300","buckeye brown" => "#4e3330","buckeye light blue" => "#027bc2","beaver blue" => "#002a86","beaver yellow" => "#ffea0f","golden red" => "#c10435","golden green" => "#007e3a","golden brown" => "#391800","golden yellow" => "#bc8e07","golden cyan" => "#40a7aa","golden gray" => "#84948e","sunflower blue" => "#00009c","sunflower light blue" => "#0092df","sunflower green" => "#29b910","sunflower orange" => "#ff660f","sunflower brown" => "#b34e20","sunflower purple" => "#7c4790","sunflower yellow" => "#ffe400","sunflower gray" => "#dedede","new england" => "#e25c5c","midatlantic" => "#5c7a7a","south" => "#8a84a3","florida" => "#e9bda2","midwest" => "#ffd577","texas" => "#77cbb3","great plains" => "#b6bc4d","rocky mountain" => "#e9df25","southwest" => "#ee2222","california" => "#e0fa92","pacific northwest" => "#38911c","alaska" => "#d09440","hawaii" => "#4f93c0","mountains alabama" => "#999966","metropolitan alabama" => "#ff9933","river heritage alabama" => "#996699","gulf coast alabama" => "#99cccc","southern california" => "#e03030","california desert" => "#e0b000","california central coast" => "#00b000","san joaquin valley" => "#a0a0c0","sacramento valley" => "#e0b000","sierra nevada" => "#00e000","gold country" => "#e0e000","bay area california" => "#e06060","california north coast" => "#b0b000","shasta cascades" => "#e03030","mississippi capital river" => "#336699","mississippi delta" => "#663366","mississippi pines" => "#339966","gulf coast mississippi" => "#660033","mississippi hills" => "#996633","panhandle nebraska" => "#cc9966","north central nebraska" => "#cccc66","eastern nebraska" => "#99cccc","western nevada" => "#cc9999","northern nevada" => "#cc9966","central nevada" => "#9999cc","southern nevada" => "#99cccc","central new mexico" => "#e0fa92","north central new mexico" => "#6699aa","northeast new mexico" => "#b6bc4d","northwest new mexico" => "#d09440","southwest new mexico" => "#b2cc7f","southeast new mexico" => "#ffff99","northwest ohio" => "#666633","northeast ohio" => "#669999","midohio" => "#996666","southwest ohio" => "#666699","southeast ohio" => "#cc9933","western tennessee" => "#996699","central tennessee" => "#339999","eastern tennessee" => "#339966","panhandle texas" => "#80622f","prairies and lakes" => "#335c64","piney woods" => "#406324","gulf coast texas" => "#7895a3","south texas plains" => "#7d6b71","hill country" => "#d1a85e","big bend country" => "#c6ab7a","wasatch front" => "#99cc33","canyon country" => "#cc6600","northeastern utah" => "#669900","dixie" => "#b2cc7f","central utah" => "#999933","western utah" => "#ffff99","northern virginia" => "#9966ff","eastern virginia" => "#33bbee","central virginia" => "#ff6655","southwest virginia" => "#ffcc33","shenandoah valley" => "#339933","southeast wisconsin" => "#66cc99","southwest wisconsin" => "#99ccff","northeast wisconsin" => "#009999","north central wisconsin" => "#66ccff","northwest wisconsin" => "#99cccc");

    $raindrops_base_setting = array(

        array('option_id' =>'null',
        'blog_id' => 0 ,
        'option_name' => "raindrops_base_color",
        'option_value' => "#444444",
        'autoload'=>'yes',
        'title'=> __('Base Color for Automatic Arrangement','Raindrops'),
        'excerpt1'=>'',
        'excerpt2'=>__('Please specify your favorite color. It is based on the specified color,
         and an automatic arrangement of color is designed. Please set the value of TMN_USE_AUTO_COLOR of function.php to false when you want to stop it. The specification of the color and border is removed. Even if this function is used,
         you can freely specify it with style.css. Because the author of Raindrops is Japanese,
         a traditional color of Japan is set in the specification of the color If it wants you other arrangement of color sets themes/functions.php is opened,
         and it is value of const COLOR_SCHEME revokable. In default,
         color_en or color_en_140 can be set. ','Raindrops','Raindrops'),
         'validate'=>'raindrops_base_color_validate'),

        array('option_id' =>'null',
        'blog_id' => 0 ,
        'option_name' => "raindrops_style_type",
        'option_value' => "default",
        'autoload'=>'yes',
        'title'=>__('Color Type','Raindrops'),
        'excerpt1'=>'',
        'excerpt2'=>__('The mood like dark atmosphere and the bright note,
         etc. is decided.','Raindrops'),
         'validate'=>'raindrops_style_type_validate'),

        array('option_id' =>'null',
        'blog_id' => 0 ,
        'option_name' => "raindrops_header_image",
        'option_value' => "header.png",
        'autoload'=>'yes',
        'title'=>__('Header image','Raindrops'),
        'excerpt1'=>'',
        'excerpt2'=>__('The name of the picture file used for the header is set. As for the image,
         the image that exists in themes/raindrops/image/is used.','Raindrops'),
         'validate'=>'raindrops_header_image_validate'),

        array('option_id' =>'null',
        'blog_id' => 0 ,
        'option_name' => "raindrops_footer_image",
        'option_value' => "footer.png",
        'autoload'=>'yes',
        'title'=>__('Footer image','Raindrops'),
        'excerpt1'=>'',
        'excerpt2'=>__('The name of the picture file used for the footer is set.As for the image,
         the image that exists in themes/raindrops/image/is used.','Raindrops'),
         'validate'=>'raindrops_footer_image_validate'),

        array('option_id' =>'null',
        'blog_id' => 0 ,
        'option_name' => "raindrops_heading_image_position",
        'option_value' => "0",
        'autoload'=>'yes',
        'title'=>__('image position h2 background image','Raindrops'),
        'excerpt1'=>'',
        'excerpt2'=>__('The name of the picture file used for the h2 headding is set. Please set the integral value from 0 to 7. ','Raindrops'),
        'validate'=>'raindrops_heading_image_position_validate'),

        array('option_id' =>'null',
        'blog_id' => 0 ,
        'option_name' => "raindrops_heading_image",
        'option_value' => "h2.png",
        'autoload'=>'yes',
        'title'=>__('Background Image h2','Raindrops'),
        'excerpt1'=>'',
        'excerpt2'=>__('The name of the picture file used for the h2 headding is set. As for the image,
         the image that exists in themes/raindrops/image/is used.The header image can be chosen from among three kinds [h2.png,
        h2b.png,h2c.png] now. Of course, customizing is also possible. ','Raindrops'),
         'validate'=>'raindrops_heading_image_validate'),

        array('option_id' =>'null',
        'blog_id' => 0 ,
        'option_name' => "raindrops_page_width",
        'option_value' => "doc2",
        'autoload'=>'yes',
        'title'=>__('Page Width','Raindrops'),
        'excerpt1'=>'',
        'excerpt2'=>__('Please choose width on the page.
    Please choose from four kinds of inside of 750px centerd 950px centerd 100% fluid 974px fluid.
    Please add the variable to functions.php when you want to specify page other size. For instance,
         $page_width =  700;The width of the page if it specifies it will be changed to 700px centerd at once.','Raindrops'),
         'validate'=>'raindrops_page_width_validate'),

        array('option_id' =>'null',
        'blog_id' => 0 ,
        'option_name' => "raindrops_col_width",
        'option_value' => "t2",
        'autoload'=>'yes',
        'title'=>__('Column Width and Position','Raindrops'),
        'excerpt1'=>'',
        'excerpt2'=>__('Please specify the position and the width of Default Sidebar. Six kinds of sidebars of left 160px left 180px left 300px right 180px right 240px right 300px can be specified.','Raindrops'),
        'validate'=>'raindrops_col_width_validate'),

        array('option_id' =>'null',
        'blog_id' => 0 ,
        'option_name' => "raindrops_default_fonts_color",
        'option_value' => "",
        'autoload'=>'yes',
        'title'=>__('Fonts Color ','Raindrops'),
        'excerpt1'=>'',
        'excerpt2'=>__('Please specify the color of the entry content. Please use it when you want to decide the text color though the automatic arrangement of color function does well in most cases.When none is selected from the selection box,
         it becomes an automatic arrangement of color. ','Raindrops'),
         'validate'=>'raindrops_default_fonts_color_validate'),

        array('option_id' =>'null',
        'blog_id' => 0 ,
        'option_name' => "raindrops_footer_color",
        'option_value' => "",
        'autoload'=>'yes',
        'title'=>__('Fonts Color Footer ','Raindrops'),
        'excerpt1'=>'',
        'excerpt2'=>__('Please specify the text color of the footer. Please use it when you want to decide the text color though the automatic arrangement of color function does well in most cases.When none is selected from the selection box,
         it becomes an automatic arrangement of color. ','Raindrops'),
         'validate'=>'raindrops_footer_color_validate'),

        array('option_id' =>'null',
        'blog_id' => 0 ,
        'option_name' => "raindrops_show_right_sidebar",
        'option_value' => "show",
        'autoload'=>'yes',
        'title'=>__('Extra Sidebar','Raindrops'),
        'excerpt1'=>'',
        'excerpt2'=>__('Please specify show when you want to use three row layout. Please set Ratio to text when extra sidebar is displayed when you specify show','Raindrops'),
        'validate'=>'raindrops_show_right_sidebar_validate'),

        array('option_id' =>'null',
        'blog_id' => 0 ,
        'option_name' => "raindrops_right_sidebar_width_percent",
        'option_value' => "25",
        'autoload'=>'yes',
        'title'=>__('Extra Sidebar Width','Raindrops'),
        'excerpt1'=>'',
        'excerpt2'=>__('When display extra sidebar is set to show,
         it is necessary to specify it. It can decide to divide the width of which place of extra sidebar and to give it. Please select it from among 25% 33% 50% 66% 75%. ','Raindrops'),
         'validate'=>'raindrops_right_sidebar_width_percent_validate'),

    );

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

?>