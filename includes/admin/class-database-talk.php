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

		// delete map
		add_action( 'wp_ajax_mxmpotm_del_map', array( $this, 'prepare_del_map' ) );

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
			$this->add_new_map( $_POST['mapName'], $_POST['mapDesc'], $_POST['obj_points'], $_POST['latitude_center'], $_POST['longitude_center'], $_POST['zoom_map_center'], $_POST['zoom_map_to_point'], $_POST['map_width'], $_POST['map_height'] );

		}

		wp_die();

	}

		// Add data
		public function add_new_map( $map_name, $map_desc, $obj_points, $latitude_center, $longitude_center, $zoom_map_center, $zoom_map_to_point, $map_width, $map_height )
		{

			// name of the map
			$map_name = sanitize_text_field( $map_name );

			// desc of the map
			$map_desc = sanitize_text_field( $map_desc );

			// points
			$sanitize_points = array();

			foreach( $obj_points as $key => $value ) {

				$tmp_array = array();

				// point_id
				$point_id = intval( $value['point_id'] );

					$tmp_array['point_id'] = $point_id;

				// point_name
				$point_name = sanitize_text_field( $value['point_name'] );

					$tmp_array['point_name'] = $point_name;

				// point_desc
				$point_desc = sanitize_text_field( $value['point_desc'] );

					$tmp_array['point_desc'] = $point_desc;

				// point_latitude
				$point_latitude = sanitize_text_field( $value['point_latitude'] );

					$tmp_array['point_latitude'] = $point_latitude;

				// point_longitude
				$point_longitude = sanitize_text_field( $value['point_longitude'] );

					$tmp_array['point_longitude'] = $point_longitude;

				// point_address
				$point_address = sanitize_text_field( $value['point_address'] );

					$tmp_array['point_address'] = $point_address;

				// point_additional
				$point_additional = sanitize_text_field( $value['point_additional'] );

					$tmp_array['point_additional'] = $point_additional;

				// web_site
				$web_site = sanitize_text_field( $value['web_site'] );

					$tmp_array['web_site'] = $web_site;

				// phone
				$phone = sanitize_text_field( $value['phone'] );

					$tmp_array['phone'] = $phone;

					// areas
					$tmp_all_areas = array();

					foreach ( $value['areas'] as $key => $value ) {
						
						// point_desc
						$area = sanitize_text_field( $value );

							$push_area = array_push( $tmp_all_areas, $area );

					}

					$tmp_array['areas'] = $tmp_all_areas;

					$push_to_main_array = array_push( $sanitize_points, $tmp_array );

			}

			$obj_points = serialize( $sanitize_points );

			// latitude of the map
			$latitude_center = sanitize_text_field( $latitude_center );

			// latitude of the map
			$longitude_center = sanitize_text_field( $longitude_center );

			// zoom of the map
			$zoom_map_center = sanitize_text_field( $zoom_map_center );

			// zoom to the point
			$zoom_map_to_point = sanitize_text_field( $zoom_map_to_point );

			// map size
			$map_width = sanitize_text_field( $map_width );

			$map_height = sanitize_text_field( $map_height );

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
					'zoom_map_center'		=> $zoom_map_center,
					'zoom_to_point'			=> $zoom_map_to_point,
					'map_width'				=> $map_width,
					'map_height'			=> $map_height
				), 
				array( 
					'%s', 
					'%s',
					'%s',
					'%s',
					'%s',
					'%d',
					'%d',
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

			// Update map
			$this->update_map( $_POST['id_map'], $_POST['mapName'], $_POST['mapDesc'], $_POST['obj_points'], $_POST['latitude_center'], $_POST['longitude_center'], $_POST['zoom_map_center'], $_POST['zoom_map_to_point'], $_POST['map_width'], $_POST['map_height'], $_POST['filter_regions'] );

		}

		wp_die();

	}

		// Update map
		public function update_map( $id_map, $map_name, $map_desc, $obj_points, $latitude_center, $longitude_center, $zoom_map_center, $zoom_map_to_point, $map_width, $map_height, $filter_regions )
		{

			// name of the map
			$map_name = sanitize_text_field( $map_name );

			// desc of the map
			$map_desc = sanitize_text_field( $map_desc );

			// points
			$sanitize_points = array();

			foreach( $obj_points as $key => $value ) {

				$tmp_array = array();

				// point_id
				$point_id = intval( $value['point_id'] );

					$tmp_array['point_id'] = $point_id;

				// point_name
				$point_name = sanitize_text_field( $value['point_name'] );

					$tmp_array['point_name'] = $point_name;

				// point_desc
				$point_desc = sanitize_text_field( $value['point_desc'] );

					$tmp_array['point_desc'] = $point_desc;

				// point_latitude
				$point_latitude = sanitize_text_field( $value['point_latitude'] );

					$tmp_array['point_latitude'] = $point_latitude;

				// point_longitude
				$point_longitude = sanitize_text_field( $value['point_longitude'] );

					$tmp_array['point_longitude'] = $point_longitude;

				// point_address
				$point_address = sanitize_text_field( $value['point_address'] );

					$tmp_array['point_address'] = $point_address;

				// point_additional
				$point_additional = sanitize_text_field( $value['point_additional'] );

					$tmp_array['point_additional'] = $point_additional;

				// web_site
				$web_site = sanitize_text_field( $value['web_site'] );

					$tmp_array['web_site'] = $web_site;

				// phone
				$phone = sanitize_text_field( $value['phone'] );

					$tmp_array['phone'] = $phone;

					// areas
					$tmp_all_areas = array();

					foreach ( $value['areas'] as $key => $value ) {
						
						// point_desc
						$area = sanitize_text_field( $value );

							$push_area = array_push( $tmp_all_areas, $area );

					}

					$tmp_array['areas'] = $tmp_all_areas;

					$push_to_main_array = array_push( $sanitize_points, $tmp_array );

			}

			$obj_points = serialize( $sanitize_points );

			// latitude of the map
			$latitude_center = sanitize_text_field( $latitude_center );

			// latitude of the map
			$longitude_center = sanitize_text_field( $longitude_center );

			// zoom of the map
			$zoom_map_center = sanitize_text_field( $zoom_map_center );

			// zoom to the point
			$zoom_map_to_point = sanitize_text_field( $zoom_map_to_point );

			// map size
			$map_width = sanitize_text_field( $map_width );

			$map_height = sanitize_text_field( $map_height );

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
					'zoom_map_center'		=> $zoom_map_center,
					'zoom_to_point'			=> $zoom_map_to_point,
					'map_width'				=> $map_width,
					'map_height'			=> $map_height,
					'filter_regions' 		=> $filter_regions
				), 
				array( 'id' => $id_map ),
				array( 
					'%s', 
					'%s',
					'%s',
					'%s',
					'%s',
					'%d',
					'%d',
					'%s',
					'%s',
					'%d'
				) 
			);

		}

	/*
	* Prepare to map delete
	*/
	public function prepare_del_map()
	{

		// Checked POST nonce is not empty
		if( empty( $_POST['nonce'] ) ) wp_die( '0' );

		// Checked or nonce match
		if( wp_verify_nonce( $_POST['nonce'], 'mxmpotm_nonce_request' ) ){

			// Delete map
			$this->delete_map( $_POST['id_map'] );	

		}

		wp_die();

	}

		// delete map
		public function delete_map( $id_map )
		{

			global $wpdb;

			$table_name = $wpdb->prefix . MXMPOTM_TABLE_SLUG;

			$wpdb->delete(

				$table_name,
				array( 'id' => $id_map ),
				array( '%d' )

			);

		}

}

// New instance
new MXMPOTMDataBaseTalk();