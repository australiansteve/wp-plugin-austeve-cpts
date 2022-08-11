<?php

/*
Plugin Name: Custom Post Types
Plugin URI: https://github.com/australiansteve/austeve-cpts
Description: Initialize Custom Post Types
Version: 1.0.0
Author: AustralianSteve
Author URI: http://australiansteve.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

class AUSteve_CPTs {

	function __construct() {

		//Register Menu 
		add_action( 'admin_menu',  array($this, 'wpse_226690_admin_menu') );

		//Register post types
		add_action( 'init', array($this, 'austeve_create_post_type_wishlists'), 0 );
		add_action( 'init', array($this, 'austeve_create_post_type_schools'), 0 );
		add_action( 'init', array($this, 'austeve_create_post_type_teachers'), 0 );

		//Register custom taxonomies
		add_action( 'init', array($this, 'austeve_create_taxonomies'), 0 );

	}

	function austeve_create_taxonomies() {

		$labels = array(
			'name'                       => _x( 'Wishlist Categories', 'taxonomy general name', 'austeve-cpts' ),
			'singular_name'              => _x( 'Wishlist Category', 'taxonomy singular name', 'austeve-cpts' ),
			'search_items'               => __( 'Search Wishlist Categories', 'austeve-cpts' ),
			'popular_items'              => __( 'Popular Wishlist Categories', 'austeve-cpts' ),
			'all_items'                  => __( 'All Wishlist Categories', 'austeve-cpts' ),
			'parent_item'       			=> __( 'Parent Wishlist Category', 'austeve-cpts' ),
			'parent_item_colon' 			=> __( 'Parent Wishlist Category:', 'austeve-cpts' ),
			'edit_item'                  => __( 'Edit Wishlist Category', 'austeve-cpts' ),
			'update_item'                => __( 'Update Wishlist Category', 'austeve-cpts' ),
			'add_new_item'               => __( 'Add New Wishlist Category', 'austeve-cpts' ),
			'new_item_name'              => __( 'New Wishlist Category Name', 'austeve-cpts' ),
			'separate_items_with_commas' => __( 'Separate wishlist categories with commas', 'austeve-cpts' ),
			'add_or_remove_items'        => __( 'Add or remove wishlist categories', 'austeve-cpts' ),
			'choose_from_most_used'      => __( 'Choose from the most used wishlist categories', 'austeve-cpts' ),
			'not_found'                  => __( 'No wishlist categories found.', 'austeve-cpts' ),
			'menu_name'                  => __( 'Wishlist Categories', 'austeve-cpts' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'show_in_rest'		=> true,
			'rewrite'               => array( 'slug' => 'wishlist-category' ),
		);

		register_taxonomy( 'wishlist-category', 'austeve-wishlists', $args );
	}

	function austeve_create_post_type_wishlists() {

		
		// Set UI labels for Custom Post Type
		$labels = array(
			'name'                => _x( 'Wishlists', 'Post Type General Name', 'austeve-cpts' ),
			'singular_name'       => _x( 'Wishlist', 'Post Type Singular Name', 'austeve-cpts' ),
			'menu_name'           => __( 'Wishlists', 'austeve-cpts' ),
			'all_items'           => __( 'Wishlists', 'austeve-cpts' ),
			'view_item'           => __( 'View Wishlist', 'austeve-cpts' ),
			'add_new_item'        => __( 'Add New Wishlist', 'austeve-cpts' ),
			'add_new'             => __( 'Add New', 'austeve-cpts' ),
			'edit_item'           => __( 'Edit Wishlist', 'austeve-cpts' ),
			'update_item'         => __( 'Update Wishlist', 'austeve-cpts' ),
			'search_items'        => __( 'Search Wishlists', 'austeve-cpts' ),
			'not_found'           => __( 'Not Found', 'austeve-cpts' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'austeve-cpts' ),
		);
		
		// Set other options for Custom Post Type		
		$args = array(
			'label'               => __( 'Wishlists', 'austeve-cpts' ),
			'description'         => __( 'Wishlists', 'austeve-cpts' ),
			'labels'              => $labels,
			// Features this CPT supports in Post Editor
			'supports'            => array( 'title', 'revisions', 'thumbnail'),
			// You can associate this CPT with a taxonomy or custom taxonomy. 
			'taxonomies'    => array(
		        'wishlist-category'
		    ),
			/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/	
			'hierarchical'        => false,
			'rewrite'           => array( 'slug' => 'wishlists' ),
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => 'wishlists',
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'show_in_rest'  	=> true,
			'capability_type'    => 'post',
		);
		
		// Registering your Custom Post Type
		register_post_type( 'austeve-wishlists', $args );

	}

	function austeve_create_post_type_schools() {

		// Set UI labels for Custom Post Type
		$labels = array(
			'name'                => _x( 'Schools', 'Post Type General Name', 'austeve-cpts' ),
			'singular_name'       => _x( 'School', 'Post Type Singular Name', 'austeve-cpts' ),
			'menu_name'           => __( 'Schools', 'austeve-cpts' ),
			'all_items'           => __( 'Schools', 'austeve-cpts' ),
			'view_item'           => __( 'View School', 'austeve-cpts' ),
			'add_new_item'        => __( 'Add New School', 'austeve-cpts' ),
			'add_new'             => __( 'Add New', 'austeve-cpts' ),
			'edit_item'           => __( 'Edit School', 'austeve-cpts' ),
			'update_item'         => __( 'Update School', 'austeve-cpts' ),
			'search_items'        => __( 'Search Schools', 'austeve-cpts' ),
			'not_found'           => __( 'Not Found', 'austeve-cpts' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'austeve-cpts' ),
		);
		
		// Set other options for Custom Post Type		
		$args = array(
			'label'               => __( 'Schools', 'austeve-cpts' ),
			'description'         => __( 'Schools', 'austeve-cpts' ),
			'labels'              => $labels,
			// Features this CPT supports in Post Editor
			'supports'            => array( 'title', 'thumbnail'),
			// You can associate this CPT with a taxonomy or custom taxonomy. 
			'taxonomies'          => array( ),
			/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/	
			'hierarchical'        => false,
			'rewrite'           => array( 'slug' => 'schools' ),
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => 'wishlists',
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'show_in_rest'  	=> true,
			'capability_type'    => 'post',
		);
		
		// Registering your Custom Post Type
		register_post_type( 'austeve-schools', $args );

	}

	function austeve_create_post_type_teachers() {

		// Set UI labels for Custom Post Type
		$labels = array(
			'name'                => _x( 'Teachers', 'Post Type General Name', 'austeve-cpts' ),
			'singular_name'       => _x( 'Teacher', 'Post Type Singular Name', 'austeve-cpts' ),
			'menu_name'           => __( 'Teachers', 'austeve-cpts' ),
			'all_items'           => __( 'Teachers', 'austeve-cpts' ),
			'view_item'           => __( 'View Teacher', 'austeve-cpts' ),
			'add_new_item'        => __( 'Add New Teacher', 'austeve-cpts' ),
			'add_new'             => __( 'Add New', 'austeve-cpts' ),
			'edit_item'           => __( 'Edit Teacher', 'austeve-cpts' ),
			'update_item'         => __( 'Update Teacher', 'austeve-cpts' ),
			'search_items'        => __( 'Search Teachers', 'austeve-cpts' ),
			'not_found'           => __( 'Not Found', 'austeve-cpts' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'austeve-cpts' ),
		);
		
		// Set other options for Custom Post Type		
		$args = array(
			'label'               => __( 'Teachers', 'austeve-cpts' ),
			'description'         => __( 'Teachers', 'austeve-cpts' ),
			'labels'              => $labels,
			// Features this CPT supports in Post Editor
			'supports'            => array( 'title', 'editor'),
			// You can associate this CPT with a taxonomy or custom taxonomy. 
			'taxonomies'          => array( ),
			/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/	
			'hierarchical'        => false,
			'rewrite'           => array( 'slug' => 'teachers' ),
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => 'wishlists',
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'show_in_rest'  	=> true,
			'capability_type'    => 'post'
		);
		
		// Registering your Custom Post Type
		register_post_type( 'austeve-teachers', $args );

	}

	function wpse_226690_admin_menu() {
	    add_menu_page(
	        'Wishlists',
	        'Wishlists',
	        'read',
	        'wishlists',
	        '', // Callback, leave empty
	        'dashicons-buddicons-friends',
	        6 // Position
	    );

	    add_submenu_page( 
	    	'wishlists',
            'Wishlist Categories',
            'Wishlist Categories',
            'read',
            'edit-tags.php?taxonomy=wishlist-category&post_type=austeve-wishlists',
            null // Doesn't need a callback function.
         );
	}


}

// Create CPTs!
$austeveCPTs = new AUSteve_CPTs();

?>
