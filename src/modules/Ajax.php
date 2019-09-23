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
        	'pk_get_index_data',
            'pk_get_orders',
            'pk_get_order',
            'pk_create_order',
            'pk_get_custom_statuses'
        );

        // Load the hooks
        parent::__construct( $hooks );
    }

    /**
     * This retrieve all the data from
     * Woonder Orders Index Page in dash
     *
     * @since 1.0.0
     * @return array $data - the initial data.
     */
    public function pk_get_index_data() {

    	$data = $this->init_data();

    	return $this->send_success(array(
    		'message' => __('Data loaded successfully!', PK_PLUGIN_NAME),
    		'initData' => $data
    	));
    }

    /**
     * Get the WooCommerce Orders
     *
     * @since  1.0.0
     * @return array $orders - The array with the orders
     */
    public function pk_get_orders() {

        $orders = $this->get_orders();

        return $this->send_success( array(
        	'message' => __('Order has been loaded successfully!', PK_PLUGIN_NAME),
        	'orders' => $orders
        ) );
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

    /**
     * Create a custom order
     *
     * @since  1.0.0
     * @param  $fields array The Custom Status Fields
     * @return array $custom_status - The Custom Status Data
     */
    public function pk_create_order() {

    	if ( isset( $_POST['fields'] ) ) {

    		$custom_status = $this->create_order( $_POST['fields'] );

    		return $this->send_success(array(
    			'message' => __('The Custom Status has been created', PK_PLUGIN_NAME),
    			'customStatus' => $custom_status
    		));
    	}

    	return $this->send_error(array(
    		'message' => __( 'The fields are required!', PK_PLUGIN_NAME )
    	));
    }

    /**
     * Retrieve custom status
     *
     * @return array $customStatuses - Return the custom statues
     */
    public function pk_get_custom_statuses() {

    	$custom_statuses = $this->get_custom_statuses();
    	return $this->send_success( array(
    		'message' => __( 'The custom statuses has been returned successfully!', PK_PLUGIN_NAME ),
    		'customStatuses' => $custom_statuses
    	) );
    }
}
