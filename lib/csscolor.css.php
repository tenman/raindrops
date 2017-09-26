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
	$background_4 = raindrops_colors( -4, "background" );
	$background_3 = raindrops_colors( -3, "background" );
	$background4 = raindrops_colors( 4, "background" );
	$raindrops_focus_style = apply_filters( 'raindrops_forcus_style',  'color:orange!important;');

    $style = <<<DOC
.raindrops-menu-fixed{ background:$background_3;}
.post-format-wrap{
	    border:solid 1px %c_border%;
}
.post-format-text{
    %c_3%;
}
.mark-alert,.mark-notice,.mark-info,.mark-blue,
.mark-blue, .mark-yellow,.mark-green,.mark-red,
mark.alert,mark.info,mark.notice,mark.red,mark.yellow,mark.blue,mark.green{
	color: $font_color_5;
}
.rd-ripple:after {
    background: $background4;
}
.topsidebar .widget_tag_cloud .tagcloud a{
	background:$background_4;
}
.topsidebar .widget_meta ul > li a,
.topsidebar .widget_meta ul > li,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive.by-month .item a,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive.by-month .item,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive .year a,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive .year,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive .month a,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive .month,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive.by-year .month a,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive.by-year .month,
.topsidebar .sticky-widget.widget_archive li a,
.topsidebar .sticky-widget.widget_archive li,
.topsidebar .cat-item a,	
.topsidebar .cat-item{
	%c_4%;
}
.topsidebar .widget_tag_cloud .tagcloud a:hover{
	background:$background_3;
}
.topsidebar .widget_tag_cloud .tagcloud a:focus{
	%c_3%;
}
.topsidebar .widget_meta ul > li:hover a,
.topsidebar .widget_meta ul > li:hover,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive.by-month .item:hover a,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive.by-month .item:hover,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive .year:hover a,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive .year:hover,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive .month a,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive .month,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive.by-year .month:hover a,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive.by-year .month:hover,
.topsidebar .sticky-widget.widget_archive li:hover a,
.topsidebar .sticky-widget.widget_archive li:hover,
.topsidebar .cat-item:hover a,	
.topsidebar .cat-item:hover{
	%c_3%;
}
.topsidebar .widget_recent_comments #recentcomments li{
	%c_1%;
}
.topsidebar .widget_rss ul li a,
.topsidebar .widget_rss ul li{
	%c2%;
}
.topsidebar .widget_rss .rsswidget a,
.topsidebar .widget_rss .rsswidget{
	%c_1%;
}
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive .year:hover,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive .month:hover,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive .year,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive .month,
.topsidebar .widget_rss h2 .rsswidget a,
.topsidebar .widget_rss h2 .rsswidget{
	background:transparent;
}

.topsidebar .widget_recent-post-groupby-cat .xoxo > li > ul > li a,
    .topsidebar .widget_recent-post-groupby-cat .xoxo > li > ul > li{
		%c1%;
	
	}
.topsidebar .widget_recent-post-groupby-cat .xoxo > li > ul > li:nth-child(1) a,
.topsidebar .widget_recent-post-groupby-cat .xoxo > li > ul > li:nth-child(1){
	%c4%;
}
.topsidebar .widget_recent-post-groupby-cat .xoxo > li > ul > li:nth-child(2) a,
.topsidebar .widget_recent-post-groupby-cat .xoxo > li > ul > li:nth-child(2){
	%c3%;
}
.topsidebar .widget_recent-post-groupby-cat .xoxo > li > ul > li:nth-child(3) a,
.topsidebar .widget_recent-post-groupby-cat .xoxo > li > ul > li:nth-child(3){
	%c2%;
}
.topsidebar .widget_recent-post-groupby-cat .xoxo > .post-group-by-category-title h3 span{
	background:transparent;
}

.focus .icon-post-format-notitle,
.icon-post-format-notitle:focus,
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
 
}
.topsidebar .widget_nav_menu.sticky-widget .children,
.topsidebar .widget_nav_menu.sticky-widget .sub-menu{
	border-bottom:1px solid rgba(122,122,122,.5);
	   %c_4%;
}
.topsidebar .widget_pages.sticky-widget .children{
   border-top:1px solid rgba(68,68,68,.5);
   %c_4%;
}
.topsidebar .widget_nav_menu.sticky-widget .sub-menu:last-child{
	 border-bottom:none;
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
h1{
	background:transparent;
}

a:link,
a:active,
a:visited,
a:hover{
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
.textwidget td,
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
/*
#access ul li.current_page_item,
#access ul li.current-menu-ancestor > a,
#access ul li.current-menu-item > a,
#access ul li.current-menu-parent > a,*/
#access .current_page_item,
#access .current-menu-ancestor,
#access .current-menu-item,
#access .current-menu-parent,
.searchform input[type="search"],
.searchform input[type="text"],
.social textarea#comment,
.social input[type="text"],
.hentry input[type="password"],
.textwidget blockquote,
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
.rd-current-month-archive,
.rd-current-post,
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
    border-top:solid 1px %c_border%;
	border-bottom:solid 1px %c_border%;
}
.blog .sticky,
.home .sticky{
    border-top:solid 6px %c_border%;
}
.blog.rd-grid .sticky,
.home.rd-grid .sticky{
    border-top:none;
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
/* @since 1.462 from #ft a */
.footer a,
body:not(.rd-tag-em) #ft a,
#ft li:not(.widget_tag_cloud) a{
     color:%raindrops_footer_link_color%; 
         background:none;
}
.footer-widget h2 span,.rsidebar h2 span,.lsidebar h2 span {
    %h2_dark_background%
    %h_position_rsidebar_h2%
}

.sticky-widget.widget_recent-post-groupby-cat .xoxo > li > ul >li,
.datetable td li,
.rsidebar > ul > li:last-child,
.rsidebar ul li ul li,
.lsidebar > ul > li:last-child,	
.lsidebar ul li ul li,
.blog .entry-utility li,
.mycomment,
.blog .entry-utility li,
dl.author dd,
dl.author dt,
/* @1.477 dl.my_tags dd,
dl.my_tags dt,*/
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
#date_list td,
#month_list,
#month_list td,
#raindrops_year_list td,
#wp-calendar td,
#calendar_wrap td,
#date_list td,
fieldset,
#month_list,
#month_list td,
#raindrops_year_list td,
#date_list td,
.searchform input[type="search"],
.searchform input[type="text"],
.searchform input[type="submit"],
.hentry input[type="password"],
#respond input[type="text"],
#respond textarea#comment,
.social textarea#comment,
.social input[type="text"],
.social input[type="submit"],
.entry-content input[type="email"],
.entry-content input[type="search"],	
.entry-content input[type="text"],
.entry-content input[type=url],
.entry-content input[type=tel],
.entry-content input[type=number],
.entry-content input[type=color],
.entry-content textarea,
.entry-content blockquote,
.textwidget blockquote,
td.month-date,
td.month-name,
td.time{
    border:1px solid %c_border%;
}
.textwidget blockquote,
.entry-content blockquote {
    border-left:solid 6px %c_border%;
}

li.byuser,
li.bypostauthor,
#respond input[type="text"]:focus,
#respond textarea#comment:focus,
.social textarea#comment:focus,
.social input:focus,
.textwidget th,
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
.entry-content input[type="search"],
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
    %c_3%
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
.page .entry-title a,
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

.rd-cat-em .footer-widget-wrapper .cat-item:before,
.rd-cat-em .topsidebar .cat-item:before,
.rd-cat-em .rsidebar .cat-item:before,
.rd-cat-em .lsidebar .cat-item:before{
	border:2px solid $background_4;
}
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
    border-top:solid 1px %rgba_border%;
	border-bottom:solid 1px %rgba_border%;
}

