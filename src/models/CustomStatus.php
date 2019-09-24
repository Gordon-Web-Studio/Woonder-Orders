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
			'pk_custom_status_color'
		);

		parent::__construct( 'pk_custom_status', $fields );
	}

	public function register_custom_statuses(  ) {

	}

	public function get_all_orders() {

	}

}
