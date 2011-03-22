<?php
/**
 * create individual stylesheet
 *
 *
 * @package WordPress
 * @subpackage Raindrops
 * @since Raindrops 0.1
 */
?>
<?php
/** Style Settings INDEX
 *
 * default
 * dark
 * minimal
 * light
 *
 */

/**
 * dark
 *
 *
 *
 *
 */

function raindrops_dark(){

$style =<<<DOC
%gradient%
body{
background: -webkit-gradient(linear, left top, left bottom, from(%custom_dark_bg%), to(%custom_light_bg%));
background: -moz-linear-gradient(top,  %custom_dark_bg%,  %custom_light_bg%);
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='%custom_dark_bg%', endColorstr='%custom_light_bg%');
}
#top{
%c_4%
}
h2 a{
background:inherit;
}
.entry div h2,.entry div h3{
}
.entry ol ol ,.entry ul {
%c_5%
}
.entry ul * {
%c_5%
}
.home .sticky {
background:%c_4%
border-top:solid 6px %rgba_border%;
border-bottom:solid 2px %rgba_border%;
}
.entry-meta{
background:%c_4%
border-top:solid 2px %rgba_border%;
border-bottom:solid 2px %rgba_border%;
}
.home .sticky a,
.home .entry-meta a{
background:none;
}
#yui-main{
%c_5%
color:%tmn_header_color%;
}
#hd{
%c_5%
background-image:url(%images_path%%tmn_header_image%);
}
#site-description,
#hd h1,
.h1,
#site-title{
background:none;
}

#header-image{
background-color:%custom_light_bg%!important;
}
#doc,#doc2,#doc3,#doc4{
%c_5%
}
#nav{
%c_3%
}
ul.nav{
%c_3%
}
ul.nav li a,ul.nav li a:link,ul.nav li a:visited{
%c_4%
}
ul.nav li a:hover,ul.nav li a:active{
%c_4%
}
#sidebar{
%c_5%
}
.rsidebar{
%c_5%
}
div.comment-body blockquote{
background:none!important;
}
ol.commentlist :hover{
background:url(%images_path%latestbck.gif) repeat-x;
}
ol.commentlist li :hover{background:none;}
ol.tblist li{
background:transparent url(%images_path%c.gif) 0 2px no-repeat;
}
#ft{
%c_3%
border-top: medium solid %c_border%;
background:url(%images_path%%tmn_footer_image%) repeat-x;
color:%tmn_footer_color%;
}
#ft #wp-calendar{
%c_3%
border:1px solid %c_border%!important;
}
.lsidebar{
%c_5%
}
.footer-widget h2,.rsidebar h2,.lsidebar h2 {
%c_3%
%h2_dark_background%
%h_position_rsidebar_h2%
-webkit-border-top-right-radius: 1em;
-moz-border-radius-topright: 1em;
border-top-right-radius: 1em;
-webkit-border-top-left-radius: 1em;
-moz-border-radius-topleft: 1em;
border-top-left-radius: 1em;
}
a:link,a:active,a:visited,a:hover{
%c_5%
}
#hd h1 a:link,#hd h1 a:active,#hd h1 a:visited,#hd h1 a:hover{
%c_3%
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
ul.archive,ul.index{
margin:2em 0;border-bottom:
1px solid %c_border%;
border-bottom:1px solid %rgba_border%;
}
.sitemap.new li{
border-bottom:1px solid %c_border%;
}
.social{
border-top:3px double %c_border%;
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
/*  border-top:1px solid %c_border%;
border-top:1px solid %rgba_border%;*/
}
.itiran{
border:1px solid %c_border%;
}
.pagenate{
}
#month_list,
#month_list td,
#year_list td,
#calendar_wrap td,
#date_list td{
border:1px solid %c_border%;
border:1px solid %rgba_border%;
}
td.month-date,td.month-name,td.time
{
%c_3%
border-bottom:1px solid %c_border%;
border:1px solid %rgba_border%;
}
.entry-content blockquote {
border-left:solid 3px %c_border%;
%c_3%
}
cite{
%c_4%
}
cite a:link,cite a:active,cite a:visited,cite a:hover{
%c_4%
background:none!important;
}
fieldset {
border:1px solid %rgba_border%;
}
legend{
%c_5%
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
%c_3%
}
.social textarea#comment:focus,
.social input:focus{
box-shadow: 0 0 5px %rgba_border%;
-webkit-box-shadow: 0 0 5px %rgba_border%;
-moz-box-shadow: 0 0 5px %rgba_border%;
/* border:1px solid %rgba_border%;*/
%c3%
}
.social input[type="submit"] {
border:double 3px %rgba_border%;
background: %c3%
}
.entry-content td{
%c_4%
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
background: %c3%
}
.entry-content input[type="checkbox"],
.entry-content input[type="radio"]{
background: %c3%
border:double 3px %rgba_border%;
}
.entry-content select{
background: %c3%
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
	background: -webkit-gradient(linear, left top, left bottom, from(%custom_dark_bg%), to(%custom_light_bg%));
background: -moz-linear-gradient(top,  %custom_dark_bg%,  %custom_light_bg%);
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='%custom_dark_bg%', endColorstr='%custom_light_bg%');
color:%custom_color%;
}
#access ul ul a {
%c_3%
/* border:1px solid %rgba_border%;*/
}
#access li:active > a,
#access ul ul :active > a {
/*%c_2%*/
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
/* border:1px solid %rgba_border%;*/
%c_3%
}
* html #access ul li.current_page_item a,
* html #access ul li.current-menu-ancestor a,
* html #access ul li.current-menu-item a,
* html #access ul li.current-menu-parent a,
* html #access ul li a:hover {
/* border:1px solid %rgba_border%;*/
%c_2%
}
address{margin:10px auto;}
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
li.bypostauthor{
%c3%
}
cite.fn{
	background:none;
}
div[id^="comment-"]{
%c_4%

}
.children:hover,
.children{

}
.datetable td li{
	border-bottom:solid 1px %rgba_border%;
}
.datetable td li:nth-last-child(1){
	border-bottom:none;

}