.blog .sticky,
.home .sticky{
    border-top:solid 6px %rgba_border%;
}
.blog.rd-grid .sticky,
.home.rd-grid .sticky{
    border-top:none;
}
.raindrops-extend-archive.sticky-widget .eco-archive.by-month .item,
.raindrops-extend-archive.sticky-widget .eco-archive.by-year .month,
.topsidebar .sticky-widget.widget_archive li,
.topsidebar .sticky-widget.widget_categories .cat-item,
.page .rd-border,
.post .rd-border,
.comment-body th,
.comment-body td,
.wp-caption,
.textwidget td,
.textwidget th,
.entry-content td,
.entry-content th{
    border:solid 1px %rgba_border%;
}
.lsidebar > ul > li:last-child,	
.rsidebar > ul > li:last-child,
.datetable td li,
.rsidebar ul li ul li,
.lsidebar ul li ul li,
.blog .entry-utility li,
.mycomment,
.blog .entry-utility li,
dl.author dd,
dl.author dt,
/* @1.477 dl.my_tags dd,
dl.my_tags dt,*/
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
.searchform input[type="search"],
.searchform input[type="text"],
.searchform input[type="submit"],
.hentry input[type="password"],
#respond input[type="text"],
#respond textarea#comment,
.social textarea#comment,
.social input[type="text"],
.social input[type="submit"],
.entry-content input[type="email"],
.entry-content input[type="search"],
.entry-content input[type="text"],
.entry-content input[type=url],
.entry-content input[type=tel],
.entry-content input[type=number],
.entry-content input[type=color],
.entry-content blockquote,
.textwidget blockquote,
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
.searchform input[type="search"],
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
.raindrops-excerpt-more{
	 border:1px solid rgba(62,6d2,62, 0.4);
}

kbd,
.entry-content .more-link,
.sticky-widget #wp-calendar th,
.sticky-widget #wp-calendar tbody #today,
.sticky-widget #wp-calendar #prev a,
.sticky-widget #wp-calendar tbody td:hover,
.raindrops-excerpt-more,
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
.entry-content input[type="file"],
.entry-content input[type="reset"],
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
#access li a:active{
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
.textwidget blockquote,
.entry-content blockquote {
    border-left:solid 6px %rgba_border%;
}

#access .menu > li{
    border-left:1px solid rgba( 222,222,222,.2);
}
#access .menu > li:nth-of-type(2){
    border-left:none;
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
.rd-type-dark .rd-switch-to-grid-layout,
.rd-type-dark button[class="layout-switch-button"],
.rd-type-dark .rd-switch-to-list-layout{
	 border:1px solid rgba(200,200,200,0.3);
	-moz-border-radius: 3px;
    -khtml-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
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
.raindrops-post-format-chat > dd{
    border:1px solid %rgba_border%;
    background-color:  %custom_dark_bg%;
}
.raindrops-post-format-chat > dd:after{
    background-color:  %custom_dark_bg%;
    border-left:1px solid %rgba_border%;
    border-bottom:1px solid %rgba_border%;
}
.rsidebar .raindrops-post-format-chat > dd:after,
.lsidebar .raindrops-post-format-chat > dd:after{
	background-color:  %custom_dark_bg%;
	border-left:1px solid  %rgba_border%;
	border-top:1px solid  %rgba_border%;
	border-bottom:none;
}

@media screen and (max-width : 640px){
	.raindrops-post-format-chat > dd:after{
		background-color:  %custom_dark_bg%;
		border-left:1px solid  %rgba_border%;
		border-top:1px solid  %rgba_border%;
		border-bottom:none;
	}	
}
.front-page-template-pages > li:nth-child(odd) {
	%c_4%;
}
CSS3;
	$page_for_posts	= get_option( 'page_for_posts', false );

	if( false == is_home() && true == is_front_page() && $page_for_posts ) {

		$style .= ' .portfolio-nav > ul > li{width:33%;}';	
	}
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
	$background4 = raindrops_colors( 5, "background" );
	$background3 = raindrops_colors( 4, "background" );	
	$background_3 = raindrops_colors( -3, "background" );
	$raindrops_focus_style = apply_filters( 'raindrops_forcus_style',  'background:orange!important;');
    $style = <<<DOC
.post-format-wrap{
	border:1px solid %rgba_border%;
}
.post-format-text{
    %c1%;
}
.rd-cat-em .footer-widget-wrapper .cat-item:before,
.rd-cat-em .topsidebar .cat-item:before,
.rd-cat-em .rsidebar .cat-item:before,
.rd-cat-em .lsidebar .cat-item:before{
	border:2px solid #fff;
}
.rd-ripple:after {
    background: $background_3;
}	
.topsidebar .widget_tag_cloud .tagcloud a{
	background:$background4;
}
.topsidebar a{
	%c4%;
	background:transparent;
}
.topsidebar .widget_meta ul > li a,
.topsidebar .widget_meta ul > li,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive.by-month .item a,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive.by-month .item,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive .year a,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive .year,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive .month a,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive .month,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive.by-year .month a,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive.by-year .month,
.topsidebar .sticky-widget.widget_archive li a,
.topsidebar .sticky-widget.widget_archive li,
.topsidebar .cat-item a,	
.topsidebar .cat-item{
	%c4%;
}
.topsidebar .widget_tag_cloud .tagcloud a:hover{
	background:#fff;
}
.topsidebar .widget_meta ul > li:hover a,
.topsidebar .widget_meta ul > li:hover,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive.by-month .item:hover a,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive.by-month .item:hover,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive .year:hover a,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive .year:hover,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive .month a,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive .month,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive.by-year .month:hover a,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive.by-year .month:hover,
.topsidebar .sticky-widget.widget_archive li:hover a,
.topsidebar .sticky-widget.widget_archive li:hover,
.topsidebar .cat-item:hover a,	
.topsidebar .cat-item:hover{
	%c5%;
	opacity:1.0;
}
.topsidebar .widget_recent_comments #recentcomments li{
	%c5%;
}
.topsidebar .widget_rss ul li a,
.topsidebar .widget_rss ul li{
	%c4%;
}
.topsidebar .widget_rss .rssSummary + cite,
.topsidebar .widget_rss .rsswidget a,
.topsidebar .widget_rss .rsswidget{
	%c_1%;
}
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive h3.month a,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive h3.year a,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive .year:hover,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive .month:hover,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive .year,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive .month,
.topsidebar .widget_rss h2 .rsswidget a,
.topsidebar .widget_rss h2 .rsswidget{
	background:transparent;
}
	
