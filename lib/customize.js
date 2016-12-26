(function($){
    var $output = (function(){/*
        <div id="raindrops-customizer-preview-menu" class="wp-ui-primary">
            <span id="raindrops-customizer-label"></span>
            <span id="raindrops-customizer-width"></span>       
            <span id="raindrops-data-stored"></span>
            <input type="range" name="raindrops-sidebar-width" id="raindrops-sidebar-width" min="300" max="640" />
            <span id="range_val"></span>
        </div>
    */}).toString().match(/[^]*\/\*([^]*)\*\/\}$/)[1];

    $('#customize-preview').prepend( $output );

    function resizerChange( $width ) {

            if(  $width ) {

                $('#customize-controls').css({
                            'width': $width,
                            'max-width':'100%'
                    });
            } else {

                $('#customize-controls').removeAttr('style');
            }
    }

    $(window).resize(function(){

        var $preview_width = $('#customize-preview').innerWidth();

            $('#raindrops-customizer-width').text(  $preview_width +'px' );
    }).resize();
    
    $( '.devices .preview-tablet' ).on( 'click', function( event ) {
        
	setTimeout(function(){
            var $preview_width = $('#customize-preview').innerWidth();
            $('#raindrops-customizer-width').text(  $preview_width +'px' );
        },1000);
    });
    /**
     * For WordPress4.5 devices preview
     * 
     */
    $( '.devices .preview-mobile' ).on( 'click', function( event ) {
        
	setTimeout(function(){
            var $preview_width = $('#customize-preview').innerWidth();
            $('#raindrops-customizer-width').text(  $preview_width +'px' );
        },1000);      
    });
    
    $( '.devices .preview-desktop' ).on( 'click', function( event ) {
        
         setTimeout(function(){
            var $preview_width = $('#customize-preview').innerWidth();
            $('#raindrops-customizer-width').text(  $preview_width +'px' );
        },1000);          
    });
    
    $( 'button.collapse-sidebar' ).on('click', function() {

         setTimeout(function(){
            var $preview_width = $('#customize-preview').innerWidth();
            $('#raindrops-customizer-width').text(  $preview_width +'px' );
        },1000);
    });
    
    $( '#raindrops-sidebar-width' ).change(function() {

             var $width  = $('#raindrops-sidebar-width').val();

             resizerChange( $width );
    });


    sanitaize = {
        hex : function ( str ) {

            var hex_color  = /^#[0-9A-F]{6}$/i.test(str);
            if(hex_color) {
                return str;
            }
        }
    };
    $('#raindrops-data-stored').text( raindrops_customizer_script_vars.raindrops_data_stored );
    $( '#raindrops-customizer-label' ).text( raindrops_customizer_script_vars.preview_label );
    $( '#raindrops-reset-font-color' ).text( raindrops_customizer_script_vars.reset_font_label );
    $( '#raindrops-customizer-label' ).before( '<span class="raindrops-theme-settings-presentation link" ><a href="javascript:wp.customize.panel( \'raindrops_theme_settings_presentation_panel\' ).focus();" class="wp-ui-primary">'+ raindrops_customizer_script_vars.basic_config_label +'</a></span>');

    if ( 'yes' == raindrops_customizer_script_vars.admin_color) {

            $( '#customize-theme-controls').addClass( 'wp-ui-primary' );
            $( '.wp-full-overlay-sidebar' ).addClass( 'wp-ui-primary' );
            $( 'customize-controls-close' ).addClass( 'wp-ui-primary' );
            $( '.wp-full-overlay-sidebar' ).css({'border-right':'none'});
    }
    
    var core_version = raindrops_customizer_script_vars.raindrops_core_version;
        core_version = core_version.split('.');
    var branch = core_version[1].slice(0,1);

    if ( 'option' == raindrops_customizer_script_vars.setting_field_type && parseInt(core_version[0]) == 4 && parseInt(branch) < 7 ) {

        $( document ).on( 'change', function(event) {
           var raindrops_alert_flag = false;

           if ( wp.customize.instance( 'raindrops_theme_settings[raindrops_reset_options]' ).get() == 'yes' && 'option' == raindrops_customizer_script_vars.setting_field_type ) {

                    var message = confirm( raindrops_customizer_script_vars.reset_confirm );

                    if( message ) {               

                        $("#customize-header-actions #save").click( function(){
                            setTimeout(function(){ location.reload(); },1000);
                        });                  

                    } else {
                        wp.customize.instance( 'raindrops_theme_settings[raindrops_reset_options]' ).set( 'no' );
                    }

                    raindrops_alert_flag = true;
            }
        } );
    }   

    if ( 'automatic' == raindrops_customizer_script_vars.raindrops_raindrops_color_select ) {

       if ( 'option' == raindrops_customizer_script_vars.setting_field_type ) {
            
            $( document ).on( 'change', function(event) {       
            /**
             * change @1.422
             * $( '#customize-control-raindrops_theme_settings-raindrops_style_type input[type="radio"]' ).on( 'change', function ( event ) {
             */

                if ( wp.customize.instance( 'raindrops_theme_settings[raindrops_style_type]' ).get() == 'dark' ) {

                    wp.customize.instance( 'raindrops_theme_settings[raindrops_footer_link_color]' ).set( sanitaize.hex( raindrops_customizer_script_vars.dark_footer_link_color ) );
                    wp.customize.instance( 'raindrops_theme_settings[raindrops_footer_color]' ).set( sanitaize.hex( raindrops_customizer_script_vars.dark_footer_color_default ) );
                    wp.customize.instance( 'raindrops_theme_settings[raindrops_hyperlink_color]' ).set( sanitaize.hex( raindrops_customizer_script_vars.dark_hyperlink_color_default ) );
                    wp.customize.instance( 'raindrops_theme_settings[raindrops_default_fonts_color]' ).set( sanitaize.hex( raindrops_customizer_script_vars.dark_fonts_color_default ) );

                } else if ( wp.customize.instance( 'raindrops_theme_settings[raindrops_style_type]' ).get() == 'w3standard' ) {

                    wp.customize.instance( 'raindrops_theme_settings[raindrops_footer_link_color]' ).set( sanitaize.hex( raindrops_customizer_script_vars.w3standard_footer_link_color ) );
                    wp.customize.instance( 'raindrops_theme_settings[raindrops_footer_color]' ).set( sanitaize.hex( raindrops_customizer_script_vars.w3standard_footer_color_default ) );
                    wp.customize.instance( 'raindrops_theme_settings[raindrops_hyperlink_color]' ).set( sanitaize.hex( raindrops_customizer_script_vars.w3standard_hyperlink_color_default ) );
                    wp.customize.instance( 'raindrops_theme_settings[raindrops_default_fonts_color]' ).set( sanitaize.hex( raindrops_customizer_script_vars.w3standard_fonts_color_default ) );

                } else if ( wp.customize.instance( 'raindrops_theme_settings[raindrops_style_type]' ).get() == 'light' ) {

                    wp.customize.instance( 'raindrops_theme_settings[raindrops_footer_link_color]' ).set( sanitaize.hex( raindrops_customizer_script_vars.light_footer_link_color ) );
                    wp.customize.instance( 'raindrops_theme_settings[raindrops_footer_color]' ).set( sanitaize.hex( raindrops_customizer_script_vars.light_footer_color_default ) );
                    wp.customize.instance( 'raindrops_theme_settings[raindrops_hyperlink_color]' ).set( sanitaize.hex( raindrops_customizer_script_vars.light_hyperlink_color_default ) );
                    wp.customize.instance( 'raindrops_theme_settings[raindrops_default_fonts_color]' ).set( sanitaize.hex( raindrops_customizer_script_vars.light_fonts_color_default ) );

                } else if ( wp.customize.instance( 'raindrops_theme_settings[raindrops_style_type]' ).get() == 'minimal' ) {

                    wp.customize.instance( 'raindrops_theme_settings[raindrops_footer_link_color]' ).set( sanitaize.hex( raindrops_customizer_script_vars.minimal_footer_link_color ) );
                    wp.customize.instance( 'raindrops_theme_settings[raindrops_footer_color]' ).set( sanitaize.hex( raindrops_customizer_script_vars.minimal_footer_color_default ) );
                    wp.customize.instance( 'raindrops_theme_settings[raindrops_hyperlink_color]' ).set( sanitaize.hex( raindrops_customizer_script_vars.minimal_hyperlink_color_default ) );
                    wp.customize.instance( 'raindrops_theme_settings[raindrops_default_fonts_color]' ).set( sanitaize.hex( raindrops_customizer_script_vars.minimal_fonts_color_default ) );

                } else {

                    wp.customize.instance( 'raindrops_theme_settings[raindrops_footer_link_color]' ).set( sanitaize.hex( raindrops_customizer_script_vars.fallback_footer_link_color ) );
                    wp.customize.instance( 'raindrops_theme_settings[raindrops_footer_color]' ).set( sanitaize.hex( raindrops_customizer_script_vars.fallback_footer_color_default ) );
                    wp.customize.instance( 'raindrops_theme_settings[raindrops_hyperlink_color]' ).set( sanitaize.hex( raindrops_customizer_script_vars.fallback_hyperlink_color_default ) );
                    wp.customize.instance( 'raindrops_theme_settings[raindrops_default_fonts_color]' ).set( sanitaize.hex( raindrops_customizer_script_vars.fallback_fonts_color_default ) );

                }
            } );
        }
    } 
})(jQuery);

