<?php
/*
Template Name: Event Style 1
*/
?>

<?php get_header(); ?>


<div id="content">

<div class="title-head"><h1><?php
$prefix = false;
if (function_exists('is_tag') && is_tag()) {
    $prefix = true;
} elseif (is_archive()) {
    wp_title(' ');
} elseif (is_page()) {
    the_title();
}
?>
</h1></div><!-- end #title-head -->

<?php
$page_layout = sidebar_layout();
switch ($page_layout) {
    case "layout-sidebar-left":
        echo '
<div class="sidebar-left">';
        wz_setSection('zone-sidebar');
        if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
        echo '
</div><!-- end .sidebar-left -->';
        break;
    case "layout-sidebar-right":
        echo '
<div class="sidebar-right">';
        wz_setSection('zone-sidebar');
        if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
        echo '
</div><!-- end .sidebar-right -->';
        break;
    case "layout-full":
        echo '
<div class="sidebar-right">';
        wz_setSection('zone-sidebar');
        if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-page'));
        echo '
</div><!-- end .sidebar-right -->';
        break;
}
?>

<?php
$term               = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
$events_nr          = of_get_option('nr_events');
$query    = array(
    'post_type' => 'event',
    'posts_per_page' => $events_nr,
    'paged' => $paged,
    'taxonomy' => 'events',
	'term' => $term->slug
);
$wp_query = new WP_Query($query);
echo '
<div class="fixed">';
echo '
  <div class="col-blog-archive">';

    while ($wp_query->have_posts()):
        $wp_query->the_post();
        global $post;
        $results = $wp_query->post_count;
        $data_event     = get_post_meta($post->ID, 'event_date_interval', true);
        $time           = strtotime($data_event);
        $pretty_date_yy = date('Y', $time);
        $pretty_date_d  = date('d', $time);
		require('includes/language.php');
        $tstart         = get_post_meta($post->ID, 'event_tstart', true);
        $tend           = get_post_meta($post->ID, 'event_tend', true);
        $venue          = get_post_meta($post->ID, 'event_venue', true);
		$event_text     = get_post_meta($post->ID, "ev_text", true);
        $custom         = get_post_custom($post->ID);
        $event_ticket   = $custom["event_ticket"][0];
        $image_id       = get_post_thumbnail_id();
        $cover          = wp_get_attachment_image_src($image_id, 'event-cover-arc');
        echo '
    <div class="event-archive">     
      <div class="event-arc-data">
        <div class="event-arc-day">' . $pretty_date_d . '</div>
        <div class="event-arc-month">' . $pretty_date_M . '</div>
      </div><!-- end #event-arc-data -->                
      <div class="event-arc-cover">';
        if ($image_id) {
            echo '
        <a href="' . get_permalink() . '"><img src="' . $cover[0] . '" alt="' . get_the_title() . '" /></a>';
        } else {
            echo '
        <a href="' . get_permalink() . '"><img src="' . get_template_directory_uri() . '/images/no-featured/event-single.png" alt="no image" /></a>';
        }
        echo '                
      </div><!-- end #event-arc-cover -->
      <div class="event-arc-text">
        <h2 class="event-arc-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>
          <div class="event-arc-info">';
            if($venue) {
                echo '<p class="event-arc-venue">' . $venue . '</p>';    
            }              
            if (get_post_meta($post->ID, 'event_allday', true) == 'yes'){            
                echo '<p class="event-arc-time">All Day</p>';           
            } elseif ($tstart) {            
                echo '<p class="event-arc-time">' . $tstart . '';            
            } if ($tend) { 
                echo ' – ' . $tend . '</p>';
            } 
        echo '
          </div><!-- end #event-arc-info -->';
            echo ' ' . the_excerpt_max(165) . ' ';
                
	if (get_post_meta($post->ID, 'event_disable', true) == 'no') {
        if ($event_text) {   
            echo '
                        <div class="event-tickets"><a href="' . $event_ticket . '" target="_blank">' . $event_text . '</a></div>';
        } else {  
            if (get_post_meta($post->ID, 'event_out', true) == 'yes') {
                echo '
                        <div class="event-cancel-out"><p>Sold Out</p></div>';
            } elseif (get_post_meta($post->ID, 'event_cancel', true) == 'yes') {
                echo '
                        <div class="event-cancel-out"><p>Canceled</p></div>';
            } elseif (get_post_meta($post->ID, 'event_free', true) == 'yes') {
                echo '
                        <div class="event-cancel-out"><p>Free Entry</p></div>';
            } else {
                echo '
                        <div class="event-tickets"><a href="' . $event_ticket . '" target="_blank">Buy Tickets</a></div>';
            }
        }
	}

        echo '
      </div><!-- end #event-arc-text -->
    </div><!-- end #event-archive -->
        ';
        
    endwhile;

?>
    <div class="pagination-pos">
<?php
if (function_exists("pagination")) {
    pagination();
}?>
    </div><!-- end .pagination-pos -->

  </div><!-- end .blog-archive -->
</div><!-- end .fixed-->  
</div><!-- end #content -->
	

<?php get_footer(); ?>