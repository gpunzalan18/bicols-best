<?php
/**
 * Featured Content options
 *
 * @package Foodie_World
 */

/**
 * Add featured content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function foodie_world_featured_content_options( $wp_customize ) {
	// Add note to Jetpack Testimonial Section
    foodie_world_register_option( $wp_customize, array(
            'name'              => 'foodie_world_featured_content_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Foodie_World_Note_Control',
            'active_callback'   => 'foodieworld_is_ect_featured_content_inactive',
            'label'             => sprintf( esc_html__( 'For Featured Content, install %1$sEssential Content Types%2$s Plugin with Featured Content Type Enabled', 'foodie-world' ),
                '<a target="_blank" href="https://wordpress.org/plugins/essential-content-types/">',
                '</a>'
            ),
           'section'            => 'foodie_world_featured_content',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    $wp_customize->add_section( 'foodie_world_featured_content', array(
			'title' => esc_html__( 'Featured Content', 'foodie-world' ),
			'panel' => 'foodie_world_theme_options',
		)
	);

	// Add color scheme setting and control.
	foodie_world_register_option( $wp_customize, array(
			'name'              => 'foodie_world_featured_content_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'foodie_world_sanitize_select',
			'active_callback'   => 'foodieworld_is_ect_featured_content_active',
			'choices'           => foodie_world_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'foodie-world' ),
			'section'           => 'foodie_world_featured_content',
			'type'              => 'select',
		)
	);

    foodie_world_register_option( $wp_customize, array(
            'name'              => 'foodie_world_featured_content_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Foodie_World_Note_Control',
            'active_callback'   => 'foodie_world_is_featured_content_active',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'foodie-world' ),
                 '<a href="javascript:wp.customize.control( \'featured_content_title\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'foodie_world_featured_content',
            'type'              => 'description',
        )
    );

	foodie_world_register_option( $wp_customize, array(
			'name'              => 'foodie_world_featured_content_number',
			'default'           => 3,
			'sanitize_callback' => 'foodie_world_sanitize_number_range',
			'active_callback'   => 'foodie_world_is_featured_content_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Featured Content is changed (Max no of Featured Content is 20)', 'foodie-world' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'No of items', 'foodie-world' ),
			'section'           => 'foodie_world_featured_content',
			'type'              => 'number',
			'transport'         => 'postMessage',
		)
	);

	foodie_world_register_option( $wp_customize, array(
			'name'              => 'foodie_world_featured_content_show',
			'default'           => 'excerpt',
			'sanitize_callback' => 'foodie_world_sanitize_select',
			'active_callback'   => 'foodie_world_is_featured_content_active',
			'choices'           => foodie_world_content_show(),
			'label'             => esc_html__( 'Display Content', 'foodie-world' ),
			'section'           => 'foodie_world_featured_content',
			'type'              => 'select',
		)
	);

	$number = get_theme_mod( 'foodie_world_featured_content_number', 3 );

	//loop for featured post content
	for ( $i = 1; $i <= $number ; $i++ ) {

		foodie_world_register_option( $wp_customize, array(
				'name'              => 'foodie_world_featured_content_cpt_' . $i,
				'sanitize_callback' => 'foodie_world_sanitize_post',
				'active_callback'   => 'foodie_world_is_featured_content_active',
				'label'             => esc_html__( 'Featured Content', 'foodie-world' ) . ' ' . $i ,
				'section'           => 'foodie_world_featured_content',
				'type'              => 'select',
                'choices'           => foodie_world_generate_post_array( 'featured-content' ),
			)
		);

	} // End for().
}
add_action( 'customize_register', 'foodie_world_featured_content_options', 10 );

/** Active Callback Functions **/
if ( ! function_exists( 'foodie_world_is_featured_content_active' ) ) :
	/**
	* Return true if featured content is active
	*
	* @since Foodie World 0.1
	*/
	function foodie_world_is_featured_content_active( $control ) {
		$enable = $control->manager->get_setting( 'foodie_world_featured_content_option' )->value();

		//return true only if previewed page on customizer matches the type of content option selected
		return ( foodie_world_check_section( $enable ) );
	}
endif;


if ( ! function_exists( 'foodieworld_is_ect_featured_content_inactive' ) ) :
    /**
    * Return true if featured_content is active
    *
    * @since Personal Trainer 0.1
    */
    function foodieworld_is_ect_featured_content_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Featured_Content' ) || class_exists( 'Essential_Content_Pro_Featured_Content' ) );
    }
endif;
if ( ! function_exists( 'foodieworld_is_ect_featured_content_active' ) ) :
    /**
    * Return true if featured_content is active
    *
    * @since Simple Persona 0.1
    */
    function foodieworld_is_ect_featured_content_active( $control ) {
        return ( class_exists( 'Essential_Content_Featured_Content' ) || class_exists( 'Essential_Content_Pro_Featured_Content' ) );
    }
endif;
