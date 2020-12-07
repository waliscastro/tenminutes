<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme Tameer for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */
/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Plugin:
 * require_once dirname( __FILE__ ) . '/path/to/class-tgm-plugin-activation.php';
 */
require_once get_template_directory() . '/tgm/class-tgm-plugin-activation.php';

add_action('tgmpa_register', 'sb_themes_register_required_plugins');

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function sb_themes_register_required_plugins() {
    // check if purchase code is there
    if (get_option('_sb_purchase_code') == "") {
        return;
    }
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        // This is an example of how to include a plugin bundled with a theme.
        array(
            'name' => esc_html__('WP Bakery Visual Composer', 'adforest'),
            'slug' => 'js_composer',
            'source' => get_template_directory() . '/required-plugins/js_composer.zip',
            'required' => false,
            'version' => '',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => '',
            'is_callable' => '',
        ),
        array(
            'name' => esc_html__('Elementor Website Builder', 'adforest'), // The plugin name.
            'slug' => 'elementor',
            'source' => '',
            'required' => false,
            'version' => '',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => esc_url('https://downloads.wordpress.org/plugin/elementor.3.0.13.zip'),
            'is_callable' => '',
        ),   

        array(
            'name' => esc_html__('Elementor - AdForest Adon', 'adforest'),
            'slug' => 'adforest-elementor',
            'source' => get_template_directory() . '/required-plugins/adforest-elementor.zip',
            'required' => false,
            'version' => '1.0.0',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => '',
            'is_callable' => '',
        ),
        array(
            'name' => esc_html__('SB Framework', 'adforest'),
            'slug' => 'sb_framework',
            'source' => get_template_directory() . '/required-plugins/sb_framework.zip',
            'required' => true,
            'version' => '3.4.1',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => '',
            'is_callable' => '',
        ),
        array(
            'name' => esc_html__('Woocommerce', 'adforest'), // The plugin name.
            'slug' => 'woocommerce',
            'source' => '',
            'required' => true,
            'version' => '',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => esc_url('https://downloads.wordpress.org/plugin/woocommerce.3.4.5.zip'),
            'is_callable' => '',
        ),
        array(
            'name' => esc_html__('One Click Demo Import', 'adforest'),
            'slug' => 'one-click-demo-import',
            'source' => '',
            'required' => true,
            'version' => '',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => esc_url('https://downloads.wordpress.org/plugin/one-click-demo-import.2.5.1.zip'),
            'is_callable' => '',
        ),
        array(
            'name' => esc_html__('Contact Form 7', 'adforest'),
            'slug' => 'contact-form-7',
            'source' => '',
            'required' => true,
            'version' => '',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => esc_url('https://downloads.wordpress.org/plugin/contact-form-7.5.0.2.zip'),
            'is_callable' => '',
        ),
        array(
            'name' => esc_html__('Image Watermark', 'adforest'),
            'slug' => 'image-watermark',
            'source' => '',
            'required' => false,
            'version' => '',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => esc_url('https://downloads.wordpress.org/plugin/image-watermark.zip'),
            'is_callable' => '',
        ),
        array(
            'name' => esc_html__('AddToAny Share Buttons', 'adforest'),
            'slug' => 'add-to-any',
            'source' => '',
            'required' => true,
            'version' => '',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => esc_url('https://downloads.wordpress.org/plugin/add-to-any.1.7.28.zip'),
            'is_callable' => '',
        ),
        array(
            'name' => esc_html__('SMS verification - Twillio', 'adforest'),
            'slug' => 'wp-twilio-core',
            'source' => '',
            'required' => true,
            'version' => '',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => esc_url('https://downloads.wordpress.org/plugin/wp-twilio-core.1.1.0.zip'),
            'is_callable' => '',
        ),
    );

    /*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
     */
    $config = array(
        'id' => 'adforest', // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '', // Default absolute path to bundled plugins.
        'menu' => 'tgmpa-install-plugins', // Menu slug.
        'has_notices' => true, // Show admin notices or not.
        'dismissable' => false, // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false, // Automatically activate plugins after installation or not.
        'message' => '', // Message to output right before the plugins table.
    );
    $tgm_disable_notification = false;
    if (class_exists('Redux')) {
        $tgm_disable_notification = Redux::getOption('adforest_theme', 'tgm_disable_notification');
        $tgm_disable_notification = isset($tgm_disable_notification) && !empty($tgm_disable_notification) ? $tgm_disable_notification : false;
    }
    if (!$tgm_disable_notification) {
        tgmpa($plugins, $config);
    }
}