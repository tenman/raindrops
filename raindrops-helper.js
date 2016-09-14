( function ( ) {

    jQuery( function ( ) {

        /* test code @see functions.php raindrops_article_wrapper_class() */
        try{
            jQuery( '.index.archives li > div' ).addClass( 'rd-l-' + navigator.language );
        }catch(e){
            jQuery( '.index.archives li > div' ).addClass( 'rd-l-unknown' );
        }finally{  }

        if ( raindrops_script_vars.page_width == 'doc3' || raindrops_script_vars.page_width == 'doc5' ) {
            var raindrops_width = jQuery( 'div#header-image' ).width( );
            var raindrops_window_width = jQuery( window ).width();
            var raindrops_primary_menu_height = jQuery('#access ul.menu').height();
            
            
            function raindrops_resizes( ) {

                if ( raindrops_script_vars.restore_check !== 'remove-header' ) {

                    var image_exists = raindrops_script_vars.header_image_uri;
                    var raindrops_width = jQuery( 'div#header-image' ).width();
                    var raindrops_window_width = jQuery( window ).width();
                    var raindrops_ratio = raindrops_script_vars.ratio;
                    var raindrops_height = Math.round( raindrops_width * raindrops_ratio );

                    if ( raindrops_script_vars.has_ratio_filter ) {
                       jQuery( '#top #header-image' ).removeAttr( 'style' ).css( { 'height': raindrops_height,'display':'block','background-size':'cover' } );
                    }
                }

                    /* @1.352 */
                    if( 'yes' == raindrops_script_vars.raindrops_primary_menu_responsive ) {
                        
                        var raindrops_primary_menu_height = jQuery('#access ul.menu').height();
 
                        if( raindrops_primary_menu_height > raindrops_script_vars.raindrops_primary_menu_responsive_height ) {
                             jQuery('#access').hide();
                             jQuery( 'body' ).addClass( 'rd-primary-menu-responsive-active' );
                        }else{
                             jQuery( 'body' ).removeClass( 'rd-primary-menu-responsive-active' );
                        }
                    }
                    /* @1.354 */
                    var raindrops_main_sidebar_height = jQuery( '.lsidebar' ).height( );
                    var raindrops_extra_sidebar_height = jQuery( '.rsidebar' ).height( );
                    var raindrops_container_height = jQuery( '#container' ).height( );
                    
                    if( raindrops_window_width < 641 ) {
                      
                        jQuery( '.lsidebar, .rsidebar' ).removeAttr( 'style' );
                    } else {
                        
                        if( true == raindrops_script_vars.raindrops_add_inline_style_for_sidebars ) {
                            
                            if( jQuery( 'body' ).hasClass( 'rd-css-equal-height' ) ) {
                                jQuery( 'body' ).remveClass( 'rd-css-equal-height' );
                            }

                           if ( raindrops_main_sidebar_height > raindrops_container_height ) {

                               jQuery( '#container' ).css( { 'min-height': raindrops_main_sidebar_height + 'px' } );
                               jQuery( '.rsidebar' ).css( { 'min-height': raindrops_main_sidebar_height + 'px' } );
                           } else {

                               jQuery( '.lsidebar' ).css( { 'min-height': raindrops_container_height + 'px' } );
                               jQuery( '.rsidebar' ).css( { 'min-height': raindrops_container_height + 'px' } );
                           }
                       } else {
                           
                           jQuery( 'body' ).addClass( 'rd-css-equal-height' );
                       }
                    }
                   
                 /* @1.403 */
                    var raindrops_content_width = jQuery( '#container > .first').width();

                    if ( raindrops_content_width < 481 && raindrops_window_width > 640 ) {
                        jQuery( 'body').addClass('content-lt-480');
                    } else {
                        jQuery( 'body').removeClass('content-lt-480');
                    }
            }

            
            jQuery('#access').show();
            if ( raindrops_script_vars.current_template == 'list_of_post' ) {

                var raindrops_ignore_template = true;
            } else {

                var raindrops_ignore_template = false;
            }

/**
 * detect lang  add ver 1.120
 */
            if ( raindrops_script_vars.browser_detection !== 1 ) {

                jQuery( 'body' ).addClass( raindrops_script_vars.color_type );
                jQuery( 'body' ).addClass( raindrops_script_vars.kind_of_browser );

                if ( navigator.userLanguage ) {

                    baseLang = navigator.userLanguage.substring( 0, 2 ).toLowerCase( );
                } else {

                    baseLang = navigator.language.substring( 0, 2 ).toLowerCase( );
                }

                jQuery( 'body' ).addClass( 'accept-lang-' + baseLang );

                var userAgent = window.navigator.userAgent.toLowerCase( );

                if ( userAgent.match( /msie/i ) ) {

                    var ie_num = userAgent.match( /MSIE (\d+\.\d+);/i );
                    var ieversion = parseInt( ie_num[1], 10 );
                    jQuery( 'body' ).addClass( 'ie' + ieversion );

                } else if ( userAgent.match( /Edge\/\d+/i ) ) {

                    jQuery( 'body' ).addClass( 'edge' );

                } else if ( userAgent.match( /Trident/i ) && userAgent.match( /rv:11/i )) {

                    jQuery( 'body' ).addClass( 'ie11' );

                } else if ( userAgent.match( /Edge/i ) ) {

                    //jQuery( 'body' ).addClass( 'Edge' );
                } else if ( userAgent.indexOf( 'opera' ) != -1 ) {

                    jQuery( 'body' ).addClass( 'opera' );
                } else if ( userAgent.indexOf( 'chrome' ) != -1 ) {

                    jQuery( 'body' ).addClass( 'chrome' );
                } else if ( userAgent.indexOf( 'safari' ) != -1 ) {

                    jQuery( 'body' ).addClass( 'safari' );
                } else if ( userAgent.indexOf( 'firefox' ) != -1 ) {

                    jQuery( 'body' ).addClass( 'firefox' );
                } else if ( userAgent.indexOf( 'gecko' ) != -1 ) {

                    var match = userAgent.match( /(trident)(?:.*rv:([\w.]+))?/ );
                    try{
                        var version = parseInt( match[2], 10 );
                    }catch(error){
                        var version = -1; //match == null for no match
                    }

                    if ( version == 11 ) {
                        jQuery( 'body' ).addClass( 'ie11' );
                    } else {
                        jQuery( 'body' ).addClass( 'gecko' );
                    }

                } else if ( userAgent.indexOf( 'iphone' ) != -1 ) {

                    jQuery( 'body' ).addClass( 'iphone' );
                } else if ( userAgent.indexOf( 'Netscape' ) != -1 ) {

                    jQuery( 'body' ).addClass( 'netscape' );
                } else {

                    jQuery( 'body' ).addClass( 'unknown' );
                }

                /**
                 * Accessible class
                 *
                 * @since 1.217
                 */
                if ( raindrops_script_vars.link_unique_text == true ) {

                    jQuery( 'body' ).addClass( 'raindrops-accessible-mode' );

                } else if ( 'yes' !== raindrops_script_vars.accessibility_settings ) {

                    jQuery( 'body' ).removeClass( 'raindrops-accessible-mode' );

                }
                /**
                 * Check window size and mouse position
                 * Controll childlen menu show right or left side.
                 *
                 *
                 *
                 */

                if ( jQuery( 'body > div' ).is( '#doc3' ) ) {

                    jQuery( "#access" ).mousemove( function ( e ) {

                        var raindrops_menu_item_position = e.pageX;
                        if ( raindrops_window_width - 200 < raindrops_menu_item_position ) {

                            jQuery( '#access ul ul ul' ).addClass( 'left' );
                        } else if ( raindrops_window_width / 2 > raindrops_menu_item_position ) {

                            jQuery( '#access ul ul ul' ).removeClass( 'left' );
                        }

                    } );

                    if ( raindrops_window_width > raindrops_script_vars.fluid_maximum_width ) {
                        //centering page when browser width > $raindrops_fluid_maximun_width
                        jQuery( '#doc3' ).css( { 'margin': 'auto' } );
                    }
                    // Only Japanese Languages
                    if( jQuery('div[class^=rd-l-]') ) {

                        function raindrops_language_detect() {
                            try {
                                return (navigator.browserLanguage || navigator.language || navigator.userLanguage);
                            }
                            catch(e) {
                                 return -1;
                            }
                        }

                        if ( raindrops_language_detect() ) {
                            var accept_language_class = 'rd-l-' + raindrops_language_detect();
                            jQuery('div[class^=rd-l-]').removeClass().addClass( accept_language_class );
                        }

                        if( jQuery('.single div[class^=rd-l-] .entry-content div').hasClass('lang-not-ja') ||
                            jQuery( '.page div[class^=rd-l-] .entry-content div').hasClass('lang-not-ja') ) {
                                jQuery( '.single div[class^=rd-l-] .entry-content,.page div[class^=rd-l-] .entry-content').prepend( '<button id="show_all_lang" class="pad-s clearfix">Show All Languages</button>' );
                        }
                        jQuery('#show_all_lang').click(function(){
                            jQuery('article div,article span').removeClass('lang-ja lang-not-ja');
                            jQuery( '#show_all_lang').remove();
                        });
                    }
                }
            }
            jQuery( window ).load( function ( ) {
                raindrops_resizes( )
            } );
            jQuery( window ).resize( function ( ) {
                raindrops_resizes( )
            } );

            jQuery( '.topsidebar' ).find( 'a' ).on( 'focus.raindrops blur.raindrops', function ( ) {
                  jQuery( this ).parents( ).toggleClass( 'focus' );
            } );
            jQuery( '#access' ).find( 'a' ).on( 'focus.raindrops blur.raindrops', function ( ) {
                   jQuery( this ).parents( ).toggleClass( 'focus' );
            } );

           /*
            * While using the keyboard interface, if you use a mouse, they affect the display of menu If you do not remove the focus class
            */
            jQuery( '.topsidebar' ).on('mousemove','a', function(){
               jQuery( this ).toggleClass('focus').parents( ).children().removeClass('focus');
            });
            jQuery( '#access' ).on('mousemove','a', function(){
               jQuery( this ).toggleClass('focus').parents( ).children().removeClass('focus');
            });

        } else {

            if( false == raindrops_script_vars.raindrops_add_inline_style_for_sidebars ) {

                jQuery( 'body' ).addClass( 'rd-css-equal-height' );
            }else{
                
                if( jQuery( 'body' ).hasClass( 'rd-css-equal-height' ) ) {
                    
                   jQuery( 'body' ).remveClass( 'rd-css-equal-height' );
                }
            }

            if ( raindrops_script_vars.browser_detection !== 1 ) {


               // if ( raindrops_script_vars.is_single || raindrops_script_vars.is_page ) {


                    jQuery( 'body' ).addClass( raindrops_script_vars.color_type );

                    if ( raindrops_script_vars.current_template == 'list_of_post' ) {

                        var raindrops_ignore_template = true;
                    } else {

                        var raindrops_ignore_template = false;
                    }

                    if ( raindrops_script_vars.ignore_template == false ) {

                        var raindrops_main_sidebar_height = jQuery( '.lsidebar' ).height();
                        var raindrops_extra_sidebar_height = jQuery( '.rsidebar' ).height();
                        var raindrops_container_height = jQuery( '#container' ).height();
                        var raindrops_sticky_widget_height = jQuery( '.topsidebar' ).height();

                        if ( raindrops_main_sidebar_height > raindrops_container_height ) {

                            jQuery( '#container' ).css( { 'min-height': raindrops_main_sidebar_height + 'px' } );
                            jQuery( '.rsidebar' ).css( { 'min-height': raindrops_main_sidebar_height + 'px' } );
                        } else {

                            if ( raindrops_sticky_widget_height > 0 ) {

                                raindrops_left_sidebar_height = raindrops_container_height + raindrops_sticky_widget_height + 13;
                                jQuery( '.lsidebar' ).css( { 'min-height': raindrops_left_sidebar_height + 'px' } );
                            } else {

                                jQuery( '.lsidebar' ).css( { 'min-height': raindrops_container_height + 'px' } );
                            }
                            jQuery( '.rsidebar' ).css( { 'min-height': raindrops_container_height + 'px' } );
                        }
                    }

                    if ( navigator.userLanguage ) {

                        baseLang = navigator.userLanguage.substring( 0, 2 ).toLowerCase();
                    } else {

                        baseLang = navigator.language.substring( 0, 2 ).toLowerCase();
                    }

                    jQuery( 'body' ).addClass( 'accept-lang-' + baseLang );


                    var userAgent = window.navigator.userAgent.toLowerCase();

                    if ( userAgent.match( /msie/i ) ) {

                        var ie_num = userAgent.match( /MSIE (\d+\.\d+);/i );
                        var ieversion = parseInt( ie_num[1], 10 );
                        jQuery( 'body' ).addClass( 'ie' + ieversion );
                    } else if ( userAgent.indexOf( 'opera' ) != -1 ) {

                        jQuery( 'body' ).addClass( 'opera' );
                    } else if ( userAgent.indexOf( 'chrome' ) != -1 ) {

                        jQuery( 'body' ).addClass( 'chrome' );
                    } else if ( userAgent.indexOf( 'safari' ) != -1 ) {

                        jQuery( 'body' ).addClass( 'safari' );
                    } else if ( userAgent.indexOf( 'gecko' ) != -1 ) {

                        var match = userAgent.match( /(trident)(?:.*rv:([\w.]+))?/ );
                        try{
                            var version = parseInt( match[2], 10 );
                        }catch(error){
                            var version = -1;
                        }

                        if ( version == 11 ) {
                            jQuery( 'body' ).addClass( 'ie11' );
                        } else {
                            jQuery( 'body' ).addClass( 'gecko' );
                        }
                    } else if ( userAgent.indexOf( 'iphone' ) != -1 ) {

                        jQuery( 'body' ).addClass( 'iphone' );
                    } else if ( userAgent.indexOf( 'Netscape' ) != -1 ) {

                        jQuery( 'body' ).addClass( 'netscape' );
                    } else {

                        jQuery( 'body' ).addClass( 'unknown' );
                    }
               // }
            }


        }
        
        if( true == raindrops_script_vars.raindrops_archive_has_count ) {
                jQuery('.widget_archive').addClass('has-count');
        }

        // "//www.tenman.info/wpdev/wp-content/uploads/2015/08/404.jpg"
        /* show alternative image when image of entry content not exists */
        if( /^(http|https):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i.test(raindrops_script_vars.fallback_image_for_entry_content ) ) {
            jQuery( ".entry-content img" ).error( function () {
                jQuery( this ).unbind( "error" ).attr( "src", raindrops_script_vars.fallback_image_for_entry_content );
            } );
        }

       /**
        * Comment form
        * @1.334
        */

       var require_name_email = raindrops_script_vars.require_name_email;

       if( 9 <  parseInt( ieversion ) || !ieversion ) {
            jQuery( '#comments .social label, #comments .social label + .option, #comments .social .comment-notes' ).css('display','none');
            jQuery( "#respond textarea#comment, .social textarea#comment").css({'border-bottom':'2px solid #e14d43'}).attr("placeholder", raindrops_script_vars.placeholder_text_message );
            jQuery( "#respond textarea#comment, .social textarea#comment").attr("title", raindrops_script_vars.placeholder_text_required_message );
            jQuery( '#comments .social #author' ).attr("placeholder", raindrops_script_vars.placeholder_text_comment_name );
            jQuery( '#comments .social #email' ).attr("placeholder", raindrops_script_vars.placeholder_text_email );
            jQuery( '#comments .social #url' ).attr("placeholder", raindrops_script_vars.placeholder_text_url );
        }

        if( 1 ==  require_name_email ) {

                jQuery('#comments .social input[required="required"]').css({'border-bottom':'2px solid #e14d43'});
                jQuery( '#comments .social #email[required="required"]' ).attr("title", raindrops_script_vars.placeholder_text_required_email );
                jQuery( '#comments .social #author[required="required"]' ).attr("title", raindrops_script_vars.placeholder_text_required_comment_name );

                var inputvalue = jQuery( '#comments .social #author[required="required"]' ).attr("value");

                if(inputvalue !== "") {
                        jQuery('#comments .social #author[required="required"]').removeAttr( 'style' ).css('border-bottom', 'solid 2px #56b274');
                }

                var inputvalue = jQuery( '#comments .social #email[required="required"]' ).attr("value");

                if( validateEmail(inputvalue) ) {
                        jQuery('#comments .social #email[required="required"]').removeAttr( 'style' ).css('border-bottom', 'solid 2px #56b274');
                }
        }

        jQuery("#respond textarea#comment, .social textarea#comment").live('change', function() {

               var inputvalue = jQuery("#respond textarea#comment, .social textarea#comment").attr("value");

               if(inputvalue !== "") {
                       jQuery(this).removeAttr( 'style' ).css('border-bottom', 'solid 2px #56b274');
               }

               else if(inputvalue === "") {
                        jQuery(this).removeAttr( 'style' ).css('border-bottom','2px solid #e14d43');
               }

       });

        jQuery('#comments .social #author[required="required"]').live('change', function() {

                var inputvalue = jQuery( this ).attr("value");

               if(inputvalue !== "") {
                       jQuery(this).removeAttr( 'style' ).css('border-bottom', 'solid 2px #56b274');
               }

               else if(inputvalue === "") {
                        jQuery(this).removeAttr( 'style' ).css('border-bottom','2px solid #e14d43');
               }

       });

        jQuery('#comments .social #email[required="required"]').live('change', function() {

                var inputvalue = jQuery( this ).attr("value");

                if(validateEmail(inputvalue) && '' !== inputvalue ) {
                        jQuery(this).removeAttr( 'style' ).css('border-bottom', 'solid 2px #56b274');
                } else if( false == validateEmail(inputvalue) ) {
                         jQuery(this).removeAttr( 'style' ).css('border-bottom','2px solid #e14d43');
                }

        });

        jQuery('#comments .social #url').live('change', function() {

                 var inputvalue = jQuery( this ).attr("value");

                if(validateUrl(inputvalue)) {
                        jQuery(this).removeAttr( 'style' ).css('border-bottom', 'solid 2px green');
                } else if('' !== inputvalue) {
                         jQuery(this).removeAttr( 'style' ).css('border-bottom', '2px solid #e14d43');
                }

        });

        function validateEmail($email) {
            var emailReg =  /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
            if (!emailReg.test($email)) {
                return false;
            } else {
                return true;
            }
        }
        function validateUrl($url) {
            var urlReg = /^(http|https|ftp):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i;
            if (!urlReg.test($url)) {
                return false;
            } else {
                return true;
            }
        }

        /**
         * add external class for external links
         */

         jQuery('a[href^=http]').not('[href^="' + raindrops_script_vars.home_url + '"]').addClass('external');

        /**
         * add rel="nofollow" for External links that have been described in the comment text
         */
        jQuery('.comment-body a[href^=http]').not('[href^="' + raindrops_script_vars.home_url + '"]').attr('rel','nofollow');
    } );
} )( jQuery );

