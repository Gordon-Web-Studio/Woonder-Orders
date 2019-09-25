<?php

namespace PoetKods\WoonderOrders\Models;

use PoetKods\WoonderOrders\Abstracts\AbstractModel;
use PoetKods\WoonderOrders\Traits\HookerTrait;

/**
 * This file create a Custom Status Class
 *
 * A class definition that includes the CustomStatus PostType to
 * can manage all related with the custom status
 * in WooCommerce.
 *
 * @link       https://github.com/dgaitan
 * @since      1.0.0
 *
 * @package    PoetKods/WoonderOrders
 * @subpackage PoetKods/WoonderOrders/Models
 */

defined( 'ABSPATH' ) || exit;

/**
 * The class that let us handle the custom status.
 *
 * This define the methods to can handle/manage the custom
 * status of woocommerce.
 *
 * @since      1.0.0
 * @package    PoetKods/WoonderOrders
 * @subpackage PoetKods/WoonderOrders/Models
 * @author     David Gaitán <jdavid.gaitan@gmail.com>
 */
class CustomStatus extends AbstractModel {

	use HookerTrait;

	/**
	 * The Construct of the model
	 */
	public function __construct() {

		$fields = array( // Set the fields
			'pk_custom_status_name',
			'pk_custom_status_description',
			'pk_custom_status_color',
			'pk_custom_status_show'
		);

		parent::__construct( 'pk_custom_status', $fields );
	}

	/**
	 * Register Custom Status created by the user
	 * to WooCommerce Status
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function register_custom_status_to_woocommerce() {
		$this->where( array( 'posts_per_page' => -1 ) );
		$this->action( 'init', 'register_custom_post_status' );
		$this->filter( 'wc_order_statuses', 'register_custom_status_to_woo' );
	}

	/**
	 * Register custom status as post status
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function register_custom_post_status() {
		if ( $this->items ) {
			foreach ( $this->items as $status ) {
				$status_slug = "wc-{$status['post_name']}";
				$status_label = $status['pk_custom_status_name'];

				register_post_status( $status_slug, array(
			        'label'                     => $status_label,
			        'public'                    => true,
			        'exclude_from_search'       => false,
			        'show_in_admin_all_list'    => true,
			        'show_in_admin_status_list' => true,
			        'label_count'               => _n_noop( "{$status_label} <span class='count'>(%s)</span>", "{$status_label} <span class='count'>(%s)</span>" )
			    ) );
			}
		}
	}

	/**
	 * Register custom status to woocommerce status
	 *
	 * @since  1.0.0
	 * @param  array $statuses - WooCommerce Statuses
	 * @return array $statuses - WooCommerce Statuses + Custom Statuses
	 */
	public function register_custom_status_to_woo( $statuses ) {
		if ( $this->items ) {
			foreach ( $this->items as $status ) {
				$status_slug = "wc-{$status['post_name']}";
				$statuses[$status_slug] = _x( $status['pk_custom_status_name'], 'Order Status', 'woocommerce' );
			}
		}

		return $statuses;
	}

	public function get_statuses() {
		$statuses = wc_get_order_statuses(); // WooCommerce Status
		$custom_statuses = $this->all(); // Custom Status
		$data = array(); // Status Merged

		$woo_status_atts = array(
			'wc-completed' => array( 'color' => '#c8d7e1' ),
			'wc-on-hold' => array( 'color' => '#f8dda7' ),
			'wc-processing' => array( 'color' => '#c6e1c6' ),
			'wc-failed' => array( 'color' => '#eba3a3')
		);

		// Default WooCommerce Status
		$default_statuses = array(
	        'wc-pending',
	        'wc-processing',
	        'wc-on-hold',
	        'wc-completed',
	        'wc-cancelled',
	        'wc-refunded',
	        'wc-failed',
	    );

		foreach ( $custom_statuses as $value ) {
			$status_name = 'wc-' . $value['post_name'];
			$woo_status_atts[$status_name]['color'] = $value['pk_custom_status_color'];
			$woo_status_atts[$status_name]['show'] = $value['pk_custom_status_show'];
		}

		foreach ( $statuses as $key => $value ) {
			$data[] = array(
				'slug' => explode('wc-', $key)[1],
				'id' => $key,
				'name' => $value,
				'color' => isset( $woo_status_atts[$key] ) ? $woo_status_atts[$key]['color'] : '#e5e5e5',
				'show' => in_array( $key, $default_statuses ) ? true : $woo_status_atts[$key]['show'] === "true"
			);
		}

		return $data;
	}

}
