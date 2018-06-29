jQuery( document ).ready( function( $ ) {

	/*************
	* AJAX
	*/
	// create map
	$( '#mxmpotm_map_create' ).on( 'submit', function( e ) {

		e.preventDefault();

		// action
		var action = 'mxmpotm_add_map';

		// get data and send it
		mxmpotm_ajax_data( $, $( this ), action );

	} );

	// update map
	$( '#mxmpotm_map_update' ).on( 'submit', function( e ) {

		e.preventDefault();

		// action
		var action = 'mxmpotm_update_map';

		// get data and send it
		mxmpotm_ajax_data( $, $( this ), action );

	} );

	/****************
	* point box
	*/
	// create a new box point
	var pointBox = $( '#mxmpotm_points_wrap_example' ).find( '.mxmpotm_point_wrap' );

	// create a new box area
	var arerBox = $( '#mxmpotm_points_wrap_example' ).find( '.mxmpotm_point_area' );

	// Add the first point if the block is empty
	if( $( '#mxmpotm_points_wrap' ).find( '.mxmpotm_point_wrap' ).length === 0 ) {

		$( pointBox ).clone().appendTo( '#mxmpotm_points_wrap' );

	}
	
	// event add points
	$( '#mxmpotm_points_wrap' ).on( 'click', '.mx-add_point', function() {

		var arrayFields = [];

		$( '#mxmpotm_points_wrap' ).find( '.mxmpotm_point_wrap' ).each( function() {

			arrayFields.push( $( this ).find( '.mx_new_point_name' ) );
			arrayFields.push( $( this ).find( '.mx_new_point_latitude' ) );
			arrayFields.push( $( this ).find( '.mx_new_point_longitude' ) );
			arrayFields.push( $( this ).find( '.mx_new_point_address' ) );

		} );

		setTimeout( function(){

			if( mxmpotm_check_empty_fields( $, arrayFields, $( '#mxmpotm_points_wrap' ) ) ) {

				// set the number of point
				mxmpotm_set_attr_for_poins( $, pointBox );	

				$( pointBox ).clone().appendTo( '#mxmpotm_points_wrap' );

			}

		},1000 );

	} );

	// delete point
	$( '#mxmpotm_points_wrap' ).on( 'click', '.mx-del_point', function() {

		if( confirm( confirmText ) ) {

			$( this ).parent().css( 'opacity', 0.4 );

			$( this ).parent().animate( { 'height': '15px' }, 500, function() {

				$( this ).remove();

			} );

		}		

	} );	

	// open box
	$( '#mxmpotm_points_wrap' ).on( 'click', '.mx-open_point_box', function( e ) {

		e.preventDefault();

		if( $( this ).parent().hasClass( 'mxmpotm_point_wrap_open' ) ) {

			$( this ).parent().animate( { 'height': '50px' }, 500, function(){

				$( this ).removeClass( 'mxmpotm_point_wrap_open' );

				$( this ).attr( 'style', '' );

			} );			

		} else {

			$( this ).parent().animate( { 'height': '200px' }, 500, function(){

				$( this ).addClass( 'mxmpotm_point_wrap_open' );

				$( this ).css( 'height', 'auto' );

			} );

		}		

	} );

	// focus input name of the point
	$( '#mxmpotm_points_wrap' ).on( 'focus', '.mx_new_point_name', function() {

		if( !$( this ).parent().parent().hasClass( 'mxmpotm_point_wrap_open' ) ) {

			$( this ).parent().parent().animate( { 'height': '200px' }, 500, function(){

				$( this ).addClass( 'mxmpotm_point_wrap_open' );

				$( this ).css( 'height', 'auto' );

			} );

		}

	} );

	/***************
	* Areas
	*/
	// event add ares
	$( '#mxmpotm_points_wrap' ).on( 'click', '.mx-add_region', function() {

		var areaParent = $( this ).parent().parent();

		// check empty region inputs
		if( mxmpotm_check_empty_areas( $, areaParent ) ) {

			$( arerBox ).clone().appendTo( areaParent );

		}

	} );

	// event delete region
	$( '#mxmpotm_points_wrap' ).on( 'click', '.mx-delete_region', function() {

		$( this ).parent().remove();

	} );

} );