DOC;

return $style;
}
?>
<?php

/**
 * default
 *
 *
 *
 *
 */

function raindrops_default(){

$style =<<<DOC
%gradient%

body {

margin:0!important;padding:0;
	background-repeat:repeat-x;
}
#yui-main{
	color:%tmn_header_color%;
}
#hd{
	background-image:url(%images_path%%tmn_header_image%);
}
.hfeed{
    background:#fff;
    box-shadow: 0 0 15px rgba(51,51,51,0.6);
    -webkit-box-shadow: 0 0 15px rgba(51,51,51,0.6);
    -moz-box-shadow: 0 0 15px rgba(51,51,51,0.6);
	border:1px solid #fff;
	border-top:none;
}
#ft {
	background:url(%images_path%%tmn_footer_image%) repeat-x;
	color:%tmn_footer_color%;
}

.footer-widget h2,
.rsidebar h2,
.lsidebar h2 {
%h2_default_background%
%h_position_rsidebar_h2%
}
.home .sticky {
background: %c4%
border-top:solid 6px %c_border%;
border-bottom:solid 2px %c_border%;
border-top:solid 6px %rgba_border%;
border-bottom:solid 2px %rgba_border%;

}
.entry-meta{
background: %c4%
border-top:solid 2px %c_border%;
border-bottom:solid 2px %c_border%;
border-top:solid 2px %rgba_border%;
border-bottom:solid 2px %rgba_border%;


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
    border:1px solid %rgba_border%;
    background: %c3%

}

.social textarea#comment:focus,
.social input:focus{
    box-shadow: 0 0 5px %rgba_border%;
    -webkit-box-shadow: 0 0 5px %rgba_border%;
    -moz-box-shadow: 0 0 5px %rgba_border%;
  /*  border:1px solid %rgba_border%;*/
    background: %c4%

}

.entry-content input[type="submit"],
.entry-content input[type="reset"],
.entry-content input[type="file"]{

border:double 3px %rgba_border%;
background: %c4%
}
.entry-content input[type="submit"],
.entry-content input[type="radio"]{
background: %c3%
border:double 3px %rgba_border%;
}
.entry-content select{
background: %c4%
border:double 3px %rgba_border%;
}

.entry-content blockquote{

    %c4%
    border-left:solid 3px %c_border%;


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
    border:1px solid %rgba_border%;
}
.entry-content legend{
    %c5%
}

.entry-content td{
    %c4%
    border:solid 1px %c_border%;
    border:solid 1px %rgba_border%
}
.entry-content th{
    %c3%
    border:solid 1px %c_border%;
    border:solid 1px %rgba_border%;
}
.entry-content tr:nth-child(even) {
    background-color:rgba(255,255,255,0.3);
}
/*--------------------------------*/

