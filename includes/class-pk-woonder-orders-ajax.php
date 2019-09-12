<?php

/**
 * The Woonder Orders Ajax actions
 *
 * @link       https://github.com/dgaitan
 * @since      1.0.0
 *
 * @package    Pk_Woonder_Orders
 * @subpackage Pk_Woonder_Orders/admin
 */

/**
 * The Woonder Orders Ajax actions.
 *
 * This class load all the wp-ajax actions to can manage
 * the orders with vue.js
 *
 * @package    Pk_Woonder_Orders
 * @subpackage Pk_Woonder_Orders/admin
 * @author     David Gaitán <jdavid.gaitan@gmail.com>
 */

class Pk_Woonder_Orders_Ajax {

	/**
	 * The Ajax Hooks
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $hooks    The ajax hooks/endpoints
	 */
	private $hooks = array();

	/**
	 * Init the Ajax
	 *
	 * @since  1.0.0
	 */
	public function __construct() {

		// Set the hooks
		$this->hooks = array(
			'pk_get_orders',
			'pk_get_order'
		);

		// Load the hooks
		foreach ( $this->hooks as $hook ) {
			$this->action( "wp_ajax_{$hook}", $hook );
		}
	}

	/**
	 * Get the WooCommerce Orders
	 *
	 * @since  1.0.0
	 * @return array $orders - The array with the orders
	 */
	public function pk_get_orders() {

		return $this->send_success( array( 'status' => 'ok' ) );
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
     * Hooks a function on to a specific action.
     *
     * @param     $tag
     * @param     $function
     * @param int $priority
     * @param int $accepted_args
     */
    public function action( $tag, $function, $priority = 10, $accepted_args = 1 ) {
        add_action( $tag, [ $this, $function ], $priority, $accepted_args );
    }

    /**
     * Hooks a function on to a specific filter.
     *
     * @param     $tag
     * @param     $function
     * @param int $priority
     * @param int $accepted_args
     */
    public function filter( $tag, $function, $priority = 10, $accepted_args = 1 ) {
        add_filter( $tag, [ $this, $function ], $priority, $accepted_args );
    }

    /**
     * Verify request nonce
     *
     * @param  string  the nonce action name
     *
     * @return void
     */
    public function verify_nonce( $action ) {
        if ( ! isset( $_REQUEST['_wpnonce'] ) || ! wp_verify_nonce( $_REQUEST['_wpnonce'], $action ) ) {
            $this->send_error( __( 'Error: Nonce verification failed', 'kindhumans' ) );
        }
    }

    /**
     * Wrapper function for sending success response
     *
     * @param  mixed $data
     *
     * @return void
     */
    public function send_success( $data = null ) {
        wp_send_json_success( $data );
    }

    /**
     * Wrapper function for sending error
     *
     * @param  mixed $data
     *
     * @return void
     */
    public function send_error( $data = null ) {
        wp_send_json_error( $data );
    }
}