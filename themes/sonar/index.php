<?php get_header(); ?>

<div class="container clearfix">
    <div class="session-box">
        <h3> 
            <span>tonight</span>
        </h3>
        <div class="down-triangle"></div>
    </div>
    <div class="slider">
        <div class="slider-box">
            <a class="slide fit_link" href="#" title="<!-- 같같같같 -->">
                <img src="<?php bloginfo("template_directory"); ?>/img/slider_prova.png" src="<!-- 같같같같같같같� -->" />
                <div class="slide-title">Varas cazzo mollo V.S. Ale ano pubblico</div>
                <div class="slide-subtitle">Ano spazioso e viagra gratis <span class="slide-location">/ london</span></div>
            </a>
        </div>
    </div>
    <div class="session-box">
        <h3>
            <span>upcoming events</span>
        </h3>
        <div class="down-triangle"></div>
    </div>
    <div class="cont-event clearfix">
        <?php
        $posts = get_posts( home_page_query() );
        events_order($posts);
        foreach ($posts as $post) : 
            setup_postdata( $post );
            ?>
            <a class="event" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <div>
                    <h2 class="event-cont-title">
                        <span class="event-title"><?php the_title(); ?></span>
                        <span class="event-subtitle"><?php echo get_post_meta( get_the_id() , '_event_subtitle', true ); ?></span>
                    </h2>
                    <div class="event-ribbon">
                        <div class="event-date">
                            <div>
                                <span class="event-mounth">apr</span>
                                <span class="event-day">23</span>
                            </div>
                        </div>
                    </div>
                    <?php if ( has_post_thumbnail() ) { ?>
                        <div class="event-img" >
                            <?php the_post_thumbnail(); ?>
                        </div>
                    <?php } ?>
                    <div class="event-info" >
                        <ul class="event-list">
                            <li>
                                <span class="event-list-title">Open</span>
                                <span class="event-list-info">: <?php echo get_post_meta( get_the_ID() , "_starting_time" , true ) ?></span>
                            </li>
                            <li>
                                <span class="event-list-title">Close</span>
                                <span class="event-list-info">: <?php echo get_post_meta( get_the_ID() , "_endind_time" , true ) ?></span>
                            </li>
                            <li>
                                <span class="event-list-title">Starting date</span>
                                <span class="event-list-info">: <?php echo get_post_meta( get_the_ID() , "_starting_date" , true ) ?></span>
                            </li>
                            <li>
                                <span class="event-list-title" >Endind date</span>
                                <span class="event-list-info">: <?php echo get_post_meta( get_the_ID() , "_endind_time" , true ) ?></span>
                            </li>
                        </ul>
                    </div>
                    <div class="event-decription">
                        <?php the_content('Read more...',12); ?>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
    <?php
        $big = 999999999; 
        echo paginate_links( 
            array(
                'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
                'format' => '?paged=%#%',
                'current' => max( 1, get_query_var('paged') ),
                'total' => count($posts)
            ) 
        );
    ?>
</div>

<?php get_footer(); ?>