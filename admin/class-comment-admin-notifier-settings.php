<?php

/**
 * The new discussion setting of the plugin.
 *
 * @since      1.0.0
 * @package    Comment_Admin_Notifier\admin
 */

/**
 * Class Comment_Admin_Notifier_Settings
 *
 */
class Comment_Admin_Notifier_Settings {

	private $plugin_name;

	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * This function introduces the plugin option as a new section in the Settings -> Discussion page.
	 */
	public function setup_plugin_options_section() {
		add_settings_section(
			'comment_admin_notifier_settings_section',         // ID used to identify this section and with which to register options
			'Comment admin notifier options',                  // Title to be displayed on the administration page
			array($this, 'render_settings_page_content'), // Callback used to render the description of the section
			'discussion'                           // Page on which to add this section
		);

        // Next, we will introduce the field for toggling the email alert feature.
        add_settings_field(
            'email_comment_admin_alert',                      // ID used to identify the field throughout the theme
            'Email alert',                           // The label to the left of the option interface element
            array($this, 'render_settings_field_content'),   // The name of the function responsible for rendering the option interface
            'discussion',                          // The page on which this option will be displayed
            'comment_admin_notifier_settings_section',         // The name of the section to which this field belongs
            array(                              // The array of arguments to pass to the callback. In this case, just a description.
                'Activate this setting to make sure admins get an email every time a new comment is published.'
            )
        );

    // Finally, we register the field with WordPress
        register_setting(
            'discussion',
            'email_comment_admin_alert'
        );

	}


	/**
	 * Renders additional text for the new section
	 */
	public function render_settings_page_content()
    {


    }

    /**
     * This function renders the interface elements for toggling the email alert .
     * It accepts an array of arguments and expects the first element in the array to be the description
     * to be displayed next to the checkbox.
     */
    public function render_settings_field_content($args) {

        // Note that the ID and the name attribute of the element should match that of the ID in the call to add_settings_field
        $html = '<input type="checkbox" id="email_comment_admin_alert" name="email_comment_admin_alert" value="1" ' . checked(1, get_option('email_comment_admin_alert'), false) . '/>';

        // Here, we will take the first argument of the array and add it to a label next to the checkbox
        $html .= '<label for="email_comment_admin_alert"> '  . $args[0] . '</label>';

        echo $html;

    }

}