<?php
/**
 * Theme main header file.
 *
 * @package cuisine-palace
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php
	/**
	 * This function automatically hooks the styles and scripts
	 * that are needed inside <head>
	 *
	 * It is also used by other plugins or child theme developer.
	 */
	wp_head();
	?>
</head>

<body <?php body_class(); ?>>
	<?php

	/**
	 * Hook right after body opens.
	 * This hook can be used by other plugins
	 * or child theme developers.
	 */
	do_action( 'wp_body_open' ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound
	?>
	<!-- This adds the accessibility option for "Skip to content". -->
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip To Content', 'cuisine-palace' ); ?></a>

	<!-- Our main section starts from here, this div is closed in footer -->
	<div id="<?php cuisine_palace_get_main_container_id(); ?>" class="site">

		<?php

		/**
		 * Hook before site header wrapper starts.
		 */
		do_action( 'cuisine_palace_before_header_wrapper' );

		?>

		<div class="site-header-wrapper">

			<?php

			/**
			 * Hook before the header navigation contents starts.
			 *
			 * @see inc/template-functions.php
			 * @hooked cuisine_palace_top_bar() - 15
			 */
			do_action( 'cuisine_palace_before_header_content_wrapper' );
			?>

			<!-- -------------navigation bar--------------------->
			<div class="header-content">

				<div class="container">

					<div class="wrapper">

						<header class="header">

							<?php

							/**
							 * Prints the html for site logo.
							 * It returns the logo image or site title and tagline accordingly.
							 *
							 * @see inc/template-tags.php
							 */
							cuisine_palace_get_site_identity();

							?>

							<div class="right-content">

								<?php

								/**
								 * Hook right before the theme nav tag starts.
								 */
								do_action( 'cuisine_palace_before_header_nav' );
								?>

								<div class="theme-primary-navigation right-content-item">
									<nav id="site-navigation" class="main-navigation">

										<div class="toggle-button-wrapper">
											<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
												<span class="menu-toggle__text"><?php esc_html_e( 'Toggle Menu', 'cuisine-palace' ); ?></span>
											</button>
										</div>

										<?php

										/**
										 * Theme main menu [Primary Menu].
										 */
										wp_nav_menu(
											array(
												'container' => 'div',
												'container_class' => 'navigation-bar',
												'menu_id' => 'primary-menu',
												'fallback_cb' => 'cuisine_palace_menu_fallback',
												'theme_location' => 'primary-menu',
											)
										);
										?>

									</nav><!-- #site-navigation -->
								</div><!-- #theme-primary-navigation -->

								<?php

								/**
								 * Hook right after the theme nav tag ends.
								 *
								 * @see inc/template-functions.php
								 * @hooked cuisine_palace_header_search_form() - 15
								 */
								do_action( 'cuisine_palace_after_header_nav' );
								?>

							</div>


						</header>

					</div><!-- .wrapper -->

				</div><!-- .container -->

			</div><!-- .header-content -->

			<?php

			/**
			 * Hook after the header navigation contents ends.
			 */
			do_action( 'cuisine_palace_after_header_content_wrapper' );
			?>


		</div><!-- .site-header-wrapper -->

		<?php

		/**
		 * Hook after site header wrapper ends.
		 *
		 * @see inc/template-functions.php
		 * @hooked cuisine_palace_frontpage_banner_slider - 10
		 * @hooked cuisine_palace_page_banner - 15
		 */
		do_action( 'cuisine_palace_after_header_wrapper' );
