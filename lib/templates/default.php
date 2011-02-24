%gradient%

body {

margin:0!important;padding:0;
background-repeat:repeat-x;

}
#yui-main{
%tmn_header_color%
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
color:%tmn_footer_color%
%tmn_footer_color%
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

