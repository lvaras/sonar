<?php get_header();
	/*
	 * Template Name: Blog + widget
	 * Description: Blog with lateral widget
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
    <div class="cont-blog">
        <div>
            <h2 class="title-head">Blog <span class="second-head-title">+ widget</span></h2>
        </div>
	   <?php 
		$posts = get_posts( array("number_of_posts" => -1 , "post_type" => "post") );
		foreach($posts as $post) :
			setup_postdata( $post );
		?>
		
		<div class="blog-post-1 clearfix">
		  
            <?php if ( has_post_thumbnail() ) { ?>
				<div class="cont-img-post-1">
				    <?php the_post_thumbnail( "square-blog-thumb" ); ?>
				</div> 
            <?php } ?>  
            
            <div class="cont-text-post-1">
                <h3 class="title-post-1"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" ><?php the_title(); ?> <span class="title-2-post-1">titolo2</span></a></h3>
                <div class="cont-info-post-1 clearfix">
                    <div class="autor-post-1">
                        <span class="ico-autor-post"></span>
                        <span><?php the_author(); ?></span>
                    </div>
                    <div class="date-post-1">
                        <span class="ico-date-post"></span>
                        <span><?php the_date(); ?></span>
                    </div>
                    <div class="comment-post-1"> 
                        <span class="ico-comment-post"></span>
                        <span><?php comments_number( 'no Comment', 'one Comment', '% Comments'); ?></span>
                    </div> 
                </div>
                <div class="cont-content-post-1">
                    <?php the_content(); ?>
                </div>
                <div class="read-more-box-post-1">
                    <a class="read-more-post-1" href="<?php the_permalink(); ?>" title="Read more">Read <span class="read-more-light-post-1">more</span></a>
                </div>
            </div>
			
		</div>
		
		<div class="blog-post-2">
		  
            <?php if ( has_post_thumbnail() ) { ?>
				<div class="cont-img-post-2">
				    <?php the_post_thumbnail( 'square-blog-thumb' ); ?>
				</div>
            <?php } ?>  
            
            <div class="cont-text-post-2">
                <h3 class="title-post-2"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" ><?php the_title(); ?> <span class="title-2-post-2">titolo2</span></a></h3>
                <div class="cont-info-post-2 clearfix">
                    <div class="comment-post-2"><span class="ico-comment-post"></span><span><?php comments_number( 'no Comment', 'one Comment', '% Comments'); ?></span></div>
                    <div class="date-post-2"><span class="ico-date-post"></span><span><?php the_date(); ?></span></div>
                    <div class="autor-post-2"><span class="ico-autor-post"></span><span><?php the_author(); ?></span></div> 
                </div>
                <div class="cont-content-post-2">
                    <?php the_content(); ?>
                </div>
                <div class="read-more-box-post-2">
                    <a class="read-more-post-2" href="<?php the_permalink(); ?>" title="Read more">Read <span class="read-more-light-post-2">more</span></a>
                </div>
            </div>
			
		</div>
		
		<?php endforeach; ?>        
    </div>
    
    <div class="cont-widget">
    <?php get_sidebar(); ?>
    <?php /*
        ------------------------------------------
        - TEMPLATE DEL WIDGET SVILUPPATO DA UZZO -
        ------------------------------------------
        <div id="events-widget" class="widget list-nav events-widget">
            <div class="sidebarnav">
                <h3>Upcoming <span class="second-widget-title">Events</span> </h3>
            </div>

            <div class="widgets-col">

                <div class="event-widgets clearfix">                                                          
                    <div class="event-w-data">
                        <div class="event-w-day">20</div>
                        <div class="event-w-month"> Mar</div>
                    </div><!-- .event-w-data-->
                    <div class="event-w-title"> <a href="#" rel="bookmark" title="Despite Secret Guests">Despite Secret<span class="event-w-subtitle"> Guests</span></a></div>
                </div><!-- .event-widgets-->
                                                             		
            </div><!-- .event-widgets-col-->
            
            <div class="widgets-col">

                <div class="event-widgets clearfix">                                                          
                    <div class="event-w-data">
                        <div class="event-w-day">20</div>
                        <div class="event-w-month"> Mar</div>
                    </div><!-- .event-w-data-->
                    <div class="event-w-title"> <a href="#" rel="bookmark" title="Despite Secret Guests">Despite <span class="event-w-subtitle"> Guests</span></a></div>
                </div><!-- .event-widgets-->
                                                             		
            </div><!-- .event-widgets-col-->
            
        </div><!-- .event-widgets-col-->     
    */ ?> 
    </div><!-- .cont-widgets--> 
    
</div>

<?php get_footer(); ?>
