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
 * w3standard
 * dark
 * minimal
 * light
 *
 */

/**
 * Color type dark
 *
 *
 *
 *
 */
raindrops_register_styles("dark");

function raindrops_indv_css_dark(){

$style =<<<DOC
body{
%c1%
}
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
%c_5%
}
.lsidebar,
#sidebar,
.rsidebar{
%c_4%
}


div[id^="comment-"],
.entry-content td,
cite a:link,cite a:active,cite a:visited,cite a:hover,
cite,
ul.nav li a,ul.nav li a:link,ul.nav li a:visited,
ul.nav li a:hover,ul.nav li a:active,
.entry-meta,
.home .sticky,
#top{
%c_4%
}
input[type="file"],
input[type="reset"],
input[type="submit"],
.fail-search,
#not-found ,
#access ul li.current_page_item > a,
#access ul li.current-menu-ancestor > a,
#access ul li.current-menu-item > a,
#access ul li.current-menu-parent > a,
#access ul ul a,
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
/* border:1px solid %rgba_border%;*/
%c_2%
}

input[type="file"],
input[type="reset"],
.social input[type="submit"],
input[type="submit"]{
%c_3%
}
h2 a{
background:inherit;
}
.entry div h2,.entry div h3{
}

#hd{
background-image:url(%raindrops_images_path%%raindrops_header_image%);
}

#header-image{
background-color:%custom_light_bg%!important;
}


.home .sticky,
.entry-meta{
border-top:solid 2px %c_border%;
border-bottom:solid 2px %c_border%;
}
.home .sticky{
border-top:solid 6px %c_border%;
}
.attachment .caption dt{
border-bottom:double 3px %c_border%;

}

#yui-main{
color:%raindrops_header_color%;
}
/*
ol.commentlist :hover{
background:url(%raindrops_images_path%latestbck.gif) repeat-x;
}*/
ol.tblist li{
background:transparent url(%raindrops_images_path%c.gif) 0 2px no-repeat;
}
#ft{
border-top: medium solid %c_border%;
background:url(%raindrops_images_path%%raindrops_footer_image%) repeat-x;
color:%raindrops_footer_color%;
}
#ft #wp-calendar{
border:1px solid %c_border%!important;
}

