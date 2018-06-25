<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

$map_id = $_GET['map'];

// ger results
$map_rows = mxmpotm_select_row( $map_id );

// get current page url
$current_page_url = get_admin_url() . 'admin.php?page=mxmpotm-many-points-on-the-map&map=' . $map_id;

?>

<h1><?php echo __( 'Edit map', 'mxmpotm_map' ); ?></h1>

<div class="mx-block_wrap">

	<form id="mxmpotm_map_update" class="mx-settings" method="post" action="">

		<input type="hidden" id="mx_map_id" name="mx_map_id" value="<?php echo $map_id; ?>" />

		<input type="hidden" id="current_page_url" name="current_page_url" value="<?php echo $current_page_url; ?>" />

		<div class="form-group">
			<label for="mx_name_of_the_map"><?php echo __( 'The name of the map', 'mxmpotm_map' ); ?></label>
			<input type="text" class="form-control" id="mx_name_of_the_map" name="mx_name_of_the_map" value="<?php echo $map_rows->map_name; ?>" />	
		</div>

		<div class="form-group">
			<label for="mx_desc_of_the_map"><?php echo __( 'Map description', 'mxmpotm_map' ); ?></label>
			<textarea name="mx_desc_of_the_map" id="mx_desc_of_the_map"><?php echo $map_rows->map_desc; ?></textarea>
		</div>		

		<p class="mx-submit_button_wrap">
			<input type="hidden" id="mxmpotm_wpnonce" name="mxmpotm_wpnonce" value="<?php echo wp_create_nonce( 'mxmpotm_nonce_request' ) ;?>" />
			<input class="button-primary" type="submit" name="mxmpotm-submit" value="Save" />
		</p>

	</form>

</div>