<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/dgaitan
 * @since      1.0.0
 *
 * @package    Pk_Woonder_Orders
 * @subpackage Pk_Woonder_Orders/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Pk_Woonder_Orders
 * @subpackage Pk_Woonder_Orders/includes
 * @author     David Gaitán <jdavid.gaitan@gmail.com>
 */
class Pk_Woonder_Orders_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'pk-woonder-orders',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
