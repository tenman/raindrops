<?php
/**
 * Create individual stylesheet
 *
 * @package WordPress
 * @subpackage Raindrops
 * @since Raindrops 0.1
 */
/**
 * INDEX
 *
 * Color type w3standard
 * Color type dark
 * Color type minimal
 * Color type light
 *
 */
/**
 * Color type default
 *
 * blank style
 *
 *
 */
/**
 * Color type dark
 *
 *
 *
 *
 */

raindrops_register_styles( "dark" );

function raindrops_indv_css_dark() {

    $font_color_5 = raindrops_colors( -5, "color" );
	
	$raindrops_focus_style = apply_filters( 'raindrops_forcus_style',  'color:orange!important;');
	
    $style = <<<DOC
	

.raindrops-accessible-mode.rd-type-dark .raindrops-comment-link:focus em,
.enable-keyboard.rd-type-dark .raindrops-comment-link:focus em,
.ie11.enable-keyboard.rd-type-dark eess .sub-menu a:focus,
.ie11.enable-keyboard.rd-type-dark #access .children a:focus,
.enable-keyboard.rd-type-dark .hfeed a:focus,
.raindrops-accessible-mode.rd-type-dark .hfeed a:focus,
.ie11.raindrops-accessible-mode.rd-type-dark #access .sub-menu a:focus,
.ie11.raindrops-accessible-mode.rd-type-dark #access .children a:focus{
	$raindrops_focus_style
}
.widget_nav_menu.sticky-widget .sub-menu,
.widget_pages.sticky-widget .children,
.widget_nav_menu.sticky-widget .sub-menu a,
.widget_pages.sticky-widget .children a{
    width:12em;
    background:#000;
    color:#fff;

}
.topsidebar .widget_nav_menu.sticky-widget .sub-menu,
.topsidebar .widget_pages.sticky-widget .children{
     border:1px solid rgba(122,122,122,.5);
}
.widget_nav_menu.sticky-widget .sub-menu a,
.widget_pages.sticky-widget .children a{
    border-bottom:1px solid rgba(122,122,122,.5);
}

#access .sub-menu,
#access .children{
	border:1px solid #ccc;
	border:1px solid rgba(222,222,222,.5);
}
#access .sub-menu li a,
#access .children li a{
	border-bottom:1px solid #ccc;
	border-left:1px solid #ccc;
	border-bottom:1px solid rgba(222,222,222,.5);
	border-left:1px solid rgba(222,222,222,.5);
}
#access .sub-menu li:last-child > a,
#access .children li:last-child > a{
	border-bottom:none;
}
body{
    %c1%
}
#top,
legend,
#sidebar,
div[id^="doc"],
#hd,
h1,
div[id="yui-main"],
.entry ol ol ,.entry ul{
    %c_5%
}

a:link,
a:active,
a:visited,
a:hover,
#site-title,
.h1 a{
    color:$font_color_5;
    background:none;
}
h2 a{
    background:inherit;
}

.lsidebar,
#sidebar,
.rsidebar{
    %c_4%
}
.rsidebar option.level-0,
.lsidebar option.level-0,
.commentlist .pingback,
div[id^="comment-"],
.entry-content td,
cite a:link,cite a:active,cite a:visited,cite a:hover,
cite,
ul.nav li a,ul.nav li a:link,ul.nav li a:visited,
ul.nav li a:hover,ul.nav li a:active,
.entry-meta,
.blog .sticky
.home .sticky{
    %c_4%
}
.rsidebar option.level-1,
.lsidebar option.level-1{
    %c_3%
}
.rsidebar option.level-2,
.lsidebar option.level-2{
    %c_2%
}
.widget select,
input[type="file"],
input[type="reset"],
input[type="submit"],
.fail-search,
.error404,
#access ul li.current_page_item,
#access ul li.current-menu-ancestor > a,
#access ul li.current-menu-item > a,
#access ul li.current-menu-parent > a,
.searchform input[type="text"],
.social textarea#comment,
.social input[type="text"],
.hentry input[type="password"],
.entry-content blockquote,
td.month-date,td.month-name,td.time,
.footer-widget h2,.rsidebar h2,.lsidebar h2,
#ft #wp-calendar,
#ft,
#nav,
ul.nav{
    %c_3%
}
.ie6 #access ul li.current_page_item a,
.ie6 #access ul li.current-menu-ancestor a,
.ie6 #access ul li.current-menu-item a,
.ie6 #access ul li.current-menu-parent a,
.ie6 #access ul li a:hover {
    %c_2%
}
 
.current-cat{
	 %c_2%
}
input[type="file"],
input[type="reset"],
.social input[type="submit"],
input[type="submit"]{
    %c_3%
}

.blog .sticky,
.home .sticky,
.entry-meta{
    border-top:solid 2px %c_border%;
    border-bottom:solid 2px %c_border%;
}
.blog .sticky,
.home .sticky{
    border-top:solid 6px %c_border%;
}

#yui-main{
    /*1.303
		color:%raindrops_header_color%;
	*/
}

ol.tblist li{
    background:transparent url(%raindrops_images_path%c.gif) 0 2px no-repeat;
}
#ft{
    border-top: medium solid %c_border%;
    background-repeat:repeat-x;
    color:%raindrops_footer_color%;
}
#ft a{
     color:%raindrops_footer_link_color%; 
         background:none;
}
.footer-widget h2 span,.rsidebar h2 span,.lsidebar h2 span {
    %h2_dark_background%
    %h_position_rsidebar_h2%
}

.sticky-widget.widget_recent-post-groupby-cat .xoxo > li > ul >li,
.datetable td li,
.rsidebar ul li ul li,
.lsidebar ul li ul li,
.blog .entry-utility li,
.mycomment,
.blog .entry-utility li,
dl.author dd,
dl.author dt,
dl.my_tags dd,
dl.my_tags dt,
ul.category li,
ul.sitemap ul li,
ul.archive ul li,
ul.all_entry h2,
ul.archive,ul.index,
.sitemap.new li{
    border-bottom:1px solid %c_border%;
}
.rsidebar ul li ul li:last-child,
.lsidebar ul li ul li:last-child{
	border:none;
}

.ie6 .datetable td li,
.ie7 .datetable td li,
.ie8 .datetable td li{
    border-bottom:none;
    border-bottom:none;
}

hr{
    border:none;
    border-top:1px solid %c_border%;
}

#month_list,
#month_list td,
#raindrops_year_list td,
#calendar_wrap td,
#date_list td,
#month_list,
#month_list td,
#raindrops_year_list td,
#calendar_wrap td,
#date_list td,
fieldset,
/*.itiran,*/
#month_list,
#month_list td,
#raindrops_year_list td,
#calendar_wrap td,
#date_list td,
.searchform input[type="text"],
.searchform input[type="submit"],
.hentry input[type="password"],
#respond input[type="text"],
#respond textarea#comment,
.social textarea#comment,
.social input[type="text"],
.social input[type="submit"],
.entry-content input[type="email"],
.entry-content input[type="text"],
.entry-content input[type=url],
.entry-content input[type=tel],
.entry-content input[type=number],
.entry-content input[type=color],
.entry-content textarea,
.entry-content blockquote,
td.month-date,td.month-name,td.time{
    border:1px solid %c_border%;
}

.entry-content blockquote {
    border-left:solid 6px %c_border%;
}

li.byuser,
li.bypostauthor,
#respond input[type="text"]:focus,
#respond textarea#comment:focus,
.social textarea#comment:focus,
.social input:focus,
.entry-content th{
    %c_3%
}
.raindrops-comment-author-meta cite.fn,
li.byuser div.comment-body *,
li.byuser span.says{
    %c_3%
    background:none;
}

#respond input[type="text"],
#respond textarea#comment,
.searchform input[type="submit"],
.entry-content textarea,
.entry-content input[type="password"],
.entry-content input[type="text"],
.entry-content input[type="submit"],
.entry-content input[type="reset"],
.entry-content input[type="file"],
.entry-content input[type="checkbox"],
.entry-content input[type="radio"],
.entry-content input[type="email"],
.entry-content input[type="text"],
.entry-content input[type=url],
.entry-content input[type=tel],
.entry-content input[type=number],
.entry-content input[type=color],
.entry-content select{
    %c_4%
}
#access .children li ,
#access .children a {
    background:%custom_light_bg%;
    color:%custom_color%;
    z-index:999;
}
.raindrops-tab-content,
.raindrops-tab-page,
.raindrops-tab-list li{
    background:%custom_light_bg%;
    color:%custom_color%;
}



