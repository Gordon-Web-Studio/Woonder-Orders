<?php

namespace GWS\WoonderOrders\Traits;

/**
 * The Woonder Hooker Traits
 *
 * @link       https://github.com/dgaitan
 * @since      1.0.0
 *
 * @package    GWS/WoonderOrders
 * @subpackage GWS/WoonderOrders/Traits
 */

defined( 'ABSPATH' ) || exit;


/**
 * The Woonder Hooker functions.
 *
 * This Hooker contains the wordpress hookers
 *
 * @package    GWS/WoonderOrders
 * @subpackage GWS/WoonderOrders/Traits
 * @author     David Gaitán <jdavid.gaitan@gmail.com>
 */
trait HookerTrait {

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
}
