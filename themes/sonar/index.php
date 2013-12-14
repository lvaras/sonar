<?php get_header(); ?>

<div class="container clearfix">
    <?php
    $posts = get_posts( home_page_query() );
    events_order($posts);
    foreach ($posts as $post) : 
        setup_postdata( $post );
        ?>
        <a href="<?php the_permalink(); ?>">
        <div class="event">
            <?php the_title(); ?>
            <br/>
            <?php echo get_post_meta( get_the_ID() , "_starting_date" , true ) ?>
            <br/>
            <?php echo get_post_meta( get_the_ID() , "_starting_time" , true ) ?>
            <br/>
            <?php echo get_post_meta( get_the_ID() , "_endind_date" , true ) ?>
            <br/>
            <?php echo get_post_meta( get_the_ID() , "_endind_time" , true ) ?>
        </div>
        </a>
    <?php endforeach; ?>
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