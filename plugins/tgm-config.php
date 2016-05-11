<?php
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */

function raindrops_theme_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        // This is an example of how to include a plugin pre-packaged with a theme.
		 array(
            'name'               => 'Breadcrumb NavXT',
            'slug'               => 'breadcrumb-navxt',
            'required'           => false,
        ),
		 array(
            'name'               => 'WP-PageNavi',
            'slug'               => 'wp-pagenavi',
            'required'           => false,
        ),
		 array(
            'name'               => 'Comet Cache',
            'slug'               => 'comet-cache',
            'required'           => false,
        ),
		 array(
            'name'               => 'Meta Slider',
            'slug'               => 'ml-slider',
            'required'           => false,
        ),
		array(
            'name'               => 'The Events Calendar',
            'slug'               => 'the-events-calendar',
            'required'           => false,
        ),
    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */

	$message_strings = '<div class="wrap raindrops-tgm-message"><p>'. esc_html__('Once you activate Breadcrumb NavXT, the WP-PageNavi, Next Setting is the Plugin Presentation at customizer page.If Set to yes then reflect automatically, even without and editing of the template to reflect automatically.', 'raindrops'). '</p>';
	$message_strings .= '<p>'. esc_html__( "Prior to install the theme, if you have to activate these plug-ins, it does not do anything. If you use the function of customized plug-in theme, Once you have the plug-in de-activate, add this page or, in the plug-in list, and you'll re-activated, the item of the customizer add-on It will be.", 'raindrops' ). '</p>';
	$message_strings .= '<p>'. esc_html__('Of course, even if you do not use these plugins, it will work without the function of the Raindrops is lost, please decide freely whether or not to use or use in your favorite','raindrops').'</p></div>';
	$message_strings .= '<p><a href="'. esc_url( admin_url('customize.php' ) ).'">'.esc_html__('Link to Customizer', 'raindrops' ).'</a></p>';
	
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => $message_strings, // Message to output right before the plugins table.
    );

    tgmpa( $plugins, $config );
}