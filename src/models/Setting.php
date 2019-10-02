<?php

namespace GWS\WoonderOrders\Models;

/**
 * This file manage the Setting Model
 *
 * A difinition to manage Setting Stuffs
 *
 * @link       https://github.com/dgaitan
 * @since      1.0.0
 *
 * @package    GWS/WoonderOrders
 * @subpackage GWS/WoonderOrders/Models
 */

defined( 'ABSPATH' ) || exit;

/**
 * Setting Model
 *
 * This model manage the plugin settings.
 *
 * @since      1.0.0
 * @package    GWS/WoonderOrders
 * @subpackage GWS/WoonderOrders/Models
 * @author     David Gaitán <jdavid.gaitan@gmail.com>
 */
class Setting {

	/**
	 * The Version Slug
	 *
	 * @var string
	 */
	public $version_slug = 'pk_woonder_orders_settings_version';

	/**
	 * The Setting Slug
	 *
	 * @var string
	 */
	public $setting_slug = 'pk_woonder_orders_settings_';

	/**
	 * The Setting Version.
	 * To can manage settings update
	 *
	 * @var string
	 */
	public $version = '1.0.4';

	/**
	 * Default Settings
	 *
	 * @var array
	 */
	public $default_settings = array();

	/**
	 * Settings Stored in db
	 * @var array
	 */
	public $settings_stored = array();

	/**
	 * Construct of the Settings Model
	 *
	 * @since  1.0.0
	 * @return  void
	 */
	public function __construct() {
		$this->load_or_create_settings();
	}

	/**
	 * Load the settings, in case it does not exist,
	 * Create it!
	 *
	 * @return void - Just store the settings.
	 */
	public function load_or_create_settings() {
		$this->load_default_settings();

		$settings = get_option( $this->setting_slug, false );
		$version = get_option( $this->version_slug, false );

		if ( ! $version ) {
			update_option( $this->version_slug, $this->version );
			$this->settings_stored = $this->default_settings;
			return;
		}


		if ( $settings && $version === $this->version ) {
			$this->settings_stored = $settings;
		} else {
			$settings = is_array( $settings ) ? $this->merge_settings( $settings ) : $this->default_settings;
			update_option( $this->setting_slug, $settings );
			update_option( $this->version_slug, $this->version );
			$this->settings_stored = get_option( $this->setting_slug, false );
		}

	}

	/**
	 * Return all settings stored
	 *
	 * @return array
	 */
	public function all() {
		return $this->settings_stored;
	}

	/**
	 * Update Settings
	 *
	 * @param  array $settings - The Settings updated ready to save into db
	 * @return array $settings - The settings updated.
	 */
	public function update_settings( $settings ) {
		update_option( $this->setting_slug, $settings );
		return get_option( $this->setting_slug, false );
	}

	/**
	 * Merge settings.
	 *
	 * Load the settings stored in db
	 * and merge it with the default settings
	 * in case exist new fields settings
	 *
	 * @param  array $settings - The Current Settings
	 * @return array $settings
	 */
	public function merge_settings( $settings ) {
		$result = array();

		foreach ( $settings as $key => $value ) {
			$this->default_settings[$key]['value'] = $value['value'];
		}

		return $this->default_settings;
	}

