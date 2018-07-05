<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

?>

<h1 class="text-secondary"><?php echo __( 'Create a new map', 'mxmpotm-map' ); ?></h1>

<form id="mxmpotm_map_create" class="mx-settings" method="post" action="">

	<div class="mx-block_wrap">

		<input type="hidden" id="mx_map_id" name="mx_map_id" value="" />

		<input type="hidden" id="current_page_url" name="current_page_url" value="" />

		<div class="form-group">
			<label for="mx_name_of_the_map"><?php echo __( 'The name of the map', 'mxmpotm-map' ); ?> <span class="text-danger">*</span></label>
			<input type="text" class="form-control" id="mx_name_of_the_map" name="mx_name_of_the_map" value="" required />	
		</div>

		<div class="form-group">
			<label for="mx_desc_of_the_map"><?php echo __( 'Map description', 'mxmpotm-map' ); ?></label>
			<textarea name="mx_desc_of_the_map" id="mx_desc_of_the_map"></textarea>
		</div>			

	</div>

	<!-- area of creating a new points  -->
	<br>
	<h2 class="text-secondary"><?php echo __( 'Create new points on the map', 'mxmpotm-map' ); ?></h2>

	<!-- Working block -->
	<div class="mx-block_wrap" id="mxmpotm_points_wrap"></div>

	<!-- This block is an example block structure. For JS -->
	<div class="mx-block_wrap" id="mxmpotm_points_wrap_example" style="display: none;">
		<?php include( 'components/add_point_for_js.php' ); ?>
	</div>
	<!-- end JS block -->

	<div class="mx-block_wrap">

		<div class="form-group">

			<label for="mx_latitude_map_center"><?php echo __( 'Latitude Map Center', 'mxmpotm-map' ); ?> <span class="text-danger">*</span></label>
			<input type="text" name="mx_latitude_map_center form-control" class="form-control" id="mx_latitude_map_center" required />

		</div>

		<div class="form-group">
			
			<label for="mx_longitude_map_center"><?php echo __( 'Longitude Map Center', 'mxmpotm-map' ); ?> <span class="text-danger">*</span></label>
			<input type="text" name="mx_longitude_map_center" class="form-control form-control" id="mx_longitude_map_center" required />

		</div>			

		<p class="mx-submit_button_wrap">
			<input type="hidden" id="mxmpotm_wpnonce" name="mxmpotm_wpnonce" value="<?php echo wp_create_nonce( 'mxmpotm_nonce_request' ) ;?>" />
			<input class="button-primary" type="submit" name="mxmpotm-submit" value="<?php echo __( 'Create map', 'mxmpotm-map' ); ?>" />
		</p>

	</div>

</form>

<!-- Variables for javascript with translation functions -->
<?php include( 'components/js_vars.php' ); ?>