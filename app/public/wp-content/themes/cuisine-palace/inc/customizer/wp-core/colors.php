<?php
/**
 * This file has the colors options.
 *
 * @package cuisine-palace
 * @subpackage inc/customizer/wp-core
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! function_exists( 'cuisine_palace_customizer_wp_core_colors' ) ) {

	/**
	 * This adds the section and controls for the footer.
	 *
	 * @param object $wp_customize WordPress customizer objects.
	 */
	function cuisine_palace_customizer_wp_core_colors( $wp_customize ) {
		$cuisine_palace_panel_id   = 'cuisine_palace_wp_core_colors';
		$cuisine_palace_section_id = 'colors';

		cuisine_palace_register_option(
			$wp_customize,
			array(
				'type'              => 'color',
				'custom_control'    => 'WP_Customize_Color_Control',
				'name'              => cuisine_palace_customizer_get_name( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'primary_color' ),
				'default'           => cuisine_palace_customizer_defaults( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'primary_color' ),
				'sanitize_callback' => 'sanitize_hex_color',
				'label'             => esc_html__( 'Primary Color', 'cuisine-palace' ),
				'section'           => $cuisine_palace_section_id,
			)
		);

		cuisine_palace_register_option(
			$wp_customize,
			array(
				'type'              => 'color',
				'custom_control'    => 'WP_Customize_Color_Control',
				'name'              => cuisine_palace_customizer_get_name( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'secondary_color' ),
				'default'           => cuisine_palace_customizer_defaults( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'secondary_color' ),
				'sanitize_callback' => 'sanitize_hex_color',
				'label'             => esc_html__( 'Secondary Color', 'cuisine-palace' ),
				'section'           => $cuisine_palace_section_id,
			)
		);

	}
	add_action( 'customize_register', 'cuisine_palace_customizer_wp_core_colors' );
}

