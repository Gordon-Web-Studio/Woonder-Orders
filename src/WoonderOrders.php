<?php

namespace GWS\WoonderOrders;

use GWS\WoonderOrders\Modules\Ajax;
use GWS\WoonderOrders\Models\CustomStatus;

/**
 * The Woonder Orders Initial Class
 *
 * @link       https://github.com/dgaitan
 * @since      1.0.0
 *
 * @package    GWS/WoonderOrders
 * @subpackage GWS/WoonderOrders
 */

defined( 'ABSPATH' ) || exit;

/**
 * This class Load the Woonder Orders Source
 *
 * @since      1.0.0
 * @package    GWS/WoonderOrders
 * @subpackage GWS/WoonderOrders
 * @author     David Gaitán <jdavid.gaitan@gmail.com>
 */
class WoonderOrders {

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
		$custom_statuses->register_custom_status_to_woocommerce();

	}
}

new WoonderOrders();