.reply,
.page .hentry .entry-title a,
cite.fn,
cite a:link,
cite a:active,
cite a:visited,
cite a:hover,
div.comment-body blockquote,
div.comment-body *,
div.comment-author,
div.comment-author-meta,
#site-description,
.home .sticky a,
.home .entry-meta a{
    color:$font_color_5;
    background:none;
}
.comment-author div.comment-meta a{
    color:$font_color_5;
    background:none;
}
.rd-page-navigation li{
border-left:solid 1px %c_border%;
    %c_4%
}
.rd-page-navigation .current_page_item{
    %c_4%
}
.current_page_item{
    %c_2%
}

.yui-main .rd-list-type-tree li:before {
    border-top:solid 1px %c_border%;
}
.yui-main .rd-list-type-tree:before, 
.yui-main .rd-list-type-tree ul:before {
    border-left:solid 1px %c_border%;
}
/* tinyMCE */
html .mceContentBody li:last-child:before,
.yui-main .rd-list-type-tree li:last-child:before,
.breadcrumbs li:last-child:before,
html .mceContentBody{
 %c_5%
}
	

DOC;

    $css3 = <<<CSS3

%gradient%

body{
    background: -webkit-gradient(linear, left top, left bottom, from(%custom_dark_bg%), to(%custom_light_bg%));
    background: -moz-linear-gradient(top, %custom_dark_bg%, %custom_light_bg%);
}
.rsidebar .eco-archive li,
.lsidebar .eco-archive li,
.rsidebar .eco-archive ul li:last-child,
.lsidebar .eco-archive ul li:last-child,
.nav-links .page-numbers{
     border:1px solid %rgba_border%;
}
	
.rsidebar .eco-archive li:hover,
.lsidebar .eco-archive li:hover{
	%c_2%;
}
.rsidebar .eco-archive  h3,
.lsidebar .eco-archive  h3{
    border-bottom:3px solid %rgba_border%;
}
.rsidebar .eco-archive  h3 a:active,
.lsidebar .eco-archive  h3 a:active,
.rsidebar .eco-archive  h3 a,
.lsidebar .eco-archive  h3 a{
    background: %rgba_border%;
}
.nav-links .page-numbers:hover{
	%c4%;
}
.nav-links .current{
    %c3%;
}
hr{
    border:none;
    border-top:1px solid %rgba_border%;
}

.blog .sticky,
.home .sticky,
.entry-meta{
    border-top:solid 2px %rgba_border%;
    border-bottom:solid 2px %rgba_border%;
}
.blog .sticky,
.home .sticky{
    border-top:solid 6px %rgba_border%;
}
.raindrops-extend-archive.sticky-widget .eco-archive.by-month .item,
.raindrops-extend-archive.sticky-widget .eco-archive.by-year .month,
.yui-b .sticky-widget.widget_archive li,
.yui-b .sticky-widget.widget_categories .cat-item,
.page .rd-border,
.post .rd-border,
.comment-body th,
.comment-body td,
.wp-caption,
.entry-content td,
.entry-content th{
    border:solid 1px %rgba_border%;
}
.datetable td li,
.rsidebar ul li ul li,
.lsidebar ul li ul li,
.blog .entry-utility li,
.mycomment,
.blog .entry-utility li,
dl.author dd,
dl.author dt,
dl.my_tags dd,
dl.my_tags dt,
ul.category li,
ul.sitemap ul li,
ul.archive ul li,
ul.all_entry h2,
ul.archive,ul.index,
.sitemap.new li{
    border-bottom:1px solid %rgba_border%;
}

.sticky-widget #wp-calendar tbody td,
.raindrops-toc-front li,
.widget select,
.rsidebar option,
.lsidebar option,
#month_list,
#month_list td,
#raindrops_year_list td,
#calendar_wrap td,
#date_list td,
#month_list,
#month_list td,
#raindrops_year_list td,
#calendar_wrap td,
#date_list td,
fieldset,
#month_list,
#month_list td,
#raindrops_year_list td,
#calendar_wrap td,
#date_list td,
.searchform input[type="text"],
.searchform input[type="submit"],
.hentry input[type="password"],
#respond input[type="text"],
#respond textarea#comment,
.social textarea#comment,
.social input[type="text"],
.social input[type="submit"],
.entry-content input[type="email"],
.entry-content input[type="text"],
.entry-content input[type=url],
.entry-content input[type=tel],
.entry-content input[type=number],
.entry-content input[type=color],
.entry-content blockquote,
td.month-date,td.month-name,td.time{
    border:1px solid %rgba_border%;
}
.searchform input:focus,
.searchform input:focus,
#respond input[type="text"]:focus,
#respond textarea#comment:focus,
.social textarea:focus,
.hentry input:focus,
.social input:focus{
    box-shadow: 0 0 5px %rgba_border%;
    -webkit-box-shadow: 0 0 5px %rgba_border%;
    -moz-box-shadow: 0 0 5px %rgba_border%;
}
kbd,
.searchform input[type="text"],
#respond input[type="text"],
#respond textarea#comment,
.social textarea#comment,
.hentry input[type="password"],
.social input[type="text"] {
    outline:none;
    transition: all 0.25s ease-in-out;
    -webkit-transition: all 0.25s ease-in-out;
    -moz-transition: all 0.25s ease-in-out;
    border-radius:3px;
    -webkit-border-radius:3px;
    -moz-border-radius:3px;
    border:1px solid rgba(203,203,203, 0.5);
}
.entry-content textarea{
    background: %rgba_border%
}
kbd,
.entry-content .more-link,
.sticky-widget #wp-calendar th,
.sticky-widget #wp-calendar tbody #today,
.sticky-widget #wp-calendar #prev a,
.sticky-widget #wp-calendar tbody td:hover,
.raindrops-excerpt-more,
.raindrops-toc-front li,
input[type="file"],
input[type="reset"],
.searchform input[type="submit"],
input[type="submit"],
#access{
    background: -webkit-gradient(linear, left top, left bottom, from(%custom_dark_bg%), to(%custom_light_bg%));
    background: -moz-linear-gradient(top, %custom_dark_bg%, %custom_light_bg%);
	background-image: -ms-linear-gradient(top, %custom_dark_bg%, %custom_light_bg%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='%custom_dark_bg%', endColorstr='%custom_light_bg%');
    border-radius:3px 3px 3px 3px;
    -moz-border-radius:3px 3px 3px 3px;
    -moz-box-shadow: 1px 1px 3px #000;
    -webkit-box-shadow: 1px 1px 3px #000;
    border-top:1px solid rgba(100,100,100,1);
}
.widget_calendar #today a,
.widget_calendar #today,
a.raindrops-comment-link em,
.entry-content input[type="submit"]{
    border: solid 1px %rgba_border%;
}

.raindrops-tab-list li,
/*#access .children li,*/
#access .focus a,
#access li:hover > ul{
    background: -webkit-gradient(linear, left top, left bottom, from(%custom_dark_bg%), to(%custom_light_bg%));
    background: -moz-linear-gradient(top, %custom_dark_bg%, %custom_light_bg%);
	background-image: -ms-linear-gradient(top, %custom_dark_bg%, %custom_light_bg%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='%custom_dark_bg%', endColorstr='%custom_light_bg%');
    color:%custom_color%;
}
#access li:hover > ul > ul{
    background:none;
	border:none;
}

.ie11 #access .sub-menu a,
.ie11 #access .children a {
color:%custom_color%;
    background: %custom_light_bg%!important;

}
.ie10 #access{
    background-image: -ms-linear-gradient(top, %custom_dark_bg%, %custom_light_bg%)!important;

}
.ie10 #access a {
    background-image: -ms-linear-gradient(top, %custom_dark_bg%, %custom_light_bg%);
}

.ie10 #access .children li:active >a,
.ie10 #access li:active >a ,
.ie10 #access ul ul :active >a{
    background-image: -ms-linear-gradient(top, %custom_light_bg%, %custom_dark_bg%);
}


.raindrops-tab-list li:active,
#access .children li:active,
#access li:active,
#access ul ul :active{
   top:0;
    background: -webkit-gradient(linear, left top, left bottom, from(%custom_light_bg%), to(%custom_dark_bg%));
    background: -moz-linear-gradient(top, %custom_light_bg%, %custom_dark_bg%);
	background-image: -ms-linear-gradient(top, %custom_light_bg%, %custom_dark_bg%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='%custom_light_bg%', endColorstr='%custom_dark_bg%');
    color:%custom_color%;
}

