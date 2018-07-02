<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.ggpoker.com
 * @since      1.0.0
 *
 * @package    Ga_Code_Tracker
 * @subpackage Ga_Code_Tracker/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ga_Code_Tracker
 * @subpackage Ga_Code_Tracker/admin
 * @author     Arasus <jayvee.maoirat@arasus.com>
 */
class Ga_Code_Tracker_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ga_Code_Tracker_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ga_Code_Tracker_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ga-code-tracker-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ga_Code_Tracker_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ga_Code_Tracker_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ga-code-tracker-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register partial pages for admin level
	 * 
	 * @since 1.0.0
	 */
	public function init_ga_code_tracker() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/ga-code-tracker-admin-display.php';

		//this is the main item for the menu
		add_menu_page('GA Codes', //page title
		'GA Codes', //menu title
		'manage_options', //capabilities
		'ga_code_tracker_list', //menu slug
		'ga_code_tracker_list' //function
		);
		
		//this is a submenu
		add_submenu_page('ga_code_tracker_list', //parent slug
		'Add New Code', //page title
		'Add New', //menu title
		'manage_options', //capability
		'ga_code_tracker_create', //menu slug
		'ga_code_tracker_create'); //function
		
		//this submenu is HIDDEN, however, we need to add it anyways
		add_submenu_page(null, //parent slug
		'Update Code', //page title
		'Update', //menu title
		'manage_options', //capability
		'ga_code_tracker_update', //menu slug
		'ga_code_tracker_update'); //function		
	}

}
