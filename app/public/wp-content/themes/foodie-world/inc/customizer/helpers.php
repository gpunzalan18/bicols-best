<?php

/**
 * Function to register control and setting
 */
function foodie_world_register_option( $wp_customize, $option ) {
	// Initialize Setting.
	$wp_customize->add_setting( $option['name'], array(
		'sanitize_callback'    => $option['sanitize_callback'],
		'default'              => isset( $option['default'] ) ? $option['default'] : '',
		'transport'            => isset( $option['transport'] ) ? $option['transport'] : 'refresh',
		'theme_supports'       => isset( $option['theme_supports'] ) ? $option['theme_supports'] : '',
	) );

	$control = array(
		'label'    => $option['label'],
		'section'  => $option['section'],
		'settings' => $option['name'],
	);

	if ( isset( $option['active_callback'] ) ) {
		$control['active_callback'] = $option['active_callback'];
	}

	if ( isset( $option['priority'] ) ) {
		$control['priority'] = $option['priority'];
	}

	if ( isset( $option['choices'] ) ) {
		$control['choices'] = $option['choices'];
	}

	if ( isset( $option['type'] ) ) {
		$control['type'] = $option['type'];
	}

	if ( isset( $option['input_attrs'] ) ) {
		$control['input_attrs'] = $option['input_attrs'];
	}

	if ( isset( $option['description'] ) ) {
		$control['description'] = $option['description'];
	}

	if ( isset( $option['custom_control'] ) ) {
		$wp_customize->add_control( new $option['custom_control']( $wp_customize, $option['name'], $control ) );
	} else {
		$wp_customize->add_control( $option['name'], $control );
	}
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Foodie World 1.2
 * @see foodie_world_customize_register()
 *
 * @return void
 */
function foodie_world_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Foodie World 1.2
 * @see foodie_world_customize_register()
 *
 * @return void
 */
function foodie_world_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Function to reset date with respect to condition
 */
function foodie_world_reset_data() {
	if ( get_theme_mod( 'foodie_world_reset_all_settings' ) ) {
		remove_theme_mods();

		return;
	}
}
add_action( 'customize_save_after', 'foodie_world_reset_data' );

/**
 * Alphabetically sort theme options sections
 *
 * @param  wp_customize object $wp_customize wp_customize object.
 */
function foodie_world_sort_sections_list( $wp_customize ) {
	foreach ( $wp_customize->sections() as $section_key => $section_object ) {
		if ( false !== strpos( $section_key, 'foodie_world_' ) && 'foodie_world_reset_all' !== $section_key && 'foodie_world_important_links' !== $section_key ) {
			$options[] = $section_key;
		}
	}

	sort( $options );

	$priority = 1;
	foreach ( $options as  $option ) {
		$wp_customize->get_section( $option )->priority = $priority++;
	}
}
add_action( 'customize_register', 'foodie_world_sort_sections_list' );

/**
 * Returns an array of visibility options for featured sections
 *
 * @since Foodie World 0.1
 */
function foodie_world_section_visibility_options() {
	$options = array(
		'disabled'    => esc_html__( 'Disabled', 'foodie-world' ),
		'homepage'    => esc_html__( 'Homepage / Frontpage', 'foodie-world' ),
		'entire-site' => esc_html__( 'Entire Site', 'foodie-world' ),
	);

	return apply_filters( 'foodie_world_section_visibility_options', $options );
}

/**
 * Returns an array of featured content options
 *
 * @since Foodie World 0.1
 */
function foodie_world_sections_layout_options() {
	$options = array(
		'layout-one'   => esc_html__( '1 column', 'foodie-world' ),
		'layout-two'   => esc_html__( '2 columns', 'foodie-world' ),
		'layout-three' => esc_html__( '3 columns', 'foodie-world' ),
		'layout-four'  => esc_html__( '4 columns', 'foodie-world' ),
	);

	return apply_filters( 'foodie_world_sections_layout_options', $options );
}

/**
 * Returns an array of section types
 *
 * @since Foodie World 0.1
 */
function foodie_world_section_type_options() {
	$options = array(
		'demo'     => esc_html__( 'Demo', 'foodie-world' ),
		'post'     => esc_html__( 'Post', 'foodie-world' ),
		'page'     => esc_html__( 'Page', 'foodie-world' ),
		'category' => esc_html__( 'Category', 'foodie-world' ),
		'image'    => esc_html__( 'Image', 'foodie-world' ),
	);

	return apply_filters( 'foodie_world_section_type_options', $options );
}

/**
 * Returns an array of color schemes registered for catchresponsive.
 *
 * @since Foodie World 0.1
 */
function foodie_world_get_pagination_types() {
	$pagination_types = array(
		'default' => esc_html__( 'Default(Older Posts/Newer Posts)', 'foodie-world' ),
		'numeric' => esc_html__( 'Numeric', 'foodie-world' ),
	);

	return apply_filters( 'foodie_world_get_pagination_types', $pagination_types );
}

/**
 * Generate a list of all available post array
 *
 * @param  string $post_type post type.
 * @return post_array
 */
function foodie_world_generate_post_array( $post_type = 'post' ) {
	$output = array();
	$posts = get_posts( array(
		'post_type'        => $post_type,
		'post_status'      => 'publish',
		'suppress_filters' => false,
		'posts_per_page'   => -1,
		)
	);

	$output['0']= esc_html__( '-- Select --', 'foodie-world' );

	foreach ( $posts as $post ) {
		/* translators: 1: post id. */
		$output[ $post->ID ] = ! empty( $post->post_title ) ? $post->post_title : sprintf( __( '#%d (no title)', 'foodie-world' ), $post->ID );
	}

	return $output;
}

/**
 * Generate a list of all available taxonomy
 *
 * @param  string $post_type post type.
 * @return post_array
 */
function foodie_world_generate_taxonomy_array( $taxonomy = 'category' ) {
	$output = array();
	$taxonomy = get_categories( array( 'taxonomy' => $taxonomy ) );

	$output['0']= esc_html__( '-- Select --', 'foodie-world' );

	foreach ( $taxonomy as $tax ) {
		$output[ $tax->term_id ] = ! empty($tax->name ) ?$tax->name : sprintf( __( '#%d (no title)', 'foodie-world' ), $tax->term_id );
	}

	return $output;
}
