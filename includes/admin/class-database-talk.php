<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class MXMPOTMDataBaseTalk
{

	/*
	* MXMPOTMDataBaseTalk constructor
	*/
	public function __construct()
	{

		$this->mxmpotm_observe_update_data();

	}

	/*
	* Observe function
	*/
	public function mxmpotm_observe_update_data()
	{

		// create map
		add_action( 'wp_ajax_mxmpotm_add_map', array( $this, 'prepare_add_map' ) );

		// update map
		add_action( 'wp_ajax_mxmpotm_update_map', array( $this, 'prepare_update_map' ) );

	}

	/*
	* Prepare to map create
	*/
	public function prepare_add_map()
	{
		
		// Checked POST nonce is not empty
		if( empty( $_POST['nonce'] ) ) wp_die( '0' );

		// Checked or nonce match
		if( wp_verify_nonce( $_POST['nonce'], 'mxmpotm_nonce_request' ) ){

			// Update data
			$this->add_new_map( $_POST['mapName'], $_POST['mapDesc'] );		

		}

		wp_die();

	}

		// Add data
		public function add_new_map( $map_name, $map_desc )
		{

			// name of the map
			$map_name = esc_html( $map_name );

			// desc of the map
			$map_desc = esc_html( $map_desc );

			global $wpdb;

			$table_name = $wpdb->prefix . MXMPOTM_TABLE_SLUG;

			$wpdb->insert( 
				$table_name, 
				array( 
					'map_name' => $map_name,
					'map_desc' => $map_desc
				), 
				array( 
					'%s', 
					'%s' 
				) 
			);

		}

	/*
	* Prepare to map update
	*/
	public function prepare_update_map()
	{
		
		// Checked POST nonce is not empty
		if( empty( $_POST['nonce'] ) ) wp_die( '0' );

		// Checked or nonce match
		if( wp_verify_nonce( $_POST['nonce'], 'mxmpotm_nonce_request' ) ){

			// Update data
			$this->update_map( $_POST['mapId'], $_POST['mapName'], $_POST['mapDesc'] );		

		}

		wp_die();

	}

		// Update map
		public function update_map( int $id, $map_name, $map_desc )
		{

			// name of the map
			$map_name = esc_html( $map_name );

			// desc of the map
			$map_desc = esc_html( $map_desc );

			global $wpdb;

			$table_name = $wpdb->prefix . MXMPOTM_TABLE_SLUG;

			$wpdb->update(
				$table_name, 
				array(
					'map_name' => $map_name,
					'map_desc' => $map_desc
				), 
				array( 'id' => $id ), 
				array( 
					'%s',
					'%s'
				)
			);

		}

}

// New instance
new MXMPOTMDataBaseTalk();