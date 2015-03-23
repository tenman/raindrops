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
            'name'               => 'ZenCache',
            'slug'               => 'zencache',
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
	

	$message_strings = '<div class="wrap raindrops-tgm-message"><p>'. esc_html__('Once you activate Breadcrumb NavXT, the WP-PageNavi, Next Setting is the Plugin Presentation at customizer page.If Set to yes then reflect automatically, even without and editing of the template to reflect automatically.', 'Raindrops'). '</p>';
	$message_strings .= '<p>'. esc_html__('Of course, even if you do not use these plugins, it will work without the function of the Raindrops is lost, please decide freely whether or not to use or use in your favorite','Raindrops').'</p></div>';
	$message_strings .= '<p><a href="'. esc_url( admin_url('customize.php' ) ).'">'.esc_html__('Link to Customizer', 'Raindrops' ).'</a></p>';
	
	
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => $message_strings, // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Recommend Plugins', 'Raindrops' ),
            'menu_title'                      => __( 'Recommend Plugins', 'Raindrops' ),
            'installing'                      => __( 'Installing Plugin: %s', 'Raindrops' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'Raindrops' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'Raindrops' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' , 'Raindrops'), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' , 'Raindrops'), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'Raindrops' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' , 'Raindrops'), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' , 'Raindrops'), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' , 'Raindrops'), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' , 'Raindrops'), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' , 'Raindrops'),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' , 'Raindrops'),
            'return'                          => __( 'Return to Recommend Plugins Installer', 'Raindrops' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'Raindrops' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'Raindrops' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );

}