.topsidebar .widget_recent-post-groupby-cat .xoxo > li > ul > li a,
.topsidebar .widget_recent-post-groupby-cat .xoxo > li > ul > li{
	%c4%;
}
.topsidebar .widget_recent-post-groupby-cat .xoxo > li > ul > li:nth-child(1) a,
.topsidebar .widget_recent-post-groupby-cat .xoxo > li > ul > li:nth-child(1){
	%c1%;
}
.topsidebar .widget_recent-post-groupby-cat .xoxo > li > ul > li:nth-child(2) a,
.topsidebar .widget_recent-post-groupby-cat .xoxo > li > ul > li:nth-child(2){
	%c2%;
}
.topsidebar .widget_recent-post-groupby-cat .xoxo > li > ul > li:nth-child(3) a,
.topsidebar .widget_recent-post-groupby-cat .xoxo > li > ul > li:nth-child(3){
	%c3%;
}
.topsidebar .widget_recent-post-groupby-cat .xoxo > .post-group-by-category-title h3 span{
	background:transparent;
}
/*-----------------------------------------------------------*/

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
	
.topsidebar .widget_pages.sticky-widget .children,
.topsidebar .widget_nav_menu.sticky-widget .children,
.topsidebar .widget_nav_menu.sticky-widget .sub-menu{
	border:none;
	%c5%;
}
.topsidebar .widget_pages.sticky-widget .children{
     border-top:1px dotted rgba(122,122,122,.5);
}
.widget_nav_menu.sticky-widget .sub-menu{
    border-bottom:1px solid rgba(122,122,122,.5);
}

body {
%c4%
    margin:0!important;padding:0;
    background-repeat:repeat-x;
}
.raindrops-extend-archive.sticky-widget .eco-archive.by-month .item,
.raindrops-extend-archive.sticky-widget .eco-archive.by-year .month,
.topsidebar .sticky-widget.widget_archive li,
.topsidebar .sticky-widget.widget_categories .cat-item,
.nav-links .page-numbers{
     border:1px solid #ccc;

}
.nav-links .page-numbers:hover{
	%c4%;
}
.nav-links .current{
    %c5%;
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
   /* background:url(%raindrops_images_path%%raindrops_footer_image%) repeat-x;
    color:%raindrops_footer_color%;*/
}
/* @since 1.462 from #ft a */
.footer a,
body:not(.rd-tag-em) #ft a,
#ft li:not(.widget_tag_cloud) a{
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

    border-top:solid 6px %c_border%;
    border-bottom:solid 2px %c_border%;
}
.blog.rd-grid .sticky,
.home.rd-grid .sticky{
    border-top:none;
}
.entry-meta{
    %c5%
    border-top:dashed 1px %c_border%;
    border-bottom:dashed 1px %c_border%;
}
textarea,
input[type="password"],
input[type="search"],
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
.entry-content input[type="search"],
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
.entry-content input[type="email"],
.entry-content input[type="search"],
.entry-content input[type="text"],
.entry-content input[type="url"],
.entry-content input[type="tel"],
.entry-content input[type="number"],
.entry-content input[type="color"],
.entry-content select{
    %c5%
}
.textwidget blockquote,
.entry-content blockquote{
    %c4%;
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
.textwidget td,
.textwidget td,
.comment-body td,
.entry-content td{
    %c4%
    border:solid 1px %c_border%;
}
.textwidget th,
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
    %c5%
}

#access li:active > a,
#access ul ul :active > a {
    top:0;
    %c4%
    color:%custom_color%
}

#access .current_page_item,
#access .current-menu-ancestor,
#access .current-menu-item,
#access .current-menu-parent{
    %c4%
}
.ie6 #access ul li.current_page_item a,
.ie6 #access ul li.current-menu-ancestor a,
.ie6 #access ul li.current-menu-item a,
.ie6 #access ul li.current-menu-parent a,
.ie6 #access ul li a:hover {
    %c3%
}
rd-current-month-archive,
.rd-current-post,
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
/* @1.453 */

.ghost-s.rd-notice,
.ghost-m.rd-notice,
.ghost-l.rd-notice,
.ghost.rd-notice,
.ghost-s.rd-info,
.ghost-m.rd-info,
.ghost-l.rd-info,
.ghost.rd-info,
.ghost-s.rd-alert,
.ghost-m.rd-alert,
.ghost-l.rd-alert,
.ghost.rd-alert,
.ghost-s.rd-notice-bg,
.ghost-m.rd-notice-bg,
.ghost-l.rd-notice-bg,
.ghost.rd-notice-bg,
.ghost-s.rd-info-bg,
.ghost-m.rd-info-bg,
.ghost-l.rd-info-bg,
.ghost.rd-info-bg,
.ghost-s.rd-alert-bg,
.ghost-m.rd-alert-bg,
.ghost-l.rd-alert-bg,
.ghost.rd-alert-bg{
    background:transparent;
	color:#333;
}
.raindrops-post-format-chat > dd{
    border:1px solid %rgba_border%;
    background-color:  #fafafa;
}
.raindrops-post-format-chat > dd:after{
    background-color: #fafafa;
    border-left:1px solid %rgba_border%;
    border-bottom:1px solid %rgba_border%;
}

