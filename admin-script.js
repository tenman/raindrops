jQuery( document ).ready( function( $ ) {
  var farbtastic;

  function pickColor( color ) {
    farbtastic.setColor( color );
    jQuery( '#pickedcolor' ).val( color );
  }

  jQuery( 'body.theme-editor-php .fileedit-sub ' ).append(
      '<div><input type="text" name="pickedcolor" id="pickedcolor" value="" />'
    + '<a class="hide-if-no-js" href="#" id="pickcolor">色を選択</a>'
    + '<div id="colorPickerDiv" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>'
  );

  jQuery( '#pickcolor' ).click( function() {
    jQuery( '#colorPickerDiv' ).show();
    return false;
  });

  jQuery( '#colorPickerDiv' ).each( function() {
    farbtastic = jQuery.farbtastic('#colorPickerDiv', function(color) {
      pickColor(color);
    });
  });

  jQuery( document ).mousedown( function() {
    jQuery( '#colorPickerDiv' ).each(function(){
      var display = jQuery( this ).css( 'display' );
      if ( display == 'block' ) {
        jQuery( this ).fadeOut(2);
          var ed = jQuery( '#newcontent' );
          ed.focus();
          edInsertContent( ed.get( 0 ), jQuery( '#pickedcolor' ).val() );
      }
    });
  });
});