.widget_calendar #today a,
.widget_calendar #today,
a.raindrops-comment-link em,
.wp-caption {
    -moz-border-radius: 3px;
    -khtml-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    background: -webkit-gradient(linear, left top, left bottom, from(%custom_dark_bg%), to(%custom_light_bg%));
    background: -moz-linear-gradient(top, %custom_dark_bg%, %custom_light_bg%);
	background-image: -ms-linear-gradient(top, %custom_dark_bg%, %custom_light_bg%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='%custom_dark_bg%', endColorstr='%custom_light_bg%');
}
.entry-content blockquote {
    border-left:solid 6px %rgba_border%;
}

#access .menu > li{
    border-left:1px solid rgba( 222,222,222,.2);
}

#slides .slides_container,
.raindrops-tab-content,
.raindrops-tab-list li{
    border:1px solid rgba(200,200,200,0.3);
}
/*comment bubble*/
a.raindrops-comment-link {
}
.raindrops-comment-link em {
    %c_3%
    -moz-border-radius: 0.25em;
    -webkit-border-radius: 0.25em;
    border-radius: 0.25em;
    position: relative;
}
.raindrops-comment-link .point {
    border-left: 0.45em solid %rgba_border%;
    border-bottom: 0.45em solid #FFF; /* IE fix */
    border-bottom: 0.45em solid rgba(0,0,0,0);
    overflow: hidden; /* IE fix */
}

a.raindrops-comment-link:hover .point {
    border-left:1px solid %rgba_border%;
}
CSS3;
    return apply_filters( __FUNCTION__ , $style . $css3 );
}

?><?php

/**
 * Color type w3standard
 *
 *
 *
 *
 */
raindrops_register_styles( "w3standard" );

function raindrops_indv_css_w3standard() {
	
		$raindrops_focus_style = apply_filters( 'raindrops_forcus_style',  'background:orange!important;');
    $style = <<<DOC
.raindrops-accessible-mode .raindrops-comment-link:focus em,
.enable-keyboard .raindrops-comment-link:focus em,
.ie11.enable-keyboard #access .sub-menu a:focus,
.ie11.enable-keyboard #access .children a:focus,
.enable-keyboard .hfeed a:focus,
.ie11.raindrops-accessible-mode #access .sub-menu a:focus,
.ie11.raindrops-accessible-mode #access .children a:focus,
.raindrops-accessible-mode .hfeed a:focus{
	$raindrops_focus_style
}

.enable-keyboard #access li:hover >ul > li> a,
.raindrops-accessible-mode #access li:hover> ul>  li a,
#access .sub-menu li a,
#access .children li a{
    border:1px solid #696969;
	border-top:none;
}
.enable-keyboard #access li:hover >ul,
.raindrops-accessible-mode #access li:hover> ul,
#access .sub-menu:hover,
#access .children:hover{
    border-top:1px solid #696969;
}

.footer-widget h2 span,.rsidebar h2 span,.lsidebar h2 span {
    %c5%
    %h2_w3standard_background%
    %h_position_rsidebar_h2%
}
	
.widget_nav_menu.sticky-widget .sub-menu,
.widget_pages.sticky-widget .children,
.widget_nav_menu.sticky-widget .sub-menu a,
.widget_pages.sticky-widget .children a{
    background:#fff;
    color:#000;
}
.topsidebar .widget_nav_menu.sticky-widget .sub-menu,
.topsidebar .widget_pages.sticky-widget .children{
     border:1px solid rgba(122,122,122,.5);
}
.widget_nav_menu.sticky-widget .sub-menu a,
.widget_pages.sticky-widget .children a{
    border-bottom:1px solid rgba(122,122,122,.5);
}
	
#access .menu li:first-child,
#access .menu .menu-item-has-children,
#access .menu li:last-child{
   border-right:1px solid #fff;    
}
body {
%c4%
    margin:0!important;padding:0;
    background-repeat:repeat-x;
}
.raindrops-extend-archive.sticky-widget .eco-archive.by-month .item,
.raindrops-extend-archive.sticky-widget .eco-archive.by-year .month,
.yui-b .sticky-widget.widget_archive li,
.yui-b .sticky-widget.widget_categories .cat-item,
.nav-links .page-numbers{
     border:1px solid #ccc;
}
.nav-links .page-numbers:hover{
	%c4%;
}
.nav-links .current{
    %c5%;
}
#yui-main{
	 /*1.303
    color:%raindrops_header_color%;
	*/
}
#hd{
  /*  background-image:url(%raindrops_hd_images_path%%raindrops_header_image%);*/
}
.yui-main .rd-list-type-tree li:before {
    border-top:solid 1px %c_border%;
}
.yui-main .rd-list-type-tree:before, 
.yui-main .rd-list-type-tree ul:before {
    border-left:solid 1px %c_border%;
}
/* tinyMCE */
html .mceContentBody li:last-child:before,
.yui-main .rd-list-type-tree li:last-child:before,
.breadcrumbs li:last-child:before,
html .mceContentBody,
.hfeed{
    background:#fff;
}
#ft {
    background:url(%raindrops_images_path%%raindrops_footer_image%) repeat-x;
    color:%raindrops_footer_color%;
}
#ft a{
     color:%raindrops_footer_link_color%;           
}

.footer-widget h2 span,
.rsidebar h2 span,
.lsidebar h2 span{
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
.blog .sticky,
.home .sticky {
    %c5%
    border-top:solid 6px %c_border%;
    border-bottom:solid 2px %c_border%;
}
.entry-meta{
    %c5%
    border-top:dashed 1px %c_border%;
    border-bottom:dashed 1px %c_border%;
}
textarea,
input[type="password"],
input[type="text"],
input[type="submit"],
input[type="reset"],
input[type="file"]{
    %c5%
}
input[type="checkbox"],
input[type="radio"],
select{
    %c4%
}
.social input[type="submit"],
#respond input[type="text"],
#respond textarea#comment,
.social textarea#comment,
.social input[type="text"] {
    outline:none;
    background:#fff;
	color:#333;
	border:solid 1px %c_border%;
}
#respond input[type="text"]:focus,
#respond textarea#comment:focus,
.social textarea#comment:focus,
.social input:focus{
    %c5%

}
.page .rd-border,
.post .rd-border,
kbd,
.sticky-widget #wp-calendar tbody td,
.raindrops-toc-front li,
.entry-content input[type="email"],
.entry-content input[type="text"],
.entry-content input[type=url],
.entry-content input[type=tel],
.entry-content input[type=number],
.entry-content input[type=color]{
    border:1px solid %rgba_border%;
}
.entry-content input[type="submit"],
.entry-content input[type="reset"],
.entry-content input[type="file"]{
    %c5%
}

.entry-content input[type="radio"]{
    %c3%
}
.sticky-widget #wp-calendar th,
.sticky-widget #wp-calendar tbody #today,
.sticky-widget #wp-calendar #prev,
.sticky-widget #wp-calendar tbody td:hover,
.raindrops-toc-front li,
.entry-content input[type="email"],
.entry-content input[type="text"],
.entry-content input[type="url"],
.entry-content input[type="tel"],
.entry-content input[type="number"],
.entry-content input[type="color"],
.entry-content select{
    %c5%
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
    %c4%
}
.entry-content fieldset {
    border:solid 1px %c_border%;
}
.entry-content legend{
    %c5%
}
.comment-body td,
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
    %c5%
}

#access ul ul a {
    %c4%
}

#access li:active > a,
#access ul ul :active > a {
    top:0;
    %c2%
    color:%custom_color%
}
#access ul li.current_page_item,
#access ul li.current-menu-ancestor > a,
#access ul li.current-menu-item > a,
#access ul li.current-menu-parent > a {
    %c4%
}
.ie6 #access ul li.current_page_item a,
.ie6 #access ul li.current-menu-ancestor a,
.ie6 #access ul li.current-menu-item a,
.ie6 #access ul li.current-menu-parent a,
.ie6 #access ul li a:hover {
    %c3%
}

.current-cat{
	 %c5%
}
table,
table td,
#access > li{
    border:1px solid #ccc;

}
tfoot td{
    border:none;
}
.lsidebar li,
.rsidebar li{
    border:none!important;
}

td.month-date,td.month-name,td.time{
    %c4%

}

address{
    margin:10px auto;
}
li.byuser,
li.bypostauthor {
    %c5%
}
.comment-meta a,
cite.fn{
    background:none;
}


