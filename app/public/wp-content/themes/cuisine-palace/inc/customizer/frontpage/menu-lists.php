<?php
/**
 * This file has the settings and options for the frontpage menu.
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


if ( ! function_exists( 'cuisine_palace_customizer_frontpage_menu_lists' ) ) {

	/**
	 * This adds the section and controls for the frontpage menu section.
	 *
	 * @param object $wp_customize WordPress customizer objects.
	 */
	function cuisine_palace_customizer_frontpage_menu_lists( $wp_customize ) {
		$cuisine_palace_panel_id   = 'cuisine_palace_frontpage';
		$cuisine_palace_section_id = 'cuisine_palace_frontpage_menu_lists';

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
					$cuisine_palace_section_id = 'cuisine_palace_frontpage_menu_lists';
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
					$cuisine_palace_section_id = 'cuisine_palace_frontpage_menu_lists';
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
				'description'       => esc_html__( 'Select multiple categories for menu heads. You can select upto 6 items.', 'cuisine-palace' ),
				'default'           => cuisine_palace_customizer_defaults( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'terms' ),
				'choices'           => cuisine_palace_customizer_get_terms(),
				'sanitize_callback' => 'cuisine_palace_sanitize_select',
				'label'             => esc_html__( 'Select Categories', 'cuisine-palace' ),
				'input_attrs'       => array(
					'multiple' => true,
					'limit'    => 6,
				),
				'section'           => $cuisine_palace_section_id,
				'active_callback'   => function() {
					$cuisine_palace_panel_id   = 'cuisine_palace_frontpage';
					$cuisine_palace_section_id = 'cuisine_palace_frontpage_menu_lists';
					return cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_section', true );
				},
			)
		);

	}
	add_action( 'customize_register', 'cuisine_palace_customizer_frontpage_menu_lists' );
}

