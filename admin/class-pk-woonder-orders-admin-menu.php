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
	 * The Items navigation slugs
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $menu_slugs  The Slugs of the admin navigations
	 */
	private $menu_slugs;

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
		$this->menu_slugs = array(
			'index' => 'woonder-orders',
			'custom-status' => 'custom-status'
		);

	}

	/**
	 * Register the index page.
	 *
	 * @since    1.0.0
	 */
	public function pages() {

		// Main Page Woonder Orders
		add_menu_page(
	        __( 'Woonder Orders', $this->plugin_name ),
	        'Woonder Orders',
	        'manage_options',
	        $this->menu_slugs['index'],
	        array( $this, 'index_view' ),
	        // plugins_url( 'myplugin/images/icon.png' ),
	        'dashicons-chart-area',
	        $this->priority
	    );

	    // Custom Status Woonder ORders
	    add_submenu_page(
	    	$this->menu_slugs['index'],
	    	__( 'Custom Statuses', $this->plugin_name ),
	    	__( 'Custom Statuses', $this->plugin_name ),
    		'manage_options',
    		'woonder-orders-custom-statuses',
    		array( &$this, 'custom_statuses_view' )
    	);

    	// Woonder Orders Settings
		add_submenu_page(
	    	$this->menu_slugs['index'],
	    	__( 'Settings', $this->plugin_name ),
	    	__( 'Settings', $this->plugin_name ),
    		'manage_options',
    		'woonder-orders-settings',
    		array( &$this, 'settings_view' )
    	);    	
    	

	}

	/**
	 * Load the index page.
	 * 
	 * @since 1.0.0
	 */
	public function index_view() {
		
		$plugin_name = $this->plugin_name;
		// Return the index view template
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'views/woonder-orders-index.php';
	}

	/**
	 * Load the custom statuses page.
	 * 
	 * @since 1.0.0
	 */
	public function custom_statuses_view() {
		// Return the index view template
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'views/custom-statuses.php';
	}

	/**
	 * Load the settings page.
	 * 
	 * @since 1.0.0
	 */
	public function settings_view() {
		// Return the index view template
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'views/settings.php';
	}

}
