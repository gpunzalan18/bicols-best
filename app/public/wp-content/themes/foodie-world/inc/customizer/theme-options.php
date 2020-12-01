<?php
/**
 * Theme Options
 *
 * @package Foodie_World
 */

/**
 * Add theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function foodie_world_theme_options( $wp_customize ) {
	$wp_customize->add_panel( 'foodie_world_theme_options', array(
		'title'    => esc_html__( 'Theme Options', 'foodie-world' ),
		'priority' => 130,
	) );

	// Breadcrumb Option.
	$wp_customize->add_section( 'foodie_world_breadcrumb_options', array(
		'description'   => esc_html__( 'Breadcrumbs are a great way of letting your visitors find out where they are on your site with just a glance.', 'foodie-world' ),
		'panel'         => 'foodie_world_theme_options',
		'title'         => esc_html__( 'Breadcrumb', 'foodie-world' ),
	) );

	foodie_world_register_option( $wp_customize, array(
			'name'              =>'foodie_world_breadcrumb_option',
			'default'           => 1,
			'sanitize_callback' => 'foodie_world_sanitize_checkbox',
			'label'             => esc_html__( 'Check to enable Breadcrumb', 'foodie-world' ),
			'section'           => 'foodie_world_breadcrumb_options',
			'type'              => 'checkbox',
	    )
	);
    // Breadcrumb Option End

	// Layout Options
	$wp_customize->add_section( 'foodie_world_layout_options', array(
		'title' => esc_html__( 'Layout Options', 'foodie-world' ),
		'panel' => 'foodie_world_theme_options',
		)
	);

	/* Layout Type */
	foodie_world_register_option( $wp_customize, array(
			'name'              => 'foodie_world_layout_type',
			'default'           => 'fluid',
			'sanitize_callback' => 'foodie_world_sanitize_select',
			'label'             => esc_html__( 'Site Layout', 'foodie-world' ),
			'section'           => 'foodie_world_layout_options',
			'type'              => 'radio',
			'choices'           => array(
				'fluid' => esc_html__( 'Fluid', 'foodie-world' ),
				'boxed' => esc_html__( 'Boxed', 'foodie-world' ),
			),
		)
	);

	/* Default Layout */
	foodie_world_register_option( $wp_customize, array(
			'name'              => 'foodie_world_default_layout',
			'default'           => 'right-sidebar',
			'sanitize_callback' => 'foodie_world_sanitize_select',
			'label'             => esc_html__( 'Default Layout', 'foodie-world' ),
			'section'           => 'foodie_world_layout_options',
			'type'              => 'radio',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'foodie-world' ),
				'no-sidebar'            => esc_html__( 'No Sidebar', 'foodie-world' ),
			),
		)
	);

	/* Homepage/Archive Layout */
	foodie_world_register_option( $wp_customize, array(
			'name'              => 'foodie_world_homepage_archive_layout',
			'default'           => 'no-sidebar-full-width',
			'sanitize_callback' => 'foodie_world_sanitize_select',
			'label'             => esc_html__( 'Homepage/Archive Layout', 'foodie-world' ),
			'section'           => 'foodie_world_layout_options',
			'type'              => 'radio',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'foodie-world' ),
				'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'foodie-world' ),
			),
		)
	);

	// Single Page/Post Image Layout
	foodie_world_register_option( $wp_customize, array(
			'name'              => 'foodie_world_single_layout',
			'default'           => 'disabled',
			'sanitize_callback' => 'foodie_world_sanitize_select',
			'label'             => esc_html__( 'Single Page/Post Image', 'foodie-world' ),
			'section'           => 'foodie_world_layout_options',
			'type'              => 'radio',
			'choices'           => array(
				'disabled'                 => esc_html__( 'Disabled', 'foodie-world' ),
				'post-thumbnail'           => esc_html__( 'Enable', 'foodie-world' ),
			),
		)
	);


	// Excerpt Options.
	$wp_customize->add_section( 'foodie_world_excerpt_options', array(
		'panel' => 'foodie_world_theme_options',
		'title' => esc_html__( 'Excerpt Options', 'foodie-world' ),
	) );

	foodie_world_register_option( $wp_customize, array(
			'name'              => 'foodie_world_excerpt_length',
			'default'           => '55',
			'sanitize_callback' => 'absint',
			'description' => esc_html__( 'Excerpt length. Default is 55 words', 'foodie-world' ),
			'input_attrs' => array(
				'min'   => 10,
				'max'   => 200,
				'step'  => 5,
				'style' => 'width: 60px;',
			),
			'label'    => esc_html__( 'Excerpt Length (words)', 'foodie-world' ),
			'section'  => 'foodie_world_excerpt_options',
			'type'     => 'number',
		)
	);

	foodie_world_register_option( $wp_customize, array(
			'name'              => 'foodie_world_excerpt_more_text',
			'default'           => esc_html__( 'Continue reading', 'foodie-world' ),
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Read More Text', 'foodie-world' ),
			'section'           => 'foodie_world_excerpt_options',
			'type'              => 'text',
		)
	);

	// Excerpt Options.
	$wp_customize->add_section( 'foodie_world_search_options', array(
		'panel'     => 'foodie_world_theme_options',
		'title'     => esc_html__( 'Search Options', 'foodie-world' ),
	) );

	foodie_world_register_option( $wp_customize, array(
			'name'              => 'foodie_world_search_text',
			'default'           => esc_html__( 'Search ...', 'foodie-world' ),
			'sanitize_callback' => 'wp_kses_data',
			'label'             => esc_html__( 'Search Text', 'foodie-world' ),
			'section'           => 'foodie_world_search_options',
			'type'              => 'text',
		)
	);

	// Homepage / Frontpage Options.
	$wp_customize->add_section( 'foodie_world_homepage_options', array(
		'description' => esc_html__( 'Only posts that belong to the categories selected here will be displayed on the front page', 'foodie-world' ),
		'panel'       => 'foodie_world_theme_options',
		'title'       => esc_html__( 'Homepage / Frontpage Options', 'foodie-world' ),
	) );

	foodie_world_register_option( $wp_customize, array(
			'name'              => 'foodie_world_recent_posts_heading',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => esc_html__( 'Recent Posts', 'foodie-world' ),
			'label'             => esc_html__( 'Recent Posts Heading', 'foodie-world' ),
			'section'           => 'foodie_world_homepage_options',
		)
	);

	foodie_world_register_option( $wp_customize, array(
			'name'              => 'foodie_world_front_page_category',
			'sanitize_callback' => 'foodie_world_sanitize_category_list',
			'custom_control'    => 'Foodie_World_Multi_Cat',
			'label'             => esc_html__( 'Categories', 'foodie-world' ),
			'section'           => 'foodie_world_homepage_options',
			'type'              => 'dropdown-categories',
		)
	);

	$wp_customize->add_section( 'foodie_world_pagination_options', array(
		'panel' => 'foodie_world_theme_options',
		'title' => esc_html__( 'Pagination Options', 'foodie-world' ),
	) );

	foodie_world_register_option( $wp_customize, array(
			'name'              => 'foodie_world_pagination_type',
			'default'           => 'default',
			'sanitize_callback' => 'foodie_world_sanitize_select',
			'choices'           => foodie_world_get_pagination_types(),
			'label'             => esc_html__( 'Pagination type', 'foodie-world' ),
			'section'           => 'foodie_world_pagination_options',
			'type'              => 'select',
		)
	);

	/* Scrollup Options */
	$wp_customize->add_section( 'foodie_world_scrollup', array(
		'panel'    => 'foodie_world_theme_options',
		'title'    => esc_html__( 'Scrollup Options', 'foodie-world' ),
	) );

	foodie_world_register_option( $wp_customize, array(
			'name'              => 'foodie_world_disable_scrollup',
			'sanitize_callback' => 'foodie_world_sanitize_checkbox',
			'label'             => esc_html__( 'Disable Scroll Up', 'foodie-world' ),
			'section'           => 'foodie_world_scrollup',
			'type'              => 'checkbox',
		)
	);
}
add_action( 'customize_register', 'foodie_world_theme_options' );
