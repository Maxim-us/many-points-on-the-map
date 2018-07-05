<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/*
* Require template for admin panel
*/
function mxmpotm_require_template_admin( $file ) {

	require_once MXMPOTM_PLUGIN_ABS_PATH . 'includes\admin\templates\\' . $file;

}

/*
* Select data
*/
// select row by id
function mxmpotm_select_row( $id ) {

	global $wpdb;

	$table_name = $wpdb->prefix . MXMPOTM_TABLE_SLUG;

	$get_row_map = $wpdb->get_row( "SELECT map_name, map_desc, points, latitude_map_center, longitude_map_center, zoom_map_center FROM $table_name WHERE id = $id" );

	return $get_row_map;

}

// select rows
function mxmpotm_select_rows() {

	global $wpdb;

	$table_name = $wpdb->prefix . MXMPOTM_TABLE_SLUG;

	$get_all_rows_map = $wpdb->get_results( "SELECT id, map_name, map_desc, points FROM $table_name ORDER BY id DESC" );

	return $get_all_rows_map;

}

/*
* Shortcodes
*/
function mxmpotm_show_many_points_map( $args ) {

	// if isset id of the map
	if( ! isset( $args['id'] ) ) return;

	// save this id
	$id_map = $args['id'];
	
	// get result by id
	$result_map = mxmpotm_select_row( $id_map );

	// unserialize points
	$unserialize_points = maybe_unserialize( $result_map->points );

	var_dump( $unserialize_points );

	// create js object for display data
	return mxmpotm_create_js_object_points( $unserialize_points );

	


	

}

add_shortcode( 'many_points_map', 'mxmpotm_show_many_points_map' );

// create js object
function mxmpotm_create_js_object_points( $points ) {	

	// create html
	$html = 'sss<script>
		var points = [';

			foreach ( $points as $key => $value ) :
			
	    		$html .='{
	    			"type": "Feature",
		        	"id": ' . $value['point_id'] . ',
		        	"geometry": {
		        		"type": "Point",
		        		"coordinates": [
		        			"' . $value['point_latitude'] . '",
							"' . $value['point_longitude'] . '"
						]
					},

					"mx_object": {
						"areas": ["' .
							implode( "\",\"", $value['areas'] )
						. '"]
					},

					"options": {
						"iconLayout": "default#image"
					},

					"properties": {
						"balloonContent": `
							<div id="mxmpotmModal1">
								<h4>' . $value['point_name'] . '</h4>
								
								<p class="mxmpotm-map_adress"><strong>' . __( 'Address:', 'mxmpotm-map' ) . '</strong> 
									' . $value['point_address'] . '
								</p>

								<div class="mxmpotm-areas_wrap">

									<strong>Районы:</strong>
														
									<p>Матушкино</p>
													
									<p>Савелки</p>
										
								</div>

							</div>
						`
					}
				},';

			endforeach;

		$html .= '];

	</script>';

	return $html;

}