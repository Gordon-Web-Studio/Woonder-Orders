<?php

/**
 * Fired during plugin activation
 *
 * @link       https://github.com/dgaitan
 * @since      1.0.0
 *
 * @package    Pk_Woonder_Orders
 * @subpackage Pk_Woonder_Orders/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Pk_Woonder_Orders
 * @subpackage Pk_Woonder_Orders/includes
 * @author     David Gaitán <jdavid.gaitan@gmail.com>
 */
class Pk_Woonder_Orders_Activator {

	/**
	 * Check if exist an instance of WooCommerce first. (use period)
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		if ( ! class_exists( 'WooCommerce' ) ) {
			
			add_action(
				'admin_notices',
				'Pk_Woonder_Orders_Activator::woocommerce_missing_wc_notice'
			);
			
			return;
		
		}
	
	}

	public static function woocommerce_missing_wc_notice () {

		echo '<div class="error"><p><strong>' . sprintf( esc_html__( 'Woonder Orders requires WooCommerce to be installed and active. You can download %s here.', 'pk-woonder-orders' ), '<a href="https://woocommerce.com/" target="_blank">WooCommerce</a>' ) . '</strong></p></div>';
	
	}

}