.rsidebar .raindrops-post-format-chat > dd:after,
.lsidebar .raindrops-post-format-chat > dd:after{
	background-color: #fafafa;
	border-left:1px solid  %rgba_border%;
	border-top:1px solid  %rgba_border%;
	border-bottom:none;
}

@media screen and (max-width : 640px){
	.raindrops-post-format-chat > dd:after{
		background-color: #fafafa;
		border-left:1px solid  %rgba_border%;
		border-top:1px solid  %rgba_border%;
		border-bottom:none;
	}

}
.front-page-template-pages > li:nth-child(even) {
	%c5%;
}
.widget.widget_rss > ul > li{
	list-style:none;
}
.rd-grid ul.search-results .entry-meta,
.rd-grid ul.archives .entry-meta{
    %c5%
}
DOC;
	
	$page_for_posts	= get_option( 'page_for_posts', false );

	if( false == is_home() && true == is_front_page() && $page_for_posts ) {

		$style .= ' .portfolio-nav > ul > li{width:33%;}';	
	}
    
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
	
	$background5			 = raindrops_colors( 5, "background" );
	$background4			 = raindrops_colors( 4, "background" );
	$font_color5			 = raindrops_colors( 5, "color" );
	$background_3			 = raindrops_colors( -3, "background" );
	$background3			 = raindrops_colors( 3, "background" );
	$raindrops_focus_style	 = apply_filters( 'raindrops_forcus_style', 'color:red!important;' );

	$style = <<<DOC
.raindrops-menu-fixed{ background:%custom_dark_bg%;}
.post-format-wrap{
	border:1px solid %rgba_border%;
}
.post-format-text{
    %c1%;
}
.topsidebar .widget_tag_cloud .tagcloud a{
	background:$background5;
}
.rd-ripple:after {
    background: $background_3;
}
.topsidebar .widget_meta ul > li{
	%c4%;
}
.topsidebar .widget_tag_cloud .tagcloud a:hover{
	background:#fff;
}
.topsidebar .widget_meta ul > li:hover a,
.topsidebar .widget_meta ul > li:hover{
	%c5%;
	opacity:1.0;
}
.topsidebar .widget_recent_comments #recentcomments li{
	%c5%;
}

.topsidebar .widget_rss ul li a,
.topsidebar .widget_rss ul li{
	%c4%;
}
.topsidebar .widget_rss h2 a,
.topsidebar .widget_rss h2{
	background:transparent;	
}
.topsidebar .widget_rss .rssSummary + cite,
.topsidebar .widget_rss .rsswidget a,
.topsidebar .widget_rss .rsswidget{
	%c_1%;
}
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive .year:hover,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive .month:hover,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive .year,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive .month{
	background:transparent;
}
	
