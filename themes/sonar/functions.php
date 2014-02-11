<?php 

// Costants
define ( "SONAR_VERSION" , "1.0" ); 

#get_template_part("events/main");
// Including a few scripts and styles.. 
function sonar_scripts() 
{
	wp_enqueue_script('jquery');
	wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/vendor/modernizr-2.6.2.min.js', false, null, true);
	wp_enqueue_script('masonry', get_template_directory_uri() . '/js/vendor/masonry.pkgd.min.js', array('jquery'), null, true);
    wp_enqueue_script('backstretch', get_template_directory_uri() . '/js/vendor/jquery.backstretch.min.js', array('jquery'), null, true);
	wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js', array('jquery', 'masonry', 'backstretch') , SONAR_VERSION , true);
    
	wp_localize_script( 'main', 'sonar_wp_data', js_variables() );
	//wp_enqueue_script('google_map_api', '', false , null , true);
	wp_enqueue_style("normalize" , get_template_directory_uri() . "/css/normalize.min.css");
	wp_enqueue_style("roboto" , "http://fonts.googleapis.com/css?family=Roboto&subset=latin,latin-ext", array("normalize"));
	wp_enqueue_style("main_style" , get_template_directory_uri() . "/style.css", array("normalize" , "roboto"));
	// provvisorio
} 

get_template_part('admin/theme_options');

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

/**
* Gets the JS variables retrieved from database
* @return: Array ( An array of js variables ) 
**/
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

/**
* Get classes necessary to create custom skins
* @return: string ( a string containing the name of the classes ) 
**/
function get_customization_classes() 
{
	return "";
}

// Adding sidebar to the theme.
register_sidebar( 
    array(
        'name' => __( 'Primary Widget Area', 'twentyten' ),
        'id' => 'primary-widget-area',
        'description' => __( 'The primary widget area', 'twentyten' ),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) 
);

// thumbnail theme support
if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails' ); 
}
// adding image sizes for thumbnails
if ( function_exists( 'add_image_size' ) ) { 
    add_image_size( 'square-blog-thumb', 220, 220, true );
    add_image_size( 'wide-blog-thumb', 700, 220, false );
    add_image_size( 'extrawide-blog-thumb', 940, 320, true );
}
 




