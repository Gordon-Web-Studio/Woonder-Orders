<?php

namespace PoetKods\WoonderOrders\Modules;

use PoetKods\WoonderOrders\Abstracts\AbstractAjax;
use PoetKods\WoonderOrders\Traits\AjaxTrait;
use PoetKods\WoonderOrders\Traits\HookerTrait;

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

    use HookerTrait;
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
            'pk_create_custom_status',
            'pk_get_custom_statuses',
            'pk_get_woocommerce_statuses',
            'pk_get_statuses',
            'pk_get_settings'
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
    public function pk_create_custom_status() {
    	if ( isset( $_POST['fields'] ) ) {

    		$custom_status = $this->create_custom_status( $_POST['fields'] );

    		return $this->send_success(array(
    			'message' => __('The Custom Status has been created', PK_PLUGIN_NAME),
    			'status' => $custom_status
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

    /**
     * Retrieve the WooCommerce Status
     *
     * @return array $woocommerce_statuses - Reeturn the Default Woocommerce Statuses
     */
    public function pk_get_woocommerce_statuses () {
    	$woocommerce_status = wc_get_order_statuses();

    	return $this->send_success(array(
    		'message' => __('WooCommerce Status', PK_PLUGIN_NAME ),
    		'statuses' => $woocommerce_status
    	));
    }

    /**
     * Get all statuses
     *
     * @return array $statuses
     */
    public function pk_get_statuses() {
    	$statuses = $this->get_statuses();

    	return $this->send_success(array(
    		'message' => __('Statuses has been retrieved successfully', PK_PLUGIN_NAME),
    		'statuses' => $statuses
    	));
    }

    public function pk_get_settings() {
    	$settings = $this->get_settings();

    	return $this->send_success(array(
    		'message' => __('Settings loaded successfully', PK_PLUGIN_NAME),
    		'settings' => $settings
    	));
    }
}