.topsidebar .widget_recent-post-groupby-cat .xoxo > li > ul > li a,
.topsidebar .widget_recent-post-groupby-cat .xoxo > li > ul > li{
	%c4%;
}
.topsidebar .widget_recent-post-groupby-cat .xoxo > li > ul > li:nth-child(1) a,
.topsidebar .widget_recent-post-groupby-cat .xoxo > li > ul > li:nth-child(1){
	%c1%;
}
.topsidebar .widget_recent-post-groupby-cat .xoxo > li > ul > li:nth-child(2) a,
.topsidebar .widget_recent-post-groupby-cat .xoxo > li > ul > li:nth-child(2){
	%c2%;
}
.topsidebar .widget_recent-post-groupby-cat .xoxo > li > ul > li:nth-child(3) a,
.topsidebar .widget_recent-post-groupby-cat .xoxo > li > ul > li:nth-child(3){
	%c3%;
}
.topsidebar .widget_recent-post-groupby-cat .xoxo > .post-group-by-category-title h3 span{
	background:transparent;
}
/*-----------------------------------------------------------*/
	
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
.widget_pages.sticky-widget .children{
    %c4%
}
.topsidebar .widget_nav_menu.sticky-widget .sub-menu{
	
}
.topsidebar .widget_pages.sticky-widget .children{
     border-top:1px dotted rgba(105,105,105,.5);
}
.widget_nav_menu.sticky-widget .sub-menu a,
.widget_pages.sticky-widget .children a{
  /*  border-bottom:1px solid rgba(105,105,105,.5);*/
}

 a:link,
 a:active,
 a:visited,
 a:hover{
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
/* @since 1.462 from #ft a */
.footer a,
body:not(.rd-tag-em) #ft a,
#ft li:not(.widget_tag_cloud) a{
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
dl.author dt/* @1.477,
dl.my_tags dd,
dl.my_tags dt*/{
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
.textwidget blockquote,
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
input[type="search"],	
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
.entry-content input[type="search"],
.entry-content input[type="text"],
.entry-content input[type=url],
.entry-content input[type=tel],
.entry-content input[type=number],
.entry-content input[type=color],
.social input[type="submit"] {
    border:solid 1px %c_border%;
    %c4%
}
.textwidget th,
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
.entry-content input[type="search"],
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
.rd-current-month-archive,
.rd-current-post,
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
/* @1.453 */

.ghost-s.rd-notice,
.ghost-m.rd-notice,
.ghost-l.rd-notice,
.ghost.rd-notice,
.ghost-s.rd-info,
.ghost-m.rd-info,
.ghost-l.rd-info,
.ghost.rd-info,
.ghost-s.rd-alert,
.ghost-m.rd-alert,
.ghost-l.rd-alert,
.ghost.rd-alert,
.ghost-s.rd-notice-bg,
.ghost-m.rd-notice-bg,
.ghost-l.rd-notice-bg,
.ghost.rd-notice-bg,
.ghost-s.rd-info-bg,
.ghost-m.rd-info-bg,
.ghost-l.rd-info-bg,
.ghost.rd-info-bg,
.ghost-s.rd-alert-bg,
.ghost-m.rd-alert-bg,
.ghost-l.rd-alert-bg,
.ghost.rd-alert-bg{
    background:transparent;
	color:#333;
}
.raindrops-post-format-chat > dd{
    border:1px solid %rgba_border%;
    background-color:  #fafafa;
}
.raindrops-post-format-chat > dd:after{
    background-color: #fafafa;
    border-left:1px solid %rgba_border%;
    border-bottom:1px solid %rgba_border%;
}

.rsidebar .raindrops-post-format-chat > dd:after,
.lsidebar .raindrops-post-format-chat > dd:after{
	background-color: #fafafa;
	border-left:1px solid  %rgba_border%;
	border-top:1px solid  %rgba_border%;
	border-bottom:none;
}
@media screen and (max-width : 640px){
	.raindrops-post-format-chat > dd:after{
		background-color: #fafafa;
		border-left:1px solid  %rgba_border%;
		border-top:1px solid  %rgba_border%;
		border-bottom:none;
	}	
}
DOC;


    $css3 = <<<CSS3

%gradient%
	
.rd-cat-em .footer-widget-wrapper .cat-item:before,
.rd-cat-em .topsidebar .cat-item:before,
.rd-cat-em .rsidebar .cat-item:before,
.rd-cat-em .lsidebar .cat-item:before{
	border:2px solid $background5;
}
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
.blog.rd-grid .sticky,
.home.rd-grid .sticky{
    border-top:none;
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
.lsidebar > ul > li:last-child,	
.rsidebar > ul > li:last-child,
.rsidebar ul li ul li,
.lsidebar ul li ul li{
    border-bottom:1px solid %rgba_border%;
}
.sticky-widget.widget_recent-post-groupby-cat .xoxo > li > ul >li,
dl.author dd,
dl.author dt/* @1.477,
dl.my_tags dd,
dl.my_tags dt*/{
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
.topsidebar .sticky-widget.widget_archive li,
.topsidebar .sticky-widget.widget_categories .cat-item,
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
.entry-content input[type="search"],
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

.topsidebar .widget_meta ul > li,
.raindrops-extend-archive.sticky-widget .eco-archive.by-month .item,
.raindrops-extend-archive.sticky-widget .eco-archive.by-year .month,
.topsidebar .sticky-widget.widget_archive li,
.topsidebar .sticky-widget.widget_categories .cat-item,
kbd,
.sticky-widget #wp-calendar th,
.sticky-widget #wp-calendar tbody #today,
.sticky-widget #wp-calendar #prev,
.sticky-widget #wp-calendar tbody td:hover,
.entry-content .more-link,
.raindrops-excerpt-more,
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
#access a, 
#access{
	background-image: -ms-linear-gradient(top, %custom_dark_bg%, %custom_light_bg%);
    background: -webkit-gradient(linear, left top, left bottom, from(%custom_dark_bg%), to(%custom_light_bg%));
    background: -moz-linear-gradient(top, %custom_dark_bg%, %custom_light_bg%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='%custom_dark_bg%', endColorstr='%custom_light_bg%');
    color:%custom_color%;
}
#access{
	border-top:1px solid %custom_light_bg%;
	border-top:1px solid rgba(255,255,255,.8);
}
.widget_calendar #today a,
.widget_calendar #today,
a.raindrops-comment-link em,
/* @1.355 todo */

#access ul li.current_page_item,
#access ul li.current_page_item:after,
#access ul li.current-menu-ancestor > a,
#access ul li.current-menu-ancestor > a:after,
#access ul li.current-menu-item > a,
#access ul li.current-menu-item > a:after,
#access ul li.current-menu-parent > a,
#access ul li.current-menu-parent > a:after,
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
.front-page-template-pages > li:nth-child(even) {
	%c4%;
}
.raindrops-tag-posts li,
.raindrops-category-posts li,
.raindrops-recent-posts li{
	background:#fff;
}
.rd-grid .archives > li > div{
    background:#fff;
}
.raindrops-tag-posts li:hover,
.raindrops-category-posts li:hover,
.raindrops-recent-posts li:hover,
.rd-grid ul.search-results .click-drawing-container:hover:before,
.rd-grid ul.archives .click-drawing-container:hover:before, 
.rd-grid .archives > li:hover,
.rd-grid .search-results > li:hover,
.rd-grid .topsidebar .widget:not(.raindrops-pinup-entries):hover,
.rd-content-width-keep .search-results > li:hover,
.rd-content-width-keep .commentlist > li:hover,
.rd-content-width-keep .topsidebar .widget:hover,
.rd-content-width-keep .index:not(.front-portfolio) > li:hover{
	outline:1px solid $background3;
    box-shadow: 0px 0px 6px 3px $background4;
    -moz-box-shadow: 0px 0px 6px 3px $background4;
    -webkit-box-shadow: 0px 0px 6px 3px $background4;
    transition: box-shadow 0.5s ease-in-out;
    -webkit-transition: box-shadow 0.5s ease-in-out;
}
.rd-content-width-keep .topsidebar .widget.raindrops-pinup-entries:hover,
.rd-grid .topsidebar .widget.raindrops-pinup-entries:hover{
	outline:none;
    box-shadow: none;
    -moz-box-shadow: none;
    -webkit-box-shadow: none;
    transition: none;
    -webkit-transition:none;	
}
CSS3;
	
	$page_for_posts	= get_option( 'page_for_posts', false );

	if( false == is_home() && true == is_front_page() && $page_for_posts ) {

		$style .= ' .portfolio-nav > ul > li{width:33%;}';	
	}
	 return apply_filters( __FUNCTION__ , $style . $css3 );
}

?><?php
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
	$background_3 = raindrops_colors( -3, "background" );
	$background3 = raindrops_colors( 3, "background" );
	$background4 = raindrops_colors( 4, "background" );
	$background5 = raindrops_colors( 5, "background" );
	$raindrops_focus_style = apply_filters( 'raindrops_forcus_style',  'background:#efefef!important;color:#000!important;');
	$raindrops_focus_style = apply_filters( 'raindrops_forcus_style',  'background:#efefef!important;color:#c0392b!important;');
    $style = <<<CSS
.post-format-wrap{
	border:1px solid %rgba_border%;
}
.post-format-text{
    %c1%;
}	
.rd-cat-em .footer-widget-wrapper .cat-item:before,
.rd-cat-em .topsidebar .cat-item:before,
.rd-cat-em .rsidebar .cat-item:before,
.rd-cat-em .lsidebar .cat-item:before{
	border:2px solid #fff;
}
.rd-ripple:after {
    background: $background_3;
}
.topsidebar .widget_rss ul li a,
.topsidebar .widget_rss ul li{
	%c5%;
}
.topsidebar .widget_rss .rssSummary + cite,
.topsidebar .widget_rss .rsswidget a,
.topsidebar .widget_rss .rsswidget{
	%c4%;
}
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive .year:hover,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive .month:hover,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive .year,
.topsidebar .raindrops-extend-archive.sticky-widget .eco-archive .month,
.topsidebar .widget_rss h2 .rsswidget a,
.topsidebar .widget_rss h2 .rsswidget{
	background:transparent;
}
.topsidebar .widget_recent-post-groupby-cat .xoxo > li > ul > li a,
.topsidebar .widget_recent-post-groupby-cat .xoxo > li > ul > li{
	%c5%;

}
.topsidebar .widget a.post-group_by-category-entry-title.no-thumb{
	 border-left:48px solid #bdc3c7;
}

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
.topsidebar .sticky-widget.widget_archive li,
.topsidebar .sticky-widget.widget_categories .cat-item,
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
.topsidebar .widget_nav_menu.sticky-widget .children,
.topsidebar .widget_nav_menu.sticky-widget .sub-menu,
.topsidebar .widget_pages.sticky-widget .children{
    border:1px dotted rgba(105,105,105,.5);
}
/*
.widget_nav_menu.sticky-widget .sub-menu a,
.widget_pages.sticky-widget .children a{
    border-bottom:1px solid rgba(105,105,105,.5);
}
	*/
.enable-keyboard #access li:hover >ul > li> a,
.raindrops-accessible-mode #access li:hover> ul>  li a,
#access .sub-menu li a,
#access .children li a{
    border:1px solid #696969;
	border:1px solid rgba(105,105,105,.5);
	/* @1.459 border-top:none;*/
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
#access .menu > li:nth-of-type(2){
    border-left:none;
}
 #access .menu li:first-child a,
 #access .menu li:last-child a{
    /* @1.459 border:none;*/
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
/* @since 1.462 from #ft a */
.footer a,
body:not(.rd-tag-em) #ft a,
#ft li:not(.widget_tag_cloud) a{
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
input[type="search"],
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
.raindrops-toc-front li{
	border:1px solid #ddd;
    border-color:%rgba_border%;
	border-radius:0;
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

#access .sub-menu a:hover,
#access .children a:hover,
#access .children .current_page_item a:hover{
	%c4%
}

