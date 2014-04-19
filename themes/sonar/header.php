<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php wp_title(); ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
		<?php sonar_favicons();	?>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class( get_customization_classes() . of_get_option('theme_skin') ); ?> >
    <div class="page-sonar clearfix">
	    <header class="main-header clearfix">
	        <div class="logo">
	            <h1>
	                <a href="<?php echo get_site_url(); ?>" title="<!-- °°°°°°°°°°°°°°° -->" class="fit_link">
		                <img src="<?php echo of_get_option('logo') ?>" alt="<!-- °°°°°°°°°°°°°°° -->" />
		                <span class="hidden"><!-- °°°°°°°°°°°°°°° --></span>
	                </a>
	            </h1>
	        </div>
	        <?php wp_nav_menu( array( 'theme_location' => 'header-menu') ); ?>
	    </header>