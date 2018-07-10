<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.ggpoker.com
 * @since      1.0.0
 *
 * @package    Ga_Code_Tracker
 * @subpackage Ga_Code_Tracker/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Ga_Code_Tracker
 * @subpackage Ga_Code_Tracker/public
 * @author     Arasus <jayvee.maoirat@arasus.com>
 */
class Ga_Code_Tracker_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}


	/**
	 * This function will handle the event when a download button is click
	 *
	 */

	public function init_ga_code_tracker(){
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/ga-code-tracker-public-display.php';
	}
}
