<?php get_header();
	/*
	 *Template Name: Blog full width
	 *Description: Blog full width
	 */
?>

<div class="container clearfix">
    <div class="session-box">
        <h3>
            <span>Tonight</span>
        </h3>
        <div class="graphic-line"></div>
        <div class="down-triangle"></div>
        <div class="graphic-line"></div>
    </div>
    <div class="cont-blog-fw">
        <div>
            <h2 class="title-head">Blog <span class="second-head-title">+ widget</span></h2>
        </div>
	   <?php 
		$posts = get_posts( array("number_of_posts" => -1 , "post_type" => "post") );
		foreach($posts as $post) :
			setup_postdata( $post );
		?>
		
		<div class="blog-fw-post-1 clearfix">
		  
            <?php if ( has_post_thumbnail() ) { ?>
				<div class="cont-img-fw-post-1">
				    <?php the_post_thumbnail(); ?>
				</div>
            <?php } ?>  
            
            <div class="cont-text-fw-post-1">
                <h3 class="title-fw-post-1">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" ><?php the_title(); ?> 
                        <span class="title-2-fw-post-1">titolo2</span>
                    </a>
                </h3>
                <div class="cont-info-fw-post-1 clearfix">
                    <div class="comment-fw-post-1">
                        
                        <span><?php comments_number( 'no Comment', 'one Comment', '% Comments'); ?></span>
                    </div>
                    <div class="date-fw-post-1">
                        
                        <span><?php the_date(); ?></span>
                    </div>
                    <div class="autor-fw-post-1">
                        
                        <span><?php the_author(); ?></span>
                    </div> 
                </div>
                <div class="cont-content-fw-post-1">
                    <?php the_content(); ?>
                </div>
                <div class="read-more-box-fw-post-1">
                    <a class="read-more-fw-post-1" href="<?php the_permalink(); ?>" title="Read more">
                        Read 
                        <span class="read-more-light-fw-post-1">more</span>
                    </a>
                </div>
            </div>
			
		</div>
		
		<div class="blog-fw-post-2">
		  
            <?php if ( has_post_thumbnail() ) { ?>
				<div class="cont-img-fw-post-2">
				    <?php the_post_thumbnail(); ?>
				</div>
            <?php } ?>  
            
            <div class="cont-text-fw-post-2">
                <div class="cont-info-fw-post-2 clearfix">
                    <div class="autor-fw-post-2">
                        
                        <span><?php the_author(); ?></span>
                    </div>
                    <div class="date-fw-post-2">
                        <span class="ico-date-post"></span>
                        <span><?php the_date(); ?></span>
                    </div>
                    <div class="comment-fw-post-2">
                        
                        <span><?php comments_number( 'no Comment', 'one Comment', '% Comments'); ?></span>
                    </div>
                </div>
                <h3 class="title-fw-post-2">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" ><?php the_title(); ?> 
                        <span class="title-2-fw-post-2">titolo2</span>
                    </a>
                </h3>
                <div class="cont-content-fw-post-2">
                    <?php the_content(); ?>
                </div>
                <div class="read-more-box-fw-post-2">
                    <a class="read-more-fw-post-2" href="<?php the_permalink(); ?>" title="Read more">Read <span class="read-more-light-fw-post-2">more</span></a>
                </div>
            </div>
			
		</div>
		
		<?php endforeach; ?>        
    </div>
    <div class="cont-widget-fw">
    
        <div id="events-widget-fw" class="widget list-nav events-widget-fw clarfix">
           
            <div class="sidebarnav">
                <h3>Upcoming <span class="second-widget-title">Events</span></h3>
            </div>

            <div class="widgets-col-fw">

                <div class="event-widgets-fw clearfix">                                                          
                    <div class="event-w-data-fw">
                        <div class="event-w-day-fw">20</div>
                        <div class="event-w-month-fw"> Mar</div>
                    </div><!-- .event-w-data-->
                    <div class="event-w-title-fw"> 
                        <a href="#" rel="bookmark" title="Despite Secret Guests">Despite Secret
                            <span class="event-w-subtitle-fw"> Guests</span>
                        </a>
                    </div>
                </div><!-- .event-widgets-->
                                                             		
            </div><!-- .event-widgets-col-->            


            <div class="widgets-col-fw">

                <div class="event-widgets-fw clearfix">                                                          
                    <div class="event-w-data-fw">
                        <div class="event-w-day-fw">20</div>
                        <div class="event-w-month-fw"> Mar</div>
                    </div><!-- .event-w-data-->
                    <div class="event-w-title-fw"> 
                        <a href="#" rel="bookmark" title="Despite Secret Guests">Despite Secret
                            <span class="event-w-subtitle-fw"> Guests</span>
                        </a>
                    </div>
                </div><!-- .event-widgets-->
                                                             		
            </div><!-- .event-widgets-col-->    

      	
        </div><!-- .event-widgets-col-->     
        
    </div><!-- .cont-widgets--> 
</div>

<?php get_footer(); ?>
