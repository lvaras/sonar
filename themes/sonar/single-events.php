<?php get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<div class="container-event clearfix">
	<h1><?php the_title() ?></h1>
	<h2>Starting Date: </h2>
	<?php echo get_post_meta( get_the_ID() , "_starting_date" , true ); ?> at <?php echo get_post_meta( get_the_ID() , "_starting_time" , true ); ?>
	<h2>Ending Date: </h2>
	<?php echo get_post_meta( get_the_ID() , "_ending_date" , true ) ?> at <?php echo get_post_meta( get_the_ID() , "_ending_time" , true ); ?>
	<div id="map" 
		data-address="<?php echo get_post_meta( get_the_ID() , "_address" , true ); ?>"
		data-lat="<?php echo get_post_meta( get_the_ID() , "_latitude" , true ); ?>" 
		data-long="<?php echo get_post_meta( get_the_ID() , "_longitude" , true ); ?>"></div>
	<style type="text/css">
		#map { width: 100%; height: 300px; }
	</style>
</div>
<?php endwhile; endif; ?>

<?php get_footer(); ?>