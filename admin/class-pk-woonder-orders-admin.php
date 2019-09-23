<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/dgaitan
 * @since      1.0.0
 *
 * @package    Pk_Woonder_Orders
 * @subpackage Pk_Woonder_Orders/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Pk_Woonder_Orders
 * @subpackage Pk_Woonder_Orders/admin
 * @author     David Gaitán <jdavid.gaitan@gmail.com>
 */
class Pk_Woonder_Orders_Admin {

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
	 * Page Slugs
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $page_slugs  The pages slugs to can load assets
	 */
	private $page_slugs;

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
		$this->page_slugs = array(
			'toplevel_page_woonder-orders'
		);

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		/**
		 * If isn't the woonder orders page
		 * doesn't load the css file.
		 */
		if ( ! in_array( get_current_screen()->id, $this->page_slugs ) ) {
			return;
		}

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pk_Woonder_Orders_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pk_Woonder_Orders_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/styles.css', array(), date('Ymdhs'), 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * If isn't the woonder orders page
		 * doesn't load the js file.
		 */
		if ( ! in_array( get_current_screen()->id, $this->page_slugs ) ) {
			return;
		}

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pk_Woonder_Orders_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pk_Woonder_Orders_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( 'wp-color-picker' );

		wp_enqueue_script( 'pk-vue-js', 'https://cdn.jsdelivr.net/npm/vue/dist/vue.js' );

		wp_enqueue_script(
			'pk-pooper',
			'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js',
			array( 'jquery' ),
			date( 'Ymdhs' ),
			true
		);

		wp_enqueue_script(
			'pk-bootstrap-file',
			'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js',
			array( 'jquery' ),
			date( 'Ymdhs' ),
			true
		);

		wp_enqueue_script(
			$this->plugin_name . '-admin',
			plugin_dir_url( __FILE__ ) . 'js/pk-woonder-orders-admin.js',
			array( 'jquery', 'wp-color-picker' ),
			date('Ymdhs'),
			true
		);

		if ( 'toplevel_page_woonder-orders' === get_current_screen()->id ) {

			wp_enqueue_script(
				$this->plugin_name . '-handler',
				plugin_dir_url( __FILE__ ) . 'js/pk-woonder-orders.js',
				array( 'jquery' ),
				date('Ymdhs'),
				true
			);

		}

	}

}
