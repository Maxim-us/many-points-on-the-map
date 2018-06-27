jQuery( document ).ready( function( $ ) {

	/*************
	* AJAX
	*/
	// create map
	$( '#mxmpotm_map_create' ).on( 'submit', function( e ) {

		e.preventDefault();

		var nonce = $( this ).find( '#mxmpotm_wpnonce' ).val();

		var mapName = $( '#mx_name_of_the_map' ).val();

		var mapDesc = $( '#mx_desc_of_the_map' ).val();

		var data = {

			'action': 'mxmpotm_add_map',
			'nonce': nonce,
			'mapName': mapName,
			'mapDesc': mapDesc

		};

		jQuery.post( ajaxurl, data, function( response ) {

			window.location.href = 'admin.php?page=mxmpotm-many-points-on-the-map';

			// console.log( response );

		} );

	} );

	// update map
	$( '#mxmpotm_map_update' ).on( 'submit', function( e ) {

		e.preventDefault();

		var nonce = $( this ).find( '#mxmpotm_wpnonce' ).val();

		var mapName = $( '#mx_name_of_the_map' ).val();

		var mapDesc = $( '#mx_desc_of_the_map' ).val();

		var mapId =  $( '#mx_map_id' ).val();

		var current_page_url = $( '#current_page_url' ).val();

		var data = {

			'action': 'mxmpotm_update_map',
			'nonce': nonce,
			'mapId': mapId,
			'mapName': mapName,
			'mapDesc': mapDesc

		};

		jQuery.post( ajaxurl, data, function( response ) {

			window.location.href = current_page_url;

			// console.log( response );

		} );

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
	
	var data_id_last_point = parseInt( pointBox.attr( 'data-id' ) );

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