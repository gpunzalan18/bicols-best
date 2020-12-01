<?php
/**
 * This file has the settings and options for Site Header.
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


if ( ! function_exists( 'cuisine_palace_customizer_theme_options_site_header' ) ) {

	/**
	 * This adds the section and controls for the Site Header.
	 *
	 * @param object $wp_customize WordPress customizer objects.
	 */
	function cuisine_palace_customizer_theme_options_site_header( $wp_customize ) {
		$cuisine_palace_panel_id   = 'cuisine_palace_theme_options';
		$cuisine_palace_section_id = 'cuisine_palace_theme_options_site_header';

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
				'type'              => 'select',
				'name'              => cuisine_palace_customizer_get_name( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'header_behavior' ),
				'default'           => cuisine_palace_customizer_defaults( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'header_behavior' ),
				'sanitize_callback' => 'cuisine_palace_sanitize_select',
				'choices'           => array(
					'scroll' => esc_html__( 'Scroll ( Default )', 'cuisine-palace' ),
					'sticky' => esc_html__( 'Sticky', 'cuisine-palace' ),
				),
				'description'       => esc_html__( 'Select header behavior on page scroll. Scroll the preview page to see the changes.', 'cuisine-palace' ),
				'label'             => esc_html__( 'Header Behavior', 'cuisine-palace' ),
				'section'           => $cuisine_palace_section_id,
			)
		);

		cuisine_palace_register_option(
			$wp_customize,
			array(
				'type'              => 'select',
				'name'              => cuisine_palace_customizer_get_name( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'search_icon_visibility' ),
				'default'           => cuisine_palace_customizer_defaults( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'search_icon_visibility' ),
				'sanitize_callback' => 'cuisine_palace_sanitize_select',
				'choices'           => array(
					'none'            => esc_html__( 'Hidden', 'cuisine-palace' ),
					'display-all'     => esc_html__( 'Display in all screens', 'cuisine-palace' ),
					'hide_in_desktop' => esc_html__( 'Hide in Desktops', 'cuisine-palace' ),
					'hide_in_tablets' => esc_html__( 'Hide in Tablets', 'cuisine-palace' ),
					'hide_in_mobile'  => esc_html__( 'Hide in Mobile', 'cuisine-palace' ),
				),
				'label'             => esc_html__( 'Search Icon Visibility', 'cuisine-palace' ),
				'section'           => $cuisine_palace_section_id,
			)
		);

	}
	add_action( 'customize_register', 'cuisine_palace_customizer_theme_options_site_header' );
}

