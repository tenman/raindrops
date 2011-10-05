/** Add Visual Editor Menu
 *
 *
 * @package WordPress
 * @subpackage Raindrops
 * @since Raindrop 0.922
 */

(function() {

/**
 * Add list box
 *
 *
 *
 *
 */
	
tinymce.create('tinymce.plugins.addMyButton', {
    createControl: function(n, cm) {
        switch (n) {
            case 'addMyButton':
                var mlb = cm.createListBox('addMyButton', {
                     title : 'Option',
                     onselect : function(v) {
tinyMCE.activeEditor.execCommand('mceInsertContent', false, v);
                     }
                });

var test_layout = '<div class="yui-gd"><div class="yui-u first gradient3" style="min-height:150px"><div>left narrow</div></div><div class="yui-u gradient3" style="min-height:150px"><div>right main</div></div></div>';

var harf = '<div class="yui-g"><div class="yui-u first gradient3" style="min-height:100px;"><div>Left Column</div></div><div class="yui-u gradient3" style="min-height:100px;"><div>Right Column</div></div></div>';
              
var torio = '<div class="yui-gb"><div class="yui-u first gradient3" style="min-height:100px"><div >left</div></div><div class="yui-u gradient3" style="min-height:100px"><div >right</div></div><div class="yui-u gradient3" style="min-height:100px"><div >center</div></div></div>';

var dialog = '<div class="gradient3 raindrops-dialog" style="min-height: 100px;"><h2 class="gradient-2 raindrops-dialog-title" style="margin: 0; padding: 0.2em 1em;">title</h2><div class="raindrops-dialog-content pad-m">text</div></div>';

var tab = '<div class="raindrops-tab"><ul class="raindrops-tab-list"><li>Tab Area</li></ul><div class="raindrops-tab-content clearfix"><div id="raindrops-tab-wrapper"><div class="raindrops-tab-page"><h3>title1</h3>content here</div><div class="raindrops-tab-page"><h3>title2</h3>content here</div><div class="raindrops-tab-page"><h3>title3</h3>content here</div></div></div></div>';
var tab = '<ul class="raindrops-tab-list clearfix"><li class="dummy">Tab Area</li></ul><div class="raindrops-tab-content clearfix"><div class="raindrops-tab-page"><h3>title1</h3>content here</div><div class="raindrops-tab-page"><h3>title2</h3>content here</div><div class="raindrops-tab-page"><h3>title3</h3>content here</div></div>';

var toggle = '<ul><li class="raindrops-toggle raindrops-toggle-title">Toggle Title</li><li class="raindrops-toggle">Toggle Content</li></ul>';

                mlb.add('33:66', test_layout);
                mlb.add('50:50', harf);
                mlb.add('33:33:33', torio);
                mlb.add('dialog box', dialog);
                mlb.add('tab box', tab);
				mlb.add('Toggle', toggle);

		return mlb;
        }

        return null;
    }
});
	tinymce.PluginManager.add('addMyButton', tinymce.plugins.addMyButton);
	
})();
