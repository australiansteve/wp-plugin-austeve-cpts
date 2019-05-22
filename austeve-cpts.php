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

		//Register post types
		add_action( 'init', array($this, 'austeve_create_conditions_post_type'), 0 );

	}

	function austeve_create_conditions_post_type() {

		// Set UI labels for Custom Post Type
		$labels = array(
			'name'                => _x( 'Conditions', 'Post Type General Name', 'austeve-cpts' ),
			'singular_name'       => _x( 'Condition', 'Post Type Singular Name', 'austeve-cpts' ),
			'menu_name'           => __( 'Conditions', 'austeve-cpts' ),
			'all_items'           => __( 'All Conditions', 'austeve-cpts' ),
			'view_item'           => __( 'View Condition', 'austeve-cpts' ),
			'add_new_item'        => __( 'Add New Condition', 'austeve-cpts' ),
			'add_new'             => __( 'Add New', 'austeve-cpts' ),
			'edit_item'           => __( 'Edit Condition', 'austeve-cpts' ),
			'update_item'         => __( 'Update Condition', 'austeve-cpts' ),
			'search_items'        => __( 'Search Conditions', 'austeve-cpts' ),
			'not_found'           => __( 'Not Found', 'austeve-cpts' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'austeve-cpts' ),
		);
		
		// Set other options for Custom Post Type		
		$args = array(
			'label'               => __( 'Conditions', 'austeve-cpts' ),
			'description'         => __( 'Conditions', 'austeve-cpts' ),
			'labels'              => $labels,
			// Features this CPT supports in Post Editor
			'supports'            => array( 'title', 'author', 'revisions', 'editor', 'thumbnail'),
			// You can associate this CPT with a taxonomy or custom taxonomy. 
			'taxonomies'          => array( ),
			/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/	
			'hierarchical'        => false,
			'rewrite'           => array( 'slug' => 'conditions' ),
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'show_in_rest'  	=> true,
			'capability_type'    => 'post',
			'menu_icon'				=> 'dashicons-plus',
		);
		
		// Registering your Custom Post Type
		register_post_type( 'austeve-conditions', $args );
	}

}

// Create CPTs!
$austeveCPTs = new AUSteve_CPTs();

?>
