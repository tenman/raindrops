

%gradient%

body{
    margin:0!important;
    %c4%
    background: -webkit-gradient(linear, left top, left bottom, from(%custom_dark_bg%), to(%custom_light_bg%));
    background: -moz-linear-gradient(top,  %custom_dark_bg%,  %custom_light_bg%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='%custom_dark_bg%', endColorstr='%custom_light_bg%');
}
#top{
    %c4%
}


.hfeed{
    /*%base_gradient%*/
    %c5%
    box-shadow: 0 0 5px %rgba_border%;
    -webkit-box-shadow: 0 0 5px %rgba_border%;
    -moz-box-shadow: 0 0 5px %rgba_border%;

}

h2,h3{
    %c5%
}
.home .sticky {
    background: %c4%
    border-top:solid 6px %rgba_border%;
    border-bottom:solid 2px %rgba_border%;

}

.entry-meta{
    background: %c4%
    border-top:solid 2px %rgba_border%;
    border-bottom:solid 2px %rgba_border%;
}

.home .sticky a{
    background: none;

}
#yui-main{

    /*%c5%*/
 %tmn_header_color%
}

.entry div h2,.entry div h3{
    %c5%
}
.entry ol ol ,.entry ul {
    %c5%
}
.entry ul *{
    %c5%
}

#hd{
   %c4%
    background-image:url(%images_path%%tmn_header_image%);

}
#hd h1,.h1,#site-title{
    %c4%
    background:none;

}
#site-description{
    %c4%
    background:none;

}
#header-image{
    background-color:%custom_light_bg%!important;
}
#doc,#doc2,#doc3,#doc4{
    %c5%
}

#nav{
    %c3%
}
ul.nav{
    %c3%
}
ul.nav li a,ul.nav li a:link,ul.nav li a:visited{
    %c_%4
}
ul.nav li a:hover,ul.nav li a:active{
    %c4%
}
#sidebar{
    border-color:%rgba_border%;
}

.rsidebar{
}

.postmetadata{
    %c5%
}

ol.commentlist :hover{background:url(%images_path%latestbck.gif) repeat-x;}
ol.commentlist li :hover{background:none;}
ol.tblist li{background:transparent url(%images_path%c.gif) 0 2px no-repeat;}

#ft{
    %c3%
    border-top: medium solid %c_border%;
    background:url(%images_path%%tmn_footer_image%) repeat-x;
    %tmn_footer_color%
}


.footer-widget h2,.rsidebar h2,.lsidebar h2 {
    %c3%
    %h2_light_background%;
    %h_position_rsidebar_h2%
	
	-webkit-border-top-left-radius: 1em;
	-moz-border-radius-topleft: 1em;
	border-top-left-radius: 1em;
	-webkit-border-bottom-right-radius: 1em;
	-moz-border-radius-bottomright: 1em;
	border-bottom-right-radius: 1em;
}

a:link,a:active,a:visited,a:hover{
    %c5%
}
#hd h1 a:link,
#hd h1 a:active,
#hd h1 a:visited,
#hd h1 a:hover{
    %c4%
    background:none;
}

.rsidebar ul li ul li,
.lsidebar ul li ul li{
    border-bottom:1px solid %c_border%;
    border-bottom:1px solid %rgba_border%;
}

dl.author dd,
dl.author dt,
dl.my_tags dd,
dl.my_tags dt{
    border-bottom:1px solid %c_border%;
}

#items li{
    border-bottom:1px solid %c_border%;
}
.attachment .caption dd{
    border-bottom:1px solid %c_border%;
}
.attachment .caption dt{
    border-bottom:double 3px %c_border%;
}
ul.archive,
ul.index{
    margin:2em 0;
    border-bottom:1px solid %c_border%;
    border-bottom:1px solid %rgba_border%;

}
.sitemap.new li{
    border-bottom:1px solid %c_border%;
}
.social{
    border-top:3px double %c_border%;border-bottom:3px double %c_border%;
    border-bottom:3px double %c_border%;
    border-bottom:3px double %rgba_border%;
    border-top:3px double %rgba_border%;

}

ul.all_entry h2{
    border-bottom:3px double %c_border%;
}
ul.category li{
    border-bottom:1px solid %c_border%;
    border-bottom:1px solid %rgba_border%;

}
ul.sitemap ul li,
ul.archive ul li {
    border-bottom:1px solid %c_border%;
}
.blog .entry-utility li{
    border-bottom:1px solid %c_border%;
}
.mycomment{
    border-bottom:1px dashed %c_border%;
}
.blog .entry-utility li{
    border-bottom:1px solid %c_border%;
}

