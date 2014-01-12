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

        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-bDm0-14-_9InjkCz1PJgoWcHibf7LfQ&sensor=true"></script>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
    <div class="page">
	    <header class="main-header clearfix">
	        <div class="logo">
	            <h1>
	                <a href="<?php echo get_site_url(); ?>" title="<!-- °°°°°°°°°°°°°°° -->" class="fit_link">
		                <img src="<?php bloginfo("template_directory"); ?>/img/logo_header.png" src="<!-- °°°°°°°°°°°°°°° -->" />
		                <span class="hidden"><!-- °°°°°°°°°°°°°°° --></span>
	                </a>
	            </h1>
	        </div>
	        <?php wp_nav_menu( array( 'theme_location' => 'header-menu') ); ?>
	        <?php /*
	        <div class="menu">
	            <ul class="clearfix">
	                <li>
	                    <a href="#">events</a>
	                </li>
	                <li>
	                    <a href="#">blog</a>
	                </li>
	                <li>
	                    <a href="#">about</a>
	                </li>
	                <li>
	                    <a href="#">contact</a>
	                </li>
	            </ul>
	        </div>
	        */ ?>
	    </header>