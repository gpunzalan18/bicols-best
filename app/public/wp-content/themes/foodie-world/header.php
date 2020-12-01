<?php
/**
* The header for our theme
*
* This is the template that displays all of the <head> section and everything up until <div id="content">
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package Foodie_World
*/

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'wp_body_open' );  ?>

	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'foodie-world' ); ?></a>

		<header id="masthead" class="site-header">
			<div class="site-header-main">
				<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>

				<div class="nav-search-wrap">

					<?php get_template_part( 'template-parts/header/site', 'navigation' ); ?>

					<?php get_template_part( 'template-parts/header/top', 'search' ); ?>

				</div>

			</div> <!-- .site-header-main -->
		</header><!-- #masthead -->

		<div class="below-site-header">

			<div class="site-overlay"><span class="screen-reader-text"><?php esc_html_e( 'Site Overlay', 'foodie-world' ); ?></span></div>

			<?php get_template_part( 'template-parts/header/breadcrumb' ); ?>

			<?php get_template_part( 'template-parts/slider/content', 'display' ); ?>

			<?php get_template_part( 'template-parts/header/header', 'media' ); ?>

			<?php get_template_part( 'template-parts/hero-content/content', 'hero' ); ?>

			<?php get_template_part( 'template-parts/promotion-headline/content', 'promotion-headline' ); ?>

			<?php get_template_part( 'template-parts/services/display', 'services' ); ?>

			<?php get_template_part( 'template-parts/food-menu/display', 'menu' ); ?>

			<?php ! get_theme_mod( 'foodie_world_featured_content_position' ) ? get_template_part( 'template-parts/featured-content/display', 'featured' ) : ''; ?>
			<?php
			$enable_homepage_posts = foodie_world_enable_homepage_posts();

			if ( $enable_homepage_posts ) : ?>
			<div id="content" class="site-content">
				<div class="wrapper">
			<?php endif; ?>