.error404 {
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
.raindrops-comment-link em {
    %c4%
    position: relative;
}
	
.widget_calendar #today a,
.widget_calendar #today,
a.raindrops-comment-link:hover em {
    %c_1%
}
a.raindrops-comment-link:hover .point {
    border-left:1px solid %c_border%;
}
.rsidebar .eco-archive  h3,
.lsidebar .eco-archive  h3{
    border-bottom:3px solid %rgba_border%;
}
.rsidebar .eco-archive  h3 a:active,
.lsidebar .eco-archive  h3 a:active,
.rsidebar .eco-archive  h3 a,
.lsidebar .eco-archive  h3 a{
    background: %rgba_border%;
}
.lsidebar .widgettitle,
.rsidebar .widgettitle{
	font-weight:700;
	padding:.5em 0;
	margin:.7em 0;
}
.rsidebar .widget  .post-group_by-category-title,
.lsidebar .widget  .post-group_by-category-title{
	border-bottom:3px solid %rgba_border%;
}
.rsidebar .widget  .post-group-by-category-title li,
.lsidebar .widget  .post-group-by-category-title li,
.rsidebar .widget  .post-group-by-category-title,
.lsidebar .widget  .post-group-by-category-title{
    list-style-type:none;
}


DOC;
    
	 return apply_filters( __FUNCTION__ , $style );
}

?>
<?php

/**
 * Color type light
 *
 *
 *
 *
 */
raindrops_register_styles( "light" );

function raindrops_indv_css_light() {

    $font_color5 = raindrops_colors( 5, "color" );
	$raindrops_focus_style = apply_filters( 'raindrops_forcus_style',  'color:red!important;');
    $style = <<<DOC
.raindrops-accessible-mode .raindrops-comment-link:focus em,
.enable-keyboard .raindrops-comment-link:focus em,
.ie11.enable-keyboard #access .sub-menu a:focus,
.ie11.enable-keyboard #access .children a:focus,
.enable-keyboard .hfeed a:focus,
.ie11.raindrops-accessible-mode #access .sub-menu a:focus,
.ie11.raindrops-accessible-mode #access .children a:focus,
.raindrops-accessible-mode .hfeed a:focus{
	$raindrops_focus_style
}
	
.widget_nav_menu.sticky-widget .sub-menu,
.widget_pages.sticky-widget .children,
.widget_nav_menu.sticky-widget .sub-menu a,
.widget_pages.sticky-widget .children a{
    %c5%
}
.topsidebar .widget_nav_menu.sticky-widget .sub-menu,
.topsidebar .widget_pages.sticky-widget .children{
     border:1px solid rgba(105,105,105,.5);
}
.widget_nav_menu.sticky-widget .sub-menu a,
.widget_pages.sticky-widget .children a{
    border-bottom:1px solid rgba(105,105,105,.5);
}

 a:link,
 a:active,
 a:visited,
 a:hover,
#site-title,
.h1 a{
      color:$font_color5;
 background:none;
}
         
h2 a{
    background:inherit;
}
.footer-widget h2 span,.rsidebar h2 span,.lsidebar h2 span{
    %h2_light_background%;
    %h_position_rsidebar_h2%
}

body{
    margin:0!important;
    %c4%
}
.rsidebar .eco-archive li,
.lsidebar .eco-archive li,
.nav-links .page-numbers{
    border:1px solid rgba(105,105,105,.5);
}
.nav-links .page-numbers:hover{
	%c4%;
}
.nav-links .current{
    %c_2%;
}
#top,
.hfeed{
    %c5%
}
.blog .sticky,
.home .sticky {
    %c4%
}
.entry-meta{
    %c5%
}
.blog .sticky,
.home .sticky a{
    background-color: none;

}
#yui-main{
   /*1.303
	   color:%raindrops_header_color%;
		   */
}

.entry ol ol ,.entry ul {
    %c5%
}
/* @1.334
.entry ul *{
    %c5%
}
*/

#hd{
    %c5%
    border-top: 6px solid %c_border%;
/*    background-image:url(%raindrops_hd_images_path%%raindrops_header_image%);
    background-position:0 -5px;*/

}
#hd h1,.h1,#site-title{
    %c4%
    background:none;
}
#site-description{
    %c4%
    background:none;
}
.yui-main .rd-list-type-tree li:before{
    border-top:solid 1px %c_border%;
}
.yui-main .rd-list-type-tree:before,
.yui-main .rd-list-type-tree ul:before{
	border-left:solid 1px %c_border%;
}
/* tinyMCE */
html .mceContentBody li:last-child:before,
.yui-main .rd-list-type-tree li:last-child:before,
.breadcrumbs li:last-child:before,
html .mceContentBody,	
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
    %c4%
}
ul.nav li a:hover,ul.nav li a:active{
    %c4%
}
ol.tblist li{
    background:transparent url(%raindrops_images_path%c.gif) 0 2px no-repeat;
}

#ft{
    %c3%;
    border-top: medium solid %c_border%;
 /*   background:url(%raindrops_images_path%%raindrops_footer_image%) repeat-x;*/
    color:%raindrops_footer_color%;
}
#ft a{
     color:%raindrops_footer_link_color%;           
}

.rsidebar ul li ul li,
.lsidebar ul li ul li{
    border-bottom:1px solid %c_border%;

}
.rsidebar ul li ul li:last-child,
.lsidebar ul li ul li:last-child{
	border:none;
}
.lsidebar h2.widgettitle,
.rsidebar h2.widgettitle{
    text-indent:0;
}
dl.author dd,
dl.author dt,
dl.my_tags dd,
dl.my_tags dt{
    border-bottom:1px solid %c_border%;
}
ul.archive,
ul.index{
    margin:2em 0;
    border-bottom:1px solid %c_border%;
}
.sitemap.new li{
    border-bottom:1px solid %c_border%;
}
ul.all_entry h2{
    border-bottom:3px double %c_border%;
}
ul.category li{
    border-bottom:1px solid %c_border%;
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
table,
table td{
    border:1px solid %c_border%;
}

td.month-date,td.month-name,td.time{
    %c4%
    border-bottom:1px solid %c_border%;
}
.entry-content blockquote{
    border-left:solid 3px %c_border%;
    background:#fefefe;
}
cite{
    background:#fefefe;
}
cite a:link,cite a:active,cite a:visited,cite a:hover{
    %c4%
    background:none!important;
}
legend{
    %c5%
}
hr{
    border-top:1px dashed %c_border%;
}
textarea,
input[type="password"],
input[type="text"],
input[type="submit"],
input[type="reset"],
input[type="file"]{
    background:#fff;
	color:#333;
}
input[type="checkbox"],
input[type="radio"],
select{
    %c4%
}
#respond input[type="text"]:focus,
#respond textarea#comment:focus,
.social textarea#comment:focus,
.social input[type="text"]:focus{
    border:1px solid %c_border%;
}

.entry-content input[type="email"],
.entry-content input[type="text"],
.entry-content input[type=url],
.entry-content input[type=tel],
.entry-content input[type=number],
.entry-content input[type=color],
.social input[type="submit"] {
    border:solid 1px %c_border%;
    %c4%
}
.entry-content th{
    %c3%
    border:solid 1px %c_border%;
}
.entry-content input[type="submit"],
.entry-content input[type="reset"],
.entry-content input[type="file"]{
    border:double 3px %c_border%;
    %c4%
}
.entry-content input[type="checkbox"],
.entry-content input[type="radio"]{
    %c4%
    border:double 3px %c_border%;
}
.entry-content input[type="email"],
.entry-content input[type="text"],
.entry-content input[type="url"],
.entry-content input[type="tel"],
.entry-content input[type="number"],
.entry-content input[type="color"],
.entry-content select{
    %c4%
    border:solid 1px %c_border%;
}

.entry-content textarea{
    border:solid 1px %c_border%;
}

/*--------------------------------*/

#access .children li:active >a,
#access li:active >a ,
#access ul ul :active >a{
    top:0;
}

.ie6 #access ul li.current_page_item a,
.ie6 #access ul li.current-menu-ancestor a,
.ie6 #access ul li.current-menu-item a,
.ie6 #access ul li.current-menu-parent a,
.ie6 #access ul li a:hover {
    %c2%
}

.current-cat{
	 %c4%
}
address{
    margin:10px auto;
}


.wp-caption {
    border:solid 1px #999;
}
cite.fn{
    background:none;
}

.error404 {
    %c4%
    border:3px double %c_border%;
}
.rd-page-navigation li{
    border-left:solid 1px %c_border%;
    %c4%
}
.rd-page-navigation a{
    %c4%
}
	
.rd-page-navigation .current_page_item{
    %c5%
}
.raindrops-tab-content,
.raindrops-tab-list li{
    border:1px solid %c_border%;
}

DOC;


    $css3 = <<<CSS3

