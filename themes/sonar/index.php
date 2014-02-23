<?php get_header(); ?>

<div class="container clearfix">
    <div class="session-box">
        <h3>
            <span>Tonight</span>
        </h3>
        <div class="graphic-line"></div>
        <div class="down-triangle"></div>
        <div class="graphic-line"></div>
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
        <div class="graphic-line"></div>
        <div class="down-triangle"></div>
        <div class="graphic-line"></div>
    </div>
    <div class="cont-event clearfix">
        <?php get_template_part('includes/modules/event_wall'); ?>
    </div>
    <?php
    // da fixxare
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