#access{
    /*%c3%*/
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
    /*%c3%*/

    background: -webkit-gradient(linear, left top, left bottom, from(%custom_dark_bg%), to(%custom_light_bg%));
    background: -moz-linear-gradient(top,  %custom_dark_bg%,  %custom_light_bg%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='%custom_dark_bg%', endColorstr='%custom_light_bg%');
    color:%custom_color%
}
#access ul ul a {

    %c3%
    border:1px solid %rgba_border%;

}
#access li:active > a,
#access ul ul :active > a {
    top:0;
    %c2%
    background: -webkit-gradient(linear, left top, left bottom, from(%custom_light_bg%), to(%custom_dark_bg%));
    background: -moz-linear-gradient(top,  %custom_light_bg%,  %custom_dark_bg%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='%custom_light_bg%', endColorstr='%custom_dark_bg%');
    color:%custom_color%
}

#access ul li.current_page_item > a,
#access ul li.current-menu-ancestor > a,
#access ul li.current-menu-item > a,
#access ul li.current-menu-parent > a {
    border:1px solid %rgba_border%;

    %c3%
}
* html #access ul li.current_page_item a,
* html #access ul li.current-menu-ancestor a,
* html #access ul li.current-menu-item a,
* html #access ul li.current-menu-parent a,
* html #access ul li a:hover {
    border:1px solid %rgba_border%;

    %c2%
}
#month_list,
#month_list td,
#year_list td,
#calendar_wrap td,
#date_list td{
    border:1px solid %c_border%;
    border:1px solid %rgba_border%;
}
td.month-date,td.month-name,td.time
{
    %c3%
    border:1px solid %rgba_border%;

}
address{margin:10px auto;}
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
%c2%
}
.comment-meta a,
cite.fn{
	background:none;
}
.datetable td li{
	border-bottom:solid 1px %rgba_border%;
}
.datetable td li:nth-last-child(1){
	border-bottom:none;

}

DOC;
return $style;
}

?>
<?php

/**
 * light
 *
 *
 *
 *
 */

function raindrops_light(){

$style =<<<DOC

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
 color:%tmn_header_color%;
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
    color:%tmn_footer_color%;
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
li.byuser,
li.bypostauthor {
%c3%
}
cite.fn{
	background:none;
}
.datetable td li{
	border-bottom:solid 1px %rgba_border%;
}
.datetable td li:nth-last-child(1){
	border-bottom:none;

}


DOC;

return $style;
}
?>
<?php

/**
 * minimal
 *
 *
 *
 *
 */

function raindrops_minimal(){

$style =<<<DOC
%gradient%
#access ul ul.children a{
background:#fff;
}
#access .menu  ul li{
/*border:1px solid %rgba_border%*/
}
a{
 text-decoration:underline;
 }
a,
#yui-main{
	color:%tmn_header_color%;
}
#year_list,
#year_list td,
#month_list,
#month_list td,
#datelist,
#date_list td{
border:1px solid %rgba_border%
}
.footer-widget h2,.rsidebar h2,.lsidebar h2 {
%c5%
%h2_default_background%
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
.home .sticky {
%c4%
border-top:solid 6px %c_border%;
border-bottom:solid 2px %c_border%;
border-top:solid 6px %rgba_border%;
border-bottom:solid 2px %rgba_border%;
}
.sticky a{
%c4%

}
li.byuser,
li.bypostauthor {
%c4%
}
cite.fn{
	background:none;
}
.datetable td li{
	border-bottom:solid 1px %rgba_border%;
}
.datetable td li:nth-last-child(1){
	border-bottom:none;

}

DOC;

return $style;
}
?>
<?php

	if(!defined('ABSPATH')){exit;}

    $images_path            = get_stylesheet_directory_uri().'/images/';
    $count                  = warehouse('raindrops_base_color');
    $style_type             = warehouse('raindrops_style_type');
    $navigation_title_img   = warehouse('raindrops_heading_image');
    $position_y             = warehouse('raindrops_heading_image_position');
    $tmn_header_image       = warehouse('raindrops_header_image');
    $tmn_header_color       = warehouse('raindrops_default_fonts_color');
    $tmn_footer_image       = warehouse('raindrops_footer_image');
    $tmn_footer_color       = warehouse('raindrops_footer_color');
    define("BASE_COLOR1",$count);
/**
 * save stylesheet
 *
 */
	$raindrops_indv_css 	= design_output($style_type).color_base();
	$raindrops_options 		= get_option("raindrops_theme_settings");
	$add_array				= array('_raindrops_indv_css'=> $raindrops_indv_css );
	$raindrops_options 		= array_merge($raindrops_options,$add_array);

	update_option("raindrops_theme_settings",$raindrops_options);
