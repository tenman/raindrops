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
jQuery( function ( $ ) {

    $( '.trancate' ).each( function ( index ) {
        var rows = $( this ).data( 'rows' );
        if ( !rows ) {
            rows = 3;
        }

        var line_height = parseInt( $( this ).css( 'line-height' ) );
        var box_height = parseInt( Math.ceil( rows * line_height ) );
        $( this ).wrapInner( "<span class='multiline-text-overflow'></span>" );
       // $( this ).height( box_height );
       $( this ).css({'max-height': box_height });
       if( parseInt($( '.multiline-text-overflow', this ).height()) > box_height ){
             $( this ).addClass('on-trancate');  
             $( this ).removeClass('off-trancate');
         }
       if( parseInt($( '.multiline-text-overflow', this ).height()) < box_height ){
            $( this ).addClass('off-trancate');
            $( this ).removeClass('on-trancate');
        }
    });
    
    $( '.related-posts .on-trancate > span' ).each( function ( index ) {
        var text = $( this ).text();
        $( this ).attr('title', text);
        
    });
});
/** 
 * .rd-layout-switch
 * @param {type} $
 * @returns {undefined}
 * @1.466
 */
jQuery( function ( $ ) {
    
    var title_text_to_grid =  raindrops_script_vars.raindrops_layout_change_label_to_list;
    var title_text_to_list =  raindrops_script_vars.raindrops_layout_change_label_to_grid;
    var is_grid_archives =  raindrops_script_vars.raindrops_is_grid_archives;
    
    if ( 'no' == is_grid_archives &&  $( 'body' ).hasClass( 'rd-grid' ) ) {
         $( 'body' ).removeClass( "rd-grid" );
    }
    
    function setCookie( key, value ) {
        var expires = new Date();
        expires.setTime( expires.getTime() + ( 1 * 24 * 60 * 60 ) );
        document.cookie = key + '=' + value + ';path=/' + ';expires=' + expires.toUTCString();
    }

    function getCookie( key ) {
        var keyValue = document.cookie.match( '(^|;) ?' + key + '=([^;]*)(;|$)' );
        return keyValue ? keyValue[2] : null;
    }
    if ( 'yes' == is_grid_archives ) {
        
        if ( 'list' == getCookie( 'rd_swich_layout' ) ) {

            $( '#rd-swich-layout' ).addClass( 'rd-switch-to-grid-layout' ).removeClass( 'rd-switch-to-list-layout' ).attr("title", title_text_to_list ); //.html('grid');
            $( 'body' ).removeClass( "rd-grid" );

        } else if ( 'grid' == getCookie( 'rd_swich_layout' ) ) {

            $( '#rd-swich-layout' ).addClass( 'rd-switch-to-list-layout' ).removeClass( 'rd-switch-to-grid-layout' ).attr("title", title_text_to_grid );//.html('list');           
            $( 'body' ).addClass( "rd-grid" );
        }

    } else {
        $( 'body' ).removeClass( "rd-grid" );
    }

    $( "#rd-swich-layout" ).on( 'click', function () {

        if ( $( 'body' ).hasClass( 'rd-grid' ) ) {

            setCookie( 'rd_swich_layout', 'list' );

            $( this ).addClass( 'rd-switch-to-grid-layout' ).removeClass( 'rd-switch-to-list-layout' ).attr("title", title_text_to_list ); //.html('grid');
            $( 'body' ).removeClass( "rd-grid" );
        } else {
            setCookie( 'rd_swich_layout', 'grid' );

            $( this ).addClass( 'rd-switch-to-list-layout' ).removeClass( 'rd-switch-to-grid-layout' ).attr("title", title_text_to_grid );//.html('list');
            $( 'body' ).addClass( "rd-grid" );
        }
    } );
} );