<?php
/**
 * Header Media Options
 *
 * @package Foodie_World
 */

/**
 * Add Header Media options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function foodie_world_header_media_options( $wp_customize ) {
	$wp_customize->get_section( 'header_image' )->description = esc_html__( 'If you add video, it will only show up on Homepage/FrontPage. Other Pages will use Header/Post/Page Image depending on your selection of option. Header Image will be used as a fallback while the video loads ', 'foodie-world' );

	foodie_world_register_option( $wp_customize, array(
			'name'              => 'foodie_world_header_media_option',
			'default'           => 'exclude-home-page-post',
			'sanitize_callback' => 'foodie_world_sanitize_select',
			'choices'           => array(
				'homepage'               => esc_html__( 'Homepage / Frontpage', 'foodie-world' ),
				'exclude-home'           => esc_html__( 'Excluding Homepage', 'foodie-world' ),
				'exclude-home-page-post' => esc_html__( 'Excluding Homepage, Page/Post Featured Image', 'foodie-world' ),
				'entire-site'            => esc_html__( 'Entire Site', 'foodie-world' ),
				'entire-site-page-post'  => esc_html__( 'Entire Site, Page/Post Featured Image', 'foodie-world' ),
				'pages-posts'            => esc_html__( 'Pages and Posts', 'foodie-world' ),
				'disable'                => esc_html__( 'Disabled', 'foodie-world' ),
			),
			'label'             => esc_html__( 'Enable on', 'foodie-world' ),
			'section'           => 'header_image',
			'type'              => 'select',
			'priority'          => 1,
		)
	);

	foodie_world_register_option( $wp_customize, array(
			'name'              => 'foodie_world_header_media_title',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Header Media Title', 'foodie-world' ),
			'section'           => 'header_image',
			'type'              => 'text',
		)
	);

    foodie_world_register_option( $wp_customize, array(
			'name'              => 'foodie_world_header_media_text',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Header Media Text', 'foodie-world' ),
			'section'           => 'header_image',
			'type'              => 'textarea',
		)
	);

	foodie_world_register_option( $wp_customize, array(
			'name'              => 'foodie_world_header_media_url',
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
			'label'             => esc_html__( 'Header Media Url', 'foodie-world' ),
			'section'           => 'header_image',
		)
	);

	foodie_world_register_option( $wp_customize, array(
			'name'              => 'foodie_world_header_media_url_text',
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Header Media Url Text', 'foodie-world' ),
			'section'           => 'header_image',
		)
	);

	foodie_world_register_option( $wp_customize, array(
			'name'              => 'foodie_world_header_url_target',
			'sanitize_callback' => 'foodie_world_sanitize_checkbox',
			'label'             => esc_html__( 'Check to Open Link in New Window/Tab', 'foodie-world' ),
			'section'           => 'header_image',
			'type'              => 'checkbox',
		)
	);
}
add_action( 'customize_register', 'foodie_world_header_media_options' );
