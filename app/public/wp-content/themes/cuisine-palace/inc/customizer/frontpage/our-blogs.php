<?php
/**
 * This file has the settings and options for the frontpage our blogs.
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


if ( ! function_exists( 'cuisine_palace_customizer_frontpage_our_blogs' ) ) {

	/**
	 * This adds the section and controls for the frontpage our blogs section.
	 *
	 * @param object $wp_customize WordPress customizer objects.
	 */
	function cuisine_palace_customizer_frontpage_our_blogs( $wp_customize ) {
		$cuisine_palace_panel_id   = 'cuisine_palace_frontpage';
		$cuisine_palace_section_id = 'cuisine_palace_frontpage_our_blogs';

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
				'type'              => 'text',
				'name'              => cuisine_palace_customizer_get_name( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'heading' ),
				'default'           => cuisine_palace_customizer_defaults( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'heading' ),
				'sanitize_callback' => 'sanitize_text_field',
				'label'             => esc_html__( 'Heading', 'cuisine-palace' ),
				'section'           => $cuisine_palace_section_id,
				'active_callback'   => function() {
					$cuisine_palace_panel_id   = 'cuisine_palace_frontpage';
					$cuisine_palace_section_id = 'cuisine_palace_frontpage_our_blogs';
					return cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_section', true );
				},
			)
		);

		cuisine_palace_register_option(
			$wp_customize,
			array(
				'type'              => 'text',
				'name'              => cuisine_palace_customizer_get_name( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'sub_heading' ),
				'default'           => cuisine_palace_customizer_defaults( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'sub_heading' ),
				'sanitize_callback' => 'sanitize_text_field',
				'label'             => esc_html__( 'Sub Heading', 'cuisine-palace' ),
				'section'           => $cuisine_palace_section_id,
				'active_callback'   => function() {
					$cuisine_palace_panel_id   = 'cuisine_palace_frontpage';
					$cuisine_palace_section_id = 'cuisine_palace_frontpage_our_blogs';
					return cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_section', true );
				},
			)
		);

		cuisine_palace_register_option(
			$wp_customize,
			array(
				'type'              => 'radio',
				'description'       => esc_html__( 'Display the latest posts by date ( all categories ) or any specific category.', 'cuisine-palace' ),
				'name'              => cuisine_palace_customizer_get_name( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'display_by' ),
				'default'           => cuisine_palace_customizer_defaults( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'display_by' ),
				'choices'           => array(
					'date'     => esc_html__( 'Date', 'cuisine-palace' ),
					'category' => esc_html__( 'Category', 'cuisine-palace' ),
				),
				'sanitize_callback' => 'cuisine_palace_sanitize_select',
				'label'             => esc_html__( 'Display By', 'cuisine-palace' ),
				'section'           => $cuisine_palace_section_id,
				'active_callback'   => function() {
					$cuisine_palace_panel_id   = 'cuisine_palace_frontpage';
					$cuisine_palace_section_id = 'cuisine_palace_frontpage_our_blogs';
					return cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_section', true );
				},
			)
		);

		cuisine_palace_register_option(
			$wp_customize,
			array(
				'type'              => 'cuisine_palace_slim_select',
				'custom_control'    => 'Cuisine_Palace_Customizer_Slim_Select_Control',
				'name'              => cuisine_palace_customizer_get_name( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'terms' ),
				'description'       => esc_html__( 'Select a category for your blogs.', 'cuisine-palace' ),
				'default'           => cuisine_palace_customizer_defaults( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'terms' ),
				'choices'           => cuisine_palace_customizer_get_terms(),
				'sanitize_callback' => 'cuisine_palace_sanitize_select',
				'active_callback'   => function() {
					$cuisine_palace_panel_id   = 'cuisine_palace_frontpage';
					$cuisine_palace_section_id = 'cuisine_palace_frontpage_our_blogs';
					$enable   = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_section', true );
					$settings = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'display_by', true );
					return $enable && ! empty( $settings ) && 'category' === $settings;
				},
				'label'             => esc_html__( 'Select Categories', 'cuisine-palace' ),
				'section'           => $cuisine_palace_section_id,
			)
		);


		cuisine_palace_register_option(
			$wp_customize,
			array(
				'type'              => 'number',
				'name'              => cuisine_palace_customizer_get_name( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'numberposts' ),
				'default'           => cuisine_palace_customizer_defaults( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'numberposts' ),
				'sanitize_callback' => 'sanitize_text_field',
				'description'       => esc_html__( 'Maximum number of posts that you want to display. Limit: 6', 'cuisine-palace' ),
				'label'             => esc_html__( 'Number Of Posts', 'cuisine-palace' ),
				'input_attrs'       => array(
					'min' => 0,
					'max' => 6,
				),
				'section'           => $cuisine_palace_section_id,
				'active_callback'   => function() {
					$cuisine_palace_panel_id   = 'cuisine_palace_frontpage';
					$cuisine_palace_section_id = 'cuisine_palace_frontpage_our_blogs';
					return cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_section', true );
				},
			)
		);

	}
	add_action( 'customize_register', 'cuisine_palace_customizer_frontpage_our_blogs' );
}
