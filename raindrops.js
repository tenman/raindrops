(function($){
　jQuery(function(){
				 
　　jQuery("blockquote").each(function(){
        var cite  = jQuery(this).attr("cite");
		if( cite ){
			jQuery(this).append("<p style=\"text-align:right;\">cite:<a href=\"" + cite +"\" onclick=\"this.target='_blank';\" onkeypress=\"this.target='_blank';\">" + cite + "</a></p>");
		}
		
	});

	jQuery("#month_list ul li:last-child").css({border:"none"});
	jQuery(".widget ul li:last-child").css({border:"none"});
	
	
	
　});

})(jQuery);