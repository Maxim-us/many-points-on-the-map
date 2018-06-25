jQuery( document ).ready( function( $ ){

	// create map
	$( '#mxmpotm_map_create' ).on( 'submit', function( e ){

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

		jQuery.post( ajaxurl, data, function( response ){

			window.location.href = 'admin.php?page=mxmpotm-many-points-on-the-map';

			// console.log( response );

		} );

	} );

	// update map
	$( '#mxmpotm_map_update' ).on( 'submit', function( e ){

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

		jQuery.post( ajaxurl, data, function( response ){

			window.location.href = current_page_url;

			// console.log( response );

		} );

	} );

} );