.footer-widget h2,.rsidebar h2,.lsidebar h2 {
%h2_dark_background%
%h_position_rsidebar_h2%

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
.attachment .caption dd,
ul.archive,ul.index,
.sitemap.new li,
#items li{
border-bottom:1px solid %c_border%;
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

ul.archive li,
ul.index li{

}

.pagenate{
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
.itiran,
#month_list,
#month_list td,
#raindrops_year_list td,
#calendar_wrap td,
#date_list td,
.searchform input[type="text"],
.searchform input[type="submit"],
.hentry input[type="password"],
.social textarea#comment,
.social input[type="text"],
.social input[type="submit"],
.entry-content blockquote,
td.month-date,td.month-name,td.time{
border:1px solid %c_border%;
}

.entry-content blockquote {
border-left:solid 6px %c_border%;
}
div.social{
}


li.byuser,
li.bypostauthor,
.social textarea#comment:focus,
.social input:focus,
.entry-content th{
%c3%
}
.wp-caption,
.entry-content td,
.entry-content th{
}

.searchform  input[type="submit"],
.entry-content textarea,
.entry-content input[type="password"],
.entry-content input[type="text"],
.entry-content input[type="submit"],
.entry-content input[type="reset"],
.entry-content input[type="file"],
.entry-content input[type="checkbox"],
.entry-content input[type="radio"],
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

.fail-search,
#not-found,
li.byuser,
li.bypostauthor{
border:1px solid;
}
.children:hover,
.children{

}
.reply,

#ft a,
.category32,
.archive li a,
.page .hentry .entry-title a,
.archive.category h2 a,
cite.fn,
cite a:link,
cite a:active,
cite a:visited,
cite a:hover,
#hd h1 a:link,
#hd h1 a:active,
#hd h1 a:visited,
#hd h1 a:hover,
/*ol.commentlist li :hover,*/
div.comment-body blockquote,
div.comment-body *,
div.comment-author,
div.comment-author-meta,
#site-description,
#site-title,
#site-title span a,
.home .sticky a,
.home .entry-meta a{
%c_4%
background:none!important;
}
h1{color:#fff!important;}
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
DOC;

$css3 =<<<CSS3

%gradient%

body{
background: -webkit-gradient(linear, left top, left bottom, from(%custom_dark_bg%), to(%custom_light_bg%));
background: -moz-linear-gradient(top,  %custom_dark_bg%,  %custom_light_bg%);
}
hr{
border:none;
border-top:1px solid %rgba_border%;
}

.home .sticky,
.entry-meta{
border-top:solid 2px %rgba_border%;
border-bottom:solid 2px %rgba_border%;
}
.home .sticky{
border-top:solid 6px %rgba_border%;
}
.wp-caption,
.entry-content td,
.entry-content th{
border:solid 1px %rgba_border%;
}

.attachment .caption dt{
border-bottom:3px double %rgba_border%;
}
.footer-widget h2,.rsidebar h2,.lsidebar h2 {
-webkit-border-top-right-radius: 1em;
-moz-border-radius-topright: 1em;
border-top-right-radius: 1em;
-webkit-border-top-left-radius: 1em;
-moz-border-radius-topleft: 1em;
border-top-left-radius: 1em;
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
.attachment .caption dd,
ul.archive,ul.index,
.sitemap.new li,
#items li{
border-bottom:1px solid %rgba_border%;
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
.itiran,
#month_list,
#month_list td,
#raindrops_year_list td,
#calendar_wrap td,
#date_list td,
.searchform input[type="text"],
.searchform input[type="submit"],
.hentry input[type="password"],
.social textarea#comment,
.social input[type="text"],
.social input[type="submit"],
.entry-content blockquote,
td.month-date,td.month-name,td.time{
border:1px solid %rgba_border%;
}
.searchform input:focus,
.searchform input:focus,
.social textarea:focus,
.hentry input:focus,
.social input:focus{
box-shadow: 0 0 5px %rgba_border%;
-webkit-box-shadow: 0 0 5px %rgba_border%;
-moz-box-shadow: 0 0 5px %rgba_border%;
}
.searchform input[type="text"],
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
input[type="file"],
input[type="reset"],
.searchform input[type="submit"],
input[type="submit"],
#access{
background: -webkit-gradient(linear, left top, left bottom, from(%custom_dark_bg%), to(%custom_light_bg%));
background: -moz-linear-gradient(top,  %custom_dark_bg%,  %custom_light_bg%);
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='%custom_dark_bg%', endColorstr='%custom_light_bg%');
border-radius:1em 1em 1em 1em;
-moz-border-radius:1em 1em 1em 1em;
-webkit-border-radius:1em 1em 1em 1em!important;
/*border-top:1px solid rgba(255, 255, 255, 0.3);*/
-moz-box-shadow: 1px 1px 3px #000;
-webkit-box-shadow: 1px 1px 3px #000;
}
.raindrops-tab-list li,
#access .children li,
#access a {
background: -webkit-gradient(linear, left top, left bottom, from(%custom_dark_bg%), to(%custom_light_bg%));
background: -moz-linear-gradient(top,  %custom_dark_bg%,  %custom_light_bg%);
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='%custom_dark_bg%', endColorstr='%custom_light_bg%');
color:%custom_color%;

}
.raindrops-tab-list li:active,
#access .children li:active,
#access li:active,
#access ul ul :active {
top:0;
background: -webkit-gradient(linear, left top, left bottom, from(%custom_light_bg%), to(%custom_dark_bg%));
background: -moz-linear-gradient(top,  %custom_light_bg%,  %custom_dark_bg%);
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='%custom_light_bg%', endColorstr='%custom_dark_bg%');
color:%custom_color%;
}
.wp-caption {
-moz-border-radius: 3px;
-khtml-border-radius: 3px;
-webkit-border-radius: 3px;
border-radius: 3px;
background: -webkit-gradient(linear, left top, left bottom, from(%custom_dark_bg%), to(%custom_light_bg%));
background: -moz-linear-gradient(top,  %custom_dark_bg%,  %custom_light_bg%);
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='%custom_dark_bg%', endColorstr='%custom_light_bg%');
}
.entry-content blockquote {
border-left:solid 6px %rgba_border%;
}
#header-image p{
text-shadow: 2px 2px 2px #000;
}
.raindrops-tab-content,
.raindrops-tab-list li{
border:1px solid rgba(200,200,200,0.3);

}

