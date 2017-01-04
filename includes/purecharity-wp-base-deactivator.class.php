<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://purecharity.com
 * @since      1.0.0
 *
 * @package    Purecharity_Wp_Base
 * @subpackage Purecharity_Wp_Base/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Purecharity_Wp_Base
 * @subpackage Purecharity_Wp_Base/includes
 * @author     Pure Charity <dev@purecharity.com>
 */
class Purecharity_Wp_Base_Deactivator {

    /**
     * Deactivates the Pure Base Plugin.
     *
     * Sets all the necessary settings for the plugin.
     *
     * @since    1.0.0
     */
    public static function deactivate() {
        require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        
        $current = get_option( 'active_plugins', [] );
        $deactivate = [];

        foreach ( $current as $v ) {
            if ( self::is_pure_plugin( $v ) ) {
                $deactivate[] = $v;
            }
        }
        
        deactivate_plugins( $deactivate, true );
    }

    public static function is_pure_plugin( $name ) {
        $plugins = [
            'purecharity-wp-trips.php',
            'purecharity-wp-donations.php',
            'purecharity-wp-fundraisers.php',
            'purecharity-wp-sponsorships.php',
            'purecharity-wp-givingcircles.php',
        ];

        foreach ( $plugins as $v ) {
            if ( strpos( $name, $v ) !== false ) {
                return true;
            }
        }
        return false;
    }

}
