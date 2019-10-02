<?php

namespace GWS\WoonderOrders\Abstracts;

/**
 * Abstract Ajax
 *
 * @link       https://github.com/dgaitan
 * @since      1.0.0
 *
 * @package    GWS/WoonderOrders
 * @subpackage GWS/WoonderOrders/Abstracts
 */

defined( 'ABSPATH' ) || exit;

/**
 * Absctract class to handle the main ajax logic.
 *
 * Here is defined the methods and actions
 * that contains all the logic related
 * with the ajax actions
 *
 * @package    GWS/WoonderOrders
 * @subpackage GWS/WoonderOrders/Abstracts
 * @author     David Gaitán <jdavid.gaitan@gmail.com>
 */
abstract class AbstractAjax {

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
