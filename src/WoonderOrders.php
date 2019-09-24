<?php

namespace PoetKods\WoonderOrders;

use PoetKods\WoonderOrders\Modules\Ajax;
use PoetKods\WoonderOrders\Traits\HookerTrait;
use PoetKods\WoonderOrders\Models\CustomStatus;

/**
 * The Woonder Orders Initial Class
 *
 * @link       https://github.com/dgaitan
 * @since      1.0.0
 *
 * @package    PoetKods/WoonderOrders
 * @subpackage PoetKods/WoonderOrders
 */

defined( 'ABSPATH' ) || exit;

/**
 * This class Load the Woonder Orders Source
 *
 * @since      1.0.0
 * @package    PoetKods/WoonderOrders
 * @subpackage PoetKods/WoonderOrders
 * @author     David Gaitán <jdavid.gaitan@gmail.com>
 */
class WoonderOrders {

	use HookerTrait;

	/**
	 * Custom Statuses create by the user
	 * @var array
	 */
	public $custom_statuses = array();

	/**
	 * Constructor for the class
	 *
	 * Setup all the plugin
	 *
	 * @since  1.0.0
	 * @return  void
	 */
	public function __construct() {

		/**
		 * Load Ajax Callbacks
		 */
		new Ajax();

		/**
		 * Register The Custom Status to WooCommerce
		 */
		$custom_statuses = new CustomStatus();
		$this->custom_statuses = $custom_statuses->where( array(
			'posts_per_page' => -1
		) );

		$this->action( 'init', 'register_custom_post_status' );
		$this->filter( 'wc_order_statuses', 'register_custom_status_to_woo' );

	}

	public function register_custom_post_status() {
		if ( $this->custom_statuses ) {
			foreach ( $this->custom_statuses as $status ) {
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

	public function register_custom_status_to_woo( $statuses ) {
		if ( $this->custom_statuses ) {
			foreach ( $this->custom_statuses as $status ) {
				$status_slug = "wc-{$status['post_name']}";
				$statuses[$status_slug] = _x( $status['pk_custom_status_name'], 'Order Status', 'woocommerce' );
			}
		}

		return $statuses;
	}
}

new WoonderOrders();
