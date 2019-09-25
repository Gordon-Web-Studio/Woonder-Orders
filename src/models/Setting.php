<?php

namespace PoetKods\WoonderOrders\Models;

/**
 * This file manage the Setting Model
 *
 * A difinition to manage Setting Stuffs
 *
 * @link       https://github.com/dgaitan
 * @since      1.0.0
 *
 * @package    PoetKods/WoonderOrders
 * @subpackage PoetKods/WoonderOrders/Models
 */

defined( 'ABSPATH' ) || exit;

/**
 * Setting Model
 *
 * This model manage the plugin settings.
 *
 * @since      1.0.0
 * @package    PoetKods/WoonderOrders
 * @subpackage PoetKods/WoonderOrders/Models
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
	public $version = '1.0.1';

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

		return $this->settings_stored = $settings;


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
			'col_order_id' => array(
				'id'		=> 'col_order_id',
				'label' 	=> __( 'Show Order id', PK_PLUGIN_NAME ),
				'value'		=> true,
				'type'		=> 'boolean',
				'help_text' => __( 'Check if do you want to show the Order id in the orders table.', PK_PLUGIN_NAME )
			),
			'col_customer' => array(
				'id'		=> 'col_customer',
				'label'		=> __( 'Show Customer', PK_PLUGIN_NAME ),
				'value' 	=> true,
				'type'		=> 'boolean',
				'help_text' => __( 'Check if do you want to show the Customer in the orders table', PK_PLUGIN_NAME )
			),
			'col_date' => array(
				'id'		=> 'col_date',
				'label'		=> __( 'Show Created Date', PK_PLUGIN_NAME ),
				'value' 	=> true,
				'type'		=> 'boolean',
				'help_text' => __( 'Check if do you want to show the order created date in the orders table', PK_PLUGIN_NAME )
			)
		);
	}
}