%gradient%
kbd,
.hfeed{
    box-shadow: 0 0 5px %rgba_border%;
    -webkit-box-shadow: 0 0 5px %rgba_border%;
    -moz-box-shadow: 0 0 5px %rgba_border%;

}
.blog .sticky,
.home .sticky {
    border-top:solid 6px %rgba_border%;
    border-bottom:solid 2px %rgba_border%;
}
.entry-meta{
    border-top:solid 1px %rgba_border%;
    border-bottom:solid 1px %rgba_border%;
}
.rsidebar .eco-archive li,
.lsidebar .eco-archive li,
.rsidebar .eco-archive ul li:last-child,
.lsidebar .eco-archive ul li:last-child{
      border:1px solid %rgba_border%;
}
.rsidebar .eco-archive li:hover,
.lsidebar .eco-archive li:hover{
	%c4%;
}
.rsidebar .eco-archive  h3,
.lsidebar .eco-archive  h3{
    border-bottom:3px solid %rgba_border%;
}
.rsidebar .eco-archive  h3 a:active,
.lsidebar .eco-archive  h3 a:active,
.rsidebar .eco-archive  h3 a,
.lsidebar .eco-archive  h3 a{
    background: %rgba_border%;
}
.rsidebar ul li ul li,
.lsidebar ul li ul li{
    border-bottom:1px solid %rgba_border%;
}
.sticky-widget.widget_recent-post-groupby-cat .xoxo > li > ul >li,
dl.author dd,
dl.author dt,
dl.my_tags dd,
dl.my_tags dt{
    border-bottom:1px solid %rgba_border%;

}
ul.index{
    border-bottom:1px solid %rgba_border%;

}
ul.category li{
    border-bottom:1px solid %rgba_border%;

}
.raindrops-extend-archive.sticky-widget .eco-archive.by-month .item,
.raindrops-extend-archive.sticky-widget .eco-archive.by-year .month,
.yui-b .sticky-widget.widget_archive li,
.yui-b .sticky-widget.widget_categories .cat-item,
kbd,
table td,
td.month-date,td.month-name,td.time,
fieldset {
    border:1px solid %rgba_border%;
}
hr{
    border-top:1px dashed %rgba_border%;
}
#respond input[type="text"],
#respond textarea#comment,
.social textarea#comment,
.social input[type="text"]{
    outline:none;
    transition: all 0.25s ease-in-out;
    -webkit-transition: all 0.25s ease-in-out;
    -moz-transition: all 0.25s ease-in-out;
    border-radius:3px;
    -webkit-border-radius:3px;
    -moz-border-radius:3px;
    border:1px solid rgba(0,0,0, 0.2);
}
.social textarea#comment:focus,
.social input[type="text"]:focus{
    box-shadow: 0 0 5px %rgba_border%;
    -webkit-box-shadow: 0 0 5px %rgba_border%;
    -moz-box-shadow: 0 0 5px %rgba_border%;
    border:1px solid %rgba_border%;
	%c5%
}
.sticky-widget #wp-calendar th,
.sticky-widget #wp-calendar tbody #today,
.sticky-widget #wp-calendar #prev,
.sticky-widget #wp-calendar tbody td:hover,
.raindrops-toc-front li,
.entry-content input[type="email"],
.entry-content input[type="text"],
.entry-content input[type=url],
.entry-content input[type=tel],
.entry-content input[type=number],
.entry-content input[type=color],
.social input[type="submit"]{
    border:1px solid %rgba_border%;
}
.page .rd-border,
.post .rd-border,
.entry-content th{
    border:solid 1px %rgba_border%;
}
.entry-content input[type="submit"],
.entry-content input[type="reset"],
.entry-content input[type="file"]{
    border:solid 1px %rgba_border%;
}
.entry-content input[type="checkbox"],
.entry-content input[type="radio"]{
    border:solid 1px %rgba_border%;
}

.entry-content select{
    border:solid 1px %rgba_border%;
}

.entry-content textarea{
    background: %rgba_border%;
    border:solid 1px %rgba_border%;
}
.raindrops-extend-archive.sticky-widget .eco-archive.by-month .item,
.raindrops-extend-archive.sticky-widget .eco-archive.by-year .month,
.yui-b .sticky-widget.widget_archive li,
.yui-b .sticky-widget.widget_categories .cat-item,
kbd,
.sticky-widget #wp-calendar th,
.sticky-widget #wp-calendar tbody #today,
.sticky-widget #wp-calendar #prev,
.sticky-widget #wp-calendar tbody td:hover,
.entry-content .more-link,
.raindrops-excerpt-more,
.raindrops-toc-front li,
#access{
	background-image: -ms-linear-gradient(top, %custom_dark_bg%, %custom_light_bg%);
    background: -webkit-gradient(linear, left top, left bottom, from(%custom_dark_bg%), to(%custom_light_bg%));
    background: -moz-linear-gradient(top, %custom_dark_bg%, %custom_light_bg%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='%custom_dark_bg%', endColorstr='%custom_light_bg%');
    border-radius:3px 3px 3px 3px;
    -moz-border-radius:3px 3px 3px 3px;
    -webkit-border-radius:3px 3px 3px 3px;
    border-top:1px solid rgba(255, 255, 255, 0.3);
    -moz-box-shadow: 0 1px 3px #333;
    -webkit-box-shadow: 0 1px 3px #333;
	box-shadow: 0 1px 3px #333;
}

#access .focus a,
#access li:hover > ul,
#access a {
	background-image: -ms-linear-gradient(top, %custom_dark_bg%, %custom_light_bg%);
    background: -webkit-gradient(linear, left top, left bottom, from(%custom_dark_bg%), to(%custom_light_bg%));
    background: -moz-linear-gradient(top, %custom_dark_bg%, %custom_light_bg%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='%custom_dark_bg%', endColorstr='%custom_light_bg%');
    color:%custom_color%;
}
.widget_calendar #today a,
.widget_calendar #today,
a.raindrops-comment-link em,
#access ul li.current_page_item,
#access ul li.current-menu-ancestor > a,
#access ul li.current-menu-item > a,
#access ul li.current-menu-parent > a,
.raindrops-tab-list li,
#access .children li:active >a,
#access li:active >a ,
#access ul ul :active >a {
    background: -webkit-gradient(linear, left top, left bottom, from(%custom_light_bg%), to(%custom_dark_bg%));
    background: -moz-linear-gradient(top, %custom_light_bg%, %custom_dark_bg%);
    color:%custom_color%;
}
.ie10 #access{
    background-image: -ms-linear-gradient(top, %custom_dark_bg%, %custom_light_bg%);

}
.ie10 #access a {
    background-image: -ms-linear-gradient(top, %custom_dark_bg%, %custom_light_bg%);
}
.ie10 #access .children li:active >a,
.ie10 #access li:active >a ,
.ie10 #access ul ul :active >a{
    background-image: -ms-linear-gradient(top, %custom_light_bg%, %custom_dark_bg%);
}
.page .rd-border,
.post .rd-border,
.widget_calendar #today a,
.widget_calendar #today,
a.raindrops-comment-link em,
.wp-caption {
    border:solid 1px %rgba_border%;
    -moz-border-radius: 3px;
    -khtml-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius:0 0 3px 3px;
}
.wp-caption{
    padding:0;
}
.datetable td li{
    border-bottom:solid 1px %rgba_border%;
}
#sidebar{
    border-color:%rgba_border%;
}
table,
table td{
    border:1px solid %rgba_border%;
}
.raindrops-tab-content,
.raindrops-tab-list li{
border:1px solid %c_border%;
    border:1px solid %rgba_border%;
}

.raindrops-comment-link em {
    %c4%
    -moz-border-radius: 0.25em;
    -webkit-border-radius: 0.25em;
    border-radius: 0.25em;
    position: relative;
}
.raindrops-comment-link .point {
    border-left: 0.45em solid %rgba_border%;
    border-bottom: 0.45em solid #FFF; /* IE fix */
    border-bottom: 0.45em solid rgba(0,0,0,0);
    overflow: hidden; /* IE fix */
}

a.raindrops-comment-link:hover .point {
    border-left:1px solid %rgba_border%;
}
#bd .raindrops-lightbox-overlay a{
    background:#fff!important;
}

.footer-widget>ul>li{
    border-bottom:1px solid %rgba_border%;
}
#header-image p{
   /* 
	* 1.295 commentout
	text-shadow: 2px 2px 2px #fff;*/
}

#access .sub-menu,
#access .children{
	border:1px solid #ccc;
	border:1px solid rgba( 156,156,156,.7);
}
#access .sub-menu li a,
#access .children li a{
	border-bottom:1px solid #ccc;
	border-left:1px solid #ccc;
	border-bottom:1px solid rgba( 156,156,156,.7);
	border-left:1px solid rgba( 156,156,156,.7);
}
#access .sub-menu li:last-child > a,
#access .children li:last-child > a{
	border-bottom:none;
}	

