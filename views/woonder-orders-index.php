<?php

/**
 * Woonder Orders Index
 *
 * Index page to load the woonder orders
 *
 * @link       https://github.com/dgaitan
 * @since      1.0.0
 *
 * @package    Pk_Woonder_Orders
 * @subpackage Pk_Woonder_Orders/views
 */
?>
<div class="wrap woonder-orders" id="pk-woonder-orders">
	<h1 class="wp-heading-inline">Woonder Orders</h1>
	<a href="<?php echo admin_url( "post-new.php?post_type=shop_order" ) ?>" class="page-title-action">
		<?php echo __( 'Add Order', $plugin_name ); ?>
	</a>
	<a href="#" class="page-title-action" data-toggle="modal" data-target="#customStatusModal">
		<?php echo __( 'Add Custom Status', $plugin_name ); ?>
	</a>
	<hr class="wp-header-end" />
	<!-- woonder orders -->
	<div class="card pk-card">
		<nav class="card-status">
		  	<a
		  		v-for="status in customStatuses"
		  		class="nav-link"
		  		href="#">
				{{ status.pk_custom_status_name }}
		  	</a>
		</nav>
		<div class="card-element">
			<input type="search" placeholder="<?php echo __( 'Search...', $plugin_name ) ?>" class="form-control">
		</div>
		<div class="card-body">
			<table class="table">
				<thead>
					<tr>
						<th scope="col"></th>
						<th scope="col">
							<?php echo __( 'Order ID', $plugin_name ) ?>
						</th>
						<th scope="col">
							<?php echo __( 'Customer', $plugin_name ) ?>
						</th>
						<th scope="col">
							<?php echo __( 'Status', $plugin_name ) ?>
						</th>
						<th scope="col">
							<?php echo __( 'Total', $plugin_name ) ?>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="order in orders">
						<th></th>
						<th>{{ order.id }}</th>
						<th>{{ order.customer_id }}</th>
						<th>{{ order.status }}</th>
						<th>{{ order.total }}</th>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<!-- /woonder orders -->

	<?php require_once plugin_dir_path( dirname( __FILE__ ) ) . 'views/partials/custom-status-modal.php'; ?>

</div>
