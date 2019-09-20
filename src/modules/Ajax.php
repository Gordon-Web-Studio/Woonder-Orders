<?php

namespace PoetKods\WoonderOrders\Modules;

use PoetKods\WoonderOrders\Abstracts\AbstractAjax;
use PoetKods\WoonderOrders\Traits\AjaxTrait;

/**
 * The Woonder Orders Ajax actions
 *
 * @link       https://github.com/dgaitan
 * @since      1.0.0
 *
 * @package    PoetKods/WoonderOrders
 * @subpackage PoetKods/WoonderOrders/Modules
 */

defined( 'ABSPATH' ) || exit;

/**
 * This class manage the ajaxs callbacks
 *
 *
 * @since      1.0.0
 * @package    PoetKods/WoonderOrders
 * @subpackage PoetKods/WoonderOrders/Modules
 * @author     David Gaitán <jdavid.gaitan@gmail.com>
 */
class Ajax extends AbstractAjax {

    use AjaxTrait;

    /**
     * Init the Ajax
     *
     * @since  1.0.0
     */
    public function __construct() {

        // Define the ajax actions hooks/endpoints
        $hooks = array(
            'pk_get_orders',
            'pk_get_order'
        );

        // Load the hooks
        parent::__construct( $hooks );
    }

    /**
     * Get the WooCommerce Orders
     *
     * @since  1.0.0
     * @return array $orders - The array with the orders
     */
    public function pk_get_orders() {

        $orders = $this->get_orders();

        return $this->send_success( $orders );
    }

    /**
     * Get a simple order by id
     *
     * @since  1.0.0
     * @param  $order_id integer The Order ID
     * @return array $order - The Order Object
     */
    public function pk_get_order() {

        return $this->send_success( array( 'status' => 'ok' ) );
    }
}
