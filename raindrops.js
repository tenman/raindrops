/**
 * Raindrops javascript actions
 *
 * @package WordPress
 * @subpackage Raindrops
 */
(function(){
　jQuery(function(){

　　jQuery("blockquote").each(function(){
        var cite  = jQuery(this).attr("cite");
        if( cite ){
            jQuery(this).append("<p style=\"text-align:right;\">cite:<a href=\"" + cite +"\" onclick=\"this.target='_blank';\" onkeypress=\"this.target='_blank';\">" + cite + "</a></p>");
        }

    });

    jQuery("#month_list ul li:last-child").css({border:"none"});
    jQuery(".widget ul li:last-child").css({border:"none"});
    jQuery('a').removeAttr("title");

/** Toggle
 *
 *
 * @package WordPress
 * @subpackage Raindrops
 * @since Raindrop 0.922
 */

    jQuery('.raindrops-toggle').hide().css("width","90%");
    jQuery('.raindrops-toggle.raindrops-toggle-title').show().css({"width":"90%","list-style":"none","font-weight":"bold","margin":"0 0 0 -1em"}).prepend("+ ");
    jQuery('.raindrops-toggle.raindrops-toggle-title').css("cursor","pointer").click(function(){

        jQuery(this).siblings().toggle("slow");

        var v = jQuery(this).html().substring( 0, 1 );

        if ( v == "+" ){
            jQuery(this).html( "-" + jQuery(this).html().substring( 1 ) );
        }else if ( v == "-" ){
            jQuery(this).html( "+" + jQuery(this).html().substring( 1 ) );
        }
    });

　});

})(jQuery);

/** Tab Controll
 *
 *
 * @package WordPress
 * @subpackage Raindrops
 * @since Raindrop 0.922
 */

