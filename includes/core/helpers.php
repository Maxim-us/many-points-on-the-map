<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/*
* Require template for admin panel
*/
function mxmpotm_require_template_admin( $file ) {

	require_once MXMPOTM_PLUGIN_ABS_PATH . 'includes/admin/templates/' . $file;

}

/*
* Select data
*/
// select row by id
function mxmpotm_select_row( $id ) {

	global $wpdb;

	$table_name = $wpdb->prefix . MXMPOTM_TABLE_SLUG;

	$get_row_map = $wpdb->get_row( "SELECT map_name, map_desc, points, latitude_map_center, longitude_map_center, zoom_map_center, zoom_to_point, map_width, map_height, filter_regions FROM $table_name WHERE id = $id" );

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
	if( ! isset( $args['id'] ) ) return '<strong>Error in shortcode!</strong>';

	// save this id
	$id_map = intval( $args['id'] );
	
	// get result by id
	$result_map = mxmpotm_select_row( $id_map );

	// check if the map exists
	if( $result_map == NULL ) return '<strong>Error in shortcode!</strong>';

	// unserialize points
	$unserialize_points = maybe_unserialize( $result_map->points );	

	// create js object for display data
	return mxmpotm_create_object_points( $result_map, $unserialize_points );

}

add_shortcode( 'many_points_map', 'mxmpotm_show_many_points_map' );

