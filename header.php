<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"><!--<![endif]-->
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
  <link href='///fonts.googleapis.com/css?family=Muli:300' rel='stylesheet' type='text/css'>
  <!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/oldie.css">
	<![endif]-->

	<!-- Favicons
  ================================================== -->
  <link rel="apple-touch-icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.png">
  <link rel="apple-touch-icon" sizes="57x57" href="<?php bloginfo('template_directory'); ?>/images/apple-touch-icon-57x57.png" />
  <link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('template_directory'); ?>/images/apple-touch-icon-114x114.png" />
  <link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('template_directory'); ?>/images/apple-touch-icon-72x72.png" />
  <link rel="apple-touch-icon" sizes="144x144" href="<?php bloginfo('template_directory'); ?>/images/apple-touch-icon-144x144.png" />
  <link rel="apple-touch-icon" sizes="60x60" href="<?php bloginfo('template_directory'); ?>/images/apple-touch-icon-60x60.png" />
  <link rel="apple-touch-icon" sizes="120x120" href="<?php bloginfo('template_directory'); ?>/images/apple-touch-icon-120x120.png" />
  <link rel="apple-touch-icon" sizes="76x76" href="<?php bloginfo('template_directory'); ?>/images/apple-touch-icon-76x76.png" />
  <link rel="apple-touch-icon" sizes="152x152" href="<?php bloginfo('template_directory'); ?>/images/apple-touch-icon-152x152.png" />
  <link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/images/favicon.png">
  <link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/images/favicon-16x16.png" sizes="16x16" />
  <link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/images/favicon-32x32.png" sizes="32x32" />
  <link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/images/favicon-96x96.png" sizes="96x96" />
  <link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/images/favicon-160x160.png" sizes="160x160" />
  <!--[if IE]><link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico"><![endif]-->
  <meta name="msapplication-TileColor" content="#ffffff" />
  <meta name="msapplication-TileImage" content="<?php bloginfo('template_directory'); ?>/images/mstile-144x144.png" />
  <meta name="msapplication-square70x70logo" content="<?php bloginfo('template_directory'); ?>/images/mstile-70x70.png" />
  <meta name="msapplication-square150x150logo" content="<?php bloginfo('template_directory'); ?>/images/mstile-150x150.png" />
  <meta name="msapplication-wide310x150logo" content="<?php bloginfo('template_directory'); ?>/images/mstile-310x150.png" />
  <meta name="msapplication-square310x310logo" content="<?php bloginfo('template_directory'); ?>/images/mstile-310x310.png" />

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
  <label for="main-nav-check" class="toggle-menu">&#9776; Navigation</label>
  <input type="checkbox" class="main-nav-check" id="main-nav-check" /> 
  <nav class="menubar mobile-nav" id="mobile-nav">
    <?php wp_nav_menu(array( 'theme_location' => 'secondary-menu', 'container_class' => 'container' ) );?>
  </nav> 
  
  <div class="topbar container fourcol">
    <div class="col spanthree">
      <h1 class="sitetitle"><a href="<?php bloginfo('url'); ?>" ><?php bloginfo('name'); ?></a></h1>
    </div>
    <div class="col topserach">
      <?php dynamic_sidebar('topbar') ?>
    </div>
  </div>

  <div class="navarea container fourcol">
    <div class="col bodybackgroundcolour rowholder">
      &nbsp;
    </div>
    <div class="col spanthree rowholder">
      <nav class="menubar main-nav" id="main-nav">
        <?php wp_nav_menu(array('theme_location' => 'primary-menu'));?>
      </nav>
    </div>
  </div>
  <div class="container headdecor">

  </div>
