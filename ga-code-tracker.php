<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.ggpoker.com
 * @since             1.0.0
 * @package           Ga_Code_Tracker
 *
 * @wordpress-plugin
 * Plugin Name:       Ga Code Tracker
 * Plugin URI:        https://www.ggpoker.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Arasus
 * Author URI:        https://www.ggpoker.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ga-code-tracker
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ga-code-tracker-activator.php
 */
function activate_ga_code_tracker() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ga-code-tracker-activator.php';
	Ga_Code_Tracker_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ga-code-tracker-deactivator.php
 */
function deactivate_ga_code_tracker() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ga-code-tracker-deactivator.php';
	Ga_Code_Tracker_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ga_code_tracker' );
register_deactivation_hook( __FILE__, 'deactivate_ga_code_tracker' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ga-code-tracker.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ga_code_tracker() {

	$plugin = new Ga_Code_Tracker();
	$plugin->run();

}
run_ga_code_tracker();
