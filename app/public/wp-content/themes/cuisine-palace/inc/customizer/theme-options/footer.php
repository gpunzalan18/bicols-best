<?php
/**
 * This file has the settings and options for footer.
 *
 * @package cuisine-palace
 * @subpackage inc/customizer/theme-options
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! function_exists( 'cuisine_palace_customizer_theme_options_footer' ) ) {

	/**
	 * This adds the section and controls for the footer.
	 *
	 * @param object $wp_customize WordPress customizer objects.
	 */
	function cuisine_palace_customizer_theme_options_footer( $wp_customize ) {
		$cuisine_palace_panel_id   = 'cuisine_palace_theme_options';
		$cuisine_palace_section_id = 'cuisine_palace_theme_options_footer';

		// Add section.
		$wp_customize->add_section(
			$cuisine_palace_section_id,
			array(
				'title' => cuisine_palace_customizer_defaults( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'heading' ),
				'panel' => $cuisine_palace_panel_id,
			)
		);

		cuisine_palace_register_option(
			$wp_customize,
			array(
				'type'              => 'cuisine_palace_toggle',
				'custom_control'    => 'Cuisine_Palace_Customizer_Toggle_Control',
				'name'              => cuisine_palace_customizer_get_name( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_footer_widgets' ),
				'default'           => cuisine_palace_customizer_defaults( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_footer_widgets' ),
				'sanitize_callback' => 'cuisine_palace_sanitize_checkbox',
				'label'             => esc_html__( 'Enable Footer Widgets?', 'cuisine-palace' ),
				'section'           => $cuisine_palace_section_id,
			)
		);

		cuisine_palace_register_option(
			$wp_customize,
			array(
				'type'              => 'cuisine_palace_toggle',
				'custom_control'    => 'Cuisine_Palace_Customizer_Toggle_Control',
				'name'              => cuisine_palace_customizer_get_name( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'display_site_logo' ),
				'default'           => cuisine_palace_customizer_defaults( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'display_site_logo' ),
				'sanitize_callback' => 'cuisine_palace_sanitize_checkbox',
				'label'             => esc_html__( 'Display Site Logo?', 'cuisine-palace' ),
				'section'           => $cuisine_palace_section_id,
			)
		);

	}
	add_action( 'customize_register', 'cuisine_palace_customizer_theme_options_footer' );
}

