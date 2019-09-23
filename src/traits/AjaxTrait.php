<?php

namespace PoetKods\WoonderOrders\Traits;

use PoetKods\WoonderOrders\Models\Order;
use PoetKods\WoonderOrders\Models\CustomStatus;

/**
 * The Woonder Orders Ajax Traits
 *
 * @link       https://github.com/dgaitan
 * @since      1.0.0
 *
 * @package    PoetKods/WoonderOrders
 * @subpackage PoetKods/WoonderOrders/Traits
 */

defined( 'ABSPATH' ) || exit;


/**
 * The Woonder Orders Ajax functions.
 *
 * Use this trait to handle the logic of the
 * Main Ajax Class
 *
 * @package    PoetKods/WoonderOrders
 * @subpackage PoetKods/WoonderOrders/Traits
 * @author     David Gaitán <jdavid.gaitan@gmail.com>
 */
trait AjaxTrait {

	/**
	 * Setup the initial data in the woonder orders index page
	 *
	 * @since  1.0.0
	 * @return array $data all the necessary data to show in index
	 */
	private function init_data() {

		$data = array();
		// Set the custom statuses
		$data['customStatuses'] = $this->get_custom_statuses();
		// Get orders
		$data['orders'] = $this->get_orders();

		return $data;
	}

	/**
	 * Get all WooCommerce Orders
	 *
	 * @since  1.0.0
	 * @return array $orders The Order List
	 */
	private function get_orders() {

		$args = array();

		$orders = Order::where( $args, $serialize = true );

		return $orders;
	}

	/**
	 * Get a single WooCoomerce Order
	 *
	 * @since 1.0.0
	 * @return array $order The Order Single Object
	 */
	private function get_order() {

	}

	/**
	 * Create a Custom Status
	 *
	 * @param  array $fields - The Custom Status fields to save
	 * @return array $custom_status - The Custom Status saved!
	 */
	private function create_order( $fields ) {
		$custom_status = new CustomStatus();
		$custom_status = $custom_status->create( $fields );
		return $custom_status;
	}

	private function get_custom_statuses() {
		$custom_statuses = new CustomStatus();
		$custom_statuses = $custom_statuses->where( array(
			'posts_per_page' => -1
		) );

		return $custom_statuses;

	}
}
