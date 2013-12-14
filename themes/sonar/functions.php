<?php 

// Costants
define ( "SONAR_VERSION" , "1.0" ); 

#get_template_part("events/main");
// Including a few scripts and styles.. 
function sonar_scripts() 
{
	wp_enqueue_script('jquery');
	wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/vendor/modernizr-2.6.2.min.js', false, null, true);
	wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js', array('jquery') , SONAR_VERSION , true);
	wp_localize_script( 'main', 'sonar_wp_data', js_variables() );
	//wp_enqueue_script('google_map_api', '', false , null , true);
	wp_enqueue_style("normalize" , get_template_directory_uri() . "/css/normalize.min.css");
	wp_enqueue_style("main_style" , get_template_directory_uri() . "/style.css", array("normalize" , "roboto"));
	// provvisorio
	wp_enqueue_style("roboto" , "http://fonts.googleapis.com/css?family=Roboto&subset=latin,latin-ext", array("normalize"));
} 
add_action( 'wp_enqueue_scripts', 'sonar_scripts');

// order events from present day to future
function events_order ($posts) 
{
	usort($posts , function ($a , $b) {
		$a_event_date = get_post_meta( $a->ID , "_starting_date" , true );
	    $a_event_time = get_post_meta( $a->ID , "_starting_time" , true );
	    $b_event_date = get_post_meta( $b->ID , "_starting_date" , true );
	    $b_event_time = get_post_meta( $b->ID , "_starting_time" , true );
	    $a = new DateTime($a_event_date . " " . $a_event_time);
	    $b = new DateTime($b_event_date . " " . $b_event_time);
	    if($a > $b) {
	        return $a_event_date;
	    }
    });
}

// home page query parameters
function home_page_query () 
{
	return array( 
        "post_type" => "events" , 
        "posts_per_page" =>  -1 , 
        'paged' => get_query_var('paged') ? get_query_var('paged') : 1 
    );
}

// registro nav menu
function register_my_menu() 
{
  register_nav_menu('header-menu',__( 'Header Menu' ));
}
add_action( 'init', 'register_my_menu' );

// sonar contact form
function sonar_contact_form () 
{
	return 
	"<div class='contact_form'>
		<label for='name'>Name:</label>
		<input type='text' name='name' id='name' />
		<label for='email'>Name:</label>
		<input type='text' name='email' id='email' />
		<label for='message_text'>Message:</label>
		<textarea name='message_text' id='message_text'></textarea>
	</div>";
}

add_shortcode( 'sonar_contact_form', 'sonar_contact_form' );

function  js_variables () 
{
	return array(
		"choosen_map" => "pale dawn"
	);
}

class geo_array
{
    private static $myArray = array();

    public static function getMyArray()
    {
       return self::$myArray;
    } 
}


