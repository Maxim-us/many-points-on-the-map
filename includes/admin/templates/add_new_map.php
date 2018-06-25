<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

?>

<h1><?php echo __( 'Create a new map', 'mxmpotm_map' ); ?></h1>

<div class="mx-block_wrap">

	<form id="mxmpotm_map_create" class="mx-settings" method="post" action="">

		<div class="form-group">
			<label for="mx_name_of_the_map"><?php echo __( 'The name of the map', 'mxmpotm_map' ); ?></label>
			<input type="text" class="form-control" id="mx_name_of_the_map" name="mx_name_of_the_map" />	
		</div>

		<div class="form-group">
			<label for="mx_desc_of_the_map"><?php echo __( 'Map description', 'mxmpotm_map' ); ?></label>
			<textarea name="mx_desc_of_the_map" id="mx_desc_of_the_map"><?php //echo mxmpotm_select_row( $id ); ?></textarea>
		</div>		

		<p class="mx-submit_button_wrap">
			<input type="hidden" id="mxmpotm_wpnonce" name="mxmpotm_wpnonce" value="<?php echo wp_create_nonce( 'mxmpotm_nonce_request' ) ;?>" />
			<input class="button-primary" type="submit" name="mxmpotm-submit" value="Save" />
		</p>

	</form>

</div>