/*
* functions
*/
// get data from the form
function mxmpotm_ajax_data( $, _this, action ) {

	// data vars
	var id_map = null;

	var id_map_val = $( '#mx_map_id' ).val();

	if( id_map_val.length !== 0 ) {

		id_map = parseInt( id_map_val );

	}

	var nonce 				= _this.find( '#mxmpotm_wpnonce' ).val();

	var mapName 			= $( '#mx_name_of_the_map' ).val();

	var mapDesc 			= $( '#mx_desc_of_the_map' ).val();

	var latitude_center		= $( '#mx_latitude_map_center' ).val();

	var longitude_center 	= $( '#mx_longitude_map_center' ).val();

	var zoom_map_center 	= 10;

	var obj_points 	= {};

	// get data of points
	var obj_point_tmp = {};

	var array_point_areas_tmp = [];

	$( '#mxmpotm_points_wrap' ).find( '.mxmpotm_point_wrap' ).each( function(  index, element ) {

		// push id into tmp obj
		obj_point_tmp['point_id'] = parseInt( $( this ).attr( 'data-id' ) );

		// push name into tmp obj
		obj_point_tmp['point_name'] = $( this ).find( '.mx_new_point_name' ).val();

		// push desc into tmp obj
		obj_point_tmp['point_desc'] = $( this ).find( '.mx_new_point_desc' ).val();

		// push latitude into tmp obj
		obj_point_tmp['point_latitude'] = $( this ).find( '.mx_new_point_latitude' ).val();

		// push longitude into tmp obj
		obj_point_tmp['point_longitude'] = $( this ).find( '.mx_new_point_longitude' ).val();

		// push address into tmp obj
		obj_point_tmp['point_address'] = $( this ).find( '.mx_new_point_address' ).val();

		// push additional into tmp obj
		obj_point_tmp['point_additional'] = $( this ).find( '.mx_new_point_additional' ).val();

		// areas
		$( this ).find( '.mxmpotm_point_area_wrap' ).find( '.mx_new_point_region' ).each( function() {

			if( $( this ).val().length !== 0 ) {

				array_point_areas_tmp.push( $( this ).val() );

			}			

		} );

		obj_point_tmp['areas'] = array_point_areas_tmp;

		// --- push into main obj ---
		obj_points[index] = obj_point_tmp;

		// clean tmp obj
		obj_point_tmp = {};

		// clean tmp array
		array_point_areas_tmp = [];		

	} );

	// set data
	setTimeout( function() {

		var data = {

			'action'			: 	action,
			'nonce'				: 	nonce,
			'id_map'			: 	id_map,
			'mapName'			: 	mapName,
			'mapDesc'			: 	mapDesc,
			'latitude_center'	: 	latitude_center,
			'longitude_center'	: 	longitude_center,
			'obj_points' 		: 	obj_points,
			'zoom_map_center'	: 	zoom_map_center

		};

		jQuery.post( ajaxurl, data, function( response ) {

			window.location.href = 'admin.php?page=mxmpotm-many-points-on-the-map-edit&map=' + id_map;

			// console.log( response );

		} );

	},1000 );

}

// check empty fields
function mxmpotm_check_empty_fields( $, arrayFields, boxPoints ) {

	var _return = true;

	$.each( arrayFields, function( index, element ){

		if( element.val().length === 0 ) {

			element.addClass( 'is-invalid' );

			boxPoints.addClass( 'is-invalid' );

			_return = false;

			return false;

		} else {

			element.removeClass( 'is-invalid' );

			boxPoints.removeClass( 'is-invalid' );

			_return = true;

		}

	} );

	return _return;

}

// set attr for points
function mxmpotm_set_attr_for_poins( $, pointBox ) {
	
	var data_id_last_point = parseInt( $( '#mxmpotm_points_wrap' ).find( '.mxmpotm_point_wrap' ).last().attr( 'data-id' ) );

	data_id_last_point++;

	// set number
	pointBox.find( '.mx_number_of_point_n' ).text( data_id_last_point );

	// set data
	pointBox.attr( 'data-id', data_id_last_point );

}

// check empty areas
function mxmpotm_check_empty_areas( $, areaParent ) {

	var _return = true;

	var inputs = areaParent.find( '.mx_new_point_region' );

	inputs.each( function() {

		if( $( this ).val().length === 0 ) {

			$( this ).addClass( 'is-invalid' );

			_return = false;

			return false;

		} else {

			$( this ).removeClass( 'is-invalid' );

			_return = true;

		}

	} );

	return _return;

}

// check empty fields by class name
function mxmpotm_check_empty_fields_by_class_name() {
	// ...
}