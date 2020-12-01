<?php
/**
 * This is the main file for the customizer options.
 *
 * @package cuisine-palace
 * @subpackage inc/customizer
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'cuisine_palace_customizer_add_panels' ) ) {

	/**
	 * It initiates the panels to the customizer for the sections
	 * that will be later added accordingly in the respective files.
	 *
	 * @param object $wp_customize WordPress customizer objects.
	 */
	function cuisine_palace_customizer_add_panels( $wp_customize ) {

		$wp_customize->add_panel(
			'cuisine_palace_theme_options',
			array(
				'title'       => esc_html__( 'Theme Options', 'cuisine-palace' ),
				'description' => '<p>' . __( 'General theme options for customizing the over all feel of your website.', 'cuisine-palace' ) . '</p>',
				'priority'    => 130,
			)
		);

		$wp_customize->add_panel(
			'cuisine_palace_frontpage',
			array(
				'title'       => esc_html__( 'Front Page', 'cuisine-palace' ),
				'description' => '<p>' . __( 'Customize your frontpage sections. Please setup the static front page from Homepage Settings panel.', 'cuisine-palace' ) . '</p>',
				'priority'    => 140,
			)
		);

	}
	add_action( 'customize_register', 'cuisine_palace_customizer_add_panels' );
}

if ( ! function_exists( 'cuisine_palace_customizer_includes' ) ) {

	/**
	 * It loads all the files related to customizer.
	 */
	function cuisine_palace_customizer_includes() {

		$path  = get_template_directory();
		$files = array(

			// Custom Controls.
			'custom-controls/toggle/class-cuisine-palace-customizer-toggle-control',
			'custom-controls/slim-select/class-cuisine-palace-customizer-slim-select-control',
			'custom-controls/register-control-type',

			// Customizer Core Files.
			'sanitization-functions',
			'defaults',
			'customizer-helpers',

			// Controls added in WordPress core sections.
			'wp-core/colors',
			'wp-core/homepage-settings',

			// Theme Options.
			'theme-options/top-bar',
			'theme-options/site-header',
			'theme-options/layouts',
			'theme-options/footer',

			// Front Page.
			'frontpage/banner-slider',
			'frontpage/who-we-are',
			'frontpage/what-we-do',
			'frontpage/menu-lists',
			'frontpage/our-blogs',
			'frontpage/book-your-table',
			'frontpage/testimonials',
			'frontpage/contact-us',
		);

		if ( is_array( $files ) && count( $files ) > 0 ) {
			foreach ( $files as $file ) {
				require_once "{$path}/inc/customizer/{$file}.php";
			}
		}

	}
	add_action( 'init', 'cuisine_palace_customizer_includes' );
}
