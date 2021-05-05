<?php

/*
Plugin Name: Custom Post Types
Plugin URI: https://github.com/australiansteve/austeve-cpts
Description: Custom Post Types for PeterRowan.ca
Version: 1.0.0
Author: AustralianSteve
Author URI: http://australiansteve.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

class AUSteve_CPTs_PeterRowan {

	function __construct() {

		//Register post types
		add_action( 'init', array($this, 'austeve_create_post_type_projects'), 0 );

		//Register custom taxonomies
		add_action( 'init', array($this, 'austeve_create_taxonomies'), 0 );

	}

	function austeve_create_taxonomies() {

		$labels = array(
			'name'                       => _x( 'Project Categories', 'taxonomy general name', 'austeve-cpts' ),
			'singular_name'              => _x( 'Project Category', 'taxonomy singular name', 'austeve-cpts' ),
			'search_items'               => __( 'Search Project Categories', 'austeve-cpts' ),
			'popular_items'              => __( 'Popular Project Categories', 'austeve-cpts' ),
			'all_items'                  => __( 'All Project Categories', 'austeve-cpts' ),
			'parent_item'       			=> __( 'Parent Project Category', 'austeve-cpts' ),
			'parent_item_colon' 			=> __( 'Parent Project Category:', 'austeve-cpts' ),
			'edit_item'                  => __( 'Edit Project Category', 'austeve-cpts' ),
			'update_item'                => __( 'Update Project Category', 'austeve-cpts' ),
			'add_new_item'               => __( 'Add New Project Category', 'austeve-cpts' ),
			'new_item_name'              => __( 'New Project Category Name', 'austeve-cpts' ),
			'separate_items_with_commas' => __( 'Separate project categories with commas', 'austeve-cpts' ),
			'add_or_remove_items'        => __( 'Add or remove project categories', 'austeve-cpts' ),
			'choose_from_most_used'      => __( 'Choose from the most used project categories', 'austeve-cpts' ),
			'not_found'                  => __( 'No project categories found.', 'austeve-cpts' ),
			'menu_name'                  => __( 'Project Categories', 'austeve-cpts' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'show_in_rest'		=> true,
			'rewrite'               => array( 'slug' => 'project-category' ),
		);

		register_taxonomy( 'project-category', 'austeve-projects', $args );

	}

	function austeve_create_post_type_projects() {

		
		// Set UI labels for Custom Post Type
		$labels = array(
			'name'                => _x( 'Projects', 'Post Type General Name', 'austeve-cpts' ),
			'singular_name'       => _x( 'Project', 'Post Type Singular Name', 'austeve-cpts' ),
			'menu_name'           => __( 'Projects', 'austeve-cpts' ),
			'all_items'           => __( 'All Projects', 'austeve-cpts' ),
			'view_item'           => __( 'View Project', 'austeve-cpts' ),
			'add_new_item'        => __( 'Add New Project', 'austeve-cpts' ),
			'add_new'             => __( 'Add New', 'austeve-cpts' ),
			'edit_item'           => __( 'Edit Project', 'austeve-cpts' ),
			'update_item'         => __( 'Update Project', 'austeve-cpts' ),
			'search_items'        => __( 'Search Projects', 'austeve-cpts' ),
			'not_found'           => __( 'Not Found', 'austeve-cpts' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'austeve-cpts' ),
		);
		
		// Set other options for Custom Post Type		
		$args = array(
			'label'               => __( 'Projects', 'austeve-cpts' ),
			'description'         => __( 'Projects', 'austeve-cpts' ),
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
			'rewrite'           => array( 'slug' => 'projects' ),
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
			'menu_icon'				=> 'dashicons-admin-appearance',
		);
		
		// Registering your Custom Post Type
		register_post_type( 'austeve-projects', $args );

	}

}

// Create CPTs!
$austeveCPTsPeterRowan = new AUSteve_CPTs_PeterRowan();

?>