(function(){
       jQuery(function(){

        var element = ".raindrops-tab-content h3";
        var prefix = "raindrops-tab-page-";

        jQuery(element).each(function(i){
            var fragment = prefix + i;

            var title = "<li><a href=\"#" + fragment + "\">" + jQuery(element).eq(i).html() + "</a></li>" ;
                jQuery(this).parents(':eq(1)').prev().append(title);
                jQuery(this).parent().attr("id", fragment );

         });

    jQuery(".raindrops-tab-list li.dummy").remove();

    //Default Action
    jQuery(".raindrops-tab-page").hide(); //Hide all content
    jQuery(".raindrops-tab-list li:first").addClass("active").show(); //Activate first tab
    jQuery(".raindrops-tab-page:first").show(); //Show first tab content

    //On Click Event
    jQuery(".raindrops-tab-list li").click(function() {
        jQuery(".raindrops-tab-list li").removeClass("active"); //Remove any "active" class
        jQuery(this).addClass("active"); //Add "active" class to selected tab
        jQuery(".raindrops-tab-page").hide(); //Hide all tab content
        var activeTab = jQuery(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
        jQuery(activeTab).fadeIn(); //Fade in the active content
        return false;
    });
    jQuery(".raindrops-tab-list").css({"margin": "auto"});
    jQuery(".raindrops-tab-list li").css({"float":"left","list-style":"none"});
    jQuery(".raindrops-tab-list li a").css({"display":"block","padding":"10px","text-decoration":"none","margin-right":"1px"      });
    });
})(jQuery);



/*
* Slides, A Slideshow Plugin for jQuery
* Intructions: http://slidesjs.com
* By: Nathan Searles, http://nathansearles.com
* Version: 1.0.9
* Updated: January 4th, 2011
*
* Licensed under the Apache License, Version 2.0 (the "License");

* you may not use this file except in compliance with the License.
* You may obtain a copy of the License at
*
* http://www.apache.org/licenses/LICENSE-2.0
*
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an "AS IS" BASIS,
* WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
* See the License for the specific language governing permissions and
* limitations under the License.
*/
/**
 * Change id ,class name
 * #slides to #raindrops-slides,
 * .slides-container to .raindrops-slides-container
 */
/*
(function($){
$.fn.slides=function(option){
option=$.extend({
},$.fn.slides.option,option);
return this.each(function(){
$('.'+option.container,$(this)).children().wrapAll('<div class="slides_control"/>');
var elem=$(this),control=$('.slides_control',elem),total=control.children().size(),width=control.children().outerWidth(),height=control.children().outerHeight(),start=option.start-1,effect=option.effect.indexOf(',')<0?option.effect:option.effect.replace(' ','').split(',')[0],paginationEffect=option.effect.indexOf(',')<0?effect:option.effect.replace(' ','').split(',')[1],next=0,prev=0,number=0,current=0,loaded,active,clicked,position,direction;
if(total<2){
return;
}
if(start<0){
start=0;
};
if(start>total){
start=total-1;
};
if(option.start){
current=start;
};
if(option.randomize){
control.randomize();
}
$('.'+option.container,elem).css({
overflow:'hidden',position:'relative'});
control.css({
position:'relative',width:(width*3),height:height,left:-width});
control.children().css({
position:'absolute',top:0,left:width,zIndex:0,display:'none'});
if(option.autoHeight){
control.animate({
height:control.children(':eq('+start+')').outerHeight()},option.autoHeightSpeed);
}
if(option.preload&&control.children()[0].tagName=='IMG'){
elem.css({
background:'url('+option.preloadImage+') no-repeat 50% 50%'});
var img=$('img:eq('+start+')',elem).attr('src')+'?'+(new Date()).getTime();
$('img:eq('+start+')',elem).attr('src',img).load(function(){
$(this).fadeIn(option.fadeSpeed,function(){
$(this).css({
zIndex:5});
elem.css({
background:''});
loaded=true;
});
});
}else{
control.children(':eq('+start+')').fadeIn(option.fadeSpeed,function(){
loaded=true;
});
}
if(option.bigTarget){
control.children().css({
cursor:'pointer'});
control.children().click(function(){
animate('next',effect);
return false;
});
}
if(option.hoverPause&&option.play){
control.children().bind('mouseover',function(){
stop();
});
control.children().bind('mouseleave',function(){
pause();
});
}
if(option.generateNextPrev){
$('.'+option.container,elem).after('<a href="#" class="'+option.prev+'">Prev</a>');
$('.'+option.prev,elem).after('<a href="#" class="'+option.next+'">Next</a>');
}
$('.'+option.next,elem).click(function(e){
e.preventDefault();
if(option.play){
pause();
};
animate('next',effect);
});
$('.'+option.prev,elem).click(function(e){
e.preventDefault();
if(option.play){
pause();
};
animate('prev',effect);
});
if(option.generatePagination){
elem.append('<ul class='+option.paginationClass+'></ul>');
control.children().each(function(){
$('.'+option.paginationClass,elem).append('<li><a href="#'+number+'">'+(number+1)+'</a></li>');
number++;
});
}else{
$('.'+option.paginationClass+' li a',elem).each(function(){
$(this).attr('href','#'+number);
number++;
});
}
$('.'+option.paginationClass+' li:eq('+start+')',elem).addClass('current');
$('.'+option.paginationClass+' li a',elem).click(function(){
if(option.play){
pause();
};
clicked=$(this).attr('href').match('[^#/]+$');
if(current!=clicked){
animate('pagination',paginationEffect,clicked);
}
return false;
});
$('a.link',elem).click(function(){
if(option.play){
pause();
};
clicked=$(this).attr('href').match('[^#/]+$')-1;
if(current!=clicked){
animate('pagination',paginationEffect,clicked);
}
return false;
});
if(option.play){
playInterval=setInterval(function(){
animate('next',effect);
},option.play);
elem.data('interval',playInterval);
};
function stop(){
clearInterval(elem.data('interval'));
};
function pause(){
if(option.pause){
clearTimeout(elem.data('pause'));
clearInterval(elem.data('interval'));
pauseTimeout=setTimeout(function(){
clearTimeout(elem.data('pause'));
playInterval=setInterval(function(){
animate("next",effect);
},option.play);
elem.data('interval',playInterval);
},option.pause);
elem.data('pause',pauseTimeout);
}else{
stop();
}};
function animate(direction,effect,clicked){
if(!active&&loaded){
active=true;
switch(direction){
case'next':prev=current;
next=current+1;
next=total===next?0:next;
position=width*2;
direction=-width*2;
current=next;
break;
case'prev':prev=current;
next=current-1;
next=next===-1?total-1:next;
position=0;
direction=0;
current=next;
break;
case'pagination':next=parseInt(clicked,10);
prev=$('.'+option.paginationClass+' li.current a',elem).attr('href').match('[^#/]+$');
if(next>prev){
position=width*2;
direction=-width*2;
}else{
position=0;
direction=0;
}
current=next;
break;
}
if(effect==='fade'){
option.animationStart();
if(option.crossfade){
control.children(':eq('+next+')',elem).css({
zIndex:10}).fadeIn(option.fadeSpeed,function(){
if(option.autoHeight){
control.animate({
height:control.children(':eq('+next+')',elem).outerHeight()},option.autoHeightSpeed,function(){
control.children(':eq('+prev+')',elem).css({
display:'none',zIndex:0});
control.children(':eq('+next+')',elem).css({
zIndex:0});
option.animationComplete(next+1);
active=false;
});
}else{
control.children(':eq('+prev+')',elem).css({
display:'none',zIndex:0});
control.children(':eq('+next+')',elem).css({
zIndex:0});
option.animationComplete(next+1);
active=false;
}});
}else{
option.animationStart();
control.children(':eq('+prev+')',elem).fadeOut(option.fadeSpeed,function(){
if(option.autoHeight){
control.animate({
height:control.children(':eq('+next+')',elem).outerHeight()},option.autoHeightSpeed,function(){
control.children(':eq('+next+')',elem).fadeIn(option.fadeSpeed);
});
}else{
control.children(':eq('+next+')',elem).fadeIn(option.fadeSpeed,function(){
if($.browser.msie){
$(this).get(0).style.removeAttribute('filter');
}});
}
option.animationComplete(next+1);
active=false;
});
}}else{
control.children(':eq('+next+')').css({
left:position,display:'block'});
if(option.autoHeight){
option.animationStart();
control.animate({
left:direction,height:control.children(':eq('+next+')').outerHeight()},option.slideSpeed,function(){
control.css({
left:-width});
control.children(':eq('+next+')').css({
left:width,zIndex:5});
control.children(':eq('+prev+')').css({
left:width,display:'none',zIndex:0});
option.animationComplete(next+1);
active=false;
});
}else{
option.animationStart();
control.animate({
left:direction},option.slideSpeed,function(){
control.css({
left:-width});
control.children(':eq('+next+')').css({
left:width,zIndex:5});
control.children(':eq('+prev+')').css({
left:width,display:'none',zIndex:0});
option.animationComplete(next+1);
active=false;
});
}}
if(option.pagination){
$('.'+option.paginationClass+' li.current',elem).removeClass('current');
$('.'+option.paginationClass+' li:eq('+next+')',elem).addClass('current');
}}};
});
};
$.fn.slides.option={
preload:false,preloadImage:'/img/loading.gif',container:'raindrops-slides-container',generateNextPrev:false,next:'next',prev:'prev',pagination:true,generatePagination:true,paginationClass:'pagination',fadeSpeed:350,slideSpeed:350,start:1,effect:'slide',crossfade:false,randomize:false,play:0,pause:0,hoverPause:false,autoHeight:false,autoHeightSpeed:350,bigTarget:false,animationStart:function(){
},animationComplete:function(){
}};
$.fn.randomize=function(callback){
function randomizeOrder(){
return(Math.round(Math.random())-0.5);
}
return($(this).each(function(){
var $this=$(this);
var $children=$this.children();
var childCount=$children.length;
if(childCount>1){
$children.hide();
var indices=[];
for(i=0;
i<childCount;
i++){
indices[indices.length]=i;
}
indices=indices.sort(randomizeOrder);
$.each(indices,function(j,k){
var $child=$children.eq(k);
var $clone=$child.clone(true);
$clone.show().appendTo($this);
if(callback!==undefined){
callback($child,$clone);
}
$child.remove();
});
}}));
};
})(jQuery);


		
		jQuery(function(){
			jQuery('#raindrops-slides').slides({
				preload: true,
				generateNextPrev: true,
				preloadImage: 'img/loading.gif',
				play: 5000,
				pause: 2500,
				hoverPause: true
			
			});
			jQuery('#raindrops-slides .pagination li').css({'float':'left'});
    	});
*/

					   
