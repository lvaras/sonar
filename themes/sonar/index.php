<?php get_header(); ?>
<div class="page-sonar clearfix">
    <div class="slider">
        <div class="slider-box">
            <a class="slide fit_link" href="#" title="<!-- 같같같같 -->">
                <img src="<?php bloginfo("template_directory"); ?>/img/slider_prova.png" src="<!-- 같같같같같같같� -->" />
                <div class="slide-title">Varas cazzo mollo V.S. Ale ano pubblico</div>
                <div class="slide-subtitle">Ano spazioso e viagra gratis <span class="slide-location">/ london</span></div>
            </a>
        </div>
    </div>
</div>
<div class="page-sonar-wall clearfix">
    <div class="cont-wall clearfix">
        <?php
        $posts = get_posts( home_page_query() );
        events_order($posts);
        foreach ($posts as $post) : 
            setup_postdata( $post );
            ?>
            <div class="box-wall box-wall-1x box-wall-event">
                <div class="box-wall-header">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <?php the_post_thumbnail(); ?>
                    </a>
                    <span class="box-wall-date"><b>23</b> apr</span>
                </div>
                <div class="box-wall-body">
                    <a class="box-wall-cont-title" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <span class="box-wall-title"><?php the_title(); ?></span>
                        <span class="box-wall-subtitle"><?php echo get_post_meta( get_the_id() , '_event_subtitle', true ); ?></span>
                    </a>
                </div>
            </div>
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