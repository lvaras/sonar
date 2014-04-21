<?php 

// Costants
define ( "SONAR_VERSION" , "1.0" ); 

// includes
get_template_part('admin/theme_options');
get_template_part('widgets');


// Including a few scripts and styles.. 
function sonar_scripts() 
{
	wp_enqueue_script('jquery');
	wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/vendor/modernizr-2.6.2.min.js', false, null, true);
	wp_enqueue_script('masonry', get_template_directory_uri() . '/js/vendor/masonry.pkgd.min.js', array('jquery'), null, true);
	wp_enqueue_script('bxslider', get_template_directory_uri() . '/js/bxslider/jquery.bxslider.min.js', array('jquery'), null, true);
    // wp_enqueue_script('backstretch', get_template_directory_uri() . '/js/vendor/jquery.backstretch.min.js', array('jquery'), null, true);
	wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js', array('jquery', 'bxslider', 'masonry') , SONAR_VERSION , true);
    
	wp_localize_script( 'main', 'sonar_wp_data', js_globals() );
	wp_enqueue_script('google_map_api', '', false , null , true);
	wp_enqueue_style("normalize" , get_template_directory_uri() . "/css/normalize.min.css");
	wp_enqueue_style("bxslider" , get_template_directory_uri() . "/js/bxslider/jquery.bxslider.css");
	wp_enqueue_style("roboto" , "http://fonts.googleapis.com/css?family=Roboto&subset=latin,latin-ext", array("normalize"));
	wp_enqueue_style("main_style" , get_template_directory_uri() . "/style.css", array("normalize" , "roboto", "bxslider"));
	// provvisorio
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
	$number_of_posts = of_get_option('events_home_number_texthidden');
	return array( 
        "post_type" => "events" , 
        "posts_per_page" =>  intval($number_of_posts) !== 0 ? $number_of_posts: 10, 
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
function  js_globals () 
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

// Outputs the links of normal favicon and apple touch favicon (add retina support?)
function sonar_favicons() 
{
	$favicon_url = of_get_option('favicon');
	if (empty($favicon_url)) {
	    $favicon_url = get_template_directory_uri().'/favicon.jpg';
	}
	$apple_touch_favicon_url = of_get_option('favicon_apple_touch');
	if (empty($apple_touch_favicon_url)) {
		$apple_touch_favicon_url = get_template_directory_uri().'/apple-touch-icon-precomposed.png';
	}
	echo '<link rel="shortcut icon" href="'.$favicon_url.'" />';
	echo '<link rel="apple-touch-icon" href="' . $apple_touch_favicon_url . '">';
}

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
 

// Register and load the widget
function wpb_load_widget() {
	register_widget( 'sonar_events_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );

// custom excerpt length
function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/**
* Checks if a string is empty after being trimmed
* @param: string 
* @return: boolean  
**/
function trimmed_empty ($meta_value = '') 
{
	$meta_value = trim($meta_value);
	return empty($meta_value) ? true : false;
}

/**
* Converts a meta value to a standard css class
* if is a meta value that starts with underscore set the 
* second parameter to tre and it will be removed
* @param: string 
* @param: boolean 
* @return: string  
**/
function metavalue_to_class ($meta_value , $underscore = false) 
{
	$meta_value = substr($meta_value, 1); 
	$meta_value = str_replace('_' , '-', $meta_value );
	return $meta_value;
}