blockquote{
    border-left:6px solid;
    border-left-color:%rgba_border%;
    padding:10px;    
}
.rd-current-month-archive,
.rd-current-post,
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
.textwidget th,
.textwidget td,
.entry-content th,
.entry-content td{
	padding:.7em .5em;
	border-bottom:1px solid %rgba_border%;
}
.entry-content tfoot{
	border-top:1px solid %rgba_border%;
	font-weight:bold;
}
.textwidget thead,
.textwidget tfoot,	
.entry-content thead,
.entry-content tfoot{
	%c5%;
}
.entry-content tr:last-child td{
	border:none;
}
#raindrops.rd-type-minimal a{
	
}
.entry-meta .edit-link{
	margin: 2px .5em;
    padding: 3px 4px;
    display: inline-block;
    line-height: 1.6;
		 border:1px solid rgba(127,127,127,.3);
}

.post-tag a span,
.post-category a span{
	 border:1px solid rgba(127,127,127,.3);
	padding:.2em .3em;
	line-height:1.6;
	display:inline-block;
}
.entry-meta .post-format-text + a{
	line-height:1.0;
}
a:hover{
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
/* @1.402 start */
address .comments-rss:after, 
address .entry-rss:after,
.nav-next a:after,
.nav-previous a:before{
	display:none;
}
.nav-next, .nav-previous{
	border:1px solid #ccc;
	text-align:center;
	padding:1em;
	box-sizing:border-box;
}
.nav-next:hover, .nav-previous:hover{
	color:%c5%;
	-webkit-transition: width 2s; /* Safari */
    -webkit-transition-timing-function: linear; /* Safari */
    transition: background 1.2s;
    transition-timing-function: linear;
}
#date_list td,
#raindrops_year_list td,
#month_list td{
	 border:1px solid rgba(127,127,127,.3);
}
#date_list td:first-child,
#raindrops_year_list td:first-child,
#month_list td:first-child{
	text-align:center;
}

	
/* @1.402 end */
/* @1.403 add */
.topsidebar .portfolio-nav{
		overflow:visible;
}

.topsidebar .portfolio-nav > ul > li a{
	padding:1em;
	display:block;
	border:1px solid #ccc;
	margin:1em;
}

.topsidebar .portfolio-nav li{
	margin:1em;
	width:20%;
}
/* @1.403 end */
/* @1.447 start */
.nav-next a, .nav-previous a{
	display:block;
	width:100%;
	height:100%;
}
.commentlist > li:nth-child(odd),
.rd-content-width-fit .topsidebar .sticky-widget:nth-child(odd),
.rd-content-width-fit.rd-pw-doc5 .index > li:nth-child(odd){
	background:#fff;
	 transition: all 1s ease-in-out;
}
.commentlist > li:nth-child(even),
.rd-content-width-fit .topsidebar .sticky-widget:nth-child(even),
.rd-content-width-fit.rd-pw-doc5 .index > li:nth-child(even){
	background:$background5;
	 transition: all 1s ease-in-out;
}

.commentlist >li{
	margin-bottom:.3em;
}
.rd-content-width-keep .index > li{
	/* @1.458
		padding:1em;*/
	/* @1.456
	margin:.5em 0;
	*/
	transition: box-shadow 1s ease-in-out;
    -webkit-transition: all 1s ease-in-out;
	box-sizing:border-box;
}
.rd-content-width-fit #ft,
.rd-content-width-keep #ft,
.rd-content-width-fit .pagination,
.rd-content-width-keep .pagination,
.rd-content-width-keep .index > li{
	background:#fff;
}

