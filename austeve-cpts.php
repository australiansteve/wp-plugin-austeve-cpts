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

		//Add top level admin menu item
		add_action( 'admin_menu', array($this, 'austeve_register_menu_item') ); 

		//Register post types
		add_action( 'init', array($this, 'austeve_create_programs_post_type'), 0 );

		//Register post types
		add_action( 'init', array($this, 'austeve_create_deadline_post_type'), 0 );

		  // run after ACF saves the $_POST['fields'] data
		add_action(	'acf/save_post', array($this, 'post_title_updater'), 20);

		add_filter( 'manage_austeve-deadline_posts_columns', array($this, 'set_custom_edit_deadline_columns') );

		add_action( 'manage_austeve-deadline_posts_custom_column' , array($this, 'custom_deadline_column'), 10, 2 );

		add_filter( 'manage_edit-austeve-deadline_sortable_columns', array($this, 'sortable_deadline_column') );

	 	add_action( 'pre_get_posts', array($this, 'pre_get_deadline_posts_admin') );

	 	add_action( 'pre_get_posts', array($this, 'pre_get_deadline_posts') );

	}

	function austeve_register_menu_item() { 

		add_menu_page(
			'Grant Programs',
			'Grant Programs',
			'read',
			'grant-programs-menu',
			'',
			'dashicons-awards',
			5
		);

	}


	function austeve_create_programs_post_type() {

		// Set UI labels for Custom Post Type
		$labels = array(
			'name'                => _x( 'Grant Programs', 'Post Type General Name', 'austeve-cpts' ),
			'singular_name'       => _x( 'Grant Program', 'Post Type Singular Name', 'austeve-cpts' ),
			'menu_name'           => __( 'Grant Programs', 'austeve-cpts' ),
			'all_items'           => __( 'Grant Programs', 'austeve-cpts' ),
			'view_item'           => __( 'View Grant Program', 'austeve-cpts' ),
			'add_new_item'        => __( 'Add New Grant Program', 'austeve-cpts' ),
			'add_new'             => __( 'Add New', 'austeve-cpts' ),
			'edit_item'           => __( 'Edit Grant Program', 'austeve-cpts' ),
			'update_item'         => __( 'Update Grant Program', 'austeve-cpts' ),
			'search_items'        => __( 'Search Grant Programs', 'austeve-cpts' ),
			'not_found'           => __( 'Not Found', 'austeve-cpts' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'austeve-cpts' ),
		);
		
		// Set other options for Custom Post Type		
		$args = array(
			'label'               => __( 'Grant Programs', 'austeve-cpts' ),
			'description'         => __( 'Grant Programs', 'austeve-cpts' ),
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
			'rewrite'           => array( 'slug' => 'programs' ),
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => 'grant-programs-menu',
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'show_in_rest'  	=> true,
			'capability_type'    => 'post',
			'menu_icon'				=> 'dashicons-awards',
		);
		
		// Registering your Custom Post Type
		register_post_type( 'austeve-programs', $args );
	}

	function austeve_create_deadline_post_type() {

		// Set UI labels for Custom Post Type
		$labels = array(
			'name'                => _x( 'Deadlines', 'Post Type General Name', 'austeve-cpts' ),
			'singular_name'       => _x( 'Deadline', 'Post Type Singular Name', 'austeve-cpts' ),
			'menu_name'           => __( 'Deadlines', 'austeve-cpts' ),
			'all_items'           => __( 'Deadlines', 'austeve-cpts' ),
			'view_item'           => __( 'View Deadline', 'austeve-cpts' ),
			'add_new_item'        => __( 'Add New Deadline', 'austeve-cpts' ),
			'add_new'             => __( 'Add New', 'austeve-cpts' ),
			'edit_item'           => __( 'Edit Deadline', 'austeve-cpts' ),
			'update_item'         => __( 'Update Deadline', 'austeve-cpts' ),
			'search_items'        => __( 'Search Deadlines', 'austeve-cpts' ),
			'not_found'           => __( 'Not Found', 'austeve-cpts' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'austeve-cpts' ),
		);
		
		// Set other options for Custom Post Type		
		$args = array(
			'label'               => __( 'Deadlines', 'austeve-cpts' ),
			'description'         => __( 'Deadlines', 'austeve-cpts' ),
			'labels'              => $labels,
			// Features this CPT supports in Post Editor
			'supports'            => array( 'author' ),
			// You can associate this CPT with a taxonomy or custom taxonomy. 
			'taxonomies'          => array( ),
			/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/	
			'hierarchical'        => false,
			'rewrite'           => array( 'slug' => 'deadlines' ),
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => 'grant-programs-menu',
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'show_in_rest'  	=> true,
			'capability_type'    => 'post',
			'menu_icon'				=> 'dashicons-clock',
		);
		
		// Registering your Custom Post Type
		register_post_type( 'austeve-deadline', $args );
	}

	//Auto add and update Title field:
	function post_title_updater( $post_id ) {

		if ( get_post_type() == 'austeve-deadline' ) {

			$my_post = array();
			$my_post['ID'] = $post_id;

			$grantProgram = get_field('grant-program');
			$date = get_field('date', $post_id);

			$my_post['post_title'] = get_the_title($grantProgram);
			
			// Update the post into the database
			wp_update_post( $my_post );
		}

	}

	// Add the custom columns to the book post type:
	
	function set_custom_edit_deadline_columns($columns) {
		unset( $columns['author'] );
		unset( $columns['date'] );

		$columns['deadline'] = __( 'Deadline', 'austeve-cpts' );

		return $columns;
	}
	function sortable_deadline_column( $columns ) {
		$columns['deadline'] = 'deadline';

		return $columns;
	}

	// Add the data to the custom columns for the book post type:
	function custom_deadline_column( $column, $post_id ) {
		switch ( $column ) {

			case 'deadline' :
				$external = get_field( 'date', $post_id);
				$format = "Ymd";
				$dateobj = DateTime::createFromFormat($format, $external);

				echo $dateobj->format('dS F Y'); 
				break;

		}
	}
   
	function pre_get_deadline_posts_admin( $query ) {
		if( ! is_admin() )
			return;
	 
	    $orderby = $query->get( 'orderby');
	 
	    if( 'deadline' == $orderby ) {
	        $query->set('meta_key','date');
	        $query->set('orderby','meta_value_num');
	    }
	    else if ('austeve-deadline' == $query->get( 'post_type')) {
	    	//default ordering for deadlines
	        $query->set('meta_key','date');
	        $query->set('orderby','meta_value_num');
	        $query->set('order','ASC');
	    }


	    if ('austeve-deadline' == $query->get( 'post_type')) {
		    //add meta query to only get deadlines AFTER the 'timeout' period'

		    $days = get_field('remove_deadlines_after', 'option');
		    $startDate = (new DateTime(null, new DateTimeZone('America/Halifax')))->modify('-'.$days.' days');

		    $meta_query = array(
		    	array(
		    		'key' => 'date',
		    		'value' 	=> $startDate->format('Ymd'),
		    		'compare' 	=> '>=',
		    		'type' 	=> 'DATE'
		    	)
		    );
		    $query->set('meta_query', $meta_query);
		}
	}

	function pre_get_deadline_posts( $query ) {
		if( is_admin() )
			return;
	 
	    $orderby = $query->get( 'orderby');
	 
	    if ('austeve-deadline' == $query->get( 'post_type')) {
	    	//default ordering for deadlines
	        $query->set('meta_key', 'date');
	        $query->set('orderby', 'meta_value_num');
	        $query->set('order', 'ASC');

	        $query->set('posts_per_page', '-1'); //Always get all deadlines
	    }

	    if ('austeve-deadline' == $query->get( 'post_type')) {
		    //add meta query to only get deadlines AFTER the 'timeout' period'

		    $days = get_field('remove_deadlines_after', 'option');
		    $startDate = (new DateTime(null, new DateTimeZone('America/Halifax')))->modify('-'.$days.' days');

		    $meta_query = array(
		    	array(
		    		'key' => 'date',
		    		'value' 	=> $startDate->format('Ymd'),
		    		'compare' 	=> '>=',
		    		'type' 	=> 'DATE'
		    	)
		    );
		    $query->set('meta_query', $meta_query);
		}
	}
}

// Create CPTs!
$austeveCPTs = new AUSteve_CPTs();

?>
