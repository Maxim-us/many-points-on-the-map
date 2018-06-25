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

	$get_row_map = $wpdb->get_row( "SELECT map_name, map_desc, points FROM $table_name WHERE id = $id" );

	return $get_row_map;

}

// select rows
function mxmpotm_select_rows() {

	global $wpdb;

	$table_name = $wpdb->prefix . MXMPOTM_TABLE_SLUG;

	$get_all_rows_map = $wpdb->get_results( "SELECT id, map_name, map_desc, points FROM $table_name ORDER BY id DESC" );

	return $get_all_rows_map;

}