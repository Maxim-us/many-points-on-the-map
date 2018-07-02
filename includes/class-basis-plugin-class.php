<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;


class MXMPOTMBasisPluginClass
{

	private static $table_slug = MXMPOTM_TABLE_SLUG;

	public static function activate()
	{

		// set option for rewrite rules CPT
		self::create_option_for_activation();

		// Create table
		global $wpdb;

		// Table name
		$table_name = $wpdb->prefix . self::$table_slug;

		if ( $wpdb->get_var( "SHOW TABLES LIKE '" . $table_name . "'" ) !=  $table_name ) {

			$sql = "CREATE TABLE IF NOT EXISTS `$table_name`
			(
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`map_name` text NOT NULL,
				`map_desc` text DEFAULT '' NOT NULL,
				`points` longtext NOT NULL,
				`latitude_map_center` varchar(15) NOT NULL,
				`longitude_map_center` varchar(15) NOT NULL,
				`zoom_map_center` varchar(3) DEFAULT '10' NOT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=MyISAM DEFAULT CHARSET=$wpdb->charset AUTO_INCREMENT=1;";

			$wpdb->query( $sql );
		}

	}

	public static function deactivate()
	{

		// Rewrite rules
		flush_rewrite_rules();

	}

	/*
	* This function sets the option in the table for CPT rewrite rules
	*/
	public static function create_option_for_activation()
	{

		add_option( 'mxmpotm_flush_rewrite_rules', 'go_flush_rewrite_rules' );

	}

}