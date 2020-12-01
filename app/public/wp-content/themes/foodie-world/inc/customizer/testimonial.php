<?php
/**
 * Add Testimonial Settings in Customizer
 *
 * @package Foodie_World
*/

/**
 * Add testimonial options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function foodie_world_testimonial_options( $wp_customize ) {
    // Add note to Jetpack Testimonial Section
    foodie_world_register_option( $wp_customize, array(
            'name'              => 'foodie_world_jetpack_testimonial_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Foodie_World_Note_Control',
            'label'             => sprintf( esc_html__( 'For Testimonial Options for Foodie World Theme, go %1$shere%2$s', 'foodie-world' ),
                '<a href="javascript:wp.customize.section( \'foodie_world_testimonials\' ).focus();">',
                 '</a>'
            ),
           'section'            => 'jetpack_testimonials',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    $wp_customize->add_section( 'foodie_world_testimonials', array(
            'panel'    => 'foodie_world_theme_options',
            'title'    => esc_html__( 'Testimonials', 'foodie-world' ),
        )
    );

    foodie_world_register_option( $wp_customize, array(
            'name'              => 'foodie_world_testimonial_note_1',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Foodie_World_Note_Control',
            'active_callback'   => 'foodieworld_is_ect_testimonial_inactive',
            'label'             => sprintf( esc_html__( 'For Testimonials, install %1$sEssential Content Types%2$s Plugin with Testimonials Content Type Enabled', 'foodie-world' ),
                '<a target="_blank" href="https://wordpress.org/plugins/essential-content-types/">',
                '</a>'
            ),
            'section'           => 'foodie_world_testimonials',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    foodie_world_register_option( $wp_customize, array(
            'name'              => 'foodie_world_testimonial_option',
            'default'           => 'disabled',
            'sanitize_callback' => 'foodie_world_sanitize_select',
            'active_callback'   => 'foodieworld_is_ect_testimonail_active',
            'choices'           => foodie_world_section_visibility_options(),
            'label'             => esc_html__( 'Enable on', 'foodie-world' ),
            'section'           => 'foodie_world_testimonials',
            'type'              => 'select',
            'priority'          => 1,
        )
    );

    foodie_world_register_option( $wp_customize, array(
            'name'              => 'foodie_world_testimonial_slider',
            'default'           => 1,
            'sanitize_callback' => 'foodie_world_sanitize_checkbox',
            'active_callback'   => 'foodie_world_is_testimonials_active',
            'label'             => esc_html__( 'Check to Enable Slider', 'foodie-world' ),
            'section'           => 'foodie_world_testimonials',
            'type'              => 'checkbox',
        )
    );

    foodie_world_register_option( $wp_customize, array(
            'name'              => 'foodie_world_testimonial_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Foodie_World_Note_Control',
            'active_callback'   => 'foodie_world_is_testimonials_active',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'foodie-world' ),
                '<a href="javascript:wp.customize.section( \'jetpack_testimonials\' ).focus();">',
                '</a>'
            ),
            'section'           => 'foodie_world_testimonials',
            'type'              => 'description',
        )
    );

    foodie_world_register_option( $wp_customize, array(
            'name'              => 'foodie_world_testimonial_number',
            'default'           => 4,
            'sanitize_callback' => 'foodie_world_sanitize_number_range',
            'active_callback'   => 'foodie_world_is_testimonials_active',
            'label'             => esc_html__( 'No of items', 'foodie-world' ),
            'section'           => 'foodie_world_testimonials',
            'type'              => 'number',
            'input_attrs'       => array(
                'style'             => 'width: 100px;',
                'min'               => 0,
            ),
        )
    );

    $number = get_theme_mod( 'foodie_world_testimonial_number', 4 );

    for ( $i = 1; $i <= $number ; $i++ ) {

        //for CPT
        foodie_world_register_option( $wp_customize, array(
                'name'              => 'foodie_world_testimonial_cpt_' . $i,
                'sanitize_callback' => 'foodie_world_sanitize_post',
                'active_callback'   => 'foodie_world_is_testimonials_active',
                'label'             => esc_html__( 'Testimonial', 'foodie-world' ) . ' ' . $i ,
                'section'           => 'foodie_world_testimonials',
                'type'              => 'select',
                'choices'           => foodie_world_generate_post_array( 'jetpack-testimonial' ),
            )
        );
    } // End for().
}
add_action( 'customize_register', 'foodie_world_testimonial_options' );

/**
 * Active Callback Functions
 */
if ( ! function_exists( 'foodie_world_is_testimonials_active' ) ) :
    /**
    * Return true if featured content is active
    *
    * @since Foodie World 0.1
    */
    function foodie_world_is_testimonials_active( $control ) {
        $enable = $control->manager->get_setting( 'foodie_world_testimonial_option' )->value();

        return ( foodieworld_is_ect_testimonail_active( $control ) && foodie_world_check_section( $enable ) );
    }
endif;

if ( ! function_exists( 'foodieworld_is_ect_testimonial_inactive' ) ) :
    /**
    * Return true if service is active
    *
    * @since Personal Trainer 0.1
    */
    function foodieworld_is_ect_testimonial_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Service' ) || class_exists( 'Essential_Content_Pro_Service' ) );
    }
endif;

if ( ! function_exists( 'foodieworld_is_ect_testimonail_active' ) ) :
    /**
    * Return true if service is active
    *
    * @since Personal Trainer 0.1
    */
    function foodieworld_is_ect_testimonail_active( $control ) {
        return ( class_exists( 'Essential_Content_Service' ) || class_exists( 'Essential_Content_Pro_Service' ) );
    }
endif;
