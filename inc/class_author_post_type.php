<?php

/**
 * wooa_author_post_type class.
 *
 * This class is for registering woocommerce-author post type
 *
 * @package wooa_admin_inputs
 * @version 1.0
 *
*/
class wooa_author_post_type
{

	/**
	 *
	 * Class constructor function which call 'register_woocommerce_author_post_type' function on 'init' action
	 *
	 *
	 */
    public function __construct(){

        add_action( 'init' , array( $this , 'register_woocommerce_author_post_type' ) );

    }


	/**
	 *
	 * Register woocommerce-author post type
	 *
	 * First it will get 'wooa_url_slug' option which is a url slug for this post type that users can change in admin
	 * panel >> settings >> permalink , then it will set a default value for it , then we set label and args for
	 * 'register_post_type' function to register our custom post type named 'woocommerce-author'
	 *
	 * @return void
	 *
	 */
    public function register_woocommerce_author_post_type():void{

        $wooa_detail_slug = get_option('wooa_url_slug') ;

        $wooa_detail_slug = $wooa_detail_slug && $wooa_detail_slug != '' ? $wooa_detail_slug : 'woocommerce-author';

        $labels = array(
            'name'                  => _x( 'WooCommerce Author', 'Post type general name', WOOA_TEXT_DOMAIN ),
            'singular_name'         => _x( 'WooCommerce Author', 'Post type singular name', WOOA_TEXT_DOMAIN ),
            'menu_name'             => _x( 'WooCommerce Authors', 'Admin Menu text', WOOA_TEXT_DOMAIN ),
            'name_admin_bar'        => _x( 'WooCommerce Author', 'Add New on Toolbar', WOOA_TEXT_DOMAIN ),
            'add_new'               => __( 'Add New', WOOA_TEXT_DOMAIN ),
            'add_new_item'          => __( 'Add New recipe', WOOA_TEXT_DOMAIN ),
            'new_item'              => __( 'New WooCommerce Author', WOOA_TEXT_DOMAIN ),
            'edit_item'             => __( 'Edit WooCommerce Author', WOOA_TEXT_DOMAIN ),
            'view_item'             => __( 'View WooCommerce Author', WOOA_TEXT_DOMAIN ),
            'all_items'             => __( 'All WooCommerce Author', WOOA_TEXT_DOMAIN ),
            'search_items'          => __( 'Search WooCommerce Author', WOOA_TEXT_DOMAIN ),
            'parent_item_colon'     => __( 'Parent WooCommerce Author:', WOOA_TEXT_DOMAIN ),
            'not_found'             => __( 'No WooCommerce Author found.', WOOA_TEXT_DOMAIN ),
            'not_found_in_trash'    => __( 'No WooCommerce Author found in Trash.', WOOA_TEXT_DOMAIN ),
            'featured_image'        => _x( 'Author Profile Picture', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', WOOA_TEXT_DOMAIN ),
            'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', WOOA_TEXT_DOMAIN ),
            'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', WOOA_TEXT_DOMAIN ),
            'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', WOOA_TEXT_DOMAIN ),
            'archives'              => _x( 'WooCommerce Author archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', WOOA_TEXT_DOMAIN ),
            'insert_into_item'      => _x( 'Insert into WooCommerce Author', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', WOOA_TEXT_DOMAIN ),
            'uploaded_to_this_item' => _x( 'Uploaded to this WooCommerce Author', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', WOOA_TEXT_DOMAIN ),
            'filter_items_list'     => _x( 'Filter WooCommerce Author list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', WOOA_TEXT_DOMAIN ),
            'items_list_navigation' => _x( 'WooCommerce Author list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', WOOA_TEXT_DOMAIN ),
            'items_list'            => _x( 'WooCommerce Author list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', WOOA_TEXT_DOMAIN ),
        );

        $args = array(
            'labels'             => $labels,
            'description'        => 'Add Author To WooCommerce Plugin',
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'menu_icon'         =>  'dashicons-universal-access',
            'rewrite'            => array( 'slug' => $wooa_detail_slug ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'      => false,
            'menu_position'      => 90,
            'supports'           => array( 'title','thumbnail','editor' ),
            'show_in_rest'       => true
        );


        register_post_type( 'woocommerce-author', $args );


    }

}

/* Creating a clone of wooa_author_post_type class */
if ( !post_type_exists('woocommerce-author') && class_exists('wooa_author_post_type') ){

    $wooa_author_post_type = new wooa_author_post_type();

}