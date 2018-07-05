<!-- point wrap -->
<div class="mxmpotm_point_wrap" data-id="1">

	<div class="mx_number_of_point">
		<span class="mx_number_of_point_s">#</span>
		<span class="mx_number_of_point_n">1</span>
	</div>

	<button type="button" class="mx-open_point_box"><i class="fa fa-angle-down"></i></button>

	<button type="button" class="mx-add_point" title="<?php echo __( 'Add a new point', 'mxmpotm-map' ); ?>"><i class="fa fa-plus"></i></button>

	<button type="button" class="mx-del_point" title="<?php echo __( 'Delete point', 'mxmpotm-map' ); ?>"><i class="fa fa-trash"></i></button>
		
	<div class="form-group">

		<input type="text" class="mx_new_point_name form-control mx-is_required" name="mx_new_point_name" placeholder="<?php echo __( 'Set point name', 'mxmpotm-map' ); ?> *" />

		<textarea name="mx_new_point_desc" class="mx_new_point_desc form-control" placeholder="<?php echo __( 'Describe the point', 'mxmpotm-map' ); ?>"></textarea>

		<div>
			
			<small class="form-text text-muted"><?php echo __( 'For example: 50.456608', 'mxmpotm-map' ); ?></small>
			<input type="text" name="mx_new_point_latitude" class="mx_new_point_latitude form-control mx-is_required mx-is_coordinates" placeholder="<?php echo __( 'Latitude', 'mxmpotm-map' ); ?> *" />
			

			<small class="form-text text-muted"><?php echo __( 'For example: 30.343306', 'mxmpotm-map' ); ?></small>
			<input type="text" name="mx_new_point_longitude" class="mx_new_point_longitude form-control mx-is_required mx-is_coordinates" placeholder="<?php echo __( 'Longitude', 'mxmpotm-map' ); ?> *" />
			

		</div>

		<input type="text" name="mx_new_point_address" class="mx_new_point_address form-control mx-is_required"  placeholder="<?php echo __( 'Address', 'mxmpotm-map' ); ?> *" />					

		<textarea name="mx_new_point_additional" class="mx_new_point_additional form-control" placeholder="<?php echo __( 'Additional information', 'mxmpotm-map' ); ?>"></textarea>

		<!-- regions -->
		<div class="mxmpotm_point_area_wrap">

			<h6><?php echo __( 'Below you can add a list of regions that are related to this point.', 'mxmpotm-map' ); ?></h6>

			<div class="form-group mxmpotm_point_area">
				<input type="text" class="mx_new_point_region form-control" placeholder="Which region belongs to this point" /><button type="button" class="mx-add_region" title="<?php echo __( 'Add region', 'mxmpotm-map' ); ?>"><i class="fa fa-plus"></i></button>
				<button type="button" class="mx-delete_region" title="<?php echo __( 'Delete region', 'mxmpotm-map' ); ?>"><i class="fa fa-trash"></i></button>
				<div class="clearfix"></div>
			</div>
			
		</div>

	</div>

</div>
<!-- point wrap -->
