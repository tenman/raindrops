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
                // $('#range_val').text(  $width +'px' );
                 resizerChange( $width );
        });
        
        $( '#raindrops-customizer-label' ).text( raindrops_customizer_script_vars.preview_label );
        
        $( '#raindrops-customizer-label' ).before( '<span class="raindrops-theme-settings-presentation link"><a href="'+ raindrops_customizer_script_vars.home_url +'/wp-admin/customize.php?autofocus[section]=raindrops_theme_settings_presentation" class="wp-ui-primary">'+ raindrops_customizer_script_vars.basic_config_label +'</a></span>');
        
    if ( 'yes' == raindrops_customizer_script_vars.admin_color) {
            $( '#customize-theme-controls').addClass( 'wp-ui-primary' ); 
            $( '.wp-full-overlay-sidebar' ).addClass( 'wp-ui-primary' );
            $( 'customize-controls-close' ).addClass( 'wp-ui-primary' );
            $( '.wp-full-overlay-sidebar' ).css({'border-right':'none'});
    }
})(jQuery);