<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * Dashboard. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://purecharity.com
 * @since             1.0.0
 * @package           Purecharity_Wp_Base
 *
 * @wordpress-plugin
 * Plugin Name:       Pure Charity Base
 * Plugin URI:        http://purecharity.com/
 * Description:       The base plugin for Pure Charity API integration
 * Version:           1.0.1
 * Author:            Pure Charity
 * Author URI:        http://purecharity.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       purecharity-wp-base
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/purecharity-wp-base-template-tags-helper.php';

/**
 * The code that runs during plugin activation.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/purecharity-wp-base-activator.class.php';

/**
 * The code that runs during plugin deactivation.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/purecharity-wp-base-deactivator.class.php';

/** 
 * This action is documented in includes/purecharity-wp-base-activator.class.php 
 */
register_activation_hook( __FILE__, array( 'Purecharity_Wp_Base_Activator', 'activate' ) );

/** 
 * This action is documented in includes/purecharity-wp-base-deactivator.class.php 
 */
register_deactivation_hook( __FILE__, array( 'Purecharity_Wp_Base_Deactivator', 'deactivate' ) );

/**
 * The core plugin class that is used to define internationalization,
 * dashboard-specific hooks, and public-facing site hooks.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/purecharity-wp-base.class.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_pure_base() {

	$plugin = new Purecharity_Wp_Base();
	$plugin->run();

}
run_pure_base();

/**
 * Word pluralizer helper for all the plugins.
 *
 * @since    1.0.0
 */
function pluralize($count, $singular, $plural = false)
{
  if (!$plural) $plural = $singular . 's';
  return ($count == 1 ? $singular : $plural) ;
}