	/**
	 * Setup the default settings
	 *
	 * @return void
	 */
	public function load_default_settings() {
		$this->default_settings = array(
			'default_status_filter' => array(
				'id'		=> 'default_status_filter',
				'label' 	=> __( 'Default Filter', PK_PLUGIN_NAME ),
				'value' 	=> array(
					'id' 	=> '',
					'name' 	=> ''
				),
				'type'		=> 'single_select',
				'options'	=> wc_get_order_statuses(),
				'help_text' => __( 'Select a default status to show in the order list', PK_PLUGIN_NAME ),
			),
			'orders_per_page' => array(
				'id'		=> 'orders_per_page',
				'label'		=> __( 'Orders Per Page', PK_PLUGIN_NAME ),
				'value' 	=> 20,
				'type'		=> 'numeric',
				'help_text' => __( 'Define the orders items per page do you want to see.', PK_PLUGIN_NAME )
			),
			'col_order_id' => array(
				'id'		=> 'col_order_id',
				'label' 	=> __( 'Show Order id Colun', PK_PLUGIN_NAME ),
				'value'		=> true,
				'type'		=> 'boolean',
				'help_text' => __( 'Check if do you want to show the Order id in the orders table.', PK_PLUGIN_NAME )
			),
			'col_customer' => array(
				'id'		=> 'col_customer',
				'label'		=> __( 'Show Customer Column', PK_PLUGIN_NAME ),
				'value' 	=> true,
				'type'		=> 'boolean',
				'help_text' => __( 'Check if do you want to show the Customer in the orders table', PK_PLUGIN_NAME )
			),
			'col_date' => array(
				'id'		=> 'col_date',
				'label'		=> __( 'Show Created Date Column', PK_PLUGIN_NAME ),
				'value' 	=> true,
				'type'		=> 'boolean',
				'help_text' => __( 'Check if do you want to show the order created date in the orders table', PK_PLUGIN_NAME )
			),
			'col_status' => array(
				'id'		=> 'col_status',
				'label'		=> __( 'Show Status Column', PK_PLUGIN_NAME ),
				'value' 	=> true,
				'type'		=> 'boolean',
				'help_text' => __( 'Check if do you want to show the status in the orders table', PK_PLUGIN_NAME )
			),
			'col_total' => array(
				'id'		=> 'col_total',
				'label'		=> __( 'Show Total Column', PK_PLUGIN_NAME ),
				'value' 	=> true,
				'type'		=> 'boolean',
				'help_text' => __( 'Check if do you want to show the total in the orders table', PK_PLUGIN_NAME )
			),
			'col_subtotal' => array(
				'id'		=> 'col_subtotal',
				'label'		=> __( 'Show Sub-Total Column', PK_PLUGIN_NAME ),
				'value' 	=> true,
				'type'		=> 'boolean',
				'help_text' => __( 'Check if do you want to show the sub-total in the orders table', PK_PLUGIN_NAME )
			),
			'col_shipping_address' => array(
				'id'		=> 'col_shipping_address',
				'label'		=> __( 'Show Shipping Address Column', PK_PLUGIN_NAME ),
				'value' 	=> true,
				'type'		=> 'boolean',
				'help_text' => __( 'Check if do you want to show the shipping address in the orders table', PK_PLUGIN_NAME )
			),
			'col_billing_address' => array(
				'id'		=> 'col_billing_address',
				'label'		=> __( 'Show Billing Address Column', PK_PLUGIN_NAME ),
				'value' 	=> true,
				'type'		=> 'boolean',
				'help_text' => __( 'Check if do you want to show the billing address in the orders table', PK_PLUGIN_NAME )
			),
			'col_email' => array(
				'id'		=> 'col_email',
				'label'		=> __( 'Show Email Address Column', PK_PLUGIN_NAME ),
				'value' 	=> true,
				'type'		=> 'boolean',
				'help_text' => __( 'Check if do you want to show the email address in the orders table', PK_PLUGIN_NAME )
			),
			'col_shipping_method' => array(
				'id'		=> 'col_shipping_method',
				'label'		=> __( 'Show Shipping Method Column', PK_PLUGIN_NAME ),
				'value' 	=> true,
				'type'		=> 'boolean',
				'help_text' => __( 'Check if do you want to show the shipping method in the orders table', PK_PLUGIN_NAME )
			),
			'col_phone' => array(
				'id'		=> 'col_phone',
				'label'		=> __( 'Show Phone Column', PK_PLUGIN_NAME ),
				'value' 	=> true,
				'type'		=> 'boolean',
				'help_text' => __( 'Check if do you want to show the phone in the orders table', PK_PLUGIN_NAME )
			),
			'col_product_items' => array(
				'id'		=> 'col_product_items',
				'label'		=> __( 'Show Product Items Column', PK_PLUGIN_NAME ),
				'value' 	=> true,
				'type'		=> 'boolean',
				'help_text' => __( 'Check if do you want to show the products related with the order in the orders table', PK_PLUGIN_NAME )
			),
			'col_order_notes' => array(
				'id'		=> 'col_order_notes',
				'label'		=> __( 'Show Order Notes Column', PK_PLUGIN_NAME ),
				'value' 	=> true,
				'type'		=> 'boolean',
				'help_text' => __( 'Check if do you want to show the orders in the orders table', PK_PLUGIN_NAME )
			),
			'col_private_notes' => array(
				'id'		=> 'col_private_notes',
				'label'		=> __( 'Show Private Notes Column', PK_PLUGIN_NAME ),
				'value' 	=> true,
				'type'		=> 'boolean',
				'help_text' => __( 'Check if do you want to show the private notes in the orders table', PK_PLUGIN_NAME )
			)
		);
	}
}
