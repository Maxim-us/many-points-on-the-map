<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

?>

<h1><?php echo __( 'All maps', 'mxmpotm_map' ); ?></h1>

<table class="table table-striped">
	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">
				<?php echo __( 'Name', 'mxmpotm_map' ); ?>
				
				</th>
			<th scope="col"><?php echo __( 'Shortcode', 'mxmpotm_map' ); ?></th>
		</tr>
	</thead>

	<tbody>
	<!-- # -->

	<?php $all_maps = mxmpotm_select_rows(); ?>

	<?php foreach( $all_maps as $key => $map ) : ?>

		<?php $key++; ?>

	    <tr>
			<th scope="row"><?php echo $key; ?></th>
			<td>
				<a href="<?php echo get_admin_url(); ?>admin.php?page=mxmpotm-many-points-on-the-map-edit&map=<?php echo $map->id; ?>">
					<strong>
						<?php echo $map->map_name; ?>
					</strong>
				</a>
			</td>
			<td><span class="mx-shortcode">[many_points_map="<?php echo $map->id; ?>"]</span></td>
	    </tr>

	<?php endforeach; ?>

	<!-- # -->
	</tbody>

	<tfoot>
	<tr>
	  <th scope="col">#</th>
	  <th scope="col"><?php echo __( 'Name', 'mxmpotm_map' ); ?></th>
	  <th scope="col"><?php echo __( 'Shortcode', 'mxmpotm_map' ); ?></th>
	</tr>
	</tfoot>

</table>