<?php
/**
 * This file has the options for homepage settings panel.
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


if ( ! function_exists( 'cuisine_palace_customizer_wp_core_homepage_settings' ) ) {

	/**
	 * This adds the section and controls for the footer.
	 *
	 * @param object $wp_customize WordPress customizer objects.
	 */
	function cuisine_palace_customizer_wp_core_homepage_settings( $wp_customize ) {
		$cuisine_palace_panel_id   = 'cuisine_palace_wp_core_homepage_settings';
		$cuisine_palace_section_id = 'static_front_page';

		cuisine_palace_register_option(
			$wp_customize,
			array(
				'type'              => 'cuisine_palace_toggle',
				'custom_control'    => 'Cuisine_Palace_Customizer_Toggle_Control',
				'name'              => cuisine_palace_customizer_get_name( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'display_static_content' ),
				'default'           => cuisine_palace_customizer_defaults( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'display_static_content' ),
				'sanitize_callback' => 'cuisine_palace_sanitize_checkbox',
				'label'             => esc_html__( 'Display Static Content?', 'cuisine-palace' ),
				'section'           => $cuisine_palace_section_id,
			)
		);

	}
	add_action( 'customize_register', 'cuisine_palace_customizer_wp_core_homepage_settings' );
}

