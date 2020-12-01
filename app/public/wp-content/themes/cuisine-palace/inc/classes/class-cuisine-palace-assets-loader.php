<?php
/**
 * This is a class file which handles the loading of styles and scripts.
 *
 * @package cuisine-palace
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Cuisine_Palace_Assets_Loader' ) ) {

	/**
	 * Loads the theme assets.
	 */
	class Cuisine_Palace_Assets_Loader {

		/**
		 * Theme current version.
		 *
		 * @var string
		 */
		public $theme_version;

		/**
		 * Whether or not use the minified version of assets.
		 *
		 * @var bool
		 */
		public $use_minified = false;

		/**
		 * Assets directory uri..
		 *
		 * @var bool
		 */
		public $assets_dir_uri = false;

		/**
		 * Initialize class.
		 */
		public function __construct() {
			$this->theme_version  = wp_get_theme()->get( 'Version' );
			$this->use_minified   = defined( 'SCRIPT_DEBUG' ) && ! SCRIPT_DEBUG;
			$this->assets_dir_uri = get_template_directory_uri() . '/assets';

			add_action( 'wp_enqueue_scripts', array( $this, 'load_scripts' ) );
		}

		/**
		 * Loads styles and scripts to hook.
		 */
		public function load_scripts() {
			$this->enqueue_styles();
			$this->enqueue_scripts();
		}

		/**
		 * Converts the hex color value to rgb color value.
		 *
		 * @param string $color Hex color value.
		 */
		public function hex_to_rgb( $color ) {

			$default = '0,0,0';

			// Return default if no color provided.
			if ( empty( $color ) ) {
				return $default;
			}

			// Sanitize $color if "#" is provided.
			if ( '#' === $color[0] ) {
				$color = substr( $color, 1 );
			}

			// Check if color has 6 or 3 characters and get values.
			if ( strlen( $color ) === 6 ) {
				$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
			} elseif ( strlen( $color ) === 3 ) {
				$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
			} else {
				return $default;
			}

			// Convert hexadec to rgb.
			$rgb = array_map( 'hexdec', $hex );

			$output = implode( ',', $rgb );

			// Return rgb(a) color string.
			return $output;
		}


		/**
		 * Creates the css variables that will be later used by the css files or sass files.
		 */
		public function css_variables() {
			$primary_color   = sanitize_hex_color( cuisine_palace_get_theme_mod( 'cuisine_palace_wp_core_colors', 'colors', 'primary_color' ) );
			$secondary_color = sanitize_hex_color( cuisine_palace_get_theme_mod( 'cuisine_palace_wp_core_colors', 'colors', 'secondary_color' ) );
			?>
			<style id="cuisine-css-variables">
				:root {
					--Cuisine-palace-primary-color: <?php echo esc_attr( $primary_color ); ?>;
					--Cuisine-palace-primary-rbga: <?php echo esc_attr( $this->hex_to_rgb( $primary_color, 0.7 ) ); ?>;
					--Cuisine-palace-secondary-rbga: <?php echo esc_attr( $this->hex_to_rgb( $secondary_color, 0.7 ) ); ?>;
					--Cuisine-palace-secondary-color: <?php echo esc_attr( $secondary_color ); ?>;
				}
			</style>
			<?php
		}

		/**
		 * Returns the array of styles attributes.
		 */
		public function list_styles() {

			$styles = array(
				'fontawesome' => array(
					'file'    => 'all',
					'version' => '5.11.2',
				),
			);

			return $styles;

		}

		/**
		 * Returns the array of scripts attributes.
		 */
		public function list_scripts() {

			$scripts = array(
				'navigation' => array(
					'file'    => 'navigation',
					'version' => '1.0.0',
				),
				'tab'        => array(
					'file'    => 'tab',
					'version' => '1.0.0',
				),
				'wow'        => array(
					'file'    => 'wow',
					'version' => 'v1.1.2',
				),
				'custom'     => array(
					'file' => 'custom',
				),
			);

			return $scripts;

		}

		/**
		 * Register and enqueue the stylesheets.
		 */
		private function enqueue_styles() {
			$styles         = $this->list_styles();
			$use_minified   = $this->use_minified;
			$theme_version  = $this->theme_version;
			$assets_dir_uri = $this->assets_dir_uri;

			$suffix = $use_minified ? '.min.css' : '.css';

			/**
			 * Load CSS variables at top so that we can use it in styles files.
			 */
			$this->css_variables();

			wp_enqueue_style( 'cuisine-palace-font-great-vibes', 'https://fonts.googleapis.com/css2?family=Great+Vibes:wght@100;200;300;400;500;531;600;700;800;900&display=swap', array(), '1.0.0' );
			wp_enqueue_style( 'cuisine-palace-font-heebo', 'https://fonts.googleapis.com/css2?family=Heebo:wght@100;200;300;400;500;531;600;700;800;900&display=swap', array(), '1.0.0' );
			wp_enqueue_style( 'cuisine-palace-font-roboto', 'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap', array(), '1.0.0' );

			if ( is_array( $styles ) && count( $styles ) > 0 ) {
				foreach ( $styles as $style_handle => $style_attrs ) {
					$handle  = "cuisine-palace-{$style_handle}-css";
					$version = ! empty( $style_attrs['version'] ) ? $style_attrs['version'] : $theme_version;
					$file    = ! empty( $style_attrs['file'] ) ? $style_attrs['file'] : false;
					$src     = "{$assets_dir_uri}/css/{$file}{$suffix}";

					wp_enqueue_style( $handle, $src, array(), $version, 'all' );

				}
			}
			wp_enqueue_style( 'cuisine-palace-slick', get_template_directory_uri() . '/assets/slick/slick.css', array(), '1.8.1' );
			wp_enqueue_style( 'cuisine-palace-slick-theme', get_template_directory_uri() . '/assets/slick/slick-theme.css', array(), '1.8.1' );
			wp_enqueue_style( 'cuisine-palace-stylesheet', get_stylesheet_uri(), array(), $theme_version );
			wp_style_add_data( 'cuisine-palace-stylesheet', 'rtl', 'replace' );
		}

		/**
		 * Register and enqueue the scripts.
		 */
		private function enqueue_scripts() {
			$scripts        = $this->list_scripts();
			$use_minified   = $this->use_minified;
			$theme_version  = $this->theme_version;
			$assets_dir_uri = $this->assets_dir_uri;

			$suffix = $use_minified ? '.min.js' : '.js';

			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'cuisine-palace-slick', get_template_directory_uri() . "/assets/slick/slick{$suffix}", array(), '1.8.1', true );

			if ( is_array( $scripts ) && count( $scripts ) > 0 ) {
				foreach ( $scripts as $script_handle => $script_attrs ) {
					$handle  = "cuisine-palace-{$script_handle}-js";
					$version = ! empty( $script_attrs['version'] ) ? $script_attrs['version'] : $theme_version;
					$file    = ! empty( $script_attrs['file'] ) ? $script_attrs['file'] : false;
					$deps    = ! empty( $script_attrs['deps'] ) ? $script_attrs['deps'] : array();
					$src     = "{$assets_dir_uri}/js/{$file}{$suffix}";

					wp_enqueue_script( $handle, $src, $deps, $version, true );
				}
			}

			if ( is_singular() ) {
				wp_enqueue_script( 'comment-reply' );
			}
		}

	}

	new Cuisine_Palace_Assets_Loader();
}