CSS3;

	 return apply_filters( __FUNCTION__ , $style . $css3 );
}

?>
<?php

/**
 * Color type minimal
 *
 *
 *
 *
 */
raindrops_register_styles( "minimal" );

function raindrops_indv_css_minimal() {
    global $raindrops_base_color;
	
    $font_color = raindrops_colors( 5, "color" );
	$raindrops_focus_style = apply_filters( 'raindrops_forcus_style',  'background:#efefef!important;');
    $style = <<<CSS
.sticky-widget #wp-calendar tbody #today,
.raindrops-accessible-mode .raindrops-comment-link:focus em,
.enable-keyboard .raindrops-comment-link:focus em,
.ie11.enable-keyboard #access .sub-menu a:focus,
.ie11.enable-keyboard #access .children a:focus,
.enable-keyboard .hfeed a:focus,
.ie11.raindrops-accessible-mode #access .sub-menu a:focus,
.ie11.raindrops-accessible-mode #access .children a:focus,
.raindrops-accessible-mode .hfeed a:focus{
	$raindrops_focus_style
}
.rsidebar .eco-archive li,
.lsidebar .eco-archive li,
.rsidebar .eco-archive ul li:last-child,
.lsidebar .eco-archive ul li:last-child{
     border:1px solid %rgba_border%;
}
	
.rsidebar .eco-archive li:hover,
.lsidebar .eco-archive li:hover{
	%c5%;
}
.raindrops-extend-archive.sticky-widget .eco-archive.by-month .item,
.raindrops-extend-archive.sticky-widget .eco-archive.by-year .month,
.yui-b .sticky-widget.widget_archive li,
.yui-b .sticky-widget.widget_categories .cat-item,
.sticky-widget #wp-calendar th,
.sticky-widget #wp-calendar tbody #today,
.sticky-widget #wp-calendar #prev,
.sticky-widget #wp-calendar tbody td{
   border:1px solid #696969;
	border:1px solid rgba(105,105,105,.5);	
}
	
.widget_nav_menu.sticky-widget .sub-menu,
.widget_pages.sticky-widget .children,
.widget_nav_menu.sticky-widget .sub-menu a,
.widget_pages.sticky-widget .children a{
    color:#000;
	background:#fff;
}
.topsidebar .widget_nav_menu.sticky-widget .sub-menu,
.topsidebar .widget_pages.sticky-widget .children{
     border:1px solid rgba(105,105,105,.5);
}
.widget_nav_menu.sticky-widget .sub-menu a,
.widget_pages.sticky-widget .children a{
    border-bottom:1px solid rgba(105,105,105,.5);
}
.enable-keyboard #access li:hover >ul > li> a,
.raindrops-accessible-mode #access li:hover> ul>  li a,
#access .sub-menu li a,
#access .children li a{
    border:1px solid #696969;
	border:1px solid rgba(105,105,105,.5);
	border-top:none;
}
.enable-keyboard #access li:hover >ul,
.raindrops-accessible-mode #access li:hover> ul,
#access .sub-menu:hover,
#access .children:hover{
    border-top:1px solid #696969;
	border-top:1px solid rgba(105,105,105,.5);

}

#access .menu > li{
    border-left:1px solid #ccc;
    border-left:1px solid rgba( 156,156,156,.7);
}
 #access .menu > li:last-child{
    border-right:1px solid #ccc;
    border-right:1px solid rgba( 156,156,156,.7);
}
 #access .menu li:first-child a,
 #access .menu li:last-child a{
    border:none;
}

/* tinyMCE */

html .mceContentBody,
body{
    border-top:6px solid $raindrops_base_color;
}
.nav-links .page-numbers{
    border:1px solid rgba(105,105,105,.7);
}
.nav-links .page-numbers:hover{
	%c4%;
}
.widget_calendar #today a,
.widget_calendar #today,
.nav-links .current{
    %c_2%;
}
a{
    color:$font_color;
}
a:hover{
    color:#777;
}
#yui-main{

	/* color:%raindrops_header_color%; */
		   
}
#ft{
	/* %c5% */
	}
#ft a{
     color:%raindrops_footer_link_color%;           
}
.footer-widget h2,
.rsidebar h2,
.lsidebar h2,
.widgettitle h2,
h2.footer-content {
    text-indent:0;
}
input[type="submit"],
.social input[type="submit"]{
    border:1px solid rgba(105,105,105,.7);
}
/*comment bubble*/

.raindrops-comment-link em {
    %c4%
    -moz-border-radius: 0.25em;
    -webkit-border-radius: 0.25em;
    border-radius: 0.25em;
    position: relative;
}
.raindrops-comment-link .point {
    border-left: 0.45em solid %rgba_border%;
    border-bottom: 0.45em solid #FFF; /* IE fix */
    border-bottom: 0.45em solid rgba(0,0,0,0);
    overflow: hidden; /* IE fix */
}

a.raindrops-comment-link:hover em {
    %c_1%
}
a.raindrops-comment-link:hover .point {
    border-left:1px solid %rgba_border%;
}
.page .rd-border,
.post .rd-border{
	border:1px solid %rgba_border%;
}

kbd,
input[type="email"],
.raindrops-toc-front li,
input[type="text"],
textarea#comment{
    border:1px solid #ddd;
    border-top-color:%rgba_border%;
    border-left-color:%rgba_border%;
    padding:3px;
    -moz-border-radius: 3px;
    -khtml-border-radius: 3px;
    -webkit-border-radius: 3px;
}
#access .children,
#access .children li{
    border-top:none;
}
#access .children li:nth-child(1){
	border-top:1px solid #ccc;
}
#access .sub-menu a,
#access .children a,
#access .children .current_page_item a{
    text-align:left;
    padding:10px;
    background:#fff;
    border-left-color:%rgba_border%;
}
.raindrops-toc-front li,
#access .sub-menu a:hover,
#access .children a:hover,
#access .children .current_page_item a:hover{
	%c4%
}

blockquote{
    border-left:6px solid;
    border-left-color:%rgba_border%;
    padding:10px;
    %c5%
}

kbd,
.current-cat{
	 %c5%
}
hr{
    border-top:1px solid %rgba_border%;
}
/* @1.345 start */
.rsidebar ul li ul li,
.lsidebar ul li ul li{
    list-style-type:square;
    list-style-position:inside;
	line-height:2;
}
.entry-content table{
	 border-top:1px solid %rgba_border%;
	 border-bottom:1px solid %rgba_border%;
	border-collapse: collapse;
}
.entry-content th,
.entry-content td{
	padding:.7em .5em;
	 border-bottom:1px dashed %rgba_border%;
}
.entry-content tfoot{
	 border-top:1px dashed %rgba_border%;
	font-weight:bold;
}
.entry-content thead,
.entry-content tfoot{
	%c5%;
}
.entry-content tr:last-child td{
	border:none;
}
#raindrops.rd-type-minimal a{
	
}
.entry-meta .edit-link,
.entry-meta .post-format-text + a,
.post-tag a span,
.post-category a span{
	 border:1px solid rgba(127,127,127,.3);
	padding:.2em .3em;
	line-height:2.4;
}
#raindrops.rd-type-minimal a:hover{
	 color:rgba(41, 128, 185,1.0);
}
.rd-type-minimal #access .menu > li{
	border:none;
}
.rd-type-minimal #access a:hover{
	color:rgba(255, 255, 255,1.0);
	background:#000;
}
/* @1.345 end */
.lsidebar .widgettitle,
.rsidebar .widgettitle{
	font-weight:700;
	padding:.5em 0;
	margin:.7em 0;
}
.rsidebar .widget  .post-group-by-category-title li,
.lsidebar .widget  .post-group-by-category-title li,
.rsidebar .widget  .post-group-by-category-title,
.lsidebar .widget  .post-group-by-category-title{
    list-style-type:none;
}
.rsidebar .widget  .post-group-by-category-title li,
.lsidebar .widget  .post-group-by-category-title li{
	border-bottom:1px solid %rgba_border%;
}

.rsidebar .widget  .post-group-by-category-title h3,
.lsidebar .widget  .post-group-by-category-title h3,	
.rsidebar .eco-archive  h3,
.lsidebar .eco-archive  h3{
    border-bottom:3px solid %rgba_border%;
}
.rsidebar .eco-archive  h3 a:active,
.lsidebar .eco-archive  h3 a:active,
.rsidebar .eco-archive  h3 a,
.lsidebar .eco-archive  h3 a{
    background: %rgba_border%;
}	
CSS;


 return apply_filters( __FUNCTION__ , $style  );

}

