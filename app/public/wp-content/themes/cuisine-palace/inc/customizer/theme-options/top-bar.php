<?php
/**
 * This file has the settings and options for top bar.
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


if ( ! function_exists( 'cuisine_palace_customizer_theme_options_top_bar' ) ) {

	/**
	 * This adds the section and controls for the top bar.
	 *
	 * @param object $wp_customize WordPress customizer objects.
	 */
	function cuisine_palace_customizer_theme_options_top_bar( $wp_customize ) {
		$cuisine_palace_panel_id   = 'cuisine_palace_theme_options';
		$cuisine_palace_section_id = 'cuisine_palace_theme_options_top_bar';

		$social_links = cuisine_palace_get_social_links();

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
				'name'              => cuisine_palace_customizer_get_name( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_top_bar' ),
				'default'           => cuisine_palace_customizer_defaults( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_top_bar' ),
				'sanitize_callback' => 'cuisine_palace_sanitize_checkbox',
				'label'             => esc_html__( 'Enable Top Bar?', 'cuisine-palace' ),
				'section'           => $cuisine_palace_section_id,
			)
		);

		/**
		 * ===============
		 * Contact Details.
		 * ===============
		 */
		cuisine_palace_register_option(
			$wp_customize,
			array(
				'type'              => 'group_label',
				'custom_control'    => 'Cuisine_Palace_Customizer_Group_Heading_Control',
				'name'              => cuisine_palace_customizer_get_name( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'contacts_details_headings' ),
				'sanitize_callback' => 'sanitize_text_field',
				'active_callback'   => function() {
					$cuisine_palace_panel_id   = 'cuisine_palace_theme_options';
					$cuisine_palace_section_id = 'cuisine_palace_theme_options_top_bar';
					return cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_top_bar', true );
				},
				'label'             => esc_html__( 'Contact Details', 'cuisine-palace' ),
				'section'           => $cuisine_palace_section_id,
			)
		);

		cuisine_palace_register_option(
			$wp_customize,
			array(
				'type'              => 'tel',
				'name'              => cuisine_palace_customizer_get_name( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'contact_number' ),
				'default'           => cuisine_palace_customizer_defaults( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'contact_number' ),
				'sanitize_callback' => 'sanitize_text_field',
				'input_attrs'       => array(
					'placeholder' => esc_attr( '+01-23456789' ),
				),
				'active_callback'   => function() {
					$cuisine_palace_panel_id   = 'cuisine_palace_theme_options';
					$cuisine_palace_section_id = 'cuisine_palace_theme_options_top_bar';
					return cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_top_bar', true );
				},
				'label'             => esc_html__( 'Contact Number', 'cuisine-palace' ),
				'section'           => $cuisine_palace_section_id,
			)
		);

		cuisine_palace_register_option(
			$wp_customize,
			array(
				'type'              => 'text',
				'name'              => cuisine_palace_customizer_get_name( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'address' ),
				'default'           => cuisine_palace_customizer_defaults( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'address' ),
				'sanitize_callback' => 'sanitize_text_field',
				'input_attrs'       => array(
					'placeholder' => esc_attr__( 'ABC Road, XYZ Town', 'cuisine-palace' ),
				),
				'active_callback'   => function() {
					$cuisine_palace_panel_id   = 'cuisine_palace_theme_options';
					$cuisine_palace_section_id = 'cuisine_palace_theme_options_top_bar';
					return cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_top_bar', true );
				},
				'label'             => esc_html__( 'Address', 'cuisine-palace' ),
				'section'           => $cuisine_palace_section_id,
			)
		);

		/**
		 * =============
		 * Social Links.
		 * =============
		 */
		cuisine_palace_register_option(
			$wp_customize,
			array(
				'type'              => 'group_label',
				'custom_control'    => 'Cuisine_Palace_Customizer_Group_Heading_Control',
				'name'              => cuisine_palace_customizer_get_name( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'social_links_group_headings' ),
				'sanitize_callback' => 'sanitize_text_field',
				'active_callback'   => function() {
					$cuisine_palace_panel_id   = 'cuisine_palace_theme_options';
					$cuisine_palace_section_id = 'cuisine_palace_theme_options_top_bar';
					return cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_top_bar', true );
				},
				'label'             => esc_html__( 'Social Links', 'cuisine-palace' ),
				'section'           => $cuisine_palace_section_id,
			)
		);

		cuisine_palace_register_option(
			$wp_customize,
			array(
				'type'              => 'cuisine_palace_toggle',
				'custom_control'    => 'Cuisine_Palace_Customizer_Toggle_Control',
				'name'              => cuisine_palace_customizer_get_name( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_social_links' ),
				'default'           => cuisine_palace_customizer_defaults( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_social_links' ),
				'description'       => esc_html__( 'Enable or Disable the social links.', 'cuisine-palace' ),
				'sanitize_callback' => 'cuisine_palace_sanitize_checkbox',
				'active_callback'   => function() {
					$cuisine_palace_panel_id   = 'cuisine_palace_theme_options';
					$cuisine_palace_section_id = 'cuisine_palace_theme_options_top_bar';
					return cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_top_bar', true );
				},
				'label'             => esc_html__( 'Enable Social Links?', 'cuisine-palace' ),
				'section'           => $cuisine_palace_section_id,
			)
		);

		foreach ( $social_links as $social_link ) {

			cuisine_palace_register_option(
				$wp_customize,
				array(
					'type'              => 'url',
					'name'              => cuisine_palace_customizer_get_name( $cuisine_palace_panel_id, $cuisine_palace_section_id, $social_link ),
					'sanitize_callback' => 'sanitize_text_field',
					'input_attrs'       => array(
						'placeholder' => esc_attr( "{$social_link}.com" ),
					),
					'active_callback'   => function() {
						$cuisine_palace_panel_id   = 'cuisine_palace_theme_options';
						$cuisine_palace_section_id = 'cuisine_palace_theme_options_top_bar';
						$enable_top_bar = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_top_bar', true );
						$enable_social_links = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_social_links', true );
						return $enable_top_bar && $enable_social_links;
					},
					'description'       => esc_html__( 'Leave empty to disable', 'cuisine-palace' ),
					'label'             => esc_html( ucfirst( $social_link ) ),
					'section'           => $cuisine_palace_section_id,
				)
			);

		}

		/**
		 * ===============
		 * Call to Action.
		 * ===============
		 */
		cuisine_palace_register_option(
			$wp_customize,
			array(
				'type'              => 'group_label',
				'custom_control'    => 'Cuisine_Palace_Customizer_Group_Heading_Control',
				'name'              => cuisine_palace_customizer_get_name( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'cta_group_headings' ),
				'sanitize_callback' => 'sanitize_text_field',
				'active_callback'   => function() {
					$cuisine_palace_panel_id   = 'cuisine_palace_theme_options';
					$cuisine_palace_section_id = 'cuisine_palace_theme_options_top_bar';
					return cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_top_bar', true );
				},
				'label'             => esc_html__( 'Call To Action', 'cuisine-palace' ),
				'section'           => $cuisine_palace_section_id,
			)
		);

		cuisine_palace_register_option(
			$wp_customize,
			array(
				'type'              => 'cuisine_palace_toggle',
				'custom_control'    => 'Cuisine_Palace_Customizer_Toggle_Control',
				'name'              => cuisine_palace_customizer_get_name( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_cta_btn' ),
				'default'           => cuisine_palace_customizer_defaults( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_cta_btn' ),
				'description'       => esc_html__( 'Enable or disable the call to action button.', 'cuisine-palace' ),
				'sanitize_callback' => 'cuisine_palace_sanitize_checkbox',
				'active_callback'   => function() {
					$cuisine_palace_panel_id   = 'cuisine_palace_theme_options';
					$cuisine_palace_section_id = 'cuisine_palace_theme_options_top_bar';
					return cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_top_bar', true );
				},
				'label'             => esc_html__( 'Enable CTA Button?', 'cuisine-palace' ),
				'section'           => $cuisine_palace_section_id,
			)
		);

		cuisine_palace_register_option(
			$wp_customize,
			array(
				'type'              => 'text',
				'name'              => cuisine_palace_customizer_get_name( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'btn_label' ),
				'default'           => cuisine_palace_customizer_defaults( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'btn_label' ),
				'sanitize_callback' => 'sanitize_text_field',
				'active_callback'   => function() {
					$cuisine_palace_panel_id   = 'cuisine_palace_theme_options';
					$cuisine_palace_section_id = 'cuisine_palace_theme_options_top_bar';
					$enable_top_bar = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_top_bar', true );
					$enable_cta = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_cta_btn', true );
					return $enable_top_bar && $enable_cta;
				},
				'label'             => esc_html__( 'Button Label', 'cuisine-palace' ),
				'section'           => $cuisine_palace_section_id,
			)
		);

		cuisine_palace_register_option(
			$wp_customize,
			array(
				'type'              => 'select',
				'name'              => cuisine_palace_customizer_get_name( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'link_type' ),
				'default'           => cuisine_palace_customizer_defaults( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'link_type' ),
				'sanitize_callback' => 'cuisine_palace_sanitize_select',
				'active_callback'   => function() {
					$cuisine_palace_panel_id   = 'cuisine_palace_theme_options';
					$cuisine_palace_section_id = 'cuisine_palace_theme_options_top_bar';
					$enable_top_bar = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_top_bar', true );
					$enable_cta = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_cta_btn', true );
					return $enable_top_bar && $enable_cta;
				},
				'choices'           => array(
					'none'         => esc_html__( '--Select--', 'cuisine-palace' ),
					'post_or_page' => esc_html__( 'Post or Page', 'cuisine-palace' ),
					'custom_link'  => esc_html__( 'Custom Link', 'cuisine-palace' ),
				),
				'description'       => esc_html__( 'Select the link type for call to action button', 'cuisine-palace' ),
				'label'             => esc_html__( 'Button Link Type', 'cuisine-palace' ),
				'section'           => $cuisine_palace_section_id,
			)
		);

		// When 'link_type' === 'post_or_page'.
		cuisine_palace_register_option(
			$wp_customize,
			array(
				'type'              => 'cuisine_palace_slim_select',
				'custom_control'    => 'Cuisine_Palace_Customizer_Slim_Select_Control',
				'name'              => cuisine_palace_customizer_get_name( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'post_or_page' ),
				'default'           => cuisine_palace_customizer_defaults( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'post_or_page' ),
				'description'       => esc_html__( 'Select a post or page for the call to action button link.', 'cuisine-palace' ),
				'sanitize_callback' => 'cuisine_palace_sanitize_select',
				'active_callback'   => function() {
					$cuisine_palace_panel_id   = 'cuisine_palace_theme_options';
					$cuisine_palace_section_id = 'cuisine_palace_theme_options_top_bar';
					$enable_top_bar = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_top_bar', true );
					$enable_cta = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_cta_btn', true );
					$link_type = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'link_type', true );
					return $enable_top_bar && $enable_cta && ( 'post_or_page' === $link_type );
				},
				'label'             => esc_html__( 'Post or Page', 'cuisine-palace' ),
				'choices'           => cuisine_palace_customizer_get_posts_and_pages(),
				'section'           => $cuisine_palace_section_id,
			)
		);

		// When 'link_type' === 'custom_link'.
		cuisine_palace_register_option(
			$wp_customize,
			array(
				'type'              => 'url',
				'name'              => cuisine_palace_customizer_get_name( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'custom_link' ),
				'default'           => cuisine_palace_customizer_defaults( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'custom_link' ),
				'description'       => esc_html__( 'Enter a custom url for your call to action button link.', 'cuisine-palace' ),
				'sanitize_callback' => 'esc_url_raw',
				'active_callback'   => function() {
					$cuisine_palace_panel_id   = 'cuisine_palace_theme_options';
					$cuisine_palace_section_id = 'cuisine_palace_theme_options_top_bar';
					$enable_top_bar = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_top_bar', true );
					$enable_cta = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'enable_cta_btn', true );
					$link_type = cuisine_palace_get_theme_mod( $cuisine_palace_panel_id, $cuisine_palace_section_id, 'link_type', true );
					return $enable_top_bar && $enable_cta && ( 'custom_link' === $link_type );
				},
				'input_attrs'       => array(
					'placeholder' => 'https://',
				),
				'label'             => esc_html__( 'Custom Link', 'cuisine-palace' ),
				'section'           => $cuisine_palace_section_id,
			)
		);

	}
	add_action( 'customize_register', 'cuisine_palace_customizer_theme_options_top_bar' );
}

