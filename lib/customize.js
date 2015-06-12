(function($){

    var $output = (function(){/*
        <div id="raindrops-customizer-preview-menu" class="wp-ui-primary">
            <span id="raindrops-customizer-label"></span>             
            <span id="raindrops-customizer-width"></span>
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

    $( '#raindrops-customizer-label' ).text( raindrops_customizer_script_vars.preview_label );
    $( '#raindrops-reset-font-color' ).text( raindrops_customizer_script_vars.reset_font_label );
    $( '#raindrops-customizer-label' ).before( '<span class="raindrops-theme-settings-presentation link"><a href="customize.php?autofocus[panel]=raindrops_theme_settings_presentation_panel" class="wp-ui-primary">'+ raindrops_customizer_script_vars.basic_config_label +'</a></span>');

    if ( 'yes' == raindrops_customizer_script_vars.admin_color) {
        
            $( '#customize-theme-controls').addClass( 'wp-ui-primary' ); 
            $( '.wp-full-overlay-sidebar' ).addClass( 'wp-ui-primary' );
            $( 'customize-controls-close' ).addClass( 'wp-ui-primary' );
            $( '.wp-full-overlay-sidebar' ).css({'border-right':'none'});
    }
 
    $( document ).on( 'change', function(event) {
         
        if ( wp.customize.instance( 'raindrops_theme_settings[raindrops_style_type]' ).get() == 'dark' ) {
              
            wp.customize.instance( 'raindrops_theme_settings[raindrops_footer_link_color]' ).set( sanitaize.hex( raindrops_customizer_script_vars.dark_footer_link_color ) );           
            wp.customize.instance( 'raindrops_theme_settings[raindrops_footer_color]' ).set( sanitaize.hex( raindrops_customizer_script_vars.dark_footer_color_default ) );
            wp.customize.instance( 'raindrops_theme_settings[raindrops_hyperlink_color]' ).set( sanitaize.hex( raindrops_customizer_script_vars.dark_hyperlink_color_default ) );
            wp.customize.instance( 'raindrops_theme_settings[raindrops_default_fonts_color]' ).set( sanitaize.hex( raindrops_customizer_script_vars.dark_fonts_color_default ) );
        }
        if ( wp.customize.instance( 'raindrops_theme_settings[raindrops_style_type]' ).get() == 'w3standard' ) {
            
            wp.customize.instance( 'raindrops_theme_settings[raindrops_footer_link_color]' ).set( sanitaize.hex( raindrops_customizer_script_vars.w3standard_footer_link_color ) );           
            wp.customize.instance( 'raindrops_theme_settings[raindrops_footer_color]' ).set( sanitaize.hex( raindrops_customizer_script_vars.w3standard_footer_color_default ) );
            wp.customize.instance( 'raindrops_theme_settings[raindrops_hyperlink_color]' ).set( sanitaize.hex( raindrops_customizer_script_vars.w3standard_hyperlink_color_default ) );
            wp.customize.instance( 'raindrops_theme_settings[raindrops_default_fonts_color]' ).set( sanitaize.hex( raindrops_customizer_script_vars.w3standard_fonts_color_default ) );
        }

        if ( wp.customize.instance( 'raindrops_theme_settings[raindrops_style_type]' ).get() == 'light' ) {
            
            wp.customize.instance( 'raindrops_theme_settings[raindrops_footer_link_color]' ).set( sanitaize.hex( raindrops_customizer_script_vars.light_footer_link_color ) );           
            wp.customize.instance( 'raindrops_theme_settings[raindrops_footer_color]' ).set( sanitaize.hex( raindrops_customizer_script_vars.light_footer_color_default ) );
            wp.customize.instance( 'raindrops_theme_settings[raindrops_hyperlink_color]' ).set( sanitaize.hex( raindrops_customizer_script_vars.light_hyperlink_color_default ) );
            wp.customize.instance( 'raindrops_theme_settings[raindrops_default_fonts_color]' ).set( sanitaize.hex( raindrops_customizer_script_vars.light_fonts_color_default ) );
        }
        
        if ( wp.customize.instance( 'raindrops_theme_settings[raindrops_style_type]' ).get() == 'minimal' ) {
            
            wp.customize.instance( 'raindrops_theme_settings[raindrops_footer_link_color]' ).set( sanitaize.hex( raindrops_customizer_script_vars.minimal_footer_link_color ) );           
            wp.customize.instance( 'raindrops_theme_settings[raindrops_footer_color]' ).set( sanitaize.hex( raindrops_customizer_script_vars.minimal_footer_color_default ) );
            wp.customize.instance( 'raindrops_theme_settings[raindrops_hyperlink_color]' ).set( sanitaize.hex( raindrops_customizer_script_vars.minimal_hyperlink_color_default ) );
            wp.customize.instance( 'raindrops_theme_settings[raindrops_default_fonts_color]' ).set( sanitaize.hex( raindrops_customizer_script_vars.minimal_fonts_color_default ) );
        }
        
        if ( wp.customize.instance( 'raindrops_theme_settings[raindrops_col_setting_type]' ).get() == 'details' ) {
            
            wp.customize.instance( 'raindrops_theme_settings[raindrops_show_right_sidebar]' ).set( 'show' );  
        }
        
    } );

})(jQuery);