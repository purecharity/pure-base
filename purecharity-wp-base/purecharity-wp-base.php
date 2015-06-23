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
 * Version:           1.0.7
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
 * The GitHub updater.
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/purecharity-wp-base-updater.class.php';

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

/*
 * Plugin updater using GitHub
 *
 * Auto Updates through GitHub
 *
 * @since   1.0.3
 */
add_action( 'init', 'purecharity_wp_base_updater' );
function purecharity_wp_base_updater() {
  define( 'WP_GITHUB_FORCE_UPDATE', true );
  if ( is_admin() ) { // note the use of is_admin() to double check that this is happening in the admin
    $config = array(
      'slug' => plugin_basename( __FILE__ ),
      'proper_folder_name' => 'purecharity-wp-base',
      'api_url' => 'https://api.github.com/repos/purecharity/pure-base',
      'raw_url' => 'https://raw.githubusercontent.com/purecharity/pure-base/master/purecharity-wp-base/',
      'github_url' => 'https://github.com/purecharity/pure-base',
      'zip_url' => 'https://github.com/purecharity/pure-base/archive/master.zip',
      'sslverify' => true,
      'requires' => '3.0',
      'tested' => '3.3',
      'readme' => 'README.md',
      'access_token' => '',
    );
    new WP_GitHub_Updater( $config );
  }
}