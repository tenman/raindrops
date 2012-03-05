Raindrops WordPress Theme
http://www.tenman.info/wp3/raindrops/

wp3.jpg wp3-thumbnail.jpg,arrows-vs.png, icons32-vs.png,bg.png,c.gif,footer.png,footer,png,footerbck.gif,footerbck.png,h2.gif,h2,png,h2b.png,h2c.png,header.png,info.png,ja-em.png,link.png,next.png,number.png,previus.png,requre.png,rss.png,sidebar.png,sticky.png,stop.png,topbck.png,y.gif

Above images License

copyright   Copyright (c) 2010-2012, Tenman
License: GNU General Public License v2.0
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This themes contents is especially the thing without clear statement of a license
supply under below license.

copyright   Copyright (c) 2010-2012, Tenman
License: GNU General Public License v2.0
License URI: http://www.gnu.org/licenses/gpl-2.0.html


QUICK START
see: http://www.tenman.info/wp3/raindrops/quick-start/

ver 0.960
    Add CSS class columns
        When a setup of page width is set to fluid 100%, page width changes in the range of 480px to 1280px by default.
At this time, the length of the text of contents becomes long too much, and it becomes difficult to compose it.
When describing contents, when possible, column is automatically set up by describing the whole as follows.

    example(need html mode)
    on your post content or page content

    <div class="columns">
    your content here
    </div>

ver 0.958
    Add simple view for mobile
    If you want show manuary
    Open functions.php
        Set $raindrops_fallback_human_interface_show = true
ver 0.948
raindrops_delete_post_link()
    This function default no work.
    If you need delete post link
    Please open file functions.php and const SHOW_DELETE_POST_LINK value set true.
ver 0.940
By page edit and post edit,
the Color Type and the number of columns can be set to contribution.
Add a few codes when you edit post.
e.g.
<!--[raindrops color_type="light" col="1"]-->
it makes display 1column page or post.
and raindrops color type is overwrite light.

And next You can add your own color type.
Please open functions.php
Add code example where must last line.

raindrops_register_styles("my_css");

function raindrops_indv_css_my_css(){

$style = '/* Add CSS style rule*/ body{background:orange;
color:black;}';


return $style;

}
and add the code when you edit post.
<!--[raindrops color_type="my_css" col="1"]-->


Custom Header
If you select Header Image where Appearance header panel
and Raindrops will show select image.
If you delete header Image and Raindrops hide a Header Image.
If you select Header Text 'display text' value 'yes'
and site description text shows on the Header Image.
select 'no' and description show page right top position.

Raindrops option 'Background image h2'
color type dark and minimal have this option.
If you need background image setting when open style.css
and last line comment out like this
e.g.
.rd-type-w3standard .footer-widget h2,.rsidebar h2,.lsidebar h2,
.rd-type-light .footer-widget h2,.rsidebar h2,.lsidebar h2 {
/*background:none!important;*/
}

Custom Background
If you want your original background. you can change every color type.

Tips
Featured Image will show Article above on single page.
loop page show icon each the_content left.

Category gallery and Cagory blog have Special Layout.

Upload header,footer image.
    Allow image type is png,jpeg,gif
    max upload size 2000000byte
    header or footer image max width 1300px
    upload files saved your uplload dir
    default header,footer image exists raindrops/images header.png footer.png

Be careful
    version 0.907 Reset all setting button initializes all customizing.
    MultiSite user must click the link when setting change where  with update result message.

Questions, bugs and others can be emailed me to a.tenman@gmail.com

Tenman
a.tenman@gmail.com
http://www.tenman.info