CSS3;
return $style.$css3;
}
?>
<?php

/**
 * w3standard
 *
 *
 *
 *
 */
raindrops_register_styles("w3standard");

function raindrops_indv_css_w3standard(){

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
    background-image:url(%raindrops_images_path%%raindrops_header_image%);
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
%c5%
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
.raindrops-tab-content,
.raindrops-tab-list li{
border:1px solid %c_border%;

}

DOC;
return $style;
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
raindrops_register_styles("light");

function raindrops_indv_css_light(){

$style =<<<DOC

.footer-widget h2,.rsidebar h2,.lsidebar h2 {

    %h2_light_background%;
    %h_position_rsidebar_h2%
}

body{
    margin:0!important;
    %c4%
}
#top{
    %c5%
}


.hfeed{
    %c5%
}

h2,h3{
    %c5%
}
.home .sticky {
    %c4%
}

.entry-meta{
    %c4%
}

.home .sticky a{
    background-color: none;

}
#yui-main{

    /*%c5%*/
 color:%raindrops_header_color%;
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
   color:#000;

    background:#fff url(%raindrops_images_path%%raindrops_header_image%);

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
    %c4%
}
ul.nav li a:hover,ul.nav li a:active{
    %c4%
}

.rsidebar{
}

.postmetadata{
    %c5%
}
/*
ol.commentlist :hover{background:url(%raindrops_images_path%latestbck.gif) repeat-x;}
ol.commentlist li :hover{background:none;}*/
ol.tblist li{background:transparent url(%raindrops_images_path%c.gif) 0 2px no-repeat;}

#ft{
    %c3%
    border-top: medium solid %c_border%;
    background:url(%raindrops_images_path%%raindrops_footer_image%) repeat-x;
    color:%raindrops_footer_color%;
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

}
.sitemap.new li{
    border-bottom:1px solid %c_border%;
}
.social{

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

ul.archive li,
ul.index li{

}
table,
table td{
    border:1px solid %c_border%;
}

td.month-date,td.month-name,td.time{
   %c_3%
    border-bottom:1px solid %c_border%;
}

td.month-date,td.month-name,td.time{
    %c3%
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
    %c4%
}
input[type="checkbox"],
input[type="radio"],
select{
    %c4%
}

.social textarea#comment:focus,
.social input[type="text"]:focus{

    border:1px solid %c_border%;
}
.social input[type="submit"] {
    border:double 3px %c_border%;
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
.entry-content select{
    %c4%
    border:double 3px %c_border%;
}

.entry-content textarea{
    border:double 3px %c_border%;
}

/*--------------------------------*/
#access{




}
#access a {
}
#access ul ul a {
    %c3%
}
#access .children li:active >a,
#access li:active >a ,
#access ul ul :active >a{
    top:0;
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
address{
    margin:10px auto;
}


#bd a,
.postmetadata{
background:none!important;
}

.wp-caption {
   border:solid 1px #999;
}
li.byuser,
li.bypostauthor {
    %c_3%
    border:solid 1px %c_border%;
}
cite.fn{
    background:none;
}

.datetable td li{
}
.fail-search,
#not-found {
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


$css3=<<<CSS3

%gradient%

body{
    background: -webkit-gradient(linear, left top, left bottom, from(%custom_dark_bg%), to(%custom_light_bg%));
    background: -moz-linear-gradient(top,  %custom_dark_bg%,  %custom_light_bg%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='%custom_dark_bg%', endColorstr='%custom_light_bg%');
}

.hfeed{
    box-shadow: 0 0 5px %rgba_border%;
    -webkit-box-shadow: 0 0 5px %rgba_border%;
    -moz-box-shadow: 0 0 5px %rgba_border%;

}

.home .sticky {
    border-top:solid 6px %rgba_border%;
    border-bottom:solid 2px %rgba_border%;

}

.entry-meta{

    border-top:solid 2px %rgba_border%;
    border-bottom:solid 2px %rgba_border%;
}
.footer-widget h2,.rsidebar h2,.lsidebar h2 {
    -webkit-border-top-left-radius: 1em;
    -moz-border-radius-topleft: 1em;
    border-top-left-radius: 1em;
    -webkit-border-bottom-right-radius: 1em;
    -moz-border-radius-bottomright: 1em;
    border-bottom-right-radius: 1em;
}
.rsidebar ul li ul li,
.lsidebar ul li ul li{
    border-bottom:1px solid %rgba_border%;
}
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
table td{
    border:1px solid %rgba_border%;
}
td.month-date,td.month-name,td.time{
    border:1px solid %rgba_border%;

}
fieldset {
    border:1px solid %rgba_border%;
}
hr{
border-top:1px dashed %rgba_border%;
}
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
}
.social input[type="submit"] {
    border:double 3px %rgba_border%;
}