/**
 * Create CSS Color Declaration
 *
 *
 *
 *
 */
	function colors($num = 0, $select = 'set',$color1 = null){
		global $images_path;
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
 * Base Color Class Create
 *
 *
 *
 *
 */
	function color_base($color1=null,$color2=null){
	global $images_path;
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
    function hex2rgba($color,$opecity){
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
/*    function design_output($name = 'default'){
	
    }
/**
 * Declaration Calculator
 *
 *
 *
 *
 */
	function design_output($name = 'dark'){
	
		$images_path            = get_stylesheet_directory_uri().'/images/';
		$navigation_title_img   = warehouse('raindrops_heading_image');
		$tmn_header_image       = warehouse('raindrops_header_image');
		$tmn_header_color       = warehouse('raindrops_default_fonts_color');
		$tmn_footer_image       = warehouse('raindrops_footer_image');
		$tmn_footer_color       = warehouse('raindrops_footer_color');
		
		if(empty($name)){ $name = 'dark';}
		
		$c_border   = colors(0,'background');
		if($c_border == '#'){
			$rgba_border = 'rgba(203,203,203, 0.8)';
		}else{
			$rgba_border = hex2rgba($c_border,0.5);
		}

		$c1 = colors(0);		
		$c1 = colors(1);		
		$c2 = colors(2);		
		$c3 = colors(3);		
		$c4 = colors(4);		
		$c5 = colors(5);		
		$c_1 = colors(-1);		
		$c_2 = colors(-2);		
		$c_3 = colors(-3);		
		$c_4 = colors(-4);		
		$c_5 = colors(-5);		
		
		$position_y = warehouse('raindrops_heading_image_position');
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
			$h2_default_background = "background:".colors(4,'background').' ';
			$h2_default_background .= "url({$images_path}{$navigation_title_img});";
			$h2_default_background .= "color:".colors(4,'color').';';
			$h2_dark_background = "background:".colors(-3,'background').' ';
			$h2_dark_background .= "url({$images_path}{$navigation_title_img});";
			$h2_dark_background .= "color:".colors(-3,'color').';';
			$h2_light_background = "background:".colors(4,'background').' ';
			$h2_light_background .= "url({$images_path}{$navigation_title_img});";
			$h2_light_background .= "color:".colors(4,'color').';';
			
		switch($name){
			case("default"):
				$custom_dark_bg = colors('3','background');
				$custom_light_bg = colors('1','background');
				$custom_color = colors('1','color');
				if(!empty($tmn_footer_color)){
					$tmn_footer_color = $tmn_footer_color;
				}else{
					$tmn_footer_color = '';
				}
				if(!empty($tmn_header_color)){
					$tmn_header_color = $tmn_header_color;
				}else{
					$tmn_header_color = '';
				}
				$gradient = tmn_gradient();
			break;
			case("dark"):
			/**
			 *dark
			 */
				$custom_dark_bg = colors('-1','background');
				$custom_light_bg = colors('-4','background');
				$custom_color = colors('-3','color');
				if(!empty($tmn_footer_color)){
					$tmn_footer_color = $tmn_footer_color;
				}else{
					$tmn_footer_color = '';
				}
				if(!empty($tmn_header_color)){
					$tmn_header_color = $tmn_header_color;
				}else{
					$tmn_header_color = '';
				}
				$gradient = tmn_gradient();
			break;
			case("light"):
			/**
			 * light
			 */
				$custom_dark_bg = colors('5','background');
				$custom_light_bg = colors('3','background');
				$custom_color = colors('3','color');
				$base_gradient = tmn_gradient_single(3,"asc");
				if(!empty($tmn_footer_color)){
					$tmn_footer_color = $tmn_footer_color;
				}else{
					$tmn_footer_color = '';
				}
				if(!empty($tmn_header_color)){
					$tmn_header_color = $tmn_header_color;
				}else{
					$tmn_header_color = '';
				}
				$gradient = tmn_gradient();
			break;
			default:
				$custom_dark_bg = colors('3','background');
				$custom_light_bg = colors('1','background');
				$custom_color = colors('1','color');
				if(!empty($tmn_footer_color)){
					$tmn_footer_color = $tmn_footer_color;
				}else{
					$tmn_footer_color = '';
				}
				if(!empty($tmn_header_color)){
					$tmn_header_color = $tmn_header_color;
				}else{
					$tmn_header_color = '';
				}
				$gradient = tmn_gradient();
			break;
		}
		
		
		$function_name = 'raindrops_'.$name;
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
		return apply_filters("raindrops_colors", $content );
	}
?>
