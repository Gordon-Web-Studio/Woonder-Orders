<?php

/**
 * Abstract Ajax Handler
 *
 * @link       https://github.com/dgaitan
 * @since      1.0.0
 *
 * @package    Pk_Woonder_Orders
 * @subpackage Pk_Woonder_Orders/includes/abstract
 */

/**
 * Absctract class to handle the main ajax logic.
 *
 * Here is defined the methods and actions
 * that contains all the logic related 
 * with the ajax actions
 *
 * @package    Pk_Woonder_Orders
 * @subpackage Pk_Woonder_Orders/includes/abstract
 * @author     David Gaitán <jdavid.gaitan@gmail.com>
 */
abstract class Pk_Ajax_Legacy {

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
	public function __construct( $hooks = array() ) {

		// Set the hooks
		$this->hooks = $hooks;

		// Load the hooks
		foreach ( $this->hooks as $hook ) {
			$this->action( "wp_ajax_{$hook}", $hook );
		}
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