?>
<?php

/**
 *
 *
 *
 *
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
do_action( 'raindrops_extend_style_type' );

global $raindrops_wp_version, $raindrops_current_theme_name,$raindrops_current_theme_slug,$raindrops_setting_type;

$alias_functions = get_stylesheet_directory() . '/lib/alias_functions.php';

$raindrops_included_files = get_included_files();

if ( !in_array( $alias_functions, $raindrops_included_files ) ) {

    locate_template( array( 'lib/alias_functions.php' ), true, true );
}
if ( isset( $raindrops_current_theme_name ) ) {
	$raindrops_embed_common_style = $raindrops_current_theme_name;
} else {
	$boots_current_theme_data	  = wp_get_theme();
	$raindrops_embed_common_style = $boots_current_theme_data->get( 'Name' );
}
/* 1.303 */
if( function_exists( 'raindrops_indv_css_'.$raindrops_embed_common_style) ) {
	
	raindrops_register_styles( $raindrops_embed_common_style );
}

$raindrops_images_path = get_stylesheet_directory_uri() . '/images/';

if ( !file_exists( $raindrops_images_path ) ) {

    get_template_directory() . '/images/';
}

$raindrops_base_color   = raindrops_warehouse_clone( 'raindrops_base_color' );
$style_type             = raindrops_warehouse_clone( 'raindrops_style_type' );
$navigation_title_img   = raindrops_warehouse_clone( 'raindrops_heading_image' );
$position_y             = raindrops_warehouse_clone( 'raindrops_heading_image_position' );
$raindrops_header_image = raindrops_warehouse_clone( 'raindrops_header_image' );
$raindrops_header_color = raindrops_warehouse_clone( 'raindrops_default_fonts_color' );
$raindrops_footer_image = raindrops_warehouse_clone( 'raindrops_footer_image' );
$raindrops_footer_color = raindrops_warehouse_clone( 'raindrops_footer_color' );
$raindrops_footer_color = raindrops_warehouse_clone( 'raindrops_footer_link_color' );

//define("BASE_COLOR1",$raindrops_base_color);
/**
 * save stylesheet
 *
 */

if( 'option' == $raindrops_setting_type ) {
	
	$raindrops_options = get_option( "raindrops_theme_settings" );
}

$raindrops_theme_mod_options = false;

if( 'theme_mod' == $raindrops_setting_type ) {
	$raindrops_theme_mods_key = get_theme_mods( );
	$raindrops_theme_mods_key = array_keys( $raindrops_theme_mods_key );
	
	foreach( $raindrops_theme_mods_key as $key ){
		
		if( preg_match( '$raindrops$',$key)){
			
			$raindrops_theme_mod_options = true;
			break;
		}
	}
	
}

if ( $raindrops_theme_mod_options == true && 'theme_mod' == $raindrops_setting_type ) {
		
	if ( is_admin() || $wp_customize ) {
	
			$raindrops_indv_css = raindrops_design_output( $style_type ) . raindrops_color_base();
			set_theme_mod('_raindrops_indv_css', $raindrops_indv_css );

	}
}
 /* 
 */
/**
 * Create CSS Color Declaration
 *
 *
 *
 *
 */

function raindrops_colors( $num = 0, $select = 'set', $color1 = null ) {

    global $raindrops_images_path;

	return raindrops_colors_clone( $num, $select, $color1 );
}

/**
 * Create gradient style
 *
 *
 *
 *
 */
function raindrops_gradient_css( $color = null, $num = 0, $diff = 1, $order = 'asc' ) {

    global $raindrops_images_path;

    if ( null == $color ) {

        $color = str_replace( '#', "", raindrops_warehouse_clone( 'raindrops_base_color' ) );
    } else {

        $color = str_replace( '#', "", $color );
    }

    $base = new raindrops_CSS_Color( $color );

    if ( $num > 4 ) {
        $num = 4;
    }

    if ( $num + $diff > 4 ) {
        $num = 4 - $diff;
    }

    if ( "asc" == $order ) {

        $custom_dark_bg1  = raindrops_colors( $num, 'background', $color );
        $num2             = ( int ) $num + $diff;
        $custom_light_bg1 = raindrops_colors( $num2, 'background', $color );

        if ( isset( $base->fg[$num] ) ) {

            $fg = $base->fg[$num];
        } else {

            $fg = "";
        }
    } elseif ( "desc" == $order ) {

        $custom_dark_bg1  = $base->bg[$num + $diff];
        $custom_light_bg1 = $base->bg[$num];

        if ( isset( $base->fg[$num] ) ) {

            $fg = $base->fg[$num];
        } else {

            $fg = "";
        }
    }
    $g = 'color:#' . $fg . ';';
    $g .= 'background: -webkit-gradient(linear, left top, left bottom, from(' . $custom_dark_bg1 . '), to(' . $custom_light_bg1 . '));';
    $g .= 'background: -moz-linear-gradient(top, ' . $custom_dark_bg1 . ', ' . $custom_light_bg1 . ');';
    $g .= 'background-image: -ms-linear-gradient(top, ' . $custom_dark_bg1 . ', ' . $custom_light_bg1 . ');';
    $g .= 'filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\'' . $custom_dark_bg1 . '\', endColorstr=\'' . $custom_light_bg1 . '\');';
    return $g;
}

/**
 * Base Color Class Create
 *
 *
 *
 *
 */
function raindrops_color_base( $color1 = null, $color2 = null ) {

    return raindrops_color_base_clone( $color1, $color2 );
}

/**
 * from hex color #000000 to rgba color
 *
 *
 *
 *
 */
