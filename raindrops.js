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
        jQuery('.raindrops-toggle.raindrops-toggle-title').show().css({"width": "90%", "list-style": "none", "font-weight": "bold", "margin": "0 0 0 0"}).prepend("+ ");
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
            jQuery(this).wrap('<div class="rd-table-wrapper"></div>');
        });
        /* @1.503 */
        jQuery(".wp-block-table.alignleft").not('.rd-no-scroll,.tribe-events-calendar').each(function (i) { 
            jQuery(this).parent().addClass('alignleft');
        });
        /* @1.503 */
        jQuery(".wp-block-table.alignright").not('.rd-no-scroll,.tribe-events-calendar').each(function (i) { 
            jQuery(this).parent().addClass('alignright');
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
    
    function raindrops_set_cookie( key, value ) {
        var expires = new Date();
        expires.setTime( expires.getTime() + ( 1 * 24 * 60 * 60 ) );
        document.cookie = key + '=' + value + ';path=/' + ';expires=' + expires.toUTCString();
    }

    function raindrops_get_cookie( key ) {
        var keyValue = document.cookie.match( '(^|;) ?' + key + '=([^;]*)(;|$)' );
        return keyValue ? keyValue[2] : null;
    }
    var raindrops_window_width = jQuery( window ).width();
    
    if ( 'yes' == is_grid_archives && raindrops_script_vars.raindrops_grid_layout_break_point_small_max < raindrops_window_width ) {
        
        if ( 'list' == raindrops_get_cookie( 'rd_swich_layout' ) ) {

            $( '#rd-swich-layout' ).addClass( 'rd-switch-to-grid-layout' ).removeClass( 'rd-switch-to-list-layout' ).attr("title", title_text_to_list ); //.html('grid');
            $( 'body' ).removeClass( "rd-grid" ).addClass('rd-list');


        } else if ( 'grid' == raindrops_get_cookie( 'rd_swich_layout' ) ) {

            $( '#rd-swich-layout' ).addClass( 'rd-switch-to-list-layout' ).removeClass( 'rd-switch-to-grid-layout' ).attr("title", title_text_to_grid );//.html('list');           
            $( 'body' ).addClass( "rd-grid" ).removeClass('rd-list');

        }

    } else {
        $( 'body' ).removeClass( "rd-grid" );
    }

    $( "#rd-swich-layout" ).on( 'click', function () {

        if ( $( 'body' ).hasClass( 'rd-grid' ) ) {

            raindrops_set_cookie( 'rd_swich_layout', 'list' );

            $( this ).addClass( 'rd-switch-to-grid-layout' ).removeClass( 'rd-switch-to-list-layout' ).attr("title", title_text_to_list ); //.html('grid');
            $( 'body' ).removeClass( "rd-grid" ).addClass('rd-list');
            
            $( '.rd-featured-yes-front.rd-list #bd .index .h2-thumb' ).each( function ( index ) {
                if( 48 == parseInt( $(this).width() ) ) {
                    $(this).siblings( ".entry-title-text" ).addClass('small-thumb-siblings');
                }
            });   

        } else {
            raindrops_set_cookie( 'rd_swich_layout', 'grid' );

            $( this ).addClass( 'rd-switch-to-list-layout' ).removeClass( 'rd-switch-to-grid-layout' ).attr("title", title_text_to_grid );//.html('list');
            $( 'body' ).addClass( "rd-grid" ).removeClass('rd-list');
            
            $( '.rd-featured-yes-front.rd-list #bd .index .h2-thumb' ).each( function ( index ) {
                if( 48 == parseInt( $(this).width() ) ) {
                    $(this).siblings( ".entry-title-text" ).removeClass('small-thumb-siblings');
                }
            });
        }
    } );
    
    var raindrops_window_width = $( window ).width();
    var vertical_label = raindrops_script_vars.writing_mode_vertical_label;
    var horizontal_label = raindrops_script_vars.writing_mode_horizontal_label;
    
    if( raindrops_window_width > 640 && 'yes' == raindrops_script_vars.enable_writing_mode_mix && 'ja' == raindrops_script_vars.locale && false == raindrops_script_vars.delete_writing_mode_mix ) {
       
        
        if ( 'standard' == raindrops_get_cookie( 'rd_writing_mode' ) ) {
             
            $( '.single .writing-mode-mix .entry-title, .page .writing-mode-mix .entry-title' ).append('<span title="' + horizontal_label + '" id="rd-vertical-rl" class="direction-button"  style="display:none;">&equiv;</span><span title="' + vertical_label + '" id="rd-horizontal-tb" class="direction-button">&#10624;</span>');
            $( '.writing-mode-mix').removeClass('writing-mode-mix' ).addClass('writing-mode-standard');
            $( '.writing-mode-mix article,.writing-mode-standard article').removeClass('writing-mode-mix-article' ).addClass('writing-mode-standard-article');
            $( '.writing-mode-mix .entry-title').removeClass('d-tate');
            
        } else if ( 'mix' == raindrops_get_cookie( 'rd_writing_mode' ) ) {
            $( '.single .writing-mode-mix .entry-title, .page .writing-mode-mix .entry-title' ).append('<span title="' + horizontal_label + '" id="rd-vertical-rl" class="direction-button">&equiv;</span><span title="' + vertical_label + '" id="rd-horizontal-tb" class="direction-button" style="display:none;">&#10624;</span>');
            $( '.writing-mode-standard').removeClass('writing-mode-standard' ).addClass('writing-mode-mix');
            $( '.writing-mode-standard article, .writing-mode-mix article').removeClass('writing-mode-standard-article' ).addClass('writing-mode-mix-article');
            
        } else {
            
            $( '.single .writing-mode-mix .entry-title, .page .writing-mode-mix .entry-title' ).append('<span title="' + horizontal_label + '" id="rd-vertical-rl" class="direction-button">&equiv;</span><span title="' + vertical_label + '" id="rd-horizontal-tb" class="direction-button" style="display:none;">&#10624;</span>');           
            $( '.writing-mode-standard').removeClass('writing-mode-standard' ).addClass('writing-mode-mix');
            $( '.writing-mode-standard article,.writing-mode-mix article').removeClass('writing-mode-standard-article' ).addClass('writing-mode-mix-article');
        }
        
        $( ".direction-button" ).click(function() {
             $( ".direction-button" ).toggle();
        });
 
        $("#rd-vertical-rl").on( 'click', function () {
            raindrops_set_cookie( 'rd_writing_mode', 'standard' );
            
            $( '.writing-mode-mix article').removeClass('writing-mode-mix-article' ).addClass('writing-mode-standard-article');
            $( '.writing-mode-mix').removeClass('writing-mode-mix' ).addClass('writing-mode-standard');
            $( '.writing-mode-mix .entry-title').removeClass('d-tate');
        });
        $("#rd-horizontal-tb").on( 'click', function () {
            raindrops_set_cookie( 'rd_writing_mode', 'mix' );
            $( '.writing-mode-standard article').removeClass('writing-mode-standard-article' ).addClass('writing-mode-mix-article');
            $( '.writing-mode-standard').removeClass('writing-mode-standard' ).addClass('writing-mode-mix');           
        });
   } else if( $( 'article' ).hasClass('writing-mode-mix-article') ||  $( 'article' ).hasClass('writing-mode-standard-article') ) {
        
        $( '.writing-mode-mix').removeClass('writing-mode-mix' ).addClass('writing-mode-standard');
        $( '.writing-mode-mix article,.writing-mode-standard article').removeClass('writing-mode-mix-article' ).addClass('writing-mode-standard-article');
        $( '.writing-mode-mix .entry-title').removeClass('d-tate');
    }   
} );
/**
 * category first page NOT featured Image display property change from block to table-cell
 * @param {type} $
 * @returns {undefined}
 * @since 1.470
 */
