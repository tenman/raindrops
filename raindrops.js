/**
 * Raindrops javascript actions
 *
 * @package Raindrops
 */
(function() {
    jQuery(function() {
        jQuery("body").removeClass('noscript');
    });
})(jQuery);
(function() {
    jQuery(function() {
        
         var entity_map = {
            "&": "&amp;",
            "<": "&lt;",
            ">": "&gt;",
            '"': '&quot;',
            "'": '&#39;',
            "/": '&#x2F;'
          };

        function escape_html(string) {
          return String(string).replace(/[&<>"'\/]/g, function (s) {
            return entity_map[s];
          });
        }
        jQuery("blockquote").each(function() {
            var cite = jQuery(this).attr("cite");
            
            if (cite) {
                var decoded_uri = decodeURIComponent( cite );
                jQuery(this).append("<p class=\"cite-url\">" + raindrops_script_vars.blockquote_cite_i18n + "<a href=\"" + cite + "\" onclick=\"this.target='_blank';\" onkeypress=\"this.target='_blank';\">" + escape_html(decoded_uri) + "</a></p>");
            }

        });

       jQuery("#month_list ul li:last-child").css({border: "none"});
       jQuery('a').not( "#flags, .flag, .tooltip" ).removeAttr("title");
       jQuery( ".no-tooltip" ).removeAttr("title");
       
        // #flags is google translate plugin
        // @1.403 add class .flag for Google Language Translator plugin version 5.0.06
        
        /** Toggle
         *
         *
         * @package Raindrops
         * @since Raindrop 0.922
         */

        jQuery('.raindrops-toggle').hide().css("width", "90%");
        jQuery('.raindrops-toggle.raindrops-toggle-title').show().css({"width": "90%", "list-style": "none", "font-weight": "bold", "margin": "0 0 0 -1em"}).prepend("+ ");
        /* @1.326 for keyboard accessibility */
        jQuery('.raindrops-toggle.raindrops-toggle-title').attr("tabindex","0");

        jQuery('.raindrops-toggle.raindrops-toggle-title').css("cursor", "pointer").click(function() {

            jQuery(this).siblings().toggle("slow");

            var v = jQuery(this).html().substring(0, 1);

            if (v == "+") {
                jQuery(this).html("-" + jQuery(this).html().substring(1));
            } else if (v == "-") {
                jQuery(this).html("+" + jQuery(this).html().substring(1));
            }
            return false;
        }).on('keydown', function(e) {

        /* @1.326 for keyboard accessibility */
        if(e.keyCode == 9){ //tab key
           jQuery(this).siblings().toggle("slow");

            var v = jQuery(this).html().substring(0, 1);

            if (v == "+") {
                jQuery(this).html("-" + jQuery(this).html().substring(1));
            } else if (v == "-") {
                jQuery(this).html("+" + jQuery(this).html().substring(1));
            }
        }
        });

        jQuery('#raindrops_status_bar').hide();

         jQuery(window).mousemove(function(e){

                var status_bar_window_height =  jQuery(window).innerHeight();
                if ( status_bar_window_height - 100 < e.pageY - jQuery(this).scrollTop() ) {

                    jQuery('#raindrops_status_bar').show();
                } else {
                   
                    jQuery('#raindrops_status_bar').hide();

                }
         });

    });

})(jQuery);

/** Tab Controll
 *
 *
 * @package Raindrops
 * @since Raindrop 0.922
 */

(function() {
    jQuery(function() {

        var element = ".raindrops-tab-content h3";
        var prefix = "raindrops-tab-page-";

        jQuery(element).each(function(i) {
            var fragment = prefix + i;

            var title = "<li role=\"tab\"><a href=\"#" + fragment + "\">" + jQuery(element).eq(i).html() + "</a></li>";
            jQuery(this).parents(':eq(1)').prev().append(title);
            jQuery(this).parent().attr("id", fragment);

        });

        jQuery(".raindrops-tab-list li.dummy").remove();

        //Default Action
        jQuery(".raindrops-tab-page").hide(); //Hide all content
        jQuery(".raindrops-tab-list li:first").addClass("active").show(); //Activate first tab
        jQuery(".raindrops-tab-page:first").show(); //Show first tab content
        jQuery(".raindrops-tab-list").show();
        jQuery(".raindrops-tab-content").show();

        //On Click Event
        jQuery(".raindrops-tab-list li").click(function() {
            jQuery(".raindrops-tab-list li").removeClass("active"); //Remove any "active" class
            jQuery(this).addClass("active"); //Add "active" class to selected tab
            jQuery(".raindrops-tab-page").hide(); //Hide all tab content
            var activeTab = jQuery(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
            jQuery(activeTab).fadeIn(); //Fade in the active content

            return false;
        }).focus(function() {
         
            jQuery(".raindrops-tab-list li").removeClass("active"); //Remove any "active" class
            jQuery(this).addClass("active"); //Add "active" class to selected tab
            jQuery(".raindrops-tab-page").hide(); //Hide all tab content
            var activeTab = jQuery(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
            jQuery(activeTab).fadeIn(); //Fade in the active content
        
            return false;
        });
        jQuery(".raindrops-tab-list").css({"margin": "auto"});
        jQuery(".raindrops-tab-list li").css({"float": "left", "list-style": "none"});
        jQuery(".raindrops-tab-list li a").css({"display": "block", "padding": "10px", "text-decoration": "none", "margin-right": "1px"});
    });
})(jQuery);

(function() {
    jQuery(function() {
        jQuery("figure").each(function (i) { jQuery(this).attr('tabindex', 0); });
        jQuery("figcaption").each(function (i) { jQuery(this).attr('tabindex', 0); });
        /* @1.326 for keyboard accessibility */       
        jQuery(".raindrops-tab-list li").each(function (i) { jQuery(this).attr('tabindex', 0); });
    });
})(jQuery);


(function() {
    jQuery(function() {
        jQuery("table").not('.rd-no-scroll,.tribe-events-calendar').each(function (i) { 
            jQuery(this).wrap('<div class="rd-table-wrapper"></div>') 
        });
    });
})(jQuery);

(function() {
    jQuery(function() {
        /**
         * @since 1.453
         */
        jQuery("a.disable, .disable > a").each(function (i) { 
            jQuery(this).removeAttr("href");
        });
    });
})(jQuery);
/*!
 * Simple jQuery Equal Heights
 * 
 * https://github.com/mattbanks/jQuery.equalHeights
 * Copyright (c) 2013 Matt Banks
 * Dual licensed under the MIT and GPL licenses.
 * Uses the same license as jQuery, see:
 * http://docs.jquery.com/License
 *
 * @version 1.5.1
 */
(function($) {

    $.fn.equalHeights = function() {
        var maxHeight = 0,
            $this = $(this);

        $this.each( function() {
            var height = $(this).innerHeight();

            if ( height > maxHeight ) { maxHeight = height; }
        });

        return $this.css('height', maxHeight);
    };

    // auto-initialize plugin
    $('[data-equal]').each(function(){
        var $this = $(this),
            target = $this.data('equal');
        $this.find(target).equalHeights();
    });

})(jQuery);
