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
	<form action="">
		<table class="wp-list-table widefat fixed striped posts">
			<thead>
				<tr>
					<td class="manage-column column-cb check-column">
						<input type="checkbox" id="pk-select-all" />
					</td>
					<td class="manage-column column-order_number column-primary sortable desc">
						<a
							href="<?php echo admin_url( 'admin.php?page=woonder-orders&order_by=ID&order=asc' ) ?>">
							<?php echo __( 'Order ID', $plugin_name ) ?>
						</a>
					</td>
					<td class="manage-column column-customer">
						<?php echo __( 'Customer', $plugin_name ) ?>
					</td>
					<td class="manage-column column-status">
						<?php echo __( 'Status', $plugin_name ) ?>
					</td>
					<td class="manage-column column-total">
						<?php echo __( 'Total', $plugin_name ) ?>
					</td>
				</tr>
			</thead>
			<tbody>
				<?php if ( $orders ) : ?>
					<?php foreach ( $orders as $order ) : ?>
						<tr id="order-<?php echo $order->get_id() ?>">
							<th scope="row" class="check-column">
								<input type="checkbox" name="post[]" value="<?php echo $order->get_id() ?>">
							</th>
							<th>
								<a
									href="<?php echo admin_url("post.php?post={$order->get_id()}&action=edit" ) ?>">

									<strong>#<?php echo $order->get_id() ?></strong>
								</a>
							</th>
							<th>
								<?php echo $order->get_user()->display_name ?>
							</th>
							<th>
								<?php echo $order->get_status() ?>
							</th>
							<th>
								<?php echo $order->get_total() ?>
							</th>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
	</form>
	<!-- /woonder orders -->

	<?php require_once plugin_dir_path( dirname( __FILE__ ) ) . 'views/partials/custom-status-modal.php'; ?>

</div>
