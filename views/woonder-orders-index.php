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
	<a href="#" class="page-title-action" data-toggle="modal" data-target="#settingsModal">
		<?php echo __( 'Settings', $plugin_name ); ?>
	</a>
	<hr class="wp-header-end" />
	<!-- woonder orders -->
	<div class="card pk-card">
		<nav class="card-status">
		  	<a
		  		v-for="status in statuses"
		  		class="nav-link"
		  		href="#"
		  		v-bind:class="[currentStatus.id === status.id ? 'active' : '']"
		  		@click="changeStatus(status)">
				{{ status.name }}
		  	</a>
		</nav>
		<div class="card-element">
			<div class="row">
				<div class="col-12 col-md-3">
					<div class="input-group">
					  	<input type="search" class="form-control" placeholder="<?php echo __( 'Search...', $plugin_name ); ?>" aria-label="" aria-describedby="basic-addon1">
					  	<div class="input-group-append input-group-sm">
						    <button class="btn btn-primary" type="button">
						    	<span class="dashicons dashicons-search"></span>
						    </button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="card-body">
			<table class="table" v-if="settings">
				<thead>
					<tr>
						<th scope="col"></th>
						<th scope="col" v-if="settings.col_order_id.value">
							<?php echo __( 'Order ID', $plugin_name ) ?>
						</th>
						<th scope="col" v-if="settings.col_customer.value">
							<?php echo __( 'Customer', $plugin_name ) ?>
						</th>
						<th scope="col" v-if="settings.col_date.value">
							<?php echo __( 'Date', $plugin_name ) ?>
						</th>
						<th scope="col" v-if="settings.col_status.value">
							<?php echo __( 'Status', $plugin_name ) ?>
						</th>
						<th scope="col" v-if="settings.col_billing_address.value">
							<?php echo __( 'Billing Address', $plugin_name ) ?>
						</th>
						<th scope="col" v-if="settings.col_shipping_address.value">
							<?php echo __( 'Shipping Address', $plugin_name ) ?>
						</th>
						<th scope="col" v-if="settings.col_product_items.value">
							<?php echo __( 'Products', $plugin_name ) ?>
						</th>
						<th scope="col" v-if="settings.col_total.value">
							<?php echo __( 'Total', $plugin_name ) ?>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="order in orders">
						<th></th>
						<td v-if="settings.col_order_id.value">
							<a :href="order.detail_url">
								<strong>Order #{{ order.id }}</strong>
							</a>
						</td>
						<td v-if="settings.col_customer.value">
							<div v-if="order.customer">
								<span class="d-block"><strong>{{ order.customer.display_name }}</strong></span>
								<em>{{ order.customer.user_email }}</em>
							</div>
							<div v-else>
								<?php echo __( 'Guest', $plugin_name ); ?>
							</div>
						</td>
						<td v-if="settings.col_date.value">
							{{ order.date }}
						</td>
						<td v-if="settings.col_status.value">
							<div v-html="getStatusLabel(order.status)"></div>
						</td>
						<td v-if="settings.col_billing_address.value">
							<div v-html="getAddressFormat(order, 'billing')"></div>
						</td>
						<td v-if="settings.col_shipping_address.value">
							<div v-html="getAddressFormat(order, 'shipping')"></div>
						</td>
						<td v-if="settings.col_product_items.value">
							<ul>
								<li :id="product.id" v-for="product in order.products">
									<strong class="d-block">{{ product.name }}</strong>
									<em class="d-block">
										<strong><?php echo __('Total: ', $plugin_name) ?></strong>{{ order.currency }} {{ product.total }}
									</em>
									<hr>
								</li>
							</ul>
						</td>
						<td v-if="settings.col_total.value">
							{{ order.currency }} {{ order.total }}
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<nav class="mt-3">
		<ul class="pagination">
			<li class="page-item">
				<a href="#" class="page-link">
					<?php echo __( 'Previous', $plugin_name ) ?>
				</a>
			</li>
			<li class="page-item">
				<a href="#" class="page-link">
					<?php echo __( 'Next', $plugin_name ) ?>
				</a>
			</li>
		</ul>
	</nav>
	<!-- /woonder orders -->

	<?php require_once plugin_dir_path( dirname( __FILE__ ) ) . 'views/partials/custom-status-modal.php'; ?>
	<?php require_once plugin_dir_path( dirname( __FILE__ ) ) . 'views/partials/settings-modal.php'; ?>

</div>
