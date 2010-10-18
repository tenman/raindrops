
jQuery.noConflict();
  /*toggle*/
  jQuery(function(){
    jQuery('*[class^="toggle"]').hide().css("width","100%");
    jQuery('*[id^="toggle"]').css("cursor","pointer").click(
      function(){
        var target ="."+jQuery(this).attr("id");
        jQuery(target).toggle("slow");
      });
    jQuery('*[id^="showAll"]').css("cursor","pointer").click(
      function(){
        jQuery('*[class^="toggle"]').show().css("width","100%");
      }
    );
    jQuery('*[id^="hideAll"]').css("cursor","pointer").click(
      function(){
        jQuery('*[class^="toggle"]').hide().css("width","100%");
      }
    );
	

  });
