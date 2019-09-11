<?php

/**
 * The admin-menu items of the plugin.
 *
 * @link       https://github.com/dgaitan
 * @since      1.0.0
 *
 * @package    Pk_Woonder_Orders
 * @subpackage Pk_Woonder_Orders/admin
 */

/**
 * The admin-menu items of the plugin.
 *
 * Define the admin menu items in the dashboard 
 *
 * @package    Pk_Woonder_Orders
 * @subpackage Pk_Woonder_Orders/admin
 * @author     David Gaitán <jdavid.gaitan@gmail.com>
 */
class Pk_Woonder_Orders_Admin_Menu {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The priority of the navigation.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      integer    $priority  The Priority in the WP MENU  
	 */
	private $priority;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->priority = 30;

	}

	/**
	 * Register the index page.
	 *
	 * @since    1.0.0
	 */
	public function index() {

		// Main Page Woonder Orders
		add_menu_page(
	        __( 'Woonder Orders', $this->plugin_name ),
	        'Woonder Orders',
	        'manage_options',
	        'woonder-orders',
	        '',
	        // plugins_url( 'myplugin/images/icon.png' ),
	        'dashicons-chart-area',
	        $this->priority
	    );

	}

}