function raindrops_share_href() {

    var browser = document.raindrops_share.share_links.value;

    if ( browser == 'data:text' ) {
        location.href = raindrops_script_vars.content_shareing;
    } else {
        location.href = browser;
    }
}

/* Sticky Menu */

jQuery( function ( $ ) {
    var raindrops_window_width = jQuery( window ).width();
    
    if ( 'yes' == raindrops_script_vars.raindrops_raindrops_sticky_menu && raindrops_window_width > 640 ) {

        $( '#access .menu-header' ).after( '<a id="page-top"><span></span></a><a id="desmiss"><span></span></a>' );
        var topBtn = $( "#page-top" );
        topBtn.hide();
        $( '#desmiss' ).hide();
        var desmiss = false;

        $( '#desmiss' ).click( function () {

            topBtn.fadeOut();
            $( 'nav#access' ).removeClass( 'raindrops-menu-fixed' );
            desmiss = true;
        } );

        $( window ).scroll( function () {

            if ( $( this ).scrollTop() > 100 && desmiss == false ) {

                topBtn.fadeIn();
                $( '#desmiss' ).fadeIn();
                $( 'nav#access, p.raindrops-mobile-menu' ).addClass( 'raindrops-menu-fixed' ); //.css( { 'min-height': '3.2em' } );

                if ( raindrops_window_width < 641 ) {
                    $( 'nav .menu > li > a' ).removeAttr( 'style' );
                }

            } else {
                
                $( '#desmiss' ).fadeOut('fast');
                topBtn.fadeOut('fast');
                $( 'nav#access, p.raindrops-mobile-menu' ).removeClass( 'raindrops-menu-fixed' );
                $( 'nav' ).not('.lsidebar').removeAttr( 'style' );
                $( 'nav .menu > li > a' ).removeAttr( 'style' );
            }
        } );

        topBtn.click( function () {
            $( "body,html" ).animate( {
                scrollTop: 0 }, 500 );
            return false;
        } );
        $( '#desmiss' ).click( function () {
            topBtn.fadeOut('fast');
            $( 'nav#access' ).removeClass( 'raindrops-menu-fixed' );
        } );
    }
} );