/*
* components of map
*/
	// create js object
	function mxmpotm_create_object_points( $map, $points ) {

		// create html
		$html = '<div class="mx-map_desc">';

		$html .= '<h3>' . $map->map_name . '</h3>';

		$html .= '<p>' . $map->map_desc . '</p>';

		$html .= '</div>';

		$html .= '<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>';

		// get filter
		$html .= mxmpotm_filter_map( $map, $points  );

		$html .= '<div id="map" style="width: ' . $map->map_width . '; height: ' . $map->map_height . '"></div>';

		$html .= '<script> var points = [';

				foreach ( $points as $key => $value ) :
				
		    		$html .= '{"type": "Feature","id": ' . $value['point_id'] . ',';
			        
			        $html .= '"geometry": {"type": "Point","coordinates": [';

			        $html .= $value['point_latitude'] . ', ' . $value['point_longitude'] . '] },';

					$html .= '"mx_object": {"areas": ["' . implode( "\",\"", $value['areas'] ) . '"]},';

					$html .= '"options": {"iconLayout": "default#image"},';

					$html .= '"properties": {"balloonContent": `' . mxmpotm_show_content( $value['point_id'], $value['point_name'], $value['point_address'], $value['phone'], $value['web_site'], $value['areas'], $value['point_desc'], $value['point_additional'] ) . '`}},';

				endforeach;

			$html .= ']; </script>';

		$html .= mxmpotm_vars_for_translate( $map );

		// script for map
		$html .= '<script src="' . MXMPOTM_PLUGIN_URL . 'includes/frontend/assets/js/yandex-map-customize.js?v=' . MXMPOTM_PLUGIN_VERSION . '"></script>';

		return $html;

	}
	
	// create array of areas
	function mxmpotm_create_array_areas( $areasArray ) {

		$stringAreas = '';

		for( $i = 0; $i < count( $areasArray ); $i++ ) {

			if( $i == count( $areasArray ) - 1 ) {

				$stringAreas .= '"' . $areasArray[$i] . '"';

			} else {

				$stringAreas .= '"' . $areasArray[$i] . '",';

			}

		}

		return $stringAreas;

	}

	// show modal window on the map
	function mxmpotm_show_content( $id, $name, $adress, $phone, $website, $areas, $point_desc, $point_additional ) {

		$html = '<div id="mxmpotmModal' . $id .'">';

			$html .= '<h4>' . $name . '</h4>';

			if( $point_desc !== '' ) {

				$html .= '<p class="mxmpotm-point_desc">'. $point_desc . '</p>';

			}			

			$html .= '<p class="mxmpotm-point_adress"><strong>' . __( 'Address:', 'mxmpotm-map' ) . '</strong> ' . $adress . '</p>';

			if( $website !== '' ) {

				$html .= '<p class="mxmpotm-point_website"><strong>' . __( 'Web-site:', 'mxmpotm-map' ) . '</strong> <a href="' . $website . '" target="_blank">' . $website . '</a></p>';

			}

			if( $phone !== '' ) {

				$html .= '<p class="mxmpotm-point_phone"><strong>' . __( 'Phone:', 'mxmpotm-map' ) . '</strong> ' . $phone . '</p>';

			}			

			if( $point_additional !== '' ) {

				$html .= '<p class="mxmpotm-point_phone"><strong>' . __( 'Additional:', 'mxmpotm-map' ) . '</strong> ' . $point_additional . '</p>';

			}			

			if( count( $areas ) !== 0 ) {

				$html .= '<div class="mxmpotm-areas_wrap">';

					$html .= '<strong>' . __( 'Regions:', 'mxmpotm-map' ) . '</strong>';

						for( $i = 0; $i < count( $areas ); $i++ ) {
							
							$html .= '<p>' . $areas[$i] . '</p>';

						}

				$html .= '</div>';

			}			

		$html .= '</div>';

		return $html;

	}

	// fister
	function mxmpotm_filter_map( $map, $points  ) {		

		$html = '<div class="mxmpotm_map_filter_wrap">';

			// show filter by region
			if( $map->filter_regions == 1 ) {

				$html .= '<div class="mxmpotm_map_filter_type_select">';

					$html .= '<div class="mxmpotm_map_filter_type_select_point">';

						$html .= '<label for="mxmpotm_type_filter_point">' . __( 'All points:', 'mxmpotm-map' ) . '</label>';

						$html .= '<input type="radio" name="mxmpotm_type_filter" id="mxmpotm_type_filter_point" value="point" checked />';

					$html .= '</div>';

					$html .= '<div class="mxmpotm_map_filter_type_select_area">';
					
						$html .= '<label for="mxmpotm_type_filter_area">' . __( 'Regions:', 'mxmpotm-map' ) . '</label>';

						$html .= '<input type="radio" name="mxmpotm_type_filter" id="mxmpotm_type_filter_area" value="area" />';

					$html .= '</div>';						

				$html .= '</div>';

			}

			$html .= '<div class="mx-clearfix"></div>';
			
			$html .= '<div class="mxmpotm_map_filter_search_point">';
				
				$html .= '<label for="mxmpotm_map_search_point">' . __( 'Search points:', 'mxmpotm-map' ) . '</label>';

				$html .= '<select name="mxmpotm_map_search_point" id="mxmpotm_map_search_point">';

					$html .= '<option value="0" data-lat="' . $map->latitude_map_center . '" data-lng="' . $map->longitude_map_center . '" >' . __( 'All points', 'mxmpotm-map' ) . '</option>';
					
					foreach ( $points as $k => $v ) {

						$html .= '<option value="' . $v['point_id'] . '" data-lng="' . $v['point_longitude'] . '" data-lat="' . $v['point_latitude'] . '">' . $v['point_name'] . '</option>';

					}

				$html .= '</select>';

			$html .= '</div>';

			// show filter by region
			if( $map->filter_regions == 1 ) {

				$html .= '<div class="mxmpotm_map_filter_search_area" style="display: none">';

					$html .= '<label for="mxmpotm_map_search_area">' . __( 'Search region:', 'mxmpotm-map' ) . '</label>';

					$html .= '<select id="mxmpotm_map_search_area"></select>';

				$html .= '</div>';

			}			
			
		$html .= '</div>';

		return $html;

	}

	// vars for translate
	function mxmpotm_vars_for_translate( $map ) {

		$html = '<script>';

			$html .= 'var allAreasText = "' . __( 'All regions', 'mxmpotm-map' ) . '";';

			$html .= 'var centerMapLatDefault = parseFloat( ' . $map->latitude_map_center . ' );';

			$html .= 'var centerMapLngDefault = parseFloat( ' . $map->longitude_map_center . ' );';

			$html .= 'var zoomMapDefault = parseInt( ' . $map->zoom_map_center . ' );';

			$html .= 'var zoomToPointDefault = parseInt( ' . $map->zoom_to_point . ' );';

		$html .= '</script>';

		return $html;

	}