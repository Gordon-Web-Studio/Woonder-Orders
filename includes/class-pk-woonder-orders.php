<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://github.com/dgaitan
 * @since      1.0.0
 *
 * @package    Pk_Woonder_Orders
 * @subpackage Pk_Woonder_Orders/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Pk_Woonder_Orders
 * @subpackage Pk_Woonder_Orders/includes
 * @author     David Gaitán <jdavid.gaitan@gmail.com>
 */
class Pk_Woonder_Orders {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Pk_Woonder_Orders_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'PK_WOONDER_ORDERS_VERSION' ) ) {
			$this->version = PK_WOONDER_ORDERS_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'pk-woonder-orders';

        $this->define_constants();
        $this->register_custom_post_types();
		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_navs();
		$this->define_admin_hooks();

	}

    /**
     * Define constants
     *
     * @since  1.0.0
     * @access private
     * @return void
     */
    private function define_constants() {
    	define( 'PK_PLUGIN_NAME', $this->plugin_name );
        define( 'PK_WOONDER_ORDERS_PATH', plugin_dir_path( dirname( __FILE__ ) ) );
        define( 'PK_WOONDER_ORDERS_INCLUDES', PK_WOONDER_ORDERS_PATH . 'includes' );
        define( 'PK_WOONDER_ORDERS_ADMIN', PK_WOONDER_ORDERS_PATH . 'admin' );
        define( 'PK_WOONDER_ORDERS_SOURCE', PK_WOONDER_ORDERS_PATH . 'src' );
        define( 'PK_WOONDER_ORDERS_VENDOR', PK_WOONDER_ORDERS_PATH . 'vendor' );
    }

    /**
     * Load and define the custom post types
     *
     * @since  1.0.0
     * @access private
     * @return void
     */
    private function register_custom_post_types() {

        require_once PK_WOONDER_ORDERS_INCLUDES . '/registers/custom-status.php';

    }

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Pk_Woonder_Orders_Loader. Orchestrates the hooks of the plugin.
	 * - Pk_Woonder_Orders_i18n. Defines internationalization functionality.
	 * - Pk_Woonder_Orders_Admin. Defines all hooks for the admin area.
	 * - Pk_Woonder_Orders_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {
        /**
         * Load PSR-4 Autoloader
         */
        require_once PK_WOONDER_ORDERS_VENDOR  . '/autoload.php';

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once PK_WOONDER_ORDERS_INCLUDES . '/class-pk-woonder-orders-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once PK_WOONDER_ORDERS_INCLUDES . '/class-pk-woonder-orders-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once PK_WOONDER_ORDERS_ADMIN . '/class-pk-woonder-orders-admin.php';

		/**
		 * The class responsible for defining the dashboard navigation items.
		 */
		require_once PK_WOONDER_ORDERS_ADMIN . '/class-pk-woonder-orders-admin-menu.php';

        /**
         * The class responsible of load all the backend actions.
         */
        require_once PK_WOONDER_ORDERS_SOURCE . '/WoonderOrders.php';

		/**
		 * Load the Woonder Orders Loader
		 */
		$this->loader = new Pk_Woonder_Orders_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Pk_Woonder_Orders_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Pk_Woonder_Orders_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Pk_Woonder_Orders_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register the navigations items in the dashboard.
	 *
	 * @since 	1.0.0
	 * @access  private
	 */
	private function define_admin_navs() {

		$admin_navs = new Pk_Woonder_Orders_Admin_Menu( $this->get_plugin_name(), $this->get_version() );

	    $this->loader->add_action( 'admin_menu', $admin_navs, 'pages' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Pk_Woonder_Orders_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
