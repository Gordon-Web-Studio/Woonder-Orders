<?php

namespace PoetKods\WoonderOrders\Models;

/**
 * This file handle Order Class
 *
 * A Class definition that help to manage the WooCommerce Orders
 *
 * @link       https://github.com/dgaitan
 * @since      1.0.0
 *
 * @package    PoetKods/WoonderOrders
 * @subpackage PoetKods/WoonderOrders/Models
 */

defined( 'ABSPATH' ) || exit;

/**
 * This file handle Order Class
 *
 * Local managemente of WooCommerce Orders
 *
 * @since      1.0.0
 * @package    PoetKods/WoonderOrders
 * @subpackage PoetKods/WoonderOrders/Models
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
			'limit' => 20,
			'orderby' => 'date',
			'order' => 'DESC'
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

		$orders = new \WC_Order_Query( self::parse_args( $args ) );
		$data = array();

		if ( $serialize ) {

			foreach ( $orders->get_orders() as $order ) {
				$data[] = $order->get_data();
			}

		} else {

			$data = $orders->get_orders();

		}

		return $data;
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

}