jQuery( function ( $ ) {
    $( '.archive .entry-title' ).each( function ( index ) {
    
        var width = $( this ).find( 'img' ).width();
        
        if( 48 == parseInt( width ) ) {

             $( this ).find('span').css({'display':'table'});
             $( this ).find('.h2-thumb').css({'display':'table-cell','width':'48px'});
             $( this ).find('.entry-title-text').css({'display':'table-cell'});
        }       
    });
} );
jQuery( function ( $ ) {
    /* @1.475 */
    $( '.widget.widget_media_image > figure' ).each( function ( index ) {
    
       $( this ).parent().css({'padding-bottom':'1.5em'});
       $( this ).prev().css({'margin-bottom':'1em'});
    });
    /* @1.477 */
    $( '.js-figure-fit' ).each( function ( index ) {
       var figure_width = $( this ).find('img').width() + 10;
       if( parseInt( figure_width ) > 10 ) {
            $( this ).css({'width':figure_width + 'px'});
        } 
    });
} );
jQuery( function ( $ ) {
    $( '.rd-featured-yes-front.rd-list #bd .index .h2-thumb' ).each( function ( index ) {
        if( 48 == parseInt( $(this).width() ) ) {
            $(this).siblings( ".entry-title-text" ).css({'padding-left': '0.4em'});
        }
    });   
} );
jQuery( function ( $ ) {
    $( '.rd-featured-yes-front.rd-list #bd .index .h2-thumb' ).each( function ( index ) {
        if( 48 == parseInt( $(this).width() ) ) {
            $(this).siblings( ".entry-title-text" ).css({'padding-left': '0.4em'});
        }
    });   
} );
jQuery( function ( $ ) {
    /**
     * @since 1.492
     */
    $('.wp-block-categories .children').parent().addClass('has-children');
    $('#doc5 .raindrops-no-keep-content-width .index > li .raindrops-sticky').parent().addClass('no-padding');
    
} );
jQuery( function ( $ ) {
    /**
     * Raindrops Modalbox
     * Video Stoped when Click Close Button
     * @1.498
     */
    $('.lb-close').click(function(){
        var iframe_src = $(this).parents('.rd-modal').find('iframe').attr('src');
        $(this).parents('.rd-modal').find('iframe').attr('src', iframe_src);
    });
    

    $('.rd-modal iframe').each( function ( index ) { 
        var renamed_src = $(this).attr('src');
        
        if (typeof renamed_src !== typeof undefined && renamed_src !== false) {
            $( this).attr('data-rd-src', renamed_src );
        }
    });
    
    $('.modal-link').click(function(){
            
        var modal_box_id    = $(this).attr('href');
        modal_box_id        = modal_box_id.replace(/^[^#]*/,"");
        var iframe_src      = $( modal_box_id ).find('iframe').attr('data-rd-src');
       if (typeof iframe_src !== typeof undefined && iframe_src !== false) {
            $( modal_box_id ).find('iframe').attr('src', iframe_src).removeAttr('data-rd-src');
       }

    });    
} );
jQuery( function ( $ ) {
/*
    $( '.wp-block-embed-instagram.alignleft,.wp-block-embed-instagram.alignright' ).each( function ( ) {
        var width = $( this ).width();
        var height = $( this ).height();
        var ratio = Math.ceil( ( height / width ) * 140 );
        
        $( this ).children( '.oembed-container' ).css( { 'padding-bottom': ratio + '%' } );

    } );*/

} );