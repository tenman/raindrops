
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
 %tmn_header_color%
}
#hd{
    %c_5%
    background-image:url(%images_path%%tmn_header_image%);


}

#hd h1,.h1,#site-title{
    %c_3%
    background:none;

}

#site-description{
    %c_3%
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
%tmn_footer_color%
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
    background: %c3%

}

.social textarea#comment:focus,
.social input:focus{
   box-shadow: 0 0 5px %rgba_border%;
    -webkit-box-shadow: 0 0 5px %rgba_border%;
    -moz-box-shadow: 0 0 5px %rgba_border%;
   /* border:1px solid %rgba_border%;*/
    background:%c_4%

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

