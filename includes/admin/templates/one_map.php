<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

$map_id = $_GET['map'];

// ger results
$map_rows = mxmpotm_select_row( $map_id );

// exit if the result is not found
if( $map_rows == NULL ) {

	wp_redirect( get_admin_url() . 'admin.php?page=mxmpotm-many-points-on-the-map' );

	die();

}

// get current page url
$current_page_url = get_admin_url() . 'admin.php?page=mxmpotm-many-points-on-the-map&map=' . $map_id;

?>

<h1><?php echo __( 'Edit map', 'mxmpotm_map' ); ?></h1>

	<form id="mxmpotm_map_update" class="mx-settings" method="post" action="">

		<div class="mx-block_wrap">

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

		</div>

		<!-- area of creating a new points  -->
		<br>
		<h2><?php echo __( 'Create new points on the map', 'mxmpotm_map' ); ?></h2>

		<div class="mx-block_wrap" id="mxmpotm_points_wrap">			

			<!-- point wrap -->
			<div class="mxmpotm_point_wrap">

				<div class="mx_number_of_point">
					<span class="mx_number_of_point_s">#</span>
					<span class="mx_number_of_point_n">1</span>
				</div>
			
				<button type="button" class="mx-open_point_box"><i class="fa fa-angle-down"></i></button>

				<button type="button" class="mx-add_point" title="<?php echo __( 'Add a new point', 'mxmpotm_map' ); ?>"><i class="fa fa-plus"></i></button>
					
				<div class="form-group">

					<input type="text" class="mx_new_point_name form-control" placeholder="Set point name" required />

					<textarea name="mx_new_point_desc" class="mx_new_point_desc form-control" placeholder="Describe the point"></textarea>

					<div>
						
						<input type="text" name="mx_new_point_latitude" class="mx_new_point_latitude form-control"  placeholder="Latitude" required />

						<input type="text" name="mx_new_point_longitude" class="mx_new_point_longitude form-control"  placeholder="Longitude" required />

					</div>

					<input type="text" name="mx_new_point_address" class="mx_new_point_address form-control"  placeholder="Address" required />					

					<textarea name="mx_new_point_additional" class="mx_new_point_additional form-control" placeholder="Additional information"></textarea>

					<!-- regions -->
					<div class="mxmpotm_point_area_wrap">

						<h6><?php echo __( 'Below you can add a list of regions that are related to this point.', 'mxmpotm_map' ); ?></h6>

						<div class="form-group">
							<input type="text" class="mx_new_point_region form-control" placeholder="Which region belongs to this point" /><button type="button" class="mx-add_region" title="<?php echo __( 'Add region', 'mxmpotm_map' ); ?>"><i class="fa fa-plus"></i></button>
							<div class="clearfix"></div>
						</div>
						
					</div>

				</div>

			</div>
			<!-- point wrap -->

		</div>
		<!-- end region block -->

		<div class="mx-block_wrap">

			<div class="form-group">

				<label for="mx_latitude_map_center">Latitude Map Center</label>
				<input type="text" name="mx_latitude_map_center" class="form-control" id="mx_latitude_map_center form-control" required />

			</div>

			<div class="form-group">
				
				<label for="mx_longitude_map_center">Longitude Map Center</label>
				<input type="text" name="mx_longitude_map_center" class="form-control" id="mx_longitude_map_center form-control" required />

			</div>			

			<p class="mx-submit_button_wrap">
				<input type="hidden" id="mxmpotm_wpnonce" name="mxmpotm_wpnonce" value="<?php echo wp_create_nonce( 'mxmpotm_nonce_request' ) ;?>" />
				<input class="button-primary" type="submit" name="mxmpotm-submit" value="Save" />
			</p>

		</div>

	</form>