.rd-content-width-fit .pagination,
.rd-content-width-keep .pagination{
	padding-top:2.5em;
	padding-bottom:.5em;
	margin:auto;
}
.rd-content-width-fit .pagination + br,
.rd-content-width-keep .pagination + br{
	display:none;
}
.wp-caption{
	background:#fff;
}
.wp-caption:hover,
.raindrops-tag-posts li:hover,
.raindrops-category-posts li:hover,
.raindrops-recent-posts li:hover,
.rd-grid ul.search-results .click-drawing-container:hover:before,
.rd-grid ul.archives .click-drawing-container:hover:before, 
.rd-grid .archives > li:hover,
.rd-grid .search-results > li:hover,
.rd-grid .rd-content-width-keep .topsidebar .widget:hover,
.rd-content-width-keep .search-results > li:hover,
.rd-content-width-keep .commentlist > li:hover,
.rd-content-width-keep .topsidebar .widget:hover,
.rd-content-width-keep .index:not(.front-portfolio) > li:hover{
	outline:1px solid $background3;
    box-shadow: 0px 0px 6px 3px $background4;
    -moz-box-shadow: 0px 0px 6px 3px $background4;
    -webkit-box-shadow: 0px 0px 6px 3px $background4;
    transition: box-shadow 0.5s ease-in-out;
    -webkit-transition: box-shadow 0.5s ease-in-out;
}
.rd-grid ul.search-results .click-drawing-container:hover:before,
.rd-grid ul.archives .click-drawing-container:hover:before{
	outline:none;
	cursor:pointer;
}
.rd-content-width-keep .topsidebar .widget.raindrops-pinup-entries:hover,
.rd-grid .topsidebar .widget.raindrops-pinup-entries:hover,
.rd-content-width-keep ul.index > .title-wrapper:hover{
	outline:none;
	border:none;
    box-shadow:none;
    -moz-box-shadow:none;
    -webkit-box-shadow:none;
    transition: none;
    -webkit-transition: none;	
}
.rd-content-width-keep .index > .title-wrapper{
	border-bottom:none;	
}


/* @1.447 end */
/* @1.448 */
.index article{
    margin-bottom:0;
}
/* @1.469
.raindrops-no-keep-content-width div[id^="post-"]{
    margin-top:0;
}*/
.raindrops-keep-content-width ul.archive > li,
.raindrops-keep-content-width ul.index > li {
    margin:.5em 0;
}
.rd-col-1.rd-content-width-fit ul.archive > li,
.rd-col-1.rd-content-width-fit ul.index > li {
    margin:0;
}
.raindrops-keep-content-width ul.archive > li > div,
.raindrops-keep-content-width ul.index > li > div{
    box-sizing:border-box;
    background-origin:border-box;
    overflow:hidden;
}
/* @1.448 */
/* @1.453 start */

/* @1.453 end */
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
.sticky-widget #wp-calendar tbody td[colspan]{
	 background: repeating-linear-gradient( 135deg, transparent, rgba(127,127,127,.3) 2px, rgba(127,127,127,.1) 3px, rgba(127,127,127,.1) 5px );
}
.sticky-widget #wp-calendar tbody #today a{
	padding:.6em;
	
}
/* @1.453 */

.ghost-s.rd-notice,
.ghost-m.rd-notice,
.ghost-l.rd-notice,
.ghost.rd-notice,
.ghost-s.rd-info,
.ghost-m.rd-info,
.ghost-l.rd-info,
.ghost.rd-info,
.ghost-s.rd-alert,
.ghost-m.rd-alert,
.ghost-l.rd-alert,
.ghost.rd-alert,
.ghost-s.rd-notice-bg,
.ghost-m.rd-notice-bg,
.ghost-l.rd-notice-bg,
.ghost.rd-notice-bg,
.ghost-s.rd-info-bg,
.ghost-m.rd-info-bg,
.ghost-l.rd-info-bg,
.ghost.rd-info-bg,
.ghost-s.rd-alert-bg,
.ghost-m.rd-alert-bg,
.ghost-l.rd-alert-bg,
.ghost.rd-alert-bg{
    background:transparent;
	color:#333;
}
.raindrops-post-format-chat > dd{
    border:1px solid #aaa;
    background-color: #F2F2F2;
}
.raindrops-post-format-chat > dd:after{
    background-color: #F2F2F2;
    border-left:1px solid #aaa;
    border-bottom:1px solid #aaa;
}

.rsidebar .raindrops-post-format-chat > dd:after,
.lsidebar .raindrops-post-format-chat > dd:after{
	background-color: #F2F2F2;
	border-left:1px solid #aaa;
	border-top:1px solid #aaa;
	border-bottom:none;
}
@media screen and (max-width : 640px){
	.raindrops-post-format-chat > dd:after{
		background-color: #F2F2F2;
		border-left:1px solid #aaa;
		border-top:1px solid #aaa;
		border-bottom:none;
	}	
}
dl.author dt{
	border-top:1px solid #aaa;
}
dl.author{
	border-bottom:1px solid #aaa;
}
.front-page-template-pages > li:nth-child(even) {
	%c5%;
}
fieldset{
	border:1px solid #aaa;
}
.raindrops-excerpt-more{
	text-align:center;
    border: 1px solid rgba(127,127,127,.3);
}
.rd-grid ul.search-results .entry-meta,
.rd-grid ul.archives .entry-meta{
    background:rgba(255,255,255,.8);
}


CSS;
	if( 'yes' == raindrops_warehouse_clone( 'raindrops_text_transform_of_title' ) ){
		$transform = 'text-transform: uppercase;';
	} else {
		$transform = '';
	}
