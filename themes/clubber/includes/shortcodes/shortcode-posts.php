<?php
add_shortcode("blog", "blog_shortcode");
add_shortcode("event", "event_shortcode");
add_shortcode("eventup", "eventup_shortcode");
add_shortcode("photo", "photo_shortcode");
add_shortcode("audio", "audio_shortcode");
add_shortcode("video", "video_shortcode");
function blog_shortcode($atts, $content) {
    extract(shortcode_atts(array(
        "items" => 4,
		"cat" => null,
        "id" => null,
        "nav" => false,
        "order" => "desc",
		"orderby" => "ID",
        "events" => null
    ), $atts));
    $order       = strtoupper($order);
    $items_count = 0;
    $items_src   = null;
    if ($id == null) {
        $query          = array(
            'orderby' => $orderby,
            'order' => $order,
            'posts_per_page' => $items,
			'cat' => $cat
        );
        $wp_query_event = new WP_Query($query);
    }
    $items_src .= '
  <div class="home-post">';
    while ($wp_query_event->have_posts()):
        $wp_query_event->the_post();
        global $post;
        $image_id    = get_post_thumbnail_id();
        $cover_blog  = wp_get_attachment_image_src($image_id, 'blog-home');
        $items_src .= '
    <div class="home-width fixed">
      <div class="blog-home">';
        if ($image_id) {
            $items_src .= '
        <div class="blog-home-cover">
          <a href="' . get_permalink() . '">
            <img src="' . $cover_blog[0] . '" alt="' . get_the_title() . '" />
          </a>
        </div><!-- end .blog-home-cover --> ';
        }
        $items_src .= '
        <h2 class="event-arc-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>
        <div class="blog-home-info">
          <p class="blog-user">' . get_the_author() . '</p> 
          <p class="blog-date">' . get_the_time('F jS, Y') . '</p> 
          <p class="blog-comment"><a href="' . get_comments_link() . '">' . get_comments_number() . ' ' . __('Comments', 'clubber') . '</a></p> 
        </div><!-- end .blog-home-info -->
        <p>' . the_excerpt_max(200) . '</p>
        <div class="blog-arc-more"><a href="' . get_permalink() . '" rel="bookmark">Read more</a></div>
      </div><!-- end .blog-home -->                   
    </div><!-- end .home-width fixed -->';
    endwhile;
    wp_reset_query();
    $items_src .= '
  </div><!-- end .home-post -->';
    return $items_src;
}
function event_shortcode($atts, $content) {
    extract(shortcode_atts(array(
        "items" => 2,
		"cat" => null,
        "id" => null,
        "nav" => false,
        "order" => "desc",
		"orderby" => "ID",
    ), $atts));
    $order       = strtoupper($order);
    $items_count = 0;
    $items_src   = null;
    if ($id == null) {
        $query = array(
            'post_type' => 'event',
            'orderby' => $orderby,
            'order' => $order,
            'posts_per_page' => $items,
        );		
	if ($cat) {
     $query = array(
        'posts_per_page' => $items, 
        'orderby' => $orderby,
		'order' => $order,
        'post_type' => 'event',
        'tax_query' => array(
            array(
                'taxonomy' => 'events',
                'field' => 'slug',
                'terms' => array($cat)
            )));
    }
        $wp_query_event = new WP_Query($query);
    }
    $items_src .= '
  <div class="home-post">';
    while ($wp_query_event->have_posts()):
        $wp_query_event->the_post();
        global $post;
        $image_id       = get_post_thumbnail_id();
        $cover_event    = wp_get_attachment_image_src($image_id, 'event-cover-arc');
        $image_large    = wp_get_attachment_image_src($image_id, 'large');
        $data_event     = get_post_meta($post->ID, 'event_date_interval', true);
        $time           = strtotime($data_event);
        $tstart         = get_post_meta($post->ID, 'event_tstart', true);
        $tend           = get_post_meta($post->ID, 'event_tend', true);
        $venue          = get_post_meta($post->ID, 'event_venue', true);
		$event_text     = get_post_meta($post->ID, "ev_text", true);
        $custom         = get_post_custom($post->ID);
        $event_ticket   = $custom["event_ticket"][0];
        $pretty_date_yy = date('Y', $time);
		$pretty_date_d  = date('d', $time);
		$theme = get_template_directory();
		require($theme.'/includes/language.php');
        $items_src .= '
    <div class="home-width fixed">
      <div class="event-archive">       
        <div class="event-arc-data">
          <div class="event-arc-day">' . $pretty_date_d . '</div>
          <div class="event-arc-month">' . $pretty_date_M . '</div>
        </div><!-- end .event-arc-data -->                
        <div class="event-arc-cover">';
        if ($image_id) {
            $items_src .= '
          <a href="' . get_permalink() . '">
            <img src="' . $cover_event[0] . '" alt="' . get_the_title() . '" />
          </a>';
        } else {
            $items_src .= '
          <a href="' . get_permalink() . '">
            <img src="' . get_template_directory_uri() . '/images/no-featured/event-single.png" alt="no image" />
          </a>';
        }
        $items_src .= '                
        </div><!-- end .event-arc-cover -->
        <div class="event-arc-text">
          <h2 class="event-arc-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>
          <div class="event-arc-info">';
            if($venue) {
                $items_src .= '<p class="event-arc-venue">' . $venue . '</p>';    
            }              
            if (get_post_meta($post->ID, 'event_allday', true) == 'yes'){            
                $items_src .= '<p class="event-arc-time">All Day</p>';           
            } elseif ($tstart) {            
                $items_src .= '<p class="event-arc-time">' . $tstart . '';            
            } if ($tend) { 
                $items_src .= ' – ' . $tend . '</p>';
            } 
        $items_src .= '
          </div><!-- end .event-arc-info -->';
            $items_src .= '<p>' . the_excerpt_max(165) . '</p>';
	if (get_post_meta($post->ID, 'event_disable', true) == 'no') {
        if ($event_text) {   
            $items_src .= '
                        <div class="event-tickets"><a href="' . $event_ticket . '" target="_blank">' . $event_text . '</a></div>';
        } else {  
            if (get_post_meta($post->ID, 'event_out', true) == 'yes') {
                $items_src .= '
                        <div class="event-cancel-out"><p>Sold Out</p></div>';
            } elseif (get_post_meta($post->ID, 'event_cancel', true) == 'yes') {
                $items_src .= '
                        <div class="event-cancel-out"><p>Canceled</p></div>';
            } elseif (get_post_meta($post->ID, 'event_free', true) == 'yes') {
                $items_src .= '
                        <div class="event-cancel-out"><p>Free Entry</p></div>';
            } else {
                $items_src .= '
                        <div class="event-tickets"><a href="' . $event_ticket . '" target="_blank">Buy Tickets</a></div>';
            }
        }
	}
        $items_src .= '
        </div><!-- end .event-arc-text -->
      </div><!-- end .event-archive -->
    </div><!-- end .home-width fixed -->';
    endwhile;
    $items_src .= '
  </div><!-- end .home-post -->';
    return $items_src;
}
function eventup_shortcode($atts, $content) {
    extract(shortcode_atts(array(
        "items" => 2,
		"cat" => null,
        "id" => null,
        "nav" => false,
        "order" => "asc",
        "events" => null
    ), $atts));
    $order       = strtoupper($order);
    $items_count = 0;
    $items_src   = null;
    if ($id == null) {
        $query = array(
            'post_type' => 'event',
            'orderby' => 'meta_value',
            'order' => $order,
		    'meta_key' => 'event_date_interval',
			'meta_value' => strftime("%Y/%m/%d", time()- (60 * 60 * 24) ),
			'meta_compare' => '>',
            'posts_per_page' => $items,
        );
	if ($cat) {
     $query = array(
        'posts_per_page' => $items, 
        'orderby' => 'meta_value',
		'meta_value' => strftime("%Y/%m/%d", time()- (60 * 60 * 24) ),
		'meta_key' => 'event_date_interval',
		'meta_compare' => '>',
		'order' => $order,
        'post_type' => 'event',
        'tax_query' => array(
            array(
                'taxonomy' => 'events',
                'field' => 'slug',
                'terms' => array($cat)
            )));
    }
        $wp_query_event = new WP_Query($query);
    }
    $items_src .= '
  <div class="home-post">';
    while ($wp_query_event->have_posts()):
        $wp_query_event->the_post();
        global $post;
        $image_id       = get_post_thumbnail_id();
        $cover_event    = wp_get_attachment_image_src($image_id, 'event-cover-arc');
        $image_large    = wp_get_attachment_image_src($image_id, 'large');
        $data_event     = get_post_meta($post->ID, 'event_date_interval', true);
        $time           = strtotime($data_event);
        $tstart         = get_post_meta($post->ID, 'event_tstart', true);
        $tend           = get_post_meta($post->ID, 'event_tend', true);
        $venue          = get_post_meta($post->ID, 'event_venue', true);
		$event_text     = get_post_meta($post->ID, "ev_text", true);
        $custom         = get_post_custom($post->ID);
        $event_ticket   = $custom["event_ticket"][0];
        $pretty_date_yy = date('Y', $time);
        $pretty_date_d  = date('d', $time);
		$theme = get_template_directory();
		require($theme.'/includes/language.php');
        $items_src .= '
    <div class="home-width fixed">
      <div class="event-archive">       
        <div class="event-arc-data">
          <div class="event-arc-day">' . $pretty_date_d . '</div>
          <div class="event-arc-month">' . $pretty_date_M . '</div>
        </div><!-- end .event-arc-data -->                
        <div class="event-arc-cover">';
        if ($image_id) {
            $items_src .= '
          <a href="' . get_permalink() . '">
            <img src="' . $cover_event[0] . '" alt="' . get_the_title() . '" />
          </a>';
        } else {
            $items_src .= '
          <a href="' . get_permalink() . '">
            <img src="' . get_template_directory_uri() . '/images/no-featured/event-single.png" alt="no image" />
          </a>';
        }
        $items_src .= '                
        </div><!-- end .event-arc-cover -->
        <div class="event-arc-text">
          <h2 class="event-arc-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>
          <div class="event-arc-info">';
            if($venue) {
                $items_src .= '<p class="event-arc-venue">' . $venue . '</p>';    
            }              
            if (get_post_meta($post->ID, 'event_allday', true) == 'yes'){            
                $items_src .= '<p class="event-arc-time">All Day</p>';           
            } elseif ($tstart) {            
                $items_src .= '<p class="event-arc-time">' . $tstart . '';            
            } if ($tend) { 
                $items_src .= ' – ' . $tend . '</p>';
            } 
        $items_src .= '
          </div><!-- end .event-arc-info -->';
            $items_src .= '<p>' . the_excerpt_max(165) . '</p>';
	if (get_post_meta($post->ID, 'event_disable', true) == 'no') {
        if ($event_text) {   
            $items_src .= '
                        <div class="event-tickets"><a href="' . $event_ticket . '" target="_blank">' . $event_text . '</a></div>';
        } else {  
            if (get_post_meta($post->ID, 'event_out', true) == 'yes') {
                $items_src .= '
                        <div class="event-cancel-out"><p>Sold Out</p></div>';
            } elseif (get_post_meta($post->ID, 'event_cancel', true) == 'yes') {
                $items_src .= '
                        <div class="event-cancel-out"><p>Canceled</p></div>';
            } elseif (get_post_meta($post->ID, 'event_free', true) == 'yes') {
                $items_src .= '
                        <div class="event-cancel-out"><p>Free Entry</p></div>';
            } else {
                $items_src .= '
                        <div class="event-tickets"><a href="' . $event_ticket . '" target="_blank">Buy Tickets</a></div>';
            }
        }
	}
        $items_src .= '
        </div><!-- end .event-arc-text -->
      </div><!-- end .event-archive -->
    </div><!-- end .home-width fixed -->';
    endwhile;
    $items_src .= '
  </div><!-- end .home-post -->';
    return $items_src;
}
function photo_shortcode($atts, $content) {
    extract(shortcode_atts(array(
        "items" => 3,
		"cat" => null,
        "id" => null,
        "nav" => false,
        "order" => "desc",
		"orderby" => "ID",
        "photos" => null
    ), $atts));
    $order = strtoupper($order);
    if ($id == null) {
        $query = array(
            'post_type' => 'photo',
            'orderby' => $orderby,
            'order' => $order,
            'posts_per_page' => $items
        );
	if ($cat) {
     $query = array(
        'posts_per_page' => $items, 
        'orderby' => $orderby,
		'order' => $order,
        'post_type' => 'photo',
        'tax_query' => array(
            array(
                'taxonomy' => 'photos',
                'field' => 'slug',
                'terms' => array($cat)
            )));
    }
        $wp_query_photo = new WP_Query($query);
    }
    $items_src  = null;
    $items_src .= '
  <div class="home-post fixed">
    <div class="col-home">
      <div class="home-width"> ';
    while ($wp_query_photo->have_posts()):
        $wp_query_photo->the_post();
        global $post;
        $fix         = the_excerpt_max(0);
        $title       = get_the_title($fix);
        $image_id    = get_post_thumbnail_id();
        $cover_photo = wp_get_attachment_image_src($image_id, 'photo-home');
        $items_src .= '
        <div class="photo-home last-p">
          <div class="photo-home-cover bar-home-photo">
            <a href="' . get_permalink() . '">';
        if ($image_id) {
            $items_src .= '
              <img src="' . $cover_photo[0] . '" alt="' . get_the_title() . '" />';
        } else {
            $items_src .= '
              <img src="' . get_template_directory_uri() . '/images/no-featured/photo-video-home.png" alt="no image" />';
        }
        $items_src .= '
              <div class="media-home-title mosaic-overlay">';             
        if (strlen($post->post_title) > 29) {
        $items_src .= ' ' . substr(the_title($before = '', $after = '', FALSE), 0, 29).  '...';    ' ';
        } else {
        $items_src .= ' ' . $title . ' ';
        }      
        $items_src .= '</div><!-- end .audio-title -->    
            </a>
          </div><!-- end .photo-home-cover -->          
        </div><!-- end .photo-home last-p -->';
    endwhile;
    wp_reset_query();
    $items_src .= '
      </div><!-- end .home-width -->
    </div><!-- end .col-home -->
  </div><!-- end .home-post fixed-->';
    return $items_src;
}
function audio_shortcode($atts, $content) {
    extract(shortcode_atts(array(
        "items" => 3,
		"cat" => null,
        "id" => null,
        "nav" => false,
        "order" => "desc",
		"orderby" => "ID",
        "audios" => null
    ), $atts));
    $order       = strtoupper($order);
    $items_count = 0;
    $items_src   = null;
    if ($id == null) {
        $query = array(
            'post_type' => 'audio',
            'orderby' => $orderby,
            'order' => $order,
            'posts_per_page' => $items,
        );
	if ($cat) {
     $query = array(
        'posts_per_page' => $items, 
        'orderby' => $orderby,
		'order' => $order,
        'post_type' => 'audio',
        'tax_query' => array(
            array(
                'taxonomy' => 'audios',
                'field' => 'slug',
                'terms' => array($cat)
            )));
    }
        $wp_query_audio = new WP_Query($query);
    }
    $items_src .= ' 
  <div class="home-post fixed">
    <div class="col-home">
      <div class="home-width">';
    while ($wp_query_audio->have_posts()):
        $wp_query_audio->the_post();
        global $post;
        $fix         = the_excerpt_max(0);
        $title       = get_the_title();
        $image_id    = get_post_thumbnail_id();
        $cover_audio = wp_get_attachment_image_src($image_id, 'audio-home');
        $items_src .= '
        <div class="audio-home last-p">
          <div class="audio-home-cover bar-home-audio">
            <a href="' . get_permalink() . '">';
        if ($image_id) {
            $items_src .= '
              <img src="' . $cover_audio[0] . '" alt="' . get_the_title() . '" />';
        } else {
            $items_src .= '
              <img src="' . get_template_directory_uri() . '/images/no-featured/audio-home.png" alt="no image" />';
        }
        $items_src .= '
              <div class="media-home-title mosaic-overlay">';             
        if (strlen($post->post_title) > 29) {
        $items_src .= ' ' . substr(the_title($before = '', $after = '', FALSE), 0, 29).  '...';    ' ';
        } else {
        $items_src .= ' ' . $title . ' ';
        }      
        $items_src .= '</div><!-- end .audio-title -->  
            </a>
          </div><!-- end .audio-home-cover -->  
        </div><!-- end .audio-home last-p -->';
    endwhile;
    wp_reset_query();
    $items_src .= ' 
      </div><!-- end .home-width -->
    </div><!-- end .col-home -->
  </div><!-- end .home-post fixed-->';
    return $items_src;
}
function video_shortcode($atts, $content) {
    extract(shortcode_atts(array(
        "items" => 3,
		"cat" => null,
        "id" => null,
        "nav" => false,
        "order" => "desc",
		"orderby" => "ID",
        "videos" => null
    ), $atts));
    $order       = strtoupper($order);
    $items_count = 0;
    $items_src   = null;
    if ($id == null) {
        $query = array(
            'post_type' => 'video',
            'orderby' => $orderby,
            'order' => $order,
            'posts_per_page' => $items
        );
	if ($cat) {
     $query = array(
        'posts_per_page' => $items, 
        'orderby' => $orderby,
		'order' => $order,
        'post_type' => 'video',
        'tax_query' => array(
            array(
                'taxonomy' => 'videos',
                'field' => 'slug',
                'terms' => array($cat)
            )));
    }
        $wp_query_video = new WP_Query($query);
    }
    $items_src .= '    
  <div class="home-post fixed">
    <div class="col-home">
      <div class="home-width">';
    while ($wp_query_video->have_posts()):
        $wp_query_video->the_post();
        global $post;
        $fix         = the_excerpt_max(0);
        $title       = get_the_title($fix);
        $video       = get_post_meta($post->ID, "video_link", true);
        $image_id    = get_post_thumbnail_id();
        $cover_video = wp_get_attachment_image_src($image_id, 'video-home');
        $items_src .= '
        <div class="video-home last-p">
          <div class="video-home-cover bar-home-video">
            <a href="' . $video . '" data-rel="prettyPhoto">';
        if ($image_id) {
            $items_src .= '
              <img src="' . $cover_video[0] . '" alt="' . get_the_title() . '" />';
        } else {
            $items_src .= '
              <img src="' . get_template_directory_uri() . '/images/no-featured/photo-video-home.png" alt="no image" />';
        }
        $items_src .= '
              <div class="media-home-title mosaic-overlay">';             
        if (strlen($post->post_title) > 29) {
        $items_src .= ' ' . substr(the_title($before = '', $after = '', FALSE), 0, 29).  '...';    ' ';
        } else {
        $items_src .= ' ' . $title . ' ';
        }      
        $items_src .= '</div><!-- end .audio-title -->  
            </a>
          </div><!-- end .video-home-cover --> 
        </div><!-- end .video-home last-p -->';
    endwhile;
    wp_reset_query();
    $items_src .= '    
      </div><!-- end .home-width -->
    </div><!-- end .col-home -->
  </div><!-- end .home-post fixed-->';
    return $items_src;
}
?>