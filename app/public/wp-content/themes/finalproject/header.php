<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bootcamp2
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<!-- head untuk css/js -->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'bootcamp2'); ?></a>

		<!-- site-header -->
		<header id="site-header" class="site-header">
			<!-- top-header -->
			<div id="site-top-header" class="site-top-header">
				<?php echo do_shortcode("[layout layout_id=88]"); ?>
			</div>

			<!-- site main navbar -->
			<div id="site-header-main-navbar" class="site-header-main-navbar">
				<!-- site branding/logo -->
				<div class="site-branding">
					<?php the_custom_logo(); ?>
				</div>

				<!-- site navigation menu -->
				<nav id="site-navigation" class="main-navigation">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						)
					);
					?>
				</nav>

				<!-- button untuk menu mobile -->
				<button class="hamburger-menu btn-toggle-state">
					<span></span>
					<span></span>
					<span></span>
				</button>
			</div>
			<!-- end site main navbar -->

		</header><!-- #site-header -->
