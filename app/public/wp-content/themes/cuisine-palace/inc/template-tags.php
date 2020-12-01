<?php
/**
 * This file has the helper functions for the templates.
 * For ex: Breadcrumbs, Author Meta, Date, etc.
 *
 * @package cuisine-palace
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'cuisine_palace_get_site_identity' ) ) {

	/**
	 * Retrives and prints the html for site identity.
	 *
	 * @uses cuisine_palace_get_site_logo()
	 * @uses cuisine_palace_get_site_branding($is_footer)
	 *
	 * @param bool $is_footer If passed true, it will exclude the site tagline.
	 */
	function cuisine_palace_get_site_identity( $is_footer = false ) {
		?>
			<div class="logo">

				<div class="site-identity">

					<?php
					if ( ! $is_footer ) {
						cuisine_palace_get_site_logo();
					}

					/**
					 * If we are in footer and the display logo has been enabled from Theme Options > Footer.
					 */
					if ( $is_footer && cuisine_palace_get_theme_mod( 'cuisine_palace_theme_options', 'cuisine_palace_theme_options_footer', 'display_site_logo' ) ) {
						cuisine_palace_get_site_logo();
					}

					cuisine_palace_get_site_branding( $is_footer );
					?>

				</div><!-- .site-identity -->

			</div><!-- .logo -->

		<?php
	}
}

if ( ! function_exists( 'cuisine_palace_get_site_logo' ) ) {

	/**
	 * Returns or prints the html for custom logo.
	 *
	 * @param bool $echo Display or return the logo html.
	 */
	function cuisine_palace_get_site_logo( $echo = true ) {

		/**
		 * Bail early if these functions are not available.
		 */
		if ( ! function_exists( 'get_custom_logo' ) ) {
			return;
		}
		if ( ! function_exists( 'the_custom_logo' ) ) {
			return;
		}

		if ( ! $echo ) {
			return get_custom_logo();
		}

		the_custom_logo();
	}
}

if ( ! function_exists( 'cuisine_palace_get_site_branding' ) ) {

	/**
	 * Prints the site title and description with html.
	 *
	 * @param bool $is_footer If passed true, it will exclude the site tagline.
	 */
	function cuisine_palace_get_site_branding( $is_footer = false ) {

		if ( ! $is_footer && ! display_header_text() ) {
			return;
		}

		$site_title = get_bloginfo();
		$tagline    = ! $is_footer && get_bloginfo( 'description' ) ? sprintf( '<p class="site-description">%s</p>', esc_html( get_bloginfo( 'description' ) ) ) : '';

		if ( ! $site_title && ! $tagline ) {
			return;
		}

		?>
			<div class="site-branding-text" >
				<?php if ( $site_title ) { ?>
					<h1 class="site-title">
						<a href="<?php echo esc_url( home_url() ); ?>" rel="<?php esc_attr_e( 'home', 'cuisine-palace' ); ?>"><?php echo esc_html( $site_title ); ?></a>
					</h1>
				<?php } ?>
				<?php echo wp_kses_post( $tagline ); ?>
			</div>
		<?php
	}
}


if ( ! function_exists( 'cuisine_palace_get_banner_title' ) ) {

	/**
	 * Prints the sanitized html for current page banner title.
	 * ! Do not use it as the_title() alternative.
	 *
	 * @uses is_archive()
	 * @uses is_singular()
	 * @uses get_the_archive_title()
	 * @uses wp_title()
	 * @uses the_title()
	 *
	 * @param string $before Element before the title.
	 * @param string $after Element after the title.
	 * @param string $echo Print or return the html.
	 */
	function cuisine_palace_get_banner_title( $before = '', $after = '', $echo = true ) {

		$title = is_archive() ? get_the_archive_title() : wp_title( '', false );

		/**
		 * If we are in single page or post then use the default the_title() function for better formatting.
		 */
		if ( is_singular() ) {
			$title = the_title( '', '', false );
		}

		if ( ! $title ) {
			return;
		}

		if ( ! $echo ) {
			return $before . $title . $after;
		}

		echo wp_kses_post( $before . $title . $after );

	}
}


