(function($){

        var $output = (function(){/*
            <div id="raindrops-customizer-preview-menu" class="wp-ui-primary">
                <span id="raindrops-customizer-label preview">Preview Width</span>
                <span id="raindrops-customizer-width"></span><span id="range_val"></span>
                <input type="range" name="raindrops-sidebar-width" id="raindrops-sidebar-width" min="300" max="640" />
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

})(jQuery);
