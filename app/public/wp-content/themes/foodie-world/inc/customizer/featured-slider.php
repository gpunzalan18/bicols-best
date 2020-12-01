<?php
/**
 * Featured Slider Options
 *
 * @package Foodie_World
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function foodie_world_slider_options( $wp_customize ) {
	$wp_customize->add_section( 'foodie_world_featured_slider', array(
			'panel' => 'foodie_world_theme_options',
			'title' => esc_html__( 'Featured Slider', 'foodie-world' ),
		)
	);

	foodie_world_register_option( $wp_customize, array(
			'name'              => 'foodie_world_slider_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'foodie_world_sanitize_select',
			'choices'           => foodie_world_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'foodie-world' ),
			'section'           => 'foodie_world_featured_slider',
			'type'              => 'select',
		)
	);

	foodie_world_register_option( $wp_customize, array(
			'name'              => 'foodie_world_slider_transition_effect',
			'default'           => 'fade',
			'sanitize_callback' => 'foodie_world_sanitize_select',
			'active_callback'   => 'foodie_world_is_slider_active',
			'choices'           => foodie_world_slider_transition_effects(),
			'label'             => esc_html__( 'Transition Effect', 'foodie-world' ),
			'section'           => 'foodie_world_featured_slider',
			'type'              => 'select',
		)
	);

	foodie_world_register_option( $wp_customize, array(
			'name'              => 'foodie_world_slider_transition_delay',
			'default'           => '4',
			'sanitize_callback' => 'absint',
			'active_callback'   => 'foodie_world_is_slider_active',
			'description'       => esc_html__( 'seconds(s)', 'foodie-world' ),
			'input_attrs'       => array(
				'style' => 'width: 40px;',
			),
			'label'             => esc_html__( 'Transition Delay', 'foodie-world' ),
			'section'           => 'foodie_world_featured_slider',
		)
	);

	foodie_world_register_option( $wp_customize, array(
			'name'              => 'foodie_world_slider_transition_length',
			'default'           => '1',
			'sanitize_callback' => 'absint',

			'active_callback'   => 'foodie_world_is_slider_active',
			'description'       => esc_html__( 'seconds(s)', 'foodie-world' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
			),
			'label'             => esc_html__( 'Transition Length', 'foodie-world' ),
			'section'           => 'foodie_world_featured_slider',
		)
	);

	foodie_world_register_option( $wp_customize, array(
			'name'              => 'foodie_world_slider_image_loader',
			'default'           => 'false',
			'sanitize_callback' => 'foodie_world_sanitize_select',
			'active_callback'   => 'foodie_world_is_slider_active',
			'choices'           => foodie_world_slider_image_loader(),
			'label'             => esc_html__( 'Image Loader', 'foodie-world' ),
			'section'           => 'foodie_world_featured_slider',
			'type'              => 'select',
		)
	);

	foodie_world_register_option( $wp_customize, array(
			'name'              => 'foodie_world_slider_disable_pager',
			'sanitize_callback' => 'foodie_world_sanitize_checkbox',
			'active_callback'   => 'foodie_world_is_slider_active',
			'label'             => esc_html__( 'Check to disable pager/navigation', 'foodie-world' ),
			'section'           => 'foodie_world_featured_slider',
			'type'              => 'checkbox',
		)
	);

	foodie_world_register_option( $wp_customize, array(
			'name'              => 'foodie_world_slider_number',
			'default'           => '4',
			'sanitize_callback' => 'foodie_world_sanitize_number_range',

			'active_callback'   => 'foodie_world_is_slider_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Slides is changed (Max no of slides is 20)', 'foodie-world' ),
			'input_attrs'       => array(
				'style' => 'width: 45px;',
				'min'   => 0,
				'max'   => 20,
				'step'  => 1,
			),
			'label'             => esc_html__( 'No of items', 'foodie-world' ),
			'section'           => 'foodie_world_featured_slider',
			'type'              => 'number',
			'transport'         => 'postMessage',
		)
	);

	$slider_number = get_theme_mod( 'foodie_world_slider_number', 4 );

	for ( $i = 1; $i <= $slider_number ; $i++ ) {
		// Page Sliders
		foodie_world_register_option( $wp_customize, array(
				'name'              =>'foodie_world_slider_page_' . $i,
				'sanitize_callback' => 'foodie_world_sanitize_post',
				'active_callback'   => 'foodie_world_is_slider_active',
				'label'             => esc_html__( 'Page', 'foodie-world' ) . ' # ' . $i,
				'section'           => 'foodie_world_featured_slider',
				'type'              => 'dropdown-pages',
			)
		);
	} // End for().

}
add_action( 'customize_register', 'foodie_world_slider_options' );


/**
 * Returns an array of feature slider transition effects
 *
 * @since Foodie World 0.1
 */
function foodie_world_slider_transition_effects() {
	$options = array(
		'fade'       => esc_html__( 'Fade', 'foodie-world' ),
		'fadeout'    => esc_html__( 'Fade Out', 'foodie-world' ),
		'none'       => esc_html__( 'None', 'foodie-world' ),
		'scrollHorz' => esc_html__( 'Scroll Horizontal', 'foodie-world' ),
		'scrollVert' => esc_html__( 'Scroll Vertical', 'foodie-world' ),
		'flipHorz'   => esc_html__( 'Flip Horizontal', 'foodie-world' ),
		'flipVert'   => esc_html__( 'Flip Vertical', 'foodie-world' ),
		'tileSlide'  => esc_html__( 'Tile Slide', 'foodie-world' ),
		'tileBlind'  => esc_html__( 'Tile Blind', 'foodie-world' ),
		'shuffle'    => esc_html__( 'Shuffle', 'foodie-world' ),
	);

	return apply_filters( 'foodie_world_slider_transition_effects', $options );
}


/**
 * Returns an array of featured slider image loader options
 *
 * @since Foodie World 0.1
 */
function foodie_world_slider_image_loader() {
	$options = array(
		'true'  => esc_html__( 'True', 'foodie-world' ),
		'wait'  => esc_html__( 'Wait', 'foodie-world' ),
		'false' => esc_html__( 'False', 'foodie-world' ),
	);

	return apply_filters( 'foodie_world_slider_image_loader', $options );
}


/**
 * Returns an array of featured content show registered for Lucida.
 *
 * @since Foodie World 0.1
 */
function foodie_world_content_show() {
	$options = array(
		'excerpt'      => esc_html__( 'Show Excerpt', 'foodie-world' ),
		'full-content' => esc_html__( 'Full Content', 'foodie-world' ),
		'hide-content' => esc_html__( 'Hide Content', 'foodie-world' ),
	);
	return apply_filters( 'foodie_world_content_show', $options );
}

/**
 * Returns an array of featured content show registered for Lucida.
 *
 * @since Foodie World 0.1
 */
function foodie_world_meta_show() {
	$options = array(
		'show-meta'      => esc_html__( 'Show Meta', 'foodie-world' ),
		'hide-meta' => esc_html__( 'Hide Meta', 'foodie-world' ),
	);
	return apply_filters( 'foodie_world_content_show', $options );
}

/** Active Callback Functions */

if( ! function_exists( 'foodie_world_is_slider_active' ) ) :
	/**
	* Return true if slider is active
	*
	* @since Foodie World 0.1
	*/
	function foodie_world_is_slider_active( $control ) {
		$enable = $control->manager->get_setting( 'foodie_world_slider_option' )->value();

		//return true only if previewed page on customizer matches the type of slider option selected
		return ( foodie_world_check_section( $enable ) );
	}
endif;
