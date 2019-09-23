<?php

namespace PoetKods\WoonderOrders\Abstracts;

/**
 * Abstract Model
 *
 * @link       https://github.com/dgaitan
 * @since      1.0.0
 *
 * @package    PoetKods/WoonderOrders
 * @subpackage PoetKods/WoonderOrders/Abstracts
 */

defined( 'ABSPATH' ) || exit;

/**
 * Absctract class to handle main logic of Models.
 *
 * Save fields, Create fields, delete fields,
 * update stuffs, all related with model stuffs.
 *
 * @package    PoetKods/WoonderOrders
 * @subpackage PoetKods/WoonderOrders/Abstracts
 * @author     David Gaitán <jdavid.gaitan@gmail.com>
 */
abstract class AbstractModel {

	/**
	 * Model Slug
	 *
	 * The post type slug used to
	 * register the custom post type
	 *
	 */
	public $model_slug = '';

	/**
	 * Model Fields
	 *
	 * @var $fields
	 */
	private $fields = array();

	/**
	 * Object Data array.
	 *
	 * This will contain the data by a simple object
	 *
	 * @since 1.0.0
	 * @var array
	 */
	protected $data = array();

	/**
	 * A collection of elements
	 *
	 * When a use a where clause, this var
	 * will have all data.
	 *
	 * @var array
	 */
	protected $items = array();

	/**
	 * The Construct of the model
	 */
	public function __construct( $model_slug, $fields ) {

		$this->model_slug = $model_slug;
		$this->fields = $fields;
	}

	/**
	 * Create a new record
	 *
	 * @param  array  $fields - Fields to save
	 * @return object $object - The Object created.
	 */
	public function create( $fields = array() ) {

		$defaults = array(
			'post_title' => $fields['name'],
			'post_type' => $this->model_slug,
			'post_status' => 'publish'
		);

		$object_id = wp_insert_post( $defaults );

		$this->add_custom_fields( $object_id, $fields );

		$object = $this->get( $object_id );

		return $object;

	}

	/**
	 * Get an Object
	 *
	 * @param  integer $id - The model ID
	 * @return array $object - The Object to return.
	 */
	public function get( $id ) {

		try {
			/**
			 * Try return the post
			 */
			$object = get_post( $id );

			if ( ! $object ) {
				throw new Exception("Error trying to get the object", 1);
			}

			$object = $object->to_array();

			// Set the custom fields to the object
			foreach ( $this->fields as $field ) {
				$object[$field] = get_post_meta( $id, $field, true );
			}

			return $object;

		} catch (Exception $e) {

			return $e->getMessage();

		}

	}

	/**
	 * Get elements with where clause
	 *
	 * @param  array $args - The arguments
	 * @return array $objects - The objects to return.
	 */
	public function where( $args = array() ) {
		$args = $this->parse_args( $args );
		$objects = get_posts( $args );
		$objects = $this->prepare_data( $objects );
		return $objects;
	}

	/**
	 * Parse Args
	 *
	 * @param  array  $args the custom args
	 * @return arry The args parsed
	 */
	public function parse_args( $args = array() ) {
		$default_args = array(
			'post_type' => $this->model_slug,
			'post_status' => 'publish'
		);

		$args = wp_parse_args( $args, $default_args );

		return $args;
	}

	/**
	 * Set the fields to create or update
	 *
	 * @param integer $id -  Model Object ID
	 * @param array $fields - The Fields to save
	 */
	public function add_custom_fields( $id, $fields ) {

		foreach ( $fields as $field => $value ) {
			update_post_meta(
				$id,
				"{$this->model_slug}_{$field}",
				$value
			);
		}
	}

	/**
	 * Prepare data and add it to items
	 *
	 * @param  array $objects - A colleection of objects
	 * @return arrat $object - The data parsed to be returned
	 */
	private function prepare_data( $objects ) {

		if ( $objects ) {
			foreach ( $objects as $object ) {
				$item = $object->to_array();

				// Add custom field if exist
				if ( $this->fields ) {
					foreach ( $this->fields as $field ) {
						$item[$field] = get_post_meta( $item['ID'], $field, true );
					}
				}

				$this->items[] = $item;
			}
		}

		return $this->items;
	}
}
