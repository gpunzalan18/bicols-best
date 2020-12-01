<?php
/**
 * This file has the settings and options for the layouts section.
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


if ( ! function_exists( 'cuisine_palace_customizer_theme_options_layouts' ) ) {

	/**
	 * This adds the section and controls for the layouts option.
	 *
	 * @param object $wp_customize WordPress customizer objects.
	 */
	function cuisine_palace_customizer_theme_options_layouts( $wp_customize ) {
		$cuisine_palace_panel_id   = 'cuisine_palace_theme_options';
		$cuisine_palace_section_id = 'cuisine_palace_theme_options_layouts';

		// Add section.
		$wp_customize->add_section(
			$cuisine_palace_section_id,
			array(
				'title' => cuisine_palace_customizer_defaults( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'heading' ),
				'panel' => $cuisine_palace_panel_id,
			)
		);

		/**
		 * ==============================
		 * Pages and Posts layout options
		 * ==============================
		 */

		cuisine_palace_register_option(
			$wp_customize,
			array(
				'type'              => 'group_label',
				'custom_control'    => 'Cuisine_Palace_Customizer_Group_Heading_Control',
				'name'              => cuisine_palace_customizer_get_name( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'pages_posts_headings' ),
				'default'           => cuisine_palace_customizer_defaults( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'pages_posts_headings' ),
				'sanitize_callback' => 'sanitize_text_field',
				'label'             => esc_html__( 'Pages and Posts', 'cuisine-palace' ),
				'section'           => $cuisine_palace_section_id,
			)
		);

		cuisine_palace_register_option(
			$wp_customize,
			array(
				'type'              => 'select',
				'name'              => cuisine_palace_customizer_get_name( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'page_layout' ),
				'default'           => cuisine_palace_customizer_defaults( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'page_layout' ),
				'sanitize_callback' => 'cuisine_palace_sanitize_select',
				'choices'           => array(
					'has-no-sidebar'    => esc_html__( 'No Sidebar - Full Width', 'cuisine-palace' ),
					'has-left-sidebar'  => esc_html__( 'Left Sidebar - Right Content', 'cuisine-palace' ),
					'has-right-sidebar' => esc_html__( 'Left Content - Right Sidebar', 'cuisine-palace' ),
				),
				'description'       => esc_html__( 'Select layout for single pages.', 'cuisine-palace' ),
				'label'             => esc_html__( 'Page Layout', 'cuisine-palace' ),
				'section'           => $cuisine_palace_section_id,
			)
		);

		cuisine_palace_register_option(
			$wp_customize,
			array(
				'type'              => 'select',
				'name'              => cuisine_palace_customizer_get_name( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'post_layout' ),
				'default'           => cuisine_palace_customizer_defaults( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'post_layout' ),
				'sanitize_callback' => 'cuisine_palace_sanitize_select',
				'choices'           => array(
					'has-no-sidebar'    => esc_html__( 'No Sidebar - Full Width', 'cuisine-palace' ),
					'has-left-sidebar'  => esc_html__( 'Left Sidebar - Right Content', 'cuisine-palace' ),
					'has-right-sidebar' => esc_html__( 'Left Content - Right Sidebar', 'cuisine-palace' ),
				),
				'description'       => esc_html__( 'Select layout for single posts.', 'cuisine-palace' ),
				'label'             => esc_html__( 'Post Layout', 'cuisine-palace' ),
				'section'           => $cuisine_palace_section_id,
			)
		);

		/**
		 * ==============================
		 * Archives layout options
		 * ==============================
		 */

		cuisine_palace_register_option(
			$wp_customize,
			array(
				'type'              => 'group_label',
				'custom_control'    => 'Cuisine_Palace_Customizer_Group_Heading_Control',
				'name'              => cuisine_palace_customizer_get_name( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'archives_group_headings' ),
				'default'           => cuisine_palace_customizer_defaults( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'archives_group_headings' ),
				'sanitize_callback' => 'sanitize_text_field',
				'label'             => esc_html__( 'Blogs and Archives', 'cuisine-palace' ),
				'section'           => $cuisine_palace_section_id,
			)
		);

		cuisine_palace_register_option(
			$wp_customize,
			array(
				'type'              => 'select',
				'name'              => cuisine_palace_customizer_get_name( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'archive_layout' ),
				'default'           => cuisine_palace_customizer_defaults( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'archive_layout' ),
				'sanitize_callback' => 'cuisine_palace_sanitize_select',
				'choices'           => array(
					'has-no-sidebar'    => esc_html__( 'No Sidebar - Full Width', 'cuisine-palace' ),
					'has-left-sidebar'  => esc_html__( 'Left Sidebar - Right Content', 'cuisine-palace' ),
					'has-right-sidebar' => esc_html__( 'Left Content - Right Sidebar', 'cuisine-palace' ),
				),
				'description'       => esc_html__( 'Select layout for blogs and archives.', 'cuisine-palace' ),
				'label'             => esc_html__( 'Archives Layout', 'cuisine-palace' ),
				'section'           => $cuisine_palace_section_id,
			)
		);

		cuisine_palace_register_option(
			$wp_customize,
			array(
				'type'              => 'select',
				'name'              => cuisine_palace_customizer_get_name( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'archive_view' ),
				'default'           => cuisine_palace_customizer_defaults( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'archive_view' ),
				'sanitize_callback' => 'cuisine_palace_sanitize_select',
				'choices'           => array(
					'has-list-type' => esc_html__( 'List View', 'cuisine-palace' ),
					'has-grid-type' => esc_html__( 'Grid View', 'cuisine-palace' ),
				),
				'description'       => esc_html__( 'Select the view type for post listings in blogs and archives.', 'cuisine-palace' ),
				'label'             => esc_html__( 'Archives View', 'cuisine-palace' ),
				'section'           => $cuisine_palace_section_id,
			)
		);

	}
	add_action( 'customize_register', 'cuisine_palace_customizer_theme_options_layouts' );
}

