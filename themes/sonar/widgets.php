<?php 

// Creating the widget 
class sonar_events_widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			// Base ID of your widget
			'wpb_widget', 

			// Widget name will appear in UI
			__('SOANAR events' , 'wpb_widget_domain'), 

			// Widget description
			array( 'description' => __( 'An event resume view for your sidebar', 'events_data' ), ) 
			);
	}

	// Creating widget front-end
	// This is where the action happens
	public function widget( $args, $instance ) {
		// $title = apply_filters( 'widget_title', $instance['title'] );
		// // before and after widget arguments are defined by themes
		// echo $args['before_widget'];
		// if ( ! empty( $title ) ) {
		// 	echo $args['before_title'] . $title . $args['after_title'];
		// }

		// // This is where you run the code and display the output
		// echo __( 'Hello, World!', 'wpb_widget_domain' );
		// echo $args['after_widget'];
		?>

		<div id="events-widget" class="widget list-nav events-widget">
		    <div class="sidebarnav">
		        <h3>Upcoming <span class="second-widget-title">Events</span> </h3>
		    </div>
		    <?php
	        $posts = get_posts( 
	        	array( 
		        "post_type" => "events" , 
		        "posts_per_page" =>  5 
		    	) 
	        );
	        events_order($posts);
	        foreach ($posts as $post) : 
	            setup_postdata( $post );
            ?>
		    <div class="widgets-col">
	        	<div class="event-widgets clearfix">                                                          
		        	<div class="event-w-data">
		        		<?php $date = date_create($post->post_date); ?>
		                <div class="event-w-day"><?php echo date_format($date, 'd'); ?></div>
		                <div class="event-w-month"><?php echo date_format($date, 'M');  ?></div>
		            </div><!-- .event-w-data-->
		            <div class="event-w-title"> 
		            	<a href="<?php echo get_permalink( $post->ID ); ?>" rel="bookmark" title="Despite Secret Guests">
		            		<?php echo $post->post_title; ?><span class="event-w-subtitle"></span>
		            	</a>
		            </div>
		        </div><!-- .event-widgets-->
		    </div>
		<?php endforeach; ?>
		</div>

	    <?php
	}
		
// Widget Backend 
public function form( $instance ) 
{
	if ( isset( $instance[ 'title' ] ) ) {
	$title = $instance[ 'title' ];
	}
	else {
	$title = __( 'New title', 'wpb_widget_domain' );
	}
	// Widget admin form
	?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
	<?php 
	}
	
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) 
	{
	$instance = array();
	$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
	return $instance;
	}
} 