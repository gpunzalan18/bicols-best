<?php
/**
 * Services options
 *
 * @package Foodie_World
 */

/**
 * Add services content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function foodie_world_services_options( $wp_customize ) {
	// Add note to Jetpack Testimonial Section
    foodie_world_register_option( $wp_customize, array(
            'name'              => 'foodie_world_services_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Foodie_World_Note_Control',
            'label'             => sprintf( esc_html__( 'For all Services Options for Foodie World Theme, go %1$shere%2$s', 'foodie-world' ),
                '<a href="javascript:wp.customize.section( \'foodie_world_services\' ).focus();">',
                 '</a>'
            ),
           'section'            => 'services',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    $wp_customize->add_section( 'foodie_world_services', array(
			'title' => esc_html__( 'Services', 'foodie-world' ),
			'panel' => 'foodie_world_theme_options',
		)
	);

	foodie_world_register_option( $wp_customize, array(
            'name'              => 'foodie_world_service_note_1',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Foodie_World_Note_Control',
            'active_callback'   => 'foodieworld_is_ect_service_inactive',
            'label'             => sprintf( esc_html__( 'For Services, install %1$sEssential Content Types%2$s Plugin with Services Content Type Enabled', 'foodie-world' ),
                '<a target="_blank" href="https://wordpress.org/plugins/essential-content-types/">',
                '</a>'
            ),
            'section'           => 'foodie_world_services',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

	// Add color scheme setting and control.
	foodie_world_register_option( $wp_customize, array(
			'name'              => 'foodie_world_services_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'foodie_world_sanitize_select',
			'active_callback'   => 'foodieworld_is_ect_service_active',
			'choices'           => foodie_world_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'foodie-world' ),
			'section'           => 'foodie_world_services',
			'type'              => 'select',
		)
	);

	foodie_world_register_option( $wp_customize, array(
            'name'              => 'foodie_world_services_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Foodie_World_Note_Control',
            'active_callback'   => 'foodie_world_is_services_active',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'foodie-world' ),
                 '<a href="javascript:wp.customize.control( \'ect_service_title\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'foodie_world_services',
            'type'              => 'description',
        )
    );

	foodie_world_register_option( $wp_customize, array(
			'name'              => 'foodie_world_services_number',
			'default'           => 2,
			'sanitize_callback' => 'foodie_world_sanitize_number_range',
			'active_callback'   => 'foodie_world_is_services_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Services is changed (Max no of Services is 20)', 'foodie-world' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'No of items', 'foodie-world' ),
			'section'           => 'foodie_world_services',
			'type'              => 'number',
			'transport'         => 'postMessage',
		)
	);

	foodie_world_register_option( $wp_customize, array(
			'name'              => 'foodie_world_services_show',
			'default'           => 'excerpt',
			'sanitize_callback' => 'foodie_world_sanitize_select',
			'active_callback'   => 'foodie_world_is_services_active',
			'choices'           => foodie_world_content_show(),
			'label'             => esc_html__( 'Display Content', 'foodie-world' ),
			'section'           => 'foodie_world_services',
			'type'              => 'select',
		)
	);

	$number = get_theme_mod( 'foodie_world_services_number', 2 );

	//loop for services post content
	for ( $i = 1; $i <= $number ; $i++ ) {

		foodie_world_register_option( $wp_customize, array(
				'name'              => 'foodie_world_services_cpt_' . $i,
				'sanitize_callback' => 'foodie_world_sanitize_post',
				'active_callback'   => 'foodie_world_is_services_active',
				'label'             => esc_html__( 'Services', 'foodie-world' ) . ' ' . $i ,
				'section'           => 'foodie_world_services',
				'type'              => 'select',
                'choices'           => foodie_world_generate_post_array( 'ect-service' ),
			)
		);

	} // End for().
}
add_action( 'customize_register', 'foodie_world_services_options', 10 );

/** Active Callback Functions **/
if ( ! function_exists( 'foodie_world_is_services_active' ) ) :
    /**
    * Return true if featured content is active
    *
    * @since Foodie World 0.1
    */
    function foodie_world_is_services_active( $control ) {
        $enable = $control->manager->get_setting( 'foodie_world_services_option' )->value();

        return ( foodieworld_is_ect_service_active( $control ) && foodie_world_check_section( $enable ) );
    }
endif;

if ( ! function_exists( 'foodieworld_is_ect_service_inactive' ) ) :
    /**
    * Return true if service is active
    *
    * @since Personal Trainer 0.1
    */
    function foodieworld_is_ect_service_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Service' ) || class_exists( 'Essential_Content_Pro_Service' ) );
    }
endif;

if ( ! function_exists( 'foodieworld_is_ect_service_active' ) ) :
    /**
    * Return true if service is active
    *
    * @since Personal Trainer 0.1
    */
    function foodieworld_is_ect_service_active( $control ) {
        return ( class_exists( 'Essential_Content_Service' ) || class_exists( 'Essential_Content_Pro_Service' ) );
    }
endif;
