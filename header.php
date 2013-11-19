<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>
	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title><?php wp_title(''); ?><?php if(wp_title(' ', false)) { echo ' - '; } ?><?php bloginfo('name'); ?></title>
  <meta name="description" content="Saanich Best Practicve Management documents"/>
	<meta name="author" content="Designed by Saanich IT Department, Joel Friesen">
  <meta name="robots" content="index, follow" />
	<meta name="googlebot" content="index, follow" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	
  <!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">

	<!-- CSS
  ================================================== -->
  <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/style.css">
  <link href='http://fonts.googleapis.com/css?family=Special+Elite' rel='stylesheet' type='text/css'>
	<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Favicons
  ================================================== -->
  
  <link rel="apple-touch-icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.png">
  <link rel="apple-touch-icon" sizes="16x16" href="<?php bloginfo('template_directory'); ?>/images/apple-touch-icon-16x16.png">
  <link rel="apple-touch-icon" sizes="32x32" href="<?php bloginfo('template_directory'); ?>/images/apple-touch-icon-32x32.png">
  <link rel="apple-touch-icon" sizes="48x48" href="<?php bloginfo('template_directory'); ?>/images/apple-touch-icon-48x48.png">
  <link rel="apple-touch-icon" sizes="64x64" href="<?php bloginfo('template_directory'); ?>/images/apple-touch-icon-64x64.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('template_directory'); ?>/images/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('template_directory'); ?>/images/apple-touch-icon-114x114.png">
  <link rel="icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.png">
  <!--[if IE]><link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico"><![endif]-->
  <!-- or, set /favicon.ico for IE10 win -->
  <meta name="msapplication-TileColor" content="#98e048">
  <meta name="msapplication-TileImage" content="<?php bloginfo('template_directory'); ?>/images/favicon.png">

  <!-- JQuery, analytics and WP scripts
	================================================== -->   
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/menu.js"></script>
  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/responsiveslides.min.js"></script>
  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/analytics.js"></script>
  <script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<script type="text/javascript">
    $(document).ready(function() 
        {
        	$(".wp-caption a[href*='/wp-content/uploads/'],.gallery-icon a[href*='/wp-content/uploads/'],.attachment a[href*='/wp-content/uploads/'],.ngg-gallery-thumbnail a[href*='/wp-content/gallery/']").fancybox({'titlePosition' : 'inside'});
		});
    </script> 
    <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
    <?php wp_head(); ?>
</head>

<body>
  <label for="main-nav-check" class="toggle-menu">Navigation</label>
  <input type="checkbox" class="main-nav-check" id="main-nav-check" /> 
  <nav class="menubar mobile-nav" id="mobile-nav">
    <?php wp_nav_menu(array( 'theme_location' => 'secondary-menu', 'container_class' => 'container' ) );?>
  </nav> 

  <div class="navdecoration"></div>
  
  <div class="main">
    <div class="container fourcol header">
      <div class="logo col ">
        <h1><a href="<?php bloginfo('url'); ?>"><span><?php bloginfo('name'); ?></span></a></h1>
      </div>
      <div class="navholder col spanthree">
        <nav class="menubar main-nav" id="main-nav">
          <?php wp_nav_menu(array('theme_location' => 'primary-menu'));?>
        </nav>
      </div>
    </div>