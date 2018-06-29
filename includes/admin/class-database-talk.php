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

			// Add map
			$this->add_new_map( $_POST['mapName'], $_POST['mapDesc'], $_POST['obj_points'], $_POST['latitude_center'], $_POST['longitude_center'], $_POST['zoom_map_center'] );

		}

		wp_die();

	}

		// Add data
		public function add_new_map( $map_name, $map_desc, $obj_points, $latitude_center, $longitude_center, int $zoom_map_center )
		{

			// name of the map
			$map_name = esc_html( $map_name );

			// desc of the map
			$map_desc = esc_html( $map_desc );

			// points
			$obj_points = serialize( $obj_points );

			// latitude of the map
			$latitude_center = esc_html( $latitude_center );

			// latitude of the map
			$longitude_center = esc_html( $longitude_center );

			// zoom of the map
			$zoom_map_center = esc_html( $zoom_map_center );

			global $wpdb;

			$table_name = $wpdb->prefix . MXMPOTM_TABLE_SLUG;

			$wpdb->insert( 
				$table_name, 
				array( 
					'map_name' 				=> $map_name,
					'map_desc' 				=> $map_desc,
					'points'				=> $obj_points,
					'latitude_map_center' 	=> $latitude_center,
					'longitude_map_center'	=> $longitude_center,
					'zoom_map_center'		=> $zoom_map_center
				), 
				array( 
					'%s', 
					'%s',
					'%s',
					'%s',
					'%s',
					'%d'
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

			// Update map
			$this->update_map( $_POST['id_map'], $_POST['mapName'], $_POST['mapDesc'], $_POST['obj_points'], $_POST['latitude_center'], $_POST['longitude_center'], $_POST['zoom_map_center'] );	

		}

		wp_die();

	}

		// Update map
		public function update_map( int $id_map, $map_name, $map_desc, $obj_points, $latitude_center, $longitude_center, int $zoom_map_center  )
		{

			// name of the map
			$map_name = esc_html( $map_name );

			// desc of the map
			$map_desc = esc_html( $map_desc );

			// points
			$obj_points = serialize( $obj_points );

			// latitude of the map
			$latitude_center = esc_html( $latitude_center );

			// latitude of the map
			$longitude_center = esc_html( $longitude_center );

			// zoom of the map
			$zoom_map_center = esc_html( $zoom_map_center );

			global $wpdb;

			$table_name = $wpdb->prefix . MXMPOTM_TABLE_SLUG;

			$wpdb->update( 
				$table_name, 
				array( 
					'map_name' 				=> $map_name,
					'map_desc' 				=> $map_desc,
					'points'				=> $obj_points,
					'latitude_map_center' 	=> $latitude_center,
					'longitude_map_center'	=> $longitude_center,
					'zoom_map_center'		=> $zoom_map_center
				), 
				array( 'id' => $id_map ),
				array( 
					'%s', 
					'%s',
					'%s',
					'%s',
					'%s',
					'%d'
				) 
			);

		}

}

// New instance
new MXMPOTMDataBaseTalk();