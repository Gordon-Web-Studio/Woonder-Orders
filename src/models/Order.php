<?php

namespace GWS\WoonderOrders\Models;

/**
 * This file handle Order Class
 *
 * A Class definition that help to manage the WooCommerce Orders
 *
 * @link       https://github.com/dgaitan
 * @since      1.0.0
 *
 * @package    GWS/WoonderOrders
 * @subpackage GWS/WoonderOrders/Models
 */

defined( 'ABSPATH' ) || exit;

/**
 * This file handle Order Class
 *
 * Local managemente of WooCommerce Orders
 *
 * @since      1.0.0
 * @package    GWS/WoonderOrders
 * @subpackage GWS/WoonderOrders/Models
 * @author     David Gaitán <jdavid.gaitan@gmail.com>
 */
class Order {

	/**
	 * Construct the class
	 *
	 * @since  1.0.0
	 * @return  void
	 */
	public function __construct() {

	}

	/**
	 * Parse Args
	 *
	 * @param  array  $args the custom args
	 * @return arry The args parsed
	 */
	public static function parse_args( $args = array() ) {
		$default_args = array(
			'limit' => 2,
			'orderby' => 'date',
			'order' => 'DESC',
			'paginate' => true,
			'offset' => 1
		);

		$args = wp_parse_args( $args, $default_args );

		return $args;
	}

	/**
	 * Where clause
	 *
	 * Get Orders based in args params
	 *
	 * @param  array  $args arguments to get orders
	 * @return object $orders Return Orders filtered.
	 */
	public static function where( $args = array(), $serialize = true ) {

		$orders = wc_get_orders( self::parse_args( $args ) );
		$data = array();

		if ( $serialize ) {

			foreach ( $orders->orders as $key => $order ) {
				$data[] = $order->get_data();

				// Set the customer data
				$customer = $order->get_user();

				if ( $customer ) {
					$customer = array(
						'display_name' => $customer->data->display_name,
						'user_email' => $customer->data->user_email
					);
				}

				$data[$key]['customer'] = $customer;
				$data[$key]['detail_url'] = admin_url() . 'post.php?post=' . $order->get_id() . '&action=edit';

				// Set the date formated
				$date = new \DateTime($data[$key]['date_created']->date);
				$data[$key]['date'] = $date->format('M j, Y');

				// Set the items
				$products = array();

				foreach ( $order->get_items( 'line_item' ) as $product ) {
					$p = $product->get_product();

					$products[] = array(
						'id' => $p->get_id(),
						'name' => $p->get_name(),
						'total' => $product->get_total()
					);
				}

				$data[$key]['products'] = $products;
			}

		} else {

			$data = $orders->get_orders();

		}

		return array(
			'items' => $data,
			'total' => $orders->total,
			'max_num_pages' => $orders->max_num_pages
		);
	}

	/**
	 * Find an Order
	 *
	 * @param  integer $order_id
	 * @return object WooCommerce Order
	 */
	public static function find( $order_id ) {

		$order = wc_get_order( $order_id );

		return $order;
	}

	/**
	 * Count total Order stored
	 *
	 * @return integer $total_orders
	 */
	public static function count( $status = 'all' ) {
		global $wpdb;

		$sql = "SELECT COUNT(*) FROM $wpdb->posts WHERE 1=1 AND post_type='shop_order'";

		if ( $status !== 'all' ) {
			$sql = $sql . "AND post_status = {$status}";
		}

		return (int)$wpdb->get_var($sql);
	}

}