jQuery( function ( $ ) {
    /**
     * Responsive Sidebar
     * @sice 1.410
     */
    
    if ( 'yes' == raindrops_script_vars.raindrops_extra_sidebar_responsive ) {

        $( ".rsidebar-shrink button" ).click( function () {
            $( ".rd-col-3 #container, .rsidebar-shrink button" ).toggleClass( "rd-expand-sidebar" );
            $( ".rsidebar-shrink button span" ).not( ".rd-expand-sidebar" ).text( raindrops_script_vars.raindrops_sidebar_responsive_text_op );
            $( ".rsidebar-shrink button.rd-expand-sidebar span" ).text( raindrops_script_vars.raindrops_sidebar_responsive_text_cl );
        } );
    }
    if ( 'yes' == raindrops_script_vars.raindrops_default_sidebar_responsive ) {
        $( ".lsidebar-shrink button" ).click( function () {
            $( ".rd-col-2 #bd,.rd-col-3 #bd, .lsidebar-shrink button" ).toggleClass( "rd-expand-sidebar-default" );
            $( ".lsidebar-shrink button span" ).not( ".rd-expand-sidebar-default" ).text( raindrops_script_vars.raindrops_sidebar_responsive_text_op );
            $( ".lsidebar-shrink button.rd-expand-sidebar-default span" ).text( raindrops_script_vars.raindrops_sidebar_responsive_text_cl );
        } );
    }
} );