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
                    <?php 
                    $option_label = ['_starting_time' , '_ending_time', '_starting_date', '_ending_time'];
                    foreach ($option_label as $label) :
                        $event_meta = get_post_meta( get_the_ID() , $label , true );
                        if( !trimmed_empty( $event_meta ) ) : 
                        ?>
                            <li>
                                <span class="event-list-title"><?php echo metavalue_to_class($label); ?></span>
                                <span class="event-list-info <?php echo metavalue_to_class($label); ?>">: 
                                    <?php echo $event_meta; ?>
                                </span>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="event-decription">
                <?php the_excerpt(); ?>
            </div>
        </div>
    </a>
<?php endforeach; ?>