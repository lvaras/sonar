<?php 
/**
 * Plugin Name: Sonar Event Manager
 * Plugin URI: 
 * Description: Manages Evenets.
 * Version: 1.0
 * Author: Lorenzo Varas
 * Author URI: http://www.creativemuffin.it/lnz.varas
 * License: GPL2
 */

// creating events custom post type
class events {

	public function __construct()
	{
		$this->register_post_type();
		$this->register_custom_taxonomy();
		$this->register_custom_meta_box();
		add_action( 'save_post', array( $this, 'save' ) );
	}

	// Registering custom posty type.
	public function register_post_type()
	{
		$args = array(
			'labels' => array(
				'name' => 'Events',
				'singular_name' => 'Events',
				'add_new' => 'Add Event',
				'add_new_item' => 'Add Event',
				'edit_item' => 'Edit Event',
				'new_item' => 'Add New Event',
				'view_item' => 'View Event',
				'search_item' => 'Search Event',
				'not_found' => 'No Events Were Found',
				'not_found_in_trash' => 'No Events Were Found in Trash',
			),
			'query_var' => 'events',
			'rewrite' => array (
					'slug' => "events"
			),
			'public' => true,
			'show_in_menu' => true,
        	'show_in_nav_menus '=>true,
			'menu_position' => 5,
			'has_archive' => true,
			'show_ui' => true,
			'menu_icon' => 'dashicons-calendar',
			'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
			'hierarchical' => true,
		);
		register_post_type("events", $args);
	}

	// Registering custom taxonomy.
	public function register_custom_taxonomy()
	{
		register_taxonomy(
		'event_cat',
		'event',
		array(
			'hierarchical' => true,
			'label' => 'Events Categories',
			'query_var' => true,
			'rewrite' => true,
			'show_admin_column' => true
			)
		);
		add_action('admin_enqueue_scripts', array($this , 'enqueue_script_and_styles'));
	}

	// Registering custom meta box.
	public function register_custom_meta_box()
	{
		add_action( 'add_meta_boxes', function ($this) {
			add_meta_box(
				'event_manager',	
				'Event Information',	
				array($this, 'render_meta_box'),
				'events',					
				'normal',					
				'high'					
			);
		}); 
	}

	public function save ( $post_id ) 
	{ 

	 	// Check if our nonce is set.
	    if ( !isset( $_POST['event_custom_box_nonce'] )) {
	      return $post_id;
	    }

  	    $nonce = $_POST['event_custom_box_nonce']; 
  
  	    // Verify that the nonce is valid.
  	    if ( ! wp_verify_nonce( $nonce, 'event_custom_box' ) ) {
  	        return $post_id;
  	    }
  
  	    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
  	    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
  	        return $post_id;
  	    }
  	    // Check the user's permissions.
  	    if ( 'page' == $_POST['post_type'] ) {
  	      if ( ! current_user_can( 'edit_page', $post_id ) )
  	          return $post_id;
  	    } 
  	    else {
  	      if ( ! current_user_can( 'edit_post', $post_id ) )
	          return $post_id;
  		}
	    /* OK, its safe for us to save the data now. */
  	    // Sanitize user input.
  	    foreach ($_POST["event_meta"] as $input_name => $value) 
  	    {
  	    	$sanitazed_data = sanitize_text_field( $value );
  	    	update_post_meta( $post_id, "_$input_name", $value );  
  		}
	}

	// Rendering template for custom meta box.
	public function render_meta_box () 
	{
		include_once( plugin_dir_path(__FILE__) . "meta-box.php");
	}

	// Enqueueing scripts for meta fields.
	public function enqueue_script_and_styles () 
	{
		wp_enqueue_script('jquery_ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js' );
		wp_enqueue_script('jquery-timepicker', plugins_url('' , __FILE__) . '/jquery.timepicker.min.js');
		wp_enqueue_script('admin_scripts', plugins_url('' , __FILE__) . '/admin-scripts.js' , array( "jquery_ui" , "jquery-timepicker" ) );
		wp_enqueue_style('sonar_admin_css', plugins_url('' , __FILE__) . '/admin-styles.css' );
		wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
	}
}

// Adding event post type
function sonar_post_types ()
{
	new events();
} 

add_action('init', "sonar_post_types");
