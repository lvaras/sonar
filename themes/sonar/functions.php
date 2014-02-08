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
	wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js', array('jquery', 'masonry') , SONAR_VERSION , true);

	wp_localize_script( 'main', 'sonar_wp_data', js_variables() );
	//wp_enqueue_script('google_map_api', '', false , null , true);
	wp_enqueue_style("normalize" , get_template_directory_uri() . "/css/normalize.min.css");
	wp_enqueue_style("roboto" , "http://fonts.googleapis.com/css?family=Roboto&subset=latin,latin-ext", array("normalize"));
	wp_enqueue_style("main_style" , get_template_directory_uri() . "/style.css", array("normalize" , "roboto"));
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

class options_page_controller
{
	
    private $settings;
    
    public function __construct( $settings = array() )
    {
        $this->settings = $settings;
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
    }

    /**
     * Add options page
     */
    public function menu_page(  )
    {
        add_menu_page( 
        	'Theme Options', 
        	'Theme Options', 
        	'manage_options', 
        	'sonar_theme_options', 
        	array( $this , 'my_custom_menu_page' ), 
        	'', 
        	90 
        ); 
    }

    public function submenu_page ( $submenu_page_settings )
    {
        add_submenu_page(
            'sonar_theme_options',
            'Opzioni Visive', 
            'Opzioni Visive', 
            'manage_options', 
            'my-custom-submenu-page',
            array( $this, 'my_custom_submenu_page_callback' )
        );
    }


    private function my_custom_menu_page()
    {
    	echo "<h1>Theme Options principale</h1>";
    }

    private function my_custom_submenu_page_callback()
    {
        echo "<h1>Theme Options secondaria</h1>";
    }

}

// new sonar_settings_page ();