( function ( $ ) {
    if ( 'theme_mod' == raindrops_customizer_script_vars.setting_field_type ) {
     
        $( window ).load( function () {
                    
             wp.customize( 'raindrops_style_type', function ( value ) {

                value.bind( function ( newval ) {
                    if ( 'dark' == newval ) {
                        
                        wp.customize.instance( 'raindrops_footer_link_color' ).set( sanitaize.hex( raindrops_customizer_script_vars.dark_footer_link_color ) );
                        wp.customize.instance( 'raindrops_footer_color' ).set( sanitaize.hex( raindrops_customizer_script_vars.dark_footer_color_default ) );
                        wp.customize.instance( 'raindrops_hyperlink_color' ).set( sanitaize.hex( raindrops_customizer_script_vars.dark_hyperlink_color_default ) );
                        wp.customize.instance( 'raindrops_default_fonts_color' ).set( sanitaize.hex( raindrops_customizer_script_vars.dark_fonts_color_default ) );             
                    } else if ( 'w3standard' == newval ) {
                        
                        wp.customize.instance( 'raindrops_footer_link_color' ).set( sanitaize.hex( raindrops_customizer_script_vars.w3standard_footer_link_color ) );
                        wp.customize.instance( 'raindrops_footer_color' ).set( sanitaize.hex( raindrops_customizer_script_vars.w3standard_footer_color_default ) );
                        wp.customize.instance( 'raindrops_hyperlink_color' ).set( sanitaize.hex( raindrops_customizer_script_vars.w3standard_hyperlink_color_default ) );
                        wp.customize.instance( 'raindrops_default_fonts_color' ).set( sanitaize.hex( raindrops_customizer_script_vars.w3standard_fonts_color_default ) );                
                    } else if ( 'light' == newval ) {
                        
                        wp.customize.instance( 'raindrops_footer_link_color' ).set( sanitaize.hex( raindrops_customizer_script_vars.light_footer_link_color ) );
                        wp.customize.instance( 'raindrops_footer_color' ).set( sanitaize.hex( raindrops_customizer_script_vars.light_footer_color_default ) );
                        wp.customize.instance( 'raindrops_hyperlink_color' ).set( sanitaize.hex( raindrops_customizer_script_vars.light_hyperlink_color_default ) );
                        wp.customize.instance( 'raindrops_default_fonts_color' ).set( sanitaize.hex( raindrops_customizer_script_vars.light_fonts_color_default ) );                
                    } else if ( 'minimal' == newval ) {
                        
                        wp.customize.instance( 'raindrops_footer_link_color' ).set( sanitaize.hex( raindrops_customizer_script_vars.minimal_footer_link_color ) );
                        wp.customize.instance( 'raindrops_footer_color' ).set( sanitaize.hex( raindrops_customizer_script_vars.minimal_footer_color_default ) );
                        wp.customize.instance( 'raindrops_hyperlink_color' ).set( sanitaize.hex( raindrops_customizer_script_vars.minimal_hyperlink_color_default ) );
                        wp.customize.instance( 'raindrops_default_fonts_color' ).set( sanitaize.hex( raindrops_customizer_script_vars.minimal_fonts_color_default ) );               
    
                    } else {

                        wp.customize.instance( 'raindrops_footer_link_color' ).set( sanitaize.hex( raindrops_customizer_script_vars.fallback_footer_link_color ) );
                        wp.customize.instance( 'raindrops_footer_color' ).set( sanitaize.hex( raindrops_customizer_script_vars.fallback_footer_color_default ) );
                        wp.customize.instance( 'raindrops_hyperlink_color' ).set( sanitaize.hex( raindrops_customizer_script_vars.fallback_hyperlink_color_default ) );
                        wp.customize.instance( 'raindrops_default_fonts_color' ).set( sanitaize.hex( raindrops_customizer_script_vars.fallback_fonts_color_default ) );
                    }
                } );

            } );

        });
    }
} )( jQuery );

(function($){
        $('#raindrops-refresh').click(function(){
            var api = wp.customize;
            api.previewer.refresh();
        });
})(jQuery);
(function($){
   /**
    * customize-selective-refresh-widgets relate settings
    */
   
    /* blog name */
        wp.customize( 'blogname', function( value ) {
            value.bind( function( to ) {
                    $( '#site-title a span' ).text( to );
            } );
        } );
        if( wp.customize.section( 'theme_options' ).prop('expanded')){
            wp.customize.section( 'theme_options' ).expanded.bind( function( isExpanding ) {
                wp.customize.previewer.send( 'section-highlight', { expanded: isExpanding } );
            } );
        }
    /* blog description */
        wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( 'p.tagline' ).text( to );
		} );    
	} );
    
})(jQuery);