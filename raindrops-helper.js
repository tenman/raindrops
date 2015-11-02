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
         
            function raindrops_resizes( ) {

                if ( raindrops_script_vars.restore_check !== 'remove-header' ) {

                    var image_exists = raindrops_script_vars.header_image_uri;
                    var raindrops_width = jQuery( 'div#header-image' ).width();
                    var raindrops_window_width = jQuery( window ).width();
                    var raindrops_ratio = raindrops_script_vars.ratio;
                    var raindrops_height = Math.round( raindrops_width * raindrops_ratio );
                  /*  jQuery( '#header-image' ).removeAttr( 'style' ).css( { 'height': raindrops_height,'display':'block' } );*/
                      
                }
            }

            if ( raindrops_script_vars.current_template == 'list_of_post' ) {

                var raindrops_ignore_template = true;
            } else {

                var raindrops_ignore_template = false;
            }

            if ( raindrops_window_width > 640 && raindrops_script_vars.ignore_template == false ) {

                var raindrops_main_sidebar_height = jQuery( '.lsidebar' ).height( );
                var raindrops_extra_sidebar_height = jQuery( '.rsidebar' ).height( );
                var raindrops_container_height = jQuery( '#container' ).height( );
                var raindrops_sticky_widget_height = jQuery( '.topsidebar' ).height( );

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

//detect lang  add ver 1.120

            if ( raindrops_script_vars.browser_detection !== 1 ) {

                //  if ( raindrops_script_vars.is_single || raindrops_script_vars.is_page ) {

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
                    
                } else if ( userAgent.match( /Edge\/12/i ) ) {

                    jQuery( 'body' ).addClass( 'edge' );
                
                } else if ( userAgent.match( /Trident/i ) && userAgent.match( /rv:11/i )) {

                    jQuery( 'body' ).addClass( 'ie11' );
                
                } else if ( userAgent.match( /Edge/i ) ) {

                   // jQuery( 'body' ).addClass( 'Edge' );
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
                // } //end if (  true !== $raindrops_browser_detection  )

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
 

            jQuery( '#access' ).find( 'a' ).on( 'focus.raindrops blur.raindrops', function ( ) {
               // jQuery( this ).parents( '.menu-header .menu, .menu-item, .page_item, .skip-link' ).toggleClass( 'focus' );
                jQuery( this ).parents( ).toggleClass( 'focus' );
            } );
            
           
           /*
            * While using the keyboard interface, if you use a mouse, they affect the display of menu If you do not remove the focus class
            */
            jQuery( '#access' ).on('mousemove','a', function(){
               jQuery( this ).toggleClass('focus').parents( ).children().removeClass('focus'); 
            });

        } else {


            
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

        // "//www.tenman.info/wpdev/wp-content/uploads/2015/08/404.jpg"
        /* show alternative image when image of entry content not exists */
        if( /^(http|https):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i.test(raindrops_script_vars.fallback_image_for_entry_content ) ) { 
            jQuery( ".entry-content img" ).error( function () {
                jQuery( this ).unbind( "error" ).attr( "src", raindrops_script_vars.fallback_image_for_entry_content );
            } );
        }
        
    } );
} )( jQuery );