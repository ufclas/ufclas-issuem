<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package ufclas-issuem
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1" />

<!-- Allow web app to be run in full-screen mode. -->
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="mobile-web-app-capable" content="yes" />

<!-- Make the app title different than the page title. -->
<meta name="apple-mobile-web-app-title" content="CLAS IT Connections" />

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<!-- ======================================================================================================================= HEADER NAVBAR -->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid nopadding">
    <div class="navbar-header">
      <button type="button" data-toggle="collapse" data-target="#navbar-collapse-1" class="navbar-toggle"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a href="http://clas.ufl.edu/" target="_blank" id="logo"><span class="text-hide">College of Liberal Arts and Sciences</span></a> 
      <a href="<?php echo site_url(); ?>" id="mobile-title"><?php bloginfo('name'); ?></a>
    </div>
    
    <div id="navbar-collapse-1" class="navbar-collapse collapse">
        <div class="row" id="global">
          <ul class="nav navbar-nav service">
		  	<?php 
                   wp_nav_menu( array( 
                        'theme_location' => 'newsletter-global',
                        'container' => '',
                        'menu_class' => '', 
                        'fallback_cb' => 'wp_bootstrap_navwalker::fallback', 
                        'walker' => new wp_bootstrap_navwalker(),
                        'depth' => 2,
                    ));
                ?>
            </ul>
          </div>
          <div class="row" id="navigation">
            <div id="website"><a href="http://www.clas.ufl.edu/"><img src="<?php echo plugins_url('/images/logo.svg', __FILE__); ?>" class="img-responsive" alt="Liberal Arts and Sciences"> </a></div>
            <?php 
                wp_nav_menu( array( 
                    'theme_location' => 'newsletter-primary',
                    'menu_class' => 'nav navbar-nav yamm', 
                    'menu_id' => 'site-nav', 
                    'fallback_cb' => 'wp_bootstrap_navwalker::fallback', 
                    'walker' => new wp_bootstrap_navwalker(),
                    'depth' => 2,
                )); 
            ?>
        </div>
      </div>
    </div>
</nav>

<div id="content" class="container">
<div class="row">
