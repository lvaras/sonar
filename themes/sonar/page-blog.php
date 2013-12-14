<?php get_header(); ?>

<div class="container clearfix">
	<?php 
		$posts = get_posts( array("number_of_posts" => -1 , "post_type" => "post") );
		foreach($posts as $post) :
			setup_postdata( $post );
		?>
		<div class="blog-post">
			<h2><?php the_title(); ?></h2>
			<?php the_content(); ?>	
		</div>
		<?php endforeach; ?>
</div>

<?php get_footer(); ?>
