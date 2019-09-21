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
				$data[] = self::serialize_order( $order );
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

	/**
	 * Order Serializer
	 *
	 * This take an order object and prepare the order
	 * serialized to return in ajax callback
	 *
	 * @param  object $order
	 * @return object $order
	 */
	public static function serialize_order( $order ) {		// // Get Order Totals $0.00
		$order->formatted_order_total = $order->get_formatted_order_total();
		$order->cart_tax = $order->get_cart_tax();
		$order->currency = $order->get_currency();
		$order->discount_tax = $order->get_discount_tax();
		$order->get_discount_to_display = $order->get_discount_to_display();
		$order->discount_total = $order->get_discount_total();
		$order->fees = $order->get_fees();
		$order->shipping_tax = $order->get_shipping_tax();
		$order->shipping_total = $order->get_shipping_total();
		$order->subtotal = $order->get_subtotal();
		$order->subtotal_to_display = $order->get_subtotal_to_display();
		$order->tax_totals = $order->get_tax_totals();
		$order->taxes = $order->get_taxes();
		$order->total = $order->get_total();
		$order->total_discount = $order->get_total_discount();
		$order->total_tax = $order->get_total_tax();
		$order->total_refunded = $order->get_total_refunded();
		$order->total_tax_refunded = $order->get_total_tax_refunded();
		$order->total_shipping_refunded = $order->get_total_shipping_refunded();
		$order->item_count_refunded = $order->get_item_count_refunded();
		$order->total_qty_refunded = $order->get_total_qty_refunded();
		$order->remaining_refund_amount = $order->get_remaining_refund_amount();

		// Get Order Items
		$order->items_tax_classes = $order->get_items_tax_classes();
		$order->item_count = $order->get_item_count();

		// Get Order Shipping
		$order->shipping_method = $order->get_shipping_method();
		$order->shipping_methods = $order->get_shipping_methods();
		$order->shipping_to_display = $order->get_shipping_to_display();

		// Get Order Dates
		$order->date_created = $order->get_date_created();
		$order->date_modified = $order->get_date_modified();
		$order->date_completed = $order->get_date_completed();
		$order->date_paid = $order->get_date_paid();

		// Get Order User, Billing & Shipping Addresses
		$order->customer_id = $order->get_customer_id();
		$order->user_id = $order->get_user_id();
		$order->user = $order->get_user();
		$order->customer_ip_address = $order->get_customer_ip_address();
		$order->customer_user_agent = $order->get_customer_user_agent();
		$order->created_via = $order->get_created_via();
		$order->customer_note = $order->get_customer_note();
		// $order->get_address_prop();
		// $order->get_billing_first_name();
		// $order->get_billing_last_name();
		// $order->get_billing_company();
		// $order->get_billing_address_1();
		// $order->get_billing_address_2();
		// $order->get_billing_city();
		// $order->get_billing_state();
		// $order->get_billing_postcode();
		// $order->get_billing_country();
		// $order->get_billing_email();
		// $order->get_billing_phone();
		// $order->get_shipping_first_name();
		// $order->get_shipping_last_name();
		// $order->get_shipping_company();
		// $order->get_shipping_address_1();
		// $order->get_shipping_address_2();
		// $order->get_shipping_city();
		// $order->get_shipping_state();
		// $order->get_shipping_postcode();
		// $order->get_shipping_country();
		// $order->get_address();
		// $order->get_shipping_address_map_url();
		// $order->get_formatted_billing_full_name();
		// $order->get_formatted_shipping_full_name();
		// $order->get_formatted_billing_address();
		// $order->get_formatted_shipping_address();

		// // Get Order Payment Details
		// $order->get_payment_method();
		// $order->get_payment_method_title();
		// $order->get_transaction_id();

		// // Get Order URLs
		// $order->get_checkout_payment_url();
		// $order->get_checkout_order_received_url();
		// $order->get_cancel_order_url();
		// $order->get_cancel_order_url_raw();
		// $order->get_cancel_endpoint();
		// $order->get_view_order_url();
		// $order->get_edit_order_url();

		// Get Order Status
		$order->status = $order->get_status();

		return $order;
	}
}