if ( ! function_exists( 'cuisine_palace_get_breadcrumb' ) ) {

	/**
	 * Returns the html for breadcrumbs if $echo is provided false else prints it.
	 *
	 * @param bool $echo Echo or return the html.
	 */
	function cuisine_palace_get_breadcrumb( $echo = true ) {

		if ( ! class_exists( 'Cuisine_Palace_Breadcrumb_Trail' ) ) {
			require_once get_template_directory() . '/inc/classes/class-cuisine-palace-breadcrumb-trail.php';
		}

		$breadcrumb            = '';
		$use_yoast_breadcrumbs = function_exists( 'yoast_breadcrumb' ) && yoast_breadcrumb( '', '', false ) ? true : false;

		$args = array(
			'container'     => 'div',
			'show_on_front' => false,
			'show_browse'   => false,
			'echo'          => false,
		);

		$is_showable = cuisine_palace_breadcrumb_trail( $args );

		$breadcrumb .= '<!-- Breadcrumb Starts -->';

		if ( $use_yoast_breadcrumbs ) {
			/**
			 * Add support for yoast breadcrumb.
			 */
			$breadcrumb .= yoast_breadcrumb( '<div id="cuisine-palace-breadcrumb"><div class="container">', '</div></div><!-- Breadcrumbs-end -->', false );
		} else {
			if ( $is_showable ) {
				$breadcrumb .= '<div id="cuisine-palace-breadcrumb">';
				$breadcrumb .= '<div class="container">';
				$breadcrumb .= cuisine_palace_breadcrumb_trail( $args );
				$breadcrumb .= '</div>';
				$breadcrumb .= '</div>';
			}
		}

		$breadcrumb .= '<!-- Breadcrumb Ends -->';

		if ( ! $echo ) {
			return $breadcrumb;
		}
		echo $breadcrumb; // phpcs:ignore
	}
}


if ( ! function_exists( 'cuisine_palace_get_the_author' ) ) {

	/**
	 * Prints the html with the author info and author archive link.
	 */
	function cuisine_palace_get_the_author() {
		$author_id = get_the_author_meta( 'ID' );

		if ( ! $author_id ) {
			return;
		}

		$author_name  = get_the_author_meta( 'display_name' );
		$author_posts = get_author_posts_url( $author_id );
		?>
			<span class="author-img posted-by">
				<span class="author">
					<a href="<?php echo esc_url( $author_posts ); ?>">
						<?php echo wp_kses_post( get_avatar( $author_id, 150 ) ); ?>
						<span class="author-name">
							<?php echo esc_html( $author_name ); ?>
						</span>
					</a>
				</span>
			</span>
		<?php
	}
}


if ( ! function_exists( 'cuisine_palace_get_the_date' ) ) {

	/**
	 * Prints the html with the date and date archive link.
	 */
	function cuisine_palace_get_the_date() {
		$date_link = ! is_singular() ? get_the_permalink() : get_day_link( get_the_time( 'Y' ), get_the_time( 'm' ), get_the_time( 'd' ) );
		$date      = get_the_date();
		ob_start();
		?>
			<div class="date-meta">
				<span class="posted-on">
					<a href="<?php echo esc_url( $date_link ); ?>">
						<?php echo esc_html( $date ); ?>
					</a>
				</span>
			</div>
		<?php
		$content = ob_get_clean();
		echo wp_kses_post( $content );
	}
}

if ( ! function_exists( 'cuisine_palace_frontpage_section_header' ) ) {

	/**
	 * Prints the html for frontpage section heading and sub heading.
	 */
	function cuisine_palace_frontpage_section_header( $heading = '', $sub_heading = '' ) {
		if ( ! $heading && ! $sub_heading ) {
			return;
		}
		?>

		<div class="section-header">
			<div class="container">
				<div class="section-header-content">
					<?php
					if ( $heading ) {
						?>
						<p class="sub-title"><?php echo esc_html( $heading ); ?></p>
						<?php
					}

					if ( $sub_heading ) {
						?>
						<h2 class="title"><?php echo esc_html( $sub_heading ); ?></h2>
						<?php
					}
					?>
				</div>
			</div>
		</div>

		<?php
	}
}