$style .=<<<STRUCTURE_STYLE
.rd-type-minimal.rd-col-2 .raindrops-expand-width{
    width:95%;
}
/* @1.345 */
.rd-type-minimal .textwidget input[name="post_password"],
.rd-type-minimal .entry-content input[name="post_password"]{
    display:inline-block;
    padding:.2em;
    height:1.4em;
}
.rd-type-minimal input[type="submit"]{
    padding:.5em 1em;
}
.rd-type-minimal .gallery img{
    border:none;
    box-shadow:none;
    -webkit-box-shadow:none;
    -moz-box-shadow:none;
}
.rd-type-minimal .widget_meta > ul,
.rd-type-minimal .widget_pages > ul,
.rd-type-minimal .widget_nav_menu > div > ul,
.rd-type-minimal .widget_archive > ul{
    margin-left:2em;
}
.rd-type-minimal .topsidebar .widget_meta > ul,
.rd-type-minimal .topsidebar .widget_pages > ul,
.rd-type-minimal .topsidebar .widget_nav_menu > div > ul,
.rd-type-minimal .topsidebar .widget_archive > ul,
.rd-type-minimal .topsidebar > ul{
    margin-left:auto;
    margin-right:auto;
}
.rd-type-minimal .widget_recent_entries > ul{
    margin-left:.8em;
}
.rd-type-minimal .widget_rss li,
.rd-type-minimal .widget_meta li,
.rd-type-minimal .widget_pages li,
.rd-type-minimal .widget_nav_menu li,
.rd-type-minimal .widget_recent_entries li,
.rd-type-minimal .widget_archive li{
    letter-spacing:-.03em;
    list-style-type:none;
    position:relative;
}
.rd-type-minimal .widget_rss li{
	border-bottom:1px dotted #aaa;
}
.rd-type-minimal .widget_rss li .rssSummary{
     display: block;
     overflow: hidden;
     position: relative;
     text-overflow: ellipsis;
     white-space: normal;
     word-wrap: break-word;
	 border-left:4px solid;
     border-left-color:%rgba_border%;
     padding-left:1em;
}
.rd-type-minimal .widget.widget_recent_entries li a{
	font-weight:700;
	line-height:1.6;
	margin-top:0;
	{$transform}
}
.rd-type-minimal .widget_recent_entries li:last-child{
    border-bottom: 1px dotted rgba(122,122,122,.5);
}
.rd-type-minimal .widget_meta li:before,
.rd-type-minimal .widget_pages li:before,
.rd-type-minimal .widget_nav_menu li:before,
.rd-type-minimal .widget_archive li:before {
    display: inline-block;
    font-size: 2em;
    width:6px;
    height:6px;
    position: absolute;
    top:-.28em;
    left:-.2em;
}
.footer .widget_meta li:before,
.footer .widget_pages li:before,
.footer .widget_nav_menu li:before,
.footer .widget_archive li:before {
    top:-.5em;
    left:-.5em;
}
.rd-type-minimal .widget_recent_entries li:before{
    /* @1.469 */
    position: absolute;
    top:.15em;
    left:-.2em;   
}
.rd-type-minimal .topsidebar li:before{
    content:'';
    display:none;
}
.rd-type-minimal li.widget_archive ul li a{
    margin-top:0;
    padding-top:0;
    padding-bottom:0;
}
.rd-type-minimal hr{
    margin:3em auto 3em;
}
.rd-type-minimal .sticky .entry-title{
    padding-top:.3em;
}
.rd-grid .sticky .entry-title{
    padding-top:0;
}
.rd-type-minimal .recentcomments,
.rd-type-minimal .widget_recent_comments .recentcomments,
.rd-type-minimal .widget_recent_comments .recentcomments{
     margin:5px 5px 5px .8em;
}
.rd-type-minimal #access{
    width:100%;
    margin-left:0;
}
.rd-type-minimal .rd-modal:target > div{
    border:1px solid #000;
}
.rd-type-minimal #access{
    background:#fff;
    border-bottom:1px solid #ccc;
    border-top:1px solid #ccc;
}
.rd-type-minimal .widget_meta a,
.rd-type-minimal .widget_pages a,
.rd-type-minimal .widget_nav_menu a,
.rd-type-minimal .widget_recent_entries a{
    padding:.279em .56em;
	box-sizing:border-box;
}
.rd-type-minimal .widget_meta a,
.rd-type-minimal .widget_pages a,
.rd-type-minimal .widget_nav_menu a,
.rd-type-minimal .widget_recent_entries a{
	width:auto;
}
.rd-type-minimal.page-template-page-featured #doc5 .poster > li:nth-child(even){
    background:rgba(222,222,222,.4);
}
	
STRUCTURE_STYLE;
	$page_for_posts	= get_option( 'page_for_posts', false );

	if( false == is_home() && true == is_front_page() && $page_for_posts ) {

		$style .= ' .portfolio-nav > ul > li{width:33%;}';	
	}

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

global $raindrops_wp_version, $raindrops_current_theme_name,$raindrops_current_theme_slug,$raindrops_setting_type, $wp_customize;

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
$raindrops_style_type   = raindrops_warehouse_clone( 'raindrops_style_type' );//@1.430 var name change
$navigation_title_img   = raindrops_warehouse_clone( 'raindrops_heading_image' );
$position_y             = raindrops_warehouse_clone( 'raindrops_heading_image_position' );
$raindrops_header_image = raindrops_warehouse_clone( 'raindrops_header_image' );
$raindrops_header_color = raindrops_warehouse_clone( 'raindrops_default_fonts_color' );
$raindrops_footer_image = raindrops_warehouse_clone( 'raindrops_footer_image' );
$raindrops_footer_color = raindrops_warehouse_clone( 'raindrops_footer_color' );
$raindrops_footer_link_color = raindrops_warehouse_clone( 'raindrops_footer_link_color' );

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
	
	//@1.430 add $raindrops_theme_mods_key value check	
	if ( is_array($raindrops_theme_mods_key) && ! empty( $raindrops_theme_mods_key ) ) {
		
		$raindrops_theme_mods_key = array_keys( $raindrops_theme_mods_key );
		
		foreach( $raindrops_theme_mods_key as $key ){

			if( preg_match( '$raindrops$',$key)){

				$raindrops_theme_mod_options = true;
				break;
			}
		}
	}
	
}

if ( $raindrops_theme_mod_options == true && 'theme_mod' == $raindrops_setting_type ) {
		
	if ( is_admin() || $wp_customize ) {
	
			$raindrops_indv_css = raindrops_design_output($raindrops_style_type) . raindrops_color_base();
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

    global $raindrops_automatic_color;

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
    $position_y = ( int ) raindrops_warehouse_clone( 'raindrops_heading_image_position' );
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
/*
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
*/
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
            $custom_dark_bg  = apply_filters( 'raindrops_dark_dark_bg', -3 );
            $custom_dark_bg  = raindrops_colors( $custom_dark_bg, 'background' );
            $custom_light_bg = apply_filters( 'raindrops_dark_light_bg', -5 );
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

				if ( isset( ${$reg[1]} ) ) {

					$content = str_replace( $reg[0], ${$reg[1]}, $content );
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