hr{
    border:none;
    border-top:1px solid %c_border%;
    border-top:1px solid %rgba_border%;

}
ul.archive li,
ul.index li{

}
.itiran{
    border:1px solid %c_border%;
}

#month_list,
#month_list td,
#year_list td,
#calendar_wrap td,
#date_list td{
    border:1px solid %c_border%;
    border:1px solid %rgba_border%!important;
}
td.month-date,td.month-name,td.time{
   %c_3%
    border-bottom:1px solid %c_border%;
    border:1px solid %rgba_border%;

}

td.month-date,td.month-name,td.time{
    %c3%
}

.footer-widget h2{
    background:none;

}
.entry-content blockquote{
    border-left:solid 3px %c_border%;

    background:#fefefe;
}
cite{
    background:#fefefe;
}

cite a:link,cite a:active,cite a:visited,cite a:hover{


}

cite a:link,cite a:active,cite a:visited,cite a:hover{

    %c4%
    background:none!important;
}
fieldset {
    border:1px solid %rgba_border%;
}
legend{
    %c5%
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
    box-shadow: 0 0 5px %rgba_border%;
    -webkit-box-shadow: 0 0 5px %rgba_border%;
    -moz-box-shadow: 0 0 5px %rgba_border%;
    border:1px solid %rgba_border%;
}
.social input[type="submit"] {
    border:double 3px %rgba_border%;
    background: %c4%
}

.entry-content td{
    %c4%
    border:solid 1px %rgba_border%;
}
.entry-content th{
    %c3%
    border:solid 1px %rgba_border%;
}
.entry-content input[type="submit"],
.entry-content input[type="reset"],
.entry-content input[type="file"]{
    border:double 3px %rgba_border%;
    background: %c4%
}
.entry-content input[type="checkbox"],
.entry-content input[type="radio"]{
    background: %c4%
    border:double 3px %rgba_border%;
}
.entry-content select{
    background: %c4%
    border:double 3px %rgba_border%;
}
.entry-content textarea{
    background: %rgba_border%
    border:double 3px %rgba_border%;
}
/*--------------------------------*/
#access{


    background: -webkit-gradient(linear, left top, left bottom, from(%custom_dark_bg%), to(%custom_light_bg%));
    background: -moz-linear-gradient(top,  %custom_dark_bg%,  %custom_light_bg%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='%custom_dark_bg%', endColorstr='%custom_light_bg%');
    border-radius:1em 1em 1em 1em;
    -moz-border-radius:1em 1em 1em 1em;
    -webkit-border-radius:1em 1em 1em 1em!important;
    border-top:1px solid rgba(255, 255, 255, 0.3);
    -moz-box-shadow: 1px 1px 3px #000;
    -webkit-box-shadow: 1px 1px 3px #000;

}
#access a {
    background: -webkit-gradient(linear, left top, left bottom, from(%custom_dark_bg%), to(%custom_light_bg%));
    background: -moz-linear-gradient(top,  %custom_dark_bg%,  %custom_light_bg%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='%custom_dark_bg%', endColorstr='%custom_light_bg%');
    color:%custom_color%;
}
#access ul ul a {
    %c3%
}

#access li:active > a,
#access ul ul :active > a {
    top:0;
    background: -webkit-gradient(linear, left top, left bottom, from(%custom_light_bg%), to(%custom_dark_bg%));
    background: -moz-linear-gradient(top,  %custom_light_bg%,  %custom_dark_bg%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='%custom_light_bg%', endColorstr='%custom_dark_bg%');
    color:%custom_color%;
}
#access ul li.current_page_item > a,
#access ul li.current-menu-ancestor > a,
#access ul li.current-menu-item > a,
#access ul li.current-menu-parent > a {
    %c3%
}
* html #access ul li.current_page_item a,
* html #access ul li.current-menu-ancestor a,
* html #access ul li.current-menu-item a,
* html #access ul li.current-menu-parent a,
* html #access ul li a:hover {
    %c2%
}
address{
    margin:10px auto;
}

h1,h2,h3,h4,h5,h6,#bd a,.postmetadata{background:none!important;}
.wp-caption {
   border:solid 1px %rgba_border%;
   -moz-border-radius: 3px;
   -khtml-border-radius: 3px;
   -webkit-border-radius: 3px;
   border-radius: 3px;
    background: -webkit-gradient(linear, left top, left bottom, from(%custom_dark_bg%), to(%custom_light_bg%));
    background: -moz-linear-gradient(top,  %custom_dark_bg%,  %custom_light_bg%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='%custom_dark_bg%', endColorstr='%custom_light_bg%');
}