.entry-content th{
    border:solid 1px %rgba_border%;
}
.entry-content input[type="submit"],
.entry-content input[type="reset"],
.entry-content input[type="file"]{
    border:double 3px %rgba_border%;

}
.entry-content input[type="checkbox"],
.entry-content input[type="radio"]{
    border:double 3px %rgba_border%;
}
.entry-content select{
    border:double 3px %rgba_border%;
}

.entry-content textarea{
    background: %rgba_border%
    border:double 3px %rgba_border%;
}

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
    background: -webkit-gradient(linear, left top, left bottom, from(%custom_dark_bg%), to(%custom_light_bg%))!important;
    background: -moz-linear-gradient(top,  %custom_dark_bg%,  %custom_light_bg%)!important;
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='%custom_dark_bg%', endColorstr='%custom_light_bg%');
    color:%custom_color%;
}
#access .children li:active >a,
#access li:active >a ,
#access ul ul :active >a{
    background: -webkit-gradient(linear, left top, left bottom, from(%custom_light_bg%), to(%custom_dark_bg%))!important;
    background: -moz-linear-gradient(top,  %custom_light_bg%,  %custom_dark_bg%)!important;
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='%custom_light_bg%', endColorstr='%custom_dark_bg%');
    color:%custom_color%;
}

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
li.byuser,
li.bypostauthor {
    border:solid 1px %rgba_border%;

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

CSS3;
return $style.$css3;
}
?>
<?php
/////////////////////////////////////////////////
/**
 * Color type minimal
 *
 *
 *
 *
 */
raindrops_register_styles("minimal");

function raindrops_indv_css_minimal(){
global $raindrops_base_color;
    $font_color = raindrops_colors(5,"color");
    $gradient_4d = raindrops_gradient_single_clone(4,"desc");
    $gradient_3a = raindrops_gradient_single_clone(3,"asc");

$style =<<<DOC
@import url(http://fonts.googleapis.com/css?family=Ubuntu+Condensed);

#access ul ul.children a{
    background:#fff;
}
.searchform{
    padding-top:3px;
    padding-bottom:3px;
}
a{

    text-decoration:underline;
}
.sticky a,
address a,
.nav-previous a,
#doc,#doc2,#doc3,#doc4{
background:$raindrops_base_color;
}
#ft,
#top{
    $gradient_4d

    $footer_image
}
/*navigation*/


#access{
    background:#000;
    color:#eef;
}
#access a{
    color:#fff;
}
#nav-below,
.entry-meta-default,
.posted-on,
div.entry-content{
margin:10px;
}
.lsidebar,.rsidebar{
display:none!important;
}
.lsidebar > ul,.rsidebar > ul{

margin-top:5px;
}
.raindrops-tab-list li{
$gradient_4d
}
.raindrops-tab-content{
$gradient_4d
}
li.widget{
margin-bottom:10px!important;
$gradient_4d
border:1px solid #ccc;
}
/*entry*/

.hentry{
    border:1px solid #ccc;
    $gradient_4d
}
.single-post .hentry{
    border:none;
}

/* titles */
.entry-title{
margin:0;
    font-family: 'Ubuntu Condensed', sans-serif;
    $gradient_3a
    text-indent:1em;
}

.single-post .hentry h2,
.single-post .hentry{
}

.widget h2{
    margin-top:0;

}
.sticky .entry-title{
background:none;
}
/*comments*/
h2#comments-title,
.hentry div#comments{
    background:#fff;
}

