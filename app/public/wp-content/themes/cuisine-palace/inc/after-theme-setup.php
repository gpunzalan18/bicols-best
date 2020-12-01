<?php
/**
 * This file sets up theme defaults and registers support for various WordPress features.
 *
 * @package cuisine-palace
 * @subpackage inc/
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cuisine_palace_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'cuisine_palace_content_width', 640 ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
}
add_action( 'after_setup_theme', 'cuisine_palace_content_width', 0 );


if ( ! function_exists( 'cuisine_palace_theme_setup' ) ) {

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function cuisine_palace_theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'cuisine-palace', get_template_directory() . '/languages' );

		/**
		 * Add default posts and comments RSS feed links to head.
		 */
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * This theme uses wp_nav_menu() in header.php only.
		 */
		register_nav_menus(
			array(
				'primary-menu' => esc_html__( 'Primary Menu', 'cuisine-palace' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/**
		 * Support for custom logo in site identity.
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 100,
				'width'       => 400,
				'flex-height' => true,
				'flex-width'  => true,
				'header-text' => array( 'site-title', 'site-description' ),
			)
		);

		/**
		 * Set up the WordPress core custom background feature.
		 */
		add_theme_support(
			'custom-background',
			apply_filters(
				'cuisine_palace_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		/**
		 * Set up the WordPress core custom header feature.
		 *
		 * @see cuisine_palace_header_style_callback()
		 */
		add_theme_support(
			'custom-header',
			array(
				'default-image'      => '',
				'default-text-color' => 'ffffff',
				'width'              => 1000,
				'height'             => 250,
				'flex-width'         => true,
				'flex-height'        => true,
				'wp-head-callback'   => 'cuisine_palace_header_style_callback',
			)
		);

		/**
		 * Selective refresh for widgets.
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
	add_action( 'after_setup_theme', 'cuisine_palace_theme_setup' );
}


if ( ! function_exists( 'cuisine_palace_header_style_callback' ) ) {

	/**
	 * A callback function for custom header.
	 */
	function cuisine_palace_header_style_callback() {
		$header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text.
		 * Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
			?>
			.site-title,
			.site-description {
				position: absolute;
				display: none;
				}
			<?php
			// If the user has set a custom color for the text use that.
		else :
			?>
			.site-title a,
			.site-description {
				color: <?php echo esc_attr( "#{$header_text_color}" ); ?> !important;
			}
		<?php endif; ?>
		</style>
		<?php
	}
}
