<?php

namespace PoetKods\WoonderOrders;

use PoetKods\WoonderOrders\Modules\Ajax;

/**
 * The Woonder Orders Initial Class
 *
 * @link       https://github.com/dgaitan
 * @since      1.0.0
 *
 * @package    PoetKods/WoonderOrders
 * @subpackage PoetKods/WoonderOrders
 */

defined( 'ABSPATH' ) || exit;

/**
 * This class Load the Woonder Orders Source
 *
 *
 * @since      1.0.0
 * @package    PoetKods/WoonderOrders
 * @subpackage PoetKods/WoonderOrders
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

        // Load the Ajax Module
        new Ajax();
    }
}

new WoonderOrders();
