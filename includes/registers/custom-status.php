<?php

/**
 *
 * Register custom post type to can manage all the custom status
 *
 * @since  1.0.0
 *
 * @return void
 *
 */
function pk_woonder_custom_status() {

    $labels = array(
        'name'                  => _x( 'Custom Status', 'Post Type General Name', 'pk-woonder-orders' ),
        'singular_name'         => _x( 'Custom Status', 'Post Type Singular Name', 'pk-woonder-orders' ),
        'menu_name'             => __( 'Custom Status', 'pk-woonder-orders' ),
        'name_admin_bar'        => __( 'Custom Status', 'pk-woonder-orders' ),
        'archives'              => __( 'Item Archives', 'pk-woonder-orders' ),
        'attributes'            => __( 'Item Attributes', 'pk-woonder-orders' ),
        'parent_item_colon'     => __( 'Parent Item:', 'pk-woonder-orders' ),
        'all_items'             => __( 'All Items', 'pk-woonder-orders' ),
        'add_new_item'          => __( 'Add New Item', 'pk-woonder-orders' ),
        'add_new'               => __( 'Add New', 'pk-woonder-orders' ),
        'new_item'              => __( 'New Item', 'pk-woonder-orders' ),
        'edit_item'             => __( 'Edit Item', 'pk-woonder-orders' ),
        'update_item'           => __( 'Update Item', 'pk-woonder-orders' ),
        'view_item'             => __( 'View Item', 'pk-woonder-orders' ),
        'view_items'            => __( 'View Items', 'pk-woonder-orders' ),
        'search_items'          => __( 'Search Item', 'pk-woonder-orders' ),
        'not_found'             => __( 'Not found', 'pk-woonder-orders' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'pk-woonder-orders' ),
        'featured_image'        => __( 'Featured Image', 'pk-woonder-orders' ),
        'set_featured_image'    => __( 'Set featured image', 'pk-woonder-orders' ),
        'remove_featured_image' => __( 'Remove featured image', 'pk-woonder-orders' ),
        'use_featured_image'    => __( 'Use as featured image', 'pk-woonder-orders' ),
        'insert_into_item'      => __( 'Insert into item', 'pk-woonder-orders' ),
        'uploaded_to_this_item' => __( 'Uploaded to this item', 'pk-woonder-orders' ),
        'items_list'            => __( 'Items list', 'pk-woonder-orders' ),
        'items_list_navigation' => __( 'Items list navigation', 'pk-woonder-orders' ),
        'filter_items_list'     => __( 'Filter items list', 'pk-woonder-orders' ),
    );
    $args = array(
        'label'                 => __( 'Custom Status', 'pk-woonder-orders' ),
        'description'           => __( 'WooCommerce Custom Status', 'pk-woonder-orders' ),
        'labels'                => $labels,
        'supports'              => array( 'title' ),
        'hierarchical'          => false,
        'public'                => false,
        'show_ui'               => false,
        'show_in_menu'          => false,
        'menu_position'         => 5,
        'show_in_admin_bar'     => false,
        'show_in_nav_menus'     => false,
        'can_export'            => false,
        'has_archive'           => false,
        'exclude_from_search'   => true,
        'publicly_queryable'    => true,
        'query_var'             => 'pk-custom-status',
        'rewrite'               => false,
        'capability_type'       => 'page',
    );
    register_post_type( 'pk_custom_status', $args );

}

add_action( 'init', 'pk_woonder_custom_status', 0 );