function raindrops_hex2rgba( $color, $opecity ) {

    if ( '#' == $color[0] ) {

        $color = substr( $color, 1 );
    }

    if ( 6 == strlen( $color ) ) {

        list($r, $g, $b) = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( 3 == strlen( $color ) ) {

        list($r, $g, $b) = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {

        return false;
    }

    $r = hexdec( $r );
    $g = hexdec( $g );
    $b = hexdec( $b );
    return "rgba({$r}, {$g}, {$b},{$opecity})";
}

/**
 * Declaration Calculator
 *
 *
 *
 *
 */
function raindrops_design_output( $name = 'dark' ) {

    global $raindrops_show_theme_option, $raindrops_automatic_color;

    $uploads                 = wp_upload_dir();
    $raindrops_header_image  = raindrops_warehouse_clone( 'raindrops_header_image' );
    $raindrops_hd_image_path = $uploads['path'] . '/' . $raindrops_header_image;

    if ( file_exists( $raindrops_hd_image_path ) ) {

        $raindrops_hd_images_path = $uploads['url'] . '/';
    } else {

        $raindrops_hd_images_path = get_stylesheet_directory_uri() . '/images/';
    }

    if ( !file_exists( get_stylesheet_directory() . '/images/' ) ) {

        $raindrops_hd_images_path = get_template_directory_uri() . '/images/';
    }

    $raindrops_hd_image_path = apply_filters( 'raindrops_hd_image_path', $raindrops_hd_images_path );
    $raindrops_images_path   = get_stylesheet_directory_uri() . '/images/';

    if ( !file_exists( get_stylesheet_directory() . '/images/' ) ) {

        $raindrops_images_path = get_template_directory_uri() . '/images/';
    }
    $raindrops_images_path       = apply_filters( 'raindrops_images_path', $raindrops_images_path );
    $navigation_title_img        = raindrops_warehouse_clone( 'raindrops_heading_image' );
    $raindrops_header_color      = raindrops_warehouse_clone( 'raindrops_default_fonts_color' );
    $raindrops_footer_image      = raindrops_warehouse_clone( 'raindrops_footer_image' );
    $raindrops_footer_color      = raindrops_warehouse_clone( 'raindrops_footer_color' );
    $raindrops_footer_link_color = raindrops_warehouse_clone( 'raindrops_footer_link_color' );
    
   
    if ( empty( $name ) ) {
        $name = 'dark';
    }

    $c_border = raindrops_colors( 0, 'background' );

    if ( '#' == $c_border ) {

        $rgba_border = 'rgba(203,203,203, 0.8)';
    } else {

        $rgba_border = raindrops_hex2rgba( $c_border, 0.5 );
    }

    if ( 'light' == $name ) {

        if ( '#' == $c_border ) {

            $rgba_border = 'rgba(203,203,203, 0.4)';
        } else {

            $rgba_border = raindrops_hex2rgba( $c_border, 0.2 );
        }
    }

    $c1         = raindrops_colors( 0 );
    $c1         = raindrops_colors( 1 );
    $c2         = raindrops_colors( 2 );
    $c3         = raindrops_colors( 3 );
    $c4         = raindrops_colors( 4 );
    $c5         = raindrops_colors( 5 );
    $c_1        = raindrops_colors( -1 );
    $c_2        = raindrops_colors( -2 );
    $c_3        = raindrops_colors( -3 );
    $c_4        = raindrops_colors( -4 );
    $c_5        = raindrops_colors( -5 );
    $position_y = raindrops_warehouse_clone( 'raindrops_heading_image_position' );
    $y          = $position_y * 26;
    $y          = '-' . $y . 'px';

    switch ( $position_y ) {
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

    if ( $raindrops_show_theme_option == true ) {
		
        if ( file_exists( get_template_directory() . '/images/' . $navigation_title_img ) || file_exists( get_stylesheet_directory() . '/images/' . $navigation_title_img ) ) {
            $image_exists = true;
        } else {
            $image_exists = false;
        }

        $h2_w3standard_background = "background:" . raindrops_colors( 5, 'background' ) . ' ';
		
        if ( true == $image_exists ) {
            $h2_w3standard_background .= "url({$raindrops_images_path}{$navigation_title_img});";
        }else{
            $h2_w3standard_background .= ";";
        }

        $h2_w3standard_background .= "color:" . raindrops_colors( 4, 'color' ) . ';';

        $h2_dark_background = "background:" . raindrops_colors( -3, 'background' ) . ' ';
		
        if ( true == $image_exists ) {
			
            $h2_dark_background .= "url({$raindrops_images_path}{$navigation_title_img});";		
        }else{
            $h2_dark_background .= ";";
        }
		
        $h2_dark_background .= "color:" . raindrops_colors( -3, 'color' ) . ';';

        $h2_light_background = "background:" . raindrops_colors( 5, 'background' ) . ' ';
		
        if ( true == $image_exists ) {
			
            $h2_light_background .= "url({$raindrops_images_path}{$navigation_title_img});";
        }else{
			
            $h2_light_background .= ";";
        }
        $h2_light_background .= "color:" . raindrops_colors( 4, 'color' ) . ';';
    }
	
	$raindrops_has_indivisual_notation = raindrops_has_indivisual_notation();
		// else color is only notation default
    switch ( $name ) {
        case("w3standard"):
            $custom_dark_bg  = raindrops_colors( 3, 'background' );
            $custom_light_bg = raindrops_colors( 1, 'background' );
            $custom_color    = raindrops_colors( '1', 'color' );

            if ( ! empty( $raindrops_footer_color ) && false == $raindrops_has_indivisual_notation &&  false == $raindrops_automatic_color ) {

                $raindrops_footer_color = $raindrops_footer_color;
            } else {

                $raindrops_footer_color = '#000';
            }
            if ( !empty( $raindrops_footer_link_color ) && false == $raindrops_has_indivisual_notation &&  false == $raindrops_automatic_color ) {

                $raindrops_footer_link_color = $raindrops_footer_link_color;
            } else {

                $raindrops_footer_link_color = '#555';				
            }
            if ( !empty( $raindrops_header_color ) && false == $raindrops_has_indivisual_notation  && false == $raindrops_automatic_color ) {

                $raindrops_header_color = $raindrops_header_color;
            } else {

                $raindrops_header_color = '#000';
            }
            $gradient        = raindrops_gradient_clone();
            break;
        case("dark"):
            /**
             * dark
             */
            $custom_dark_bg  = apply_filters( 'raindrops_dark_dark_bg', -1 );
            $custom_dark_bg  = raindrops_colors( $custom_dark_bg, 'background' );
            $custom_light_bg = apply_filters( 'raindrops_dark_light_bg', -4 );
            $custom_light_bg = raindrops_colors( $custom_light_bg, 'background' );
            $custom_color    = apply_filters( 'raindrops_dark_color', -3 );
            $custom_color    = raindrops_colors( $custom_color, 'color' );

            if ( ! empty( $raindrops_footer_color ) && false == $raindrops_has_indivisual_notation &&  false == $raindrops_automatic_color ) {

                $raindrops_footer_color = $raindrops_footer_color;
            } else {

                $raindrops_footer_color = '#fff';
            }
            if ( !empty( $raindrops_footer_link_color ) && false == $raindrops_has_indivisual_notation &&  false == $raindrops_automatic_color ) {

                $raindrops_footer_link_color = $raindrops_footer_link_color;
            } else {

                $raindrops_footer_link_color = '#fff';
            }

            if ( !empty( $raindrops_header_color ) && false == $raindrops_has_indivisual_notation &&  false == $raindrops_automatic_color ) {

                $raindrops_header_color = $raindrops_header_color;
            } else {

                $raindrops_header_color = '#fff';
            }
            $gradient        = raindrops_gradient_clone();
            break;
        case("light"):
            /**
             * light
             */
            $custom_dark_bg  = apply_filters( 'raindrops_light_dark_bg', 5 );
            $custom_dark_bg  = raindrops_colors( $custom_dark_bg, 'background' );
            $custom_light_bg = apply_filters( 'raindrops_light_light_bg', 4 );
            $custom_light_bg = raindrops_colors( $custom_light_bg, 'background' );
            $custom_color    = apply_filters( 'raindrops_light_color', 3 );
            $custom_color    = raindrops_colors( $custom_color, 'color' );
            $base_gradient   = raindrops_gradient_single_clone( 3, "asc" );

            if ( !empty( $raindrops_footer_color ) ) {

                $raindrops_footer_color = $raindrops_footer_color;
            } else {

                $raindrops_footer_color = '#333';
            }
            if ( !empty( $raindrops_footer_link_color ) && false == $raindrops_has_indivisual_notation &&  false == $raindrops_automatic_color ) {

                $raindrops_footer_link_color = $raindrops_footer_link_color;
            } else {

                $raindrops_footer_link_color = '#fff';
            }
            if ( !empty( $raindrops_header_color ) && false == $raindrops_has_indivisual_notation &&  false == $raindrops_automatic_color ) {

                $raindrops_header_color = $raindrops_header_color;
            } else {
                $raindrops_header_color = '#333';
            }
            $gradient        = raindrops_gradient_clone();
            break;
        default:
            $custom_dark_bg  = apply_filters( 'raindrops_default_dark_bg', 3 );
            $custom_dark_bg  = raindrops_colors( $custom_dark_bg, 'background' );
            $custom_light_bg = apply_filters( 'raindrops_default_light_bg', 1 );
            $custom_light_bg = raindrops_colors( $custom_light_bg, 'background' );
            $custom_color    = apply_filters( 'raindrops_default_color', 1 );
            $custom_color    = raindrops_colors( $custom_color, 'color' );

            if ( !empty( $raindrops_footer_color ) ) {

                $raindrops_footer_color = $raindrops_footer_color;
            } else {

                $raindrops_footer_color = '#000';
            }
						
            if ( ! empty( $raindrops_footer_link_color ) && false == $raindrops_has_indivisual_notation &&  false == $raindrops_automatic_color ) {

                $raindrops_footer_link_color = $raindrops_footer_link_color;
            } else {

                $raindrops_footer_link_color = '#555';
            }
			
            if ( ! empty( $raindrops_header_color ) && false == $raindrops_has_indivisual_notation  && false == $raindrops_automatic_color ) {

                $raindrops_header_color = $raindrops_header_color;
            } else {

                $raindrops_header_color = '#000';
            }
            $gradient = raindrops_gradient_clone();
            break;
    }


    $function_name = 'raindrops_indv_css_' . $name;

    if ( function_exists( $function_name ) ) {

        $content = $function_name();

        foreach ( explode( ' ', $content, -1 ) as $line ) {

            preg_match_all( '|%([a-z0-9_-]+)?%|si', $line, $regs, PREG_SET_ORDER );

            foreach ( $regs as $reg ) {

                if ( isset( $$reg[1] ) ) {

                    $content = str_replace( $reg[0], $$reg[1], $content );
                } else {

                    $content = str_replace( $reg[0], '/*cannot bind data [%' . $reg[1] . '%]*/', $content );
                }
            }
        }
    }
	if( isset( $content ) ) {
		
		return $content;
	}else{
		return false;
	}
}

/**
 * register style name
 *
 *
 *
 *
 */
function raindrops_register_styles( $style_name = '' ) {
    static $vals;
	
	if ( empty( $style_name ) ) {

        return $vals;
    }	
	
    if ( !is_string( $style_name ) ) {

        return false;
    }
	

    $vals[$style_name] = $style_name;
    return apply_filters( 'raindrops_register_styles', $vals );
}

?>