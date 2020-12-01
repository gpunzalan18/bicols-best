<?php
/**
 * This file has the default options for the customizer controls.
 *
 * @package cuisine-palace
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'cuisine_palace_customizer_defaults' ) ) {

	/**
	 * Generates the customizer defaults.
	 *
	 * @param string $panel Customizer panel id.
	 * @param string $section Customizer section id.
	 * @param string $control Customizer control id.
	 */
	function cuisine_palace_customizer_defaults( $panel, $section, $control ) {
		$defaults = array(

			/**
			 * WP Core options defaults.
			 */
			'cuisine_palace_wp_core_colors' => array(
				'colors' => array(
					'primary_color'   => '#BF863F',
					'secondary_color' => '#4e4e4e',
				),
			),

			/**
			 * Theme Options panel defaults.
			 */
			'cuisine_palace_theme_options'  => array(
				'cuisine_palace_theme_options_top_bar'     => array(
					'enable_top_bar'      => false,
					'heading'             => esc_html__( 'Top Bar', 'cuisine-palace' ),
					'enable_social_links' => false,
					'enable_cta_btn'      => false,
					'btn_label'           => esc_html__( 'Reserve', 'cuisine-palace' ),
					'link_type'           => 'none',
				),
				'cuisine_palace_theme_options_layouts'     => array(
					'enable_top_bar' => false,
					'heading'        => esc_html__( 'Layouts', 'cuisine-palace' ),
					'page_layout'    => 'has-right-sidebar',
					'post_layout'    => 'has-right-sidebar',
					'archive_layout' => 'has-right-sidebar',
					'archive_view'   => 'has-list-type',
				),
				'cuisine_palace_theme_options_site_header' => array(
					'heading'                => esc_html__( 'Site Header', 'cuisine-palace' ),
					'header_behavior'        => 'scroll',
					'search_icon_visibility' => 'display-all',
				),
				'cuisine_palace_theme_options_footer'      => array(
					'heading'               => esc_html__( 'Footer', 'cuisine-palace' ),
					'enable_footer_widgets' => true,
					'display_site_logo'     => true,
					'copyright_text'        => esc_html__( 'Copyright © Cuisine Palace | Powered by WordPress', 'cuisine-palace' ),
				),
			),

			/**
			 * Frontpage options defaults.
			 */
			'cuisine_palace_frontpage'      => array(
				'cuisine_palace_frontpage_banner_slider'   => array(
					'enable_section' => false,
					'heading'        => esc_html__( 'Banner Slider', 'cuisine-palace' ),
				),
				'cuisine_palace_frontpage_who_we_are'      => array(
					'enable_section' => false,
					'heading'        => esc_html__( 'Who We Are', 'cuisine-palace' ),
					'sub_heading'    => esc_html__( 'Cuisine Restaurant', 'cuisine-palace' ),
				),
				'cuisine_palace_frontpage_what_we_do'      => array(
					'enable_section' => false,
					'heading'        => esc_html__( 'What We Do', 'cuisine-palace' ),
					'sub_heading'    => esc_html__( 'Services', 'cuisine-palace' ),
				),
				'cuisine_palace_frontpage_menu_lists'      => array(
					'enable_section' => false,
					'heading'        => esc_html__( 'Delightful Experience', 'cuisine-palace' ),
					'sub_heading'    => esc_html__( 'Our Menu', 'cuisine-palace' ),
				),
				'cuisine_palace_frontpage_our_blogs'       => array(
					'enable_section' => false,
					'heading'        => esc_html__( 'Latest News', 'cuisine-palace' ),
					'sub_heading'    => esc_html__( 'From Blog', 'cuisine-palace' ),
					'display_by'     => 'date',
					'numberposts'    => 3,
				),
				'cuisine_palace_frontpage_book_your_table' => array(
					'enable_section' => false,
					'heading'        => esc_html__( 'Book Your Table', 'cuisine-palace' ),
					'sub_heading'    => esc_html__( 'Reservation', 'cuisine-palace' ),
				),
				'cuisine_palace_frontpage_testimonials'    => array(
					'enable_section' => false,
					'heading'        => esc_html__( 'What Our Client Says', 'cuisine-palace' ),
					'sub_heading'    => esc_html__( 'Testimonial', 'cuisine-palace' ),
				),
				'cuisine_palace_frontpage_contact_us'      => array(
					'enable_section'  => false,
					'heading'         => esc_html__( 'Get In Touch', 'cuisine-palace' ),
					'background_type' => 'none',
				),
			),
		);

		return isset( $defaults[ $panel ][ $section ][ $control ] ) ? $defaults[ $panel ][ $section ][ $control ] : '';
	}
}
