<?php
/**
 * This file has the settings and options for the frontpage contact us section.
 *
 * @package cuisine-palace
 * @subpackage inc/customizer/frontpage
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! function_exists( 'cuisine_palace_customizer_frontpage_contact_us' ) ) {

	/**
	 * This adds the section and controls for the frontpage contact us option.
	 *
	 * @param object $wp_customize WordPress customizer objects.
	 */
	function cuisine_palace_customizer_frontpage_contact_us( $wp_customize ) {
		$cuisine_palace_panel_id   = 'cuisine_palace_frontpage';
		$cuisine_palace_section_id = 'cuisine_palace_frontpage_contact_us';

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
				'name'              => cuisine_palace_customizer_get_name( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_section' ),
				'default'           => cuisine_palace_customizer_defaults( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_section' ),
				'sanitize_callback' => 'cuisine_palace_sanitize_checkbox',
				'label'             => esc_html__( 'Enable Section?', 'cuisine-palace' ),
				'section'           => $cuisine_palace_section_id,
			)
		);

		cuisine_palace_register_option(
			$wp_customize,
			array(
				'type'              => 'cuisine_palace_slim_select',
				'custom_control'    => 'Cuisine_Palace_Customizer_Slim_Select_Control',
				'name'              => cuisine_palace_customizer_get_name( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'content_left' ),
				'default'           => cuisine_palace_customizer_defaults( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'content_left' ),
				'description'       => esc_html__( 'Select a page or post for the section left content.', 'cuisine-palace' ),
				'sanitize_callback' => 'cuisine_palace_sanitize_select',
				'label'             => esc_html__( 'Content ( Left )', 'cuisine-palace' ),
				'choices'           => cuisine_palace_customizer_get_posts_and_pages(),
				'section'           => $cuisine_palace_section_id,
				'active_callback'   => function() {
					$cuisine_palace_panel_id   = 'cuisine_palace_frontpage';
					$cuisine_palace_section_id = 'cuisine_palace_frontpage_contact_us';
					return cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_section', true );
				},
			)
		);


		cuisine_palace_register_option(
			$wp_customize,
			array(
				'type'              => 'cuisine_palace_slim_select',
				'custom_control'    => 'Cuisine_Palace_Customizer_Slim_Select_Control',
				'name'              => cuisine_palace_customizer_get_name( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'content_right' ),
				'default'           => cuisine_palace_customizer_defaults( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'content_right' ),
				'description'       => esc_html__( 'Select a page or post for the section right content.', 'cuisine-palace' ),
				'sanitize_callback' => 'cuisine_palace_sanitize_select',
				'label'             => esc_html__( 'Content ( Right )', 'cuisine-palace' ),
				'choices'           => cuisine_palace_customizer_get_posts_and_pages(),
				'section'           => $cuisine_palace_section_id,
				'active_callback'   => function() {
					$cuisine_palace_panel_id   = 'cuisine_palace_frontpage';
					$cuisine_palace_section_id = 'cuisine_palace_frontpage_contact_us';
					return cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_section', true );
				},
			)
		);


		cuisine_palace_register_option(
			$wp_customize,
			array(
				'type'              => 'select',
				'name'              => cuisine_palace_customizer_get_name( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'background_type' ),
				'default'           => cuisine_palace_customizer_defaults( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'background_type' ),
				'description'       => esc_html__( 'Select the background type for this section.', 'cuisine-palace' ),
				'sanitize_callback' => 'cuisine_palace_sanitize_select',
				'label'             => esc_html__( 'Background Type', 'cuisine-palace' ),
				'choices'           => array(
					'none'  => esc_html__( 'No Background', 'cuisine-palace' ),
					'map'   => esc_html__( 'Google Map', 'cuisine-palace' ),
					'image' => esc_html__( 'Background Image', 'cuisine-palace' ),
				),
				'section'           => $cuisine_palace_section_id,
				'active_callback'   => function() {
					$cuisine_palace_panel_id   = 'cuisine_palace_frontpage';
					$cuisine_palace_section_id = 'cuisine_palace_frontpage_contact_us';
					return cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_section', true );
				},
			)
		);

		// When Google Map is selected.
		cuisine_palace_register_option(
			$wp_customize,
			array(
				'type'              => 'text',
				'name'              => cuisine_palace_customizer_get_name( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'location' ),
				'default'           => cuisine_palace_customizer_defaults( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'location' ),
				'description'       => esc_html__( 'Enter a location to display on the map.', 'cuisine-palace' ),
				'sanitize_callback' => 'sanitize_text_field',
				'active_callback'   => function() {
					$cuisine_palace_panel_id   = 'cuisine_palace_frontpage';
					$cuisine_palace_section_id = 'cuisine_palace_frontpage_contact_us';
					$enable   = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_section', true );
					$settings = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'background_type', true );
					return $enable && ! empty( $settings ) && 'map' === $settings;
				},
				'label'             => esc_html__( 'Location', 'cuisine-palace' ),
				'section'           => $cuisine_palace_section_id,
			)
		);

		// When Background Image is selected.
		cuisine_palace_register_option(
			$wp_customize,
			array(
				'custom_control'    => 'WP_Customize_Image_Control',
				'name'              => cuisine_palace_customizer_get_name( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'background_image' ),
				'default'           => cuisine_palace_customizer_defaults( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'background_image' ),
				'sanitize_callback' => 'esc_url_raw',
				'active_callback'   => function() {
					$cuisine_palace_panel_id   = 'cuisine_palace_frontpage';
					$cuisine_palace_section_id = 'cuisine_palace_frontpage_contact_us';
					$enable   = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_section', true );
					$settings = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'background_type', true );
					return $enable && ! empty( $settings ) && 'image' === $settings;
				},
				'label'             => esc_html__( 'Background Image', 'cuisine-palace' ),
				'section'           => $cuisine_palace_section_id,
			)
		);

	}
	add_action( 'customize_register', 'cuisine_palace_customizer_frontpage_contact_us' );
}