a,
#yui-main{
    color:%raindrops_header_color%;
}
#datelist table,
#raindrops_year_list,
#raindrops_year_list td,
#month_list,
#month_list td,
#datelist,
#date_list td{
border:solid 1px %c_border%!important;
}
.footer-widget h2,.rsidebar h2,.lsidebar h2 {
%c5%
%h2_w3standard_background%
%h_position_rsidebar_h2%
}
.entry-content blockquote{
%c5%
border-left:solid 3px %c_border%;
}
cite{
%c5%
}
cite a:link,cite a:active,cite a:visited,cite a:hover{
%c5%
background:none!important;
}
li.byuser,
li.bypostauthor {
%c3%
}
cite.fn{
    background:none;
}
.datetable td li{
    border-bottom:solid 1px %c_border%;
}
.fail-search,
#not-found {
border:3px double;
}
th{
%c4%
}
td{


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
.raindrops-tab-list li{

border-bottom:none;
}
.raindrops-tab-list li a{
$gradient_4d
color:#000;
}
DOC;

$style=<<<CSSB
a{color:#333;}
a:hover{color:#777;}
#hd #header-image{display:none;}
CSSB;

$css3 =<<<CSS3

%gradient%

#access .children li,
#datelist table,
#raindrops_year_list,
#raindrops_year_list td,
#month_list,
#month_list td,
#datelist,
#date_list td{
    border:1px solid %rgba_border%!important;
}
.home .sticky {
    border-top:solid 6px %rgba_border%;
    border-bottom:solid 2px %rgba_border%;
}
.datetable td li,
th,
td{
    border-bottom:solid 1px %rgba_border%;
}
.raindrops-tab-content,
.raindrops-tab-list li{
    border:1px solid %rgba_border%;
}
CSS3;

return $style;
}
?>
<?php
    if(!defined('ABSPATH')){exit;}
    $alias_functions = get_stylesheet_directory().'/lib/alias_functions.php';
    if(!in_array($alias_functions,$included_files)){
         get_template_part('lib/alias_functions');
    }
    $embed_common_style = get_current_theme();
    raindrops_register_styles($embed_common_style);
    $raindrops_images_path            = get_stylesheet_directory_uri().'/images/';
    $raindrops_base_color                  = raindrops_warehouse_clone('raindrops_base_color');
    $style_type             = raindrops_warehouse_clone('raindrops_style_type');
    $navigation_title_img   = raindrops_warehouse_clone('raindrops_heading_image');
    $position_y             = raindrops_warehouse_clone('raindrops_heading_image_position');
    $raindrops_header_image       = raindrops_warehouse_clone('raindrops_header_image');
    $raindrops_header_color       = raindrops_warehouse_clone('raindrops_default_fonts_color');
    $raindrops_footer_image       = raindrops_warehouse_clone('raindrops_footer_image');
    $raindrops_footer_color       = raindrops_warehouse_clone('raindrops_footer_color');
    define("BASE_COLOR1",$raindrops_base_color);
/**
 * save stylesheet
 *
 */
    $raindrops_indv_css     = raindrops_design_output($style_type).raindrops_color_base();
    $raindrops_options      = get_option("raindrops_theme_settings");
        // if not handmade css. theme name style type is handmade
if(raindrops_warehouse_clone("raindrops_style_type") !== get_current_theme() ){
    if(is_array($raindrops_options)){

            if(array_key_exists('_raindrops_indv_css',$raindrops_options)){
                $raindrops_options['_raindrops_indv_css'] = $raindrops_indv_css;
            }else{
                $add_array              = array('_raindrops_indv_css'=> $raindrops_indv_css );
                $raindrops_options      = array_merge($raindrops_options,$add_array);
            }
            update_option("raindrops_theme_settings",$raindrops_options);

    }else{
        $raindrops_options['_raindrops_indv_css'] = $raindrops_indv_css;
        add_option("raindrops_theme_settings",$raindrops_options );
    }
}
/**
 * Create CSS Color Declaration
 *
 *
 *
 *
 */
    function raindrops_colors($num = 0, $select = 'set',$color1 = null){
        global $raindrops_images_path;
        if($color1 == null){
            $color1 = str_replace('#',"",BASE_COLOR1);
        }else{
            $color1 = str_replace('#',"",$color1);
        }
            $base = new CSS_Color( $color1 );
        switch($num){
        case(0):
            $bg         = $base->bg['0'];
            $fg         = $base->fg['0'];
            $color  = "color:#$fg;background-color:#$bg;";
            break;
            case(-1):
            $bg         = $base->bg['-1'];
            $fg         = $base->fg['-1'];
            $color  = "color:#$fg;background-color:#$bg;";
            break;
            case(-2):
            $bg         = $base->bg['-2'];
            $fg         = $base->fg['-2'];
            $color  = "color:#$fg;background-color:#$bg;";
            break;
            case(-3):
            $bg         = $base->bg['-3'];
            $fg         = $base->fg['-3'];
            $color  = "color:#$fg;background-color:#$bg;";
            break;
            case(-4):
            $bg         = $base->bg['-4'];
            $fg         = $base->fg['-4'];
            $color  = "color:#$fg;background-color:#$bg;";
            break;
            case(-5):
            $bg         = $base->bg['-5'];
            $fg         = $base->fg['-5'];
            $color  = "color:#$fg;\n\tbackground-color:#$bg;";
            break;
            case(1):
            $bg         = $base->bg['+1'];
            $fg         = $base->fg['+1'];
            $color  = "color:#$fg;\n\tbackground-color:#$bg;";
            break;
            case(2):
            $bg         = $base->bg['+2'];
            $fg         = $base->fg['+2'];
            $color  = "color:#$fg;\n\tbackground-color:#$bg;";
            break;
            case(3):
            $bg         = $base->bg['+3'];
            $fg         = $base->fg['+3'];
            $color  = "color:#$fg;\n\tbackground-color:#$bg;";
            break;
            case(4):
            $bg         = $base->bg['+4'];
            $fg         = $base->fg['+4'];
            $color  = "color:#$fg;\n\tbackground-color:#$bg;";
            break;
            case(5):
            $bg         = $base->bg['+5'];
            $fg         = $base->fg['+5'];
            $color  = "color:#$fg;\n\tbackground-color:#$bg;";
            break;
            default:
            $bg         = $base->bg['0'];
            $fg         = $base->fg['0'];
            $color  = "color:#$fg;\n\tbackground-color:#$bg;";
            break;
        }
        switch($select){
            case('set'):
            return $color;
            break;
            case('background'):
            return '#'.$bg;
            break;
            case('color'):
            return '#'.$fg;
            break;
        }
    }

/**
 * Create gradient style
 *
 *
 *
 *
 */

function raindrops_gradient_css($color = null,$num = 0,$diff = 1,$order = 'asc'){
        global $raindrops_images_path;
        if($color == null){
            $color = str_replace('#',"",BASE_COLOR1);
        }else{
            $color = str_replace('#',"",$color);
        }

        $base = new CSS_Color( $color );

        if($num>4){$num = 4;}
        if($num + $diff > 4){$num = 4 - $diff;}
        if($order == "asc"){
            $custom_dark_bg1 = raindrops_colors($num, 'background',$color);

            $num2 = (int)$num + $diff;

            $custom_light_bg1 = raindrops_colors($num2, 'background',$color);
            if(isset($base->fg[$num])){
            $fg         = $base->fg[$num];
            }else{
            $fg         = "";
            }

        }elseif($order == "desc"){
            $custom_dark_bg1 = $base->bg[$num + $diff];
            $custom_light_bg1 = $base->bg[$num];
            if(isset($base->fg[$num])){
            $fg         = $base->fg[$num];
            }else{
            $fg         = "";
            }
        }
        $g = 'color:#'.$fg.';';
        $g .= 'background: -webkit-gradient(linear, left top, left bottom, from('.$custom_dark_bg1.'), to('.$custom_light_bg1.'));';
        $g .= 'background: -moz-linear-gradient(top,  '.$custom_dark_bg1.',  '.$custom_light_bg1.');';
        $g .= 'filter: progid:DXImageTransform.Microsoft.gradient(startColorstr=\''.$custom_dark_bg1.'\', endColorstr=\''.$custom_light_bg1.'\');';
        return $g;
    }
/**
 * Base Color Class Create
 *
 *
 *
 *
 */
    function raindrops_color_base($color1=null,$color2=null){
    global $raindrops_images_path;
    if($color1 == null){
        $color1 = str_replace('#',"",BASE_COLOR1);
    }else{
        $color1 = str_replace('#',"",$color1);
    }
        $base = new CSS_Color($color1);
        $bg_1 = $base->bg['-1'];
        $fg_1 = $base->fg['-1'];
        $bg_2 = $base->bg['-2'];
        $fg_2 = $base->fg['-2'];
        $bg_3 = $base->bg['-3'];
        $fg_3 = $base->fg['-3'];
        $bg_4 = $base->bg['-4'];
        $fg_4 = $base->fg['-4'];
        $bg_5 = $base->bg['-5'];
        $fg_5 = $base->fg['-5'];
        $bg1 = $base->bg['+1'];
        $fg1 = $base->fg['+1'];
        $bg2 = $base->bg['+2'];
        $fg2 = $base->fg['+2'];
        $bg3 = $base->bg['+3'];
        $fg3 = $base->fg['+3'];
        $bg4 = $base->bg['+4'];
        $fg4 = $base->fg['+4'];
        $bg5 = $base->bg['+5'];
        $fg5 = $base->fg['+5'];






        $result=<<<CSS
.color-1{
  background:#{$bg_1};
  color:#{$fg_1};
}
.color-2 {
  background:#{$bg_2};
  color:#{$fg_2};
}
.color-3 {
  background:#{$bg_3};
  color:#{$fg_3};
}
.color-4 {
  /** Use the base color, two shades darker */
  background:#{$bg_4};
  /** Use the corresponding foreground color */
  color:#{$fg_4};
}
.color-5 {
  background:#{$bg_5};
  color:#{$fg_5};
}
.color1{
  background:#{$bg1};
  color:#{$fg1};
}
.color2 {
  background:#{$bg2};
  color:#{$fg2};
}
.color3 {
  background:#{$bg3};
  color:#{$fg3};
}
.color4 {
  /** Use the base color, two shades darker */
  background:#{$bg4};
  /** Use the corresponding foreground color */
  color:#{$fg4};
}
.color5 {
  background:#{$bg5};
  color:#{$fg5};
}
.face-1{
  color:#{$fg_1};
}
.face-2 {
  color:#{$fg_2};
}
.face-3 {
  color:#{$fg_3};
}
.face-4 {
  color:#{$fg_4};
}
.face-5 {
  color:#{$fg_5};
}
.face1{
  color:#{$fg1};
}
.face2 {
  color:#{$fg2};
}
.face3 {
  color:#{$fg3};
}
.face4 {
  color:#{$fg4};
}
.face5 {
  color:#{$fg5};
}
CSS;
    return $result;
    }
/**
 * from hex color #000000 to rgba color
 *
 *
 *
 *
 */
    function raindrops_hex2rgba($color,$opecity){
        if ($color[0] == '#')
            $color = substr($color, 1);
        if (strlen($color) == 6)
            list($r, $g, $b) = array($color[0].$color[1],
                                     $color[2].$color[3],
                                     $color[4].$color[5]);
        elseif (strlen($color) == 3)
            list($r, $g, $b) = array($color[0].$color[0], $color[1].$color[1], $color[2].$color[2]);
        else
            return false;
        $r = hexdec($r); $g = hexdec($g); $b = hexdec($b);
        return "rgba({$r}, {$g}, {$b},{$opecity})";
    }
/**
 * Style template and Declaration merge
 *
 * %something% to Declaration value
 *
 *
 */
/*    function raindrops_design_output($name = 'default'){

    }
/**
 * Declaration Calculator
 *
 *
 *
 *
 */
    function raindrops_design_output($name = 'dark'){

        $raindrops_images_path            = get_stylesheet_directory_uri().'/images/';
        $navigation_title_img   = raindrops_warehouse_clone('raindrops_heading_image');
        $raindrops_header_image       = raindrops_warehouse_clone('raindrops_header_image');
        $raindrops_header_color       = raindrops_warehouse_clone('raindrops_default_fonts_color');

        $raindrops_footer_image       = raindrops_warehouse_clone('raindrops_footer_image');
        $raindrops_footer_color       = raindrops_warehouse_clone('raindrops_footer_color');

        if(empty($name)){ $name = 'dark';}

        $c_border   = raindrops_colors(0,'background');
        if($c_border == '#'){
            $rgba_border = 'rgba(203,203,203, 0.8)';
        }else{
            $rgba_border = raindrops_hex2rgba($c_border,0.5);
        }

        $c1 = raindrops_colors(0);
        $c1 = raindrops_colors(1);
        $c2 = raindrops_colors(2);
        $c3 = raindrops_colors(3);
        $c4 = raindrops_colors(4);
        $c5 = raindrops_colors(5);
        $c_1 = raindrops_colors(-1);
        $c_2 = raindrops_colors(-2);
        $c_3 = raindrops_colors(-3);
        $c_4 = raindrops_colors(-4);
        $c_5 = raindrops_colors(-5);

        $position_y = raindrops_warehouse_clone('raindrops_heading_image_position');
        $y = $position_y * 26;
        $y = '-'.$y.'px';
        switch( $position_y ){
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
            $h2_w3standard_background = "background:".raindrops_colors(5,'background').' ';
            $h2_w3standard_background .= "url({$raindrops_images_path}{$navigation_title_img});";
            $h2_w3standard_background .= "color:".raindrops_colors(4,'color').';';
            $h2_dark_background = "background:".raindrops_colors(-3,'background').' ';
            $h2_dark_background .= "url({$raindrops_images_path}{$navigation_title_img});";
            $h2_dark_background .= "color:".raindrops_colors(-3,'color').';';
            $h2_light_background = "background:".raindrops_colors(4,'background').' ';
            $h2_light_background .= "url({$raindrops_images_path}{$navigation_title_img});";
            $h2_light_background .= "color:".raindrops_colors(4,'color').';';





        switch($name){
            case("w3standard"):
                $custom_dark_bg = raindrops_colors('3','background');
                $custom_light_bg = raindrops_colors('1','background');
                $custom_color = raindrops_colors('1','color');
                if(!empty($raindrops_footer_color)){
                    $raindrops_footer_color = $raindrops_footer_color;
                }else{
                    $raindrops_footer_color = '#000';
                }
                if(!empty($raindrops_header_color)){
                    $raindrops_header_color = $raindrops_header_color;
                }else{
                    $raindrops_header_color = '#000';
                }
                $gradient = raindrops_gradient_clone();
            break;
            case("dark"):
            /**
             *dark
             */
                $custom_dark_bg = raindrops_colors('-1','background');
                $custom_light_bg = raindrops_colors('-4','background');
                $custom_color = raindrops_colors('-3','color');
                if(!empty($raindrops_footer_color)){
                    $raindrops_footer_color = $raindrops_footer_color;
                }else{
                    $raindrops_footer_color = '#fff';
                }
                if(!empty($raindrops_header_color)){
                    $raindrops_header_color = $raindrops_header_color;
                }else{
                    $raindrops_header_color = '#fff';
                }
                $gradient = raindrops_gradient_clone();
            break;
            case("light"):
            /**
             * light
             */
                $custom_dark_bg = raindrops_colors('5','background');
                $custom_light_bg = raindrops_colors('3','background');
                $custom_color = raindrops_colors('3','color');
                $base_gradient = raindrops_gradient_single_clone(3,"asc");
                if(!empty($raindrops_footer_color)){
                    $raindrops_footer_color = $raindrops_footer_color;
                }else{
                    $raindrops_footer_color = '#333';
                }
                if(!empty($raindrops_header_color)){
                    $raindrops_header_color = $raindrops_header_color;
                }else{
                    $raindrops_header_color = '#333';
                }
                $gradient = raindrops_gradient_clone();
            break;
            default:
                $custom_dark_bg = raindrops_colors('3','background');
                $custom_light_bg = raindrops_colors('1','background');
                $custom_color = raindrops_colors('1','color');
                if(!empty($raindrops_footer_color)){
                    $raindrops_footer_color = $raindrops_footer_color;
                }else{
                    $raindrops_footer_color = '#000';
                }
                if(!empty($raindrops_header_color)){
                    $raindrops_header_color = $raindrops_header_color;
                }else{
                    $raindrops_header_color = '#000';
                }
                $gradient = raindrops_gradient_clone();
            break;
        }


        $function_name = 'raindrops_indv_css_'.$name;

        if(function_exists($function_name)){

            $content = $function_name();

            foreach(explode(' ',$content,-1) as $line){

                preg_match_all('|%([a-z0-9_-]+)?%|si',$line,$regs,PREG_SET_ORDER);

                foreach($regs as $reg){
                    if(isset($$reg[1])){
                        $content = str_replace($reg[0],$$reg[1],$content);
                    }else{
                        $content = str_replace($reg[0],'/*cannot bind data [%'.$reg[1].'%]*/',$content);
                    }
                }
            }
            return apply_filters("raindrops_colors", $content);

        }
    }
/**
 * register style name
 *
 *
 *
 *
 */
function raindrops_register_styles($style_name){

    static $vals;

    $vals[$style_name] = $style_name;

    return $vals;

}
?>