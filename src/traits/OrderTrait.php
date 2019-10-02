<?php

namespace GWS\WoonderOrders\Traits;

/**
 * The Woonder Orders Order Traits
 *
 * @link       https://github.com/dgaitan
 * @since      1.0.0
 *
 * @package    GWS/WoonderOrders
 * @subpackage GWS/WoonderOrders/Traits
 */

defined( 'ABSPATH' ) || exit;


/**
 * The Woonder Orders Traits.
 *
 * Use this trait to can manage specific logic
 * about the order from WooCommerce
 *
 * @package    GWS/WoonderOrders
 * @subpackage GWS/WoonderOrders/Traits
 * @author     David Gaitán <jdavid.gaitan@gmail.com>
 */
trait OrderTrait {

	/**
	 * Order Serializer
	 *
	 * This take an order object and prepare the order
	 * serialized to return in ajax callback
	 *
	 * @param  object $order
	 * @return object $order
	 */
	public static function serialize_order( $order ) {

		// return $order;
	}
}
