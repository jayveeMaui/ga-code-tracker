<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.ggpoker.com
 * @since      1.0.0
 *
 * @package    Ga_Code_Tracker
 * @subpackage Ga_Code_Tracker/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Ga_Code_Tracker
 * @subpackage Ga_Code_Tracker/includes
 * @author     Arasus <jayvee.maoirat@arasus.com>
 */
class Ga_Code_Tracker_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;

		$table_name = $wpdb->prefix . "ga_code_tracker";
		$charset_collate = $wpdb->get_charset_collate();
		$sql = "CREATE TABLE $table_name (
				`id` MEDIUMINT NOT NULL AUTO_INCREMENT,
				`code` varchar(50) CHARACTER SET utf8 NOT NULL,
				`description` varchar(100) CHARACTER SET utf8 NOT NULL,
				PRIMARY KEY (`id`),
				CONSTRAINT ga_code_uq UNIQUE (`code`)
			  ) $charset_collate; ";
	
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta($sql);


	}

}
